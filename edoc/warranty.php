<?php
//include files
require "../require/modules.php";

if (isset($_GET['warrantyid'])) {
  $warrantyid = $_GET['warrantyid'];
  $_SESSION['warrantyid'] = $warrantyid;
} else {
  $warrantyid = $_SESSION['warrantyid'];
}
$WarnSql = "SELECT * FROM warranty_products where WarrantyProductsId='$warrantyid'";
$WarrantyCustomerId = FETCH($WarnSql, "WarrantyCustomerId");
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
              <span>(CID<?php echo $WarrantyCustomerId; ?>) <?php echo FETCH("SELECT * FROM users where UserId='" . $WarrantyCustomerId . "'", "UserFullName"); ?></span><br>
              <span><?php echo FETCH("SELECT * FROM users where UserId='" . $WarrantyCustomerId . "'", "UserPhoneNumber"); ?></span><br>
              <span><?php echo FETCH("SELECT * FROM users where UserId='" . $WarrantyCustomerId . "'", "UserEmailId"); ?></span><br>
            </p>
          </td>
          <td>
            <p style="margin-left:1rem;">
              <span><b>Customer Address</b></span><br>
              <?php
              $FetchAddress = FetchConvertIntoArray("SELECT * FROM user_addresses where UserAddressUserId='$WarrantyCustomerId'", true);
              if ($FetchAddress != null) {
                foreach ($FetchAddress as $Address) {
                  $UserAddressId = $Address->UserAddressId;
                  echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserStreetAddress"), "d") . " ";
                  echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserLocality"), "d") . " ";
                  echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserCity"), "d") . " ";
                  echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserState"), "d") . " ";
                  echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserCountry"), "d") . " ";
                  echo "-";
                  echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserPincode"), "d") . " ";
                  echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserAddressContactPerson"), "d") . " ";
                }
              }
              ?>
            </p>
          </td>
        </tr>
      </table>
      <table style="width:100%;margin-top:5px;">
        <tr>
          <td>
            <b style="color:black;">Product Name</b><br>
            <span><?php echo FETCH("SELECT * FROM products, product_serial_no where products.ProductId=product_serial_no.ProductMainProId and ProductSerialNo='" . FETCH($WarnSql, "WarrantyProductSno") . "'", "ProductName"); ?></span>-<br>
            <span><?php echo FETCH("SELECT * FROM products, product_serial_no where products.ProductId=product_serial_no.ProductMainProId and ProductSerialNo='" . FETCH($WarnSql, "WarrantyProductSno") . "'", "ProductBrandName"); ?></span>
          </td>
          <td>
            <b style="color:black;">Serial No</b><br>
            <span><?php echo FETCH($WarnSql, "WarrantyProductSno"); ?> <br><?php echo FETCH($WarnSql, "WarrantyProductCapacity"); ?></span>
          </td>
          <td>
            <b style="color:black;">Modal No</b><br>
            <span><?php echo FETCH($WarnSql, "WarrantyProductModalNo"); ?></span>
          </td>
        </tr>
        <tr>
          <td>
            <b style="color:black;">Mfg Date</b><br>
            <span>
              <?php echo DATE_FORMATE2("d M, Y", FETCH($WarnSql, "WarrantyProductMfgDate")); ?></span>
          </td>
          <td>
            <b style="color:black;">Sale Date</b><br>
            <span> <?php echo DATE_FORMATE2("d M, Y", FETCH($WarnSql, "WarrantyProductPurchasedate")); ?></span>
          </td>
          <td>
            <b style="color:black;">Warranty In Months</b><br>
            <span><?php echo FETCH($WarnSql, "WarrantyProductMonthWarranty"); ?></span>
          </td>
        </tr>
        <tr>
          <td>
            <b style="color:black;">Warranty Expire At</b><br>
            <span><?php echo DATE_FORMATE2("d M, Y", FETCH($WarnSql, "WarrantyExpireDate")); ?></span>
          </td>
          <td>
            <b style="color:black;">Current Status</b><br>
            <span>
              <?php
              $SaleDate = FETCH($WarnSql, "WarrantyProductPurchasedate");
              $ExpireDate = FETCH($WarnSql, "WarrantyExpireDate");
              if ($SaleDate <= $ExpireDate) {
                $Update = UPDATE("UPDATE warranty_products SET WarrantyStatus='Active' where WarrantyProductsId='$warrantyid'");
                echo "Active";
                $warranty = "warranty.png";
              } else {
                echo "Expired";
                $Update = UPDATE("UPDATE warranty_products SET WarrantyStatus='Expired' where WarrantyProductsId='$warrantyid'");
                $warranty = "expire.png";
              } ?>
            </span>
          </td>
        </tr>
      </table>
      <img src="<?php echo STORAGE_URL_D; ?>/tool-img/<?php echo $warranty; ?>" style="width:100px;float:right;margin-top:-50px;margin-right:20px;">
    </div>
  </section>
</body>

</html>