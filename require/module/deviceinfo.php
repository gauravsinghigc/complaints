<?php

//More Requirements
$ip_address = IP_ADDRESS;
$device_type = DEVICE_TYPE;
date_default_timezone_set("Asia/Calcutta");
$date_time_c = date("D d M, Y h:m:s a");
$ipv6_n = php_uname('n');
$ipv6_p = php_uname('p');
$os = php_uname('s');
$OS_release = php_uname('r');
$OS_Version = php_uname('v');
$System_Info = php_uname('m');
$System_more_Info = $_SERVER['HTTP_USER_AGENT'];
$PAGE_LOCATION = GET_URL();
$SYSTEM_CONFIGURATIONS = "
    Date Time: $date_time_c
    Page_Location: $PAGE_LOCATION
    Ip-Address : $ip_address
    Device Type : $device_type
    Ipv6_P : $ipv6_p
    OS : $os
    OS_RELEASE : $OS_release
    OS_VERSION : $OS_Version
    System : $System_Info
    Host Name : $ipv6_n
    System Information : $System_more_Info";

define("SYSTEM_INFO", SECURE($SYSTEM_CONFIGURATIONS, "e"));
define("VALIDATOR_REQ", SECURE(IP_ADDRESS . DEVICE_TYPE . $System_more_Info, "e"));
