<?php

/**
 * 
 * Merchant Account Api
 * @package
 * 
 */
class Merchant_account{
	
		public function connection($creditinfo){

			$apidata = array(
					'USER' 						=> USER_MERCHANT,
					'PWD' 							=> PWD_MERCHANT,
					'SIGNATURE' 			=> SIGNATURE_MERCHANT,
					'VERSION'		 			=> VERSION_MERCHANT,
					'METHOD'       			=>'DoDirectPayment',
					'PAYMENTACTION'	=>'Sale',
					'IPADDRESS'				=>get_real_ip(),
					'AMT'							=>$creditinfo['amount'],
					'ACCT'						    =>$creditinfo['number'],
					'EXPDATE'					=>$creditinfo['month'].$creditinfo['year'],
					'CVV2'			    			=>$creditinfo['cvv'],
					'FIRSTNAME' 			=>$creditinfo['c_name'],
					'LASTNAME'				=>$creditinfo['c_surname'],
					'STREET'        			=>$creditinfo['c_address'],
				//    'STATE'						=>'CA',
				 	'ZIP'								=>$creditinfo['c_zip'],
				//	'COUNTRYCODE'=>'US'
			);
			
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_HEADER, 0);
		//	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10); 
			curl_setopt($ch, CURLOPT_URL, HOST_MERCHANT.'?'.http_build_query($apidata)); 
			
			//$response = curl_exec($ch);
			
		//	$message = queryToArray(urldecode($response));
		
			$message['ACK']					    ='ok';
			
			$message['TRANSACTIONID'] ='Mastercard **** ***** **** 8803';
			
			
			switch($message['ACK']){
				case  	'Failure': 
				case  	'FailureWithWarning':
					Sysmessages::Excpetion($declinedtransaction);
				break;
			}
			
			return array('authcode'=> $message['TRANSACTIONID']);
		}
		
}
?>