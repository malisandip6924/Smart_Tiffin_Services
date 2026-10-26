<?php
   include("../admin/connection.php");
?>
<!-- Mirrored from webstrot.com/html/lunchbox/lunchbox/customer-choice.html by HTTrack Website Copier/3.x
    [XR&CO'2014], Mon, 17 Aug 2026 17:00:26 GMT -->

<head>
    <meta charset="utf-8">
    <title>Lunch Box - Customer Choice</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="shortcut icon" type="image/png" href="images/logo/favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/fonts.css">
    <link rel="stylesheet" href="css/font-awesome-6.css">
    <link rel="stylesheet" type="text/css" href="css/grt-youtube-popup.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
</head>

<body>
    <main class="innerPage">

        <!--Preloader Start-->
        <div class="preloader" id="status">
            <div class="preloaderInner" id="preloader">
                <div class="loaderGroup">
                    <div class="loaderContent">
                        <div class="loading" data-loading-text="LunchBox..."></div>
                    </div>
                </div>
            </div>
        </div>
        <!--Preloader End-->

        <!--Header Start-->
        <?php
            include("header.php");
        ?>
        <!--header end-->

        <!-- search start -->
        <div class="searchBox">
            <div class="searchBoxCard">
                <a href="javascript:void(0);" class="searchBoxClose">
                    <i class="fa-solid fa-xmark"></i>
                </a>
                <div class="searchBoxInner">
                    <div class="searchBoxLogo">
                        <img src="images/logo/logo-white.png" alt="search" class="img-fluid">
                    </div>
                    <div class="searchBoxForm">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <button type="button" class="btn btnSecondary">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- search end -->

        <!--Banner Start-->
        <section class="w-100 clearfix innerPageBanner" id="innerPageBanner">
            <div class="container">
                <div class="innerPageBannerInner">
                    <div class="innerPageBannerImgLeft">
                        <img src="images/img24.png" alt="banner-img" class="img-fluid">
                    </div>
                    <div class="innerPageBannerContent">
                        <h1>Customer <span>Choice</span></h1>
                        
                    </div>
                    <div class="innerPageBannerImgRight">
                        <img src="images/img23.png" alt="banner-img" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>
        <!--Banner End-->

        <!-- Thali Detail Start -->
        <section class="w-100 clearfix thaliDetail" id="thaliDetail">
            <div class="container">
                <div class="thaliDetailInner">
                    <div class="thaliDetailRow">
                        <div class="thaliDetailCol">
                            <div class="thaliDetailImg">
                                <div class="thaliDetailImgInner">
                                    <?php
                                    $thaliid=$_GET['thaliid'];
                                    $q = mysqli_query($con, "SELECT * FROM thali_master where thali_id=$thaliid");
                                    while ($row = mysqli_fetch_assoc($q)) {
                                    ?>
                                    <img src="../admin/upload/<?php echo $row['photo']; ?>" alt="img"
                                        class="img-fluid thaliImg">
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="howItWorkCol">
                            <div class="howItWorkContent">
                                <div class="commonHeading headingLeft">
                                    <h4>Customer <span>Choice</span></h4>
                                </div>
                                <div class="customerChoiceList">
                                    <ul class="list-group list-group-horizontal">
                                        <?php
$itemQuery = mysqli_query($con, "SELECT * FROM item_master");

$count = 1;

while ($item = mysqli_fetch_assoc($itemQuery)) {
?>

                                        <li class="list-group-item">

                                            <input type="checkbox" id="myCheckbox<?php echo $count; ?>" name="items[]"
                                                value="<?php echo $item['item_id']; ?>" />

                                            <label for="myCheckbox<?php echo $count; ?>">

                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />

                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>

                                                <span>
                                                    <?php echo htmlspecialchars($item['item_name']); ?>
                                                </span>

                                            </label>

                                        </li>

                                        <?php
    $count++;
}
?>
                                        <!--<li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox1" />
                                            <label for="myCheckbox1">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Dalfry</span>
                                            </label>
                                        </li> 
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox2" />
                                            <label for="myCheckbox2">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Paneer</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox3" />
                                            <label for="myCheckbox3">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Aloo Mutter</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox4" />
                                            <label for="myCheckbox4">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>5 Roti</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox5" />
                                            <label for="myCheckbox5">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Rice</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox6" />
                                            <label for="myCheckbox6">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Salad</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox7" />
                                            <label for="myCheckbox7">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Papad</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox8" />
                                            <label for="myCheckbox8">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Dalfry</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox9" />
                                            <label for="myCheckbox9">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Paneer</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox10" />
                                            <label for="myCheckbox10">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Aloo Mutter</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox11" />
                                            <label for="myCheckbox11">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>5 Roti</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox12" />
                                            <label for="myCheckbox12">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Rice</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox13" />
                                            <label for="myCheckbox13">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Salad</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox14" />
                                            <label for="myCheckbox14">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Papad</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox15" />
                                            <label for="myCheckbox15">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Dalfry</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox16" />
                                            <label for="myCheckbox16">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Paneer</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox17" />
                                            <label for="myCheckbox17">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Aloo Mutter</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox18" />
                                            <label for="myCheckbox18">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>5 Roti</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox19" />
                                            <label for="myCheckbox19">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Rice</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox20" />
                                            <label for="myCheckbox20">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Salad</span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" id="myCheckbox21" />
                                            <label for="myCheckbox21">
                                                <svg fill="none" width="20" height="20" viewBox="0 0 20 20">
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M16.23 3.562c-2.353 0-4.569-.97-6.23-2.562-1.662 1.592-3.877 2.562-6.23 2.562-.97 0-1.87-.208-2.77-.485C1 12.769 4.808 16.647 10 19c5.192-2.354 9-6.23 9-15.923-.9.277-1.8.485-2.77.485z" />
                                                    <path stroke="#999" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-width="1.5"
                                                        d="M7.23 10l2.077 2.077 4.154-4.154" />
                                                </svg>
                                                <span>Papad</span>
                                            </label>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Thali Detail End -->

        <!-- Customer Review Start -->
        <section class="w-100 clearfix customerReview" id="customerReview">
            <div class="container">
                <h2 class="d-none">Customer Review</h2>
                <div class="customerReviewInner">
                    <!-- Nav pills -->
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill" href="#description">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#review">Review</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="description">
                            <div class="descriptionInner">
                                <p>Serving North-Indian, South-Indian and desi-Chinese
                                    cuisines, choose from Vegetarian
                                    and
                                    Non-Vegetarian meal options. dolor sit amet,
                                    consectetur Nulla fringilla purus at
                                    leo
                                    dignissim congue. Mauris elementum accumsan leo vel
                                    tempor. Sit amet cursus nisl
                                    aliquam.
                                    Aliquam et elit eu nunc rhoncus viverra quis at
                                    felis Vegetarian and Non-Vegetarian
                                    meal
                                    options. dolor sit amet, consectetur Nulla fringilla
                                    purus at leo dignissim congue.
                                    Mauris
                                    elementum accumsan leo vel tempor. Sit amet cursus
                                    nisl aliquam. Aliquam et elit eu
                                    nunc
                                    rhoncus viverra quis at felis.</p>

                                <p>Vegetarian and Non-Vegetarian meal options. dolor sit
                                    amet, consectetur Nulla
                                    fringilla purus
                                    at leo dignissim congue. Mauris elementum accumsan
                                    leo vel tempor.</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="review">
                            <div class="reviewInner">
                                <div class="row">
                                    <div class="col-md-5 col-lg-4">
                                        <div class="reviewStar">
                                            <div class="reviewStarInner">
                                                <div class="reviewStarHead">
                                                    <div class="reviewStarPoint">
                                                        <span>5.0</span>
                                                    </div>
                                                    <div class="review5Star">
                                                        <div class="review5StarInner">
                                                            <a href="javascript:void(0);"><i
                                                                    class="fa-solid fa-star"></i></a>
                                                            <a href="javascript:void(0);"><i
                                                                    class="fa-solid fa-star"></i></a>
                                                            <a href="javascript:void(0);"><i
                                                                    class="fa-solid fa-star"></i></a>
                                                            <a href="javascript:void(0);"><i
                                                                    class="fa-solid fa-star"></i></a>
                                                            <a href="javascript:void(0);"><i
                                                                    class="fa-solid fa-star"></i></a>
                                                        </div>
                                                        <div class="rating">
                                                            <p class="mb-0">2 Product
                                                                Ratings</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="reviewStarProg">
                                                    <div class="reviewStarProgItm">
                                                        <div class="reviewStarPoint">
                                                            <span>5</span> <i class="fa-solid fa-star"></i>
                                                        </div>
                                                        <div class="reviewProgBar">
                                                            <div class="progress" style="height:8px">
                                                                <div class="progress-bar" style="width:100%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="reviewProgPoint">
                                                            <span>2</span>
                                                        </div>
                                                    </div>
                                                    <div class="reviewStarProgItm">
                                                        <div class="reviewStarPoint">
                                                            <span>4</span> <i class="fa-solid fa-star"></i>
                                                        </div>
                                                        <div class="reviewProgBar">
                                                            <div class="progress" style="height:8px">
                                                                <div class="progress-bar" style="width:75%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="reviewProgPoint">
                                                            <span>1</span>
                                                        </div>
                                                    </div>
                                                    <div class="reviewStarProgItm">
                                                        <div class="reviewStarPoint">
                                                            <span>3</span> <i class="fa-solid fa-star"></i>
                                                        </div>
                                                        <div class="reviewProgBar">
                                                            <div class="progress" style="height:8px">
                                                                <div class="progress-bar" style="width:50%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="reviewProgPoint">
                                                            <span>2</span>
                                                        </div>
                                                    </div>
                                                    <div class="reviewStarProgItm">
                                                        <div class="reviewStarPoint">
                                                            <span>2</span> <i class="fa-solid fa-star"></i>
                                                        </div>
                                                        <div class="reviewProgBar">
                                                            <div class="progress" style="height:8px">
                                                                <div class="progress-bar" style="width:25%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="reviewProgPoint">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                    <div class="reviewStarProgItm">
                                                        <div class="reviewStarPoint">
                                                            <span>1</span> <i class="fa-solid fa-star"></i>
                                                        </div>
                                                        <div class="reviewProgBar">
                                                            <div class="progress" style="height:8px">
                                                                <div class="progress-bar" style="width:0%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="reviewProgPoint">
                                                            <span>0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="reviewStarContent">
                                                    <h5>Review this product</h5>
                                                    <p>Share your thoughts with other
                                                        customers</p>
                                                </div>
                                                <div class="writeReviewBtn">
                                                    <a href="check-out.html" class="btn btnPrimary">Write a
                                                        review</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-lg-8">
                                        <div class="reviewComment">
                                            <div class="reviewCommentInner">
                                                <div class="reviewCommenHeading">
                                                    <h5>Customer Reviews (5)</h5>
                                                </div>
                                                <div class="reviewCommentItemGroup">
                                                    <div class="reviewCommentItem">
                                                        <div class="reviewCommentItemInner">
                                                            <div class="reviewCommentHead">
                                                                <div class="reviewCommentInnerProfile">
                                                                    <div class="reviewCommentProfile">
                                                                        <span>
                                                                            <img src="images/chef7.png" alt="profile"
                                                                                class="img-fluid">
                                                                        </span>
                                                                    </div>
                                                                    <div class="reviewCommentProfNam">
                                                                        <h6>Liam</h6>
                                                                        <span>March 8,
                                                                            2024</span>
                                                                    </div>
                                                                </div>
                                                                <div class="review5Star">
                                                                    <div class="review5StarInner">
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="reviewCommentTxt">
                                                                <p>Life is a tapestry
                                                                    woven from the
                                                                    threads of our
                                                                    experiences, each
                                                                    moment a brushstroke
                                                                    on the canvas
                                                                    of our existence. It
                                                                    is a journey filled
                                                                    with ups
                                                                    and downs, twists
                                                                    and turns, yet it is
                                                                    also one
                                                                    imbued with beauty
                                                                    and wonder. For it
                                                                    is through our
                                                                    struggles that we
                                                                    learn the value of
                                                                    resilience, the
                                                                    power of
                                                                    perseverance in the
                                                                    face of adversity.
                                                                    And
                                                                    though the road may
                                                                    be long and winding,
                                                                    it is
                                                                    ultimately our
                                                                    ability to embrace
                                                                    the challenges
                                                                    that lie ahead that
                                                                    defines us, shaping
                                                                    us into the
                                                                    individuals we are
                                                                    meant to become.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="reviewCommentItem">
                                                        <div class="reviewCommentItemInner">
                                                            <div class="reviewCommentHead">
                                                                <div class="reviewCommentInnerProfile">
                                                                    <div class="reviewCommentProfile">
                                                                        <span>
                                                                            <img src="images/chef8.png" alt="profile"
                                                                                class="img-fluid">
                                                                        </span>
                                                                    </div>
                                                                    <div class="reviewCommentProfNam">
                                                                        <h6>Isabella
                                                                        </h6>
                                                                        <span>March 9,
                                                                            2024</span>
                                                                    </div>
                                                                </div>
                                                                <div class="review5Star">
                                                                    <div class="review5StarInner">
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="reviewCommentTxt">
                                                                <p>In the quest for
                                                                    meaning and purpose,
                                                                    we are often
                                                                    confronted with
                                                                    moments of profound
                                                                    introspection.
                                                                    It is during these
                                                                    times of reflection
                                                                    that we come
                                                                    to understand the
                                                                    complexities of our
                                                                    existence, the
                                                                    interconnectedness
                                                                    of all things. Yet,
                                                                    amidst the
                                                                    chaos and
                                                                    uncertainty, there
                                                                    exists a sense of
                                                                    clarity, a
                                                                    deep-seated knowing
                                                                    that transcends the
                                                                    limitations of our
                                                                    understanding. For
                                                                    it is through
                                                                    the exploration of
                                                                    our innermost selves
                                                                    that we
                                                                    discover the true
                                                                    essence of our
                                                                    being, the inherent
                                                                    wisdom that lies
                                                                    dormant within us.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="reviewCommentItem">
                                                        <div class="reviewCommentItemInner">
                                                            <div class="reviewCommentHead">
                                                                <div class="reviewCommentInnerProfile">
                                                                    <div class="reviewCommentProfile">
                                                                        <span>
                                                                            <img src="images/chef5.png" alt="profile"
                                                                                class="img-fluid">
                                                                        </span>
                                                                    </div>
                                                                    <div class="reviewCommentProfNam">
                                                                        <h6>Ethan</h6>
                                                                        <span>March 10,
                                                                            2024</span>
                                                                    </div>
                                                                </div>
                                                                <div class="review5Star">
                                                                    <div class="review5StarInner">
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"
                                                                            class="inactive"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="reviewCommentTxt">
                                                                <p>The pursuit of
                                                                    excellence often
                                                                    entails confronting
                                                                    our deepest fears
                                                                    and overcoming the
                                                                    obstacles that
                                                                    stand in our way. It
                                                                    is a journey fraught
                                                                    with
                                                                    uncertainty and
                                                                    doubt, yet it is
                                                                    also one filled
                                                                    with endless
                                                                    possibilities and
                                                                    opportunities for
                                                                    growth. For it is
                                                                    through our
                                                                    struggles that we
                                                                    learn the true
                                                                    meaning of
                                                                    resilience, the
                                                                    power of
                                                                    perseverance in the
                                                                    face of adversity.
                                                                    And though
                                                                    the road may be long
                                                                    and arduous, it is
                                                                    ultimately
                                                                    our unwavering
                                                                    determination that
                                                                    propels us
                                                                    forward, guiding us
                                                                    towards the
                                                                    realization of our
                                                                    fullest potential.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="reviewCommentItem">
                                                        <div class="reviewCommentItemInner">
                                                            <div class="reviewCommentHead">
                                                                <div class="reviewCommentInnerProfile">
                                                                    <div class="reviewCommentProfile">
                                                                        <span>
                                                                            <img src="images/chef9.png" alt="profile"
                                                                                class="img-fluid">
                                                                        </span>
                                                                    </div>
                                                                    <div class="reviewCommentProfNam">
                                                                        <h6>Sophia</h6>
                                                                        <span>March 20,
                                                                            2024</span>
                                                                    </div>
                                                                </div>
                                                                <div class="review5Star">
                                                                    <div class="review5StarInner">
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"
                                                                            class="inactive"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"
                                                                            class="inactive"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="reviewCommentTxt">
                                                                <p>Life is a journey
                                                                    filled with twists
                                                                    and turns,
                                                                    trials and
                                                                    tribulations. At
                                                                    times, it may seem
                                                                    as
                                                                    though we are
                                                                    navigating through a
                                                                    maze of
                                                                    challenges, each
                                                                    obstacle testing our
                                                                    resolve and
                                                                    pushing us to our
                                                                    limits. Yet, it is
                                                                    in these
                                                                    moments of
                                                                    uncertainty that we
                                                                    discover our true
                                                                    strength, our
                                                                    ability to persevere
                                                                    in the face of
                                                                    adversity. For it is
                                                                    not our successes
                                                                    that define
                                                                    us, but rather our
                                                                    ability to rise
                                                                    after each fall,
                                                                    to dust ourselves
                                                                    off and continue on
                                                                    the path
                                                                    towards our dreams.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="reviewCommentItem">
                                                        <div class="reviewCommentItemInner">
                                                            <div class="reviewCommentHead">
                                                                <div class="reviewCommentInnerProfile">
                                                                    <div class="reviewCommentProfile">
                                                                        <span>
                                                                            <img src="images/chef4.png" alt="profile"
                                                                                class="img-fluid">
                                                                        </span>
                                                                    </div>
                                                                    <div class="reviewCommentProfNam">
                                                                        <h6>Alexander
                                                                        </h6>
                                                                        <span>March 26,
                                                                            2024</span>
                                                                    </div>
                                                                </div>
                                                                <div class="review5Star">
                                                                    <div class="review5StarInner">
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"
                                                                            class="inactive"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                        <a href="javascript:void(0);"
                                                                            class="inactive"><i
                                                                                class="fa-solid fa-star"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="reviewCommentTxt">
                                                                <p>Duis aute irure dolor
                                                                    in reprehenderit in
                                                                    voluptate
                                                                    velit esse cillum
                                                                    dolore eu fugiat
                                                                    nulla pariatur.
                                                                    Excepteur sint
                                                                    occaecat cupidatat
                                                                    non proident, sunt
                                                                    in culpa qui officia
                                                                    deserunt mollit anim
                                                                    id est
                                                                    laborum. Sed ut
                                                                    perspiciatis unde
                                                                    omnis iste natus
                                                                    error sit voluptatem
                                                                    accusantium
                                                                    doloremque
                                                                    laudantium, totam
                                                                    rem aperiam.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Customer Review End -->

        <!-- Watch Video Start -->
       <!--<section class="w-100 clearfix lbWatchVideo" id="lbWatchVideo">
            <div class="container">
                <h2 class="d-none">watch video</h2>
                <div class="lbWatchVideoInner">
                    <div class="lbWatchVideoRow">
                        <div class="lbWatchVideoCol">
                            <div class="specialDishBtnGroup">
                                <div class="specialDishWatchVideoBtn">
                                    <a href="javascript:void(0)" class="youtube-link circle pulse"
                                        data-youtube-id="VKQIU3fg5kI">
                                        <span class="playIcon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="18"
                                                viewBox="0 0 15 18" fill="none">
                                                <path d="M1 1V17L14 9L1 1Z" stroke="#FFA31E" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                        <span>Watch video</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="lbWatchVideoCol">
                            <div class="customerChoiceVideo">
                                <div class="customerVideoBg">
                                    <img src="images/video-bg-img.png" alt="video-icon" class="img-fluid">
                                </div>
                                 <a href="javascript:void(0);" class="customerChoicePlayBtn"> 
                                <a href="javascript:void(0)" class="youtube-link customerChoicePlayBtn circle pulse"
                                    data-youtube-id="fftdu8Up9Q8">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="104" height="104"
                                        viewBox="0 0 104 104" fill="none">
                                        <circle opacity="0.2" cx="52" cy="52" r="52" fill="white" />
                                        <circle opacity="0.5" cx="52" cy="52" r="42" fill="white" />
                                        <circle cx="52" cy="52" r="32" fill="white" />
                                        <path
                                            d="M62.7799 49.0556C62.3919 48.8171 61.8817 48.9338 61.64 49.3162C61.3983 49.6986 61.5166 50.2016 61.9043 50.4399C62.8066 50.9947 63.3452 51.9517 63.3452 53.0001C63.3452 54.0485 62.8066 55.0056 61.9043 55.5604L48.3339 63.9026C47.3766 64.4911 46.2162 64.5201 45.2299 63.9805C44.2434 63.4408 43.6545 62.4546 43.6545 61.3424V44.6577C43.6545 43.5456 44.2434 42.5593 45.2299 42.0196C46.2162 41.48 47.3766 41.509 48.3339 42.0975L56.2337 46.9539C56.6216 47.192 57.1318 47.0755 57.3736 46.6933C57.6154 46.311 57.4971 45.8078 57.1093 45.5695L49.2095 40.7133C47.7347 39.8067 45.947 39.7617 44.4269 40.5933C42.9073 41.4247 42 42.9442 42 44.6577V61.3423C42 63.0558 42.9073 64.5753 44.4271 65.4067C45.151 65.8027 45.9354 66 46.7182 66C47.5787 66 48.4372 65.7616 49.2095 65.2867L62.7799 56.9444C64.1701 56.0898 65 54.6153 65 53C65 51.3847 64.1701 49.9102 62.7799 49.0556Z"
                                            fill="#FFA31E" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <img src="images/dash-arrow1.png" alt="arrow" class="img-fluid lbArrow">
                </div>
            </div>
        </section> -->
        <!-- Watch Video End -->

        <!--Trusted by users Start-->
        <!-- <section class="w-100 clearfix trustedUsers" id="trustedUsers">
            <div class="container">
                <div class="trustedUsersInner">
                    <div class="commonHeading headingCenter">
                        <h2 class="d-none">Trusted Users</h2>
                        <p class="mb-0">Trusted by 45M+ users</p>
                    </div>
                    <div class="owl-carousel owl-theme trustedUsersCarousel">
                        <div class="item">
                            <div class="trustedUsersItem">
                                <a href="javascript:void(0);"><img src="images/partner1.png" alt="trusted-users"
                                        class="img-fluid"></a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="trustedUsersItem">
                                <a href="javascript:void(0);"><img src="images/partner2.png" alt="trusted-users"
                                        class="img-fluid"></a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="trustedUsersItem">
                                <a href="javascript:void(0);"><img src="images/partner3.png" alt="trusted-users"
                                        class="img-fluid"></a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="trustedUsersItem">
                                <a href="javascript:void(0);"><img src="images/partner4.png" alt="trusted-users"
                                        class="img-fluid"></a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="trustedUsersItem">
                                <a href="javascript:void(0);"><img src="images/partner5.png" alt="trusted-users"
                                        class="img-fluid"></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section> -->
        <!--Trusted by users End-->

        <!--Footer Section Start-->
        <?php
            include("footer.php");
        ?>
        <!--Footer Section End-->

    </main>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/anime.min.js"></script>
    <script src="js/grt-youtube-popup.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
    <script>
    $(".youtube-link").grtyoutube({
        autoPlay: true,
        theme: "dark",
    });
    </script>
</body>


<!-- Mirrored from webstrot.com/html/lunchbox/lunchbox/customer-choice.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Aug 2026 17:00:27 GMT -->

</html>