<?php
session_start();
require_once '../db/connection.php';
include 'function.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginSubmit'])) {
  $user_mail = mysqli_real_escape_string($conn, $_POST['email']);
  $user_password = mysqli_real_escape_string($conn, $_POST['password']);
  $hashPassword = md5($user_password);

  $loginQuery = "SELECT * FROM super_user WHERE super_name = '$user_mail' AND super_password = '$hashPassword'";
  $loginResult = $conn->query($loginQuery);

  if ($loginResult && $loginResult->num_rows > 0) {
    $row = $loginResult->fetch_assoc();
    $_SESSION['adminUser'] = $row['super_name']; // Store user_email in session
    //echo '<meta http-equiv="refresh" content="0;url=dashboard.php">';
    echo "Login Corret";
    header("Location: dashboard.php"); // Redirect to dashboard after successful login
  } else {
    header("Location: login.php?error=InvalidCredentials");
    exit();
  }
}
?>


<!doctype html>
<html lang="en" class="minimal-theme">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png" />
  <!-- Bootstrap CSS -->
  <link href="<?php echo getUrlAsset() ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo getUrlAsset() ?>/assets/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="<?php echo getUrlAsset() ?>/assets/css/style.css" rel="stylesheet" />
  <link href="<?php echo getUrlAsset() ?>/assets/css/icons.css" rel="stylesheet">
  <link href="<?php echo getUrlAsset() ?>/assets/fonts.googleapis.com/css276c7.css?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="custom.css">


  <!-- loader-->
	<link href="<?php echo getUrlAsset() ?>/assets/css/pace.min.css" rel="stylesheet" />

  <title>Login - Boyer Music</title>
</head>

<body class="bg-surface">

  <!--start wrapper-->
  <div class="wrapper">

       <header>
          <nav class="navbar navbar-expand-lg navbar-light bg-white rounded-0 border-bottom">
            <div class="container">
              <a class="navbar-brand" href="#"><img src="../public/logo/logo.png" width="60" alt="shri boyer music"/></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              
            </div>
          </nav>
       </header>
    
       <!--start content-->
       <main class="authentication-content">
        <div class="container">
          <div class="mt-4">
            <div class="card rounded-0 overflow-hidden shadow-none border mb-5 mb-lg-0">
              <div class="row g-0">
                
                <div class="col-12 col-xl-4 order-xl-2 " >
                  <div class="card-body p-4 p-sm-5 login-border">
                    <h5 class="card-title">Sign In</h5>
                    <p class="card-text mb-4">See your growth and get consulting support!</p>
                     <form class="form-body" action="" method="POST">
                      
                        <div class="row g-3">
                          <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="fa-solid fa-envelope"></i></div>
                              <input type="email" name="email" class="form-control radius-30 ps-5" id="inputEmailAddress" placeholder="Email">
                            </div>
                          </div>
                          <div class="col-12">
                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="fa-solid fa-lock"></i></div>
                              <input type="password" name="password" class="form-control radius-30 ps-5" id="inputChoosePassword" placeholder="Password">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
                              <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                            </div>
                          </div>
                          <div class="col-6 text-end">	<a href="authentication-forgot-password.html">Forgot Password ?</a>
                          </div>
                          <div class="col-12">
                            <div class="d-grid">
                              <button type="submit" name="loginSubmit" class="btn btn-primary radius-30">Sign In</button>
                            </div>
                          </div>
                         
                          
                        </div>
                    </form>
                 </div>
                </div>
              </div>

              <div class="col-12 order-1 col-xl-8 d-flex align-items-center justify-content-center border-end">
                  <img src="../public/img/banner.png" width="200" class="img-fluid" alt="">
                </div>
            </div>
          </div>
        </div>
       </main>
        
       <!--end page main-->

       <footer class="bg-white border-top p-3 text-center fixed-bottom">
        <p class="mb-0">Copyright © 2023. All right reserved.</p>
      </footer>

  </div>
  <!--end wrapper-->


  <!-- Bootstrap bundle JS -->
  <script src="<?php echo getUrlAsset() ?>/assets/js/bootstrap.bundle.min.js"></script>

  <!--plugins-->
  <script src="<?php echo getUrlAsset() ?>/assets/js/jquery.min.js"></script>
  <script src="<?php echo getUrlAsset() ?>/assets/js/pace.min.js"></script>


</body>
</html>