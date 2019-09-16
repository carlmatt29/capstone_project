<?php
    require_once("support/config.php");
    $appid = $_POST['applicant_id'];
    ini_set("display_error",1);
//  $applicant = $con->myQuery("SELECT * from tbl_applicant ta join job_title tp on ta.position_applied = tp.id where ta.id='".$appid."'")->fetch(PDO::FETCH_ASSOC);
    $applicant = $con->myQuery("SELECT * from tbl_applicant ta join job_title tp on ta.position_applied = tp.id where ta.applicant_id='".$appid."'")->fetch(PDO::FETCH_ASSOC); // CHANGED : 4/30/2019 : Marckus
    $applicant_char = $con->myQuery("SELECT * from tbl_applicant_character_reference where id='".$appid."'")->fetch(PDO::FETCH_ASSOC);
    /*$applicant_education = $con->myQuery("SELECT *FROM tbl_applicant_education tae join tbl_education_level tel on tae.education_level_id = tel.id  where tae.applicant_id='".$applicant['applicant_id']."'")->fetch(PDO::FETCH_ASSOC);*/
    
    $applicant_education =$con->myQuery("SELECT *from tbl_applicant_education ta Inner join tbl_education_level te on ta.education_level_id = te.id where ta.applicant_id='".$applicant['applicant_id']."'");
    $applicant_profile = $con->myQuery("SELECT *FROM tbl_applicant_profile tap  where tap.id='".$applicant['applicant_id']."'")->fetch(PDO::FETCH_ASSOC);
    
    $applicant_work_exp = $con->myQuery("SELECT *from tbl_applicant_work_experience where applicant_id = '".$applicant['applicant_id']."'");
    makeHead("Applicant");
    // print_r($applicant);
    // echo "<pre>";
    // print_r($applicant_char);
    // echo "<pre>";
    // print_r($applicant_education);
    // echo "<pre>";
    // print_r($applicant_profile);
    // echo "<pre>";
    // print_r($applicant_work_exp);
    // echo "<pre>";
    // print_r($appid);

    // die();

?>
<?php
    require_once("template/header.php");
    require_once("template/sidebar.php");
?>

