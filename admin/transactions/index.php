<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Transactions";
$PageDescription = "Manage all customers";
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
      document.getElementById("customers").classList.add("active");
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
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Sno</th>
                <th>InvoiceNo</th>
                <th>CustomerName</th>
                <th>SaleAmount</th>
                <th>SaleDate</th>
                <th>CreatedAt</th>
                <th>SaleStatus</th>
                <th>CreatedBy</th>
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
                      <a href="<?php echo ADMIN_URL; ?>/customers/details/index.php?customer_id=<?php echo SECURE($Sale->InvoiceCustomerId, "e"); ?>"><i class="fa fa-user"></i> <?php echo FETCH("SELECT * FROM users where UserId='" . $Sale->InvoiceCustomerId . "'", "UserFullName"); ?></a>
                    </td>
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
                      <?php echo FETCH("SELECT * FROM users where UserId='" . $Sale->InvoiceCreatedBy . "'", "UserFullName"); ?>
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
                <td colspan="3" align="right"><b class="p-2">Net Total</b></td>
                <td colspan="7"><?php echo Price($TotalSale, "text-success bold fs-15px", "Rs."); ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <?php
    include $Dir . "/include/forms/customer-add.php"; ?>
  </div>
  <?php include $Dir . "/include/admin/footer.php"; ?>
  <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>