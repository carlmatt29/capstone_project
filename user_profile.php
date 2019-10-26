<?php
  require_once("support/config.php");
  if(!isLoggedIn()){
    toLogin();
    die();
  }

  

    $inputs['employees_id']=$_SESSION[WEBAPP]['user']['employee_id'];

#EMPLOYEES
      $query="SELECT
                e.id,
                e.code as code, 
                e.first_name as fname,
                e.middle_name as mname,
                e.last_name as lname,
                e.nationality,
                e.gender,
                e.birthday,
                e.civil_status,
                IFNULL(e.sss_no,'-') AS sss_no, 
                IFNULL(e.tin,'-') AS tin, 
                IFNULL(e.philhealth,'-') AS philhealth, 
                IFNULL(e.pagibig,'-') AS pagibig,
                (SELECT description FROM job_title WHERE id=e.job_title_id AND is_deleted=0) as job_title,
                CONCAT(e.address1,' ',e.address2,' ',e.city,' ',e.province,' ',e.country,' ',e.postal_code) as full_address,
                e.contact_no, 
                IFNULL(e.work_contact_no,'-') as work_contact_no, 
                e.private_email, 
                IFNULL(e.work_email,'-') AS work_email, 
                e.joined_date,
                DATE_ADD(joined_date, INTERVAL 6 MONTH) as expected_regularization_date
                
              FROM employees e
              WHERE e.id=:employees_id";
      $data=$con->myQuery($query,$inputs)->fetch(PDO::FETCH_ASSOC); 

