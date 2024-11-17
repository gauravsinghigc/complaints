<?php
$Dir = "../../";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "System Profile";
$PageDescription = "Manage System Profile, address, logo";
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
      document.getElementById("configs").classList.add("active");
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
                    <div class="col-md-12 mb-2">
                      <h4 class="app-heading"><?php echo $PageName; ?></h4>
                      <a href="index.php" class="btn btn-sm btn-default m-1">System Profile</a>
                      <a href="advance-settings.php" class="btn btn-sm btn-default m-1">Advance Settings</a>
                    </div>
                    <div class="col-md-8 col-lg-8 col-sm-12 col-12">
                      <form class="form row mb-50px" action="../../controller/configcontroller.php" method="POST">
                        <?php FormPrimaryInputs(true); ?>
                        <div class="form-group col-md-6 col-sm-6">
                          <label>Company Name</label>
                          <input type="text" name="APP_NAME" value="<?php echo APP_NAME; ?>" class="form-control" required="">
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                          <label>Tagline</label>
                          <input type="text" name="TAGLINE" value="<?php echo TAGLINE; ?>" class="form-control" required="">
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                          <label>Phone Number</label>
                          <input type="text" name="PRIMARY_PHONE" value="<?php echo PRIMARY_PHONE; ?>" class="form-control" required="">
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                          <label>Email-ID</label>
                          <input type="text" name="PRIMARY_EMAIL" value="<?php echo PRIMARY_EMAIL; ?>" class="form-control" required="">
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                          <label>GST No</label>
                          <input type="text" name="PRIMARY_GST" value="<?php echo PRIMARY_GST; ?>" class="form-control" required="">
                        </div>
                        <div class="form-group col-md-12">
                          <label>Short Descriptions</label>
                          <textarea class="form-control" name="SHORT_DESCRIPTION" required="" rows="2"><?php echo SECURE(SHORT_DESCRIPTION, "d"); ?></textarea>
                        </div>
                        <div class="form-group col-md-12">
                          <label>Complete Address (Primary)</label>
                          <textarea class="form-control" name="PRIMARY_ADDRESS" required="" rows="3"><?php echo SECURE(PRIMARY_ADDRESS, 'd'); ?></textarea>
                        </div>
                        <div class="form-group col-md-12">
                          <label>Map Location Url</label>
                          <textarea type="url" class="form-control" name="PRIMARY_MAP_LOCATION_LINK" required="" rows="5"><?php echo SECURE(PRIMARY_MAP_LOCATION_LINK, 'd'); ?></textarea>
                        </div>
                        <div class="form-group col-md-12">
                          <label>Android APP Link (Play store App link)</label>
                          <textarea type="url" class="form-control" name="DOWNLOAD_ANDROID_APP_LINK" required="" rows="2"><?php echo DOWNLOAD_ANDROID_APP_LINK; ?></textarea>
                        </div>
                        <div class="form-group col-md-12">
                          <label>iOS App Link</label>
                          <textarea type="url" class="form-control" name="DOWNLOAD_IOS_APP_LINK" required="" rows="2"><?php echo DOWNLOAD_IOS_APP_LINK; ?></textarea>
                        </div>
                        <div class="form-group col-md-12">
                          <label>Brocher or Pdf File Link</label>
                          <textarea type="url" class="form-control" name="DOWNLOAD_BROCHER_LINK" required="" rows="2"><?php echo DOWNLOAD_BROCHER_LINK; ?></textarea>
                        </div>
                        <div class="col-md-12 mt-15px">
                          <button type="Submit" name="UpdatePrimaryConfigurations" class="btn btn-lg btn-primary">Update Details</button>
                        </div>
                      </form>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-5 col-12 text-center">
                      <H5 class="app-sub-heading">Login Background Image</H5>
                      <div class="text-center app-bg-light">
                        <img src="<?php echo LOGIN_BG_IMAGE; ?>" class="w-100 br20">
                        <form class="form m-t-3" action="../../controller/configcontroller.php" method="POST" enctype="multipart/form-data">
                          <input type="text" name="Update_LOGIN_BG_IMAGE" value="true" hidden="">
                          <?php echo CurrentFile(LOGIN_BG_IMAGE); ?>
                          <?php FormPrimaryInputs(true); ?>
                          <label for="UpdateLoginBg">
                            <img src="<?php echo STORAGE_URL_D; ?>/tool-img/img-upload.png" class="w-pr-10 upload-icon">
                          </label>
                          <input type="file" class="hidden" onchange="form.submit()" hidden="" name="LOGIN_BG_IMAGE" id="UpdateLoginBg" value="<?php echo LOGIN_BG_IMAGE; ?>" accept="images/*">
                        </form>
                      </div>
                      <div class="text-center">
                        <H5 class="app-sub-heading">System Main Logo</H5>
                        <center>
                          <img src="<?php echo $MAIN_LOGO; ?>" class="w-25 mx-auto d-block rounded config-logo">
                        </center>
                        <form class="form" action="../../controller/configcontroller.php" method="POST" enctype="multipart/form-data">
                          <input type="text" name="updatelogo" value="true" hidden="">
                          <?php echo CurrentFile(APP_LOGO); ?>
                          <?php FormPrimaryInputs(true); ?>
                          <label for="UploadAppLogo">
                            <img src="<?php echo STORAGE_URL_D; ?>/tool-img/img-upload.png" class="w-pr-10 upload-icon">
                          </label>
                          <input type="file" class="hidden" onchange="form.submit()" hidden="" name="APP_LOGO" id="UploadAppLogo" value="<?php echo APP_LOGO; ?>" accept="images/*">
                        </form>
                      </div>
                      <p class="m-t-10">
                        <span class="fs-20"> <?php echo APP_NAME; ?></span><br>
                        <span><i class="fa fa-phone text-info"></i> <?php echo PRIMARY_PHONE; ?></span><br>
                        <span><i class="fa fa-envelope text-danger"></i> <?php echo PRIMARY_EMAIL; ?></span><br>
                        <span><i class="fa fa-tag text-warning"></i> <?php echo TAGLINE; ?></span><br>
                        <span><i class="fa fa-hashtag text-warning"></i> <?php echo GST_NO; ?></span><br>
                        <span><i class="fa fa-list text-primary"></i> <?php echo SECURE(SHORT_DESCRIPTION, "d"); ?></span><br>
                        <span><i class="fa fa-map-marker text-success"></i> <?php echo SECURE(PRIMARY_ADDRESS, "d"); ?></span><br>
                      </p>
                      <iframe src="<?php echo SECURE(PRIMARY_MAP_LOCATION_LINK, 'd'); ?>" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy">
                      </iframe>
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