<?php
session_start();
    include("header.php");
?>
<head>
    <link rel="shortcut icon" type="image/png" href="images/logo/favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/fonts.css">
    <link rel="stylesheet" href="css/font-awesome-6.css">
    <link rel="stylesheet" type="text/css" href="css/grt-youtube-popup.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <link rel="stylesheet" type="text/css" href="css/mean-plan.css">

    <style>

        /* =========================================
           RESET
        ========================================= */

        * {

            margin: 0;
            padding: 0;

            box-sizing: border-box;

        }


        body {

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #faf9f6;

            color: #292929;

        }


        /* =========================================
           MAIN CONTAINER
        ========================================= */

        .page-container {

            width: 95%;

            max-width: 1250px;

            margin: 25px auto;

            background: #ffffff;

            border: 1px solid #eeeeee;

            border-radius: 18px;

            padding: 28px;

            box-shadow:
                0 3px 15px rgba(0,0,0,0.05);

        }


        /* =========================================
           TOP SECTION
        ========================================= */

        .top-section {

            display: grid;

            grid-template-columns:
                1fr 1.65fr;

            gap: 35px;

            align-items: center;

        }


        /* =========================================
           LEFT CONTENT
        ========================================= */

        .left-content {

            padding: 10px;

        }


        /* BACK BUTTON */

        .back-btn {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            text-decoration: none;

            color: #333;

            font-size: 14px;

            font-weight: 600;

            padding: 9px 15px;

            border: 2px solid #f6dc72;

            border-radius: 10px;

            background: #fff;

            transition: 0.3s;

        }


        .back-btn:hover {

            background: #fff5ca;

            transform:
                translateX(-3px);

        }


        /* =========================================
           PLAN TITLE
        ========================================= */

        .left-content h1 {

            font-size: 48px;

            margin-top: 70px;

            margin-bottom: 15px;

            color: #351900;

            font-weight: 700;

        }


        /* =========================================
           MEAL BADGE
        ========================================= */

        .meal-badge {

            display: inline-block;

            background: #fff0b8;

            color: #4c3a00;

            padding: 8px 18px;

            border-radius: 20px;

            font-size: 14px;

            font-weight: 600;

            margin-bottom: 25px;

        }


        /* =========================================
           DESCRIPTION
        ========================================= */

        .description {

            font-size: 17px;

            line-height: 1.7;

            color: #555;

            max-width: 420px;

        }


        /* =========================================
           FOOD IMAGE
        ========================================= */

        .food-image {

            width: 100%;

            height: 395px;

            object-fit: cover;

            border-radius: 18px;

            display: block;

            box-shadow:
                0 5px 15px rgba(0,0,0,0.08);

        }


        /* =========================================
           INFO BOX
        ========================================= */

        .info-box {

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            margin-top: 28px;

            border: 1px solid #f1e5b9;

            border-radius: 15px;

            background: #fffdf5;

            overflow: hidden;

        }


        .info-item {

            display: flex;

            align-items: center;

            gap: 15px;

            padding: 24px;

            border-right:
                1px solid #eee3bc;

        }


        .info-item:last-child {

            border-right: none;

        }


        /* =========================================
           INFO ICON
        ========================================= */

        .info-icon {

            width: 45px;

            height: 45px;

            border-radius: 50%;

            background: #ffffff;

            border: 1px solid #eadfb7;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 22px;

            flex-shrink: 0;

        }


        .info-text span {

            display: block;

            color: #777;

            font-size: 13px;

            margin-bottom: 5px;

        }


        .info-text strong {

            display: block;

            font-size: 17px;

            color: #222;

        }


        .active {

            color: #189b3d !important;

        }


        .inactive {

            color: #d33 !important;

        }


        /* =========================================
           COMMON SECTION
        ========================================= */

        .details-box {

            margin-top: 22px;

            padding: 25px;

            border: 1px solid #eeeeee;

            border-radius: 16px;

            background: #ffffff;

        }


        /* =========================================
           SECTION TITLE
        ========================================= */

        .section-title {

            display: flex;

            align-items: center;

            gap: 12px;

            margin-bottom: 15px;

        }


        .title-icon {

            width: 42px;

            height: 42px;

            background: #fff1b8;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 20px;

            flex-shrink: 0;

        }


        .section-title h2 {

            font-size: 21px;

            color: #321b08;

        }


        /* =========================================
           DETAILS
        ========================================= */

        .details-main {

            margin-left: 54px;

            font-size: 15px;

            font-weight: 600;

            color: #333;

            margin-bottom: 12px;

        }


        .details-description {

            margin-left: 54px;

            color: #555;

            line-height: 1.6;

            font-size: 14px;

            max-width: 900px;

        }


        /* =========================================
           INCLUDED BOX
        ========================================= */

        .included-box {

            display: grid;

            grid-template-columns:
                1.25fr 0.9fr;

            margin-top: 22px;

            border: 1px solid #eeeeee;

            border-radius: 16px;

            background: #ffffff;

            overflow: hidden;

        }


        .included-left {

            padding: 25px;

            border-right: 1px solid #eeeeee;

        }


        .included-right {

            padding: 25px;

        }


        /* =========================================
           FOOD LIST
        ========================================= */

        .food-list {

            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 15px;

            margin-left: 54px;

            margin-top: 15px;

        }


        .food-item {

            display: flex;

            align-items: center;

            gap: 10px;

            font-size: 14px;

            font-weight: 600;

        }


        .check {

            width: 19px;

            height: 19px;

            border-radius: 50%;

            background: #16a34a;

            color: #ffffff;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 12px;

            font-weight: bold;

        }


        /* =========================================
           SERVICE ITEMS
        ========================================= */

        .service-item {

            display: flex;

            align-items: center;

            gap: 13px;

            margin-bottom: 22px;

        }


        .service-icon {

            width: 42px;

            height: 42px;

            background: #fff2bd;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 19px;

            flex-shrink: 0;

        }


        .service-text strong {

            display: block;

            font-size: 13px;

            margin-bottom: 4px;

        }


        .service-text span {

            display: block;

            color: #888;

            font-size: 12px;

        }


        /* =========================================
           CART SECTION
        ========================================= */

        .cart-section {

            margin-top: 22px;

            padding: 20px 25px;

            border: 1px solid #eeeeee;

            border-radius: 15px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            background: #ffffff;

        }


        .price-label {

            color: #777;

            font-size: 13px;

            margin-bottom: 5px;

        }


        .price {

            font-size: 28px;

            font-weight: 700;

            color: #222;

        }


        /* =========================================
           ADD TO CART
        ========================================= */

        .cart-btn {

            width: 305px;

            padding: 16px;

            border: none;

            border-radius: 10px;

            background: #ffc51c;

            color: #2b2100;

            font-size: 17px;

            font-weight: 700;

            cursor: pointer;

            transition: 0.3s;

        }


        .cart-btn:hover {

            background: #f5b900;

            transform: translateY(-3px);

            box-shadow:
                0 8px 20px
                rgba(245,185,0,0.25);

        }


        /* =========================================
           BOTTOM FEATURES
        ========================================= */

        .bottom-features {

            width: 95%;

            max-width: 1250px;

            margin: 35px auto;

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 20px;

            padding: 20px;

            background: #fffdf4;

            border-radius: 12px;

        }


        .bottom-item {

            display: flex;

            align-items: center;

            gap: 12px;

        }


        .bottom-icon {

            width: 42px;

            height: 42px;

            border-radius: 50%;

            background: #ffffff;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 20px;

            flex-shrink: 0;

        }


        .bottom-item strong {

            display: block;

            font-size: 13px;

            margin-bottom: 3px;

        }


        .bottom-item span {

            color: #888;

            font-size: 11px;

        }


        /* =========================================
           HOVER
        ========================================= */

        .info-item {

            transition: 0.3s;

        }


        .info-item:hover {

            background: #fff9df;

        }


        .service-item {

            transition: 0.3s;

        }


        .service-item:hover {

            transform: translateX(5px);

        }


        .bottom-item {

            transition: 0.3s;

        }


        .bottom-item:hover {

            transform: translateY(-3px);

        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 1000px) {

            .top-section {

                grid-template-columns: 1fr;

            }


            .left-content h1 {

                margin-top: 35px;

            }


            .food-image {

                height: 350px;

            }


            .info-box {

                grid-template-columns:
                    repeat(2, 1fr);

            }


            .info-item:nth-child(2) {

                border-right: none;

            }


            .included-box {

                grid-template-columns: 1fr;

            }


            .included-left {

                border-right: none;

                border-bottom:
                    1px solid #eeeeee;

            }


            .bottom-features {

                grid-template-columns:
                    repeat(2, 1fr);

            }

        }


        @media (max-width: 600px) {

            .page-container {

                width: 94%;

                padding: 15px;

                margin: 15px auto;

            }


            .left-content h1 {

                font-size: 36px;

                margin-top: 35px;

            }


            .food-image {

                height: 250px;

            }


            .info-box {

                grid-template-columns: 1fr;

            }


            .info-item {

                border-right: none !important;

                border-bottom:
                    1px solid #eee3bc;

            }


            .info-item:last-child {

                border-bottom: none;

            }


            .details-box,
            .included-left,
            .included-right {

                padding: 18px;

            }


            .details-main,
            .details-description,
            .food-list {

                margin-left: 0;

            }


            .food-list {

                grid-template-columns: 1fr;

            }


            .cart-section {

                flex-direction: column;

                align-items: stretch;

                gap: 20px;

            }


            .cart-btn {

                width: 100%;

            }


            .bottom-features {

                grid-template-columns: 1fr;

            }

        }
         .plan-error {
            width: 500px;
            margin: 100px auto;
            padding: 45px 30px;
            text-align: center;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 35px rgba(0,0,0,0.12);
        }

        .error-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff3df;
            border-radius: 50%;
            font-size: 40px;
        }

        .plan-error h2 {
            margin: 0 0 12px;
            color: #4b2205;
            font-size: 26px;
        }

        .plan-error p {
            color: #777;
            font-size: 15px;
            margin-bottom: 25px;
        }

        .back-btn {
            display: inline-block;
            padding: 12px 25px;
            background: #ed8617;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
        }

        .back-btn:hover {
            background: #d96f08;
            transform: translateY(-2px);
        }
