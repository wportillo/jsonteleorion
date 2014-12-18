<?php
/**
 * Main
 *
 * @author william
 * @package
 *
 */

	$base_memory = round(memory_get_usage() / 1024);
	
	$time_start = microtime(true);
	
	
	/**
	 *  Error reporting
	 */
	error_reporting(E_ALL);

	ini_set('memory_limit','500M');
	
	ini_set('precision', 17);
	
	/**
	 * Default Timezone
	 * 
	 */
    date_default_timezone_set('America/New_York');
	/**
	 * Base Path
	 */
	define('BASE_PATH', realpath(dirname(realpath(__FILE__))));
	/**
	 * Includes Path
	 */
	define('INCLUDE_PATH', BASE_PATH . '/includes/');
	/**
	 * SERVER NAME
	 */
	define('SERVER_NAME',$_SERVER['SERVER_NAME']);
	/**
	 * SERVER NAME LOCAL
	 */
	define('SERVER_NAME_LOCAL','jsontvmia');
	/**
	 * SERVER NAME LOCAL
	 */
	define('SERVER_NAME_LIVE','customers.tvmia.com');
	/**
	 * Encrypt Key
	 */
	define('ENCRYPT_KEY','jp3326001');
	/**
	 * Classes Path
	 */
	define('CLASSES_PATH', BASE_PATH. '/includes/classes/');
	/**
	 * Config
	 */
	require_once(INCLUDE_PATH . 'config.inc.php');
	/**
	 * General Functions
	 */
	require_once(INCLUDE_PATH . 'functions.inc.php');
	/**
	 * DB Class
	 */
	require_once(INCLUDE_PATH . 'db.class.php');
	/**
	 * RS Class
	 */
	require_once(INCLUDE_PATH . 'rs.class.php');	
	/**
	 * Rs Extend Elements
	 */
	require_once(CLASSES_PATH . 'clase.php');
	
	/**
	 * Check
	 */
	require_once(INCLUDE_PATH . 'check.class.php');
	
	/**
	 * System Messages
	 */
	require_once(INCLUDE_PATH . 'systemmessages.class.php');
	
	/**
	 * Base
	 */
	require_once(INCLUDE_PATH . 'base.class.php');
	
	/**
	 * Method
	 */
	require_once (INCLUDE_PATH . 'method.class.php');
	
	/**
	 * Actions
	*/
	require_once (INCLUDE_PATH . 'actions.class.php');
	
	/**
	 * Member
	*/
	require_once (INCLUDE_PATH . 'memberactions.class.php');
	
	/**
	 * Security
	*/
	require_once (INCLUDE_PATH . 'security.class.php');
	
	/**
	 * Channels
	*/
	require_once (INCLUDE_PATH . 'channels.class.php');
	
	
	/**
	 * Db Connection
	 */
		if(DEBUG){
			ini_set('display_errors', true);
		}else {
			ini_set('display_errors', false);
			$old_error_handler = set_error_handler('userErrorHandler');	
		}

		
		if(!db::connectdb()){
				
			global $db;
				
			die('Database server error');
		}
?>