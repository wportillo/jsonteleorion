<?php
/*
Uvault Live Streaming CDN
Token generator
Version 1.0.2
January 12, 2011

Requires PHP version 5 or greater

This class generates time sensitive access tokens for use with Uvault's Live Streaming CDN.
Before deploying this class, please set the configurable options below. 
Please see the included documentation for instructions on how to use the generated tokens with your Streaming account
*/

/* BEGIN CONFIGURABLE SETTINGS  */

define("UVAULT_TOKEN_SECRET_KEY", "TeL86F6Y6Kp83T"); // The secret key provided to you by customer support. Be sure to keep the quotes around this value.
define("UVAULT_TOKEN_LIFETIME", 600); // The lifetime of the generated tokens, in seconds. Should be 30 or greater No quotes around this value

/* END CONFIGURABLE SETTINGS. DO NOT CHANGE ANYTHING BELOW THIS LINE  */

class UvaultTokenGenerator{
	
	
	function UvaultTokenGenerator(){
	}
	
	function generateToken(){
		//[random value]-[secret key]-[unix creation time]-[lifetime in seconds]
		$token_random_half = $this->generateRandomHalf(20);
		$token_creation_time = time();
		$token_string = $token_random_half.'-'.UVAULT_TOKEN_SECRET_KEY.'-'.$token_creation_time.'-'.UVAULT_TOKEN_LIFETIME;
		$token_encoded = md5($token_string);
		
		//[md5 encoded token]-[random value]-[unix creation time]-[lifetime in seconds]
		$token_hash_string = $token_encoded.'-'.$token_random_half.'-'.$token_creation_time.'-'.UVAULT_TOKEN_LIFETIME;
		$token_hash = base64_encode($token_hash_string);
		$cleaned_token_hash = str_replace("=", "*", $token_hash);
		return $cleaned_token_hash;
		
	}

	function generateRandomHalf($chars){
		
		$r='';
		
		for($i=0;$i<=($chars-1);$i++){
			$r0 = rand(0,1); $r1 = rand(0,2);
			if($r0==0){$r .= chr(rand(ord('a'),ord('k')));}
			elseif($r0==1){ $r .= rand(0,9); }
			if($r1==0){ $r = strtolower($r); }
		}
		
		return $r;
	}

}
?>