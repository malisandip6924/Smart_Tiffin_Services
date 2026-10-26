<?php

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();

$error = "";

$admin_username = "admin";
$admin_password = "admin123";

if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username == "") {

        $error = "Please enter username.";

    } elseif ($password == "") {

        $error = "Please enter password.";

    } elseif ($username === $admin_username && $password === $admin_password) {

        session_regenerate_id(true);

        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;

        header("Location: home.php");
        exit();

    } else {

        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login | Smart Tiffin Service</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* ==========================================
           RESET
        ========================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* ==========================================
           BODY
        ========================================== */

        body {
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            font-family: 'Poppins', sans-serif;

            background:
                radial-gradient(circle at 10% 20%,
                    rgba(255, 152, 0, 0.15),
                    transparent 30%),
                radial-gradient(circle at 90% 80%,
                    rgba(255, 87, 34, 0.12),
                    transparent 30%),
                #0c0b0a;

            color: #ffffff;

            /* IMPORTANT */
            overflow-x: hidden;
            overflow-y: auto;

            position: relative;
        }


        /* ==========================================
           BACKGROUND GLOW
        ========================================== */

        body::before {

            content: "";

            position: absolute;

            width: 500px;
            height: 500px;

            border-radius: 50%;

            background: rgba(255, 152, 0, 0.05);

            filter: blur(80px);

            top: -200px;
            left: -150px;

            animation: glowMove 8s ease-in-out infinite alternate;
        }


        body::after {

            content: "";

            position: absolute;

            width: 450px;
            height: 450px;

            border-radius: 50%;

            background: rgba(255, 87, 34, 0.05);

            filter: blur(80px);

            bottom: -200px;
            right: -150px;

            animation: glowMove2 9s ease-in-out infinite alternate;
        }


        @keyframes glowMove {

            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(100px, 70px);
            }
        }


        @keyframes glowMove2 {

            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(-80px, -70px);
            }
        }


        /* ==========================================
           FLOATING FOOD ICONS
        ========================================== */

        .floating-icon {

            position: absolute;

            color: rgba(255, 152, 0, 0.08);

            font-size: 45px;

            animation: floatIcon 6s ease-in-out infinite;

            pointer-events: none;
        }


        .icon1 {
            top: 12%;
            left: 10%;
            animation-delay: 0s;
        }


        .icon2 {
            top: 18%;
            right: 12%;
            animation-delay: 1.5s;
        }


        .icon3 {
            bottom: 15%;
            left: 13%;
            animation-delay: 3s;
        }


        .icon4 {
            bottom: 12%;
            right: 10%;
            animation-delay: 4.5s;
        }


        @keyframes floatIcon {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(8deg);
            }
        }


        /* ==========================================
           LOGIN CONTAINER
        ========================================== */

        .login-container {

            width: 100%;
            max-width: 460px;

            padding: 20px;

            position: relative;

            z-index: 5;

            animation: containerShow 0.8s ease;
        }


        @keyframes containerShow {

            from {
                opacity: 0;
                transform: translateY(35px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }


        /* ==========================================
           LOGIN CARD
        ========================================== */

        .login-card {

            position: relative;

            padding: 42px 40px 35px;

            background:
                linear-gradient(145deg,
                    rgba(35, 31, 27, 0.97),
                    rgba(21, 19, 17, 0.98));

            border: 1px solid rgba(255, 152, 0, 0.16);

            border-radius: 25px;

            box-shadow:
                0 35px 90px rgba(0, 0, 0, 0.7),
                inset 0 1px 0 rgba(255, 255, 255, 0.03);

            backdrop-filter: blur(15px);

            overflow: hidden;
        }


        .login-card::before {

            content: "";

            position: absolute;

            top: 0;
            left: 0;

            width: 100%;
            height: 3px;

            background:
                linear-gradient(90deg,
                    transparent,
                    #ff9800,
                    #ffb52e,
                    #ff9800,
                    transparent);
        }


        /* ==========================================
           LOGO
        ========================================== */

        .logo-wrapper {

            width: 82px;
            height: 82px;

            margin: 0 auto 20px;

            display: flex;
            justify-content: center;
            align-items: center;

            border-radius: 50%;

            background:
                linear-gradient(135deg,
                    #ffab1a,
                    #ed7900);

            box-shadow:
                0 12px 35px rgba(255, 152, 0, 0.28);

            position: relative;

            animation: logoPulse 3s ease-in-out infinite;
        }


        .logo-wrapper::after {

            content: "";

            position: absolute;

            inset: -7px;

            border-radius: 50%;

            border: 1px solid rgba(255, 152, 0, 0.18);

            animation: logoRing 2.5s linear infinite;
        }


        .logo-wrapper i {

            font-size: 35px;

            color: #17120d;
        }


        @keyframes logoPulse {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }


        @keyframes logoRing {

            from {
                transform: scale(0.9);
                opacity: 0.8;
            }

            to {
                transform: scale(1.2);
                opacity: 0;
            }
        }


        /* ==========================================
           BRAND
        ========================================== */

        .brand {

            text-align: center;

            margin-bottom: 8px;
        }


        .brand h1 {

            font-size: 28px;

            font-weight: 800;

            letter-spacing: -0.5px;
        }


        .brand h1 span {

            color: #ff9800;
        }


        .brand-subtitle {

            text-align: center;

            color: #858079;

            font-size: 12px;

            margin-top: 5px;

            letter-spacing: 0.4px;
        }


        /* ==========================================
           WELCOME
        ========================================== */

        .welcome {

            text-align: center;

            margin-top: 27px;

            margin-bottom: 27px;
        }


        .welcome h2 {

            font-size: 19px;

            font-weight: 600;

            color: #eee9e4;
        }


        .welcome p {

            color: #77716b;

            font-size: 12px;

            margin-top: 5px;
        }


        /* ==========================================
           ERROR
        ========================================== */

        .error-message {

            display: flex;

            align-items: center;

            gap: 10px;

            padding: 12px 14px;

            margin-bottom: 20px;

            border-radius: 11px;

            background: rgba(220, 55, 55, 0.09);

            border: 1px solid rgba(220, 75, 75, 0.25);

            color: #ffaaaa;

            font-size: 12px;

            animation: errorShake 0.4s ease;
        }


        .error-message i {

            font-size: 15px;
        }


        @keyframes errorShake {

            0% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-7px);
            }

            50% {
                transform: translateX(7px);
            }

            75% {
                transform: translateX(-5px);
            }

            100% {
                transform: translateX(0);
            }
        }


        /* ==========================================
           INPUT
        ========================================== */

        .input-group {

            margin-bottom: 19px;

            position: relative;
        }


        .input-group label {

            display: block;

            color: #d8d2cc;

            font-size: 12px;

            font-weight: 600;

            margin-bottom: 8px;
        }


        .input-wrapper {

            position: relative;
        }


        .input-wrapper>.input-icon {

            position: absolute;

            left: 16px;

            top: 50%;

            transform: translateY(-50%);

            color: #77716b;

            font-size: 14px;

            transition: 0.3s;

            pointer-events: none;
        }


        .input-wrapper input {

            width: 100%;

            height: 52px;

            padding: 0 45px;

            color: #ffffff;

            background: #141210;

            border: 1px solid #37312c;

            border-radius: 12px;

            outline: none;

            font-family: 'Poppins', sans-serif;

            font-size: 13px;

            transition: 0.3s;
        }


        .input-wrapper input::placeholder {

            color: #625d58;
        }


        .input-wrapper input:focus {

            border-color: #ff9800;

            background: #171410;

            box-shadow:
                0 0 0 3px rgba(255, 152, 0, 0.08),
                0 8px 25px rgba(0, 0, 0, 0.15);
        }


        .input-wrapper:focus-within .input-icon {

            color: #ff9800;
        }


        /* ==========================================
           PASSWORD EYE
        ========================================== */

        .toggle-password {

            position: absolute;

            right: 16px;

            top: 50%;

            transform: translateY(-50%);

            color: #77716b;

            cursor: pointer;

            font-size: 14px;

            transition: 0.3s;
        }


        .toggle-password:hover {

            color: #ff9800;
        }


        /* ==========================================
           REMEMBER
        ========================================== */

        .options {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin: 3px 0 23px;
        }


        .remember {

            display: flex;

            align-items: center;

            gap: 8px;

            color: #858079;

            font-size: 11px;

            cursor: pointer;
        }


        .remember input {

            accent-color: #ff9800;

            cursor: pointer;
        }


        .forgot {

            color: #ff9800;

            text-decoration: none;

            font-size: 11px;

            transition: 0.3s;
        }


        .forgot:hover {

            color: #ffb52e;
        }


        /* ==========================================
           LOGIN BUTTON
        ========================================== */

        .login-btn {

            width: 100%;

            height: 53px;

            border: none;

            border-radius: 12px;

            background:
                linear-gradient(135deg,
                    #ffab1a,
                    #ed7900);

            color: #17120d;

            font-family: 'Poppins', sans-serif;

            font-size: 14px;

            font-weight: 800;

            cursor: pointer;

            position: relative;

            overflow: hidden;

            transition: 0.3s;
        }


        .login-btn::before {

            content: "";

            position: absolute;

            top: 0;
            left: -100%;

            width: 70%;
            height: 100%;

            background: rgba(255, 255, 255, 0.18);

            transform: skewX(-20deg);

            transition: 0.5s;
        }


        .login-btn:hover::before {

            left: 130%;
        }


        .login-btn:hover {

            transform: translateY(-2px);

            box-shadow:
                0 15px 35px rgba(255, 152, 0, 0.24);
        }


        .login-btn:active {

            transform: translateY(0);
        }


        .login-btn i {

            margin-left: 8px;

            transition: 0.3s;
        }


        .login-btn:hover i {

            transform: translateX(5px);
        }


        /* ==========================================
           DIVIDER
        ========================================== */

        .divider {

            display: flex;

            align-items: center;

            gap: 12px;

            margin: 27px 0 22px;

            color: #55504b;

            font-size: 10px;
        }


        .divider::before,
        .divider::after {

            content: "";

            height: 1px;

            flex: 1;

            background: #302c28;
        }


        /* ==========================================
           SECURITY
        ========================================== */

        .security {

            display: flex;

            justify-content: center;

            align-items: center;

            gap: 7px;

            color: #69635e;

            font-size: 10px;
        }


        .security i {

            color: #ff9800;

            font-size: 11px;
        }


        /* ==========================================
           FOOTER
        ========================================== */

        .footer {

            text-align: center;

            color: #504b47;

            font-size: 9px;

            margin-top: 22px;
        }


        /* ==========================================
           RESPONSIVE
        ========================================== */

        @media(max-width: 520px) {

            body {
                overflow-y: auto;
                padding: 20px 0;
            }

            .login-container {
                max-width: 430px;
            }

            .login-card {
                padding: 35px 25px 30px;
            }

            .floating-icon {
                display: none;
            }

            .brand h1 {
                font-size: 25px;
            }
        }
    </style>

</head>


<body>


    <!-- FLOATING BACKGROUND ICONS -->

    <i class="fa-solid fa-utensils floating-icon icon1"></i>

    <i class="fa-solid fa-bowl-food floating-icon icon2"></i>

    <i class="fa-solid fa-leaf floating-icon icon3"></i>

    <i class="fa-solid fa-motorcycle floating-icon icon4"></i>


    <!-- LOGIN -->

    <div class="login-container">

        <div class="login-card">


            <!-- LOGO -->

            <div class="logo-wrapper">

                <i class="fa-solid fa-crown"></i>

            </div>


            <!-- BRAND -->

            <div class="brand">

                <h1>
                    Smart <span>Tiffin</span>
                </h1>

                <p class="brand-subtitle">
                    ADMINISTRATION PANEL
                </p>

            </div>


            <!-- WELCOME -->

            <div class="welcome">

                <h2>
                    Welcome, Admin 👋
                </h2>

                <p>
                    Sign in to manage your tiffin service
                </p>

            </div>


            <!-- ERROR -->

            <?php if ($error != "") { ?>

                <div class="error-message">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <span>
                        <?php echo $error; ?>
                    </span>

                </div>

            <?php } ?>


            <!-- FORM -->

            <form method="POST" autocomplete="off">


                <!-- USERNAME -->

                <div class="input-group">

                    <label>
                        Admin Username
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-user input-icon"></i>

                        <input type="text" name="username" placeholder="Enter admin username" maxlength="30"
                            autocomplete="username"
                            value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                            required>

                    </div>

                </div>


                <!-- PASSWORD -->

                <div class="input-group">

                    <label>
                        Password
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-lock input-icon"></i>

                        <input type="password" id="password" name="password" placeholder="Enter admin password"
                            minlength="6" maxlength="30" autocomplete="current-password" required>

                        <i class="fa-solid fa-eye toggle-password" id="togglePassword">
                        </i>

                    </div>

                </div>


                <!-- OPTIONS -->

                <div class="options">

                    <label class="remember">

                        <input type="checkbox" name="remember">

                        Remember me

                    </label>


                    <a href="#" class="forgot" onclick="return false;">

                        Forgot password?

                    </a>

                </div>


                <!-- LOGIN -->

                <button type="submit" name="login" class="login-btn">

                    Login to Admin Panel

                    <i class="fa-solid fa-arrow-right"></i>

                </button>


            </form>


            <!-- DIVIDER -->

            <div class="divider">

                <span>
                    SECURE ADMIN ACCESS
                </span>

            </div>


            <!-- SECURITY -->

            <div class="security">

                <i class="fa-solid fa-shield-halved"></i>

                <span>
                    Protected & Secure Administration
                </span>

            </div>


            <!-- FOOTER -->

            <div class="footer">

                © 2026 Smart Tiffin Service · Admin Panel

            </div>


        </div>

    </div>


    <!-- PASSWORD SHOW / HIDE -->

    <script>

        const password =
            document.getElementById("password");

        const togglePassword =
            document.getElementById("togglePassword");


        togglePassword.addEventListener("click", function () {

            if (password.type === "password") {

                password.type = "text";

                this.classList.remove("fa-eye");

                this.classList.add("fa-eye-slash");

            } else {

                password.type = "password";

                this.classList.remove("fa-eye-slash");

                this.classList.add("fa-eye");

            }

        });

    </script>


</body>

</html>