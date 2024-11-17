<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/sessionvariables.php';


//save products 
if (isset($_POST['SaveProducts'])) {
 $tablerows = array(
  "ProductName" => $_POST['ProductName'],
  "ProductBrandName" => $_POST['ProductBrandName'],
  "ProductModalNo" => strtoupper($_POST['ProductModalNo']),
  "ProductCapacity" => $_POST['ProductCapacity'],
  "ProductType" => $_POST['ProductType'],
  "ProductSalePrice" => $_POST['ProductSalePrice'],
  "ProductMrp" => $_POST['ProductMrp'],
  "ProductWarrantyinMonths" => $_POST['ProductWarrantyinMonths'],
  "ProductLife" => $_POST['ProductLife'],
  "ProductDescription" => POST("ProductDescription"),
  "ProductCreatedAt" => RequestDataTypeDate(),
  "ProductUpdateAt" => RequestDataTypeDate(),
  "ProductApplicableTaxes" => $_POST['ProductApplicableTaxes'],
  "ProductNetPayable" => $_POST['ProductNetPayable']
 );

 $Save = INSERT("products", $tablerows);

 if ($Save == true) {
  if ($_FILES['ProductImages']['name'] != "null" || $_FILES['ProductImages']['name'] != null || $_FILES['ProductImages']['name'] != "" || $_FILES['ProductImages']['name'] != " ") {
   $ProductMainProductid = FETCH("SELECT * FROM products ORDER BY ProductID DESC limit 0, 1", "ProductID");
   $total_count = count($_FILES['ProductImages']['name']);
   for ($i = 0; $i < $total_count; $i++) {
    $UploadDir = "../storage/products/pro-img/$ProductMainProductid/";

    if (!file_exists("$UploadDir")) {
     mkdir("$UploadDir", 0777, true);
    }

    $ProductImages = $_FILES['ProductImages']['name'][$i];
    $ProImageType = $_FILES['ProductImages']['type'][$i];
    $ProImageSize = $_FILES['ProductImages']['size'][$i];
    $ProImageTmpName = $_FILES['ProductImages']['tmp_name'][$i];
    $ProImageError = $_FILES['ProductImages']['error'][$i];
    $ProImageExt = pathinfo($ProductImages, PATHINFO_EXTENSION);


    $ProductName = FETCH("SELECT * FROM products WHERE ProductId='$ProductMainProductid'", "ProductName");
    $ProductSerialNo = FETCH("SELECT * FROM products WHERE ProductId='$ProductMainProductid'", "ProductSerialNo");
    $ProductName = str_replace(" ", "_", $ProductName);
    $ProductImages = $ProductName . "_" . $ProductSerialNo . "_" . $i . "_" . date("d_m_Y_h_m_s_a_") . "." . $ProImageExt;
    $ProImagePath = $UploadDir . $ProductImages;
    $ProImageStatus = 1;

    if ($ProImageExt === 'jpg' || $ProImageExt === 'jpeg' || $ProImageExt === 'png' || $ProImageExt === 'gif') {
     move_uploaded_file($ProImageTmpName, $ProImagePath);
     $SaveImages = SAVE("product_images", ["ProductMainProductid", "ProductImages"]);
    } else {
     $SaveImages = false;
    }
   }
  }
 }

 RESPONSE($Save, "Product Saved Successfully!", "Unable to Save Product at the moment!");

 //upload
} elseif (isset($_POST['UploadProducts'])) {

 if ($_FILES['DocumentFile']['name']) {
  $FileName = explode(".", $_FILES['DocumentFile']['name']);
  if ($FileName[1] == "csv") {
   $handle = fopen($_FILES['DocumentFile']['tmp_name'], "r");
   $flag = true;
   while ($data = fgetcsv($handle)) {
    if ($flag) {
     $flag = false;
     continue;
    }
    if (array(null) !== $data) {

     $array = array(
      "ProductName" => $data[0],
      "ProductCategory" => $data[1],
      "ProductBrandName" => $data[2],
      "ProductSerialNo" => $data[3],
      "ProductModalNo" => $data[4],
      "ProductSKUCODE" => $data[5],
      "ProductDimension" => $data[6],
      "ProductType" => $data[7],
      "ProductManufacturingCost" => $data[8],
      "ProductSalePrice" => $data[9],
      "ProductManufacturingDate" => $data[10],
      "ProductWarrantyinMonths" => $data[11],
      "ProductLife" => $data[12],
      "ProductWarrantyUpgradePrice" => $data[13],
      "ProductDescription" => $data[14],
      "ProductCreatedAt" => RequestDataTypeDate(),
      "ProductUpdateAt" => RequestDataTypeDate(),
      "ProductApplicableTaxes" => $data[15],
      "ProductNetPayable" => $data[16],
      "ProductStatus" => "ACTIVE",
     );
     $Save = INSERT("products", $array, false);
    }
   }
   fclose($handle);
   // RESPONSE($Save, "Product Data uploaded successfully!", "Unable to upload product data");
  }
 }

 //save product serial numbers
} elseif (isset($_POST['SaveSerialNumbers'])) {

 $SerialNos = array(
  "ProductMainProId" => SECURE($_POST['ProductMainProId'], "d"),
  "ProductSerialNo" => $_POST['ProductSerialNo'],
  "ProductMfgDate" => $_POST['ProductMfgDate'],
  "ProuctSerialNoStatus" => "ACTIVE",
  "ProductSerialNoCreatedAt" => RequestDataTypeDate()
 );

 $Check = CHECK("SELECT * FROM product_serial_no where ProductSerialNo='" . $_POST['ProductSerialNo'] . "'");
 if ($Check == null) {
  $Response = INSERT("product_serial_no", $SerialNos, false);
  $msg = "Unable to add stock in the system!";
 } else {
  $Response = false;
  $msg = "Already Exits Serail no " . $_POST['ProductSerialNo'];
 }
 RESPONSE($Response, "Stock Added into the system", "$msg");

 //else if
} elseif (isset($_GET['delete_serial_nos'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $delete_serial_nos = SECURE($_GET['delete_serial_nos'], "d");

 if ($delete_serial_nos == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $Delete = DELETE_FROM("product_serial_no", "ProductSerialNoId='$control_id'");
 } else {
  $Delete = true;
 }

 RESPONSE($Delete, "Serial No Removed from the stock", "Unable to remove serial no at the moment!");

 //update stock
} elseif (isset($_POST['UpdateSerialNumbers'])) {
 $data = array(
  "ProductSerialNo" => $_POST['ProductSerialNo'],
  "ProductMfgDate" => $_POST['ProductMfgDate'],
  "ProuctSerialNoStatus" => $_POST['ProuctSerialNoStatus']
 );
 $Response = UPDATE_DATA("product_serial_no", $data, "ProductSerialNoId='" . SECURE($_POST['ProductSerialNoId'], "d") . "'");
 RESPONSE($Response, "Stock Added into the system", "Unable to add stock in the system!");

 //delete products
} elseif (isset($_GET['delete_products'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $delete_products = SECURE($_GET['delete_products'], "d");

 if ($delete_products == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $Delete = DELETE_FROM("products", "ProductId='$control_id'");
  $Delete = DELETE_FROM("product_serial_no", "ProductMainProId='$control_id'");
 } else {
  $Delete = false;
 }
 RESPONSE($Delete, "Products Delete Successfully!", "Unable to Remove Product At the Moment!");
}
