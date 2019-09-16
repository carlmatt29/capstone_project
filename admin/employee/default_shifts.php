<?php
  $data=$con->myQuery("SELECT ecd.id,ecd.emp_code,ecd.comde_code,ecd.emp_comde_amt,ecd.emp_comde_start_date,ecd.emp_comde_end_date,ecd.emp_deduct_type,cd.comde_desc FROM employee_company_deductions ecd JOIN company_deductions cd ON cd.comde_code=ecd.comde_code WHERE ecd.is_deleted=0 AND ecd.emp_id=?", array($employee['id']))->fetchAll(PDO::FETCH_ASSOC);
  $data=array();
if (!empty($_GET['ec_id'])) {
    $record=$con->myQuery("SELECT id,emp_code,comde_code,emp_comde_amt as amount,emp_comde_start_date as start_date,emp_comde_end_date as end_date,emp_deduct_type FROM employee_company_deductions WHERE emp_id=? AND id=? LIMIT 1", array($employee['id'],$_GET['ec_id']))->fetch(PDO::FETCH_ASSOC);
}
  $company_deductions=$con->myQuery("SELECT comde_code as id,comde_desc FROM company_deductions WHERE is_deleted=0 AND is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
  $deduction_types=$con->myQuery("SELECT id,name FROM deduction_types WHERE is_deleted=0 AND is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
  $tab=13;

  $Date=$con->myQuery("SELECT start_date from employees_default_shifts where employee_id=?", array($employee['id']))->fetchAll(PDO::FETCH_ASSOC);

  $working_Days=$con->myQuery("SELECT working_days from employees_default_shifts where employee_id=?", array($employee['id']))->fetch(PDO::FETCH_ASSOC);

  $new = explode('|', $working_Days['working_days']);
  // $newe = implode('M',$new);

  // echo "<pre>";
  // print_r($new);
  // echo "</pre>";
  // die();
?>
<?php
  $has_error=false;
if (!empty($_SESSION[WEBAPP]['Alert']) && $_SESSION[WEBAPP]['Alert']['Type']=="danger") {
    $has_error=true;
}
  Alert();
?>
<div class='text-right'>
<button class='btn btn-warning' data-toggle="collapse" data-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm">Toggle Form </button>
</div>
<br/>
<div id='collapseForm' class='collapse'>
<form class='form-horizontal' action='save_employee_default_shift.php' method="POST">
    <input type='hidden' name='employee_id' value='<?php echo !empty($employee)?$employee['id']:''; ?>'>
<div class = "box box-warning">
<div class = "box-body">
  <div class="container" id="newLayout">
                            <div class="row">
                                <div class="col-md-2">                                        
                                    <label>Start Date *:</label>
                                </div>
                                <div class="col-md-6">                                        
                                    <input type="text" class="form-control date_picker" name="date_target" value='<?php echo !empty($record)?htmlspecialchars(DisplayDate($record['start_date'])):''; ?>' required>
                                </div>
                            </div>
                            <br>
                            <div>
                                <div class="row">
                                    <div class="col-md-2">&nbsp;</div>
                                    <div class="col-md-2">Time In *</div>
                                    <div class="col-md-2">Time Out *</div>
                                    <div class="col-md-2">Late Start *</div>  
                                    <div class="col-md-2">Grace Period</div>
                                </div>
                                
                                    <div class="row">
                                        <div class="col-md-2">
                                            <input type="checkbox"  style="margin-left: 50px;" name="Monday[]" value="M"> Monday
                                        </div>
                                        <div class="timeOptionMonday" style="display: none;">                                                
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker ' name="Monday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' name="Monday[]" readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker' >
                                                    <input type='text'  class='form-control time_picker' name="Monday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group '>
                                                    <input type='text'  class='form-control numeric' name="Monday[]"  title="Grace Period (Minutes)" value="" maxlength="2">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <td><input type="checkbox"  style="margin-left: 50px;"  name="Tuesday[]" value="T"> Tuesday</td> 
                                        </div>
                                        <div class="timeOptionTuesday" style="display: none;">                                                
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' name="Tuesday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' name="Tuesday[]" readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker' >
                                                    <input type='text'  class='form-control time_picker' name="Tuesday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group '>
                                                    <input type='text'  class='form-control numeric' name="Tuesday[]"  title="Grace Period (Minutes)" value="" maxlength="2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <td><input type="checkbox"  style="margin-left: 50px;" name="Wednesday[]"  value="W"> Wednesday</td>                                                
                                        </div>
                                        <div class="timeOptionWednesday" style="display: none;">                                                
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' name="Wednesday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' name="Wednesday[]" readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker' >
                                                    <input type='text' class='form-control time_picker' name="Wednesday[]" readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group '>
                                                    <input type='text' class='form-control numeric' name="Wednesday[]"  title="Grace Period (Minutes)" value="" maxlength="2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <td><input type="checkbox"  style="margin-left: 50px;" name="Thursday[]"  value="TH"> Thursday</td> 
                                        </div>
                                        <div class="timeOptionThursday" style="display: none;">                                                
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' name="Thursday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' name="Thursday[]" readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker' >
                                                    <input type='text' class='form-control time_picker' name="Thursday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group '>
                                                    <input type='text' class='form-control numeric' name="Thursday[]"  title="Grace Period (Minutes)" value="" maxlength="2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <td><input type="checkbox"  style="margin-left: 50px;" name="Friday[]"  value="F"> Friday</td>  
                                        </div>
                                        <div class="timeOptionFriday" style="display: none;">                                                
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' name="Friday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' name="Friday[]" readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker' >
                                                    <input type='text' class='form-control time_picker' name="Friday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group '>
                                                    <input type='text'  class='form-control numeric'  name="Friday[]" title="Grace Period (Minutes)" value="" maxlength="2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <td><input type="checkbox"  style="margin-left: 50px;" name="Saturday[]" value="SA"> Saturday</td>  
                                        </div>
                                        <div class="timeOptionSaturday" style="display: none;">                                                
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' name="Saturday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text'  class='form-control time_picker' name="Saturday[]" readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker' >
                                                    <input type='text' class='form-control time_picker' name="Saturday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group '>
                                                    <input type='text' class='form-control numeric' name="Saturday[]"  title="Grace Period (Minutes)" value="" maxlength="2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <td><input type="checkbox"  style="margin-left: 50px;" name="Sunday[]"  value="SU"> Sunday</td>  
                                        </div>
                                        <div class="timeOptionSunday" style="display: none;">                                                
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text'  class='form-control time_picker' name="Sunday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text'  class='form-control time_picker' name="Sunday[]" readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker' >
                                                    <input type='text'  class='form-control time_picker' name="Sunday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group '>
                                                    <input type='text'  class='form-control numeric'  name="Sunday[]" title="Grace Period (Minutes)" value="" maxlength="2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                    
                                    <Br>
                                    <div class="form-group">
                                    <div class="col-sm-7 col-md-offset-3 text-center">
                                        <a href='frm_employee.php?tab=<?php echo $tab?>&id=<?php echo $employee['id']?>' class='btn btn-default' onclick="return confirm('<?php echo empty($record)?"Cancel creation of new default shift?":"cancel change of default shift?" ?>')">Cancel</a>
                                        <button type='submit' class='btn btn-warning'>Save </button>

                                    </div>
                                </div>
                                
                            </div>
</div>
</div>

</form>
</div>
<br/> 
<div class='table-responsive'></div>
<table id='CustomTable' class='table table-bordered table-striped'>
  <thead>
    <tr>
      <th class='text-center'>Start Date</th>
      <!-- <th class='text-center'>End Date</th> -->
      <th class='text-center'>Working Days</th>
<!--       <th class='text-center'>Time in</th>
      <th class='text-center'>Time out</th>
      <th class='text-center'>Late Start</th>
      <th class='text-center'>Grace Period</th> -->
      <!-- <th class='text-center'>Beginning in</th>
      <th class='text-center'>Ending in</th>
      <th class='text-center'>Beginning out</th>
      <th class='text-center'>Ending out</th>
      <th class='text-center'>Break One Start</th>
      <th class='text-center'>Break One End</th>
      <th class='text-center'>Break Two Start</th>
      <th class='text-center'>Break Two End</th>
      <th class='text-center'>Break Three Start</th>
      <th class='text-center'>Break Three End</th> -->
      <th class='text-center'>Action</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>


<!-- Modal -->
<style>
    .datepicker{
        z-index:9999999999999!important;
    }
</style>
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Working Days</h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form">
                            <div class="row">
                                <div class="col-md-2">                                        
                                    <label>Start Date *:</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control date_picker" id="date_target" required>                                        
                                    <!-- <input type="text" class="form-control" id="date_target" required> -->
                                </div>
                            </div>
                    <br>
                                <div class="row">
                                    <div class="col-md-2">&nbsp;</div>
                                    <div class="col-md-2">Time In *</div>
                                    <div class="col-md-2">Time Out *</div>
                                    <div class="col-md-2">Late Start *</div>  
                                    <div class="col-md-2">Grace Period</div>
                                </div>
                                <br>

                <div class="form-group" id="mon" style="display: none;">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <input type="checkbox" id="moncheck" style="margin-left: 25px;" name="Monday[]" value="M"> Monday
                                        </div>
                                        <div class="timeOptionMonday" style="display: none;">                                                
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' id="Monday_1" name="Monday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' id="Monday_2" name="Monday[]" readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker' >
                                                    <input type='text'  class='form-control time_picker' id="Monday_3" name="Monday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group '>
                                                    <input type='text'  class='form-control numeric' id="Monday_4" name="Monday[]"  title="Grace Period (Minutes)" value="" maxlength="2">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                </div><!-- monday -->

                <div class="form-group" id="tues" style="display: none;">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <td><input class="weekcheck" type="checkbox" id="tuescheck" style="margin-left: 25px;"  name="Tuesday[]" value="T"> Tuesday</td> 
                                        </div>
                                        <div class="timeOptionTuesday" style="display: none;">                                                
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' id="Tuesday_1" name="Tuesday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' id="Tuesday_2" name="Tuesday[]" readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker' >
                                                    <input type='text'  class='form-control time_picker' id="Tuesday_3" name="Tuesday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group '>
                                                    <input type='text'  class='form-control numeric' id="Tuesday_4" name="Tuesday[]"  title="Grace Period (Minutes)" value="" maxlength="2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                </div><!-- Tuesday -->

                <div class="form-group" id="wed" style="display: none;">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <td><input class="weekcheck" type="checkbox" id="wedcheck" style="margin-left: 25px;" name="Wednesday[]"  value="W"> Wednesday</td>                                                
                                        </div>
                                        <div class="timeOptionWednesday" style="display: none;">                                                
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' id="Wednesday_1" name="Wednesday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' id="Wednesday_2" name="Wednesday[]" readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker' >
                                                    <input type='text' class='form-control time_picker' id="Wednesday_3" name="Wednesday[]" readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group '>
                                                    <input type='text' class='form-control numeric' id="Wednesday_4" name="Wednesday[]"  title="Grace Period (Minutes)" value="" maxlength="2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                </div><!-- Wednesday -->

                <div class="form-group" id="thurs" style="display: none;">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <td><input class="weekcheck" type="checkbox" id="thurscheck" style="margin-left: 25px;" name="Thursday[]"  value="TH"> Thursday</td> 
                                        </div>
                                        <div class="timeOptionThursday" style="display: none;">                                                
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' id="Thursday_1" name="Thursday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' id="Thursday_2" name="Thursday[]" readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker' >
                                                    <input type='text' class='form-control time_picker' id="Thursday_3" name="Thursday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group '>
                                                    <input type='text' class='form-control numeric' id="Thursday_4" name="Thursday[]"  title="Grace Period (Minutes)" value="" maxlength="2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                </div><!-- Thursday -->

                <div class="form-group" id="fri" style="display: none;">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <td><input class="weekcheck" type="checkbox" id="fricheck" style="margin-left: 25px;" name="Friday[]"  value="F"> Friday</td>  
                                        </div>
                                        <div class="timeOptionFriday" style="display: none;">                                                
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' id="Friday_1"  name="Friday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' id="Friday_2"  name="Friday[]" readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker' >
                                                    <input type='text' class='form-control time_picker' id="Friday_3"  name="Friday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group '>
                                                    <input type='text'  class='form-control numeric' id="Friday_4"   name="Friday[]" title="Grace Period (Minutes)" value="" maxlength="2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                </div><!-- Friday -->

                <div class="form-group" id="sat" style="display: none;">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <td><input class="weekcheck" type="checkbox" id="satcheck" style="margin-left: 25px;" name="Saturday[]" value="SA"> Saturday</td>  
                                        </div>
                                        <div class="timeOptionSaturday" style="display: none;">                                                
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text' class='form-control time_picker' id="Saturday_1" name="Saturday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text'  class='form-control time_picker' id="Saturday_2" name="Saturday[]" readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker' >
                                                    <input type='text' class='form-control time_picker' id="Saturday_3" name="Saturday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group '>
                                                    <input type='text' class='form-control numeric' id="Saturday_4" name="Saturday[]"  title="Grace Period (Minutes)" value="" maxlength="2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                </div><!-- Saturday -->

                <div class="form-group" id="sun" style="display: none;">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <td><input class="weekcheck" type="checkbox" id="suncheck" style="margin-left: 25px;" name="Sunday[]"  value="SU"> Sunday</td>  
                                        </div>
                                        <div class="timeOptionSunday" style="display: none;">                                                
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text'  class='form-control time_picker' id="Sunday_1" name="Sunday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker'>
                                                    <input type='text'  class='form-control time_picker' id="Sunday_2" name="Sunday[]" readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group bootstrap-timepicker timepicker' >
                                                    <input type='text'  class='form-control time_picker' id="Sunday_3" name="Sunday[]"  readonly="" required style="cursor: pointer;" title="Click to change" value="00:00:00">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='input-group '>
                                                    <input type='text'  class='form-control numeric' id="Sunday_4" name="Sunday[]" title="Grace Period (Minutes)" value="" maxlength="2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>  

                </div><!-- Sunday -->

                </form>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id = 'update_shift' name = 'upload_shift'>Save changes</button>
                <!-- <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">SUBMIT</button> -->
            </div>
        </div>
    </div>
</div>
  


<script type="text/javascript">

// function validate_form() {
//   /*
//   Validate the inpus
//    */
//   var str_error="";
//   if (validate_times($("#time_in").val(),$("#time_out").val())===false){
//     str_error+="Invalid time in and time out. \n";
//   } else if ($("#time_in").val()>=$("#time_out").val()) {
//     str_error+="Time out should be greater than time in. \n";
//   } 
//   start_date=moment("2017-01-01 "+$("#time_in").val(), "YYYY-MM-DD hh:mm a");
//   end_date=moment("2017-01-01 "+$("#time_out").val(), "YYYY-MM-DD hh:mm a");
//   late_start=moment("2017-01-01 "+$("#late_start").val(), "YYYY-MM-DD hh:mm a");
//   if (late_start.isBetwee(start_date, end_date)===false) {
//     str_error+="Late start should be between time in and time out. \n"
//   }
//   if ($("#beginning_in").val()=="00:00" && $("#beginning_out").val()=="00:00") {
//     str_error+="Invalid beginning in and beginning out. \n";
//   } else if ($("#beginning_in").val()>=$("#ending_in").val()) {
//     str_error+="Beginning in should be less than ending in. \n";
//   } else if ($("#beginning_in").val() > $("#time_in").val()) {
//     str_error+="Beginning in should be less than time in. \n";
//   } 

//   if ($("#ending_in").val()=="00:00" && $("#ending_out").val()=="00:00") {
//     str_error+="Invalid ending in and ending out. \n";
//   } else if ($("#ending_in").val()>=$("#ending_out").val()) {
//     str_error+="Ending in should be less than ending out. \n";
//   } else if ($("#ending_out").val() < $("#time_out").val()) {
//     str_error+="Ending out should be greater than time out. \n";
//   } 

//   if ($("#break_one_start").val()!=="00:00" && $("#break_one_end").val()!=="00:00" && $("#break_one_start").val()>=$("#break_one_end").val()) {
//     str_error+="Break one start should be less than break one end. \n";
//   }

//   if ($("#break_two_start").val()!=="00:00" && $("#break_two_end").val()!=="00:00" && $("#break_two_start").val()>=$("#break_two_end").val()) {
//     str_error+="Break two start should be less than break two end. \n";
//   }

//   if ($("#break_three_start").val()!=="00:00" && $("#break_three_end").val()!=="00:00" && $("#break_three_start").val()>=$("#break_three_end").val()) {
//     str_error+="Break three start should be less than break three end. \n";
//   }

//   if ($("input[name='working_days[]']:checked").length==0) {
//       str_error+="Please select a working day.\n";
//   }

//   if (str_error=="") { 
//     return confirm('This will replace the current active shift.');
//   } else {
//     alert('You have the following errors: \n'+str_error);
//     return false;
//   }
// }

    // start added
  $(function(){
    // var work = JSON.parse('<?php echo json_encode($new = explode('|', $working_Days['working_days'])) ?>');

    $('#modalForm').on('hidden.bs.modal', function () {

        $(this).find('form').trigger('reset');
        $('#mon').css('display','none');
        $('#tues').css('display','none');
        $('#wed').css('display','none');
        $('#thurs').css('display','none');
        $('#fri').css('display','none');
        $('#sat').css('display','none');
        $('#sun').css('display','none');

    });

    $(document).on('click' , '.check-data', function(){
        var date = $(this).data('start_date');
        date = date.split('-');
        $('#date_target').val(date[1]+"/"+date[2]+"/"+date[0]);
        // $('#date_target').val($(this).data('start_date'));

        var work = $(this).data('working_days');
            work = work.split('|');

            var day = new Map();

        for(var i = 0; i < work.length; i++){
            day.set(work[i]);
        }

    if (day.has('M')) {
        $("#moncheck").attr("checked", true);
        $(".timeOptionMonday").show();
        $('#mon').css('display','block');
        var a = work.indexOf("M");
        $("#Monday_1").val(work[a+1]);
        $("#Monday_2").val(work[a+2]);
        $("#Monday_3").val(work[a+3]);
        $("#Monday_4").val(work[a+4]);

    }
    else{
        $("#moncheck").attr("checked", false);
        $(".timeOptionMonday").show();
        $('#mon').css('display','block');
    }

    if (day.has('T')) {
        $("#tuescheck").attr("checked", true);
        $(".timeOptionTuesday").show();
        $('#tues').css('display','block');
        var a = work.indexOf("T");
        $("#Tuesday_1").val(work[a+1]);
        $("#Tuesday_2").val(work[a+2]);
        $("#Tuesday_3").val(work[a+3]);
        $("#Tuesday_4").val(work[a+4]);
    }
    else{
        $("#tuescheck").attr("checked", false);
        $(".timeOptionTuesday").show();
        $('#tues').css('display','block');
    }

    if (day.has('W')) {
        $("#wedcheck").attr("checked", true);
        $(".timeOptionWednesday").show();
        $('#wed').css('display','block');
        var a = work.indexOf("W");
        $("#Wednesday_1").val(work[a+1]);
        $("#Wednesday_2").val(work[a+2]);
        $("#Wednesday_3").val(work[a+3]);
        $("#Wednesday_4").val(work[a+4]);
    }
    else{
        $("#wedcheck").attr("checked", false);
        $(".timeOptionWednesday").show();
        $('#wed').css('display','block');
    }

    if (day.has('TH')) {
        $("#thurscheck").attr("checked", true);
        $(".timeOptionThursday").show();
        $('#thurs').css('display','block');
        var a = work.indexOf("TH");
        $("#Thursday_1").val(work[a+1]);
        $("#Thursday_2").val(work[a+2]);
        $("#Thursday_3").val(work[a+3]);
        $("#Thursday_4").val(work[a+4]);
    }
    else{
        $("#thurscheck").attr("checked", false);
        $(".timeOptionThursday").show();
        $('#thurs').css('display','block');
    }

    if (day.has('F')) {
        $("#fricheck").attr("checked", true);
        $(".timeOptionFriday").show();
        $('#fri').css('display','block');
        var a = work.indexOf("F");
        $("#Friday_1").val(work[a+1]);
        $("#Friday_2").val(work[a+2]);
        $("#Friday_3").val(work[a+3]);
        $("#Friday_4").val(work[a+4]);
    }
    else{
        $("#fricheck").attr("checked", false);
        $(".timeOptionFriday").show();
        $('#fri').css('display','block');
    }

    if (day.has('SA')) {
        $("#satcheck").attr("checked", true);
        $(".timeOptionSaturday").show();
        $('#sat').css('display','block');
        var a = work.indexOf("SA");
        $("#Saturday_1").val(work[a+1]);
        $("#Saturday_2").val(work[a+2]);
        $("#Saturday_3").val(work[a+3]);
        $("#Saturday_4").val(work[a+4]);
    }
    else{
        $("#satcheck").attr("checked", false);
        $(".timeOptionSaturday").show();
        $('#sat').css('display','block');
    }

    if (day.has('SU')) {
        $("#suncheck").attr("checked", true);
        $(".timeOptionSunday").show();
        $('#sun').css('display','block');
        var a = work.indexOf("SU");
        $("#Sunday_1").val(work[a+1]);
        $("#Sunday_2").val(work[a+2]);
        $("#Sunday_3").val(work[a+3]);
        $("#Sunday_4").val(work[a+4]);
    }
    else{
        $("#suncheck").attr("checked", false);
        $(".timeOptionSunday").show();
        $('#sun').css('display','block');
    }

            $('#update_shift').click(function(){
                var date_start =  $('#date_target').val();
                var work = $(this).data('working_days');
                // alert(work);
                console.log(work);
            });


    });
    // end added
  
<?php
if ($has_error===true || !empty($record)) :
?>
    $('#collapseForm').collapse({
      toggle: true
    });    
<?php
endif;
?>
    $('#CustomTable').DataTable({
          "columnDefs":[{
            "targets":[-1],
            "orderable":false
          }],
          "scrollX": true,
          "ajax":{
            "url":"ajax/employee_default_shifts.php",
            "data":function (d) {
              d.employee_id='<?php echo $employee['id'] ?>'
            }
          },
          "order": [[ 0, "desc" ]],
           dom: 'Bfrtip',
                buttons: [
                    {
                        extend:"excel",
                        text:"<span class='fa fa-download'></span> Download as Excel File "
                    }
                    ]
    });
  });

$(document).ready(function(){
        $("input[type='checkbox']").click(function(){
            var dayShort = $(this).val();
            var day;
            if(dayShort=="M"){
                day="Monday";
            }
            if(dayShort=="T"){
                day="Tuesday";
            }
            if(dayShort=="W"){
                day="Wednesday";
            }
            if(dayShort=="TH"){
                day="Thursday";
            }
            if(dayShort=="F"){
                day="Friday";
            }
            if(dayShort=="SA"){
                day="Saturday";
            }
            if(dayShort=="SU"){
                day="Sunday";
            }
            showTimeOption(day,dayShort);
        });
        layout();
        $("#oldChecker").click(function(){
            layout();
        });   

    });

    function layout(){
        if($("#oldChecker").is(':checked')){
            $("#oldLayout").show();
            $("#newLayout").hide();
        }
        else{
            $("#oldLayout").hide();
            $("#newLayout").show();   
        }
    }
    function showTimeOption(day,dayShort){
        if($("input[type='checkbox'][value='"+dayShort+"']").is(':checked')){
            $(".timeOption"+day).show();
            
        }
        else{
            $("input[type='text'][name='"+day+"']").val('');
            $(".timeOption"+day).hide();
        } 
    }


</script>

