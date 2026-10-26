
<?php
session_start();
include('../admin/connection.php');

if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$uid = (int)$_SESSION['uid'];
$message = "";
$messageType = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mobile_no = trim($_POST['mobile_no'] ?? '');

    if ($username === '' || $email === '' || $mobile_no === '') {
        $message = "Please fill in all fields.";
        $messageType = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
        $messageType = "error";
    } elseif (!preg_match('/^[0-9]{10}$/', $mobile_no)) {
        $message = "Please enter a valid 10-digit mobile number.";
        $messageType = "error";
    } else {
        $check = mysqli_prepare(
            $con,
            "SELECT uid FROM user_records WHERE email = ? AND uid != ?"
        );
        mysqli_stmt_bind_param($check, "si", $email, $uid);
        mysqli_stmt_execute($check);
        $checkResult = mysqli_stmt_get_result($check);

        if (mysqli_num_rows($checkResult) > 0) {
            $message = "This email is already used by another account.";
            $messageType = "error";
        } else {
            $update = mysqli_prepare(
                $con,
                "UPDATE user_records
                 SET username = ?, email = ?, mobile_no = ?
                 WHERE uid = ?"
            );

            mysqli_stmt_bind_param(
                $update,
                "sssi",
                $username,
                $email,
                $mobile_no,
                $uid
            );

            if (mysqli_stmt_execute($update)) {
                $message = "Your profile has been updated successfully.";
                $messageType = "success";
            } else {
                $message = "Unable to update your profile. Please try again.";
                $messageType = "error";
            }

            mysqli_stmt_close($update);
        }

        mysqli_stmt_close($check);
    }
}

$stmt = mysqli_prepare(
    $con,
    "SELECT uid, username, email, mobile_no, status
     FROM user_records WHERE uid = ?"
);
mysqli_stmt_bind_param($stmt, "i", $uid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$row) {
    exit("User data not found!");
}

