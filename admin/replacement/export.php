<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Products";
$PageDescription = "Manage all products";
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="utf-8" />
 <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
 <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
 <meta name="keywords" content="<?php echo APP_NAME; ?>">
 <meta name="description" content="<?php echo SHORT_DESCRIPTION; ?>">
</head>

<body class='container' style="font-size:1rem !important;font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;">

 <div class="row" style="display:block;">
  <table class="table table-striped" style="width:100%;" border="1">
   <thead>
    <tr>
     <th>Sno</th>
     <th>ComplaintNo</th>
     <th>CustomerName</th>
     <th>ModalNo</th>
     <th>OldSerialNo</th>
     <th>NewSerailNo</th>
     <th>ReplacementDate</th>
    </tr>
   </thead>
   <?php
   if (isset($_GET['ComplaintReplacementModal'])) {
    $ComplaintReplacementModal = $_GET['ComplaintReplacementModal'];
    $Replacements = FetchConvertIntoArray("SELECT * FROM complaint_replacements where ComplaintReplacementModal like '%$ComplaintReplacementModal%' ORDER BY ComplaintReplacementId ASC", true);
   } else {
    $Replacements = FetchConvertIntoArray("SELECT * FROM complaint_replacements ORDER BY ComplaintReplacementId ASC", true);
   }
   if ($Replacements != null) {
    $Sno = 0;
    foreach ($Replacements as $Data) {
     $Sno++;
     $ComplaintMainId = FETCH("SELECT * FROM complaint_activities where ComplaintActivityId='" . $Data->ComplaintActivityId . "'", "ComplaintMainId");
     $ComplaintNo = FETCH("SELECT * FROM complaints where ComplaintsId='$ComplaintMainId'", "ComplaintsCustomRefId");
     $userid = FETCH("SELECT * FROM complaints where ComplaintsId='" . $ComplaintMainId . "'", "ComplaintsUserId");
     $userphone = FETCH("SELECT * FROM users where UserId='$userid'", "UserPhoneNumber"); ?>
     <tr>
      <td><?php echo $Sno; ?></td>
      <td><a href="../complaints/details/?id=<?php echo $ComplaintMainId; ?>" target="_blank" class="text-info"><?php echo $ComplaintNo; ?></a></td>
      <td><?php echo FETCH("SELECT * FROM users where UserId='" . $userid . "'", "UserFullName"); ?> <br>
       <span class="text-grey"><?php echo $userphone; ?></span>
      </td>
      <td><?php echo $Data->ComplaintReplacementModal; ?></td>
      <td><?php echo $Data->ComplaintReplacementOldBatteryNo; ?></td>
      <td><?php echo $Data->ComplaintReplacementNewSerialNo; ?></td>
      <td><?php echo DATE_FORMATE2("d M, Y", $Data->ComplaintReplcementPurchasedate); ?></td>
      <td>
      </td>
     </tr>
   <?php }
   } else {
    NoDataTableView("No Replacements Found!", "7");
   } ?>
  </table>
  <button onclick="print()" class="btn btn-sm btn-info"> Print</button>
</body>

</html>