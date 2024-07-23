<?php

//CONTROL_DATABASE can be true or false
//if true, then database connection will be controlled by DB_ENV which must DEV or PROD
//if false, then database connection will be controlled by DB_ENV which must NULL
//CONTROL_DB_STATUS can be true or false.
//CONTROL_DB_STATUS display the Status of DB_STATUS like connected, not connected, or connection error.
//default value is false for CONTROL_DB_STATUS
define("CONTROL_DATABASE", true);
define("CONTROL_DB_STATUS", false);

//DB_ENV can be NULL, DEV or PROD.

/*
 DEV -> for development
 PROD -> for production
 NULL -> for NO DB connection required

 *** change DB_ENV mode as per your requirement *** 
*/

//set DB_ENV Database work environments DB_ENV can be NULL, DEV or PROD.
define("DB_ENV", "DEV");

//database variables
//for muliple database connections, connections will be declared here...

//DB_ENV can be NULL, DEV or PROD.
if (DB_ENV == "DEV") {
 define("DB_SERVER_HOST", "localhost");
 define("DB_SERVER_USER", "root");
 define("DB_SERVER_PASS", "");
 define("DB_SERVER_DB_NAME", "truefastenergy");
 define("DB_SERVER_PORT", "3306");

 //DB_ENV can be NULL, DEV or PROD.
} else if (DB_ENV == "PROD") {
 define("DB_SERVER_HOST", "localhost");
 define("DB_SERVER_USER", "root");
 define("DB_SERVER_PASS", "");
 define("DB_SERVER_DB_NAME", "truefastenergy");
 define("DB_SERVER_PORT", "3306");

 //die if DB_ENV is not set
} elseif (DB_ENV == "NULL") {
 /**
  * DB is not required for this project
  * DB setup is not required for this project
  * DB_ENV can be NULL, DEV or PROD.
  * Change DB_ENV mode as per your requirement
  * DB setup is depend DB connection or requirements
  * if may be DB connection is not required then DB_ENV can be NULL
  * if DB connection is required then DB_ENV can be DEV or PROD
  * DB connection is Optional for this project
  * If required then config.php file will be changed accordingly
  * disable DB connection by setting CONTROL_DATABASE to false
  * disable DB status by setting CONTROL_DB_STATUS to false 
  * DB_SERVER_HOST, DB_SERVER_USER, DB_SERVER_PASS, DB_SERVER_DB_NAME, DB_SERVER_PORT can be changed as per your requirement
  */

 //set DB_ENV Database work environments DB_ENV can be NULL, DEV or PROD.
 //if false, then database connection will be controlled by DB_ENV which must NULL
 //if true, then database connection will be controlled by DB_ENV which must DEV or PROD
} else {
 die("<b>Error:</b> DB_ENV is not set. Please set DB_ENV as DEV or PROD in config/db.php file");
}
