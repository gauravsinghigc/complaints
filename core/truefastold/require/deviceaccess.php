<?php

//device controller
if (DEVICE_TYPE == "Mobile") {
 header("location: " . DOMAIN . "/web");
} elseif (DEVICE_TYPE == "Computer") {
 header("location: " . DOMAIN . "/web");
} else {
 header("location: " . DOMAIN . "/web");
}
