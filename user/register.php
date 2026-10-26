<?php
session_start();
include("../admin/connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

$message = "";
$messageType = "error";

if (isset($_POST['regis'])) {
    $name = trim($_POST['uname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mobile = trim($_POST['mob'] ?? '');
    $password = $_POST['pass'] ?? '';
    $cpassword = $_POST['cpass'] ?? '';

    if ($name === '' || $email === '' || $mobile === '' || $password === '' || $cpassword === '') {
        $message = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    } elseif (!preg_match('/^[0-9]{10}$/', $mobile)) {
        $message = "Please enter a valid 10-digit mobile number.";
    } elseif (strlen($password) < 8) {
        $message = "Password must contain at least 8 characters.";
    } elseif ($password !== $cpassword) {
        $message = "Password and Confirm Password do not match.";
    } elseif (!isset($_POST['terms'])) {
        $message = "Please accept the Terms & Conditions.";
    } else {
        $check = mysqli_prepare($con, "SELECT uid FROM user_records WHERE email = ? LIMIT 1");

        if ($check) {
            mysqli_stmt_bind_param($check, "s", $email);
            mysqli_stmt_execute($check);
            mysqli_stmt_store_result($check);

            if (mysqli_stmt_num_rows($check) > 0) {
                $message = "This email is already registered. Please login.";
            } else {
                $otp = (string) random_int(1000, 9999);
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $insert = mysqli_prepare(
                    $con,
                    "INSERT INTO user_records (username, email, mobile_no, password, status, otp)
                     VALUES (?, ?, ?, ?, 0, ?)"
                );

                if ($insert) {
                    mysqli_stmt_bind_param(
                        $insert,
                        "sssss",
                        $name,
                        $email,
                        $mobile,
                        $hashedPassword,
                        $otp
                    );

                    if (mysqli_stmt_execute($insert)) {
                        $mail = new PHPMailer(true);

                        try {
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'smarttiffinservices@gmail.com';
                            $mail->Password = 'amgu rqrc hkim cldu';
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            $mail->Port = 587;
                            $mail->CharSet = 'UTF-8';

                            $mail->setFrom(
                                'smarttiffinservices@gmail.com',
                                'Tiffin Services'
                            );

                            $mail->addAddress($email, $name);
                            $mail->isHTML(true);
                            $mail->Subject = 'Tiffin Services - OTP Verification';

                            $safeName = htmlspecialchars(
                                $name,
                                ENT_QUOTES,
                                'UTF-8'
                            );

                            $mail->Body = "
                                <div style='font-family:Arial,sans-serif;padding:25px;background:#fff8f0;border-radius:12px;'>
                                    <h2 style='color:#ff7a1a;'>Tiffin Services</h2>
                                    <p>Hello <b>{$safeName}</b>,</p>
                                    <p>Thank you for registering with Smart Tiffin Services.</p>
                                    <p>Your email verification OTP is:</p>
                                    <h1 style='color:#ff7a1a;letter-spacing:8px;'>{$otp}</h1>
                                    <p>Please enter this OTP on the verification page.</p>
                                    <p>Do not share this OTP with anyone.</p>
                                    <p>Thank you,<br><b>Tiffin Services Team</b></p>
                                </div>
                            ";

                            $mail->AltBody =
                                "Hello $name, your Tiffin Services verification OTP is $otp.";

                            $mail->send();

                            $_SESSION['otp_email'] = $email;
                            $_SESSION['otp'] = $otp;

                            header("Location: otp.php");
                            exit;
                        } catch (Exception $e) {
                            $message = "OTP email could not be sent. Please check your Gmail SMTP settings and try again.";

                            unset($_SESSION['otp_email'], $_SESSION['otp']);

                            $delete = mysqli_prepare(
                                $con,
                                "DELETE FROM user_records WHERE email = ? AND status = 0"
                            );

                            if ($delete) {
                                mysqli_stmt_bind_param($delete, "s", $email);
                                mysqli_stmt_execute($delete);
                                mysqli_stmt_close($delete);
                            }
                        }
                    } else {
                        $message = "Registration failed. Please try again.";
                    }

                    mysqli_stmt_close($insert);
                } else {
                    $message = "Database query could not be prepared.";
                }
            }

            mysqli_stmt_close($check);
        } else {
            $message = "Database query could not be prepared.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tiffin Services — Create Account</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Pacifico&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        .field--password {
            position: relative;
        }

        .field--password input {
            padding-right: 48px;
        }

        .toggle-pw {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 35px;
            border: none;
            background: transparent;
            color: #ff7a1a;
            cursor: pointer;
            z-index: 5;
            font-size: 16px;
        }

        .toggle-pw i {
            pointer-events: none;
        }

        .register-message {
            padding: 12px 15px;
            margin: 0 0 15px;
            border-radius: 9px;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            line-height: 1.5;
            background: #fff0ed;
            color: #b42318;
            border: 1px solid #ffc9c1;
        }

        .field input:focus {
            outline-color: #ff7a1a;
        }
    </style>
</head>

<body class="theme-light">

    <button id="themeToggle" class="theme-toggle" aria-label="Toggle theme" type="button">
        <i class="fas fa-sun sun"></i>
        <span class="knob"></span>
        <i class="fas fa-moon moon"></i>
    </button>

    <span class="leaf leaf-1"><i class="fas fa-leaf"></i></span>
    <span class="leaf leaf-2"><i class="fas fa-leaf"></i></span>
    <span class="leaf leaf-3"><i class="fas fa-leaf"></i></span>
    <span class="leaf leaf-4"><i class="fas fa-leaf"></i></span>
    <span class="leaf leaf-5"><i class="fas fa-leaf"></i></span>

    <div class="page">

        <aside class="left-panel">
            <div class="left-panel__overlay"></div>

            <div class="tiffin-badge">
                <i class="fas fa-utensils"></i>
            </div>

            <div class="left-panel__content">
                <div class="hearts">
                    <span>&#10084;</span>
                    <span>&#10084;</span>
                </div>

                <h1 class="hero-title">Good Food</h1>

                <p class="hero-sub">
                    Fresh, Hygienic &amp; Homemade<br>
                    Tiffin Service<br>
                    Delivered to Your Doorstep
                </p>

                <div class="squiggle"></div>

                <ul class="features">
                    <li>
                        <div class="feature-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <div>
                            <h4>Fresh &amp; Healthy</h4>
                            <p>We serve fresh and<br>healthy meals everyday.</p>
                        </div>
                    </li>

                    <li>
                        <div class="feature-icon">
                            <i class="fas fa-motorcycle"></i>
                        </div>
                        <div>
                            <h4>On-time Delivery</h4>
                            <p>Timely delivery at<br>your convenience.</p>
                        </div>
                    </li>

                    <li>
                        <div class="feature-icon">
                            <i class="fas fa-shield-heart"></i>
                        </div>
                        <div>
                            <h4>Safe &amp; Hygienic</h4>
                            <p>Prepared with care<br>and 100% hygiene.</p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="customers-card">
                <div class="customers-card__icon">
                    <i class="fas fa-users"></i>
                </div>

                <div class="customers-card__text">
                    <strong>5000+</strong>
                    <span>Happy Customers</span>
                </div>

                <div class="avatars">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Customer">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Customer">
                    <img src="https://randomuser.me/api/portraits/men/12.jpg" alt="Customer">
                    <span class="more">+</span>
                </div>
            </div>
        </aside>

        <main class="form-card">

            <div class="brand">
                <div class="brand__logo">
                    <i class="fas fa-utensils"></i>
                </div>

                <h2 class="brand__name">
                    Tiffin<span>Services</span>
                    <i class="fas fa-heart brand__heart"></i>
                </h2>

                <p class="brand__tag">
                    <span class="dot"></span>
                    Smart Tiffin Service
                </p>
            </div>

            <div class="form-heading">
                <h3>Create <span>Account</span></h3>
                <p>Join us and enjoy healthy &amp; tasty meals</p>
            </div>

            <?php if ($message !== ""): ?>
                <div class="register-message" role="alert">
                    <?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="register-form" id="registerForm">

                <div class="field">
                    <span class="field__icon">
                        <i class="fas fa-circle-user"></i>
                    </span>
                    <input type="text" name="uname" placeholder="Username"
                        value="<?php echo htmlspecialchars($_POST['uname'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required
                        maxlength="100" autocomplete="name">
                </div>

                <div class="field">
                    <span class="field__icon">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" name="email" placeholder="Email Address"
                        value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required
                        maxlength="255" autocomplete="email">
                </div>

                <div class="field">
                    <span class="field__icon">
                        <i class="fas fa-phone"></i>
                    </span>
                    <input type="tel" name="mob" placeholder="Mobile Number"
                        value="<?php echo htmlspecialchars($_POST['mob'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required
                        pattern="[0-9]{10}" maxlength="10" minlength="10" inputmode="numeric" autocomplete="tel">
                </div>

                <div class="field field--password">
                    <span class="field__icon">
                        <i class="fas fa-lock"></i>
                    </span>

                    <input type="password" name="pass" id="password" placeholder="Password" required minlength="8"
                        autocomplete="new-password">

                    <button type="button" class="toggle-pw" data-target="password" aria-label="Show password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                <div class="field field--password">
                    <span class="field__icon">
                        <i class="fas fa-lock"></i>
                    </span>

                    <input type="password" name="cpass" id="confirm_password" placeholder="Confirm Password" required
                        minlength="8" autocomplete="new-password">

                    <button type="button" class="toggle-pw" data-target="confirm_password"
                        aria-label="Show confirm password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                <label class="terms">
                    <input type="checkbox" name="terms" required>
                    <span class="terms__box"></span>
                    <span class="terms__text">
                        I agree to the
                        <a href="#">Terms &amp; Conditions</a>
                    </span>
                </label>

                <button type="submit" class="btn-register" name="regis" value="1">
                    Register
                    <span class="btn-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                </button>

                <div class="divider">
                    <span>or register with</span>
                </div>

                <div class="socials">
                    <button type="button" class="social social--google" aria-label="Register with Google">
                        <i class="fab fa-google"></i>
                    </button>

                    <button type="button" class="social social--facebook" aria-label="Register with Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </button>

                    <button type="button" class="social social--email" aria-label="Register with Email">
                        <i class="fas fa-envelope"></i>
                    </button>
                </div>

                <p class="login-link">
                    Already have an account?
                    <a href="login.php">Login Now</a>
                </p>

            </form>
        </main>
    </div>

    <div class="delivery-badge">
        <img src="https://cdn-icons-png.flaticon.com/512/2972/2972185.png" alt="Delivery">
        <div>
            <strong>Fast Delivery</strong>
            <span>At Your Doorstep</span>
        </div>
    </div>

    <svg class="flight-path" viewBox="0 0 200 700" preserveAspectRatio="none" aria-hidden="true">
        <path d="M180,20 C60,120 220,260 80,380 C-20,470 200,560 100,680" stroke="#FF7A1A" stroke-width="2"
            stroke-dasharray="6 8" fill="none">
        </path>
    </svg>

    <i class="fas fa-paper-plane paper-plane"></i>

    <script src="assets/js/main.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".toggle-pw").forEach(function (button) {
                button.addEventListener("click", function () {
                    const targetId = this.getAttribute("data-target");
                    const input = document.getElementById(targetId);
                    const icon = this.querySelector("i");

                    if (!input || !icon) return;

                    const showPassword = input.type === "password";

                    input.type = showPassword ? "text" : "password";

                    icon.classList.toggle("fa-eye", !showPassword);
                    icon.classList.toggle("fa-eye-slash", showPassword);

                    this.setAttribute(
                        "aria-label",
                        showPassword ? "Hide password" : "Show password"
                    );
                });
            });

            const form = document.getElementById("registerForm");
            const password = document.getElementById("password");
            const confirmPassword = document.getElementById("confirm_password");

            form.addEventListener("submit", function (event) {
                if (password.value !== confirmPassword.value) {
                    event.preventDefault();
                    alert("Password and Confirm Password do not match.");
                    confirmPassword.focus();
                }
            });
        });
    </script>
    <?php if (!empty($message)) { ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            Swal.fire({
                icon: '<?php echo $messageType ?? "error"; ?>',
                title: 'Email Already Registered!',
                text: <?php echo json_encode($message); ?>,
                confirmButtonText: 'OK',
                confirmButtonColor: '#f97316',
                background: '#ffffff',
                color: '#222222',
                customClass: {
                    popup: 'custom-popup'
                }
            });
        </script>
        <?php } ?>
    <style>
        .custom-popup {
            border-radius: 20px !important;
            padding: 25px !important;
            font-family: Arial, sans-serif;
        }
    </style>

</body>

</html>