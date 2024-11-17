<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "Upload New Products";
$PageDescription = "Manage all members";
$ProductLabel = "Battery";
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
   <form action="<?php echo CONTROLLER; ?>/products.php" method="POST" enctype="multipart/form-data">
    <?php FormPrimaryInputs(true); ?>
    <div class="row">
     <div class="col-md-6">
      <h4 class="app-heading">Select File</h4>
      <div class="row mb-5px">
       <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12">
        <label>Select Document (.csv)</label>
        <input type="FILE" name="DocumentFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control" required="">
       </div>
      </div>
     </div>
     <div class="col-md-6">
      <h4 class="app-heading">Download Formate</h4>
      <a href="<?php echo STORAGE_URL_D; ?>/doc/pro.csv" download="<?php echo STORAGE_URL_D; ?>/doc/pro.csv" class="btn btn-md btn-success"><i class="fa fa-download"></i> Download formate</a>
     </div>
    </div>
    <div class="row mb-10px mb-20px">
     <div class="form-group col-lg-12 col-md-12 col-12">
      <div class="action-btn">
       <button class="btn btn-md btn-success" type="submit" name="UploadProducts"><i class="fa fa-check-circle"></i> Process Selected File</button>
       <button class="btn btn-md btn-default" type="reset"><i class="fa fa-refresh"></i> Reset</button><br>
      </div>
     </div>
    </div>
   </form>
  </div>
  <?php include $Dir . "/include/admin/footer.php"; ?>
  <a href=" javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
 </div>
 <script>
  function CalculateGSTPrice() {
   var GstValue = document.getElementById("GstValue");
   var Netprice = document.getElementById("Netprice");
   var ProductSalePrice = document.getElementById("ProductSalePrice");

   if (GstValue.value == 0) {
    Netprice.value = ProductSalePrice.value;
   } else {
    Netprice.value = (+ProductSalePrice.value * (+GstValue.value / 100)) + +ProductSalePrice.value;
   }
  }
 </script>
 <script>
  $(function() {
   // Multiple images preview in browser
   var imagesPreview = function(input, placeToInsertImagePreview) {

    if (input.files) {
     var filesAmount = input.files.length;

     for (i = 0; i < filesAmount; i++) {
      var reader = new FileReader();

      reader.onload = function(event) {
       $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
      }

      reader.readAsDataURL(input.files[i]);
     }
    }

   };

   $('#UploadFiles').on('change', function() {
    imagesPreview(this, 'div.gallery');
   });
  });
 </script>
 <?php include $Dir . "/include/admin/footer_files.php"; ?>
</body>

</html>