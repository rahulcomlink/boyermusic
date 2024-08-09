
<?php
session_start();
require_once '../db/connection.php';
include 'function.php';
include 'functions.php';


if (!isset($_SESSION['userCode'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
$productionCode = $_SESSION['productionCode'];

// Get Production Name
// $productionNameQuery = "SELECT user_production_name FROM user_details WHERE user_unicode = '$productionCode'";
// $productionNameResult = $conn->query($productionNameQuery);
// $productionNameRow = $productionNameResult->fetch_assoc();
// $productionName = $productionNameRow['user_production_name'];
// $productionIcon = $productionNameRow['user_mail_otp'];
// echo $productionIcon;

$productionName = '';
$productionIcon = '';

// Prepare the query
$productionNameQuery = "SELECT user_production_name, user_mail_otp FROM user_details WHERE user_unicode = '$productionCode'";
$productionNameResult = $conn->query($productionNameQuery);

if ($productionNameResult) {
    if ($productionNameResult->num_rows > 0) {
        $productionNameRow = $productionNameResult->fetch_assoc();
        $productionName = $productionNameRow['user_production_name'];
        $productionIcon = $productionNameRow['user_mail_otp'];
    } else {
        echo "No records found for the given user_unicode.";
    }
    $productionNameResult->free();
} else {
    echo "Error executing query: " . $conn->error;
}


?>
<!doctype html>
<html lang="en" class="minimal-theme">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
  <!--plugins-->
  <link href="<?php echo getBaseUrl(); ?>/public/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="<?php echo getBaseUrl(); ?>/public/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
  <link href="<?php echo getBaseUrl(); ?>/public/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
  <link href="<?php echo getBaseUrl(); ?>/public/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
  <link href="<?php echo getBaseUrl(); ?>/public/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="<?php echo getBaseUrl(); ?>/public/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo getBaseUrl(); ?>/public/assets/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="<?php echo getBaseUrl(); ?>/public/assets/css/style.css" rel="stylesheet" />
  <link href="<?php echo getBaseUrl(); ?>/public/assets/css/icons.css" rel="stylesheet">
  <link href="<?php echo getBaseUrl(); ?>/public/assets/fonts.googleapis.com/css276c7.css?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo getBaseUrl(); ?>/public/assets/cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- loader-->
  <link rel="stylesheet" type="text/css"
  href="https://cdn.jsdelivr.net/gh/lafeber/world-flags-sprite/stylesheets/flags32-both.css" />
	<link href="<?php echo getBaseUrl(); ?>/public/assets/css/pace.min.css" rel="stylesheet" />

  <!--Theme Styles-->
  <link href="<?php echo getBaseUrl(); ?>/public/assets/css/dark-theme.css" rel="stylesheet" />
  <link href="<?php echo getBaseUrl(); ?>/public/assets/css/light-theme.css" rel="stylesheet" />
  <link href="<?php echo getBaseUrl(); ?>/public/assets/css/semi-dark.css" rel="stylesheet" />
  <link href="<?php echo getBaseUrl(); ?>/public/assets/css/header-colors.css" rel="stylesheet" />
  <link href="<?php echo getBaseUrl(); ?>/public/assets/css/custom.css" rel="stylesheet" />


    <link href="<?php echo getBaseUrl(); ?>/public/assets/plugins/datetimepicker/css/classic.css" rel="stylesheet" />
    <link href="<?php echo getBaseUrl(); ?>/public/assets/plugins/datetimepicker/css/classic.time.css" rel="stylesheet" />
    <link href="<?php echo getBaseUrl(); ?>/public/assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo getBaseUrl(); ?>/public/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css"> 

<!-- Select 2 -->
    <link href="<?php echo getBaseUrl(); ?>/public/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="<?php echo getBaseUrl(); ?>/public/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />

    <!-- Data Table -->
    <link href="<?php echo getBaseUrl(); ?>/public/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />



    <!-- FANCY FILE UPLOAD -->

    <link href="<?php echo getBaseUrl(); ?>/public/assets/plugins/fancy-file-uploader/fancy_fileupload.css" rel="stylesheet" />
	  <link href="<?php echo getBaseUrl(); ?>/public/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="custom.css">
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>



  <title>Shri Boyer Music</title>
  <style>

        #image-preview {
            display: flex;
            flex-wrap: wrap;
        }

        .preview-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin: 10px;
        }

        #secondDropdownContainer {
            display: none;
        }
        .khowai_color{
          background-color: #9ADE7BD9;
        }
    </style>
</head>

