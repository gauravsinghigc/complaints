<?php
//generate form request if system have
//store generated request into contstant
//and use it to validate form requests that include GET, POST, REQUEST
//if form request is not valid then redirect to error page
//if form request is valid then redirect to form page


if (isset($_REQUEST['AuthToken'])) {
 $AuthToken = SECURE($_REQUEST['AuthToken'], "d");
} else {
 $AuthToken = null;
}

//form request constant
define("FORM_REQUESTOR", $AuthToken);
