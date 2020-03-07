<?php
	require_once("support/config.php");
	$appid = $_POST['applicant_id'];


	makeHead("Application Form");
	$education = $con->myQuery("SELECT id,education_type FROM tbl_education_level WHERE id");

?>
<div class="">
	<section class="content">
	    <?php Alert(); ?>
	    <div class="row">
			<div class="col-md-7">
				<div class="box box-warning">
				  <div class="box-body">
				     <div class="row">
						<div class="form-group; col-lg-6" style="margin: 8px 0"> <!-- MOVED : 4/26/2019-->
							<h1>Position Applied For <span style="color: red">*</span></h1>
							<select id="position_applied" class="required form-control cbo" name="position_applied">
								<!-- <option>Select Job you applied for</option> -->
								<?php
									$sql = $con->myQuery("SELECT id, CONCAT(code,' (',company_name,')' ) as code,description FROM job_title WHERE is_deleted=0 and is_available=1 AND id='$_GET[id];'");

									while($row=$sql->fetch(PDO::FETCH_ASSOC)){
										echo "<option data-description ='".htmlspecialchars($row['description'])."'  value='" . $row['id'] . "'>" . $row['code'] . "</option>";
									}
								?>
							</select>

						</div>
						<div class="col-lg-1"><br><br><br><br>
							<a class="btn btn-primary" id="view_job_description" type="button"><i class="fa fa-question"> &nbsp View Job Description</i></a>
						</div>
					</div>

				     </br>
					<h3>Personal Info:</h3>
					<form method="POST" id="user_form" autocomplete="off">
						<div class="row">
							<div class="form-group; col-lg-6" style="margin: 8px 0">
								<label>Last Name<span style="color: red">*</span></label>
								<input type="text" id="last_name"  class="required form-control" name="last_name" required>
							</div>
							<div class="form-group; col-lg-6" style="margin: 8px 0">
								<label>First Name<span style="color: red">*</span></label>
								<input type="text" id="first_name" class="required form-control" name="first_name" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group; col-lg-6" style="margin: 8px 0">
								<label>Middle Name</label>
								<input type="text" id="middle_name" class="form-control" name="middle_name">
							</div>
							<div class="form-group col-lg-6" style="margin: 8px 0">
								<label>Other Name or Alias</label>
								<input type="text" class="form-control" id="alias" name="alias">
							</div>
						</div>
						<div class="row">
							<div class="form-group; col-lg-8" style="margin: 8px 0">
								<label>Present Address<span style="color: red">*</span></label>
								<input type="text" class="required form-control" id="present_address" name="present_address" required>
							</div>
							<div class="form-group; col-lg-4" style="margin: 8px 0">
								<label>City<span style="color: red">*</span></label>
								<input id="city" type="text" class="required form-control" name="city" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group; col-lg-4" style="margin: 8px 0">
								<label>State / Province / Region<span style="color: red">*</span></label>
								<input id="state" type="text" class="required form-control" name="state" required>
							</div>
							<div class="form-group; col-lg-4" style="margin: 8px 0">
								<label>Country <span style="color: red">*</span></label>
								<select id="country" class="required form-control" name="country" required>
									<option value="AF">Afghanistan</option>
									<option value="AL">Albania</option>
									<option value="DZ">Algeria</option>
									<option value="AS">American Samoa</option>
									<option value="AD">Andorra</option>
									<option value="AO">Angola</option>
									<option value="AI">Anguilla</option>
									<option value="AQ">Antarctica</option>
									<option value="AG">Antigua and Barbuda</option>
									<option value="AR">Argentina</option>
									<option value="AM">Armenia</option>
									<option value="AW">Aruba</option>
									<option value="AU">Australia</option>
									<option value="AT">Austria</option>
									<option value="AZ">Azerbaijan</option>
									<option value="BS">Bahamas</option>
									<option value="BH">Bahrain</option>
									<option value="BD">Bangladesh</option>
									<option value="BB">Barbados</option>
									<option value="BY">Belarus</option>
									<option value="BE">Belgium</option>
									<option value="BZ">Belize</option>
									<option value="BJ">Benin</option>
									<option value="BM">Bermuda</option>
									<option value="BT">Bhutan</option>
									<option value="BO">Bolivia</option>
									<option value="BA">Bosnia and Herzegowina</option>
									<option value="BW">Botswana</option>
									<option value="BV">Bouvet Island</option>
									<option value="BR">Brazil</option>
									<option value="IO">British Indian Ocean Territory</option>
									<option value="BN">Brunei Darussalam</option>
									<option value="BG">Bulgaria</option>
									<option value="BF">Burkina Faso</option>
									<option value="BI">Burundi</option>
									<option value="KH">Cambodia</option>
									<option value="CM">Cameroon</option>
									<option value="CA">Canada</option>
									<option value="CV">Cape Verde</option>
									<option value="KY">Cayman Islands</option>
									<option value="CF">Central African Republic</option>
									<option value="TD">Chad</option>
									<option value="CL">Chile</option>
									<option value="CN">China</option>
									<option value="CX">Christmas Island</option>
									<option value="CC">Cocos (Keeling) Islands</option>
									<option value="CO">Colombia</option>
									<option value="KM">Comoros</option>
									<option value="CG">Congo</option>
									<option value="CD">Congo, the Democratic Republic of the</option>
									<option value="CK">Cook Islands</option>
									<option value="CR">Costa Rica</option>
									<option value="CI">Cote d'Ivoire</option>
									<option value="HR">Croatia (Hrvatska)</option>
									<option value="CU">Cuba</option>
									<option value="CY">Cyprus</option>
									<option value="CZ">Czech Republic</option>
									<option value="DK">Denmark</option>
									<option value="DJ">Djibouti</option>
									<option value="DM">Dominica</option>
									<option value="DO">Dominican Republic</option>
									<option value="TP">East Timor</option>
									<option value="EC">Ecuador</option>
									<option value="EG">Egypt</option>
									<option value="SV">El Salvador</option>
									<option value="GQ">Equatorial Guinea</option>
									<option value="ER">Eritrea</option>
									<option value="EE">Estonia</option>
									<option value="ET">Ethiopia</option>
									<option value="FK">Falkland Islands (Malvinas)</option>
									<option value="FO">Faroe Islands</option>
									<option value="FJ">Fiji</option>
									<option value="FI">Finland</option>
									<option value="FR">France</option>
									<option value="FX">France, Metropolitan</option>
									<option value="GF">French Guiana</option>
									<option value="PF">French Polynesia</option>
									<option value="TF">French Southern Territories</option>
									<option value="GA">Gabon</option>
									<option value="GM">Gambia</option>
									<option value="GE">Georgia</option>
									<option value="DE">Germany</option>
									<option value="GH">Ghana</option>
									<option value="GI">Gibraltar</option>
									<option value="GR">Greece</option>
									<option value="GL">Greenland</option>
									<option value="GD">Grenada</option>
									<option value="GP">Guadeloupe</option>
									<option value="GU">Guam</option>
									<option value="GT">Guatemala</option>
									<option value="GN">Guinea</option>
									<option value="GW">Guinea-Bissau</option>
									<option value="GY">Guyana</option>
									<option value="HT">Haiti</option>
									<option value="HM">Heard and Mc Donald Islands</option>
									<option value="VA">Holy See (Vatican City State)</option>
									<option value="HN">Honduras</option>
									<option value="HK">Hong Kong</option>
									<option value="HU">Hungary</option>
									<option value="IS">Iceland</option>
									<option value="IN">India</option>
									<option value="ID">Indonesia</option>
									<option value="IR">Iran (Islamic Republic of)</option>
									<option value="IQ">Iraq</option>
									<option value="IE">Ireland</option>
									<option value="IL">Israel</option>
									<option value="IT">Italy</option>
									<option value="JM">Jamaica</option>
									<option value="JP">Japan</option>
									<option value="JO">Jordan</option>
									<option value="KZ">Kazakhstan</option>
									<option value="KE">Kenya</option>
									<option value="KI">Kiribati</option>
									<option value="KP">Korea, Democratic People's Republic of</option>
									<option value="KR">Korea, Republic of</option>
									<option value="KW">Kuwait</option>
									<option value="KG">Kyrgyzstan</option>
									<option value="LA">Lao People's Democratic Republic</option>
									<option value="LV">Latvia</option>
									<option value="LB">Lebanon</option>
									<option value="LS">Lesotho</option>
									<option value="LR">Liberia</option>
									<option value="LY">Libyan Arab Jamahiriya</option>
									<option value="LI">Liechtenstein</option>
									<option value="LT">Lithuania</option>
									<option value="LU">Luxembourg</option>
									<option value="MO">Macau</option>
									<option value="MK">Macedonia, The Former Yugoslav Republic of</option>
									<option value="MG">Madagascar</option>
									<option value="MW">Malawi</option>
									<option value="MY">Malaysia</option>
									<option value="MV">Maldives</option>
									<option value="ML">Mali</option>
									<option value="MT">Malta</option>
									<option value="MH">Marshall Islands</option>
									<option value="MQ">Martinique</option>
									<option value="MR">Mauritania</option>
									<option value="MU">Mauritius</option>
									<option value="YT">Mayotte</option>
									<option value="MX">Mexico</option>
									<option value="FM">Micronesia, Federated States of</option>
									<option value="MD">Moldova, Republic of</option>
									<option value="MC">Monaco</option>
									<option value="MN">Mongolia</option>
									<option value="MS">Montserrat</option>
									<option value="MA">Morocco</option>
									<option value="MZ">Mozambique</option>
									<option value="MM">Myanmar</option>
									<option value="NA">Namibia</option>
									<option value="NR">Nauru</option>
									<option value="NP">Nepal</option>
									<option value="NL">Netherlands</option>
									<option value="AN">Netherlands Antilles</option>
									<option value="NC">New Caledonia</option>
									<option value="NZ">New Zealand</option>
									<option value="NI">Nicaragua</option>
									<option value="NE">Niger</option>
									<option value="NG">Nigeria</option>
									<option value="NU">Niue</option>
									<option value="NF">Norfolk Island</option>
									<option value="MP">Northern Mariana Islands</option>
									<option value="NO">Norway</option>
									<option value="OM">Oman</option>
									<option value="PK">Pakistan</option>
									<option value="PW">Palau</option>
									<option value="PA">Panama</option>
									<option value="PG">Papua New Guinea</option>
									<option value="PY">Paraguay</option>
									<option value="PE">Peru</option>
									<option value="PH">Philippines</option>
									<option value="PN">Pitcairn</option>
									<option value="PL">Poland</option>
									<option value="PT">Portugal</option>
									<option value="PR">Puerto Rico</option>
									<option value="QA">Qatar</option>
									<option value="RE">Reunion</option>
									<option value="RO">Romania</option>
									<option value="RU">Russian Federation</option>
									<option value="RW">Rwanda</option>
									<option value="KN">Saint Kitts and Nevis</option>
									<option value="LC">Saint LUCIA</option>
									<option value="VC">Saint Vincent and the Grenadines</option>
									<option value="WS">Samoa</option>
									<option value="SM">San Marino</option>
									<option value="ST">Sao Tome and Principe</option>
									<option value="SA">Saudi Arabia</option>
									<option value="SN">Senegal</option>
									<option value="SC">Seychelles</option>
									<option value="SL">Sierra Leone</option>
									<option value="SG">Singapore</option>
									<option value="SK">Slovakia (Slovak Republic)</option>
									<option value="SI">Slovenia</option>
									<option value="SB">Solomon Islands</option>
									<option value="SO">Somalia</option>
									<option value="ZA">South Africa</option>
									<option value="GS">South Georgia and the South Sandwich Islands</option>
									<option value="ES">Spain</option>
									<option value="LK">Sri Lanka</option>
									<option value="SH">St. Helena</option>
									<option value="PM">St. Pierre and Miquelon</option>
									<option value="SD">Sudan</option>
									<option value="SR">Suriname</option>
									<option value="SJ">Svalbard and Jan Mayen Islands</option>
									<option value="SZ">Swaziland</option>
									<option value="SE">Sweden</option>
									<option value="CH">Switzerland</option>
									<option value="SY">Syrian Arab Republic</option>
									<option value="TW">Taiwan, Province of China</option>
									<option value="TJ">Tajikistan</option>
									<option value="TZ">Tanzania, United Republic of</option>
									<option value="TH">Thailand</option>
									<option value="TG">Togo</option>
									<option value="TK">Tokelau</option>
									<option value="TO">Tonga</option>
									<option value="TT">Trinidad and Tobago</option>
									<option value="TN">Tunisia</option>
									<option value="TR">Turkey</option>
									<option value="TM">Turkmenistan</option>
									<option value="TC">Turks and Caicos Islands</option>
									<option value="TV">Tuvalu</option>
									<option value="UG">Uganda</option>
									<option value="UA">Ukraine</option>
									<option value="AE">United Arab Emirates</option>
									<option value="GB">United Kingdom</option>
									<option value="US">United States</option>
									<option value="UM">United States Minor Outlying Islands</option>
									<option value="UY">Uruguay</option>
									<option value="UZ">Uzbekistan</option>
									<option value="VU">Vanuatu</option>
									<option value="VE">Venezuela</option>
									<option value="VN">Viet Nam</option>
									<option value="VG">Virgin Islands (British)</option>
									<option value="VI">Virgin Islands (U.S.)</option>
									<option value="WF">Wallis and Futuna Islands</option>
									<option value="EH">Western Sahara</option>
									<option value="YE">Yemen</option>
									<option value="YU">Yugoslavia</option>
									<option value="ZM">Zambia</option>
									<option value="ZW">Zimbabwe</option>
								</select>
							</div>

							<div class="form-group; col-lg-4" style="margin: 8px 0">
								<label>Postal/Zip Code<span style="color: red">*</span></label>
								<input type="text" id="postal_code" class="required form-control" name="postal_code" required/>
							</div>
						</div>

						<div class="row">
							<div class="form-group; col-lg-2" style="margin: 8px 0">
								<label>Gender</label>
								<select class="required form-control" id="gender" name="gender" required>
									<option value="other">Other</option>
									<option value="female">Female</option>
									<option value="male">Male</option>
								</select>
							</div>
							<div class="form-group col-lg-2" style="margin: 8px 0">
								<label>Age<span style="color: red">*</span></label>
								<input type="text" class="required numeric form-control" name="age" id="age" required>
							</div>
							<div class="form-group col-lg-4" style="margin: 8px 0">
								<label>Date of Birth<span style="color: red">*</span></label>
								<input class="required form-control" type="date" name="birth_date" id="birth_date" required>
							</div>
							<div class="form-group col-lg-4" style="margin: 8px 0">
								<label>Place of Birth<span style="color: red">*</span></label>
								<input type="text" class="required form-control" name="birth_place" id="birth_place" required>
							</div>
						</div>

						<div class="row">
							<div class="form-group col-lg-4" style="margin: 8px 0">
								<label>Citizenship<span style="color: red">*</span></label>
								<input type="text" class="required form-control" name="citizenship" id="citizenship" required>
							</div>
							<div class="form-group col-lg-4" style="margin: 8px 0">
								<label>Status <span style="color: red">*</span></label>
								<select class="required form-control" name="civil_status"  id="civil_status" required>
									<option value="single">Single</option>
									<option value="married">Married</option>
									<option value="divorced">Divorced</option>
									<option value="widowed">Widowed</option>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="form-group; col-lg-4" style="margin: 8px 0">
								<label>Email<span style="color: red">*</span></label>
								<input type="text" class="required form-control" name="email" id="email" required>
							</div>
							<div class="form-group; col-lg-4" style="margin: 8px 0">
								<label>Contact No.<span style="color: red">*</span></label>
								<input type="text" class="required form-control" name="contact_no" id="contact_no" required>
							</div>

						</div>

						<div class="row">
							<!-- <div class="form-group; col-lg-4" style="margin: 8px 0">
								<label>Monthly Salary Desired<span style="color: red">*</span></label>
								<input type="number" class="required form-control" name="desired_monthly_salary" id="desired_monthly_salary" required>
							</div> -->
							<div class="form-group; col-lg-4" style="margin: 8px 0">
								<label><span style="color: red"></span></label>
								<input type="hidden" class="required form-control" name="date_available_for_work" id="date_available_for_work" required>
							</div>
						</div>

					  </div>
					</div><br>
			</div>

			<div class="col-md-5">
			    <div class="row">
    				<div class="box box-warning">
    				    <h2>Character Reference</h2>
    					<div class="box-body">
    					    <div class="text-right">
    					        <a onclick="addrefmodal()" class="btn btn-warning">Add</a>
    					    </div>
    						<div class="table-responsive">
                				<table class="table table-stiped table-bordered" id="reference_data">
                				    <thead>
                    					<tr class="bg-primary">
                    						<th>Reference Name</th>
                    						<th>Reference Contact</th>
                    						<th>Reference Address</th>
                    						<th>Reference Position</th>
                    						<th>Action</th>
                    					</tr>
                					</thead>
                					<tbody>

                					</tbody>
                				</table>
                			</div>
    					</div>
    				</div>
				</div>

				<div class="row"><br>
            	    <div class="box box-warning">
            	        <h2>EDUCATIONAL ATTAINMENT</h2>
            	        <div class="box-body">
            	           <div class="text-right">
                    	    <a onclick="addeducmodal()" class="btn btn-warning">Add</a>
                    	    </div><br>
            	            <div class="table-responsive">
                				<table class="table table-stiped table-bordered" id="user_data">
                				    <thead>
                    					<tr class="bg-primary">
                    						<th>Education Level</th>
                    						<th>School Name</th>
                    						<th>Address</th>
                    						<th>From</th>
                    						<th>To</th>
                    						<th>Action</th>
                    					</tr>
                					</thead>
                					<tbody>

                					</tbody>
                				</table>
                			</div>
            	        </div>
            	    </div>
            	</div>
			</div>
		</div>
        	<section class="content">
        	<div class="row"><br>
        	    <div class="box box-warning">
        	        <h2>Work Experience</h2>
        	        <div class="box-body">
        	           <div class="text-right">
                	    <a onclick="addworkmodal()" class="btn btn-warning">Add</a>
                	    </div><br>
        	            <div class="table-responsive">
            				<table class="table table-stiped table-bordered" id="work_data">
            				    <thead>
                					<tr class="bg-primary">
                						<th>Name of Employer</th>
                						<th>Address of Employer</th>
                						<th>Date From</th>
                						<th>Date To</th>
                						<th>Nature of Work</th>
                						<th>Monthly Salary</th>
                						<th>Reason for Leaving</th>
                						<th>Action</th>
                					</tr>
            					</thead>
            					<tbody>

            					</tbody>
            				</table>
            			</div>
        	        </div>
        	    </div>
        	</div>
        	</section>
        	<div align="center">
				<input type="submit" name="insert" id="insert" class="btn btn-primary" value="Submit" />
				<a type="button" href="template.php" name="back" id="back" class="btn btn-primary">Back</a>
			</div>
    	</form>
	</section>
