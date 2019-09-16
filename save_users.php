<?php
	require_once("support/config.php");
	if(!isLoggedIn()){
		toLogin();
		die();
	}

    if(!AllowUser(array(4))){
        redirect("index.php");
    }

    
	if(!empty($_POST)){
		//Validate form inputs
		$inputs=$_POST;
        
		if($inputs['user_type_id'] == 1 || $inputs['user_type_id'] == 2){
			$inputs['system_id']=1;
		}
		if($inputs['s_type'] == 'payroll_with_attendance'){
			// $inputs['system_id']=2;
			$count_uaid=count($inputs['user_feature']);
			$uaid_hr=array();
			$uaid_pay=array();
			for($j=0; $j<$count_uaid; $j++){
				$uaid= $con->myQuery("SELECT user_access_id,system_id FROM user_access WHERE user_access_id=?",array($inputs['user_feature'][$j]))->fetch(PDO::FETCH_ASSOC);
				if($uaid['system_id']==1){
					$uaid_hr[]=$uaid['user_access_id'];
					$inputs['u_feature_hr']= array(implode("," , $uaid_hr));

					// print_r($uid);
				}elseif($uaid['system_id']==2){
					$uaid_pay[]=$uaid['user_access_id'];
					$inputs['u_feature_pay']= array(implode("," , $uaid_pay));

				}	
			}
		}

		if($inputs['s_type'] == 'both'){
			$count_uaid=count($inputs['user_feature']);
			$uaid_hr=array();
			$uaid_pay=array();
			for($j=0; $j<$count_uaid; $j++){
				$uaid= $con->myQuery("SELECT user_access_id,system_id FROM user_access WHERE user_access_id=?",array($inputs['user_feature'][$j]))->fetch(PDO::FETCH_ASSOC);
				if($uaid['system_id']==1){
					$uaid_hr[]=$uaid['user_access_id'];
					$inputs['u_feature_hr']= array(implode("," , $uaid_hr));
					// print_r($uid);
				}elseif($uaid['system_id']==2){
					$uaid_pay[]=$uaid['user_access_id'];
					$inputs['u_feature_pay']= array(implode("," , $uaid_pay));
				}				
			}
		}

		// echo "<pre>";
		// print_r($inputs);
		// die;

		if(!empty($inputs['user_id'])){
		$employee_user=$con->myQuery("SELECT * FROM users WHERE is_deleted=0 and employee_id=?",array($inputs['emp_id']));
		$uname=$con->myQuery("SELECT id,lcase(username) FROM users WHERE is_deleted=0 and username=?",array(strtolower($inputs['username'])));
		}

		$errors="";

		if (empty($inputs['username'])){
			$errors.="Enter Username. <br/>";
		}
		if (empty($inputs['password'])){
			$errors.="Enter Password. <br/>";
		}
		if (empty($inputs['user_type_id'])){
			$errors.="Select User Type. <br/>";
		}
		if (empty($inputs['emp_id'])){
			$errors.="Select Employee. <br/>";
		}
		// if ($employee_user->fetchcolumn() > 0) {
		// 	$errors.="Selected Employee already has an Account. <br />";
		// }

		// print_r(strtolower($inputs['username']));

		$uname=$con->myQuery("SELECT id,lcase(username) FROM users WHERE is_deleted=0 and username=?",array(strtolower($inputs['username'])))->fetch(PDO::FETCH_ASSOC);

		
		if(!empty($uname)){
			if(empty($inputs['user_id'])){
				$errors.="Entered Username is not available.";
			}
			elseif(!empty($inputs['user_id']) && $uname['id']<>$inputs['user_id']){
				$errors.="Entered Username is not available.";
			}
		}

		if($errors!=""){

			Alert("You have the following errors: <br/>".$errors,"danger");
			if(empty($inputs['id'])){
				redirect("frm_users.php");
			}
			else{
				redirect("frm_users.php?id=".urlencode($inputs['id']));
			}
			die;
		}
		else{
			unset($inputs['get_id']);
			unset($inputs['con_password']);
			//IF id exists update ELSE insert
			// var_dump($inputs);
			if(empty($inputs['user_id'])){
				//Insert
				try {
	            	$con->beginTransaction();
	            	
	            	unset($inputs['user_id']);
	            	$inputs['password'] = encryptIt($inputs['password']);
	            	
	            	//password_hash($inputs['password'], PASSWORD_DEFAULT);
					
	                $param_user=array(
					    'emp_id'    	=>$inputs['emp_id'],
					    'username'  	=>$inputs['username'],
					    'password'  	=>$inputs['password'],
					    'user_type_id'  =>$inputs['user_type_id'],
					    'pass_q'        =>$inputs['pass_q'],
					    'pass_a'        =>$inputs['pass_a']
					);

	    			// echo "<pre>";
					// print_r($param_user);
					// die;

					$con->myQuery("INSERT INTO users(employee_id,username,password,user_type_id,password_question,password_answer) VALUES(:emp_id,:username,:password,:user_type_id,:pass_q,:pass_a)",$param_user);

					$user_id=$con->lastInsertId();
					$user_access_ids=implode(',', $inputs['user_feature']);

					if($inputs['s_type'] == 'both'){
						$param_hr=array(
						    'user_id'    	=>$user_id,
						    'u_access_ids'  =>$inputs['u_feature_hr'],
						    'system_id'  	=>'1'
						);
						$param_pay=array(
						    'user_id'    	=>$user_id,
						    'u_access_ids'  =>$inputs['u_feature_pay'],
						    'system_id'  =>'2'
						);
						$con->myQuery("INSERT INTO permissions(user_id,user_access_id,system_id) VALUES (:user_id,:u_access_ids,:system_id)",$param_hr);
						$con->myQuery("INSERT INTO permissions(user_id,user_access_id,system_id) VALUES (:user_id,:u_access_ids,:system_id)",$param_pay);		
					} 
					if($inputs['s_type'] == 'payroll_with_attendance') {
						$hey_hr = implode(',', $inputs['u_feature_hr']);
						$hey_pay = implode(',', $inputs['u_feature_pay']);
						$param_hr=array(
						    'user_id'    	=>$user_id,
						    'u_access_ids'  =>$hey_hr,
						    'system_id'  	=>'1'
						);
						$param_pay=array(
						    'user_id'    	=>$user_id,
						    'u_access_ids'  =>$hey_pay,
						    'system_id'  =>'2'
						);
						$con->myQuery("INSERT INTO permissions(user_id,user_access_id,system_id) VALUES (:user_id,:u_access_ids,:system_id)",$param_hr);
						$con->myQuery("INSERT INTO permissions(user_id,user_access_id,system_id) VALUES (:user_id,:u_access_ids,:system_id)",$param_pay);	
					} else{
						$param_uaid=array(
						    'user_id'    	=>$user_id,
						    'u_access_ids'  =>$user_access_ids,
						    'system_id'  =>$inputs['system_id']
						);
						$con->myQuery("INSERT INTO permissions(user_id,user_access_id,system_id) VALUES (:user_id,:u_access_ids,:system_id)",$param_uaid);					
					}

					Alert("Save succesful","success");
					redirect("users.php");
	            	
	            	$con->commit();
                } catch (Exception $e) {
	            	$con->rollback();
	            	error_logs('User',$e);
                }
				
			}
			else{
				//Update user
				try {
	            	$con->beginTransaction();
	            	
	            	$pw=$con->myQuery("SELECT id,password FROM users WHERE is_deleted=0 and id=?",array($inputs['user_id']))->fetch(PDO::FETCH_ASSOC);
					if($pw['password']==$inputs['password']){					
					}else{
						// print_r("update pass");
						$inputs['password'] =encryptIt($inputs['password']);
						
					}
	                $param_user=array(
	                	'user_id'    	=>$inputs['user_id'],
					    'username'  	=>$inputs['username'],
					    'password'  	=>$inputs['password'],
					    'user_type_id'  =>$inputs['user_type_id'],
					    'pass_q'        =>$inputs['pass_q'],
					    'pass_a'        =>$inputs['pass_a']
					);
					
                    
	                $user_access_ids=implode(',', $inputs['user_feature']);

					// echo "<pre>";
					// print_r($param_user);
					// die;

					$con->myQuery("UPDATE users SET username=:username,password=:password,user_type_id=:user_type_id,password_question=:pass_q,password_answer=:pass_a WHERE id=:user_id",$param_user);
					

					$con->myQuery("DELETE FROM permissions where user_id = ?",array($inputs['user_id']));

					if($inputs['s_type'] == 'both'){	
						$param_hr=array(
						    'user_id'    	=>$inputs['user_id'],
						    'u_access_ids'  =>$inputs['u_feature_hr'][0],
						    'system_id'  =>'1'
						);
						$param_pay=array(
						    'user_id'    	=>$inputs['user_id'],
						    'u_access_ids'  =>$inputs['u_feature_pay'][0],
						    'system_id'  =>'2'
						);
						// echo "<pre>";
						// print_r($param_hr);
						// die;	
						$con->myQuery("INSERT INTO permissions(user_id,user_access_id,system_id) VALUES (:user_id,:u_access_ids,:system_id)",$param_hr);
						$con->myQuery("INSERT INTO permissions(user_id,user_access_id,system_id) VALUES (:user_id,:u_access_ids,:system_id)",$param_pay);

						//echo "<pre>";
						//print_r($param_hr);
						//echo "<pre>";
						//print_r($param_pay);
						//die;	

					} 
					if($inputs['s_type'] == 'payroll_with_attendance') {
						$user_id = $inputs['user_id'];
						$hey_hr = implode(',', $inputs['u_feature_hr']);
						$hey_pay = implode(',', $inputs['u_feature_pay']);
						$param_hr=array(
						    'user_id'    	=>$user_id,
						    'u_access_ids'  =>$hey_hr,
						    'system_id'  	=>'1'
						);
						$param_pay=array(
						    'user_id'    	=>$user_id,
						    'u_access_ids'  =>$hey_pay,
						    'system_id'  =>'2'
						);
						$con->myQuery("INSERT INTO permissions(user_id,user_access_id,system_id) VALUES (:user_id,:u_access_ids,:system_id)",$param_hr);
						$con->myQuery("INSERT INTO permissions(user_id,user_access_id,system_id) VALUES (:user_id,:u_access_ids,:system_id)",$param_pay);	
					} else{
						$param_uaid=array(
						    'user_id'    	=>$inputs['user_id'],
						    'u_access_ids'  =>$user_access_ids,
						    'system_id'  =>$inputs['system_id']
						);
						// echo "<pre>";
						// print_r($param_uaid);
						// die;	
						$con->myQuery("INSERT INTO permissions(user_id,user_access_id,system_id) VALUES (:user_id,:u_access_ids,:system_id)",$param_uaid);					
					}
					// $con->myQuery("INSERT INTO permissions(user_id,user_access_id) VALUES (:user_id,:u_access_ids)",$param_uaid);

					Alert("Update succesful","success");
					redirect("users.php");
	            	
	            	$con->commit();
                } catch (Exception $e) {
	            	$con->rollback();
	            	error_logs('User',$e);
                }
				// $inputs['password']=encryptIt($inputs['password']);
			}

			// die;
			//Alert("Save succesful","success");
			redirect("users.php");
		}
		die;
	}
	else{
		redirect('index.php');
		die();
	}
	redirect('index.php');
?>