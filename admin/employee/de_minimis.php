<?php
  $data=$con->myQuery("SELECT id,dmb_code,dmb_desc,dmb_amount FROM de_minimis_benefits WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
  $current_de_minimis=$con->myQuery("SELECT dmb_code FROM employee_de_minimis_benefits WHERE emp_id=?", array($employee['id']))->fetchAll(PDO::FETCH_COLUMN);

  $payslip1 = $con->myQuery("SELECT a.dmb_code as dmb_code,b.payslip as payslip FROM de_minimis_benefits a INNER JOIN employee_de_minimis_benefits b  ON a.dmb_code = b.dmb_code WHERE a.is_deleted=0 AND b.emp_id = ? AND b.payslip = 'Payslip 1' ", array($employee['id']))->fetchAll(PDO::FETCH_COLUMN);
  $payslip2 = $con->myQuery("SELECT a.dmb_code as dmb_code,b.payslip as payslip FROM de_minimis_benefits a INNER JOIN employee_de_minimis_benefits b  ON a.dmb_code = b.dmb_code WHERE a.is_deleted=0 AND b.emp_id = ? AND b.payslip = 'Payslip 2' ", array($employee['id']))->fetchAll(PDO::FETCH_COLUMN);
  $payslip3 = $con->myQuery("SELECT a.dmb_code as dmb_code,b.payslip as payslip FROM de_minimis_benefits a INNER JOIN employee_de_minimis_benefits b  ON a.dmb_code = b.dmb_code WHERE a.is_deleted=0 AND b.emp_id = ? AND b.payslip = 'Payslip 1,Payslip 2' ", array($employee['id']))->fetchAll(PDO::FETCH_COLUMN);
  $tab=10;
?>
<?php
  $has_error=false;
if (!empty($_SESSION[WEBAPP]['Alert']) && $_SESSION[WEBAPP]['Alert']['Type']=="danger") {
      $has_error=true;
}
  Alert();
?>
<br/>
<form method="POST" action='save_employee_de_minimis.php'>
<input type='hidden' name='employee_id' value='<?php echo !empty($employee)?$employee['id']:''; ?>'>
<input type='hidden' name='emp_code' value='<?php echo !empty($employee)?$employee['code']:''; ?>'>
<div class='text-right'>
  <button type='submit' class='btn btn-warning'><span class='fa fa-save'></span> Save </button>
  <button type='button' class='btn btn-default' onclick="clear_selected()"> Clear </button>
</div>
<br/><br/>
<table id='' class='table table-bordered table-striped table-condensed'>
  <thead>
    <tr>
      <th class='text-center' style="max-width: 20px;width: 20px"></th>
      <th class='text-center'>Payslip</th>
      <th class='text-center'>Code</th>
      <th class='text-center'>Description</th>
      <th class='text-center'>Amount</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $a=0;
    foreach ($data as $row) :
    ?>
      <tr>
        <td class='text-center'><input type='checkbox' name='dmb_code[]' value='<?php echo htmlspecialchars($row['dmb_code'])?>' <?php echo in_array($row['dmb_code'], $current_de_minimis)?"checked":"" ?>></td>
        <td class='text-center'>
        <input type="checkbox" name="payslip<?=$a?>" id="payslip1" value="Payslip 1" tabIndex="1" onClick="ckChange(this)" onchange="payslips(this)" <?php echo in_array($row['dmb_code'], $payslip1)?"checked":"" ?>>Payslip 1 
        &nbsp;&nbsp;&nbsp;
        <input type="checkbox" name="payslip<?=$a?>" id="payslip2" value="Payslip 2" tabIndex="1" onClick="ckChange(this)" onchange="payslips1(this)" <?php echo in_array($row['dmb_code'], $payslip2)?"checked":"" ?>>Payslip 2
        &nbsp;&nbsp;&nbsp;
        <input type="checkbox" name="payslip<?=$a?>" id="payslipdual" value="Payslip 1,Payslip 2" tabIndex="1" onClick="ckChange(this)" onchange="dual(this)" <?php echo in_array($row['dmb_code'], $payslip3)?"checked":"" ?>>Payslip 1 & 2
        </td>
        <td class='text-center'><?php echo htmlspecialchars($row['dmb_code'])?></td>
        <td class='text-center'><?php echo htmlspecialchars($row['dmb_desc'])?></td>
        <td class='text-center'><?php echo htmlspecialchars(number_format($row['dmb_amount'], 2))?></td>
      </tr>
    <?php
    $a++;
    endforeach;
    ?>
  </tbody>
</table>
</form>
<script type="text/javascript">
  function clear_selected() {
    $("input[name='dmb_code[]']").removeAttr('checked');
  }
 function ckChange(element) {
  var ckName = document.getElementsByName(element.name);
  for (var i = 0, c; c = ckName[i]; i++) {
   c.disabled = !(!element.checked || c === element);
  }
}


</script>