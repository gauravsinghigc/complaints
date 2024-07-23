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
</head>

<body class='container' style="font-size:1rem !important;font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;">

  <div style="display:block;width:100%;">
    <h2>Product Details</h2>
    <hr>
    <table border="1" style="width:100%;text-align:left;">
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
    <h2>Stock & Serial No Details </h2>
    <hr>
    <table class="table table-striped" style="width:100%;" border="1">
      <thead>
        <tr>
          <th>Sno</th>
          <th>ItemSerialNo</th>
          <th>MfgDate</th>
          <th>Status</th>
          <th>CreatedAt</th>
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
            <td><?php echo DATE_FORMATE2("d M, Y", $Data->ProductSerialNoCreatedAt); ?></td>
          </tr>
      <?php
        }
      } ?>
    </table>
    <button onclick="print()" class="btn btn-sm btn-info"> Print</button>
</body>

</html>