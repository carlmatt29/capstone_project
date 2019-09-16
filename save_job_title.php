<?php
	require_once("support/config.php");
	if(!isLoggedIn()){
		toLogin();
		die();
	}

    if(!AllowUser(array(1,4))){
        redirect("template.php");
    }


		if(!empty($_POST)){
		//Validate form inputs
		$inputs=$_POST;
		$inputs=array_map('trim', $inputs);
		$bulkemplist ="";
		
		$emp_ids=$_POST['emp_id'];
		$countermax = sizeOf($emp_ids);
		$ctr=0;
    	while($ctr<$countermax){
    		if($ctr==0){
    			$bulkemplist = $emp_ids[$ctr];
    		}
    		else{
    			$bulkemplist.= ",".$emp_ids[$ctr];
    		}
    		$ctr++;
    	}
    	$inputs['emp_id'] = $bulkemplist;
        
		$errors="";
		if (empty($inputs['name'])){
			$errors.="<li>Enter Job Title. </li>";
		}
		if (empty($inputs['description'])){
			$errors.="<li>Enter Description. </li>";
		}


		if($errors!=""){

			Alert("You have the following errors: <br/><ul>".$errors."</ul>","danger");
			if(empty($inputs['id'])){
				redirect("frm_job_title.php");
			}
			else{
				redirect("frm_job_title.php?id=".urlencode($inputs['id']));
			}
			die;
		}
		else{
			//IF id exists update ELSE insert
			$inputs['process_id']="";
			$lastrow = $con->myQuery("select auto_increment as id from information_schema.tables where table_schema = 'db_capstone' and table_name =  'job_title'")->fetch(PDO::FETCH_ASSOC);
			$inputs['process_id'] = $lastrow['id'];
			if(empty($inputs['id'])){
				//Insert
				
				if($inputs['is_available']!=1){
				    $inputs['is_available']=0;
				}
				try {
	$con->beginTransaction();
	
	
	unset($inputs['id']);
				
				
				$con->myQuery("INSERT INTO job_title(code,description,employee_process_id,process_id,is_available) VALUES(:name,:description,:emp_id,:process_id,:is_available)",$inputs);	
	
	$con->commit();
    } catch (Exception $e) {
	$con->rollback();
	error_logs('Job Title',$e);
    }
				
			}
			else{
				//Update
				
				try {
	$con->beginTransaction();
	if($inputs['is_available']!=1){
	    $inputs['is_available']=0;
	}
	$inputs['process_id']= $inputs['id'];
	$con->myQuery("UPDATE job_title SET code=:name,description=:description,employee_process_id=:emp_id,is_available=:is_available,process_id=:process_id WHERE id=:id",$inputs);
	$con->commit();
    } catch (Exception $e) {
	$con->rollback();
	error_logs('Job Title',$e);
    }
				
			}
			//die();
			Alert("Save succesful","success");
			redirect("job_title.php");
		}
		die;
	}
	else{
		redirect('template.php');
		die();
	}
	redirect('template.php');
?>