<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "Create New Sale";
$PageDescription = "Manage all team";


//start invoice session
$_SESSION['INVOICE_AND_CREATION_SESSION'] = date("d/m/y/") . rand(11111, 9999999999);
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
      document.getElementById("sales").classList.add("active");
      document.getElementById("add_sale").classList.add("active");
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

      <div class="d-flex align-items-center mb-1">
        <div>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;"><?php echo $PageName; ?></a></li>
          </ol>
          <h1 class="page-header mb-0"><?php echo $PageName; ?></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="flex-space-evenly">
            <div>
              <a href="#" class="btn btn-md btn-success">1</a> Select Customers <i class="fa fa-angle-double-right text-grey"></i>
            </div>
            <div>
              <a href="#" class="btn btn-md btn-default">2</a> Select Products <i class="fa fa-angle-double-right text-grey"></i>
            </div>
            <div>
              <a href="#" class="btn btn-md btn-default">3</a> Add Payment & Invoice Details <i class="fa fa-angle-double-right text-grey"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <h4 class="app-sub-heading">Add or Select Customers</h4>
        </div>
        <div class="col-md-6">
          <h4 class="app-heading">Search Customers</h4>
          <form action="" method="get">
            <div class="flex-s-b">
              <div class="form-group w-100">
                <input type="text" class="form-control form-control-lg" onchange="form.submit()" list="UserPhoneNumber" placeholder="Search Customer by phone number" name="UserPhoneNumber">
                <?php SUGGEST("users", "UserPhoneNumber", "ASC"); ?>
              </div>
            </div>
          </form>
          <br>
          <?php if (isset($_GET['UserPhoneNumber'])) {
            $UserPhoneNumber = $_GET['UserPhoneNumber']; ?>
            <h5 class="text-success"> Search Results : <b><i class="fa fa-check-cirle-o"></i><?php echo TOTAL("SELECT * FROM users where UserPhoneNumber like '%$UserPhoneNumber%'"); ?> </b> results found!</h5>
            <?php
            $FetchCustomers = FetchConvertIntoArray("SELECT * FROM users where UserPhoneNumber like '%$UserPhoneNumber%'", true);
            if ($FetchCustomers == null) {
              NoData("No Customer Found!");
            } else { ?>
              <?php
              foreach ($FetchCustomers as $Customers) {
              ?>
                <p class="shadow-sm p-2 rounded-1 pb-20px">
                  <span class="fs-16px bold text-grey"><?php echo $Customers->UserSalutation; ?></span>
                  <span class="fs-16px bold"><?php echo $Customers->UserFullName; ?></span>
                  <span class="pull-right text-grey italic">CUSTOMERID000<?php echo $Customers->UserId; ?></span><br>
                  <span class="fs-13px">
                    <span><b>Company name : </b><?php echo $Customers->UserDesignation; ?> @ <?php echo $Customers->UserCompanyName; ?> </span><br>
                    <span><b>Department : </b><?php echo $Customers->UserDepartment; ?></span><br>
                    <span><b>Phone Number : </b><?php echo $Customers->UserPhoneNumber; ?></span><br>
                    <span><b>Email-ID : </b><?php echo $Customers->UserEmailId; ?></span><br>
                    <span><b class="text-grey">Address : </b>
                      <?php
                      $UserId = $Customers->UserId;
                      $CheckAddress = CHECK("SELECT * FROM user_addresses where UserAddressUserId='$UserId'");
                      if ($CheckAddress == null) {
                        echo "No Address found!";
                      } else {
                        $FetchAddress = FetchConvertIntoArray("SELECT * FROM user_addresses where UserAddressUserId='$UserId'", true);
                        if ($FetchAddress != null) {
                          foreach ($FetchAddress as $Address) {
                            $UserAddressId = $Address->UserAddressId;
                            echo "<br><b>" . SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserAddressType"), "d") . "</b> - ";
                            echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserStreetAddress"), "d");
                            echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserLocality"), "d");
                            echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserCity"), "d");
                            echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserState"), "d");
                            echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserCountry"), "d");
                            echo "-";
                            echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserPincode"), "d");
                            echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserAddressContactPerson"), "d");
                          }
                        }
                      }
                      ?>
                    </span>
                  </span><br><br>
                  <a href="select-products.php?customer_id=<?php echo SECURE($UserId, "e"); ?>" class="btn btn-sm btn-success">Select & Continue <i class="fa fa-angle-right"></i></a>
                </p>

              <?php }
              ?>
          <?php
            }
          } ?>

        </div>
        <div class="col-md-6">
          <h4 class="app-heading">Add New Customer</h4>
          <form action="<?php echo CONTROLLER; ?>/customer.php" method="POST">
            <?php FormPrimaryInputs($url = ADMIN_URL . "/sales/select-products.php", [
              "success_url" => ADMIN_URL . "/sales/select-products.php",
            ]); ?>
            <div class="row mb-10px">
              <div class="form-group col-lg-2 col-md-2 col-sm-6 col-12">
                <label>Salutations</label>
                <select class="form-control" name="UserSalutation" required="">
                  <?php SelectInputOptions(SALUTATION, null); ?>
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
                <label>Work Department</label>
                <input type="text" name="UserDepartment" list="UserDepartment" class="form-control" placeholder="IT, HR, Account, Sales, Marketing etc">
                <?php echo SUGGEST("users", "UserDepartment", "ASC"); ?>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6">
                <label>Designation</label>
                <input type="text" name="UserDesignation" list="UserDesignation" class="form-control" placeholder="accountant, hr, sale executing, director etc">
                <?php echo SUGGEST("users", "UserDesignation", "ASC"); ?>
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
                <input type="text" name="UserType" class="form-control" value="Customer" readonly="">
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label>Date of Birth</label>
                <input type="date" name="UserDateOfBirth" class="form-control" value="<?php echo date('Y-m-d'); ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <h4 class="app-heading">Customer Address</h4>
              </div>
            </div>

            <div class="row mb-10px">
              <div class="form-group col-lg-12 col-md-12 col-12">
                <label>Customer/Company Street Address</label>
                <textarea class="form-control" name="UserStreetAddress" rows="3"></textarea>
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
              <div class="form-group col-lg-12 col-md-12">
                <label>Location Map Url (If Have)</label>
                <textarea class="form-control" rows="2" name="UserAddressMapUrl"></textarea>
              </div>
            </div>
            <div class="row mb-10px mb-20px">
              <div class="form-group col-lg-12 col-md-12 col-12">
                <div class="action-btn">
                  <button class="btn btn-md btn-success" type="submit" name="SaveCustomer"><i class="fa fa-check-circle"></i> Save & Continue</button>
                  <button class="btn btn-md btn-default" type="reset"><i class="fa fa-refresh"></i> Reset</button><br>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php include $Dir . "/include/admin/footer.php"; ?>
    <a href=" javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>
</body>

</html>