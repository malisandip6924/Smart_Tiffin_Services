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
     FROM user_records
     WHERE uid = ?"
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
<div class="bg-circle circle-one"></div>
<div class="bg-circle circle-two"></div>
<div class="bg-circle circle-three"></div>

<section class="profile-section">
    <div class="profile-card">
        <!-- Profile Header -->

        <div class="profile-header">

            <div class="profile-icon-wrapper">

                <div class="profile-icon">
                    <i class="fa-solid fa-user"></i>
                </div>

            </div>

            <h2>
                <?php echo safe($row['username']); ?>

                <button type="button"
                        class="profile-btn edit-btn"
                        id="editProfileBtn"
                        title="Edit Profile">

                    <i class="fa-solid fa-pen-to-square"></i>

                </button>

            </h2>

            <p>My Smart Tiffin Profile</p>

            <div class="welcome-text">

                <i class="fa-solid fa-leaf"></i>

                Fresh Food • Healthy Life

            </div>

        </div>

        <!-- Profile Information -->

        <div class="profile-info">

            <div class="info-box">

                <div class="info-icon">
                    <i class="fa-solid fa-id-card"></i>
                </div>

                <span class="info-label">User ID</span>

                <span class="info-value">
                    # <?php echo safe($row['uid']); ?>
                </span>

            </div>

            <div class="info-box">

                <div class="info-icon">
                    <i class="fa-solid fa-user"></i>
                </div>

                <span class="info-label">Username</span>

                <span class="info-value">
                    <?php echo safe($row['username']); ?>
                </span>

            </div>

            <div class="info-box">

                <div class="info-icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <span class="info-label">Email Address</span>

                <span class="info-value">
                    <?php echo safe($row['email']); ?>
                </span>

            </div>

            <div class="info-box">

                <div class="info-icon">
                    <i class="fa-solid fa-phone"></i>
                </div>

                <span class="info-label">Mobile Number</span>

                <span class="info-value">
                    <?php echo safe($row['mobile_no']); ?>
                </span>

            </div>

            <div class="info-box">

                <div class="info-icon">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>

                <span class="info-label">Account Status</span>

                <span class="info-value">

                    <?php if ((int)$row['status'] === 1) { ?>

                        <span class="status-badge active-status">

                            <span class="status-dot"></span>

                            Active

                        </span>

                    <?php } else { ?>

                        <span class="status-badge inactive-status">

                            <span class="status-dot"></span>

                            Inactive

                        </span>

                    <?php } ?>

                </span>

            </div>

        </div>

        <!-- Edit Profile Popup Overlay -->

        <div class="modal-overlay" id="modalOverlay"></div>

        <!-- Edit Profile Popup Form -->

        <form method="POST"
              class="edit-form"
              id="editProfileForm">

            <h3>

                <i class="fa-solid fa-pen-to-square"
                   style="color:#f58220;"></i>

                Edit Profile

            </h3>

            <p class="form-description">
                Update your details below.
            </p>

            <label for="username">Username</label>

            <input type="text"
                   id="username"
                   name="username"
                   maxlength="100"
                   value="<?php echo safe($row['username']); ?>"
                   required>

            <label for="email">Email Address</label>

            <input type="email"
                   id="email"
                   name="email"
                   maxlength="150"
                   value="<?php echo safe($row['email']); ?>"
                   required>

            <label for="mobile_no">Mobile Number</label>

            <input type="tel"
                   id="mobile_no"
                   name="mobile_no"
                   pattern="[0-9]{10}"
                   maxlength="10"
                   value="<?php echo safe($row['mobile_no']); ?>"
                   required>

            <div class="form-actions">

                <button type="submit"
                        name="update_profile"
                        class="profile-btn home-btn">

                    <i class="fa-solid fa-floppy-disk"></i>

                    Save Changes

                </button>

                <button type="button"
                        class="profile-btn cancel-btn"
                        id="cancelEdit">

                    <i class="fa-solid fa-xmark"></i>

                    Cancel

                </button>

            </div>

        </form>

        <!-- Bottom Buttons -->

        <div class="button-area">

            <a href="index.php"
               class="profile-btn home-btn">

                <i class="fa-solid fa-house"></i>

                Back to Home

            </a>

            <a href="logout.php"
               class="profile-btn logout-btn">

                <i class="fa-solid fa-right-from-bracket"></i>

                Logout

            </a>

            <a href="my_orders.php"
               class="profile-btn my-orders-btn">

                <i class="fa-solid fa-clock-rotate-left"></i>

                My Orders

            </a>

        </div>

    </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

const editProfileBtn = document.getElementById('editProfileBtn');

const editProfileForm = document.getElementById('editProfileForm');

const cancelEdit = document.getElementById('cancelEdit');

const modalOverlay = document.getElementById('modalOverlay');


/* Open Edit Profile Popup */

editProfileBtn.addEventListener('click', function () {

    editProfileForm.classList.add('show');

    modalOverlay.classList.add('show');

});


/* Close Popup */

function closeEditPopup() {

    editProfileForm.classList.remove('show');

    modalOverlay.classList.remove('show');

}


/* Cancel Button */

cancelEdit.addEventListener('click', function () {

    closeEditPopup();

});


/* Click Outside Popup */

modalOverlay.addEventListener('click', function () {

    closeEditPopup();

});


/* Escape Key */

document.addEventListener('keydown', function (event) {

    if (event.key === 'Escape') {

        closeEditPopup();

    }

});


/* PHP Popup Message */

<?php if ($message !== '') { ?>

Swal.fire({

    icon: <?php echo json_encode($messageType); ?>,

    title: <?php echo json_encode(
        $messageType === 'success'
        ? 'Profile Updated!'
        : 'Update Failed'
    ); ?>,

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