<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> Zay Ben Restaurant </title>

  <!-- Favicon -->
  <link rel="icon" href="image/logo.png">

  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Fontawesome for this template-->
  <link href="fontawesome/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="backend/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-white">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9 mt-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-5 d-none d-lg-block" >
                <img src="backend/img/bg2.jpg" class="img-fluid" >
              </div>
              <div class="col-lg-7">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>

                  <?php if (isset($_SESSION['reg_success'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert"> 
                      <?php echo $_SESSION['reg_success']; ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                  <?php unset($_SESSION['login_reject']); } ?>

                  <?php if (isset($_SESSION['login_reject'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                      <?php echo $_SESSION['login_reject']; ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                  <?php unset($_SESSION['login_reject']); } ?>

                  <form class="user" action="signin" method="POST">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                    </div>
                    
                    <input type="submit" class="btn btn-success btn-user btn-block" name="register" value="Login">

                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot_password">
                      <i class="fas fa-key"></i> Forgot Password?
                    </a>
                  </div>

                  <div class="text-center">
                    <a class="small" href="register">
                      <i class="fas fa-portrait"></i> Create an Account!
                    </a>
                  </div>

                  <div class="text-center mt-3">
                    <a class="small" href="index">
                      <i class="fas fa-home"></i> Go Back Home
                    </a>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="backend/vendor/jquery/jquery.min.js"></script>
  <script src="backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="backend/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="backend/js/sb-admin-2.min.js"></script>

</body>

</html>
