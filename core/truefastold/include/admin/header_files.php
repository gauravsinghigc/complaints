<link rel="shortcut icon" href="<?php echo MAIN_LOGO; ?>">
<link href="<?php echo ASSETS_URL; ?>/admin/css/vendor.min.css" rel="stylesheet" />
<link href="<?php echo ASSETS_URL; ?>/admin/css/app.css" rel="stylesheet" />
<link href="<?php echo ASSETS_URL; ?>/admin/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
<link href="<?php echo ASSETS_URL; ?>/admin/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="<?php echo ASSETS_URL; ?>/admin/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
<link href="<?php echo ASSETS_URL; ?>/admin/plugins/simple-calendar/dist/simple-calendar.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="<?php echo ASSETS_URL; ?>/admin/js/textarea.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<?php
if (isset($_GET['theme'])) {
 $theme = strtolower($_GET['theme']);
 $_SESSION['theme'] = $theme;
} elseif (isset($_SESSION['theme'])) {
 $theme = strtolower($_SESSION['theme']);
} else {
 $theme = strtolower(APP_THEME);
} ?>
<link href="<?php echo ASSETS_URL; ?>/admin/css/<?php echo $theme; ?>/app.min.css" rel="stylesheet" />
<script>
 tinymce.init({
  selector: 'textarea.editor',
  menubar: false
 });
</script>