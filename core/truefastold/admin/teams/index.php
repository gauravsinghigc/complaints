<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Team Members";
$PageDescription = "Manage teams";
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
      document.getElementById("teams").classList.add("active");
    }
    window.onload = SidebarActive;
  </script>
</head>

<body class='pace-top'>
  <?php include $Dir . "/include/admin/loader.php"; ?>

  <div id="app" class="app app-content-full-height app-header-fixed app-sidebar-fixed">
    <?php
    include $Dir . "/include/admin/header.php";
    include $Dir . "/include/admin/sidebar.php"; ?>


    <div id="content" class="app-content">

      <div class="d-flex align-items-center mb-1">
        <div>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;"><?php echo $PageName; ?></a></li>
          </ol>
          <h1 class="page-header mb-0"><?php echo $PageName; ?></h1>
        </div>
        <div class="ms-auto">
          <a href="add.php" class="btn btn-success btn-rounded px-4 rounded-pill"><i class="fa fa-plus fa-lg me-2 ms-n2 text-white"></i> Add Team Member</a>
        </div>
      </div>

      <div class="mb-3 d-sm-flex fw-bold">
        <div class="mt-sm-0 mt-2">
          <a href="export.php" class="text-dark text-decoration-none"><i class="fa fa-download fa-fw me-1 text-dark text-opacity-50"></i> Export</a>
        </div>
        <div class="ms-sm-4 ps-sm-1 mt-sm-0 mt-2">
          <a href="import.php" class="text-dark text-decoration-none"><i class="fa fa-upload fa-fw me-1 text-dark text-opacity-50"></i> Import</a>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <p class="flex-s-b bg-black p-1 mb-1 text-white shadow-sm rounded-1">
            <span class="w-pr-3"><b>SNo</b></span>
            <span class="w-pr-16"><b>FullName</b></span>
            <span class="w-pr-17"><b>CompanyName</b></span>
            <span class="w-pr-12"><b>PhoneNumber</b></span>
            <span class="w-pr-18"><b>EmailId</b></span>
            <span class="w-pr-12"><b>Designation</b></span>
            <span class="w-pr-10"><b>DateOfBirth</b></span>
            <span class="w-pr-7"><b>CreatedAt</b></span>
            <span class="w-pr-5"><b>Status</b></span>
          </p>
        </div>
        <?php
        $AllCustomers = FetchConvertIntoArray("SELECT * FROM users where UserType='TeamMember' or UserType='Admin' or UserType='SERVICE_EXECUTIVE' ORDER BY UserId Desc", true);
        if ($AllCustomers != null) {
          $Sno = 0;
          foreach ($AllCustomers as $Customers) {
            $Sno++;
            include "../../include/admin/common/user-list.php";
          }
        }
        ?>
      </div>

    </div>
    <?php include $Dir . "/include/admin/footer.php"; ?>
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
  </div>
  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>