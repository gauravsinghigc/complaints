<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "User Details";
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
                                       <div class="col-md-4 form-group">
                                          <label>FullName</label>
                                          <input type="text" name="UserFullName" class="form-control" value="<?php echo GET_DATA("UserFullName"); ?>" required="">
                                       </div>
                                       <div class="col-md-4 form-group">
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

                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>

      <?php
      include $Dir . "/include/admin/footer.php"; ?>
   </div>

   <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>