<?php
//include files
require "../require/modules.php";

if (isset($_GET['txnid'])) {
 $UserTxnid = SECURE($_GET['txnid'], "d");
 $_SESSION['txnid'] = $UserTxnid;
} else {
 $UserTxnid = $_SESSION['txnid'];
}
?>
<html>

<head>
 <title>USER-TXN-RECEIPT-<?php echo rand(1111, 9999999); ?></title>
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

 <?php
 $ReqSql = "SELECT * FROM user_transactions where UserTxnid='$UserTxnid'";
 $fetchInvoices = FetchConvertIntoArray("$ReqSql", true);
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
    <h5 class="h5">PAYMENT RECEIPTS</h5>
    <div class="c-data" style="margin-top:10px;">
     <table>
      <tr>
       <td width="50%">
        <p>
         <span><b>Member Details</b></span><br>
         <span><?php echo FETCH("SELECT * FROM users where UserId='" . $UserTxnMainUserId = FETCH("$ReqSql", "UserTxnMainUserId") . "'", "UserFullName"); ?></span><br>
         <span><?php echo FETCH("SELECT * FROM users where UserId='" . FETCH("$ReqSql", "UserTxnMainUserId") . "'", "UserPhoneNumber"); ?></span><br>
         <span><?php echo FETCH("SELECT * FROM users where UserId='" . FETCH("$ReqSql", "UserTxnMainUserId") . "'", "UserEmailId"); ?></span><br>
        </p>
       </td>
       <td>
        <p style="margin-left:1rem;">
         <span><b>Address Address</b></span><br>
         <?php
         $UserTxnMainUserId = FETCH("$ReqSql", "UserTxnMainUserId");
         $GetAddress = FetchConvertIntoArray("SELECT * FROM user_addresses WHERE UserAddressUserId='$UserTxnMainUserId' ORDER BY UserAddressId DESC limit 1", true);
         if ($GetAddress != null) {
          foreach ($GetAddress as $Address) { ?>
           <span class="info-details">
            <b><?php echo SECURE($Address->UserAddressType, "d"); ?></b><br>
            <span>
             <?php echo SECURE($Address->UserStreetAddress, "d"); ?>
             <?php echo SECURE($Address->UserLocality, "d"); ?>
             <?php echo SECURE($Address->UserCity, "d"); ?>
             <?php echo SECURE($Address->UserState, "d"); ?>
             <?php echo SECURE($Address->UserCountry, "d"); ?>
             <?php echo SECURE($Address->UserPincode, "d"); ?>
             <?php echo SECURE($Address->UserPincode, "d"); ?><br>
             <?php echo SECURE($Address->UserAddressContactPerson, "d"); ?><br>
             <?php echo SECURE($Address->UserAddressNotes, "d"); ?><br>
            </span>
           </span>
         <?php }
         } ?>
        </p>
       </td>
      </tr>
     </table>
     <table style="width:100%;margin-top:5px;">
      <tr>
       <td>
        <b style="color:black;">TxnRefid</b><br>
        <span><?php echo FETCH("$ReqSql", "TxnCustomRefId"); ?></span>
       </td>
       <td>
        <b style="color:black;">Txn Date</b><br>
        <span><?php echo DATE_FORMATE2("d M, Y", FETCH("$ReqSql", "UserTxnDate")); ?></span>
       </td>
       <td>
        <b style="color:black;">Txn Created At</b><br>
        <span><?php echo DATE_FORMATE2("d M, Y", FETCH("$ReqSql", "UserTxnCreatedAt")); ?></span>
       </td>
      </tr>
      <tr>
       <td>
        <b style="color:black;">Txn Type</b><br>
        <span><?php echo FETCH("$ReqSql", "UserTxnType"); ?></span>
       </td>
       <td>
        <b style="color:black;">Status</b><br>
        <span><?php echo PayStatus(FETCH("$ReqSql", "UserTxnStatus")); ?></span>
       </td>
       <td>
        <b style="color:black;">Created By</b><br>
        <span><?php echo FETCH("SELECT * FROM users where UserId='" . FETCH("$ReqSql", "UserTxnCreatedBy") . "'", "UserFullName"); ?></span>
       </td>
      </tr>
      <tr>
       <td colspan="2">
        <b style="color:black;">Txn Amount</b><br>
        <span><?php echo  Price(number_format($Price = FETCH("$ReqSql", "UserTxnAmount")), "", "Rs."); ?></span><br>
        <span><?php echo PriceInWords($Price); ?></span>
       </td>
       <td>
        <b style="color:black;">Note/Remark</b><br>
        <span><?php echo SECURE(FETCH("$ReqSql", "UserTxnDetails"), "d"); ?></span>
       </td>
      </tr>
     </table>
    </div>
   </section>

 <?php
  }
 } ?>
</body>

</html>