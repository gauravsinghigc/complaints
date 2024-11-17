 <div id="header" class="app-header app-header-inverse">
    <div class="navbar-header">
       <a href="<?php echo ADMIN_URL; ?>" class="navbar-brand">
          <img src="<?php echo MAIN_LOGO; ?>" class="app-logo">
          <?php echo APP_NAME; ?></a>
       <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
       </button>
    </div>


    <div class="navbar-nav">
       <div class="navbar-item dropdown">
          <div class="dropdown-menu media-list dropdown-menu-end">
             <div class="dropdown-header">NOTIFICATIONS (5)</div>
             <a href="javascript:;" class="dropdown-item media">
                <div class="media-left">
                   <i class="fa fa-bug media-object bg-gray-400"></i>
                </div>
                <div class="media-body">
                   <h6 class="media-heading">Server Error Reports <i class="fa fa-exclamation-circle text-danger"></i></h6>
                   <div class="text-muted fs-10px">3 minutes ago</div>
                </div>
             </a>
             <div class="dropdown-footer text-center">
                <a href="javascript:;" class="text-decoration-none">View more</a>
             </div>
          </div>
       </div>
       <div class="navbar-item navbar-user dropdown">
          <a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
             <img src="<?php echo LOGIN_UserProfileImage; ?>" alt="" />
             <span class="d-none d-md-inline"><?php echo LOGIN_UserFullName; ?></span> <b class="caret ms-6px"></b>
          </a>
          <div class="dropdown-menu dropdown-menu-end me-1">
             <?php if (LOGIN_UserType == "Admin") {
               ?>
                <a href="<?php echo ADMIN_URL; ?>/profile." class="dropdown-item">Edit Profile</a>
             <?php
               } else { ?>
                <a href="<?php echo DOMAIN; ?>/se/profile/" class="dropdown-item">Edit Profile</a>
             <?php } ?>
             <a href="<?php echo DOMAIN; ?>/logout.php" class="dropdown-item">Log Out</a>
          </div>
       </div>
    </div>

 </div>