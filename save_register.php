
<?php
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
          $user_id = $con->myQuery("SELECT * FROM users WHERE username = ? AND is_deleted = 0", array($_POST["username"]))->fetch();
          $verifier= $con->myQuery("SELECT * FROM users WHERE id = ? AND is_deleted = 0", array($user_id['id']))->fetch();

          if($verifier["username"] != $_POST["username"]){
          if($verifier["email"] != $_POST["email"]){


          $con->myQuery("INSERT INTO employees(code,first_name,middle_name,last_name) VALUES (:code,:first_name,:middle_name,:last_name)", $params_applicant);
    // print_r($app_id['applicant_id']);

    //    die();


              $inputs['applicant_id'] = $applicant_id = $con->lastInsertId();
              unset($inputs['user_id']);
              $inputs['password'] = encryptIt($inputs['password']);

              //password_hash($inputs['password'], PASSWORD_DEFAULT);

              $token = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM123456789';
              $token = str_shuffle($token);
              $token = substr($token, 0, 10);
              $user_id = 3;
              $param_user = array(
               'emp_id' => $inputs['applicant_id'],
               'email' => $inputs['email'],
               'username' => $inputs['username'],
               'password' => $inputs['password'],
               'password_decrypted' => $inputs['cPassword'],
               'user_type_id' => $user_id,
               'token' => $token
              );

              // EMAIL VERIFICATION
              $hatdog = $con->myQuery("INSERT INTO users(employee_id,email,username,password,password_decrypted,user_type_id,token) VALUES(:emp_id,:email,:username,:password,:password_decrypted,:user_type_id,:token)", $param_user);
              // print_r($hatdog);
              // die();


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
                    <a href='http://localhost/template_capstone/verify.php?token=$token'>Click Here to Verify your Email</a>";
              $result = $mail->send();
              if($result) {
                    $_SESSION["registration"] = true;
              } else {
                $_SESSION["registration"] = false;

              }

              Alert("Register succesful", "success");
              redirect("register.php");

              $con->commit();
            }

            else{
            ?>
              <script> alert('Email already in used!')</script>';
            <?php

            }
            }
            else{
            ?>
              <script> alert('Username already in used!')</script>';
            <?php

            }
}
  }
  catch (Exception $e) {
    $con->rollback();
        error_logs('User', $e);
    echo "<pre>";
    print_r($e);
    echo "</pre>";
  }



}

?>
