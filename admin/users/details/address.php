<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "Contact Address";
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
   document.getElementById("emp_sec").classList.add("active");
  }
  window.onload = SidebarActive;
 </script>
</head>

<body class="hold-transition sidebar-mini">
 <div class="wrapper">
  <?php include $Dir . "/include/admin/loader.php"; ?>

  <?php
  include $Dir . "/include/admin/header.php";
  include $Dir . "/include/admin/sidebar.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
    <div class="container-fluid">
     <div class="row">

      <div class="col-12">
       <div class="card card-primary">
        <div class="card-body">

         <div class="row">
          <div class="col-md-3">
           <?php include "c-profile.php"; ?>
          </div>
          <div class="col-md-9">
           <div class="row">
            <div class="col-md-12 mb-2">
             <div class="flex-s-b">
              <a href="../index.php" class="btn btn-sm btn-default mr-1 back-btn"><i class="fa fa-angle-left"></i></a>
              <h4 class="app-heading w-100 mb-0 mt-0"><?php echo $PageName; ?></h4>
             </div>
            </div>
            <div class="col-md-12">
             <?php include "common-nav.php"; ?>

             <h5 class="app-sub-heading">Update Contact Address</h5>
            </div>
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
               <?php InputOptions(["Home Address"], SECURE(FETCH("SELECT * FROM user_addresses where UserAddressUserId='$REQ_UserId'", "UserAddressType"), "d")); ?>
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
             <div class="col-md-12">
              <button type="submit" name="UpdateAddress" class="btn btn-md btn-success">Update Address Details</button>
             </div>
            </div>
           </form>

          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </section>
  </div>
  <script>
   function checkpass() {
    var pass1 = document.getElementById("pass1");
    var pass2 = document.getElementById("pass2");
    if (pass1.value === pass2.value) {
     document.getElementById("passbtn").classList.remove("disabled");
     document.getElementById("passmsg").classList.add("text-success");
     document.getElementById("passmsg").classList.remove("text-danger");
     document.getElementById("passmsg").innerHTML = "<i class='fa fa-check-circle'></i> Password Matched!";
    } else {
     document.getElementById("passmsg").classList.remove("text-success");
     document.getElementById("passmsg").classList.add("text-danger");
     document.getElementById("passbtn").classList.add("disabled");
     document.getElementById("passmsg").innerHTML = "<i class='fa fa-warning'></i> Password do not matched!";
    }
   }
  </script>
  <?php
  include $Dir . "/include/admin/footer.php"; ?>
 </div>

 <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>