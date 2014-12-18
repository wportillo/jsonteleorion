<?php 
			/*
			 * Header  Crossdomain policy access 
			 */
			header('Access-Control-Allow-Origin:*');
				
			header('Pragma: no-cache');
	
			require_once ('main.inc.php');
	
			require_once ('includes/form.class.php');

			$Form = new Form();
			
			
?>