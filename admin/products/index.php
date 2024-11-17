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
                    <div class="col-md-12 mb-4">
                      <div class="flex-s-b">
                        <a href="add.php" class="btn btn-sm btn-default mb-0 action-btn mr-1"><i class="fa fa-plus"></i></a>
                        <h4 class="app-heading w-100 mb-0 mt-0"><?php echo $PageName; ?> | <?php echo $PageDescription; ?></h4>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <form class="row">
                        <div class="col-md-4 mb-3">
                          <div class="flex-s-b">
                            <input type="search" onchange="form.submit()" value="<?php echo IfRequested("GET", "ProductModalNo", "", false); ?>" name="ProductModalNo" list="ProductModalNo" placeholder="Search Modal No..." class="form-control mb-0 form-control-sm w-100">
                            <?php SUGGEST_SQL_DATA("SELECT * FROM products", "ProductModalNo", "ASC"); ?>
                            <?php if (isset($_GET['ProductModalNo'])) { ?>
                              <a href="index.php" class="btn btn-sm btn-danger w-50 ml-3"><i class="fa fa-times"></i> Clear Search</a>
                            <?php } ?>
                          </div>
                        </div>
                        <div class="col-dm-8 text-right">
                          <a href="export.php" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Export All</a>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-12">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Sno</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>ModalNo</th>
                            <th>Warranty</th>
                            <th>StockIn</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <?php
                        if (isset($_GET['ProductModalNo'])) {
                          $ProductModalNo = $_GET['ProductModalNo'];
                          $Products = FetchConvertIntoArray("SELECT * FROM products where ProductModalNo like '%$ProductModalNo%' ORDER BY ProductId ASC", true);
                        } else {
                          $Products = FetchConvertIntoArray("SELECT * FROM products ORDER BY ProductId ASC", true);
                        }
                        if ($Products != null) {
                          $Sno = 0;
                          foreach ($Products as $Data) {
                            $Sno++; ?>
                            <tr>
                              <td><?php echo $Sno; ?></td>
                              <td><?php echo $Data->ProductName; ?><br> <span class="text-grey">(<?php echo $Data->ProductCapacity; ?> Ah)</span></td>
                              <td><?php echo $Data->ProductType; ?></td>
                              <td><?php echo $Data->ProductModalNo; ?></td>
                              <td><?php echo $Data->ProductWarrantyinMonths; ?> months</td>
                              <td><?php echo $StockCount = TOTAL("SELECT * FROM product_serial_no where ProductMainProId='" . $Data->ProductID . "'"); ?></td>
                              <td>
                                <a href="add-stock.php?proid=<?php echo $Data->ProductID; ?>" class="btn btn-xs btn-success">View Stock</a>
                                <?php if ($StockCount == 0) {
                                  CONFIRM_DELETE_POPUP(
                                    "products_data",
                                    [
                                      "delete_products" => true,
                                      "control_id" => $Data->ProductID,
                                    ],
                                    "products",
                                    "Remove",
                                    "btn btn-xs btn-danger"
                                  );
                                } ?>
                              </td>
                            </tr>
                        <?php }
                        } ?>
                      </table>
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