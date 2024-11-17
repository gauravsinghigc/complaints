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
    <title><?php echo APP_NAME; ?> | Reset</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <?php include "../../../include/admin/header_files.php"; ?>
</head>

<body class="hold-transition login-page" style="background-image:url('<?php echo LOGIN_BG_IMAGE; ?>');background-size:cover;background-repeat:no-repeat;">
    <div class="login-box">

      <div class="card">
          <div class="card-header text-center">
              <img src="<?php echo MAIN_LOGO; ?>" class="img-fluid w-50"><br>
              <br>
                <a href="<?php echo DOMAIN; ?>" class="h5">Reset Your Password</a>
            </div>
            <div class="card-body">
                <?php if (isset($_GET['token'])) {
                    $ReceivedToken = $_GET['token'];
                    $for = SECURE($_GET['for'], "d");
                    $UserIdForPasswordChange = FETCH("SELECT * from users where UserEmailId='$for'", "UserId");
                    $RequiredToken = CHECK("SELECT * FROM user_password_change_requests where PasswordChangeToken='$ReceivedToken' and UserIdForPasswordChange='$UserIdForPasswordChange'");
                    $PasswordChangeTokenExpireTime = FETCH("SELECT * FROM user_password_change_requests where PasswordChangeToken='$ReceivedToken' and UserIdForPasswordChange='$UserIdForPasswordChange'", "PasswordChangeTokenExpireTime");
                    $PasswordChangeTokenExpireTime = date("d-m-y h:i", strtotime($PasswordChangeTokenExpireTime));
                    $CurrentDateTime = date("d-m-y h:i");
                    $_SESSION['SUBMITTED_PASSWORD_RESET_TOKEN'] = $RequiredToken;
                    $_SESSION['REQUESTED_EMAIL_ID'] = $for;

                    if ($CurrentDateTime <= $PasswordChangeTokenExpireTime) {
                        if ($RequiredToken == $ReceivedToken) { ?>
                            <form role="form" action="../../../controller/authcontroller.php" method="POST">
                                <?php FormPrimaryInputs($url = RUNNING_URL); ?>
                                <div class="form-group">
                                    <label for="inputUsernameEmail">New Password</label>
                                    <input type="password" name="Password1" value="" id="Pass1" required="" class="form-control outline-danger">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="inputUsernameEmail">Re-Enter New Password</label>
                                    <input type="password" name="Password2" id="Pass2" value="" required="" class="form-control" oninput="CheckPassMatch()">
                                </div>
                                <br>
                                <button type="submit" name="RequestForPasswordChange" class="btn btn btn-dark btn-md p-2 fs-18">
                                    <i class="fa fa-edit fs-18 text-white"></i> Change Password
                                </button>
                            </form>
                        <?php } else {
                            $PasswordChangeRequestStatus = "Expired";
                            $PasswordChangeToken = $RequiredToken;
                            $Update = UPDATE_TABLE("user_password_change_requests", ["PasswordChangeRequestStatus"], "PasswordChangeToken='$PasswordChangeToken' and UserIdForPasswordChange='$UserIdForPasswordChange'"); ?>
                            <h4>Sorry! Token Expired</h4>
                            <p>Password link is expired. Please re create link or re-send password change request!</p>
                            <a href="<?php echo DOMAIN; ?>/auth/admin/forget/">Password Reset</a><br>
                            <a href="<?php echo DOMAIN; ?>/auth/admin/login">Back to Login</a>
                        <?php }
                    } else {
                        $PasswordChangeRequestStatus = "Expired";
                        $PasswordChangeToken = $RequiredToken;
                        $Update = UPDATE_TABLE("user_password_change_requests", ["PasswordChangeRequestStatus"], "PasswordChangeToken='$PasswordChangeToken' and UserIdForPasswordChange='$UserIdForPasswordChange'");
                        ?>
                        <h4><i class="fa fa-warning text-danger"></i> Token Expired</h4>
                        <p>Received Password change token is not valid or may be epxired. You have to create new one by following below links.</p>
                        <a href="<?php echo DOMAIN; ?>/auth/admin/forget/">Password Reset</a><br>
                        <a href="<?php echo DOMAIN; ?>/auth/admin/login">Back to Login</a>
                    <?php }
                } else { ?>
                    <h5><b>Ooopsss......</b></h5>
                    <p>Password reset access token are missing. Please check the link it may be broken or incorrect.</p>
                    <p>You can also generate password reset link again. </p>
                    <a href="<?php echo DOMAIN; ?>/auth/admin/forget/">Password Reset</a><br>
                    <a href="<?php echo DOMAIN; ?>/auth/admin/login">Back to Login</a>
                <?php } ?>
                <script>
                    function CheckPassMatch() {
                        var Pass1 = document.getElementById("Pass1").value;
                        var Pass2 = document.getElementById("Pass2").value;
                        if (Pass1 != Pass2) {
                            document.getElementById("msg1").innerHTML = "<span class='text-danger'><i class='fa fa-warning'></i> Password Mismatch</span>";
                            document.getElementById("msg2").innerHTML = "<span class='text-danger'><i class='fa fa-warning'></i> Password Mismatch</span>";
                            document.getElementById("Pass1").style.borderColor = "red";
                            document.getElementById("Pass2").style.borderColor = "red";
                            document.getElementById("Pass1").style.backgroundColor = "rgba(255, 0, 0, 0.1)";
                            document.getElementById("Pass2").style.backgroundColor = "rgba(255, 0, 0, 0.1)";
                            document.getElementById("Pass1").style.color = "red";
                            document.getElementById("Pass2").style.color = "red";
                            document.getElementById("Pass1").style.boxShadow = "0 0 0 0.2rem rgba(255, 0, 0, 0.5)";
                            document.getElementById("Pass2").style.boxShadow = "0 0 0 0.2rem rgba(255, 0, 0, 0.5)";
                            document.getElementById("Pass1").style.transition = "0.5s";
                            document.getElementById("Pass2").style.transition = "0.5s";
                            document.getElementById("Pass1").style.borderRadius = "0.25rem";
                            document.getElementById("Pass2").style.borderRadius = "0.25rem";
                            document.getElementById("Pass1").style.fontSize = "1rem";
                            document.getElementById("btn").classList.add("disabled");
                        } else {
                            document.getElementById("msg1").innerHTML = "";
                            document.getElementById("msg2").innerHTML = "";
                            document.getElementById("Pass1").style.borderColor = "green";
                            document.getElementById("Pass2").style.borderColor = "green";
                            document.getElementById("Pass1").style.backgroundColor = "rgba(0, 255, 0, 0.1)";
                            document.getElementById("Pass2").style.backgroundColor = "rgba(0, 255, 0, 0.1)";
                            document.getElementById("Pass1").style.color = "green";
                            document.getElementById("Pass2").style.color = "green";
                            document.getElementById("Pass1").style.boxShadow = "0 0 0 0.2rem rgba(0, 255, 0, 0.5)";
                            document.getElementById("Pass2").style.boxShadow = "0 0 0 0.2rem rgba(0, 255, 0, 0.5)";
                            document.getElementById("Pass1").style.transition = "0.5s";
                            document.getElementById("Pass2").style.transition = "0.5s";
                            document.getElementById("Pass1").style.borderRadius = "0.25rem";
                            document.getElementById("Pass2").style.borderRadius = "0.25rem";
                            document.getElementById("Pass1").style.fontSize = "1rem";
                            document.getElementById("btn").classList.remove("disabled");
                        }
                    }
                </script>
            </div>

        </div>

    </div>
    <?php include "../../../include/admin/footer_files.php"; ?>
</body>

</html>
