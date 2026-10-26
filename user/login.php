<?php 
if (isset($_GET['reset']) && $_GET['reset'] === 'success') { ?>
    <div id="resetToast" class="reset-toast">
        <span class="toast-icon">✓</span>
        <span>Password reset successful! Please login.</span>
        <button type="button" onclick="closeResetToast()">×</button>
    </div>

    <script>
        function closeResetToast() {
            const toast = document.getElementById('resetToast');
            if (toast) {
                toast.classList.add('hide');
                setTimeout(() => toast.remove(), 300);
            }
        }

        window.addEventListener('DOMContentLoaded', function () {
            const toast = document.getElementById('resetToast');

            if (toast) {
                setTimeout(closeResetToast, 4000);
            }

            const url = new URL(window.location.href);
            url.searchParams.delete('reset');
            window.history.replaceState({}, document.title, url.pathname + url.search + url.hash);
        });
    </script>
<?php } ?>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include('../admin/connection.php');
if (isset($_POST['login'])) {
    $identifier = trim($_POST['email']);
    $password = trim($_POST['password']);
    if ($identifier == "" || $password == "") {
        echo "<script>
                alert('Please enter Username/Email and Password!');
              </script>";
    } 
    else 
    {
        $identifier_safe = mysqli_real_escape_string($con, $identifier);
        $q = mysqli_query(
            $con,
            "SELECT uid, username, email, password, status
             FROM user_records
             WHERE email = '$identifier_safe'
                OR username = '$identifier_safe'
             LIMIT 1"
        );
        if (!$q) {
            die("Database Error: " . mysqli_error($con));
        }
        if (mysqli_num_rows($q) == 0) {
            echo "<script>
                    alert('Username or Email not found!');
                  </script>";
        } 
        else 
        {
            $row = mysqli_fetch_assoc($q);
            if ($row['status'] != 1) {
                echo "<script>
                        alert('Your account is inactive!');
                      </script>";
            }
             elseif ($password !== $row['password']) {
                echo "<script>
                        alert('Password is incorrect!');
                      </script>";
            }
             else {
                session_regenerate_id(true);
                $_SESSION['uid'] = $row['uid'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['user_logged_in'] = true;
                header("Location: index.php");
                exit();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tiffin Services- Login</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Caveat:wght@600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body>
    <div class="page">
        <aside class="left-panel">
            <div class="left-overlay"></div>
            <div class="left-content">
                <div class="tag-cloche">
                    <i class="fa-solid fa-utensils"></i>
                </div>
                <h1 class="hero-title"> Delicious<br />
                    <span class="script">Meals</span><br />
                    Delivered<br />to You!
                </h1>
                <p class="hero-sub">
                    Fresh, Hygienic &amp; Homemade<br />
                    Tiffin Service
                </p>
                <ul class="feature-list">
                    <li>
                        <span class="feat-icon">
                            <i class="fa-solid fa-leaf"></i>
                        </span>
                        <div>
                            <div class="feat-title">
                                Daily Fresh Menu
                            </div>
                            <div class="feat-sub"> Nutritious &amp; tasty meals everyday </div>
                        </div>
                    </li>
                    <li>
                        <span class="feat-icon">
                            <i class="fa-solid fa-motorcycle"></i>
                        </span>
                        <div>
                            <div class="feat-title">
                                On-time Delivery
                            </div>
                            <div class="feat-sub">
                                Always on time, every time
                            </div>
                        </div>
                    </li>
                    <li>
                        <span class="feat-icon">
                            <i class="fa-solid fa-shield-halved"></i>
                        </span>
                        <div>
                            <div class="feat-title">Hygienic &amp; Safe </div>
                            <div class="feat-sub"> Prepared with care and hygiene </div>
                        </div>
                    </li>
                </ul>
                <blockquote class="quote">
                    <i class="fa-solid fa-quote-left"></i>
                    Good food is<br />
                    good mood.
                    <i class="fa-solid fa-heart heart"></i>
                </blockquote>
            </div>
        </aside>
        <main class="right-panel">
            <!-- THEME TOGGLE -->
            <div class="theme-toggle" id="themeToggle" title="Toggle theme">
                <i class="fa-solid fa-sun sun"></i>
                <span class="knob"></span>
                <i class="fa-solid fa-moon moon"></i>
            </div>
            <div class="auth-card">

                <!-- BRAND -->
                <div class="brand">
                    <div class="brand-logo">
                        <i class="fa-solid fa-box-tissue"></i>
                        <span class="leaf leaf-l">
                            <i class="fa-solid fa-leaf"></i>
                        </span>
                        <span class="leaf leaf-r">
                            <i class="fa-solid fa-leaf"></i>
                        </span>
                    </div>
                    <h2 class="brand-name">
                        Tiffin<span>Services</span>
                        <i class="fa-solid fa-heart brand-heart"></i>
                    </h2>
                    <p class="brand-tag">
                        • Smart Tiffin Service •
                    </p>
                </div>
                <!-- WELCOME -->
                <h3 class="welcome">

                    Welcome <span>Back!</span>

                </h3>


                <p class="welcome-sub">

                    Login to your account

                </p>



                <!-- =================================================
                 LOGIN FORM
            ================================================== -->

                <form method="post" class="auth-form" autocomplete="off">


                    <!-- USERNAME / EMAIL -->

                    <div class="input-group">

                        <i class="fa-solid fa-user"></i>

                        <input type="text" name="email" placeholder="Username / Email" autocomplete="off" required />

                    </div>



                    <!-- PASSWORD -->

                    <div class="input-group">

                        <i class="fa-solid fa-lock"></i>

                        <input type="password" name="password" id="password" placeholder="Password" autocomplete="off"
                            required />

                       <i class="fa-regular fa-eye" id="togglePassword"></i>
                    </div>



                    <!-- REMEMBER / FORGOT -->

                    <div class="row-between">


                        <label class="checkbox">

                            <input type="checkbox" name="remember" />

                            <span class="box"></span>

                            Remember Me

                        </label>


                        <a href="forgot_password.php" class="link-orange">

                            Forgot Password?

                        </a>


                    </div>



                    <!-- LOGIN BUTTON -->

                    <button type="submit" class="btn-primary" name="login">

                        Login

                        <i class="fa-solid fa-arrow-right"></i>

                    </button>



                    <!-- DIVIDER -->

                    <div class="divider">

                        <span>or continue with</span>

                    </div>



                    <!-- SOCIAL BUTTONS -->

                    <div class="socials">


                        <button type="button" class="social-btn" title="Google (visual only)">

                            <i class="fa-brands fa-google" style="color:#EA4335">
                            </i>

                        </button>


                        <button type="button" class="social-btn" title="Facebook (visual only)">

                            <i class="fa-brands fa-facebook" style="color:#1877F2">
                            </i>

                        </button>


                        <button type="button" class="social-btn" title="Email (visual only)">

                            <i class="fa-solid fa-envelope" style="color:#555">
                            </i>

                        </button>


                    </div>



                    <!-- REGISTER -->

                    <p class="foot-text">

                        Don't have an account?

                        <a href="register.php" class="link-orange">

                            Register Now

                        </a>

                    </p>


                </form>


            </div>



            <!-- =================================================
             DELIVERY BADGE
        ================================================== -->

            <div class="delivery-badge">


                <div class="delivery-icon">

                    <i class="fa-solid fa-motorcycle"></i>

                </div>


                <div class="delivery-text">

                    <strong>

                        Fast Delivery

                    </strong>

                    <span>

                        At Your Doorstep

                    </span>

                </div>


            </div>


        </main>


    </div>



    <!-- =========================================================
     SCRIPT
========================================================= -->

    <script src="assets/js/script.js"></script>
    
<script>
document.addEventListener("DOMContentLoaded", function () {
    const password = document.getElementById("password");
    const toggle = document.getElementById("togglePassword");

    if (!password || !toggle) return;

    toggle.style.cursor = "pointer";

    toggle.addEventListener("click", function () {
        if (password.type === "password") {
            password.type = "text";
            toggle.classList.remove("fa-eye");
            toggle.classList.add("fa-eye-slash");
        } else {
            password.type = "password";
            toggle.classList.remove("fa-eye-slash");
            toggle.classList.add("fa-eye");
        }
    });
});
</script>



</body>

</html>