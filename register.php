<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("support/config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '.\PHPMailer\Exception.php';
require '.\PHPMailer\PHPMailer.php';
require '.\PHPMailer\SMTP.php';
require '.\PHPMailer\OAuth.php';

$msg = "";



if (!empty($_POST)) {



  $inputs = $_POST;

  try {
    // echo "<pre>";
    // print_r($inputs);
    // echo "</pre>";

    $con->beginTransaction();
    $special_id = $con->myQuery("SELECT COUNT(id)+1 as special_id FROM employees")->fetch();
    $applicant = "APPLICANT-" . $special_id['special_id'] . "";
    $inputs['applicant'] = $applicant;
    $inputs['code'] = $applicant;


    $params_applicant = array(
      'code'      => $inputs['code'],
      'first_name'  => $inputs['firstname'],
      'middle_name' => $inputs['middlename'],
      'last_name'   => $inputs['lastname']

    );

    if($inputs['firstname']  == "" || $inputs['middlename'] == "" || $inputs['lastname'] == "" || $inputs['email'] == "" || $inputs['username'] == "" || $inputs['password'] != $inputs['cPassword']){
        $msg = "Please confirm your inputs!";

    }
    else{
          $con->myQuery("INSERT INTO employees(code,first_name,middle_name,last_name) VALUES (:code,:first_name,:middle_name,:last_name)", $params_applicant);
    // print_r($app_id['applicant_id']);
    //    die();
          $email=$inputs['email'];
          $sql = ("SELECT id FROM users WHERE email='$email'");
          $res = mysqli_query($con,$sql);
          $row = mysqli_fetch_assoc($res);
          if ($row > 0){
            $msg ="Email is already exist!";

          }
          else{

              $inputs['applicant_id'] = $applicant_id = $con->lastInsertId();
              unset($inputs['user_id']);
              $inputs['password'] = encryptIt($inputs['password']);

              //password_hash($inputs['password'], PASSWORD_DEFAULT);

              $token = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM123456789';
              $token = str_shuffle($token);
              $token = substr($token, 0, 10);

              $param_user = array(
               'emp_id' => $inputs['applicant_id'],
               'email' => $email,
               'username' => $inputs['username'],
               'password' => $inputs['password'],
               'password_decrypted' => $inputs['cPassword'],
               'user_type_id' => 0,
               'token' => $token
              );

              // EMAIL VERIFICATION
              $con->myQuery("INSERT INTO users(employee_id,email,username,password,password_decrypted,user_type_id,token) VALUES(:emp_id,:email,:username,:password,:password_decrypted,:user_type_id,:token)", $param_user);



              $mail = new PHPMailer();
              $mail->SMTPDebug = 1;
              $mail->isSMTP();
              $mail->Host = 'smtp.gmail.com';
              $mail->SMTPAuth = true;
              $mail->Username = "carlrosales32998@gmail.com";
              $mail->Password = "Matthew29";
              $mail->SMTPSecure = "tls";
              $mail->Port = 587;

              $mail->setFrom('carlrosales32998@gmail.com','JMSStaffingSolutionInc.');
              $mail->addAddress($email);
              $mail->addReplyTo('carlrosales32998@gmail.com');
              $mail->isHTML(true);                                  // Set email format to HTML
              $mail->Subject = 'Email Verification';
              $mail->Body = "Please Click on the link below <br><br>
                    <a href='http://localhost/template_capstone/verify.php?email=$email&token=$token'>Click Here to Verify your Email</a>";
              $result = $mail->send();
              if($result) {
                    $_SESSION["registration"] = true;
              } else {
                $_SESSION["registration"] = false;

              }

              Alert("Save succesful", "success");

              redirect("index.php");

              $con->commit();

            }
          }

  }catch (Exception $e) {
    $con->rollback();
        error_logs('User', $e);
    echo "<pre>";
    print_r($e);
    echo "</pre>";
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


    <div class="container" style="margin-top: 100px; background-color: skyblue;">
        <center><h1>REGISTRATION</h1></center>
        <div class="row justify-content-center">

            <div class="col-md-6 col-md-offset-3" align="center">
                <?php if($msg != "") echo $msg . "<br><br>"; ?>
                  <form method="post" action="register.php" autocomplete="off" style="margin: 5% 5% 5% 5%;">
                  <label for="inputlg">Firstname</label>
                  <input class="form-control input-sm" type="text" name="firstname" placeholder="Firstname..."><br>

                  <label for="inputlg">Middlename</label>
                  <input class="form-control" type="text" name="middlename" placeholder="Middlename..."><br>

                  <label for="inputlg">Lastname</label>
                  <input class="form-control" type="text" name="lastname" placeholder="Lastname..."><br>

                  <label for="inputlg">Email</label>
                  <input class="form-control" type="email" name="email" placeholder="Email..."><br>

                  <label for="inputlg">Username</label>
                  <input class="form-control" type="text" name="username" placeholder="Username..."><br>

                  <label for="inputlg">Password</label>
                  <input class="form-control" type="password" name="password" placeholder="Password..."><br>

                  <label for="inputlg">Confirm Password</label>
                  <input class="form-control" type="password" name="cPassword" placeholder="Confirm Password..."><br>

                  <center><input class="btn btn-primary btn-block" type="submit" name="submit" value="Register"><br></center>
                </form>
            </div>
            </div>
        </div>

    </div>


</body>
</html>







