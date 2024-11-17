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
        <div class="col-md-8">
          <h4 class="app-heading">Search Customer</h4>
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
                <div class="data-list">
                  <p>
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
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>SNo</th>
                            <th>ComplaintNo</th>
                            <th>CustomerDetails</th>
                            <th>PhoneNumber</th>
                            <th>Status</th>
                            <th>CreateDate</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <?php

                        $Complaints = FetchConvertIntoArray("SELECT * FROM complaints where ComplaintsUserId='" . $Customers->UserId . "' ORDER BY DATE(ComplaintCreatedAt) DESC", true);

                        if ($Complaints == null) {
                          NoDataTableView("No Complaints Found!", 7);
                        } else {
                          $sNO = 0;
                          foreach ($Complaints as $Complaint) {
                            $sNO++; ?>
                            <tr>
                              <td><?PHP echo $sNO; ?></td>
                              <td>
                                <a target="_blank" href="details/?id=<?php echo $Complaint->ComplaintsId; ?>" class="bold"><?php echo $Complaint->ComplaintsCustomRefId; ?></a>
                              </td>
                              <td>
                                <i class="fa fa-user"></i> <?php echo FETCH("SELECT * FROM users Where UserID='" . $Complaint->ComplaintsUserId . "'", "UserFullName"); ?>
                                <br> <?php echo $Complaint->ComplaintAddress; ?>
                              </td>
                              <td>
                                <a href="tel:<?php echo FETCH("SELECT * FROM users Where UserID='" . $Complaint->ComplaintsUserId . "'", "UserPhoneNumber"); ?>"><?php echo FETCH("SELECT * FROM users Where UserID='" . $Complaint->ComplaintsUserId . "'", "UserPhoneNumber"); ?></a>
                              </td>
                              <td>
                                <span class="btn btn-xs bg-white"><?php echo $Complaint->ComplaintStatus; ?></span>
                              </td>
                              <td>
                                <?php echo DATE_FORMATE2("d M, Y", $Complaint->ComplaintCreatedAt); ?>
                              </td>
                              <td>
                                <a target="_blank" href="details/?id=<?php echo $Complaint->ComplaintsId; ?>" class="btn btn-xs btn-primary">Details</a>
                              </td>
                            </tr>
                        <?php }
                        } ?>
                      </table>
                    </div>
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
                        <div class="col-md-6 form-group">
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
                    <hr>
                  </div>
                  </p>
                </div>

              <?php }
              ?>
          <?php
            }
          } ?>
        </div>
        <div class="col-md-4">
          <h4 class="app-heading">Add New Customer</h4>
          <form action="<?php echo CONTROLLER; ?>/ComplaintController.php" method="POST">
            <?php FormPrimaryInputs(ADMIN_URL . "/services/select-complaint-invoices.php", [
              "success_url" => ADMIN_URL . "/services/select-complaint-invoices.php",
              "UserStatus" => "1",
              "UserType" => "Customer"
            ]); ?>
            <div class="row mb-10px">
              <div class="form-group col-lg-2 col-md-2 col-sm-6 col-12">
                <label>Salutations</label>
                <select class="form-control" name="UserSalutation" required="">
                  <?php SelectInputOptions(SALUTATION, null); ?>
                </select>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                <label>Full Name</label>
                <input type="text" name="UserFullName" class="form-control" required="" placeholder="Full Name">
              </div>
            </div>
            <div class="row mb-10px">
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                <label>Primary Contact Number</label>
                <input type="phone" name="UserPhoneNumber" class="form-control" value="" placeholder="+91">
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                <label>Primary Contact Email-ID</label>
                <input type="email" name="UserEmailId" class="form-control" placeholder="email@domain.tld">
              </div>
            </div>
            <div class="row mb-10px">
              <div class="form-group col-lg-6 col-md-6 col-12">
                <label>Sector/Locality/Area/Landmark</label>
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
                <div class="action-btn">
                  <button class="btn btn-md btn-success" type="submit" name="AddNewCustomer"><i class="fa fa-check-circle"></i> Save & Continue</button>
                  <button class="btn btn-md btn-default" type="reset"><i class="fa fa-refresh"></i> Reset</button><br>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php include $Dir . "/include/admin/footer.php"; ?>
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>