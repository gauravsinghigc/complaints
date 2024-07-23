<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "ADD New Complaint";
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
      document.getElementById("services").classList.add("active");
      document.getElementById("add_services").classList.add("active");
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
                    <div class="col-md-7">
                      <div class="flex-s-b mb-2">
                        <a href="index.php" class="btn btn-sm btn-default mb-0 action-btn mr-1"><i class="fa fa-angle-left"></i></a>
                        <h4 class="app-heading w-100 mb-0 mt-0"><?php echo $PageName; ?></h4>
                      </div>
                      <form action="" method="get">
                        <div class="flex-s-b">
                          <div class="form-group w-100">
                            <input type="text" class="form-control form-control-lg" onchange="form.submit()" list="UserPhoneNumber" placeholder="Search Customer by phone number" name="UserPhoneNumber">
                            <?php SUGGEST_SQL_DATA("SELECT * FROM users where UserType='Customer'", "UserPhoneNumber", "ASC"); ?>
                          </div>
                        </div>
                      </form>
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
                            <div class="data-list">
                              <span class="fs-16px bold text-grey"><?php echo $Customers->UserSalutation; ?></span>
                              <span class="fs-16px bold"><?php echo $Customers->UserFullName; ?></span>
                              <span class="pull-right text-grey italic">CUSTOMERID000<?php echo $Customers->UserId; ?></span><br>
                              <span class="fs-13px">
                                <span><b>Phone Number : </b><?php echo $Customers->UserPhoneNumber; ?></span><br>
                                <span><b>Email-ID : </b><?php echo $Customers->UserEmailId; ?></span><br>
                                <span><b class="text-grey">Address : </b>
                                  <?php
                                  $UserId = $Customers->UserId;
                                  $CheckAddress = CHECK("SELECT * FROM user_addresses where UserAddressUserId='$UserId'");
                                  if ($CheckAddress == null) {
                                    echo "No Address found!";
                                    $StreetAddress = "";
                                    $Locality = "";
                                    $userCity = "";
                                    $states = "";
                                    $usercountry = "";
                                    $pincode = "";
                                  } else {
                                    $FetchAddress = FetchConvertIntoArray("SELECT * FROM user_addresses where UserAddressUserId='$UserId'", true);
                                    if ($FetchAddress != null) {
                                      foreach ($FetchAddress as $Address) {
                                        $UserAddressId = $Address->UserAddressId;
                                        echo "<br><b>" . SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserAddressType"), "d") . "</b> - ";
                                        echo $StreetAddress =  SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserStreetAddress"), "d");
                                        echo $Locality =  SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserLocality"), "d");
                                        echo $userCity = SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserCity"), "d");
                                        echo $states = SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserState"), "d");
                                        echo $usercountry = SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserCountry"), "d");
                                        echo "-";
                                        echo $pincode = SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserPincode"), "d");
                                        echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserAddressContactPerson"), "d");
                                      }
                                    }
                                  }
                                  ?>
                                </span>
                              </span><br><br>
                              <a href="select-complaint-invoices.php?customer_id=<?php echo SECURE($UserId, "e"); ?>" class="btn btn-sm btn-success">Select & Continue <i class="fa fa-angle-right"></i></a>
                              <a onclick="Databar('Update_<?php echo $Customers->UserId; ?>')" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Edit Details</a>
                              <div class="row">
                                <div class="col-md-12">
                                  <h5 class="app-sub-heading">Registered Complaints</h5>
                                </div>
                                <?php
                                $Complaints = FetchConvertIntoArray("SELECT * FROM complaints where ComplaintsUserId='" . $Customers->UserId . "' ORDER BY DATE(ComplaintCreatedAt) DESC", true);
                                if ($Complaints == null) {
                                  NoDataTableView("No Complaints Found!", 7);
                                } else {
                                  $sNO = 0;
                                  foreach ($Complaints as $Complaint) {
                                    $sNO++; ?>
                                    <div class="col-md-6 col-sm-6 col-12 mb-2">
                                      <a href="details/?id=<?php echo $Complaint->ComplaintsId; ?>">
                                        <p class="data-list">
                                          <small class="text-grey italic"><?php echo DATE_FORMATE2("d M, Y", $Complaint->ComplaintCreatedAt); ?></small>
                                          <span>
                                            <span class="pull-right">
                                              <span class="btn btn-xs btn-default"><?php echo $Complaint->ComplaintStatus; ?></span><br>
                                              <span class="text-grey">Complaint No</span><br>
                                              <span class="bold">
                                                <?php echo $Complaint->ComplaintsCustomRefId; ?>
                                              </span>
                                            </span>
                                          </span><br>
                                          <span>
                                            <span class="text-grey">Customer Details</span><br>
                                            <span class="bold">
                                              <a href="details/?uid=<?php echo SECURE($Complaint->ComplaintsUserId, "e"); ?>"><i class="fa fa-user"></i> <?php echo FETCH("SELECT * FROM users Where UserID='" . $Complaint->ComplaintsUserId . "'", "UserFullName"); ?></a>
                                              <br> <?php echo $Complaint->ComplaintAddress; ?>
                                            </span>
                                          </span>
                                        </p>
                                      </a>
                                    </div>
                                <?php }
                                } ?>
                              </div>
                              <div style="display:none;" id="Update_<?php echo $Customers->UserId; ?>">
                                <h5 class="app-sub-heading">Update Details</h5>
                                <form action="../../controller/ComplaintController.php" method="POST">
                                  <?php FormPrimaryInputs(true, [
                                    "UserId" => $UserId
                                  ]); ?>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <h5>Primary Details</h5>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-6">
                                      <label>Salutation</label>
                                      <select class="form-control" name="UserSalutation" required="">
                                        <?php SelectInputOptions(SALUTATION, $Customers->UserSalutation); ?>
                                      </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-6">
                                      <label>Full Name</label>
                                      <input type="text" name="UserFullName" class="form-control" value="<?php echo $Customers->UserFullName; ?>" placeholder="Full Name">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-6">
                                      <label>Phone no</label>
                                      <input type="phone" name="UserPhoneNumber" class="form-control" value="<?php echo $Customers->UserPhoneNumber; ?>" placeholder="+91">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                                      <label>Email-ID</label>
                                      <input type="email" name="UserEmailId" value="<?php echo $Customers->UserEmailId; ?>" class="form-control" placeholder="email@domain.tld">
                                    </div>
                                    <div class="col-md-12">
                                      <h5 class="mt-3">Address Details</h5>
                                      <div class="row mb-10px">
                                        <div class="form-group col-lg-12 col-md-12 col-12">
                                          <label>Street Address</label>
                                          <textarea class="form-control" name="UserStreetAddress" rows="3"><?php echo $StreetAddress; ?></textarea>
                                        </div>
                                      </div>

                                      <div class="row mb-10px">
                                        <div class="form-group col-lg-6 col-md-6 col-12">
                                          <label>Sector/Locality/Area/Landmark</label>
                                          <input type="text" name="UserLocality" value="<?php echo $Locality; ?>" class="form-control">
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6 col-12">
                                          <label>City</label>
                                          <input type="text" name="UserCity" value="<?php echo $userCity; ?>" class="form-control">
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-12">
                                          <label>State</label>
                                          <input type="text" name="UserState" value="<?php echo $states; ?>" class="form-control">
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-12">
                                          <label>Country</label>
                                          <input type="text" name="UserCountry" value="<?php echo $usercountry; ?>" class="form-control">
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-12">
                                          <label>Pincode</label>
                                          <input type="text" name="UserPincode" value="<?php echo $pincode; ?>" class="form-control">
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                          <button type="submit" name="UpdateUserDetails" class="btn btn-md btn-success mt-4">Update Details</button>
                                          <a onclick="Databar('Update_<?php echo $Customers->UserId; ?>')" class="btn btn-md btn-default mt-0">Cancel</a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          <?php }
                          ?>
                      <?php
                        }
                      } ?>
                    </div>
                    <div class="col-md-5">
                      <h4 class="app-heading mt-0">Add New Customer</h4>
                      <form action="<?php echo CONTROLLER; ?>/ComplaintController.php" method="POST">
                        <?php FormPrimaryInputs(ADMIN_URL . "/services/select-complaint-invoices.php", [
                          "success_url" => ADMIN_URL . "/complaints/select-complaint-invoices.php",
                          "UserStatus" => "1",
                          "UserType" => "Customer"
                        ]); ?>
                        <div class="row mb-10px">
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-12">
                            <label>Salutations</label>
                            <select class="form-control" name="UserSalutation" required="">
                              <?php SelectInputOptions(SALUTATION, null); ?>
                            </select>
                          </div>
                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-12">
                            <label>Full Name</label>
                            <input type="text" name="UserFullName" class="form-control" required="" placeholder="Full Name">
                          </div>
                        </div>
                        <div class="row mb-10px">
                          <div class="form-group col-lg-10 col-md-10 col-sm-10 col-12">
                            <label>Primary Contact Number</label>
                            <input type="phone" name="UserPhoneNumber" class="form-control" value="" placeholder="+91">
                          </div>
                          <div class="form-group col-lg-10 col-md-10 col-sm-10 col-12">
                            <label>Primary Contact Email-ID</label>
                            <input type="email" name="UserEmailId" class="form-control" placeholder="email@domain.tld">
                          </div>
                        </div>
                        <div class="row mb-10px">
                          <div class="form-group col-lg-6 col-md-6 col-12">
                            <label>Locality/Area</label>
                            <input type="text" name="UserLocality" value="" class="form-control">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-12">
                            <label>City</label>
                            <input type="text" name="UserCity" value="" class="form-control">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-12">
                            <label>State</label>
                            <input type="text" name="UserState" value="" class="form-control">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-12">
                            <label>Country</label>
                            <input type="text" name="UserCountry" value="" class="form-control">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-12">
                            <label>Pincode</label>
                            <input type="text" name="UserPincode" value="" class="form-control">
                          </div>
                        </div>

                        <div class="row mb-10px mb-20px">
                          <div class="form-group col-lg-12 col-md-12 col-12">
                            <button class="btn btn-md btn-success" type="submit" name="AddNewCustomer"><i class="fa fa-check-circle"></i> Save & Continue</button>
                            <button class="btn btn-md btn-default" type="reset"><i class="fa fa-refresh"></i> Reset</button><br>
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