<?php
session_start();
require_once '../db/connection.php';
include 'function.php';

if (!isset($_SESSION['userCode'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
$productionCode = $_SESSION['productionCode'];

// Get Production Name
$productionNameQuery = "SELECT user_production_name FROM user_details WHERE user_unicode = '$productionCode'";
$productionNameResult = $conn->query($productionNameQuery);
$productionNameRow = $productionNameResult->fetch_assoc();
$productionName = $productionNameRow['user_production_name'];


?>


<!doctype html>
<html lang="en" class="minimal-theme">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png" />
  <!--plugins-->
  <link href="<?php echo getUrlAsset() ?>/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="<?php echo getUrlAsset() ?>/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
  <link href="<?php echo getUrlAsset() ?>/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
  <link href="<?php echo getUrlAsset() ?>/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="<?php echo getUrlAsset() ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo getUrlAsset() ?>/assets/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="<?php echo getUrlAsset() ?>/assets/css/style.css" rel="stylesheet" />
  <link href="<?php echo getUrlAsset() ?>/assets/css/icons.css" rel="stylesheet">
  <link href="<?php echo getUrlAsset() ?>/assets/fonts.googleapis.com/css276c7.css?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo getUrlAsset() ?>/assets/cdn.jsdelivr.net/npm/bootstrap-icons%401.5.0/font/bootstrap-icons.css">
  <link href="<?php echo getUrlAsset() ?>/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <link href="<?php echo getUrlAsset() ?>/assets/plugins/fancy-file-uploader/fancy_fileupload.css" rel="stylesheet" />
	<link href="<?php echo getUrlAsset() ?>/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />

  <link href="<?php echo getUrlAsset() ?>/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
  <link href="<?php echo getUrlAsset() ?>/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
  <link href="<?php echo getUrlAsset() ?>/assets/plugins/datetimepicker/css/classic.css" rel="stylesheet" />
	<link href="<?php echo getUrlAsset() ?>/assets/plugins/datetimepicker/css/classic.time.css" rel="stylesheet" />
	<link href="<?php echo getUrlAsset() ?>/assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo getUrlAsset() ?>/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css">


  <!-- loader-->
	<link href="<?php echo getUrlAsset() ?>/assets/css/pace.min.css" rel="stylesheet" />

  <!--Theme Styles-->
  <link href="<?php echo getUrlAsset() ?>/assets/css/dark-theme.css" rel="stylesheet" />
  <link href="<?php echo getUrlAsset() ?>/assets/css/light-theme.css" rel="stylesheet" />
  <link href="<?php echo getUrlAsset() ?>/assets/css/semi-dark.css" rel="stylesheet" />
  <link href="<?php echo getUrlAsset() ?>/assets/css/header-colors.css" rel="stylesheet" />

  <title>Users Dashboard - Boyar Music</title>
</head>

<body>



  <!--start wrapper-->
  <div class="wrapper">
    <!--start top header-->
      <header class="top-header">        
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
                    <img src="../public/img/logo.png" class="user-img" alt="">
                    <div class="user-name d-none d-sm-block"><?php echo $productionName; ?></div>
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                     <a class="dropdown-item" href="#">
                       <div class="d-flex align-items-center">
                          <img src="../public/img/logo.png" alt="" class="rounded-circle" width="60" height="60">
                          <div class="ms-3">
                            <h6 class="mb-0 dropdown-user-name"><?php echo $productionName; ?></h6>
                            <small class="mb-0 dropdown-user-designation text-secondary">Production</small>
                          </div>
                       </div>
                     </a>
                   </li>
                   <li><hr class="dropdown-divider"></li>
                   <li>
                      <a class="dropdown-item" href="pages-user-profile.html">
                         <div class="d-flex align-items-center">
                           <div class="setting-icon"><i class="bi bi-person-fill"></i></div>
                           <div class="setting-text ms-3"><span>Profile</span></div>
                         </div>
                       </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                         <div class="d-flex align-items-center">
                           <div class="setting-icon"><i class="bi bi-gear-fill"></i></div>
                           <div class="setting-text ms-3"><span>Bank Setting</span></div>
                         </div>
                       </a>
                    </li>
                    
                    <li><hr class="dropdown-divider"></li>
                    <li>
                      <a class="dropdown-item" href="authentication-signup-with-header-footer.html">
                         <div class="d-flex align-items-center">
                           <div class="setting-icon"><i class="bi bi-lock-fill"></i></div>
                           <div class="setting-text ms-3"><span>Logout</span></div>
                         </div>
                       </a>
                    </li>
                </ul>
              </li>
              <!-- <li class="nav-item dropdown dropdown-large">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                  <div class="projects">
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                   <div class="row row-cols-3 gx-2">
                      <div class="col">
                        <a href="ecommerce-orders.html">
                         <div class="apps p-2 radius-10 text-center">
                            <div class="apps-icon-box mb-1 text-white bg-primary bg-gradient">
                              <i class="bi bi-cart-plus-fill"></i>
                            </div>
                            <p class="mb-0 apps-name">Orders</p>
                         </div>
                        </a>
                      </div>
                      <div class="col">
                        <a href="javascript:;">
                        <div class="apps p-2 radius-10 text-center">
                           <div class="apps-icon-box mb-1 text-white bg-danger bg-gradient">
                             <i class="bi bi-people-fill"></i>
                           </div>
                           <p class="mb-0 apps-name">Users</p>
                        </div>
                      </a>
                     </div>
                     <div class="col">
                      <a href="ecommerce-products-grid.html">
                      <div class="apps p-2 radius-10 text-center">
                         <div class="apps-icon-box mb-1 text-white bg-success bg-gradient">
                          <i class="bi bi-bank2"></i>
                         </div>
                         <p class="mb-0 apps-name">Products</p>
                      </div>
                      </a>
                    </div>
                    <div class="col">
                      <a href="component-media-object.html">
                      <div class="apps p-2 radius-10 text-center">
                         <div class="apps-icon-box mb-1 text-white bg-orange bg-gradient">
                          <i class="bi bi-collection-play-fill"></i>
                         </div>
                         <p class="mb-0 apps-name">Media</p>
                      </div>
                      </a>
                    </div>
                    <div class="col">
                      <a href="pages-user-profile.html">
                      <div class="apps p-2 radius-10 text-center">
                         <div class="apps-icon-box mb-1 text-white bg-purple bg-gradient">
                          <i class="bi bi-person-circle"></i>
                         </div>
                         <p class="mb-0 apps-name">Account</p>
                       </div>
                      </a>
                    </div>
                    <div class="col">
                      <a href="javascript:;">
                      <div class="apps p-2 radius-10 text-center">
                         <div class="apps-icon-box mb-1 text-dark bg-info bg-gradient">
                          <i class="bi bi-file-earmark-text-fill"></i>
                         </div>
                         <p class="mb-0 apps-name">Docs</p>
                      </div>
                      </a>
                    </div>
                    <div class="col">
                      <a href="ecommerce-orders-detail.html">
                      <div class="apps p-2 radius-10 text-center">
                         <div class="apps-icon-box mb-1 text-white bg-pink bg-gradient">
                          <i class="bi bi-credit-card-fill"></i>
                         </div>
                         <p class="mb-0 apps-name">Payment</p>
                      </div>
                      </a>
                    </div>
                    <div class="col">
                      <a href="javascript:;">
                      <div class="apps p-2 radius-10 text-center">
                         <div class="apps-icon-box mb-1 text-white bg-bronze bg-gradient">
                          <i class="bi bi-calendar-check-fill"></i>
                         </div>
                         <p class="mb-0 apps-name">Events</p>
                      </div>
                    </a>
                    </div>
                    <div class="col">
                      <a href="javascript:;">
                      <div class="apps p-2 radius-10 text-center">
                         <div class="apps-icon-box mb-1 text-dark bg-warning bg-gradient">
                          <i class="bi bi-book-half"></i>
                         </div>
                         <p class="mb-0 apps-name">Story</p>
                        </div>
                      </a>
                    </div>
                   </div>
                </div>
              </li> -->
              <!-- <li class="nav-item dropdown dropdown-large">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                  <div class="messages">
                    <span class="notify-badge">5</span>
                    <i class="bi bi-messenger"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end p-0">
                  <div class="p-2 border-bottom m-2">
                      <h5 class="h5 mb-0">Messages</h5>
                  </div>
                 <div class="header-message-list p-2">
                    <div class="dropdown-item bg-light radius-10 mb-1">
                      <form class="dropdown-searchbar position-relative">
                        <div class="position-absolute top-50 start-0 translate-middle-y px-3 search-icon"><i class="bi bi-search"></i></div>
                        <input class="form-control" type="search" placeholder="Search Messages">
                      </form>
                    </div>
                     <a class="dropdown-item" href="#">
                       <div class="d-flex align-items-center">
                          <img src="{{baseUrl}}/assets/images/avatars/avatar-1.png" alt="" class="rounded-circle" width="52" height="52">
                          <div class="ms-3 flex-grow-1">
                            <h6 class="mb-0 dropdown-msg-user">Amelio Joly <span class="msg-time float-end text-secondary">1 m</span></h6>
                            <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">The standard chunk of lorem...</small>
                          </div>
                       </div>
                     </a>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                         <img src="{{baseUrl}}/assets/images/avatars/avatar-2.png" alt="" class="rounded-circle" width="52" height="52">
                         <div class="ms-3 flex-grow-1">
                           <h6 class="mb-0 dropdown-msg-user">Althea Cabardo <span class="msg-time float-end text-secondary">7 m</span></h6>
                           <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Many desktop publishing</small>
                         </div>
                      </div>
                    </a>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                         <img src="{{baseUrl}}/assets/images/avatars/avatar-3.png" alt="" class="rounded-circle" width="52" height="52">
                         <div class="ms-3 flex-grow-1">
                           <h6 class="mb-0 dropdown-msg-user">Katherine Pechon <span class="msg-time float-end text-secondary">2 h</span></h6>
                           <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Making this the first true</small>
                         </div>
                      </div>
                    </a>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                         <img src="{{baseUrl}}/assets/images/avatars/avatar-4.png" alt="" class="rounded-circle" width="52" height="52">
                         <div class="ms-3 flex-grow-1">
                           <h6 class="mb-0 dropdown-msg-user">Peter Costanzo <span class="msg-time float-end text-secondary">3 h</span></h6>
                           <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">It was popularised in the 1960</small>
                         </div>
                      </div>
                    </a>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                         <img src="{{baseUrl}}/assets/images/avatars/avatar-5.png" alt="" class="rounded-circle" width="52" height="52">
                         <div class="ms-3 flex-grow-1">
                           <h6 class="mb-0 dropdown-msg-user">Thomas Wheeler <span class="msg-time float-end text-secondary">1 d</span></h6>
                           <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">If you are going to use a passage</small>
                         </div>
                      </div>
                    </a>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                         <img src="{{baseUrl}}/assets/images/avatars/avatar-6.png" alt="" class="rounded-circle" width="52" height="52">
                         <div class="ms-3 flex-grow-1">
                           <h6 class="mb-0 dropdown-msg-user">Johnny Seitz <span class="msg-time float-end text-secondary">2 w</span></h6>
                           <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">All the Lorem Ipsum generators</small>
                         </div>
                      </div>
                    </a>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                         <img src="{{baseUrl}}/assets/images/avatars/avatar-1.png" alt="" class="rounded-circle" width="52" height="52">
                         <div class="ms-3 flex-grow-1">
                           <h6 class="mb-0 dropdown-msg-user">Amelio Joly <span class="msg-time float-end text-secondary">1 m</span></h6>
                           <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">The standard chunk of lorem...</small>
                         </div>
                      </div>
                    </a>
                   <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                        <img src="{{baseUrl}}/assets/images/avatars/avatar-2.png" alt="" class="rounded-circle" width="52" height="52">
                        <div class="ms-3 flex-grow-1">
                          <h6 class="mb-0 dropdown-msg-user">Althea Cabardo <span class="msg-time float-end text-secondary">7 m</span></h6>
                          <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Many desktop publishing</small>
                        </div>
                     </div>
                   </a>
                   <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                        <img src="{{baseUrl}}/assets/images/avatars/avatar-3.png" alt="" class="rounded-circle" width="52" height="52">
                        <div class="ms-3 flex-grow-1">
                          <h6 class="mb-0 dropdown-msg-user">Katherine Pechon <span class="msg-time float-end text-secondary">2 h</span></h6>
                          <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Making this the first true</small>
                        </div>
                     </div>
                   </a>
                </div>
                <div class="p-2">
                  <div><hr class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                      <div class="text-center">View All Messages</div>
                    </a>
                </div>
               </div>
              </li> -->
              <!-- <li class="nav-item dropdown dropdown-large d-none d-sm-block">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                  <div class="notifications">
                    <span class="notify-badge">8</span>
                    <i class="bi bi-bell-fill"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end p-0">
                  <div class="p-2 border-bottom m-2">
                      <h5 class="h5 mb-0">Notifications</h5>
                  </div>
                  <div class="header-notifications-list p-2">
                     <div class="dropdown-item bg-light radius-10 mb-1">
                      <form class="dropdown-searchbar position-relative">
                        <div class="position-absolute top-50 start-0 translate-middle-y px-3 search-icon"><i class="bi bi-search"></i></div>
                        <input class="form-control" type="search" placeholder="Search Messages">
                      </form>
                      </div>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex align-items-center">
                           <div class="notification-box"><i class="bi bi-basket2-fill"></i></div>
                           <div class="ms-3 flex-grow-1">
                             <h6 class="mb-0 dropdown-msg-user">New Orders <span class="msg-time float-end text-secondary">1 m</span></h6>
                             <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">You have recived new orders</small>
                           </div>
                        </div>
                      </a>
                     <a class="dropdown-item" href="#">
                       <div class="d-flex align-items-center">
                        <div class="notification-box"><i class="bi bi-people-fill"></i></div>
                          <div class="ms-3 flex-grow-1">
                            <h6 class="mb-0 dropdown-msg-user">New Customers <span class="msg-time float-end text-secondary">7 m</span></h6>
                            <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">5 new user registered</small>
                          </div>
                       </div>
                     </a>
                     <a class="dropdown-item" href="#">
                       <div class="d-flex align-items-center">
                        <div class="notification-box"><i class="bi bi-file-earmark-bar-graph-fill"></i></div>
                          <div class="ms-3 flex-grow-1">
                            <h6 class="mb-0 dropdown-msg-user">24 PDF File <span class="msg-time float-end text-secondary">2 h</span></h6>
                            <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">The pdf files generated</small>
                          </div>
                       </div>
                     </a>
                     <a class="dropdown-item" href="#">
                       <div class="d-flex align-items-center">
                        <div class="notification-box"><i class="bi bi-collection-play-fill"></i></div>
                          <div class="ms-3 flex-grow-1">
                            <h6 class="mb-0 dropdown-msg-user">Time Response  <span class="msg-time float-end text-secondary">3 h</span></h6>
                            <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">5.1 min avarage time response</small>
                          </div>
                       </div>
                     </a>
                     <a class="dropdown-item" href="#">
                       <div class="d-flex align-items-center">
                        <div class="notification-box"><i class="bi bi-cursor-fill"></i></div>
                          <div class="ms-3 flex-grow-1">
                            <h6 class="mb-0 dropdown-msg-user">New Product Approved  <span class="msg-time float-end text-secondary">1 d</span></h6>
                            <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Your new product has approved</small>
                          </div>
                       </div>
                     </a>
                     <a class="dropdown-item" href="#">
                       <div class="d-flex align-items-center">
                        <div class="notification-box"><i class="bi bi-gift-fill"></i></div>
                          <div class="ms-3 flex-grow-1">
                            <h6 class="mb-0 dropdown-msg-user">New Comments <span class="msg-time float-end text-secondary">2 w</span></h6>
                            <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">New customer comments recived</small>
                          </div>
                       </div>
                     </a>
                     <a class="dropdown-item" href="#">
                       <div class="d-flex align-items-center">
                        <div class="notification-box"><i class="bi bi-droplet-fill"></i></div>
                          <div class="ms-3 flex-grow-1">
                            <h6 class="mb-0 dropdown-msg-user">New 24 authors<span class="msg-time float-end text-secondary">1 m</span></h6>
                            <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">24 new authors joined last week</small>
                          </div>
                       </div>
                     </a>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                        <div class="notification-box"><i class="bi bi-mic-fill"></i></div>
                         <div class="ms-3 flex-grow-1">
                           <h6 class="mb-0 dropdown-msg-user">Your item is shipped <span class="msg-time float-end text-secondary">7 m</span></h6>
                           <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Successfully shipped your item</small>
                         </div>
                      </div>
                    </a>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                        <div class="notification-box"><i class="bi bi-lightbulb-fill"></i></div>
                         <div class="ms-3 flex-grow-1">
                           <h6 class="mb-0 dropdown-msg-user">Defense Alerts <span class="msg-time float-end text-secondary">2 h</span></h6>
                           <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">45% less alerts last 4 weeks</small>
                         </div>
                      </div>
                    </a>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                        <div class="notification-box"><i class="bi bi-bookmark-heart-fill"></i></div>
                         <div class="ms-3 flex-grow-1">
                           <h6 class="mb-0 dropdown-msg-user">4 New Sign Up <span class="msg-time float-end text-secondary">2 w</span></h6>
                           <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">New 4 user registartions</small>
                         </div>
                      </div>
                    </a>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                        <div class="notification-box"><i class="bi bi-briefcase-fill"></i></div>
                         <div class="ms-3 flex-grow-1">
                           <h6 class="mb-0 dropdown-msg-user">All Documents Uploaded <span class="msg-time float-end text-secondary">1 mo</span></h6>
                           <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Sussessfully uploaded all files</small>
                         </div>
                      </div>
                    </a>
                 </div>
                 <div class="p-2">
                   <div><hr class="dropdown-divider"></div>
                     <a class="dropdown-item" href="#">
                       <div class="text-center">View All Notifications</div>
                     </a>
                 </div>
                </div>
              </li> -->
              </ul>
              </div>
        </nav>
      </header>
       <!--end top header-->

        <!--start sidebar -->
        <aside class="sidebar-wrapper">
          <div class="iconmenu"> 
            <div class="nav-toggle-box">
              <div class="nav-toggle-icon"><i class="bi bi-list"></i></div>
            </div>
            <ul class="nav nav-pills flex-column">
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboards">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-dashboards" type="button"><i class="bi bi-house-door-fill"></i></button>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Application">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-application" type="button"><i class="bi bi-grid-fill"></i></button>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Widgets">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-widgets" type="button"><i class="bi bi-briefcase-fill"></i></button>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="eCommerce">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-ecommerce" type="button"><i class="bi bi-bag-check-fill"></i></button>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Components">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-components" type="button"><i class="bi bi-bookmark-star-fill"></i></button>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Forms">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-forms" type="button"><i class="bi bi-file-earmark-break-fill"></i></button>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Tables">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-tables" type="button"><i class="bi bi-file-earmark-spreadsheet-fill"></i></button>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Authentication">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-authentication" type="button"><i class="bi bi-lock-fill"></i></button>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Icons">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-icons" type="button"><i class="bi bi-cloud-arrow-down-fill"></i></button>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Content">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-content" type="button"><i class="bi bi-cone-striped"></i></button>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Charts">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-charts" type="button"><i class="bi bi-pie-chart-fill"></i></button>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Maps">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-maps" type="button"><i class="bi bi-pin-map-fill"></i></button>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Pages">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-pages" type="button"><i class="bi bi-award-fill"></i></button>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Content">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-content" type="button"><i class="bi bi-cone-striped"></i></button>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Charts">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-charts" type="button"><i class="bi bi-pie-chart-fill"></i></button>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Maps">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-maps" type="button"><i class="bi bi-pin-map-fill"></i></button>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Pages">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-pages" type="button"><i class="bi bi-award-fill"></i></button>
              </li>
            </ul>
          </div>
          <div class="textmenu">
            <div class="brand-logo">
              <img src="{{baseUrl}}/assets/images/brand-logo-2.png" width="140" alt=""/>
            </div>
            <div class="tab-content active show">
              <div class="tab-pane active show" id="pills-dashboards">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Dashboards</h5>
                    </div>
                    <small class="mb-0">All System At Once</small>
                  </div>
                  <a href="dashboard.php" class="list-group-item"><i class="bi bi-cart-plus"></i>Dashboard</a>
                  <a href="songUpload.php" class="list-group-item"><i class="bi bi-wallet"></i>Song Upload</a>
                  <a href="index3.html" class="list-group-item"><i class="bi bi-bar-chart-line"></i>Analytics</a>
                  <a href="index4.html" class="list-group-item"><i class="bi bi-archive"></i>Project Management</a>
                  <a href="index5.html" class="list-group-item"><i class="bi bi-cast"></i>CMS Dashboard</a>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-application">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Application</h5>
                    </div>
                    <small class="mb-0">Some placeholder content</small>
                  </div>
                  <a href="app-emailbox.html" class="list-group-item"><i class="bi bi-envelope"></i>Email</a>
                  <a href="app-chat-box.html" class="list-group-item"><i class="bi bi-chat-left-text"></i>Chat Box</a>
                  <a href="app-file-manager.html" class="list-group-item"><i class="bi bi-archive"></i>File Manager</a>
                  <a href="app-to-do.html" class="list-group-item"><i class="bi bi-check2-square"></i>Todo List</a>
                  <a href="app-invoice.html" class="list-group-item"><i class="bi bi-receipt"></i>Invoice</a>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-widgets">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Widgets</h5>
                    </div>
                    <small class="mb-0">Some placeholder content</small>
                  </div>
                  <a href="widgets-static-widgets.html" class="list-group-item"><i class="bi bi-box"></i>Static Widgets</a>
                  <a href="widgets-data-widgets.html" class="list-group-item"><i class="bi bi-bar-chart"></i>Data Widgets</a>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-ecommerce">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">eCommerce</h5>
                    </div>
                    <small class="mb-0">Some placeholder content</small>
                  </div>
                  <a href="ecommerce-products-list.html" class="list-group-item"><i class="bi bi-box-seam"></i>Products List</a>
                  <a href="ecommerce-products-grid.html" class="list-group-item"><i class="bi bi-box-seam"></i>Products Grid</a>
                  <a href="ecommerce-products-categories.html" class="list-group-item"><i class="bi bi-card-text"></i>Products Categories</a>
                  <a href="ecommerce-orders.html" class="list-group-item"><i class="bi bi-plus-square"></i>Orders</a>
                  <a href="ecommerce-orders-detail.html" class="list-group-item"><i class="bi bi-handbag"></i>Orders Detail</a>
                  <a href="ecommerce-add-new-product.html" class="list-group-item"><i class="bi bi-handbag"></i>Add New Product</a>
                  <a href="ecommerce-add-new-product-2.html" class="list-group-item"><i class="bi bi-handbag"></i>Add New Product 2</a>
                  <a href="ecommerce-transactions.html" class="list-group-item"><i class="bi bi-handbag"></i>Transactions</a>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-components">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Components</h5>
                    </div>
                    <small class="mb-0">Some placeholder content</small>
                  </div>
                  <a href="component-alerts.html" class="list-group-item"><i class="bi bi-bell"></i>Alerts</a>
                  <a href="component-accordions.html" class="list-group-item"><i class="bi bi-arrows-collapse"></i>Accordions</a>
                  <a href="component-badges.html" class="list-group-item"><i class="bi bi-badge-8k"></i>Badges</a>
                  <a href="component-buttons.html" class="list-group-item"><i class="bi bi-menu-button"></i>Buttons</a>
                  <a href="component-cards.html" class="list-group-item"><i class="bi bi-card-list"></i>Cards</a>
                  <a href="component-carousels.html" class="list-group-item"><i class="bi bi-card-image"></i>Carousels</a>
                  <a href="component-list-groups.html" class="list-group-item"><i class="bi bi-list-ol"></i>List Groups</a>
                  <a href="component-media-object.html" class="list-group-item"><i class="bi bi-collection"></i>Media Objects</a>
                  <a href="component-modals.html" class="list-group-item"><i class="bi bi-binoculars"></i>Modals</a>
                  <a href="component-navs-tabs.html" class="list-group-item"><i class="bi bi-segmented-nav"></i>Navs & Tabs</a>
                  <a href="component-navbar.html" class="list-group-item"><i class="bi bi-list"></i>Navbars</a>
                  <a href="component-paginations.html" class="list-group-item"><i class="bi bi-arrow-down-up"></i>Pagination</a>
                  <a href="component-popovers-tooltips.html" class="list-group-item"><i class="bi bi-droplet"></i>Popovers & Tooltips</a>
                  <a href="component-progress-bars.html" class="list-group-item"><i class="bi bi-eject"></i>Progress</a>
                  <a href="component-spinners.html" class="list-group-item"><i class="bi bi-gear-wide"></i>Spinners</a>
                  <a href="component-notifications.html" class="list-group-item"><i class="bi bi-app-indicator"></i>Notifications</a>
                  <a href="component-avtars-chips.html" class="list-group-item"><i class="bi bi-person-badge"></i>Avatrs & Chips</a>
                  <a href="component-typography.html" class="list-group-item"><i class="bi bi-person-badge"></i>Typography</a>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-forms">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Forms</h5>
                    </div>
                    <small class="mb-0">Some placeholder content</small>
                  </div>
                  <a href="form-elements.html" class="list-group-item"><i class="bi bi-award"></i>Form Elements</a>
                  <a href="form-input-group.html" class="list-group-item"><i class="bi bi-back"></i>Input Groups</a>
                  <a href="form-layouts.html" class="list-group-item"><i class="bi bi-bookmark-check"></i>Form Layouts</a>
                  <a href="form-validations.html" class="list-group-item"><i class="bi bi-broadcast-pin"></i>Form Validations</a>
                  <a href="form-file-upload.html" class="list-group-item"><i class="bi bi-cloud-upload"></i>File Upload</a>
                  <a href="form-date-time-pickes.html" class="list-group-item"><i class="bi bi-calendar-date"></i>Date Pickers</a>
                  <a href="form-select2.html" class="list-group-item"><i class="bi bi-check2-circle"></i>Select2</a>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-tables">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Tables</h5>
                    </div>
                    <small class="mb-0">Some placeholder content</small>
                  </div>
                  <a href="table-basic-table.html" class="list-group-item"><i class="bi bi-table"></i>Basic Tables</a>
                  <a href="table-advance-tables.html" class="list-group-item"><i class="bi bi-basket3"></i>Advance Tables</a>
                  <a href="table-datatable.html" class="list-group-item"><i class="bi bi-graph-up"></i>Data Tables</a>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-authentication">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Authentication</h5>
                    </div>
                    <small class="mb-0">Some placeholder content</small>
                  </div>
                  <a href="authentication-signin.html" class="list-group-item"><i class="bi bi-easel"></i>Sign In</a>
                  <a href="authentication-signin-with-header-footer.html" class="list-group-item d-flex align-items-center"><i class="bi bi-eject"></i>Sign In with Header & Footer</a>
                  <a href="authentication-signup.html" class="list-group-item"><i class="bi bi-emoji-heart-eyes"></i>Sign Up</a>
                  <a href="authentication-signup-with-header-footer.html" class="list-group-item d-flex align-items-center"><i class="bi bi-eye"></i>Sign Up with Header & Footer</a>
                  <a href="authentication-forgot-password.html" class="list-group-item"><i class="bi bi-file-earmark-code"></i>Forgot Password</a>
                  <a href="authentication-reset-password.html" class="list-group-item"><i class="bi bi-gem"></i>Reset Password</a>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-icons">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Icons</h5>
                    </div>
                    <small class="mb-0">Some placeholder content</small>
                  </div>
                  <a href="icons-line-icons.html" class="list-group-item"><i class="bi bi-brightness-low"></i>Line Icons</a>
                  <a href="icons-boxicons.html" class="list-group-item"><i class="bi bi-chat"></i>Boxicons</a>
                  <a href="icons-feather-icons.html" class="list-group-item"><i class="bi bi-droplet"></i>Feather Icons</a>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-charts">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Charts</h5>
                    </div>
                    <small class="mb-0">Some placeholder content</small>
                  </div>
                  <a href="charts-chartjs.html" class="list-group-item"><i class="bi bi-bar-chart"></i>Chart JS</a>
                  <a href="charts-apex-chart.html" class="list-group-item"><i class="bi bi-pie-chart"></i>Apex Chart</a>
                  <a href="charts-highcharts.html" class="list-group-item"><i class="bi bi-graph-up"></i>Highcharts</a>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-maps">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Maps</h5>
                    </div>
                    <small class="mb-0">Some placeholder content</small>
                  </div>
                  <a href="map-google-maps.html" class="list-group-item"><i class="bi bi-geo-alt"></i>Google Map</a>
                  <a href="map-vector-maps.html" class="list-group-item"><i class="bi bi-geo"></i>Vector Map</a>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-pages">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Pages</h5>
                    </div>
                    <small class="mb-0">Some placeholder content</small>
                  </div>
                  <a href="pages-user-profile.html" class="list-group-item"><i class="bi bi-alarm"></i>User Profile</a>
                  <a href="pages-timeline.html" class="list-group-item"><i class="bi bi-archive"></i>Timeline</a>
                  <a href="pages-faq.html" class="list-group-item"><i class="bi bi-question-diamond"></i>FAQ</a>
                  <a href="pages-pricing-tables.html" class="list-group-item"><i class="bi bi-tags"></i>Pricing</a>
                  <a href="pages-errors-404-error.html" class="list-group-item"><i class="bi bi-bug"></i>404 Error</a>
                  <a href="pages-errors-500-error.html" class="list-group-item"><i class="bi bi-diagram-2"></i>500 Error</a>
                  <a href="pages-errors-coming-soon.html" class="list-group-item"><i class="bi bi-egg-fried"></i>Coming Soon</a>
                  <a href="pages-blank-page.html" class="list-group-item"><i class="bi bi-flag"></i>Blank Page</a>
                </div>
              </div>
            </div>
          </div>
       </aside>
