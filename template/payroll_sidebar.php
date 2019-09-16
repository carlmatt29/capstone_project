<aside class="main-sidebar bg-LightGray ">
    <section class="sidebar">
        <ul class="sidebar-menu">
        <?php
            if (AllowUser(array(3, 4))):
            ?>
            <li>
              <a href="../index.php">
                <i class="fa fa-desktop"></i> <span>HRIS</span>
              </a>
            </li>
            <?php
            endif;
            ?>
    <!--  DASHBOARD -->
            <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="index.php"?"active":"";?>">
                <a href="index.php">            
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
    <!-- ATTENDANCE UPLOAD -->
            <?php if($set['uploading_attendance'] == 1): ?>
                <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("attendance.php","attendance_view.php")))?"active":"";?>">
                    <a href="attendance.php">
                        <i class="fa fa-users"></i> <span>Upload Attendance</span>
                    </a>
                </li>
            <?php endif; ?>
    <!-- PAYROLL -->
            <!-- <li class='header'>PAYROLL</li> -->
            <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("view_payroll_maintenance.php","frm_generate_payroll.php")))?"active":"";?>" id="70">
                <a href="view_payroll_maintenance.php">
                    <i class="fa fa-money"></i> <span>Generate Payroll</span>
                    
                </a>
                <!-- <label>(Under Maintenance)</label> -->
            </li>
    <!-- 13TH MONTH -->
            <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("13th_month.php","13th_month_view.php")))?"active":"";?>" id="71">
                <a href="13th_month.php">
                    <i class="fa fa-gift"></i> <span>Generate 13th Month</span>
                </a>
            </li>
    <!-- PAYROLL ADJUSTMNET -->
            <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("frm_payroll_adjustment.php")))?"active":"";?>" id="72">
                <a href="frm_payroll_adjustment.php">
                    <i class="fa fa-gift"></i> <span>Payroll Adjustment</span>
                </a>
            </li>
    <!-- REPORTS -->
           
            <li class='header' id="reports">PAYROLL REPORTS</li>
            <li class='treeview <?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1), array("pay_journal.php","pay_slip.php","report_govde.php","view_r5.php","view_sss_r1a.php","view_ph_er2.php","view_ph_rf1.php","view_m1.php","view_hdmf_stlrf.php","view_1601c.php","1601c_view.php","view_1604cf.php","report_bir_1601_e.php","report_bir_1601_e_view.php","report_bir_1604_e.php","report_bir_1604_e_view.php","report_bir_1604_e_view_2.php","view_2316.php","alpha_list.php", "absent_report.php","allowance_report.php","deductions_per_month.php","loan.php","sss_ml2.php","billing_report.php")))?"active":"";?>' id="lbl_report">
                <label type="hidden" id="73"></label>
                <a href="#">
                    <i class="fa fa-file-text"></i>
                    <span>Reports</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class='treeview-menu'>
                    <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="late_overtime.php"?"active":"";?>" id="74">
                        <a  href="#" data-toggle="modal" data-target="#absent_report"><i class="fa fa-file-text-o"></i> <span>Absences Report</span></a>
                    </li>
                    <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="allowance_report.php"?"active":"";?>" id="75">
                        <a  href="#" data-toggle="modal" data-target="#allowances_report"><i class="fa fa-file-text-o"></i> <span>Allowances Report</span></a>
                    </li>
                    <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="billing_report.php"?"active":"";?>" id="75">
                        <a  href="#" data-toggle="modal" data-target="#billing_report"><i class="fa fa-file-text-o"></i> <span>Billing Report</span></a>
                    </li>
                    <!-- <li class="<?php //echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="billing_report.php"?"active":"";?>" id="80">
                        <a href="billing_report.php"><i class="fa fa-file-text-o"></i> <span>Billing Reports</span></a>
                    </li> -->
                    <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="company_deduction.php"?"active":"";?>" id="76">
                        <a  href="#" data-toggle="modal" data-target="#comde"><i class="fa fa-file-text-o"></i> <span>Company Deduction</span></a>
                    </li>
                    <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="deductions_per_month.php"?"active":"";?>" id="77">
                        <a  href="#" data-toggle="modal" data-target="#ded_month"><i class="fa fa-file-text-o"></i> <span>Deductions per Cutoff</span></a>
                    </li>
                    <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="report_govde.php"?"active":"";?>" id="78">
                        <a href="report_govde.php"><i class="fa fa-file-text-o"></i> <span>Government Deduction</span></a>
                    </li>
                    <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="absent_report.php"?"active":"";?>" id="79">
                        <a  href="#" data-toggle="modal" data-target="#lateover"><i class="fa fa-file-text-o"></i> <span>Late and Overtime</span></a>
                    </li>
                    <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="loan.php"?"active":"";?>" id="80">
                        <a href="loan.php"><i class="fa fa-file-text-o"></i> <span>Loan</span></a>
                    </li>
                    <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="pay_journal.php"?"active":"";?>" id="81">
                        <a href="pay_journal.php"><i class="fa fa-file-text-o"></i> <span>Pay Journal</span></a>
                    </li>
                    <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="pay_slip.php"?"active":"";?>" id="82">
                        <a href="pay_slip.php"><i class="fa fa-file-text-o"></i> <span>Pay Slip</span></a>
                    </li>
                    <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="sched_net_pay.php"?"active":"";?>" id="83">
                        <a href="#" data-toggle="modal" data-target="#netpay"><i class="fa fa-file-text-o"></i> <span>Schedule of Net Pay</span></a>
                    </li>
                    <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="with_tax.php"?"active":"";?>" id="84">
                        <a  href="#" data-toggle="modal" data-target="#withtax"><i class="fa fa-file-text-o"></i> <span>Witholding Tax</span></a>
                    </li>

                    <!-- SSS -->

                    <li class='<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1), array("view_r5.php","view_sss_r1a.php","sss_ml2.php")))?"active":"";?>' id="sss">
                        <a href="#">
                            <i class="fa fa-file-text-o"></i>
                            <span>SSS</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class='treeview-menu'>
                            <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="view_r5.php"?"active":"";?>" id="85">
                                <a href="view_r5.php"><i class="fa fa-circle-o"></i> <span>R5</span></a>
                            </li>
                            <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="view_sss_r1a.php"?"active":"";?>" id="86">
                                <a href="view_sss_r1a.php"><i class="fa fa-circle-o"></i> <span>R1-A</span></a>
                            </li>
                            <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))==" sss_ml2.php"?"active":"";?>" id="87">
                                <a href="sss_ml2.php"><i class="fa fa-circle-o"></i> <span>ML-2-Collection List</span></a>
                            </li>                           
                        </ul>
                    </li>

                    <!-- PHILHEALTH -->

                    <li class='<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1), array("view_ph_er2.php","view_ph_rf1.php")))?"active":"";?>' id="phil">
                        <a href="#">
                            <i class="fa fa-file-text-o"></i>
                            <span>PHILHEALTH</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class='treeview-menu'>
                            <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="view_ph_er2.php"?"active":"";?>" id="88">
                                <a href="view_ph_er2.php"><i class="fa fa-circle-o"></i> <span>ER2</span></a>
                            </li>
                            <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="view_ph_rf1.php"?"active":"";?>" id="89">
                                <a href="view_ph_rf1.php"><i class="fa fa-circle-o"></i> <span>RF1</span></a>
                            </li>
                           
                        </ul>
                    </li>

                    <!-- PAG-IBIG -->

                    <li class='<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1), array("view_m1.php","view_hdmf_stlrf.php")))?"active":"";?>' id="pagibig">
                        <a href="#">
                            <i class="fa fa-file-text-o"></i>
                            <span>PAG-IBIG</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class='treeview-menu'>
                            <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="view_m1.php"?"active":"";?>" id="90">
                                <a href="view_m1.php"><i class="fa fa-circle-o"></i> <span>M1-1</span></a>
                            </li>
                            <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="view_hdmf_stlrf.php"?"active":"";?>" id="91">
                                <a href="view_hdmf_stlrf.php"><i class="fa fa-circle-o"></i> <span>STLRF</span></a>
                            </li>
                           
                        </ul>
                    </li>

                    <!-- BIR -->

                    <li class='<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1), array("view_1601c.php","1601c_view.php","view_1604cf.php","report_bir_1601_e.php","report_bir_1601_e_view.php","report_bir_1604_e.php","report_bir_1604_e_view.php","report_bir_1604_e_view_2.php","view_2316.php","alpha_list.php")))?"active":"";?>' id="bir">
                        <a href="#">
                            <i class="fa fa-file-text-o"></i>
                            <span>BIR</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class='treeview-menu'>
                            <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("view_1601c.php","1601c_view.php")))?"active":"";?>" id="92">
                                <a href="view_1601c.php"><i class="fa fa-circle-o"></i> <span>1601-C</span></a>
                            </li>
                            <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="view_1604cf.php"?"active":"";?>" id="93">
                                <a href="view_1604cf.php"><i class="fa fa-circle-o"></i> <span>1604-CF</span></a>
                            </li>
                            <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("report_bir_1601_e.php","report_bir_1601_e_view.php")))?"active":"";?>" id="94">
                                <a href="report_bir_1601_e.php"><i class="fa fa-circle-o"></i> <span>1601-E</span></a>
                            </li>
                            <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("report_bir_1604_e.php","report_bir_1604_e_view.php","report_bir_1604_e_view_2.php")))?"active":"";?>" id="95">
                                <a href="report_bir_1604_e.php"><i class="fa fa-circle-o"></i> <span>1604-E</span></a>
                            </li>
                            <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="view_2316.php"?"active":"";?>" id="96">
                                <a href="view_2316.php"><i class="fa fa-circle-o"></i> <span>2316</span></a>
                            </li>
                            <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="alpha_list.php"?"active":"";?>" id="97">
                                <a href="alpha_list.php"><i class="fa fa-circle-o"></i> <span>Alphalist</span></a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>
    <!-- PAYROLL SETTINGS -->   
            <li class='header' id="payroll">PAYROLL SETTINGS</li>
            <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("view_loan.php","frm_loan.php")))?"active":"";?>" id="98">
                <a href="view_loan.php">
                    <i class="fa fa-money"></i> <span>Employee's Loans</span>
                </a>
            </li>
            <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("view_payroll_group_rates.php","frm_payroll_group_rate.php")))?"active":"";?>" id="99">
                <a href="view_payroll_group_rates.php">
                    <i class="fa fa-gears"></i> <span>Payroll Group Rates</span>
                </a>
            </li>
            <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("view_shifting_sched.php","frm_shifting_sched.php")))?"active":"";?>" id="100">
                <a href="view_shifting_sched.php">
                    <i class="fa fa-calendar-plus-o"></i> <span>Shifting Schedule</span>
                </a>
            </li>
    <!-- ADMINISTRATOR -->
            <li class='header' id="admin">ADMINISTRATOR MENU</li>
            <li class='treeview <?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1), array("bir_1601_e_reference.php","bir_1601_e_form.php","company_deductions.php","frm_company_deductions.php","deminimis.php","frm_deminimis.php","taxable_allowances.php","view_sss.php","view_phealth.php","view_housing.php","view_tax.php","view_loan_list.php","frm_loan_list.php","view_payrollgroups.php","frm_payrollgroup.php","frm_taxable_allowances.php","view_shift.php","frm_shift.php", "payroll_settings.php")))?"active":"";?>' id="administrator">

                <a href=''><i class="fa fa-gear"></i><span>Administrator</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class='treeview-menu'>
                    <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("frm_daily_rate.php","frm_daily_rate.php")))?"active":"";?>" >
                        <a href="frm_daily_rate.php">
                            <i class="fa fa-calendar"></i> <span>Yearly Working Day</span>
                        </a>
                    </li>

                    <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("bir_1601_e_reference.php","bir_1601_e_form.php")))?"active":"";?>" id="101">
                        <a href="bir_1601_e_reference.php">
                            <i class="fa fa-calendar"></i> <span>BIR 1601-E Reference</span>
                        </a>
                    </li>
                    <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("company_deductions.php","frm_company_deductions.php")))?"active":"";?>" id="102">
                        <a href="company_deductions.php">
                            <i class="fa fa-minus-square"></i> <span>Company Deductions</span>
                        </a>
                    </li>
                    <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("deminimis.php","frm_deminimis.php")))?"active":"";?>" id="103">
                        <a href="deminimis.php">
                            <i class="fa fa-plus-square"></i> <span>De Minimis Allowance</span>
                        </a>
                    </li>
                    <li class='<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1), array("view_sss.php","view_phealth.php","view_housing.php","view_tax.php")))?"active":"";?>' id="gov_tbl">
                        <a href="#">
                            <i class="fa fa-table"></i>
                            <span>Government Tables</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class='treeview-menu'>
                            <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="view_sss.php"?"active":"";?>" id="104">
                                <a href="view_sss.php"><i class="fa fa-circle-o"></i> <span>SSS Table</span></a>
                            </li>
                            <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="view_phealth.php"?"active":"";?>" id="105">
                                <a href="view_phealth.php"><i class="fa fa-circle-o"></i> <span>Philhealth Table</span></a>
                            </li>
                            <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="view_housing.php"?"active":"";?>" id="106">
                                <a href="view_housing.php"><i class="fa fa-circle-o"></i> <span>Pagibig Table</span></a>
                            </li>
                            <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1))=="view_tax.php"?"active":"";?>" id="107">
                                <a href="view_tax.php"><i class="fa fa-circle-o"></i> <span>Tax Table</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("view_loan_list.php","frm_loan_list.php")))?"active":"";?>" id="108">
                        <a href="view_loan_list.php">
                            <i class="fa fa-users"></i> <span>Loan Types</span>
                        </a>
                    </li>
                    <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("view_payrollgroups.php","frm_payrollgroup.php")))?"active":"";?>" id="109">
                        <a href="view_payrollgroups.php">
                            <i class="fa fa-users"></i> <span>Payroll Groups</span>
                        </a>
                    </li>
                    <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("taxable_allowances.php","frm_taxable_allowances.php")))?"active":"";?>" id="110">
                        <a href="taxable_allowances.php">
                            <i class="fa fa-plus-square"></i> <span>Taxable Allowance</span>
                        </a>
                    </li>
                    <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("view_shift.php","frm_shift.php")))?"active":"";?>" id="111">
                        <a href="view_shift.php">
                            <i class="fa fa-calendar"></i> <span>Shifts</span>
                        </a>
                    </li>

                    <li class="<?php echo (in_array(substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], "/")+1),array("payroll_settings.php")))?"active":"";?>" id="112">
                        <a href="payroll_settings.php">
                            <i class="fa fa-calendar"></i> <span>Settings</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    </section>
