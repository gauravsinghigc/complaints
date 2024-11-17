<?php
//include files
require "../require/modules.php";

if (isset($_GET['invoiceid'])) {
 $InvoiceId = SECURE($_GET['invoiceid'], "d");
 $_SESSION['InvoiceId'] = $InvoiceId;
} else {
 $InvoiceId = $_SESSION['InvoiceId'];
}
?>
<html>

<head>
 <title>WARRANTY-CARD-<?php echo rand(1111, 9999999); ?></title>
 <style>
  body,
  html {
   font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;
  }

  .main-container {
   width: 730px;
   height: max-content;
   box-shadow: 0px 0px 10px grey;
   border-style: groove;
   border-width: thin;
   border-color: green;
   margin: 0.2% auto;
   padding: 0.5%;
   padding-bottom: 4rem;
   border-radius: 10px;
   margin-bottom: 10px;

  }

  .header {
   width: 100%;
   text-align: center;
  }

  .header img {
   width: 80px;
   margin-top: 5px;
  }

  p {
   font-size: 14px !important;
   margin-top: -3px;
   margin-bottom: 1px;
   line-height: 17px;
  }

  .app-name {
   font-weight: 600;
   font-size: 17px;
  }

  .c-details,
  .address {
   font-size: 13px;
  }

  .tagline {
   font-size: 12px;
   font-style: italic;
  }

  .h5 {
   text-align: center;
   font-size: 2rem !important;
   margin-top: 10px;
   margin-bottom: 0px;
  }

  table {
   width: 100%;
  }

  table.striped {
   border-spacing: 0;
   width: 100%;
  }

  tr.striped:nth-child(even) {
   background-color: #f2f2f2;
  }
 </style>
</head>

<body>

 <?php $fetchInvoices = FetchConvertIntoArray("SELECT * FROM invoice_products where InvoiceMainId='$InvoiceId'", true);
 if ($fetchInvoices != null) {
  foreach ($fetchInvoices as $Items) { ?>

   <section class="main-container">
    <div class="header">
     <img src="<?php echo MAIN_LOGO; ?>">
     <p>
      <span class="app-name"><?php echo APP_NAME; ?></span><br>
      <span class="tagline">(<?php echo TAGLINE; ?>)</span><br>
      <span class="c-details"><?php echo PRIMARY_PHONE; ?></span> |
      <span class="c-details"><?php echo PRIMARY_EMAIL; ?></span> |
      <span class="c-details"><?php echo HOST; ?></span> <br>
      <span class="address"><?php echo SECURE(PRIMARY_ADDRESS, "d"); ?></span><br>
      <span class="c-details"><b>GST:</b> <?php echo PRIMARY_GST; ?></span>
     </p>
    </div>
    <h5 class="h5">WARRANTY CARD</h5>
    <div class="c-data" style="margin-top:10px;">
     <table>
      <tr>
       <td width="50%">
        <p>
         <span><b>Customer Details</b></span><br>
         <span><?php echo FETCH("SELECT * FROM users where UserId='" . FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoiceCustomerId") . "'", "UserFullName"); ?></span><br>
         <span><?php echo FETCH("SELECT * FROM users where UserId='" . FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoiceCustomerId") . "'", "UserPhoneNumber"); ?></span><br>
        </p>
       </td>
       <td>
        <p style="margin-left:1rem;">
         <span><b>Shipping Address</b></span><br>
         <?php echo FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoiceShippingAddress"); ?>
        </p>
       </td>
      </tr>
     </table>
     <table style="width:100%;margin-top:5px;">
      <tr>
       <td>
        <b style="color:black;">Product Name</b><br>
        <span><?php echo FETCH("SELECT * FROM invoice_products where InvoiceMainId='$InvoiceId'", "InvoiceProductName"); ?></span>
       </td>
       <td>
        <b style="color:black;">Serial No</b><br>
        <span><?php echo FETCH("SELECT * FROM invoice_products where InvoiceMainId='$InvoiceId'", "InvoiceProductSerialNo"); ?></span>
       </td>
       <td>
        <b style="color:black;">Modal No</b><br>
        <span><?php echo FETCH("SELECT * FROM invoice_products where InvoiceMainId='$InvoiceId'", "InvoiceProductModalNo"); ?></span>
       </td>
       <td>
        <b style="color:black;">SKU CODE</b><br>
        <span><?php echo FETCH("SELECT * FROM invoice_products where InvoiceMainId='$InvoiceId'", "InvoiceProductSkuCode"); ?></span>
       </td>
      </tr>
      <tr>
       <td>
        <b style="color:black;">Mfg Date</b><br>
        <span><?php
              $ProductId = FETCH("SELECT * FROM invoice_products where InvoiceMainId='$InvoiceId'", "InvoiceProductMainId");
              echo DATE_FORMATE2("d M, Y", FETCH("SELECT * FROM products where ProductId='$ProductId'", "ProductManufacturingDate")); ?></span>
       </td>
       <td>
        <b style="color:black;">Sale Date</b><br>
        <span><?php echo DATE_FORMATE2("d M, Y", FETCH("SELECT * FROM invoice_products where InvoiceMainId='$InvoiceId'", "InvoiceProductSaleDate")); ?></span>
       </td>
       <td>
        <b style="color:black;">Warranty In Months</b><br>
        <span><?php echo FETCH("SELECT * FROM invoice_products where InvoiceMainId='$InvoiceId'", "InvoiceProductWarranty"); ?> months</span>
       </td>
       <td>
        <b style="color:black;">Warranty Expire At</b><br>
        <span><?php echo DATE_FORMATE2("d M, Y", FETCH("SELECT * FROM invoice_products where InvoiceMainId='$InvoiceId'", "InvoiceProductWarrantyExpireAt")); ?></span>
       </td>
      </tr>
      <tr>
       <td>
        <b style="color:black;">Current Status</b><br>
        <span>
         <?php
         $SaleDate = date("Y-m-d", strtotime(FETCH("SELECT * FROM invoice_products where InvoiceMainId='$InvoiceId'", "InvoiceProductSaleDate")));
         $ExpireDate = date("Y-m-d", strtotime(FETCH("SELECT * FROM invoice_products where InvoiceMainId='$InvoiceId'", "InvoiceProductWarrantyExpireAt")));
         if ($SaleDate <= $ExpireDate) {
          echo "Active";
          $warranty = "warranty.png";
         } else {
          echo "Expired";
          $warranty = "expire.png";
         } ?>
        </span>
       </td>
      </tr>
     </table>
     <img src="<?php echo STORAGE_URL_D; ?>/tool-img/<?php echo $warranty; ?>" style="width:100px;float:right;margin-top:-50px;margin-right:20px;">
    </div>
   </section>

 <?php
  }
 } ?>
</body>

</html>