<?php
  $directoryURI = $_SERVER['REQUEST_URI'];
  $path = parse_url($directoryURI, PHP_URL_PATH);
  $components = explode('/', $path);
  $route = $components[3];

  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> Zay Ben Restaurant </title>

  <!-- Favicon -->
  <link rel="icon" href="image/logo.png">

  <!-- Fontawesome for this template-->
  <link href="fontawesome/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Bootstrap core CSS -->
  <link href="frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="frontend/css/shop-homepage.css" rel="stylesheet">

  <style type="text/css">
    
    .flip .back 
    {
      background: #fff;
      color: #000;
      padding-left: 25px;
    }

    .badge-notify
    {
      background: white;
      position: relative;
      top: -15px;
      left: -10px;
    }

  </style>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary fixed-top mb-5">
    <div class="container">
      <a class="navbar-brand" href="index"> 
        <img src="image/logo.png" class="img-fluid" style="width: 90px; height:50px;"> Zay Ben Restaurant 
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item <?php if ($route=="index") {echo "active"; } else  {echo "";}?>  mr-3 ml-3">
            <a class="nav-link" href="index">Home </a>
          </li>
          <li class="nav-item <?php if ($route=="about") {echo "active"; } else  {echo "";}?> mr-3 ml-3">
            <a class="nav-link" href="about">About</a>
          </li>
          <li class="nav-item <?php if ($route=="menu" || $route=="special")  {echo "active"; } else  {echo "";}?> mr-3 ml-3">
            <a class="nav-link" href="menu">Menu</a>
          </li>

          <li class="nav-item <?php if ($route=="contact") {echo "active"; } else  {echo "";}?> mr-3 ml-3">
            <a class="nav-link" href="contact">Contact</a>
          </li>

          <li class="nav-item mr-3 ml-3">
            <a class="nav-link" href="cart">
              <i class="fas fa-cart-arrow-down fa-lg"></i>
              <span class="badge badge-pill badge-light badge-notify"></span>
            </a>
          </li>

          <?php if(isset($_SESSION['loginuser'])): ?>
          
          <li class="nav-item mr-3 ml-3 dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                <?php echo $_SESSION['loginuser']['name'];?>
              </span>
              <img src="<?php echo $_SESSION['loginuser']['profile'];?>" class="img-profile rounded-circle" width="40px" height="40px">
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="profile"> Profile </a>
              <a class="dropdown-item" href="order_history"> Order History </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="signout"> Logout </a>
            </div>
          </li>

          <?php else: ?>

          <li class="nav-item mr-3 ml-3">
            <a class="nav-link" href="login">Login | Register</a>
          </li>

          <?php endif; ?>
          
        </ul>
      </div>
    </div>
  </nav>


  
