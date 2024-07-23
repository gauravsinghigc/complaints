<?php
//Get running url
function GET_URL()
{
 if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
  $url = "https://";
 else
  $url = "http://";
 // Append the host(domain name, ip) to the URL.
 $url .= $_SERVER['HTTP_HOST'];

 // Append the requested resource location to the URL
 $url .= $_SERVER['REQUEST_URI'];

 return $url;
}

//runing url
define("RUNNING_URL", GET_URL());

//add-on urls function and directories
define("E_DOC_URL", DOMAIN . "/edoc");
