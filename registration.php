<?php
    require_once("support/config.php");
    if(!empty($_GET['id'])){
    $user = $con->myQuery(  "SELECT id,username,password,is_active,last_activity,user_type_id,password_question,password_answer FROM users
        WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);

    $e_id = $con->myQuery("SELECT employees.id as employee_id FROM employees INNER JOIN users ON employees.id=users.`employee_id` WHERE users.id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
    
    $employees=$con->myQuery("SELECT id as employee_id,
        CONCAT(last_name,', ',first_name,' ', middle_name) as `name` FROM employees
        WHERE is_deleted ='0'")->fetchAll(PDO::FETCH_ASSOC);
} else {
    $employees=$con->myQuery("SELECT id as employee_id,CONCAT(last_name,', ',first_name,' ', middle_name) as name FROM employees e WHERE is_deleted=0 and is_terminated=0 AND id NOT IN(SELECT employee_id FROM users WHERE is_deleted=0 AND employee_id=e.id)")->fetchAll(PDO::FETCH_ASSOC); 
}
    $user_types = $con->myQuery("SELECT id, description FROM user_type")->fetchAll(PDO::FETCH_ASSOC);

    makeHead("User Access");
    
    
?>
<style>
    /* The switch - the box around the slider */
    .switch {
    position: relative;
    display: inline-block;
    width: 54px;
    height: 30px;
    }

    /* Hide default HTML checkbox */
    .switch input {display:none;}

    /* The slider */
    .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    }

    .slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    }

    input:checked + .slider {
    background-color: #0073b7;
    }

    input:focus + .slider {
    box-shadow: 0 0 1px #f42a1f;
    }

    input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
    border-radius: 34px;
    }

    .slider.round:before {
    border-radius: 50%;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1> User Form </h1>
    </section>
    
    <section class="content">
         <div class="row">          <div class='col-md-10 col-md-offset-1'>
                <?php Alert(); ?>
                <div class="box box-warning">
                    <div class = "box-body">
                        <div class ="row form-horizontal">
                            <div class="col-md-5">
                                <div class='form-group'>
                                    <label  style="text-align: left;" class = 'control-label col-sm-3'>Employee <span class='text-red'>*</span></label>
                                    <div class="col-sm-8">
                                        <select data-employeeid="<?php if(!empty($_GET['id'])){
                                        echo $_GET['id'];
                                        }else{
                                        echo "";
                                        } ?>" <?php if(!empty($_GET['id'])){ echo 'disabled';} ?> class='form-control cbo' name='employee_id' onchange='set_user_name()' id='employee_id' data-placeholder="Select Employee" data-allow-clear="true" <?php echo !(empty($_GET))?"data-selected='".$e_id['employee_id']."'":NULL ?> style='width:100%'>

                                            <?php echo makeOptions($employees, "Select Employee") ?>
                                        </select>
                                    </div>
                                </div>
                            </div> q
                            <div class = "col-md-5 offset-md 2">
                                <div class='form-group'>
                                    <label   class = 'control-label col-sm-3' style="text-align: left;" > User Type <span class='text-red'>*</span></label>
                                    <div class="col-sm-8">
                                        <select class='form-control cbo' name='user_type_id' onchange='loadSelect()' id='user_type_id' data-placeholder="Select User Type" data-allow-clear="true" <?php echo !(empty($user))?"data-selected='".$user['user_type_id']."'":NULL ?> style='width:100%'>
                                            <?php echo makeOptions($user_types) ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row form-horizontal">
                            <div class="col-md-5">
                                <div class='form-group'>
                                    <label  style="text-align: left;" class = 'control-label col-sm-3'>Username <span class='text-red'>*</span></label>
                                    <div class="col-sm-8">
                                        <input onkeypress='passMe()' onkeyup='passMe()' type="text" class="form-control" id="username" placeholder="Username" name='username' onblur ='passMe()' value='<?php echo !empty($user)?htmlspecialchars($user['username']):''; ?>' required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class = "col-md-5 offset-md 2">
                                <div class='form-group'>
                                    <label   class = 'control-label col-sm-3' style="text-align: left;" > Password <span class='text-red'>*</span></label>
                                    <div class="col-sm-8">
                                        <input onkeypress='passMe()' onkeyup='passMe()' type="password" class="form-control" id="password" placeholder="Password" name='password' value='<?php echo !empty($user)?htmlspecialchars(decryptIt($user['password'])):''; ?>' required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row form-horizontal">
                            <div class="col-md-5">
                                <div class='form-group'>
                                    <label  style="text-align: left;" class = 'control-label col-sm-3'>Secret Question <span class='text-red'>*</span></label>
                                    <div class="col-sm-8">
                                        <input onkeypress='passMe()' onkeyup='passMe()' type="text" class="form-control" id="pass_q" placeholder="Secret Question" name='pass_q' value='<?php echo !empty($user)?htmlspecialchars($user['password_question']):''; ?>' required>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-md-5 offset-md 2">
                                <div class='form-group'>
                                    <label  style="text-align: left;" class = 'control-label col-sm-3'> Confirm Password <span class='text-red'>*</span></label>
                                    <div class="col-sm-8">
                                        <input onkeypress='passMe()' onkeyup='passMe()' type="password" class="form-control" id="con_password" placeholder="Confirm Password" name='con_password' value='<?php echo !empty($user)?htmlspecialchars(decryptIt($user['password'])):''; ?>' required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row form-horizontal">
                            <div class="col-md-5">
                                <div class='form-group'>
                                    <label  style="text-align: left;" class = 'control-label col-sm-3'>Answer <span class='text-red'>*</span></label>
                                    <div class="col-sm-8">
                                        <input onkeypress='passMe()' onkeyup='passMe()' type="text" class="form-control" id="pass_a" placeholder="Answer" name='pass_a' value='<?php echo !empty($user)?htmlspecialchars($user['password_answer']):''; ?>' required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
    
                        <div class="box-footer no-padding">
                                <form class='form-horizontal formForUsers disable-submit' id="formForUsers1" method='POST' action='save_users.php'>
                                    <input type='hidden' id='user_id' name='user_id' value='<?php echo !empty($user)?$user['id']:''; ?>'  />
                                    <input type='hidden' id='emp_id' name='emp_id' value='<?php echo !empty($e_id)?$e_id['employee_id']:''; ?>'  />
                                    <input type='hidden' id='user_type_id' name='user_type_id' value='<?php echo !empty($user)?$user['user_type_id']:''; ?>'  />
                                    <input type='hidden' id='username' name='username' value='<?php echo !empty($user)?$user['username']:''; ?>'  />
                                    <input type='hidden' id='password' name='password' value='<?php echo !empty($user)?$user['password']:''; ?>'  />
                                    <input type='hidden' id='con_password' name='con_password' value='<?php echo !empty($user)?$user['password']:''; ?>'  />
                                    <input type='hidden' id='pass_q' name='pass_q' value='<?php echo !empty($user)?$user['password_question']:''; ?>'  />
                                    <input type='hidden' id='pass_a' name='pass_a' value='<?php echo !empty($user)?$user['password_answer']:''; ?>'  />
                                    <input type='hidden' id='s_type' name='s_type' value='<?php echo 'hris'; ?>'  />
                                    
                                    
                                    <div class = "col-md-12">
                                            <br>
                                        <div class='form-group pull-right' style="padding-right:10px;">
                                            <button title='Save user' type="submit" class='btn btn-success'><span class='fa fa-save'>
                                            </span>  Save</button>
                                            <a  title="Cancel" class="btn btn-default " href="users.php"> Cancel </a>
                                        </div>
                                    </div>
                                </form>
                            
                        </div>

                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function() 
    {
      
        $("#formForUsers1").submit(function(e)
        {
            $('input, select' ).removeClass('inputTxtError');
            $('label.errorText').remove();
            submitter = true;
        
            if ($("#employee_id").val() ==""){
                submitter=false;
                //alert("Please select employee id.");
                var msg = '<label class= "errorText" for="employee_id">Employee is empty.</label>';
                $('select[name="employee_id"]').addClass('inputTxtError').after(msg);
                $('select[name="employee_id"]').focus();
            }
            if ($("#username").val() ==""){
                submitter=false;
                var msg = '<label class= "errorText" for="username">Username is empty.</label>';
                $('input[name="username"]').addClass('inputTxtError').after(msg);
                $('input[name="username"]').focus();

            }
            if(/^[a-zA-Z0-9- _]*$/.test($("#username").val()) == false) {
               submitter=false;
                var msg = '<label class= "errorText" for="username">Username has special characters.</label>';
                $('input[name="username"]').addClass('inputTxtError').after(msg);
                $('input[name="username"]').focus();
            }
            if(submitter==false){
                $('input[name=""]').focus();
                e.preventDefault();
                return false;
            }
            
            $("#username").val($("#username").val());
        });
        $("#formForUsers2").submit(function(e)
        {
            $('input, select' ).removeClass('inputTxtError');
            $('label.errorText').remove();
            submitter = true;
        
            if ($("#employee_id").val() ==""){
                submitter=false;
                //alert("Please select employee id.");
                var msg = '<label class= "errorText" for="employee_id">Employee is empty.</label>';
                $('select[name="employee_id"]').addClass('inputTxtError').after(msg);
                $('select[name="employee_id"]').focus();
            }
            if ($("#username").val() ==""){
                submitter=false;
                var msg = '<label class= "errorText" for="username">Username is empty.</label>';
                $('input[name="username"]').addClass('inputTxtError').after(msg);
                $('input[name="username"]').focus();

            }
            if(/^[a-zA-Z0-9- _]*$/.test($("#username").val()) == false) {
               submitter=false;
                var msg = '<label class= "errorText" for="username">Username has special characters.</label>';
                $('input[name="username"]').addClass('inputTxtError').after(msg);
                $('input[name="username"]').focus();
            }
            if(submitter==false){
                $('input[name=""]').focus();
                e.preventDefault();
                return false;
            }
            
            $("#username").val($("#username").val());
        });
        $("#formForUsers3").submit(function(e)
        {
            $('input, select' ).removeClass('inputTxtError');
            $('label.errorText').remove();
            submitter = true;
        
            if ($("#employee_id").val() ==""){
                submitter=false;
                //alert("Please select employee id.");
                var msg = '<label class= "errorText" for="employee_id">Employee is empty.</label>';
                $('select[name="employee_id"]').addClass('inputTxtError').after(msg);
                $('select[name="employee_id"]').focus();
            }
            if ($("#username").val() ==""){
                submitter=false;
                var msg = '<label class= "errorText" for="username">Username is empty.</label>';
                $('input[name="username"]').addClass('inputTxtError').after(msg);
                $('input[name="username"]').focus();

            }
            if(/^[a-zA-Z0-9- _]*$/.test($("#username").val()) == false) {
               submitter=false;
                var msg = '<label class= "errorText" for="username">Username has special characters.</label>';
                $('input[name="username"]').addClass('inputTxtError').after(msg);
                $('input[name="username"]').focus();
            }
            if(submitter==false){
                $('input[name=""]').focus();
                e.preventDefault();
                return false;
            }
            
            $("#username").val($("#username").val());
        });//david  end May 5 2019
    });
