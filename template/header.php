<?php
require_once("support/config.php");
if (!isLoggedIn()) {
         toLogin();
         die();
}

$date = new DateTime();
$date_now=date_format($date, 'Y-m-d');
$shift=getShift($_SESSION[WEBAPP]['user']['employee_id'], $date->format("Y-m-d"));
$total_time = date("h:i A", strtotime($shift['time_in'])+($shift['grace_minutes']*60));



$total_time = date("h:i A", strtotime($shift['time_in']));
?>
<header class="main-header">

        <!-- Logo -->
        <a href="template.php" class="logo">
            <span class="logo-lg"><b>JMS STAFFING SOLUTIONS</b> INC.</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
       <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <?php if (!empty($late)): ?>
              <li class="dropdown messages-menu" >

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <i class="fa fa-bell-o"></i>
                  <span class="label label-danger">1</span>
                </a>
                 
                    <ul class="dropdown-menu">
                      <li class="header" style='background: #f9f9f9'><h4>Attendance Notification</h4></li>
                     
                        <!-- inner menu: contains the actual data -->
                        <ul class="body">
                          <!-- start message -->
                           
                              <?php 
                              if (!empty($time_in)) {
                              echo "<h4>
                                <b>Time-in</b>
                              </h4>";
                              echo "<p>".$time_in."</p>";
                              if (!empty($late)) {
                                 echo "<h4>
                                <b>Late</b>
                                </h4>";
                                $late_minute = strtotime($time_in)-strtotime($total_time);
                                if (($late_minute/60) >= 60) {
                                  $minute = $late_minute%3600;
                                  echo "<p>".(int)($late_minute/3600)." hour";
                                  if ($minute > 0) {
                                    echo " and ".($minute/60)." minute";

                                  }
                                  echo "</p>";
                                  //echo date("H", $late_minute/3600);
                                } else {
                                   echo ($late_minute/60)." minute/s";
                                }
                                 
                              }

                              echo "<h4>
                                <b>Expected Time-out</b>
                              </h4>";
                              $time = date("h:i A", strtotime($time_in)+32400);
                              //$time = date(, $time);
                              echo "<p>".$time."</p>";
                              }
                              
                              ?>
                              
                          <!-- end message -->
                          
                        </ul> 
                      </li>
                    </ul>

              </li>
              <?php endif; ?>

              <!-- Control Sidebar Toggle Button -->
              <li class="dropdown user user-menu">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php    
                        $today = date("F j, Y l g:i a");
                        //echo $today;
                    ?>
                  <span class="hidden-xs">
                    <?php
                        echo htmlspecialchars("{$_SESSION[WEBAPP]['user']['last_name']}, {$_SESSION[WEBAPP]['user']['first_name']} {$_SESSION[WEBAPP]['user']['middle_name']}")
                      ?>
                  </span>
                    &nbsp;&nbsp;
                  <?php
                    if(empty($_SESSION[WEBAPP]['user']['image'])){
                        if($_SESSION[WEBAPP]['user']['gender']=='Male'){
                          $image="dist/img/user_male.png";
                        }
                        else{
                          $image="dist/img/user_female.png";
                        }
                    }
                    else{
                      $image="employee_images/".$_SESSION[WEBAPP]['user']['image'];
                    }
                  ?>
                  <img src="<?php echo $image;?>" class="user-image pull-right" alt="User Image">
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo $image;?>" class="img-circle" alt="User Image">
                    <p>
                      <?php
                        echo htmlspecialchars("{$_SESSION[WEBAPP]['user']['last_name']}, {$_SESSION[WEBAPP]['user']['first_name']} {$_SESSION[WEBAPP]['user']['middle_name']}")
                      ?>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="user_profile.php" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
