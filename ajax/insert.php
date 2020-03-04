<?php
	require_once("../support/config.php");

	$mydate = new DateTime();
	$date_today = $mydate->format('Y-m-d H:i:s');


	$email = $_POST['email'];
	$contact_no = $_POST['contact_no'];
	$position_applied = $_POST['position_applied'];
	$desired_monthly_salary = $_POST['desired_monthly_salary'];
	$date_available_for_work = $_POST['date_available_for_work'];
	$date_available_for_work  = date("Y-m-d",strtotime($date_available_for_work));
	$last_name = $_POST['last_name'];
	$first_name = $_POST['first_name'];
	$middle_name = $_POST['middle_name'];
	$alias = $_POST['alias'];
	$present_address = $_POST['present_address'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	$postal_code = $_POST['postal_code'];
	$gender = $_POST['gender'];
	$age = $_POST['age'];
	$birth_date = $_POST['birth_date'];
	$birth_date  = date("Y-m-d",strtotime($birth_date));
	$birth_place = $_POST['birth_place'];
	$citizenship = $_POST['citizenship'];
	$civil_status = $_POST['civil_status'];

	$length = 5;
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

	$date_today = date("Ymd");
	$application_number = "APPLICANT-".$date_today."-".$randomString;

	// use query below only when one field is empty
	// IFNULL(e.middle_name,'')) as 'employee'

	$profile = $con->myQuery("INSERT INTO tbl_applicant_profile (first_name, middle_name, last_name, email, present_address, contact_number, city, state_province_region, postal_code, country, gender, age, date_of_birth, place_of_birth, citizenship, marital_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array($first_name, $middle_name, $last_name, $email, $present_address, $contact_no, $city, $state, $postal_code, $country, $gender, $age, $birth_date, $birth_place, $citizenship, $civil_status));

	$applicant_id = $con->lastInsertId();

	$qry = $con->myQuery("INSERT INTO tbl_applicant (applicant_id, application_number, application_status_id, position_applied, desired_monthly_salary, date_available_for_work, date_applied) VALUES (?, ?, ?, ?, ?, ?, ?)", array($applicant_id, $application_number, 1, $position_applied, 0, $date_available_for_work, $date_today));

	//for($count = 0; $count<count($_POST['hidden_school_name']); $count++) {
		/*$data = array(
			':applicant_id'	=> $applicant_id,
			':education_level'	=>	$_POST['hidden_education_type'][$count],
			':school_name'	=>	$_POST['hidden_school_name'][$count],
			':school_address'	=>	$_POST['hidden_school_address'][$count],
			':school_year_attended_from'	=>	$_POST['hidden_school_year_attended_from'][$count],
			':school_year_attended_to'	=>	$_POST['hidden_school_year_attended_to'][$count]
		);*/

		$d_data = $_POST['value'];
        $ctr = sizeof($d_data);

        $row =0;
        while($row<$ctr){
            $data = array(
			'applicant_id'	=> $applicant_id,
			'education_level'	=>	$d_data[$row][0],
			'school_name'	=>	$d_data[$row][1],
			'school_address'	=>	$d_data[$row][2],
			'school_year_attended_from'	=>	$d_data[$row][3],
			'school_year_attended_to'	=>	$d_data[$row][4]
		    );

            $con->myQuery("INSERT INTO tbl_applicant_education(applicant_id, education_level_id, school_name, school_address, school_year_attended_from, school_year_attended_to) VALUES (:applicant_id, (SELECT id FROM tbl_education_level WHERE education_type = :education_level), :school_name, :school_address, :school_year_attended_from, :school_year_attended_to)", $data);
        $row++;
        }

        $work_data = $_POST['workvalue'];
        $workctr = sizeof($work_data);
        $row =0;

        while($row<$workctr){

            $con->myQuery("Insert INTO tbl_applicant_work_experience(applicant_id,company_name,date_range_from,date_range_to,is_present,company_address,nature_of_work,monthly_salary,reason_for_leaving) values ('".$applicant_id."','".$work_data[$row][0]."','".$work_data[$row][2]."','".$work_data[$row][3]."','1','".$work_data[$row][1]."','".$work_data[$row][4]."','".$work_data[$row][5]."','".$work_data[$row][6]."')");
            $row++;
        }





	//}

	for($count = 0; $count<count($_POST['hidden_employer_name']); $count++) {
		$data = array(
			':employer_name'	=>	$_POST['hidden_employer_name'][$count]
			// ':school_address'	=>	$_POST['hidden_school_address'][$count],
			// ':school_year'	=>	$_POST['hidden_school_year'][$count],
			// ':desired_salary'	=>	$_POST['hidden_education_type'][$count]
		);

		$con->myQuery("INSERT INTO tbl_sample(email) VALUES (:employer_name)",$data);

		//$con->myQuery("INSERT INTO tbl_sample(email, first_name, last_name, desired_salary) VALUES (:school_name, :school_address, :school_year, (SELECT id FROM tbl_education_level WHERE education_type = :desired_salary))",$data);
	}
              Alert("Submit succesful", "success");

              redirect("template.php");


?>
