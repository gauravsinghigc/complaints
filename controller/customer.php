<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/sessionvariables.php';

//new customer
if (isset($_POST['SaveCustomer'])) {
 $UserSalutation = $_POST['UserSalutation'];
 $UserFullName = $_POST["UserFirstName"] . " " . $_POST['UserLastName'];
 $UserPhoneNumber = $_POST['UserPhoneNumber'];
 $UserEmailId = $_POST['UserEmailId'];
 $UserCompanyName = $_POST["UserCompanyName"];
 $UserWorkFeilds = $_POST["UserWorkFeilds"];
 $UserDepartment = $_POST["UserDepartment"];
 $UserDesignation = $_POST["UserDesignation"];
 $UserNotes = "";
 $UserStatus = $_POST["UserStatus"];
 $UserCreatedAt = date("Y-m-d h:i A");
 $UserType = $_POST["UserType"];
 $UserPassword = $_POST['UserPassword'];

 //address requests 
 $UserStreetAddress = POST("UserStreetAddress");
 $UserLocality = POST("UserLocality");
 $UserCity = POST("UserCity");
 $UserState = POST("UserState");
 $UserCountry = POST("UserCountry");
 $UserPincode = POST("UserPincode");
 $UserAddressType = POST("UserAddressType");
 $UserAddressContactPerson = POST("UserAddressContactPerson");
 $UserAddressNotes = POST("UserAddressNotes");
 $UserAddressMapUrl = POST("UserAddressMapUrl");

 //check if phone or email-id is already registered or not
 $CheckifPhone = CHECK("SELECT * FROM users where UserPhoneNumber='$UserPhoneNumber'");
 $CheckifMail = CHECK("SELECT * FROM users where UserEmailId='$UserEmailId'");
 if ($CheckifPhone != null) {;
  LOCATION("warning", "Phone Number is already registered!", $access_url);
 } elseif ($CheckifMail != null) {
  LOCATION("warning", "Email-id is already registered", $access_url);
 } else {
  $Save = SAVE("users", ["UserFullName", "UserSalutation", "UserType", "UserPassword", "UserPhoneNumber", "UserEmailId", "UserCompanyName", "UserWorkFeilds", "UserDepartment", "UserDesignation", "UserNotes", "UserStatus", "UserCreatedAt"]);
 }

 //GET registered customer id
 if ($_POST['UserCity'] != null) {
  $UserAddressUserId = FETCH("SELECT * FROM users where UserPhoneNumber='$UserPhoneNumber' AND UserEmailId='$UserEmailId' ORDER BY UserId DESC limit 0, 1", "UserId");

  //save customer address
  $Save = SAVE("user_addresses", ["UserAddressUserId", "UserStreetAddress", "UserLocality", "UserCity", "UserState", "UserCountry", "UserPincode", "UserAddressType", "UserAddressContactPerson", "UserAddressNotes", "UserAddressMapUrl"], false);
 } else {
  $Save = $Save;
 }

 //check url response
 if (isset($_POST['success_url'])) {
  $access_url = SECURE($_POST['success_url'], "d") . "?customer_id=" . SECURE($UserAddressUserId, "e");
 }

 //generate response
 RESPONSE($Save, "New Customer Details saved successfully!", "Unable to save customer details at the moment!");
}
