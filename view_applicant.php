<?php
	require_once("support/config.php");
	if (!isLoggedIn()) {
		toLogin();
		die();
	}
	ini_set("display_error",1);

	session_start();

	$id = $_SESSION[WEBAPP]['user']['id'];
	$applicant_id = $_GET['id'];

	$session = $con->myQuery("SELECT * FROM tbl_applicant WHERE id=?", array($_GET['id']))->fetch(PDO::FETCH_ASSOC);

	# FINAL QUERY FOR CHECKING OF JOB TITLE - HR DEPT
	// $job_checker = $con->myQuery("SELECT jt.description FROM users u INNER JOIN employees e ON u.employee_id = e.id INNER JOIN job_title jt ON e.job_title_id = jt.id WHERE jt.id IN (16, 26, 27) AND u.id = '".$id."'")->fetch(PDO::FETCH_ASSOC);
	
	# UNCOMMENT THIS IN THE FUTURE
	$job_checker = $con->myQuery("SELECT jt.description FROM users u INNER JOIN employees e ON u.employee_id = e.id INNER JOIN job_title jt ON e.job_title_id = jt.id WHERE jt.id IN (16, 26, 27, 13, 1, 3) AND u.id = '".$id."'")->fetch(PDO::FETCH_ASSOC);

	# PREVIOUS CODE
	// if ($session['is_viewed'] == 1 && $session['working_id'] == $id) {
	// 	if ($session['working_id'] != $id) {
	// 		redirect("recruitment.php");
	// 	}
	// }
	$is_assessed = $con->myQuery("SELECT is_assessed FROM tbl_applicant WHERE id = '".$applicant_id."'")->fetch(PDO::FETCH_ASSOC);

	# TEST CONDITION FOR VIEWING OF APPLICANTS APPLICATION FORM
	if ($session['is_viewed'] == 1) {
		// if ($session['working_id'] != $id) {
		// 	if (empty($is_assessed["is_assessed"]) || $is_assessed["is_assessed"] == 0) {
		// 		redirect("recruitment.php");
		// 	}
		// 	if (empty($job_checker)) {
		// 		redirect("recruitment.php");
		// 	}
		// }
	} else if ($session['is_viewed'] == 0) {
		$inputs['employees_id']=$_SESSION[WEBAPP]['user']['employee_id'];
		$loggedin_user = "SELECT id, CONCAT(e.last_name, ', ', e.first_name) AS employee FROM employees e WHERE e.id=:employees_id";
		$data = $con->myQuery($loggedin_user,$inputs)->fetch(PDO::FETCH_ASSOC); 
		$query = $con->myQuery("UPDATE tbl_applicant SET is_viewed = 1, working_id = '".$id."', working = '".$data['employee']."' WHERE id = ?", array($_GET['id']));
	} else {
		redirect("recruitment.php");
	}

	// die();

	if (!empty($_GET['id'])) {
		$result_id = $con->myQuery("SELECT assessment_result FROM tbl_applicant WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
		# CHANGE THE VARIABLE NAME OF THE VARIABLE BELOW
		$sample_application_id = $con->myQuery("SELECT application_status_id FROM tbl_applicant WHERE applicant_id = ?", array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
		$applicant = $con->myQuery("SELECT applicant.id, CONCAT(profile.last_name, ', ', profile.first_name, ' ', IFNULL(profile.middle_name, '')) AS applicant_name, profile.email, profile.contact_number, applicant.application_number, applicant.application_status_id, status.description, applicant.is_viewed, IFNULL(applicant.assessed_by, '') AS assessed_by_id, position.id AS position_id, position.description, applicant.desired_monthly_salary, DATE_FORMAT(applicant.date_available_for_work,'%W, %D %M %Y') AS date_available_for_work, applicant.date_of_contact, applicant.interview_date, applicant.date_applied, (SELECT CONCAT(e.last_name, ', ', e.first_name) AS assessed_by 
			FROM employees e 
			INNER JOIN users u ON u.employee_id = e.id
			INNER JOIN tbl_applicant a ON u.id = a.assessed_by WHERE a.id = ?)  AS assessed_by 
			FROM tbl_applicant AS applicant 
			INNER JOIN tbl_applicant_profile AS profile ON applicant.applicant_id = profile.id 
			INNER JOIN tbl_application_status AS status ON applicant.application_status_id = status.id 
			LEFT JOIN tbl_employee AS employee ON applicant.pending_interview_status = employee.id INNER JOIN job_title AS position ON applicant.position_applied = position.id WHERE applicant.id=?", array($applicant_id, $_GET['id']))->fetch(PDO::FETCH_ASSOC);
		# CHANGE THE VARIABLE NAME OF THE VARIABLE BELOW
		$assessed_by = $con->myQuery("SELECT applicant.assessment_result, application_status.description FROM tbl_applicant applicant INNER JOIN tbl_application_status application_status ON applicant.assessment_result = application_status.id WHERE applicant.id = ?", array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
		$assessed_by_count = $con->myQuery("SELECT applicant.assessment_result, application_status.description FROM tbl_applicant applicant INNER JOIN tbl_application_status application_status ON applicant.assessment_result = application_status.id WHERE applicant.id = ?", array($_GET['id']));
		$count_assessed_by = $assessed_by_count->rowCount();

		// if(trim($applicant["assessed_by_id"]) == trim($id)) {
		// 	var_dump('hello');
		// } else {
		// 	var_dump('hi');
		// }

		// var_dump($applicant["assessed_by_id"]);
		// var_dump($id);

		// die();

	} else {
		redirect("recruitment.php");
	}

	# CHANGE THE VARIABLE NAME OF THE VARIABLE BELOW
	// $position = $con->myQuery("SELECT id, description FROM job_title WHERE is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);
	$position_ = $con->myQuery("SELECT id AS pos_id,code, description FROM job_title WHERE is_deleted = 0");
	$position_count = $position_->rowCount();

	$applied_position = $con->myQuery("SELECT position.process_id FROM tbl_applicant AS applicant INNER JOIN tbl_position AS position ON applicant.position_applied = position.id WHERE applicant.id=1");
	$application_status = $con->myQuery("SELECT id, description FROM tbl_application_status WHERE is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);
	$result_status = $con->myQuery("SELECT id, description FROM tbl_application_status WHERE status_name = 'passed' OR status_name = 'failed'")->fetchAll(PDO::FETCH_ASSOC);

	if (isset($_REQUEST['change_application_status'])) {

	}

	$user = $con->myQuery(	"SELECT id,username,password,is_active,last_activity,user_type_id,password_question,password_answer FROM users
		WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
	
	$user_types = $con->myQuery("SELECT id, description FROM user_type")->fetchAll(PDO::FETCH_ASSOC);

	$applicant_details = $con->myQuery("SELECT first_name, middle_name, last_name, email, present_address, contact_number, city, state_province_region, postal_code, country, gender, age, DATE_FORMAT(date_of_birth, '%M %d, %Y') AS date_of_birth, citizenship, marital_status FROM tbl_applicant_profile WHERE id", array($applicant_id))->fetch(PDO::FETCH_ASSOC);

	// FOR FETCHING EMPLOYMENT STATUS IN DROPDOWN RESULT
	$employment_status = $con->myQuery("SELECT id, name FROM employment_status WHERE is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

	// FOR FETCHING PAY GRADE OF EMPLOYEE
	$pay_grade = $con->myQuery("SELECT id, level FROM pay_grade WHERE is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

	// FOR FETCHING TAX STATUS
	$tax_status = $con->myQuery("SELECT id, description FROM tax_status WHERE is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

	// FOR FETCHING DEPARTMENTS
	$department = $con->myQuery("SELECT id, name FROM departments WHERE is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

	// FOR FETCHING PAYROLL GROUPS
	$payroll_group = $con->myQuery("SELECT payroll_group_id, name FROM payroll_groups WHERE is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

	// GET COUNT WITH NULL VALUES OF INTERVIEWER
	$interviewer_null_count = $con->myQuery("SELECT COUNT(id) AS null_count FROM tbl_interview WHERE applicant_id = ? AND interview_status IS NULL", array($applicant_id))->fetch(PDO::FETCH_ASSOC);
	$interviewer_null_count = $interviewer_null_count['null_count'];

	makeHead("Applicant Details");
?>

<?php
	require_once("template/header.php");
	require_once("template/sidebar.php");
?>

<div class="content-wrapper">
	<section class="content-header">
		<a href='recruitment.php' class='btn btn-default'><span class='glyphicon glyphicon-arrow-left'></span> Applicant list</a>
	</section>

	<section class="content">
		<div class="row">
			<div>
				<div class="col-md-9" style="margin: 5px 0">
					<div class="row">
						<div class="col-md-6" style="margin: 5px 0">
							<label for="position">Position:</label>
							<input type="text" name="position" id="position" value='<?php echo!empty($applicant)?htmlspecialchars($applicant['description']):''; ?>' style="width: 100%" class="form-control" disabled>
						</div>
						<div class="col-md-6" style="margin: 5px 0">
							<label for="applicant_number">Applicant Number:</label>
							<input type="text" name="applicant_number" id="applicant_number" value='<?php echo!empty($applicant)?htmlspecialchars($applicant['application_number']):''; ?>' style="width: 100%" class="form-control" disabled>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" style="margin: 5px 0">
							<label for="applicant_name">Applicant Name:</label>
							<input type="text" name="applicant_name" id="applicant_name" value='<?php echo!empty($applicant)?htmlspecialchars($applicant['applicant_name']):''; ?>' style="width: 100%" class="form-control" disabled>
						</div>
						<div class="col-md-6" style="margin: 5px 0">
							<label for="asking_salary">Asking Salary:</label>
							<input type="text" name="asking_salary" id="asking_salary" value='<?php echo!empty($applicant)?htmlspecialchars($applicant['desired_monthly_salary']):''; ?>' style="width: 100%" class="form-control" disabled>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" style="margin: 5px 0">
							<label>Date Available for Work:</label>
							<input type="text" name="date_available_for_work" id="date_available_for_work" value='<?php echo!empty($applicant)?htmlspecialchars($applicant['date_available_for_work']):''; ?>' style="width: 100%" class="form-control" disabled>
						</div>
						<!-- <form method="post" action="" onSubmit="window.location.reload()"> -->
						<form method="post" action="ajax/change_application_status.php?id=<?php echo $_GET['id']?>">
							<div class="col-md-6" style="margin: 5px 0">
								<label>Application Status: <Font style='color:red;'>(STEP #3)</Font></label>
								<select name="applicant_status" id="applicant_status" onchange="hired()" class="form-control cbo" style="width: 100%" <?php echo !(empty($_GET))?"data-selected='".$sample_application_id['application_status_id']."'":NULL ?> required>
									<!-- <option value="" disabled selected hidden>Select Application Status</option> -->
									<?php
										echo makeOptions($application_status, "Select Application Result")
									?>
								</select>
							</div>
							<div class="col-md-6" style="margin: 5px 0">
								<!-- <input type="submit" name="change_application_status" <?php if($applicant["assessed_by_id"] != $id) {?> disabled="disabled" <?php } ?> value="Update Application Status" style="width: 100%; height: 50px;"> -->

								<button class="btn btn-primary" name="change_application_status" type="submit" <?php if(($applicant["assessed_by_id"] != $id) || ($interviewer_null_count > 0)) {?> disabled="disabled" <?php } ?> style="width: 100%; height: 50px;">Update Application Status</button>	
							</div>
						</form>
						<div class="col-md-6"></div>
						<div class="col-md-6">
						    
						   <label style="font-size:11px;color:red;">(Step #1 & Step #2 must have result before Application status can be updated)</label>
						</div>
						
							<!-- <div class="col-md-6" style="margin: 5px 0">
								<label for="applicant_status">Application Status:</label>
								<select name="applicant_status" class="form-control" style="width: 100%" required>
									<option value="" disabled selected hidden>Select Application Status</option>
									<?php
										echo makeOptions($application_status);
									?>
								</select>
							</div> -->
					</div>
				</div>
				<div class="col-md-3" style="margin: 5px 0">
					<div class="col-md-12">
						<!--<div class="row"  style="margin-bottom: 5px">
							<a href="application_form_temp.php" style="width: 100%; height: 50px">(UNDER MAINTENANCE) View Application Form </a>	
						</div>-->
						
						<div class="row">
						<form action="application_form_view.php" method="post" autocomplete="off">
						    <input style="display:none;" value="<?php echo $applicant_id; ?> " name="applicant_id">
							<input class="btn btn-primary" style="width:80%;" type="submit" value="View Application Form"/>
						</form>
						</div>
						<div class="row">
							<button style="display:none;width: 100%; height: 50px">Download Application Form</button>	
						</div>
					</div>
				</div>
			</div>
			<br/>

			<div class="col-md-12">
				<h3>INITIAL ASSESSMENT  <Font style='color:red;'>(STEP #1)</Font></h3>	
				<hr>
				<form action="ajax/submit_initial_assessment.php?id=<?php echo $_GET['id']?>" method="POST">
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12" style="margin: 5px 0">
									<label>Initial Assessment Result:</label>
									<select <?php if(!empty($assessed_by)){ echo 'disabled';} ?> class='form-control cbo' name='assessment_result' id='assessment_result' data-placeholder="Select Assessment Result" <?php echo !(empty($_GET))?"data-selected='".$result_id['assessment_result']."'":NULL ?> style='width:100%'>

										<?php echo makeOptions($result_status, "Select Assessment Result") ?>
									</select>
									
								</div>
							</div>
							<!-- POSITION -->
							<input type="hidden" name="process_name" id="process_name" value='<?php echo htmlspecialchars($applicant['position_id']); ?>' style="width: 100%" class="form-control">

							<div class="row">
								<div class="col-md-12" style="margin: 5px 0">
									<label>Assessed By:</label>
									<input type="text" name="assessed_by" id="assessed_by" value='<?php echo!empty($applicant)?htmlspecialchars($applicant['assessed_by']):''; ?>' style="width: 100%" class="form-control" disabled>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12" style="margin: 5px 0">
									<label>Remarks:</label>
									<textarea <?php if(!empty($assessed_by)){ echo 'disabled';} ?> name="remarks" rows="5" style="width: 100%"></textarea>	
								</div>
							</div>
						</div>
						<div class="col-md-12 text-left">
							<button class="btn btn-primary" type="submit" <?php if($count_assessed_by>0) {?> disabled="disabled" <?php } ?>>Submit Initial Assessment</button>	
						</div>
					</div>
				</form>
				<hr>
			</div>
		</div>

		<div class="row">
		    
			<div class="col-md-6 text-right" >
				<!-- <a href="#" class="btn btn-warning"><span class="fa fa-plus"></span> Add Process Owner</a> -->
				<!-- <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#processOwner" <?php if(empty($assessed_by)){ echo 'disabled';} ?> >Add Process Owner</button> -->
			    <Right> <H3  style='color:red;'>(STEP #2)  </H3></Right>
				
				<!-- <button class="btn btn-warning" data-toggle="modal" data-target="#add_process_owner">Add Process Owner</button> -->
			</div>
			<div class="col-md-6 text-right" style="margin-bottom:10px;">
			    <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#processOwner" <?php if(empty($assessed_by) || ($applicant["assessed_by_id"] != $id)){ echo 'disabled';} ?> >Add Interviewer</button>
			    
			    <Center><Font style='font-size:11px;'> Note: Click <a style='font-size:11px' href="job_title.php">here </a> to update preset interviewer(s) </Font></Center>
			</div>  
			
			<div class="col-md-12">
			    
				<table id="resultTable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th class="text-center">Process Owner</th>
							<th class="text-center">Interview Date</th>
							<th class="text-center">Interview Status</th>
							<th class="text-center">Remarks</th>
							<th class="text-center">Status Change Date</th>
							<th char="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<!-- <tr>
							<td>HR (Mike Enriquez)</td>
							<td>10/22/2018</td>
							<td>PASSED</td>
							<td>-</td>
							<td>10/24/2018</td>
						</tr> -->
					</tbody>
				</table>
			</div>
		</div>

		<!-- MODAL FORM FOR ADDING PROCESS OWNER -->
		<div class="modal fade" id="processOwner" tabindex="-1" role="dialog" aria-labelledby="processOwnerLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form method="POST" action="ajax/frm_add_process_owner.php?id=<?php echo $_GET['id']?>">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>

						<div class="modal-body">
							<div class="form-group">
								<label>Position:</label>
								<select id="pos" name="pos" class="form-control" required>
									<option value="selectposition">Select Position</option>
									<?php
										if ($position_count > 0) {
											while ($row = $position_->fetch(PDO::FETCH_ASSOC)) {
												echo '<option value="'.$row['pos_id'].'">'.$row['code'].' </option>';
											}
										} else {
											echo "<option>Position not available</option>";
										}
									?>
								</select>
							</div>

							<div class="form-group">
								<label>Employee:</label>
								<select id="emp" name="emp" class="form-control" required>
									<option value="">Select Position First</option>
								</select>
							</div>

							<div class="form-group">
								<label> Interview Date:</label>
								<input type="date" name="interview_date" id="interview_date" class="form-control" required>
							</div>
						</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-warning">Save</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>

<div id="myModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">
	<!-- Modal content-->
		<div class="modal-content">
			<form method="POST" action="ajax/onboarding.php?id=<?php echo $applicant_id?>">
				<div class="modal-header">
					<h4 class="modal-title">Employee Form</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<!-- ADDITIONAL FIELDS -->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Employment Status</label>
									<select class='form-control cbo' name='employment_status' id='employment_status' data-placeholder="Select Employment Status" style='width:100%' required>

										<?php echo makeOptions($employment_status, "Select Assessment Result") ?>
									</select>

									<label>Pay Grade</label>
									<select class='form-control cbo' name='pay_grade' id='pay_grade' data-placeholder="Select Pay Grade" style='width:100%' required>

										<?php echo makeOptions($pay_grade, "Select Pay Grade") ?>
									</select>

									<label>Tax Status</label>
									<select class='form-control cbo' name='tax_status_id' id='tax_status_id' data-placeholder="Select Tax Status" style='width:100%' required>

										<?php echo makeOptions($tax_status, "Select Tax Status") ?>
									</select>

									<label>Department</label>
									<select class='form-control cbo' name='department' id='department' data-placeholder="Select Department" style='width:100%' required>

										<?php echo makeOptions($department, "Select Department") ?>
									</select>

									<label>Payroll Group</label>
									<select class='form-control cbo' name='payroll_group' id='payroll_group' data-placeholder="Select Payroll Group" style='width:100%' required>

										<?php echo makeOptions($payroll_group, "Select Payroll Group") ?>
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Employment Status</label>
									<select class='form-control cbo' name='employment_status' id='employment_status' data-placeholder="Select Employment Status" style='width:100%' required>

										<?php echo makeOptions($employment_status, "Select Assessment Result") ?>
									</select>

									<label>Pay Grade</label>
									<select class='form-control cbo' name='pay_grade' id='pay_grade' data-placeholder="Select Pay Grade" style='width:100%' required>

										<?php echo makeOptions($pay_grade, "Select Pay Grade") ?>
									</select>

									<label>Tax Status</label>
									<select class='form-control cbo' name='tax_status' id='tax_status' data-placeholder="Select Tax Status" style='width:100%' required>

										<?php echo makeOptions($tax_status, "Select Tax Status") ?>
									</select>

									<label>Department</label>
									<select class='form-control cbo' name='department' id='department' data-placeholder="Select Department" style='width:100%' required>

										<?php echo makeOptions($department, "Select Department") ?>
									</select>

									<label>Payroll Group</label>
									<select class='form-control cbo' name='payroll_group' id='payroll_group' data-placeholder="Select Payroll Group" style='width:100%' required>

										<?php echo makeOptions($payroll_group, "Select Payroll Group") ?>
									</select>
								</div>
							</div>

						</div>

						<!-- EMPLOYEE CODE -->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Enter Employee Code:</label>
									<input type="text" name="employee_code" class="form-control" required>
								</div>
							</div>
						</div>
						<!-- EMPLOYEE NAME -->
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Last Name:</label>
									<!-- <?php if(!empty($assessed_by)){ echo 'disabled';} ?> -->
									<input type="text" name="last_name" class="form-control" value='<?php echo !empty($applicant_details)?htmlspecialchars($applicant_details['last_name']):''; ?>' readonly>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label>First Name:</label>
									<input type="text" name="first_name" class="form-control" value='<?php echo !empty($applicant_details)?htmlspecialchars($applicant_details['first_name']):''; ?>' readonly>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>Middle Name:</label>
									<input type="text" name="middle_name" class="form-control" value='<?php echo !empty($applicant_details)?htmlspecialchars($applicant_details['middle_name']):''; ?>' readonly>
								</div>
							</div>
						</div>
						<!--  -->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Nationality:</label>
									<input type="text" name="nationality" class="form-control" value='<?php echo !empty($applicant_details)?htmlspecialchars($applicant_details['citizenship']):''; ?>' readonly>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Civil Status:</label>
									<input type="text" name="civil_status" class="form-control" value='<?php echo !empty($applicant_details)?htmlspecialchars($applicant_details['marital_status']):''; ?>' readonly>
								</div>
							</div>
						</div>
						<!--  -->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Date of Birth:</label>
									<input type="text" name="date_of_birth" class="form-control" value='<?php echo !empty($applicant_details)?htmlspecialchars($applicant_details['date_of_birth']):''; ?>' readonly>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Gender:</label>
									<input type="text" name="gender" class="form-control" value='<?php echo !empty($applicant_details)?htmlspecialchars($applicant_details['gender']):''; ?>' readonly>
								</div>
							</div>
						</div>
						<!--  -->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>SSS Number:</label>
									<input type="text" pattern="[0-9]{2}-[0-9]{7}-[0-9]{2}" name="sss_no" class="form-control sss" id="sss_no" placeholder="SSS Number">
									<label for="w_sss">
										<input type="checkbox" name="w_sss" id="w_sss"> Deduct sss from payroll
									</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Tax Identification Number:</label>
									<input type="text" pattern="[0-9]{2}-[0-9]{9}-[0-9]{1}" name="tin" class="form-control tin" id="tin" placeholder="Tax Identification Number">
								</div>
							</div>
						</div>
						<!--  -->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Philhealth:</label>
									<input type="text" pattern="" name="philhealth_no" class="form-control philhealth" id="philhealth_no" placeholder="Philhealth">
									<label for="w_philhealth">
										<input type="checkbox" name="w_philhealth" id="w_philhealth"> Deduct philhealth from payroll
									</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Pag-ibig:</label>
									<input type="text" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" name="pagibig_no" class="form-control pagibig" id="pagibig_no" placeholder="Pagibig">
									<label for="w_pagibig">
										<input type="checkbox" name="w_pagibig" id="w_pagibig"> Deduct pagibig from payroll
									</label>
								</div>
							</div>
						</div>
						<!--  -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Address 1:</label>
									<input type="text" name="address_1" class="form-control" value='<?php echo !empty($applicant_details)?htmlspecialchars($applicant_details['present_address']):''; ?>' readonly>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Address 2:</label>
									<input type="text" name="address_2" class="form-control">
								</div>
							</div>
						</div>
						<!--  -->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>City:</label>
									<input type="text" name="city" class="form-control" value='<?php echo !empty($applicant_details)?htmlspecialchars($applicant_details['city']):''; ?>' readonly>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Province:</label>
									<input type="text" name="province" class="form-control" value='<?php echo !empty($applicant_details)?htmlspecialchars($applicant_details['state_province_region']):''; ?>' readonly>
								</div>
							</div>
						</div>
						<!--  -->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Country:</label>
									<input type="text" name="country" class="form-control" value='<?php echo !empty($applicant_details)?htmlspecialchars($applicant_details['country']):''; ?>' readonly>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Postal Code:</label>
									<input type="text" name="postal_code" class="form-control" value='<?php echo !empty($applicant_details)?htmlspecialchars($applicant_details['postal_code']):''; ?>' readonly>
								</div>
							</div>
						</div>
						<!--  -->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Contact No:</label>
									<input type="text" name="contact_no" class="form-control" value='<?php echo !empty($applicant_details)?htmlspecialchars($applicant_details['contact_number']):''; ?>' readonly>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Work Contact No:</label>
									<input type="text" name="work_contact_no" class="form-control">
								</div>
							</div>
						</div>
						<!--  -->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Email Address:</label>
									<input type="text" name="email_address" class="form-control" value='<?php echo !empty($applicant_details)?htmlspecialchars($applicant_details['email']):''; ?>' readonly>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Work Email Address:</label>
									<input type="text" name="work_email_address" class="form-control">
								</div>
							</div>
						</div>
						<!--  -->
						<div class="row">
							<!-- <div class="col-md-4">
								<div class="form-group">
									<label>Tax Status:</label>
									<input type="text" name="tax_status" class="form-control">
								</div>
							</div> -->
							<div class="col-md-4">
								<div class="form-group">
									<label>Account No:</label>
									<input type="text" name="account_no" class="form-control">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Access Unit ID:</label>
									<input type="text" name="access_unit_id" class="form-control">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-warning">Save</button>
					<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
					<button type="button" class="btn btn-default" id="closemodal" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

	function hired() {
		var option_value = document.getElementById("applicant_status").value;
		if (option_value == "8") {
			$(document).ready(function(){	
				// alert("Hai !");
				$("#myModal").modal('show');
			});
		}
	}

	$('#closemodal').on('click', function() {
		window.location.reload();
	});

	// $(document).ready(function(){	
	// 	$("#contactForm").submit(function(event){
	// 		submitForm();
	// 		return false;
	// 	});
	// });

	// function submitForm(){
	// 	 $.ajax({
	// 		type: "POST",
	// 		url: "ajax/add_process_owner.php",
	// 		cache:false,
	// 		data: $('form#contactForm').serialize(),
	// 		success: function(response){
	// 			$("#contact").html(response);
	// 			// $("#contact-modal").modal('hide');
	// 		},
	// 		error: function(){
	// 			alert("Error");
	// 		}
	// 	});
	// }

	// $(document).ready(function(){	
	// 	$("#add_process").submit(function(event){
	// 		contactForm();
	// 		return false;
	// 	});
	// });

	// function contactForm() {
	// 	$.ajax({
	// 		type: "POST",
	// 		url: "",
	// 		cache: false,
	// 		data: $('form#add_process').serialize(),
	// 		success: function(response) {
	// 			$("").html(response)
	// 			$("#").modal('hide');
	// 		},
	// 		error: function(){
	// 			alert("Error");
	// 		}
	// 	});
	// }

	// function addProcessOwner() {
	// 	var position = $('#pos').val();
	// 	var process_owner = $('#emp').val();
	// 	var interview_date = $('#interview_date').val();

	// 	$.ajax({
	// 		type: 'POST',
	// 		url: '',
	// 		data: 
	// 	});
	// 	// if (position == 'selectposition') {
	// 	// 	alert('Please select position');
	// 	// 	$('#pos').focus();
	// 	// 	return false;
	// 	// }
	// }

	// function set_result() {
	// 	var result_name = $("select[name='assessment_result'] :selected").text();
	// 	var arr = new Array();
	// 	arr = result_name.split(",");
	// 	var result = arr[0] + "_" + Math.floor(Math.random()*999);

	// }

	//$(document).ready(function(){

	// });
	// $(document).ready(function(){
		// var app_id = $_GET['id'];
		// $.ajax({
		//     url: 'ajax/recruitment_session_timeout.php',
		//     // data: {app_id: app_id},
		//     success: function(data){
		//         alert(data);
		//     }
		// });
	// }
	// window.setInterval(function() {
	//     $.ajax({   
	//     	type: "PATCH",
	// 		url: "ajax/recruitment_session_timeout.php",
	// 		success: function(data) {
	// 			location.href = "recruitment.php";
	// 		}
	//     }); 
	// }, 10000); // 1000 = 1 second

	// setTimeout("location.href = 'recruitment.php';", 300000);

	$(document).ready(function(){
		$('#pos').on('change',function(){
			var posID = $(this).val();
			if(posID){
				$.ajax({
					type:'POST',
					url:'ajax/add_process_owner.php',
					data:'pos_id='+posID,
					success:function(html){
						$('#emp').html(html);
					}
				}); 
			}else{
				$('#emp').html('<option value="">Select employee first</option>');
			}
		});
	});
</script>

<script type="text/javascript">
	$(function () 
	{
		$('#resultTable').DataTable({
			"scrollX": true,
			"order": [[2, "asc"]],
			"columnDefs": [
				{ width: 170, targets: 1},
				{ width: 50, targets: 6},
				{ "targets": 0, "visible": false}
			],
			"fixedColumns": true,
			"ajax":{
				  "url":"ajax/process_owner.php?id=<?php echo $_GET['id']?>",
				  // "data":function(d){
					// d.employee_id=$("select[name='employee_id']").val();
					  // d.employee_id=$("select[name='employee_id']").val();
					  // d.user_type_id=$("select[name='user_type_id']").val();
					// }
				  }
		});
		// below is commented because the modal is not showing
		// getUsers(); 
	});
</script>

<?php
	Modal();
	makeFoot();
?>