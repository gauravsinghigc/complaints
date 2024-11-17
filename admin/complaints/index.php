<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Complaints";
$PageDescription = "Manage all customers";

if (isset($_GET['type'])) {
  $PageName = $PageName . " : " . $_GET['type'];
} else {
  $PageName = $PageName;
}
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

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include $Dir . "/include/admin/loader.php"; ?>

    <?php
    include $Dir . "/include/admin/header.php";
    include $Dir . "/include/admin/sidebar.php"; ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">

            <div class="col-12">
              <div class="card card-primary">
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-12 mb-1">
                      <div class="flex-s-b">
                        <?php if (LOGIN_UserType == "Admin") { ?>
                          <a href="add-complaint.php" class="btn btn-sm btn-default mb-0 action-btn mr-1"><i class="fa fa-plus"></i></a>
                        <?php } ?>
                        <h4 class="app-heading w-100 mb-0 mt-0"><?php echo $PageName; ?></h4>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 col-md-3 text-center">
                      <div class="bg-secondary text-white" style="border-radius:0.5rem;">
                        <div class="mb-2 rounded-2 p-3">
                          <a class="text-white" href="index.php">
                            <h1>
                              <?PHP echo TOTAL("SELECT * FROM complaints where ComplaintStatus like '%EXECUTIVE ASSIGNED%'"); ?>
                            </h1>
                            OPEN COMPLAINTS
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 text-white col-md-3 text-center">
                      <div style="background-color:skyblue !important;border-radius:0.5rem;">
                        <div class="mb-2 rounded-2 p-3">
                          <a class="text-white" href="index.php?type=NEW COMPLAINT">
                            <h1>
                              <?PHP echo TOTAL("SELECT * FROM complaints where ComplaintAssignedTo='' and ComplaintStatus like '%NEW COMPLAINT%'"); ?>
                            </h1>
                            NEW COMPLAINTS
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="col-6 text-white col-md-3 text-center">
                      <div class="bg-info" style="border-radius:0.5rem;">
                        <div class="mb-2 rounded-2 p-3">
                          <a class="text-white" href="index.php?type=IN PROGRESS">
                            <h1>
                              <?PHP echo TOTAL("SELECT * FROM complaints where ComplaintStatus like '%IN PROGRESS%'"); ?>
                            </h1>
                            IN PROGRESS
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 text-white col-md-3 text-center rounded-3">
                      <div class="bg-success rounded-2" style="border-radius:0.5rem;">
                        <div class="mb-2 rounded-3 p-3">
                          <a class="text-white" href="index.php?type=COMPLETED">
                            <h1>
                              <?PHP echo TOTAL("SELECT * FROM complaints where ComplaintStatus like '%COMPLETED%'"); ?>
                            </h1>
                            COMPLETED
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="">
                    <form class="w-100 flex-s-b">
                      <div class='w-50 m-r-10'>
                        <input type="search" placeholder="Complaint No: COMPLAINT-NO-15-OCT-2022-6884985" value="<?php echo IfRequested("GET", "ComplaintsCustomRefId", "", false); ?>" list="ComplaintsCustomRefId" name="ComplaintsCustomRefId" class="form-control" onchange="form.submit()">
                        <?php SUGGEST("complaints", "ComplaintsCustomRefId", "ASC"); ?>
                      </div>
                      <div class='w-50 ml-2'>
                        <input type="search" placeholder="Serial No" value="<?php echo IfRequested("GET", "ComplaintProductId", "", false); ?>" list="ComplaintProductId" name="ComplaintProductId" class="form-control" onchange="form.submit()">
                        <?php SUGGEST("complaints", "ComplaintProductId", "ASC"); ?>
                      </div>
                      <div class="w-50 ml-2">
                        <?php if (isset($_GET['type']) or isset($_GET['ComplaintsCustomRefId']) or isset($_GET['ComplaintProductId'])) { ?>
                          <a href="index.php" class="btn btn-md btn-danger"><i class="fa fa-times"></i> Clear</a>
                        <?php } ?>
                      </div>
                    </form>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h6 class="app-sub-heading">Complaints</h6>
                    </div>
                    <?php
                    if (isset($_GET['type'])) {
                      $type = $_GET['type'];
                      $Complaints = FetchConvertIntoArray("SELECT * FROM complaints where ComplaintStatus like '%$type%' ORDER BY DATE(ComplaintCreatedAt) DESC", true);
                    } elseif (isset($_GET['ComplaintsCustomRefId'])) {
                      $ComplaintsCustomRefId = $_GET['ComplaintsCustomRefId'];
                      $ComplaintProductId = $_GET['ComplaintProductId'];
                      $Complaints = FetchConvertIntoArray("SELECT * FROM complaints where ComplaintProductId like '%$ComplaintProductId%' and ComplaintsCustomRefId like '%$ComplaintsCustomRefId%' ORDER BY DATE(ComplaintCreatedAt) DESC", true);
                    } else {
                      $Complaints = FetchConvertIntoArray("SELECT * FROM complaints where ComplaintStatus like '%EXECUTIVE ASSIGNED%' ORDER BY DATE(ComplaintCreatedAt) DESC", true);
                    }

                    if ($Complaints == null) {
                      NoDataTableView("No Complaints Found!", 7);
                    } else {
                      $sNO = 0;
                      foreach ($Complaints as $Complaint) {
                        $sNO++; ?>
                        <div class="col-md-4 col-sm-6 col-12">
                          <a href="details/?id=<?php echo $Complaint->ComplaintsId; ?>">
                            <div class="data-list pb-2">
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
                                  <a href="details/?uid=<?php echo SECURE($Complaint->ComplaintsUserId, "e"); ?>"><i class="fa fa-user"></i> <?php echo FETCH("SELECT * FROM users Where UserID='" . $Complaint->ComplaintsUserId . "'", "UserFullName"); ?></a>
                                  <br> <i class="fa fa-phone"></i> <?php echo FETCH("SELECT * FROM users Where UserID='" . $Complaint->ComplaintsUserId . "'", "UserPhoneNumber"); ?>
                                  <br> <i class="fa fa-map-location"></i> <?php echo $Complaint->ComplaintAddress; ?>
                                </span>
                              </span>
                              <?php
                              if (LOGIN_UserType == "SERVICE_EXECUTIVE") {
                                if ($Complaint->ComplaintStatus == "NEW COMPLAINT") { ?>
                                  <hr>
                                  <form class="mb-2" action="../../controller/ComplaintController.php" method="POST">
                                    <?php FormPrimaryInputs(true, [
                                      "ComplaintAssignedTo" => LOGIN_UserId,
                                      "ComplaintsId" => $Complaint->ComplaintsId
                                    ]) ?>
                                    <button type="submit" name="CaptureComplaints" class="btn btn-sm btn-primary mt-0 mb-0">Capture Complaints</button>
                                  </form>
                                <?php } else { ?>
                                  <hr>
                                  <a href="details/?id=<?php echo $Complaint->ComplaintsId; ?>" class="btn btn-sm btn-success mb-2"> View Details</a>
                                <?php }
                              } else { ?>
                                <hr>
                                <a href="details/?id=<?php echo $Complaint->ComplaintsId; ?>" class="btn btn-sm btn-success mb-2"> View Details</a>
                              <?php
                              } ?>
                            </div>
                          </a>
                        </div>
                    <?php }
                    } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php
    include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>