<?php
//DB configuations
define("CONTROL_DATABASE", true);
define("CONTROL_DB_STATUS", false);
define("DB_SERVER_HOST", "localhost");
define("DB_SERVER_USER", "root");
define("DB_SERVER_PASS", "");
define("DB_SERVER_DB_NAME", "avgs");

if (CONTROL_DATABASE == true) {
 $DBConnection = mysqli_connect(DB_SERVER_HOST, DB_SERVER_USER, DB_SERVER_PASS, DB_SERVER_DB_NAME);

 if ($DBConnection == true) {
  $DBStatus = "<i class='fa fa-check-circle text-success'></i> Online";
 } else {
  $DBStatus = "<i class='fa fa-warning text-danger'></i> Offline";
 }
} else {
 $DBStatus = "<i class='fa fa-times text-warning'></i> DB Not Used!";
}

//display Database Status
if (CONTROL_DB_STATUS == true) {
 echo $DBStatus;
}
