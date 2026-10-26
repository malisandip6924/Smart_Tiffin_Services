<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['uid']);
$username = '';

if ($isLoggedIn) {
    $username = isset($_SESSION['username'])
        ? $_SESSION['username']
        : '';
}
?>

<style>
    /* LOGO */
    .header .navbar-brand {
        width: 100px !important;
        height: 100px !important;
        padding: 0 !important;
        margin: 0 !important;
        display: flex !important;
        align-items: center !important;
    }

    .header .navbar-brand img {
        width: 150px !important;
        height: auto !important;
        max-width: none !important;
        margin-left: -100px !important;
        transform: scale(1.8);
        transform-origin: left center;
    }

    .header .navbar {
        min-height: 100px !important;
    }

    /* PROFILE BUTTON */
    .userProfileBtn {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 9px 14px;
        border-radius: 30px;
        text-decoration: none !important;
        color: #321b08 !important;
        background: #fff8ed;
        border: 1px solid #f5dfc2;
        transition: all 0.3s ease;
    }

    .userProfileBtn i {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: #fff;
        background: linear-gradient(135deg, #f58220, #ffa21a);
        font-size: 14px;
        transition: 0.3s;
    }

    .userProfileBtn .userName {
        max-width: 110px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-size: 13px;
        font-weight: 600;
    }

    .userProfileBtn:hover {
        transform: translateY(-2px);
        border-color: #ffa21a;
        box-shadow: 0 7px 18px rgba(245, 130, 32, 0.18);
    }

    /* LOGIN AND REGISTER BUTTONS */
    .loginBtn,
    .registerBtn {
        margin: 0;
    }

    .loginBtn .btnPrimary,
    .registerBtn .registerPrimary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        height: 46px;
        padding: 0 20px;
        border-radius: 30px;
        background: linear-gradient(135deg, #f58220, #ffa21a) !important;
        color: #ffffff !important;
        border: 1px solid #f58220;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none !important;
        white-space: nowrap;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    /* LOGIN HOVER */
    .loginBtn .btnPrimary:hover {
        background: linear-gradient(135deg, #e66d0b, #f58220) !important;
        color: #ffffff !important;
        border-color: #e66d0b;
        transform: translateY(-3px);
        box-shadow: 0 9px 20px rgba(245, 130, 32, 0.28);
    }

    /* REGISTER BUTTON */
    .registerBtn {
        margin-left: 10px;
    }

    .registerBtn .registerPrimary:hover {
        background: linear-gradient(135deg, #e66d0b, #f58220) !important;
        color: #ffffff !important;
        border-color: #e66d0b;
        transform: translateY(-3px);
        box-shadow: 0 9px 20px rgba(245, 130, 32, 0.28);
    }

    /* BUTTON ICONS */
    .loginBtn .btnPrimary i,
    .registerBtn .registerPrimary i {
        transition: transform 0.3s ease;
    }

    .loginBtn .btnPrimary:hover i,
    .registerBtn .registerPrimary:hover i {
        transform: scale(1.12);
    }

    /* RIGHT MENU */
    .rightMenu {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .rightMenu .cart {
        display: flex;
        align-items: center;
        margin-right: 5px;
    }

    /* MOBILE RESPONSIVE */
    @media (max-width: 600px) {
        .userProfileBtn {
            padding: 7px 10px;
        }

        .userProfileBtn .userName {
            max-width: 70px;
        }

        .rightMenu {
            gap: 6px;
        }

        .loginBtn .btnPrimary,
        .registerBtn .registerPrimary {
            height: 42px;
            padding: 0 11px;
            font-size: 12px;
            gap: 5px;
        }

        .registerBtn {
            margin-left: 0;
        }
    }
    

/* PREMIUM CART BUTTON FIX */
.rightMenu .cart {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    flex-shrink: 0;
}

.rightMenu .premiumCart {
    position: relative;
    width: 48px;
    height: 48px;
    min-width: 48px;
    padding: 0;
    box-sizing: border-box;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 25px;
    background: linear-gradient(135deg, #ffad24, #ff8415);
    color: #fff !important;
    text-decoration: none !important;
    border: 2px solid #fff2df;
    box-shadow: 0 4px 12px rgba(255, 132, 21, 0.22);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.rightMenu .premiumCart i {
    display: block;
    font-size: 23px;
    line-height: 1;
    margin: 0;
}

.rightMenu .premiumCart:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 7px 17px rgba(255, 132, 21, 0.32);
}
@media (max-width: 600px) {
    .rightMenu .premiumCart {
        width: 42px;
        height: 42px;
        min-width: 42px;
        border-radius: 13px;
    }

    .rightMenu .premiumCart i {
        font-size: 20px;
    }
}

</style>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">

<header class="w-100 clearfix header" id="header">
    <div class="container">
        <div class="headerInner">

            <nav class="navbar navbar-expand-xl">
                <div class="container-fluid">

                    <a class="navbar-brand" href="index.php">
                        <img src="images/logo/smart_logo.png" alt="Smart Tiffin Service" class="img-fluid">
                    </a>

                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="aboutus.php">About us</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="contactus.php">Contact us</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </nav>

            <div class="rightMenu">

                <!-- CART -->

               <div class="cart">
                <a href="checkout.php" class="premiumCart" aria-label="Shopping Cart">
                <i class="fa-solid fa-cart-shopping"></i>
                 
                 </a>
                </div>

                <?php if (!$isLoggedIn) { ?>

                    <!-- LOGIN BUTTON -->

                    <div class="loginBtn">
                        <a href="login.php" class="btnPrimary">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <span>Login</span>
                        </a>
                    </div>

                    <!-- REGISTER BUTTON -->

                    <div class="registerBtn">
                        <a href="register.php" class="registerPrimary">
                            <i class="fa-solid fa-user-plus"></i>
                            <span>Register</span>
                        </a>
                    </div>

                <?php } else { ?>

                    <!-- PROFILE BUTTON: LOGGED-IN USER -->

                    <div class="profileMenu">
                        <a href="profile.php" class="userProfileBtn">
                            <i class="fa-solid fa-user"></i>
                            <span class="userName">
                                <?php echo htmlspecialchars($username); ?>
                            </span>
                        </a>
                    </div>

                <?php } ?>

                <!-- MOBILE MENU -->

                <div class="menuToggle">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapsibleNavbar">

                        <span id="nav-icon2">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>

                    </button>
                </div>

            </div>

        </div>
    </div>
</header>

<!-- HEADER END -->