
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ==========================================
   CHECK USER LOGIN
========================================== */

if (!isset($_SESSION['uid'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Required - Smart Tiffin Service</title>
        <style>
            * { box-sizing: border-box; margin: 0; padding: 0; }
            body {
                font-family: Arial, sans-serif;
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
                background: linear-gradient(135deg, #fff7e8, #ffe2b5);
            }
            .login-box {
                width: 100%;
                max-width: 460px;
                padding: 40px 30px;
                background: white;
                text-align: center;
                border-radius: 22px;
                box-shadow: 0 15px 45px rgba(70,40,10,.12);
            }
            .cart-icon { font-size: 50px; margin-bottom: 20px; }
            h1 { color: #39200d; font-size: 27px; margin-bottom: 12px; }
            p { color: #777; line-height: 1.7; margin-bottom: 25px; }
            .action-buttons { display: flex; flex-direction: column; gap: 12px; }
            .action-buttons a {
                display: block;
                padding: 14px;
                border-radius: 30px;
                background: linear-gradient(135deg, #f58220, #ffa21a);
                color: white;
                font-weight: bold;
                text-decoration: none;
            }
            .action-buttons .register-link {
                background: white;
                color: #f58220;
                border: 1px solid #f58220;
            }
            .home-link {
                display: inline-block;
                margin-top: 22px;
                color: #777;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="login-box">
            <div class="cart-icon">🛒</div>
            <h1>Please Login First!</h1>
            <p>Please log in to your account to view your cart and continue with your order.</p>
            <div class="action-buttons">
                <a href="login.php">Login to Your Account</a>
                <a href="register.php" class="register-link">Create New Account</a>
            </div>
            <a href="index.php" class="home-link">← Back to Home</a>
        </div>
    </body>
    </html>
    <?php
    exit();
}

/* ==========================================
   DATABASE CONNECTION
========================================== */

include('../admin/connection.php');

/* ==========================================
   REMOVE PRODUCT
========================================== */

if (isset($_GET['remove'])) {

    $remove_id = (int) $_GET['remove'];

    $current_uid = (int) $_SESSION['uid'];

    $stmt = mysqli_prepare(
        $con,
        "DELETE FROM add_to_cart WHERE cartid = ? AND uid = ?"
    );

    mysqli_stmt_bind_param($stmt, "ii", $remove_id, $current_uid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: checkout.php");
    exit();
}

/* ==========================================
   CART QUERY
========================================== */

$current_uid = (int) $_SESSION['uid'];

$stmt = mysqli_prepare(
    $con,
    "SELECT p.*, a.*, pm.*
     FROM plan_detail p
     INNER JOIN add_to_cart a
        ON a.plandetail_id = p.plandetail_id
     INNER JOIN plan_master pm
        ON pm.plan_id = p.plan_id
     WHERE a.uid = ?"
);

mysqli_stmt_bind_param($stmt, "i", $current_uid);
mysqli_stmt_execute($stmt);
$q = mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

if (!$q) {
    die("Cart query error: " . mysqli_error($con));
}

$cart_count = mysqli_num_rows($q);

$cart_total = 0;
$selected_plan = "";
$cart_items = [];

while ($row = mysqli_fetch_assoc($q)) {

    $unit_price = (float) $row['charger_per_day'] * 15;

    $row['calculated_unit_price'] = $unit_price;

    $cart_items[] = $row;

    $cart_total += $unit_price;

    $selected_plan = $row['plan_name'];
}

if ($cart_count > 0) {
    $_SESSION['order_plan_name'] = $selected_plan;
    $_SESSION['order_price'] = $cart_total;
} else {
    unset($_SESSION['order_plan_name']);
    unset($_SESSION['order_price']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lunch Box - Check Out</title>

    <link rel="shortcut icon" type="image/png" href="images/logo/favicon.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/font-awesome-6.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/checkout.css">

    <style>
        .checkout-page {
            padding: 38px 0 55px;
            background: #faf8f4;
            min-height: 65vh;
        }

        .checkout-page .container {
            max-width: 1350px;
        }

        .checkout-title { margin-bottom: 28px; }

        .checkout-title h1 {
            color: #302015;
            font-size: 35px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .checkout-title p {
            color: #80766b;
            font-size: 15px;
        }

        .checkout-card,
        .summary-card {
            background: #fff;
            border: 1px solid #eee7dc;
            border-radius: 16px;
            box-shadow: 0 7px 25px rgba(50,30,10,.07);
            overflow: hidden;
        }

        .checkout-card { padding: 25px; }

        .section-heading {
            font-size: 21px;
            font-weight: 800;
            color: #30241a;
            margin: 0 0 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid #eee8df;
        }

        .section-heading i {
            color: #f5a018;
            margin-right: 9px;
        }

        .product-item {
            display: flex;
            align-items: center;
            gap: 17px;
            padding: 19px 0;
            border-bottom: 1px solid #f0ece6;
        }

        .product-img {
            width: 100px;
            height: 100px;
            flex-shrink: 0;
            overflow: hidden;
            border-radius: 12px;
            background: #fff3dc;
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info { flex: 1; min-width: 0; }

        .product-info h5 {
            font-size: 18px;
            font-weight: 800;
            color: #30241a;
            margin-bottom: 7px;
        }

        .product-info p {
            color: #81786e;
            font-size: 13px;
            margin-bottom: 9px;
        }

        .product-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 10px;
        }

        .product-meta span {
            background: #fff3dd;
            color: #89530c;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .remove-product {
            color: #d84c43;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
        }

        .remove-product:hover { color: #a8231d; }

        .quantity-box {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-top: 12px;
        }

        .quantity-btn {
            width: 31px;
            height: 31px;
            border: 1px solid #f2c56f;
            border-radius: 7px;
            background: #fff5e2;
            color: #8b5006;
            font-size: 18px;
            cursor: pointer;
        }

        .quantity-btn:hover {
            background: #ffa91f;
            color: #fff;
        }

        .quantity-input {
            width: 45px;
            padding: 5px 2px;
            text-align: center;
            border: 1px solid #e6dfd5;
            border-radius: 6px;
        }

        .product-price {
            min-width: 95px;
            text-align: right;
        }

        .product-price strong {
            color: #30241a;
            font-size: 16px;
            white-space: nowrap;
        }

        .product-price small {
            display: block;
            margin-top: 7px;
            color: #898078;
        }

        .summary-card { position: sticky; top: 20px; }

        .summary-heading {
            padding: 22px;
            border-bottom: 1px solid #eee8df;
            font-size: 21px;
            font-weight: 800;
            color: #30241a;
        }

        .summary-heading i {
            color: #f5a018;
            margin-right: 9px;
        }

        .summary-body { padding: 22px; }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 17px;
            color: #6d655d;
            font-size: 14px;
        }

        .summary-row strong {
            color: #30241a;
            text-align: right;
        }

        .summary-row .free { color: #168a43; }

        .summary-total-row {
            border-top: 1px solid #eee8df;
            padding-top: 20px;
            margin-top: 8px;
        }

        .summary-total-row span {
            color: #30241a;
            font-weight: 800;
            font-size: 16px;
        }

        .summary-total {
            color: #f3980d !important;
            font-size: 23px;
            font-weight: 800;
        }

        .payment-section { margin-top: 30px; }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 16px;
            margin-bottom: 12px;
            border: 1px solid #e9e3d9;
            border-radius: 12px;
            cursor: pointer;
            background: #fff;
            transition: .25s ease;
        }

        .payment-option:hover {
            border-color: #ffb02c;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255,159,24,.09);
        }

        .payment-option.active {
            border-color: #ffa51e;
            background: #fff9ed;
        }

        .payment-option input[type="radio"] {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            accent-color: #f5a018;
            cursor: pointer;
        }

        .payment-icon {
            width: 43px;
            height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff0d0;
            color: #e38b00;
            border-radius: 10px;
            font-size: 20px;
            flex-shrink: 0;
        }

        .payment-details { flex: 1; }

        .payment-details strong {
            display: block;
            color: #30241a;
            font-size: 15px;
            margin-bottom: 5px;
        }

        .payment-details small {
            display: block;
            color: #81786e;
            font-size: 12px;
            line-height: 1.6;
        }

        .upi-panel {
            display: none;
            padding: 20px;
            margin: -2px 0 15px;
            border: 1px solid #f5cb80;
            border-radius: 13px;
            background: linear-gradient(135deg, #fffaf1, #fff0d3);
        }

        .upi-panel.show {
            display: block;
            animation: upiFade .25s ease;
        }

        @keyframes upiFade {
            from { opacity: 0; transform: translateY(-6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .upi-content {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        .qr-frame {
            width: 160px;
            height: 160px;
            flex-shrink: 0;
            padding: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,.08);
        }

        .qr-frame img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .qr-placeholder {
            color: #81766a;
            text-align: center;
            font-size: 11px;
            line-height: 1.6;
        }

        .upi-info { flex: 1; min-width: 0; }

        .upi-info h4 {
            color: #30241a;
            font-size: 19px;
            font-weight: 800;
            margin-bottom: 15px;
        }

        .upi-id-label {
            color: #756b5f;
            font-size: 12px;
            margin-bottom: 6px;
        }

        .upi-id-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .upi-id {
            background: #ffedca;
            color: #603b0c;
            padding: 9px 11px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .copy-upi {
            border: 0;
            border-radius: 7px;
            padding: 9px 11px;
            background: #ffad24;
            color: #38200a;
            cursor: pointer;
        }

        .upi-apps {
            display: flex;
            flex-wrap: wrap;
            gap: 17px;
            margin-top: 18px;
        }

        .upi-app {
            color: #625b53;
            font-size: 11px;
            text-align: center;
        }

        .upi-app i {
            display: block;
            font-size: 22px;
            margin-bottom: 5px;
            color: #7446bd;
        }

        .upi-note {
            margin-top: 17px;
            padding: 12px;
            background: #ffedcc;
            color: #76501b;
            border-radius: 9px;
            font-size: 12px;
            line-height: 1.7;
        }

        .checkout-btn {
            width: 100%;
            min-height: 53px;
            margin-top: 8px;
            border: 0;
            border-radius: 11px;
            background: linear-gradient(110deg, #ffb522, #ff9815);
            color: #2d1b08;
            font-size: 16px;
            font-weight: 800;
            cursor: pointer;
            transition: .25s ease;
        }

        .checkout-btn:hover {
            background: linear-gradient(110deg, #ffa313, #f58208);
            transform: translateY(-2px);
            box-shadow: 0 7px 18px rgba(255,153,20,.23);
        }

        .secure-message {
            font-size: 12px;
            color: #898078;
            text-align: center;
            margin: 14px 0 0;
        }

        .secure-message i {
            color: #e99b19;
            margin-right: 5px;
        }

        .empty-cart { text-align: center; padding: 50px 20px; }
        .empty-cart-icon { font-size: 50px; color: #ffad27; margin-bottom: 18px; }
        .empty-cart h3 { color: #33251a; font-weight: 800; }
        .empty-line { width: 55px; height: 4px; border-radius: 5px; background: #ffae27; margin: 18px auto; }

        .home-btn {
            display: inline-block;
            padding: 12px 22px;
            background: #ffab20;
            color: #2d1d0b;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
        }

        @media (max-width: 991px) {
            .summary-card { position: static; }
            .checkout-page { padding: 25px 0 40px; }
        }

        @media (max-width: 575px) {
            .checkout-card { padding: 16px; }
            .checkout-title h1 { font-size: 28px; }
            .product-item { gap: 11px; flex-wrap: wrap; }
            .product-img { width: 78px; height: 78px; }
            .product-info { flex: 1; }
            .product-price { margin-left: auto; }
            .upi-content { flex-direction: column; align-items: stretch; }
            .qr-frame { margin: 0 auto; }
            .upi-info h4 { text-align: center; }
            .upi-apps { justify-content: center; }
            .summary-body { padding: 17px; }
        }
    </style>
</head>

<body>

<main class="innerPage">

    <header class="w-100 clearfix header">
    </header>

    <section class="checkout-page">
        <div class="container">

            <div class="checkout-title">
                <h1>Your Order</h1>
                <p>Review your meal plans and complete your order.</p>
            </div>

            <div class="row g-4">

                <div class="col-lg-8">
                    <div class="checkout-card">

                        <?php if ($cart_count > 0) { ?>

                            <h3 class="section-heading">
                                <i class="fa-solid fa-bag-shopping"></i>
                                Order Items
                                <span style="font-size:14px;color:#8a8177;font-weight:500;">
                                    (<?php echo $cart_count; ?> items)
                                </span>
                            </h3>

                            <?php foreach ($cart_items as $row) {
                                $item_total = $row['calculated_unit_price'];
                            ?>

                                <div class="product-item">

                                    <div class="product-img">
                                        <img src="../admin/upload/<?php echo htmlspecialchars($row['photo']); ?>"
                                             alt="<?php echo htmlspecialchars($row['plan_name']); ?>">
                                    </div>

                                    <div class="product-info">
                                        <h5><?php echo htmlspecialchars($row['plan_name']); ?></h5>
                                        <p><?php echo htmlspecialchars($row['plan_details']); ?></p>

                                        <div class="product-meta">
                                            <span>Lunch</span>
                                            <span><?php echo htmlspecialchars($row['days']); ?> Days</span>
                                        </div>

                                        <a href="checkout.php?remove=<?php echo (int)$row['cartid']; ?>"
                                           class="remove-product"
                                           onclick="return confirm('Are you sure you want to remove this product?');">
                                            <i class="fa-solid fa-trash"></i> Remove Product
                                        </a>

                                        <div class="quantity-box">
                                            <button type="button" class="quantity-btn quantity-minus">−</button>
                                            <input type="number" class="quantity-input" value="1" min="1" step="1">
                                            <button type="button" class="quantity-btn quantity-plus">+</button>
                                        </div>
                                    </div>

                                    <div class="product-price" data-unit-price="<?php echo $item_total; ?>">
                                        <strong class="item-price">₹<?php echo number_format($item_total, 2); ?></strong>
                                        <small>₹<?php echo number_format((float)$row['charger_per_day'], 2); ?>/day</small>
                                    </div>

                                </div>

                            <?php } ?>

                            <div class="payment-section">

                                <h3 class="section-heading">
                                    <i class="fa-solid fa-wallet"></i>
                                    Payment Method
                                </h3>

                                <label class="payment-option active">
                                    <input type="radio" name="payment" value="Cash on Delivery" checked>
                                    <span class="payment-icon"><i class="fa-solid fa-money-bill-wave"></i></span>
                                    <span class="payment-details">
                                        <strong>Cash on Delivery</strong>
                                        <small>Pay when your order arrives at your doorstep.</small>
                                    </span>
                                </label>

                                <label class="payment-option">
                                    <input type="radio" name="payment" value="UPI">
                                    <span class="payment-icon"><i class="fa-solid fa-qrcode"></i></span>
                                    <span class="payment-details">
                                        <strong>UPI Payment</strong>
                                        <small>Scan the QR code using your UPI payment app.</small>
                                    </span>
                                </label>

                                <div class="upi-panel" id="upi-panel">

                                    <div class="upi-content">

                                        <div class="qr-frame">
                                            <div class="qr-placeholder" id="qr-placeholder">
                                                <i class="fa-solid fa-qrcode" style="font-size:45px;"></i>
                                                <br>Put your QR image at<br>
                                                <strong>images/upi-qr.png</strong>
                                            </div>

                                            <img src="images/upi-qr.png"
                                                 alt="UPI Payment QR Code"
                                                 id="upi-qr-image"
                                                 style="display:none;"
                                                 onload="this.style.display='block';document.getElementById('qr-placeholder').style.display='none';"
                                                 onerror="this.style.display='none';document.getElementById('qr-placeholder').style.display='block';">
                                        </div>

                                        <div class="upi-info">
                                            <h4>Scan &amp; Pay using UPI</h4>

                                            <div class="upi-id-label">Your UPI ID</div>

                                            <div class="upi-id-row">
                                                <span class="upi-id" id="upi-id-text">YOUR_UPI_ID_HERE</span>
                                                <button type="button" class="copy-upi" onclick="copyUpiId()">
                                                    <i class="fa-regular fa-copy"></i>
                                                </button>
                                            </div>

                                            <div class="upi-apps">
                                                <div class="upi-app"><i class="fa-brands fa-google-pay"></i>Google Pay</div>
                                                <div class="upi-app"><i class="fa-solid fa-mobile-screen-button"></i>PhonePe</div>
                                                <div class="upi-app"><i class="fa-solid fa-wallet"></i>Paytm</div>
                                                <div class="upi-app"><i class="fa-solid fa-building-columns"></i>BHIM</div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="upi-note">
                                        <i class="fa-solid fa-circle-info"></i>
                                        Scan the QR code and pay the order amount. Keep your UPI transaction reference for manual verification.
                                    </div>

                                </div>

                                <label class="payment-option">
                                    <input type="radio" name="payment" value="Credit / Debit Card">
                                    <span class="payment-icon"><i class="fa-solid fa-credit-card"></i></span>
                                    <span class="payment-details">
                                        <strong>Credit / Debit Card</strong>
                                        <small>Card payment processing is not configured in this design.</small>
                                    </span>
                                </label>

                            </div>

                        <?php } else { ?>

                            <div class="empty-cart">
                                <div class="empty-cart-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                                <h3>Your cart is empty</h3>
                                <div class="empty-line"></div>
                                <a href="index.php" class="home-btn">
                                    <i class="fa-solid fa-house"></i> Back to Homepage
                                </a>
                            </div>

                        <?php } ?>

                    </div>
                </div>

                <?php if ($cart_count > 0) { ?>

                    <div class="col-lg-4">
                        <div class="summary-card">

                            <div class="summary-heading">
                                <i class="fa-solid fa-receipt"></i>
                                Order Summary
                            </div>

                            <div class="summary-body">

                                <div class="summary-row">
                                    <span>Items</span>
                                    <strong id="summary-items"><?php echo $cart_count; ?></strong>
                                </div>

                                <div class="summary-row">
                                    <span>Cart Total</span>
                                    <strong id="cart-total">₹<?php echo number_format($cart_total, 2); ?></strong>
                                </div>

                                <div class="summary-row">
                                    <span>Delivery</span>
                                    <strong class="free">Free</strong>
                                </div>

                                <div class="summary-row summary-total-row">
                                    <span>Total</span>
                                    <strong class="summary-total" id="grand-total">
                                        ₹<?php echo number_format($cart_total, 2); ?>
                                    </strong>
                                </div>

                                <button type="button" class="checkout-btn" onclick="goToOrder()">
                                    <i class="fa-solid fa-lock"></i>
                                    Place Order
                                </button>

                                <p class="secure-message">
                                    <i class="fa-solid fa-shield-halved"></i>
                                    Your order information is secure.
                                </p>

                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </section>

</main>

<script>
    // ORIGINAL PLACE ORDER LOGIC

    function goToOrder() {

        let cartTotal = 0;
        let totalItems = 0;

        document.querySelectorAll(".product-item").forEach(function (item) {

            const priceBox = item.querySelector(".product-price");
            const quantityInput = item.querySelector(".quantity-input");

            if (!priceBox || !quantityInput) {
                return;
            }

            const unitPrice = parseFloat(priceBox.dataset.unitPrice) || 0;
            const quantity = Math.max(1, parseInt(quantityInput.value) || 1);

            cartTotal += unitPrice * quantity;
            totalItems += quantity;
        });

        if (cartTotal <= 0) {
            alert("Your cart is empty.");
            return;
        }

        const paymentInput = document.querySelector('input[name="payment"]:checked');

        const paymentMethod = paymentInput
            ? paymentInput.value
            : "Cash on Delivery";

        const form = document.createElement("form");

        form.method = "POST";
        form.action = "order.php";

        const totalInput = document.createElement("input");
        totalInput.type = "hidden";
        totalInput.name = "checkout_total";
        totalInput.value = cartTotal.toFixed(2);
        form.appendChild(totalInput);

        const quantityInput = document.createElement("input");
        quantityInput.type = "hidden";
        quantityInput.name = "checkout_quantity";
        quantityInput.value = totalItems;
        form.appendChild(quantityInput);

        const paymentField = document.createElement("input");
        paymentField.type = "hidden";
        paymentField.name = "payment_method";
        paymentField.value = paymentMethod;
        form.appendChild(paymentField);

        document.body.appendChild(form);
        form.submit();
    }

    // ORIGINAL AUTOMATIC CART TOTAL LOGIC

    document.addEventListener("DOMContentLoaded", function () {

        function updateCartTotal() {

            let cartTotal = 0;
            let totalItems = 0;

            document.querySelectorAll(".product-item").forEach(function (item) {

                const priceBox = item.querySelector(".product-price");
                const quantityInput = item.querySelector(".quantity-input");
                const itemPrice = item.querySelector(".item-price");

                if (!priceBox || !quantityInput || !itemPrice) {
                    return;
                }

                let quantity = parseInt(quantityInput.value);

                if (isNaN(quantity) || quantity < 1) {
                    quantity = 1;
                    quantityInput.value = 1;
                }

                const unitPrice = parseFloat(priceBox.dataset.unitPrice) || 0;
                const totalPrice = unitPrice * quantity;

                itemPrice.textContent = "₹" + totalPrice.toLocaleString(
                    "en-IN",
                    {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }
                );

                cartTotal += totalPrice;
                totalItems += quantity;
            });

            const cartTotalElement = document.getElementById("cart-total");
            const grandTotalElement = document.getElementById("grand-total");
            const summaryItems = document.getElementById("summary-items");

            if (cartTotalElement) {
                cartTotalElement.textContent = "₹" + cartTotal.toLocaleString(
                    "en-IN",
                    { minimumFractionDigits: 2, maximumFractionDigits: 2 }
                );
            }

            if (grandTotalElement) {
                grandTotalElement.textContent = "₹" + cartTotal.toLocaleString(
                    "en-IN",
                    { minimumFractionDigits: 2, maximumFractionDigits: 2 }
                );
            }

            if (summaryItems) {
                summaryItems.textContent = totalItems;
            }
        }

        document.querySelectorAll(".product-item").forEach(function (item) {

            const minusButton = item.querySelector(".quantity-minus");
            const plusButton = item.querySelector(".quantity-plus");
            const quantityInput = item.querySelector(".quantity-input");

            if (!minusButton || !plusButton || !quantityInput) {
                return;
            }

            minusButton.addEventListener("click", function () {

                let quantity = parseInt(quantityInput.value) || 1;

                if (quantity > 1) {
                    quantityInput.value = quantity - 1;
                    updateCartTotal();
                }
            });

            plusButton.addEventListener("click", function () {

                let quantity = parseInt(quantityInput.value) || 1;
                quantityInput.value = quantity + 1;
                updateCartTotal();
            });

            quantityInput.addEventListener("input", updateCartTotal);

            quantityInput.addEventListener("change", function () {

                let quantity = parseInt(quantityInput.value);

                if (isNaN(quantity) || quantity < 1) {
                    quantity = 1;
                }

                quantityInput.value = quantity;
                updateCartTotal();
            });
        });

        updateCartTotal();
    });

    // PAYMENT SELECTION DESIGN

    function updatePaymentDesign() {
        const selected = document.querySelector('input[name="payment"]:checked');
        const upiPanel = document.getElementById("upi-panel");

        document.querySelectorAll(".payment-option").forEach(function (option) {
            const radio = option.querySelector('input[name="payment"]');
            option.classList.toggle("active", radio.checked);
        });

        if (selected && selected.value === "UPI") {
            upiPanel.classList.add("show");
        } else {
            upiPanel.classList.remove("show");
        }
    }

    document.querySelectorAll('input[name="payment"]').forEach(function (radio) {
        radio.addEventListener("change", updatePaymentDesign);
    });

    function copyUpiId() {
        const upiId = document.getElementById("upi-id-text").textContent.trim();

        if (upiId === "YOUR_UPI_ID_HERE") {
            alert("Please add your actual UPI ID first.");
            return;
        }

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(upiId)
                .then(function () {
                    alert("UPI ID copied successfully!");
                })
                .catch(function () {
                    prompt("Copy your UPI ID:", upiId);
                });
        } else {
            prompt("Copy your UPI ID:", upiId);
        }
    }
</script>

</body>
</html>
