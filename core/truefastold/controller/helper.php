<?php

//add require modules & auto load files
require __DIR__ . '/../require/modules.php';

//remove all exitisting heeadferts
ob_start();

//sent response to submitted request url
if (isset($_REQUEST['access_url']) == null) {
 echo "<h1>ERROR</h1>
 <p>Invalid OUTPUT request is received!</p>
 <a href='../index.php'>Back to Home</a><br><br>";
 $UrlReqeust = "Failed";
 $access_url = "#";
} else {
 $access_url = SECURE($_REQUEST['access_url'], "d");
 $UrlReqeust = "Ok";
}

//validate submittion requests
if (FORM_REQUESTOR != null) {
 $FormRequestor = "Ok";
 if (FORM_REQUESTOR == SECURE(VALIDATOR_REQ, "e")) {
  echo "<h1>Unable to Validate Form Request at the Moment</h1>
 <p>Please check submitted form request. All Request must be PASSED out via form requestor & validator.</p>
 <a href='../index.php'>Back to Home</a><br><br><br>";
  $FormValidator = "Failed";
 } else {
  $FormValidator = "Ok";
 }
} else {
 $FormRequestor = "Failed";
 $FormValidator = "Invalid";
}
?>

<head>

 <style>
  @import url('https://fonts.googleapis.com/css2?family=Blinker&display=swap');

  body,
  span {
   font-family: 'Blinker', sans-serif !important;
   letter-spacing: 1px;
  }

  b {
   margin-right: 0.5rem !important;
  }
 </style>
</head>

<body class="bg-white" style="font-size: 12px !important;font-family: monospace;font-weight: 500;padding:0rem;background-color:white !important;">
 <span>------- Start Controller --------</span><br>
 <span><b>Checking Requirements:</b></span><br>
 <span><b style="color:red;font-size:13px;">$</b> Controller Status : <br>
  --- Controller : <span class="text-success"><b>Ok</b></span></span><br>
 <span><b style="color:red;font-size:13px;">$</b> Checking Applicable Requests :</span><br>
 <span>--- Form Request : <span class="bold"><b><?php echo $FormRequestor; ?></b></span></span><br>
 <span>--- Form Validation : <span class="bold"><b><?php echo $FormValidator; ?></b></span></span><br>
 <span>--- Request URL : <span class="bold"><b><?php echo $UrlReqeust; ?></b></span> <br>
  ---- URL : <b><?php echo $access_url; ?></b></span><br>
 <span><b style="color:red;font-size:13px;">$</b> Checking Database Connection : <br>
  --- Database Status: <span class="bold"><b><?php echo $DBStatus; ?></b></span></span><br>
 <span><b style="color:red;font-size:13px;">$</b> Checking Database Status : <br>
  --- Database Connection : <span class="bold"><b><?php echo $DBStatus; ?></b></span></span><br>
 <span><b style="color:red;font-size:13px;">$</b> Requested Device : <br>
  --- <span class="bold"><b><?php echo SECURE(VALIDATOR_REQ, "d"); ?></b></span></span><br>
 ------ Requirements END -------<br><br>
 <span><b>Controller Activity Status</b></span><br>
 <span> <b style='font-size:13px;color:red;'>$</b> Query & Activity :</span><br>