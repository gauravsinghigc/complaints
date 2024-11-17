<?php
//required files added
require '../require/modules.php';
if (WEBSITE == "true") {
 header("location: " . DOMAIN . "/");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Coming Soon | <?php echo APP_NAME; ?></title>
 <?php include '../include/admin/header_files.php'; ?>
</head>

<body>
 <center>
  <img src="<?php echo $ComingSoonImage; ?>" style="width:20%;">
  <br>
  <img src="<?php echo MAIN_LOGO; ?>" style="width:15%;border-radius:5rem;">
  <h1 class="bold"><?php echo APP_NAME; ?> is on the way!</h1>
  <h2>Our Webstore is coming soon, we will update you when it is live for for you.</h2>
 </center>

 <center>
  <hr class="w-50">
  <h4 class="text-primary">Have an query, suggestions & feedback?</h4>
  <p class="shadow-lg br10 w-50 bg-light-gray p-1">
   <span class="fs-16"><?php echo APP_NAME; ?> </span><br> <i class="fa fa-phone text-info"></i> <?php echo PRIMARY_PHONE; ?> <br> <i class="fa fa-envelope text-primary"></i> <?php echo PRIMARY_EMAIL; ?> <br> <i class="fa fa-map-marker text-success"></i> <?php echo SECURE(PRIMARY_ADDRESS, "d"); ?>
  </p>
 </center>
 <center>
  <a href="<?php echo DOMAIN; ?>/admin/"><i class="fa fa-lock text-success"></i> Admin Login</a>
 </center>
 <?php include '../include/admin/footer.php'; ?>
 <?php include '../include/admin/footer_files.php'; ?>

</body>

</html>