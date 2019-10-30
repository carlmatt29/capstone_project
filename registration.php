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
			'code'			=> $inputs['code'],
			'first_name'	=> $inputs['firstname'],
			'middle_name'	=> $inputs['middlename'],
			'last_name'		=> $inputs['lastname']

		);

		$con->myQuery("INSERT INTO employees(code,first_name,middle_name,last_name) VALUES (:code,:first_name,:middle_name,:last_name)", $params_applicant);
		// print_r($app_id['applicant_id']);
		// 		die();
		$inputs['applicant_id'] = $applicant_id = $con->lastInsertId();
		unset($inputs['user_id']);
		$inputs['password'] = encryptIt($inputs['password']);

		//password_hash($inputs['password'], PASSWORD_DEFAULT);

		$token = uniqid();
		// $param_user = array(
		// 	'emp_id' => $inputs['applicant_id'],
		// 	'username' => $inputs['username'],
		// 	'password' => $inputs['password'],
		// 	'password_decrypted' => $inputs['cPassword'],
		// 	'user_type_id' => 3,
		// 	'token' => $token
		// );

		// EMAIL VERIFICATION
		$con->myQuery("INSERT INTO users(employee_id,username,password,password_decrypted,user_type_id,token) VALUES(:emp_id,:username,:password,:password_decrypted,:user_type_id,:token)", $param_user);

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
		$mail->addAddress($inputs['email']);
		$mail->addReplyTo('carlrosales32998@gmail.com');
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Email Verification';
		$mail->Body = "Please Click on the link below <br><br> <a href='localhost/capstone_project/confirm.php?email=$email&token=$token'>Click Here</a>";
		$result = $mail->send();
		if($result) {
					$_SESSION["registration"] = true;
		} else {
			$_SESSION["registration"] = false;

		}

		Alert("Save succesful", "success");

		redirect("index.php");

		$con->commit();



	} catch (Exception $e) {
		$con->rollback();
				error_logs('User', $e);
		echo "<pre>";
		print_r($e);
		echo "</pre>";
	}



}

?>
