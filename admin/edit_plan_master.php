<?php
include("header.php");
include("connection.php");

/* =========================================
   GET PLAN ID
========================================= */

if (!isset($_GET['plan_id']) || empty($_GET['plan_id'])) {

    echo "<script>
            alert('Invalid Plan ID');
            window.location='view_plan_master.php';
          </script>";

    exit;
}

$plan_id = intval($_GET['plan_id']);


/* =========================================
   FETCH PLAN DATA
========================================= */

$q = mysqli_query(
    $con,
    "SELECT * FROM plan_master WHERE plan_id = $plan_id"
);

if (mysqli_num_rows($q) == 0) {

    echo "<script>
            alert('Plan not found');
            window.location='view_plan_master.php';
          </script>";

    exit;
}

$row = mysqli_fetch_assoc($q);

$plan_name = $row['plan_name'];
$description = $row['description'];
$old_photo = $row['photo'];
$status = $row['status'];


/* =========================================
   UPDATE PLAN
========================================= */

if (isset($_POST['update_plan'])) {

    $plan_name = mysqli_real_escape_string(
        $con,
        $_POST['plan_name']
    );

    $description = mysqli_real_escape_string(
        $con,
        $_POST['description']
    );

    $status = intval($_POST['status']);

    $photo_name = $old_photo;


    /* =====================================
       IMAGE UPLOAD
    ===================================== */

    if (
        isset($_FILES['photo']) &&
        $_FILES['photo']['error'] == 0
    ) {

        $upload_dir = "uploads/";

        $original_name = $_FILES['photo']['name'];
        $tmp_name = $_FILES['photo']['tmp_name'];

        $extension = strtolower(
            pathinfo(
                $original_name,
                PATHINFO_EXTENSION
            )
        );

        $allowed_extensions = [
            "jpg",
            "jpeg",
            "png",
            "webp"
        ];


        if (!in_array($extension, $allowed_extensions)) {

            echo "<script>
                    alert('Only JPG, JPEG, PNG and WEBP images are allowed.');
                  </script>";

        } else {

            $new_photo =
                time() . "_" .
                uniqid() . "." .
                $extension;

            $destination =
                $upload_dir . $new_photo;


            if (
                move_uploaded_file(
                    $tmp_name,
                    $destination
                )
            ) {

                /* Delete old image */

                if (
                    !empty($old_photo) &&
                    file_exists(
                        $upload_dir . $old_photo
                    )
                ) {

                    unlink(
                        $upload_dir . $old_photo
                    );
                }

                $photo_name = $new_photo;
            }
        }
    }


    /* =====================================
       UPDATE DATABASE
    ===================================== */

    $update = mysqli_query(
        $con,
        "UPDATE plan_master SET

            plan_name = '$plan_name',
            description = '$description',
            photo = '$photo_name',
            status = '$status'

         WHERE plan_id = $plan_id"
    );


    if ($update) {

        echo "<script>
                alert('Tiffin Plan updated successfully!');
                window.location='view_plan_master.php';
              </script>";

        exit;

    } else {

        echo "<script>
                alert('Something went wrong while updating the plan.');
              </script>";
    }
}
?>


