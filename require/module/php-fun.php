<?php
//foreach loop html tag attribute display
function LOOP_TagsAttributes($data)
{
 foreach ($data as $key => $values) {
  echo "$key='$values'";
 }
}

//remove space
function RemoveSpace($string)
{
 $string = str_replace(' ', '-', $string);
 if ($string == null) {
  return null;
 } else {
  return $string;
 }
}

//lowercase all words
function LowerCase($string)
{
 $string = strtolower($string);
 if ($string == null) {
  return null;
 } else {
  return $string;
 }
}

//display data null or data
function Data($data)
{
 if ($data == null || $data == "" || $data == " " || $data == "  ") {
  return "";
 } else {
  return $data;
 }
}


//getworkdays 
function CountWorkingDays($startdate, $endate)
{

 $workingDays = 0;
 $startTimestamp = strtotime($startdate);
 $endTimestamp = strtotime($endate);
 for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
  if (date("N", $i) <= 5) $workingDays = $workingDays + 1;
 }
 return $workingDays;
}

//get weekend days
function CountNonWorkingDays($startDate, $endDate)
{
 $weekendDays = 0;
 $startTimestamp = strtotime($startDate);
 $endTimestamp = strtotime($endDate);
 for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
  if (date("N", $i) > 5) $weekendDays = $weekendDays + 1;
 }
 return $weekendDays;
}


//function GetDays from current date
function GetDays($fromdate)
{
 $ProjectDueDate = $fromdate;
 $TodayDate = strtotime(RequestDataTypeDate());
 $ProjectDaysLefts = strtotime($ProjectDueDate);
 $DaysLeft = (int)$ProjectDaysLefts - (int)$TodayDate;
 $TimeLeft = round($DaysLeft / (60 * 60 * 24));

 return $TimeLeft;
}

//get hours 
function GetHours($starttime, $endtime)
{
 $hours = round((strtotime($endtime) - strtotime($starttime)) / 3600, 1);

 return $hours;
}


//random stringorcharater
function GenerateRandomData($length_of_string)
{

 // String of all alphanumeric character
 $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

 // Shuffle the $str_result and returns substring
 // of specified length
 return substr(
  str_shuffle($str_result),
  0,
  $length_of_string
 );
}
