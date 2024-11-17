<?php
//check app is comming soon or live
if (APP != "true") {
 header("location: " . DOMAIN . "/soon/");
}
