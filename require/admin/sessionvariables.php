<?php
//login per details
if (isset($_SESSION['LOGIN_USER_ID'])) {
 $UserId = $_SESSION['LOGIN_USER_ID'];
 define("LOGIN_UserId", FETCH("SELECT * FROM users where UserId='$UserId'", "UserId"));
 define("LOGIN_UserFullName", FETCH("SELECT * FROM users where UserId='$UserId'", "UserFullName"));
 define("LOGIN_UserPhoneNumber", FETCH("SELECT * FROM users where UserId='$UserId'", "UserPhoneNumber"));
 define("LOGIN_UserEmailId", FETCH("SELECT * from users where UserId='$UserId'", "UserEmailId"));
 define("LOGIN_UserCreatedAt", FETCH("SELECT * FROM users where UserId='$UserId'", "UserCreatedAt"));
 define("LOGIN_UserUpdatedAt", FETCH("SELECT * FROM users where UserId='$UserId'", "UserUpdatedAt"));
 define("LOGIN_UserStatus", FETCH("SELECT * FROM users where UserId='$UserId'", "UserStatus"));
 define("LOGIN_UserNotes", FETCH("SELECT * FROM users where UserId='$UserId'", "UserNotes"));
 define("LOGIN_UserDepartment", FETCH("SELECT * FROM users where UserId='$UserId'", "UserDepartment"));
 define("LOGIN_UserDesignation", FETCH("SELECT * FROM users where UserId='$UserId'", "UserDesignation"));
 define("LOGIN_UserWorkFeilds", FETCH("SELECT * FROM users where UserId='$UserId'", "UserWorkFeilds"));
 define("LOGIN_UserProfileImage1", FETCH("SELECT * FROM users WHERE UserId='$UserId'", "UserProfileImage"));
 define("LOGIN_UserType", FETCH("SELECT * FROM users WHERE UserId='$UserId'", "UserType"));
 if (LOGIN_UserProfileImage1 == "default.png") {
  define("LOGIN_UserProfileImage", STORAGE_URL_D . "/default.png");
 } else {
  define("LOGIN_UserProfileImage", STORAGE_URL_U . "/" . LOGIN_UserId . "/img/" . LOGIN_UserProfileImage1);
 }
} else {
 define("LOGIN_UserId", null);
 define("LOGIN_UserFullName", null);
 define("LOGIN_UserPhoneNumber", null);
 define("LOGIN_UserEmailId", null);
 define("LOGIN_UserCreatedAt", null);
 define("LOGIN_UserUpdatedAt", null);
 define("LOGIN_UserStatus", null);
 define("LOGIN_UserNotes", null);
 define("LOGIN_UserDepartment", null);
 define("LOGIN_UsrDesignation", null);
 define("LOGIN_UserWorkFeilds", null);
 define("LOGIN_UserProfileImage", null);
 define("LOGIN_UserType", null);
}
