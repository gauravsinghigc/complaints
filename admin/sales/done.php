<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "Order Created";
$PageDescription = "Manage all team";


//start invoice session
if (isset($_GET['invoiceid'])) {
 $InvoiceId = SECURE($_GET['invoiceid'], "d");
 $_SESSION['InvoiceId'] = $InvoiceId;
} else {
 $InvoiceId = $_SESSION['InvoiceId'];
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

   <div class="row shadow-sm">
    <div class="col-md-4 text-center">
     <img src="<?php echo STORAGE_URL_D; ?>/tool-img/success.gif" class="img-fluid">
    </div>
    <div class="col-md-8">
     <div class="shadow-sm p-2">
      <h3><b>Invoice No: </b><?php echo FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoiceCustomId"); ?></h3>
      <p class="h4"><b class="text-gray">Invoice Amount : </b><?php echo Price(FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoiceAmount"), "text-success bold", "Rs."); ?></p>
      <p class="h4"><b class="text-gray">Invoice Date : </b><?php echo DATE_FORMATE2("d M, Y", FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoiceDate")); ?></p>
      <p class="h4"><b class="text-gray">Payment Mode : </b><?php echo FETCH("SELECT * FROM invoice_transactions where InvoiceMainId='$InvoiceId'", "InvoiceTxnPaymode"); ?></p>
      <p class="h4"><b class="text-gray">Payment Status : </b><?php echo FETCH("SELECT * FROM invoice_transactions where InvoiceMainId='$InvoiceId'", "Invoicetxnstatus"); ?></p>
      <div class="p-2">
       <a href="<?php echo DOMAIN; ?>/edoc/invoice.php?invoiceid=<?php echo SECURE($InvoiceId, "e"); ?>" class="btn btn-md btn-info" target="_blank"><i class="fa fa-print"></i> View Invoice</a>
       <a href="<?php echo DOMAIN; ?>/edoc/warranty.php?invoiceid=<?php echo SECURE($InvoiceId, "e"); ?>" class="btn btn-md btn-primary" target="_blank"><i class="fa fa-certificate"></i> View Warranty Card</a>
       <a href="<?php echo DOMAIN; ?>/edoc/receipt.php?invoiceid=<?php echo SECURE($InvoiceId, "e"); ?>" class="btn btn-md btn-success" target="_blank"><i class="fa fa-inr"></i> View Payment Receipt</a>
      </div>
      <hr>
      <div class="p-2">
       <a href="" class="btn btn-sm btn-default">View All Sale</a>
       <a href="" class="btn btn-sm btn-default">Create New Sale</a>
       <a href="" class="btn btn-sm btn-default">View Customer Profile</a>
      </div>
     </div>
    </div>
   </div>
  </div>
  <?php include $Dir . "/include/admin/footer.php"; ?>
  <a href=" javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
 </div>

 <?php include $Dir . "/include/admin/footer_files.php"; ?>
</body>

</html>