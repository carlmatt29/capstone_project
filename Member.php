<?php

   require_once 'support/config.php';

class Member
{


    function __construct()
    {
        require_once "DataSource.php";
        $this->ds = new DataSource();
    }

    function validateMember()
    {
        $valid = true;
        $errorMessage = array();
        foreach ($_POST as $key => $value) {
            if (empty($_POST[$key])) {
                $valid = false;
            }
        }
        
        if($valid == true) {
            // Password Matching Validation
            if ($_POST['password'] != $_POST['confirm_password']) {
                $errorMessage[] = 'Passwords should be same.';
                $valid = false;
            }
            
            // Email Validation
            if (! isset($error_message)) {
                if (! filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
                    $errorMessage[] = "Invalid email address.";
                    $valid = false;
                }
            }
            
            // Validation to check if Terms and Conditions are accepted
            if (! isset($error_message)) {
                if (! isset($_POST["terms"])) {
                    $errorMessage[] = "Accept terms and conditions.";
                    $valid = false;
                }
            }
        }
        else {
            $errorMessage[] = "All fields are required.";
        }
        
        if ($valid == false) {
            return $errorMessage;
        }
        return;
    }

    function isMemberExists($username, $email)
    {
        $query = "select * FROM registered_users WHERE user_name = ? OR email = ?";
        $paramType = "ss";
        $paramArray = array($username, $email);
        $memberCount = $this->ds->numRows($query, $paramType, $paramArray);
        
        return $memberCount;
    }

    function insertMemberRecord($username, $displayName, $password, $email)
    {
        $passwordHash = md5($password);
        $query = "INSERT INTO registered_users (userName, firstName,lastName, password, email) VALUES ('$userName','$firstName','$lastName','$password','$email')";
        $paramType = "ss";
        $paramArray = array(
            $userName,
            $firstName,
            $lastName,
            $displayName,
            $passwordHash,
            $email
        );
        $insertId = $this->ds->insert($query, $paramType, $paramArray);
        return $insertId;
    }
}