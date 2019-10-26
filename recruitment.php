<?php
	require_once("support/config.php");
	if (!isLoggedIn()) {
		toLogin();
		die();
	}

	$id = $_SESSION[WEBAPP]['user']['employee_id'];
	// var_dump($id);
	// die();
    // $user_access_id='119';
    // $uid = get_user_access_id($id,$user_access_id);
    // if($uid<>1){
    //   redirect("index.php");
    // }

	//$interview_checker = $con->myQuery("");

	// if (condition) {
	// 	# code...
	// }

	// UNCOMMENT BELOW FOR FUTURE QUERY
	$query = $con->myQuery("SELECT applicant.id, CONCAT(profile.last_name, ', ', profile.first_name, ' ', IFNULL(profile.middle_name, '')) AS applicant_name, profile.email, profile.contact_number, applicant.application_number, status.description AS application_status, applicant.application_status_id, applicant.is_assessed, status.description, applicant.is_viewed, IFNULL(applicant.working, '') AS working, applicant.working_datetime, (SELECT CONCAT(emp.last_name, ', ', emp.first_name) AS process_owner FROM employees emp WHERE emp.id = applicant.interviewer_id) AS process_owner,  position.code as position_name, applicant.desired_monthly_salary, applicant.date_available_for_work, applicant.date_of_contact, applicant.interview_date, applicant.date_applied FROM tbl_applicant AS applicant 
		INNER JOIN tbl_applicant_profile AS profile ON applicant.applicant_id = profile.id 
		INNER JOIN tbl_application_status AS status ON applicant.application_status_id = status.id 
		LEFT JOIN job_title AS position ON applicant.position_applied = position.id 
		WHERE applicant.application_status_id != 8");

	$sample = $con->myQuery("SELECT applicant.id, applicant.is_assessed, CONCAT(profile.last_name, ', ', profile.first_name, ' ', IFNULL(profile.middle_name, '')) AS applicant_name, profile.email, profile.contact_number, applicant.application_number, applicant.application_status_id, status.description, applicant.is_viewed, IFNULL(applicant.working, '') AS working, applicant.working_datetime, CONCAT(employee.last_name, ', ', employee.first_name) AS process_owner, position.position_name as position_name, applicant.desired_monthly_salary, applicant.date_available_for_work, applicant.date_of_contact, applicant.interview_date, applicant.date_applied FROM tbl_applicant AS applicant INNER JOIN tbl_applicant_profile AS profile ON applicant.applicant_id = profile.id INNER JOIN tbl_application_status AS status ON applicant.application_status_id = status.id LEFT JOIN tbl_employee AS employee ON applicant.pending_interview_status = employee.id INNER JOIN tbl_position AS position ON applicant.position_applied = position.id WHERE applicant.application_status_id != 8");

	while ($test = $sample->fetch(PDO::FETCH_ASSOC)) {
		if ($test["is_assessed"] == 0 && $test["working_datetime"] != "0000-00-00 00:00:00") {
			$startTime = strtotime($test["working_datetime"]);
			$endTime = date("Y/m/d H:i:s",strtotime('+30 minutes', $startTime));
				// echo '<pre>' , var_dump($test) , '</pre>';
			if (date('Y/m/d H:i:s') >= $endTime) {
				// echo '<pre>' , var_dump($startTime) , '</pre>';
				// echo '<pre>' , var_dump($endTime) , '</pre>';
				// echo '<pre>' , date('Y/m/d H:i:s') , '</pre>';
				$qry = $con->myQuery("UPDATE tbl_applicant SET is_viewed = 0, working_id = 0, working_datetime = '0000-00-00 00:00:00', working = '' WHERE id = '".$test['id']."' ");
			}
		}
	}

	// die(); 
	
	makeHead("Recruitment");
?>

<?php
	require_once("template/header.php");
	require_once("template/sidebar.php");
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Recruitment
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<?php Alert(); ?>
				<div class="box box-warning">
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12">
								<form class="form-horizontal">
									<div class="form-group">
										
									</div>
								</form>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<table id="resultTable" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center">Applicant No.</th>
								            <th class="text-center">Applicant Name</th>
								            <th class="text-center">Applied Position</th>
								            <th class="text-center">Status</th>
								            <th class="text-center">Process Owner</th>
								            <th class="text-center">Date Applied</th>
								            <th class="text-center">Date of Contact</th>
								            <th class="text-center">Working</th>
								            <th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php while($row = $query->fetch(PDO::FETCH_ASSOC)):?>
											<tr>
												<td><?php echo htmlspecialchars($row['application_number'])?></td>
												<td><?php echo htmlspecialchars($row['applicant_name'])?></td>
												<td><?php echo htmlspecialchars($row['position_name'])?></td>
												<td><?php echo htmlspecialchars($row['application_status'])?></td>
												<td><?php echo htmlspecialchars($row['process_owner'])?></td>
												<td><?php echo htmlspecialchars($row['date_applied'])?></td>
												<td><?php echo htmlspecialchars($row['date_of_contact'])?></td>
												<td><?php echo htmlspecialchars($row['working'])?></td>
												<td class='text-center'>
                                                    <a href='view_applicant.php?id=<?php echo $row['id']?>' class='btn btn-success btn-sm' onclick='update_applicant_view()'><span class='fa fa-eye'></span></a>
                                                </td>
											</tr>
										<?php endwhile; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script type="text/javascript">

	function update_applicant_view() {
		// $.ajax({
		// 	type: "PATCH",
		// 	url: "ajax/update_viewed_by.php",
		// 	success:function(msg) {
		// 		alert("Data saved: " + msg);
		// 	}
		// });
	}

	$(function () 
	{
		$('#resultTable').DataTable(
		{
			// "scrollX": true,
			// dom: 'Bfrtip',
			// buttons: [
			// {
			// 	extend:"excel",
			// 	text:"<span class='fa fa-download'></span> Download as Excel File "
			// }],
		});
		getUsers();
	});
	
</script>

<?php
	Modal();
	makeFoot();
?>