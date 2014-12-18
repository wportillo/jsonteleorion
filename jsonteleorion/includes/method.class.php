<?php 
/*
 * Method class 
 */
	require_once 'includes/init.class.php';
	
	class Method extends Init{
	
	/*
	 * Get data
	 */
		public $getdata;
		
		/**
		 *  Automatic debit Customer
		 * @param integer $i_customer
		 * @param boolean $status
		 *
		 * @return void
		 *
		 */
		public function automaticdebit($debit=0,$i_customer){
		
			$this->c_info->primary_key='i_customer';
		
			$data['automatic_debit']	= $debit;
					
			$this->c_info->update($data, $i_customer);
		}
		/**
		 *  Restore Customer
		 * @param integer $i_customer
		 * @return void
		 */
		public function restore($i_customer){
		
			$this->c_info->primary_key='i_customer';
				
			$get_data = json_decode($this->get($i_customer));
				
			if($get_data->customer_info->trash==1){
					
				$data['trash']=0;
					
				$this->c_info->update($data, $i_customer);
			}
		}
		/**
		 *  Payment Method Customer
		 * @param integer $i_customer
		 * @param boolean $status
		 *
		 * @return void
		 *
		 */
		public function paymentmethod($method='credit',$i_customer){
		
			$this->c_info->primary_key='i_customer';
				
			if($method){
		
				$data['payment_method']	= $method;
					
				$this->c_info->update($data, $i_customer);
			}
		}
		/**
		 * Set customer product
		 * @param integer $i_customer
		 * @param string  $key_product
		 * @return void
		 */
			public function setproduct($i_customer,$key_product){
					
				$this->c_product->primary_key  = 'i_customer';
					
				$data['key_product']					= $key_product;
					
				$this->c_product->update($data, $i_customer);
			}
			
			/**
			 * Status Customer
			 * @param integer $i_customer
			 * @param boolean $status
			 * @return void
			 *
			 */
			public function setstatus($i_customer,$status){
			
				$this->c_info->primary_key='i_customer';
					
				if(is_int($status)){
			
					$data['active']=$status;
						
					$this->c_info->update($data, $i_customer);
				}
			}
			
			/**
			 * Update Customer info
			 *
			 * @param array $c_data
			 * @param integer $i_customer
			 */
			public function updatecustomerinfo($c_data,$i_customer){
			
				$this->c_info->primary_key='i_customer';
			
				$dbdata=array(
						'name'			=>	$c_data['name'],
						'surname'		=>	$c_data['surname'],
						'country'		=>	$c_data['country'],
						'email'			=>	$c_data['email'],
						'areacode'	=>	$c_data['areacode'],
						'phone'			=>	$c_data['phone'],	
						'password'	=>	encrypt($c_data['password'],ENCRYPT_KEY),
				);
				
				$this->c_info->update($dbdata, $i_customer);
			}
			
			/**
			 * Update Fb info
			 *
			 * @param array $c_data
			 * @param integer $i_customer
			 */
			public function updatefbid($c_data,$i_customer){
					
				$this->c_info->primary_key='i_customer';
					
				$dbdata=array(
						  'i_fbid'=>$c_data['i_fbid'],
				);
			
				$this->c_info->update($dbdata, $i_customer);
			}
			
			/**
			 * Update Fb info
			 *
			 * @param array $c_data
			 * @param integer $i_customer
			 */
			public function updateilog($c_data,$i_customer){
					
				$this->c_info->primary_key='i_customer';
					
				$dbdata=array(
						'i_log'=>$c_data['i_log'],
				);
					
				$this->c_info->update($dbdata, $i_customer);
			}
			
			/**
			 * Update Session
			 *
			 * @param array $c_data
			 * @param integer $i_customer
			 */
			public function updatesession($i_sess,$data){
				
				$dbdata=array(
						'i_customer'  =>$data['i_customer'],
						'session'		 => serialize_session($data),
				);
					
				$this->c_sess->update($dbdata, $i_sess);
			}
			
			
			/**
			 * Update Address info
			 *
			 * @param array $c_data
			 * @param integer $i_customer
			 */
			public function updateaddressinfo($c_data,$i_customer){
					
				$this->c_info->primary_key='i_customer';
					
				$dbdata=array(
						'address'   	  	  => $c_data['address'],
						'state'   	  	  	  => $c_data['state'],
						'zip'   	  	 	  => $c_data['zip'],
						'city'	  	  	 	  => $c_data['city'],
						'country'			  =>  $c_data['country'],
				);
			
				$this->c_info->update($dbdata, $i_customer);
			}
			
			/**
			 * Update Product
			 *
			 * @param string $key_product
			 * @param	integer $i_customer
			 *
			 * @return boolean
			 *
			 */
			public function updateproduct($key_product,$i_customer){
			
				$data['key_product']	=	$key_product;
			
				$this->c_product->primary_key ='i_customer';
			
				$this->c_product->update($data, $i_customer);
					
			}	
			/**
			 * Get PHP sess
			 * @param string $i_sess
			 * @param	integer $i_customer
			 *
			 * @return  mixed array or boolean
			 *
			 */
				public function getsess($i_sess){
					return	$this->c_sess->get($i_sess);
				}
				
				/**
				 * Get Device serial
				 * @param string $i_device
				 * @param	integer $i_customer
				 *
				 * @return  mixed array or boolean
				 *
				 */
				public function getdevice($i_device){
					return	$this->c_device->get($i_device);
				}
			
			/**
			 * Get Customer Info
			 * @param integer $i_customer
			 * @return json
			 */
			
			public function getinfo($i_customer,$dataname=false){
				
				$return_data;
				
				require_once 'includes/creditcheck.class.php';
	
			/**
			 * 
			 * Credit Info
			 */	
				
					$this->c_credit->primary_key='i_customer';	  
					
					$this->c_credit->fields=array('c_name','c_surname','c_zip','month','year','c_address','number','cvv');
					
					
					
					
					$this->c_fav->primary_key='i_customer';

					$this->c_device->primary_key='i_customer';
					
					$this->c_device->nolimit=true;
					
					$this->c_device->fields=array('i_serial','type');
					
				/**
				 * 
				 * Product Info 
				 */		
					$this->c_product->primary_key='i_customer';

					$this->c_product->fields=array('i_product','key_product','subscription_date');
					
				/**
				 * Date
				 */	
					$this->c_date->primary_key='i_customer'; 	  
					
					$this->c_date->fields=array('creation_date','last_payment','next_payment','valid');
				
				/**
				 * Payment History
				 */	
						$this->p_history->primary_key='i_customer'; 
						
						$this->p_history->nolimit=true;
						
						$this->p_history->fields=array('transdate','authcode','amount','type');
						
			/**
			 * Customer Info
			 */			
						
					$this->c_info->fields=array('name','surname','email','automatic_debit','active','phone','areacode','payment_method','country');
						
					$customer_info=array(
							'customer_info'     	=> $this->c_info->get($i_customer),
							'credit_info'      	    => $this->c_credit->get($i_customer),
							'device_info'      		=> $this->c_device->get($i_customer),
							'fav_info'     		    	=> $this->c_fav->get($i_customer),
							'date_info'     		    => $this->c_date->get($i_customer),
							'payment_history' 	=> $this->p_history->get($i_customer),
							'product_info'			=> $this->c_product->get($i_customer)
					);
				
					$customer_info['credit_info']['type'] = 	$this->getcredittype($customer_info['credit_info']['number']);
					
					if($dataname){
						
						$section = explode(',', $dataname);
						
						foreach($section as $value){
							$return_data[$value] = $customer_info[$value];
						}
						
						return $return_data;
							
					}else{

						return $customer_info;
					
					}
			}
			
			
			
			/**
			 * Make Payment
			 *
			 * @param integer $i_customer
			 *
			 * @return message
			 *
			 */
				public function makepayment($i_customer,$key_product,$monthly=false){
				
					$Crm_store		= new Crm_store();
					
					$Crm_reseller	= new Crm_reseller();
					
					require_once 'includes/merchant.class.php';
				
					$Merchant = new Merchant_account();
				
					$getdata  	= array(
							'product_info'		=>   $this->getproduct($key_product),
							'customer'			=>	$this->getinfo($i_customer,'credit_info')
					);
					
					$creditdata  = array(
							'number' 			=> decrypt($getdata['customer']['credit_info']['number'],ENCRYPT_KEY),
							'cvv'				=> decrypt($getdata['customer']['credit_info']['cvv'],ENCRYPT_KEY),
							'c_zip' 			=> $getdata['customer']['credit_info']['c_zip'],
							'c_name' 			=> $getdata['customer']['credit_info']['c_name'],
							'c_surname' 		=> $getdata['customer']['credit_info']['c_surname'],
							'c_address' 		=> $getdata['customer']['credit_info']['c_address'],
							'month' 			=> $getdata['customer']['credit_info']['month'],
							'year' 				=> $getdata['customer']['credit_info']['year'],
							'type' 				=> $getdata['customer']['credit_info']['type'],
							'i_customer' 		=> $i_customer,
							'amount'			=> ($monthly) ? $getdata['product_info']['subscription'] : $getdata['product_info']['amount']
					);
						
					if(isset($data['i_reseller'])){
						
						if($data['i_reseller']!='0' && $data['i_store']=='0'){

							$row_reseller = $Crm_reseller->get($data['i_reseller']);
								
							$amount = ($monthly) ? $getdata['product_info']['subscription'] : $getdata['product_info']['amount'];
								
							$commission 	  = ($monthly) ? $row_reseller['commission'] : $row_reseller['create_commission'];
							
							$amount_reseller  =  $amount - (($amount*$commission)/100) ;
						
							$this->setbalance_reseller($data['i_reseller'], $amount_reseller);
						}
					}
					
						$mmessage = $Merchant->connection($creditdata);
				
						$creditdata['authcode'] = $mmessage['authcode'];
				
						$creditdata['post'] 	= '';
						
						$this->paymenthistory($creditdata);
							
						$this->customerdate($i_customer,$key_product);
						
						return $mmessage;
				}
				

				/**
				 * Make Reseller Payment
				 *
				 * @param integer $i_reseller
				 * @param float   $amount
				 *
				 * @return message
				 *
				 */
					public function makeresellerpayment($i_reseller,$amount){
					
						require_once 'includes/merchant.class.php';
					
						$Merchant = new Merchant_account();
					
						$credit_info = new Crm_reseller_credit_info();

						$credit_info->primary_key='i_reseller';
						
						$getdata = $credit_info->get($i_reseller);
						
						$creditdata  = array(
								'number' 			=> decrypt($getdata['number'],ENCRYPT_KEY),
								'cvv'				=> decrypt($getdata['cvv'],ENCRYPT_KEY),
								'c_zip' 			=> $getdata['c_zip'],
								'c_name' 			=> $getdata['c_name'],
								'c_surname' 		=> $getdata['c_surname'],
								'c_address' 		=> $getdata['c_address'],
								'i_reseller' 		=> $i_reseller,
								'i_store' 			=> '0',
								'i_customer' 		=> '0',
								'month' 			=> $getdata['month'],
								'year' 				=> $getdata['year'],
								'i_reseller' 		=> $i_reseller,
								'amount'			=> $amount
						);
					
						$mmessage = $Merchant->connection($creditdata);
					
						$creditdata['authcode'] = $mmessage['authcode'];
						
						$creditdata['type']	    = $mmessage['authcode'];
						
						$this->resellerpaymenthistory($creditdata);
						
						$this->setbalance_reseller($i_reseller, $amount,'-');
							
						return $mmessage;
					}
				
				/**
				 * Make Debit Payment
				 *
				 * @param integer $i_customer
				 * @param array	  $reseller_data
				 * @param string  $key_product
				 * 
				 * @return message
				 *
				 */
					public function makedebitpayment($i_customer,$data,$monthly=false){

						$Crm_store		= new Crm_store();
						
						$Crm_reseller	= new Crm_reseller();
						
						$getdata  	= array(
								'product_info'		=>  $this->getproduct($data['key_product']),
						);
					
						if($data['i_reseller']!='0' && $data['i_store']=='0'){
							
							$row_reseller = $Crm_reseller->get($data['i_reseller']);
							
							$amount = ($monthly) ? $getdata['product_info']['subscription'] : $getdata['product_info']['amount'];
							
							$commission 	  = ($monthly) ? $row_reseller['commission'] : $row_reseller['create_commission'];
						
							$amount_reseller  =  $amount - (($amount*$commission)/100) ;
							
							$this->setbalance_reseller($data['i_reseller'], $amount_reseller);
							
							$creditdata = array(
									'authcode'			=> "Debit / {$row_reseller['name']}",
									'i_customer' 		=> $i_customer,
									'i_reseller' 		=> $data['i_reseller'],
									'i_store' 			=> $data['i_store'],
									'type'				=> "Debit / {$row_reseller['name']}",
									'amount'			=> $amount_reseller
							);
						
							$creditcustomer 		 = $creditdata;
							
							$creditcustomer['amount']= $amount;
							
							$creditcustomer['post']='';
						}
					
						if($data['i_store']!='0'){
						
							//$row_store = $Crm_store->get($data['i_store']);
							
						//	$amount_store = (($getdata['product_info']['amount']*$row_store['create_commission'])/100);
								
							$row_reseller = $Crm_reseller->get($data['i_reseller']);
							
							$amount = $getdata['product_info']['amount'];
								
							$amount_reseller  = ($amount -($amount*$row_reseller['create_commission'])/100);
							
							$this->setbalance_reseller($data['i_reseller'], $amount_reseller);
							
							//$this->setbalance_store($data['i_store'], $getdata['product_info']['amount']);
						}
						
						$this->paymenthistory($creditcustomer);

						$this->resellerpaymenthistory($creditdata);
						
						$this->customerdate($i_customer,$data['key_product']);
					
						return $creditdata;
					}
			/*
			 * Payment History
			 * @param array $c_data
			 * @retrun void
			 */
			public function paymenthistory($c_data){
			
				$data=array(
						'i_customer'	  	  => $c_data['i_customer'],
						'amount'		  	  => $c_data['amount'],
						'authcode'	   	 	  => $c_data['authcode'],
						'type'				  => $c_data['type'],
						'post'				  => $c_data['post']
				);
			
				$this->p_history->add($data);
			}
		   
		   /*
			* Payment History
			* @param array $c_data
			* @retrun void
			*/
			public function resellerpaymenthistory($c_data){
					
				$data=array(
						'i_reseller'	  	  => $c_data['i_reseller'],
						'i_customer'	  	  => $c_data['i_customer'],
						'i_store'	  	  	  => $c_data['i_store'],
						'amount'		  	  => $c_data['amount'],
						'authcode'	   	 	  => $c_data['authcode'],
						'type'				  => $c_data['type'],
				);
					
				$this->r_history->add($data);
			}
			
			
			/**
			 * Setbalance Reseller
			 * 
			 * @param integer $i_reseller
			 * @param float $amount
			 */
				public function setbalance_reseller($i_reseller,$amount,$operator='+'){
					
					$sql = "UPDATE `crm_reseller` SET `balance` =  balance {$operator} {$amount} WHERE `crm_reseller`.`i_reseller` = {$i_reseller};";
				
					db::query($sql);
				}
			/**
			 * Setrefound Reseller
			 *
			 * @param integer $i_reseller
			 * @param float $amount
			 */
			public function setrefound_reseller($i_reseller,$amount,$operator='+'){
					
				$sql = "UPDATE `crm_reseller` SET `refound` =  refound {$operator} {$amount} WHERE `crm_reseller`.`i_reseller` = {$i_reseller};";
			
				db::query($sql);
			}	
			/**
			 *
			 * Setbalance Store
			 * 
			 * @param integer $i_store
			 * @param float $amount
			 */
				public function setbalance_store($i_store,$amount,$operator='+'){
				
					$sql = "UPDATE `crm_store` SET `balance` =  balance {$operator} {$amount} WHERE `crm_store`.`i_store` = {$i_store};";
						
					db::query($sql);
				}
			
			
			/*
			 * Customer Date
			* @param array $c_data
			* @retrun array $data
			*/
			public function customerdate($i_customer,$key_product){
			
				$productdata      						= $this->getproduct($key_product);
					
				switch($key_product){
					case 'freeorion':
						$data['valid'] = mydateadd(mydate(), $productdata['cycle'] );
					break;
					default:
						
						/*
						 *  Last Payment to Timestamp
						 */
							
						$customerdata  			     = $this->getinfo($i_customer);
						
						$lastpaymentdate 		     = $customerdata['date_info']['last_payment'];
			
						$nextpaymentdate 		     = $customerdata['date_info']['next_payment'];
							
						$nextpaymenttimestamp  = mydatetotimestamp($customerdata['date_info']['next_payment']);
			
						if(Check::nulldate($lastpaymentdate)){
			
							$data['next_payment'] = mydateadd(mydate(), $productdata['cycle']);
						
							$data['valid'] = mydateadd(mydate(), $productdata['cycle']);

						}else{

									if(Check::expireddate($nextpaymenttimestamp)){
									
										$data['next_payment'] = mydateadd(mydate(), $productdata['cycle'] );
										
										$data['valid']   	  = mydateadd(mydate(), $productdata['cycle'] );
										
									}else{
										
										$data['next_payment'] = mydateadd($nextpaymentdate, $productdata['cycle']);
									
										$data['valid'] = mydateadd($nextpaymentdate, $productdata['cycle']);
									}
									
						}
									$data['last_payment']  	 = mydate();

						break;
				}
				
				$this->c_date->primary_key='i_customer';
					
				$this->c_date->update($data,$i_customer);
			
				return $data;
			}
			
			/**
			 * Update credit
			 *
			 * @var array $c_data
			 * @var inger $i_customer
			 */
				public function updatecredit($c_data,$i_customer){
						
					$this->c_credit->primary_key='i_customer';
						
					$data = array(
							'c_name' 			=> $c_data['c_name'],
							'c_surname' 		=> $c_data['c_surname'],
							'c_zip'				=> $c_data['c_zip'],
							'month' 			=> $c_data['month'],
							'year'				=> $c_data['year'],
							'c_address' 		=> $c_data['c_address'],
							'number'			=> encrypt($c_data['number'], ENCRYPT_KEY),
							'cvv'				=> encrypt($c_data['cvv'], ENCRYPT_KEY)
					);
					
					$this->c_credit->update($data, $i_customer);
				}
			
			/*
			 * Sendnotify
			 *
			 * @params $c_data
			 *
			 * @return   $c_data
			 */
			public function sendnotify($c_data){
			
				require_once 'includes/sndsms.class.php';
			
				require_once 'includes/phpmailer/class.phpmailer.php';
			
				require_once 'includes/email.class.php';
			
				$Email = 	new Email();
			
				$Sms 	=  new Sendsms();
					
				$send_email = array(
						'action'			=>	'background_email',
						'template'		=>	array(
								'config'        => array('template' => $c_data['template']),
								'print_vars'  => $c_data['print_vars_'.$c_data['lang']],
						),
						'subject' 		=>  $c_data['subject_'.$c_data['lang']] ,
						'from'	  		=>  $c_data['from'],
						'fromname'	=>  $c_data['fromname_'.$c_data['lang']],
						'bcc'     		=>  true,
						'address' 		=>  (!isset($c_data['email']))?false : array('email'=>$c_data['email'],'name'=>ucfirst($c_data['name']).' '.ucfirst($c_data['surname']))
				);
					
				$Email->Send($send_email);
					
				if(!isset($c_data['notsms'])){
						
					$sms_data	 =	  array('areacode' =>$c_data['areacode'],'phone'=>$c_data['phone'],'body'=>$c_data['body_'.$c_data['lang']]);
			
					$Sms->send($sms_data);
				}
			}
			
			/**
			 * Delete Customer
			 * @param integer $i_customer
			 * @return void
			 *
			 */
			public function delete($i_customer){
					
				$this->c_info->primary_key='i_customer';
			
				$get_data = json_decode($this->get($i_customer));
					
				if($get_data->customer_info->trash==0){
			
					$data['trash']=1;
			
					$this->c_info->update($data, $i_customer);
						
				}else{
					$this->c_info->delete($i_customer);
				}
			}
			
			/**
			 * Get Credit type
			 * @var string $number
			 */
				public function getcredittype($number){
					
						require_once 'includes/creditcheck.class.php';
						
						$Creditchek = new Creditcheck();
						
						$number    = decrypt($number,ENCRYPT_KEY);

						$credit_type = $Creditchek->CreditCard($number);
							
						if($credit_type['type']){
							return  $credit_type['type'].' **** ***** **** '.substr($number,-4);
						}else{
							return null;
						}
				}
			
			/**
			 * Search Customer
			 * @param string $search_email
			 * @param string $primary
			 * 
			 * @return mixed boolean,array
			 *
			 */
				public function getcustomer($search_email,$primary){

					$this->c_info->primary_key=$primary;
						
					$row = $this->c_info->get($search_email);

					return $row;
				}
			/*
			 * Search products
			*
			* @param string $key_product
			* @ return  mixed array boolean
			*/
				public function getproduct($key_product){
				
					$this->product_info->primary_key='key_product';
				
					$row = $this->product_info->get($key_product);
				
					return $row;
				}
	}
?>