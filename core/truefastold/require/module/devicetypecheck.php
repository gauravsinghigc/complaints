<?php
// Device Type
function DEVICE_TYPE()
{
 $deviceName = "";
 $userAgent = $_SERVER["HTTP_USER_AGENT"];
 $devicesTypes = array(
  "Computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
  "Tablet"   => array("tablet", "android", "ipad", "tablet.*firefox"),
  "Mobile"   => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
  "Bot"      => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
 );
 foreach ($devicesTypes as $deviceType => $devices) {
  foreach ($devices as $device) {
   if (preg_match("/" . $device . "/i", $userAgent)) {
    $deviceName = $deviceType;
   }
  }
 }
 return ucfirst($deviceName);
}

define("DEVICE_TYPE", DEVICE_TYPE());
