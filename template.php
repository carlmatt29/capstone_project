<?php
require_once("support/config.php");
	if(!isLoggedIn()){
		toLogin();
		die();
	}
        if(AllowUser(array(4))){
        redirect("recruitment.php");
    }

$data=$con->myQuery("SELECT A.id,A.code,A.location,A.minimum_salary,A.maximum_salary,A.description,A.is_available,A.company_name,A.employee_process_id,A.employee_need,(select concat(first_name,' ',last_name) from employees where id in (A.employee_process_id)) as interviewers,
                        (select COUNT(*) from employees where job_title_id in (A.id) AND is_deleted =0) as employee_count
                        FROM job_title A
                        LEFT JOIN employees
                        ON A.id = employees.job_title_id
                        WHERE A.is_deleted= 0 AND A.is_available = 1 GROUP BY A.id"); //
makeHead("Index");
?>

<?php
	require_once("template/header.php");
	require_once("template/sidebar.php");
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Job Open in JMS Staffing
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Main row -->
          <div class="row">

            <div class='col-md-12'>
             <!-- <?php
                //Alert();
              ?> -->
              <div class="box box-warning">
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-12">
                        <br/>
                        <table id='ResultTable' class='table table-bordered table-striped'>
                          <thead>
                            <tr>
                              <th class='text-center'>Job Title</th>
                              <th class='text-center'>Employee Need/s</th>
                              <th class='text-center'>Location</th>
                              <th class='text-center'>Salary</th>
                              <th class='text-center'>Description</th>
                              <th class='text-center'>Company Name</th>
                              <!-- <th class='text-center'>Hiring</th> -->
                              <!--<th class="text-center">Interviewer</th>-->
                              <th class='text-center'>Action</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              while($row = $data->fetch(PDO::FETCH_ASSOC)):
                            ?>
                              <tr>
                                <center><td><?php echo htmlspecialchars($row['code'])?></td></center>
                                <td><center><?php echo htmlspecialchars($row['employee_need'])?></center></td>
                                <td><center><?php echo htmlspecialchars($row['location'])?></center></td>
                                <td><center><?php echo htmlspecialchars($row['minimum_salary'].'-'.$row['maximum_salary'])?></center></td>
                                <center><td><?php echo htmlspecialchars($row['description'])?></td></center>
                                <center><td><?php echo htmlspecialchars($row['company_name'])?></td></center>

                                <td class='text-center'>
                                  <a href='application_form.php?id=<?php echo $row['id']?>' class='btn btn-warning btn-sm'><span class='fa fa-pencil'>Apply Now</span></a>
                                </td>


                              </tr>
                            <?php
                              endwhile;
                            ?>
                          </tbody>
                        </table>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->

          </div>
      </div>
  </section>
</div>
<script type="text/javascript">
  $(function () {
        $('#ResultTable').DataTable();
      });
</script>

<?php
  Modal();
    makeFoot();
?>
