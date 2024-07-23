 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-light-primary elevation-4">
     <!-- Brand Logo -->
     <a href="<?php echo ADMIN_URL; ?>" class="brand-link">
         <img src="<?php echo MAIN_LOGO; ?>" alt="<?php echo APP_NAME; ?>" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
         <span class="brand-text bold mt-2" style="font-size: 1rem !important;font-weight:600 !important;"><?php echo substr(APP_NAME, 0, 20); ?></span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>" class="nav-link">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/complaints" class="nav-link">
                         <i class="nav-icon fas fa-list"></i>
                         <p>
                             All Complaints
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/products" class="nav-link">
                         <i class="nav-icon fas fa-table"></i>
                         <p>
                             All Products
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/replacement" class="nav-link">
                         <i class="nav-icon fas fa-exchange"></i>
                         <p>
                             All Replacements
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/warranty" class="nav-link">
                         <i class="nav-icon fas fa-stamp"></i>
                         <p>
                             All Warranty Cards
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/customers" class="nav-link">
                         <i class="nav-icon fas fa-users"></i>
                         <p>
                             All Customers
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/users" class="nav-link">
                         <i class="nav-icon fas fa-users"></i>
                         <p>
                             All Users
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/configs" class="nav-link">
                         <i class="nav-icon fas fa-gears"></i>
                         <p>
                             System Settings
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/profile/" class="nav-link">
                         <i class="nav-icon fas fa-user"></i>
                         <p>
                             Profile
                         </p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/logout.php" class="nav-link">
                         <i class="nav-icon fas fa-power-off"></i>
                         <p>
                             Logout
                         </p>
                     </a>
                 </li>

             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>