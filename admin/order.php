<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('log_errors', '1');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ==========================================
// SESSION
// ==========================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ==========================================
// DATABASE CONNECTION
// ==========================================

require_once __DIR__ . '/connection.php';

// ==========================================
// PHPMailer
// ==========================================

require_once __DIR__ . '/../PHPMailer-master/src/Exception.php';
require_once __DIR__ . '/../PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer-master/src/SMTP.php';

$message = '';
$message_type = '';

// ==========================================
// UPDATE ORDER STATUS
// ==========================================

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['update_status'])
) {

    $order_id = (int) ($_POST['order_id'] ?? 0);
    $status = (int) ($_POST['status'] ?? 0);

    if (
        $order_id <= 0
        || !in_array($status, [1, 2, 3, 4], true)
    ) {

        $message = 'Invalid order details.';
        $message_type = 'error';

    } else {

        // Fetch existing order details

        $check = mysqli_prepare(
            $con,
            'SELECT status, email, customer_name, plan_name, price
             FROM order_master
             WHERE order_id = ?'
        );

        if (!$check) {

            $message = 'Unable to read order details: ' . mysqli_error($con);
            $message_type = 'error';

        } else {

            mysqli_stmt_bind_param($check, 'i', $order_id);

            if (!mysqli_stmt_execute($check)) {

                $message = 'Unable to read order details: '
                    . mysqli_stmt_error($check);

                $message_type = 'error';

                mysqli_stmt_close($check);

            } else {

                mysqli_stmt_bind_result(
                    $check,
                    $old_status,
                    $customer_email,
                    $customer_name,
                    $plan_name,
                    $price
                );

                $order_found = mysqli_stmt_fetch($check);

                mysqli_stmt_close($check);

                if (!$order_found) {

                    $message = 'Order not found.';
                    $message_type = 'error';

                } else {

                    $old_status = (int) $old_status;

                    // Update only status; do not overwrite order price.

                    $update = mysqli_prepare(
                        $con,
                        'UPDATE order_master
                         SET status = ?
                         WHERE order_id = ?'
                    );

                    if (!$update) {

                        $message = 'Unable to prepare order update: '
                            . mysqli_error($con);

                        $message_type = 'error';

                    } else {

                        mysqli_stmt_bind_param(
                            $update,
                            'ii',
                            $status,
                            $order_id
                        );

                        if (!mysqli_stmt_execute($update)) {

                            $message = 'Failed to update order status: '
                                . mysqli_stmt_error($update);

                            $message_type = 'error';

                        } else {

                            $message = 'Order status updated successfully!';
                            $message_type = 'success';

                            // ==========================================
                            // SEND EMAIL ONLY WHEN STATUS CHANGES TO CONFIRMED
                            // ==========================================

                            if ($status === 2 && $old_status !== 2) {

                                if (
                                    !filter_var(
                                        $customer_email,
                                        FILTER_VALIDATE_EMAIL
                                    )
                                ) {

                                    $message =
                                        'Status changed to Confirmed, but the customer email is missing or invalid.';

                                    $message_type = 'error';

                                } else {

                                    $mail = new PHPMailer(true);

                                    try {

                                        $mail->isSMTP();

                                        $mail->Host = 'smtp.gmail.com';
                                        $mail->SMTPAuth = true;

                                        $mail->Username =
                                            'smarttiffinservices@gmail.com';

                                        /*
                                         * Replace this placeholder with
                                         * your real Gmail App Password.
                                         */

                                        $mail->Password =
                                            'amgu rqrc hkim cldu';

                                        $mail->SMTPSecure =
                                            PHPMailer::ENCRYPTION_STARTTLS;

                                        $mail->Port = 587;
                                        $mail->Timeout = 15;
                                        $mail->CharSet = 'UTF-8';

                                        $mail->setFrom(
                                            'smarttiffinservices@gmail.com',
                                            'Smart Tiffin Services'
                                        );

                                        $mail->addAddress(
                                            $customer_email,
                                            $customer_name
                                        );

                                        $mail->isHTML(true);

                                        $mail->Subject =
                                            'Your Tiffin Order is Confirmed!';

                                        $safe_name = htmlspecialchars(
                                            (string) $customer_name,
                                            ENT_QUOTES,
                                            'UTF-8'
                                        );

                                        $safe_plan = htmlspecialchars(
                                            (string) $plan_name,
                                            ENT_QUOTES,
                                            'UTF-8'
                                        );

                                        $safe_price = number_format(
                                            (float) $price,
                                            2,
                                            '.',
                                            ','
                                        );

                                        $safe_order_id = (int) $order_id;

                                        $mail->Body = "
                                        <div style='font-family:Arial,sans-serif;background:#fff8ed;padding:25px;'>
                                            <div style='max-width:560px;margin:auto;background:#fff;border-radius:14px;padding:28px;border:1px solid #f3d6a4;'>

                                                <h2 style='color:#e8790c;text-align:center;'>
                                                    Smart Tiffin Services
                                                </h2>

                                                <h3 style='color:#198754;'>
                                                    Your Order is Confirmed!
                                                </h3>

                                                <p>
                                                    Hello <strong>{$safe_name}</strong>,
                                                </p>

                                                <p>
                                                    Great news! Your tiffin order has been confirmed by our admin.
                                                </p>

                                                <div style='background:#fff8ed;padding:18px;border-radius:10px;line-height:1.9;'>

                                                    <strong>Order ID:</strong>
                                                    #{$safe_order_id}<br>

                                                    <strong>Plan Name:</strong>
                                                    {$safe_plan}<br>

                                                    <strong>Price:</strong>
                                                    ₹{$safe_price}<br>

                                                    <strong>Status:</strong>

                                                    <span style='color:#198754;font-weight:bold;'>
                                                        Confirmed
                                                    </span>

                                                </div>

                                                <p>
                                                    Thank you for choosing Smart Tiffin Services!
                                                </p>

                                                <p style='color:#777;font-size:12px;'>
                                                    This is an automatic confirmation email.
                                                </p>

                                            </div>
                                        </div>";

                                        $mail->AltBody =
                                            "Hello {$customer_name}, your order #{$safe_order_id} "
                                            . "for {$plan_name} has been confirmed. "
                                            . "Price: Rs. {$safe_price}.";

                                        $mail->send();

                                        $message =
                                            'Order confirmed! Confirmation email sent to '
                                            . $customer_email . '.';

                                        $message_type = 'success';

                                    } catch (Exception $e) {

                                        error_log(
                                            'PHPMailer error for order #'
                                            . $order_id
                                            . ': '
                                            . $mail->ErrorInfo
                                            . ' | '
                                            . $e->getMessage()
                                        );

                                        $mail_error = trim($mail->ErrorInfo);

                                        if ($mail_error === '') {
                                            $mail_error = $e->getMessage();
                                        }

                                        $message =
                                            'Status changed to Confirmed, but email failed: '
                                            . $mail_error;

                                        $message_type = 'error';
                                    }
                                }
                            }
                        }

                        mysqli_stmt_close($update);
                    }
                }
            }
        }
    }

    // Save message and redirect

    $_SESSION['order_message'] = $message;
    $_SESSION['order_message_type'] = $message_type;

    header('Location: order.php');
    exit();
}

