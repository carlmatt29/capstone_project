<?php
	require_once 'support/config.php';
	$msg ='';
	if(!empty($_POST)){
		$user = $con->myQuery("SELECT users.id,users.user_type_id as 'user_type',e.whitelist_ip,e.acu_id,e.first_name,e.middle_name,e.department_id,e.payroll_group_id,e.last_name,e.department_id,e.image,e.gender,e.id as employee_id FROM `users` JOIN employees e ON e.id=users.employee_id  WHERE username=? AND password= ? AND users.is_deleted=0 AND e.is_terminated=0 AND e.is_deleted=0 LIMIT 1", array($_POST['username'],encryptIt($_POST['password'])))->fetch(PDO::FETCH_ASSOC);
		$db_password = $user['password'];
		$password = $_POST['password'];

		$get_user = $con->myQuery("SELECT * FROM users WHERE id = ? AND is_deleted = 0", array($user['id']))->fetch(PDO::FETCH_NUM);

		if(empty($user)){
			$msg = "Please check your inputs!";

			if(!empty($_SESSION[WEBAPP]['attempt_no'])){
				$_SESSION[WEBAPP]['attempt_no']+=1;
			}
			else{
				$_SESSION[WEBAPP]['attempt_no']=1;
			}
			redirect('index.php');
		}
		else {

			$_SESSION[WEBAPP]['user']=$user;
			refresh_activity($_SESSION[WEBAPP]['user']['id']);
			redirect("template.php");
			}
		die;
	} else {

		die();
	}

?>
