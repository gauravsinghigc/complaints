<?php
$Dir = "../../";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "Invoice & Payment Details";
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
          <h1 class="page-header mb-0"><?php echo $PageName; ?></h1>
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
                    $CheckAddress = CHECK("SELECT * FROM user_addresses where UserAddressUserId='$customer_id'");
                    if ($CheckAddress == null) {
                      echo "No Address found!";
                    } else {
                      $FetchAddress = FetchConvertIntoArray("SELECT * FROM user_addresses where UserAddressUserId='$customer_id'", true);
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
              <h6 class="app-sub-heading">Cart Items</h6>
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
          <?php
              }
            }
          } ?>
        </div>

        <div class="col-md-7">
          <h4 class="app-heading">Enter Invoice & Payment Details</h4>
          <h5 class="app-sub-heading">Invoice Details</h5>
          <form action="<?php echo CONTROLLER; ?>/order.php" method="POST">
            <?php
            $TotalInvoice = TOTAL("SELECT * FROM invoices") + 1;
            FormPrimaryInputs(true, [
              "InvoiceCustomerId" => $_SESSION['SaleCustomerId'],
            ]) ?>
            <input type="hidden" id="paid" value="">
            <div class="row mb-5px">
              <div class="col-md-4 form-group">
                <label>Invoice No</label>
                <input type="text" name="InvoiceCustomId" class="form-control" value="INV-<?php echo date("Y"); ?>-<?php echo date("Y", strtotime("+1 year")); ?>/000<?php echo $TotalInvoice; ?>">
              </div>
              <div class="col-md-4 form-group">
                <label>Invoice Date</label>
                <input type="date" name="InvoiceDate" class="form-control" value="<?php echo date("Y-m-d"); ?>">
              </div>
              <div class="col-md-6 form-group">
                <label>Invoice Footer Text</label>
                <textarea name="InvoiceFooterText" rows="3" class="form-control"></textarea>
              </div>
              <div class="col-md-6 form-group">
                <label>Note & Remarks</label>
                <textarea name="InvoiceRemarks" rows="3" class="form-control"></textarea>
              </div>
            </div>
            <h5 class="app-sub-heading">Payment Details</h5>
            <div class="row">
              <div class="col-md-12">
                <table class="table">
                  <tr>
                    <td align="right">Product Total Amount</td>
                    <td align="right"><?php echo Price($NetTotalAmount, "text-success bold", "Rs."); ?></td>
                  </tr>
                  <tr>
                    <td align="right">
                      <input type="text" name="PaymentDiscountName" class="form-control w-50" value="" placeholder="Discount Name">
                    </td>
                    <td align="right">
                      <input type="text" name="PaymentDiscountAmount" oninput="CalculateNetPayable()" id="disocuntamountinput" class="form-control w-50" value="0" placeholder="Discount Amount (Rs.)">
                    </td>
                  </tr>
                  <tr>
                    <td align="right">
                      <input type="text" name="PaymentChargeName" class="form-control w-50" value="" placeholder="Charge Name">
                    </td>
                    <td align="right">
                      <input type="text" name="PaymentChargeAmount" oninput="CalculateNetPayable()" id="chargeaamountinput" class="form-control w-50" value="0" placeholder="Charge Amount (Rs.)">
                    </td>
                  </tr>
                  <tr>
                    <td align="right">Net Payable Amount</td>
                    <td align="right" id="netpayabletext"><?php echo Price($NetTotalAmount, "text-success bold fs-17px", "Rs"); ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="row mb-5px">
              <div class="col-md-4 form-group">
                <label>Payable Amount</label>
                <input type="text" name="InvoiceTxnAmount" oninput="CalculateNetPayable()" id="netpaidinput" value="<?php echo $NetTotalAmount; ?>" class="form-control" required="">
              </div>
              <div class="col-md-4 form-group">
                <label>Payment Status</label>
                <select name="Invoicetxnstatus" class="form-control">
                  <option value="Paid" selected>Paid</option>
                  <option value="UnPaid">UnPaid</option>
                  <option value="Pending">Pending</option>
                </select>
              </div>
              <div class="col-md-4 form-group">
                <label>Payment Date</label>
                <input type="date" name="PaymentDate" class="form-control" required="" value="<?php echo date("Y-m-d"); ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 form-group">
                <label>Pay Mode</label>
                <select name="InvoiceTxnPaymode" onchange="Credit()" id="credit" class="form-control" required="">
                  <?php foreach (TXN_MODE as $txnmode) { ?>
                    <option value="<?php echo $txnmode; ?>"><?php echo $txnmode; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-8 form-group">
                <label>RefNo/TxnId/RefCode</label>
                <input type="text" name="InvoiceTxnRefId" class="form-control" value="" placeholder="txn122123/cash/SNO123 etc" required="">
              </div>
              <div class="col-md-12 form-group">
                <label>Complete/More Details</label>
                <textarea class="form-control" name="Invoicetxndetails" rows="2" required=""></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <button name="CreateOrder" class="btn btn-lg btn-success" type="submit"><i class="fa fa-check-circle-o"></i> Complete & Finish</button>
              </div>
            </div>
          </form>
        </div>
      </div>



    </div>
    <?php include $Dir . "/include/admin/footer.php"; ?>
    <a href=" javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
  </div>
  <script>
    function Credit() {
      var credit = document.getElementById("credit");
      if (credit.value == "CREDIT") {
        document.getElementById("paid").value = document.getElementById("netpaidinput").value;
        document.getElementById("netpaidinput").value = 0;
      } else {
        document.getElementById("netpaidinput").value = document.getElementById("paid").value;
      }
    }

    function CalculateNetPayable() {
      var disocuntamountinput = document.getElementById("disocuntamountinput");
      var chargeaamountinput = document.getElementById("chargeaamountinput");
      var netpaidinput = document.getElementById("netpaidinput");
      var netpayabletext = document.getElementById("netpayabletext");
      var producttotalamount = <?php echo $NetTotalAmount; ?>;
      var netpayableamount = 0;

      if (disocuntamountinput.value == 0 && chargeaamountinput.value == 0) {
        netpaidinput.value = producttotalamount;
        netpayabletext.innerHTML = "<span class='text-success fs-17px bold'> Rs." + producttotalamount + "</span>";
      } else {
        netpayableamount = (+producttotalamount + +chargeaamountinput.value) - +disocuntamountinput.value;
        netpaidinput.value = netpayableamount;
        netpayabletext.innerHTML = "<span class='text-success fs-17px bold'> Rs." + netpayableamount + "</span>";
      }
    }
  </script>
  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>