<style>
    /* =========================================
   GLOBAL FIX
========================================= */

    * {
        box-sizing: border-box;
    }


    /* =========================================
   EDIT PLAN SECTION
========================================= */

    .edit-plan-section {

        width: 100%;

        max-width: 100%;

        min-height: 100vh;

        padding: 35px 25px 80px;

        display: flex;

        flex-direction: column;

        align-items: center;

        background:
            radial-gradient(circle at 10% 10%,
                rgba(255, 159, 28, 0.08),
                transparent 25%),
            radial-gradient(circle at 90% 90%,
                rgba(255, 107, 53, 0.07),
                transparent 25%);

        animation:
            pageFadeIn 0.7s ease;
    }


    /* =========================================
   INNER WRAPPER
========================================= */

    .edit-plan-container {

        width: 100%;

        max-width: 900px;

        margin: 0 auto;
    }


    /* =========================================
   PAGE HEADING
========================================= */

    .edit-plan-heading {

        width: 100%;

        display: flex;

        align-items: center;

        gap: 15px;

        margin-bottom: 28px;

        animation:
            headingSlide 0.7s ease;
    }


    .edit-plan-icon {

        width: 58px;

        height: 58px;

        min-width: 58px;

        border-radius: 17px;

        background:
            linear-gradient(135deg,
                #ff9f1c,
                #ff6b35);

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 27px;

        box-shadow:
            0 10px 25px rgba(255, 159, 28, 0.25);

        animation:
            iconFloat 3s ease-in-out infinite;

        transition:
            transform 0.3s ease;
    }


    .edit-plan-icon:hover {

        transform:
            rotate(-6deg) scale(1.08);
    }


    .edit-plan-title h1 {

        margin: 0;

        font-size: 28px;

        font-weight: 800;

        color: #241b1b;
    }


    .edit-plan-title p {

        margin: 5px 0 0;

        font-size: 14px;

        color: #8c817c;
    }


    /* =========================================
   FORM CARD
========================================= */

    .edit-plan-card {

        width: 100%;

        max-width: 900px;

        margin: 0 auto;

        background: #ffffff;

        border-radius: 22px;

        padding: 38px 40px 40px;

        box-shadow:
            0 15px 40px rgba(50, 30, 20, 0.10);

        position: relative;

        overflow: hidden;

        animation:
            cardUp 0.8s ease;

        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease;
    }


    .edit-plan-card:hover {

        transform:
            translateY(-3px);

        box-shadow:
            0 20px 50px rgba(50, 30, 20, 0.13);
    }


    /* TOP GRADIENT */

    .edit-plan-card::before {

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
                #ffa21a);
    }


    /* =========================================
   FORM GRID
========================================= */

    .edit-plan-form {

        width: 100%;

        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 24px;
    }


    .form-group {

        display: flex;

        flex-direction: column;

        gap: 8px;

        min-width: 0;
    }


    .form-group.full-width {

        grid-column:
            1 / -1;
    }


    /* =========================================
   LABEL
========================================= */

    .form-group label {

        font-size: 14px;

        font-weight: 700;

        color: #352727;
    }


    .required {

        color: #ff6b35;
    }


    /* =========================================
   INPUT
========================================= */

    .form-group input,
    .form-group textarea,
    .form-group select {

        width: 100%;

        border:
            1px solid #e5e0dc;

        border-radius: 12px;

        background: #fffaf6;

        padding: 14px 15px;

        font-size: 14px;

        color: #302525;

        outline: none;

        transition:
            border-color 0.3s ease,
            background 0.3s ease,
            box-shadow 0.3s ease,
            transform 0.3s ease;
    }


    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {

        border-color: #ffa21a;

        background: #ffffff;

        box-shadow:
            0 0 0 4px rgba(255, 162, 26, 0.10);

        transform:
            translateY(-1px);
    }


    .form-group textarea {

        min-height: 140px;

        resize: vertical;

        line-height: 1.6;
    }


    /* =========================================
   PLAN ID
========================================= */

    .plan-id-box {

        background: #f4f2f0 !important;

        color: #777 !important;

        cursor: not-allowed;

        font-weight: 600;
    }


    /* =========================================
   CURRENT PHOTO
========================================= */

    .current-photo-box {

        width: 100%;

        display: flex;

        align-items: center;

        gap: 18px;

        padding: 16px;

        border-radius: 14px;

        background: #fffaf4;

        border:
            1px dashed #e4d5c7;

        transition:
            all 0.3s ease;
    }


    .current-photo-box:hover {

        border-color: #ffa21a;

        background: #fff8ef;
    }


    .current-photo {

        width: 85px;

        height: 85px;

        min-width: 85px;

        object-fit: cover;

        border-radius: 15px;

        border:
            2px solid #ffffff;

        box-shadow:
            0 6px 15px rgba(0, 0, 0, 0.12);

        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease;
    }


    .current-photo:hover {

        transform:
            scale(1.07) rotate(2deg);

        box-shadow:
            0 10px 22px rgba(0, 0, 0, 0.18);
    }


    .current-photo-text {

        display: flex;

        flex-direction: column;

        gap: 5px;
    }


    .current-photo-text strong {

        font-size: 14px;

        color: #4b3a34;
    }


    .current-photo-text span {

        font-size: 12px;

        color: #998b83;

        line-height: 1.5;
    }


    /* =========================================
   FILE INPUT
========================================= */

    .file-input {

        padding: 10px !important;

        background: #ffffff !important;

        cursor: pointer;
    }


    .file-input::file-selector-button {

        border: none;

        padding: 9px 14px;

        border-radius: 8px;

        background: #fff0d7;

        color: #e98b00;

        font-weight: 700;

        cursor: pointer;

        margin-right: 10px;

        transition:
            all 0.3s ease;
    }


    .file-input::file-selector-button:hover {

        background: #ffe2b5;
    }


    /* =========================================
   STATUS
========================================= */

    .status-options {

        width: 100%;

        display: flex;

        gap: 15px;
    }


    .status-option {

        flex: 1;

        position: relative;
    }


    .status-option input {

        position: absolute;

        opacity: 0;

        pointer-events: none;
    }


    .status-option label {

        width: 100%;

        display: flex;

        align-items: center;

        justify-content: center;

        gap: 8px;

        padding: 14px;

        border-radius: 12px;

        border:
            1px solid #e5e0dc;

        background: #fffaf6;

        cursor: pointer;

        transition:
            all 0.3s ease;
    }


    .status-option label:hover {

        border-color: #ffa21a;

        transform:
            translateY(-2px);
    }


    .status-option input:checked+label {

        background: #fff0d7;

        border-color: #ffa21a;

        color: #e98b00;

        box-shadow:
            0 6px 16px rgba(255, 162, 26, 0.14);
    }


    /* =========================================
   BUTTONS
========================================= */

    .form-buttons {

        grid-column: 1 / -1;

        width: 100%;

        display: flex;

        justify-content: flex-end;

        gap: 14px;

        margin-top: 8px;

        padding-top: 25px;

        border-top:
            1px solid #eeeeee;
    }


    .btn {

        min-width: 150px;

        padding: 13px 20px;

        border-radius: 12px;

        border: none;

        font-size: 14px;

        font-weight: 700;

        cursor: pointer;

        text-decoration: none;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 8px;

        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease,
            background 0.3s ease;
    }


    /* CANCEL */

    .btn-cancel {

        background: #f4f2f0;

        color: #655b57;
    }


    .btn-cancel:hover {

        background: #e9e5e2;

        color: #655b57;

        transform:
            translateY(-2px);
    }


    /* UPDATE */

    .btn-update {

        background:
            linear-gradient(135deg,
                #ffa21a,
                #ff7b22);

        color: #ffffff;

        box-shadow:
            0 8px 18px rgba(255, 145, 20, 0.25);
    }


    .btn-update:hover {

        color: #ffffff;

        transform:
            translateY(-3px);

        box-shadow:
            0 13px 28px rgba(255, 145, 20, 0.35);
    }


    .btn-update:active {

        transform:
            translateY(-1px);
    }


    /* =========================================
   ANIMATIONS
========================================= */

    @keyframes pageFadeIn {

        from {

            opacity: 0;
        }

        to {

            opacity: 1;
        }
    }


    @keyframes headingSlide {

        from {

            opacity: 0;

            transform:
                translateY(-20px);
        }

        to {

            opacity: 1;

            transform:
                translateY(0);
        }
    }


    @keyframes cardUp {

        from {

            opacity: 0;

            transform:
                translateY(35px);
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


    /* =========================================
   TABLET
========================================= */

    @media screen and (max-width: 900px) {

        .edit-plan-section {

            padding:
                25px 20px 70px;
        }


        .edit-plan-card {

            padding:
                32px 28px 35px;
        }
    }


    /* =========================================
   MOBILE
========================================= */

    @media screen and (max-width: 650px) {

        .edit-plan-section {

            padding:
                20px 12px 60px;
        }


        .edit-plan-heading {

            gap: 12px;
        }


        .edit-plan-icon {

            width: 50px;

            height: 50px;

            min-width: 50px;

            font-size: 23px;
        }


        .edit-plan-title h1 {

            font-size: 22px;
        }


        .edit-plan-title p {

            font-size: 12px;
        }


        .edit-plan-card {

            padding:
                28px 18px 30px;

            border-radius: 18px;
        }


        .edit-plan-form {

            grid-template-columns:
                1fr;
        }


        .form-group.full-width {

            grid-column: auto;
        }


        .current-photo-box {

            flex-direction: column;

            align-items: flex-start;
        }


        .status-options {

            flex-direction: column;
        }


        .form-buttons {

            grid-column: auto;

            flex-direction: column;
        }


        .btn {

            width: 100%;
        }
    }
</style>


<!-- =========================================
     MAIN CONTENT
========================================= -->

<div class="edit-plan-section">

    <div class="edit-plan-container">


        <!-- PAGE HEADING -->

        <div class="edit-plan-heading">

            <div class="edit-plan-icon">
                ✏️
            </div>

            <div class="edit-plan-title">

                <h1>
                    Edit Tiffin Plan
                </h1>

                <p>
                    Update your tiffin plan information and services
                </p>

            </div>

        </div>


        <!-- FORM CARD -->

        <div class="edit-plan-card">

            <form method="POST" enctype="multipart/form-data" class="edit-plan-form">


                <!-- PLAN ID -->

                <div class="form-group">

                    <label>
                        Plan ID
                    </label>

                    <input type="text" value="<?php echo $plan_id; ?>" class="plan-id-box" readonly>

                </div>


                <!-- PLAN NAME -->

                <div class="form-group">

                    <label>
                        Plan Name
                        <span class="required">*</span>
                    </label>

                    <input type="text" name="plan_name" value="<?php echo htmlspecialchars($plan_name); ?>"
                        placeholder="Enter plan name" required>

                </div>


                <!-- DESCRIPTION -->

                <div class="form-group full-width">

                    <label>
                        Description

                    </label>

                    <input type="text" name="description" value="<?php echo htmlspecialchars($description); ?>"
                        placeholder="Enter plan description">

                </div>


                <!-- CURRENT PHOTO -->

                <div class="form-group">

                    <label>
                        Current Photo
                    </label>

                    <div class="current-photo-box">

                        <?php if (!empty($old_photo)) { ?>

                            <img src="upload/<?php echo htmlspecialchars($old_photo); ?>" class="current-photo"
                                alt="Current Plan Photo">

                            <div class="current-photo-text">

                                <strong>
                                    Current Plan Image
                                </strong>

                                <span>
                                    Upload a new image below to replace it.
                                </span>

                            </div>

                        <?php } else { ?>

                            <div class="current-photo-text">

                                <strong>
                                    No Image Available
                                </strong>

                                <span>
                                    You can upload a new image.
                                </span>

                            </div>

                        <?php } ?>

                    </div>

                </div>


                <!-- NEW PHOTO -->

                <div class="form-group">

                    <label>
                        Change Photo
                    </label>

                    <input type="file" name="photo" class="file-input" accept=".jpg,.jpeg,.png,.webp">

                </div>


                <!-- STATUS -->

                <div class="form-group full-width">

                    <label>
                        Plan Status
                    </label>

                    <div class="status-options">

                        <div class="status-option">

                            <input type="radio" id="active" name="status" value="1" checked>

                            <label for="active">
                                🟢 Active
                            </label>

                        </div>

                    </div>

                </div>


                <!-- BUTTONS -->

                <div class="form-buttons">

                    <a href="view_plan_master.php" class="btn btn-cancel">
                        ← Cancel
                    </a>


                    <button type="submit" name="update_plan" class="btn btn-update">
                        ✓ Update Plan
                    </button>

                </div>


            </form>

        </div>

    </div>

</div>


<?php
include("footer.php");
?>