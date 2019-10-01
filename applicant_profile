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
    // $user_access_id='113';
    // $uid = get_user_access_id($id,$user_access_id);
    // if($uid<>1){
    //   redirect("index.php");
    // }
    


    $employee_list = $con->myQuery("SELECT code,CONCAT(last_name,', ',first_name,' ',IFNULL(middle_name,'')) as 'full_name' FROM employees WHERE is_deleted = 0 AND id != 1 AND id != 90 ORDER BY last_name");


    $data=$con->myQuery("SELECT e.id,e.code,CONCAT(e.last_name,', ',e.first_name,' ',IFNULL(e.middle_name,'')) as 'employee',e.private_email,e.contact_no FROM employees e WHERE e.is_deleted=0 AND e.is_terminated=0");
    makeHead("Employees");
?>

<?php
    require_once("template/header.php");
    require_once("template/sidebar.php");
?>

 <div class="content-wrapper">
    <section class="content-header">
        <h1>
            Employees
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class='col-md-12'>
                <?php Alert(); ?>
                <div class="box box-warning">
                    <div class="box-body">
              


                                <div class='col-ms-6 text-right'>
                                    <a href='personal_information.php' class='btn btn-info'> Create New <span class='fa fa-plus'></span> </a>
                                </div>
                                <br/>

                                <table id='ResultTable' class='table table-bordered table-striped'>
                                    <thead>
                                        <tr>
                                            <th class='text-center'>Employee Code</th>
                                            <th class='text-center'>Employee</th>
                                      <!--       <th class='text-center'>Job Title</th>
                                            <th class='text-center'>Department</th> -->
                                            <th class='text-center'>Email</th>
                                            <th class='text-center'>Contact No</th>
                                            <th class='text-center' style='min-width:150px'>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $data->fetch(PDO::FETCH_ASSOC)): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($row['code'])?></td>
                                                <td><?php echo htmlspecialchars($row['employee'])?></td>
                                         <!--        <td><?php echo htmlspecialchars($row['job_title'])?></td>
                                                <td><?php echo htmlspecialchars($row['department'])?></td>
 -->                                                <td><?php echo htmlspecialchars($row['private_email'])?></td>
                                                <td><?php echo htmlspecialchars($row['contact_no'])?></td>
                                                <td class='text-center's>
                                                    <a href='personal_information.php?id=<?php echo $row['id']?>' class='btn btn-success btn-sm'><span class='fa fa-pencil'></span></a>
                                                    <a href='delete.php?t=e&id=<?php echo $row['id']?>' title='Delete Employee' onclick="return confirm('This record will be deleted.')" class='btn btn-danger btn-sm'><span class='fa fa-trash'></span></a>
                                                    <a href='employee_details_report.php?employees_id=<?php echo $row['id']?>' class='btn btn-info btn-sm'><span class='fa fa-download'></span></a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
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
    function getUsers() 
    {
        $(".cbo-employees-id").val("");
        $(".cbo-employees-id").trigger("change");   
        $(".cbo-employees-id").select2(
        {
            placeholder:"Select Employee",
            multiple:true,
            ajax: 
            {
                url: "./ajax/cbo_dep_employees.php?dep_id="+$("#department_id").val(),
                dataType: "json",
                type: "GET",
                data: function (params) {
                    var queryParameters = {
                        term: params.term
                    }
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            // console.log(item);
                            return {
                                text: item.description,
                                id: item.id
                            }
                        })
                    };
                }
            },
            allowClear:$(this).data("allow-clear")
        });
    }
  
    $(function () 
    {
        $('#ResultTable').DataTable(
        {
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [
            {
                extend:"excel",
                text:"<span class='fa fa-download'></span> Download as Excel File "
            }],
        });
        getUsers();
    });
    function myFunction() 
    {
        document.getElementById("pgl").selected = "true";
        document.getElementById("dl").selected = "true";
        document.getElementById("el").selected = "true";
    }
</script>

<script type="text/javascript" src="ajax/employee_filter.js"></script>


<?php
    Modal();
    makeFoot();
?>