</script>
 
<script>
    function set_user_name() 
    {
        var employee_name = $("select[name='employee_id'] :selected").text();
        var arr = new Array();
        arr = employee_name.split(",");
        var username=arr[0] + "_" +Math.floor(Math.random()*999);
        // $("input[name='username']").val(user_name);
        // $("input[name='user_name']").val(user_name);
        
        // if(employee_name==""){
        //  // $("input[name='username']").val("");
        //  // $("input[name='password']").val(password);
        //  $("input[name='username']").val(username);
        //  $("input[name='username']").val(username);
  //       }else{

  //       }
    }

    function passMe()
    {
        var username = document.getElementById('username');
        $("input[name='username']").val(username.value);
        var password = document.getElementById('password');
        $("input[name='password']").val(password.value);
        var con_password = document.getElementById('con_password');
        $("input[name='con_password']").val(con_password.value);
        var pass_q = document.getElementById('pass_q');
        $("input[name='pass_q']").val(pass_q.value);
        var pass_a = document.getElementById('pass_a');
        $("input[name='pass_a']").val(pass_a.value);
    }

    function loadSelect()
    {
        var user_type_id = document.getElementById('user_type_id');
        var employee_id = document.getElementById('employee_id');
        var emp_id = document.getElementById('emp_id');
        var user_type_id = document.getElementById('user_type_id');
        emp_id.value = employee_id.value;
        emp_id.value = employee_id.value;
        $("input[name='user_type_id']").val(user_type_id.value);
        $("input[name='emp_id']").val(emp_id.value);
        
        var datavalue = $("#employee_id").data('employeeid'); //checks if the frmuser is for updating or add new user
        var typeid = $(user_type_id).val() //send to ajaxrequest
        if(datavalue!=""){
            
        }
        else if(datavalue==""){
            $.ajax({
               type:"POST",
               url:"ajax/checkboxtoggle.php",
               data:{typeid},
               success:function(response){
                   if(typeid==1||typeid==2){
                   
                       document.getElementById('t_body').innerHTML = response;
                   }
                   else if(typeid==3){
                       document.getElementById('t_body2').innerHTML = response;
                   }
                   else if(typeid==4){
                       document.getElementById('t_body3').innerHTML = response;
                   }
                   
               }
            });
        }
        if($(user_type_id).val() == '')
        {
            $( "#hris").fadeOut("fast");
            $( "#payroll").fadeOut("fast");
            $( "#hcms").fadeOut("fast");
            $( "#payroll_with_attendance").fadeOut("fast");
            return;
        }

        if($(user_type_id).val() == '1' || $(user_type_id).val() == '2')
        {
            $( "#hris").fadeIn("fast");
            $( "#payroll").hide();
            $( "#hcms").hide();
            $( "#payroll_with_attendance").hide();

            return;
        }else{
            $( "#hris").hide();

        }

        if($(user_type_id).val() == '3')
        {
            // $( "#payroll").fadeIn("fast");
            $( "#payroll_with_attendance").fadeIn("fast");
            $( "#hris").hide();
            $( "#hcms").hide();
            return;
        }else{
            // $( "#payroll").hide();
            $( "#payroll_with_attendance").hide();
        }

        if($(user_type_id).val() == '4')
        {
            $( "#hcms").fadeIn("fast");
            $( "#hris").hide();
            $( "#payroll").hide();
            $( "#payroll_with_attendance").hide();
            return;
        }else{
            $( "#hcms").hide();
            // $( "#payroll").hide();
        }
    
    }
</script>

<script type="text/javascript">
    $("tbody tr td input").on('change', function(e)
    {
        var $row = $(this).closest("tr");
        $tds = $row.find("td");
        $inpt= $tds.find('input');

        if($inpt.prop('checked')==true){
            $tds.removeClass('inactive');
            $tds.addClass('highlighted');
        }else{
            $tds.removeClass('highlighted');
            $tds.addClass('inactive');
        }

    });
    
    $('.checkthis').click (function () {
        var checkedStatus = this.checked;
        $.each($("tbody tr td .switch input"),function(){           
             $(this).prop('checked', checkedStatus);        
                        
        });
    });
</script>

<?php
    makeFoot();
?>
