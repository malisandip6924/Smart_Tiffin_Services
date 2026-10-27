<?php
session_start();

include('../admin/connection.php');

if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$uid = (int)$_SESSION['uid'];

/* Fetch Logged In User Details */

$userQuery = mysqli_prepare(
    $con,
    "SELECT username, email
     FROM user_records
     WHERE uid = ?"
);

mysqli_stmt_bind_param($userQuery, "i", $uid);
mysqli_stmt_execute($userQuery);

$userResult = mysqli_stmt_get_result($userQuery);
$user = mysqli_fetch_assoc($userResult);

mysqli_stmt_close($userQuery);

if (!$user) {
    exit("User not found!");
}

/* Fetch Orders Of Logged In User */

$orderQuery = mysqli_prepare(
    $con,
    "SELECT *
     FROM order_master
     WHERE email = ?
     ORDER BY order_id DESC"
);

mysqli_stmt_bind_param(
    $orderQuery,
    "s",
    $user['email']
);

mysqli_stmt_execute($orderQuery);

$orderResult = mysqli_stmt_get_result($orderQuery);

$totalOrders = mysqli_num_rows($orderResult);


/* Safe Output */

function safe($value) {
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES,
        'UTF-8'
    );
}


/* Order Status */

function getOrderStatus($status) {

    switch ((int)$status) {

        case 1:
            return [
                'Pending',
                'pending'
            ];

        case 2:
            return [
                'Confirmed',
                'confirmed'
            ];

        case 3:
            return [
                'Completed',
                'completed'
            ];

        case 4:
            return [
                'Cancelled',
                'cancelled'
            ];

        default:
            return [
                'Unknown',
                'pending'
            ];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>My Orders - Smart Tiffin Services</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;

            min-height: 100vh;

            background:
                radial-gradient(
                    circle at 10% 20%,
                    rgba(255,162,26,.12),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 90% 80%,
                    rgba(255,193,7,.12),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #fffaf3,
                    #fff3df
                );

            color: #321b08;
            padding: 40px 20px;
        }

        .orders-container {
            max-width: 1150px;
            margin: auto;

            background: #ffffff;

            border-radius: 25px;

            padding: 35px;

            border: 1px solid rgba(245,130,32,.15);

            box-shadow:
                0 25px 70px rgba(50,27,8,.10),
                0 10px 25px rgba(245,130,32,.05);

            position: relative;
            overflow: hidden;
        }

        .orders-container::before {
            content: "";

            position: absolute;
            top: 0;
            left: 0;

            width: 100%;
            height: 5px;

            background: linear-gradient(
                90deg,
                #f58220,
                #ffa21a,
                #ffc107
            );
        }

        /* Header */

        .orders-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            margin-bottom: 30px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-icon {
            width: 60px;
            height: 60px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: linear-gradient(
                135deg,
                #f58220,
                #ffa21a
            );

            color: white;

            border-radius: 16px;

            font-size: 24px;

            box-shadow: 0 10px 25px rgba(245,130,32,.22);
        }

        .orders-header h1 {
            font-size: 27px;
            font-weight: 800;
            color: #321b08;
        }

        .orders-header p {
            font-size: 13px;
            color: #999;
            margin-top: 5px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 9px;

            padding: 12px 20px;

            border-radius: 11px;

            background: #fff;
            color: #f58220;

            border: 1px solid #f2d6bd;

            text-decoration: none;

            font-size: 13px;
            font-weight: 600;

            transition: .3s;
        }

        .back-btn:hover {
            background: #f58220;
            color: white;

            transform: translateY(-2px);
        }

        /* Summary */

        .orders-summary {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 20px 24px;

            margin-bottom: 25px;

            background: linear-gradient(
                135deg,
                #fff8ee,
                #fff2df
            );

            border: 1px solid #f2dfcb;

            border-radius: 16px;
        }

        .summary-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .summary-icon {
            width: 45px;
            height: 45px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background: rgba(245,130,32,.13);

            color: #f58220;

            font-size: 18px;
        }

        .summary-label {
            font-size: 12px;
            color: #999;
        }

        .summary-value {
            font-size: 23px;
            font-weight: 800;
            color: #321b08;
        }

        /* Table */

        .table-wrapper {
            width: 100%;
            overflow-x: auto;

            border: 1px solid #f0e2d4;
            border-radius: 15px;
        }

        .orders-table {
            width: 100%;

            border-collapse: collapse;

            min-width: 750px;
        }

        .orders-table thead {
            background: #321b08;
            color: white;
        }

        .orders-table th {
            padding: 17px 16px;

            text-align: left;

            font-size: 12px;
            font-weight: 600;

            white-space: nowrap;
        }

        .orders-table td {
            padding: 18px 16px;

            border-bottom: 1px solid #f3e8dc;

            font-size: 13px;
            color: #5a4635;

            white-space: nowrap;
        }

        .orders-table tbody tr {
            transition: .25s;
        }

        .orders-table tbody tr:hover {
            background: #fff9f1;
        }

        .orders-table tbody tr:last-child td {
            border-bottom: none;
        }

        .order-id {
            color: #f58220;
            font-weight: 700;
        }

        .plan-name {
            color: #321b08;
            font-weight: 600;
        }

        .price {
            color: #321b08;
            font-weight: 700;
        }

        /* Status */

        .status-badge {
            display: inline-flex;
            align-items: center;

            gap: 7px;

            padding: 7px 12px;

            border-radius: 30px;

            font-size: 11px;
            font-weight: 600;
        }

        .status-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;
            background: currentColor;
        }

        .pending {
            color: #c78300;
            background: #fff4d6;
        }

        .confirmed {
            color: #0879d1;
            background: #e5f3ff;
        }

        .completed {
            color: #008f6b;
            background: #e2f7ee;
        }

        .cancelled {
            color: #d83232;
            background: #ffebeb;
        }

        /* Empty Orders */

        .empty-orders {
            text-align: center;
            padding: 65px 20px;
        }

        .empty-icon {
            width: 100px;
            height: 100px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 22px;

            border-radius: 50%;

            background: linear-gradient(
                135deg,
                #fff2df,
                #fff8ee
            );

            color: #f58220;

            font-size: 40px;
        }

        .empty-orders h2 {
            font-size: 23px;
            font-weight: 800;

            color: #321b08;

            margin-bottom: 10px;
        }

        .empty-orders p {
            font-size: 14px;
            color: #999;

            margin-bottom: 25px;
        }

        .order-now-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 9px;

            padding: 13px 25px;

            background: linear-gradient(
                135deg,
                #f58220,
                #ffa21a
            );

            color: white;

            border-radius: 11px;

            text-decoration: none;

            font-size: 13px;
            font-weight: 600;

            transition: .3s;
        }

        .order-now-btn:hover {
            color: white;
            transform: translateY(-3px);

            box-shadow: 0 12px 25px rgba(245,130,32,.25);
        }

        /* Footer */

        .orders-footer {
            display: flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            margin-top: 25px;

            color: #aaa;

            font-size: 12px;
        }

        .orders-footer i {
            color: #f58220;
        }

        /* Responsive */

        @media (max-width: 650px) {

            body {
                padding: 20px 12px;
            }

            .orders-container {
                padding: 25px 15px;
                border-radius: 20px;
            }

            .orders-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .orders-header h1 {
                font-size: 22px;
            }

            .header-icon {
                width: 48px;
                height: 48px;

                font-size: 20px;
            }

            .orders-summary {
                padding: 16px;
            }

            .summary-value {
                font-size: 20px;
            }

            .empty-orders {
                padding: 45px 10px;
            }

            .empty-orders h2 {
                font-size: 20px;
            }

        }

    </style>

