<?php
	require_once("../support/config.php");

	$result = $_POST['assessment_result'];
	$assessed_by = $_POST['assessed_by'];
	$remarks =  $_POST['remarks'];
	$process_name = $_POST['process_name'];

	$id = $_SESSION[WEBAPP]['user']['id'];
	$applicant_id = $_GET['id'];

	// var_dump($result);
	// die();
	if (empty($applicant_id)) {
		redirect("recruitment.php");
	} else {
		$applicant = $con->myQuery("SELECT CONCAT(ap.last_name, ', ', ap.first_name) AS applicant_name, application_number FROM tbl_applicant a INNER JOIN tbl_applicant_profile ap ON a.applicant_id = ap.id WHERE a.id = ?", array($applicant_id))->fetch(PDO::FETCH_ASSOC);
		$activity = implode(["Initial assessment result for applicant ", $applicant['applicant_name'], "(", $applicant['application_number'], ")"]);

		$query_history = $con->myQuery("INSERT INTO tbl_application_history (user_id, activity, activity_type, module) VALUES (?, ?, ?, ?)", array($id, $activity, 1, 1));

		$update_application = $con->myQuery("UPDATE tbl_applicant SET is_assessed = 1, assessed_by = '".$id."', assessment_result = '".$result."' WHERE id=?", array($applicant_id));

		if ($result == 5) {
			$query = $con->myQuery("SELECT process_name, employee_process_id AS process_id FROM tbl_interview_process WHERE process_id=?", array($process_name))->fetch(PDO::FETCH_ASSOC);
			
			$process = explode(",", $query['process_id']);
			$process_count = count($process);

			for ($i=0; $i < $process_count; $i++) { 
				$get_process[$i] = $con->myQuery("SELECT id, CONCAT(last_name, ', ', first_name) AS process_name FROM employees WHERE id=?", array($process[$i]))->fetch(PDO::FETCH_ASSOC);
			}

			for ($j=0; $j < count($get_process); $j++) {
				$insert_interview[$j] = $con->myQuery("INSERT INTO tbl_interview (applicant_id, process_owner_id, interview_date, status_date_change) VALUES (?, ?, NULL, NULL)", array($applicant_id, $get_process[$j]['id']));
				var_dump($get_process[$j]);
				// die();
			}
			// die();
		}

		redirect('../view_applicant.php?id='.urlencode($applicant_id));
		// echo $process_owner;
		// var_dump($test);
		// die();		
	}
	// $query = $con->myQuery("INSERT INTO tbl_application_history (user_id) VALUES (?)", array($id));
?>