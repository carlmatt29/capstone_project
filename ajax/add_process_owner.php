<?php
	require_once("../support/config.php");
	
	if (!empty($_POST["pos_id"])) {
		$query = $con->myQuery("SELECT id, CONCAT(last_name, ', ', first_name) AS process_owner FROM employees WHERE job_title_id = ".$_POST['pos_id']."");
		$rowCount = $query->rowCount();

		if ($rowCount > 0) {
			echo '<option value="">Select Employee</option>';
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				echo '<option value="'.$row['id'].'">'.$row['process_owner'].'</option>';
			}
		} else {
			echo '<option value="">Employee not available</option>';
		}
	}
?>