<div class="content-wrapper">
    <section class="content-header">
        <a href='view_applicant.php?id=<?php echo $appid; ?>' class='btn btn-default'><span class='glyphicon glyphicon-arrow-left'></span> Back</a>
    
    </section>

    <section class="content">
        <div class="box box-warning">
          <div class="box-body">
            <h3>Personal Info:</h3>
            <div class="row">
                <div class="form-group; col-lg-6" style="margin: 8px 0">
                    <label>Last Name</label>
                    <input type="text" value="<?php echo $applicant_profile['last_name']; ?>" class="form-control" name="last_name" disabled>
                </div>
                <div class="form-group; col-lg-6" style="margin: 8px 0">
                    <label>First Name</label>
                    <input type="text" value="<?php echo $applicant_profile['first_name']; ?>"  class="form-control" name="first_name" disabled>
                </div>
            </div>
            <div class="row">
                <div class="form-group; col-lg-6" style="margin: 8px 0">
                    <label>Middle Name</label>
                    <input type="text" value="<?php echo $applicant_profile['middle_name']; ?>" class="form-control" name="middle_name" disabled>
                </div>
                <div class="form-group; col-lg-6" style="margin: 8px 0">
                    <label>Other Name or Alias</label>
                    <input type="text" class="form-control" name="alias" disabled>
                </div>
            </div>
            <div class="row">
                <div class="form-group; col-lg-8" style="margin: 8px 0">
                    <label>Present Address</label>
                    <input type="text" value="<?php echo $applicant_profile['present_address']; ?>" class="form-control" name="present_address" disabled>
                </div>
                <div class="form-group; col-lg-4" style="margin: 8px 0">
                    <label>City</label>
                    <input type="text" value="<?php echo $applicant_profile['city']; ?>" class="form-control" name="city" disabled>
                </div>
            </div>
            <div class="row">
                <div class="form-group; col-lg-4" style="margin: 8px 0">
                    <label>State / Province / Region</label>
                    <input type="text" value="<?php echo $applicant_profile['state_province_region']; ?>" class="form-control" name="state" disabled>
                </div>
                <div class="form-group; col-lg-4" style="margin: 8px 0">
                    <label>Country</label>
                    <input type="text" value="<?php echo $applicant_profile['country']; ?>" class="form-control" name="country" disabled>
                </div>
                
                <div class="form-group; col-lg-4" style="margin: 8px 0">
                    <label>Postal/Zip Code</label>
                    <input type="text" value="<?php echo $applicant_profile['postal_code']; ?>" class="form-control" name="postal" disabled>
                </div>
            </div>
            
            <div class="row">
                <div class="form-group; col-lg-2" style="margin: 8px 0">
                    <label>Gender</label>
                    <input type="text" value="<?php echo $applicant_profile['gender']; ?>" class="form-control" name="gender" disabled>
                </div>
                <div class="form-group; col-lg-2" style="margin: 8px 0">
                    <label>Age</label>
                    <input type="text" value="<?php echo $applicant_profile['age']; ?>" class="form-control" name="age" disabled>
                </div>
                <div class="form-group col-lg-4" style="margin: 8px 0">
                    <label>Date of Birth</label>
                    <input type="text" value="<?php echo $applicant_profile['date_of_birth']; ?>" class="form-control" name="bday" disabled>
                </div>
                <div class="form-group col-lg-4" style="margin: 8px 0">
                    <label>Place of Birth</label>
                    <input type="text" value="<?php echo $applicant_profile['place_of_birth']; ?>" class="form-control" name="placeofbirth" disabled>
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-lg-4" style="margin: 8px 0">
                    <label>Citizenship</label>
                    <input type="text" value="<?php echo $applicant_profile['citizenship']; ?>" class="form-control" name="citizenship" disabled>
                </div>
                <div class="form-group col-lg-4" style="margin: 8px 0">
                    <label>Status</label>
                    <input type="text" value="<?php echo $applicant_profile['marital_status']; ?>" class="form-control" name="marital_status" disabled>
                </div>
            </div>
            
          </div>
        </div><br>
        <div class="box box-warning">
          <div class="box-body">
            <div class="row">
                <div class="form-group; col-lg-4" style="margin: 8px 0">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" value="<?php echo $applicant_profile['email']; ?>" disabled>
                </div>
                <div class="form-group; col-lg-4" style="margin: 8px 0">
                    <label>Contact No.</label>
                    <input type="text" class="form-control" name="contact_no" value="<?php echo $applicant_profile['contact_number']; ?>" disabled>
                </div>
                <div class="form-group; col-lg-4" style="margin: 8px 0">
                    <label>Position</label>
                    <input type="text" class="form-control" name="position" value="<?php echo $applicant['description']; ?>" disabled>
                </div>
            </div>
            
            <div class="row">
                <div class="form-group; col-lg-4" style="margin: 8px 0">
                    <label>Monthly Salary Desired</label>
                    <input type="number" class="form-control" name="desired_monthly_salary" value = "<?php echo $applicant['desired_monthly_salary'];  ?>" disabled>
                </div>
                <div class="form-group; col-lg-4" style="margin: 8px 0">
                    <label>Date Available for Work</label>
                    <input type="text" class="form-control" name="date_available_for_work" value="<?php echo $applicant['date_available_for_work']; ?>" disabled>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="box box-warning">
                    <h2>EDUCATIONAL ATTAINMENT</h2>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-stiped table-bordered" id="user_data">
                                <tr class="bg-primary">
                                    <th>Education Level</th>
                                    <th>School Name</th>
                                    <th>Address</th>
                                    <th>School Year From</th>
                                    <th>School Year To</th>
                                </tr>
                                <tbody>
                                    <?php while($row = $applicant_education->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['education_type']; ?></td>
                                        <td><?php echo $row['school_name']; ?></td>
                                        <td><?php echo $row['school_address']; ?></td>
                                        <td><?php echo $row['school_year_attended_from']; ?></td>
                                        <td><?php echo $row['school_year_attended_to']; ?></td>
                                    </tr>
                                    <?php 
                                    } ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="box box-warning">
                    <h2>Work Experience</h2>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-stiped table-bordered" id="work_experience">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>Name of Employer</th>
                                        <th>Address of Employer</th>
                                        <th>Date From</th>
                                        <th>Date To</th>
                                        <th>Nature of Work</th>
                                        <th>Monthly Salary</th>
                                        <th>Reason for Leaving</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = $applicant_work_exp->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <tr>
                                        <td><?php echo $row['company_name']; ?></td>
                                        <td><?php echo $row['company_address']; ?></td>
                                        <td><?php echo $row['date_range_from']; ?></td>
                                        <td><?php echo $row['date_range_to']; ?></td>
                                        <td><?php echo $row['nature_of_work']; ?></td>
                                        <td><?php echo $row['monthly_salary']; ?></td>
                                        <td><?php echo $row['reason_for_leaving']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </section>
</div>

<?php
    Modal();
    makeFoot();
?>
