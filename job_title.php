<?php
    require_once("support/config.php");
    if(!isLoggedIn()){
     toLogin();
     die();
    }

    // if(!AllowUser(array(1,4))){
    //     redirect("index.php");
    // }

    // $id = $_SESSION[WEBAPP]['user']['id'];
    // $user_access_id='52';
    // $uid = get_user_access_id($id,$user_access_id);
    // if($uid<>1){
    //   redirect("index.php");
    // }
        
  $data=$con->myQuery("SELECT A.id,A.code,A.description,A.is_available,A.employee_process_id,A.employee_need,(select concat(first_name,' ',last_name) from employees where id in (A.employee_process_id)) as interviewers, 
                        (select COUNT(*) from employees where job_title_id in (A.id) AND is_deleted =0) as employee_count
	                    FROM job_title A 
	                    LEFT JOIN employees 
                        ON A.id = employees.job_title_id
                        WHERE A.is_deleted= 0 GROUP BY A.id"); // Added By Marckus : 4/25/2019
                        
  //$data=$con->myQuery("SELECT id,code,description,is_available,employee_process_id,(select concat(first_name,' ',last_name) from employees where id in (A.employee_process_id)) as interviewers FROM job_title A WHERE is_deleted=0"); 
  //$employee =$on->myQuery("SELECT id,CONCAT(last_name,', ',first_name,' ',middle_name,' (',code,')') as employee_name FROM employees WHERE is_deleted=0 AND is_terminated=0 ORDER BY last_name")->fetchAll();
    makeHead("Job Title");
?>

<?php
    require_once("template/header.php");
    require_once("template/sidebar.php");
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Job Title
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
              <div class="box box-warning">
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-12">
                        <div class='col-ms-12 text-right'>
                          <a href='frm_job_title.php' class='btn btn-warning'> Create New <span class='fa fa-plus'></span> </a>
                        </div>
                        <br/>
                        <table id='ResultTable' class='table table-bordered table-striped'>
                          <thead>
                            <tr>
                              <th class='text-center'>Job Title (Assigned Employees Count)</th>
                              <th class='text-center'>Description</th>
                              <th class='text-center'>Hiring</th>
                              <!--<th class="text-center">Interviewer</th>-->
                              <th class='text-center'>Action</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              while($row = $data->fetch(PDO::FETCH_ASSOC)):
                            ?>
                              <tr>
                                <td><?php echo htmlspecialchars($row['code'].' ('.$row['employee_count'].'/'.$row['employee_need'].')')?></td>
                                <td><?php echo htmlspecialchars($row['description'])?></td>
                                <td><?php if($row['is_available']==1){
                                    echo "Yes";
                                }else{
                                   echo "No";
                                }  ?></td>
                                <!--<td>
                                    <?php echo $row['interviewers']; ?> 
                                </td>-->
                                <td class='text-center'>
                                  <a href='frm_job_title.php?id=<?php echo $row['id']?>' class='btn btn-success btn-sm'><span class='fa fa-pencil'></span></a>
                                  <a href='delete.php?t=jt&id=<?php echo $row['id']?>' onclick="return confirm('This record will be deleted.')" class='btn btn-danger btn-sm'><span class='fa fa-trash'></span></a>
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
          </div><!-- /.row -->
        </section><!-- /.content -->
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