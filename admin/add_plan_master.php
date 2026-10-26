<?php
include("header.php");
include("connection.php");

if (isset($_POST['btninsert'])) {

    $pname = $_POST["plan_name"];
    $desc = $_POST["description"];
    $phot = $_FILES["photo"]['name'];
    $dst = './upload/' . $phot;

    $q = mysqli_query($con, "insert into plan_master values('','$pname','$desc','$phot',1)");

    if ($q) {
        move_uploaded_file($_FILES['photo']['tmp_name'], $dst);
        echo "<script>alert('Record Inserted Successfully');</script>";
    } else {
        echo "<script>alert('Record Not Inserted');</script>";
    }
}
?>

<style>
/* =====================================================
   PAGE
===================================================== */

.plan-page {
    width: 100%;
    min-height: calc(150vh - 100px);
    padding: 20px 35px 50px;
    box-sizing: border-box;

    background:
        radial-gradient(circle at 10% 20%, rgba(255, 166, 77, 0.08), transparent 25%),
        radial-gradient(circle at 90% 80%, rgba(255, 103, 38, 0.07), transparent 25%),
        #fafaf8;

    display: flex;
    flex-direction: column;

    align-items: center;

    animation: pageFade 0.6s ease;
}


/* =====================================================
   PAGE ANIMATION
===================================================== */

