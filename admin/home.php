<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

include("connection.php");

function dashboardCount($con, $sql, $field = 'total') {
    $result = mysqli_query($con, $sql);

    if (!$result) {
        return 0;
    }

    $row = mysqli_fetch_assoc($result);
    return isset($row[$field]) ? $row[$field] : 0;
}

$total_orders = (int) dashboardCount(
    $con,
    "SELECT COUNT(*) AS total FROM order_master"
);

$total_users = (int) dashboardCount(
    $con,
    "SELECT COUNT(*) AS total FROM user_records WHERE status = 1"
);

$total_revenue = (float) dashboardCount(
    $con,
    "SELECT COALESCE(SUM(price),0) AS total FROM order_master"
);

$active_plans = (int) dashboardCount(
    $con,
    "SELECT COUNT(*) AS total FROM plan_master WHERE status = 1"
);

$today_orders = (int) dashboardCount(
    $con,
    "SELECT COUNT(*) AS total FROM order_master WHERE startdate = CURDATE()"
);

$today_revenue = (float) dashboardCount(
    $con,
    "SELECT COALESCE(SUM(price),0) AS total FROM order_master WHERE startdate = CURDATE()"
);

$chart_labels = [];
$chart_values = [];
$chart_max = 0;

for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $chart_labels[] = date('D', strtotime($date));

    $safeDate = mysqli_real_escape_string($con, $date);

    $count = (int) dashboardCount(
        $con,
        "SELECT COUNT(*) AS total FROM order_master WHERE startdate = '$safeDate'"
    );

    $chart_values[] = $count;

    if ($count > $chart_max) {
        $chart_max = $count;
    }
}

$chart_max = max(5, (int) (ceil($chart_max / 5) * 5));

$recent_orders = mysqli_query(
    $con,
    "SELECT order_id, customer_name, plan_name, price, startdate, status
     FROM order_master
     ORDER BY order_id DESC
     LIMIT 6"
);

function getOrderStatus($status) {
    switch ((int) $status) {
        case 1:
            return ['name' => 'Delivered', 'class' => 'delivered'];

        case 2:
            return ['name' => 'Preparing', 'class' => 'preparing'];

        case 3:
            return ['name' => 'Out for Delivery', 'class' => 'delivery'];

        default:
            return ['name' => 'Pending', 'class' => 'pending'];
    }
}

$chartPoints = [];
$countDays = count($chart_values);

foreach ($chart_values as $i => $value) {
    $x = 12 + ($i * (676 / 6));
    $y = 190 - (($value / $chart_max) * 155);

    $chartPoints[] = ['x' => $x, 'y' => $y];
}

$linePoints = [];

foreach ($chartPoints as $point) {
    $linePoints[] = round($point['x'], 2) . ',' . round($point['y'], 2);
}

$lineString = implode(' ', $linePoints);

$firstPoint = $chartPoints[0];
$lastPoint = $chartPoints[count($chartPoints) - 1];

$fillString = $lineString . ' ' .
    round($lastPoint['x'], 2) . ',210 ' .
    round($firstPoint['x'], 2) . ',210';

include("header.php");
?>

