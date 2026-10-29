<?php
session_start();

include("../admin/connection.php");

$success = "";
$error = "";

// Receive updated price from checkout
if (isset($_POST['checkout_total'])) {

    $checkout_total = filter_var(
        $_POST['checkout_total'],
        FILTER_VALIDATE_FLOAT
    );

    if ($checkout_total !== false && $checkout_total > 0) {
        $_SESSION['order_price'] = $checkout_total;
    }
}

// Plan name and price
$plan_name = $_SESSION['order_plan_name'] ?? "Selected Plan";
$price = $_SESSION['order_price'] ?? 0;

// Place order
if (isset($_POST['place_order'])) {

    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');

    $name = $first_name . " " . $last_name;

    $email = trim($_POST['email'] ?? '');
    $mobile = trim($_POST['phone'] ?? '');

    $city = trim($_POST['city'] ?? '');
    $pincode = trim($_POST['pincode'] ?? '');
    $street = trim($_POST['street'] ?? '');
    $house_no = trim($_POST['house_number'] ?? '');
    $message = trim($_POST['message'] ?? '');

    $date = date("Y-m-d");
    $status = 1;

    // Read latest price from session
    $plan_name = $_SESSION['order_plan_name'] ?? "Selected Plan";
    $price = $_SESSION['order_price'] ?? 0;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email address.";

    } elseif ($price <= 0) {

        $error = "Invalid order price. Please select your plan again.";

    } else {

        $query = "INSERT INTO order_master
            (customer_name, email, mobile_no, plan_name, price, startdate, status)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($con, $query);

        if ($stmt) {

            mysqli_stmt_bind_param(
                $stmt,
                "ssssdsi",
                $name,
                $email,
                $mobile,
                $plan_name,
                $price,
                $date,
                $status
            );

            if (mysqli_stmt_execute($stmt)) {

                $success = "yes";

                unset($_SESSION['order_plan_name']);
                unset($_SESSION['order_price']);

            } else {

                $error = "Order could not be saved: " . mysqli_stmt_error($stmt);

            }

            mysqli_stmt_close($stmt);

        } else {

            $error = "Database query failed: " . mysqli_error($con);

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Customer Information</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #fffaf2, #f6eee2);
            padding: 50px 20px;
        }

        .customer-wrapper {
            width: 80%;
            max-width: 800px;
            margin: auto;
        }

        .info-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
        }

        .heading-area {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .heading-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            background: linear-gradient(135deg, #8f5a18, #d99d35);
        }

        .heading-text h2 {
            margin: 0;
            color: #432a19;
        }

        .heading-text p {
            margin: 5px 0 0;
            color: #958477;
        }

        .form-control {
            height: 54px;
            border-radius: 12px;
        }

        textarea.form-control {
            height: 100px;
        }

        .continue-btn {
            width: 100%;
            height: 55px;
            margin-top: 25px;
            border: none;
            border-radius: 13px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            background: linear-gradient(135deg, #8f5a18, #d99d35);
            cursor: pointer;
        }

        .continue-btn:hover {
            transform: translateY(-2px);
        }

        .popup-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            z-index: 999;
        }

        .success-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            max-width: 90%;
            background: white;
            padding: 40px;
            border-radius: 22px;
            text-align: center;
            z-index: 1000;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.3);
            animation: popup 0.4s ease;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            margin: auto;
            margin-bottom: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e5f8ec;
            color: #20a552;
            font-size: 40px;
        }

        .success-popup h2 {
            color: #342217;
        }

        .success-popup p {
            color: #777;
        }

        .success-btn {
            display: inline-block;
            padding: 12px 25px;
            border-radius: 12px;
            color: white;
            background: linear-gradient(135deg, #8f5a18, #d99d35);
            text-decoration: none;
        }

        @keyframes popup {
            from {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.7);
            }

            to {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
        }

        @media(max-width:767px) {

            body {
                padding: 25px 12px;
            }

            .customer-wrapper {
                width: 100%;
            }

            .info-card {
                padding: 25px 18px;
            }
        }
    </style>

</head>

<body>

    <div class="customer-wrapper">

        <div class="info-card">

            <div class="heading-area">

                <div class="heading-icon">
                    <i class="fa-regular fa-user"></i>
                </div>

                <div class="heading-text">
                    <h2>Your Information</h2>
                    <p>Enter your details for smooth and secure delivery</p>
                </div>

            </div>

            <form method="POST">

                <div class="row g-3">

                    <div class="col-md-6">
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                    </div>

                    <div class="col-md-6">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" maxlength="10" required>
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="city" class="form-control" placeholder="City" required>
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="pincode" class="form-control" placeholder="Pincode" maxlength="6" required>
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="street" class="form-control" placeholder="Street">
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="house_number" class="form-control" placeholder="House Number">
                    </div>

                    <div class="col-12">
                        <textarea name="message" class="form-control" placeholder="Delivery Instructions / Message"></textarea>
                    </div>

                </div>

                <button type="submit" name="place_order" class="continue-btn">
                    Order Confirm
                    <i class="fa-solid fa-check"></i>
                </button>

            </form>

        </div>

    </div>

    <?php if ($success == "yes") { ?>

        <div class="popup-overlay"></div>

        <div class="success-popup">

            <div class="success-icon">
                <i class="fa-solid fa-check"></i>
            </div>

            <h2>Order Placed Successfully!</h2>

            <p>
                Your order has been confirmed successfully.
            </p>

            <a href="index.php" class="success-btn">
                Back to Home
                <i class="fa-solid fa-arrow-right"></i>
            </a>

        </div>

    <?php } ?>

</body>
</html>