@keyframes pageFade {

    from {
        opacity: 0;
        transform: translateY(15px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}


/* =====================================================
   PAGE HEADING
===================================================== */

.plan-title {
    text-align: center;
    margin-bottom: 50px;
}

.plan-title-icon {

    width: 58px;
    height: 58px;

    margin: 0 auto 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 17px;

    background: linear-gradient(135deg,
            #ff9f2f,
            #ff6633);

    font-size: 27px;

    box-shadow:
        0 10px 25px rgba(255, 112, 45, 0.25);

    animation: iconFloat 3s ease-in-out infinite;
}


@keyframes iconFloat {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-6px);
    }
}


.plan-title h2 {

    margin: 0;

    font-size: 28px;

    font-weight: 700;

    color: #292522;

    letter-spacing: -0.3px;
}


.plan-title p {

    margin: 7px 0 0;

    color: #96908b;

    font-size: 14px;
}


/* =====================================================
   FORM CARD
===================================================== */

.plan-form-card {

    width: 100%;
    max-width: 560px;

    background: #ffffff;

    border-radius: 20px;

    padding: 28px 34px 30px;

    box-sizing: border-box;

    border-top: 3px solid #ff8b2d;

    box-shadow:
        0 12px 35px rgba(40, 30, 20, 0.08);

    position: relative;

    overflow: hidden;

    animation: cardAnimation 0.7s ease;
}


@keyframes cardAnimation {

    from {
        opacity: 0;
        transform: translateY(30px) scale(0.97);
    }

    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}


/* Decorative glow */

.plan-form-card::before {

    content: "";

    position: absolute;

    width: 160px;
    height: 160px;

    background: rgba(255, 159, 47, 0.06);

    border-radius: 50%;

    top: -80px;
    right: -70px;

    pointer-events: none;
}


/* =====================================================
   FORM TOP SECTION
===================================================== */

.plan-form-heading {

    display: flex;

    align-items: center;

    gap: 15px;

    padding-bottom: 18px;

    margin-bottom: 22px;

    border-bottom: 1px solid #eeeeee;
}


.plan-form-heading-icon {

    width: 45px;
    height: 45px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 13px;

    background: #fff4df;

    color: #ff9f2f;

    font-size: 20px;

    transition: 0.3s ease;
}


.plan-form-heading:hover .plan-form-heading-icon {

    transform: rotate(-5deg) scale(1.05);

    background: #ffedd1;
}


.plan-form-heading h3 {

    margin: 0;

    font-size: 17px;

    font-weight: 700;

    color: #3a332f;
}


.plan-form-heading span {

    display: block;

    margin-top: 4px;

    font-size: 12px;

    color: #a19b96;
}


/* =====================================================
   FORM GROUP
===================================================== */

.plan-group {

    margin-bottom: 19px;
}


.plan-group label {

    display: block;

    margin-bottom: 8px;

    font-size: 13px;

    font-weight: 600;

    color: #403934;
}


.plan-group label::after {

    content: "";
}


/* =====================================================
   INPUT
===================================================== */

.plan-input,
.plan-textarea {

    width: 100%;

    box-sizing: border-box;

    border: 1px solid #dedede;

    background: #fafafa;

    border-radius: 11px;

    padding: 12px 14px;

    font-family: inherit;

    font-size: 13px;

    color: #333;

    outline: none;

    transition:
        border-color 0.3s ease,
        box-shadow 0.3s ease,
        background 0.3s ease,
        transform 0.3s ease;
}


.plan-input {

    height: 45px;
}


.plan-textarea {

    min-height: 100px;

    resize: vertical;
}


.plan-input::placeholder,
.plan-textarea::placeholder {

    color: #aaa;
}


.plan-input:hover,
.plan-textarea:hover {

    border-color: #ffb36a;
}


.plan-input:focus,
.plan-textarea:focus {

    background: #ffffff;

    border-color: #ff9b35;

    box-shadow:
        0 0 0 3px rgba(255, 155, 53, 0.10);

    transform: translateY(-1px);
}


/* =====================================================
   FILE UPLOAD
===================================================== */

.plan-file-box {

    width: 100%;

    box-sizing: border-box;

    border: 2px dashed #ffb34d;

    border-radius: 12px;

    background: #fffaf2;

    padding: 14px;

    text-align: center;

    transition: all 0.3s ease;

    cursor: pointer;
}


.plan-file-box:hover {

    background: #fff5e5;

    border-color: #ff8c20;

    transform: translateY(-2px);

    box-shadow:
        0 7px 18px rgba(255, 151, 45, 0.10);
}


.plan-file-icon {

    font-size: 22px;

    margin-bottom: 5px;
}


.plan-file-title {

    font-size: 13px;

    color: #555;

    font-weight: 600;
}


.plan-file-subtitle {

    font-size: 10px;

    color: #aaa;

    margin-top: 4px;
}


/* Actual file input */

.plan-file {

    width: 100%;

    margin-top: 10px;

    font-size: 12px;

    color: #777;

    cursor: pointer;
}


/* =====================================================
   BUTTON AREA
===================================================== */

.plan-button-area {

    display: flex;

    gap: 10px;

    margin-top: 5px;
}


/* Reset */

.plan-reset {

    width: 90px;

    border: none;

    border-radius: 10px;

    background: #f1f1f1;

    color: #777;

    font-size: 13px;

    font-weight: 600;

    cursor: pointer;

    transition: all 0.3s ease;
}


.plan-reset:hover {

    background: #e6e6e6;

    transform: translateY(-2px);
}


/* Submit */

.plan-submit {

    flex: 1;

    height: 45px;

    border: none;

    border-radius: 10px;

    background:
        linear-gradient(135deg,
            #ffae2f,
            #ff6336);

    color: white;

    font-size: 13px;

    font-weight: 700;

    cursor: pointer;

    box-shadow:
        0 7px 18px rgba(255, 104, 45, 0.22);

    transition: all 0.3s ease;

    position: relative;

    overflow: hidden;
}


/* Button shine */

.plan-submit::before {

    content: "";

    position: absolute;

    top: 0;

    left: -100%;

    width: 70%;

    height: 100%;

    background:
        linear-gradient(90deg,
            transparent,
            rgba(255, 255, 255, 0.30),
            transparent);

    transition: 0.6s;
}


.plan-submit:hover::before {

    left: 130%;
}


.plan-submit:hover {

    transform: translateY(-2px);

    box-shadow:
        0 10px 24px rgba(255, 104, 45, 0.30);
}


.plan-submit:active {

    transform: translateY(0);
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 100px) {

    .plan-page {

        padding: 25px 20px 70px;
    }

    .plan-form-card {

        max-width: 600px;
    }
}


@media (max-width: 600px) {

    .plan-page {

        padding: 20px 12px 60px;
    }

    .plan-title h2 {

        font-size: 23px;
    }

    .plan-form-card {

        padding: 23px 20px 25px;

        border-radius: 16px;
    }

    .plan-button-area {

        flex-direction: column;
    }

    .plan-reset {

        width: 100%;

        height: 42px;
    }
}
</style>


<div class="plan-page">

    <h2>Add Tiffin Plan</h2>

    <p>
        Create a new plan for your customers
    </p>


    <div class="plan-form-card">

        <div class="plan-form-heading">

            

            <div>

                <h3>Plan Details</h3>

                <span>
                    Enter the details of your tiffin plan
                </span>

            </div>

        </div>

        <form method="POST" enctype="multipart/form-data">

            <div class="plan-group">

                <label>
                    Plan Name
                </label>

                <input type="text" name="plan_name" class="plan-input" placeholder="Enter plan name">

            </div>

            <div class="plan-group">

                <label>
                    Description
                </label>

                <input type="text" name="description" class="plan-input" placeholder="Enter plan description">

            </div>


            <!-- PHOTO -->

            <div class="plan-group">

                <label>
                    Plan Photo
                </label>

                <div class="plan-file-box">

                    <input type="file" name="photo" class="plan-file">

                </div>

            </div>


            <!-- BUTTON -->

            <div class="plan-button-area">

                <button type="reset" class="plan-reset">
                    Reset
                </button>

                <button type="submit" name="btninsert" class="plan-submit">
                    Add Tiffin Plan
                </button>

            </div>


        </form>

    </div>

</div>


<?php
include("footer.php");
?>