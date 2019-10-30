<?php
require("support/config.php");


try{
    // echo "<pre>";
    // print_r($_GET);

    // echo "</pre>";


    if(!isset($_GET['email']) || !isset($_GET['token']))
    {
        header("Location: index.php");
    }else{


        $email = $con->real_escape_string($_GET['email']);
        $token = $con->real_escape_string($_GET['token']);


            // echo "<pre>";
            // print_r($_GET['email']);
            // echo "</pre>";

        // $query = "SELECT user_type FROM applicant_users WHERE email='$email' ";
        // $result = mysqli_query($con,$query);
        $query=("SELECT id FROM users WHERE email='$email' AND token='token' AND user_type_id=0");
        $result= mysqli_query($con,$query);


        if($result->num_rows==0){
            // $updateQuery = "UPDATE applicant_users SET user_type = 3 WHERE email = '$email' ";
            // // UPDATE applicant_users SET user_type = 3 WHERE email = 'carlmprosales@gmail.com'
            // $update = mysqli_query($con,$updateQuery);

            $updateQuery=("UPDATE users SET user_type_id=3, token='' WHERE email='$email'");
            mysqli_query($con,$updateQuery);
            // redirect();
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

?>
