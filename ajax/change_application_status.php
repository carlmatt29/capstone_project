<?php
	require_once("../support/config.php");

	$applicant_id = $_GET['id'];

	$status = $_POST['applicant_status'];



	if ($status == "8") {
		$query = $con->myQuery("UPDATE tbl_applicant SET application_status_id = '".$status."' WHERE applicant_id = ?", array($applicant_id));
		
		// var_dump($status);
		// die();
	} else {
		$query = $con->myQuery("UPDATE tbl_applicant SET application_status_id = '".$status."' WHERE applicant_id = ?", array($applicant_id));
		// echo "echo";
		// die();
	}
	$_SESSION['success'] = "Status Successfully Updated";
	Alert("Status Successfully Updated","success");
	redirect('../view_applicant.php?id='.urlencode($applicant_id));
?>