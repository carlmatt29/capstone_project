<?php
require_once("support/config.php");
require_once("registration.php");


if (isLoggedIn()) {
  redirect("template.php");
  die();
}

$registrationSuccess = "";

if (isset($_SESSION['registration']) && $_SESSION['registration']) {
  $registrationSuccess = "show";
  unset($_SESSION['registration']);
}



makeHead("Login");

?>


<title></title>
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
        <a class="navbar-brand" href="index.php">JMSSTaffingSolutionInc.</a>
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
          <div class="col-md topper d-flex align-items-center justify-content-end">
            <p class="mb-0 d-block">
              <a class="btn btn-info btn-lg" href="applicant_registration.php" data-toggle="registration.php" data-target="#sign-up"><span>Register to Us</span></a>
              </button>
            </p>
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
        <li class="nav-item active"><a href="index.php" class="nav-link pl-0">Home</a></li>
        <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
        <li class="nav-item"><a href="services.php" class="nav-link">Services</a></li>
        <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
        <li class="nav-item"><a href="applicant_registration.php" class="nav-link">Sign up</a></li>
        <li class="nav-item"><a href="#" class="nav-link" data-toggle="modal" data-target="#sign-in">Sign in</a></li>


      </ul>
    </div>
  </div>
</nav>
<!-- END nav -->


<!-- Start Login -->
<section id="modal_log-in">
  <div class="modal fade" id="sign-in">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
        <div class="modal-body modal-body-center">
          <div class="login-logo">
            <img src="dist/img/capstone/JMSSolution.png" class='img-responsive center-block'>
          </div><!-- login-logo -->

          <h3>
            <p class="login-box-msg ">Login to your Account</p>
          </h3>
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
                <br />
                <center><a class='text-yellow' href='forgot_password.php'>Forgot Password</a>
              </div><!-- /.col -->
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END Login -->






<section class="home-slider owl-carousel">
  <div class="slider-item" style="background-image:url(images/bg_1.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
        <div class="col-md-7 ftco-animate">
          <span class="subheading">Welcome to JMS Staffing Solution INC.</span>
          <h1 class="mb-4">Our Talent is Finding Yours</h1>
          <p><a href="services.php" class="btn btn-primary px-4 py-3 mt-3">Our Services</a></p>
        </div>
      </div>
    </div>
  </div>

  <div class="slider-item" style="background-image:url(images/bg_2.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
        <div class="col-md-7 ftco-animate">
          <h1 class="mb-4">Choose your human resources goal and see how we can help you achieve success.</h1>
          <p><a href="services.php" class="btn btn-primary px-4 py-3 mt-3">Our Services</a></p>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="ftco-section">
  <div class="container">
    <div class="row d-flex">
      <div class="col-md-5 order-md-last wrap-about align-items-stretch">
        <div class="wrap-about-border ftco-animate">
          <div class="img" style="background-image: url(images/about.jpg); border"></div>
          <div class="text">
            <h3>Our People</h3>
            <p>The depth of the management and highly competent/professional ensures individual who have several years of experience and extensive-wide range of exposure. Who have distinguished themselves in various private industries and professional disciplines the company’s capabilities, capacities , strength and directions. We believe in the ultimate reason for existence that is to provide quality service to client-companies and fellow employers.</p>

            <p><a href="#" class="btn btn-primary py-3 px-4">Contact us</a></p>
          </div>
        </div>
      </div>
      <div class="col-md-7 wrap-about pr-md-4 ftco-animate">
        <h2 class="mb-4">Our Main Features</h2>
        <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word.</p>
        <div class="row mt-5">
          <div class="col-lg-6">
            <div class="services active text-center">
              <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="icon icon-comment"></span></div>
              <div class="text media-body">
                <h3>Looking for a Job?</h3>
                <p>We are always hiring for open positions in an area nearest to you.
                  We’ve got great jobs with companies looking for talented workers nationwide..</p>
              </div>
            </div>

          </div>
          <div class="col-lg-6">
            <div class="services text-center">
              <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="icon icon-user"></span></div>
              <div class="text media-body">
                <h3>Clients</h3>
                <p>We help small to midsize companies evaluate their hiring needs, manage their employer obligations and ensure compliance by targeted solutions the core contributors – its people.</p>
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <div class="services text-center">
              <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-analysis"></span>
              </div>
              <div class="text media-body">
                <h3>RECRUITMENT AND STAFFING SOLUTIONS</h3>
                <p>Our standard rates are competitive, reasonable and worth to the quality personnel.</p>
                <p><b>JMS Staffing Solutions, Inc.</b> takes pride of its extensive and diverse experience in supplying the staffing requirements for the Manufacturing, Information Technology, Retail, and Industries.</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-intro ftco-no-pb img" style="background-image: url(images/bg_3.jpg);">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-10 text-center heading-section heading-section-white ftco-animate">
        <h2 class="mb-0">You Always Get the Best Guidance</h2>
      </div>
    </div>
  </div>
</section>

<!--footer-->
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

        <p>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          Copyright &copy;<script>
            document.write(new Date().getFullYear());
          </script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </p>
      </div>
    </div>
  </div>
</footer>



<div class="modal" id="registration-modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <center><h3>You have been Registered! Please Verify your email!</h3></center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
    <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
    <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg>
</div>


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

<script>
  console.log("fired!");
  $('#registration-modal').modal("<?php echo $registrationSuccess ?>");
</script>

<?php
Modal();
makeFoot();
?>
