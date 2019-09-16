<?php
	$tab=15;
?>

<?php
    $has_error=FALSE;
    if(!empty($_SESSION[WEBAPP]['Alert']) && $_SESSION[WEBAPP]['Alert']['Type']=="danger")
    {
        $has_error=TRUE;
    }

    $requirements = $con->myQuery("SELECT requirement_boarding_id, employee_id, added_date, requirement_name, (SELECT CONCAT(last_name,', ',first_name) FROM employees WHERE id=updated_by) as updated_by FROM vw_requirement_employee WHERE boarding_type = 'ON' AND employee_id=?",array($_GET['id']))->fetchAll(PDO::FETCH_ASSOC);

	Alert();
?>

<div class='text-center'>
	<div>
		<a id="email" href='requirement_notify.php?id=<?php echo $_GET['id']?>&type=ON&tab=<?php echo $_GET['tab']; ?>' onclick="return confirm('Alert the employee?')" class="btn btn-danger btn-md"><span class='fa fa-envelope'></span> Alert the employee</a>			
	</div>
</div>

<table id="on_boarding_table" class='table table-bordered table-striped'>
	<thead>
		<tr>
			<td class='text-center'>Requirements</td>
			<td class='text-center'>Date Submitted</td>
			<td class='text-center'>Updated By</td>
			<td class='text-center'>Action</td>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($requirements as $row):
		?>
		<tr>
			<td class='text-center'> <?php echo htmlspecialchars($row['requirement_name'])?> </td>
			<td class='text-center'> <?php echo htmlspecialchars($row['added_date'])?></td>
			<td class='text-center'> <?php echo htmlspecialchars($row['updated_by'])?></td>
			<td class='text-center'>
				<a href='add_requirement_employee.php?requirementId=<?php echo $row['requirement_boarding_id']?>&id=<?php echo $row['employee_id']?>&type=ON' onclick="return confirm('Add the requirement?')" class="btn btn-info btn-sm"><span class='fa fa-check'></span></a>
			</td>
		</tr>
		<?php
			endforeach;
		?>
	</tbody>
</table>