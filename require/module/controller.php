<?php

//function target controller
function CONTROLLER($request = null)
{
 if ($request == null) {
  $controller = "";
 } else {
  $controller = CONTROLLER . "/" . $request . ".php";
 }

 return $controller;
}
