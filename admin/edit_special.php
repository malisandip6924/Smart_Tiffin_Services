<?php

include("header.php");
include("connection.php");


// ========================================
// GET THALI ID
// ========================================

if (!isset($_GET['thali_id']) || empty($_GET['thali_id'])) {

    echo "<script>
            window.location.assign('view_special_thali.php');
          </script>";

    exit();
}


$tid = intval($_GET['thali_id']);


// ========================================
// FETCH THALI DATA
// ========================================

$get = mysqli_query(
    $con,
    "SELECT * FROM thali_master WHERE thali_id='$tid'"
);


$row = mysqli_fetch_assoc($get);


// ========================================
// RECORD NOT FOUND
// ========================================

if (!$row) {

    echo "<script>
            alert('Thali record not found!');
            window.location.assign('view_special_thali.php');
          </script>";

    exit();
}


// ========================================
// UPDATE THALI
// ========================================

if (isset($_POST['btnupdate'])) {


    $tid = intval($_POST['thali_id']);


    $tname = mysqli_real_escape_string(
        $con,
        trim($_POST['thali_name'])
    );


    $desc = mysqli_real_escape_string(
        $con,
        trim($_POST['description'])
    );


    $price = mysqli_real_escape_string(
        $con,
        trim($_POST['thali_price'])
    );


    // ====================================
    // VALIDATION
    // ====================================

    if (empty($tname)) {

        echo "<script>
                alert('Please enter thali name!');
              </script>";

    } elseif (empty($desc)) {

        echo "<script>
                alert('Please enter description!');
              </script>";

    } elseif ($price <= 0) {

        echo "<script>
                alert('Please enter valid thali price!');
              </script>";

    } else {


        // ====================================
        // OLD PHOTO
        // ====================================

        $old_photo = $row['photo'];


        // ====================================
        // NEW PHOTO SELECTED
        // ====================================

        if (

            isset($_FILES['photo']) &&

            $_FILES['photo']['error'] == 0 &&

            !empty($_FILES['photo']['name'])

        ) {


            $original_name = $_FILES['photo']['name'];

            $tmp_name = $_FILES['photo']['tmp_name'];

            $file_size = $_FILES['photo']['size'];


            // ====================================
            // GET EXTENSION
            // ====================================

            $extension = strtolower(

                pathinfo(
                    $original_name,
                    PATHINFO_EXTENSION
                )

            );


            // ====================================
            // ALLOWED EXTENSIONS
            // ====================================

            $allowed_extensions = [

                "jpg",
                "jpeg",
                "png",
                "webp"

            ];


            // ====================================
            // CHECK EXTENSION
            // ====================================

            if (!in_array($extension, $allowed_extensions)) {

                echo "<script>
                        alert('Only JPG, JPEG, PNG and WEBP images are allowed!');
                      </script>";

            }


            // ====================================
            // CHECK FILE SIZE
            // ====================================
            elseif ($file_size > 5 * 1024 * 1024) {

                echo "<script>
                        alert('Image size must be less than 5 MB!');
                      </script>";

            } else {


                // ====================================
                // CREATE UPLOAD FOLDER
                // ====================================

                if (!is_dir("uploads")) {

                    mkdir(
                        "uploads",
                        0777,
                        true
                    );

                }


                // ====================================
                // GENERATE UNIQUE PHOTO NAME
                // ====================================

                $photo_name =

                    time()
                    . "_"
                    . uniqid()
                    . "."
                    . $extension;


                $dst = "uploads/" . $photo_name;


                // ====================================
                // UPLOAD NEW IMAGE FIRST
                // ====================================

                if (move_uploaded_file($tmp_name, $dst)) {


                    // ====================================
                    // UPDATE DATABASE
                    // ====================================

                    $q = mysqli_query(

                        $con,

                        "UPDATE thali_master SET

                            thali_name='$tname',

                            description='$desc',

                            thali_price='$price',

                            photo='$photo_name'

                        WHERE thali_id='$tid'"

                    );


                    if ($q) {


                        // ====================================
                        // DELETE OLD PHOTO
                        // ====================================

                        if (

                            !empty($old_photo)

                            &&

                            file_exists(
                                "uploads/" . $old_photo
                            )

                        ) {

                            unlink(
                                "uploads/" . $old_photo
                            );

                        }


                        echo "<script>

                                alert('Thali updated successfully!');

                                window.location.assign(
                                    'view_special_thali.php'
                                );

                              </script>";

                        exit();

                    } else {


                        // DELETE NEW FILE IF DB FAILED

                        if (file_exists($dst)) {

                            unlink($dst);

                        }


                        echo "<script>
                                alert('Database update failed!');
                              </script>";

                    }


                } else {

                    echo "<script>
                            alert('Image upload failed!');
                          </script>";

                }


            }


        }


        // ====================================
        // PHOTO NOT CHANGED
        // ====================================
        else {


            $q = mysqli_query(

                $con,

                "UPDATE thali_master SET

                    thali_name='$tname',

                    description='$desc',

                    thali_price='$price'

                WHERE thali_id='$tid'"

            );


            if ($q) {


                echo "<script>

                        alert('Thali updated successfully!');

                        window.location.assign(
                            'view_special_thali.php'
                        );

                      </script>";

                exit();


            } else {


                echo "<script>
                        alert('Update failed!');
                      </script>";

            }


        }


    }


}

