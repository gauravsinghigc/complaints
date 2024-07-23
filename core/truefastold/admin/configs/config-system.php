<?php
$Dir = "../../";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "System Configurations";
$PageDescription = "";
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
      document.getElementById("configs_apps").classList.add("active");
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
        <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL; ?>/configs/"><?php echo $PageName; ?></a></li>
      </ol>


      <h1 class="page-header"><?php echo $PageName; ?><small><?php echo $PageDescription; ?></small>
      </h1>
      <div class="row">
        <div class="col-md-4">
          <h4 class="app-heading">Available Configurations</h4>
          <form action="<?php echo CONTROLLER('configcontroller'); ?>" method='POST' class="mb-5px">
            <?php FormPrimaryInputs(true); ?>
            <div class="flex-s-b">
              <div class="form-group w-75">
                <input type="text" name="ConfigSystemName" placeholder="Configuration Group name" class="form-control" required="">
              </div>
              <button type="submit" name="SaveConfigSystemName" class="btn btn-md btn-success mt-0 mb-0">Save</button>
            </div>
          </form>
          <ul class="config-menu">
            <?php $SysConfigs = FetchConvertIntoArray("SELECT * FROM config_system", true);
            if ($SysConfigs != null) {
              foreach ($SysConfigs as $Configs) {
                if (isset($_GET['view'])) {
                  $view = SECURE($_GET['view'], "d");
                  if ($view == $Configs->ConfigSystemId) {
                    $selected = "active";
                  } else {
                    $selected = "";
                  }
                } else {
                  $selected = "";
                } ?>
                <li>
                  <a href="?view=<?php echo SECURE($Configs->ConfigSystemId, "e"); ?>" class="<?php echo $selected; ?>"><?php echo $Configs->ConfigSystemName; ?> <i class="fa fa-angle-right"></i></a>
                </li>
              <?php }
            } else {
              ?>
              <li>
                <a href="#" class="">Now Configuration Found! <i class="fa fa-angle-right"></i></a>
              </li>
            <?php
            } ?>
          </ul>
        </div>

        <div class="col-md-8">
          <h4 class="app-heading">Configuration Details</h4>
          <form action="<?php echo CONTROLLER("configcontroller"); ?>" method="POST" enctype="multipart/form-data">
            <?php FormPrimaryInputs(true); ?>
            <div class="row">
              <div class="col-md-4">
                <label>Config Name</label>
                <select class="form-control" name="ConfigSystemMainId">
                  <?php $ConfigSystemId = IfRequested("GET", "view", true); ?>
                  <?php $SysConfigs = FetchConvertIntoArray("SELECT * FROM config_system", true);
                  if ($SysConfigs != null) {
                    foreach ($SysConfigs as $Configs) {
                      if (isset($_GET['view'])) {
                        $view = SECURE($_GET['view'], "d");
                        if ($view == $Configs->ConfigSystemId) {
                          $selected = "selected";
                        } else {
                          $selected = "";
                        }
                      } else {
                        $selected = "";
                      } ?>
                      <option value="<?php echo $Configs->ConfigSystemId; ?>" <?php echo $selected; ?>><?php echo $Configs->ConfigSystemName; ?></option>
                  <?php }
                  } ?>
                </select>
              </div>
              <div class="col-md-4">
                <label>Required Value Type</label>
                <select name="ConfigSystemValueType" onchange="EnterConfigValue()" id="inputtypes" class="form-control">
                  <?php InputOptions(INPUT_TYPES, "text"); ?>
                </select>
              </div>
              <div class="col-md-4">
                <label>Data/Field Name</label>
                <input type="text" name="ConfigSystemName" list="ConfigSystemName" class="form-control" required="">
                <?php SUGGEST("config_system_values", "ConfigSystemName", "ASC"); ?>
              </div>
              <div class=" col-md-12 form-group">
                <label>Enter Value</label>
                <input type="text" name="ConfigSystemValue" id="enter_value" class="form-control" placeholder="">
                <textarea class="form-control" style="display:none;" name="ConfigSystemValueTextArea" id="textarea" rows="4"></textarea>
              </div>

              <div class="col-md-12">
                <button type="submit" name="SaveConfigValues" class="btn btn-md btn-primary">Save Details</button>
              </div>
            </div>
          </form>
          <h5 class="app-sub-heading">Update Configuration Values</h5>
          <?php
          if (isset($_GET['view'])) {
            $ConfigSystemId = SECURE($_GET['view'], "d");
            $ViewSql = "SELECT * FROM config_system, config_system_values where config_system.ConfigSystemId=config_system_values.ConfigSystemMainId and ConfigSystemId='$ConfigSystemId'";
          } else {
            $ViewSql = "SELECT * FROM config_system, config_system_values where config_system.ConfigSystemId=config_system_values.ConfigSystemMainId";
          }
          $FetchDetails = FetchConvertIntoArray($ViewSql, true);
          if ($FetchDetails == null) {
            NoData("No Configuration Found!");
          } else {
            foreach ($FetchDetails as $Configs) { ?>
              <p class="data-list">Hello</p>
          <?php
            }
          } ?>
        </div>
      </div>
    </div>

    <script>
      function EnterConfigValue() {
        var inputtypes = document.getElementById("inputtypes");
        var enter_value = document.getElementById("enter_value");
        var textarea = document.getElementById("textarea");

        if (inputtypes.value == "textarea") {
          enter_value.style.display = "none";
          textarea.style.display = "";
          textarea.placeholder = "Enter description";
        } else {
          enter_value.style.display = "";
          textarea.style.display = "none";
          enter_value.type = inputtypes.value;
          enter_value.placeholder = "Enter " + inputtypes.value;
        }
      }
    </script>
    <?php include $Dir . "/include/admin/footer.php"; ?>
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>