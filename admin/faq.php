<?php
include('header.php');
include('connection.php');

if (isset($_POST["save"])) {

    $que = $_POST['que'];
    $ans = $_POST['ans'];

    $q = mysqli_query(
        $con,
        "insert into faq values('','$que','$ans')"
    );

    if ($q) {
        echo "<script>
                alert('FAQ added successfully!');
              </script>";
    } else {
        echo "<script>
                alert('FAQ not inserted!');
              </script>";
    }
}
?>

<style>
    /* =====================================================
   PAGE BACKGROUND
===================================================== */

    .faq-page {
        width: 100%;
        min-height: 100vh;

        box-sizing: border-box;

        padding: 40px 20px 70px;

        background:
            radial-gradient(circle at 10% 15%,
                rgba(255, 166, 45, 0.12),
                transparent 28%),
            radial-gradient(circle at 90% 85%,
                rgba(255, 99, 54, 0.10),
                transparent 28%),
            #f8f9fa;

        animation: pageFadeIn 0.6s ease;
    }


    /* =====================================================
   FORM CONTAINER
===================================================== */

    .faq-container {

        width: 550px;

        max-width: 100%;

        margin: 20px auto;

        padding: 35px;

        box-sizing: border-box;

        background: #ffffff;

        border-radius: 20px;

        border: 1px solid rgba(0, 0, 0, 0.05);

        box-shadow:
            0 10px 35px rgba(0, 0, 0, 0.08);

        animation: cardSlideUp 0.7s ease;

        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease;
    }


    .faq-container:hover {

        transform: translateY(-3px);

        box-shadow:
            0 16px 45px rgba(0, 0, 0, 0.12);
    }


    /* =====================================================
   HEADER
===================================================== */

    .faq-header {

        display: flex;

        align-items: center;

        gap: 14px;

        margin-bottom: 30px;
    }


    .faq-icon {

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


    .faq-title-area h2 {

        margin: 0;

        font-size: 26px;

        font-weight: 700;

        color: #292522;

        letter-spacing: -0.4px;
    }


    .faq-title-area p {

        margin: 5px 0 0;

        font-size: 13px;

        color: #96908b;
    }


    /* =====================================================
   FORM
===================================================== */

    .faq-form {

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


    .form-group label {

        margin-bottom: 8px;

        font-size: 14px;

        font-weight: 600;

        color: #3f3a36;
    }


    /* =====================================================
   INPUT
===================================================== */

    .form-group input[type="text"],
    .form-group textarea {

        width: 100%;

        box-sizing: border-box;

        padding: 14px 15px;

        border:

            1px solid #e5e5e5;

        border-radius: 10px;

        background: #fafafa;

        color: #333;

        font-size: 14px;

        font-family: inherit;

        outline: none;

        transition:

            border-color 0.25s ease,
            box-shadow 0.25s ease,
            background 0.25s ease;
    }


    .form-group input[type="text"]:focus,
    .form-group textarea:focus {

        background: #ffffff;

        border-color: #ff9f1c;

        box-shadow:
            0 0 0 4px rgba(255, 159, 28, 0.10);
    }


    .form-group input[type="text"]::placeholder,
    .form-group textarea::placeholder {

        color: #b0aaa5;
    }


    /* =====================================================
   TEXTAREA
===================================================== */

    .form-group textarea {

        min-height: 150px;

        resize: vertical;

        line-height: 1.6;
    }


    /* =====================================================
   SAVE BUTTON
===================================================== */

    .save {

        width: 100%;

        padding: 14px;

        border: none;

        border-radius: 11px;

        cursor: pointer;

        color: white;

        font-size: 15px;

        font-weight: 700;

        letter-spacing: 0.2px;

        background:
            linear-gradient(135deg,
                #ff9f1c,
                #ff6b35);

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
            0 12px 25px rgba(255, 107, 53, 0.35);
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

            transform: translateY(10px);
        }

        to {

            opacity: 1;

            transform: translateY(0);
        }
    }


    @keyframes cardSlideUp {

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

        .faq-page {

            padding: 25px 15px 50px;
        }


        .faq-container {

            padding: 25px 20px;

            margin: 10px auto;
        }


        .faq-title-area h2 {

            font-size: 22px;
        }


        .faq-icon {

            width: 45px;

            height: 45px;

            min-width: 45px;

            font-size: 21px;
        }
    }


    @media screen and (max-width: 480px) {

        .faq-container {

            padding: 20px 15px;

            border-radius: 15px;
        }


        .faq-header {

            gap: 10px;

            margin-bottom: 25px;
        }


        .faq-title-area h2 {

            font-size: 20px;
        }


        .faq-title-area p {

            font-size: 11px;
        }


        .form-group input[type="text"],
        .form-group textarea {

            padding: 12px;
        }

    }
</style>


<!-- =====================================================
     MAIN PAGE
===================================================== -->

<div class="faq-page">

    <div class="faq-container">


        <!-- HEADER -->

        <div class="faq-header">

            <div class="faq-icon">
                ❓
            </div>


            <div class="faq-title-area">

                <h2>
                    FAQ Master
                </h2>

                <p>
                    Add frequently asked questions and answers
                </p>

            </div>

        </div>


        <!-- FORM -->

        <form method="POST" class="faq-form">


            <!-- QUESTION -->

            <div class="form-group">

                <label for="que">
                    Question
                </label>

                <input type="text" id="que" name="que" placeholder="Enter your question" required>

            </div>


            <!-- ANSWER -->

            <div class="form-group">

                <label for="ans">
                    Answer
                </label>

                <textarea id="ans" name="ans" placeholder="Enter the answer" required></textarea>

            </div>


            <!-- SAVE -->

            <input type="submit" value="Save FAQ" class="save" name="save">


        </form>


    </div>

</div>


<?php
include('footer.php');
?>