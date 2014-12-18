<?php 
/**
 * Data Check
 */
	class Datacheck{
		
		/**
		 *   Deviceinfo
		 * @param array $c_data
		 */
		public static function deviceinfo($c_data){
		
				if(!isset($c_data['lang'])){
							Sysmessages::Excpetion(Sysmessages::$lang);
				}

				if(!isset($c_data['type'])){
						Sysmessages::Excpetion(Sysmessages::$device);
				}

				if(!isset($c_data['type'])){
					Sysmessages::Excpetion(Sysmessages::$device);
				}
				if($c_data['type']=='0'){
					Sysmessages::Excpetion(Sysmessages::$device);
				}
				if(!isset($c_data['i_serial'])){
					Sysmessages::Excpetion(Sysmessages::$invalidserial);
				}
			
				switch($c_data['type']){
					case 'android':
					case 'netgear':
	
						$c_data['i_serial'] = string_to_mac($c_data['i_serial']);
	
						if(!Check::mac($c_data['i_serial'])){
							Sysmessages::Excpetion(Sysmessages::$invalidmac);
						}
					break;
				}
			
				return $c_data;
		}
		
		/**
		 *   contactinfo
		 * @param array $c_data
		 */
				public static function contactinfo($c_data){
						
					if(isset($c_data['name'])){
							
						if(!Check::lenght($c_data['name'],1,50)){
							Sysmessages::Excpetion(Sysmessages::$checkname);
						}
							
					}else{
						Sysmessages::Excpetion(Sysmessages::$name);
					}
				
					if(isset($c_data['surname'])){
						if(!Check::lenght($c_data['surname'],1,50)){
							Sysmessages::Excpetion(Sysmessages::$checksurname);
						}
					}else{
						Sysmessages::Excpetion(Sysmessages::$surname);
					}
						
					if(isset($c_data['email'])){
						if(!Check::email($c_data['email'])){
							Sysmessages::Excpetion(Sysmessages::$validemail);
						}
					}else{
						Sysmessages::Excpetion(Sysmessages::$email);
					}
						
					if(isset($c_data['email_repeat'])){
						if($c_data['email_repeat']!=$c_data['email']){
							Sysmessages::Excpetion(Sysmessages::$checkverifyemail);
						}
					}else{
						Sysmessages::Excpetion(Sysmessages::$verifyemail);
					}
						
					if(isset($c_data['country'])){
						if($c_data['country']=='0'){
							Sysmessages::Excpetion(Sysmessages::$checkcountry);
						}
					}else{
						Sysmessages::Excpetion(Sysmessages::$country);
					}
					if(isset($c_data['areacode'])){
						if(!Check::lenght($c_data['areacode'],1,50)){
							Sysmessages::Excpetion(Sysmessages::$checkcountrycode);
						}
					}else{
						Sysmessages::Excpetion(Sysmessages::$countrycode);
					}
						
					if(isset($c_data['phone'])){
						if(!Check::lenght($c_data['phone'],2,50)){
							Sysmessages::Excpetion(Sysmessages::$checkphone);
						}
					}else{
						Sysmessages::Excpetion(Sysmessages::$phone);
					}
						
					if(isset($c_data['request'])){
						if($c_data['request']=='0'){
							Sysmessages::Excpetion(Sysmessages::$requestcontact);
						}
					}else{
						Sysmessages::Excpetion(Sysmessages::$requestcontact);
					}
						
					if(isset($c_data['message'])){
						if(!Check::lenght($c_data['message'],20,100)){
							Sysmessages::Excpetion(Sysmessages::$checkmessagecontact);
						}
					}else{
						Sysmessages::Excpetion(Sysmessages::$messagecontact);
					}
				
					return $c_data;
				}
				
				/**
				 * Recoveryinfo
				 *
				 */
				public static function recoveryinfo($c_data){
				
					if(!isset($c_data['lang'])){
						Sysmessages::Excpetion(Sysmessages::$lang);
					}
				
					if(!isset($c_data['email'])){
						Sysmessages::Excpetion(Sysmessages::$email);
					}
						
					if(!Check::email($c_data['email'])){
						Sysmessages::Excpetion(Sysmessages::$validemail);
					}
					
					if(!isset($c_data['email_repeat'])){
						Sysmessages::Excpetion(Sysmessages::$verifyemail);
					}
					
					if($c_data['email_repeat']!=$c_data['email']){
							Sysmessages::Excpetion(Sysmessages::$checkverifyemail);
					}
				
					$Method = new Method();

					$row= $Method->getcustomer($c_data['email'],'email');
					
					if(!$row){
						Sysmessages::Excpetion(Sysmessages::$invalidemail);
					}
			
					return $c_data;
				}
				
			/**
			 * Login Fb
			 *
			 */	
			public static function logininfofb($c_data){
				
				if(!isset($c_data['lang'])){
					Sysmessages::Excpetion(Sysmessages::$lang);
				}
				
				if(!isset($c_data['i_fbid'])){
					Sysmessages::Excpetion(Sysmessages::$invalidfbid);
				}
					
				$Method = new Method();
				
				$row= $Method->getcustomer($c_data['i_fbid'],'i_fbid');
					
				if(!$row){
					
					Sysmessages::Excpetion(Sysmessages::$unlinkfacebook);
				}
								
				return $c_data;
			}	
			
			/**
			 * Login info
			 *
			 */
				public static function logininfo($c_data){
						
					if(!isset($c_data['lang'])){
						Sysmessages::Excpetion(Sysmessages::$lang);
					}

					if(!isset($c_data['email'])){
						Sysmessages::Excpetion(Sysmessages::$email);
					}else{
						if(!Check::email($c_data['email'])){
							Sysmessages::Excpetion(Sysmessages::$validemail);
						}else{
								
							$Method = new Method();
	
							$row= $Method->getcustomer($c_data['email'],'email');
							
							if(!$row){
								Sysmessages::Excpetion(Sysmessages::$invalidemail);
							}
						}
					}
						
					if(!isset($c_data['password'])){
						Sysmessages::Excpetion(Sysmessages::$password);
					}else{
						if(!Check::lenght($c_data['password'],2,50)){
							Sysmessages::Excpetion(Sysmessages::$checkpassword);
						}else{
							if(decrypt($row['password'], ENCRYPT_KEY) != $c_data['password']){
								Sysmessages::Excpetion(Sysmessages::$invalidpassword);
							}
						}
					}
					
					return $c_data;
				
				}
			
			/**
			 * Cinfo data
			 */
			public static function cinfo($c_data){
				
				if(!isset($c_data['lang'])){
					Sysmessages::Excpetion(Sysmessages::$lang);
				}
				
				if(isset($c_data['name'])){
					if(!Check::lenght($c_data['name'],2,50)){
						Sysmessages::Excpetion(Sysmessages::$checkname);
					}
				}else{
					Sysmessages::Excpetion(Sysmessages::$name);
				}
					
				if(isset($c_data['surname'])){
					if(!Check::lenght($c_data['surname'],2,50)){
						Sysmessages::Excpetion(Sysmessages::$checksurname);
					}
				}else{
					Sysmessages::Excpetion(Sysmessages::$surname);
				}
					
				if(isset($c_data['email'])){
					if(!Check::email($c_data['email'])){
						Sysmessages::Excpetion(Sysmessages::$validemail);
					}
				}else{
					Sysmessages::Excpetion(Sysmessages::$email);
				}
					
				if(isset($c_data['email_repeat'])){
					if($c_data['email_repeat']!=$c_data['email']){
						Sysmessages::Excpetion(Sysmessages::$checkverifyemail);
					}else{
							
						unset($c_data['email_repeat']);
							
						$Method = new Method();

						if($Method->getcustomer($c_data['email'],'email')){
							Sysmessages::Excpetion(Sysmessages::$existemail);
						}
							
					}
				}else{
					Sysmessages::Excpetion(Sysmessages::$verifyemail);
				}
					
				if(isset($c_data['password'])){
					if(!Check::lenght($c_data['password'],1,50)){
						Sysmessages::Excpetion(Sysmessages::$checkpassword);
					}
				}else{
					Sysmessages::Excpetion(Sysmessages::$password);
				}
					
				if(isset($c_data['password_repeat'])){
					if($c_data['password']!=$c_data['password_repeat']){
						Sysmessages::Excpetion(Sysmessages::$checkverifypassword);
					}else{
						unset($c_data['password_repeat']);
					}
				}else{
					Sysmessages::Excpetion(Sysmessages::$verifypassword);
				}
					
				if(isset($c_data['country'])){
					if($c_data['country']=='0'){
						Sysmessages::Excpetion(Sysmessages::$checkcountry);
					}
				}else{
					Sysmessages::Excpetion(Sysmessages::$country);
				}
					
				if(isset($c_data['areacode'])){
					if(!Check::lenght($c_data['areacode'],1,50)){
						Sysmessages::Excpetion(Sysmessages::$checkcountrycode);
					}
				}else{
					Sysmessages::Excpetion(Sysmessages::$countrycode);
				}
					
				if(isset($c_data['phone'])){
					if(!Check::lenght($c_data['phone'],1,50)){
						Sysmessages::Excpetion(Sysmessages::$checkphone);
					}
				}else{
					Sysmessages::Excpetion(Sysmessages::$phone);
				}
				
				return $c_data;
			}
			
			/*
			 * Address Info
			 */
			public static function addressinfo($c_data){
				
				if(isset($c_data['address'])){
					if(!Check::lenght($c_data['address'],3,50)){
						Sysmessages::Excpetion(Sysmessages::$checkaddress);
					}
				}else{
					Sysmessages::Excpetion(Sysmessages::$address);
				}
				
				if(isset($c_data['city'])){
					if(!Check::lenght($c_data['city'],3,50)){
						Sysmessages::Excpetion(Sysmessages::$checkcity);
					}
				}else{
					Sysmessages::Excpetion(Sysmessages::$city);
				}
				
				if(isset($c_data['state'])){
					if(!Check::lenght($c_data['state'],3,50)){
						Sysmessages::Excpetion(Sysmessages::$checkstate);
					}
				}else{
					Sysmessages::Excpetion(Sysmessages::$state);
				}
				
				if(isset($c_data['zip'])){
					if(!Check::lenght($c_data['zip'],2,50)){
						Sysmessages::Excpetion(Sysmessages::$zip);
					}
				}else{
					Sysmessages::Excpetion(Sysmessages::$checkzip);
				}
				
				return $c_data;
			}

			/*
			 * Check Debit info
			* @param array $c_data
			* @return array mixed
			*/
				public static function debitinfo($c_data){
	
					$Crm_store		= new Crm_store();
						
					$Crm_reseller	= new Crm_reseller();
					
					if(!isset($c_data['i_reseller'])){
							
						Sysmessages::Excpetion(Sysmessages::$i_reseller);
					}
					
					if($c_data['i_reseller']=='0'){
							
						Sysmessages::Excpetion(Sysmessages::$i_reseller);
					}	
					
					if(!isset($c_data['i_store'])){
							Sysmessages::Excpetion(Sysmessages::$i_store);
					}	
					
					if($c_data['i_reseller']!='0' && $c_data['i_store']=='0'){

						$rowr = $Crm_reseller->get($c_data['i_reseller']);
						
						if(!isdivisible($rowr['balance'], $c_data['product_info']['amount'])){
							Sysmessages::Excpetion(Sysmessages::$reseller_balance);
						}
					}
					
					
					if($c_data['i_store']!='0'){
					
						$rowr = $Crm_reseller->get($c_data['i_reseller']);
						
						if(!isdivisible($rowr['balance'], $c_data['product_info']['amount'])){
							Sysmessages::Excpetion(Sysmessages::$reseller_balance);
						}
						
						$rows = $Crm_store->get($c_data['i_store']);
						
						if(!isdivisible($rows['balance'], $c_data['product_info']['amount'])){
							Sysmessages::Excpetion(Sysmessages::$store_balance);
						}
					}
					
					return  $c_data;
				}
		   /*
			* Check Cinfo
			* @param array $c_data
			* @return array mixed
			*/
			public static function creditinfo($c_data){
			
				require_once 'includes/creditcheck.class.php';
			
				$Creditchek = new Creditcheck();
			
				if(!isset($c_data['lang'])){
			
					Sysmessages::Excpetion(Sysmessages::$lang);
			
				}
			
				if(isset($c_data['c_name'])){
			
					if(!Check::lenght($c_data['c_name'],2,50)){
						Sysmessages::Excpetion(Sysmessages::$checkname);
					}
			
				}else{
					Sysmessages::Excpetion(Sysmessages::$name);
				}
			
				if(isset($c_data['c_surname'])){
			
					if(!Check::lenght($c_data['c_surname'],2,50)){
						Sysmessages::Excpetion(Sysmessages::$checksurname);
					}
			
				}else{
					Sysmessages::Excpetion(Sysmessages::$surname);
				}
			
				if(isset($c_data['number'])){
					if(!Check::lenght($c_data['number'],1,50)){
						Sysmessages::Excpetion(Sysmessages::$creditnumber);
					}else{
							
						if(!$Creditchek->LuhnCheck($c_data['number'])){
							Sysmessages::Excpetion(Sysmessages::$checkcreditnumber);
						}
					}
				}else{
					Sysmessages::Excpetion(Sysmessages::$creditnumber);
				}
			
				if(isset($c_data['cvv'])){
					if(!Check::lenght($c_data['cvv'],1,5)){
						Sysmessages::Excpetion(Sysmessages::$checkcvvnumber);
					}
				}else{
					Sysmessages::Excpetion(Sysmessages::$cvvnumber);
				}
			
				if(!isset($c_data['month']) ||  $c_data['month']==0){
					Sysmessages::Excpetion(Sysmessages::$month);
				}
			
				if(!isset($c_data['year']) ||  $c_data['year']==0){
					Sysmessages::Excpetion(Sysmessages::$year);
				}
			
				if(isset($c_data['year']) && isset($c_data['month'])){
					if(!$Creditchek->Card_Expiration_Check($c_data['month'],$c_data['year'])){
						Sysmessages::Excpetion(Sysmessages::$cardexpired);
					}
				}
			
				if(isset($c_data['c_address'])){
					if(!Check::lenght($c_data['c_address'],3,50)){
						Sysmessages::Excpetion(Sysmessages::$checkaddress);
					}
				}else{
					Sysmessages::Excpetion(Sysmessages::$address);
				}
			
				if(isset($c_data['c_zip'])){
					if(!Check::lenght($c_data['c_zip'],2,50)){
						Sysmessages::Excpetion(Sysmessages::$checkzip);
					}
				}else{
					Sysmessages::Excpetion(Sysmessages::$zip);
				}
			
				return $c_data;
			}
			
		/**
		 * Cehck FreeInfo
		 */
			public static function freeinfo($c_data){
					return self::cinfo($c_data);
			}
		
		/**
		 * Reseller Payment Info
		 * 
		 */
			public static function resellerpaymentinfo($c_data){
				
				$Crm_reseller_credit_info =  new Crm_reseller_credit_info();
				
				$Crm_reseller_credit_info->primary_key='i_reseller';
				
				if(!isset($c_data['i_reseller'])){
					Sysmessages::Excpetion(Sysmessages::$i_reseller);
				}
				
				$row = $Crm_reseller_credit_info->get($c_data['i_reseller']);
				
				if(!$row){
					Sysmessages::Excpetion(Sysmessages::$reseller_payment);
				}
				
				if($row['number']==''){
					Sysmessages::Excpetion(Sysmessages::$reseller_payment);
				}
				
				if($c_data['amount']=='0'){
					Sysmessages::Excpetion(Sysmessages::$invalidamount);
				}
				
				return $c_data;
			}
		
		/**
		 * Check Premuimcinfo
		 */
			public static function premiumcinfo($c_data){
			
					$dbdata = self::cinfo($c_data);
		
					$temp_p['shipping'] =1;
		
					if(!isset($c_data['key_product'])){
							Sysmessages::Excpetion(Sysmessages::$product);
					}
					
					$Method = new Method();
		
					$product = $Method->getproduct($c_data['key_product']);
					
					if(!$product){
							Sysmessages::Excpetion(Sysmessages::$checkproduct);
					}
					
					$dbdata['product_info']	= $product;
					
					if($product['shipping']==1){
							$dbdata = self::addressinfo($dbdata);
					}	
						
					if(!isset($c_data['payment_method'])){
						Sysmessages::Excpetion(Sysmessages::$paymentmethod);
					}
					
					if($c_data['payment_method']=='0'){
						Sysmessages::Excpetion(Sysmessages::$paymentmethod);
					}
					
					
					switch ($c_data['payment_method']){
						case 'credit':
							$dbdata = self::creditinfo($dbdata);
						break;
						case 'debit':
							$dbdata = self::debitinfo($dbdata);
						break;
				    }
				   
					return $dbdata;
			}
	}
?>