// ==========================================
// DISPLAY STATUS MESSAGE
// ==========================================

if (isset($_SESSION['order_message'])) {

    $message = (string) $_SESSION['order_message'];

    $message_type = (string) (
        $_SESSION['order_message_type'] ?? 'success'
    );

    unset(
        $_SESSION['order_message'],
        $_SESSION['order_message_type']
    );
}

// ==========================================
// FETCH ALL ORDERS
// ==========================================

$result = mysqli_query(
    $con,
    'SELECT *
     FROM order_master
     ORDER BY order_id DESC'
);

?>

<?php include('header.php'); ?>

<head>

    <link rel="stylesheet" type="text/css" href="assets/css/order.css">

</head>

<style>
    .status-form {
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 210px;
    }

    .status-select {
        padding: 9px 10px;
        border: 1px solid #e2e2e2;
        border-radius: 8px;
        background: #fff;
        font-size: 13px;
        outline: none;
        cursor: pointer;
    }

    .status-update-btn {
        padding: 9px 12px;
        border: none;
        border-radius: 8px;
        background: #f59e0b;
        color: #fff;
        font-weight: 600;
        font-size: 12px;
        cursor: pointer;
        transition: 0.3s;
    }

    .status-update-btn:hover {
        background: #d97706;
        transform: translateY(-1px);
    }

    .update-message {
        margin: 15px 0;
        padding: 12px 16px;
        border-radius: 8px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .update-message.success {
        background: #dcfce7;
        color: #166534;
    }

    .update-message.error {
        background: #fee2e2;
        color: #991b1b;
    }

    .orders-table-wrapper {
        overflow-x: auto;
    }

    .order-price {
        white-space: nowrap;
        font-weight: 600;
    }
</style>

<div class="orders-box">

    <div class="orders-heading">

        <div class="orders-icon">
            <i class="fa-solid fa-receipt"></i>
        </div>

        <div>

            <h2>Customer Orders</h2>

            <p>Manage all customer orders</p>

        </div>

    </div>

    <div class="orders-line"></div>

    <?php if ($message !== '') { ?>

        <div class="update-message <?php
        echo htmlspecialchars(
            $message_type,
            ENT_QUOTES,
            'UTF-8'
        );
        ?>">

            <?php
            echo htmlspecialchars(
                $message,
                ENT_QUOTES,
                'UTF-8'
            );
            ?>

        </div>

    <?php } ?>

    <div class="orders-table-wrapper">

        <table class="orders-table">

            <thead>

                <tr>

                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Plan Name</th>
                    <th>Price</th>
                    <th>Start Date</th>
                    <th>Status</th>
                    <th>Update Status</th>

                </tr>

            </thead>

            <tbody>

                <?php if ($result && mysqli_num_rows($result) > 0) { ?>

                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                        <?php
                        $current_status = (int) $row['status'];

                        // Read the saved price directly from database.
                        $order_price = isset($row['price'])
                            ? (float) $row['price']
                            : 0;
                        ?>

                        <tr>

                            <td>
                                #
                                <?php echo (int) $row['order_id']; ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $row['customer_name'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                );
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $row['email'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                );
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $row['mobile_no'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                );
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $row['plan_name'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                );
                                ?>
                            </td>

                            <!-- PRICE FROM DATABASE -->

                            <td class="order-price">
                                ₹
                                <?php
                                echo number_format(
                                    $order_price,
                                    2,
                                    '.',
                                    ','
                                );
                                ?>
                            </td>

                            <td>
                                <?php
                                echo !empty($row['startdate'])
                                    ? date(
                                        'd M Y',
                                        strtotime($row['startdate'])
                                    )
                                    : 'N/A';
                                ?>
                            </td>

                            <td>

                                <?php
                                if ($current_status === 1) {

                                    echo '<span class="status pending">Pending</span>';

                                } elseif ($current_status === 2) {

                                    echo '<span class="status confirmed">Confirmed</span>';

                                } elseif ($current_status === 3) {

                                    echo '<span class="status preparing">Preparing</span>';

                                } elseif ($current_status === 4) {

                                    echo '<span class="status cancelled">Cancelled</span>';

                                } else {

                                    echo '<span class="status cancelled">Unknown</span>';

                                }
                                ?>

                            </td>

                            <td>

                                <form method="POST" action="order.php" class="status-form">

                                    <input type="hidden" name="order_id" value="<?php
                                    echo (int) $row['order_id'];
                                    ?>">

                                    <select name="status" class="status-select" required>

                                        <option value="1" <?php
                                        echo $current_status === 1
                                            ? 'selected'
                                            : '';
                                        ?>> Pending
                                        </option>

                                        <option value="2" <?php
                                        echo $current_status === 2
                                            ? 'selected'
                                            : '';
                                        ?>> Confirmed
                                        </option>

                                        <option value="3" <?php
                                        echo $current_status === 3
                                            ? 'selected'
                                            : '';
                                        ?>> Preparing
                                        </option>

                                        <option value="4" <?php
                                        echo $current_status === 4
                                            ? 'selected'
                                            : '';
                                        ?>> Cancelled
                                        </option>

                                    </select>

                                    <button type="submit" name="update_status" class="status-update-btn">
                                        Update
                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php } ?>

                <?php } else { ?>

                    <tr>

                        <td colspan="9" class="no-orders">

                            <div class="empty-icon">
                                <i class="fa-solid fa-box-open"></i>
                            </div>

                            <div class="empty-title">
                                No Orders Found
                            </div>

                            <div class="empty-text">
                                Customer orders will appear here
                            </div>

                        </td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</div>

<?php include('footer.php'); ?>