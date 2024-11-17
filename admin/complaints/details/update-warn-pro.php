<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "Update Product in Complaint";
$PageDescription = "Manage all customers";

if (isset($_GET['proid'])) {
 $UpdateComplaintProductDetails = SECURE($_GET['proid'], "d");
 $_SESSION['UPDATE_COMPLAINT_PRODUCT_DETAILS'] = $UpdateComplaintProductDetails;
} else {
 $UpdateComplaintProductDetails = $_SESSION['UPDATE_COMPLAINT_PRODUCT_DETAILS'];
}
$WarrantySql = "SELECT * FROM warranty_products where WarrantyProductsId='$UpdateComplaintProductDetails'";
$WarrantyCustomerId = FETCH($WarrantySql, "WarrantyCustomerId");
$UserSql = "SELECT * FROM users where UserId='$WarrantyCustomerId'";
$UserAddressSql = "SELECT * FROM user_addresses where UserAddressUserId='$WarrantyCustomerId'";
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
          <div class="col-md-12 mb-1">
           <div class="flex-s-b">
            <a href="index.php" class="btn btn-sm btn-default mb-0 action-btn mr-1"><i class="fa fa-angle-left"></i></a>
            <h4 class="app-heading w-100 mb-0 mt-0"><?php echo $PageName; ?></h4>
           </div>
          </div>
          <div class="col-md-4">
           <h5 class="app-sub-heading">Customer Details</h5>
           <?php
           $FetchCustomers = FetchConvertIntoArray("SELECT * FROM users where UserId='$WarrantyCustomerId'", true);
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
                   echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserStreetAddress"), "d") . " ";
                   echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserLocality"), "d") . " ";
                   echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserCity"), "d") . " ";
                   echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserState"), "d") . " ";
                   echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserCountry"), "d") . " ";
                   echo "-";
                   echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserPincode"), "d") . " ";
                   echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserAddressContactPerson"), "d") . " ";
                  }
                 }
                }
                ?>
               </span>
              </span>
             </p>

           <?php
            }
           }
           ?>
          </div>
          <div class="col-md-8">
           <h5 class="app-sub-heading">Update Product Details</h5>
           <?php
           $WarrantyProductSno = FETCH($WarrantySql, "WarrantyProductSno");
           $SnoSql = "SELECT * FROM product_serial_no where ProductSerialNo='$WarrantyProductSno'";
           $ProSql = "SELECT * FROM products where ProductID='" . FETCH($SnoSql, "ProductMainProId") . "'"; ?>
           <form action="<?php echo CONTROLLER; ?>/WarrantyController.php" method="POST">
            <?php FormPrimaryInputs(true, [
             "WarrantyCustomerId" => $WarrantyCustomerId,
             "WarrantyProductsId" => $UpdateComplaintProductDetails,
            ]); ?>
            <input type="hidden" name="WarrantyStatus" value="<?php echo FETCH($WarrantySql, "WarrantyStatus"); ?>" id="status">
            <input type="hidden" value="<?php echo FETCH($WarrantySql, "WarrantyProductMonthWarranty"); ?>" id="<?php echo FETCH($ProSql, "ProductWarrantyinMonths"); ?>">
            <div class="row">
             <div class="col-md-4 form-group">
              <label>Warranty ID</label>
             </div>
             <div class="col-md-8">
              <input type="text" readonly="" class="form-control" name="WarrantyCustomId" value="<?php echo FETCH($WarrantySql, "WarrantyCustomId"); ?>" required>
             </div>

             <div class="col-md-4 form-group">
              <label>Serial No</label>
             </div>
             <div class="col-md-8">
              <input type="text" class="form-control" name="WarrantyProductSno" value="<?php echo FETCH($WarrantySql, "WarrantyProductSno"); ?>" required>
             </div>
             <div class="col-md-4 form-group">
              <label>Modal No</label>
             </div>
             <div class="col-md-8">
              <input type="text" class="form-control" list="ProductModalNo" name="WarrantyProductModalNo" value="<?php echo FETCH($WarrantySql, "WarrantyProductModalNo"); ?>" required>
              <?php SUGGEST("products", "ProductModalNo", "ASC"); ?>
             </div>
             <div class="col-md-4 form-group">
              <label>Mfg Date</label>
             </div>
             <div class="col-md-8">
              <input type="date" id="MfgDate" class="form-control" oninput="GetExpireDate()" name="WarrantyProductMfgDate" value="<?php echo FETCH($WarrantySql, "WarrantyProductMfgDate"); ?>" required>
             </div>
             <div class="col-md-4 form-group">
              <label>Purchase Date</label>
             </div>
             <div class="col-md-8">
              <input type="date" oninput="GetExpireDate()" id="purchasedate" class="form-control" name="WarrantyProductPurchasedate" value="<?php echo FETCH($WarrantySql, "WarrantyProductPurchasedate"); ?>" required>
             </div>
             <div class="col-md-4 form-group">
              <label>Capacity (AH)</label>
             </div>
             <div class="col-md-8">
              <input type="text" class="form-control" list="ProductCapacity" name="WarrantyProductCapacity" value="<?php echo FETCH($WarrantySql, "WarrantyProductCapacity"); ?>" required>
              <?php SUGGEST("products", "ProductCapacity", "ASC"); ?>
             </div>
             <div class="col-md-4 form-group">
              <label>Warranty (in Months)</label>
             </div>
             <div class="col-md-8">
              <input type="number" id="months" class="form-control" oninput="GetExpireDate()" name="WarrantyProductMonthWarranty" value="<?php echo FETCH($WarrantySql, "WarrantyProductMonthWarranty"); ?>" required>
             </div>

             <div class="col-md-4 form-group">
              <label>Product life (in Years)</label>
             </div>
             <div class="col-md-8">
              <input type="text" class="form-control" oninput="GetExpireDate()" list="ProductLife" name="WarrantyProductLife" value="<?php echo FETCH($WarrantySql, "WarrantyProductLife"); ?>" required>
              <?php SUGGEST("products", "ProductLife", "ASC"); ?>
             </div>

             <div class="col-md-4 form-group">
              <label>Warranty Expired date</label>
             </div>
             <div class="col-md-8">
              <input type="date" readonly="" id="expiredate" class="form-control" name="WarrantyExpireDate" value="<?php echo FETCH($WarrantySql, "WarrantyExpireDate"); ?>" required>
             </div>

             <div class="col-md-4 form-group">
              <label>Warranty Status</label>
             </div>
             <div class="col-md-8">
              <span class="btn btn-sm" id='warrantystatus'></span>
             </div>
            </div>
            <div class="row">
             <div class="col-md-12 text-right">
              <button type="submit" name="UpdateWarrantyCard" class="btn btn-lg btn-success">Update Details <i class="fa fa-angle-right"></i></button>
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
  <script>
   function GetExpireDate() {
    var purchasedate = document.getElementById("purchasedate");
    var months = document.getElementById("months");
    var expiredate = document.getElementById("expiredate");
    var MfgDate = document.getElementById("MfgDate");
    var warrantystatus = document.getElementById("warrantystatus");
    var status = document.getElementById("status");

    var GetPurchaseData = new Date(purchasedate.value);
    GetPurchaseData.setMonth(GetPurchaseData.getMonth() + +months.value);
    var NewExpireData = GetPurchaseData;

    //birthday date checking
    const today = NewExpireData;
    const yyyy = today.getFullYear();
    let mm = today.getMonth() + 1; // Months start at 0!
    let dd = today.getDate();

    if (dd < 10) dd = '0' + dd;
    if (mm < 10) mm = '0' + mm;

    const formattedToday = yyyy + '-' + mm + '-' + dd;
    expiredate.value = formattedToday;
    var datetimeStart = new Date();

    if (Date.parse(NewExpireData) > Date.parse(datetimeStart)) {
     warrantystatus.innerHTML = "<i class='fa fa-check'></i>" + " Active";
     warrantystatus.classList.add("btn-success");
     warrantystatus.classList.remove("btn-danger");
     status.value = "Active";
    } else {
     warrantystatus.innerHTML = "<i class='fa fa-warning'></i>" + " Expired";
     warrantystatus.classList.add("btn-danger");
     warrantystatus.classList.remove("btn-success");
     status.value = "Expired";
    }
   }
   window.onload = function() {
    GetExpireDate();
   };
  </script>
  <?php
  include $Dir . "/include/admin/footer.php"; ?>
 </div>

 <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>