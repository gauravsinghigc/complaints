 <div class="row">
  <div class="col-md-12">
   <div class="profile">
    <div class="profile-header">
     <div class="profile-header-cover"></div>
     <div class="profile-header-content">
      <div class="profile-header-img">
       <img src="<?php echo STORAGE_URL; ?>/users/img/profile/<?php echo GET_DATA("UserProfileImage"); ?>" alt="" />
      </div>
      <div class="profile-header-info">
       <h4 class="mt-0 mb-1"><?php echo GET_DATA("UserSalutation"); ?> <?php echo GET_DATA("UserFullName"); ?></h4>
       <p class="mb-0"><i><?php echo GET_DATA("UserDesignation"); ?> | <?php echo GET_DATA("UserDepartment"); ?> @ <?php echo GET_DATA("UserCompanyName"); ?></i> | <?php echo GET_DATA("UserWorkFeilds"); ?> </p>
       <p class="mt-0">
        <a href="&?send_mail_to=<?php echo GET_DATA("UserEmailId"); ?>" class="text-white"><i class="fa fa-envelope"></i> <?php echo GET_DATA("UserEmailId"); ?></a><br>
        <a href="tel=<?php echo GET_DATA("UserPhoneNumber"); ?>" class="text-white"><i class="fa fa-phone-square"></i> <?php echo GET_DATA("UserPhoneNumber"); ?></a><br>
        <span class="phone-no text-line-limit-1"><i class="fa fa-cake text-warning"></i> <?php echo DATE_FORMATE2("d M, Y", GET_DATA('UserDateOfBirth')); ?></span>
       </p>
      </div>
     </div>
    </div>
   </div>
  </div>