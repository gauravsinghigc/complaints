<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/sessionvariables.php';

//create order into cart
if (isset($_POST['SaveItemIntoCart'])) {
 $access_url = SECURE($_POST['requested_url'], "d");
 $InvoiceCartCustomerId = $_SESSION['SaleCustomerId'];

 $CheckCartSerialNo = CHECK("SELECT * FROM invoice_cart where InvoiceCartProductSerialNo='" . $_POST['ProductSerialNo'] . "'");
 if ($CheckCartSerialNo == false) {

  $ProductSerialNo = $_POST['ProductSerialNo'];
  $SerialNoSQL = "SELECT * FROM product_serial_no where ProductSerialNo='$ProductSerialNo'";
  $CheckSerialNo = CHECK($SerialNoSQL);

  //check serial number is exits or not
  if ($CheckSerialNo == true) {
   $ProductId = FETCH($SerialNoSQL, "ProductMainProId");
   $ProductSql = "SELECT * FROM products where ProductId='$ProductId'";

   $cartdata = array(
    "InvoiceCartCustomerId" => $InvoiceCartCustomerId,
    "InvoiceCartProductId" => $ProductId,
    "InvoiceCartProductSerialNo" => $ProductSerialNo,
    "InvoiceCartProductPrice" => $_POST['ProductSalePrice'],
    "InvoiceCartProductMrp" => $_POST['ProductMrp'],
    "InvoiceCartItemTax" => $_POST['ProductApplicableTaxes'],
    "InvoiceCartNetPayable" => $_POST['ProductNetPayable'],
    "InvoiceCartCreatedAt" => RequestDataTypeDate(),
    "InvoiceCartCreatedBy" => LOGIN_UserId,
    "CartSessionId" => $_SESSION['INVOICE_AND_CREATION_SESSION']
   );

   //if item is not exits
  } else {
   $ProductModalNo = $_POST['ProductModalNo'];
   $ProModalSql = "SELECT * FROM products where ProductModalNo='$ProductModalNo'";

   $CheckModalNo = CHECK($ProModalSql);

   //if modal numbers exits
   if ($CheckModalNo == true) {
    $serialdata = array(
     "ProductMainProId" => FETCH($ProModalSql, "ProductID"),
     "ProductSerialNo" => $_POST['ProductSerialNo'],
     "ProductMfgDate" => $_POST['ProductMfgDate'],
     "ProuctSerialNoStatus" => "ACTIVE",
     "ProductSerialNoCreatedAt" => RequestDataTypeDate()
    );
    $Save = INSERT("product_serial_no", $serialdata);

    $cartdata = array(
     "InvoiceCartCustomerId" => $InvoiceCartCustomerId,
     "InvoiceCartProductId" => FETCH("SELECT * FROM products where ProductModalNo='$ProductModalNo'", "ProductID"),
     "InvoiceCartProductSerialNo" => $_POST['ProductSerialNo'],
     "InvoiceCartProductPrice" => $_POST['ProductSalePrice'],
     "InvoiceCartProductMrp" => $_POST['ProductMrp'],
     "InvoiceCartItemTax" => $_POST['ProductApplicableTaxes'],
     "InvoiceCartNetPayable" => $_POST['ProductNetPayable'],
     "InvoiceCartCreatedAt" => RequestDataTypeDate(),
     "InvoiceCartCreatedBy" => LOGIN_UserId,
     "CartSessionId" => $_SESSION['INVOICE_AND_CREATION_SESSION']
    );

    //if modal number is too not exits in the system
   } else {
    $ProductData = array(
     "ProductName" => "INVERTER BATTERY",
     "ProductBrandName" => APP_NAME,
     "ProductModalNo" => $_POST['ProductModalNo'],
     "ProductCapacity" => $_POST['ProductCapacity'],
     "ProductType" => $_POST['ProductType'],
     "ProductSalePrice" => $_POST['ProductSalePrice'],
     "ProductMrp" => $_POST['ProductMrp'],
     "ProductWarrantyinMonths" => $_POST['ProductWarrantyinMonths'],
     "ProductLife" => $_POST['ProductLife'],
     "ProductDescription" => "INVERTER BATTERIES",
     "ProductCreatedAt" => RequestDataTypeDate(),
     "ProductUpdateAt" => RequestDataTypeDate(),
     "ProductApplicableTaxes" => $_POST['ProductApplicableTaxes'],
     "ProductNetPayable" => $_POST['ProductNetPayable'],
     "ProductStatus" => "ACTIVE"
    );

    $Save = INSERT("products", $ProductData);
    $FreshProductsId = FETCH("SELECT * FROM products ORDER BY ProductID ASC", "ProductID");
    $serialdata = array(
     "ProductMainProId" => $FreshProductsId,
     "ProductSerialNo" => $_POST['ProductSerialNo'],
     "ProductMfgDate" => $_POST['ProductMfgDate'],
     "ProuctSerialNoStatus" => "ACTIVE",
     "ProductSerialNoCreatedAt" => RequestDataTypeDate()
    );
    $Save = INSERT("product_serial_no", $serialdata);
    $cartdata = array(
     "InvoiceCartCustomerId" => $InvoiceCartCustomerId,
     "InvoiceCartProductId" => $FreshProductsId,
     "InvoiceCartProductSerialNo" => $_POST['ProductSerialNo'],
     "InvoiceCartProductPrice" => $_POST['ProductSalePrice'],
     "InvoiceCartProductMrp" => $_POST['ProductMrp'],
     "InvoiceCartItemTax" => $_POST['ProductApplicableTaxes'],
     "InvoiceCartNetPayable" => $_POST['ProductNetPayable'],
     "InvoiceCartCreatedAt" => RequestDataTypeDate(),
     "InvoiceCartCreatedBy" => LOGIN_UserId,
     "CartSessionId" => $_SESSION['INVOICE_AND_CREATION_SESSION']
    );
   }
  }

  //send final response to the origin
  $Check = CHECK("SELECT * FROM invoice_cart where InvoiceCartProductSerialNo='" . $_POST['ProductSerialNo'] . "'");
  if ($Check == true) {
   $SaveIntoCart = INSERT("invoice_cart", $cartdata);
  } else {
   $SaveIntoCart = INSERT("invoice_cart", $cartdata);
  }
 } else {
  $SaveIntoCart = false;
 }
 RESPONSE($SaveIntoCart, "Product Save into cart successfully!", "Product Already in cart!");

 //delete cart item
} elseif (isset($_GET['delete_cart_item'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $delete_cart_item = SECURE($_GET['delete_cart_item'], "d");

 if ($delete_cart_item == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $Delete = DELETE_FROM("invoice_cart", "InvoiceCartProductId='$control_id'");
  RESPONSE($Delete, "Cart Item Deleted Successfully!", "unable to delete cart at the moment!");
 } else {
  LOCATION("warning", "Unable to delete cart items", $access_url);
 }

 //create order
} else if (isset($_POST['CreateOrder'])) {

 //check cart items
 $CustomerId = SECURE($_POST['InvoiceCustomerId'], "d");
 $CartSessionId = $_SESSION['INVOICE_AND_CREATION_SESSION'];
 $FetchCartItems = FetchConvertIntoArray("SELECT * FROM invoice_cart where InvoiceCartCustomerId='$CustomerId' and CartSessionId='$CartSessionId'", true);
 if ($FetchCartItems != null) {
  $cartitemsstatus = true;
 } else {
  $cartitemsstatus = false;
 }

 //response as per cart items
 if ($cartitemsstatus == true) {
  //invoice details
  $Address = "";
  $FetchAddress = FetchConvertIntoArray("SELECT * FROM user_addresses where UserAddressUserId='$CustomerId' ORDER BY UserAddressId DESC LIMIT 1", true);
  if ($FetchAddress != null) {
   foreach ($FetchAddress as $Address) {
    $UserAddressId = $Address->UserAddressId;
    $Address1 = SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserAddressType"), "d");
    $Address2 = SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserStreetAddress"), "d");
    $Address3 = SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserLocality"), "d");
    $Address4 = SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserCity"), "d");
    $Address5 = SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserState"), "d");
    $Address6 = SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserCountry"), "d");
    $Address7 = "-";
    $Address8 = SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserPincode"), "d");
    $Address9 = SECURE(FETCH("SELECT * FROM user_addresses where UserAddressId='$UserAddressId'", "UserAddressContactPerson"), "d");
   }
  }
  $Address = "$Address1 $Address2 $Address3 $Address4 $Address5 $Address6 $Address6 $Address7 $Address8 $Address9 ";
  $invoicedetails = array(
   "InvoiceCustomerId" => SECURE($_POST['InvoiceCustomerId'], "d"),
   "InvoiceAmount" => $_POST['InvoiceTxnAmount'],
   "InvoiceCustomId" => $_POST['InvoiceCustomId'],
   "InvoiceFooterText" => SECURE($_POST['InvoiceFooterText'], "e"),
   "InvoiceRemarks" => SECURE($_POST['InvoiceRemarks'], "e"),
   "InvoiceCreatedAt" => RequestDataTypeDate(),
   "InvoiceUpdatedAt" => RequestDataTypeDate(),
   "InvoiceCreatedBy" => LOGIN_UserId,
   "InvoiceStatus" => $_POST['Invoicetxnstatus'],
   "InvoicePaidAt" => $_POST['PaymentDate'],
   "InvoiceDate" => $_POST['InvoiceDate'],
   "InvoiceBillingAddrees" => $Address,
   "InvoiceShippingAddress" => $Address
  );
  $SaveInvoices = INSERT("invoices", $invoicedetails, false);

  //fetch latest invoice
  $InvoiceId = FETCH("SELECT * FROM invoices ORDER By InvoiceId DESC limit 1", "InvoiceId");

  //payment details
  $paymentdetails = array(
   "InvoiceMainId" => $InvoiceId,
   "InvoiceTxnAmount" => $_POST['InvoiceTxnAmount'],
   "InvoiceTxnPaymode" => $_POST['InvoiceTxnPaymode'],
   "InvoiceTxnRefId" => $_POST['InvoiceTxnRefId'],
   "Invoicetxndetails" => SECURE($_POST['Invoicetxndetails'], "e"),
   "Invoicetxnstatus" => $_POST['Invoicetxnstatus'],
   "InvoicetxnCreatedAt" => RequestDataTypeDate(),
   "InvoicetxnUpdatedAt" => RequestDataTypeDate(),
   "InvoicetxnCreatedby" => LOGIN_UserId,
   "PaymentDate" => $_POST['PaymentDate'],
   "PaymentDiscountName" => $_POST['PaymentDiscountName'],
   "PaymentDiscountAmount" => $_POST['PaymentDiscountAmount'],
   "PaymentChargeName" => $_POST['PaymentChargeName'],
   "PaymentChargeAmount" => $_POST['PaymentChargeAmount']
  );
  $SavePayments = INSERT("invoice_transactions", $paymentdetails, false);

  //move items into products table
  $Status = false;
  $FetchCartItems = FetchConvertIntoArray("SELECT * FROM invoice_cart where InvoiceCartCustomerId='$CustomerId' and CartSessionId='$CartSessionId'", true);
  foreach ($FetchCartItems as $Items) {
   $InvoiceProductMainId = $Items->InvoiceCartProductId;
   $InvoiceProductName = FETCH("SELECT * FROM products where ProductId='$InvoiceProductMainId'", "ProductName");
   $InvoiceProductSerialNo = $Items->InvoiceProductSerialNo;
   $InvoiceProductModalNo = FETCH("SELECT * FROM products where ProductId='$InvoiceProductMainId'", "ProductModalNo");
   $InvoiceProductWarranty = FETCH("SELECT * FROM products where ProductId='$InvoiceProductMainId'", "ProductWarrantyinMonths");
   $InvoiceProductSalePrice = $Items->InvoiceCartProductPrice;
   $InvoiceProductMrpPrice = $Items->InvoiceCartProductMrp;
   $InvoiceProductDetails = "
   <b>Type : </b>" . FETCH("SELECT * FROM products where ProductId='$InvoiceProductMainId'", "ProductType") . "|" .
    "<b>Dimension : </b>" . FETCH("SELECT * FROM products where ProductId='$InvoiceProductMainId'", "ProductDimension") . "|" .
    "<b>Capacity : </b>" . FETCH("SELECT * FROM products where ProductId='$InvoiceProductMainId'", "ProductCapacity") . "|" .
    "<b>Mfg. Date : </b>" . FETCH("SELECT * FROM products where ProductId='$InvoiceProductMainId'", "ProductManufacturingDate") .
    "<b>Warranty : </b>" . FETCH("SELECT * FROM products where ProductId='$InvoiceProductMainId'", "ProductManufacturingDate") . " months" .
    "<b>Life : </b>" . FETCH("SELECT * FROM products where ProductId='$InvoiceProductMainId'", "ProductLife") . "";
   $InvoiceProductWarrantyExpireAt = date("Y-m-d", strtotime("+$InvoiceProductWarranty months"));
   $InvoiceProductCreatedAt = RequestDataTypeDate();
   $InvoiceProductUpdatedAt = RequestDataTypeDate();
   $InvoiceTaxPercentage = FETCH("SELECT * FROM products where ProductId='$InvoiceProductMainId'", "ProductApplicableTaxes");

   $InvoiceDetails = array(
    "InvoiceMainId" => $InvoiceId,
    "InvoiceProductName" => $InvoiceProductName,
    "InvoiceProductSerialNo" => $InvoiceProductSerialNo,
    "InvoiceProductModalNo" => $InvoiceProductModalNo,
    "InvoiceProductWarranty" => $InvoiceProductWarranty,
    "InvoiceProductSalePrice" => $InvoiceProductSalePrice,
    "InvoiceProductMrpPrice" => $InvoiceProductMrpPrice,
    "InvoiceProductDetails" => SECURE($InvoiceProductDetails, "e"),
    "InvoiceProductCreatedAt" => $InvoiceProductCreatedAt,
    "InvoiceProductUpdatedAt" => $InvoiceProductUpdatedAt,
    "InvoiceProductStatus" => "SOLD",
    "InvoiceProductMainId" => $InvoiceProductMainId,
    "InvoiceProductSaleDate" => $_POST['InvoiceDate'],
    "InvoiceProductWarrantyExpireAt" => $InvoiceProductWarrantyExpireAt,
    "InvoiceTaxPercentage" => $InvoiceTaxPercentage,
   );
   $Save = INSERT("invoice_products", $InvoiceDetails, false);
   $update = UPDATE("UPDATE product_serial_no SET ProuctSerialNoStatus='SOLD' where ProductSerialNo='$InvoiceProductSerialNo'", false);
   $delete = DELETE("DELETE from invoice_cart where InvoiceCartProductId='$InvoiceProductMainId'");

   if ($Save == true && $update == true && $delete == true) {
    $Status = true;
   } else {
    $Status = false;
    LOCATION("warning", "Unable to move cart item into Invoice item", $access_url);
   }
  }

  if ($Status == true) {
   $access_url = ADMIN_URL . "/sales/done.php?invoiceid=" . SECURE($InvoiceId, "e");
  } else {
   $access_url = $access_url;
  }

  RESPONSE($Status, "Order Created SuccesFully!", "Unable to create Order at moment!");

  //send no item responsr
 } else {
  LOCATION("warning", "No Item found in the cart", $access_url);
 }

 //remove serial no from cart items
} elseif (isset($_GET['delete_serial_no'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $delete_serial_no = SECURE($_GET['delete_serial_no'], "d");

 if ($delete_serial_no == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $delete = DELETE_FROM("invoice_cart", "InvoiceCartId='$control_id'");
 } else {
  $delete = false;
 }
 RESPONSE($delete, "Serial Number Removed", "Unable to remove serial number");
}
