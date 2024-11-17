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
         document.getElementById("teams").classList.add("active");
         document.getElementById("add_team").classList.add("active");
         document.getElementById("p_info").classList.add("active");
      }
      window.onload = SidebarActive;
   </script>
</head>

<body class='pace-top'>
   <?php include $Dir . "/include/admin/loader.php"; ?>

   <div id="app" class="app app-header-fixed app-sidebar-fixed">
      <?php
      include $Dir . "/include/admin/header.php";
      include $Dir . "/include/admin/sidebar.php"; ?>

      <div id="content" class="app-content">
         <?php include "c-profile.php"; ?>
         <div class="row">
            <div class="col-md-12">
               <h5 class="app-heading mt-10px">Primary Informations & Contact Address</h5>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <?php include "common-nav.php"; ?>
            </div>
         </div>
         <form action="<?php echo CONTROLLER; ?>/usercontroller.php" method="POST">
            <?php FormPrimaryInputs(
               true,
               [
                  "edit_request_for" => $REQ_UserId,
               ]
            ); ?>
            <div class="row">
               <div class="col-md-12">
                  <h5 class="app-sub-heading">Primary Information</h5>
               </div>
               <div class="col-md-2 form-group">
                  <label>Salutations</label>
                  <select class="form-control" name="UserSalutation">
                     <?php echo SelectInputOptions(SALUTATION, GET_DATA("UserSalutation")); ?>
                  </select>
               </div>
               <div class="col-md-3 form-group">
                  <label>FullName</label>
                  <input type="text" name="UserFullName" class="form-control" value="<?php echo GET_DATA("UserFullName"); ?>" required="">
               </div>
               <div class="col-md-3 form-group">
                  <label>Phone Number</label>
                  <input type="tel" name="UserPhoneNumber" class="form-control" value="<?php echo GET_DATA('UserPhoneNumber'); ?>" required="">
               </div>
               <div class="col-md-4 form-group">
                  <label>Email Id</label>
                  <input type="email" name="UserEmailId" class="form-control" value="<?php echo GET_DATA("UserEmailId"); ?>" required="">
               </div>
               <div class="col-md-2 form-group">
                  <label>Date of Birth</label>
                  <input type="date" name="UserDateOfBirth" class="form-control" value="<?php echo GET_DATA("UserDateOfBirth"); ?>" required="">
               </div>
               <div class="col-md-12">
                  <label>Bio & Profile Info</label>
                  <textarea class="form-control" name="UserNotes" rows="2"><?php echo SECURE(GET_DATA("UserNotes"), "d"); ?></textarea>
               </div>
               <div class="col-md-12">
                  <button type="submit" name="UpdateProfileDetails" class="btn btn-md btn-success"><i class="fa fa-check-circle-o"></i> Update Profile </button>
               </div>
            </div>
         </form>
         <div class="row mb-5px">
            <h5 class="app-sub-heading">Contact Address</h5>
         </div>
         <form action="<?php echo CONTROLLER; ?>/usercontroller.php" method="POST">
            <?php FormPrimaryInputs(
               true,
               [
                  "edit_request_for" => $REQ_UserId,
               ]
            ); ?>
            <div class="row mb-10px">
               <div class="form-group col-lg-6 col-md-6 col-12">
                  <label>House No/Flat no Address</label>
                  <input type="text" name="UserStreetAddress" value="<?php echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressUserId='$REQ_UserId'", "UserStreetAddress"), "d"); ?>" class="form-control">
               </div>
               <div class="form-group col-lg-6 col-md-6 col-12">
                  <label>Sector/Locality/Area/Landmark</label>
                  <input type="text" name="UserLocality" value="<?php echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressUserId='$REQ_UserId'", "UserLocality"), "d"); ?>" class="form-control">
               </div>
               <div class="form-group col-lg-6 col-md-6 col-12">
                  <label>City</label>
                  <input type="text" name="UserCity" value="<?php echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressUserId='$REQ_UserId'", "UserCity"), "d"); ?>" class="form-control">
               </div>
               <div class="form-group col-lg-4 col-md-4 col-12">
                  <label>State</label>
                  <input type="text" name="UserState" value="<?php echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressUserId='$REQ_UserId'", "UserState"), "d"); ?>" class="form-control">
               </div>
               <div class="form-group col-lg-4 col-md-4 col-12">
                  <label>Country</label>
                  <input type="text" name="UserCountry" value="<?php echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressUserId='$REQ_UserId'", "UserCountry"), "d"); ?>" class="form-control">
               </div>
               <div class="form-group col-lg-4 col-md-4 col-12">
                  <label>Pincode</label>
                  <input type="text" name="UserPincode" value="<?php echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressUserId='$REQ_UserId'", "UserPincode"), "d"); ?>" class="form-control">
               </div>
               <div class="form-group col-lg-4 col-md-4 col-12">
                  <label>Address Type</label>
                  <select class="form-control" name="UserAddressType">
                     <?php InputOptions(["Office Address", "Home Address"], SECURE(FETCH("SELECT * FROM user_addresses where UserAddressUserId='$REQ_UserId'", "UserAddressType"), "d")); ?>
                  </select>
               </div>
               <div class="form-group col-lg-8 col-md-8 col-12">
                  <label>Contact Person At Address</label>
                  <input type="text" name="UserAddressContactPerson" value="<?php echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressUserId='$REQ_UserId'", "UserPincode"), "d"); ?>" class="form-control">
               </div>
               <div class="form-group col-lg-12 col-md-12">
                  <label>Address Notes</label>
                  <textarea class="form-control" rows="2" name="UserAddressNotes"><?php echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressUserId='$REQ_UserId'", "UserAddressNotes"), "d"); ?></textarea>
               </div>
               <div class="form-group col-lg-12 col-md-12">
                  <label>Location Map Url (If Have)</label>
                  <textarea class="form-control" rows="2" name="UserAddressMapUrl"><?php echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressUserId='$REQ_UserId'", "UserAddressMapUrl"), "d"); ?></textarea>
               </div>

               <div class="col-md-12">
                  <button type="submit" name="UpdateAddress" class="btn btn-md btn-success">Update Address Details</button>
               </div>
            </div>
         </form>

         <?php include $Dir . "/include/admin/footer.php"; ?>
         <a href=" javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
      </div>

      <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>