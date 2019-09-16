<?php 
    require_once("../support/config.php");
    $typeid = $_POST['typeid'];
    
if($typeid==1||$typeid==2){
    $user_access = $con->myQuery("SELECT * FROM user_access WHERE system_id=1");
	// $user_access = $con->myQuery("SELECT * FROM user_access WHERE system_id=1 AND FIND_IN_SET('2',user_type_id) <> 0");
	
	
	while($row = $user_access->fetch(PDO::FETCH_ASSOC)):
	$uad = explode("," , $row['user_type_id']);
    
    
?>
    <tr>
		<td class='text-left  <?php if(in_array('2',$user_access_id)){ echo 'highlighted'; }else{ echo 'inactive'; }?>'  style="padding-top: 13px;">
			<span class="fa fa-circle-o"></span>&nbsp;&nbsp;<?php echo $row['feature']; ?>
		</td>
		<td class='text-right'>
            <label class="switch">
                <input type="checkbox" name="user_feature[]" id="user_feature" <?php for($x=0;$x<count($uad);$x++){
					if($uad[$x]==$typeid){ echo "checked";}
				} ?> value="<?php echo $row['user_access_id']; ?>"><span class="slider round"></span>
            </label>
		</td>
	</tr>
<?php endwhile; 

}else if($typeid==3){?>
<?php

    $user_access = $con->myQuery("SELECT * FROM user_access WHERE (system_id=1 AND user_access_id=1) OR system_id=2");
	// $user_access = $con->myQuery("SELECT * FROM user_access WHERE system_id=1 AND FIND_IN_SET('2',user_type_id) <> 0");
	while($row = $user_access->fetch(PDO::FETCH_ASSOC)):
	$uad = explode("," , $row['user_type_id']);
?>
	<tr>
		<td class='text-left  <?php if(in_array('2',$user_access_id)){ echo 'highlighted'; }else{ echo 'inactive'; }?>'  style="padding-top: 13px;">
			<span class="fa fa-circle-o"></span>&nbsp;&nbsp;<?php echo $row['feature']; ?>
		</td>
		<td class='text-right'>
            <label class="switch">
                <input type="checkbox" name="user_feature[]" id="user_feature" <?php for($x=0;$x<count($uad);$x++){
					if($uad[$x]==$typeid){ echo "checked";}
				} ?>  value="<?php echo $row['user_access_id']; ?>"><span class="slider round"></span>
            </label>
		</td>
	</tr>

<?php
	endwhile;
}else if($typeid==4){
?>	

<?php 
$user_access = $con->myQuery("SELECT * FROM user_access ");
	// $user_access = $con->myQuery("SELECT * FROM user_access WHERE system_id=1 AND FIND_IN_SET('2',user_type_id) <> 0");
	while($row = $user_access->fetch(PDO::FETCH_ASSOC)):
	$uad = explode("," , $row['user_type_id']);
?>
	<tr>
		<td class='text-left  <?php if(in_array('2',$user_access_id)){ echo 'highlighted'; }else{ echo 'inactive'; }?>'  style="padding-top: 13px;">
			<span class="fa fa-circle-o"></span>&nbsp;&nbsp;<?php echo $row['feature']; ?>
		</td>
		<td class='text-right'>
            <label class="switch">
                <input type="checkbox" name="user_feature[]" id="user_feature" <?php echo !empty($uaid)?($uaid[$x]<>''?"checked":""):""; ?> <?php for($x=0;$x<count($uad);$x++){
					if($uad[$x]==$typeid){ echo "checked";}
				} ?> value="<?php echo $row['user_access_id']; ?>"><span class="slider round"></span>
            </label>
		</td>
	</tr>

<?php
	endwhile;
}
?>

