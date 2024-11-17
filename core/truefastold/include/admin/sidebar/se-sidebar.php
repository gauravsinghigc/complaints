    <div id="sidebar" class="app-sidebar">

        <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
            <div class="menu">
                <div class="menu-item" id="dashboard">
                    <a href="<?php echo ADMIN_URL; ?>" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-home"></i>
                        </div>
                        <div class="menu-text">Dashboard</div>
                    </a>
                </div>

                <div class="menu-item has-sub" id="products">
                    <a href="<?php echo DOMAIN; ?>/se/" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-table"></i>
                        </div>
                        <div class="menu-text">All Complaints</div>
                    </a>
                </div>

                <div class="menu-item has-sub" id="products">
                    <a href="<?php echo DOMAIN; ?>/se/" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-table"></i>
                        </div>
                        <div class="menu-text">Open Complaints</div>
                    </a>
                </div>

                <div class="menu-item has-sub" id="products">
                    <a href="<?php echo DOMAIN; ?>/se/" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-table"></i>
                        </div>
                        <div class="menu-text">Active Complaints</div>
                    </a>
                </div>

                <div class="menu-item has-sub" id="products">
                    <a href="<?php echo DOMAIN; ?>/se/" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-table"></i>
                        </div>
                        <div class="menu-text">Closed Complaints</div>
                    </a>
                </div>

                <?php SidebarMenus("Profile", "fa-user", "profile", [
                    "profile_view" => [
                        "dir" => ADMIN_URL . "/profile/index.php",
                        "menuname" => "Profile"
                    ],
                    "logout" => [
                        "dir" => ADMIN_URL . "/logout.php",
                        "menuname" => "Logout"
                    ]
                ]) ?>

            </div>
        </div>

    </div>
    <div class="app-sidebar-bg"></div>
    <div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>