<body>


  <!--start wrapper-->
  <div class="wrapper">
    <!--start top header-->
      <header class="top-header">
      <!-- style="background-image: url('<?php echo getBaseUrl(); ?>/public/assets/images/banner.png'); background-size: cover; background-repeat: no-repeat;height:160px;" -->

      <nav class="navbar navbar-expand" style="justify-content:right;background:#176B87">
          <div class="mobile-toggle-icon d-xl-none">
              <i class="bi bi-list"></i>
            </div>
            <div class="top-navbar d-none d-xl-block">
            
            </div>
            
            <div class="top-navbar-right ms-3">
              <ul class="navbar-nav align-items-center">
              <li class="nav-item dropdown dropdown-large">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                  <div class="user-setting d-flex align-items-center gap-1">
                    <img src="../public/productionImage/<?php echo $productionIcon; ?>" class="user-img" alt="">
                    <div class="user-name d-none d-sm-block"><?php echo $productionName; ?></div>
                  </div>
                </a>
                
              </li>
              
              </ul>
              </div>
        </nav>
      </header>
       <!--end top header-->

        <!--start sidebar -->
        <aside class="sidebar-wrapper" data-simplebar="true" style="background:#263544;">
          <!-- <div class="sidebar-header">
            
            <div>
            

            </div>
            <div class="toggle-icon ms-auto"><i class="bi bi-chevron-double-left"></i>
            </div>
          </div> -->

          <!-- <img src="<?php echo getBaseUrl(); ?>/public/logo/logo.png" style="width:30%"> -->
          <ul class="metismenu" id="menu" style="margin-top:1px !important">
            
          
            <li style="background:#0B666A">
                <a href="dashboard.php" style="color:white;">
                <div class="parent-icon"><i class="fa-solid fa-gauge"></i>
                </div>
                <div class="menu-title" style="color:white;font-weight:700;">Dashboard</div>
              </a>
            </li>

            <li>
              <a href="javascript:;" class="has-arrow" style="color:white;">
                <div class="parent-icon"><i class="fa-solid fa-music"></i>
                </div>
                <div class="menu-title" style="color:white;font-weight:700;">Songs</div>
              </a>
              <ul>
                
            <li> <a href="listedSong.php" style="color:white;font-weight:700px;"><i class="fa-brands fa-creative-commons-sampling-plus"></i>Listed Songs</a>
            </li>

            <li> <a href="all_songs.php" style="color:white;font-weight:700px;"><i class="fa-solid fa-clock"></i>Songs Bank</a>
            </li>
                
              </ul>
            </li>



            <li >
              <a href="javascript:;" class="has-arrow" style="color:white;">
                <div class="parent-icon"><i class="fa-solid fa-magnifying-glass-chart"></i>
                </div>
                <div class="menu-title" style="color:white;font-weight:700">Premium Report</div>
              </a>
              <ul>
                <li> <a href="filterPremiumPlatform.php" style="color:white;font-weight:700px;"><i class="fa-solid fa-layer-group"></i>Platform Report</a>
                </li>
                <li> <a href="filterPremiumMusic.php" style="color:white;font-weight:700px;"><i class="fa-solid fa-chart-simple"></i>Music Report</a>
                </li>

                </li>




               
              </ul>
            </li>

            <li >
              <a href="javascript:;" class="has-arrow" style="color:white;">
                <div class="parent-icon"><i class="fa-solid fa-file-shield"></i>
                </div>
                <div class="menu-title" style="color:white;font-weight:700">Report</div>
              </a>
              <ul>
                <li> <a href="platformFilterBalance.php" style="color:white;font-weight:700px;"><i class="fa-solid fa-layer-group"></i>Platform Report</a>
                </li>
                <li> <a href="filterMusic.php" style="color:white;font-weight:700px;"><i class="fa-solid fa-chart-simple"></i>Music Report</a>
                </li> 
              </ul>
            </li>


            <li style="background:#0B666A">
                <a href="songUpload.php" style="color:white;">
                <div class="parent-icon"><i class="fa-solid fa-upload"></i>
                </div>
                <div class="menu-title" style="color:white;font-weight:700;">Upload Song</div>
              </a>
            </li>

            <li >
              <a href="javascript:;" class="has-arrow" style="color:white;">
                <div class="parent-icon"><i class="fa-solid fa-gear"></i>
                </div>
                <div class="menu-title" style="color:white;font-weight:700">Setting</div>
              </a>

              <ul>
              <li> <a href="bankDetails.php" style="color:white;font-weight:700px;"><i class="fa-solid fa-list"></i>Add Bank Information</a>
                </li>
                <li> <a href="setting.php" style="color:white;font-weight:700px;"><i class="fa-solid fa-wrench"></i>General Setting</a>
                </li>
                
                
                
              </ul>
            </li>
            
 


           

            <li style="background:#06D001; color:white;border-radius:5px;">
                <a href="logout.php" class="has-arrow" style="color:white;">
                <div class="parent-icon"><i class="fa-solid fa-right-from-bracket"></i>
                </div>
                <div class="menu-title" style="color:black;font-weight:700;">Sign Out</div>
              </a>
            </li>


            

           
          </ul>
          <!--end navigation-->
       </aside>
       <!--end sidebar -->