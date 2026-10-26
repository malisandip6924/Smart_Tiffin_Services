<?php
include("header.php");
include("connection.php");

if (isset($_POST['btninsert'])) {

    $thali_name = $_POST["thali_name"];
    $desc = $_POST["description"];
    $thali_price = $_POST["thali_price"];
    $phot = $_FILES["photo"]['name'];

    $dst = './upload/' . $phot;

    $q = mysqli_query(
        $con,
        "insert into thali_master values('', '$thali_name', '$desc', '$thali_price', '$phot')"
    );

    if ($q) {

        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            $dst
        );

        echo "<script>
                alert('Special Thali Added Successfully');
              </script>";

    } else {

        echo "<script>
                alert('Special Thali Not Added');
              </script>";
    }
}
?>


<style>
    /* PAGE */

    .simple-thali-page {
        padding: 40px 20px;
    }


    /* HEADING */

    .simple-thali-title {
        text-align: center;
        margin-bottom: 30px;
    }

    .simple-thali-title h2 {
        margin: 0;
        font-size: 30px;
        color: #333;
    }

    .simple-thali-title p {
        color: #888;
        font-size: 14px;
    }


    /* FORM CARD */

    .simple-thali-card {

        max-width: 650px;

        margin: auto;

        background: white;

        padding: 30px;

        border-radius: 15px;

        box-shadow:
            0 5px 25px rgba(0, 0, 0, 0.10);

        border-top: 5px solid #ff8c32;
    }


    /* FORM GROUP */

    .simple-group {
        margin-bottom: 20px;
    }


    /* LABEL */

    .simple-group label {

        display: block;

        margin-bottom: 8px;

        font-weight: 600;

        color: #444;

        font-size: 14px;
    }


    /* INPUT */

    .simple-group input {

        width: 100%;

        height: 45px;

        box-sizing: border-box;

        padding: 10px 12px;

        border: 1px solid #ddd;

        border-radius: 8px;

        outline: none;

        font-size: 14px;

        transition: 0.3s;
    }


    .simple-group input:focus {

        border-color: #ff8c32;

        box-shadow:
            0 0 0 3px rgba(255, 140, 50, 0.12);
    }


    /* FILE INPUT */

    .simple-group input[type="file"] {

        height: auto;

        padding: 12px;

        background: #fafafa;
    }


    /* BUTTON AREA */

    .simple-button-area {

        display: flex;

        justify-content: flex-end;

        gap: 10px;

        margin-top: 25px;
    }


    /* RESET */

    .simple-reset {

        padding: 12px 25px;

        border: none;

        border-radius: 7px;

        background: #e5e5e5;

        color: #555;

        cursor: pointer;

        font-size: 14px;
    }


    .simple-reset:hover {
        background: #d5d5d5;
    }


    /* SUBMIT */

    .simple-submit {

        padding: 12px 25px;

        border: none;

        border-radius: 7px;

        background: #ff7a2f;

        color: white;

        cursor: pointer;

        font-size: 14px;

        font-weight: 600;

        transition: 0.3s;
    }


    .simple-submit:hover {

        background: #e8661f;

        transform: translateY(-2px);
    }


    /* MOBILE */

    @media(max-width:600px) {

        .simple-thali-page {
            padding: 25px 12px;
        }

        .simple-thali-card {
            padding: 20px;
        }

        .simple-button-area {
            flex-direction: column;
        }

        .simple-reset,
        .simple-submit {
            width: 100%;
        }

    }
</style>


<div class="simple-thali-page">


    <!-- PAGE TITLE -->

    <div class="simple-thali-title">

        <h2>🍛 Add Special Thali</h2>

        <p>
            Add a new delicious thali to your tiffin service
        </p>

    </div>


    <!-- FORM CARD -->

    <form method="POST" enctype="multipart/form-data" class="simple-thali-card">


        <!-- THALI NAME -->

        <div class="simple-group">

            <label>
                Thali Name *
            </label>

            <input type="text" name="thali_name" placeholder="Enter thali name" required>

        </div>


        <!-- DESCRIPTION -->

        <div class="simple-group">

            <label>
                Description *
            </label>

            <input type="text" name="description" placeholder="Enter thali description" required>

        </div>


        <!-- PRICE -->

        <div class="simple-group">

            <label>
                Thali Price *
            </label>

            <input type="number" name="thali_price" placeholder="Enter thali price" required>

        </div>


        <!-- PHOTO -->

        <div class="simple-group">

            <label>
                Thali Photo *
            </label>

            <input type="file" name="photo" accept="image/*" required>

        </div>


        <!-- BUTTONS -->

        <div class="simple-button-area">

            <button type="reset" class="simple-reset">
                Reset
            </button>


            <button type="submit" name="btninsert" class="simple-submit">
                Add Special Thali
            </button>

        </div>


    </form>


</div>


<?php
include("footer.php");
?>