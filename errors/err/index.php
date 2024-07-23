<?php
//include required files here
require '../../require/modules.php';
require '../../require/web-modules.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Invalid Request | <?php echo APP_NAME; ?></title>
 <?php include '../../include/web/header_files.php'; ?>
</head>

<body class="p-1" style="background-color: #f9f9f9 !important;">
 <section class="container-fluid section">
  <div class="row">
   <div class="col-md-12">
    <h1 class="text-danger fs-100">
     <img style="width: 25% !important;" src="<?php echo STORAGE_URL_D; ?>/tool-img/wrong.gif" class="w-pr-20" title="<?php echo APP_NAME; ?>" alt="<?php echo APP_NAME; ?>">
    </h1>
    <h3 class="m-t-0">Invalid Data Access Requested</h3>
    <p>the request data is trying to access in a incorrect way or having below reasons.</p>
    <ul style="list-style-type: circle;" class="p-l-25">
     <li>Incorrect inialization of request variable.</li>
     <li>Incorrect inialization of request function.</li>
     <li>Incorrect MySQL syntax.</li>
     <li>Request data result in null value.</li>
     <li>incomplete codes.</li>
    </ul>
    <hr>
    <a href="<?php echo $_SESSION['BACK_TO_LAST_PAGE']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-angle-left"></i> Re Request</a>
    <a href="<?php echo DOMAIN; ?>" class="btn btn-sm btn-success"> Skip Request <i class="fa fa-angle-right"></i></a>

   </div>
  </div>
 </section>
 <?php include '../../include/web/footer_files.php'; ?>
</body>

</html>