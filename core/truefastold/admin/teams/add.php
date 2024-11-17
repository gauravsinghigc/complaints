<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "ADD New team Member";
$PageDescription = "Manage all team";
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
      document.getElementById("teams").classList.add("active");
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

      <div class="d-flex align-items-center mb-1">
        <div>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;"><?php echo $PageName; ?></a></li>
          </ol>
          <h1 class="page-header mb-0"><?php echo $PageName; ?></h1>
        </div>
      </div>
      <form action="<?php echo CONTROLLER; ?>/customer.php" method="POST">
        <?php FormPrimaryInputs(true); ?>
        <div class="row">
          <div class="col-md-6">
            <h4 class="app-heading">Customer Information</h4>
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
              <div class="form-group col-lg-12 col-lg-12 col-sm-12">
                <label>Notes/Remarks</label>
                <textarea class="form-control" rows="3" name="UserNotes"></textarea>
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
                <select name="UserType" class="form-control" required="">
                  <option value="">Select User Type</option>
                  <option value="SERVICE_EXECUTIVE">SERVICE_EXECUTIVE</option>
                  <option value="TeamMember">Team Member</option>
                </select>
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
                <h4 class="app-heading">Address Details</h4>
              </div>
            </div>

            <div class="row mb-10px">
              <div class="form-group col-lg-12 col-md-12 col-12">
                <label>Street Address</label>
                <textarea class="form-control" name="UserStreetAddress" rows="3"></textarea>
              </div>
            </div>

            <div class="row mb-10px">
              <div class="form-group col-lg-4 col-md-4 col-12">
                <label>Sector/Locality/Area</label>
                <input type="text" name="UserLocality" class="form-control">
              </div>
              <div class="form-group col-lg-4 col-md-4 col-12">
                <label>City</label>
                <input type="text" name="UserCity" class="form-control">
              </div>
              <div class="form-group col-lg-4 col-md-4 col-12">
                <label>State</label>
                <input type="text" name="UserState" class="form-control">
              </div>
              <div class="form-group col-lg-4 col-md-4 col-12">
                <label>Country</label>
                <input type="text" name="UserCountry" class="form-control">
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
              <div class="form-group col-lg-12 col-md-12">
                <label>Address Notes</label>
                <textarea class="form-control" rows="2" name="UserAddressNotes"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-10px mb-20px">
          <div class="form-group col-lg-12 col-md-12 col-12">
            <div class="action-btn">
              <button class="btn btn-md btn-success" type="submit" name="SaveCustomer"><i class="fa fa-check-circle"></i> Save Team Member</button>
              <button class="btn btn-md btn-default" type="reset"><i class="fa fa-refresh"></i> Reset</button><br>
            </div>
          </div>
        </div>
      </form>
    </div>
    <?php include $Dir . "/include/admin/footer.php"; ?>
    <a href=" javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>
</body>

</html>