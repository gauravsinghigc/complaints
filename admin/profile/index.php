<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Customers";
$PageDescription = "Manage all customers";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta name="keywords" content="<?php echo APP_NAME; ?>">
  <meta name="description" content="<?php echo SHORT_DESCRIPTION; ?>">
  <?php include $Dir . "/include/admin/header_files.php"; ?>
  <script type="text/javascript">
    function SidebarActive() {
      document.getElementById("profile").classList.add("active");
      document.getElementById("profile_view").classList.add("active");
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
                    <div class="col-md-8 col-lg-8 col-sm-7 col-12">
                      <form class="form" action="../../controller/authcontroller.php" method="POST">
                        <div class="row">
                          <div class="col-md-12 col-sm-12">
                            <h4 class="app-sub-heading">Personal Details</h4>
                          </div>
                          <?php FormPrimaryInputs(true); ?>
                          <div class="form-group col-md-6 col-sm-6">
                            <label>Full Name</label>
                            <input type="text" name="UserName" value="<?php echo LOGIN_UserFullName; ?>" class="form-control" required="">
                          </div>
                          <div class="form-group col-md-6 col-sm-6">
                            <label>Phone Number</label>
                            <input type="text" name="UserPhone" value="<?php echo LOGIN_UserPhoneNumber; ?>" class="form-control" required="">
                          </div>
                          <div class="form-group col-md-6 col-sm-6">
                            <label>Email Id</label>
                            <input type="email" name="UserEmailId" value="<?php echo LOGIN_UserEmailId; ?>" class="form-control" required="">
                          </div>
                          <br>
                          <div class="col-md-12">
                            <br>
                            <button type="Submit" name="UpdateProfile" class="btn btn-md btn-success">Update Details</button>
                          </div>
                        </div>
                      </form>
                      <hr>
                      <form class="form" action="../../controller/authcontroller.php" method="POST">
                        <?php FormPrimaryInputs(true); ?>
                        <div class="row">
                          <div class="col-md-12 col-sm-12">
                            <h4 class="app-sub-heading">Update Password <span id="passmsg"></span></h4>
                          </div>
                          <div class="form-group col-md-6 col-sm-6">
                            <label>Enter New Password</label>
                            <input type="password" name="UserPassword" oninput="checkpass()" id="pass1" class="form-control" required="">
                          </div>
                          <div class="form-group col-md-6 col-sm-6">
                            <label>Re-Enter New Password</label>
                            <input type="password" name="UserPassword_2" oninput="checkpass()" id="pass2" class="form-control" required="">
                          </div>
                          <br>
                          <div class="col-md-12">
                            <br>
                            <button type="Submit" id="passbtn" name="UpdatePassword" class="btn btn-md btn-success disabled">Update Password</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-5 col-12">
                      <div class="p-2 border-success">
                        <div class="br10 app-bg-light p-3 text-center">
                          <center>
                            <img src="<?php echo LOGIN_UserProfileImage; ?>" class="w-25 mx-auto d-block rounded config-logo" style="border-radius:100% !important;">
                          </center>
                          <form class="form m-t-3" action="../../controller/usercontroller.php" method="POST" enctype="multipart/form-data">
                            <input type="text" name="updateprofileimage" value="true" hidden="">
                            <input type="text" name="current_img" value="<?php echo SECURE(LOGIN_UserProfileImage, "e"); ?>" hidden="">
                            <?php FormPrimaryInputs(true); ?>
                            <label for="UploadProfileimg">
                              <img src="<?php echo STORAGE_URL_D; ?>/tool-img/img-upload.png" class="w-pr-10 upload-icon">
                            </label>
                            <input type="file" class="hidden" onchange="form.submit()" hidden="" name="UserProfileImage" id="UploadProfileimg" value="<?php echo APP_LOGO; ?>" accept="images/*">
                          </form>
                        </div>
                        <p class="m-t-10">
                          <span class="fs-20"> <?php echo LOGIN_UserFullName; ?></span><br>
                          <span><i class="fa fa-phone text-info"></i> <?php echo LOGIN_UserPhoneNumber; ?></span><br>
                          <span><i class="fa fa-envelope text-danger"></i> <?php echo LOGIN_UserEmailId; ?></span><br>
                          <span><i class="fa fa-user text-warning"></i> <?php echo LOGIN_UserType; ?></span><br>
                          <span><i class="fa fa-calendar text-primary"></i> CreatedAt: <?php echo LOGIN_UserCreatedAt; ?></span><br>
                          <span><i class="fa fa-calendar text-primary"></i> UpdatedAt: <?php echo LOGIN_UserUpdatedAt; ?></span><br>
                        </p>
                      </div>
                    </div>

                    <script>
                      function checkpass() {
                        var pass1 = document.getElementById("pass1");
                        var pass2 = document.getElementById("pass2");
                        if (pass1.value === pass2.value) {
                          document.getElementById("passbtn").classList.remove("disabled");
                          document.getElementById("passmsg").classList.add("text-success");
                          document.getElementById("passmsg").classList.remove("text-danger");
                          document.getElementById("passmsg").innerHTML = "<i class='fa fa-check-circle-o'></i> Password Matched!";
                        } else {
                          document.getElementById("passmsg").classList.remove("text-success");
                          document.getElementById("passmsg").classList.add("text-danger");
                          document.getElementById("passbtn").classList.add("disabled");
                          document.getElementById("passmsg").innerHTML = "<i class='fa fa-warning'></i> Password do not matched!";
                        }
                      }
                    </script>
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