<?php
/**
 * General Functions
 * @author William
 * 
 */
	/*
	 * Is divisible
	 */
		function isdivisible($number,$dividend){
			
			if(abs($number) / $dividend >= 1){
				return true;
			}else{
				return false;
			}
		}
	/**
	 * Query to array
	 *
	 * @param array data
	 */
	function queryToArray($qry){
		$result = array();
		//string must contain at least one = and cannot be in first position
		if(strpos($qry,'=')) {
	
			if(strpos($qry,'?')!==false) {
				$q = parse_url($qry);
				$qry = $q['query'];
			}
		}else {
			return false;
		}
	
		foreach (explode('&', $qry) as $couple) {
			list ($key, $val) = explode('=', $couple);
			$result[$key] = $val;
		}
	
		return empty($result) ? false : $result;
	}
	
	/**
	 * Php Serialize session 
	 * 
	 * @param array data
	 */
		function serialize_session($data){
			
			session_start();
			
			foreach($data as $key=>$value){
				$_SESSION[$key] = $value;
			}
			
			$session = session_encode();
			
			session_destroy();
			
			return $session;
		}
		
	/**
	 * Php Serialize session 
	 * 
	 * @param array data
	 */
		function unserialize_session($session_data, $start_index=0, &$dict=null) {
		
			isset($dict) or $dict = array();
				
			$name_end = strpos($session_data, SESSION_DELIM, $start_index);
				
			if ($name_end !== FALSE) {
				$name = substr($session_data, $start_index, $name_end - $start_index);
				$rest = substr($session_data, $name_end + 1);
		
				$value = unserialize($rest); // PHP will unserialize up to "|" delimiter.
				$dict[$name] = $value;
		
				return unserialize_session($session_data, $name_end + 1 + strlen(serialize($value)), $dict);
			}
				
			return $dict;
		}
	
	/**
	 * Execute Background php
	 * @param string $base
	 * @param string $direction
	 * @param string $jsonobject
	 * @return void
	 */
	function backgroud_php($base,$direction,$jsonobject,$time){
	
		$fom_data = urlencode($jsonobject);
		
		$cmd="curl -v  {$base}{$direction}/?formdata={$fom_data} & sleep 0.0{$time} ; kill $!";
		
		pclose(popen($cmd,'r'));
	}
	/**
	 * Get Generator
	 * @param Array $data
	 * @return string
	 */
	function array_to_get($data){
		$i=0;
	
		$get_text='';
	
		foreach($data as $key=>$val){
	
			if($i==0){
				$get_text.=$key.'='.$val;
			}else{
				$get_text.='&'.$key.'='.$val;
			}
	
			$i++;
		}
	
		return $get_text;
	}
	/**
	 * Get POST var
	 *
	 * @param string $name
	 * @param string $default
	 * @return mixed
	 */
	function _post($name, $default = ''){
		
		if(!isset($_POST[$name])){
			return $default;
		}else {
			return $_POST[$name];			
		}
		
	}
	/**
	 * Get Mime
	 */
	function get_mime($file) {
		if (function_exists("finfo_file")) {
			$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
			$mime = finfo_file($finfo, $file);
			finfo_close($finfo);
			return $mime;
		} else if (!stristr(ini_get("disable_functions"), "shell_exec")) {
			
			$file = escapeshellarg($file);
			
			$mime = shell_exec("file -bi " . $file);
			return $mime;
		} else {
			return false;
		}
	}
	
	/** 
	 * Generate Random String
	 * 
	 * @param integer $length
	 * @return string
	 */
	function RandomString($length){
			
			$str='';
			
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
		
			$size = strlen( $chars );
			for( $i = 0; $i < $length; $i++ ) {
				$str .= $chars[ rand( 0, $size - 1 ) ];
			}
		
			return $str;
	}
	
	/**
	 * Get File ext
	 * @param string $filename
	 */
	function GetExt($filename){
		
		return preg_replace('/^.*\.([^.]+)$/D', '$1', $filename);
	}
	
	/**
	 * 
	 * Get Cookie var
	 *
	 * @param string $name
	 * @param string $default
	 * @return mixed
	 */
	function _cookie($name, $default = ''){
		
		if(!isset($_COOKIE[$name])){
			return $default;
		}else {
			return $_COOKIE[$name];			
		}
		
	}
	
	/**
	 * Get GET var
	 *
	 * @param string $name
	 * @param string $default
	 * @return mixed
	 */	
	function _get($name, $default = ''){
		
		if(!isset($_GET[$name])){
			return $default;
		}else {
			return $_GET[$name];
		}
	}
	
	/**
	 * Get REQUEST var
	 *
	 * @param string $name
	 * @param string $default
	 * @return mixed
	 */	
	function _request($name, $default = ''){

		if(!isset($_REQUEST[$name])){
			return $default;
		}else {
			return $_REQUEST[$name];
		}
		
	}

	/**
	 * Get SESSION var
	 *
	 * @param string $name
	 * @param string $default
	 * @return mixed
	 */
	function _session($name, $default = ''){
		
		if(!isset($_SESSION[$name])){
			return $default;
		}else {
			return $_SESSION[$name];
		}
		
	}
	
	/**
	 * Encrypt password
	 * 
	 * @param String $String
	 * @param String $key
	 * 
	 * return String encrypted
	 */
	function encrypt($string, $key) {
	   $result = '';
	   for($i=0; $i<strlen($string); $i++) {
	      $char = substr($string, $i, 1);
	      $keychar = substr($key, ($i % strlen($key))-1, 1);
	      $char = chr(ord($char)+ord($keychar));
	      $result.=$char;
	   }
	   return base64_encode($result);
	}
	/**
	 * Decrypt password
	 * @param String $String
	 * @param String $key
	 * return String encrypted
	 */
	function decrypt($string, $key) {
	   $result = '';
	   $string = base64_decode($string);
	   for($i=0; $i<strlen($string); $i++) {
	      $char = substr($string, $i, 1);
	      $keychar = substr($key, ($i % strlen($key))-1, 1);
	      $char = chr(ord($char)-ord($keychar));
	      $result.=$char;
	   }
	   return $result;
	}
	
	/**
	 * Generate Mysql Date
	 * 
	 * @param integer $timestamp
	 * 
	 * @return mysql $date
	 */
		function mydate($timestamp=false){
			
			if($timestamp){

				return date('Y-m-d H:i:s',$timestamp);
			
			}else{
				
				return date('Y-m-d H:i:s');
			
			}
		}
		
		/**
		 * Add days to MySql date
		 *
		 * @param integer $timestamp
		 * 
		 * @param integer $days
		 *
		 * @return mysql $date
		 */
			function mydateadd($mydate,$days){
					
				$timestamp = mydatetotimestamp($mydate);
				
				return mydate(adddaystotimestamp($timestamp,$days));
			}
		
		/**
		 * Generate Mysql Date
		 *
		 * @param integer $timestamp
		 *
		 * @return mysql $date
		 */
			function mydateremove($timestamp=false){
			
				if($timestamp){
			
					return date('Y-m-d H:i:s',$timestamp);
						
				}else{
			
					return date('Y-m-d H:i:s');
						
				}
			}
	/*
	 * MySQL Date to Timestamp
	 *
	 * @param string $date
	 * @return integer
	 */
		function  mydatetotimestamp($date){
			return strtotime($date);
		}
	
	/*
	* Add Days to Timestamp
	*
	* @param string $date
	* @return integer
	*/
		function adddaystotimestamp($timestamp,$days){
			return $timestamp+(60*60*24*$days);
		}
	
	/*
	 * Remove Days to Timestamp
	 *
	 * @param string $date
	 * @return integer
	*/
		function removedaystotimestamp($timestamp,$days){
			return $timestamp-(60*60*24*$days);
		}
	
	/**
	 * Search in array
	 *
	 * @param array $pattern
	 * @param string $search_string
	 * @return integer $key
	 */
	function search_in_array($pattern,$search_string){
		
		array_unshift($pattern,'0');
			
		return	array_search($search_string,$pattern);
	}

	/**
	 * String to Mac Address
	 * 
	 * @param string $mac_address
	 * 
	 * return string $mac_address
	 */
	
	function string_to_mac($mac_address){
		return wordwrap($mac_address,2,':',true);
	}
	
	/**
	 * Get Document Root
	 *
	 * return string $document_root
	 */
	function get_document_root(){
	
		$document_root = explode('/', $_SERVER['DOCUMENT_ROOT']);
	
		array_pop($document_root);
	
		return implode('/',$document_root);
	
	}
	
	/**
	 * Get real ip
	 *
	 * return string $get_real_ip
	 */
		function get_real_ip(){
		
		   if( getenv('HTTP_X_FORWARDED_FOR') != '' )
		 	{
		      $client_ip =
		         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
		            $_SERVER['REMOTE_ADDR']
		            :
		            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
		               $_ENV['REMOTE_ADDR']
		               :
		               "unknown" );
		
		   
		
		      $entries = preg_split('/[, ]/', getenv('HTTP_X_FORWARDED_FOR'));
		
		      reset($entries);
		      while (list(, $entry) = each($entries))
		      {
		         $entry = trim($entry);
		         if ( preg_match("/^([0-9]+\\.[0-9]+\\.[0-9]+\\.[0-9]+)/", $entry, $ip_list) )
		         {
		           
		            $private_ip = array(
		                  '/^0\\./',
		                  '/^127\\.0\\.0\\.1/',
		                  '/^192\\.168\\..*/',
		                  '/^172\\.((1[6-9])|(2[0-9])|(3[0-1]))\\..*/',
		                  '/^10\\..*/');
		
		            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
		
		            if ($client_ip != $found_ip)
		            {
		               $client_ip = $found_ip;
		               break;
		            }
		         }
		      }
		   }
		   else
		   {
		      $client_ip =
		         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
		            $_SERVER['REMOTE_ADDR']
		            :
		            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
		               $_ENV['REMOTE_ADDR']
		               :
		               "unknown" );
		   }
		
		   return $client_ip;
		
		}
		/**
		 * Get File size
		 *
		 * @param string $filename
		 * @param integer $decimal
		 * @return array
		 */
		function get_file_size($filename , $decimal = 2 ) {
			
			$file = filesize($filename);
			
			$type = array(' Bytes',' KB',' MB',' GB',' TB');
			
			return round($file/pow(1024,($i = floor(log($file, 1024)))),$decimal ).$type[$i];
		}
		/**
		 * OBject To Array
		 *
		 * @param object $d
		 * @return array
		 */
		function objectToArray($d) {
			if (is_object($d)) {
				$d = get_object_vars($d);
			}
		
			if (is_array($d)) {
				return array_map(__FUNCTION__, $d);
			}else {
				return $d;
			}
		}
		/**
		 * Array To OBject
		 *
		 * @param array $d
		 * @return object
		 */
		function arrayToObject($d) {
			if (is_array($d)) {
				return (object) array_map(__FUNCTION__, $d);
			}else{
				return $d;
			}
		}
?>