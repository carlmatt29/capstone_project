<?php
	$tab=15;

	if(!empty($employee))
    {
        $employees=$con->myQuery("SELECT id,CONCAT(last_name,', ',first_name,' ',middle_name) FROM employees WHERE is_deleted=0 AND is_terminated=0 AND id <> ?",array($employee['id']))->fetchAll(PDO::FETCH_ASSOC);
    }else
    {
        $employees=$con->myQuery("SELECT id,CONCAT(last_name,', ',first_name,' ',middle_name) FROM employees WHERE is_deleted=0 AND is_terminated=0")->fetchAll(PDO::FETCH_ASSOC);
    }
?>

<?php
    $has_error=FALSE;
    if(!empty($_SESSION[WEBAPP]['Alert']) && $_SESSION[WEBAPP]['Alert']['Type']=="danger")
    {
        $has_error=TRUE;
    }
    Alert();
?>

<div class='text-right'>
    <button class='btn btn-warning' data-toggle="collapse" data-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm">Toggle Form </button>
</div>
<br/>
<div id='collapseForm' class='collapse'>
    <form class='form-horizontal' action='save_employment_movement.php' method="POST" onsubmit="return confirm('Do you want to save the changes in employee information?')">
        <input type='hidden' name='employee_id' value='<?php echo !empty($employee)?$employee['id']:''; ?>'>
     
        <div class="form-group">
            <label for="employment_status_id" class="col-md-3 control-label">Employment Status *</label>
            <div class="col-md-7">
                <select name='employment_status_id' class='form-control' data-placeholder="Select Employment Status" <?php echo !(empty($employee))?"data-selected='".$employee['employment_status_id']."'":NULL ?> style='width:100%' required>
                    <?php
                        echo makeOptions($employment_status);
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="job_title_id" class="col-md-3 control-label">Job Title *</label>
            <div class="col-md-7">
                <select name='job_title_id' class='form-control cbo' data-placeholder="Select Job Title " <?php echo !(empty($employee))?"data-selected='".$employee['job_title_id']."'":NULL ?> style='width:100%' required>
                    <?php
                        echo makeOptions($job_titles);
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="pay_grade_id" class="col-md-3 control-label">Pay Grade *</label>
            <div class="col-md-7">
                <select name='pay_grade_id' class='form-control cbo' data-placeholder="Select Pay Grade " <?php echo !(empty($employee))?"data-selected='".$employee['pay_grade_id']."'":NULL ?> style='width:100%'  required>
                    <?php
                        echo makeOptions($pay_grades);
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="department_id" class="col-md-3 control-label">Department *</label>
            <div class="col-md-7">
                <select name='department_id' class='form-control cbo' data-placeholder="Select Department " <?php echo !(empty($employee))?"data-selected='".$employee['department_id']."'":NULL ?> style='width:100%' required>
                    <?php
                        echo makeOptions($departments);
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Pay Group *</label>
            <div class="col-md-7">
                <select name='pay_group_id' class='form-control cbo' data-placeholder="Select Pay Group " <?php echo !(empty($employee))?"data-selected='".$employee['payroll_group_id']."'":NULL ?> style='width:100%' required>
                    <?php
                        echo makeOptions($payroll_group);
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="branch_id" class="col-md-3 control-label">Branch </label>
            <div class="col-md-7">
                <select name='branch_id' id='branch_id' class='form-control cbo' data-placeholder="Select Branch " <?php echo !(empty($employee))?"data-selected='".$employee['branch_id']."'":NULL ?> style='width:100%'>
                    <?php
                        echo makeOptions($branch);
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="supervisor_id" class="col-md-3 control-label">Supervisor </label>
            <div class="col-md-7">
                <select name='supervisor_id' id='supervisor_id' class='form-control cbo' data-placeholder="Select Supervisor " <?php echo !(empty($employee))?"data-selected='".$employee['supervisor_id']."'":NULL ?> style='width:100%'>
                    <?php
                        echo makeOptions($employees);
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="joined_date" class="col-md-3 control-label">Join Date * </label>
            <div class="col-md-7">
                <input type="text" class="form-control date_picker" id="joined_date"  name='joined_date' value='<?php echo !empty($employee)?$employee['joined_date']=='0000-00-00'?'':htmlspecialchars(DisplayDate($employee['joined_date'])):''; ?>' required>
            </div>
        </div>

        <div class="form-group">
            <label for="basic_salary" class="col-md-3 control-label">Basic Salary * </label>
            <div class="col-md-7">
                <input type="text" class="form-control" id="basic_salary"  name='basic_salary' placeholder="0000.00" value='<?php echo !empty($employee)?htmlspecialchars($employee['basic_salary']):''; ?>' required>
            </div>
        </div>

        <!-- ADDED BY AILEEN ROMERO 11/13/2018 -->
        <div class="form-group">
            <label for="basic_salary" class="col-md-3 control-label">E-Cola Amount * </label>
            <div class="col-md-7">
                <input type="text" class="form-control" id="ecola_rate"  name='ecola_rate' placeholder="00.00" value='<?php echo !empty($employee)?htmlspecialchars($ecola['ecola_rate']):''; ?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="bond_date" class="col-md-3 control-label">Regularization Date </label>
            <div class="col-md-7">
                <input type="text" class="form-control date_picker" id="regularization_date"  name='regularization_date' value='<?php echo !empty($employee)?$employee['regularization_date']=='0000-00-00'?'':htmlspecialchars(DisplayDate($employee['regularization_date'])):''; ?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="bond_date" class="col-md-3 control-label">Bond Date </label>
            <div class="col-md-7">
                <input type="text" class="form-control date_picker" id="bond_date"  name='bond_date' value='<?php echo !empty($employee)?$employee['bond_date']=='0000-00-00'?'':htmlspecialchars(DisplayDate($employee['bond_date'])):''; ?>'>
            </div>
        </div>

        <div class='form-group'>
            <label class='col-md-3 control-label'>Remarks (for update only)</label>
            <div class='col-md-7'>
                <textarea name='remarks' class='form-control ' style='resize: none' rows='4'></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-9 col-md-offset-2 text-center">
                <a href='frm_employee.php?id=<?php echo $employee['id']?>&tab=<?php echo $tab?>' class='btn btn-default'>Cancel</a>
                <button type='submit' class='btn btn-warning'>Save </button>
            </div>
        </div>

    </form>
</div>