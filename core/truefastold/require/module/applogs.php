<?php
//Generate Log file for the project
function APP_LOGS($TITLE, $ACTION, $logtype)
{
 global $DBConnection;
 $TITLE = strtoupper($TITLE);

 if (CONTROL_APP_LOGS == "true") {
  $logTitle = SECURE("$TITLE", "e");
  $logdesc = SECURE("$ACTION", "e");
  $systeminfo = SYSTEM_INFO;
  $logenv = CONTROL_WORK_ENV;

  $SaveLogs = "INSERT INTO systemlogs (logTitle, logdesc, created_at, systeminfo, logtype, logenv) VALUES ('$logTitle', '$logdesc', CURRENT_TIMESTAMP, '$systeminfo', '$logtype', '$logenv')";
  $logquery = mysqli_query($DBConnection, $SaveLogs);
 } else {
 }
}
