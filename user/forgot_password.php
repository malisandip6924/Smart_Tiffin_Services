
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

include("../admin/connection.php");

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

$message = "";

if (isset($_POST['send_otp'])) {

    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $message = "Enter a valid email address.";

    } else {

        $stmt = mysqli_prepare(
            $con,
            "SELECT uid FROM user_records WHERE email = ? AND status = 1"
        );

        if (!$stmt) {
            $message = "Database query failed.";
        } else {

            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {

                $otp = (string) random_int(1000, 9999);

                $mail = new PHPMailer(true);

                try {

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;

                    $mail->Username = 'smarttiffinservices@gmail.com';
                    $mail->Password = 'amgu rqrc hkim cldu';

                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    $mail->setFrom(
                        'YOUR_GMAIL@gmail.com',
                        'Smart Tiffin Services'
                    );

                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'Smart Tiffin Services - Password Reset OTP';

                    $mail->Body = "
                        <div style='font-family:Arial;padding:20px;'>
                            <h2 style='color:#ff7a1a;'>
                                Smart Tiffin Services
                            </h2>
                            <p>Your password reset OTP is:</p>
                            <h1 style='color:#ff7a1a;letter-spacing:8px;'>
                                $otp
                            </h1>
                            <p>This OTP expires in 1 minute.</p>
                            <p>Do not share this OTP with anyone.</p>
                        </div>
                    ";

                    $mail->send();

                    session_regenerate_id(true);

                    $_SESSION['reset_email'] = $email;
                    $_SESSION['reset_otp_hash'] =
                        password_hash($otp, PASSWORD_DEFAULT);
                    $_SESSION['reset_otp_expiry'] = time() + 60;
                    $_SESSION['reset_otp_attempts'] = 0;

                    header("Location: verify_otp.php");
                    exit;

                } catch (Exception $e) {

                    $message = "OTP email could not be sent. Check Gmail settings.";
                }

            } else {

                $message = "Registered active email not found.";
            }

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

    <title>Forgot Password - Smart Tiffin Services</title>

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

        .forgot-card {
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

        .back-link {
            display: block;
            margin-top: 22px;
            text-align: center;
            color: #ff7a1a;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="forgot-card">

        <div class="logo">🍱</div>

        <h2>Forgot Password?</h2>

        <p class="subtitle">
            Enter your registered email address.
            We will send you a password reset OTP.
        </p>

        <?php if ($message != "") { ?>
            <p class="message">
                <?php echo htmlspecialchars($message); ?>
            </p>
        <?php } ?>

        <form method="post">

            <input
                type="email"
                name="email"
                placeholder="Enter registered email"
                required
            >

            <button type="submit" name="send_otp">
                Send OTP
            </button>

        </form>

        <a href="login.php" class="back-link">
            ← Back to Login
        </a>

    </div>

</body>
</html>
