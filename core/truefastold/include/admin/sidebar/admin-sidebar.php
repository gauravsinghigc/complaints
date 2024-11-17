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

       <?php
       SidebarMenus("All Sale", "fa-inr", "sales", [
        "add_sale" => [
         "dir" => ADMIN_URL . "/sales/add-sale.php",
         "menuname" => "Add Sale"
        ],
        "all_sale" => [
         "dir" => ADMIN_URL . "/sales/index.php",
         "menuname" => "All Sales"
        ],
        "sale_reports" => [
         "dir" => ADMIN_URL . "/sales/report.php",
         "menuname" => "Sale Reports"
        ]
       ]);  ?>

       <?php
       SidebarMenus("All Invoices", "fa-file-pdf-o", "invoices", [
        "add_invoice" => [
         "dir" => ADMIN_URL . "/sales/add-sale.php",
         "menuname" => "Add Invoice"
        ],
        "all_invoices" => [
         "dir" => ADMIN_URL . "/invoices/index.php",
         "menuname" => "All Invoices"
        ],
        "invoice_reports" => [
         "dir" => ADMIN_URL . "/invoices/report.php",
         "menuname" => "Invoice Reports"
        ]
       ]);

       SidebarMenus("All Transactions", "fa-exchange", "transactions", [
        "all_transactions" => [
         "dir" => ADMIN_URL . "/transactions/index.php",
         "menuname" => "All Transactions"
        ],
        "transactions_reports" => [
         "dir" => ADMIN_URL . "/transactions/report.php",
         "menuname" => "Transactions Reports"
        ]
       ]);

       SidebarMenus("All Complaints & Services", "fa-certificate", "services", [
        "add_services" => [
         "dir" => ADMIN_URL . "/services/add-complaint.php",
         "menuname" => "Add New Complaints"
        ],
        "all_services" => [
         "dir" => ADMIN_URL . "/services/index.php",
         "menuname" => "All Complaints"
        ],
        "all_complaints" => [
         "dir" => ADMIN_URL . "/services/services.php",
         "menuname" => "All Services"
        ],
        "services_reports" => [
         "dir" => ADMIN_URL . "/services/report.php",
         "menuname" => "Services & Complaints Reports"
        ]
       ]);  ?>

       <div class="menu-item has-sub" id="products">
        <a href="javascript::" class="menu-link">
         <div class="menu-icon">
          <i class="fa fa-table"></i>
         </div>
         <div class="menu-text">All Products</div>
         <div class="menu-caret"></div>
        </a>
        <div class="menu-submenu">
         <div class="menu-item" id="add_products">
          <a href="<?php echo ADMIN_URL; ?>/products/add.php" class="menu-link">
           <div class="menu-text">Add New Product</div>
          </a>
         </div>
         <div class="menu-item" id="all_products">
          <a href="<?php echo ADMIN_URL; ?>/products/index.php" class="menu-link">
           <div class="menu-text">All Products</div>
          </a>
         </div>
         <div class="menu-item" id="product_reports">
          <a href="<?php echo ADMIN_URL; ?>/products/reports.php" class="menu-link">
           <div class="menu-text">Products Reports</div>
          </a>
         </div>
        </div>
       </div>
       <?php
       SidebarMenus("All Customers", "fa-users", "customers", [
        "add_customer" => [
         "dir" => ADMIN_URL . "/customers/add.php",
         "menuname" => "Add New Customer"
        ],
        "all_customers" => [
         "dir" => ADMIN_URL . "/customers/index.php",
         "menuname" => "All Customers"
        ],
        "customer_reports" => [
         "dir" => ADMIN_URL . "/customers/report.php",
         "menuname" => "Customer Reports"
        ]
       ]);
       ?>
       <div class="menu-item has-sub" id="teams">
        <a href="javascript::" class="menu-link">
         <div class="menu-icon">
          <i class="fa fa-users"></i>
         </div>
         <div class="menu-text">All Team Members</div>
         <div class="menu-caret"></div>
        </a>
        <div class="menu-submenu">
         <div class="menu-item" id="add_team">
          <a href="<?php echo ADMIN_URL; ?>/teams/add.php" class="menu-link">
           <div class="menu-text">Add New Team Member</div>
          </a>
         </div>
         <div class="menu-item">
          <a href="<?php echo ADMIN_URL; ?>/teams/index.php" class="menu-link">
           <div class="menu-text">All Team Member</div>
          </a>
         </div>
         <div class="menu-item">
          <a href="<?php echo ADMIN_URL; ?>/teams/reports.php" class="menu-link">
           <div class="menu-text">Team Member Reports</div>
          </a>
         </div>
        </div>
       </div>

       <?php
       SidebarMenus("All Reports", "fa-file-pdf-o", "reports", [
        "sale_report" => [
         "dir" => ADMIN_URL . "/reports/sale.php",
         "menuname" => "Sale Reports"
        ],
        "invoice_report" => [
         "dir" => ADMIN_URL . "/reports/invoice.php",
         "menuname" => "Invoice Reports"
        ],
        "transaction_report" => [
         "dir" => ADMIN_URL . "/reports/invoice.php",
         "menuname" => "Transaction Reports"
        ],
        "services_reports" => [
         "dir" => ADMIN_URL . "/reports/services.php",
         "menuname" => "Service Reports"
        ],
        "customer_reports" => [
         "dir" => ADMIN_URL . "/reports/customers.php",
         "menuname" => "Customer Reports"
        ],
        "team_reports" => [
         "dir" => ADMIN_URL . "/reports/customers.php",
         "menuname" => "Team Reports"
        ],
        "employee_reports" => [
         "dir" => ADMIN_URL . "/reports/customers.php",
         "menuname" => "Employee Reports"
        ],
        "overall_reports" => [
         "dir" => ADMIN_URL . "/reports/index.php",
         "menuname" => "OverAll Reports"
        ]
       ]);
       ?>

       <div class="menu-item has-sub" id="configs">
        <a href="javascript::" class="menu-link">
         <div class="menu-icon">
          <i class="fa fa-gears"></i>
         </div>
         <div class="menu-text">Configurations</div>
         <div class="menu-caret"></div>
        </a>
        <div class="menu-submenu">
         <div class="menu-item">
          <a href="<?php echo ADMIN_URL; ?>/configs/" class="menu-link">
           <div class="menu-text">System Profile</div>
          </a>
         </div>
         <div class="menu-item">
          <a href="<?php echo ADMIN_URL; ?>/configs/theme.php" class="menu-link">
           <div class="menu-text">Theme Settings</div>
          </a>
         </div>
         <div class="menu-item">
          <a href="<?php echo ADMIN_URL; ?>/configs/api-keys.php" class="menu-link">
           <div class="menu-text">API & Key Configs</div>
          </a>
         </div>
         <div class="menu-item">
          <a href="<?php echo ADMIN_URL; ?>/configs/advance-settings.php" class="menu-link">
           <div class="menu-text">Advance Settings</div>
          </a>
         </div>
         <div class="menu-item" id="configs_apps">
          <a href="<?php echo ADMIN_URL; ?>/configs/config-system.php" class="menu-link">
           <div class="menu-text">System Configurations</div>
          </a>
         </div>
        </div>
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