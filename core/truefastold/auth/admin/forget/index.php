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
    <link href="<?php echo ASSETS_URL; ?>/admin/css/default/app.min.css" rel="stylesheet" />
</head>

<body class='pace-top'>
    <?php include "../../../include/admin/loader.php"; ?>

    <div id="app" class="app">

        <div class="login login-with-news-feed">

            <div class="news-feed">
                <div class="news-image" style="background-image: url('<?php echo LOGIN_BG_IMAGE; ?>')"></div>
                <div class="news-caption">
                    <h4 class="caption-title"><?php echo APP_NAME; ?></h4>
                    <p>
                        <?php echo SECURE(SHORT_DESCRIPTION, "d"); ?>
                    </p>
                </div>
            </div>


            <div class="login-container">

                <div class="login-header mb-30px">
                    <div class="brand">
                        <div class="d-flex align-items-center">
                            <span class="login-logo">
                                <img src="<?php echo MAIN_LOGO; ?>" class="img-fluid">
                            </span>
                            <span>
                                <?php echo APP_NAME; ?>
                            </span>
                        </div>
                    </div>
                </div>


                <div class="login-content">
                    <h4><i class="fa fa-lock text-success"></i> Recover Your Password</h4>
                    <hr>
                    <form action="<?php echo CONTROLLER; ?>/authcontroller.php" method="POST" class="fs-13px">
                        <?php FormPrimaryInputs(true); ?>
                        <p>Enter your registered email id, we will sent a password reset link on it. You can change password by using that link.</p>

                        <div class="form-floating mb-15px">
                            <input type="text" class="form-control h-40px fs-13px" name="UserEmailId" placeholder="Email Address" id="emailAddress" />
                            <label for="emailAddress" class="d-flex align-items-center fs-13px text-gray-600">Email Address</label>
                        </div>
                        <div class="mb-10px text-dark">
                            <a href="<?php echo DOMAIN; ?>/auth/admin/login/">Know Password, Login?</a>
                            <br>
                        </div>
                        <div class="mb-15px mt-10">
                            <button type="submit" name="SearchAccountForPasswordReset" class="btn btn-success d-block h-45px w-100 btn-lg fs-14px"><i class="fa fa-search text-white"></i> Search Account</button>
                        </div>
                        <hr class="bg-gray-600 opacity-2 mt-50px" />
                        <?php include "../../../include/admin/login-footer.php"; ?>
                    </form>
                </div>

            </div>

        </div>

        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>

    </div>

    <?php include "../../../include/admin/footer_files.php"; ?>
</body>

</html>