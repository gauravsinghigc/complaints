<?php
$Dir = "..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "Add Product in Warranty";
$PageDescription = "Manage all customers";

if (isset($_GET['WarrantyProductSno'])) {
  $WarrantyProductSno = $_GET['WarrantyProductSno'];
} else {
  $WarrantyProductSno = "";
}
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
        <div class="col-md-4">
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
        </div>
        <div class="col-md-8">
          <h5 class="app-heading">Enter Product Details</h5>
          <form>
            <div class="row">
              <div class="col-md-4 form-group">
                <label>Enter Item Serial No</label>
                <input type="text" class="form-control" onchange="form.submit()" list="ProductSerialNo" name="WarrantyProductSno" value="" required>
                <?php SUGGEST("product_serial_no", "ProductSerialNo", "ASC"); ?>
              </div>
            </div>
          </form>
          <?php
          if (isset($_GET['WarrantyProductSno'])) {
            $WarrantyProductSno = $_GET['WarrantyProductSno'];
            $SnoSql = "SELECT * FROM product_serial_no where ProductSerialNo='$WarrantyProductSno'";
            $ProSql = "SELECT * FROM products where ProductID='" . FETCH($SnoSql, "ProductMainProId") . "'"; ?>
            <H6 class="app-sub-heading">Enter Product Details</H6>
            <form action="<?php echo CONTROLLER; ?>/WarrantyController.php" method="POST">
              <?php FormPrimaryInputs(true, [
                "WarrantyCustomerId" => $_SESSION['SaleCustomerId'],
              ]); ?>
              <input type="hidden" name="WarrantyStatus" value="" id="status">
              <input type="hidden" value="" id="<?php echo FETCH($ProSql, "ProductWarrantyinMonths"); ?>">
              <div class="row">
                <div class="col-md-4 form-group">
                  <label>Warranty ID</label>
                </div>
                <div class="col-md-8">
                  <input type="text" readonly="" class="form-control" name="WarrantyCustomId" value="<?php echo WARRANTY_CUSTOM_ID; ?>" required>
                </div>

                <div class="col-md-4 form-group">
                  <label>Serial No</label>
                </div>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="WarrantyProductSno" value="<?php echo $WarrantyProductSno; ?>" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>Modal No</label>
                </div>
                <div class="col-md-8">
                  <input type="text" class="form-control" list="ProductModalNo" name="WarrantyProductModalNo" value="<?php echo FETCH($ProSql, "ProductModalNo"); ?>" required>
                  <?php SUGGEST("products", "ProductModalNo", "ASC"); ?>
                </div>
                <div class="col-md-4 form-group">
                  <label>Mfg Date</label>
                </div>
                <div class="col-md-8">
                  <input type="date" class="form-control" name="WarrantyProductMfgDate" value="<?php echo FETCH($SnoSql, "ProductMfgDate"); ?>" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>Purchase Date</label>
                </div>
                <div class="col-md-8">
                  <input type="date" onchange="GetExpireDate()" id="purchasedate" class="form-control" name="WarrantyProductPurchasedate" value="<?php echo Date("Y-m-d"); ?>" required>
                </div>
                <div class="col-md-4 form-group">
                  <label>Capacity (AH)</label>
                </div>
                <div class="col-md-8">
                  <input type="text" class="form-control" list="ProductCapacity" name="WarrantyProductCapacity" value="<?php echo FETCH($ProSql, "ProductCapacity"); ?>" required>
                  <?php SUGGEST("products", "ProductCapacity", "ASC"); ?>
                </div>
                <div class="col-md-4 form-group">
                  <label>Warranty (in Months)</label>
                </div>
                <div class="col-md-8">
                  <input type="text" class="form-control" list="ProductWarrantyinMonths" name="WarrantyProductMonthWarranty" value="<?php echo FETCH($ProSql, "ProductWarrantyinMonths"); ?>" required>
                  <?php SUGGEST("products", "ProductWarrantyinMonths", "ASC"); ?>
                </div>

                <div class="col-md-4 form-group">
                  <label>Product life (in Years)</label>
                </div>
                <div class="col-md-8">
                  <input type="text" class="form-control" list="ProductLife" name="WarrantyProductLife" value="<?php echo FETCH($ProSql, "ProductLife"); ?>" required>
                  <?php SUGGEST("products", "ProductLife", "ASC"); ?>
                </div>

                <div class="col-md-4 form-group">
                  <label>Warranty Expired date</label>
                </div>
                <div class="col-md-8">
                  <input type="date" readonly="" id="expiredate" class="form-control" name="WarrantyExpireDate" value="" required>
                </div>

                <div class="col-md-4 form-group">
                  <label>Warranty Status</label>
                </div>
                <div class="col-md-8">
                  <span class="btn btn-lg" id='warrantystatus'></span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-right">
                  <button type="submit" name="CreateWarrantyCard" class="btn btn-lg btn-success">Create Warranty Card & Enter Complaint Details <i class="fa fa-angle-right"></i></button>
                </div>
              </div>
            </form>
          <?PHP } ?>
        </div>
      </div>
    </div>
    <?php include $Dir . "/include/admin/footer.php"; ?>
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
  </div>
  <script>
    function formatDate(date) {
      var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

      if (month.length < 2)
        month = '0' + month;
      if (day.length < 2)
        day = '0' + day;

      return [year, month, day].join('-');
    }

    function GetExpireDate() {
      var purchasedate = document.getElementById("purchasedate");
      var expiredate = document.getElementById("expiredate");
      var months = document.getElementById("months");
      var warrantystatus = document.getElementById("warrantystatus");
      var status = document.getElementById("status");

      var d = new Date(purchasedate.value); // purchase date
      d.setMonth(d.getMonth() + months);

      expiredate.value = formatDate(d);

      if (new Date() < Date.parse(d)) {
        warrantystatus.classList.add("text-success");
        warrantystatus.classList.remove("text-danger");
        warrantystatus.innerHTML = "<i class='fa fa-check-circle-o'></i>" + " Active";
        status.value = "Active";

      } else {
        warrantystatus.innerHTML = "<i class='fa fa-warning'></i>" + " Expired";
        warrantystatus.classList.add("text-danger");
        warrantystatus.classList.remove("text-success");
        status.value = "Expired";
      }
    }
  </script>
  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>