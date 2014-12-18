<?php
		/*
		 * Paypal
		 */
			require_once ('main.inc.php');

			require_once ('includes/paypal.class.php');
			
			$Paypal = new Paypal();
			
			$Paypal->ipnnotification();
?>