.plan-error {
    animation: errorBox 0.7s ease forwards;
}

.error-icon {
    animation: iconPop 0.8s ease 0.2s both;
}

.plan-error h2 {
    animation: fadeUp 0.7s ease 0.3s both;
}

.plan-error p {
    animation: fadeUp 0.7s ease 0.4s both;
}

.back-btn {
    animation: fadeUp 0.7s ease 0.5s both;
    transition: all 0.3s ease;
}

.back-btn:hover {
    transform: translateY(-3px);
}

@keyframes errorBox {
    from {
        opacity: 0;
        transform: translateY(40px) scale(0.95);
    }

    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes iconPop {
    0% {
        opacity: 0;
        transform: scale(0);
    }

    70% {
        transform: scale(1.15);
    }

    100% {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(15px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
    </style>

</head>
<?php

include("../admin/connection.php");

if (isset($_GET['plan_id']) && !empty($_GET['plan_id'])) {
    $plan_id = intval($_GET['plan_id']);
} else {
    $plan_id = 17;
}

$sql = "SELECT * FROM plan_detail WHERE plan_id = $plan_id LIMIT 1";

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Database Query Error: " . mysqli_error($con));
}

if (mysqli_num_rows($result) == 0) {
    ?>

    <div class="plan-error">
        <div class="error-icon">📋</div>
        <h2>Plan Details Not Found</h2>
        <p>Sorry! We couldn't find the details for this plan.</p>
        <a href="index.php" class="back-btn">← Back to Plans</a>
    </div>

    <?php
    exit;
}

$plan = mysqli_fetch_assoc($result);

if (!$plan || !is_array($plan)) {
    die("Unable to load plan details.");
}
$plandetail_id=$plan['plandetail_id'];
$_SESSION['plandetail_id']=$plandetail_id;
$planDetails = $plan['plan_details'] ?? '';
$days        = $plan['days'] ?? 0;
$price       = $plan['charger_per_day'] ?? 0;
$_SESSION['rate']=$price;
$mealType    = $plan['meal_type'] ?? '';
$photo       = $plan['photo'] ?? '';
$status      = $plan['status'] ?? 0;

$planName = "Basic Plan";

$planMasterSql = "SELECT plan_name FROM plan_master WHERE plan_id = $plan_id AND status = 1 LIMIT 1";
$planMasterResult = mysqli_query($con, $planMasterSql);

if ($planMasterResult && mysqli_num_rows($planMasterResult) > 0) {
    $planMaster = mysqli_fetch_assoc($planMasterResult);
    $planName = $planMaster['plan_name'];
}

$statusText = ($status == 1) ? "Active" : "Inactive";

if (!empty($photo)) {
    $imagePath = "../admin/upload/" . $photo;
} else {
    $imagePath = "images/no-image.png";
}
$foodItems = !empty($planDetails) ? explode("+", $planDetails) : [];
?>


<body>
<div class="page-container">
    <div class="top-section">

        <!-- LEFT -->
        <div class="left-content">


            <a href="index.php"
               class="back-btn">

                ← &nbsp; Back to Plans

            </a>


            <h1>

                <?php echo $planName; ?>

            </h1>


            <span class="meal-badge">

                <?php echo htmlspecialchars($mealType); ?>

            </span>


            <p class="description">

                A healthy and delicious
                <?php echo strtolower($mealType); ?>
                plan with balanced meal
                and nutrition.

            </p>


        </div>


        <!-- RIGHT IMAGE -->

        <div class="right-image">


            <img
                src="<?php echo htmlspecialchars($imagePath); ?>"
                class="food-image"
                alt="<?php echo htmlspecialchars($planName); ?>">


        </div>


    </div>



    <!-- =================================================
         INFORMATION
    ================================================== -->

    <div class="info-box">


        <!-- DURATION -->

        <div class="info-item">

            <div class="info-icon">

                📅

            </div>

            <div class="info-text">

                <span>
                    Duration
                </span>

                <strong>
                    <?php echo $days; ?> Days
                </strong>

            </div>

        </div>



        <!-- PRICE -->

        <div class="info-item">

            <div class="info-icon">

                ₹

            </div>

            <div class="info-text">

                <span>
                    Price Per Day
                </span>

                <strong>
                    ₹ <?php echo $price; ?>
                </strong>

            </div>

        </div>



        <!-- MEAL TYPE -->

        <div class="info-item">

            <div class="info-icon">

                🍴

            </div>

            <div class="info-text">

                <span>
                    Meal Type
                </span>

                <strong>

                    <?php
                    echo htmlspecialchars($mealType);
                    ?>

                </strong>

            </div>

        </div>



        <!-- STATUS -->

        <div class="info-item">

            <div class="info-icon">

                ✓

            </div>

            <div class="info-text">

                <span>
                    Status
                </span>

                <strong class="<?php echo ($status == 1) ? 'active' : 'inactive'; ?>">

                    <?php echo $statusText; ?>

                </strong>

            </div>

        </div>


    </div>



    <!-- =================================================
         PLAN DETAILS
    ================================================== -->

    <div class="details-box">


        <div class="section-title">

            <div class="title-icon">

                📋

            </div>

            <h2>
                Plan Details
            </h2>

        </div>


        <div class="details-main">

            <?php
            echo htmlspecialchars($planDetails);
            ?>

        </div>


        <p class="details-description">

            This plan includes a wholesome combination of
            fresh and healthy food items prepared with
            quality ingredients to make your meal
            healthy and tasty.
        </p>
    </div>

    <!-- =================================================
         PRICE + CART
    ================================================== -->

    <div class="cart-section">


        <div>

            <div class="price-label">

                Price Per Day

            </div>


            <div class="price">

                ₹ <?php echo $price; ?>

            </div>

        </div>



        <form action="checksession.php" method="POST">


            <!-- PLAN ID -->

            <input
                type="hidden"
                name="plan_id"
                value="<?php echo $plan_id; ?>">


            <!-- PLAN DETAIL ID -->

            <input
                type="hidden"
                name="plandetail_id"
                value="<?php echo $plan['plandetail_id']; ?>">


            <!-- PRICE -->

            <input
                type="hidden"
                name="price"
                value="<?php echo $price; ?>">


            <button type="submit" class="cart-btn"  >

                🛒 &nbsp; Add to Cart

            </button>

        </form>


    </div>


</div>



<!-- =====================================================
     BOTTOM FEATURES
===================================================== -->

<div class="bottom-features">


    <div class="bottom-item">

        <div class="bottom-icon">
            🍃
        </div>

        <div>

            <strong>
                Healthy & Tasty
            </strong>

            <span>
                Nutritious meals everyday
            </span>

        </div>

    </div>



    <div class="bottom-item">

        <div class="bottom-icon">
            🚚
        </div>

        <div>

            <strong>
                Timely Delivery
            </strong>

            <span>
                Fast and reliable service
            </span>

        </div>

    </div>



    <div class="bottom-item">

        <div class="bottom-icon">
            🛡
        </div>

        <div>

            <strong>
                Hygienic Food
            </strong>

            <span>
                Prepared with care
            </span>

        </div>

    </div>



    <div class="bottom-item">

        <div class="bottom-icon">
            ☆
        </div>

        <div>

            <strong>
                Best Quality
            </strong>

            <span>
                Premium ingredients
            </span>

        </div>

    </div>


</div>


</body>

</html>
<?php
    include("footer.php");
?>