function safe($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Smart Tiffin Service</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
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
                radial-gradient(circle at 10% 20%, rgba(255,162,26,.12), transparent 30%),
                radial-gradient(circle at 90% 80%, rgba(255,193,7,.12), transparent 30%),
                linear-gradient(135deg, #fffaf3, #fff3df);
            overflow-x: hidden;
            color: #321b08;
        }

        .bg-circle {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            filter: blur(1px);
            animation: floating 6s ease-in-out infinite;
        }

        .circle-one {
            width: 180px;
            height: 180px;
            background: rgba(255,162,26,.12);
            top: 8%;
            left: -70px;
        }

        .circle-two {
            width: 230px;
            height: 230px;
            background: rgba(255,193,7,.10);
            bottom: -90px;
            right: -70px;
            animation-delay: 1.5s;
        }

        .circle-three {
            width: 100px;
            height: 100px;
            background: rgba(245,130,32,.08);
            top: 35%;
            right: 8%;
            animation-delay: 3s;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .profile-section {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 45px 20px;
            position: relative;
            z-index: 1;
        }

        .profile-card {
            width: 100%;
            max-width: 760px;
            background: rgba(255,255,255,.94);
            border-radius: 28px;
            padding: 42px;
            border: 1px solid rgba(245,130,32,.15);
            box-shadow: 0 30px 80px rgba(50,27,8,.13),
                        0 10px 25px rgba(245,130,32,.06);
            backdrop-filter: blur(15px);
            position: relative;
            overflow: hidden;
            animation: cardAppear .8s ease forwards;
        }

        .profile-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg,#f58220,#ffa21a,#ffc107,#f58220);
            background-size: 300% 100%;
            animation: gradientMove 4s linear infinite;
        }

        @keyframes gradientMove {
            from { background-position: 0% 50%; }
            to { background-position: 300% 50%; }
        }

        @keyframes cardAppear {
            from { opacity: 0; transform: translateY(35px) scale(.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .profile-header {
            text-align: center;
            margin-bottom: 35px;
            animation: fadeDown .8s ease;
        }

        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .profile-icon-wrapper {
            width: 105px;
            height: 105px;
            margin: auto;
            padding: 6px;
            border-radius: 50%;
            background: linear-gradient(135deg,#f58220,#ffa21a,#ffc107);
            box-shadow: 0 15px 35px rgba(245,130,32,.28);
            animation: iconFloat 3s ease-in-out infinite;
        }

        @keyframes iconFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-7px); }
        }

        .profile-icon {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #fffaf5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f58220;
            font-size: 38px;
        }

        .profile-header h2 {
            margin-top: 20px;
            margin-bottom: 5px;
            color: #321b08;
            font-size: 27px;
            font-weight: 800;
        }

        .profile-header p {
            color: #999;
            font-size: 14px;
            margin: 0;
        }

        .welcome-text {
            margin-top: 8px;
            color: #f58220;
            font-size: 13px;
            font-weight: 600;
        }

        .profile-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .info-box {
            position: relative;
            padding: 20px;
            border-radius: 16px;
            background: linear-gradient(145deg,#fffdf9,#fff7ed);
            border: 1px solid #f2e2cf;
            transition: .35s;
            overflow: hidden;
            animation: boxAppear .7s ease forwards;
        }

        .info-box:hover {
            transform: translateY(-5px);
            border-color: rgba(245,130,32,.45);
            box-shadow: 0 15px 30px rgba(50,27,8,.10);
        }

        @keyframes boxAppear {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .info-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: linear-gradient(135deg,rgba(245,130,32,.12),rgba(255,193,7,.16));
            color: #f58220;
            margin-bottom: 13px;
            font-size: 17px;
        }

        .info-label {
            display: block;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: #999;
            margin-bottom: 7px;
            font-weight: 500;
        }

        .info-value {
            display: block;
            color: #321b08;
            font-size: 14px;
            font-weight: 600;
            word-break: break-word;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
        }

        .active-status {
            color: #008f6b;
            background: rgba(0,168,120,.10);
        }

        .inactive-status {
            color: #d83232;
            background: rgba(229,57,53,.10);
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        .button-area {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 13px;
            margin-top: 28px;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 14px 16px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: .3s;
            cursor: pointer;
            font-family: inherit;
        }

        .home-btn {
            color: #fff !important;
            background: linear-gradient(135deg,#f58220,#ffa21a);
            border: none;
            box-shadow: 0 10px 22px rgba(245,130,32,.20);
        }

        .home-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(245,130,32,.32);
        }

        .logout-btn {
            color: #d9534f !important;
            background: #fff;
            border: 1px solid #f0d8d5;
        }

        .logout-btn:hover {
            color: #fff !important;
            background: linear-gradient(135deg,#e53935,#ef5350);
            border-color: transparent;
            transform: translateY(-3px);
        }

        .edit-btn {
            color: #f58220 !important;
            background: #fff;
            border: 1px solid #f2d6bd;
        }

        .edit-btn:hover {
            color: #fff !important;
            background: linear-gradient(135deg,#f58220,#ffa21a);
            transform: translateY(-3px);
        }

        .edit-form {
            display: none;
            margin-top: 28px;
            padding: 25px;
            border-radius: 18px;
            background: #fffaf3;
            border: 1px solid #f2dfcb;
            animation: boxAppear .4s ease;
        }

        .edit-form.show {
            display: block;
        }

        .edit-form h3 {
            font-size: 21px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .form-description {
            color: #888;
            font-size: 13px;
            margin-bottom: 22px;
        }

        .edit-form label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin: 15px 0 7px;
        }

        .edit-form input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ead8c5;
            border-radius: 10px;
            background: #fff;
            color: #321b08;
            font-family: inherit;
            outline: none;
            transition: .3s;
        }

        .edit-form input:focus {
            border-color: #f58220;
            box-shadow: 0 0 0 3px rgba(245,130,32,.12);
        }

        .form-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 22px;
        }

        .cancel-btn {
            color: #d9534f !important;
            background: #fff;
            border: 1px solid #f0d8d5;
        }

        .cancel-btn:hover {
            background: #fff0ef;
        }

        @media (max-width: 650px) {
            .profile-section { padding: 30px 15px; }
            .profile-card { padding: 30px 20px; border-radius: 22px; }
            .profile-info { grid-template-columns: 1fr; }
            .button-area, .form-actions { grid-template-columns: 1fr; }
            .profile-header h2 { font-size: 23px; }
            .edit-form { padding: 20px 15px; }
        }

        @media (max-width: 400px) {
            .profile-card { padding: 25px 15px; }
            .info-box { padding: 17px; }
        }
        .button-area {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 13px;
    margin-top: 28px;
}

.button-area .logout-btn {
    grid-column: 1 / -1;
    width: 50%;
    justify-self: center;
}
    </style>
</head>

<body>

<div class="bg-circle circle-one"></div>
<div class="bg-circle circle-two"></div>
<div class="bg-circle circle-three"></div>

<section class="profile-section">
    <div class="profile-card">

        <div class="profile-header">
            <div class="profile-icon-wrapper">
                <div class="profile-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>

            <h2><?php echo safe($row['username']); ?></h2>
            <p>My Smart Tiffin Profile</p>

            <div class="welcome-text">
                <i class="fa-solid fa-leaf"></i>
                Fresh Food • Healthy Life
            </div>
        </div>

        <div class="profile-info">

            <div class="info-box">
                <div class="info-icon"><i class="fa-solid fa-id-card"></i></div>
                <span class="info-label">User ID</span>
                <span class="info-value"># <?php echo safe($row['uid']); ?></span>
            </div>

            <div class="info-box">
                <div class="info-icon"><i class="fa-solid fa-user"></i></div>
                <span class="info-label">Username</span>
                <span class="info-value"><?php echo safe($row['username']); ?></span>
            </div>

            <div class="info-box">
                <div class="info-icon"><i class="fa-solid fa-envelope"></i></div>
                <span class="info-label">Email Address</span>
                <span class="info-value"><?php echo safe($row['email']); ?></span>
            </div>

            <div class="info-box">
                <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                <span class="info-label">Mobile Number</span>
                <span class="info-value"><?php echo safe($row['mobile_no']); ?></span>
            </div>

            <div class="info-box">
                <div class="info-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <span class="info-label">Account Status</span>
                <span class="info-value">
                    <?php if ((int)$row['status'] === 1) { ?>
                        <span class="status-badge active-status">
                            <span class="status-dot"></span> Active
                        </span>
                    <?php } else { ?>
                        <span class="status-badge inactive-status">
                            <span class="status-dot"></span> Inactive
                        </span>
                    <?php } ?>
                </span>
            </div>

        </div>

        <form method="POST" class="edit-form" id="editProfileForm">
            <h3>
                <i class="fa-solid fa-pen-to-square" style="color:#f58220;"></i>
                Edit Profile
            </h3>
            <p class="form-description">Update your details below.</p>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" maxlength="100"
                   value="<?php echo safe($row['username']); ?>" required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" maxlength="150"
                   value="<?php echo safe($row['email']); ?>" required>

            <label for="mobile_no">Mobile Number</label>
            <input type="tel" id="mobile_no" name="mobile_no"
                   pattern="[0-9]{10}" maxlength="10"
                   value="<?php echo safe($row['mobile_no']); ?>" required>

            <div class="form-actions">
                <button type="submit" name="update_profile"
                        class="profile-btn home-btn">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Save Changes
                </button>

                <button type="button" class="profile-btn cancel-btn" id="cancelEdit">
                    <i class="fa-solid fa-xmark"></i>
                    Cancel
                </button>
            </div>
        </form>

        <div class="button-area">
            <a href="index.php" class="profile-btn home-btn">
                <i class="fa-solid fa-house"></i>
                Back to Home
            </a>

            <button type="button" class="profile-btn edit-btn" id="editProfileBtn">
                <i class="fa-solid fa-pen-to-square"></i>
                Edit Profile
            </button>

            <a href="logout.php" class="profile-btn logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>
        </div>

    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const editProfileBtn = document.getElementById('editProfileBtn');
const editProfileForm = document.getElementById('editProfileForm');
const cancelEdit = document.getElementById('cancelEdit');

editProfileBtn.addEventListener('click', function () {
    editProfileForm.classList.add('show');
    editProfileForm.scrollIntoView({
        behavior: 'smooth',
        block: 'center'
    });
});

cancelEdit.addEventListener('click', function () {
    editProfileForm.classList.remove('show');
});

<?php if ($message !== '') { ?>
Swal.fire({
    icon: <?php echo json_encode($messageType); ?>,
    title: <?php echo json_encode($messageType === 'success' ? 'Profile Updated!' : 'Update Failed'); ?>,
    text: <?php echo json_encode($message); ?>,
    confirmButtonText: 'OK',
    confirmButtonColor: '#f58220',
    background: '#ffffff',
    color: '#321b08'
});
<?php } ?>
</script>

</body>
</html>
