<?php

include("header.php");
include("connection.php");


/* =========================================================
   GET ITEM ID
========================================================= */

if (!isset($_GET['item_id']) || empty($_GET['item_id'])) {

    echo "<script>
        alert('Invalid Item ID');
        window.location.href='view_item_master.php';
    </script>";

    exit;
}


$item_id = (int) $_GET['item_id'];


/* =========================================================
   FETCH ITEM DATA
========================================================= */

$stmt = mysqli_prepare(
    $con,
    "SELECT * FROM item_master WHERE item_id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $item_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);


if (!$result || mysqli_num_rows($result) == 0) {

    echo "<script>
        alert('Item not found');
        window.location.href='view_item_master.php';
    </script>";

    exit;
}


$row = mysqli_fetch_assoc($result);


/* =========================================================
   UPDATE ITEM
========================================================= */

if (isset($_POST['btnupdate'])) {


    /* GET FORM DATA */

    $item_name = trim($_POST['Item_name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = trim($_POST['price'] ?? '');


    /* VALIDATION */

    if ($item_name == '' || $description == '' || $price == '') {

        echo "<script>
            alert('Please fill all required fields');
        </script>";

    } elseif (!is_numeric($price) || $price < 1) {

        echo "<script>
            alert('Please enter a valid price');
        </script>";

    } else {


        $old_photo = $row['photo'];


        /* =====================================================
           CHECK IF NEW PHOTO IS SELECTED
        ===================================================== */

        if (
            isset($_FILES['photo']) &&
            $_FILES['photo']['error'] == UPLOAD_ERR_OK &&
            !empty($_FILES['photo']['name'])
        ) {


            $original_name = $_FILES['photo']['name'];

            $tmp_name = $_FILES['photo']['tmp_name'];

            $extension = strtolower(
                pathinfo(
                    $original_name,
                    PATHINFO_EXTENSION
                )
            );


            /* ALLOWED IMAGE TYPES */

            $allowed_extensions = [
                "jpg",
                "jpeg",
                "png",
                "webp"
            ];


            if (!in_array($extension, $allowed_extensions)) {

                echo "<script>
                    alert('Only JPG, JPEG, PNG and WEBP images are allowed!');
                </script>";

            } else {


                /* CREATE UNIQUE PHOTO NAME */

                $photo =
                    time() .
                    "_" .
                    uniqid() .
                    "." .
                    $extension;


                $upload_dir = "./uploads/";

                $destination =
                    $upload_dir . $photo;


                /* CREATE UPLOAD DIRECTORY IF NOT EXISTS */

                if (!is_dir($upload_dir)) {

                    mkdir(
                        $upload_dir,
                        0777,
                        true
                    );
                }


                /* MOVE NEW IMAGE FIRST */

                if (
                    move_uploaded_file(
                        $tmp_name,
                        $destination
                    )
                ) {


                    /* UPDATE DATABASE WITH PHOTO */

                    $update_stmt = mysqli_prepare(
                        $con,
                        "UPDATE item_master
                         SET
                            Item_name = ?,
                            description = ?,
                            price = ?,
                            photo = ?
                         WHERE item_id = ?"
                    );


                    mysqli_stmt_bind_param(
                        $update_stmt,
                        "ssdsi",
                        $item_name,
                        $description,
                        $price,
                        $photo,
                        $item_id
                    );


                    if (
                        mysqli_stmt_execute($update_stmt)
                    ) {


                        /* DELETE OLD PHOTO */

                        if (
                            !empty($old_photo) &&
                            file_exists(
                                "./uploads/" . $old_photo
                            )
                        ) {

                            unlink(
                                "./uploads/" . $old_photo
                            );
                        }


                        echo "<script>
                            alert('Item Updated Successfully');
                            window.location.href='view_item_master.php';
                        </script>";

                        exit;

                    } else {


                        /* DELETE NEW PHOTO IF DB UPDATE FAILS */

                        if (file_exists($destination)) {

                            unlink($destination);
                        }


                        echo "<script>
                            alert('Item Not Updated');
                        </script>";
                    }

                } else {

                    echo "<script>
                        alert('Image upload failed');
                    </script>";
                }

            }

        } else {


            /* =====================================================
               UPDATE WITHOUT CHANGING PHOTO
            ===================================================== */

            $update_stmt = mysqli_prepare(
                $con,
                "UPDATE item_master
                 SET
                    Item_name = ?,
                    description = ?,
                    price = ?
                 WHERE item_id = ?"
            );


            mysqli_stmt_bind_param(
                $update_stmt,
                "ssdi",
                $item_name,
                $description,
                $price,
                $item_id
            );


            if (
                mysqli_stmt_execute($update_stmt)
            ) {

                echo "<script>
                    alert('Item Updated Successfully');
                    window.location.href='view_item_master.php';
                </script>";

                exit;

            } else {

                echo "<script>
                    alert('Item Not Updated');
                </script>";
            }

        }

    }

}

?>


<style>
    /* =========================================================
   EDIT ITEM PAGE
========================================================= */

    .edit-item-page {

        width: 100%;

        padding: 25px 30px 60px;

        box-sizing: border-box;

        animation: editPageFade .6s ease;

    }


    /* =========================================================
   CARD
========================================================= */

    .edit-item-card {

        width: 100%;

        max-width: 900px;

        margin: 0 auto;

        background: #ffffff;

        padding: 30px;

        box-sizing: border-box;

        border-radius: 20px;

        position: relative;

        overflow: hidden;

        border: 1px solid #ffe2b8;

        box-shadow:
            0 15px 40px rgba(0, 0, 0, .09);

        animation: editCardSlide .7s ease;

    }


    /* TOP ORANGE LINE */

    .edit-item-card::before {

        content: "";

        position: absolute;

        top: 0;

        left: 0;

        width: 100%;

        height: 4px;

        background:
            linear-gradient(90deg,
                #ff9f1c,
                #ff6b35,
                #ffa21a);

        background-size: 200%;

        animation: gradientMove 4s linear infinite;

    }


    /* =========================================================
   HEADER
========================================================= */

    .edit-item-header {

        display: flex;

        align-items: center;

        gap: 14px;

        margin-bottom: 25px;

        padding-bottom: 18px;

        border-bottom: 1px solid #eeeeee;

    }


    .edit-item-icon {

        width: 52px;

        height: 52px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 15px;

        font-size: 24px;

        background:
            linear-gradient(135deg,
                #ffa21a,
                #ff6b35);

        box-shadow:
            0 8px 20px rgba(255, 150, 20, .25);

        animation: iconFloat 3s ease-in-out infinite;

    }


    .edit-item-header h2 {

        margin: 0;

        font-size: 23px;

        color: #302525;

    }


    .edit-item-header p {

        margin: 4px 0 0;

        font-size: 13px;

        color: #888888;

    }


    /* =========================================================
   FORM LAYOUT
========================================================= */

    .form-layout {

        width: 100%;

        display: grid;

        grid-template-columns:
            minmax(0, 1fr) minmax(0, 1fr);

        gap: 25px;

        box-sizing: border-box;

    }


    .form-column {

        width: 100%;

        min-width: 0;

        box-sizing: border-box;

    }


    /* =========================================================
   FORM GROUP
========================================================= */

    .edit-group {

        margin-bottom: 17px;

    }


    .edit-group label {

        display: block;

        margin-bottom: 7px;

        font-size: 13px;

        font-weight: 700;

        color: #403434;

    }


    /* =========================================================
   INPUT
========================================================= */

    .edit-input {

        width: 100%;

        height: 44px;

        padding: 11px 13px;

        box-sizing: border-box;

        border: 1px solid #e4dfdb;

        border-radius: 10px;

        outline: none;

        background: #fffdfa;

        font-size: 13px;

        transition: .3s;

    }


    .edit-input:hover {

        border-color: #ffc46b;

    }


    .edit-input:focus {

        border-color: #ffa21a;

        background: #ffffff;

        box-shadow:
            0 0 0 3px rgba(255, 162, 26, .12);

    }


    .item-id-box {

        background: #f5f4f3;

        color: #777777;

        cursor: not-allowed;

    }


    /* =========================================================
   DESCRIPTION
========================================================= */

    .edit-description {

        height: 120px;

        resize: vertical;

        line-height: 1.5;

    }


    /* =========================================================
   PRICE
========================================================= */

    .price-wrapper {

        position: relative;

    }


    .price-symbol {

        position: absolute;

        left: 14px;

        top: 50%;

        transform: translateY(-50%);

        font-weight: bold;

        color: #e98b00;

    }


    .price-input {

        padding-left: 32px;

    }


    /* =========================================================
   PHOTO SECTION
========================================================= */

    .photo-section {

        width: 100%;

        min-width: 0;

        display: flex;

        flex-direction: column;

        align-items: center;

        justify-content: center;

        text-align: center;

        min-height: 370px;

        padding: 20px;

        box-sizing: border-box;

        border-radius: 16px;

        background:
            linear-gradient(135deg,
                #fff9f0,
                #fffdf9);

        border: 1px solid #ffe2b8;

        transition: .3s;

    }


    .photo-section:hover {

        transform: translateY(-3px);

        box-shadow:
            0 10px 25px rgba(255, 162, 26, .13);

    }


    /* =========================================================
   IMAGE
========================================================= */

    .current-photo {

        width: 150px;

        height: 150px;

        object-fit: cover;

        border-radius: 18px;

        border: 4px solid #ffffff;

        box-shadow:
            0 8px 20px rgba(0, 0, 0, .13);

        margin-bottom: 15px;

        transition: .3s;

    }


    .current-photo:hover {

        transform:
            scale(1.06) rotate(2deg);

    }


    /* =========================================================
   PHOTO TEXT
========================================================= */

    .photo-info {

        width: 100%;

    }


    .photo-info strong {

        display: block;

        margin-bottom: 5px;

        color: #332727;

        font-size: 14px;

    }


    .photo-info span {

        display: block;

        margin-bottom: 14px;

        font-size: 12px;

        line-height: 1.5;

        color: #888888;

    }


    /* =========================================================
   FILE INPUT
========================================================= */

    .edit-file {

        width: 100%;

        max-width: 100%;

        padding: 9px;

        box-sizing: border-box;

        border: 1px dashed #ffb94e;

        border-radius: 10px;

        background: #fffaf2;

        font-size: 12px;

        cursor: pointer;

    }


    .edit-file::file-selector-button {

        border: none;

        padding: 7px 10px;

        border-radius: 7px;

        background: #ffe7c1;

        color: #d87900;

        font-weight: bold;

        cursor: pointer;

        margin-right: 8px;

    }


    /* =========================================================
   BUTTON AREA
========================================================= */

    .edit-button-area {

        display: flex;

        justify-content: flex-end;

        gap: 12px;

        margin-top: 22px;

        padding-top: 20px;

        border-top: 1px solid #eeeeee;

    }


    .cancel-btn {

        min-width: 130px;

        height: 44px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 10px;

        text-decoration: none;

        background: #f4f2f0;

        color: #665c58;

        font-size: 13px;

        font-weight: bold;

        transition: .3s;

    }


    .cancel-btn:hover {

        transform: translateY(-2px);

        background: #ebe7e4;

    }


    .update-btn {

        min-width: 160px;

        height: 44px;

        border: none;

        border-radius: 10px;

        background:
            linear-gradient(135deg,
                #ffa21a,
                #ff7a18);

        color: #ffffff;

        font-weight: bold;

        cursor: pointer;

        position: relative;

        overflow: hidden;

        transition: .3s;

        box-shadow:
            0 7px 18px rgba(255, 145, 20, .25);

    }


    .update-btn:hover {

        transform: translateY(-2px);

        box-shadow:
            0 12px 25px rgba(255, 145, 20, .35);

    }


    /* =========================================================
   ANIMATIONS
========================================================= */

    @keyframes editPageFade {

        from {

            opacity: 0;

        }

        to {

            opacity: 1;

        }

    }


    @keyframes editCardSlide {

        from {

            opacity: 0;

            transform:
                translateY(25px);

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


    @keyframes gradientMove {

        from {

            background-position: 0%;

        }

        to {

            background-position: 200%;

        }

    }


    /* =========================================================
   TABLET
========================================================= */

    @media screen and (max-width: 900px) {

        .edit-item-page {

            padding: 22px 20px 50px;

        }


        .edit-item-card {

            max-width: 700px;

            padding: 25px 22px;

        }


        .form-layout {

            grid-template-columns: 1fr;

        }


        .photo-section {

            min-height: auto;

        }

    }


    /* =========================================================
   MOBILE
========================================================= */

    @media screen and (max-width: 500px) {

        .edit-item-page {

            padding: 15px;

        }


        .edit-item-card {

            padding: 18px;

        }


        .edit-item-header h2 {

            font-size: 20px;

        }


        .edit-button-area {

            flex-direction: column-reverse;

        }


        .cancel-btn,
        .update-btn {

            width: 100%;

        }

    }
</style>


<!-- =========================================================
     IMPORTANT:
     page-body YAHAN NAHI BANANA HAI
     header.php already page-body open kar raha hai
========================================================= -->


<div class="edit-item-page">

    <div class="edit-item-card">


        <!-- HEADER -->

        <div class="edit-item-header">

            <div class="edit-item-icon">
                🍽️
            </div>


            <div>

                <h2>
                    Edit Food Item
                </h2>

                <p>
                    Update your food item details
                </p>

            </div>

        </div>


        <!-- FORM -->

        <form method="POST" enctype="multipart/form-data">


            <div class="form-layout">


                <!-- =============================================
                     LEFT COLUMN
                ============================================== -->

                <div class="form-column">


                    <!-- ITEM ID -->

                    <div class="edit-group">

                        <label>
                            Item ID
                        </label>

                        <input type="text" class="edit-input item-id-box"
                            value="<?php echo htmlspecialchars($row['item_id']); ?>" readonly>

                    </div>


                    <!-- ITEM NAME -->

                    <div class="edit-group">

                        <label>
                            Item Name
                        </label>

                        <input type="text" name="Item_name" class="edit-input"
                            value="<?php echo htmlspecialchars($row['item_name']); ?>" required>

                    </div>


                    <!-- PRICE -->

                    <div class="edit-group">

                        <label>
                            Price
                        </label>


                        <div class="price-wrapper">

                            <span class="price-symbol">
                                ₹
                            </span>


                            <input type="number" name="price" class="edit-input price-input"
                                value="<?php echo htmlspecialchars($row['price']); ?>" min="1" step="0.01" required>

                        </div>

                    </div>


                    <!-- DESCRIPTION -->

                    <div class="edit-group">

                        <label>
                            Description
                        </label>


                        <textarea name="description" class="edit-input edit-description"
                            required><?php echo htmlspecialchars($row['description']); ?></textarea>

                    </div>


                </div>


                <!-- =============================================
                     RIGHT COLUMN
                ============================================== -->

                <div class="form-column">


                    <div class="edit-group">

                        <label>
                            Item Photo
                        </label>


                        <div class="photo-section">


                            <?php

                            $photoPath =
                                './upload/' .$row['photo'];


                            if (

                                !empty($row['photo']) &&
                                file_exists($photoPath)

                            ) {

                                ?>


                                <img src="upload/<?php echo htmlspecialchars($row['photo']); ?>" class="current-photo"
                                    alt="Food Item">


                                <?php

                            } else {

                                ?>


                                <div class="current-photo" style="
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        font-size:35px;
                                        background:#fff0d7;
                                    ">

                                    🍽️

                                </div>


                                <?php

                            }

                            ?>


                            <div class="photo-info">


                                <strong>
                                    Current Item Image
                                </strong>


                                <span>
                                    Select a new image only if you want
                                    to replace the current photo.
                                </span>


                                <input type="file" name="photo" class="edit-file" accept=".jpg,.jpeg,.png,.webp">


                            </div>


                        </div>


                    </div>


                </div>


            </div>


            <!-- =============================================
                 BUTTONS
            ============================================== -->

            <div class="edit-button-area">


                <a href="view_item_master.php" class="cancel-btn">

                    ← Cancel

                </a>


                <button type="submit" name="btnupdate" class="update-btn">

                    ✓ Update Item

                </button>


            </div>


        </form>


    </div>

</div>


<?php

include("footer.php");

?>