<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "Complaint Details";
$PageDescription = "Manage all customers";

if (isset($_GET['id'])) {
  $ComplaintsId = $_GET['id'];
  $_SESSION['ComplaintsId'] = $ComplaintsId;
} else {
  $ComplaintsId = $_SESSION['ComplaintsId'];
}

$ComplaintSql = "SELECT * FROM complaints where ComplaintsId='$ComplaintsId'";
$ComplaintsUserId = FETCH($ComplaintSql, "ComplaintsUserId");
$UserSql = "SELECT * FROM users where UserId='$ComplaintsUserId'";

$PageName = $PageName . " : " . FETCH($ComplaintSql, "ComplaintsCustomRefId");
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
                  <?php
                  $WarrantPro = "SELECT * FROM warranty_products where WarrantyProductSno='" . FETCH($ComplaintSql, "ComplaintProductId") . "'";
                  ?>

                  <div class="row">
                    <div class="col-md-12">
                      <a href="../index.php" class="btn btn-sm btn-secondary"><i class="fa fa-angle-left"></i> View All Complaints</a>
                    </div>
                    <div class="col-md-3">
                      <h5 class="app-sub-heading">Customer Details
                        <a class="pull-right" href="../../customers/update.php?customerid=<?php echo SECURE($ComplaintsUserId, "e"); ?>"><i class='fa fa-edit'></i></a>
                      </h5>
                      <p class="data-list">
                        <span class="text-grey">Reg Person Name</span><br>
                        <span class="bold"><?php echo FETCH($ComplaintSql, "ComplaintsName"); ?></span>
                      </p>
                      <p class="data-list">
                        <span class="text-grey">Phone Number</span><br>
                        <span class="bold"><a href="tel:<?php echo FETCH($UserSql, "UserPhoneNumber"); ?>"><?php echo FETCH($UserSql, "UserPhoneNumber"); ?></a></span> <span class="pull-right"><a href="tel:<?php echo FETCH($UserSql, "UserPhoneNumber"); ?>" class="btn btn-sm btn-success" style="font-size:0.6rem;margin-top:-1.4rem;"><i class="fa fa-phone"></i> Make A Call</a></span>
                      </p>
                      <p class="data-list">
                        <span class="text-grey">Email ID</span><br>
                        <span class="bold"><?php echo EMAIL(FETCH($UserSql, "UserEmailId"), "link", "", "fa fa-envelope text-danger"); ?></span>
                      </p>
                      <p class="data-list">
                        <span class="text-grey">Complaint Address</span><br>
                        <span class="bold"><?php echo FETCH($ComplaintSql, "ComplaintAddress"); ?></span>
                      </p>
                      <h5 class="app-sub-heading">Product/Item Details
                        <a class="pull-right" href="update-warn-pro.php?proid=<?php echo SECURE(FETCH($WarrantPro, "WarrantyProductsId"), "e"); ?>"><i class='fa fa-edit'></i></a>
                      </h5>
                      <p class="data-list">
                        <span class="text-grey">Warranty Status</span><br>
                        <span class="bold"><?php echo FETCH($WarrantPro, "WarrantyStatus"); ?></span>
                      </p>
                      <p class="data-list">
                        <span class="text-grey">Product Serial No</span><br>
                        <span class="bold"><?php echo FETCH($ComplaintSql, "ComplaintProductId"); ?></span>
                      </p>


                      <p class="data-list">
                        <span class="text-grey">Modal No</span><br>
                        <span class="bold"><?php echo FETCH($WarrantPro, "WarrantyProductModalNo"); ?></span>
                      </p>
                      <p class="data-list">
                        <span class="text-grey">Capacity</span><br>
                        <span class="bold"><?php echo FETCH($WarrantPro, "WarrantyProductCapacity"); ?> AH</span>
                      </p>
                      <p class="data-list">
                        <span class="text-grey">Warranty in Months</span><br>
                        <span class="bold"><?php echo FETCH($WarrantPro, "WarrantyProductMonthWarranty"); ?> Months</span>
                      </p>
                      <p class="data-list">
                        <span class="text-grey">Life</span><br>
                        <span class="bold"><?php echo FETCH($WarrantPro, "WarrantyProductLife"); ?> Years</span>
                      </p>
                      <p class="data-list">
                        <span class="text-grey">Mfg Date</span><br>
                        <span class="bold"><?php echo DATE_FORMATE2("d M, Y", FETCH($WarrantPro, "WarrantyProductMfgDate")); ?></span>
                      </p>
                      <p class="data-list">
                        <span class="text-grey">Purchase Date</span><br>
                        <span class="bold"><?php echo DATE_FORMATE2("d M, Y", FETCH($WarrantPro, "WarrantyProductPurchasedate")); ?></span>
                      </p>
                      <p class="data-list">
                        <span class="text-grey">Expire Date</span><br>
                        <span class="bold"><?php echo DATE_FORMATE2("d M, Y", FETCH($WarrantPro, "WarrantyExpireDate")); ?></span>
                      </p>
                    </div>

                    <!-- Complaint details -->
                    <div class="col-md-4">
                      <h5 class="app-sub-heading">Service Engineer</h5>
                      <?php
                      $FetchServiceEngineer = FETCH($ComplaintSql, "ComplaintAssignedTo");
                      if ($FetchServiceEngineer == "") {
                        $ComplaintAssignedTo = null;
                        $EmpSQL = "SELECT * FROM users where UserId='$ComplaintAssignedTo'"
                      ?>
                        <a onclick="Databar('AddServiceEnginer')" class="btn btn-sm btn-dark mb-2">Add Service Executive</a>
                      <?php
                      } else {
                        $ComplaintAssignedTo = FETCH($ComplaintSql, "ComplaintAssignedTo");
                        $EmpSQL = "SELECT * FROM users where UserId='$ComplaintAssignedTo'"; ?>
                        <p class="data-list">
                          <span class="text-grey">Reg Person Name</span><br>
                          <span class="bold">(ID<?php echo $ComplaintAssignedTo; ?>) <?php echo FETCH($EmpSQL, "UserFullName"); ?></span>
                        </p>
                        <p class="data-list">
                          <span class="text-grey">Phone Number</span><br>
                          <span class="bold"><a href="tel:<?php echo FETCH($EmpSQL, "UserPhoneNumber"); ?>"><?php echo FETCH($EmpSQL, "UserPhoneNumber"); ?></a></span> <span class="pull-right"><a href="tel:<?php echo FETCH($EmpSQL, "UserPhoneNumber"); ?>" class="btn btn-sm btn-success" style="font-size:0.6rem;margin-top:-1.4rem;"><i class="fa fa-phone"></i> Make A Call</a></span>
                        </p>
                        <p class="data-list">
                          <span class="text-grey">Email ID</span><br>
                          <span class="bold"><?php echo EMAIL(FETCH($EmpSQL, "UserEmailId"), "link", "", "fa fa-envelope text-danger"); ?></span>
                        </p>
                        <a onclick="Databar('AddServiceEnginer')" class="btn btn-sm btn-dark mb-2 mx-auto d-block">Update Service Executive</a>
                      <?php } ?>
                      <div class="mt-1" id="AddServiceEnginer" style="display:none;">
                        <form action='../../../controller/ComplaintController.php' method="POST">
                          <?php FormPrimaryInputs(true, [
                            "ComplaintMainId" => $ComplaintsId,
                          ]); ?>
                          <div class="row">
                            <div class="col-md-12 form-group">
                              <select name="ComplaintAssignedTo" onchange="Form.submit()" class="form-control" required="">
                                <option value="0">Select Service Executive</option>
                                <?php $FetchExecutive = FetchConvertIntoArray("SELECT * FROM users where UserType='SERVICE_EXECUTIVE'", true);
                                if ($FetchExecutive != null) {
                                  foreach ($FetchExecutive as $Ex) { ?>
                                    <option value="<?php echo $Ex->UserId; ?>"><?php echo $Ex->UserFullName; ?> @ <?php echo $Ex->UserPhoneNumber; ?></option>
                                <?php }
                                } ?>
                              </select>
                            </div>
                            <div class="col-md-12">
                              <button type="submit" name="UpdateServiceExecutive" class="btn btn-sm btn-success">Update Executive</button>
                              <a onclick="Databar('AddServiceEnginer')" class="btn btn-sm btn-default">Cancel</a>
                            </div>
                          </div>
                        </form>
                      </div>
                      <h5 class="app-sub-heading">Complaint Details
                        <a class="pull-right" href="update-complaint.php?complaintsid=<?php echo SECURE($ComplaintsId, "e"); ?>"><i class='fa fa-edit'></i></a>
                      </h5>
                      <p class="data-list">
                        <span class="text-grey">Complaint Status</span><br>
                        <span class="bold"><?php echo FETCH($ComplaintSql, "ComplaintStatus"); ?></span>
                      </p>
                      <?php DATA_DISPLAY("Priority Level", FETCH($ComplaintSql, "ComplaintPriorityLevel")); ?>
                      <p class="data-list">
                        <span class="text-grey">Complaint No</span><br>
                        <span class="bold"><?php echo FETCH($ComplaintSql, "ComplaintsCustomRefId"); ?></span>
                      </p>
                      <p class="data-list">
                        <span class="text-grey">Complaint date</span><br>
                        <span class="bold"><?php echo FETCH($ComplaintSql, "ComplaintCreatedAt"); ?></span>
                      </p>
                      <p class="data-list">
                        <span class="text-grey">Complaint Type</span><br>
                        <span class="bold"><?php echo FETCH($ComplaintSql, "ComplaintType"); ?></span>
                      </p>
                      <p class="data-list">
                        <span class="text-grey">Issue/Problem</span><br>
                        <span class="bold"><?php echo FETCH($ComplaintSql, "ComplaintIssueDescriptions"); ?></span>
                      </p>
                      <?php
                      DATA_DISPLAY("Created At", FETCH($ComplaintSql, "ComplaintCreatedAt"));
                      DATA_DISPLAY("Updated", FETCH($ComplaintSql, "ComplaintUpdatedAt"));
                      DATA_DISPLAY("Customer verification Status", FETCH($ComplaintSql, "ComplaintVerificationStatus"));
                      DATA_DISPLAY("Verification OTP", FETCH($ComplaintSql, "ComplaintVerificationOTP"));
                      ?>
                    </div>
                    <!-- end of complaints -->

                    <!-- complaints activity -->
                    <div class="col-md-5">
                      <h5 class="app-sub-heading"><i class='fa fa-message text-danger'></i> Chat with Service Engineer</h5>
                      <div class="chat-box">
                        <div class="chat-area">
                          <p style="font-size:1rem !important;" class="data-list text-success">
                            <i class="fa fa-check-circle"></i> Complaint is Generated!...
                          </p>
                          <p class="data-list">
                            <b>Complaint Created</b> : <?php echo FETCH($ComplaintSql, "ComplaintCreatedAt"); ?><br>
                            <span class="text-grey">Reg Person Name</span><br>
                            <span class="bold">(ID<?php echo $ComplaintAssignedTo; ?>) <?php echo FETCH($EmpSQL, "UserFullName"); ?></span> @ <a href="tel:<?php echo FETCH($EmpSQL, "UserPhoneNumber"); ?>"><?php echo FETCH($EmpSQL, "UserPhoneNumber"); ?></a><br>
                            <span class="text-grey">Complaint No</span><br>
                            <span class="bold"><?php echo FETCH($ComplaintSql, "ComplaintsCustomRefId"); ?></span><br>
                            <span class="text-grey">Product Serial No</span><br>
                            <span class="bold"><?php echo FETCH($ComplaintSql, "ComplaintProductId"); ?></span><br>
                            <span class="text-grey">Modal No</span><br>
                            <span class="bold"><?php echo FETCH($WarrantPro, "WarrantyProductModalNo"); ?></span><br>
                            <span class="text-grey">Capacity</span><br>
                            <span class="bold"><?php echo FETCH($WarrantPro, "WarrantyProductCapacity"); ?></span><br>
                            <hr class="w-25">
                          </p>
                          <?php $FetchActivity = FetchConvertIntoArray("SELECT * FROM complaint_activities where ComplaintMainId='$ComplaintsId' ORDER BY ComplaintActivityId ASC", true);
                          if ($FetchActivity == null) {
                            NoData("No Activity History Found!");
                          } else {
                            foreach ($FetchActivity as $Act) { ?>
                              <?php
                              $ListUserType = FETCH("SELECT * FROM users where UserId='" . $Act->ComplaintActivityPerformedBy . "'", "UserType");
                              if ($ListUserType == LOGIN_UserType) {
                                $pullchat = "text-right";
                                $color = "style='background-color: #ecf5ff;margin-left: 3rem;'";
                              } else {
                                $pullchat = "text-left";
                                $color = "style='background-color: #ecfffb;margin-right: 3rem;'";
                              } ?>
                              <div class="w-100 <?php echo $pullchat; ?>">
                                <p class="data-list mb-0" <?php echo $color; ?>>
                                  <?php
                                  $ComplaintActivityFile = FETCH("SELECT * FROM complaint_activity_documents where ComplaintActivityId='" . $Act->ComplaintActivityId . "'", "ComplaintActivityFile");
                                  if ($ComplaintActivityFile != null) { ?>
                                    <a href="<?php echo STORAGE_URL; ?>/complaints/<?php echo $ComplaintsId; ?>/<?php echo $ComplaintActivityFile; ?>" target="_blank">
                                      <img src="<?php echo STORAGE_URL; ?>/complaints/<?php echo $ComplaintsId; ?>/<?php echo $ComplaintActivityFile; ?>" class="img-fluid w-25 m-1 rounded shadow-sm p-1"><br>
                                    </a>
                                  <?php } ?>
                                  <span class="">
                                    <span class="text-grey italic" style="font-size:0.85rem !important;"><?php echo DATE_FORMATE2("d M, Y h:i A", $Act->ComplaintActivityDateTime); ?></span><br>
                                    <span class="text-success italic"><?php echo $Act->ComplaintActivityStatus; ?></span><br>
                                  </span>
                                  <span class="text-black">
                                    <?php echo SECURE($Act->ComplaintActivityDescriptions, "d"); ?><br>
                                    <?php $CheckStatusIfReplacementsIsOuccered = CHECK("SELECT * FROM complaint_replacements where ComplaintActivityId='" . $Act->ComplaintActivityId . "'");
                                    if ($CheckStatusIfReplacementsIsOuccered != null) {
                                      $ReplaceSQL = "SELECT * FROM complaint_replacements where ComplaintActivityId='" . $Act->ComplaintActivityId . "'"; ?>
                                      <b>Replacement Details:</b><br>

                                      <span>
                                        <span class="text-grey">Serial No (OLD) : </span>
                                        <span class="bold"><?php echo FETCH($ReplaceSQL, "ComplaintReplacementOldBatteryNo"); ?></span>
                                      </span><br>

                                      <span>
                                        <span class="text-grey">Serial No (NEW) : </span>
                                        <span class="bold"><?php echo FETCH($ReplaceSQL, "ComplaintReplacementNewSerialNo"); ?></span>
                                      </span><br>

                                      <span>
                                        <span class="text-grey">Modal No (New) : </span>
                                        <span class="bold"><?php echo FETCH($ReplaceSQL, "ComplaintReplacementModal"); ?></span>
                                      </span><br>

                                      <span>
                                        <span class="text-grey">Capacity: </span>
                                        <span class="bold"><?php echo FETCH($ReplaceSQL, "ComplaintReplacementCapacity"); ?> AH</span>
                                      </span><br>

                                      <span>
                                        <span class="text-grey">Battery Life: </span>
                                        <span class="bold"><?php echo FETCH($ReplaceSQL, "ComplaintReplacementLife"); ?> AH</span>
                                      </span><br>

                                      <span>
                                        <span class="text-grey">MFG Date: </span>
                                        <span class="bold"><?php echo DATE_FORMATE2("d M, Y", FETCH($ReplaceSQL, "ComplaintReplacementMfgDate")); ?></span>
                                      </span><br>

                                      <span>
                                        <span class="text-grey">Warranty : </span>
                                        <span class="bold"><?php echo $WarrantyInMonths = FETCH($ReplaceSQL, "ComplaintReplacementWarrantyMonths"); ?> Months</span>
                                      </span><br>

                                      <span>
                                        <span class="text-grey">Purchase date : </span>
                                        <span class="bold"><?php echo DATE_FORMATE2("d M, Y", $PurchaseDate = FETCH($ReplaceSQL, "ComplaintReplcementPurchasedate")); ?></span>
                                      </span><br>

                                      <span>
                                        <span class="text-grey">Expire date : </span>
                                        <span class="bold">
                                          <?php
                                          $ExpireDate = date("Y-m-d", strtotime("+$WarrantyInMonths Months", strtotime($PurchaseDate)));
                                          echo DATE_FORMATE2("d M, Y", $ExpireDate);
                                          ?>
                                        </span>
                                      </span><br>

                                      <span>
                                        <span class="text-grey">Warranty Status : </span>
                                        <span class="bold">
                                          <?php
                                          if ($ExpireDate < Date("Y-m-d")) {
                                            echo "Expired!";
                                            UPDATE("UPDATE warranty_products SET WarrantyStatus='Expired' where WarrantyProductSno='" . FETCH($ReplaceSQL, "ComplaintReplacementNewSerialNo") . "'");
                                          } else {
                                            echo "Active";
                                          }
                                          ?>
                                        </span>
                                      </span><br>

                                      <span>
                                        <span class="text-grey">Replaced By : </span>
                                        <span class="bold"><?php echo FETCH("SELECT * FROM users where UserId='" . FETCH($ReplaceSQL, "ComplaintReplacementCreatedBy") . "'", "UserFullName"); ?> (USERID00<?php echo FETCH($ReplaceSQL, "ComplaintReplacementCreatedBy"); ?>)</span>
                                      </span><br>

                                      <br>
                                    <?php } ?>
                                    <h6 class="text-grey italic">By
                                      <?php echo FETCH("SELECT * FROM users where UserId='" . $Act->ComplaintActivityPerformedBy . "'", "UserFullName"); ?>
                                    </h6>
                                  </span>
                                </p>
                              </div>
                            <?php }
                          }
                          $CheckComplaintStatus = FETCH($ComplaintSql, "ComplaintStatus");
                          $ComplaintVerificationStatus = FETCH($ComplaintSql, "ComplaintVerificationStatus");
                          if ($CheckComplaintStatus != "COMPLETED") { ?>
                            <h3 style="font-size:1rem !important;" class="data-list text-warning mt-1 mb-1"><i class="fas fa-spinner fa-spin"></i> Complaint is in progress...</h3>
                          <?php } else { ?>
                            <h3 style="font-size:1rem !important;" class="data-list text-success mt-1 mb-1"><i class="fa fa-check-circle-0"></i> Complaint is Closed!...</h3>
                          <?php } ?>
                          <hr>
                          <div class="submitbox">
                            <?php if ($ComplaintVerificationStatus == "UN-VERIFIED" && LOGIN_UserType == "SERVICE_EXECUTIVE") { ?>
                              <h5 class="app-sub-heading mb-0">Verify Complaint</h5>

                              <form action="../../../controller/ComplaintController.php" method="POST">
                                <?php FormPrimaryInputs(true, [
                                  "ComplaintsId" => $ComplaintsId
                                ]); ?>
                                <div class="row">
                                  <div class="col-md-12">
                                    <p style="margin-top:0.5rem !important;">Enter OTP send on customer register phone number, or you can re send otp</p>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                    <input type="text" name="EnteredOTP" required="" class="form-control form-contol-md" placeholder="* * * * * *">
                                  </div>
                                  <div class="col-md-12">
                                    <button type="submit" name="VerifyComplaints" class="btn btn-md btn-success">Verify Complaint</button>
                                  </div>
                                </div>
                              </form>
                              <form class="mb-2" action="../../../controller/ComplaintController.php" method="POST">
                                <?php FormPrimaryInputs(true, [
                                  "ComplaintsId" => $ComplaintsId
                                ]); ?>
                                <div class="col-md-12">
                                  <button type="submit" name="SendOTPAgain" class="btn btn-md btn-default pull-right" style="margin-top: -2.3rem !important;">Send Again</button>
                                </div>
                              </form>
                              <?php } else {
                              if ($CheckComplaintStatus == "COMPLETED" && LOGIN_UserType == "SERVICE_EXECUTIVE") {
                              } else {
                              ?>
                                <form class="" action="../../../controller/ComplaintController.php" method="POST" enctype="multipart/form-data">
                                  <?php FormPrimaryInputs(true, [
                                    "ComplaintMainId" => $ComplaintsId,
                                  ]); ?>
                                  <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <div class="flex-s-b">
                                        <label class="p-2 mb-0 mr-1" for="uploadfeedback">
                                          <input type="file" id="uploadfeedback" hidden name="ComplaintActivityFile" class="form-control form-control-sm mb-0" accept="image/*">
                                          <i class="fa fa-image"></i>
                                        </label>
                                        <select name="update_type" onchange="ShowUpdateForms()" style="margin-bottom:0px !important;" class="form-control form-control-sm mb-0" id="UpdateType" onchange="Form.submit()">
                                          <option value="normalupdate">Normal Update</option>
                                          <?php if (LOGIN_UserType == "Admin") { ?>
                                            <option value="replacementform">Have Replacement</option>
                                          <?php } ?>
                                          <option value="completionform">Complaint Solved!</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div id="replacementform" style="display:none;">
                                        <div class="row">
                                          <div class="col-md-4 form-group">
                                            <label>Old Serial No</label>
                                            <input type="text" name="ComplaintReplacementOldBatteryNo" value="<?php echo FETCH($ComplaintSql, "ComplaintProductId"); ?>" class="form-control form-control-sm">
                                          </div>
                                          <div class="col-md-4 form-group">
                                            <label>New Serial No</label>
                                            <input type="text" name="ComplaintReplacementNewSerialNo" class="form-control form-control-sm">
                                          </div>
                                          <div class="col-md-4 form-group">
                                            <label>Mfg Date</label>
                                            <input type="date" value="<?php echo date("Y-m-d"); ?>" name="ComplaintReplacementMfgDate" class="form-control form-control-sm">
                                          </div>
                                          <div class="col-md-4 form-group">
                                            <label>Modal No</label>
                                            <input type="text" value="" list="ProductModalNo" name="ComplaintReplacementModal" class="form-control form-control-sm">
                                            <?php SUGGEST("products", "ProductModalNo", "ASC"); ?>
                                          </div>
                                          <div class="col-md-4 form-group">
                                            <label>Capacity</label>
                                            <input type="text" name="ComplaintReplacementCapacity" class="form-control form-control-sm">
                                          </div>
                                          <div class="col-md-4 form-group">
                                            <label>Life (in Years)</label>
                                            <input type="text" value="" name="ComplaintReplacementLife" class="form-control form-control-sm">
                                          </div>
                                          <div class="col-md-4 form-group">
                                            <label>Purchase date</label>
                                            <input type="date" readonly="" value="<?php echo date("Y-m-d"); ?>" name="ComplaintReplcementPurchasedate" class="form-control form-control-sm">
                                          </div>
                                          <div class="col-md-6 form-group">
                                            <label>Warranty in Months</label>
                                            <input type="number" name="ComplaintReplacementWarrantyMonths" class="form-control form-control-sm">
                                          </div>
                                          <div class="col-md-12 form-group">
                                            <label>More Descriptions</label>
                                            <textarea class="form-control form-control-sm" name="ComplaintReplacementDescriptions" rows="3"></textarea>
                                          </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                          <button type="submit" name="AddComplaintActivityRecord" class="btn btn-sm btn-success">Add Update</button>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div id="normalupdate">
                                        <textarea name="ComplaintActivityDescriptions" class="form-control form-control-sm" rows="2" placeholder="Add Description"></textarea>
                                        <button type="submit" name="AddComplaintActivityRecord" class="btn btn-sm btn-success" id="completebtn">Add Update</button>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                            <?php }
                            }
                            ?>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- end of activity -->
    </div>

    <script>
      function ShowUpdateForms() {
        var UpdateType = document.getElementById("UpdateType");
        var replacementform = document.getElementById("replacementform");
        var completionform = document.getElementById("completionform");
        var normalupdate = document.getElementById("normalupdate");

        if (UpdateType.value == "normalupdate") {
          replacementform.style.display = "none";
          normalupdate.style.display = "block";
          document.getElementById("completebtn").innerHTML = "Add Update";
        } else if (UpdateType.value == "replacementform") {
          replacementform.style.display = "block";
          normalupdate.style.display = "none";
          document.getElementById("completebtn").innerHTML = "Add Update";
        } else if (UpdateType.value == "completionform") {
          replacementform.style.display = "none";
          normalupdate.style.display = "block";
          document.getElementById("completebtn").innerHTML = "Update & Close Complaint"
        } else {
          replacementform.style.display = "none";
          normalupdate.style.display = "block";
          document.getElementById("completebtn").innerHTML = "Add Update";
        }
      }
    </script>
    <?php
    include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>