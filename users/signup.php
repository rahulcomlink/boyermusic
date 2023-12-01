<?php
require_once '../db/connection.php';
include 'function.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signupSubmit'])) {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_phone = $_POST['user_phone'];
    $user_password = $_POST['user_password'];
    $hashPassword = md5($user_password);
    $user_production_name = $_POST['user_production_name'];
    $user_production_type = $_POST['user_production_type'];
    $address = "1";
    $user_production_code = generateRandomString(8);
    $user_define_code = generateRandomString(5);
    $mailOTP = generateRandomString(4);

    // Check if user with the same email, production name, or phone number already exists
    $query = "SELECT * FROM user_details WHERE user_email = ? OR user_production_name = ? OR user_phone = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $user_email, $user_production_name, $user_phone);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "User with the same email, production name, or phone number already exists.";
        // Handle the error or redirect the user to a registration page with an error message
    } else {
        // Prepare the SQL statement using prepared statements
        $insertQuery = "INSERT INTO `user_details`(`user_name`, `user_email`, `user_phone`, `user_password`, `user_production_name`, `user_production_type`, `user_production_address`, `user_unicode`, `user_define_code`, `user_mail_otp`, `user_createdAt`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($insertQuery);
        // Bind parameters and execute the statement
        $stmt->bind_param("ssssssssss", $user_name, $user_email, $user_phone, $hashPassword, $user_production_name, $user_production_type, $address, $user_production_code, $user_define_code, $mailOTP);
        if ($stmt->execute()) {
            echo "New record created successfully";
            // You can redirect or perform other actions after successful insertion
        } else {
            echo "Error: " . $stmt->error;
        }
        // Close statement
        $stmt->close();
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
  <link href="<?php echo getUrlAsset() ?>/fonts.googleapis.com/css276c7.css?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo getUrlAsset() ?>/cdn.jsdelivr.net/npm/bootstrap-icons%401.5.0/font/bootstrap-icons.css">

  <!-- loader-->
	<link href="<?php echo getUrlAsset() ?>/assets/css/pace.min.css" rel="stylesheet" />

  <title>Sign Up - Boyer Music</title>
</head>

<body class="bg-surface">

  <!--start wrapper-->
  <div class="wrapper">

       <header>
          <nav class="navbar navbar-expand-lg navbar-light bg-white rounded-0 border-bottom">
            <div class="container">
              <a class="navbar-brand" href="#">
                <img src="../public/img/logo.png" width="60" alt=""/></a>
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
                  
                  <li class="nav-item">
                    <a class="nav-link" href="javascript:;">Support</a>
                  </li>
                </ul>
                <div class="d-flex ms-3 gap-3">
                  <a href="login.php" class="btn btn-white btn-sm px-4 radius-30">Login</a>
                  <a href="authentication-signup-with-header-footer.html" class="btn btn-primary btn-sm px-4 radius-30">Register</a>
                </div>
              </div>
            </div>
          </nav>
       </header>
    
       <!--start content-->
       <main class="authentication-content">
        <div class="container">
          <div class="mt-4">
            <div class="card rounded-0 overflow-hidden shadow-none bg-white border">
              <div class="row g-0">
                <div class="col-12 order-1 col-xl-8 d-flex align-items-center justify-content-center border-end">
                  <img src="<?php echo getUrlAsset() ?>/assets/images/error/auth-img-register3.png" class="img-fluid" alt="">
                </div>
                <div class="col-12 col-xl-4 order-xl-2" >
                  <div class="card-body p-4 p-sm-5" style="padding:15px !important;">
                    <h5 class="card-title">Sign Up</h5>
                    <p class="card-text mb-4">See your growth and get consulting support!</p>
                     <form class="form-body" action="" method="POST">
                      
                        <div class="row g-3">
                          <div class="col-12 ">
                            <label for="inputName" class="form-label">Name</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-person-circle"></i></div>
                              <input type="type" name="user_name" class="form-control radius-10 ps-5" id="inputName" placeholder="Enter Name">
                            </div>
                          </div>

                          <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                              <input type="email" name="user_email" class="form-control radius-10 ps-5" id="inputEmailAddress" placeholder="Email">
                            </div>
                          </div>

                          <div class="col-12 ">
                            <label for="inputName" class="form-label">Mobile Number</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-person-circle"></i></div>
                              <input type="number" name="user_phone" class="form-control radius-10 ps-5" id="inputName" placeholder="Enter Name">
                            </div>
                          </div>


                          <div class="col-12 ">
                            <label for="inputName" class="form-label">Production Type</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-person-circle"></i></div>
                              <select class="form-control radius-10 ps-5" name="user_production_type" id="inputName">
                                <option value="1">Individual</option>
                                <option value="2">Productions</option>
                              </select>
                            </div>
                          </div>



                          <div class="col-12 ">
                            <label for="inputName" class="form-label">Production Name</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-person-circle"></i></div>
                              <input type="text" name="user_production_name" class="form-control radius-10 ps-5" id="inputName" placeholder="Enter Name">
                            </div>
                          </div>
 
                          <div class="col-12">
                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                              <input type="password" name="user_password" class="form-control radius-10 ps-5" id="inputChoosePassword" placeholder="Password">
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                              <label class="form-check-label" for="flexSwitchCheckChecked">I Agree to the Trems & Conditions</label>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="d-grid">
                              <button type="submit" name="signupSubmit" class="btn btn-warning radius-10">Sign Up</button>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="login-separater text-center"> <span>OR</span>
                              <hr>
                            </div>
                          </div>
                         
                          <div class="col-12 text-center">
                            <p class="mb-0">Already have an account? <a href="login.php">Sign in here</a></p>
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

       <footer class="bg-white border-top p-3 text-center">
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