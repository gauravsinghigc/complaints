<?php
//module
require '../require/modules.php';

session_start();
$UserId = $_SESSION['LOGIN_USER_ID'];
setcookie("LOGIN_USER_ID", $UserId, time() - 60 * 60 * 365);
session_destroy();
session_start();

LOCATION("info", "Logout Successfully!", DOMAIN . "/auth/admin/login");
