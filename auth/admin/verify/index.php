<?php
require '../../../require/modules.php';
require '../../../require/admin/sessionvariables.php';

if (isset($_SESSION['LOGIN_USER_ID'])) {
    LOCATION("info", "Welcome User, You are login in successfully!", DOMAIN . "/admin/index.php");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo APP_NAME; ?> | Forget</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <?php include "../../../include/admin/header_files.php"; ?>
</head>

<body class="hold-transition login-page" style="background-image:url('<?php echo LOGIN_BG_IMAGE; ?>');background-size:cover;background-repeat:no-repeat;">
    <div class="login-box">

      <div class="card">
          <div class="card-header text-center">
              <img src="<?php echo MAIN_LOGO; ?>" class="img-fluid w-50"><br>
              <br>
                <a href="<?php echo DOMAIN; ?>" class="h5">Verify Your Account!</a>
            </div>
            <div class="card-body">
                <h4><i class="fa fa-check-circle-o text-success"></i> Password Reset Link Sent!</h4>
                <hr>
                <p> Password Reset Link is sent successfully on submitted email id <b><?php echo $_SESSION['REQUESTED_EMAIL']; ?></b>. Change your password by following that link.</p>

                <a href="<?php echo DOMAIN; ?>/admin" class="btn btn-block btn-dark">Back to Login</a>
            </div>

        </div>

    </div>
    <?php include "../../../include/admin/footer_files.php"; ?>
</body>

</html>
