<?php
$Dir = "../../";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "Theme Settings";
$PageDescription = "Manage your application theme";
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
    <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL; ?>/configs/theme.php"><?php echo $PageName; ?></a></li>
   </ol>
   <h1 class="page-header"><?php echo $PageName; ?><small><?php echo $PageDescription; ?></small></h1>

   <div class="row">
    <div class="col-lg-12">
     <div class="change-app-theme">
      <div class="row">
       <?php foreach (THEME_OPTION as $Theme_option) {
        if ($theme == strtolower($Theme_option)) {
         $active = "active";
        } else {
         $active = "";
        } ?>
        <div class="col-lg-2 col-md-3 col-4 theme-list <?php echo $active; ?>">
         <a href="?theme=<?php echo $Theme_option; ?>">
          <img src="<?php echo STORAGE_URL; ?>/theme/<?php echo $Theme_option; ?>.png" class="theme-img">
          <p><?php echo $Theme_option; ?></p>
         </a>
        </div>
       <?php } ?>
      </div>
     </div>
    </div>
   </div>

  </div>

  <?php include $Dir . "/include/admin/footer.php"; ?>

  <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
 </div>

 <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>