<link rel="stylesheet" href="assets/dash.css">
<div class="dashboard-content stdash">
    <section class="stdash-welcome">
        <div>
            <span class="stdash-eyebrow">
                <span class="stdash-live-dot"></span>
                ADMIN OVERVIEW
            </span>

            <h1>Welcome back, Admin!</h1>
            <p>Here’s what’s happening with your tiffin service today.</p>
        </div>

        <div class="stdash-date">
            <i class="fa-regular fa-calendar"></i>
            <div>
                <strong><?php echo date('l'); ?></strong>
                <span><?php echo date('d M Y'); ?></span>
            </div>
        </div>
    </section>

    <section class="stdash-stats">

        <article class="stdash-stat stdash-orange">
            <div class="stdash-stat-icon">
                <i class="fa-solid fa-basket-shopping"></i>
            </div>

            <div class="stdash-stat-content">
                <span>Total Orders</span>
                <strong><?php echo number_format($total_orders); ?></strong>
                <small><i class="fa-solid fa-chart-line"></i> All orders recorded</small>
            </div>

            <div class="stdash-stat-watermark">
                <i class="fa-solid fa-basket-shopping"></i>
            </div>
        </article>

        <article class="stdash-stat stdash-green">
            <div class="stdash-stat-icon">
                <i class="fa-solid fa-users"></i>
            </div>

            <div class="stdash-stat-content">
                <span>Total Users</span>
                <strong><?php echo number_format($total_users); ?></strong>
                <small><i class="fa-solid fa-circle-check"></i> Active registered users</small>
            </div>

            <div class="stdash-stat-watermark">
                <i class="fa-solid fa-users"></i>
            </div>
        </article>

        <article class="stdash-stat stdash-purple">
            <div class="stdash-stat-icon">
                <i class="fa-solid fa-indian-rupee-sign"></i>
            </div>

            <div class="stdash-stat-content">
                <span>Total Revenue</span>
                <strong>₹<?php echo number_format($total_revenue, 0); ?></strong>
                <small><i class="fa-solid fa-wallet"></i> Total order value</small>
            </div>

            <div class="stdash-stat-watermark">
                <i class="fa-solid fa-indian-rupee-sign"></i>
            </div>
        </article>

        <article class="stdash-stat stdash-blue">
            <div class="stdash-stat-icon">
                <i class="fa-solid fa-box-open"></i>
            </div>

            <div class="stdash-stat-content">
                <span>Active Plans</span>
                <strong><?php echo number_format($active_plans); ?></strong>
                <small><i class="fa-solid fa-circle-check"></i> Currently available plans</small>
            </div>

            <div class="stdash-stat-watermark">
                <i class="fa-solid fa-box-open"></i>
            </div>
        </article>

    </section>

    <section class="stdash-main-grid">

        <article class="stdash-panel stdash-chart-panel">

            <div class="stdash-panel-heading">
                <div class="stdash-heading-title">
                    <span class="stdash-heading-icon">
                        <i class="fa-solid fa-chart-column"></i>
                    </span>

                    <div>
                        <h2>Orders Overview</h2>
                        <p>Daily orders over the last 7 days</p>
                    </div>
                </div>

                <span class="stdash-period">
                    <i class="fa-regular fa-calendar"></i> Last 7 Days
                </span>
            </div>

            <div class="stdash-chart-wrap">

                <div class="stdash-y-labels">
                    <span><?php echo $chart_max; ?></span>
                    <span><?php echo round($chart_max * .75); ?></span>
                    <span><?php echo round($chart_max * .5); ?></span>
                    <span><?php echo round($chart_max * .25); ?></span>
                    <span>0</span>
                </div>

                <div class="stdash-chart-plot">

                    <div class="stdash-chart-grid">
                        <i></i><i></i><i></i><i></i><i></i>
                    </div>

                    <svg viewBox="0 0 700 220"
                         preserveAspectRatio="none"
                         role="img"
                         aria-label="Orders over the last seven days">

                        <defs>
                            <linearGradient id="stdashAreaGradient" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#ff9418" stop-opacity=".30"/>
                                <stop offset="100%" stop-color="#ff9418" stop-opacity=".015"/>
                            </linearGradient>
                        </defs>

                        <polygon
                            points="<?php echo htmlspecialchars($fillString, ENT_QUOTES, 'UTF-8'); ?>"
                            fill="url(#stdashAreaGradient)"
                        />

                        <polyline
                            points="<?php echo htmlspecialchars($lineString, ENT_QUOTES, 'UTF-8'); ?>"
                            fill="none"
                            stroke="#ff9418"
                            stroke-width="4"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                        <?php foreach ($chartPoints as $point): ?>
                            <circle
                                cx="<?php echo $point['x']; ?>"
                                cy="<?php echo $point['y']; ?>"
                                r="5.5"
                                fill="#fff"
                                stroke="#ff9418"
                                stroke-width="3"
                            />
                        <?php endforeach; ?>

                    </svg>

                    <div class="stdash-x-labels">
                        <?php foreach ($chart_labels as $label): ?>
                            <span><?php echo htmlspecialchars($label); ?></span>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

            <div class="stdash-chart-foot">
                <span><i class="stdash-legend-dot"></i> Orders per day</span>

                <strong>
                    <?php echo array_sum($chart_values); ?>
                    <small>orders this week</small>
                </strong>
            </div>

        </article>

        <article class="stdash-panel stdash-recent-panel">

            <div class="stdash-panel-heading">
                <div class="stdash-heading-title">
                    <span class="stdash-heading-icon">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </span>

                    <div>
                        <h2>Recent Orders</h2>
                        <p>Latest customer activity</p>
                    </div>
                </div>

                <a class="stdash-view-all" href="order.php">
                    View all <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="stdash-table-wrap">
                <table class="stdash-orders-table">

                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Customer / Plan</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if ($recent_orders && mysqli_num_rows($recent_orders) > 0): ?>

                        <?php while ($order = mysqli_fetch_assoc($recent_orders)): ?>
                            <?php $statusData = getOrderStatus($order['status']); ?>

                            <tr>
                                <td>
                                    <span class="stdash-order-id">
                                        #<?php echo str_pad((string) $order['order_id'], 4, '0', STR_PAD_LEFT); ?>
                                    </span>
                                </td>

                                <td>
                                    <div class="stdash-customer-name">
                                        <?php echo htmlspecialchars($order['customer_name'] ?: 'Unknown Customer'); ?>
                                    </div>

                                    <div class="stdash-plan-name">
                                        <?php echo htmlspecialchars($order['plan_name'] ?: 'No Plan'); ?>
                                    </div>
                                </td>

                                <td class="stdash-amount">
                                    ₹<?php echo number_format((float) $order['price'], 0); ?>
                                </td>

                                <td>
                                    <span class="stdash-status <?php echo $statusData['class']; ?>">
                                        <?php echo $statusData['name']; ?>
                                    </span>
                                </td>

                                <td class="stdash-date-cell">
                                    <?php
                                    echo !empty($order['startdate'])
                                        ? date('d M', strtotime($order['startdate']))
                                        : '—';
                                    ?>
                                </td>
                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="5">
                                <div class="stdash-empty">
                                    <i class="fa-solid fa-box-open"></i>
                                    <strong>No orders yet</strong>
                                    <span>New orders will appear here.</span>
                                </div>
                            </td>
                        </tr>

                    <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </article>

    </section>

    <section class="stdash-bottom-grid">

        <a class="stdash-action stdash-action-orange" href="view_special.php">
            <span class="stdash-action-icon">
                <i class="fa-solid fa-utensils"></i>
            </span>
            <span class="stdash-action-copy">
                <strong>Special Thali</strong>
                <small>View special thali</small>
            </span>
            <i class="fa-solid fa-arrow-up-right-from-square stdash-action-arrow"></i>
        </a>

        <a class="stdash-action stdash-action-blue" href="add_item.php">
            <span class="stdash-action-icon">
                <i class="fa-solid fa-box-open"></i>
            </span>
            <span class="stdash-action-copy">
                <strong>Add Item</strong>
                <small>Manage food items</small>
            </span>
            <i class="fa-solid fa-arrow-up-right-from-square stdash-action-arrow"></i>
        </a>

        <a class="stdash-action stdash-action-purple" href="view_plan_detail.php">
            <span class="stdash-action-icon">
                <i class="fa-solid fa-clipboard-list"></i>
            </span>
            <span class="stdash-action-copy">
                <strong>Plan Details</strong>
                <small>Manage plan details</small>
            </span>
            <i class="fa-solid fa-arrow-up-right-from-square stdash-action-arrow"></i>
        </a>

        <a class="stdash-action stdash-action-green" href="user.php">
            <span class="stdash-action-icon">
                <i class="fa-solid fa-user-group"></i>
            </span>
            <span class="stdash-action-copy">
                <strong>Users</strong>
                <small>Manage customers</small>
            </span>
            <i class="fa-solid fa-arrow-up-right-from-square stdash-action-arrow"></i>
        </a>

        <div class="stdash-today-panel">

            <div class="stdash-today-title">
                <span><i class="fa-solid fa-bolt"></i></span>

                <div>
                    <strong>Today's Snapshot</strong>
                    <small>Live database summary</small>
                </div>
            </div>

            <div class="stdash-today-row">
                <span>Today's orders</span>
                <strong><?php echo number_format($today_orders); ?></strong>
            </div>

            <div class="stdash-today-row">
                <span>Today's revenue</span>
                <strong>₹<?php echo number_format($today_revenue, 0); ?></strong>
            </div>

        </div>

    </section>

</div>

<?php include("footer.php"); ?>