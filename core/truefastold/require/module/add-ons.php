<?php

//form submit token
function FormInputToken()
{
 $TokenValue = SECURE(VALIDATOR_REQ, "e");
?><input type="text" name="AuthToken" value="<?php echo $TokenValue; ?>" hidden="">
<?php }

//page access
function AccessUrl($GetAutoUrl = true)
{
 if ($GetAutoUrl == true) {
  $RunningUrl = GET_URL();
 } else {
  $RunningUrl = $GetAutoUrl;
 }
?><input type="text" name="access_url" value="<?php echo SECURE($RunningUrl, "e"); ?>" hidden="">
<?php }

//form primary details
function FormPrimaryInputs($url = true, array $morerequest = null)
{
 FormInputToken();
 if ($url == true) {
  AccessUrl(true);
 } else {
  AccessUrl($url);
 }
 if ($morerequest != null) {
  foreach ($morerequest as $key => $value) {
   echo "<input type='text' name='" . $key . "' value='" . SECURE($value, "e") . "' hidden=''>";
  }
 }
}

//status view
function StatusView($data)
{
 if ($data == "1" or $data == 1) {
  return "<span class='text-success'><i class='fa fa-check-circle-o'></i></span>";
 } else {
  return "<span class='text-danger'><i class='fa fa-warning'></i></span>";
 }
}

//status view
function StatusViewWithText($data)
{
 if ($data == "1" or $data == 1 or $data == "Active") {
  return "<span class='text-success'><i class='fa fa-check-circle-o'></i> Active</span>";
 } elseif ($data == "2" or $data == 2 or $data == "Inactive") {
  return "<span class='text-danger'><i class='fa fa-warning'></i> Inactive</span>";
 } elseif ($data == "3" or $data == 3) {
  return "<span class='text-danger'><i>Deleted!</i></span>";
 } else {
  return "<span class='text-danger'><i class='fa fa-warning'></i> Inactive</span>";
 }
}

//return value
function ReturnValue($data)
{
 if ($data == null) {
  return "Not Available";
 } else {
  return $data;
 }
}
