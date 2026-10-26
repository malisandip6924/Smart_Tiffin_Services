<?php
    include("header.php");
?>
<?php
include('connection.php');

$query = mysqli_query($con, "SELECT * FROM user_records ORDER BY uid DESC");
?>

<style>
    /* ===== USERS MAIN CARD ===== */

    .users-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 10px 35px rgba(50, 27, 8, 0.08);
        border: 1px solid #eee8df;
        animation: cardShow 0.7s ease;
        overflow: hidden;
    }

    /* ===== TOP TITLE ===== */

    .users-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
    }

    .users-heading {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .users-icon {
        width: 58px;
        height: 58px;
        border-radius: 15px;
        background: linear-gradient(135deg, #ff9f1c, #ff6b35);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        box-shadow: 0 8px 20px rgba(255, 107, 53, 0.25);
        animation: iconFloat 2.5s ease-in-out infinite;
    }

    .users-heading h3 {
        margin: 0;
        color: #321b08;
        font-size: 24px;
        font-weight: 700;
    }

    .users-heading p {
        margin: 4px 0 0;
        color: #8b8177;
        font-size: 14px;
    }

    /* ===== TABLE ===== */

    .users-table-wrapper {
        width: 100%;
        overflow-x: auto;
        border-radius: 14px;
    }

    .users-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 700px;
    }

    /* HEADER */

    .users-table thead th {
        background: linear-gradient(135deg, #ff9f1c, #ffb43b);
        color: #ffffff;
        padding: 17px 18px;
        text-align: left;
        font-size: 14px;
        font-weight: 700;
        white-space: nowrap;
    }

    .users-table thead th:first-child {
        border-radius: 14px 0 0 0;
    }

    .users-table thead th:last-child {
        border-radius: 0 14px 0 0;
    }

    /* TABLE BODY */

    .users-table tbody tr {
        background: #ffffff;
        transition: all 0.3s ease;
        animation: rowShow 0.6s ease both;
    }

    .users-table tbody tr:nth-child(1) {
        animation-delay: .08s;
    }

    .users-table tbody tr:nth-child(2) {
        animation-delay: .16s;
    }

    .users-table tbody tr:nth-child(3) {
        animation-delay: .24s;
    }

    .users-table tbody tr:nth-child(4) {
        animation-delay: .32s;
    }

    .users-table tbody tr:nth-child(5) {
        animation-delay: .40s;
    }

    .users-table tbody tr:nth-child(n+6) {
        animation-delay: .48s;
    }

    .users-table tbody tr:hover {
        background: #fffaf0;
        transform: translateX(5px);
        box-shadow: 0 5px 20px rgba(50, 27, 8, 0.06);
    }

    .users-table tbody td {
        padding: 17px 18px;
        border-bottom: 1px solid #eeeae4;
        color: #62594f;
        font-size: 14px;
        vertical-align: middle;
        white-space: nowrap;
    }

    .users-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* ===== USER ID ===== */

    .user-id {
        color: #321b08 !important;
        font-weight: 700;
    }

    /* ===== USERNAME ===== */

    .user-name {
        color: #321b08 !important;
        font-weight: 600;
    }

    /* ===== EMAIL ===== */

    .user-email {
        color: #777 !important;
    }

    /* ===== MOBILE ===== */

    .user-mobile {
        color: #555 !important;
        font-weight: 500;
    }

    /* ===== STATUS ===== */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 14px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        transition: 0.3s ease;
    }

    .status-badge:hover {
        transform: translateY(-2px);
    }

    .status-badge::before {
        content: "";
        width: 7px;
        height: 7px;
        border-radius: 50%;
    }

    .status-active {
        background: #e0f7ed;
        color: #00966d;
    }

    .status-active::before {
        background: #00a878;
        animation: pulse 1.5s infinite;
    }

    .status-inactive {
        background: #ffe7e5;
        color: #dc3545;
    }

    .status-inactive::before {
        background: #dc3545;
    }

    /* ===== ANIMATIONS ===== */

    @keyframes cardShow {
        from {
            opacity: 0;
            transform: translateY(25px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes rowShow {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes iconFloat {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(0, 168, 120, 0.5);
        }

        70% {
            box-shadow: 0 0 0 7px rgba(0, 168, 120, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(0, 168, 120, 0);
        }
    }

    /* ===== RESPONSIVE ===== */

    @media(max-width: 768px) {

        .users-card {
            padding: 18px;
            border-radius: 15px;
        }

        .users-heading h3 {
            font-size: 20px;
        }

        .users-heading p {
            font-size: 12px;
        }

        .users-icon {
            width: 48px;
            height: 48px;
            font-size: 20px;
        }

        .users-table {
            min-width: 700px;
        }
    }
</style>


<div class="users-card">

    <!-- HEADER -->

    <div class="users-header">

        <div class="users-heading">

            <div class="users-icon">
                <i class="fa-solid fa-users"></i>
            </div>

            <div>
                <h3>Registered Users</h3>
                <p>Manage your registered customers</p>
            </div>

        </div>

    </div>


    <!-- TABLE -->

    <div class="users-table-wrapper">

        <table class="users-table">

            <thead>

                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Status</th>
                </tr>

            </thead>


            <tbody>

                <?php
                while($row = mysqli_fetch_assoc($query))
                {
                ?>

                <tr>

                    <td class="user-id">
                        <?php echo $row['uid']; ?>
                    </td>

                    <td class="user-name">
                        <?php echo $row['username']; ?>
                    </td>

                    <td class="user-email">
                        <?php echo $row['email']; ?>
                    </td>

                    <td class="user-mobile">
                        <?php echo $row['mobile_no']; ?>
                    </td>

                    <td>

                        <?php
                        if($row['status'] == 1)
                        {
                            echo '<span class="status-badge status-active">Active</span>';
                        }
                        else
                        {
                            echo '<span class="status-badge status-inactive">Inactive</span>';
                        }
                        ?>

                    </td>

                </tr>

                <?php
                }
                ?>

            </tbody>

        </table>

    </div>

</div>
<?php
    include("footer.php");
?>