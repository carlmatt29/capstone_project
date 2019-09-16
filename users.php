<?php
    require_once("support/config.php");
    
if (!isLoggedIn()) {
    toLogin();
    die();
}



    makeHead("Users");
?>

<?php
    require_once("template/header.php");
    require_once("template/sidebar.php");
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Users
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
                          <a href='frm_users.php' class='btn btn-warning'> Create New <span class='fa fa-plus'></span> </a>
                        </div>
                        <br/>
                        <div class='col-sm-12'>
                        
                    </div>
                        <table id='ResultTable' class='table table-bordered table-striped'>
                          <thead>
                            <tr>
                              <th class='text-center'>Employee Number</th>
                              <th class='text-center'>Employee Name</th>
                              <th class='text-center'>User Name</th>
                              <th class='text-center'>User Type</th>
                              <th class='text-center'>Email</th>
                              <th class='text-center'>Contact No.</th>
                              <th class='text-center'>Action</th>
                            </tr>
                          </thead>
                          <tbody>
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
<script type="text/javascript" src="support/get_uaid.js" ></script>
<script type="text/javascript">

  $(function () {
        data_table=$('#ResultTable').DataTable({
          "processing": true,
          "serverSide": true,
          "searching": true,
          "scrollX": true,
          dom: 'Bfrtip',
           buttons: [
            {
                extend:"excel",
                text:"<span class='fa fa-download'></span> Download as Excel File "
            }],
          "ajax":{
                  "url":"ajax/users.php",
                  "data":function(d){
                      d.employee_id=$("select[name='employee_id']").val();
                      d.user_type_id=$("select[name='user_type_id']").val();
                    }
                  },
          "oLanguage": { "sEmptyTable": "No Employees found." }
      });
      });
function filter_search() 
{
    data_table.ajax.reload();
}


</script>

<?php
  Modal();
    makeFoot();
?>