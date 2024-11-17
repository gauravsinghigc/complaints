<?php
$Dir = "../../";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "Select Products";
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
      document.getElementById("sales").classList.add("active");
      document.getElementById("add_sale").classList.add("active");
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

      <div class="d-flex align-items-center mb-1">
        <div>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;"><?php echo $PageName; ?></a></li>
          </ol>
          <h1 class="page-header mb-0"><?php echo $PageName; ?> <small>Sale SessionId : <?php echo $_SESSION['INVOICE_AND_CREATION_SESSION']; ?></small></h1>
        </div>
      </div>

      <div class="row mb-5px">
        <div class="col-md-12">
          <div class="flex-space-evenly">
            <div>
              <a href="#" class="btn btn-md btn-success">1</a> Select Customers <i class="fa fa-angle-double-right text-grey"></i>
            </div>
            <div>
              <a href="#" class="btn btn-md btn-success">2</a> Select Products <i class="fa fa-angle-double-right text-grey"></i>
            </div>
            <div>
              <a href="#" class="btn btn-md btn-default">3</a> Add Payment & Invoice Details <i class="fa fa-angle-double-right text-grey"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-5">
          <h4 class="app-heading">Sale Details</h4>
          <?php
          if (isset($_GET['customer_id'])) {
            $customer_id = SECURE($_GET['customer_id'], "d");
            $_SESSION['SaleCustomerId'] = $customer_id;
          } else {
            $customer_id = $_SESSION['SaleCustomerId'];
          }
          $FetchCustomers = FetchConvertIntoArray("SELECT * FROM users where UserId='$customer_id'", true);
          if ($FetchCustomers == null) {
            NoData("No Customer Found!");
          } else { ?>
            <?php
            foreach ($FetchCustomers as $Customers) {
            ?>
              <h6 class="app-sub-heading">Customer Details</h6>
              <p class="shadow-sm p-2 rounded-1 pb-20px">
                <span class="fs-16px bold text-grey"><?php echo $Customers->UserSalutation; ?></span>
                <span class="fs-16px bold"><?php echo $Customers->UserFullName; ?></span>
                <span class="pull-right text-grey italic">CUSTOMERID000<?php echo $Customers->UserId; ?></span><br>
                <span class="fs-13px">
                  <span><b>Company name : </b><?php echo $Customers->UserDesignation; ?> @ <?php echo $Customers->UserCompanyName; ?> </span><br>
                  <span><b>Department : </b><?php echo $Customers->UserDepartment; ?></span><br>
                  <span><b>Phone Number : </b><?php echo $Customers->UserPhoneNumber; ?></span><br>
                  <span><b>Email-ID : </b><?php echo $Customers->UserEmailId; ?></span><br>
                  <span><b class="text-grey">Address : </b>
                    <?php
                    $UserId = $Customers->UserId;
                    $CheckAddress = CHECK("SELECT * FROM user_addresses where UserAddressUserId='$UserId'");
                    if ($CheckAddress == null) {
                      echo "No Address found!";
                    } else {
                      $FetchAddress = FetchConvertIntoArray("SELECT * FROM user_addresses where UserAddressUserId='$UserId'", true);
                      if ($FetchAddress != null) {
                        foreach ($FetchAddress as $Address) {
                          $UserAddressId = $Address->UserAddressId;
                          echo "<br><b>" . SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserAddressType"), "d") . "</b> - ";
                          echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserStreetAddress"), "d");
                          echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserLocality"), "d");
                          echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserCity"), "d");
                          echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserState"), "d");
                          echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserCountry"), "d");
                          echo "-";
                          echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserPincode"), "d");
                          echo SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserAddressContactPerson"), "d");
                        }
                      }
                    }
                    ?>
                  </span>
                </span><br>
                <a href="add-sale.php" class="btn btn-sm btn-success"><i class="fa fa-angle-left"></i> Change Customer</a>
              </p>

          <?php
            }
          }
          ?>
        </div>

        <div class="col-md-7">
          <h4 class="app-heading">Select & Add Products</h4>

          <div class="row">
            <div class="col-md-7 form-group">
              <form>
                <div class="form-group">
                  <label>Enter Serial No</label>
                  <?php if (isset($_GET['ProductSerialNo'])) {
                    $ProductSerialNo = $_GET['ProductSerialNo'];
                  } else {
                    $ProductSerialNo = "";
                  } ?>
                  <input type="text" value="" name="ProductSerialNo" onchange="form.submit()" class="form-control" list="ProductSerialNo">
                  <?php SUGGEST("product_serial_no", "ProductSerialNo", "ASC"); ?>
                </div>
              </form>
            </div>
          </div>
          <?php if (isset($_GET['ProductSerialNo'])) {
            $SerialNo = $_GET['ProductSerialNo'];
            $ProSerialNoSql = "SELECT * FROM product_serial_no where ProductSerialNo='$SerialNo'";
            $ProductMainProId = FETCH($ProSerialNoSql, "ProductMainProId");
            $ProSql = "SELECT * FROM products where ProductID='$ProductMainProId'"; ?>
            <form action="<?php echo CONTROLLER; ?>/order.php" method="POST">
              <?php FormPrimaryInputs(
                TRUE,
                [
                  "InvoiceCartCustomerId" => $_SESSION['SaleCustomerId'],
                  "requested_url" => ADMIN_URL . "/sales/select-products.php",
                ]
              ); ?>
              <div class="row">
                <div class="col-md-12">
                  <h5 class="app-sub-heading">Item Details</h5>
                </div>
                <div class="col-md-4 form-group">
                  <label>Modal No</label>
                  <input type="text" name="ProductModalNo" required="" list="ProductModalNo" value="<?php echo FETCH($ProSql, "ProductModalNo"); ?>" class="form-control">
                  <?php SUGGEST("products", "ProductModalNo", "ASC"); ?>
                </div>
                <div class="col-md-3 form-group">
                  <label>Serial No</label>
                  <input type="text" value="<?php echo $SerialNo; ?>" name="ProductSerialNo" class="form-control" required="">
                </div>
                <div class="col-md-3 form-group">
                  <label>Mfg Date</label>
                  <input type="date" value="<?php echo DATE_FORMATE2("Y-m-d", FETCH($ProSerialNoSql, "ProductMfgDate")); ?>" name="ProductMfgDate" class="form-control">
                </div>
                <div class="col-md-2 form-group">
                  <label>Capacity (AH)</label>
                  <input type="text" value="<?php echo FETCH($ProSql, "ProductCapacity"); ?>" name="ProductCapacity" class="form-control">
                </div>
                <div class="col-md-3 form-group">
                  <label>Battery Type</label>
                  <input type="text" value="<?php echo FETCH($ProSql, "ProductType"); ?>" name="ProductType" class="form-control">
                </div>
                <div class="col-md-3 form-group">
                  <label>Battery Life</label>
                  <input type="text" value="<?php echo FETCH($ProSql, "ProductLife"); ?>" name="ProductLife" class="form-control">
                </div>
                <div class="col-md-3 form-group">
                  <label>Warranty in Months</label>
                  <input type="text" name="ProductWarrantyinMonths" value="<?php echo FETCH($ProSql, "ProductWarrantyinMonths"); ?>" class="form-control">
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-6">
                  <label> Sale Price</label>
                  <input type="number" name="ProductSalePrice" value="<?php echo FETCH($ProSql, "ProductSalePrice"); ?>" id="ProductSalePrice" oninput="CalculateGSTPrice()" class="form-control">
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-6">
                  <label> MRP</label>
                  <input type="number" name="ProductMrp" value="<?php echo FETCH($ProSql, "ProductMrp"); ?>" id="mrp" class="form-control">
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-6">
                  <label> Application GST</label>
                  <select class="form-control" name="ProductApplicableTaxes" id="GstValue" onchange="CalculateGSTPrice()">
                    <?php InputOptions(["0", "5", "7", "10", "12", "15", "18", "20", "25", "28", "30"], FETCH($ProSql, "ProductApplicableTaxes")); ?>
                  </select>
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-6">
                  <label> Net Price With GST</label>
                  <input type="text" name="ProductNetPayable" id="Netprice" value="<?php echo FETCH($ProSql, "ProductNetPayable"); ?>" class="form-control" readonly="">
                </div>

                <div class="form-group col-md-12 text-right">
                  <button type="submit" name="SaveItemIntoCart" class="btn btn-md btn-success pull-right"><i class="fa fa-check-circle"></i> Add to Cart</button>
                </div>
              </div>
            </form>
          <?php } ?>
          <div class="row mt-5px">
            <div class="col-md-12">
              <h4 class="app-sub-heading">Cart Products</h4>
            </div>
          </div>
          <div class="row mt-5px">
            <div class="col-md-12">
              <?php $FetchCartItems = FetchConvertIntoArray("SELECT * FROM products, invoice_cart where products.ProductId=invoice_cart.InvoiceCartProductId and InvoiceCartCustomerId='$customer_id' group by InvoiceCartProductId", true);
              if ($FetchCartItems == null) {
                NoData("No Item Found in Cart.");
              } else { ?>
                <table class="table table-striped">
                  <?php
                  $TotalPrice = 0;
                  $NetTotalAmount = 0;
                  foreach ($FetchCartItems as $Items) {
                    $InvoiceCartProductId = $Items->InvoiceCartProductId;
                    $Qty = TOTAL("SELECT * FROM products, invoice_cart where products.ProductId=invoice_cart.InvoiceCartProductId and InvoiceCartCustomerId='$customer_id' and InvoiceCartProductId='$InvoiceCartProductId'");
                    $TotalPrice += $Items->InvoiceCartProductPrice * $Qty;
                  ?>
                    <tr>
                      <td>
                        <?php CONFIRM_DELETE_POPUP(
                          "deletecart",
                          [
                            "delete_cart_item" => true,
                            "control_id" => $Items->InvoiceCartProductId
                          ],
                          "order",
                          "<i class='fa fa-trash'></i>",
                          "btn btn-sm btn-danger"
                        ) ?>
                      </td>
                      <td>
                        <h5><?php echo $Items->ProductName; ?></h5>
                        <p class="mb-0px fs-12px">
                          <b>ModalNo:</b> <?php echo $Items->ProductModalNo; ?> |
                          <b>Brand:</b> <?php echo $Items->ProductBrandName; ?> <br>
                          <b>Capacity:</b> <?php echo $Items->ProductCapacity; ?> AH |
                          <b>Type:</b> <?php echo $Items->ProductType; ?> <br>
                          <b>Warranty : </b> <?php echo $Items->ProductWarrantyinMonths; ?> Months |
                          <b>Life :</b> <?php echo $Items->ProductLife; ?> Year<br>
                          <b>Serial Nos:</b>
                          <?php
                          $GetSno = FetchConvertIntoArray("SELECT * FROM products, invoice_cart where products.ProductId=invoice_cart.InvoiceCartProductId and InvoiceCartCustomerId='$customer_id' and InvoiceCartProductId='$InvoiceCartProductId'", true);
                          if ($GetSno != null) {
                            echo "<div class='flex-start'>";
                            $CheckifitisOne = 0;
                            foreach ($GetSno as $Values) {
                              $CheckifitisOne++;
                              if ($CheckifitisOne == 1) {
                                if ($Qty != 1) {
                                  $hidden = "";
                                } else {
                                  $hidden = "hidden";
                                }
                              } else {
                                $hidden = "";
                              }
                              echo  "<span class='bg-white p-1 rounded-2 fs-12px'>" . CONFIRM_DELETE_POPUP("serno", ["delete_serial_no" => true, "control_id" => $Values->InvoiceCartId], "order", "<i class='fa fa-times'></i>", "btn btn-xs btn-danger mb-2px $hidden") . "" . $Values->InvoiceCartProductSerialNo . "</span><br>";
                            }
                            echo "</div>";
                          } ?>

                        </p>

                      </td>
                      <td>
                        <?php echo Price($Items->InvoiceCartProductPrice, "text-success", "Rs."); ?> x <?php echo $Qty; ?>
                      </td>
                      <td align="right">
                        <?php echo Price($Items->InvoiceCartProductPrice * $Qty, "text-primary bold fs-14px", "Rs."); ?>
                      </td>
                    </tr>
                  <?php
                    $NetTotalAmount += $Items->InvoiceCartProductPrice * $Qty;
                  } ?>
                  <tr>
                    <td colspan="3" align="right"><b>Item Total Price</b></td>
                    <td align="right"><?php echo Price($TotalPrice, "text-primary bold", "Rs."); ?></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="right"><b>Net Payable Amount</b></td>
                    <td align="right"><?php echo Price($NetTotalAmount, "text-success bold fs-16px", "Rs."); ?></td>
                  </tr>
                </table>
                <?php $FindItems = TOTAL("SELECT * FROM invoice_cart where InvoiceCartCustomerId='$customer_id'");
                if ($FindItems != 0 || $FindItems != null) { ?>
                  <a href="payment-details.php" class="btn btn-md btn-success">Continue & Enter Payment details <i class="fa fa-angle-right"></i></a>
              <?php
                }
              } ?>
            </div>
          </div>
        </div>
      </div>



    </div>
    <?php include $Dir . "/include/admin/footer.php"; ?>
    <a href=" javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
  </div>

  <script>
    function CalculateGSTPrice() {
      var GstValue = document.getElementById("GstValue");
      var Netprice = document.getElementById("Netprice");
      var ProductSalePrice = document.getElementById("ProductSalePrice");
      var mrp = document.getElementById("mrp");

      if (GstValue.value == 0) {
        Netprice.value = ProductSalePrice.value;
        mrp.value = +ProductSalePrice.value + 2599;
      } else {
        Netprice.value = (+ProductSalePrice.value * (+GstValue.value / 100)) + +ProductSalePrice.value;
        mrp.value = +ProductSalePrice.value + 2599;
      }
    }
  </script>
  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>