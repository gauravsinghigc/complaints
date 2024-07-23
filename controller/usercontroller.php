<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/sessionvariables.php';


//update profile image 
if (isset($_POST['updateprofileimage'])) {
 $UserId  = LOGIN_UserId;
 $current_img = SECURE($_POST['current_img'], "d");
 $UserProfileImage = UPLOAD_FILES("../storage/users/img/profile", "$current_img", LOGIN_UserFullName . "_UID_" . $UserId, "Profile", "UserProfileImage");
 $Update = UPDATE("UPDATE users SET UserProfileImage='$UserProfileImage' where user_id='$UserId'");
 RESPONSE($Update, "Profile Image Updated!", "Unable to update profile image!");

 //update
} elseif (isset($_POST['UpdateProfileDetails'])) {
 $UserId = SECURE($_POST['edit_request_for'], "d");

 $profiledata = array(
  "UserSalutation" => $_POST['UserSalutation'],
  "UserFullName" => $_POST['UserFullName'],
  "UserPhoneNumber" => $_POST['UserPhoneNumber'],
  "UserEmailId" => $_POST['UserEmailId'],
  "UserDateOfBirth" => $_POST['UserDateOfBirth'],
  "UserNotes" => SECURE($_POST['UserNotes'], "e"),
  "UserUpdatedAt" => RequestDataTypeDate()
 );
 $Update = UPDATE_DATA("users", $profiledata, "UserId='$UserId'");
 RESPONSE($Update, "Profile Updated Successfully!", "Unable to update profile at the moment!");

 //update user address
} elseif (isset($_POST['UpdateAddress'])) {
 $UserId = SECURE($_POST['edit_request_for'], "d");

 $addressdata = array(
  "UserStreetAddress" => POST("UserStreetAddress"),
  "UserLocality" => POST("UserLocality"),
  "UserCity" => POST("UserCity"),
  "UserState" => POST("UserState"),
  "UserCountry" => POST("UserCountry"),
  "UserPincode" => POST("UserPincode"),
  "UserAddressType" => POST("UserAddressType"),
  "UserAddressContactPerson" => POST("UserAddressContactPerson"),
  "UserAddressNotes" => POST("UserAddressNotes"),
  "UserAddressMapUrl" => POST("UserAddressMapUrl")
 );
 $UpdateAddress = UPDATE_DATA("user_addresses", $addressdata, "UserAddressUserId='$UserId'");
 RESPONSE($UpdateAddress, "UserAddresses Updated Successfully!", "Unable to update user address at the moment!");

 //update employement details
} elseif (isset($_POST['UpdateEmploymentDetails'])) {
 $req_data_for = SECURE($_POST['req_data_for'], "d");

 $employementdetails = array(
  "UserCompanyName" => $_POST['UserCompanyName'],
  "UserWorkFeilds" => $_POST['UserWorkFeilds'],
  "UserDepartment" => $_POST['UserDepartment'],
  "UserDesignation" => $_POST['UserDesignation'],
  "UserJoinningDate" => $_POST['UserJoinningDate'],
  "UserNotes" => POST('UserNotes'),
  "UserUpdatedAt" => RequestDataTypeDate()
 );

 //emp work status
 $empwork = array(
  "UserEmpMainUserId" => $req_data_for,
  "UserEmpWorkDays" => $_POST['UserEmpWorkDays'],
  "UserEmpWorkHours" => $_POST['UserEmpWorkHours']
 );

 $CheckEmpWorksStatus = CHECK("SELECT * FROM user_employments where UserEmpMainUserId='$req_data_for'");
 if ($CheckEmpWorksStatus == null) {
  INSERT("user_employments", $empwork);
 } else {
  UPDATE_DATA("user_employments", $empwork, "UserEmpMainUserId='$req_data_for'");
 }

 $UpdateEmployment = UPDATE_DATA("users", $employementdetails, "UserId='$req_data_for'");
 RESPONSE($UpdateEmployment, "User Employment Details Updated Successfully!", "Unable to Update User Employement Details");

 //update pay scale records
} else if (isset($_POST['UpdatePayScaleRecords'])) {
 $req_data_for = SECURE($_POST['req_data_for'], "d");

 //get pay scale data
 $payscale = array(
  "UserPayScale" => $_POST['UserPayScale'],
  "UserPayFrequency" => $_POST['UserPayFrequency'],
  "UserPayType" => $_POST['UserPayType'],
  "UserPayStartFrom" => $_POST['UserPayStartFrom'],
  "UserPayDate" => $_POST['UserPayDate'],
  "UserPayNotes" => POST("UserPayNotes"),
  "UserMainUserId" => $req_data_for
 );

 //check pay scale exits or not
 $checkpayscaleexitsornot = CHECK("SELECT * FROM user_pay_scale where UserMainUserId='$req_data_for'");
 if ($checkpayscaleexitsornot != null) {
  $PayScaleRecord = UPDATE_DATA("user_pay_scale", $payscale, "UserMainUserId='$req_data_for'");
 } else {
  $PayScaleRecord = INSERT("user_pay_scale", $payscale);
 }

 RESPONSE($PayScaleRecord, "Pay Scale Record Updated Successfully!", "Unable to update Pay scale record!");

 //update banks details
} elseif (isset($_POST['UpdateBankDetails'])) {
 $UserBankMainUserId = SECURE($_POST['UserBankMainUserId'], "d");

 //get bank details
 $bankdetails = array(
  "UserBankMainUserId" => $UserBankMainUserId,
  "UserBankName" => $_POST['UserBankName'],
  "UserBankAccounHolderName" => $_POST['UserBankAccounHolderName'],
  "UserBankAccountNumber" => $_POST['UserBankAccountNumber'],
  "UserBankAccountIFSC" => $_POST['UserBankAccountIFSC'],
  "UserBankOtherDetails" => POST('UserBankOtherDetails'),
 );

 $CheckBankDetailsExistsOrNot = CHECK("SELECT * FROM user_bank_details where UserBankMainUserId='$UserBankMainUserId'");
 if ($CheckBankDetailsExistsOrNot == null) {
  $BankDetailRecord = INSERT("user_bank_details", $bankdetails);
 } else {
  $BankDetailRecord = UPDATE_DATA("user_bank_details", $bankdetails, "UserBankMainUserId='$UserBankMainUserId'");
 }

 RESPONSE($BankDetailRecord, "Bank Details are updated successfully!", "Unable to update bank details");

 //attandance records
} else if (isset($_POST['AttandanceRecords'])) {
 $UserAttandanceMainUserId = SECURE($_POST['UserAttandanceMainUserId'], "d");
 $UserAttandanceMonth = date("M-Y", strtotime($_POST['UserAttandanceStartDate']));
 //get attandance details
 $attandance = array(
  "UserAttandanceMainUserId" => $UserAttandanceMainUserId,
  "UserAttandanceStartDate" => $_POST['UserAttandanceStartDate'],
  "UserAttandanceStatus" => $_POST['UserAttandanceStatus'],
  "UserAttandanceStartTime" => $_POST['UserAttandanceStartTime'],
  "UserAttandanceNotes" => $_POST['UserAttandanceNotes'],
  "UserAttandanceCreatedAt" => RequestDataTypeDate(),
  "UserAttandanceCreatedBy" => LOGIN_UserId,
  "UserAttandanceMonth" => $UserAttandanceMonth,
  "UserAttandanceStartIP" => HOST
 );

 $CheckAttandance = CHECK("SELECT * FROM user_attandances where UserAttandanceMainUserId='$UserAttandanceMainUserId' and UserAttandanceStartDate='" . $_POST['UserAttandanceStartDate'] . "'");
 if ($CheckAttandance == null) {
  $SaveAttandanceRecords = INSERT("user_attandances", $attandance);
 } else {
  $SaveAttandanceRecords = false;
 }

 RESPONSE($SaveAttandanceRecords, "Attandance Record Saved!", "Attandance is already recorded for Entered date!");

 //update checkout status
} elseif (isset($_POST['CheckOutRecord'])) {
 $UserAttandanceId = SECURE($_POST['UserAttandanceId'], "d");

 //get attandance variables
 $attandance = array(
  "UserAttandanceEndDate" => $_POST['UserAttandanceEndDate'],
  "UserAttandanceEndTime" => $_POST['UserAttandanceEndTime'],
  "UserAttandanceEndIP" => HOST
 );

 $Update = UPDATE_DATA("user_attandances", $attandance, "UserAttandanceId='$UserAttandanceId'");
 RESPONSE($Update, "Check-Out Record Saved Successfully!", "Unable to keep check-out record!");

 //user transaction records
} elseif (isset($_POST['UserTransactionRecords'])) {

 //capture user txn data
 $usertxndata = array(
  "UserTxnMainUserId" => SECURE($_POST['UserTxnMainUserId'], "d"),
  "UserTxnType" => $_POST['UserTxnType'],
  "UserTxnAmount" => $_POST['UserTxnAmount'],
  "UserTxnDetails" => POST("UserTxnDetails"),
  "UserTxnDate" => $_POST['UserTxnDate'],
  "UserTxnCreatedAt" => RequestDataTypeDate(),
  "UserTxnCreatedBy" => LOGIN_UserId,
  "UserTxnStatus" => $_POST['UserTxnStatus'],
  "UserTxnDocuments" => UPLOAD_FILES("../storage/users/docs/txn", "null", "TxnDocuments", $_POST['UserTxnAmount'], "UserTxnDocuments"),
  "TxnCustomRefId" => "UTXN-" . date("dmy") . rand(0, 99999),
 );

 $SavetxnRecord = INSERT("user_transactions", $usertxndata);
 RESPONSE($SavetxnRecord, "Txn Record Created Successfully", "Unable to Create txn record at the moment!");


 //upload documents
} elseif (isset($_POST['UploadDocuments'])) {

 $documentsdetails = array(
  "UserDocMainUserid" => SECURE($_POST['UserDocMainUserid'], "d"),
  "UserDocumentName" => $_POST['UserDocumentName'],
  "UserDocumentNumber" => $_POST['UserDocumentNumber'],
  "UserDocumentCreatedAt" => RequestDataTypeDate(),
  "UserUploadedDocument" => UPLOAD_FILES("../storage/users/documents", "null", $_POST['UserDocumentName'], $_POST['UserDocumentNumber'], "UserUploadedDocument"),
 );

 $Uploaddocuments = INSERT("user_documents", $documentsdetails);
 RESPONSE($Uploaddocuments, "Document Uploaded Successfully", "Unable to upload document at the moment!");

 //update password
} elseif (isset($_POST['UpdatePassword'])) {
 $UserId = $_SESSION['REQ_UserId'];

 $data = array(
  "UserPassword" => $_POST['UserPassword'],
 );

 $Update = UPDATE_DATA("users", $data, "UserId='$UserId'");
 RESPONSE($Update, "Password is updated successfully!", "Unable to update password at the moment!");

 //update user record
} elseif (isset($_POST['UpdateUserDetails'])) {
 $UserId = SECURE($_POST['UserId'], "d");

 $userdata = array(
  "UserSalutation" => $_POST['UserSalutation'],
  "UserFullName" => $_POST['UserFullName'],
  "UserPhoneNumber" => $_POST['UserPhoneNumber'],
  "UserEmailId" => $_POST['UserEmailId'],
  "UserUpdatedAt" => RequestDataTypeDate
 );

 $address = array(
  "UserStreetAddress" => POST("UserStreetAddress"),
  "UserLocality" => POST("UserLocality"),
  "UserCity" => POST("UserCity"),
  "UserState" => POST("UserState"),
  "UserCountry" => POST("UserCountry"),
  "UserPincode" => POST("UserPincode"),
  "UserAddressType" => POST("UserAddressType"),
  "UserAddressContactPerson" => POST("UserAddressContactPerson"),
  "UserAddressNotes" => POST("UserAddressNotes"),
  "UserAddressMapUrl" => POST("UserAddressMapUrl"),
  "UserAddressUserId" => $UserId
 );

 $Update = UPDATE_DATA("users", $userdata, "UserId='$UserId'");
 $checkaddress = CHECK("SELECT * FROM user_addresses where UserAddressUserId='$UserId'");
 if ($checkaddress == null) {
  $UpdateAddress = INSERT("user_addresses", $address);
 } else {
  $UpdateAddress = UPDATE_DATA("user_addresses", $address, "UserAddressUserId='$UserId'");
 }
 RESPONSE($UpdateAddress, "Details Updated Successfully!", "Unable to update details at the moment!");
}
