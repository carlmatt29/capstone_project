<?php
	require_once("support/config.php");
	if (!isLoggedIn()) {
		toLogin();
		die();
	}

	$id = $_SESSION[WEBAPP]['user']['id'];
	$process_owner_id = $_GET['id'];

	$interview = $con->myQuery("SELECT i.id AS id, i.applicant_id, CONCAT(e.last_name, ', ',e.first_name) AS process_owner, i.interview_date, i.interview_status, i.remarks, i.status_date_change FROM tbl_interview i INNER JOIN tbl_applicant a ON i.applicant_id = a.id INNER JOIN tbl_applicant_profile ap ON a.applicant_id = ap.id INNER JOIN employees e ON i.process_owner_id = e.id WHERE i.id = ? ORDER BY i.interview_date ASC", array($_GET['id']))->fetch(PDO::FETCH_ASSOC);

	$i = $con->myQuery("SELECT i.id AS id, i.applicant_id, CONCAT(e.last_name, ', ',e.first_name) AS process_owner, i.interview_date, i.interview_status, i.remarks, i.status_date_change FROM tbl_interview i INNER JOIN tbl_applicant a ON i.applicant_id = a.id INNER JOIN tbl_applicant_profile ap ON a.applicant_id = ap.id INNER JOIN employees e ON i.process_owner_id = e.id WHERE i.id = ? AND i.interview_date != 0000-00-00 ORDER BY i.interview_date ASC", array($_GET['id']));

	$count_interview = $i->rowCount();

	$result_status = $con->myQuery("SELECT id, description FROM tbl_application_status WHERE status_name = 'passed' OR status_name = 'failed'")->fetchAll(PDO::FETCH_ASSOC);
	$result_id = $con->myQuery("SELECT i.interview_status, status.description FROM tbl_interview i INNER JOIN tbl_application_status status ON i.interview_status = status.id WHERE i.id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);

	$process = $con->myQuery("SELECT i.id AS id, i.applicant_id, i.process_owner_id, CONCAT(e.last_name, ', ',e.first_name) AS process_owner, i.interview_date, i.interview_status, stat.description AS status, i.remarks, i.status_date_change
		FROM tbl_interview i
		INNER JOIN tbl_applicant a ON i.applicant_id = a.id
		INNER JOIN tbl_applicant_profile ap ON a.applicant_id = ap.id
		INNER JOIN employees e ON i.process_owner_id = e.id
		LEFT JOIN tbl_application_status stat ON i.interview_status = stat.id
		WHERE i.id = ?", array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
	
	makeHead("Edit Process Owner");

	$checker = $con->myQuery("SELECT a.assessed_by FROM tbl_applicant a INNER JOIN tbl_interview i ON i.applicant_id = a.id WHERE i.id = ?", array($_GET['id']))->fetch(PDO::FETCH_ASSOC);

	// var_dump($checker['assessed_by']);

	if ($checker['assessed_by'] != $id) {
		// redirect('view_applicant.php?id='.urlencode($interview['applicant_id']));
		header("Refresh:0; url=view_applicant.php?id=".urlencode($interview['applicant_id']));
	}
	// die();


	if ($process['interview_status'] == "7") {		
		redirect('view_applicant.php?id='.urlencode($interview['applicant_id']));
		// redirect('view_applicant.php?id='.urlencode($interview['applicant_id']).'&status='.'cancelled');
	}
?>

<?php
	require_once("template/header.php");
	require_once("template/sidebar.php");
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Edit Process Owner</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="box box-warning">
					<div class="box-body">
						<form action="ajax/edit_process_owner.php?id=<?php echo $_GET['id']?>&applicant_id=<?php echo $interview['applicant_id']?>" method="POST">
							<div class="row form-horizontal">
								<div class="col-md-12">
									<div class="form-group">
										<label style="text-align: left;" class="control-label col-md-4">Process Owner</label>
										<div class="col-md-8">
											<input type="text" name="process_owner" value='<?php echo !empty($interview)?htmlspecialchars($interview['process_owner']):''; ?>' disabled>
										</div>
									</div>	
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label style="text-align: left;" class="control-label col-md-4">Interview Date</label>
										<div class="col-md-8">
											<input type="text" <?php if (!empty($interview['interview_date'])) {?> class="form-control" <?php } else {?> class="form-control date_time_picker" <?php }?> <?php if($count_interview>0){ echo 'disabled';} ?> name="interview_date" id="interview_date" value='<?php echo !empty($interview)?htmlspecialchars($interview['interview_date']):'';?>' >
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label style="text-align: left;" class="control-label col-md-4">Interview Result:</label>
										<div class="col-md-8">
											<select <?php if(empty($interview['interview_date'])) { echo 'disabled'; } else if($interview['interview_status']) { echo 'disabled'; } ?> class='form-control cbo' name='interview_status' onchange='set_result()' id='interview_status' data-placeholder="Select Interview Result" data-allow-clear="true" <?php echo !(empty($_GET))?"data-selected='".$result_id['interview_status']."'":NULL ?> style='width:100%'>

												<?php echo makeOptions($result_status, "Select Interview Result") ?>
											</select>
										</div>
									</div>
									
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label style="text-align: left;" class="control-label col-md-4">Not Available for Interview</label>
										<div class="col-md-8">
											<input type="checkbox" <?php if($count_interview>0){ echo 'disabled';} ?> id="interview_not_available" name="interview_not_available" />
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label style="text-align: left;" class="control-label col-md-4">Remarks (type NA if Not Applicable)</label>
										<div class="col-md-8">
											<textarea name="remarks" rows="5" style="width: 100%" required><?php echo htmlspecialchars($interview['remarks']); ?></textarea>
										</div>
									</div>
								</div>

								<div class="col-md-12 text-right">
									<button class="btn btn-primary" type="submit">Update</button>
									<!-- <button class="btn btn-primary" value='<?php echo !empty($interview)?htmlspecialchars($interview['interview_date']):'';?>'>Submit Initial Assessment</button> -->
									<!-- <button class="btn btn-primary" <?php if($count_assessed_by>0) {?> disabled="disabled" <?php } ?>>Submit Initial Assessment</button> -->
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
	var checker = document.getElementById('interview_not_available');
	var date = document.getElementById('interview_date');
	checker.onchange = function() {
		date.disabled = !!this.checked;
		date.value = "";
	};

	$(document).ready(function(){
		$("form").submit(function(){
			if (date.value == '') {
				if (checker.checked) {
					// alert('checked');
					// return false;
				} else {
					date.style.borderColor = "red";
					return false;
				}
			} else {
				date.style.borderColor = "";
			}
		});
	});
</script>

<?php
	Modal();
	makeFoot();
?>