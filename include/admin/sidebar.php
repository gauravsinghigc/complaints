<?php
if (LOGIN_UserType == "Admin") {
  include __DIR__ . "/sidebar/admin-sidebar.php";
} elseif (LOGIN_UserType == "SERVICE_EXECUTIVE") {
  include __DIR__ . "/sidebar/se-sidebar.php";
}
