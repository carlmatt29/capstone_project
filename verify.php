<?php
require_once("support/config.php");
if(isset($_GET['token']))
{
    $token = $_GET['token'];

    $result = $con->query("SELECT user_type_id,token FROM users WHERE user_type_id = 0 AND token = '$token' LIMIT 1");

    if ($result->num_rows == 0) {
        $update = $con->query("UPDATE users SET user_type_id = 3 WHERE token='$token' LIMIT 1");
        if ($update) {
            echo "Your account has been verified";

        }
        else{
            echo $con->error;
        }
    }
    else{
        echo "The account invalid or already verified";
    }
}
else{
    die("Something went wrong");
}

 ?>
