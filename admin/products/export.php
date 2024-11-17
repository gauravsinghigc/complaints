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
</head>

<body class='container' style="font-size:1rem !important;font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;">

  <div class="row" style="display:block;">
    <table class="table table-striped" style="width:1000px;" border="1">
      <thead>
        <tr>
          <th>Sno</th>
          <th>Name</th>
          <th>Type</th>
          <th>ModalNo</th>
          <th>SalePrice</th>
          <th>Life</th>
          <th>Warranty</th>
          <th>StockIn</th>
        </tr>
      </thead>
      <?php
      $Products = FetchConvertIntoArray("SELECT * FROM products ORDER BY ProductId ASC", true);
      if ($Products != null) {
        $Sno = 0;
        foreach ($Products as $Data) {
          $Sno++; ?>
          <tr>
            <td><?php echo $Sno; ?></td>
            <td class="text-primary"><?php echo $Data->ProductName; ?> <span class="text-grey">(<?php echo $Data->ProductCapacity; ?> Ah)</span></td>
            <td><?php echo $Data->ProductType; ?></td>
            <td><?php echo $Data->ProductModalNo; ?></td>
            <td><?php echo Price($Data->ProductSalePrice, "text-sucsess", "Rs."); ?> <span class="text-grey">(+<?php echo $Data->ProductApplicableTaxes; ?>%)</span></td>
            <td><?php echo $Data->ProductLife; ?> years</td>
            <td><?php echo $Data->ProductWarrantyinMonths; ?> months</td>
            <td><?php echo $StockCount = TOTAL("SELECT * FROM product_serial_no where ProductMainProId='" . $Data->ProductID . "'"); ?></td>
          </tr>
      <?php }
      } ?>
    </table>
    <button onclick="print()" class="btn btn-sm btn-info"> Print</button>
</body>

</html>