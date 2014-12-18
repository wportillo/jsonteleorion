<?php
/**
 * Configuration File
 *
 * @author william
 * @package Core
 */

if(SERVER_NAME=='jsonteleorion'){
		
		/**
		 * Site Debug (PHP Errors)
		 */
		define('DEBUG', true);
		
		/**
		 * Database Debug (SQL)
		 */
		define('DEBUG_DB', false);
		
		/**
		 * Show Load (Memory & Time)
		 */
		define('DEBUG_LOAD', false);
		/**
		 * MySQL Host
		 */
		define('DB_HOST', 'localhost');
		
		/**
		 * MySQL Username
		 */
		define('DB_USER', 'root');
	
		/**
		 * MySQL Password
		 */
		define('DB_PASS', '1234');
		
		/**
		 * MySQL Database
		 */
		define('DB_NAME', 'jsonteleorion');
		/**
		 * BASE NAME
		 */
		define('BASE','http://jsonteleorion/');
		
		/**
		 * BASE IMG SITE
		 */
		define('BASE_IMG_SITE','https://www.teleorion.info:444/imagefile/');
		
		/**
		 * BASE IMG BOX
		 */
		define('BASE_IMG_BOX','http://image.teleorion.com/');
		
		/**
		 * Session
		 */
		
		define("SESSION_DELIM", '|');
	}else{
		/**
		 * Site Debug (PHP Errors)
		 */
		define('DEBUG', false);
		
		/**
		 * Database Debug (SQL)
		 */
		define('DEBUG_DB', false);
		
		/**
		 * Show Load (Memory & Time)
		 */
		define('DEBUG_LOAD', false);
		/**
		 * MySQL Host
		 */
		define('DB_HOST', 'sql.teleorion.com');
		
		/**
		 * MySQL Username
		 */
		define('DB_USER', 'teleorion');
	
		/**
		 * MySQL Password
		 */
		define('DB_PASS', 'jp3326042');
		
		/**
		 * MySQL Database
		 */
		define('DB_NAME', 'jsonteleorion');
		/**
		 * BASE NAME
		 */
		define('BASE','http://json.teleorion.com/');
		/**
		 * BASE IMG SITE
		 */
		define('BASE_IMG_SITE','https://www.teleorion.info:444/imagefile/');
		
		/**
		 * BASE IMG BOX
		*/
		define('BASE_IMG_BOX','http://image.teleorion.com/');
				
		/**
		 * Session
		 */
		define("SESSION_DELIM", '|');
	}
	
	/**
	 * SMS User & Pass
	 */
		define('SMS_USER', 'TeleOrion002');
		define('SMS_PASS', 'y9Pb3Lrq');
	/**
	 * transactions login
	 */
		define('HOST_MERCHANT','https://api-3t.paypal.com/nvp');
		
		define('USER_MERCHANT','jpedrosa_api1.teleorion.com');
		
		define('PWD_MERCHANT','M8HRKKSNTHDCFSDX');
		
		define('SIGNATURE_MERCHANT','AFcWxV21C7fd0v3bYYYRCpSSRl31ASfpj-Az1cx-6FYN5E3a9ZlUK7gf');
		
		define('VERSION_MERCHANT','99.0');
	
	/**
	 * Email Config
	 */
		define('HOST_EMAIL','smtp.gmail.com');
		
		define('PORT_EMAIL','465');
		
		define('USER_EMAIL','info@teleorion.com');
		
		define('PASSWORD_EMAIL','teleorion2014');
	
	/**
	 * Paypal Config
	 */
		define('SERVER_PAYPAL','https://www.paypal.com/cgi-bin/webscr');
		
		define('ACCOUNT_PAYPAL','jpedrosa@teleorion.com');
?>