<?php
	require_once 'support/config.php';
	
	if(!isLoggedIn()){
		toLogin();
		die();
	}
	if(!AllowUser(array(1,4))){
        redirect("index.php");
    }
	if(empty($_GET['id']) || empty($_GET['t'] || !is_numeric($_GET['id']))){
		redirect('index.php');
		die;
	}
	else
	{

		$table="";
		switch ($_GET['t']) {
			
			case 'u':
				$table="users";
				$page="users.php";

				$audit_details=$con->myQuery("SELECT u.username as username FROM users u WHERE u.id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
				$audit_message="Deleted {$audit_details['username']} from users.";

				break;
			
			case 'e':
				$table="employees";
				$page="employees.php";

				$audit_details=$con->myQuery("SELECT CONCAT(first_name,' ',last_name) AS full_name FROM {$table} WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
				$audit_message="Deleted {$audit_details['full_name']} from employees.";
				break;
				}


		
		$con->myQuery("UPDATE {$table} SET is_deleted=1 WHERE id=?",array($_GET['id']));

		insertAuditLog($_SESSION[WEBAPP]['user']['last_name'].", ".$_SESSION[WEBAPP]['user']['first_name']." ".$_SESSION[WEBAPP]['user']['middle_name'],$audit_message);
		Alert("Delete Successful.","success");
		redirect($page);

		die();

	}
?>