</div>


<div class="modal fade" id="modaladdeduc" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h1 class="modal-title " id="mod-title">Add Educational Attainment</h1>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<label>Enter Education Level</label>
			<select class="form-control education_type"  name="education_type" id="education_type" required>
				<option>Select Education Level</option>
				<?php
				    while($row = $education->fetch(PDO::FETCH_ASSOC)){
				?>
				    <option data-educ = "<?php echo $row['id'];  ?>"><?php echo $row['education_type']; ?></option>
				<?php
				    }
				?>
			</select>


			<div class="form-group">
    			<label>Enter School Name</label>
    			<input type="text" name="school_name" id="school_name" class=" school_name form-control" />
    			<span id="error_school_name" class="text-danger"></span>
    		</div>
    		<div class="form-group">
    			<label>Enter School Address</label>
    			<input type="text" name="school_address" id="school_address" class="school_address form-control" />
    			<span id="error_school_address" class="text-danger"></span>
    		</div>
    		<div class="row">
    			<div class="form-group col-lg-6">
    				<label>Enter School Year From</label>
    				<input type="text" name="school_year_attended_from" id="school_year_attended_from" class="numeric form-control" />

    			</div>
    			<div class="form-group col-lg-6">
    				<label>Enter School Year To</label>
    				<input type="text" name="school_year_attended_to" id="school_year_attended_to" class="numeric form-control" />
    			</div>
    		</div>
		  </div>

		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" onclick="addeducprocess()" class="btn btn-primary">Add</button>
		  </div>
		</div>
	</div>
