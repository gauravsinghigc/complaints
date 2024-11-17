<?php
$Dir = "..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "My Complaints";
$PageDescription = "Manage all customers";

if (isset($_GET['type'])) {
  $PageName = $PageName . " : " . $_GET['type'];
} else {
  $PageName = $PageName;
}
$LOGIN_UserId = LOGIN_UserId;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta name="keywords" content="<?php echo APP_NAME; ?>">
  <meta name="description" content="<?php echo SHORT_DESCRIPTION; ?>">
  <?php include $Dir . "/include/admin/header_files.php"; ?>
  <script type="text/javascript">
    function SidebarActive() {
      document.getElementById("services").classList.add("active");
      document.getElementById("all_services").classList.add("active");
    }
    window.onload = SidebarActive;
  </script>
</head>

<body class='pace-top'>
  <?php include $Dir . "/include/admin/loader.php"; ?>

  <div id="app" class="app app-header-fixed app-sidebar-fixed">
    <?php
    include $Dir . "/include/admin/header.php";
    ?>
    <div class="container">
      <div class="row mt-4">
        <div class="col-md-12">
          <h4 class="app-heading"><?php echo $PageName; ?></h4>
          <div class="row">
            <div class="col-6 col-md-3 text-center">
              <div class="shadow-sm mb-2 rounded-2 p-3">
                <a href="index.php">
                  <h1>
                    <?PHP echo TOTAL("SELECT * FROM complaints where ComplaintAssignedTo='$LOGIN_UserId' and ComplaintStatus like '%EXECUTIVE ASSIGNED%'"); ?>
                  </h1>
                  OPEN COMPLAINTS
                </a>
              </div>
            </div>
            <div class="col-6 col-md-3 text-center">
              <div class="shadow-sm mb-2 rounded-2 p-3">
                <a href="index.php?type=IN PROGRESS">
                  <h1>
                    <?PHP echo TOTAL("SELECT * FROM complaints where ComplaintAssignedTo='$LOGIN_UserId' and ComplaintStatus like '%IN PROGRESS%'"); ?>
                  </h1>
                  IN PROGRESS
                </a>
              </div>
            </div>
            <div class="col-6 col-md-3 text-center">
              <div class="shadow-sm mb-2 rounded-2 p-3">
                <a href="index.php?type=COMPLETED">
                  <h1>
                    <?PHP echo TOTAL("SELECT * FROM complaints where ComplaintAssignedTo='$LOGIN_UserId' and ComplaintStatus like '%COMPLETED%'"); ?>
                  </h1>
                  COMPLETED
                </a>
              </div>
            </div>
            <div class="col-6 col-md-3 text-center">
              <div class="shadow-sm mb-2 rounded-2 p-3">
                <a href="new-complaints.php">
                  <h1>
                    <?PHP echo TOTAL("SELECT * FROM complaints where ComplaintAssignedTo='' and ComplaintStatus like '%NEW COMPLAINT%'"); ?>
                  </h1>
                  NEW COMPLAINTS
                </a>
              </div>
            </div>
          </div>
          <BR>
          <div class="flex-s-b">
            <form class="w-25">
              <input type="text" name="ComplaintsCustomRefId" placeholder="Enter Complaint No: COMPLAINT-NO-15-OCT-2022-6884985" value="<?php echo IfRequested("GET", "ComplaintsCustomRefId", "", false); ?>" list="ComplaintsCustomRefId" name="ComplaintsCustomRefId" class="form-control" onchange="form.submit()">
              <?php
              $CHECK_project_tags = CHECK("SELECT * FROM complaints");
              if ($CHECK_project_tags != 0) {
                echo "<datalist id='ComplaintsCustomRefId'>";
                $SQL_project_tags = SELECT("SELECT * FROM complaints where ComplaintAssignedTo='$LOGIN_UserId'");
                while ($FetchTags = mysqli_fetch_array($SQL_project_tags)) {

                  echo "<option value='" . $FetchTags["ComplaintsCustomRefId"] . "'>";
                }
                echo "</datalist>";
              }
              ?>
            </form>
            <form class="w-50 flex-s-b">
              <input type="date" name="from" onchange="form.submit()" class="form-control" value="<?php echo IfRequested("GET", "from", date("Y-m-d"), false); ?>">
              <input type="date" name="to" onchange="form.submit()" class="form-control" value="<?php echo IfRequested("GET", "to", date("Y-m-d"), false); ?>">
            </form>
            <div class="">
              <?php if (isset($_GET['type']) or isset($_GET['ComplaintsCustomRefId'])) { ?>
                <a href="index.php" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Clear Filter</a>
              <?php } ?>
            </div>
          </div>
          <HR>
        </div>
        <div class="row">
          <?php
          if (isset($_GET['type'])) {
            $type = $_GET['type'];

            $Complaints = FetchConvertIntoArray("SELECT * FROM complaints where ComplaintAssignedTo='$LOGIN_UserId' and ComplaintStatus like '%$type%' ORDER BY DATE(ComplaintCreatedAt) DESC", true);
          } elseif (isset($_GET['ComplaintsCustomRefId'])) {
            $ComplaintsCustomRefId = $_GET['ComplaintsCustomRefId'];
            $Complaints = FetchConvertIntoArray("SELECT * FROM complaints where ComplaintAssignedTo='$LOGIN_UserId' and  ComplaintsCustomRefId like '%$ComplaintsCustomRefId%' ORDER BY DATE(ComplaintCreatedAt) DESC", true);
          } else {
            $Complaints = FetchConvertIntoArray("SELECT * FROM complaints where ComplaintAssignedTo='$LOGIN_UserId' and  ComplaintStatus like '%EXECUTIVE ASSIGNED%' ORDER BY DATE(ComplaintCreatedAt) DESC", true);
          }

          if ($Complaints == null) {
            NoDataTableView("No Complaints Found!", 7);
          } else {
            $sNO = 0;
            foreach ($Complaints as $Complaint) {
              $sNO++; ?>
              <div class="col-md-4 col-sm-6 col-12">
                <a href="complaint-detials.php?id=<?php echo $Complaint->ComplaintsId; ?>">
                  <p class="data-list w-100" style="height:7rem !important;">
                    <small class="text-grey italic"><?php echo DATE_FORMATE2("d M, Y", $Complaint->ComplaintCreatedAt); ?></small>
                    <span>
                      <span class="pull-right">
                        <span class="btn btn-xs btn-default"><?php echo $Complaint->ComplaintStatus; ?></span><br>
                        <span class="text-grey">Complaint No</span><br>
                        <span class="bold">
                          <?php echo $Complaint->ComplaintsCustomRefId; ?>
                        </span>
                      </span>
                    </span><br>
                    <span>
                      <span class="text-grey">Customer Details</span><br>
                      <span class="bold">
                        <a href="complaint-detials.php?id=<?php echo $Complaint->ComplaintsId; ?>"><i class="fa fa-user"></i> <?php echo FETCH("SELECT * FROM users Where UserID='" . $Complaint->ComplaintsUserId . "'", "UserFullName"); ?></a>
                        <br> <?php echo $Complaint->ComplaintAddress; ?>
                      </span>
                    </span>
                  </p>
                </a>
              </div>
          <?php }
          } ?>
        </div>
      </div>
      <?php include $Dir . "/include/admin/footer.php"; ?>
      <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
    </div>

    <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>