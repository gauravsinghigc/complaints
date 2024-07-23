<?php
//require
require '../../require/modules.php';
require '../../require/admin/sessionvariables.php';
?>
<html>

<head>
 <title>ExportActivities@<?php echo date("d_M_Y"); ?></title>
 <?php require '../../include/admin/header_files.php'; ?>
 <style>
  table.table .table-striped,
  table.table .table-striped tr,
  table.table .table-striped th,
  table.table .table-striped td {
   font-size: 10px !important;
   padding: 0px !important;
  }
 </style>
</head>

<body onload="window.print()">

 <div class="printable-area m-t-3" style="box-shadow:0px 0px 2px grey !important;">
  <?php
  include '../../include/admin/export-header.php';
  APP_LOGS("EXPORT", "ALL Activities Exported @ RefID: $ExportRefid", "EXPORT"); ?>
  <h4 class="text-center m-t-0 bg-dark p-1" style="background-color:black !important;color:white !important;padding:5px !important;">All Activities</h4>
  <table class="table table-striped">
   <thead>
    <tr>
     <th>SNo</th>
     <th>logTitle</th>
     <th>Details</th>
     <th>created_at</th>
    </tr>
   </thead>
   <tbody>
    <?php
    $count = 0;
    $SqlLogs = SELECT("SELECT * FROM systemlogs ORDER by LogsId ASC");
    while ($FetchLogs =  mysqli_fetch_assoc($SqlLogs)) {
     $logTitle = SECURE($FetchLogs['logTitle'], "d");
     $logdesc = SECURE($FetchLogs['logdesc'], "d");
     $created_at = date("d M, Y h:m:s A", strtotime($FetchLogs['created_at']));
     $systeminfo = SECURE($FetchLogs['systeminfo'], "d");
     $count++; ?>
     <tr>
      <td class="fs-9"><?php echo $count; ?></td>
      <td class="fs-9"><?php echo $logTitle; ?></td>
      <td class="fs-9"><?php echo $logdesc; ?></td>
      <td class="fs-9"><?php echo $created_at; ?></td>
     </tr>
    <?php } ?>
   </tbody>
  </table>
  <?php include '../../include/admin/export-footer.php'; ?>
 </div>


 <?php
 require '../../include/admin/footer_files.php';
 ?>
</body>

</html>