</div>


<div class="modal fade" id="modaladdwork" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h1 class="modal-title " id="mod-title">Add Work Experience</h1>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="form-group">
    			<label>Enter Name of Employer </label>
    			<input type="text" name="name_of_employer" id="name_of_employer" class="name_of_employer form-control" />
    		</div>
    		<div class="form-group">
    			<label>Enter Address of Employer</label>
    			<input type="text" name="address_of_employer" id="address_of_employer" class="address_of_employer form-control" />
    		</div>
    		<div class="row">
    			<div class="form-group col-lg-6">
    				<label>Working From</label>
    				<input type="date" name="work_from" id="work_from" class="form-control" />
    			</div>

    			<div class="form-group col-lg-6">
    				<label>Working to</label>
    				<input type="date" name="work_to" id="work_to" class="form-control" />
    			</div>

    			<div class="form-group col-lg-6">
    				<label>Nature of Work</label>
    				<input type="text" name="work_nature" id="work_nature" class="form-control" />
    			</div>

    			<div class="form-group col-lg-6">
    				<label>Work Monthly Salary</label>
    				<input type="text" name="work_salary" id="work_salary" class="numeric form-control" />
    			</div>

    			<div class="form-group col-lg-6">
    				<label>Reasons for leaving</label>
    				<textarea name="reason_for_leaving" id="reason_for_leaving" class="form-control"></textarea>
    			</div>


    		</div>
		  </div>

		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" onclick="addworkprocess()" class="btn btn-primary">Add</button>
		  </div>
		</div>
	</div>
