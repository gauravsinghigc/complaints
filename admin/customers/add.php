<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "ADD New Customers";
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
                        <a href="index.php" class="btn btn-sm btn-default mb-0 action-btn mr-1"><i class="fa fa-angle-left"></i></a>
                        <h4 class="app-heading w-100 mb-0 mt-0"><?php echo $PageName; ?> | <?php echo $PageDescription; ?></h4>
                      </div>
                    </div>
                  </div>
                  <form action="<?php echo CONTROLLER; ?>/customer.php" method="POST">
                    <?php FormPrimaryInputs(true); ?>
                    <div class="row">
                      <div class="col-md-6">
                        <h5 class="app-sub-heading">Customer Information</h5>
                        <div class="row mb-10px">
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-12">
                            <label>Salutations</label>
                            <select class="form-control" name="UserSalutation" required="">
                              <option value="Mr.">Mr.</option>
                              <option value="Mrs.">Mrs.</option>
                              <option value="Miss">Miss</option>
                              <option value="M/s">M/s</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>User First Name</label>
                            <input type="text" name="UserFirstName" class="form-control" required="" placeholder="First Name">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-12">
                            <label>User Full Name</label>
                            <input type="text" name="UserLastName" class="form-control" required="" placeholder="Last Name">
                          </div>
                        </div>
                        <div class="row mb-10px">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>Primary Contact Number</label>
                            <input type="phone" name="UserPhoneNumber" class="form-control" value="+91" placeholder="+91">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>Primary Contact Email-ID</label>
                            <input type="email" name="UserEmailId" class="form-control">
                          </div>
                        </div>
                        <div class="row mb-10px">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label>Company Name</label>
                            <input type="text" name="UserCompanyName" list="UserCompanyName" class="form-control" placeholder="ABC Pvt Ltd">
                            <?php echo SUGGEST("users", "UserCompanyName", "ASC"); ?>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label>Company Work Fields/Environment</label>
                            <input type="text" name="UserWorkFeilds" list="UserWorkFeilds" class="form-control" placeholder="electronics, garments, media etc">
                            <?php echo SUGGEST("users", "UserWorkFeilds", "ASC"); ?>
                          </div>
                        </div>
                        <div class="row mb-10px">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label>Designation</label>
                            <input type="text" name="UserDesignation" list="UserDesignation" class="form-control" placeholder="accountant, hr, sale executing, director etc">
                            <?php echo SUGGEST("users", "UserDesignation", "ASC"); ?>
                          </div>
                        </div>
                        <div class="row mb-10px">
                          <div class="form-group col-lg-12 col-lg-12 col-sm-12">
                            <label>Notes/Remarks</label>
                            <textarea class="form-control" rows="2" name="UserNotes"></textarea>
                          </div>
                        </div>
                        <div class="row mb-10px">
                          <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label>User Status</label>
                            <select class="form-control" name="UserStatus">
                              <option value="1" selected="">Active</option>
                              <option value="0">Inactive</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label>User Type</label>
                            <input type="text" name="UserType" class="form-control" value="Customer" readonly="">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label>Date of Birth</label>
                            <input type="date" name="UserDateOfBirth" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="row">
                          <div class="col-md-12">
                            <h5 class="app-sub-heading">Customer Address</h5>
                          </div>
                        </div>

                        <div class="row mb-10px">
                          <div class="form-group col-lg-12 col-md-12 col-12">
                            <label>Customer/Company Street Address</label>
                            <textarea class="form-control" name="UserStreetAddress" rows="2"></textarea>
                          </div>
                        </div>

                        <div class="row mb-10px">
                          <div class="form-group col-lg-6 col-md-6 col-12">
                            <label>Sector/Locality/Area/Landmark</label>
                            <input type="text" name="UserLocality" class="form-control">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-12">
                            <label>City</label>
                            <input type="text" name="UserCity" class="form-control">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-12">
                            <label>State</label>
                            <input type="text" name="UserState" class="form-control">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-12">
                            <label>Country</label>
                            <input type="text" list="UserCountry" name="UserCountry" class="form-control">
                            <datalist id="UserCountry">
                              <?php echo ALLCOUNTRIES(NULL, true); ?>
                            </datalist>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-12">
                            <label>Pincode</label>
                            <input type="text" name="UserPincode" class="form-control">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-12">
                            <label>Address Type</label>
                            <select class="form-control" name="UserAddressType">
                              <?php InputOptions(["Office Address", "Home Address"], null); ?>
                            </select>
                          </div>
                          <div class="form-group col-lg-8 col-md-8 col-12">
                            <label>Contact Person At Address</label>
                            <input type="text" name="UserAddressContactPerson" class="form-control">
                          </div>
                          <div class="form-group col-lg-12 col-md-12">
                            <label>Address Notes</label>
                            <textarea class="form-control" rows="2" name="UserAddressNotes"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-10px mb-20px">
                      <div class="form-group col-lg-12 col-md-12 col-12">
                        <button class="btn btn-md btn-success" type="submit" name="SaveCustomer"><i class="fa fa-check-circle"></i> Save Customers</button>
                        <button class="btn btn-md btn-default" type="reset"><i class="fa fa-refresh"></i> Reset</button><br>
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