</head>

<body>

<div class="orders-container">

    <!-- Header -->

    <div class="orders-header">

        <div class="header-left">

            <div class="header-icon">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>

            <div>

                <h1>My Orders</h1>

                <p>
                    Welcome,
                    <?php echo safe($user['username']); ?>!
                    View your order history below.
                </p>

            </div>

        </div>

        <a href="profile.php" class="back-btn">

            <i class="fa-solid fa-arrow-left"></i>

            Back to Profile

        </a>

    </div>


    <!-- Order Count -->

    <div class="orders-summary">

        <div class="summary-left">

            <div class="summary-icon">

                <i class="fa-solid fa-box"></i>

            </div>

            <div>

                <div class="summary-label">
                    Total Orders
                </div>

                <div class="summary-value">
                    <?php echo $totalOrders; ?>
                </div>

            </div>

        </div>

        <i class="fa-solid fa-receipt"
           style="font-size:28px;color:#f58220;"></i>

    </div>


    <!-- Orders Table -->

    <?php if ($totalOrders > 0) { ?>

        <div class="table-wrapper">

            <table class="orders-table">

                <thead>

                    <tr>

                        <th>Order ID</th>

                        <th>Plan Name</th>

                        <th>Price</th>

                        <th>Start Date</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while ($order = mysqli_fetch_assoc($orderResult)) { ?>

                        <?php
                        $statusInfo = getOrderStatus(
                            $order['status']
                        );
                        ?>

                        <tr>

                            <td class="order-id">

                                #<?php echo safe($order['order_id']); ?>

                            </td>

                            <td class="plan-name">

                                <?php echo safe($order['plan_name']); ?>

                            </td>

                            <td class="price">

                                ₹<?php echo number_format(
                                    (float)$order['price'],
                                    2
                                ); ?>

                            </td>

                            <td>

                                <?php
                                echo safe(
                                    date(
                                        'd M Y',
                                        strtotime($order['startdate'])
                                    )
                                );
                                ?>

                            </td>

                            <td>

                                <span class="status-badge <?php echo safe($statusInfo[1]); ?>">

                                    <span class="status-dot"></span>

                                    <?php echo safe($statusInfo[0]); ?>

                                </span>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    <?php } else { ?>

        <!-- No Orders -->

        <div class="empty-orders">

            <div class="empty-icon">

                <i class="fa-solid fa-bowl-food"></i>

            </div>

            <h2>No Orders Yet!</h2>

            <p>
                You haven't placed any orders yet.
                Start enjoying fresh and healthy meals today.
            </p>

            <a href="index.php" class="order-now-btn">

                <i class="fa-solid fa-utensils"></i>

                Explore Tiffin Plans

            </a>

        </div>

    <?php } ?>


    <!-- Footer -->

    <div class="orders-footer">

        <i class="fa-solid fa-leaf"></i>

        Fresh Food • Healthy Life

    </div>

</div>

</body>

</html>