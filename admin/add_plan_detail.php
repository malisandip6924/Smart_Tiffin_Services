<?php
include("header.php");
include("connection.php");

if (isset($_POST['btninsert'])) {

    $planid = $_POST['plan_id'];
    $plandetail = $_POST['plan_details'];
    $day = $_POST['days'];
    $perday = $_POST['chargeperday'];
    $mealtype = $_POST['meal_type'];

    $phot = $_FILES['photo']['name'];
    $dst = './uploads/' . $phot;

    $q = mysqli_query(
        $con,
        "insert into plan_detail
        values ('','$planid','$plandetail','$day','$perday','$mealtype','$phot',1)"
    );

    if ($q) {

        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            $dst
        );

        echo "<script>
                alert('Plan Detail Inserted Successfully');
                window.location.href='view_plan_detail.php';
              </script>";

    } else {

        echo "<script>
                alert('Record Not Inserted');
              </script>";
    }
}
?>

<style>
    /* ================================
   PAGE
================================ */

    .plan-page {
        width: 100%;
        min-height: calc(100vh - 100px);
        padding: 30px;
        box-sizing: border-box;
        background: #fafafa;
    }


    /* ================================
   HEADING
================================ */

    .plan-title {
        text-align: center;
        margin-bottom: 25px;
    }

    .plan-title h2 {
        margin: 0;
        font-size: 28px;
        color: #292522;
    }

    .plan-title p {
        margin-top: 7px;
        color: #888;
        font-size: 14px;
    }


    /* ================================
   FORM CARD
================================ */

    .plan-form-card {

        width: 100%;
        max-width: 700px;

        margin: auto;

        background: white;

        padding: 30px;

        border-radius: 18px;

        border-top: 4px solid #ff8b2d;

        box-shadow:
            0 10px 30px rgba(0, 0, 0, 0.08);

    }


    /* ================================
   FORM HEADING
================================ */

    .plan-form-heading {

        display: flex;

        align-items: center;

        gap: 12px;

        padding-bottom: 18px;

        margin-bottom: 22px;

        border-bottom: 1px solid #eee;
    }

    .plan-icon {

        width: 45px;
        height: 45px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 12px;

        background: #fff4df;

        font-size: 22px;
    }

    .plan-form-heading h3 {

        margin: 0;

        font-size: 18px;

        color: #333;
    }

    .plan-form-heading span {

        display: block;

        margin-top: 4px;

        font-size: 12px;

        color: #999;
    }


    /* ================================
   FORM GRID
================================ */

    .plan-form {

        display: grid;

        grid-template-columns: repeat(2, 1fr);

        gap: 18px;
    }


    /* ================================
   FORM GROUP
================================ */

    .plan-group {

        margin-bottom: 5px;
    }

    .plan-group label {

        display: block;

        margin-bottom: 7px;

        font-size: 13px;

        font-weight: 600;

        color: #444;
    }


    /* ================================
   INPUTS
================================ */

    .plan-input {

        width: 100%;

        height: 45px;

        box-sizing: border-box;

        border: 1px solid #ddd;

        border-radius: 10px;

        padding: 0 12px;

        font-size: 13px;

        outline: none;

        background: #fafafa;

        transition: 0.3s;
    }

    .plan-input:focus {

        background: white;

        border-color: #ff8b2d;

        box-shadow:
            0 0 0 3px rgba(255, 139, 45, 0.10);
    }


    /* ================================
   FILE
================================ */

    .file-box {

        grid-column: span 2;
    }

    .file-input {

        width: 100%;

        padding: 10px;

        box-sizing: border-box;

        border: 1px dashed #ff9b35;

        border-radius: 10px;

        background: #fffaf2;
    }


    /* ================================
   TOTAL
================================ */

    .total-area {

        grid-column: span 2;

        background: #fff4e8;

        border: 1px solid #ffe0c0;

        padding: 15px 20px;

        border-radius: 10px;

        display: flex;

        justify-content: space-between;

        align-items: center;
    }

    .total-area span {

        font-size: 14px;

        color: #666;
    }

    .total-area strong {

        font-size: 20px;

        color: #ff6b35;
    }



    /* ================================
   BUTTON
================================ */

    .button-area {

        grid-column: span 2;

        display: flex;

        gap: 10px;

        margin-top: 10px;
    }

    .reset-btn {

        width: 100px;

        height: 45px;

        border: none;

        border-radius: 10px;

        background: #eee;

        color: #666;

        cursor: pointer;
    }

    .insert-btn {

        flex: 1;

        height: 45px;

        border: none;

        border-radius: 10px;

        background: linear-gradient(135deg,
                #ffae2f,
                #ff6336);

        color: white;

        font-size: 13px;

        font-weight: 600;

        cursor: pointer;

        box-shadow:
            0 7px 18px rgba(255, 104, 45, 0.22);

        transition: 0.3s;
    }

    .insert-btn:hover {

        transform: translateY(-2px);

        box-shadow:
            0 10px 24px rgba(255, 104, 45, 0.30);
    }


    /* ================================
   RESPONSIVE
================================ */

    @media(max-width:600px) {

        .plan-page {
            padding: 20px 12px;
        }

        .plan-form-card {
            padding: 22px;
        }

        .plan-form {
            grid-template-columns: 1fr;
        }

        .file-box,
        .total-area,
        .preview-area,
        .button-area {
            grid-column: span 1;
        }

        .button-area {
            flex-direction: column;
        }

        .reset-btn,
        .insert-btn {
            width: 100%;
        }

    }
</style>


<div class="plan-page">

    <!-- HEADING -->

    <div class="plan-title">

        <h2>Add Plan Detail</h2>

        <p>
            Add meal details and pricing for your tiffin plan
        </p>

    </div>


    <!-- CARD -->

    <div class="plan-form-card">


        <!-- FORM HEADING -->

        <div class="plan-form-heading">

            <div class="plan-icon">
                🍱
            </div>

            <div>

                <h3>Plan Detail Information</h3>

                <span>
                    Enter the details of your plan
                </span>

            </div>

        </div>


        <!-- FORM -->

        <form method="POST" enctype="multipart/form-data" class="plan-form">


            <!-- PLAN -->

            <div class="plan-group">

                <label>Select Plan</label>

                <select name="plan_id" class="plan-input" required>

                    <option value="">
                        Select Plan
                    </option>

                    <?php

                    $q = mysqli_query(
                        $con,
                        "SELECT * FROM plan_master"
                    );

                    while ($row = mysqli_fetch_array($q)) {

                        ?>

                        <option value="<?php echo $row[0]; ?>">

                            <?php echo $row[1]; ?>

                        </option>

                        <?php

                    }

                    ?>

                </select>

            </div>


            <!-- PLAN DETAIL -->

            <div class="plan-group">

                <label>Plan Details</label>

                <input type="text" name="plan_details" class="plan-input" placeholder="Enter plan details" required>

            </div>


            <!-- DAYS -->

            <div class="plan-group">

                <label>Number of Days</label>

                <input type="number" id="days" name="days" class="plan-input" placeholder="Enter days" min="1" required>

            </div>


            <!-- CHARGE -->

            <div class="plan-group">

                <label>Charge Per Day</label>

                <input type="number" id="chargeperday" name="chargeperday" class="plan-input" placeholder="Enter charge"
                    min="1" step="0.01" required>

            </div>


            <!-- MEAL TYPE -->

            <div class="plan-group">

                <label>Meal Type</label>

                <select name="meal_type" class="plan-input" required>

                    <option value="">
                        Select Meal Type
                    </option>

                    <option value="BreakFast">
                        Breakfast
                    </option>

                    <option value="Lunch">
                        Lunch
                    </option>

                    <option value="Dinner">
                        Dinner
                    </option>

                </select>

            </div>


            <!-- PHOTO -->

            <div class="plan-group file-box">

                <label>Plan Detail Photo</label>

                <input type="file" id="photo" name="photo" class="file-input" accept="image/*" required>

            </div>


            <!-- TOTAL -->

            <div class="total-area">

                <span>Total Plan Amount</span>

                <strong id="totalAmount">
                    ₹ 0
                </strong>

            </div>


            <!-- IMAGE PREVIEW -->



            <!-- BUTTON -->

            <div class="button-area">

                <button type="reset" class="reset-btn">

                    Reset

                </button>


                <button type="submit" name="btninsert" class="insert-btn">

                    + Add Plan Detail

                </button>

            </div>


        </form>

    </div>

</div>


<script>

    /* TOTAL CALCULATION */

    const daysInput =
        document.getElementById("days");

    const chargeInput =
        document.getElementById("chargeperday");

    const totalAmount =
        document.getElementById("totalAmount");


    function calculateTotal() {

        let days =
            parseFloat(daysInput.value) || 0;

        let charge =
            parseFloat(chargeInput.value) || 0;

        let total =
            days * charge;

        totalAmount.innerHTML =
            "₹ " + total.toFixed(2);
    }


    daysInput.addEventListener(
        "input",
        calculateTotal
    );

    chargeInput.addEventListener(
        "input",
        calculateTotal
    );



    /* RESET */

    document.querySelector(".reset-btn")
        .addEventListener(
            "click",
            function () {

                setTimeout(function () {

                    totalAmount.innerHTML =
                        "₹ 0";

                    imagePreview.src =
                        "";

                    imagePreview.style.display =
                        "none";

                    previewText.style.display =
                        "block";

                }, 50);

            }
        );

</script>


<?php
include("footer.php");
?>