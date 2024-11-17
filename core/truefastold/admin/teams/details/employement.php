<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Customers";
$PageDescription = "Manage all customers";

if (isset($_GET['uid'])) {
   $_SESSION['REQ_UserId'] = SECURE($_GET['uid'], "d");
   $REQ_UserId = $_SESSION['REQ_UserId'];
} else {
   $REQ_UserId = $_SESSION['REQ_UserId'];
}

$PageSqls = "SELECT * FROM users where UserId='$REQ_UserId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <title><?php echo GET_DATA("UserSalutation"); ?> <?php echo GET_DATA("UserFullName"); ?> | <?php echo APP_NAME; ?></title>
   <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
   <meta name="keywords" content="<?php echo APP_NAME; ?>">
   <meta name="description" content="<?php echo SHORT_DESCRIPTION; ?>">
   <?php include $Dir . "/include/admin/header_files.php"; ?>
   <script type="text/javascript">
      function SidebarActive() {
         document.getElementById("customers").classList.add("active");
         document.getElementById("emp_info").classList.add("active");

      }
      window.onload = SidebarActive;
   </script>
</head>

<body class='pace-top'>
   <?php include $Dir . "/include/admin/loader.php"; ?>

   <div id="app" class="app app-content-full-height app-header-fixed app-sidebar-fixed">
      <?php
      include $Dir . "/include/admin/header.php";
      include $Dir . "/include/admin/sidebar.php"; ?>

      <div id="content" class="app-content">

         <?php include "c-profile.php"; ?>
         <div class="row">
            <div class="col-md-12">
               <h5 class="app-heading mt-10px">Employement Details</h5>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <?php include "common-nav.php"; ?>
            </div>
            <div class="col-md-12">
               <h5 class="app-sub-heading">Employement Information</h5>
            </div>
         </div>

         <form action="<?php echo CONTROLLER; ?>/usercontroller.php" method="POST">
            <?php FormPrimaryInputs(
               true,
               [
                  "req_data_for" => $REQ_UserId = $_SESSION['REQ_UserId'],
               ]
            ); ?>
            <div class="row mb-10px">
               <div class="form-group col-lg-6 col-md-6 col-sm-6">
                  <label>Company Name</label>
                  <input type="text" name="UserCompanyName" list="UserCompanyName" value="<?php echo GET_DATA("UserCompanyName"); ?>" class="form-control" placeholder="ABC Pvt Ltd">
                  <?php echo SUGGEST("users", "UserCompanyName", "ASC"); ?>
               </div>
               <div class="form-group col-lg-6 col-md-6 col-sm-6">
                  <label>Company Work Fields/Environment</label>
                  <input type="text" name="UserWorkFeilds" list="UserWorkFeilds" value="<?php echo GET_DATA("UserWorkFeilds"); ?>" class="form-control" placeholder="electronics, garments, media etc">
                  <?php echo SUGGEST("users", "UserWorkFeilds", "ASC"); ?>
               </div>
            </div>
            <div class="row mb-10px">
               <div class="form-group col-lg-6 col-md-6 col-sm-6">
                  <label>Work Department</label>
                  <input type="text" name="UserDepartment" list="UserDepartment" value="<?php echo GET_DATA("UserDepartment"); ?>" class="form-control" placeholder="IT, HR, Account, Sales, Marketing etc">
                  <?php echo SUGGEST("users", "UserDepartment", "ASC"); ?>
               </div>
               <div class="form-group col-lg-6 col-md-6 col-sm-6">
                  <label>Designation</label>
                  <input type="text" name="UserDesignation" list="UserDesignation" value="<?php echo GET_DATA("UserDesignation"); ?>" class="form-control" placeholder="accountant, hr, sale executing, director etc">
                  <?php echo SUGGEST("users", "UserDesignation", "ASC"); ?>
               </div>
            </div>
            <div class="row mb-10px">
               <div class="form-group col-md-3">
                  <label>Joining Date</label>
                  <input type="date" name="UserJoinningDate" value="<?php echo GET_DATA('UserJoinningDate'); ?>" class="form-control">
               </div>
               <div class="form-group col-md-3">
                  <label>Work Days (in Month)</label>
                  <input type="text" name="UserEmpWorkDays" value="<?php echo FETCH("SELECT * FROM user_employments where UserEmpMainUserId='$REQ_UserId'", "UserEmpWorkDays"); ?>" class="form-control">
               </div>
               <div class="form-group col-md-3">
                  <label>Working Hour (in Day)</label>
                  <input type="text" name="UserEmpWorkHours" value="<?php echo FETCH("SELECT * FROM user_employments where UserEmpMainUserId='$REQ_UserId'", "UserEmpWorkHours"); ?>" class="form-control">
               </div>
            </div>
            <div class="row mb-10px">
               <div class="form-group col-lg-12 col-lg-12 col-sm-12">
                  <label>Notes/Remarks</label>
                  <textarea class="form-control" rows="3" name="UserNotes"><?php echo SECURE(GET_DATA("UserNotes"), "d"); ?></textarea>
               </div>
               <div class="col-md-12">
                  <button type="submit" name="UpdateEmploymentDetails" class="btn btn-md btn-success">Update Employement Details</button>
               </div>
            </div>
         </form>

         <form action="<?php echo CONTROLLER; ?>/usercontroller.php" method="POST">
            <?php FormPrimaryInputs(true, [
               "req_data_for" => $REQ_UserId,
            ]); ?>
            <div class="row">
               <div class="col-md-12">
                  <h5 class="app-sub-heading">Pay Scale Details</h5>
               </div>
               <div class="col-md-3 form-group">
                  <label>Pay Rate</label>
                  <input type="text" name="UserPayScale" value="<?php echo FETCH("SELECT * FROM user_pay_scale where UserMainUserId='$REQ_UserId'", "UserPayScale"); ?>" class="form-control" placeholder="Rs.100">
               </div>
               <div class="col-md-3 form-group">
                  <label>Pay Frequency</label>
                  <select class="form-control" name="UserPayFrequency" required="">
                     <?php InputOptions(["PerWork", "Daily", "Weekly", "Weekly", "Monthly"], FETCH("SELECT * FROM user_pay_scale where UserMainUserId='$REQ_UserId'", "UserPayFrequency")); ?>
                  </select>
               </div>
               <div class="col-md-3 form-group">
                  <label>Pay Type</label>
                  <select class="form-control" name="UserPayType" required="">
                     <?php InputOptions(["Salary", "Reimbursement", "Incentive", "Stipends", "ServiceCost"], FETCH("SELECT * FROM user_pay_scale where UserMainUserId='$REQ_UserId'", "UserPayType")); ?>
                  </select>
               </div>
               <div class="col-md-3 form-group">
                  <label>Pay Start From</label>
                  <input type="date" name="UserPayStartFrom" class="form-control" value="<?php echo FETCH("SELECT * FROM user_pay_scale where UserMainUserId='$REQ_UserId'", "UserPayStartFrom"); ?>" value="<?php echo date('Y-m-d'); ?>">
               </div>
               <div class="col-md-3 form-group">
                  <label>Paying Date</label>
                  <input type="date" name="UserPayDate" class="form-control" value="<?php echo FETCH("SELECT * FROM user_pay_scale where UserMainUserId='$REQ_UserId'", "UserPayDate"); ?>" value="<?php echo date('Y-m-d'); ?>">
               </div>
               <div class="col-md-12 form-group">
                  <label>Pay Notes</label>
                  <textarea name="UserPayNotes" class="form-control" rows="3"><?php echo SECURE(FETCH("SELECT * FROM user_pay_scale where UserMainUserId='$REQ_UserId'", "UserPayNotes"), "d"); ?></textarea>
               </div>
               <div class="col-md-12">
                  <button type="submit" name="UpdatePayScaleRecords" class="btn btn-md btn-success">Update Pay Records</button>
               </div>
            </div>
         </form>
         <form action="<?php echo CONTROLLER; ?>/usercontroller.php" method="POST">
            <?php FormPrimaryInputs(true, [
               "UserBankMainUserId" => $REQ_UserId,
            ]) ?>
            <div class="row">
               <div class="col-md-12">
                  <h5 class="app-sub-heading">Bank Details</h5>
               </div>
               <div class="col-md-4 form-group">
                  <label>Bank Name</label>
                  <input type="text" name="UserBankName" value="<?php echo FETCH("SELECT * FROM user_bank_details where UserBankMainUserId='$REQ_UserId'", "UserBankName"); ?>" class="form-control">
               </div>
               <div class="col-md-4 form-group">
                  <label>Account Holder Name</label>
                  <input type="text" name="UserBankAccounHolderName" value="<?php echo FETCH("SELECT * FROM user_bank_details where UserBankMainUserId='$REQ_UserId'", "UserBankAccounHolderName"); ?>" class="form-control">
               </div>
               <div class="col-md-4 form-group">
                  <label>Account Number</label>
                  <input type="text" name="UserBankAccountNumber" value="<?php echo FETCH("SELECT * FROM user_bank_details where UserBankMainUserId='$REQ_UserId'", "UserBankAccountNumber"); ?>" class="form-control">
               </div>
               <div class="col-md-4 form-group">
                  <label>Bank IFSC Code</label>
                  <input type="text" name="UserBankAccountIFSC" value="<?php echo FETCH("SELECT * FROM user_bank_details where UserBankMainUserId='$REQ_UserId'", "UserBankAccountIFSC"); ?>" class="form-control">
               </div>
               <div class="col-md-12 form-group">
                  <label>Notes/Remarks</label>
                  <textarea class="form-control" name="UserBankOtherDetails" rows="3"><?php echo SECURE(FETCH("SELECT * FROM user_bank_details where UserBankMainUserId='$REQ_UserId'", "UserBankOtherDetails"), "d"); ?></textarea>
               </div>
               <div class="col-md-12 text-right">
                  <button class="btn btn-success btn-md" name="UpdateBankDetails">Update Bank Details</button>
                  <hr>
               </div>
            </div>
         </form>

      </div>
   </div>
   <?php include $Dir . "/include/admin/footer.php"; ?>
   <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
   </div>
   <?php include $Dir . "/include/admin/footer_files.php"; ?>
</body>

</html>