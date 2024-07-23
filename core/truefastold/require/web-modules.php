<?php
//check website is comming soon or live
if (WEBSITE != "true") {
 header("location: " . DOMAIN . "/soon/");
}

include __DIR__ . "/web/sessionvariables.php";
