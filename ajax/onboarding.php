<?php
	require_once("../support/config.php");

	$applicant_id = $_GET['id'];

	$employee_code = $_POST['employee_code'];
	$last_name = $_POST['last_name'];
	$first_name = $_POST['first_name'];
	$middle_name = $_POST['middle_name'];
	$nationality = $_POST['nationality'];
	$civil_status = $_POST['civil_status'];
	$date_of_birth = $_POST['date_of_birth'];
	$gender = $_POST['gender'];
	$sss_no = $_POST['sss_no'];
	$tin = $_POST['tin'];
	$philhealth_no = $_POST['philhealth_no'];
	$pagibig_no = $_POST['pagibig_no'];
	$address_1 = $_POST['address_1'];
	$address_2 = $_POST['address_2'];
	$city = $_POST['city'];
	$province = $_POST['province'];
	$country = $_POST['country'];
	$postal_code = $_POST['postal_code'];
	$contact_no = $_POST['contact_no'];
	$email_address = $_POST['email_address'];
	// $tax_status = $_POST['tax_status'];

	// ADDITIONAL FIELDS
	$employment_status = $_POST['employment_status'];
	$pay_grade = $_POST['pay_grade'];
	$tax_status = $_POST['tax_status'];
	$department = $_POST['department'];
	$payroll_group = $_POST['payroll_group'];

	if (!empty($applicant_id)) {
		echo '<pre>' . var_dump($last_name) . '</pre>';
		echo '<pre>' . var_dump($first_name) . '</pre>';
		echo '<pre>' . var_dump($middle_name) . '</pre>';
		echo '<pre>' . var_dump($nationality) . '</pre>';
		echo '<pre>' . var_dump($civil_status) . '</pre>';
		echo '<pre>' . var_dump($date_of_birth) . '</pre>';
		echo '<pre>' . var_dump($gender) . '</pre>';
		echo '<pre>' . var_dump($sss_no) . '</pre>';
		echo '<pre>' . var_dump($tin) . '</pre>';
		echo '<pre>' . var_dump($philhealth_no) . '</pre>';
		echo '<pre>' . var_dump($pagibig_no) . '</pre>';
		echo '<pre>' . var_dump($address_1) . '</pre>';
		echo '<pre>' . var_dump($address_2) . '</pre>';
		echo '<pre>' . var_dump($city) . '</pre>';
		echo '<pre>' . var_dump($province) . '</pre>';
		echo '<pre>' . var_dump($country) . '</pre>';
		echo '<pre>' . var_dump($postal_code) . '</pre>';
		echo '<pre>' . var_dump($contact_no) . '</pre>';
		echo '<pre>' . var_dump($email_address) . '</pre>';
		echo '<pre>' . var_dump($tax_status) . '</pre>';
		echo '<pre>' . var_dump($employment_status) . '</pre>';
		echo '<pre>' . var_dump($pay_grade) . '</pre>';
		echo '<pre>' . var_dump($tax_status) . '</pre>';
		echo '<pre>' . var_dump($department) . '</pre>';
		echo '<pre>' . var_dump($payroll_group) . '</pre>';

		// var_dump($last_name);
		// var_dump($first_name);
		// var_dump($middle_name);
		// var_dump($nationality);
		// var_dump($civil_status);
		// var_dump($date_of_birth);
		// var_dump($gender);
		// var_dump($sss_no);
		// var_dump($tin);
		// var_dump($philhealth_no);
		// var_dump($pagibig_no);
		// var_dump($address_1);
		// var_dump($address_2);
		// var_dump($city);
		// var_dump($province);
		// var_dump($country);
		// var_dump($postal_code);
		// var_dump($contact_no);
		// var_dump($email_address);
		// var_dump($tax_status);

		// var_dump($employment_status);
		// var_dump($pay_grade);
		// var_dump($tax_status);
		// var_dump($department);
		// var_dump($payroll_group);

		//$query = $con->myQuery("INSERT INTO employees () VALUES ()", array());

		die();
	} else {
		redirect('../recruitment.php');
	}

	// redirect('../view_applicant.php?id='.urlencode($applicant_id));

	// echo "hello";
	// die();
?>