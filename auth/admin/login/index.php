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
    <title><?php echo APP_NAME; ?> | Login</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <?php include "../../../include/admin/header_files.php"; ?>
</head>

<body class="hold-transition login-page" style="background-image:url('<?php echo LOGIN_BG_IMAGE; ?>');background-size:cover;background-repeat:no-repeat;">
    <div class="login-box">

        <div class="card">
            <div class="card-header text-center">
                <img src="<?php echo MAIN_LOGO; ?>" class="img-fluid w-50"><br>
                <br>
                <a href="<?php echo DOMAIN; ?>" class="h5"><i class="fa fa-lock text-success"></i> Login to Account </a>
            </div>
            <div class="card-body">
                <form action="<?php echo CONTROLLER; ?>/authcontroller.php" method="POST" class="fs-13px">
                    <?php FormPrimaryInputs(true); ?>
                    <div class="form-group mb-15px">
                        <label for="emailAddress" class="fs-13px text-gray-600">Email Address</label>
                        <input type="email" class="form-control h-40px fs-13px" name="UserEmailId" placeholder="Email Address" id="emailAddress" />
                    </div>
                    <div class="form-group mb-15px">
                        <label for="password" class="fs-13px text-gray-600">Password</label>
                        <input type="password" name="UserPassword" class="form-control h-40px fs-13px" placeholder="Password" id="password" />
                    </div>
                    <div class="mb-10px text-dark">
                        Forget Password? <a href="<?php echo DOMAIN; ?>/auth/admin/forget/">Recover Password</a>
                    </div>
                    <div class="mb-15px">
                        <button type="submit" name="LoginRequest" class="btn btn-dark d-block h-45px w-100 btn-lg fs-14px"><i class="fa fa-lock text-white"></i> Secured Login</button>
                    </div>
                    <hr class="bg-gray-600 opacity-2 mt-50px" />
                    <?php include "../../../include/admin/login-footer.php"; ?>
                </form>
            </div>

        </div>

    </div>
    <?php include "../../../include/admin/footer_files.php"; ?>
</body>

</html>