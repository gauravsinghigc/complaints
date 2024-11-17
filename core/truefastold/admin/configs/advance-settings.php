<?php
$Dir = "../../";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "Advance Settings";
$PageDescription = "Manage your application Advance Settings";

if (isset($_GET['PG_PROVIDER'])) {
  $PG_PROVIDER = $_GET['PG_PROVIDER'];
  $PG_MODE = FETCH("SELECT * FROM config_pgs where ConfigPgProvider='$PG_PROVIDER'", "ConfigPgMode");
  $MERCHENT_ID = FETCH("SELECT * FROM config_pgs where ConfigPgProvider='$PG_PROVIDER'", "ConfigPgMerchantId");
  $MERCHANT_KEY = FETCH("SELECT * FROM config_pgs where ConfigPgProvider='$PG_PROVIDER'", "ConfigPgMerchantKey");
} else {
  $PG_PROVIDER = PG_PROVIDER;
  $PG_MODE = PG_MODE;
  $MERCHENT_ID = MERCHENT_ID;
  $MERCHANT_KEY = MERCHANT_KEY;
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
      document.getElementById("configs").classList.add("active");
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
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL; ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL; ?>/configs/">System Profile</a></li>
        <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL; ?>/configs/advance-settings.php"><?php echo $PageName; ?></a></li>
      </ol>
      <h1 class="page-header"><?php echo $PageName; ?><small><?php echo $PageDescription; ?></small></h1>

      <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-6 col-12">
          <div class="shadow-lg br10 p-2">
            <h4 class="app-heading">Mailing Configurations</h4>
            <form class="form row" action="../../controller/configcontroller.php" method="POST">
              <?php FormPrimaryInputs(true); ?>
              <div class="form-group form-group-2 col-md-12">
                <label>Mail Function</label>
                <select name="CONTROL_MAILS" onchange="enablemails()" id="mailingstatus" class="form-control" required="">
                  <?php
                  $mailstatus = CONTROL_MAILS;
                  if ($mailstatus == "true") { ?>
                    <option value="false">Disabled</option>
                    <option value="true" selected="">Enabled</option>
                  <?php } else { ?>
                    <option value="false" selected="">Disabled</option>
                    <option value="true">Enabled</option>
                  <?php  } ?>

                </select>
              </div>
              <?php if ($mailstatus == "true") {
                $mailstatus = ""; ?>
              <?php } else {
                $mailstatus = "style='display:none;'";  ?>
              <?php } ?>
              <div id="showemailoptions" <?php echo $mailstatus; ?>>
                <div class="form-group form-group-2 col-md-12">
                  <label for="SENDER_MAIL_ID">Sender Mail-ID</label>
                  <input type="email" name="SENDER_MAIL_ID" value="<?php echo SENDER_MAIL_ID; ?>" class="form-control">
                </div>
                <div class="form-group form-group-2 col-md-12">
                  <label for="SENDER_MAIL_ID">Receiver Mail-ID</label>
                  <input type="email" name="RECEIVER_MAIL" value="<?php echo RECEIVER_MAIL; ?>" class="form-control">
                </div>
                <div class="form-group form-group-2 col-md-12">
                  <label for="SENDER_MAIL_ID">Customer Support Mail-ID</label>
                  <input type="email" name="SUPPORT_MAIL" value="<?php echo SUPPORT_MAIL; ?>" class="form-control">
                </div>
                <div class="form-group form-group-2 col-md-12">
                  <label for="SENDER_MAIL_ID">Enquiry Mail-ID</label>
                  <input type="email" name="ENQUIRY_MAIL" value="<?php echo ENQUIRY_MAIL; ?>" class="form-control">
                </div>
                <div class="form-group form-group-2 col-md-12">
                  <label for="SENDER_MAIL_ID">Admin Mail-ID</label>
                  <input type="email" name="ADMIN_MAIL" value="<?php echo ADMIN_MAIL; ?>" class="form-control">
                </div>
              </div>
              <div class="col-md-12 m-t-10">
                <button type="Submit" name="UpdateMailConfigs" class="btn btn-md btn-primary">Update Details</button>
              </div>
            </form>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
          <div class="shadow-lg br10 p-2">
            <h4 class="app-heading">Payment Gateway Setup</h4>
            <form action="" method="GET" class="row form">
              <div class="form-group form-group col-md-12">
                <label>Select Payment Gateway Provider</label>
                <select name="PG_PROVIDER" class="form-control" required="" onchange="form.submit()">
                  <?php foreach (PG_OPTIONS as $pgoptions) {
                    if (isset($_GET['PG_PROVIDER'])) {
                      if ($_GET['PG_PROVIDER'] == $pgoptions) {
                        $selected = "selected";
                      } else {
                        $selected = "";
                      }
                    } else {
                      if (PG_PROVIDER == $pgoptions) {
                        $selected = "selected";
                      } else {
                        $selected = "";
                      }
                    } ?>
                    <option value="<?php echo $pgoptions; ?>" <?php echo $selected; ?>><?php echo $pgoptions; ?></option>
                  <?php } ?>
                </select>
              </div>
            </form>
            <form class="form row" action="../../controller/configcontroller.php" method="POST">
              <?php if (isset($_GET['PG_PROVIDER'])) {
                $PG_PROVIDER = $_GET['PG_PROVIDER'];
              } else {
                $PG_PROVIDER = PG_PROVIDER;
              } ?>
              <input type="hidden" name="PG_PROVIDER" value="<?php echo $PG_PROVIDER; ?>">
              <?php FormPrimaryInputs(true); ?>
              <div class="form-group form-group-2 col-md-12">
                <label>Enable/Disable Online Payments</label>
                <select name="ONLINE_PAYMENT_OPTION" onchange="enablepaymentgateway()" id="pgstatus" class="form-control" required="">
                  <?php
                  $pgstatus = ONLINE_PAYMENT_OPTION;
                  if ($pgstatus == "true") { ?>
                    <option value="false">Disabled</option>
                    <option value="true" selected="">Enabled</option>
                  <?php } else { ?>
                    <option value="false" selected="">Disabled</option>
                    <option value="true">Enabled</option>
                  <?php  } ?>

                </select>
              </div>
              <?php if ($pgstatus == "true") {
                $pgstatus = ""; ?>
              <?php } else {
                $pgstatus = "style='display:none;'";  ?>
              <?php } ?>
              <div id="pgoptions" <?php echo $pgstatus; ?>>
                <div class="form-group form-group-2 col-md-12">
                  <label for="PG_MODE">PG Mode <small><i class="fa fa-angle-right"></i> eg: prod, test, dev, live</small></label>
                  <input type="text" name="PG_MODE" value="<?php echo $PG_MODE; ?>" class="form-control text-uppercase">
                </div>
                <div class="form-group form-group-2 col-md-12">
                  <label for="MERCHENT_ID">Merchant ID</label>
                  <input type="text" name="MERCHENT_ID" value="<?php echo $MERCHENT_ID; ?>" class="form-control">
                </div>
                <div class="form-group form-group-2 col-md-12">
                  <label for="MERCHANT_KEY">Merchant Key</label>
                  <input type="text" name="MERCHANT_KEY" value="<?php echo $MERCHANT_KEY; ?>" class="form-control">
                </div>
              </div>
              <div class="col-md-12 m-t-10">
                <button type="Submit" name="UpdatePgDetails" class="btn btn-md btn-primary">Update Details</button>
              </div>
            </form>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
          <div class="shadow-lg br10 p-2">
            <h4 class="app-heading">Enable & Disable features</h4>
            <form class="form row" action="../../controller/configcontroller.php" method="POST">
              <?php FormPrimaryInputs(true); ?>
              <div class="form-group form-group-2 col-md-12">
                <label>Work Environment</label>
                <?php if (CONTROL_WORK_ENV == "PROD") { ?>
                  <div class="flex-s-b">
                    <span>
                      <input type="radio" name="CONTROL_WORK_ENV" Value="PROD" checked=""> <span class="fs-17">Production</span>
                    </span>
                    <span>
                      <input type="radio" name="CONTROL_WORK_ENV" Value="DEV"> <span class="fs-17">Development</span>
                    </span>
                  </div>
                <?php } else { ?>
                  <div class="flex-s-b">
                    <span>
                      <input type="radio" name="CONTROL_WORK_ENV" Value="PROD"> <span class="fs-17">Production</span>
                    </span>
                    <span>
                      <input type="radio" name="CONTROL_WORK_ENV" Value="DEV" checked=""> <span class="fs-17">Development</span>
                    </span>
                  </div>
                <?php } ?>
              </div>
              <div class="form-group form-group-2 col-md-12">
                <label>Desktop Notifications</label>
                <?php if (CONTROL_NOTIFICATION == "true") { ?>
                  <div class="flex-s-b">
                    <span>
                      <input type="radio" name="CONTROL_NOTIFICATION" Value="true" checked=""> <span class="fs-17">Enable</span>
                    </span>
                    <span>
                      <input type="radio" name="CONTROL_NOTIFICATION" Value="false"> <span class="fs-17">Disabled</span>
                    </span>
                  </div>
                <?php } else { ?>
                  <div class="flex-s-b">
                    <span>
                      <input type="radio" name="CONTROL_NOTIFICATION" Value="true"> <span class="fs-17">Enable</span>
                    </span>
                    <span>
                      <input type="radio" name="CONTROL_NOTIFICATION" Value="false" checked=""> <span class="fs-17">Disabled</span>
                    </span>
                  </div>
                <?php } ?>
              </div>
              <div class="form-group form-group-2 col-md-12">
                <label>Desktop Notifications Sound</label>
                <?php if (CONTROL_NOTIFICATION_SOUND == "true") { ?>
                  <div class="flex-s-b">
                    <span>
                      <input type="radio" name="CONTROL_NOTIFICATION_SOUND" Value="true" checked=""> <span class="fs-17">Enable</span>
                    </span>
                    <span>
                      <input type="radio" name="CONTROL_NOTIFICATION_SOUND" Value="false"> <span class="fs-17">Disabled</span>
                    </span>
                  </div>
                <?php } else { ?>
                  <div class="flex-s-b">
                    <span>
                      <input type="radio" name="CONTROL_NOTIFICATION_SOUND" Value="true"> <span class="fs-17">Enable</span>
                    </span>
                    <span>
                      <input type="radio" name="CONTROL_NOTIFICATION_SOUND" Value="false" checked=""> <span class="fs-17">Disabled</span>
                    </span>
                  </div>
                <?php } ?>
              </div>
              <div class="form-group form-group-2 col-md-12">
                <label>Alert Display Time (eg: 2000 for 2sec)</label>
                <input type="number" name="CONTROL_MSG_DISPLAY_TIME" class="form-control" required="" value="<?php echo CONTROL_MSG_DISPLAY_TIME; ?>">
              </div>
              <div class="form-group form-group-2 col-md-12">
                <label>Activity Logs</label>
                <?php if (CONTROL_APP_LOGS == "true") { ?>
                  <div class="flex-s-b">
                    <span>
                      <input type="radio" name="CONTROL_APP_LOGS" Value="true" checked=""> <span class="fs-17">Enable</span>
                    </span>
                    <span>
                      <input type="radio" name="CONTROL_APP_LOGS" Value="false"> <span class="fs-17">Disabled</span>
                    </span>
                  </div>
                <?php } else { ?>
                  <div class="flex-s-b">
                    <span>
                      <input type="radio" name="CONTROL_APP_LOGS" Value="true"> <span class="fs-17">Enable</span>
                    </span>
                    <span>
                      <input type="radio" name="CONTROL_APP_LOGS" Value="false" checked=""> <span class="fs-17">Disabled</span>
                    </span>
                  </div>
                <?php } ?>
              </div>
              <div class="form-group form-group-2 col-md-12">
                <label>Website Status</label>
                <?php if (WEBSITE == "true") { ?>
                  <div class="flex-s-b">
                    <span>
                      <input type="radio" name="WEBSITE" Value="true" checked=""> <span class="fs-17">Live</span>
                    </span>
                    <span>
                      <input type="radio" name="WEBSITE" Value="false"> <span class="fs-17">Coming Soon</span>
                    </span>
                  </div>
                <?php } else { ?>
                  <div class="flex-s-b">
                    <span>
                      <input type="radio" name="WEBSITE" Value="true"> <span class="fs-17">Live</span>
                    </span>
                    <span>
                      <input type="radio" name="WEBSITE" Value="false" checked=""> <span class="fs-17">Coming Soon</span>
                    </span>
                  </div>
                <?php } ?>
              </div>
              <div class="form-group form-group-2 col-md-12">
                <label>Mobile App Status</label>
                <?php if (WEBSITE == "true") { ?>
                  <div class="flex-s-b">
                    <span>
                      <input type="radio" name="APP" Value="true" checked=""> <span class="fs-17">Live</span>
                    </span>
                    <span>
                      <input type="radio" name="APP" Value="false"> <span class="fs-17">Coming Soon</span>
                    </span>
                  </div>
                <?php } else { ?>
                  <div class="flex-s-b">
                    <span>
                      <input type="radio" name="APP" Value="true"> <span class="fs-17">Live</span>
                    </span>
                    <span>
                      <input type="radio" name="APP" Value="false" checked=""> <span class="fs-17">Coming Soon</span>
                    </span>
                  </div>
                <?php } ?>
              </div>
              <div class="col-md-12 m-t-10">
                <button type="Submit" name="UpdateFeatures" class="btn btn-md btn-primary">Update Details</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php include $Dir . "/include/admin/footer.php"; ?>

    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
  </div>
  <script>
    function enablemails() {
      var mailingstatus = document.getElementById("mailingstatus");
      if (mailingstatus.value == "true") {
        document.getElementById("showemailoptions").style.display = "block";
      } else {
        document.getElementById("showemailoptions").style.display = "none";
      }
    }
  </script>
  <script>
    function enablepaymentgateway() {
      var pgstatus = document.getElementById("pgstatus");
      if (pgstatus.value == "true") {
        document.getElementById("pgoptions").style.display = "block";
      } else {
        document.getElementById("pgoptions").style.display = "none";
      }
    }
  </script>
  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>