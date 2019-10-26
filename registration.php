<?php
require_once("support/config.php");

		if(!empty($_POST)){
		$inputs=$_POST;
		
		try {
	            	$con->beginTransaction();
		$special_id = $con->myQuery("SELECT COUNT(id)+1 as special_id FROM employees")->fetch();
		$applicant = "APPLICANT-".$special_id['special_id']."";
		$inputs['applicant']=$applicant;
		$inputs['code']=$applicant;
		$params_applicant=array(
			'code'			=>$inputs['code'],
			'first_name'	=>$inputs['firstname'],
			'middle_name'	=>$inputs['middlename'],
			'last_name'		=>$inputs['lastname']
				
		);

		$con->myQuery("INSERT INTO employees(code,first_name,middle_name,last_name) VALUES (:code,:first_name,:middle_name,:last_name)",$params_applicant);	            	
	
		
// print_r($app_id['applicant_id']);
// 		die();
		$inputs['applicant_id']=$applicant_id = $con->lastInsertId();
	            	unset($inputs['user_id']);
	            	$inputs['password'] = encryptIt($inputs['password']);
	            	
	            	//password_hash($inputs['password'], PASSWORD_DEFAULT);
					
	                $param_user=array(
					    'emp_id'    	=>$inputs['applicant_id'],
					    'username'  	=>$inputs['username'],
					    'password'  	=>$inputs['password'],
					    'password_decrypted'  	=>$inputs['cPassword'],
					    'user_type_id'  =>3
					    
					);

					$con->myQuery("INSERT INTO users(employee_id,username,password,password_decrypted,user_type_id) VALUES(:emp_id,:username,:password,:password_decrypted,:user_type_id)",$param_user);

					Alert("Save succesful","success");
					redirect("index.php");
	            	
	            	$con->commit();
                } catch (Exception $e) {
	            	$con->rollback();
	            	error_logs('User',$e);
                }
			}				
			
			

?>