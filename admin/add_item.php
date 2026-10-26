<?php
include("header.php");
include("connection.php");

if (isset($_POST['btninsert'])) {

    $iname = $_POST["Item_name"];
    $desc = $_POST["description"];
    $price = $_POST["price"];
    $phot = $_FILES["photo"]['name'];
    $dst = './uploads/' . $phot;

    $q = mysqli_query(
        $con,
        "insert into item_master values('','$iname','$desc','$price','$phot')"
    );

    if ($q) {

        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            $dst
        );

        echo "<script>
                alert('Record Inserted Successfully');
              </script>";

    } else {

        echo "<script>
                alert('Record Not Inserted');
              </script>";
    }
}
?>


<style>
    /* =====================================
   ADD ITEM PAGE
===================================== */

    .item-page {
        min-height: calc(100vh - 100px);
        padding: 35px 20px 60px;
        box-sizing: border-box;

        background:
            radial-gradient(circle at top left,
                rgba(255, 153, 51, 0.08),
                transparent 30%),
            #fafafa;
    }


    /* =====================================
   PAGE HEADING
===================================== */

    .item-page-heading {
        text-align: center;
        margin-bottom: 30px;
    }

    .item-page-heading .badge {
        display: inline-block;

        padding: 7px 15px;

        margin-bottom: 12px;

        border-radius: 25px;

        background: #fff3e5;

        color: #f07818;

        font-size: 12px;

        font-weight: 600;
    }

    .item-page-heading h1 {
        margin: 0;

        color: #2d2926;

        font-size: 32px;

        font-weight: 700;
    }

    .item-page-heading p {
        margin: 8px 0 0;

        color: #8e8782;

        font-size: 14px;
    }


    /* =====================================
   FORM CARD
===================================== */

    .item-form-card {

        width: 100%;
        max-width: 650px;

        margin: auto;

        background: #ffffff;

        border-radius: 20px;

        overflow: hidden;

        border: 1px solid #eee7e1;

        box-shadow:
            0 15px 40px rgba(0, 0, 0, 0.07);
    }


    /* TOP COLOR LINE */

    .item-card-accent {

        height: 5px;

        background: linear-gradient(90deg,
                #ffad32,
                #ff7138);
    }


    /* =====================================
   CARD HEADER
===================================== */

    .item-card-header {

        display: flex;

        align-items: center;

        gap: 15px;

        padding: 25px 30px;

        border-bottom: 1px solid #f0ebe7;
    }


    .item-header-icon {

        width: 52px;
        height: 52px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 15px;

        font-size: 24px;

        background: linear-gradient(135deg,
                #ffb437,
                #ff7138);

        box-shadow:
            0 8px 18px rgba(255, 112, 56, 0.20);
    }


    .item-header-text h3 {

        margin: 0;

        color: #332d29;

        font-size: 19px;

        font-weight: 700;
    }


    .item-header-text p {

        margin: 5px 0 0;

        color: #9a9089;

        font-size: 13px;
    }


    /* =====================================
   FORM
===================================== */

    .item-form {

        padding: 30px;
    }


    /* =====================================
   FORM GROUP
===================================== */

    .item-group {

        margin-bottom: 22px;
    }


    .item-group label {

        display: block;

        margin-bottom: 8px;

        color: #423a35;

        font-size: 13px;

        font-weight: 600;
    }


    .item-group label span {

        color: #ff6336;
    }


    /* =====================================
   INPUT
===================================== */

    .item-input {

        width: 100%;

        height: 50px;

        padding: 0 15px;

        box-sizing: border-box;

        border: 1px solid #e1dbd6;

        border-radius: 12px;

        background: #ffffff;

        font-size: 14px;

        color: #403832;

        outline: none;

        transition: 0.3s;
    }


    .item-input::placeholder {

        color: #b5aca6;
    }


    .item-input:focus {

        border-color: #ff941f;

        box-shadow:
            0 0 0 4px rgba(255, 148, 31, 0.10);
    }


    /* =====================================
   FILE UPLOAD
===================================== */

    .file-box {

        padding: 16px;

        border: 2px dashed #ecd9c9;

        border-radius: 13px;

        background: #fffaf6;

        transition: 0.3s;
    }


    .file-box:hover {

        border-color: #ff982b;

        background: #fff7ef;
    }


    .item-file {

        width: 100%;

        font-size: 13px;

        color: #777;

        cursor: pointer;
    }


    .item-file::file-selector-button {

        padding: 9px 16px;

        margin-right: 10px;

        border: none;

        border-radius: 8px;

        background: #ffe8cf;

        color: #e87920;

        font-weight: 600;

        cursor: pointer;
    }


    /* =====================================
   BUTTONS
===================================== */

    .item-button-area {

        display: flex;

        justify-content: flex-end;

        gap: 12px;

        margin-top: 30px;

        padding-top: 22px;

        border-top: 1px solid #eee8e3;
    }


    .item-reset {

        height: 48px;

        padding: 0 25px;

        border: 1px solid #ded7d2;

        border-radius: 11px;

        background: #f7f5f3;

        color: #777;

        font-size: 14px;

        font-weight: 600;

        cursor: pointer;

        transition: 0.3s;
    }


    .item-reset:hover {

        background: #eeeeee;

        transform: translateY(-2px);
    }


    .item-submit {

        height: 48px;

        padding: 0 28px;

        border: none;

        border-radius: 11px;

        background: linear-gradient(135deg,
                #ffad32,
                #ff6638);

        color: white;

        font-size: 14px;

        font-weight: 600;

        cursor: pointer;

        box-shadow:
            0 8px 20px rgba(255, 102, 56, 0.20);

        transition: 0.3s;
    }


    .item-submit:hover {

        transform: translateY(-3px);

        box-shadow:
            0 12px 25px rgba(255, 102, 56, 0.28);
    }


    /* =====================================
   RESPONSIVE
===================================== */

    @media(max-width:600px) {

        .item-page {
            padding: 25px 12px 50px;
        }

        .item-page-heading h1 {
            font-size: 26px;
        }

        .item-card-header {
            padding: 20px;
        }

        .item-form {
            padding: 22px 18px;
        }

        .item-button-area {
            flex-direction: column;
        }

        .item-reset,
        .item-submit {
            width: 100%;
        }

    }
</style>


<div class="item-page">


    <!-- PAGE HEADING -->

    <div class="item-page-heading">

        <div class="badge">
            🍽️ ITEM MANAGEMENT
        </div>

        <h1>
            Add Food Item
        </h1>

        <p>
            Create a new food item for your tiffin menu
        </p>

    </div>



    <!-- FORM CARD -->

    <div class="item-form-card">


        <div class="item-card-accent"></div>


        <!-- CARD HEADER -->

        <div class="item-card-header">

            <div class="item-header-icon">
                🍽️
            </div>


            <div class="item-header-text">

                <h3>
                    Item Information
                </h3>

                <p>
                    Enter the details of your food item
                </p>

            </div>

        </div>



        <!-- FORM -->

        <form method="POST" enctype="multipart/form-data" class="item-form">


            <!-- ITEM NAME -->

            <div class="item-group">

                <label>
                    Item Name <span>*</span>
                </label>

                <input type="text" name="Item_name" class="item-input" placeholder="Enter item name" required>

            </div>



            <!-- DESCRIPTION -->

            <div class="item-group">

                <label>
                    Description <span>*</span>
                </label>

                <input type="text" name="description" class="item-input" placeholder="Enter item description" required>

            </div>



            <!-- PRICE -->

            <div class="item-group">

                <label>
                    Price <span>*</span>
                </label>

                <input type="text" name="price" class="item-input" placeholder="₹ Enter item price" required>

            </div>



            <!-- PHOTO -->

            <div class="item-group">

                <label>
                    Item Photo <span>*</span>
                </label>

                <div class="file-box">

                    <input type="file" name="photo" class="item-file" accept="image/*" required>

                </div>

            </div>



            <!-- BUTTONS -->

            <div class="item-button-area">

                <button type="reset" class="item-reset">
                    Reset
                </button>


                <button type="submit" name="btninsert" class="item-submit">
                    Add Item
                </button>

            </div>


        </form>


    </div>


</div>


<?php
include("footer.php");
?>