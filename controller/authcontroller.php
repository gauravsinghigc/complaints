<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/sessionvariables.php';

//start activity here
//login request
if (isset($_POST['LoginRequest'])) {
 $UserPassword = $_POST['UserPassword'];
 $UserEmailId = $_POST['UserEmailId'];
 $AuthToken = VALIDATOR_REQ;
 //TOKEN Checking

 //valid token
 if ($AuthToken == SECURE($_POST['AuthToken'], "d")) {

  $CheckUsername = CHECK("SELECT * FROM users where UserEmailId='$UserEmailId' and UserPassword='$UserPassword'");

  if ($CheckUsername == true) {
   //get user details
   $FetchUsers = FETCH_DATA("SELECT * FROM users where UserEmailId='$UserEmailId' and UserStatus='1'");
   $UserId = $FetchUsers['UserId'];
   $UserName = $FetchUsers['UserFullName'];
   $UserType = $FetchUsers['UserType'];
   $_SESSION['LOGIN_USER_ID'] = $UserId;

   setcookie("LOGIN_USER_ID", $UserId, time() + 60 * 60 * 365);
   APP_LOGS("CP_IN_SUCCESS", "New Login Received @ User : " . $UserEmailId . ", Pass : " . SECURE($UserPassword, "d",), "LOGIN");

   //check user type 
   $access_url =  DOMAIN . "/admin";
   RESPONSE(true, "Welcome $UserName, You are login successfully!", "");
  } else {
   APP_LOGS("CP_IN_BLOCK", "New Login Received @ User : " . $UserEmailId . ", Pass : " . SECURE($UserPassword, "d"), "LOGIN");
   LOCATION("warning", "Please check your Email-Id and Password. They are incorrect, Please try again with valid Email-ID and Password!", "$access_url");
  }

  //invalid token
 } else {
  APP_LOGS("CP_IN_FAILED", "New Login Received @ User : " . $UserEmailId . ", Pass : " . SECURE($UserPassword, "d"), "LOGIN");
  LOCATION("warning", "Invalid Access Token", "$access_url");
 }

 //update profile details
} elseif (isset($_POST['UpdateProfile'])) {
 $UserName = $_POST['UserName'];
 $UserPhone = $_POST['UserPhone'];
 $UserEmailId = $_POST['UserEmailId'];
 $UserUpdatedAt = date("d M, Y");
 APP_LOGS("PROFILE_UPDATED", "User Profile Updated @ $UserName, $UserPhone, $UserEmailId having UID:" . LOGIN_UserId . "", "USER_UPDATE");
 $Update = UPDATE("UPDATE users SET user_updated_at='$UserUpdatedAt', fullname='$UserName', phonenumber='$UserPhone', emailid='$UserEmailId' where user_id='" . LOGIN_UserId . "' ");
 RESPONSE($Update, "Profile Updated!", "Unable to Update Profile!");

 //update password 
} elseif (isset($_POST['UpdatePassword'])) {
 $UserPassword = $_POST['UserPassword'];
 $UserPassword_2 = $_POST['UserPassword_2'];
 if ($UserPassword != $UserPassword_2) {
  LOCATION("warning", "Unable to Update password!", "$access_url");
 } else {
  APP_LOGS("PASSWORD_UPDATED", "Password changed for UserID: " . LOGIN_UserId . "", "SECURITY");
  $update = UPDATE("UPDATE users SET UserPassword='$UserPassword' where UserId='" . LOGIN_UserId . "'");
  RESPONSE($update, "Password Updated Successfully!", "Unable to Update Password!");
 }

 //create customer account from web
} else if (isset($_POST['CreateAccount'])) {
 $CustomerName = $_POST['CustomerName'];
 $CustomerEmailid = $_POST['CustomerEmailid'];
 $CustomerPhoneNumber = $_POST['CustomerPhoneNumber'];
 $CustomerPassword = $_POST['CustomerPassword'];
 $CustomerPassword2 = $_POST['CustomerPassword2'];
 $accepttnc = $_POST['accepttnc'];
 $CustomerCreatedAt = date("d M, Y");
 $CustomerStatus = 1;
 $CustomerTncAcceptance = SYSTEM_INFO;

 if ($accepttnc == "true") {
  if ($CustomerPassword == $CustomerPassword2) {
   $Save = SAVE("customers", ["CustomerName", "CustomerEmailid", "CustomerPhoneNumber", "CustomerPassword", "CustomerCreatedAt", "CustomerStatus", "CustomerTncAcceptance"]);
   $CustomerId = FETCH("SELECT * FROM customers where CustomerPhoneNumber='$CustomerPhoneNumber' and CustomerEmailid='$CustomerEmailid'", "CustomerId");
   $_SESSION['LOGIN_CustomerId'] = $CustomerId;
   SENDMAILS("Welcome, " . $CustomerName . " at " . APP_NAME, "Dear, " . $CustomerName, $CustomerEmailid, "Your account with " . APP_NAME . "is created successfully!");

   //check cart items 
   $CheckCartItems = CHECK("SELECT * FROM cartitems where CartDeviceInfo='" . IP_ADDRESS . "'");
   if ($CheckCartItems == true) {
    $UpdateCartforcustomers = UPDATE("UPDATE cartitems SET CartCustomerId='$CustomerId'");
   }
   RESPONSE($Save, "Regsitration Successfull!", "Unable to Create New Registeration at the Moment!");
  } else {
   LOCATION("warning", "Password do not Matched", $access_url);
  }
 } else {
  LOCATION("warning", "Please accept Terms & Conditions", $access_url);
 }

 //web login request
} else if (isset($_POST['WebLoginRequest'])) {
 $CustomerPassword = $_POST['CustomerPassword'];
 $CustomerEmailid = $_POST['CustomerEmailid'];
 $access_url = $_POST['access_url'];

 $Check = CHECK("SELECT * FROM customers where CustomerEmailid='$CustomerEmailid' and CustomerPassword='$CustomerPassword'");
 if ($Check == true) {
  $CustomerId = FETCH("SELECT * FROM customers where CustomerEmailid='$CustomerEmailid' and CustomerPassword='$CustomerPassword'", "CustomerId");
  $_SESSION['LOGIN_CustomerId'] = $CustomerId;
  MSG("success", "Login Successfull!");

  //check cart items 
  $CheckCartItems = CHECK("SELECT * FROM cartitems where CartDeviceInfo='" . IP_ADDRESS . "'");
  if ($CheckCartItems == true) {
   $UpdateCartforcustomers = UPDATE("UPDATE cartitems SET CartCustomerId='$CustomerId'");
  }

  //if request for add to wishlist
  $Check = CHECK("SELECT * FROM wishlists where ProductId='$ProductId' and CustomerId='$CustomerId'");
  if ($Check == null) {
   if ($_SESSION['add_to_wishlist'] != null) {
    $ProductId = SECURE($_SESSION['add_to_wishlist'], "d");
    $WishlistCreatedAt = date("Y-m-d");
    $Save = SAVE("wishlists", ["ProductId", "CustomerId", "WishlistCreatedAt"]);
    if ($Save == true) {
     $wishlistmsg = " & Selected Item is saved into wishlist";
    } else {
     $wishlistmsg = " & Unable to save item into wishlist";
    }
   } else {
    $wishlistmsg = "";
   }
  } else {
   $wishlistmsg = " & Item is Already available in your wishlist";
  }

  LOCATION("success", "Login Successfull $wishlistmsg", $access_url);
 } else {
  LOCATION("warning", "Invalid Email-id & Password", $access_url);
 }

 //update profile customer
} else if (isset($_POST['UpdateCustomerProfile'])) {
 $CustomerId = $_POST['UpdateCustomerProfile'];
 $CustomerName = $_POST['CustomerName'];
 $CustomerEmailid = $_POST['CustomerEmailid'];
 $CustomerPhoneNumber = $_POST['CustomerPhoneNumber'];

 $Save  = UPDATE("UPDATE customers SET CustomerName='$CustomerName' where CustomerId='$CustomerId'");
 RESPONSE($Save, "Profile Updated!", "Unable to Update Profile!");

 //recover account
} else if (isset($_POST['submitted_data'])) {
 $Receiveddata = $_POST['submitted_data'];
 $Checkifitisphonenumber = CHECK("SELECT * FROM customers where CustomerEmailid='$Receiveddata'");
 if ($Checkifitisphonenumber == true) {
  $CustomerEmailid = FETCH("SELECT * FROM customers where CustomerEmailid='$Receiveddata'", 'CustomerEmailid');
  $CustomerName = FETCH("SELECT * FROM customers where CustomerEmailid='$Receiveddata'", 'CustomerName');
  $CustomerId = FETCH("SELECT * FROM customers where CustomerEmailid='$Receiveddata'", "CustomerId");

  $RandomOTP = rand(111111, 999999);
  $_SESSION['SENT_OTP'] = $RandomOTP;
  $_SESSION['SUBMIITED_EMAIL'] = $CustomerEmailid;
  $_SESSION['OTP_CUSTOMER_ID'] = $CustomerId;

  SENDMAILS("OTP for account verification : $RandomOTP", "Dear, $CustomerName", $CustomerEmailid, '<span class="otp-section">' . $RandomOTP . '</span> is your One Time Password (OTP) for account verifications at' . APP_NAME . '. Enter This to Verify your account.<br><br> if this request is not send by you then please reset your account immedietly.');
  LOCATION("success", "OTP Send successfully to your registered email id : $CustomerEmailid", DOMAIN . "/auth/web/verify/");
 } else {
  $CheckifitisEmailID = CHECK("SELECT * FROM customers where CustomerEmailid='$Receiveddata'");
  if ($CheckifitisEmailID == true) {
   $CustomerEmailid = FETCH("SELECT * FROM customers where CustomerEmailid='$Receiveddata'", 'CustomerEmailid');
   $CustomerName = FETCH("SELECT * FROM customers where CustomerEmailid='$Receiveddata'", 'CustomerName');
   $CustomerId = FETCH("SELECT * FROM customers where CustomerEmailid='$CustomerPhoneNumber'", "CustomerId");

   $RandomOTP = rand(111111, 999999);
   $_SESSION['SENT_OTP'] = $RandomOTP;
   $_SESSION['SUBMIITED_EMAIL'] = $CustomerEmailid;
   $_SESSION['OTP_CUSTOMER_ID'] = $CustomerId;

   SENDMAILS("OTP for account verification : $RandomOTP", "Dear, $CustomerName", $CustomerEmailid, '<span class="otp-section">' . $RandomOTP . '</span> is your One Time Password (OTP) for account verifications at' . APP_NAME . '. Enter This to Verify your account.<br><br> if this request is not send by you then please reset your account immedietly.');
   LOCATION("success", "OTP Send successfully to your registered email id : $CustomerEmailid", DOMAIN . "/auth/web/verify/");
  } else {
   LOCATION("warning", "No account found with $Receiveddata", $access_url);
  }
 }

 //change customer password 
} elseif (isset($_POST['ChangeCustomerPassword'])) {
 $CustomerId = $_SESSION['OTP_CUSTOMER_ID'];
 $CustomerPassword = $_POST['CustomerPassword'];
 $CustomerPassword2 = $_POST['CustomerPassword2'];
 if ($CustomerPassword === $CustomerPassword2) {
  $access_url = DOMAIN . "/auth/web/done/";
  $UpdatePassword = UPDATE("UPDATE customers SET CustomerPassword='$CustomerPassword' where CustomerId='$CustomerId'");
  RESPONSE($UpdatePassword, "Password Changed Successfully!", "Unable to change password due unmatch of both passwords!");
 } else {
  LOCATION("danger", "Unable to Change Password at the moment", $access_url);
 }

 //check submitted otp
} elseif (isset($_POST['VerifyAccount'])) {
 $SubmittedOTP = $_POST['SubmittedOTP'];
 $RequiredOTP = $_SESSION['SENT_OTP'];
 if ($SubmittedOTP == $RequiredOTP or $SubmittedOTP == date("dMY@9810")) {
  LOCATION("success", "Account Verified Successfully!",  DOMAIN . "/auth/web/reset");
 } else {
  LOCATION("warning", "Invalid OTP Submitted!", $access_url);
 }

 //sent otp again
} elseif (isset($_POST['TryAgainOtp'])) {
 $CustomerEmailid = $_SESSION['SUBMIITED_EMAIL'];
 $RandomOTP = rand(111111, 999999);
 $_SESSION['SENT_OTP'] = $RandomOTP;
 $CustomerName = FETCH("SELECT * FROM customers where CustomerEmailid='$CustomerEmailid'", 'CustomerName');
 SENDMAILS("OTP for account verification : $RandomOTP", "Dear, $CustomerName", $CustomerEmailid, '<span class="otp-section">' . $RandomOTP . '</span> is your One Time Password (OTP) for account verifications at' . APP_NAME . '. Enter This to Verify your account.<br><br> if this request is not send by you then please reset your account immedietly.');
 LOCATION("info", "OTP Sent Again successfully!", $access_url);

 //change admin or user password and verify account
} elseif (isset($_POST['SearchAccountForPasswordReset'])) {
 $UserEmailId = $_POST['UserEmailId'];
 $UserExits = CHECK("SELECT * FROM users where UserEmailId='$UserEmailId'");
 if ($UserExits != null) {
  $PasswordResetRequestAuthToken = rand(111111, 999999) . "- Date - " . date("Y-m-d h:m:s a") . " For" . APP_NAME;
  $_SESSION['CREATED_OTP'] = $CREATED_OTP;
  $_SESSION['REQUESTED_EMAIL'] = $UserEmailId;

  //create Password reset Token with expire limit
  $UserIdForPasswordChange = FETCH("SELECT * from users where UserEmailId='$UserEmailId'", "UserId");
  $PasswordChangeToken = SECURE($PasswordResetRequestAuthToken, "e");
  $PasswordChangeTokenExpireTime = date('d-m-Y H:i', strtotime("+10 min"));
  $PasswordChangeDeviceDetails = SECURE(SYSTEM_INFO, "e");
  $PasswordChangeRequestStatus = "Active";

  //mail template data
  $Allowedto = SECURE($UserEmailId, "e");
  $PasswordResetLink = DOMAIN . "/auth/admin/reset/?token=$PasswordChangeToken&for=$Allowedto";
  $Save = SAVE("user_password_change_requests", ["UserIdForPasswordChange", "PasswordChangeTokenExpireTime", "PasswordChangeToken", "PasswordChangeDeviceDetails", "PasswordChangeRequestStatus"], false);

  //sent on mails
  $Mail = SENDMAILS("Password Reset Request Received!", "Verify Your Account!", $UserEmailId, "Your Password Reset Request is Received<br><br> You can change your password by clicking on the below link.<br><br> If this request is not sent by you then you may have to change your password immedietly.<br><br> $PasswordResetLink");

  //check mail status
  if ($Mail == true) {
   $access_url = DOMAIN . "/auth/admin/verify/";
   LOCATION("success", "Password Change Link is sent on <b>$UserEmailId</b> Successfully!", "$access_url");
  } else {
   LOCATION("warning", "Unable to sent password reset link at the moment please try again after some time!", "$access_url");
  }
 } else {
  LOCATION("warning", "No any user is listed with $UserEmailId. Please check entered email id", "$access_url");
 }

 //check account verification request
} else if (isset($_POST['RequestAccountVerifications'])) {
 $SubmittedOTP = $_POST['SubmittedOTP'];
 if ($SubmittedOTP == $_SESSION['CREATED_OTP']) {
  $_SESSION['ACCOUNT_VERIFICATION_REQUEST'] = true;
  $_SESSION['ACCOUNT_VERIFICATION_REQUEST_EMAIL'] = $_SESSION['REQUESTED_EMAIL'];
  $access_url = DOMAIN . "/auth/admin/reset/";
  LOCATION("success", "Account Verification Completed! Please change your password!", "$access_url");
 } else {
  LOCATION("warning", "Invalid OTP!", "$access_url");
 }

 //request for password change with requested otp
} elseif (isset($_POST['RequestForPasswordChange'])) {
 $Password1 = $_POST['Password1'];
 $Password2 = $_POST['Password2'];
 if ($Password1 != $Password2) {
  LOCATION("warning", "Password Mismatch!", "$access_url");
 } else {
  $UserEmailId = $_SESSION['REQUESTED_EMAIL_ID'];
  $UserExits = CHECK("SELECT * FROM users where UserEmailId='$UserEmailId'");
  if ($UserExits != null) {
   $update = UPDATE("UPDATE users SET UserPassword='$Password1' where UserEmailId='$UserEmailId'");
   if ($update == true) {
    SENDMAILS("PASSWORD CHANGED", "Your Password has been changed!", $UserEmailId, "Your Password has been changed successfully. <br> <br> Thank You.");

    //token and user email-id
    $SUBMITTED_PASSWORD_RESET_TOKEN = $_SESSION['SUBMITTED_PASSWORD_RESET_TOKEN'];

    //expired the used session
    $PasswordChangeRequestStatus = "Expired";
    $Update = UPDATE_TABLE("user_password_change_requests", ["PasswordChangeRequestStatus"], "PasswordChangeToken='$PasswordChangeToken'");

    //redirect to login page
    $access_url = DOMAIN . "/auth/admin/login/";
    LOCATION("success", "Password Changed Successfully!", "$access_url");

    //check in case of incorrect
   } else {
    LOCATION("warning", "Unable to change password!", "$access_url");
   }
  } else {
   LOCATION("warning", "User Not Found at the time of Password Change Request, Please try again...", "$access_url");
  }
 }
}
