<aside class="main-sidebar bg-LightGray ">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <?php if (AllowUser(array(3))): ?>
            
                 <!--david-->
                <li>
                    <a href="application_form.php">
                        <i class="fa fa-edit"></i> <span>Application Form</span>
                    </a>
                </li>
                <!--david -->     
            <?php endif; ?>

            
            <?php if (AllowUser(array(2, 4))): ?>
                <li>
                    <a href="recruitment.php">
                        <i class="fa fa-users"></i> <span>Applicant</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (AllowUser(array(2, 4))): ?>
                <li>
                    <a href="job_title.php">
                        <i class="fa fa-check-square-o"></i> <span>Job Title</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (AllowUser(array(4))): ?>
                <li>
                    <a href="employees.php">
                        <i class="fa fa-users"></i> <span>Employees</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (AllowUser(array(2,3,4))): ?>
                <li>
                    <a href="my_info.php">
                        <i class="fa fa-users"></i> <span>My Profile</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (AllowUser(array(4))): ?>
                <li>
                    <a href="users.php">
                        <i class="fa fa-user"></i> <span>Users</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (AllowUser(array(4))): ?>
                <li>
                    <a href="audit_log.php">
                        <i class="fa fa-list"></i> <span>Audit Log</span>
                    </a>
                </li>
            <?php endif; ?>
            
            <!-- Ticketing start -->
            
        </ul>
    </section>
<!-- /.sidebar -->
</aside>
<script type="text/javascript">
  

</script>