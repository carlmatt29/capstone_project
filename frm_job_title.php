<?php
	require_once("support/config.php");
	if(!isLoggedIn()){
		toLogin();
		die();
	}

    if(!AllowUser(array(2,4))){
        redirect("index.php");
    }

	$data="";
	if(!empty($_GET['id'])){
  		$data=$con->myQuery("SELECT id,code as name,location,minimum_salary,maximum_salary,description,company_name,is_available,employee_need,employee_process_id FROM job_title WHERE id=? LIMIT 1",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
  		if(empty($data)){
  			Modal("Invalid Record Selected");
  			redirect("job_title.php");
  			die;
  		}
	}


	$emp_id = explode(',',$data['employee_process_id']);
	$ctr=0;
	$emp_size = sizeOf($emp_id);

	$employees=$con->myQuery("SELECT id,CONCAT(last_name,', ',first_name,' ',middle_name,' (',code,')') as employee_name FROM employees WHERE is_deleted=0 AND is_terminated=0 ORDER BY last_name")->fetchAll(PDO::FETCH_ASSOC);
	$hired=$con->myQuery("SELECT id,CONCAT(last_name,', ',first_name,' ',middle_name) as employee_name,work_contact_no,work_email,address1 FROM employees WHERE is_deleted=0 AND is_terminated=0 AND job_title_id=? ORDER BY last_name",array($_GET['id'])); // ADDED By Marckus : 4/25/2019

	makeHead("Job Title Form");
?>

<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
    color:black;

    }
</style>

<?php
	require_once("template/header.php");
	require_once("template/sidebar.php");
?>
 	<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Job List Form
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Main row -->
          <div class="row">

            <div class='col-md-10 col-md-offset-1'>
				<?php
					Alert();
				?>
              <div class="box box-warning">
                <div class="box-body">
                  <div class="row">
                	<div class='col-md-12'>
		              	<form class='form-horizontal' action='save_job_title.php' method="POST">
		              		<input type='hidden' name='id' value='<?php echo !empty($data)?$data['id']:''; ?>'>



		              		<div class="form-group">
		                      <label for="name" class="col-sm-2 control-label">Job Title *</label>
		                      <div class="col-sm-9">
		                        <input type="text" class="form-control" id="name" placeholder="Job Title" name='name' value='<?php echo !empty($data)?htmlspecialchars($data['name']):''; ?>' required>
		                      </div>
		                  </div>

                      <div class="form-group">
                          <label for="name" class="col-sm-2 control-label">Location *</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="location" placeholder="Location" name='location' value='<?php echo !empty($data)?htmlspecialchars($data['location']):''; ?>' required>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="name" class="col-sm-2 control-label">Minimum Salary *</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="minimum_salary" placeholder="Minimum Salary" name='minimum_salary' value='<?php echo !empty($data)?htmlspecialchars($data['minimum_salary']):''; ?>' required>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="name" class="col-sm-2 control-label">Maximum Salary *</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="maximum_salary" placeholder="Maximum Salary" name='maximum_salary' value='<?php echo !empty($data)?htmlspecialchars($data['maximum_salary']):''; ?>' required>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="name" class="col-sm-2 control-label">Description *</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="description" placeholder="Description" name='description' value='<?php echo !empty($data)?htmlspecialchars($data['description']):''; ?>' required>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="name" class="col-sm-2 control-label">Company Name *</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="company_name" placeholder="Company Name" name='company_name' value='<?php echo !empty($data)?htmlspecialchars($data['company_name']):''; ?>' required>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="name" class="col-sm-2 control-label"></label>
                          <div class="col-sm-9">
                            <input type="checkbox"  placeholder="Available" name='is_available' value="1" <?php if($data['is_available']==1){echo "checked";} ?> >For Hiring
                          </div>
                      </div>


                     <!-- <div class="form-group">
                          <label for="name" class="col-sm-2 control-label">Interviewer *</label>
                          <div class="col-sm-9">
                            <input type="hidden" class="emp_pos" value="<?php //echo $data['employee_process_id']; ?>"/>
                            <select class='form-control employees_id cbo' id='employees_id' name="emp_id[]" data-placeholder="Search Interviewer" style='width:100%;' multiple="multiple" >
                               <?php // echo makeOptions($employees); ?>
                            </select>
                          </div>
                      </div> -->

                      <div class="form-group">
                          <label for="name" class="col-sm-2 control-label">Total Employee Need *</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" id="employee_need" placeholder="Enter Total Employee" name='employee_need' value='<?php echo !empty($data)?htmlspecialchars($data['employee_need']):''; ?>' required>
                          </div>
                      </div>


		                    <div class="form-group">
		                      <div class="col-sm-9 col-md-offset-2 text-center">
		                      	<a href='job_title.php' class='btn btn-default' onclick="return confirm('<?php echo empty($data)?"Cancel creation of new job title?":"cancel modification of job title?" ?>')">Cancel</a>
		                        <button type='submit' class='btn btn-warning'>Save </button>
		                      </div>
		                    </div>
		                </form>
                	</div>
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->

          <div class="row">
            <div class='col-md-10 col-md-offset-1'>
              <div class="box box-warning">
                <div class="box-body">
                  <div class="row">
                	<div class='col-md-12'>
                	    <h4>List of employees using job title: <?php echo !empty($data)?htmlspecialchars($data['name']):''; ?></h4>
                	    <br>
		              	<table id='ResultTable' class='table table-bordered table-striped'>
                          <thead>
                            <tr>
                              <th class='text-center'>Name</th>
                              <th class='text-center'>Contact</th>
                              <th class='text-center'>Email</th>
                              <th class='text-center'>Address</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              while($row = $hired->fetch(PDO::FETCH_ASSOC)):
                            ?>
                              <tr>
                                <td><?php echo htmlspecialchars($row['employee_name'])?></td>
                                <td><?php echo htmlspecialchars($row['work_contact_no'])?></td>
                                <td><?php echo htmlspecialchars($row['work_email'])?></td>
                                <td><?php echo htmlspecialchars($row['address1'])?></td>
                              </tr>
                            <?php
                              endwhile;
                            ?>
                          </tbody>
                        </table>
                	</div>
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
  </div>

<script type="text/javascript">
  $(function () {
        $('#ResultTable').DataTable();
      });


    e = $(".emp_pos").val();

    if (e != ''){
      var arr = new Array();
      var e=$(".emp_pos").val();
      arr = e.split(",");
      $("#employees_id").val(arr).change();
    }

</script>

<?php
	makeFoot();
?>
