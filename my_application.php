<?php
  require_once("support/config.php");
   if(!isLoggedIn()){
    toLogin();
    die();
   }





  makeHead("My Application");
?>

<?php
  require_once("template/header.php");
  require_once("template/sidebar.php");
?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
            <!-- Main row -->
        <!-- Main content -->
       <div class="row">
            <div class='col-md-12'>
        <section class="content-header">
          <h1>
            My Application
          </h1>
        </section>

                <div class="box box-warning">
                    <div class="box-body">
                        <div class="row">
                          <?php Alert();  ?>
                          <div class="col-sm-12">
                                <div class='col-ms-12 text-right'>
                                  <!-- <a href='frm_schedule_swap.php' class='btn btn-warning'><span class='fa fa-plus'></span>  File New Swap Request </a> -->
                                </div>

                            <br/>
                            <br/>

                            <div class="col-sm-12">
                                <table id='ResultTable' class='table table-bordered table-striped'>
                                    <thead>
                                        <tr>
                                            <th class='text-center'>Application Code</th>
                                            <th class='text-center'>Applicant Name</th>
                                            <th class='text-center'>Job Title</th>
                                            <th class='text-center'>Job Description</th>
                                            <th class='text-center date-td'>Date Filed</th>
                                            <th class='text-center'>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody >

                                    </tbody>
                                </table>
                            </div>


                        </div><!-- /.row -->
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div><!-- /.row -->
      </div>
    </section><!-- /.content -->
</div>





<?php
    $request_type="Swap";
    $redirect_page="schedule_swap_request.php";
    require_once("include/modal_query.php");
    require_once("include/modal_query_logs.php");
?>

<script type="text/javascript">
  function swapid(){
      sadest = $('#available_shift').val();
      console.log(sadest);
    }
  function effective(){
      effect = $('#effect_date option:selected').val();
      // alert(effect);
      $.ajax({
        type:"POST",
        url:"test.php",
        data:{id:effect},
        success:function(response){
          $('#my_id').val(response);

          console.log(response);
        }
      });

    }
 $(document).ready(function(){
    $("#effect_date").on('change',function(){
      var sample=$("#effect_date").val();
      $.ajax({
        type:"POST",
        url:"ajax/available_shift.php",
        data:{sample:sample},
        success:function(response){
          $('#available_shift').empty();
          $('#available_shift').append(response);
        }
      });

    });
  });
var dttable="";

//added start
$(document).ready(function ()
{






    dttable=$('#ResultTable').DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "searching": false,
        "ajax":
        {
            "url":"ajax/my_application.php",
            "data":function(d)
            {
                d.date_start=$("input[name='date_start']").val();
                // d.half_day_mode=$("select[name='half_day_mode']").val();
                d.date_end=$("input[name='date_end']").val();
                d.dept_id=$("select[name='dept_id']").val();
                d.status=$("select[name='status']").val();
            }
        },
        "columnDefs": [{ "orderable": false, "targets": -1 }],
        "order": [[ 2, "desc" ]]
    });
});

      function filter_search()
      {
              dttable.ajax.reload();
              //console.log(dttable);
      }

      // function pass(btn){
      //   $("input[name='eid']").val($(btn).data("id"));
      // }

      $("#clear_btn").on('click',function(){
        dttable.ajax.reload();
    });
</script>



<?php
  Modal();
  makeFoot();
?>
