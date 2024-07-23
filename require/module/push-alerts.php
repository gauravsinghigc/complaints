<?php
//flash msg
function MSG($type, $msg)
{
 $_SESSION["$type"] = "$msg";
}


//token on submit requests
function S_TOKEN()
{
 $RandomData = SYSTEM_INFO;
 $Token = SECURE("$RandomData", "e");
 return $Token;
}

//function for msg and redirect same
function LOCATION($type, $msg, $url)
{
 MSG("$type", "$msg");
 header("location: $url");
}

//responser for all controllers
function RESPONSE($act, $msg, $msg2)
{
 global $access_url;
 if ($act == true) {
  LOCATION("success", "$msg", "$access_url");
 } else {
  LOCATION("danger", "$msg2", "$access_url");
 }
}
