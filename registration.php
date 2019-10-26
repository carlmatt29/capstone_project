<?php
require_once("support/config.php");

if (!empty($_POST)) {

	$inputs = $_POST;

	try {
		echo "<pre>";
		print_r($inputs);
		echo "</pre>";

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
		$param_user = array(
			'emp_id' => $inputs['applicant_id'],
			'username' => $inputs['username'],
			'password' => $inputs['password'],
			'password_decrypted' => $inputs['cPassword'],
			'user_type_id' => 3,
			'token' => $token
		);


		$con->myQuery("INSERT INTO users(employee_id,username,password,password_decrypted,user_type_id,token) VALUES(:emp_id,:username,:password,:password_decrypted,:user_type_id,:token)", $param_user);


		$to      = $inputs['email'];
		$subject = 'Email Verification';
		$message = "Please Click on the link below <br><br> <a href='localhost/capstone_project/confirm.php?email=$to&token=$token'>Click Here</a>";

		$headers = 'From: carlrosales32998@gmail.com' . "\r\n" .
			'Reply-To: carlrosales32998@gmail.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		$headers .= "Return-Path: carlrosales32998@gmail.com\r\n";
		// $headers .= "CC: sombodyelse@example.com\r\n";
		// $headers .= "BCC: " . $_POST['emailAddress'] . "\r\n";

		$result = mail($to, $subject, $message);

		echo "result: " . $result;


		Alert("Save succesful", "success");
		// redirect("index.php");

		$con->commit();
	} catch (Exception $e) {
		$con->rollback();
		error_logs('User', $e);
		echo "<pre>";
		print_r($e);
		echo "</pre>";
	}
}
