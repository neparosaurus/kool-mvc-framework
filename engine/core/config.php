<?php
if (!defined("SECURE")) exit("No direct script access allowed");

// Database setup
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "h00f_database");

// Error reporting
error_reporting(E_ALL ^ E_NOTICE);

// Pages	
define("DIR_WS_SITE", "http://localhost/kool/www/", true);		// http://localhost/kool/www/
define("DIR_FS", $_SERVER['DOCUMENT_ROOT'], true); 				// C:/wamp/www/
define("DIR_FS_SITE", DIR_FS."kool/", true);					// C:/wamp/www/kool/
define("DIR_FS_SITE_INCLUDE", DIR_FS_SITE."engine/", true);		// C:/wamp/www/kool/engine/

// Session

define("LOGIN_ATT", 3, true);									// Default maximum login attempts


?>