</div>

<div class="modal fade" id="modaladdref" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h1 class="modal-title " id="mod-title">Add Character Reference</h1>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="form-group">
    			<label>Reference Name</label>
    			<input type="text" name="ref_name" id="ref_name" class="ref_name form-control" />
    		</div>
    		<div class="form-group">
    			<label>Reference Contact</label>
    			<input type="text" name="ref_contact" id="ref_contact" class="ref_contact form-control" />
    		</div>

    		<div class="form-group">
    			<label>Reference Address</label>
    			<input type="text" name="ref_address" id="ref_address" class="ref_address form-control" />
    		</div>

    		<div class="form-group">
    			<label>Reference Position</label>
    			<input type="text" name="ref_position" id="ref_position" class="ref_position form-control" />
    		</div>

		  </div>

		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" onclick="addrefmodalprocess()" class="btn btn-primary">Add</button>
		  </div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal_job_description" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Job Description</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <div class="modal-body">
		<textarea  class="form-control" style="height:500px;" id="job_description"></textarea>
	  </div>
	</div>
  </div>
</div>

<?php
	Modal();
	makeFoot();
?>
<script type="text/javascript">
    var tbl_educ = $('#user_data').DataTable( {
    	"bFilter": false,
    	"bInfo":false,
    	"bLengthChange":false,
    	"language": {
          "emptyTable": "Insert School History"
    	}
    });
    var value = new Array();
    var ctr  =0 ;

    var tbl_work = $("#work_data").DataTable({
       "bFilter": false,
    	"bInfo":false,
    	"bLengthChange":false,
    	"language": {
          "emptyTable": "Insert Work History"
    	}
    })
    var workvalue = new Array();
    var workctr=0;

    var tbl_ref = $("#reference_data").DataTable({
        "bFilter": false,
    	"bInfo":false,
    	"bLengthChange":false,
    	"language": {
          "emptyTable": "Insert Character Reference"
    	}
    })

    var refvalue = new Array();
    var refctr=0;

    function addrefmodal(){
        $("#modaladdref").modal();
    }

    function addrefmodalprocess(){
        var refname = $("#ref_name").val();
        var refcontact = $("#ref_contact").val();
        var refaddress =$("#ref_address").val();
        var refposition = $("#ref_position").val();
        var deletebtn = "<button class='btn btn-danger btnremoveref'><i class='fa fa-close'></i></button>";

        if(refname==""||refcontact==""||refaddress==""||refposition==""){
            Alert("Fill up all the fields");
        }
        else{
        	$('#modaladdref').find('input:text').val('');

            tbl_ref.row.add([
    		refname,
    		refcontact,
    		refaddress,
    		refposition,
    		deletebtn
    		]).draw( false );

    		refvalue[refctr] = new Array(refname,refcontact,refaddress,refposition);
    		refctr++;

        }
        	$("#modaladdref").modal("hide");

    }

    var refdeleteclicked=0;
    $('#reference_data tbody').on( 'click', '.btnremoveref', function () {
		tbl_ref.row( $(this).parents('tr') ).remove().draw();
		refdeleteclicked=1;
	});

	$('#reference_data tbody').on( 'click', 'tr', function () {
        if(refdeleteclicked==1){
            var indexr = tbl_ref.row( this ).index();
            refvalue.splice(indexr,1);
            refctr--;
            refdeleteclicked=0;
        }
	});

    $('.numeric').inputmask('Regex', {
	regex: "^[0-9]+"});
    //work
    function addworkmodal(){
        $("#modaladdwork").modal();
    }

    function addworkprocess(){
        var name_of_employer = $("#name_of_employer").val();
        var address_of_employer = $("#address_of_employer").val();
        var work_from = $("#work_from").val();
        var work_to = $("#work_to").val();
        var work_nature = $("#work_nature").val();
        var work_salary = $("#work_salary").val();
        var reason_for_leaving = $("#reason_for_leaving").val();
        var deletebtn = "<button class='btn btn-danger btnremovework'><i class='fa fa-close'></i></button>";
        if(name_of_employer==""||address_of_employer==""||work_from==""||work_to==""||work_nature==""||work_salary==""||reason_for_leaving==""){
            alert("Please Fill up all the fields");
        }else{
        $('#modaladdrwork').find('input:text').val('');
        tbl_work.row.add([
    		name_of_employer,
    		address_of_employer,
    		work_from,
    		work_to,
    		work_nature,
    		work_salary,
    		reason_for_leaving,
    		deletebtn
    		] ).draw( false );

    		workvalue[workctr] = new Array(name_of_employer,address_of_employer,work_from,work_to,work_nature,work_salary,reason_for_leaving);
    		workctr++;

    		$("#name_of_employer").val("");
            $("#address_of_employer").val("");
            $("#work_from").val("");
            $("#work_to").val("");
            $("#work_nature").val("");
            $("#work_salary").val("");
            $("#reason_for_leaving").val("");
        }
         $("#modaladdwork").modal("hide");
    }
    var workdeleteclicked=0;
    $('#work_data tbody').on( 'click', '.btnremovework', function () {
		tbl_work.row( $(this).parents('tr') ).remove().draw();
		workdeleteclicked=1;
	});

	$('#work_data tbody').on( 'click', 'tr', function () {
        if(workdeleteclicked==1){
            var indexw = tbl_work.row( this ).index();
            workvalue.splice(indexw,1);
            workctr--;
            workdeleteclicked=0;
        }
	});

    //educ
    function addeducmodal(){
        $("#modaladdeduc").modal();
    }

    function addeducprocess(){
        var educ_type = $("#education_type option:selected").val();
        var educ_id = $("#education_type option:selected").data("educ");
        var school_name = $("#school_name").val();
        var school_address = $("#school_address").val();
        var school_from = $("#school_year_attended_from").val();
        var school_to = $("#school_year_attended_to").val();
        var deletebtn = "<button class='btn btn-danger btnremoveschool'><i class='fa fa-close'></i></button>";

        if(educ_type==""||educ_id==""||school_name==""||school_address==""||school_from==""||school_to==""){
            alert("Fill up all the fields");
        }else{
        	$('#modaladdeduc').find('input:text').val('');
            tbl_educ.row.add([
    		educ_type,
    		school_name,
    		school_address,
    		school_from,
    		school_to,
    		deletebtn
    		] ).draw( false );
    		value[ctr] = new Array( educ_type, school_name,school_address,school_from,school_to);
			ctr++;

    		$("#school_name").val("");
    		$("#school_address").val("");
    		$("#school_year_attended_from").val("");
    		$("#school_year_attended_to").val("");
    		$('#education_type').prop('selectedIndex',0);
        }
        $("#modaladdeduc").modal("hide");

    }
    var deleteclicked =0;
    $('#user_data tbody').on( 'click', '.btnremoveschool', function () {
		tbl_educ.row( $(this).parents('tr') ).remove().draw();
		deleteclicked=1;
	});

	$('#user_data tbody').on( 'click', 'tr', function () {
        if(deleteclicked==1){
            var index = tbl_educ.row( this ).index();
            value.splice(index,1);
            ctr--;
            deleteclicked=0;
        }
	});

    $('#user_form').on('submit', function(event){
        //event.preventDefault();
        var last_name = $("#last_name").val();
        var first_name = $("#first_name").val();
        var middle_name = $("#middle_name").val();
        var alias = $("#alias").val();
        var present_address = $("#present_address").val();
        var city = $("#city").val();
        var state = $("#state").val();
        var country = $("#country option:selected").val();
        var postal_code = $("#postal_code").val();
        var gender = $("#gender option:selected").val();
        var age = $("#age").val();
        var birth_date = $("#birth_date").val();
        var birth_place = $("#birth_place").val();
        var citizenship = $("#citizenship").val();
        var civil_status = $("#civil_status option:selected").val();
        var email = $("#email").val();
        var contact_no = $("#contact_no").val();
        var position_applied = $("#position_applied option:selected").val();
        var desired_monthly_salary = $("#desired_monthly_salary").val();
        var date_available_for_work = $("#date_available_for_work").val();

            $.ajax({
                url:"ajax/insert.php",
                type:"POST",
                data:{last_name,first_name,middle_name,alias,present_address,city,state,country,postal_code,gender,age,birth_date,birth_place,citizenship,civil_status,email,contact_no,position_applied,desired_monthly_salary,date_available_for_work,value,workvalue,refvalue},
                success:function(response){

                }
            })

    });

     $("#view_job_description").on('click',function(event){
		var position_description = $("#position_applied option:selected").data("description");

		$("#job_description").val(position_description);
		$("#modal_job_description").modal();
	});


</script>
