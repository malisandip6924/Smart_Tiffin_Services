<?php
include("header.php");
include("connection.php");
?>

<style>
    /* =========================================================
   GLOBAL
========================================================= */

    html,
    body {
        overflow-x: hidden;
    }


    /* =========================================================
   SPECIAL THALI PAGE
========================================================= */

    .thali-page {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;

        padding: 25px;

        background: #f8f9fa;

        animation: pageFade 0.6s ease;
    }


    /* =========================================================
   HEADER
========================================================= */

    .thali-header {

        width: 100%;

        box-sizing: border-box;

        display: flex;

        justify-content: space-between;

        align-items: center;

        gap: 20px;

        margin-bottom: 25px;

        padding: 20px 25px;

        background: #ffffff;

        border-radius: 16px;

        border: 1px solid #e9ecef;

        box-shadow:
            0 4px 20px rgba(0, 0, 0, 0.04);

        animation: headingSlide 0.7s ease;
    }


    /* =========================================================
   HEADING LEFT
========================================================= */

    .thali-heading {

        display: flex;

        align-items: center;

        gap: 16px;

        min-width: 0;
    }


    /* =========================================================
   HEADING ICON
========================================================= */

    .thali-heading-icon {

        width: 54px;

        height: 54px;

        min-width: 54px;

        display: flex;

        align-items: center;

        justify-content: center;

        background:
            linear-gradient(135deg,
                #ff9f1c,
                #ff6b35);

        border-radius: 14px;

        font-size: 26px;

        box-shadow:
            0 8px 20px rgba(255, 140, 0, 0.22);

        transition: 0.3s ease;
    }


    .thali-heading-icon:hover {

        transform:
            rotate(-5deg) scale(1.06);
    }


    /* =========================================================
   HEADING TEXT
========================================================= */

    .thali-heading-text {

        min-width: 0;
    }


    .thali-heading-text h2 {

        margin: 0;

        font-size: 25px;

        font-weight: 800;

        color: #211b18;
    }


    .thali-heading-text p {

        margin: 5px 0 0;

        font-size: 13px;

        color: #718096;
    }


    /* =========================================================
   ADD NEW THALI BUTTON
========================================================= */

    .add-thali-btn {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 7px;

        padding: 11px 20px;

        border-radius: 10px;

        text-decoration: none;

        font-size: 13px;

        font-weight: 700;

        white-space: nowrap;

        color: #ffffff !important;

        background:
            linear-gradient(135deg,
                #ff9f1c,
                #ff6b35);

        box-shadow:
            0 6px 16px rgba(255, 107, 53, 0.25);

        transition: all 0.3s ease;
    }


    .add-thali-btn i {

        font-size: 18px;
    }


    .add-thali-btn:hover {

        color: #ffffff !important;

        transform:
            translateY(-2px);

        box-shadow:
            0 9px 22px rgba(255, 107, 53, 0.35);
    }


    /* =========================================================
   TABLE WRAPPER
========================================================= */

    .thali-table-wrapper {

        width: 100%;

        max-width: 100%;

        box-sizing: border-box;

        overflow-x: auto;

        overflow-y: hidden;

        background: #ffffff;

        border-radius: 16px;

        border: 1px solid #e9ecef;

        box-shadow:
            0 4px 20px rgba(0, 0, 0, 0.04);

        animation: tableSlide 0.8s ease;

        -webkit-overflow-scrolling: touch;

        scrollbar-width: thin;

        scrollbar-color:
            #ff9f1c #f1f1f1;
    }


    /* =========================================================
   SCROLLBAR
========================================================= */

    .thali-table-wrapper::-webkit-scrollbar {

        height: 9px;
    }


    .thali-table-wrapper::-webkit-scrollbar-track {

        background: #f1f1f1;

        border-radius: 10px;
    }


    .thali-table-wrapper::-webkit-scrollbar-thumb {

        background:
            linear-gradient(90deg,
                #ff9f1c,
                #ff6b35);

        border-radius: 10px;
    }


    /* =========================================================
   TABLE
========================================================= */

    .thali-table {

        width: 100%;

        min-width: 950px;

        border-collapse: collapse;

        table-layout: auto;

        background: #ffffff;
    }


    /* =========================================================
   TABLE HEADER
========================================================= */

    .thali-table thead {

        background:
            linear-gradient(135deg,
                #ff9f1c,
                #ffb347);
    }


    .thali-table th {

        padding: 16px 15px;

        text-align: left;

        color: #ffffff;

        font-size: 13px;

        font-weight: 700;

        white-space: nowrap;
    }


    .thali-table th:first-child {

        border-top-left-radius: 16px;
    }


    .thali-table th:last-child {

        border-top-right-radius: 16px;
    }


    /* =========================================================
   TABLE BODY
========================================================= */

    .thali-table td {

        padding: 16px 15px;

        vertical-align: middle;

        text-align: left;

        font-size: 13px;

        color: #4a5568;

        border-bottom:
            1px solid #f1f1f1;

        line-height: 1.5;

        word-break: break-word;
    }


    .thali-table tbody tr {

        transition: all 0.25s ease;
    }


    .thali-table tbody tr:nth-child(even) {

        background: #fcfcfc;
    }


    .thali-table tbody tr:hover {

        background: #fffaf0;
    }


    .thali-table tbody tr:last-child td {

        border-bottom: none;
    }


    /* =========================================================
   COLUMN WIDTH
========================================================= */

    .thali-table th:nth-child(1),
    .thali-table td:nth-child(1) {

        min-width: 90px;
    }


    .thali-table th:nth-child(2),
    .thali-table td:nth-child(2) {

        min-width: 170px;
    }


    .thali-table th:nth-child(3),
    .thali-table td:nth-child(3) {

        min-width: 300px;
    }


    .thali-table th:nth-child(4),
    .thali-table td:nth-child(4) {

        min-width: 120px;
    }


    .thali-table th:nth-child(5),
    .thali-table td:nth-child(5) {

        min-width: 110px;
    }


    .thali-table th:nth-child(6),
    .thali-table td:nth-child(6) {

        min-width: 140px;
    }


    /* =========================================================
   THALI NAME
========================================================= */

    .thali-name {

        font-weight: 700;

        color: #2d3748;

        white-space: nowrap;
    }


    /* =========================================================
   DESCRIPTION
========================================================= */

    .thali-description {

        color: #718096;

        line-height: 1.6;
    }


    /* =========================================================
   PRICE
========================================================= */

    .thali-price {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        padding: 8px 14px;

        border-radius: 25px;

        background: #fff2dc;

        color: #f28c00;

        font-size: 12px;

        font-weight: 700;

        white-space: nowrap;

        transition: all 0.25s ease;
    }


    .thali-price:hover {

        transform: scale(1.05);
    }


    /* =========================================================
   PHOTO
========================================================= */

    .thali-photo {

        width: 58px;

        height: 58px;

        object-fit: cover;

        border-radius: 12px;

        display: block;

        border:
            1px solid #eeeeee;

        box-shadow:
            0 4px 12px rgba(0, 0, 0, 0.08);

        transition: 0.3s ease;
    }


    .thali-photo:hover {

        transform: scale(1.08);

        box-shadow:
            0 8px 18px rgba(0, 0, 0, 0.14);
    }


    /* =========================================================
   ACTION
========================================================= */

    .thali-actions {

        display: flex;

        align-items: center;

        justify-content: flex-start;

        gap: 14px;

        min-width: 110px;

        white-space: nowrap;
    }


    /* =========================================================
   ACTION BUTTON
========================================================= */

    .thali-action-btn {

        width: 40px;

        height: 40px;

        min-width: 40px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        border-radius: 10px;

        background: #f1f5f9;

        text-decoration: none;

        box-shadow:
            0 3px 10px rgba(0, 0, 0, 0.04);

        transition: all 0.25s ease;
    }


    .thali-action-btn:hover {

        background: #fff0dc;

        transform:
            translateY(-3px);

        box-shadow:
            0 7px 16px rgba(255, 152, 0, 0.18);
    }


    /* ACTION ICON */

    .thali-action-btn img {

        width: 18px !important;

        height: 18px !important;

        object-fit: contain;

        border: none !important;

        margin: 0 !important;

        display: block;
    }


    /* =========================================================
   NO DATA
========================================================= */

    .no-thali {

        text-align: center !important;

        padding: 50px !important;

        color: #a0aec0 !important;

        font-size: 14px !important;
    }


    /* =========================================================
   ANIMATIONS
========================================================= */

    @keyframes pageFade {

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
                translateY(-15px);
        }

        to {

            opacity: 1;

            transform:
                translateY(0);
        }
    }


    @keyframes tableSlide {

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


    /* =========================================================
   RESPONSIVE
========================================================= */

    @media screen and (max-width: 768px) {

        .thali-page {

            padding: 15px;
        }


        .thali-header {

            flex-direction: column;

            align-items: flex-start;

            padding: 18px;
        }


        .add-thali-btn {

            width: 100%;
        }


        .thali-heading-text h2 {

            font-size: 21px;
        }


        .thali-heading-text p {

            font-size: 12px;
        }


        .thali-heading-icon {

            width: 48px;

            height: 48px;

            min-width: 48px;

            font-size: 23px;
        }
    }
</style>


<!-- =========================================================
     PAGE
========================================================= -->

<div class="thali-page">


    <!-- =====================================================
         HEADER
    ====================================================== -->

    <div class="thali-header">


        <!-- LEFT SIDE -->

        <div class="thali-heading">

            <div class="thali-heading-icon">
                🍱
            </div>


            <div class="thali-heading-text">

                <h2>Special Thali Master</h2>

                <p>
                    Manage your special thali and menu easily
                </p>

            </div>

        </div>


        <!-- RIGHT SIDE BUTTON -->

        <a href="add_special.php" class="add-thali-btn">

            <i class="ri-add-line"></i>

            Add New Thali

        </a>


    </div>


    <!-- =====================================================
         TABLE
    ====================================================== -->

    <div class="thali-table-wrapper">

        <table class="thali-table">


            <!-- TABLE HEADER -->

            <thead>

                <tr>

                    <th>Thali ID</th>

                    <th>Thali Name</th>

                    <th>Description</th>

                    <th>Price</th>

                    <th>Photo</th>

                    <th>Action</th>

                </tr>

            </thead>


            <!-- TABLE BODY -->

            <tbody>

                <?php

                $q = mysqli_query(
                    $con,
                    "SELECT * FROM thali_master ORDER BY thali_id ASC"
                );
                $sr = 1;

                if ($q && mysqli_num_rows($q) > 0) {

                    while ($row = mysqli_fetch_assoc($q)) {

                        ?>

                        <tr>


                            <!-- THALI ID -->

                            <td>

                                <?php
                                echo $sr++;
                                ?>
                            </td>


                            <!-- THALI NAME -->

                            <td class="thali-name">

                                <?php
                                echo htmlspecialchars(
                                    $row['thali_name']
                                );
                                ?>

                            </td>


                            <!-- DESCRIPTION -->

                            <td class="thali-description">

                                <?php
                                echo htmlspecialchars(
                                    $row['description']
                                );
                                ?>

                            </td>


                            <!-- PRICE -->

                            <td>

                                <span class="thali-price">

                                    ₹
                                    <?php
                                    echo htmlspecialchars(
                                        $row['thali_price']
                                    );
                                    ?>

                                </span>

                            </td>


                            <!-- PHOTO -->

                            <td>

                                <?php

                                if (!empty($row['photo'])) {

                                    ?>

                                    <img src="upload/<?php
                                    echo htmlspecialchars(
                                        $row['photo']
                                    );
                                    ?>" class="thali-photo" alt="Thali">

                                    <?php

                                } else {

                                    ?>

                                    <span style="color:#aaa;">
                                        No Image
                                    </span>

                                    <?php

                                }

                                ?>

                            </td>


                            <!-- ACTION -->

                            <td>

                                <div class="thali-actions">


                                    <!-- EDIT -->

                                    <a href="edit_special.php?thali_id=<?php
                                    echo $row['thali_id'];
                                    ?>" class="thali-action-btn" title="Edit Thali">

                                        <img src="./assets/img/edit.png" alt="Edit">

                                    </a>


                                    <!-- DELETE -->

                                    <a href="delete_special.php?thali_id=<?php
                                    echo $row['thali_id'];
                                    ?>" class="thali-action-btn" title="Delete Thali"
                                        onclick="return confirm('Are you sure you want to delete this thali?')">

                                        <img src="./assets/img/logdel.png" alt="Delete">

                                    </a>


                                </div>

                            </td>


                        </tr>

                        <?php

                    }

                } else {

                    ?>

                    <tr>

                        <td colspan="6" class="no-thali">

                            No Special Thali Records Found

                        </td>

                    </tr>

                    <?php

                }

                ?>

            </tbody>

        </table>

    </div>


</div>


<?php
include("footer.php");
?>