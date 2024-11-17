<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "Login & Security";
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
     <h5 class="app-heading mt-10px"><?php echo $PageName; ?></h5>
    </div>
   </div>
   <div class="row">
    <div class="col-md-12">
     <?php include "common-nav.php"; ?>
    </div>
   </div>

   <div class="row">
    <div class="col-md-12">
     <form class="form mt-3" action="../../../controller/usercontroller.php" method="POST">
      <?php FormPrimaryInputs(true); ?>
      <div class="row">
       <div class="form-group col-md-6 col-sm-6">
        <label>Enter New Password <small class="text-grey">Current <code><?php echo FETCH($PageSqls, "UserPassword"); ?></code></small></label>
        <input type="password" name="UserPassword" oninput="checkpass()" id="pass1" class="form-control" required="">
       </div>
       <div class="form-group col-md-6 col-sm-6">
        <label>Re-Enter New Password</label>
        <input type="password" name="UserPassword_2" oninput="checkpass()" id="pass2" class="form-control" required="">
       </div>
       <div class="col-md-12">
        <button type="Submit" id="passbtn" name="UpdatePassword" class="btn btn-md btn-success disabled">Update Password</button>
        <span style="font-size:1.5rem;padding:1rem;"><span id="passmsg"></span></span>
       </div>
      </div>
     </form>
    </div>
   </div>
  </div>

  <?php include $Dir . "/include/admin/footer.php"; ?>
  <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
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
 <?php include $Dir . "/include/admin/footer_files.php"; ?>
</body>

</html>