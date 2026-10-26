<?php
include("header.php");
include("connection.php");
?>

<style>
    /* =========================================================  
       GLOBAL OVERFLOW FIX 
    ========================================================= */

    html,
    body {
        overflow-x: hidden;
    }


    /* =========================================================  
       PAGE  
    ========================================================= */

    .item-view-page {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;

        padding: 25px;

        background: #f8f9fa;

        animation: pageFadeIn 0.6s ease;
    }


    /* =========================================================  
       PAGE HEADER CARD
    ========================================================= */

    .item-page-header {

        width: 100%;
        box-sizing: border-box;

        display: flex;
        align-items: center;
        justify-content: space-between;

        margin-bottom: 25px;

        padding: 20px 25px;

        background: #ffffff;

        border: 1px solid #e9ecef;

        border-radius: 16px;

        box-shadow:
            0 4px 20px rgba(0, 0, 0, 0.04);
    }


    /* =========================================================  
       TITLE AREA
    ========================================================= */

    .item-title-area {

        display: flex;
        align-items: center;

        gap: 15px;
    }


    .item-page-title {

        margin: 0;

        color: #1a1a1a;

        font-size: 22px;

        font-weight: 700;
    }


    .item-page-subtitle {

        margin: 4px 0 0;

        color: #718096;

        font-size: 12px;
    }


    /* =========================================================  
       TITLE ICON  
    ========================================================= */

    .item-title-icon {

        width: 50px;
        height: 50px;

        min-width: 50px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 12px;

        background:
            linear-gradient(135deg,
                #ff9f1c,
                #ff6b35);

        font-size: 22px;

        box-shadow:
            0 6px 15px rgba(255, 107, 53, 0.25);
    }


    /* =========================================================  
       ADD NEW ITEM BUTTON
    ========================================================= */

    .add-item-btn {

        display: inline-flex;

        align-items: center;
        justify-content: center;

        padding: 10px 20px;

        border-radius: 10px;

        text-decoration: none;

        font-size: 13px;

        font-weight: 600;

        color: #ffffff;

        white-space: nowrap;

        background:
            linear-gradient(135deg,
                #ff9f1c,
                #ff6b35);

        box-shadow:
            0 6px 16px rgba(255, 107, 53, 0.25);

        transition: all 0.3s ease;
    }


    .add-item-btn:hover {

        color: #ffffff;

        text-decoration: none;

        transform: translateY(-2px);

        box-shadow:
            0 8px 20px rgba(255, 107, 53, 0.35);
    }


    /* =========================================================  
       TABLE WRAPPER 
    ========================================================= */

    .item-table-wrapper {

        width: 100%;
        max-width: 100%;

        box-sizing: border-box;

        overflow-x: auto;
        overflow-y: hidden;

        -webkit-overflow-scrolling: touch;

        background: #ffffff;

        border-radius: 16px;

        border: 1px solid #e9ecef;

        box-shadow:
            0 4px 20px rgba(0, 0, 0, 0.04);

        animation: tableSlideUp 0.7s ease;

        scrollbar-width: thin;

        scrollbar-color:
            #ffad35 #f5f5f5;
    }


    /* =========================================================  
       TABLE  
    ========================================================= */

    .item-table {

        width: 100%;

        min-width: 950px;

        border-collapse: collapse;

        table-layout: auto;

        background: #ffffff;
    }


    /* =========================================================  
       TABLE HEADER  
    ========================================================= */

    .item-table thead {

        background:
            linear-gradient(135deg,
                #ff9f1c,
                #ffb347);
    }


    .item-table th {

        padding: 15px 16px;

        text-align: left;

        color: #ffffff;

        font-size: 12px;

        font-weight: 700;

        white-space: nowrap;
    }


    /* =========================================================  
       TABLE BODY  
    ========================================================= */

    .item-table td {

        padding: 15px 16px;

        vertical-align: middle;

        text-align: left;

        color: #4a5568;

        font-size: 12px;

        border-bottom:
            1px solid #f1f1f1;

        line-height: 1.5;

        word-break: break-word;
    }


    .item-table tbody tr {

        transition:
            background 0.25s ease;
    }


    .item-table tbody tr:nth-child(even) {

        background: #fcfcfc;
    }


    .item-table tbody tr:hover {

        background: #fffaf0;
    }


    .item-table tbody tr:last-child td {

        border-bottom: none;
    }


    /* =========================================================  
       COLUMN WIDTH 
    ========================================================= */

    .item-table th:nth-child(1),
    .item-table td:nth-child(1) {

        min-width: 90px;
    }


    .item-table th:nth-child(2),
    .item-table td:nth-child(2) {

        min-width: 160px;
    }


    .item-table th:nth-child(3),
    .item-table td:nth-child(3) {

        min-width: 280px;
    }


    .item-table th:nth-child(4),
    .item-table td:nth-child(4) {

        min-width: 120px;
    }


    .item-table th:nth-child(5),
    .item-table td:nth-child(5) {

        min-width: 120px;
    }


    /* ACTION COLUMN */

    .item-table th:nth-child(6),
    .item-table td:nth-child(6) {

        min-width: 145px;

        white-space: nowrap;
    }


    /* =========================================================  
       ITEM NAME  
    ========================================================= */

    .item-name-cell {

        font-weight: 700;

        color: #2d3748;
    }


    .item-table tbody tr:hover .item-name-cell {

        color: #f28c00;
    }


    /* =========================================================  
       DESCRIPTION  
    ========================================================= */

    .item-description-cell {

        color: #718096;

        line-height: 1.6;
    }


    /* =========================================================  
       PRICE  
    ========================================================= */

    .item-price {

        display: inline-flex;

        align-items: center;
        justify-content: center;

        min-width: 55px;

        padding: 8px 13px;

        border-radius: 25px;

        background: #fff3dd;

        color: #ed8b00;

        font-size: 12px;

        font-weight: 700;

        white-space: nowrap;
    }


    /* =========================================================  
       PHOTO  
    ========================================================= */

    .item-photo {

        width: 60px;
        height: 60px;

        min-width: 60px;

        object-fit: cover;

        display: block;

        border-radius: 10px;

        border: 2px solid #ffffff;

        background: #fff;

        box-shadow:
            0 3px 10px rgba(0, 0, 0, 0.08);

        transition:
            transform 0.3s ease;
    }


    .item-photo:hover {

        transform: scale(1.06);
    }


    /* =========================================================  
       NO IMAGE  
    ========================================================= */

    .no-photo {

        width: 60px;
        height: 60px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: #fff5e5;

        border: 1px dashed #ffb24d;

        color: #ed8b00;

        font-size: 10px;

        font-weight: 600;

        white-space: nowrap;
    }


    /* =========================================================  
       ACTION AREA 
    ========================================================= */

    .action-area {

        display: flex;

        align-items: center;

        justify-content: flex-start;

        /* EDIT & DELETE KE BEECH PROPER SPACE */
        gap: 12px;

        min-width: 100px;

        white-space: nowrap;

        flex-wrap: nowrap;
    }


    /* =========================================================  
       ACTION BUTTON  
    ========================================================= */

    .action-btn {

        width: 38px;
        height: 38px;

        min-width: 38px;

        display: inline-flex;

        align-items: center;
        justify-content: center;

        border-radius: 9px;

        background: #edf2f7;

        border: none;

        text-decoration: none;

        flex-shrink: 0;

        transition:
            all 0.25s ease;
    }


    .action-btn:hover {

        background: #ffede0;

        transform: translateY(-2px);
    }


    .action-btn img {

        width: 17px !important;

        height: 17px !important;

        object-fit: contain;

        border: none !important;

        margin: 0 !important;
    }


    /* =========================================================  
       EMPTY DATA  
    ========================================================= */

    .no-data {

        text-align: center !important;

        padding: 50px !important;

        color: #a0aec0 !important;

        font-size: 14px !important;
    }


    /* =========================================================  
       SCROLLBAR  
    ========================================================= */

    .item-table-wrapper::-webkit-scrollbar {

        height: 9px;
    }


    .item-table-wrapper::-webkit-scrollbar-track {

        background: #f5f5f5;

        border-radius: 10px;
    }


    .item-table-wrapper::-webkit-scrollbar-thumb {

        background:
            linear-gradient(90deg,
                #ffad35,
                #ff8c35);

        border-radius: 10px;
    }


    .item-table-wrapper::-webkit-scrollbar-thumb:hover {

        background: #f29400;
    }


    /* =========================================================  
       ANIMATIONS  
    ========================================================= */

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


    @keyframes tableSlideUp {

        from {

            opacity: 0;

            transform: translateY(20px);
        }

        to {

            opacity: 1;

            transform: translateY(0);
        }
    }


    /* =========================================================  
       RESPONSIVE 
    ========================================================= */

    @media screen and (max-width: 768px) {

        .item-view-page {

            padding: 15px;
        }


        .item-page-header {

            flex-direction: column;

            align-items: flex-start;

            gap: 15px;

            padding: 18px;
        }


        .add-item-btn {

            width: 100%;
        }


        .item-table {

            min-width: 950px;
        }
    }
</style>


<!-- =========================================================  
     MAIN PAGE  
========================================================= -->

<!-- header.php already opens page-body -->

<div class="item-view-page">


    <!-- PAGE HEADER -->

    <div class="item-page-header">


        <!-- LEFT SIDE -->

        <div class="item-title-area">

            <div class="item-title-icon">
                🍽️
            </div>


            <div>

                <h2 class="item-page-title">
                    Food Item Master
                </h2>


                <p class="item-page-subtitle">
                    Manage your food items and menu easily
                </p>

            </div>

        </div>


        <!-- ADD NEW ITEM BUTTON -->

        <a href="add_item_master.php" class="add-item-btn">

            + Add New Item

        </a>


    </div>


    <!-- =========================================================
         TABLE
    ========================================================= -->

    <div class="item-table-wrapper">

        <table class="item-table">


            <thead>

                <tr>

                    <th>Item ID</th>

                    <th>Item Name</th>

                    <th>Description</th>

                    <th>Price</th>

                    <th>Photo</th>

                    <th>Action</th>

                </tr>

            </thead>


            <tbody>

                <?php

                $q = mysqli_query(
                    $con,
                    "SELECT * FROM item_master ORDER BY item_id ASC"
                );


                if ($q && mysqli_num_rows($q) > 0) {

                    while ($row = mysqli_fetch_assoc($q)) {

                        ?>

                        <tr>


                            <!-- ITEM ID -->

                            <td>

                                <?php
                                echo htmlspecialchars(
                                    $row['item_id']
                                );
                                ?>

                            </td>


                            <!-- ITEM NAME -->

                            <td class="item-name-cell">

                                <?php
                                echo htmlspecialchars(
                                    $row['item_name']
                                );
                                ?>

                            </td>


                            <!-- DESCRIPTION -->

                            <td class="item-description-cell">

                                <?php
                                echo htmlspecialchars(
                                    $row['description']
                                );
                                ?>

                            </td>


                            <!-- PRICE -->

                            <td>

                                <span class="item-price">

                                    ₹
                                    <?php
                                    echo htmlspecialchars(
                                        $row['price']
                                    );
                                    ?>

                                </span>

                            </td>


                            <!-- PHOTO -->

                            <td>

                                <?php

                                $photoPath =
                                    "upload/" . $row['photo'];

                                if (
                                    !empty($row['photo']) &&
                                    file_exists($photoPath)
                                ) {

                                    ?>

                                    <img class="item-photo" src="<?php echo htmlspecialchars($photoPath); ?>" alt="Food Item">

                                    <?php

                                } else {

                                    ?>

                                    <div class="no-photo">

                                        No Image

                                    </div>

                                    <?php
                                }

                                ?>

                            </td>


                            <!-- ACTION -->

                            <td>

                                <div class="action-area">


                                    <!-- EDIT -->

                                    <a href="edit_item.php?item_id=<?php echo $row['item_id']; ?>"
                                        class="action-btn edit-btn" title="Edit">

                                        <img src="./assets/img/edit.png" alt="Edit">

                                    </a>


                                    <!-- DELETE -->

                                    <a href="delete_item.php?item_id=<?php echo $row['item_id']; ?>"
                                        class="action-btn delete-btn" title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this item?')">

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

                        <td colspan="6" class="no-data">

                            No food items found.

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