#EMPLOYEE_EDUCATION
      $employee_education=$con->myQuery("SELECT
                                          ee.id,
                                          ee.employee_id,
                                          (SELECT description FROM education_level WHERE id=ee.educ_level_id) AS education_level,
                                          ee.institute,
                                          ee.course,
                                          ee.date_start,
                                          ee.date_end
                                        FROM employees_education ee
                                        WHERE ee.employee_id=:employees_id",$inputs)->fetchAll(PDo::FETCH_ASSOC);
      $emp_educ_count=count($employee_education);

      
  //echo $emp_history_count;
  //die();

   $head=array("Employee Code:" => htmlspecialchars($data['code']),          
              "First Name:" => htmlspecialchars($data['fname']),             
              "Middle Name:" => htmlspecialchars($data['mname']),
              "Last Name:" => htmlspecialchars($data['lname']),
              "Nationality:" => htmlspecialchars($data['nationality']),            
              "Gender:" => htmlspecialchars($data['gender']),
              "Birthday:" => htmlspecialchars($data['birthday']),
              "Civil Status:" => htmlspecialchars($data['civil_status']),
              "SSS Number:" => htmlspecialchars($data['sss_no']),
              "TIN:" => htmlspecialchars($data['tin']),                    
              "Philhealth Number:" => htmlspecialchars($data['philhealth']),
              "PAGIBIG Number:" => $data['pagibig'],
              "Job Title:" => $data['job_title'],
              "Full Address:" => $data['full_address'], 
              "Contact Number:" => $data['contact_no'],
              "Work Contact Number:" => $data['work_contact_no'],
              "Email Address:" => $data['private_email'],
              "Work Email Address:" => $data['work_email'],
              "Joined Date:" => $data['joined_date'],
              "Expected Regularization Date:"=>$data['expected_regularization_date'],
         
              );
  $headcount=count($head);  
//var_dump($headcount);
//die();
  


  makeHead("Employee Details ");
?>

<?php
  require_once("template/header.php");
  require_once("template/sidebar.php");
?>
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Employee Details 
          </h1>
        </section>

        <!-- Main content -->
      <section class="content">

          <!-- Main row -->
          <div class="row">

            <div class='col-md-12'>
        <?php
          Alert();
        ?>

              <div class="box box-solid">
                <div class="box-body">
                  <div class="row">
                  <div class='col-md-12'>
                    <form action="download_employee_details.php" method="post" name="export_excel" autocomplete="off">
                      <div class="control-group">
                        <div class="controls">
                          <input type='hidden' name='employees_id' value=<?php echo $inputs['employees_id']; ?>>

                          <button type="submit" id="export" name="export" class="btn btn-primary button-loading" data-loading-text="Loading...">Download to Excel File</button>

                        </div>
                      </div>
                    </form> 
                    <br>
                    <table class='table table-bordered table-striped' id='RTable'>
                      
                        <th class='text-center' colspan='5'>PERSONAL INFORMATION</th>
                        <!--    <td></td><td></td><td></td><td></td> -->      
                        <?php
                          foreach ($head as $key => $value):
                        ?>
                          <tr>
                            <th style="width: 20%"><?php echo $key; ?></th>
                            <td style="width: 20%"><?php echo $value; ?></td>
                            <td style="width: 20%"></td>
                            <td style="width: 20%"></td>
                            <td style="width: 20%"></td>
                          </tr>
                        <?php
                          endforeach;
                        ?>

        <!-- EMPLOYEE EDUCATION -->   
                                 
                          <?php
                            if($emp_educ_count <> 0 || $emp_educ_count <> NULL):
                          ?>
                            <tr><td colspan='5'></td></tr>
                              <th class='text-center' colspan='5'>EDUCATION BACKGROUND</th>
                        <!--    <td></td><td></td><td></td><td></td> -->  
                              <tr>
                                <th class='text-center'>Education Level</th>
                                <th class='text-center'>Institute</th>
                                <th class='text-center'>Course</th>
                                <th class='text-center'>Date Start</th>
                                <th class='text-center'>Date End</th>
                              </tr>
                                <?php
                                  foreach ($employee_education as $row):
                                ?>
                                  <tr>
                                    <td><?php echo htmlspecialchars($row['education_level']) ?></td>
                                    <td><?php echo htmlspecialchars($row['institute']) ?></td>
                                    <td><?php echo htmlspecialchars($row['course']) ?></td>
                                    <td><?php echo htmlspecialchars($row['date_start']) ?></td>
                                    <td><?php echo htmlspecialchars($row['date_end']) ?></td>
                                  </tr>
                                <?php
                                  endforeach;
                                  endif;
                                ?>
          <!-- EMPLOYMENT HISTORY -->      
                              
                          <?php
                            if($emp_history_count <> 0 || $emp_history_count <> NULL):
                          ?>
                          <tr><td colspan='5'></td></tr>
                              <th class='text-center' colspan='5'>EMPLOYMENT HISTORY</th>
                        <!--    <td></td><td></td><td></td><td></td> -->  
                              <tr>
                                <th class='text-center'>Date Start</th>
                                <th class='text-center'>Date End</th>
                                <th class='text-center'>Company</th>
                                <th class='text-center'>Department</th>
                                <th class='text-center'>Position</th>
                              </tr>
                                <?php
                                  foreach ($emp_history as $row):
                                ?>
                                  <tr>
                                    <td><?php echo htmlspecialchars($row['date_start']) ?></td>
                                    <td><?php echo htmlspecialchars($row['date_end']) ?></td>
                                    <td><?php echo htmlspecialchars($row['company']) ?></td>
                                    <td><?php echo htmlspecialchars($row['department']) ?></td>
                                    <td><?php echo htmlspecialchars($row['position']) ?></td>
                                  </tr>
                                <?php
                                  endforeach;
                              endif;
                            ?>

        <!-- EMPLOYEE TRAINING --> 
                                 
                          <?php
                            if($emp_training_count <> 0 || $emp_training_count <> NULL):
                          ?>
                          <tr><td colspan='5'></td></tr> 
                             <th class='text-center' colspan='5'>TRAININGS</th>
                        <!--    <td></td><td></td><td></td><td></td> --> 
                              <tr>
                                <th class='text-center'>Training Name</th>
                                <th class='text-center'>Location</th>
                                <th class='text-center'>Topic</th>
                                <th class='text-center'>Training Date</th>
                                <th></th>
                              </tr>
                                <?php
                                  foreach ($emp_training as $row):
                                ?>
                                  <tr>
                                    <td><?php echo htmlspecialchars($row['name']) ?></td>
                                    <td><?php echo htmlspecialchars($row['location']) ?></td>
                                    <td><?php echo htmlspecialchars($row['topic']) ?></td>
                                    <td><?php echo htmlspecialchars($row['training_date']) ?></td>
                                    <td></td>
                                  </tr>
                                <?php
                                  endforeach;
                              endif;
                            ?>
              <!-- EMPLOYEE CERTIFICATION -->   
                                 
                          <?php
                            if($emp_cert_count <> 0 || $emp_cert_count <> NULL):
                          ?>
                          <tr><td colspan='5'></td></tr>
                              <th class='text-center' colspan='5'>CERTIFICATIONS</th>
                        <!--    <td></td><td></td><td></td><td></td> -->
                              <tr>
                                <th class='text-center'>Certifications</th>
                                <th class='text-center'>Institute</th>
                                <th class='text-center'>Date Given</th>
                                <th></th><th></th>
                              </tr>
                              <?php
                                foreach ($emp_cert as $row):
                              ?>
                                <tr>
                                  <td><?php echo htmlspecialchars($row['certification']) ?></td>
                                  <td><?php echo htmlspecialchars($row['institute']) ?></td>
                                  <td><?php echo htmlspecialchars($row['date_given']) ?></td>
                                  <td></td><td></td>
                                </tr>
                              <?php
                                endforeach;
                              endif;
                            ?>  

              <!-- EMPLOYEE LEAVES -->          
                          
                          <?php
                            if($emp_leave_count <> 0 || $emp_leave_count <> NULL):
                          ?>
                          <tr><td colspan='5'></td></tr>
                              <th class='text-center' colspan='5'>LEAVES</th>
                        <!--    <td></td><td></td><td></td><td></td> -->
                              <tr>
                                <th class='text-center'>Leave Type</th>
                                <th class='text-center'>Available Leave</th>
                                <th></th><th></th><th></th>
                              </tr>
                              <?php
                                foreach ($emp_leave as $row):
                              ?>
                                <tr>
                                  <td><?php echo htmlspecialchars($row['leave_type']) ?></td>
                                  <td><?php echo htmlspecialchars($row['balance_per_year']) ?></td>
                                  <td></td><td></td><td></td>
                                </tr>
                              <?php
                                endforeach;
                              endif;
                            ?>

                    </table>

                  </div>
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
  </div>
<?php
  makeFoot();
?>