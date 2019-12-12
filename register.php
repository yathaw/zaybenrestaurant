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
              <div class="col-lg-4 d-none d-lg-block">
                <img src="backend/img/bg4.jpg" class="img-fluid" style="height: 592px">
              </div>
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"> Create an Account!</h1>
                  </div>
                  <form class="user" action="signup" method="POST">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12">
                        
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12">
                        
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                          <input type="text" class="form-control form-control-user" id="exampleInputName" aria-describedby="emailHelp" placeholder="Enter Your Name..." name="name">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                          <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                          <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required="required">
                          <font id="error" color="red"></font>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                          <input type="password" class="form-control form-control-user" id="cpassword" name="cpassword" placeholder="Confirm Password" required="required">
                          <font id="cerror" color="red"></font>
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="exampleInputPhone"  placeholder="Enter Phone Number..." name="phone">
                    </div>
                    
                    <div class="form-group">
                      <textarea type="text" class="form-control form-control-user" name="address" placeholder="Address" required="required"></textarea>
                    </div>
                    
                    <input type="submit" class="btn btn-success btn-user btn-block" name="register" value="Register">

                  </form>
                  <hr>

                  <div class="text-center">
                    <a class="small" href="login">
                      <i class="fas fa-portrait"></i> Already Member!
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

  <script type="text/javascript">
    
    $(document).ready(function() 
    {
      $('#password').change(function ()
      {
        var password=$(this).val();

          if(password.length > 8)
          {
            $('#error').html(`<span class="text-danger">* Password shouldn't exceed eight digit</span>`);
          }
      });


      $('#cpassword').change(function () 
      {
        var cpassword = $(this).val();
        var password = $("#password").val();


        if(password!=cpassword)
        {
          $('#cerror').html(`<span class="text-danger">* Confirm Password don't match!</span>`);
        }
      });
    
    });

  </script>

</body>

</html>
