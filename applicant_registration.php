   <?php
    require_once("./support/config.php");
    require '.\PHPMailer\Exception.php';
    require '.\PHPMailer\PHPMailer.php';
    require '.\PHPMailer\SMTP.php';
    require '.\PHPMailer\OAuth.php';
    $msg = "";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


        if (isset($_POST['submit'])) {
            $firstname = $con->real_escape_string($_POST['firstname']);
            $middlename = $con->real_escape_string($_POST['middlename']);
            $lastname = $con->real_escape_string($_POST['lastname']);
            $email = $con->real_escape_string($_POST['email']);
            $password = $con->real_escape_string($_POST['password']);
            $cPassword = $con->real_escape_string($_POST['cPassword']);      # code...

            if($firstname  == ""|| $middlename = "" || $lastname = ""|| $email == ""|| $password != $cPassword){
                $msg = "Please confirm your inputs!";
                
            }
            else{
                $sql = $con->myQuery("SELECT id FROM users WHERE email = '$email'")->fetch();
                if ($sql->num_rows >0) {
                   $msg ="Email is already exist!";

                } 
                else{
                    $token = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM123456789';
                    $token = str_shuffle($token);
                    $token = substr($token, 0, 10);

                   

                    $con->myQuery("INSERT INTO users (firstname,middlename,lastname,email,password,isEmailConfirmed,token)
                        VALUES('$firstname','middlename','lastname', '$email', '$password', '0','$token');
                        ");

                    
                    include_once "PHPMailer\PHPMailer.php";

                    $mail = new PHPMailer();
                    //Enable SMTP debugging. 
                    $mail->SMTPDebug = 1;                               
                    //Set PHPMailer to use SMTP.
                    $mail->isSMTP();            
                    //Set SMTP host name                          
                    $mail->Host = 'localhost';
                    //Set this to true if SMTP host requires authentication to send email
                    $mail->SMTPAuth = true;                          
                    //Provide username and password     
                    $mail->Username = "carlrosales32998@gmail.com";                 
                    $mail->Password = "Matthew29";                           
                    //If SMTP requires TLS encryption then set it
                    $mail->SMTPSecure = "tls";                           
                    //Set TCP port to connect to 
                    $mail->Port = 25;  


                    $mail->setFrom('carlrosales32998@gmail.com','Localhost');
                    $mail->addAddress($email,$firstname,$middlename,$lastname,'Localhost');
                    $mail->Subject = "Localhost Mail:";
                    $mail->isHTML(true);
                    $mail->Body = "Please Click on the link below <br><br> <a href='localhost/capstone_project/confirm.php?email=$email&token=$token'>Click Here</a>";

                    if(!$mail->send()){
                        $msg = "You have been registered! Please verify your email!";
                    }
                    else{
                        $msg = "Something wrong happened! Please try again!";
                    }
                }

            } 
            
        }




   ?>




<!DOCTYPE html>
<html>
<head>
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
</head>
<body>


        <div class="bg-top navbar-light">
        <div class="container">
            <div class="row no-gutters d-flex align-items-center align-items-stretch">
                <div class="col-md-4 d-flex align-items-center py-4">
                    <a class="navbar-brand" href="registration.php">JMSSTaffingSolutionInc.</a>
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
                  <a class="btn btn-info btn-lg" href="applicant_registration.php" data-toggle="modal" data-target="#sign-up"><span>Register to Us</span></a>

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
                <li class="nav-item"><a href="index.php" class="nav-link pl-0">Home</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item"><a href="services.php" class="nav-link">Services</a></li>
              <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
            <li class="nav-item active"><a href="applicant_registration.php" class="nav-link">Sign-up</a></li>
            <li class="nav-item"><a href="frmlogin.php"class="nav-link" data-toggle="modal" data-target="#sign-in">Sign in</a></li>
            
           
            </ul>
          </div>
        </div>  
      </nav>
    <!-- END nav -->
    <div class="container" style="margin-top: 100px;">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3" align="center">
                <?php if($msg != "") echo $msg . "<br><br>"; ?>
                <form method="post" action="registration.php">
                    <input class="form-control" type="text" name="firstname" placeholder="Firstname..."><br>
                    <input class="form-control" type="text" name="middlename" placeholder="Middlename..."><br>
                    <input class="form-control" type="text" name="lastname" placeholder="Lastname..."><br>
                    <input class="form-control" type="email" name="email" placeholder="Email..."><br>
                    <input class="form-control" type="text" name="username" placeholder="Username..."><br>
                    <input class="form-control" type="password" name="password" placeholder="Password..."><br>
                    <input class="form-control" type="password" name="cPassword" placeholder="Confirm Password..."><br>
                    <input class="btn btn-primary" type="submit" name="submit" value="Register"><br>
                </form>
            </div>
        </div>
        
    </div>
   

</body>
</html>



   


  