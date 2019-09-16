<?php
	require_once("../support/config.php");

	$id = $_SESSION[WEBAPP]['user']['id'];
	$interview_id = $_GET['id'];
	$applicant_id = $_GET['applicant_id'];

	$interview_date = $_POST['interview_date'];
	$date_of_interview = date('Y-m-d H:i:s', strtotime($interview_date));

	$interview_status = $_POST['interview_status'];
	$remarks = $_POST['remarks'];
	$interview_not_available = $_POST['interview_not_available'];
	$activity = '';

	$interviewer_id = $con->myQuery("SELECT process_owner_id FROM tbl_interview WHERE id = ?", array($interview_id))->fetch(PDO::FETCH_ASSOC);
	$interviewer_id = $interviewer_id['process_owner_id'];

	if (empty($interview_date)) {
		if ($interview_not_available == "on") {
			$query = $con->myQuery("UPDATE tbl_interview SET interview_status = 7,remarks = '".$remarks."', status_date_change = NOW() WHERE id = ?", array($interview_id));

			$history = $con->myQuery("INSERT INTO tbl_application_history (user_id, date_of_activity, activity, activity_type, module) VALUES (?, NOW(), ?, 2, 119)", array($id, $activity));
		} else {
			$query = $con->myQuery("UPDATE tbl_interview SET interview_status = '".$interview_status."',remarks = '".$remarks."', status_date_change = NOW() WHERE id = ?", array($interview_id));

			$update_application = $con->myQuery("UPDATE tbl_application SET pending_interview_status = ''");

			$history = $con->myQuery("INSERT INTO tbl_application_history (user_id, date_of_activity, activity, activity_type, module) VALUES (?, NOW(), ?, 2, 119)", array($id, $activity));
		}
	} else {
		$update_application = $con->myQuery("UPDATE tbl_applicant SET interviewer_id = '".$interviewer_id."' WHERE id = ?", array($applicant_id));

		$update_interview = $con->myQuery("UPDATE tbl_interview SET interview_date = '".$date_of_interview."', remarks = '".$remarks."', status_date_change = NOW() WHERE id = ?", array($interview_id));

		$history = $con->myQuery("INSERT INTO tbl_application_history (user_id, date_of_activity, activity, activity_type, module) VALUES (?, NOW(), ?, 2, 119)", array($id, $activity));
	}
	
	redirect('../view_applicant.php?id='.urlencode($applicant_id));
?>