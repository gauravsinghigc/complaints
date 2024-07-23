<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Replacements";
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
  <?php include $Dir . "/include/admin/header_files.php"; ?>
  <script type="text/javascript">
    function SidebarActive() {
      document.getElementById("products").classList.add("active");
      document.getElementById("all_products").classList.add("active");
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
                    <div class="col-md-12 mb-4">
                      <div class="flex-s-b">
                        <h4 class="app-heading w-100 mb-0 mt-0"><?php echo $PageName; ?> | <?php echo $PageDescription; ?></h4>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <form class="row">
                        <div class="col-md-4 mb-3">
                          <div class="flex-s-b">
                            <input type="search" onchange="form.submit()" value="<?php echo IfRequested("GET", "ComplaintReplacementModal", "", false); ?>" name="ComplaintReplacementModal" list="ComplaintReplacementModal" placeholder="Search Modal No..." class="form-control mb-0 form-control-sm w-100">
                            <?php SUGGEST_SQL_DATA("SELECT * FROM complaint_replacements", "ComplaintReplacementModal", "ASC"); ?>
                            <?php if (isset($_GET['ComplaintReplacementModal'])) { ?>
                              <a href="index.php" class="btn btn-sm btn-danger w-50 ml-3"><i class="fa fa-times"></i> Clear Search</a>
                            <?php } ?>

                          </div>
                        </div>

                        <div class="col-dm-8 text-right">
                          <?php if (LOGIN_UserType == "Admin") { ?>
                            <a href="export.php" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Export All</a>
                          <?php } ?>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-striped">
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
                              $ComplaintActivityPerformedBy = FETCH("SELECT * FROM complaints WHERE ComplaintsId='" . $ComplaintMainId . "'", "ComplaintAssignedTo");
                              $ComplaintNo = FETCH("SELECT * FROM complaints where ComplaintsId='$ComplaintMainId'", "ComplaintsCustomRefId");
                              $userid = FETCH("SELECT * FROM complaints where ComplaintsId='" . $ComplaintMainId . "'", "ComplaintsUserId");
                              $userphone = FETCH("SELECT * FROM users where UserId='$userid'", "UserPhoneNumber");
                              if (LOGIN_UserType == "SERVICE_EXECUTIVE") {
                                if (LOGIN_UserId == $ComplaintActivityPerformedBy) { ?>
                                  <tr>
                                    <td><?php echo $Sno; ?></td>
                                    <td><a href="../complaints/details/?id=<?php echo $ComplaintMainId; ?>" target="_blank" class="text-info" style="font-size:1rem !important;"><?php echo $ComplaintNo; ?></a></td>
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
                              } else { ?>
                                <tr>
                                  <td><?php echo $Sno; ?></td>
                                  <td><a href="../complaints/details/?id=<?php echo $ComplaintMainId; ?>" target="_blank" class="text-info" style="font-size:1rem !important;"><?php echo $ComplaintNo; ?></a></td>
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
                            }
                          } else {
                            NoDataTableView("No Replacements Found!", "7");
                          } ?>
                        </table>
                      </div>
                    </div>
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