</aside>

<?php
    $getPayCode=$con->myQuery("SELECT
            p.id,
            CONCAT('(', payroll_groups.`name` ,') ',DATE_FORMAT(p.date_from,'%M %d, %Y'),' to ',DATE_FORMAT(p.date_to,'%M %d, %Y')) AS payroll_code,
            p.pay_group_id
        FROM payroll AS p
        INNER JOIN payroll_groups ON p.pay_group_id = payroll_groups.payroll_group_id
        WHERE p.is_deleted=0 AND is_processed=1")->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- COMPANY DEDUCTION MODAL -->
<div class="modal fade" id="comde" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Select Payroll Code</h4>
            </div>
            <div class="modal-body">      
                <form method='get' action="company_deduction.php">
                    <div class="form-group">
                        <div class='form-group'>
                            <div class ="row">
                                <div class = "col-md-3">
                                    <label class='control-label'> Payroll Code : </label>
                                </div>
                                <div class = "col-md-9">
                                    <select class="form-control cbo" name="p_code" data-placeholder="Select PayCode" style="width: 100%"  required> 
                                        <?php echo makeOptions($getPayCode); ?> 
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class ="modal-footer ">
                        <button type="submit" class="btn btn-danger btn-flat" >Filter</button>
                        <button type="button" class="btn btn-default btn-flat"  data-dismiss="modal" id="reset" >Cancel</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END COMPANY DEDUCTION MODAL -->

<!-- SCHEDULE PAYROLL MODAL -->
<div class="modal fade" id="netpay" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Select Payroll Code</h4>
            </div>
            <div class="modal-body">       
                <form method='get' action="sched_net_pay.php">
                    <div class="form-group">
                        <div class='form-group'>
                            <div class ="row">
                                <div class = "col-md-3">
                                    <label class='control-label'> Payroll Code : </label>
                                </div>
                                <div class = "col-md-9">
                                    <select class="form-control cbo" name="p_code" data-placeholder="Select PayCode" style="width: 100%"  required> 
                                        <?php echo makeOptions($getPayCode); ?> 
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class ="modal-footer ">
                        <button type="submit" class="btn btn-danger btn-flat" >Proceed</button>
                        <button type="button" class="btn btn-default btn-flat"  data-dismiss="modal" id="reset" >Cancel</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END SCHEDULE PAYROLL MODAL -->

<!-- WITH TAX MODAL -->
<div class="modal fade" id="withtax" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Select Payroll Code</h4>
            </div>
            <div class="modal-body">       
                <form method='get' action="with_tax.php">
                    <div class="form-group">
                        <div class='form-group'>
                            <div class ="row">
                                <div class = "col-md-3">
                                    <label class='control-label'> Payroll Code : </label>
                                </div>
                                <div class = "col-md-9">
                                    <select class="form-control cbo" name="p_code" data-placeholder="Select PayCode" style="width: 100%"  required> 
                                        <?php echo makeOptions($getPayCode); ?> 
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class ="modal-footer ">
                        <button type="submit" class="btn btn-danger btn-flat" >Proceed</button>
                        <button type="button" class="btn btn-default btn-flat"  data-dismiss="modal" id="reset" >Cancel</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END WITH TAX MODAL -->

<!-- LATE/OVERTIME MODAL -->
<div class="modal fade" id="lateover" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Select Payroll Code</h4>
            </div>
            <div class="modal-body">       
                <form method='get' action="late_overtime.php">
                    <div class="form-group">
                        <div class='form-group'>
                            <div class ="row">
                                <div class = "col-md-3">
                                    <label class='control-label'> Payroll Code : </label>
                                </div>
                                <div class = "col-md-9">
                                    <select class="form-control cbo" name="p_code" data-placeholder="Select PayCode" style="width: 100%"  required> 
                                        <?php echo makeOptions($getPayCode); ?> 
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class ="modal-footer ">
                        <button type="submit" class="btn btn-danger btn-flat" >Filter</button>
                        <button type="button" class="btn btn-default btn-flat"  data-dismiss="modal" id="reset" >Cancel</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END LATE/OVERTIME MODAL -->

<!-- ABSENT REPORT MODAL -->
<div class="modal fade" id="absent_report" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Select Payroll Code</h4>
            </div>
            <div class="modal-body">       
                <form method='post' action="absent_report.php">
                    <div class="form-group">
                        <div class='form-group'>
                            <div class ="row">
                                <div class = "col-md-3">
                                    <label class='control-label'> Payroll Code : </label>
                                </div>
                                <div class = "col-md-9">
                                    <select class="form-control cbo" name="p_code" data-placeholder="Select PayCode" style="width: 100%"  required> 
                                        <?php echo makeOptions($getPayCode); ?> 
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class ="modal-footer ">
                        <button type="submit" class="btn btn-danger btn-flat" >Filter</button>
                        <button type="button" class="btn btn-default btn-flat"  data-dismiss="modal" id="reset" >Cancel</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END ABSENT REPORT MODAL -->


<!-- ALLOWANCES REPORT MODAL -->
<div class="modal fade" id="allowances_report" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Select Payroll Code </h4> 
            </div>
            <div class="modal-body">       
                <form method='post' action="allowances_report.php">
                    <div class="form-group">
                        <div class='form-group'>
                            <div class ="row">
                                <div class = "col-md-3">
                                    <label class='control-label'> Payroll Code : </label>
                                </div>
                                <div class = "col-md-9">
                                    <select class="form-control cbo" name="p_code" data-placeholder="Select PayCode" style="width: 100%"  required> 
                                        <?php echo makeOptions($getPayCode); ?> 
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class ="modal-footer ">
                        <button type="submit" class="btn btn-danger btn-flat" >Filter</button>
                        <button type="button" class="btn btn-default btn-flat"  data-dismiss="modal" id="reset" >Cancel</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END ALLOWANCES REPORT MODAL -->

<!-- DEDUCTIONS PER MONTH REPORT MODAL -->
<div class="modal fade" id="ded_month" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Select Payroll Code </h4> 
            </div>
            <div class="modal-body">       
                <form method='get' action="deductions_per_month.php">
                    <div class="form-group">
                        <div class='form-group'>
                            <div class ="row">
                                <div class = "col-md-3">
                                    <label class='control-label'> Payroll Code : </label>
                                </div>
                                <div class = "col-md-9">
                                    <select class="form-control cbo" name="p_code" data-placeholder="Select PayCode" style="width: 100%"  required> 
                                        <?php echo makeOptions($getPayCode); ?> 
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class ="modal-footer ">
                        <button type="submit" class="btn btn-danger btn-flat" >Filter</button>
                        <button type="button" class="btn btn-default btn-flat"  data-dismiss="modal" id="reset" >Cancel</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END DEDUCTIONS PER MONTH REPORT MODAL -->

<!-- BILLING REPORT MODAL -->
<div class="modal fade" id="billing_report" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Select Payroll Code </h4> 
            </div>
            <div class="modal-body">       
                <form method='get' action="billing_report.php">
                    <div class="form-group">
                        <div class='form-group'>
                            <div class ="row">
                                <div class = "col-md-3">
                                    <label class='control-label'> Payroll Code : </label>
                                </div>
                                <div class = "col-md-9">
                                    <select class="form-control cbo" name="p_code" data-placeholder="Select PayCode" style="width: 100%"  required> 
                                        <?php echo makeOptions($getPayCode); ?> 
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class ="modal-footer ">
                        <button type="submit" class="btn btn-danger btn-flat" >Download Report</button>
                        <button type="button" class="btn btn-default btn-flat"  data-dismiss="modal" id="reset" >Cancel</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END BILLING REPORT MODAL -->


<script type="text/javascript">
    $(document).ready(function () {
    document.getElementById("70").style.display = "none";    
    document.getElementById("71").style.display = "none";
    document.getElementById("72").style.display = "none";
    document.getElementById("73").style.display = "none";
    document.getElementById("74").style.display = "none";
    document.getElementById("75").style.display = "none";
    document.getElementById("76").style.display = "none";
    document.getElementById("77").style.display = "none";
    document.getElementById("78").style.display = "none";
    document.getElementById("79").style.display = "none";
    document.getElementById("80").style.display = "none";
    document.getElementById("81").style.display = "none";
    document.getElementById("82").style.display = "none";
    document.getElementById("83").style.display = "none";
    document.getElementById("84").style.display = "none";
    document.getElementById("85").style.display = "none";
    document.getElementById("86").style.display = "none";
    document.getElementById("87").style.display = "none";
    document.getElementById("88").style.display = "none";
    document.getElementById("89").style.display = "none";
    document.getElementById("90").style.display = "none";
    document.getElementById("91").style.display = "none";
    document.getElementById("92").style.display = "none";
    document.getElementById("93").style.display = "none";
    document.getElementById("94").style.display = "none";
    document.getElementById("95").style.display = "none";
    document.getElementById("96").style.display = "none";
    document.getElementById("97").style.display = "none";
    document.getElementById("98").style.display = "none";
    document.getElementById("99").style.display = "none";
    document.getElementById("100").style.display = "none";
    document.getElementById("101").style.display = "none";
    document.getElementById("102").style.display = "none";
    document.getElementById("103").style.display = "none";
    document.getElementById("104").style.display = "none";
    document.getElementById("105").style.display = "none";
    document.getElementById("106").style.display = "none";
    document.getElementById("107").style.display = "none";
    document.getElementById("108").style.display = "none";
    document.getElementById("109").style.display = "none";
    document.getElementById("110").style.display = "none";
    document.getElementById("111").style.display = "none";
    document.getElementById("112").style.display = "none";
    document.getElementById("lbl_report").style.display = "none";

        id='<?php echo $_SESSION[WEBAPP]['user']['id']; ?>';
        $.getJSON("../payroll/ajax/get_uaid_details.php?user_id=" + id, function(result){
            
            $x=result[0].length;
            var pay1 = result[0].indexOf("98");
            var pay2 = result[0].indexOf("99");
            var pay3 = result[0].indexOf("100");
            var sss1 = result[0].indexOf("85");
            var sss2 = result[0].indexOf("86");
            var sss3 = result[0].indexOf("87");
            var phil1 = result[0].indexOf("88");
            var phil2 = result[0].indexOf("89");
            var pag1 = result[0].indexOf("90");
            var pag2 = result[0].indexOf("91");
            var bir1 = result[0].indexOf("92");
            var bir2 = result[0].indexOf("93");
            var bir3 = result[0].indexOf("94");
            var bir4 = result[0].indexOf("95");
            var bir5 = result[0].indexOf("96");
            var bir6 = result[0].indexOf("97");
            var govt1 = result[0].indexOf("104");
            var govt2 = result[0].indexOf("105");
            var govt3 = result[0].indexOf("106");
            var govt4 = result[0].indexOf("107");
            console.log(result[0]);
            var b ='74';
            var c ='101';
            var a = 0;
            var count = 0;
            var count2 = 0;
            var names_arr = result[0];
            
            function checkValue(value,arr){
              var status = '-1';
             
              for(var i=0; i<arr.length; i++){
               var name = arr[i];
               if(name == value){
                status = '0';
                break;
               }
              }
              return status;
            }
            //SHOW REPORTS SIDEBAR
            while(b<='97'){
                if(checkValue(b, names_arr) == '-1'){
                }else{
                    count++;
                }
                b++; 
            }
                if(count>0){
                    document.getElementById('reports').style.display = "block";
                    document.getElementById('lbl_report').style.display = "block";
                }else{
                    document.getElementById('reports').style.display = "none";
                    document.getElementById('lbl_report').style.display = "none";
                }
            //END SHOW REPORTS SIDEBAR

            //SHOW ADMIN SIDEBAR
            while(c<="112"){      
                if(checkValue(c, names_arr) == '-1'){
                }else{
                    count2++;
                }
                c++;
            }
                if(count2>0){
                    document.getElementById('admin').style.display = "block";
                    document.getElementById('administrator').style.display = "block";
                }else{
                    document.getElementById('admin').style.display = "none";
                    document.getElementById('administrator').style.display = "none";
                }
             //END SHOW ADMIN SIDEBAR

            //SHOW PAYROLL SETTINGS LABEL
            // console.log(pay1);
            if(pay1 == '-1'  && pay2 == '-1'  && pay3 == '-1'){
                    document.getElementById('payroll').style.display = "none";                        
            }else{
                document.getElementById('payroll').style.display = "block";
            }
            //SHOW SSS REPORT MENU
            if(sss1 == '-1' && sss2 == '-1' && sss3 == '-1'){
                    document.getElementById('sss').style.display = "none";                        
            }else{
                document.getElementById('sss').style.display = "block";
            }
            //SHOW PHILHEALTH REPORT MENU
            if(phil1 == '-1' && phil2 == '-1' ){
                    document.getElementById('phil').style.display = "none";                        
            }else{
                document.getElementById('phil').style.display = "block";
            }
            //SHOW PAGIBIG REPORT MENU
            if(pag1 == '-1' && pag2 == '-1' ){
                    document.getElementById('pagibig').style.display = "none";                        
            }else{
                document.getElementById('pagibig').style.display = "block";
            }
            //SHOW BIR REPORT MENU
            if(bir1 == '-1' && bir2 == '-1' && bir3 == '-1' && bir4 == '-1' && bir5 == '-1' && bir6 == '-1' ){
                    document.getElementById('bir').style.display = "none";                        
            }else{
                document.getElementById('bir').style.display = "block";
            }
            //SHOW GOVERNMENT TABLE
            if(govt1 == '-1' && govt2 == '-1' && govt3 == '-1' && govt4 == '-1'){
                    document.getElementById('gov_tbl').style.display = "none";                        
            }else{
                document.getElementById('gov_tbl').style.display = "block";
            }

            //GET THE USER ACCESS IDS
            while (a < $x) {
                    // console.log(result[0][a]); 
                    document.getElementById(result[0][a]).style.display = "block"; 
                
                a++;
            }

        });

    });

</script>