<?php
	require_once("../support/config.php");

	$applicant_id = $_GET['id'];

	$position = $_POST['pos'];
	$employee = $_POST['emp'];
	$interview_date = $_POST['interview_date'];

	$query = $con->myQuery("INSERT INTO tbl_interview (applicant_id, process_owner_id, interview_date, interview_status) VALUES (?,?,?, NULL)", array($applicant_id, $employee, $interview_date));

	// $query = $con->myQuery("SELECT process_name, employee_process_id AS process_id FROM tbl_interview_process WHERE id=?", array($applicant_id))->fetch(PDO::FETCH_ASSOC);
	// $process = explode(",", $query['process_id']);
	// $process_count = count($process);

	// for ($i=0; $i < $process_count; $i++) { 
	// 	$get_process[$i] = $con->myQuery("SELECT CONCAT(last_name, ', ', first_name) AS process_name FROM employees WHERE id=?", array($process[$i]))->fetch(PDO::FETCH_ASSOC);
	// }

	// for ($j=0; $j < count($get_process); $j++) { 
	// 	var_dump($get_process[$j]['process_name']);
	// }

	// var_dump($employee);
	// die();

	redirect('../view_applicant.php?id='.urlencode($applicant_id));
?>