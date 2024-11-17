<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Transactions";
$PageDescription = "Manage all customers";

if (isset($_GET['uid'])) {
 $_SESSION['REQ_UserId'] = SECURE($_GET['uid'], "d");
 $REQ_UserId = $_SESSION['REQ_UserId'];
} else {
 $REQ_UserId = $_SESSION['REQ_UserId'];
}

$PageSqls = "SELECT * FROM users where UserId='$REQ_UserId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="utf-8" />
 <title><?php echo GET_DATA("UserSalutation"); ?> <?php echo GET_DATA("UserFullName"); ?> | <?php echo APP_NAME; ?></title>
 <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
 <meta name="keywords" content="<?php echo APP_NAME; ?>">
 <meta name="description" content="<?php echo SHORT_DESCRIPTION; ?>">
 <?php include $Dir . "/include/admin/header_files.php"; ?>
 <script type="text/javascript">
  function SidebarActive() {
   document.getElementById("customers").classList.add("active");
   document.getElementById("emp_txn").classList.add("active");

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

   <?php include "c-profile.php"; ?>
   <div class="row">
    <div class="col-md-12">
     <h5 class="app-heading mt-10px"><?php echo $PageName; ?></h5>
    </div>
   </div>
   <div class="row">
    <div class="col-md-12">
     <?php include "common-nav.php"; ?>
    </div>
    <div class="col-md-12">
     <h5 class="app-sub-heading">Add Transactions Record</h5>
    </div>
   </div>

   <form method="post" action="<?php echo CONTROLLER; ?>/usercontroller.php">
    <?php FormPrimaryInputs(true, [
     "UserTxnMainUserId" => $REQ_UserId
    ]); ?>
    <div class="row">
     <div class="col-md-2 form-group">
      <label>Txn Date</label>
      <input type="date" name="UserTxnDate" class="form-control" value="<?php echo date("Y-m-d"); ?>">
     </div>

     <div class="col-md-2 form-group">
      <label>Txn Type</label>
      <select name="UserTxnType" class="form-control" required="">
       <option value="Others">Select Txn Type</option>
       <?php SelectInputOptions(EMP_TXN_TYPES, null); ?>
      </select>
     </div>

     <div class="col-md-2 form-group">
      <label>Txn Amount</label>
      <input type="text" name="UserTxnAmount" class="form-control" value="" required placeholder="Rs.10,000">
     </div>

     <div class="col-md-2 form-group">
      <label>Txn Status</label>
      <select name="UserTxnStatus" class="form-control" required>
       <option value="null">Select Payment Status</option>
       <?php SelectInputOptions(PAID_UNPAID_STATUS, null); ?>
      </select>
     </div>

     <div class="col-md-3 form-group">
      <label>Notes/Remarks</label>
      <textarea class="form-control" name="UserTxnDetails" rows="1"></textarea>
     </div>
     <div class="col-md-12 text-right">
      <button class="btn btn-md btn-success" name="UserTransactionRecords">Add Txn Record <i class="fa fa-angle-right"></i></button>
     </div>
    </div>
   </form>

   <div class="row">
    <div class="col-md-12">
     <h5 class="app-sub-heading">Transactions History</h5>
     <table class="table table-striped">
      <thead>
       <tr>
        <th>Sno</th>
        <th>RefId</th>
        <th>TxnDate</th>
        <th>TxnAmount</th>
        <th>Type</th>
        <th>TxnStatus</th>
        <th>TxnCreatedAt</th>
        <th>Note</th>
        <th>Action</th>
       </tr>
      </thead>
      <tbody>
       <?php
       $UserTxnSqls = "SELECT * FROM user_transactions where UserTxnMainUserId='$REQ_UserId' ORDER BY DATE('UserTxnDate') DESC";
       $FetchTxnRecords = FetchConvertIntoArray($UserTxnSqls, true);
       if ($FetchTxnRecords == null) {
        NoDataTableView("No Txn Record Found", 8);
       } else {
        $Sno = 0;
        $TotalCalculatedAmount = 0;
        foreach ($FetchTxnRecords as $Data) {
         $Sno++;
         $TotalCalculatedAmount += $Data->UserTxnAmount;  ?>
         <tr>
          <td><?php echo $Sno; ?></td>
          <td><span class="bold text-primary"><?php echo $Data->TxnCustomRefId; ?></span></td>
          <td><?php echo DATE_FORMATE2("d M, Y", $Data->UserTxnDate); ?></td>
          <td><?php echo Price(number_format($Data->UserTxnAmount), "text-success", "Rs."); ?></td>
          <td><?php echo $Data->UserTxnType; ?></td>
          <td><?php echo PayStatus($Data->UserTxnStatus); ?></td>
          <td><?php echo DATE_FORMATE2("d M, Y", $Data->UserTxnCreatedAt); ?></td>
          <td><?php echo SECURE($Data->UserTxnDetails, "d"); ?></td>
          <td>
           <a href="<?php echo E_DOC_URL; ?>/txn-receipt.php?txnid=<?php echo SECURE($Data->UserTxnid, "e"); ?>">View Receipt</a>
          </td>
         </tr>
        <?php } ?>
        <tr>
         <td colspan="3"></td>
         <td><?php echo Price($TotalCalculatedAmount, "text-success bold", "Rs."); ?></td>
         <td colspan="5"></td>
        </tr>
       <?php
       } ?>
      </tbody>
     </table>
    </div>
   </div>


   <!--=====
    </==============================================-->
   <!--End page content-->
  </div>
  <!--===================================================-->

  <?php include $Dir . "/include/admin/footer.php"; ?>
  <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
 </div>
 <?php include $Dir . "/include/admin/footer_files.php"; ?>
</body>

</html>