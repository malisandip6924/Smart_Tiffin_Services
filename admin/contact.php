<?php
include('header.php');
?>

<style>
    /* =====================================================
   CONTACT PAGE
===================================================== */

    .contact-page {

        width: 100%;
        min-height: 100vh;

        display: flex;

        align-items: center;
        justify-content: center;

        padding: 50px 20px;

        box-sizing: border-box;

        background:
            radial-gradient(circle at 10% 20%,
                rgba(255, 159, 28, 0.12),
                transparent 30%),
            radial-gradient(circle at 90% 80%,
                rgba(255, 107, 53, 0.10),
                transparent 30%),
            #f8f9fa;
    }


    /* =====================================================
   CONTACT CARD
===================================================== */

    .contact-container {

        width: 500px;

        max-width: 100%;

        box-sizing: border-box;

        padding: 38px;

        background: #ffffff;

        border-radius: 20px;

        border: 1px solid rgba(0, 0, 0, 0.05);

        box-shadow:
            0 15px 45px rgba(0, 0, 0, 0.10);

        animation:
            contactCardIn 0.7s ease forwards;

        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease;
    }


    .contact-container:hover {

        transform: translateY(-4px);

        box-shadow:
            0 22px 55px rgba(0, 0, 0, 0.13);
    }


    /* =====================================================
   HEADER
===================================================== */

    .contact-header {

        text-align: center;

        margin-bottom: 30px;
    }


    /* ICON */

    .contact-icon {

        width: 58px;
        height: 58px;

        margin: 0 auto 14px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 16px;

        font-size: 26px;

        background:
            linear-gradient(135deg,
                #ff9f1c,
                #ff6b35);

        box-shadow:
            0 8px 22px rgba(255, 107, 53, 0.25);

        animation:
            iconFloat 3s ease-in-out infinite;
    }


    /* TITLE */

    .contact-header h2 {

        margin: 0;

        color: #252525;

        font-size: 27px;

        font-weight: 700;

        letter-spacing: -0.4px;
    }


    /* SUBTITLE */

    .contact-header p {

        margin: 7px 0 0;

        color: #8a8a8a;

        font-size: 13px;
    }


    /* =====================================================
   FORM
===================================================== */

    .contact-form {

        display: flex;

        flex-direction: column;
    }


    /* FORM GROUP */

    .form-group {

        margin-bottom: 20px;

        animation:
            fieldFade 0.6s ease both;
    }


    .form-group:nth-child(1) {

        animation-delay: 0.1s;
    }


    .form-group:nth-child(2) {

        animation-delay: 0.2s;
    }


    .form-group:nth-child(3) {

        animation-delay: 0.3s;
    }


    /* LABEL */

    .form-group label {

        display: block;

        margin-bottom: 8px;

        font-size: 13px;

        font-weight: 600;

        color: #444;
    }


    /* INPUT + TEXTAREA */

    .form-group input[type="text"],
    .form-group textarea {

        width: 100%;

        box-sizing: border-box;

        padding: 13px 14px;

        border:
            1px solid #e1e1e1;

        border-radius: 10px;

        background: #fafafa;

        color: #333;

        font-size: 14px;

        outline: none;

        transition:
            border-color 0.25s ease,
            box-shadow 0.25s ease,
            background 0.25s ease,
            transform 0.25s ease;
    }


    /* PLACEHOLDER */

    .form-group input::placeholder,
    .form-group textarea::placeholder {

        color: #b0b0b0;
    }


    /* FOCUS */

    .form-group input[type="text"]:focus,
    .form-group textarea:focus {

        border-color: #ff9f1c;

        background: #ffffff;

        box-shadow:
            0 0 0 4px rgba(255, 159, 28, 0.10);

        transform: translateY(-1px);
    }


    /* TEXTAREA */

    .form-group textarea {

        height: 125px;

        resize: vertical;
    }


    /* =====================================================
   SAVE BUTTON
===================================================== */

    .contact_save {

        width: 100%;

        padding: 14px;

        border: none;

        border-radius: 11px;

        background:
            linear-gradient(135deg,
                #ff9f1c,
                #ff6b35);

        color: #ffffff;

        font-size: 15px;

        font-weight: 700;

        cursor: pointer;

        box-shadow:
            0 7px 18px rgba(255, 107, 53, 0.22);

        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease,
            opacity 0.25s ease;

        animation:
            buttonFade 0.7s ease both;

        animation-delay: 0.4s;
    }


    .contact_save:hover {

        transform: translateY(-3px);

        box-shadow:
            0 11px 25px rgba(255, 107, 53, 0.32);
    }


    .contact_save:active {

        transform: translateY(0);
    }


    /* =====================================================
   ANIMATIONS
===================================================== */

    @keyframes contactCardIn {

        from {

            opacity: 0;

            transform:
                translateY(30px) scale(0.98);
        }

        to {

            opacity: 1;

            transform:
                translateY(0) scale(1);
        }
    }


    @keyframes fieldFade {

        from {

            opacity: 0;

            transform:
                translateX(-15px);
        }

        to {

            opacity: 1;

            transform:
                translateX(0);
        }
    }


    @keyframes buttonFade {

        from {

            opacity: 0;

            transform:
                translateY(15px);
        }

        to {

            opacity: 1;

            transform:
                translateY(0);
        }
    }


    @keyframes iconFloat {

        0%,
        100% {

            transform:
                translateY(0);
        }

        50% {

            transform:
                translateY(-5px);
        }
    }


    /* =====================================================
   RESPONSIVE
===================================================== */

    @media screen and (max-width: 600px) {

        .contact-page {

            padding: 30px 15px;
        }


        .contact-container {

            padding: 28px 20px;

            border-radius: 16px;
        }


        .contact-header h2 {

            font-size: 23px;
        }


        .contact-icon {

            width: 52px;
            height: 52px;

            font-size: 23px;
        }

    }
</style>


<!-- =====================================================
     CONTACT PAGE
===================================================== -->

<div class="contact-page">

    <div class="contact-container">


        <!-- HEADER -->

        <div class="contact-header">

            <div class="contact-icon">
                📞
            </div>

            <h2>Contact Us</h2>

            <p>
                Please enter your contact details below
            </p>

        </div>


        <!-- FORM -->

        <form method="POST" class="contact-form">


            <!-- NAME -->

            <div class="form-group">

                <label for="uname">
                    Name
                </label>

                <input type="text" id="uname" name="uname" placeholder="Enter your name" required>

            </div>


            <!-- MOBILE -->

            <div class="form-group">

                <label for="mob">
                    Mobile Number
                </label>

                <input type="text" id="mob" name="mob" placeholder="Enter your mobile number" required>

            </div>


            <!-- ADDRESS -->

            <div class="form-group">

                <label for="address">
                    Address
                </label>

                <textarea id="address" name="address" placeholder="Enter your address" required></textarea>

            </div>


            <!-- SAVE BUTTON -->

            <input type="submit" value="Save Contact" class="contact_save">


        </form>


    </div>

</div>


<?php
include('footer.php');
?>