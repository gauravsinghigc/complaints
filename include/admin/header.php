<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
   <!-- Left navbar links -->
   <ul class="navbar-nav">
      <li class="nav-item">
         <a class="nav-link h4" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <?php if (DEVICE_TYPE == "Computer") { ?>
         <li class="navbar-item">
            <span class="nav-link h4" id="clock"></span>
         </li>
      <?php } ?>
   </ul>

   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">

      <li class="nav-item">
         <a href="<?php echo ADMIN_URL; ?>/profile/" class="nav-link user-panel p-0 pr-2 shadow-sm p-1 rounded">
            <div class="image">
               <img src="<?php echo LOGIN_UserProfileImage; ?>" class="img-circle elevation-2" alt="<?php echo LOGIN_UserFullName; ?>" title="<?php echo LOGIN_UserFullName; ?>" />

               <span class="p-2 h6 float-right bold"><b><?php echo LOGIN_UserFullName; ?></b></span>
            </div>
         </a>
      </li>
   </ul>
</nav>
<!-- /.navbar -->