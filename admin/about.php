<?php
include('header.php');
?>

<style>
    /* =====================================================
   ABOUT PAGE
===================================================== */

    .about-page {
        width: 100%;
        min-height: 100%;
        box-sizing: border-box;

        padding: 40px 20px 70px;

        background:
            radial-gradient(circle at 10% 10%,
                rgba(255, 166, 45, 0.10),
                transparent 28%),
            radial-gradient(circle at 90% 90%,
                rgba(255, 99, 54, 0.08),
                transparent 28%);

        animation: pageFadeIn 0.7s ease;
    }


    /* =====================================================
   FORM CONTAINER
===================================================== */

    .about-container {

        width: 100%;
        max-width: 620px;

        margin: 20px auto;

        padding: 35px;

        box-sizing: border-box;

        background: #ffffff;

        border-radius: 20px;

        border: 1px solid rgba(0, 0, 0, 0.05);

        box-shadow:
            0 10px 35px rgba(0, 0, 0, 0.08);

        animation: formSlideUp 0.7s ease;

        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease;
    }


    .about-container:hover {

        transform: translateY(-3px);

        box-shadow:
            0 18px 45px rgba(0, 0, 0, 0.12);
    }


    /* =====================================================
   HEADER
===================================================== */

    .about-header {

        display: flex;

        align-items: center;

        gap: 14px;

        margin-bottom: 30px;
    }


    /* ICON */

    .about-icon {

        width: 52px;
        height: 52px;

        min-width: 52px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 15px;

        font-size: 24px;

        background:
            linear-gradient(135deg,
                #ffae2f,
                #ff6336);

        box-shadow:
            0 8px 20px rgba(255, 112, 45, 0.22);

        animation: iconFloat 3s ease-in-out infinite;
    }


    /* TITLE */

    .about-title h2 {

        margin: 0;

        color: #292522;

        font-size: 25px;

        font-weight: 700;

        letter-spacing: -0.4px;
    }


    .about-title p {

        margin: 5px 0 0;

        color: #96908b;

        font-size: 13px;
    }


    /* =====================================================
   FORM
===================================================== */

    .about-container form {

        display: flex;

        flex-direction: column;
    }


    /* =====================================================
   FORM GROUP
===================================================== */

    .form-group {

        display: flex;

        flex-direction: column;

        margin-bottom: 22px;
    }


    /* LABEL */

    .form-group label {

        margin-bottom: 8px;

        font-size: 14px;

        font-weight: 600;

        color: #444;
    }


    /* =====================================================
   INPUT & TEXTAREA
===================================================== */

    .form-group input[type="text"],
    .form-group textarea {

        width: 100%;

        box-sizing: border-box;

        padding: 13px 15px;

        border:

            1px solid #e3e3e3;

        border-radius: 10px;

        background: #fafafa;

        color: #333;

        font-size: 14px;

        outline: none;

        transition:

            border-color 0.25s ease,
            box-shadow 0.25s ease,
            background 0.25s ease;
    }


    /* PLACEHOLDER */

    .form-group input::placeholder,
    .form-group textarea::placeholder {

        color: #aaa;
    }


    /* FOCUS */

    .form-group input[type="text"]:focus,
    .form-group textarea:focus {

        border-color: #ff9f1c;

        background: #ffffff;

        box-shadow:
            0 0 0 4px rgba(255, 159, 28, 0.10);
    }


    /* =====================================================
   TEXTAREA
===================================================== */

    .form-group textarea {

        height: 140px;

        resize: vertical;

        line-height: 1.6;
    }


    /* =====================================================
   FILE INPUT
===================================================== */

    .file-upload-wrapper {

        position: relative;
    }


    .form-group input[type="file"] {

        width: 100%;

        box-sizing: border-box;

        padding: 11px;

        border:

            1px dashed #ffae2f;

        border-radius: 10px;

        background: #fffaf2;

        color: #666;

        font-size: 13px;

        cursor: pointer;

        transition:

            background 0.25s ease,
            border-color 0.25s ease;
    }


    .form-group input[type="file"]:hover {

        background: #fff3df;

        border-color: #ff8c35;
    }


    .form-group input[type="file"]:focus {

        outline: none;

        box-shadow:
            0 0 0 4px rgba(255, 159, 28, 0.10);
    }


    /* =====================================================
   SAVE BUTTON
===================================================== */

    .save {

        width: 100%;

        padding: 14px 20px;

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

        letter-spacing: 0.2px;

        box-shadow:

            0 8px 20px rgba(255, 107, 53, 0.25);

        transition:

            transform 0.25s ease,
            box-shadow 0.25s ease,
            opacity 0.25s ease;
    }


    .save:hover {

        transform: translateY(-3px);

        box-shadow:

            0 12px 28px rgba(255, 107, 53, 0.35);
    }


    .save:active {

        transform: translateY(0);
    }


    /* =====================================================
   ANIMATIONS
===================================================== */

    @keyframes pageFadeIn {

        from {

            opacity: 0;

            transform: translateY(12px);
        }

        to {

            opacity: 1;

            transform: translateY(0);
        }
    }


    @keyframes formSlideUp {

        from {

            opacity: 0;

            transform: translateY(25px);
        }

        to {

            opacity: 1;

            transform: translateY(0);
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


    /* =====================================================
   RESPONSIVE
===================================================== */

    @media screen and (max-width: 768px) {

        .about-page {

            padding: 25px 15px 50px;
        }


        .about-container {

            padding: 25px 20px;

            margin: 10px auto;
        }


        .about-title h2 {

            font-size: 21px;
        }


        .about-title p {

            font-size: 12px;
        }


        .about-icon {

            width: 46px;
            height: 46px;

            min-width: 46px;

            font-size: 21px;
        }
    }


    @media screen and (max-width: 480px) {

        .about-header {

            gap: 10px;
        }


        .about-container {

            padding: 20px 15px;
        }


        .form-group {

            margin-bottom: 18px;
        }


        .save {

            padding: 13px;
        }
    }
</style>


<!-- =====================================================
     MAIN PAGE
===================================================== -->

<div class="about-page">

    <div class="about-container">


        <!-- PAGE HEADER -->

        <div class="about-header">

            <div class="about-icon">
                ℹ️
            </div>

            <div class="about-title">

                <h2>About Us</h2>

                <p>
                    Manage your about page information easily
                </p>

            </div>

        </div>


        <!-- FORM -->

        <form method="POST">


            <!-- TITLE -->

            <div class="form-group">

                <label for="title">

                    Title

                </label>

                <input type="text" id="title" name="title" placeholder="Enter Title" required>

            </div>


            <!-- DESCRIPTION -->

            <div class="form-group">

                <label for="desc">

                    Description

                </label>

                <textarea id="desc" name="desc" placeholder="Enter Description" required></textarea>

            </div>


            <!-- PHOTO -->

            <div class="form-group">

                <label for="photo">

                    Photo

                </label>

                <div class="file-upload-wrapper">

                    <input type="file" id="photo" name="photo" required>

                </div>

            </div>


            <!-- SAVE -->

            <input type="submit" value="Save About Information" class="save">


        </form>

    </div>

</div>


<?php
include('footer.php');
?>