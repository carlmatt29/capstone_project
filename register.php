
<?php
require_once("support/config.php");



makeHead("Registration");
?>




<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">
<link rel="stylesheet" href="css/magnific-popup.css">
<link rel="stylesheet" href="css/aos.css">
<link rel="stylesheet" href="css/ionicons.min.css">
<link rel="stylesheet" href="css/flaticon.css">
<link rel="stylesheet" href="css/icomoon.css">
<link rel="stylesheet" href="css/style.css">




<div class="bg-top navbar-light">
  <div class="container">
    <div class="row no-gutters d-flex align-items-center align-items-stretch">
      <div class="col-md-4 d-flex align-items-center py-4">
        <a class="navbar-brand" href="index.php">JMS Staffing Solution Inc.</a>
      </div>
      <div class="col-lg-8 d-block">
        <div class="row d-flex">
          <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
            <div class="icon d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
            <div class="text">
              <span>Email</span>
              <span>recruitment@jmsstaffingsolutions.com</span>

            </div>
          </div>
          <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
            <div class="icon d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
            <div class="text">
              <span>Call Us: (02)‎ 281-6535</span>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>


    <!-- START nav -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container d-flex align-items-center">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
                </button>
          <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="index.php" class="nav-link pl-0">Home</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item"><a href="services.php" class="nav-link">Services</a></li>
  
                <li class="nav-item active"><a href="register.php" class="nav-link">Sign-up</a></li>
                <li class="nav-item"><a href="" class="nav-link" data-toggle="modal" data-target="#sign-in">Sign in</a></li>
            </ul>
          </div>
        </div>
      </nav>
    <!-- END nav -->

    <section id="modal_log-in">
      <div class="modal fade" id="sign-in">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
              <div class="login-logo">
                <img src="dist/img/capstone/JMSSolution.png" class='img-responsive center-block' >
              </div><!-- /.login-logo -->
                  <?php
                    Alert();
                  ?>
                  <h3><p class="login-box-msg ">Login to your Account</p></h3>
                  <!--  <h4 class="form-signin-heading">Login to your Account</h4>-->
              <form action="logingin.php" method="post" autocomplete="off">
                <input type='hidden' value='<?php echo $ipaddress ?>' id='ipadd' name='ipadd'>
                <input type='hidden' value='<?php echo $ip_address['ip_address'] ?>' id='myipadd' name='myipadd'>
                <div class="form-group has-feedback">
                  <i class="glyphicon glyphicon-user form-control-feedback"></i>
                  <input type="text" class="form-control" placeholder="Username" name='username'>
                  <!--<span class="glyphicon glyphicon-user form-control-feedback"></span>-->
                </div>
                <div class="form-group has-feedback">
                  <input type="password" class="form-control" placeholder="Password" name='password'>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-xs-offset-0">
                    <!--<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>-->
                    <button type="submit" class="btn btn-lg btn-block bg-yellow">Login</button>
                    <br/>
                    <center><a class='text-yellow' href='forgot_password.php' >Forgot Password</a>
                  </div><!-- /.col -->
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </section>
<!-- END Login --> 


    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-2 bread">Register to Us</h1>
          </div>
        </div>
      </div>
    </section>

    <?php
        Alert();
   ?>
    <div class="container" style="margin: 3% 30% 5% 30%; ">
      <div class="row" style="margin: 10px 10px 20px 10px; ">
        <div class="col-md-6 col-md-offset-3"  style="z-index: 2; margin: 2% 5% 2% 5%; background-color: #00FFFF;">
            
          <div class="login-logo">
              <img src="dist/img/capstone/JMSSolution.png" class='img-responsive center-block' style="width:100%; margin-top:20px;">
              <center> <h1 style="margin-top:20px;">Registration Form</h1></center>
          </div>
          <?php if($msg != "") echo $msg . "<br><br>"; ?>
          <form method="post" action="save_register.php" autocomplete="off" style="margin: 5% 5% 5% 5%;">
              <!-- <label for="inputlg">Firstname</label> -->
              <input class="form-control" type="text" name="firstname" placeholder="Firstname..." value = "<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>" required ><br>

              <!-- <label for="inputlg">Middlename</label> -->
              <input class="form-control" type="text" name="middlename" placeholder="Middlename..." value = "<?php echo isset($_POST['middlename']) ? $_POST['middlename'] : '' ?>" required><br>

              <!-- <label for="inputlg">Lastname</label> -->
              <input class="form-control" type="text" name="lastname" placeholder="Lastname..." value = "<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>" required><br>

              <!-- <label for="inputlg">Email</label> -->
              <input class="form-control" type="email" name="email" placeholder="Email..."><br>

              <!-- <label for="inputlg">Username</label> -->
              <input class="form-control" type="text" name="username" placeholder="Username..." value = "<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" required><br>

              <!-- <label for="inputlg">Password</label> -->
              <input class="form-control" type="password" name="password" placeholder="Password..." value = "<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" required><br>

              <!-- <label for="inputlg">Confirm Password</label> -->
              <input class="form-control" type="password" name="cPassword" placeholder="Confirm Password..."><br>

              <center><input class="btn btn-primary btn-block" type="submit" name="submit" value="Register"><br></center>
            </form>

        </div>
      </div>
    </div>

  <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-6 col-lg-3">
            <div class="ftco-footer-widget mb-5">
              <h2 class="ftco-heading-2">Have a Questions?</h2>
              <div class="block-23 mb-3">
                <ul>
                  <li><span class="icon icon-map-marker"></span><span class="text">JMS Staffing Solutions, Inc.
                    2nd Floor St. Anthony Bldg. 891 Aurora Blvd. Cubao, Quezon City Metro Manila, 1109 Philippines</span></li>
                  <li><a href="#"><span class="icon icon-phone"></span><span class="text">(02)‎ 281-6535</span></a></li>
                  <li><a href="#"><span class="icon icon-envelope"></span><span class="text">recruitment@jmsstaffingsolutions.com</span></a></li>
                </ul>
              </div>
            </div>
          </div>



          <div class="col-md-6 col-lg-3">
            <div class="ftco-footer-widget mb-5 ml-md-4">
              <h2 class="ftco-heading-2">Links</h2>
              <ul class="list-unstyled">
              <ul class="list-unstyled">
                <li><a href="index.php"><span class="ion-ios-arrow-round-forward mr-2"></span>Home</a></li>
                <li><a href="about.php"><span class="ion-ios-arrow-round-forward mr-2"></span>About</a></li>
                <li><a href="services.php"><span class="ion-ios-arrow-round-forward mr-2"></span>Services</a></li>
                <li><a href="contact.php"><span class="ion-ios-arrow-round-forward mr-2"></span>Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="ftco-footer-widget mb-5">
              <h2 class="ftco-heading-2">Subscribe Us!</h2>
              <form action="#" class="subscribe-form">
                <div class="form-group">
                  <input type="text" class="form-control mb-2 text-center" placeholder="Enter email address">
                  <input type="submit" value="Subscribe" class="form-control submit px-3">
                </div>
              </form>
            </div>
            <div class="ftco-footer-widget mb-5">
              <h2 class="ftco-heading-2 mb-0">Connect With Us</h2>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>

<?php
  Modal();
  makeFoot();
?>

