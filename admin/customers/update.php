<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "Update Customers Details";
$PageDescription = "Manage all customers";

if (isset($_GET['customerid'])) {
  $UpdateCustomerRecord = SECURE($_GET['customerid'], "d");
  $_SESSION['UPDATE_CUSTOMER_RECORD'] = $UpdateCustomerRecord;
} else {
  $UpdateCustomerRecord = $_SESSION['UPDATE_CUSTOMER_RECORD'];
}
$UserSql = "SELECT * FROM users where UserId='$UpdateCustomerRecord'";
$UserAddressSql = "SELECT * FROM user_addresses where UserAddressUserId='$UpdateCustomerRecord'";
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
      document.getElementById("customers").classList.add("active");
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
                      <div class="flex-s-b">
                        <a href="../complaints/details/" class="btn btn-sm btn-default mb-0 action-btn mr-1"><i class="fa fa-angle-left"></i></a>
                        <h4 class="app-heading w-100 mb-0 mt-0"><?php echo $PageName; ?></h4>
                      </div>
                    </div>
                  </div>
                  <form action="../../controller/usercontroller.php" method="POST">
                    <?php FormPrimaryInputs(true, [
                      "UserId" => $UpdateCustomerRecord,
                    ]); ?>
                    <div class="row">
                      <div class="col-md-12">
                        <h5>Primary Details</h5>
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-6">
                        <label>Salutation</label>
                        <select class="form-control" name="UserSalutation" required="">
                          <?php SelectInputOptions(SALUTATION, FETCH($UserSql, "UserSalutation")); ?>
                        </select>
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-6">
                        <label>Full Name</label>
                        <input type="text" name="UserFullName" class="form-control" value="<?php echo FETCH($UserSql, "UserFullName"); ?>" placeholder="Full Name">
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-6">
                        <label>Phone no</label>
                        <input type="phone" name="UserPhoneNumber" class="form-control" value="<?php echo FETCH($UserSql, "UserPhoneNumber"); ?>" placeholder="+91">
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                        <label>Email-ID</label>
                        <input type="email" name="UserEmailId" value="<?php echo FETCH($UserSql, "UserEmailId"); ?>" class="form-control" placeholder="email@domain.tld">
                      </div>
                      <div class="col-md-12">
                        <h5 class="mt-3">Address Details</h5>
                        <div class="row mb-10px">
                          <div class="form-group col-lg-12 col-md-12 col-12">
                            <label>Street Address</label>
                            <textarea class="form-control" name="UserStreetAddress" rows="3"><?php echo SECURE(FETCH($UserAddressSql, "UserStreetAddress"), "d"); ?></textarea>
                          </div>
                        </div>

                        <div class="row mb-10px">
                          <div class="form-group col-lg-6 col-md-6 col-12">
                            <label>Sector/Locality/Area/Landmark</label>
                            <input type="text" name="UserLocality" value="<?php echo SECURE(FETCH($UserAddressSql, "UserLocality"), "d"); ?>" class="form-control">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-12">
                            <label>City</label>
                            <input type="text" name="UserCity" value="<?php echo SECURE(FETCH($UserAddressSql, "UserCity"), "d"); ?>" class="form-control">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-12">
                            <label>State</label>
                            <input type="text" name="UserState" value="<?php echo SECURE(FETCH($UserAddressSql, "UserState"), "d"); ?>" class="form-control">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-12">
                            <label>Country</label>
                            <input type="text" name="UserCountry" value="<?php echo SECURE(FETCH($UserAddressSql, "UserCountry"), "d"); ?>" class="form-control">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-12">
                            <label>Pincode</label>
                            <input type="text" name="UserPincode" value="<?php echo SECURE(FETCH($UserAddressSql, "UserPincode"), "d"); ?>" class="form-control">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <button type="submit" name="UpdateUserDetails" class="btn btn-md btn-success">Update Details</button>
                            <a href="../complaints/details/" class="btn btn-md btn-default mt-3">Cancel</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
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