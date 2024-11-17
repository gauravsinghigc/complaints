<div class="company-details flex-s-b">
 <h2>
  <span><?php echo APP_NAME; ?></span><br>
  <span class="fs-12 text-grey m-t-3"><?php echo DOMAIN; ?></span>
 </h2>
 <p class="text-right lh-1-3">
  <span><?php echo PRIMARY_PHONE; ?></span><br>
  <span><?php echo PRIMARY_EMAIL; ?></span><br>
  <span><?php echo SECURE(PRIMARY_ADDRESS, "d"); ?></span><br>
  <span class="text-grey italic fs-11">Ref ID : <?php echo $ExportRefid = date("D d M, Y") . "/" . rand(0, 9999999) . "/UID" . LOGIN_UserId; ?></span><br>
  <span class="text-grey fs-12"><?php echo  LOGIN_UserName; ?> | <?php echo LOGIN_UserPhone; ?> | <?php echo LOGIN_UserEmailId; ?></span>
 </p>
</div>