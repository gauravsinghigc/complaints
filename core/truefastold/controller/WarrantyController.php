<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/sessionvariables.php';

if (isset($_POST['CreateWarrantyCard'])) {
 $WarrantyData = array(
  "WarrantyCustomerId" => SECURE($_POST['WarrantyCustomerId'], "d"),
  "WarrantyCustomId" => $_POST['WarrantyCustomId'],
  "WarrantyProductSno" => $_POST['WarrantyProductSno'],
  "WarrantyProductModalNo" => $_POST['WarrantyProductModalNo'],
  "WarrantyProductMfgDate" => $_POST['WarrantyProductMfgDate'],
  "WarrantyProductPurchasedate" => $_POST['WarrantyProductPurchasedate'],
  "WarrantyProductCapacity" => $_POST['WarrantyProductCapacity'] . " AH",
  "WarrantyProductMonthWarranty" => $_POST['WarrantyProductMonthWarranty'] . " Months",
  "WarrantyProductLife" => $_POST['WarrantyProductLife'] . " Years",
  "WarrantyExpireDate" => $_POST['WarrantyExpireDate'],
  "WarrantyStatus" => $_POST['WarrantyStatus'],
  "WarrantyProductCreatedAt" => RequestDataTypeDate(),
  "WarrantyProductUpdatedAt" => RequestDataTypeDate,
  "WarrantyProductCreatedBy" => LOGIN_UserId
 );

 $Check = CHECK("SELECT * FROM warranty_products where WarrantyProductSno='" . $_POST['WarrantyProductSno'] . "'");
 if ($Check != true) {
  $Save = INSERT("warranty_products", $WarrantyData);
  $Msg = "Unable To Save Warranty Details at the moment!";
  $Exits = false;
 } else {
  $Save = false;
  $Msg = "Warranty Details Already saved into system for Serial No. <b>" . $_POST['WarrantyProductSno'] . "</b>";
  $Exits = true;
 }

 if ($Save == true) {

  $_SESSION['WARRANTY_SERIAL_NO'] = $_POST['WarrantyProductSno'];
  $access_url = ADMIN_URL . "/services/add-complaint-details.php";
 } else {
  if ($Exits == true) {
   $_SESSION['WARRANTY_SERIAL_NO'] = $_POST['WarrantyProductSno'];
   $access_url = ADMIN_URL . "/services/add-complaint-details.php";
  } else {
   $access_url = $access_url;
  }
 }

 RESPONSE($Save, "Warranty Details saved for future references", "$Msg");
}