?>


<style>
    /* =========================================
   HORIZONTAL EDIT THALI LAYOUT
========================================= */

    .thali-main-wrapper,
    .thali-main-wrapper * {
        box-sizing: border-box;
    }


    .thali-main-wrapper {

        width: 100%;

        margin: 0;

        padding: 0;

    }


    /* =========================================
   PAGE
========================================= */

    .thali-edit-page {

        width: 100%;

        min-height: calc(100vh - 150px);

        padding: 35px 30px 70px;

        display: flex;

        justify-content: center;

    }


    /* =========================================
   MAIN CARD
========================================= */

    .thali-edit-card {

        width: 100%;

        max-width: 1150px !important;

        background: #ffffff;

        border-radius: 22px;

        padding: 35px 40px;

        border: 1px solid rgba(255, 162, 26, 0.18);

        box-shadow:
            0 18px 50px rgba(45, 25, 15, 0.10);

        position: relative;

        overflow: hidden;

    }


    /* TOP BORDER */

    .thali-edit-card::before {

        content: "";

        position: absolute;

        top: 0;

        left: 0;

        width: 100%;

        height: 5px;

        background:

            linear-gradient(90deg,
                #ff9f1c,
                #ff6b35,
                #ffa21a,
                #ff9f1c);

    }


    /* =========================================
   HEADER
========================================= */

    .thali-edit-header {

        display: flex;

        align-items: center;

        gap: 16px;

        margin-bottom: 30px;

        padding-bottom: 22px;

        border-bottom: 1px solid #eeeeee;

    }


    .thali-edit-icon {

        width: 58px;

        height: 58px;

        min-width: 58px;

        border-radius: 18px;

        background:

            linear-gradient(135deg,
                #ffa21a,
                #ff6b35);

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 28px;

    }


    .thali-edit-header h2 {

        margin: 0;

        color: #2c2020;

        font-size: 26px;

        font-weight: 800;

    }


    .thali-edit-header p {

        margin: 5px 0 0;

        color: #8d817d;

        font-size: 14px;

    }


    /* =========================================
   TWO COLUMN HORIZONTAL FORM
========================================= */

    .thali-form-grid {

        display: grid;

        grid-template-columns:

            minmax(0, 1.2fr) minmax(320px, 0.8fr);

        gap: 35px;

        align-items: start;

    }


    /* =========================================
   FORM
========================================= */

    .form-group {

        margin-bottom: 20px;

    }


    .form-group label {

        display: block;

        margin-bottom: 8px;

        color: #352727;

        font-size: 14px;

        font-weight: 700;

    }


    .form-control {

        width: 100% !important;

        padding: 13px 15px;

        border: 1px solid #e5dfdb;

        border-radius: 12px;

        background: #fffdfa;

        color: #332a2a;

        font-size: 14px;

        outline: none;

    }


    .form-control:focus {

        border-color: #ffa21a;

        background: #ffffff;

        box-shadow:

            0 0 0 4px rgba(255, 162, 26, 0.12);

    }


    .form-control[readonly] {

        background: #f5f4f3;

        color: #777;

        cursor: not-allowed;

    }


    /* TEXTAREA */

    textarea.form-control {

        min-height: 160px;

        resize: vertical;

        line-height: 1.6;

    }


    /* =========================================
   PRICE
========================================= */

    .price-wrapper {

        position: relative;

        width: 100%;

    }


    .price-symbol {

        position: absolute;

        left: 16px;

        top: 50%;

        transform: translateY(-50%);

        color: #f08b00;

        font-size: 17px;

        font-weight: 800;

        z-index: 2;

    }


    .price-input {

        padding-left: 40px !important;

    }


    /* =========================================
   PHOTO
========================================= */

    .current-photo-box {

        width: 100%;

        min-height: 260px;

        display: flex;

        flex-direction: column;

        align-items: center;

        justify-content: center;

        gap: 18px;

        padding: 25px;

        background:

            linear-gradient(135deg,
                #fff9f0,
                #fffdf9);

        border: 1px solid #ffe2b8;

        border-radius: 18px;

        text-align: center;

    }


    .current-photo {

        width: 190px;

        height: 190px;

        object-fit: cover;

        border-radius: 18px;

        border: 4px solid #ffffff;

        box-shadow:

            0 10px 25px rgba(0, 0, 0, 0.15);

    }


    .no-photo {

        width: 190px;

        height: 190px;

        border-radius: 18px;

        background: #fff0d7;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 65px;

    }


    .current-photo-text {

        font-size: 13px;

        line-height: 1.6;

        color: #857975;

    }


    .current-photo-text strong {

        display: block;

        margin-bottom: 5px;

        color: #302525;

        font-size: 15px;

    }


    /* =========================================
   FILE INPUT
========================================= */

    .file-input {

        width: 100%;

        padding: 11px;

        border: 1px dashed #ffb94e;

        border-radius: 12px;

        background: #fffaf2;

        cursor: pointer;

    }


    /* =========================================
   BUTTONS
========================================= */

    .form-buttons {

        width: 100%;

        display: flex;

        justify-content: flex-end;

        gap: 14px;

        margin-top: 30px;

        padding-top: 25px;

        border-top: 1px solid #eeeeee;

    }


    .btn {

        min-width: 150px;

        padding: 13px 24px;

        border-radius: 12px;

        font-size: 14px;

        font-weight: 700;

        text-align: center;

    }


    .btn-update {

        border: none;

        background:

            linear-gradient(135deg,
                #ffa21a,
                #ff7a18);

        color: #ffffff;

        cursor: pointer;

    }


    .btn-cancel {

        background: #f4f2f0;

        color: #665c58;

        text-decoration: none;

        border: 1px solid #ebe7e4;

    }


    /* =========================================
   RESPONSIVE
========================================= */

    @media screen and (max-width: 900px) {

        .thali-form-grid {

            grid-template-columns: 1fr;

        }


        .thali-edit-card {

            padding: 30px 25px;

        }

    }


    @media screen and (max-width: 500px) {

        .thali-edit-page {

            padding: 20px 12px 50px;

        }


        .thali-edit-card {

            padding: 25px 18px;

        }


        .form-buttons {

            flex-direction: column-reverse;

        }


        .btn {

            width: 100%;

        }


        .current-photo {

            width: 150px;

            height: 150px;

        }

    }
</style>


<!-- ========================================
     MAIN CONTENT
======================================== -->

<div class="thali-main-wrapper">

    <div class="thali-edit-page">

        <div class="thali-edit-card">


            <!-- HEADER -->

            <div class="thali-edit-header">

                <div class="thali-edit-icon">
                    🍱
                </div>


                <div>

                    <h2>Edit Thali</h2>

                    <p>
                        Update your thali information and menu details
                    </p>

                </div>

            </div>


            <!-- FORM -->

            <form method="POST" enctype="multipart/form-data">


                <div class="thali-form-grid">


                    <!-- LEFT SIDE -->

                    <div class="thali-form-left">


                        <div class="form-group">

                            <label>Thali ID</label>

                            <input type="text" name="thali_id" class="form-control"
                                value="<?php echo htmlspecialchars($row['thali_id']); ?>" readonly>

                        </div>


                        <div class="form-group">

                            <label>Thali Name</label>

                            <input type="text" name="thali_name" class="form-control"
                                value="<?php echo htmlspecialchars($row['thali_name']); ?>" required>

                        </div>


                        <div class="form-group">

                            <label>Description</label>

                            <textarea name="description" class="form-control"
                                required><?php echo htmlspecialchars($row['description']); ?></textarea>

                        </div>


                        <div class="form-group">

                            <label>Thali Price</label>


                            <div class="price-wrapper">

                                <span class="price-symbol">₹</span>

                                <input type="number" name="thali_price" class="form-control price-input"
                                    value="<?php echo htmlspecialchars($row['thali_price']); ?>" min="1" required>

                            </div>

                        </div>


                    </div>


                    <!-- RIGHT SIDE -->

                    <div class="thali-form-right">


                        <div class="form-group">

                            <label>Current Photo</label>


                            <div class="current-photo-box">


                                <?php if (!empty($row['photo'])) { ?>


                                    <img src="upload/<?php echo htmlspecialchars($row['photo']); ?>" class="current-photo"
                                        alt="Current Thali">


                                    <div class="current-photo-text">

                                        <strong>
                                            Current Thali Image
                                        </strong>

                                        Upload a new image below if you
                                        want to replace this photo.

                                    </div>


                                <?php } else { ?>


                                    <div class="no-photo">
                                        🍱
                                    </div>


                                    <div class="current-photo-text">

                                        <strong>
                                            No Image Available
                                        </strong>

                                        Upload a thali image below.

                                    </div>


                                <?php } ?>


                            </div>

                        </div>


                        <div class="form-group">

                            <label>Change Photo</label>

                            <input type="file" name="photo" class="file-input" accept=".jpg,.jpeg,.png,.webp">

                        </div>


                    </div>


                </div>


                <!-- BUTTONS -->

                <div class="form-buttons">


                    <a href="view_special_thali.php" class="btn btn-cancel">

                        ← Cancel

                    </a>


                    <button type="submit" name="btnupdate" class="btn btn-update">

                        ✓ Update Thali

                    </button>


                </div>


            </form>


        </div>

    </div>

</div>


<?php

include("footer.php");

?>