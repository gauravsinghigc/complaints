<?php

//date formates
function DATE_FORMATE2($format, $date)
{
 $newdateformate = $date;
 if ($date == null  || $date == "" || $date == "0000-00-00" || $date == " ") {
  $newdateformate = DATE("Y-m-d");
 } else {
  $newdateformate = date("$format", strtotime($date));
 }
 return $newdateformate;
}

function DATE_FORMATE($format, $date)
{
 DATE_FORMATE2($format, $date);
}

//RequestDataTypeDate
function RequestDataTypeDate()
{
 $date = date('Y-m-d h:i:s A');
 return $date;
}
define("RequestDataTypeDate", RequestDataTypeDate());
