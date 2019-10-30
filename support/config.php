<?php
session_start();

date_default_timezone_set('America/New_York');//david changed the timezone from Asia manila to this june 18 2019

define("WEBAPP", 'JMS STAFFING SOLUTIONS, INC.');
define("DATE_FORMAT_PHP", "m/d/Y");
define("DATE_FORMAT_SQL", "%m/%d/%Y");
define("TIME_FORMAT_SQL", "%h:%i %p");
define("TIME_FORMAT_PHP", "h:i A");
    //$_SESSION[WEBAPP]=array();
    // function __autoload($class)
    // {
    //  require_once 'class.'.$class.'.php';
    // }
ini_set("display_errors", 0);
ini_set("log_errors", 1);


/* for error logs */
function error_logs($module,$error){
    global $con;

    $date = new DateTime();
    $error_date=date_format($date, 'Y-m-d');
    $error_time=date_format($date, 'h:i:s');

    $con->myQuery("INSERT INTO error_logs(error_date,error_time,module,error_message) VALUES(?,?,?,?)",array($error_date,$error_time,$module,$error));
}


# TRIXIA

# TRIXIA

function redirect($url)
{
    header("location:".$url);
}

// ENCRYPTOR
function encryptIt($q)
{
    //edited by david
    $cryptKey  = 'JPB0rGtIn5UB1xG03efyCp';
    $qEncoded      =
    base64_encode(openssl_encrypt($q, 'AES-256-CBC',$cryptKey, OPENSSL_RAW_DATA));

    //(old deprecated dont use the code below:)
    /*$cryptKey  = 'JPB0rGtIn5UB1xG03efyCp';
    $qEncoded      = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));*/
    return($qEncoded);
}


function decryptIt($q)
{
    //edited by david
    $cryptKey  = 'JPB0rGtIn5UB1xG03efyCp';
    $qDecoded      = openssl_decrypt(base64_decode($q),'AES-256-CBC',$cryptKey,OPENSSL_RAW_DATA);

    //(old deprecated dont use the code below:)
   /* $cryptKey  = 'JPB0rGtIn5UB1xG03efyCp';
    $qDecoded      = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");*/
    return($qDecoded);
}
//End Encryptor
/* User FUNCTIONS */
function isLoggedIn()
{
    if (empty($_SESSION[WEBAPP]['user'])) {
        return false;
    } else {
        return true;
    }
}
function toLogin($url=null)
{
    if (empty($url)) {
            //Alert('Please Log in to Continue');

        if(substr(getcwd(), strrpos(getcwd(),"/")+1)=="payroll"){
            header("location: frmlogin.php");
        } else {
            header("location: frmlogin.php");
        }
    } else {
        header("location: ".$url);
    }
}
function Login($user)
{
    $_SESSION[WEBAPP]['user']=$user;
}


/* End User FUnctions */
//HTML Helpers
function makeHead($pageTitle=WEBAPP, $level=0)
{
    require_once str_repeat('../', $level).'template/head.php';
    unset($pageTitle);
}
function makeFoot($pageTitle=WEBAPP,$level=0)
{
    global $request_type;
    require_once str_repeat('../', $level).'template/foot.php';
    unset($pageTitle);
}

function makeOptions($array, $placeholder="", $val=null, $disable="", $checked_value=null)
{
    $options="";
        // if(!empty($placeholder)){
    $options.="<option value='{$val}'>{$placeholder}</option>";
        // }
    foreach ($array as $row) {
        list($value, $display) = array_values($row);
        if ($checked_value!=null && $checked_value==$value) {
            $options.="<option value='".htmlspecialchars($value)."' checked $disable>".htmlspecialchars($display)."</option>";
        } else {
            $options.="<option value='".htmlspecialchars($value)."' $disable>".htmlspecialchars($display)."</option>";
        }
    }
    return $options;
}

//END HTML Helpers
/* BOOTSTRAP Helpers */
function Modal($content=null, $title="Alert")
{
    if (!empty($content)) {
        $_SESSION[WEBAPP]['Modal']=array("Content"=>$content,"Title"=>$title);
    } else {
        if (!empty($_SESSION[WEBAPP]['Modal'])) {
            include_once 'template/modal.php';
            unset($_SESSION[WEBAPP]['Modal']);
        }
    }
}
function Alert($content=null, $type="info")
{
    if (!empty($content)) {
        $_SESSION[WEBAPP]['Alert']=array("Content"=>$content,"Type"=>$type);
    } else {
        if (!empty($_SESSION[WEBAPP]['Alert'])) {
            include_once (substr(getcwd(), strrpos(getcwd(),"/")+1)=="payroll"?"..//":'').'template/alert.php';
            unset($_SESSION[WEBAPP]['Alert']);
        }
    }
}
function createAlert($content='', $type='info')
{
    echo "<div class='alert alert-{$type}' role='alert'>{$content}</div>";
}
/* End BOOTSTRAP Helpers */

