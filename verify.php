<?php
require_once("support/config.php");


try{
    // echo "<pre>";
    // print_r($_GET);

    // echo "</pre>";


    if(!isset($_GET['email']) || !isset($_GET['token']))
    {
        header("Location: index.php");
    }else{


        $email = $_GET['email'];
        $token = $_GET['token'];


            echo "<pre>";
            print_r($_GET);
            printr($update);
            echo "</pre>";

        // $query = "SELECT user_type FROM applicant_users WHERE email='$email' ";
        // $result = mysqli_query($con,$query);
        $query=("SELECT id FROM users WHERE email='$email' AND token='$token' AND user_type=0");
        $result= mysqli_query($con,$query);



        if($result->num_rows == 0){
            // $updateQuery = "UPDATE applicant_users SET user_type = 3 WHERE email = '$email' ";
            // // UPDATE applicant_users SET user_type = 3 WHERE email = 'carlmprosales@gmail.com'
            // $update = mysqli_query($con,$updateQuery);

            $updateQuery=("UPDATE users SET user_type_id=3 WHERE users.id=id");
            $update = mysqli_query($con,$updateQuery);
            // redirect();
            echo "<pre>";
            printr($updateQuery);
            printr($update);
            echo "</pre>";
            if($update)
                 echo "Your account is verified.";
            }
            else{
                echo "This account is invalid or already verified.";

        }
    }
}
catch (Exception $e) {
        $con->rollback();
                error_logs('User', $e);
        echo "<pre>";
        print_r($e);
        echo "</pre>";
    }

