<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Attandances";
$PageDescription = "Manage all customers";

if (isset($_GET['uid'])) {
   $_SESSION['REQ_UserId'] = SECURE($_GET['uid'], "d");
   $REQ_UserId = $_SESSION['REQ_UserId'];
} else {
   $REQ_UserId = $_SESSION['REQ_UserId'];
}

$PageSqls = "SELECT * FROM users where UserId='$REQ_UserId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <title><?php echo GET_DATA("UserSalutation"); ?> <?php echo GET_DATA("UserFullName"); ?> | <?php echo APP_NAME; ?></title>
   <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
   <meta name="keywords" content="<?php echo APP_NAME; ?>">
   <meta name="description" content="<?php echo SHORT_DESCRIPTION; ?>">
   <?php include $Dir . "/include/admin/header_files.php"; ?>
   <script type="text/javascript">
      function SidebarActive() {
         document.getElementById("customers").classList.add("active");
         document.getElementById("emp_att").classList.add("active");
      }
      window.onload = SidebarActive;
   </script>

</head>

<body class='pace-top'>
   <?php include $Dir . "/include/admin/loader.php"; ?>

   <div id="app" class="app app-header-fixed app-sidebar-fixed">
      <?php
      include $Dir . "/include/admin/header.php";
      include $Dir . "/include/admin/sidebar.php"; ?>

      <div id="content" class="app-content">

         <?php include "c-profile.php"; ?>
         <div class="row">
            <div class="col-md-12">
               <h5 class="app-heading mt-10px">Attandance</h5>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <?php include "common-nav.php"; ?>
            </div>
            <div class="col-md-12">
               <h5 class="app-sub-heading">Add Attandance Record</h5>
            </div>
         </div>
         <form action="<?php echo CONTROLLER; ?>/usercontroller.php" method="POST">
            <?php FormPrimaryInputs(true, [
               "UserAttandanceMainUserId" => $REQ_UserId
            ]); ?>
            <div class="row mb-10px">
               <div class="col-md-2 form-group">
                  <label>Check-in Date</label>
                  <input type="date" readonly="" name="UserAttandanceStartDate" class="form-control" value="<?php echo date("Y-m-d"); ?>">
               </div>
               <div class="col-md-2 form-group">
                  <label>Check-in Time</label>
                  <input type="time" readonly="" id="at_times" name="UserAttandanceStartTime" class="form-control" value="">
                  <script>
                     window.setInterval(function() {
                        var todays = new Date();
                        var times = todays.getHours() + ":" + todays.getMinutes() + ":" + todays.getSeconds();
                        document.getElementById("at_times").value = times;
                     }, 1000);
                  </script>
               </div>
               <div class="col-md-2 form-group">
                  <label>Status</label>
                  <select name="UserAttandanceStatus" id="at_status" onchange="CheckLeaves()" class="form-control" required="">
                     <option value="PRESENT">PRESENT</option>
                     <option value="ABSANT">ABSANT</option>
                     <option value="WORK_FROM_HOME">WORK FROM HOME</option>
                     <option value="LEAVE">LEAVE</option>
                  </select>
               </div>
               <div class="col-md-4 form-group hidden" id="leavenote">
                  <label>Enter Reason</label>
                  <textarea name="UserAttandanceNotes" class="form-control" rows="3"></textarea>
               </div>
               <div class="col-md-2">
                  <button type="submit" name="AttandanceRecords" class="btn btn-md btn-success mt-25px">Save Records</button>
               </div>
            </div>
         </form>

         <div class="row mb-5px">
            <div class="col-md-12">
               <h5 class="app-sub-heading">Open/Pending/Un-Check-out Attandances</h5>
               <?php
               $sql = "SELECT * FROM user_attandances where UserAttandanceMainUserId='$REQ_UserId' and UserAttandanceEndTime='null' and UserAttandanceEndDate='null' GROUP BY UserAttandanceMonth ORDER BY DATE('UserAttandanceStartDate') DESC";
               $FetchAttandances = FetchConvertIntoArray("$sql", true);
               if ($FetchAttandances != null) {
                  foreach ($FetchAttandances as $Record) {
                     $MonthGroup = $date = $Record->UserAttandanceMonth; ?>
                     <form action="<?php echo CONTROLLER; ?>/usercontroller.php" method="POST">
                        <?php FormPrimaryInputs(true, [
                           "UserAttandanceId" => $Record->UserAttandanceId,
                        ]) ?>
                        <div class="row">
                           <div class="col-md-5">
                              <p class="flex-s-b" style="line-height:18px;">
                                 <span>
                                    <span class="text-grey">Check-in Date</span><br>
                                    <span class="text-black fs-17px"><b><?php echo DATE_FORMATE2("d M, Y", $Record->UserAttandanceStartDate); ?></b></span>
                                 </span>
                                 <span>
                                    <span class="text-grey">Check-in Time</span><br>
                                    <span class="text-black fs-17px"><b><?php echo DATE_FORMATE2("h:m A", $Record->UserAttandanceStartTime); ?></b></span>
                                 </span>
                                 <span>
                                    <span class="text-grey">Status</span><br>
                                    <span class="text-black fs-17px"><?php echo $Record->UserAttandanceStatus; ?></span>
                                 </span>
                              </p>
                           </div>
                           <div class="col-md-7 flex-s-b shadow-sm rounded-1">
                              <div class="form-group">
                                 <label>Check-out Date</label>
                                 <input type="date" readonly="" name="UserAttandanceEndDate" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                              </div>
                              <div class="form-group">
                                 <label>Check-out Time</label>
                                 <input type="time" readonly="" name="UserAttandanceEndTime" id="<?php echo $Record->UserAttandanceId; ?>_times" value="" class="form-control">
                              </div>
                              <script>
                                 window.setInterval(function() {
                                    var today_<?php echo $Record->UserAttandanceId; ?> = new Date();
                                    var times_<?php echo $Record->UserAttandanceId; ?> = today_<?php echo $Record->UserAttandanceId; ?>.getHours() + ":" + today_<?php echo $Record->UserAttandanceId; ?>.getMinutes() + ":" + today_<?php echo $Record->UserAttandanceId; ?>.getSeconds();
                                    document.getElementById("<?php echo $Record->UserAttandanceId; ?>_times").value = times_<?php echo $Record->UserAttandanceId; ?>;
                                 }, 1000);
                              </script>
                              <div>
                                 <button class="btn btn-warning btn-lg" name="CheckOutRecord">Check-out <i class="fa fa-angle-right"></i></button>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <hr>
                           </div>
                        </div>
                     </form>
               <?php }
               } else {
                  NoData("No Pending Record Found!");
               } ?>
               <h5 class="app-sub-heading">Monthly Attandance History</h5>
               <?php if (isset($_GET['month-group']) && isset($_GET['monthview'])) {
                  $ReqMonthGroup = $_GET['month-group']; ?>
                  <div class="flex-s-b mb-5px">
                     <h4>Attandance Record for : <b><?php echo $_GET['month-group']; ?></b></h4>
                     <a href="attandance.php" class="btn btn-sm btn-primary">Hide Record</a>
                  </div>
                  <table class="table table-striped">
                     <tr>
                        <th>Date</th>
                        <th>Month</th>
                        <th>Check-in/IP</th>
                        <th>Check-Out/IP</th>
                        <th>Work Hours</th>
                        <th>WorkDayCount</th>
                        <th>Status/Note</th>
                     </tr>
                     <?php
                     $sql2 = "SELECT * FROM user_attandances where UserAttandanceMainUserId='$REQ_UserId' and UserAttandanceMonth='$ReqMonthGroup' ORDER BY DATE('UserAttandanceStartDate') DESC";
                     $FetchAttandances = FetchConvertIntoArray("$sql2", true);
                     if ($FetchAttandances != null) {
                        $TotalHours = 0;
                        $TotalDays = 0;
                        foreach ($FetchAttandances as $Record) {
                           $MonthGroup = $date = $Record->UserAttandanceMonth;
                           $CheckIN = $Record->UserAttandanceStartDate . " " . $Record->UserAttandanceStartTime;
                           $CheckOUT = $Record->UserAttandanceEndDate . " " . $Record->UserAttandanceEndTime;
                           $WorkingHoursTotal = GetHours($CheckIN, $CheckOUT);
                           $WorkDaysTotal = round($WorkingHoursTotal / REQUIRED_WORK_HOURS_PER_DAY, 1);
                           $TotalHours += $WorkingHoursTotal;
                           $TotalDays += $WorkDaysTotal; ?>
                           <tr>
                              <td><span class="bold text-primary"><?php echo DATE_FORMATE2("d M, Y", strtoupper($Record->UserAttandanceStartDate)); ?></span></td>
                              <td><?php echo strtoupper($MonthGroup); ?></td>
                              <td><?php echo $Record->UserAttandanceStartIP; ?></td>
                              <td><?php echo $Record->UserAttandanceEndIP; ?></td>
                              <td>
                                 <?php echo $WorkingHoursTotal; ?> Hrs.
                              </td>
                              <td>
                                 <?php echo $WorkDaysTotal; ?> Days
                              </td>
                              <td><?php echo $Record->UserAttandanceStatus; ?></td>
                           </tr>
                        <?php
                        } ?>
                        <tr>
                           <td colspan="4" align="right"><b>Total Work Hours : </b><?php echo $TotalHours; ?> Hrs.</td>
                           <td colspan="3" class="text-center"><b>Total Work Days: </b><?php echo $TotalDays; ?> Days</td>
                        </tr>
                     <?php
                     } ?>
                  </table>
               <?php } ?>
               <table class="table table-striped">
                  <thead>
                     <tr>
                        <th>Month-Year</th>
                        <th>Presents</th>
                        <th>Absants</th>
                        <th>WFH</th>
                        <th>Leaves</th>
                        <th>WorkHours</th>
                        <th>WorkDays</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $sql = "SELECT * FROM user_attandances where UserAttandanceMainUserId='$REQ_UserId' GROUP BY UserAttandanceMonth ORDER BY DATE('UserAttandanceStartDate') DESC";
                     $FetchAttandances = FetchConvertIntoArray("$sql", true);

                     if ($FetchAttandances != null) {
                        $TotalHours = 0;
                        $TotalDays = 0;
                        foreach ($FetchAttandances as $Record) {
                           $MonthGroup = $date = $Record->UserAttandanceMonth;
                           $CheckIN = $Record->UserAttandanceStartDate . " " . $Record->UserAttandanceStartTime;
                           $CheckOUT = $Record->UserAttandanceEndDate . " " . $Record->UserAttandanceEndTime;
                           $WorkingHours = GetHours($CheckIN, $CheckOUT);
                           $WorkDays = round($WorkingHours / REQUIRED_WORK_HOURS_PER_DAY, 1);

                           //count total work hours and days
                           $sql2 = "SELECT * FROM user_attandances where UserAttandanceMainUserId='$REQ_UserId' and UserAttandanceMonth='$MonthGroup' ORDER BY DATE('UserAttandanceStartDate') DESC";
                           $FetchAttandances = FetchConvertIntoArray("$sql2", true);
                           if ($FetchAttandances != null) {
                              foreach ($FetchAttandances as $Record) {
                                 $MonthGroup = $date = $Record->UserAttandanceMonth;
                                 $CheckIN = $Record->UserAttandanceStartDate . " " . $Record->UserAttandanceStartTime;
                                 $CheckOUT = $Record->UserAttandanceEndDate . " " . $Record->UserAttandanceEndTime;
                                 $WorkingHoursTotal = GetHours($CheckIN, $CheckOUT);
                                 $WorkDaysTotal = round($WorkingHoursTotal / REQUIRED_WORK_HOURS_PER_DAY, 1);
                                 $TotalHours += $WorkingHoursTotal;
                                 $TotalDays += $WorkDaysTotal;
                              }
                           }

                     ?>
                           <tr>
                              <td><span class="bold text-primary"><?php echo strtoupper($MonthGroup); ?></span></td>
                              <td class="bold"><?php echo TOTAL("SELECT * FROM user_attandances where UserAttandanceMonth='" . $date . "' and UserAttandanceStatus='PRESENT'"); ?></td>
                              <td class="bold"><?php echo TOTAL("SELECT * FROM user_attandances where UserAttandanceMonth='" . $date . "' and UserAttandanceStatus='ABSANT'"); ?></td>
                              <td class="bold"><?php echo TOTAL("SELECT * FROM user_attandances where UserAttandanceMonth='" . $date . "' and UserAttandanceStatus='WORK_FROM_HOME'"); ?></td>
                              <td class="bold"><?php echo TOTAL("SELECT * FROM user_attandances where UserAttandanceMonth='" . $date . "' and UserAttandanceStatus='LEAVE'"); ?></td>
                              <td>
                                 <?php echo $TotalHours; ?> Hrs.
                              </td>
                              <td>
                                 <?php echo $TotalDays; ?> Days
                              </td>
                              <td>
                                 <a href="?monthview=true&month-group=<?php echo $MonthGroup; ?>" class="text-primary bold">View Day Chart</a>
                              </td>
                           </tr>
                     <?php
                        }
                     }
                     ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <!--===================================================-->
   <?php include $Dir . "/include/admin/footer.php"; ?>
   <a href=" javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
   </div>

   <script>
      function CheckLeaves() {
         var at_status = document.getElementById("at_status");

         if (at_status.value == "LEAVE" || at_status.value == "WORK_FROM_HOME") {
            document.getElementById("leavenote").style.display = "block";
         } else {
            document.getElementById("leavenote").style.display = "none";
         }
      }
   </script>
   <?php include $Dir . "/include/admin/footer_files.php"; ?>
</body>

</html>