<?php
//proejct ststuas
DEFINE("PROJECT_STATUS", array(
 "ORDER_PLACED" => "Order Placed",
 "PROJECT_INITIALISED" => "Project Initialised",
 "DEVELOPMENT_PHASE" => "Development Phase",
 "TESTING" => "Testing",
 "DEMO_LIVED" => "Demo Lived",
 "PROD_LIVED" => "Production Live",
 "DELIVERED" => "Delivered",
 "MAINTENANCE_SERVICE" => "Maintenance & Service",
 "CANCELLED" => "Cancelled"
));


//project attribute type
define("PROJECT_ATTRIBUTE_TYPE", array("PHONE_NO", "WHATSAPP_NO", "EMAIL_ID", "ADDRESS", "TEXT_DESCRIPTIONS", "URL", "YOUTUBE_VIDEO", "IMAGE_URL", "DOCUMENT_FILE"));


//project deal relation
function ProjectDealStatus($data)
{
 if ($data == 0) {
  echo "No";
 } else {
  echo "Yes";
 }
}


//FUNCTION fo rpoject id
function PROJECTID($projectid)
{
 echo "PROJ000" . $projectid;
}


//development type
DEFINE("DEVELOPMENT_TYPE", array("DOMAIN", "HOSTING", "INTERNET & SECURITY", "DESIGNING & PRINTING", "MARKETING & ADVERTISING", "PARTNER COMMISSION", "DEVELOPMENT CHARGES", "TESTING & QUALITY ENSURING", "SERVICE & MAINTENANCE", "TRAINING, RESEARCH & DEVELOPMENT", "EXTERNAL HARWARE & SOFTWARE PURCHASE"));


//project status
function ProjectStatus($status)
{
 if ($status == "ORDER_PLACED") {
  echo "<span class='text-primary'><i class='fa fa-check-circle-o'></i> New </span>";
 } elseif ($status ==  "PROJECT_INITIALISED") {
  echo "<span class='text-info'><i class='fa fa-spinner fa-spin'></i> Anaylsing </span>";
 } elseif ($status == "DEVELOPMENT_PHASE") {
  echo "<span class='text-black'><i class='fa fa-gear fa-spin'></i> production</span>";
 } elseif ($status == "TESTING") {
  echo "<span class='text-warning'><i class='fa fa-edit'></i> Testing...</span>";
 } elseif ($status == "DEMO_LIVE") {
  echo "<span class='text-secondary'><i class='fa fa-desktop'></i> Demo Lived</span>";
 } elseif ($status == "PROD_LIVED") {
  echo "<span class='text-grey'><i class='fa fa-desktop'></i> Prod Lived</span>";
 } elseif ($status == "DELIVERED") {
  echo "<span class='text-success'><i class='fa fa-check'></i> Delivered</span>";
 } elseif ($status == "MAINTENANCE_SERVICE") {
  echo "<span class='text-danger'><i class='fa fa-gears'></i> Updating...</span>";
 } elseif ($status == "CANCELLED") {
  echo "<span class='text-danger'><i class='fa fa-time'></i> Cancelled...</span>";
 }
}
