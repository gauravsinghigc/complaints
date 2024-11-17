<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "Edit Stock Details";
$PageDescription = "Manage all members";
$ProductLabel = "Battery";

if (isset($_GET['serialno'])) {
 $ProductSerialNoId = $_GET['serialno'];
 $_SESSION['ProductSerialNoId'] = $ProductSerialNoId;
} else {
 $ProductSerialNoId = $_SESSION['ProductSerialNoId'];
}

$SerialNoSql = "SELECT * FROM product_serial_no where ProductSerialNoId='$ProductSerialNoId'";
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
   document.getElementById("products").classList.add("active");
   document.getElementById("add_products").classList.add("active");
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

   <form action="<?php echo CONTROLLER; ?>/products.php" method="POST">
    <?php FormPrimaryInputs(true, [
     "ProductSerialNoId" => $ProductSerialNoId,
     "Update" => true
    ]); ?>
    <div class="row">
     <div class="col-md-5 form-group">
      <label>Serial No</label>
      <input type="text" tabindex="1" name="ProductSerialNo" value="<?php echo FETCH($SerialNoSql, "ProductSerialNo"); ?>" list="ProductSerialNo" class="form-control" placeholder="S No: 98723E86">
      <?php SUGGEST("product_serial_no", "ProductSerialNo", "ASC"); ?>
     </div>
     <div class="col-md-4 form-group">
      <label>Mfg Date</label>
      <input type="date" name="ProductMfgDate" value="<?php echo DATE_FORMATE2("Y-m-d", FETCH($SerialNoSql, "ProductMfgDate")); ?>" class="form-control">
     </div>
     <div class="col-md-4 form-group">
      <label>Item Status</label>
      <select class="form-control" name="ProuctSerialNoStatus">
       <?php InputOptions(["ACTIVE", "SOLD"], FETCH($SerialNoSql, "ProuctSerialNoStatus")); ?>
      </select>
     </div>
     <div class="col-md-12 form-group">
      <button type="submit" name="UpdateSerialNumbers" class="btn btn-md btn-success mt-25px">Update Stock</button>
      <a href="add-stock.php" class="btn btn-md btn-default">Back to Stock</a>
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