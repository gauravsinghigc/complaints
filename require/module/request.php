<?php
//POST DATA
function POST($data)
{
 $results = SECURE(htmlentities($_POST["$data"]), "e");
 if ($_POST["$data"] == null or $_POST["$data"] == "") {
  return null;
 } else {
  return $results;
 }
}


//GET DATA
function GET($data)
{
 $results = SECURE(htmlentities($_GET["$data"]), "e");
 if ($_GET["$data"] == null or $_GET["$data"] == "") {
  return null;
 } else {
  return $results;
 }
}

//Request DATA
function REQUEST($data)
{
 $results = SECURE(htmlentities($_REQUEST["$data"]), "e");
 if ($_REQUEST["$data"] == null or $_REQUEST["$data"] == "") {
  return null;
 } else {
  return $results;
 }
}

//if request
function IfRequested($method = "GET", $name, $value = null, $sec = true)
{

 //check request and return values via get
 if ($method == "GET") {
  if (isset($_GET["$name"])) {
   $RequestedValue = $_GET["$name"];
  } else {
   $RequestedValue = $value;
  }

  // check request and return values vai post
 } elseif ($method == "POST") {
  if (isset($_POST["$name"])) {
   $RequestedValue = $_POST["$name"];
  } else {
   $RequestedValue = $value;
  }

  //check request and return values via any request
 } elseif ($method == "REQUEST") {
  if (isset($_POST["$name"])) {
   $RequestedValue = $_REQUEST["$name"];
  } else {
   $RequestedValue = $value;
  }

  //with no request 
 } else {
  $RequestedValue = $value;
 }

 //securiyt or enct
 if ($sec == true) {
  $RequestedValue = SECURE($RequestedValue, "e");
 } elseif ($sec == false) {
  $RequestedValue = $RequestedValue;
 } else {
  $RequestedValue = $RequestedValue;
 }

 return $RequestedValue;
}


//Form Requests Response
function FormRequests(array $Request, $method = "post", $enc = null)
{
 foreach ($Request as $key => $Req) {

  //post requests
  if ($method == "post" || $method == "POST" || $method == "p") {

   if ($enc == null) {
    global $$Req;
    $$Req = $_POST["$Req"];
    echo "<b>$Req-></b>" . $$Req . "<br>";

    //
   } else if ($enc == "e" || $enc == "enc" || $enc == "en") {
    global $$Req;
    $$Req = SECURE($_POST["$Req"], "e");
    echo "<b>$Req-></b>" . $$Req . "<br>";

    //
   } else if ($enc == "d" || $enc == "dec" || $enc == "de") {
    $$Req = SECURE($_POST["$Req"], "d");
    global $$Req;
    echo "<b>$Req-></b>" . $$Req . "<br>";

    //
   } else {
    $$Req = $_POST["$Req"];
    global $$Req;
    echo "<b>$Req-></b>" . $$Req . "<br>";
   }

   //get requests
  } else if ($method == "GET" || $method == "get" || $method == "g") {
   if ($enc == null) {
    global $$Req;
    $$Req = $_GET["$Req"];
    echo "<b>$Req-></b>" . $$Req . "<br>";

    //
   } else if ($enc == "e" || $enc == "enc" || $enc == "en") {
    global $$Req;
    $$Req = SECURE($_GET["$Req"], "e");
    echo "<b>$Req-></b>" . $$Req . "<br>";

    //
   } else if ($enc == "d" || $enc == "dec" || $enc == "de") {
    global $$Req;
    $$Req = SECURE($_GET["$Req"], "d");
    echo "<b>$Req-></b>" . $$Req . "<br>";

    //
   } else {
    global $$Req;
    $$Req = $_GET["$Req"];
    echo "<b>$Req-></b>" . $$Req . "<br>";
   }

   //request requests
  } else if ($method == "REQUEST" || $method == "request" || $method == "r" || $method == "Request") {

   if ($enc == null) {
    global $$Req;
    $$Req = $_REQUEST["$Req"];
    echo "<b>$Req-></b>" . $$Req . "<br>";

    //
   } else if ($enc == "e" || $enc == "enc" || $enc == "en") {
    global $$Req;
    $$Req = SECURE($_REQUEST["$Req"], "e");
    echo "<b>$Req-></b>" . $$Req . "<br>";

    //
   } else if ($enc == "d" || $enc == "dec" || $enc == "de") {
    global $$Req;
    $$Req = SECURE($_REQUEST["$Req"], "d");
    echo "<b>$Req-></b>" . $$Req . "<br>";

    //
   } else {
    global $$Req;
    $$Req = $_REQUEST["$Req"];
    echo "<b>$Req-></b>" . $$Req . "<br>";
   }

   //no valid requests
  } else {
   echo "No Valid Request Found for -> <b>$Req</b><br>";
  }
 }
}
