<?php
include("header.php");
include("connection.php");
?>

<style>
    /* =====================================================
   GLOBAL OVERFLOW FIX
===================================================== */

    html,
    body {
        overflow-x: hidden;
    }


    /* =====================================================
   PLAN MASTER PAGE
===================================================== */

    .plan-master-section {

        width: 100%;
        max-width: 100%;

        padding: 25px;

        box-sizing: border-box;

        background: #f8f9fa;
    }


    /* =====================================================
   HEADER
===================================================== */

    .plan-master-header {

        width: 100%;
        max-width: 100%;

        box-sizing: border-box;

        display: flex;

        justify-content: space-between;
        align-items: center;

        margin-bottom: 25px;

        padding: 20px 25px;

        background: #ffffff;

        border-radius: 16px;

        border: 1px solid #e9ecef;

        box-shadow:
            0 4px 20px rgba(0, 0, 0, 0.04);
    }


    .plan-master-heading {

        display: flex;

        align-items: center;

        gap: 15px;

        min-width: 0;
    }


    /* =====================================================
   HEADER ICON
===================================================== */

    .plan-master-icon {

        width: 50px;
        height: 50px;

        min-width: 50px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 12px;

        font-size: 22px;

        background:
            linear-gradient(135deg,
                #ff9f1c,
                #ff6b35);

        box-shadow:
            0 6px 15px rgba(255, 107, 53, .25);
    }


    /* =====================================================
   HEADER TITLE
===================================================== */

    .plan-master-title h1 {

        margin: 0;

        font-size: 22px;

        font-weight: 700;

        color: #1a1a1a;
    }


    .plan-master-title p {

        margin: 4px 0 0;

        font-size: 12px;

        color: #718096;
    }


    /* =====================================================
   ADD NEW PLAN BUTTON
===================================================== */

    .add-plan-btn {

        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: 7px;

        padding: 11px 20px;

        border-radius: 10px;

        text-decoration: none;

        font-size: 13px;

        font-weight: 600;

        color: #ffffff !important;

        white-space: nowrap;

        background:
            linear-gradient(135deg,
                #ff9f1c,
                #ff6b35);

        box-shadow:
            0 6px 16px rgba(255, 107, 53, .25);

        transition:
            transform .3s ease,
            box-shadow .3s ease;
    }


    .add-plan-btn:hover {

        color: #ffffff !important;

        transform: translateY(-2px);

        box-shadow:
            0 8px 20px rgba(255, 107, 53, .35);
    }


    /* =====================================================
   TABLE WRAPPER
===================================================== */

    .plan-master-table-wrapper {

        width: 100%;
        max-width: 100%;

        box-sizing: border-box;

        background: #ffffff;

        border-radius: 16px;

        border: 1px solid #e9ecef;

        box-shadow:
            0 4px 20px rgba(0, 0, 0, .04);

        overflow-x: auto;
        overflow-y: hidden;

        -webkit-overflow-scrolling: touch;

        scrollbar-width: thin;

        scrollbar-color:
            #ff9f1c #f1f1f1;
    }


    /* =====================================================
   HORIZONTAL SCROLLBAR
===================================================== */

    .plan-master-table-wrapper::-webkit-scrollbar {

        height: 9px;
    }


    .plan-master-table-wrapper::-webkit-scrollbar-track {

        background: #f1f1f1;

        border-radius: 10px;
    }


    .plan-master-table-wrapper::-webkit-scrollbar-thumb {

        background:
            linear-gradient(90deg,
                #ff9f1c,
                #ff6b35);

        border-radius: 10px;
    }


    .plan-master-table-wrapper::-webkit-scrollbar-thumb:hover {

        background: #ff6b35;
    }


    /* =====================================================
   TABLE
===================================================== */

    .plan-master-table {

        width: 100%;

        min-width: 1000px;

        table-layout: auto;

        border-collapse: collapse;

        background: #ffffff;
    }


    /* =====================================================
   TABLE HEADER
===================================================== */

    .plan-master-table thead {

        background:
            linear-gradient(135deg,
                #ff9f1c,
                #ffb347);
    }


    .plan-master-table th {

        padding: 16px 14px;

        text-align: left;

        font-size: 13px;

        font-weight: 700;

        color: #ffffff;

        border: none;

        white-space: nowrap;
    }


    .plan-master-table th:first-child {

        border-top-left-radius: 16px;
    }


    .plan-master-table th:last-child {

        border-top-right-radius: 16px;
    }


    /* =====================================================
   TABLE BODY
===================================================== */

    .plan-master-table td {

        padding: 15px 14px;

        font-size: 13px;

        color: #4a5568;

        border-bottom:
            1px solid #f1f1f1;

        vertical-align: middle;

        word-break: break-word;
    }


    .plan-master-table tbody tr {

        transition:
            background .25s ease;
    }


    .plan-master-table tbody tr:nth-child(even) {

        background: #fcfcfc;
    }


    .plan-master-table tbody tr:hover {

        background: #fffaf0;
    }


    .plan-master-table tbody tr:last-child td {

        border-bottom: none;
    }


    /* =====================================================
   COLUMN WIDTH
===================================================== */

    /* PLAN ID */

    .plan-master-table th:nth-child(1),
    .plan-master-table td:nth-child(1) {

        min-width: 90px;
    }


    /* PLAN NAME */

    .plan-master-table th:nth-child(2),
    .plan-master-table td:nth-child(2) {

        min-width: 160px;
    }


    /* DESCRIPTION */

    .plan-master-table th:nth-child(3),
    .plan-master-table td:nth-child(3) {

        min-width: 280px;
    }


    /* PHOTO */

    .plan-master-table th:nth-child(4),
    .plan-master-table td:nth-child(4) {

        min-width: 110px;
    }


    /* STATUS */

    .plan-master-table th:nth-child(5),
    .plan-master-table td:nth-child(5) {

        min-width: 120px;
    }


    /* ACTION */

    .plan-master-table th:nth-child(6),
    .plan-master-table td:nth-child(6) {

        min-width: 170px;

        width: 170px;

        padding-left: 20px;

        padding-right: 20px;

        white-space: nowrap;
    }


    /* =====================================================
   PLAN ID
===================================================== */

    .plan-id {

        font-weight: 700;

        color: #718096;
    }


    /* =====================================================
   PLAN NAME
===================================================== */

    .plan-name {

        font-weight: 700;

        color: #2d3748;

        white-space: nowrap;
    }


    /* =====================================================
   DESCRIPTION
===================================================== */

    .plan-description {

        max-width: 300px;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;

        color: #718096;
    }


    /* =====================================================
   PHOTO
===================================================== */

    .plan-master-photo {

        width: 50px;

        height: 50px;

        min-width: 50px;

        object-fit: cover;

        border-radius: 10px;

        border: 2px solid #ffffff;

        box-shadow:
            0 3px 10px rgba(0, 0, 0, .08);
    }


    .plan-no-image {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        width: 70px;

        height: 45px;

        font-size: 11px;

        color: #aaa;

        background: #fafafa;

        border-radius: 8px;

        white-space: nowrap;
    }


    /* =====================================================
   STATUS
===================================================== */

    .plan-status {

        display: inline-flex;

        align-items: center;

        gap: 6px;

        padding: 7px 11px;

        border-radius: 20px;

        font-size: 11px;

        font-weight: 700;

        white-space: nowrap;
    }


    .plan-status::before {

        content: "";

        width: 6px;

        height: 6px;

        border-radius: 50%;

        background: currentColor;
    }


    .plan-status.active {

        background: #def7ec;

        color: #059669;
    }


    .plan-status.inactive {

        background: #fde8e8;

        color: #dc2626;
    }


    /* =====================================================
   ACTION BUTTON AREA
===================================================== */

    .plan-actions {

        display: flex;

        align-items: center;

        justify-content: flex-start;

        /* EDIT AUR DELETE KE BEECH PROPER SPACE */

        gap: 20px;

        min-width: 120px;

        width: max-content;

        flex-wrap: nowrap;

        white-space: nowrap;
    }


    /* =====================================================
   ACTION BUTTON
===================================================== */

    .plan-action-btn {

        width: 40px;

        height: 40px;

        min-width: 40px;

        flex: 0 0 40px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        border-radius: 10px;

        background: #edf2f7;

        border: 1px solid #e2e8f0;

        text-decoration: none;

        transition:
            transform .25s ease,
            background .25s ease,
            box-shadow .25s ease;
    }


    .plan-action-btn img {

        width: 18px !important;

        height: 18px !important;

        object-fit: contain;

        display: block;

        border: none !important;

        margin: 0 !important;

        padding: 0 !important;
    }


    /* EDIT / DELETE HOVER */

    .plan-action-btn:hover {

        background: #ffede0;

        transform: translateY(-3px);

        box-shadow:
            0 6px 14px rgba(255, 107, 53, .16);
    }


    /* =====================================================
   NO DATA
===================================================== */

    .no-plan-data {

        padding: 50px !important;

        text-align: center !important;

        font-size: 14px !important;

        color: #a0aec0 !important;
    }


    /* =====================================================
   TABLET
===================================================== */

    @media(max-width: 992px) {

        .plan-master-section {

            padding: 20px;
        }


        .plan-master-table {

            min-width: 1000px;
        }


        .plan-actions {

            gap: 18px;
        }


        .plan-action-btn {

            width: 38px;

            height: 38px;

            min-width: 38px;

            flex: 0 0 38px;
        }

    }


    /* =====================================================
   MOBILE
===================================================== */

    @media(max-width: 768px) {

        .plan-master-section {

            padding: 15px;
        }


        .plan-master-header {

            flex-direction: column;

            align-items: flex-start;

            gap: 18px;

            padding: 18px;
        }


        .add-plan-btn {

            width: 100%;
        }


        .plan-master-table {

            min-width: 1000px;
        }


        .plan-master-table th:nth-child(6),
        .plan-master-table td:nth-child(6) {

            min-width: 165px;

            width: 165px;
        }


        .plan-actions {

            gap: 16px;
        }

    }
</style>


<!-- =====================================================
     MAIN PAGE
===================================================== -->

<div class="plan-master-section">


    <!-- =====================================================
         PAGE HEADER
    ===================================================== -->

    <div class="plan-master-header">


        <!-- TITLE -->

        <div class="plan-master-heading">

            <div class="plan-master-icon">
                🍱
            </div>


            <div class="plan-master-title">

                <h1>
                    Tiffin Plan Master
                </h1>

                <p>
                    Manage your tiffin plans and services easily
                </p>

            </div>

        </div>


        <!-- ADD NEW PLAN -->

        <a href="add_plan_master.php" class="add-plan-btn">

            <i class="ri-add-line"></i>

            Add New Plan

        </a>


    </div>


    <!-- =====================================================
         TABLE
    ===================================================== -->

    <div class="plan-master-table-wrapper">

        <table class="plan-master-table">


            <!-- TABLE HEADER -->

            <thead>

                <tr>

                    <th>Plan ID</th>

                    <th>Plan Name</th>

                    <th>Description</th>

                    <th>Photo</th>

                    <th>Status</th>

                    <th>Action</th>

                </tr>

            </thead>


            <!-- TABLE BODY -->

            <tbody>

                <?php

                $q = mysqli_query(
                    $con,
                    "SELECT * FROM plan_master ORDER BY plan_id asc"
                );


                if ($q && mysqli_num_rows($q) > 0) {

                    while ($row = mysqli_fetch_assoc($q)) {

                        ?>

                        <tr>


                            <!-- PLAN ID -->

                            <td class="plan-id">

                                <?php
                                echo htmlspecialchars(
                                    $row['plan_id']
                                );
                                ?>

                            </td>


                            <!-- PLAN NAME -->

                            <td class="plan-name">

                                <?php
                                echo htmlspecialchars(
                                    $row['plan_name'] ?? ''
                                );
                                ?>

                            </td>


                            <!-- DESCRIPTION -->

                            <td>

                                <div class="plan-description" title="<?php
                                echo htmlspecialchars(
                                    $row['description'] ?? ''
                                );
                                ?>">

                                    <?php
                                    echo htmlspecialchars(
                                        $row['description'] ?? ''
                                    );
                                    ?>

                                </div>

                            </td>


                            <!-- PHOTO -->

                            <td>

                                <?php

                                if (!empty($row['photo'])) {

                                    ?>

                                    <img class="plan-master-photo" src="upload/<?php
                                    echo htmlspecialchars(
                                        $row['photo']
                                    );
                                    ?>" alt="Plan Photo">

                                    <?php

                                } else {

                                    ?>

                                    <span class="plan-no-image">

                                        No Image

                                    </span>

                                    <?php

                                }

                                ?>

                            </td>


                            <!-- STATUS -->

                            <td>

                                <?php

                                if (
                                    isset($row['status'])
                                    && $row['status'] == 1
                                ) {

                                    ?>

                                    <span class="plan-status active">

                                        Active

                                    </span>

                                    <?php

                                } else {

                                    ?>

                                    <span class="plan-status inactive">

                                        Inactive

                                    </span>

                                    <?php

                                }

                                ?>

                            </td>


                            <!-- ACTION -->

                            <td>

                                <div class="plan-actions">


                                    <!-- EDIT -->

                                    <a href="edit_plan_master.php?plan_id=<?php echo urlencode($row['plan_id']); ?>"
                                        class="plan-action-btn" title="Edit">

                                        <img src="./assets/img/edit.png" alt="Edit">

                                    </a>


                                    <!-- DELETE -->

                                    <a href="delete_plan_master.php?plan_id=<?php echo urlencode($row['plan_id']); ?>"
                                        class="plan-action-btn" title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this plan?');">

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

                        <td colspan="6" class="no-plan-data">

                            No Tiffin Plans Found

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