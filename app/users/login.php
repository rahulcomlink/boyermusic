<?php
session_start();
require_once '../db/connection.php';
include 'function.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginSubmit'])) {
  $user_mail = mysqli_real_escape_string($conn, $_POST['email']);
  $user_password = mysqli_real_escape_string($conn, $_POST['password']);
  $hashPassword = md5($user_password);

  $loginQuery = "SELECT * FROM user_details WHERE user_email = '$user_mail' AND user_password = '$hashPassword'";
  $loginResult = $conn->query($loginQuery);

  if ($loginResult && $loginResult->num_rows > 0) {
    $row = $loginResult->fetch_assoc();
    $_SESSION['userMail'] = $row['user_email']; // Store user_email in session
    $_SESSION['productionCode'] = $row['user_unicode']; // Store user_unicode in session
    $_SESSION['userCode'] = $row['user_define_code']; // Store user_define_code in session
    header("Location: dashboard.php"); // Redirect to dashboard after successful login
    exit();
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
  <link rel="stylesheet" href="<?php echo getUrlAsset() ?>/assets/cdn.jsdelivr.net/npm/bootstrap-icons%401.5.0/font/bootstrap-icons.css">

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
              <a class="navbar-brand" href="#"><img src="../public/img/logo.png" width="60" alt="shri boyer music"/></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 align-items-center">
                  <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="javascript:;">About</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                       Services <i class="bi bi-chevron-down align-middle ms-2"></i>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="javascript:;">Contact Us</a>
                  </li>
                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                      English
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="javascript:;">Support</a>
                  </li>
                </ul>
                <div class="d-flex ms-3 gap-3">
                  <a href="authentication-signin-with-header-footer.html" class="btn btn-primary btn-sm px-4 radius-30">Login</a>
                  <a href="signup.php" class="btn btn-white btn-sm px-4 radius-30">Register</a>
                </div>
              </div>
            </div>
          </nav>
       </header>
    
       <!--start content-->
       <main class="authentication-content">
        <div class="container">
          <div class="mt-4">
            <div class="card rounded-0 overflow-hidden shadow-none border mb-5 mb-lg-0">
              <div class="row g-0">
                <div class="col-12 order-1 col-xl-8 d-flex align-items-center justify-content-center border-end">
                  <img src="../public/img/banner.png" width="200" class="img-fluid" alt="">
                </div>
                <div class="col-12 col-xl-4 order-xl-2">
                  <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title">Sign In</h5>
                    <p class="card-text mb-4">See your growth and get consulting support!</p>
                     <form class="form-body" action="" method="POST">
                      
                        <div class="row g-3">
                          <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                              <input type="email" name="email" class="form-control radius-30 ps-5" id="inputEmailAddress" placeholder="Email">
                            </div>
                          </div>
                          <div class="col-12">
                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
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
                          <div class="col-12">
                            <div class="login-separater text-center"> <span>OR SIGN IN WITH EMAIL</span>
                              <hr>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="d-flex align-items-center gap-3 justify-content-center">
                              <button type="button" class="btn btn-white text-danger"><i class="bi bi-google me-0"></i></button>
                              <button type="button" class="btn btn-white text-primary"><i class="bi bi-linkedin me-0"></i></button>
                              <button type="button" class="btn btn-white text-info"><i class="bi bi-facebook me-0"></i></button>
                            </div>
                          </div>
                          <div class="col-12 text-center">
                            <p class="mb-0">Don't have an account yet? <a href="authentication-signup-with-header-footer.html">Sign up here</a></p>
                          </div>
                        </div>
                    </form>
                 </div>
                </div>
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