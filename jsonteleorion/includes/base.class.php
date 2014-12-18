<?php
/*
 * Base Class
 */
	class Base{
		
		/**
		 * Decrypt Customer Id
		 *
		 * @param string encrypt id
		 * @ return array
		 *
		 */
			public static function idecrypt($id){
				return 	explode('-', decrypt($id, ENCRYPT_KEY));
			}
		
		/**
		 * Encrypt Customer Id
		 *
		 * @param string encrypt id
		 * @ return array
		 *
		 */
			public static function iencrypt($id){
				return encrypt("{$id}-".time(), ENCRYPT_KEY);
			}
			
		/**
		 *  Response
		 *
		 * @param $value
		 * @return void
		 */
			public static function response($value,$encrypt=false){
				switch(true){
					case (!is_array($value)):
						if($encrypt){
							print  encrypt($value, $encrypt) ;
						}else{
							print $value;
						}
						break;
					default:
							
						if($encrypt){
							print  encrypt(json_encode($value), $encrypt) ;
						}else{
							print json_encode($value);
						}
					break;
				}
			}
			
			/**
			 *  Messageresponse
			 *
			 * @param $value
			 * @param $action  
			 * @return void
			 */
			public static function messageresponse($value,$encode=true){
				
				if($encode){

					print  json_encode($value) ;
				
				}else{
					
					print  json_decode($value) ;
				
				}
				
			}
			
			
			
	}