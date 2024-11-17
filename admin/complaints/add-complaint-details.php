<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "Add Product in Warranty";
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
                    <div class="col-md-5">
                      <h5 class="app-heading">Customer Details</h5>
                      <?php
                      if (isset($_GET['customer_id'])) {
                        $customer_id = SECURE($_GET['customer_id'], "d");
                        $_SESSION['SaleCustomerId'] = $customer_id;
                      } else {
                        $customer_id = $_SESSION['SaleCustomerId'];
                      }
                      $FetchCustomers = FetchConvertIntoArray("SELECT * FROM users where UserId='$customer_id'", true);
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
                            <a href="add-complaint.php" class="btn btn-sm btn-success"><i class="fa fa-angle-left"></i> Change Customer</a>
                          </p>

                      <?php
                        }
                      }
                      ?>
                      <h5 class="app-heading">Product Details</h5>
                      <?php
                      if (isset($_SESSION['WARRANTY_SERIAL_NO'])) {
                        $WarrantyProductSno = $_SESSION['WARRANTY_SERIAL_NO'];
                        $Products = FetchConvertIntoArray("SELECT * FROM warranty_products where WarrantyProductSno='$WarrantyProductSno'", true);
                        if ($Products == null) {
                          NoData("No Product is Seleted!");
                        } else {
                          foreach ($Products as $Product) {
                            $WarrantyStatus =  $Product->WarrantyStatus;
                            $WarrantyExpireDate = $Product->WarrantyExpireDate;
                            if ($WarrantyExpireDate > date("Y-m-d")) {
                              $WarrantyStatus = "Active";
                              $Update = UPDATE("UPDATE warranty_products SET WarrantyStatus='$WarrantyStatus' WHERE WarrantyProductSno='$WarrantyProductSno'");
                            } else {
                              $WarrantyStatus = "Expired";
                              $Update = UPDATE("UPDATE warranty_products SET WarrantyStatus='$WarrantyStatus' WHERE WarrantyProductSno='$WarrantyProductSno'");
                            } ?>
                            <table class="table table-striped">
                              <tr>
                                <th>Warranty ID</th>
                                <td><?php echo $Product->WarrantyCustomId; ?></td>
                              </tr>
                              <tr>
                                <th>Serial No</th>
                                <td><?php echo $Product->WarrantyProductSno; ?></td>
                              </tr>
                              <tr>
                                <th>Modal No</th>
                                <td><?php echo $Product->WarrantyProductModalNo; ?></td>
                              </tr>
                              <tr>
                                <th>Capacity</th>
                                <td><?php echo $Product->WarrantyProductCapacity; ?></td>
                              </tr>
                              <tr>
                                <th>MFG DATE</th>
                                <td><?php echo DATE_FORMATE2("d M, Y", $Product->WarrantyProductMfgDate); ?></td>
                              </tr>
                              <tr>
                                <th>Purchase date</th>
                                <td><?php echo DATE_FORMATE2("d M, Y", $Product->WarrantyProductPurchasedate); ?></td>
                              </tr>
                              <tr>
                                <th>Life (in Years)</th>
                                <td><?php echo $Product->WarrantyProductLife; ?> </td>
                              </tr>
                              <tr>
                                <th>Warranty (in Months)</th>
                                <td><?php echo $Product->WarrantyProductMonthWarranty; ?></td>
                              </tr>
                              <tr>
                                <th>Expire Date</th>
                                <td><?php echo DATE_FORMATE2("d M, Y", $Product->WarrantyExpireDate); ?></td>
                              </tr>
                              <tr>
                                <th>Warranty Status</th>
                                <td>
                                  <?php echo $WarrantyStatus; ?>
                                </td>
                              </tr>
                            </table>
                      <?php
                          }
                        }
                      } ?>
                    </div>
                    <div class="col-md-7">
                      <h5 class="app-heading">Register New Complaint</h5>
                      <form action="<?php echo CONTROLLER("ComplaintController"); ?>" method="POST">
                        <?php
                        FormPrimaryInputs(true, [
                          "ComplaintsUserId" => $_SESSION['SaleCustomerId'],
                          "ComplaintProductId" => $_SESSION['WARRANTY_SERIAL_NO']
                        ]) ?>
                        <div class="row">
                          <div class="col-md-3 form-group">
                            <label>Complaint No</label>
                          </div>
                          <div class="col-md-9 form-group">
                            <input type="text" class="form-control" name="ComplaintsCustomRefId" readonly value="<?php echo COMPLAINT_NO; ?>">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3 form-group">
                            <label>Compaint Status</label>
                          </div>
                          <div class="col-md-9 form-group">
                            <select name="ComplaintStatus" class="form-control">
                              <?php InputOptions(COMPLAINT_STATUS, "NEW COMPLAINT"); ?>
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3 form-group">
                            <label>Customer Name</label>
                          </div>
                          <div class="col-md-9 form-group">
                            <input type="text" class="form-control" value="<?php echo $Customers->UserFullName; ?>" name="ComplaintsName" placeholder="Full Name" required>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3 form-group">
                            <label>Phone Number</label>
                          </div>
                          <div class="col-md-9 form-group">
                            <input type="text" class="form-control" value="<?php echo $Customers->UserPhoneNumber; ?>" name="ComplaintPhoneNumber" placeholder="+91" required>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3 form-group">
                            <label>Alt Phone Number</label>
                          </div>
                          <div class="col-md-9 form-group">
                            <input type="text" class="form-control" name="ComplaintAltPhoneNumber" placeholder="+91">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3 form-group">
                            <label>Complaint Type</label>
                          </div>
                          <div class="col-md-9 form-group">
                            <input type="text" class="form-control" name="ComplaintType" list="ComplaintType" required="">
                            <?php SUGGEST("complaints", "ComplaintType", "ASC"); ?>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-3">
                            <label>Priority level</label>
                          </div>
                          <div class="col-md-9 form-group">
                            <select name="ComplaintPriorityLevel" class="form-control">
                              <?php InputOptions(["1-High", "2-Medium", "3-Low"], "2-Medium"); ?>
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3 form-group">
                            <label>Issue Description</label>
                          </div>
                          <div class="col-md-9 form-group">
                            <textarea class="form-control" name="ComplaintIssueDescriptions" rows="3" required></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3 form-group">
                            <label>Complaint Address</label>
                          </div>
                          <div class="col-md-9 form-group">
                            <?php
                            $UserId = $Customers->UserId;
                            $CheckAddress = CHECK("SELECT * FROM user_addresses where UserAddressUserId='$UserId'");
                            if ($CheckAddress == null) {
                              echo "No Address found!";
                            } else {
                              $AddressCompleted = "";
                              $FetchAddress = FetchConvertIntoArray("SELECT * FROM user_addresses where UserAddressUserId='$UserId'", true);
                              if ($FetchAddress != null) {
                                foreach ($FetchAddress as $Address) {
                                  $UserAddressId = $Address->UserAddressId;
                                  $AddressCompleted .= SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserAddressType"), "d");
                                  $AddressCompleted .= SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserStreetAddress"), "d");
                                  $AddressCompleted .= SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserLocality"), "d");
                                  $AddressCompleted .= SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserCity"), "d");
                                  $AddressCompleted .= SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserState"), "d");
                                  $AddressCompleted .= SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserCountry"), "d");
                                  $AddressCompleted .= "-";
                                  $AddressCompleted .= SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserPincode"), "d");
                                  $AddressCompleted .= SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserAddressContactPerson"), "d");
                                }
                              }
                            }
                            ?>
                            <textarea class="form-control" name="ComplaintAddress" rows="3" required><?php echo $AddressCompleted; ?></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 form-group text-right">
                            <button type="submit" name="SaveComplaints" class="btn btn-lg btn-success">Create Complaint <i class="fa fa-angle-right"></i></button>
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