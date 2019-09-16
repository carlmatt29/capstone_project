<?php
    require_once("support/config.php");
    if (!isLoggedIn())
    {
        toLogin();
        die();
    }
    if (!empty($_POST))
    {
        $inputs=$_POST;

        $inputs=array_map('trim', $inputs);
        $errors="";

        if (empty($inputs['code'])){
            $errors.="<li>Enter Employee Code.</li>";
        }
        if (empty($inputs['first_name'])){
            $errors.="<li>Enter Employee First Name.</li>";
        }
        if (empty($inputs['last_name'])){
            $errors.="<li>Enter Employee Last Name.</li>";
        }
        if (empty($inputs['nationality'])){
            $errors.="<li>Enter Employee Nationality.</li>";
        }
        if (empty($inputs['address1'])){
            $errors.="<li>Enter Employee Address.</li>";
        }
        if (empty($inputs['city'])){
            $errors.="<li>Enter Employee City.</li>";
        }
        if (empty($inputs['province'])){
            $errors.="<li>Enter Employee Province.</li>";
        }
        if (empty($inputs['country'])){
            $errors.="<li>Enter Employee Country.</li>";
        }

        if($errors!="")
        {
            Alert("You have the following errors: <br/>".$errors,"danger");
            if(empty($inputs['id'])){
                redirect("employees.php");
            }else{
                redirect("employees.php?id=".urlencode($inputs['id']));
            }
            die;
        }

        $required_fieds=array(
            "code"                  => "Enter Employee Code. <br/>",
            "first_name"            => "Enter First Name. <br/>",
            "last_name"             => "Enter Last Name. <br/>",
            "nationality"           => "Enter Nationality. <br/>",
            "birthday"              => "Enter Date of Birth. <br/>",
            "gender"                => "Select Gender. <br/>",
            "civil_status"          => "Select Civil Status. <br/>",
            "address1"              => "Enter Address. <br/>",
            "city"                  => "Enter City. <br/>",
            "province"              => "Enter Province. <br/>",
            "country"               => "Enter Country. <br/>",
            "contact_no"            => "Enter Contact No. <br/>",
            "private_email"         => "Enter Email. <br/>"
            );

        $errors="";

        foreach ($required_fieds as $key => $value) 
        {
            if (empty($inputs[$key])) {
                $errors.=$value;
            } else {
                if ($key=='code') {
                    if (!empty($inputs['id'])) {
                        $count=$con->myQuery("SELECT COUNT(id) FROM employees WHERE code=? AND id <> ? AND is_deleted=0", array($inputs['code'],$inputs['id']))->fetchColumn();
                    } else {
                        $count=$con->myQuery("SELECT COUNT(id) FROM employees WHERE code=? AND is_deleted=0", array($inputs['code']))->fetchColumn();
                    }
                    if (!empty($count)) {
                        $errors.="Employee Code already exists. <br/>";
                    }
                }
            }
        }
        // if (empty($inputs['supervisor_id'])) {
        //     $inputs['supervisor_id']=0;
        // }
        try {
            $test=new DateTime($inputs['birthday']);
        } catch (Exception $e) {
          $errors.="Invalid Date Format";
        }


        if ($errors!="") 
        {
            Alert("You have the following errors: <br/>".$errors, "danger");
            if (empty($inputs['id'])) {
                redirect("employees.php");
                die();
            } else {
                redirect("employees.php?id=".urlencode($inputs['id']));
                die();
            }
            die;
        
        } else 
        {
            if(empty($inputs['w_sss'])){
            	$inputs['w_sss']=0;
            }

            if(empty($inputs['w_hdmf'])){
            	$inputs['w_hdmf']=0;
            }

            if(empty($inputs['w_philhealth'])){
            	$inputs['w_philhealth']=0;
            }

            if (empty($inputs['id'])) {
                //Insert
                unset($inputs['id']);

                $inputs['birthday'] = date_format(date_create($inputs['birthday']),"Y-m-d");
                
                $con->myQuery("INSERT INTO employees(
					code,
					first_name,
					middle_name,
					last_name,
					nationality,
					birthday,
					gender,
					civil_status,
					sss_no,
					tin,
					philhealth,
					pagibig,
					address1,
					address2,
					city,
					province,
					country,
					postal_code,
					contact_no,
					work_contact_no,
					private_email,
					work_email,
					acu_id,
					w_sss,
					w_philhealth,
					w_hdmf,
                    card_number
					) VALUES(
					:code,
					:first_name,
					:middle_name,
					:last_name,
					:nationality,
					:birthday,
					:gender,
					:civil_status,
					:sss_no,
					:tin,
					:philhealth,
					:pagibig,
					:address1,
					:address2,
					:city,
					:province,
					:country,
					:postal_code,
					:contact_no,
					:work_contact_no,
					:private_email,
					:work_email,
					:acu_id,
					:w_sss,
					:w_philhealth,
					:w_hdmf,
                    :account_no
					)", $inputs);
                insertAuditLog($_SESSION[WEBAPP]['user']['last_name'].", ".$_SESSION[WEBAPP]['user']['first_name']." ".$_SESSION[WEBAPP]['user']['middle_name'], " Created New Employee ({$inputs['first_name']} {$inputs['last_name']}).");
            } else {
                //Update
                $inputs['birthday'] = date_format(date_create($inputs['birthday']),"Y-m-d");
                
                $con->myQuery("UPDATE employees SET
							code=:code,
							first_name=:first_name,
							middle_name=:middle_name,
							last_name=:last_name,
							nationality=:nationality,
							birthday=:birthday,
							gender=:gender,
							civil_status=:civil_status,
							sss_no=:sss_no,
							tin=:tin,
							philhealth=:philhealth,
							pagibig=:pagibig,
							address1=:address1,
							address2=:address2,
							city=:city,
							province=:province,
							country=:country,
							postal_code=:postal_code,
							contact_no=:contact_no,
							work_contact_no=:work_contact_no,
							private_email=:private_email,
							work_email=:work_email,
							acu_id=:acu_id,
							w_sss=:w_sss,
							w_philhealth=:w_philhealth,
							w_hdmf=:w_hdmf,
                            card_number=:account_no{$file_sql}
					WHERE id=:id
					", $inputs);
                $employee_id=$inputs['id'];
            }


            Alert("Save succesful", "success");
            redirect("employees.php?id=".urlencode($employee_id));
        }
        die;
    } else {
        redirect('template.php');
        die();
    }
    redirect('template.php');