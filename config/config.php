<?php

/***
  AIO (All In One) Config.php File for core php projects or php projects.
		This file contain all basic requirements for projects and it's configuration just include the file and call required function.
		Change have to done only at App configuration and Database configuration if required, else leave others.
    DEVELOPED BY GAURAVSINGHIGC INCORPORATION WTIH NAVIX.IN

    ---
    All Mention formate are being copyrighted by gauravsinghigc and by Navix Consultancy Service--#
    Any miss use may result in un wanted fattle of codes
    showing show many errors
    Need to get support from experience developer.

    -- Thanking for Working with Navix Consultancy Services & Gauravsinghigc ---
    --- BEST OF LUCK ----
    --- BEST OF LUCK ----
    --- BEST OF LUCK ----
    --- BEST OF LUCK ----
    --- BEST OF LUCK ----
    --- BEST OF LUCK ----
    --- BEST OF LUCK ----
    --- BEST OF LUCK ----
    --- BEST OF LUCK ----

    #############################################################################
 */

//Display Errors
ini_set("display_errors", 1);

//session_start()
session_start();
ob_start();

//App Configurations
//Change configuration according to your need and project requirements


//check SSL is installed or not
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
  $link = "https";
else
  $link = "http";

// Here append the common URL characters.
$link .= "://";

//dir & domain setup
define("HOST", $HOST = $_SERVER['SERVER_NAME']);

//list of local hosts or servers
define("LOCAL_HOST", array("127.0.0.1", "192.168.1.3", "::1", "localhost", "192.168.1.9", "192.168.43.14", "192.168.1.10", "192.168.1.11", "192.168.1.5"));

//filter domain from local or live server
if (in_array("" . HOST . "", LOCAL_HOST)) {
  define("DOMAIN", $link . HOST . "/trufast");
} else {
  define("DOMAIN", $link . HOST);
}

//app constant
define("APP_URL", DOMAIN . "/app");
define("ADMIN_URL", DOMAIN . "/admin");
define("WEB_URL", DOMAIN . "/web");
define("STORAGE_URL", DOMAIN . "/storage");
define("STORAGE_URL_D", DOMAIN . "/storage/default");
define("STORAGE_URL_U", DOMAIN . "/storage/users");
define("AUTH_URL", DOMAIN . "/auth");
define("CONTROLLER", DOMAIN . "/controller");
define("ASSETS_URL", DOMAIN . "/assets");

//Company Profile
define("APP_NAME", CONFIG("APP_NAME"));
define("APP_LOGO", CONFIG("APP_LOGO"));
define("LOGIN_BG_IMAGE", STORAGE_URL_D . "/bg/" . CONFIG("LOGIN_BG_IMAGE"));
define("TAGLINE", CONFIG("TAGLINE"));
define("OWNER_NAME", CONFIG("OWNER_NAME"));
define("PRIMARY_PHONE", CONFIG("PRIMARY_PHONE"));
define("PRIMARY_EMAIL", CONFIG("PRIMARY_EMAIL"));
define("SHORT_DESCRIPTION", CONFIG("SHORT_DESCRIPTION"));
define("PRIMARY_ADDRESS", CONFIG("PRIMARY_ADDRESS"));
define("PRIMARY_AREA", CONFIG("PRIMARY_AREA"));
define("PRIMARY_CITY", CONFIG("PRIMARY_CITY"));
define("PRIMARY_STATE", CONFIG("PRIMARY_STATE"));
define("PRIMARY_PINCODE", CONFIG("PRIMARY_PINCODE"));
define("PRIMARY_COUNTRY", CONFIG("PRIMARY_COUNTRY"));
define("PRIMARY_MAP_LOCATION_LINK", CONFIG("PRIMARY_MAP_LOCATION_LINK"));
define("PRIMARY_GST", CONFIG("GST_NO"));
define("COMPANY_TYPE", CONFIG("COMPANY_TYPE"));
define("FINANCIAL_YEAR", CONFIG("FINANCIAL_YEAR"));
define("GST_NO", CONFIG("GST_NO"));
define("APP_THEME", CONFIG("APP_THEME"));

