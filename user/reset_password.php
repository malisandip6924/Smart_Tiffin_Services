
<?php
session_start();

include("../admin/connection.php");

$message = "";

if (
    !isset($_SESSION['reset_email']) ||
    !isset($_SESSION['reset_otp_verified']) ||
    $_SESSION['reset_otp_verified'] !== true
) {
    header("Location: forgot_password.php");
    exit;
}

if (isset($_POST['reset_password'])) {

    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (strlen($password) < 8) {

        $message = "Password must contain at least 8 characters.";

    } elseif ($password !== $confirm_password) {

        $message = "Password and confirm password do not match.";

    } else {

        $email = $_SESSION['reset_email'];

        $stmt = mysqli_prepare(
            $con,
            "UPDATE user_records SET password = ? WHERE email = ? AND status = 1"
        );

        mysqli_stmt_bind_param($stmt, "ss", $password, $email);

        if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {

            mysqli_stmt_close($stmt);

            unset(
                $_SESSION['reset_email'],
                $_SESSION['reset_otp_verified'],
                $_SESSION['reset_otp_hash'],
                $_SESSION['reset_otp_expiry'],
                $_SESSION['reset_otp_attempts']
            );

            session_regenerate_id(true);

            header("Location: login.php?reset=success");
            exit;

        } else {

            $message = "Password could not be updated. Please try again.";

            mysqli_stmt_close($stmt);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Password - Smart Tiffin Services</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #fff8df, #ffe5b4);
        }

        .reset-card {
            width: 100%;
            max-width: 420px;
            padding: 35px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .logo {
            text-align: center;
            font-size: 42px;
        }

        h2 {
            text-align: center;
            color: #ff7a1a;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            color: #777;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        input {
            width: 100%;
            padding: 14px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 9px;
            font-size: 15px;
            outline: none;
        }

        input:focus {
            border-color: #ff7a1a;
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 9px;
            background: #ff7a1a;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #e8660b;
        }

        .message {
            color: #c62828;
            text-align: center;
            font-size: 14px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="reset-card">

        <div class="logo">🍱</div>

        <h2>Reset Password</h2>

        <p class="subtitle">
            Enter your new password and confirm it.
        </p>

        <?php if ($message != "") { ?>
            <p class="message">
                <?php echo htmlspecialchars($message); ?>
            </p>
        <?php } ?>

        <form method="post">

            <input
                type="password"
                name="password"
                placeholder="Enter new password"
                minlength="8"
                autocomplete="new-password"
                required
            >

            <input
                type="password"
                name="confirm_password"
                placeholder="Confirm new password"
                minlength="8"
                autocomplete="new-password"
                required
            >

            <button type="submit" name="reset_password">
                Update Password
            </button>

        </form>

    </div>
</body>
</html>
