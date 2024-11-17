<div class="col-md-12">
 <p class="data-list flex-s-b">
  <span>
   <span class="count"><?php echo $Sno; ?></span>
   <a href="details/?uid=<?php echo SECURE($Customers->UserId, "e"); ?>" class="text-primary bold">
    <span class="name"> <?php echo $Customers->UserSalutation; ?></span> <?php echo $Customers->UserFullName; ?>
   </a>
   <a href="tel:<?php echo $Customers->UserPhoneNumber; ?>" class="text-grey">
    <?php echo $Customers->UserPhoneNumber; ?>
   </a>
   <a href="mailto:<?php echo $Customers->UserEmailId; ?>" class="text-grey">
    <?php echo $Customers->UserEmailId; ?>
   </a>
  </span>
  <span>
   <?php echo DATE_FORMATE2("d M, Y", $Customers->UserCreatedAt); ?>
   <?php echo StatusViewWithText($Customers->UserStatus); ?>
  </span>
 </p>
</div>