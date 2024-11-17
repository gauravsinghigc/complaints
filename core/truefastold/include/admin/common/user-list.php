<div class="col-md-12">
 <div class="p-1 mb-1 shadow-sm rounded-2 bg-white">
  <p class="mb-0 flex-s-b">
   <span class="w-pr-3">
    <?php echo $Sno; ?>
   </span>
   <span class="w-pr-16">
    <a href="details/?uid=<?php echo SECURE($Customers->UserId, "e"); ?>" class="text-primary">
     <img src="<?php echo STORAGE_URL; ?>/users/img/profile/<?php echo $Customers->UserProfileImage; ?>" class="img-fluid user-list-icon">
     <span class="text-grey fs-11"> <?php echo $Customers->UserSalutation; ?></span> <?php echo $Customers->UserFullName; ?>
    </a>
   </span>
   <span class="w-pr-17">
    <?php echo $Customers->UserCompanyName; ?>
   </span>
   <span class="w-pr-12">
    <a href="tel:<?php echo $Customers->UserPhoneNumber; ?>">
     <i class="fa fa-phone-square text-primary"></i> <?php echo $Customers->UserPhoneNumber; ?>
    </a>
   </span>
   <span class="w-pr-18">
    <a href="mailto:<?php echo $Customers->UserEmailId; ?>">
     <i class="fa fa-envelope text-danger"></i> <?php echo $Customers->UserEmailId; ?>
    </a>
   </span>
   <span class="w-pr-12">
    <?php echo $Customers->UserDesignation; ?>
   </span>
   <span class="w-pr-10">
    <b><i class="fa fa-cake-candles text-danger"></i></b> <?php echo DATE_FORMATE2("d M, Y", $Customers->UserDateOfBirth); ?>
   </span>
   <span class="w-pr-7">
    <?php echo DATE_FORMATE2("d M, Y", $Customers->UserCreatedAt); ?>
   </span>
   <span class="w-pr-5">
    <?php echo StatusViewWithText($Customers->UserStatus); ?>
   </span>
  </p>
 </div>
</div>