<?php
session_start();
session_destroy();

//require files
require 'require/modules.php';

header("location: " . DOMAIN);
