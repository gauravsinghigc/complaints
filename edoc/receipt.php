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
 <title><?php echo $CustomerInvoiceId = FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoiceCustomId"); ?></title>
 <style>
  body,
  html {
   font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;
  }

  .main-container {
   width: 730px;
   height: max-content;
   box-shadow: 0px 0px 1px black;
   border-style: groove;
   border-width: thin;
   border-color: grey;
   margin: 0.2% auto;
   padding: 0.5%;
   padding-bottom: 4rem;
  }

  .header {
   width: 100%;
   text-align: center;
  }

  .header img {
   width: 60px;
   margin-top: 5px;
  }

  p {
   font-size: 13px !important;
   margin-top: -3px;
   margin-bottom: 1px;
   line-height: 15px;
  }

  .app-name {
   font-weight: 600;
   font-size: 15px;
  }

  .c-details,
  .address {
   font-size: 12px;
  }

  .tagline {
   font-size: 11px;
   font-style: italic;
  }

  h5 {
   text-align: center;
   font-size: 13px;
   margin-top: 0px;
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
  <hr style="margin-top:2px; margin-bottom:2px;">
  <h5>PAYMENT RECEIPT FOR <?PHP echo $CustomerInvoiceId; ?></h5>
  <hr style="margin-top:2px; margin-bottom:2px;">

  <div class="c-data">
   <table>
    <tr>
     <td width="50%">
      <p>
       <span><b>Shipping & Billing Address</b></span><br>
       <span><?php echo FETCH("SELECT * FROM users where UserId='" . FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoiceCustomerId") . "'", "UserFullName"); ?></span><br>
       <span><?php echo FETCH("SELECT * FROM users where UserId='" . FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoiceCustomerId") . "'", "UserPhoneNumber"); ?></span><br>
       <?php echo FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoiceShippingAddress"); ?>
      </p>
     </td>
    </tr>
   </table>
   <table style="width:100%;">
    <tr>
     <td>
      <h3><b>Invoice Details</b></h3>
      <p>
       <span>
        <span><b>Invoice RefId : </b><?php echo DATE_FORMATE2("d/m/Y/", FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoiceCreatedAt")); ?><?php echo FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoiceCustomerId"); ?></span><br>
        <span><b>Invoice date : </b><?php echo DATE_FORMATE2("d m, Y", FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoiceDate")); ?></span><br>
        <span><b>Invoice No : </b><?php echo FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoiceCustomId"); ?></span><br>
        <span><b>Invoice Amount : </b>Rs.<?php echo FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoiceAmount"); ?></span><br>
        <span><b>Invoice Created At : </b><?php echo DATE_FORMATE2("d M, Y", FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoiceCreatedAt")); ?></span><br>
        <span><b>Status : </b><?php echo FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoiceStatus"); ?></span><br>
        <span><b>Paid Date : </b><?php echo DATE_FORMATE2("d M, Y", FETCH("SELECT * FROM invoices where InvoiceId='$InvoiceId'", "InvoicePaidAt")); ?></span><br>
       </span>
      </p>
     </td>
     <td>
      <h3>Payment Details</h3>
      <p>
       <span><b>Internal RefId : </b> <?php echo DATE_FORMATE2("d/m/Y/", FETCH("SELECT * FROM invoice_transactions where InvoiceMainId='$InvoiceId'", "PaymentDate")); ?><?php echo FETCH("SELECT * FROM invoice_transactions where InvoiceMainId='$InvoiceId'", "InvoiceTransactionId"); ?></span><br>
       <span><b>Payment Date : </b><?php echo DATE_FORMATE2("d M, Y", FETCH("SELECT * FROM invoice_transactions where InvoiceMainId='$InvoiceId'", "PaymentDate")); ?></span><br>
       <span><b>Payment Amount : </b> Rs.<?php echo FETCH("SELECT * FROM invoice_transactions where InvoiceMainId='$InvoiceId'", "InvoiceTxnAmount"); ?></span><br>
       <span><b>Payment Mode : </b><?php echo FETCH("SELECT * FROM invoice_transactions where InvoiceMainId='$InvoiceId'", "InvoiceTxnPaymode"); ?></span><br>
       <span><b>Pay mode Refid : </b><?php echo FETCH("SELECT * FROM invoice_transactions where InvoiceMainId='$InvoiceId'", "InvoiceTxnRefId"); ?></span><br>
       <span><b>Payment Details : </b><?php echo SECURE(FETCH("SELECT * FROM invoice_transactions where InvoiceMainId='$InvoiceId'", "Invoicetxndetails"), "d"); ?></span><br>
       <span><b>Payment Status : </b><?php echo FETCH("SELECT * FROM invoice_transactions where InvoiceMainId='$InvoiceId'", "Invoicetxnstatus"); ?></span><br>
       <span><b>Payment Created At : </b><?php echo DATE_FORMATE2("d M, Y", FETCH("SELECT * FROM invoice_transactions where InvoiceMainId='$InvoiceId'", "InvoicetxnCreatedAt")); ?> </span><br>
       <span><b>Discount : </b><?php echo FETCH("SELECT * FROM invoice_transactions where InvoiceMainId='$InvoiceId'", "PaymentDiscountName"); ?> - Rs.<?php echo FETCH("SELECT * FROM invoice_transactions where InvoiceMainId='$InvoiceId'", "PaymentDiscountAmount"); ?></span><br>
       <span><b>Charges : </b><?php echo FETCH("SELECT * FROM invoice_transactions where InvoiceMainId='$InvoiceId'", "PaymentChargeName"); ?> + Rs.<?php echo FETCH("SELECT * FROM invoice_transactions where InvoiceMainId='$InvoiceId'", "PaymentChargeAmount"); ?></span><br>
      </p>
     </td>
    </tr>
   </table>
  </div>
 </section>
</body>

</html>