//mail id's setups
define("SENDER_MAIL_ID", CONFIG("SENDER_MAIL_ID"));
define("RECEIVER_MAIL", CONFIG("RECEIVER_MAIL"));
define("REPLY_TO", CONFIG("REPLY_TO"));
define("SUPPORT_MAIL", CONFIG("SUPPORT_MAIL"));
define("ENQUIRY_MAIL", CONFIG("ENQUIRY_MAIL"));
define("ADMIN_MAIL", CONFIG("ADMIN_MAIL"));


//API keys, 3rd party variables and add-on
define("SMS_API_KEY", CONFIG("SMS_API_KEY"));

//downloadable & add-on links
define("DOWNLOAD_ANDROID_APP_LINK", CONFIG("DOWNLOAD_ANDROID_APP_LINK"));
define("DOWNLOAD_IOS_APP_LINK", CONFIG("DOWNLOAD_IOS_APP_LINK"));
define("DOWNLOAD_BROCHER_LINK", CONFIG("DOWNLOAD_BROCHER_LINK"));

//developer details
define("DEVELOPER_DOMAIN", "navix.in");
define("DEVELOPED_BY", "Navix Consultancy Services");
define("DEVELOPER_URL", "http://" . DEVELOPER_DOMAIN);
define("DEVELOPER_SUPPORT_PHONE", "00000000000");
define("DEVELOPER_SUPPORT_MAIL_ID", "navix365@gmail.com");
define("DEVELOPER_SUPPORT_PANEL", "http://" . DEVELOPER_DOMAIN . "/support");
define("DEVELOPER_SUPPORT_APP_LINK", "");

//Controll activity or die activities, function 
define("CONTROL_WORK_ENV", CONFIG("CONTROL_WORK_ENV"));
define("CONTROL_SMS", CONFIG("CONTROL_SMS"));
define("CONTROL_MAILS", CONFIG("CONTROL_MAILS"));
define("CONTROL_NOTIFICATION", CONFIG("CONTROL_NOTIFICATION"));
define("CONTROL_MSG_DISPLAY_TIME", CONFIG("CONTROL_MSG_DISPLAY_TIME"));
define("CONTROL_APP_LOGS", CONFIG("CONTROL_APP_LOGS"));
define("CONTROL_NOTIFICATION_SOUND", CONFIG("CONTROL_NOTIFICATION_SOUND"));
define("WEBSITE", CONFIG("WEBSITE"));
define("APP", CONFIG("APP"));

//payment gateway configurations
define("PG_OPTIONS", array("RAZORAPAY", "PAYTM"));
define("ONLINE_PAYMENT_OPTION", CONFIG("ONLINE_PAYMENT_OPTION"));
define("PG_MODE", CONFIG("PG_MODE"));
define("PG_PROVIDER", CONFIG("PG_PROVIDER"));
define("MERCHENT_ID", CONFIG("MERCHENT_ID"));
define("MERCHANT_KEY", CONFIG("MERCHANT_KEY"));
define("MAX_ORDER_QTY", CONFIG("MAX_ORDER_QTY"));
define("MIN_ORDER_QTY", CONFIG("MIN_ORDER_QTY"));

//user access, roles & permission
define("USER_ROLES", array("Admin", "TeamMember", "HR", "Account"));
define("USER_PERMISSIONS", array("DISPLAY", "VIEW", "EDIT", "DELETE", "CREATE"));
define("USER_ACCESS", array("users", "configurations", "projects", "customers", "payments", "invoices", "quotations", "pi", "calls", "meetings", "expanses", "domains", "credentails", "ulinks", "ref_links", "supports", "company", "dev_charges", "team", "reminders", "subscriptions", "products"));

//default variables
define("DEFAULT_USER_ICON", STORAGE_URL_D . "/default/default.png");
define("THEME_OPTION", array("Default", "Apple", "Facebook", "Transparent", "Google", "Material"));
