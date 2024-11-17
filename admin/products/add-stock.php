<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "Product Details";
$PageDescription = "";

if (isset($_GET['proid'])) {
  $ProductID = $_GET['proid'];
  $_SESSION['ProductID'] = $ProductID;
} else {
  $ProductID = $_SESSION['ProductID'];
}

$ProSql = "SELECT * FROM products where ProductID='$ProductID'";
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

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include $Dir . "/include/admin/loader.php"; ?>

    <?php
    include $Dir . "/include/admin/header.php";
    include $Dir . "/include/admin/sidebar.php"; ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">

            <div class="col-12">
              <div class="card card-primary">
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-12 mb-2">
                      <div class="flex-s-b">
                        <a href="index.php" class="btn btn-sm btn-default mb-0 action-btn mr-1"><i class="fa fa-angle-left"></i></a>
                        <h4 class="app-heading w-100 mb-0 mt-0"><?php echo $PageName; ?> <?php echo $PageDescription; ?></h4>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <h5 class="app-sub-heading">Product Details</h5>
                      <table class="table table-striped">
                        <?php
                        $Data = array(
                          "ProductName" => "Item Name",
                          "ProductID" => "Item ID",
                          "ProductBrandName" => "Brand",
                          "ProductModalNo" => "Modal No",
                          "ProductCapacity" => "Capacity (in AH)",
                          "ProductType" => "Type",
                          "ProductSalePrice" => "Sale Price (in Rs.)",
                          "ProductApplicableTaxes" => "Applicable Taxes (in %)",
                          "ProductNetPayable" => "Net Item Price (Rs.)",
                          "ProductMrp" => "MRP",
                          "ProductWarrantyinMonths" => "Warranty in Months",
                          "ProductLife" => "Life (in Years)",
                          "ProductStatus" => "Status"
                        );
                        foreach ($Data as $Key => $Value) { ?>
                          <tr>
                            <th><?php echo $Value; ?></th>
                            <td><?php echo FETCH($ProSql, "$Key"); ?></td>
                          </tr>
                        <?php } ?>
                      </table>
                    </div>

                    <div class="col-md-7">
                      <h5 class="app-sub-heading">Add Stock/ Serial Numbers</h5>
                      <form action="<?php echo CONTROLLER; ?>/products.php" method="POST">
                        <?php FormPrimaryInputs(true, [
                          "ProductMainProId" => $ProductID
                        ]); ?>
                        <div class="row">
                          <div class="col-md-4 form-group">
                            <label>Serial No</label>
                            <input type="text" tabindex="1" name="ProductSerialNo" list="ProductSerialNo" class="form-control" placeholder="S No: 98723E86">
                            <?php SUGGEST("product_serial_no", "ProductSerialNo", "ASC"); ?>
                          </div>
                          <div class="col-md-3 form-group">
                            <label>Mfg Date</label>
                            <input type="date" name="ProductMfgDate" value="<?php echo date("Y-m-d"); ?>" class="form-control">
                          </div>
                          <div class="col-md-3 mt-2 form-group">
                            <label class="mt-2">&nbsp;<br></label>
                            <button type="submit" name="SaveSerialNumbers" class="btn btn-md btn-success">Add Stock</button>
                          </div>
                          <div class="col-md-2 form-group">
                            <label>&nbsp;<br></label>
                            <a href="export-stock.php" target="_blank" class="btn btn-md btn-default">Export <i class="fa fa-print"></i></a>
                          </div>
                        </div>
                      </form>
                      <h5 class="app-sub-heading">Available Stock/Serial Numbers</h5>
                      <div class="row">
                        <div class="col-md-12">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Sno</th>
                                <th>ItemSerialNo</th>
                                <th>MfgDate</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <?php $GetSerialNo = FetchConvertIntoArray("SELECT * FROM product_serial_no where ProductMainProId='$ProductID'", true);
                            $Sno = 0;
                            if ($GetSerialNo != null) {

                              foreach ($GetSerialNo as $Data) {
                                $Sno++; ?>
                                <tr>
                                  <td><?php echo $Sno; ?></td>
                                  <Td><span class="bold"><?php echo $Data->ProductSerialNo; ?></span></Td>
                                  <td><?php echo DATE_FORMATE2("d M, Y", $Data->ProductMfgDate); ?></td>
                                  <td><?php echo $Data->ProuctSerialNoStatus; ?></td>
                                  <td>
                                    <a href="edit-stock.php?serialno=<?php echo $Data->ProductSerialNoId; ?>" class="btn btn-xs btn-info">Edit Details</a>
                                    <?php
                                    if ($Data->ProuctSerialNoStatus == "ACTIVE") {
                                      CONFIRM_DELETE_POPUP(
                                        "serial_no",
                                        [
                                          "delete_serial_nos" => true,
                                          "control_id" => $Data->ProductSerialNoId
                                        ],
                                        "products",
                                        "Delete",
                                        "btn btn-xs btn-danger"
                                      );
                                    } ?>
                                  </td>
                                </tr>
                            <?php
                              }
                            } ?>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php
    include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>