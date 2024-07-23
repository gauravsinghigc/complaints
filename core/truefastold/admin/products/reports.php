<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Products";
$PageDescription = "Manage all products";
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
   document.getElementById("all_products").classList.add("active");
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
    <div class="ms-auto">
     <a href="export.php" class="btn btn-success btn-rounded px-4 rounded-pill" target="_blank"><i class="fa fa-file-pdf-o fa-lg me-2 ms-n2 text-white"></i> Export All</a>
    </div>
   </div>

   <div class="row">
    <table class="table table-striped">
     <thead>
      <tr>
       <th>Sno</th>
       <th>Name</th>
       <th>Type</th>
       <th>ModalNo</th>
       <th>SalePrice</th>
       <th>Life</th>
       <th>Warranty</th>
       <th>StockIn</th>
      </tr>
     </thead>
     <?php
     $Products = FetchConvertIntoArray("SELECT * FROM products ORDER BY ProductId ASC", true);
     if ($Products != null) {
      $Sno = 0;
      foreach ($Products as $Data) {
       $Sno++; ?>
       <tr>
        <td><?php echo $Sno; ?></td>
        <td class="text-primary"><?php echo $Data->ProductName; ?> <span class="text-grey">(<?php echo $Data->ProductCapacity; ?> Ah)</span></td>
        <td><?php echo $Data->ProductType; ?></td>
        <td><?php echo $Data->ProductModalNo; ?></td>
        <td><?php echo Price($Data->ProductSalePrice, "text-sucsess", "Rs."); ?> <span class="text-grey">(+<?php echo $Data->ProductApplicableTaxes; ?>%)</span></td>
        <td><?php echo $Data->ProductLife; ?> years</td>
        <td><?php echo $Data->ProductWarrantyinMonths; ?> months</td>
        <td><?php echo $StockCount = TOTAL("SELECT * FROM product_serial_no where ProductMainProId='" . $Data->ProductID . "'"); ?></td>
       </tr>
     <?php }
     } ?>
    </table>
   </div>

  </div>
  <?php include $Dir . "/include/admin/footer.php"; ?>
  <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
 </div>


 <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>