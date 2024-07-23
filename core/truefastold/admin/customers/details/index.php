<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Customers";
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

      <div class="row">
        <div class="col-md-4">
          <div class="user-dash">
            <div class="user-img">
              <img src="<?php echo STORAGE_URL; ?>/users/img/profile/<?php echo GET_DATA("UserProfileImage"); ?>" alt="<?php echo GET_DATA("UserFullName"); ?>" title="<?php echo GET_DATA("UserFullName"); ?>" />
            </div>
            <div class="user-details">
              <h4 class="user-name"><?php echo GET_DATA("UserSalutation"); ?> <?php echo GET_DATA("UserFullName"); ?></h4>
              <p class="mb-0 mb-1"><i><?php echo GET_DATA("UserDesignation"); ?> | <?php echo GET_DATA("UserDepartment"); ?> @ <?php echo GET_DATA("UserCompanyName"); ?> | <?php echo GET_DATA("UserWorkFeilds"); ?> </i> </p>
            </div>

            <p class="mt-0 mb-2">
              <a href="&?send_mail_to=<?php echo GET_DATA("UserEmailId"); ?>"><i class="fa fa-envelope"></i> <?php echo GET_DATA("UserEmailId"); ?></a><br>
              <a href="tel:<?php echo GET_DATA("UserPhoneNumber"); ?>"><i class="fa fa-phone-square"></i> <?php echo GET_DATA("UserPhoneNumber"); ?></a><br>
            </p>
            <hr>
            <div class="user-counter">
              <div class="list text-info">
                <h2 class="count mb-0"> <?php echo Price($Payable = AMOUNT("SELECT * FROM invoices where InvoiceCustomerId='$REQ_UserId'", "InvoiceAmount"), "text-success", "Rs."); ?></h2>
                <span class="text-grey">Net Paybale</span>
              </div>
              <div class="list text-success">
                <h2 class="count mb-0"><?php echo Price($Paid = AMOUNT("SELECT * FROM invoices, invoice_transactions where invoices.InvoiceId=invoice_transactions.InvoiceMainId and invoices.InvoiceCustomerId='$REQ_UserId'", "InvoiceTxnAmount"), "text-success", "Rs."); ?></h2>
                <span class="text-grey">Paid</span>
              </div>
              <div class="list text-danger">
                <h2 class="count mb-0"><i class="fa fa-inr"></i> <?php echo $Payable - $Paid; ?></h2>
                <span class="text-grey">Balance</span>
              </div>
            </div>
            <hr>
            <div class="user-contact-info">
              <ul>
                <?php
                $GetAddress = FetchConvertIntoArray("SELECT * FROM user_addresses WHERE UserAddressUserId='$REQ_UserId'", true);
                if ($GetAddress != null) {
                  foreach ($GetAddress as $Address) { ?>
                    <li>
                      <p class="flex-s-b">
                        <span class="icon-area">
                          <i class="fa fa-map-marker"></i>
                        </span>
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
                            <a href=" <?php echo SECURE($Address->UserAddressMapUrl, "d"); ?>" class="btn btn-sm btn-success">View Location On Map</a>

                          </span>
                        </span>
                      </p>
                    </li>
                <?php }
                } ?>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <h4 class="app-heading">All Sale</h4>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Sno</th>
                <th>InvoiceNo</th>
                <th>SaleAmount</th>
                <th>SaleDate</th>
                <th>CreatedAt</th>
                <th>SaleStatus</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $fetchSales = FetchConvertIntoArray("SELECT * FROM invoices ORDER BY InvoiceId DESC", true);
              if ($fetchSales != null) {
                $Count = 0;
                $TotalSale = 0;
                foreach ($fetchSales as $Sale) {
                  $Count++;
                  $TotalSale += $Sale->InvoiceAmount; ?>
                  <tr>
                    <td><?php echo $Count; ?></td>
                    <td><span class="text-info"><b><?php echo $Sale->InvoiceCustomId; ?></b></span></td>
                    <td>
                      <?php echo Price($Sale->InvoiceAmount, "text-success bold", "Rs."); ?>
                    </td>
                    <td>
                      <?php echo DATE_FORMATE2("d M, Y", $Sale->InvoiceDate); ?>
                    </td>
                    <td>
                      <?php echo DATE_FORMATE2("d M, Y", $Sale->InvoiceCreatedAt); ?>
                    </td>
                    <td>
                      <?php echo PayStatus($Sale->InvoiceStatus); ?>
                    </td>
                    <td>
                      <a href="../../edoc/invoice.php?invoiceid=<?php echo SECURE($Sale->InvoiceId, "e"); ?>" class="text-primary bold mr-3px p-1 shadow-s">Invoice</a>
                      <a href="../../edoc/warranty.php?invoiceid=<?php echo SECURE($Sale->InvoiceId, "e"); ?>" class="text-success p-1 shadow-s bold mr-3px">W-Card</a>
                      <a href="../../edoc/receipt.php?invoiceid=<?php echo SECURE($Sale->InvoiceId, "e"); ?>" class="text-info p-1 shadow-s bold mr-3px">Receipt</a>
                    </td>
                  </tr>
              <?php }
              } ?>
              <tr>
                <td colspan="2" align="right"><b class="p-2">Net Total</b></td>
                <td colspan="5"><?php echo Price($TotalSale, "text-success bold fs-15px", "Rs."); ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <?php include $Dir . "/include/admin/footer.php"; ?>
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>