/* SPECIFIC TO WEBAPP */
function getDepriciationDate($purchase_date, $terms)
{
    $purchase_date=new DateTime($purchase_date);
    $diff_terms=new DateInterval("P{$terms}M");
    return date_format(date_add($purchase_date, $diff_terms), 'Y-m-d');
}

function AllowUser($user_type_id)
{
    if (array_search($_SESSION[WEBAPP]['user']['user_type'], $user_type_id)!==false) {
        return true;
    }
    return false;
}

function insertAuditLog($user, $action)
{
    #user,action,date
    if (file_exists("./audit_log.txt")) {
        $user=htmlspecialchars($user);
        $action=htmlspecialchars($action);
        $new_input=json_encode(array($user,$action,date('Y-m-d H:i:s')), JSON_PRETTY_PRINT);
        $file = fopen("./audit_log.txt", "r+");
        fseek($file, -4, SEEK_END);
        fwrite($file, ",".$new_input."\n\t]\n}");
        fclose($file);
    } else {
        $file = fopen("./audit_log.txt", "w+");

        $data=json_encode(array("data"=>array(array("NONE","INITIAL START UP",date('Y-m-d H:i:s')))), JSON_PRETTY_PRINT);
        fwrite($file, $data);
        fclose($file);
    }
}


function refresh_activity($user_id)
{
    global $con;
    $con->myQuery("UPDATE users SET last_activity=NOW() WHERE id=?", array($user_id));
}
function is_active($user_id)
{
    global $con;
    $last_activity=$con->myQuery("SELECT last_activity FROM users  WHERE id=?", array($user_id))->fetchColumn();
    $inactive_time=60*10;
    // echo strtotime($last_activity)."<br/>";
    // echo time();
    if (time()-strtotime($last_activity) > $inactive_time) {
        return false;
    }

    return true;
}

function user_is_active($user_id)
{
    global $con;
    $last_activity=$con->myQuery("SELECT is_active FROM users  WHERE id=?", array($user_id))->fetchColumn();
    if (!empty($last_activity)) {
        return true;
    } else {
        return false;
    }
}

function getTimeIn($half_day="")
{
    if ($half_day=="") {
        return "08:30:00";
    } elseif ($half_day=="AM") {
        return "13:00:00";
    }

    return "08:30:00";
}

function getTimeOut()
{
    return "17:30:00";
}

function DisplayDate($unformatted_date)
{
    return date("m/d/Y", strtotime($unformatted_date));
}

function SaveDate($formatted_date)
{
    return date_format(date_create($formatted_date), 'Y-m-d');
}




function get_user_access_id($user_id,$user_access_id)
{
    global $con;
    $uaid= $con->myQuery("SELECT user_id,user_access_id FROM permissions WHERE system_id=1  and user_id=?",array($user_id))->fetch(PDO::FETCH_ASSOC);
    /*Removed from SQL Query "system_id=1  and" - 16Oct2018 6:30AM Jerwin Carlos */
    $uid = explode("," , $uaid['user_access_id']);
    $count_uid=count($uid);
    for($x=0; $x<$count_uid; $x++){
      if($uid[$x]==$user_access_id){
        $val='1';
      }
    }
    return $val;
}




function getDefaultShift($employee, $date)
{

}


function getShift($employee, $date)
{

}



require_once('class.myPDO.php');
$con=new myPDO('db_capstone','root','');

if (isLoggedIn()) {
    if (!user_is_active($_SESSION[WEBAPP]['user']['id'])) {
        refresh_activity($_SESSION[WEBAPP]['user']['id']);
        session_destroy();
        session_start();
        Alert("Your account has been deactivated.", "danger");
     /*   redirect('frmlogin.php');*/
        redirect('index.php');
        die;
    }
    if (is_active($_SESSION[WEBAPP]['user']['id'])) {
        refresh_activity($_SESSION[WEBAPP]['user']['id']);
    } else {

        refresh_activity($_SESSION[WEBAPP]['user']['id']);

    }
}

$con->myQuery("SET time_zone ='-4:00'");
