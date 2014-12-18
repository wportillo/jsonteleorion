<?php
/**
 * Action Class
 */	
	class Memberactions extends Method{

				public $i_device;
				
				public $security;
				
			/**
			 * Action Construct
			 */
				public function __construct($data){
					
					/**
					 * Init Parent Construct
					 */
						parent::__construct();
						
						$this->getdata   		= objectToArray($data);
						
						$this->security 		 = new Security($data);
				}
				
				/**
				 * Get Products
				 * 
				 * @return json encode
				 */
					public function getproducts(){
					
                                                try{
						
							if(! ($i_customer = $this->security->validlogged() )){
								Sysmessages::Excpetion(Sysmessages::$loggederror);
							}
                                                         
                                                         Base::messageresponse($this->getproduct($this->getdata['key_product']));
						
						}catch (Exception $e){
                                                    
							Base::messageresponse(array('error'=>json_decode($e->getMessage())));
						}
                      }
					
				/*
				 * Get user Data
				 *
				 * @param encrypt id
				 *
				 * @return json decode
				 */
					public function getdata(){
	
						try{
	
							if(! ($i_customer = $this->security->validlogged() )){
								Sysmessages::Excpetion(Sysmessages::$loggederror);
							}
	
							
							if(isset($this->getdata['dataname'])){
						
								Base::messageresponse($this->getinfo($i_customer,$this->getdata['dataname']));
							
							}else{
							
								Base::messageresponse($this->getinfo($i_customer));
							}
							
						}catch (Exception $e){

							Base::messageresponse(array('error'=>json_decode($e->getMessage())));
						
						}
					}
			  /**
				 *  Change plan
				 *
				 *  @param object $c_data
				 */
				
				public function changeplan(){
					
					require_once 'includes/datacheck.class.php';

					try{
						
						if(!isset($this->getdata['i_reseller'])){
						
							if(! ($i_customer = $this->security->validlogged())){
								Sysmessages::Excpetion(Sysmessages::$loggederror);
							}
						}else{
							
							if($this->getdata['i_customer']=='0'){
								Sysmessages::Excpetion(Sysmessages::$invalidcustomer);
							}
							
							$i_customer = $this->getdata['i_customer'];
						}
						
						
						
						$product = $this->getproduct($this->getdata['i_product']);
						
						if($product['shipping']=='1'){
							Datacheck::addressinfo($this->getdata);
						}
						
						if($this->getdata['i_product']=='0'){
							Sysmessages::Excpetion(Sysmessages::$product);
						}
							
						if($this->getdata['payment_method']=='0'){
							Sysmessages::Excpetion(Sysmessages::$paymentmethod);
						}
							
						if($this->getdata['payment_method']=='credit'){
							
							$dbdata = Datacheck::creditinfo($this->getdata);
						}
				
						if($product['shipping']=='1'){
							$this->updateaddressinfo($this->getdata,$i_customer);
						}
						
						switch($this->getdata['payment_method']){
						
							case 'credit':
								
								$this->automaticdebit($this->getdata['automatic_debit'],$i_customer);
								
								$this->paymentmethod('credit',$i_customer);
								
								$this->updatecredit($this->getdata,$i_customer);
						
								$transinfo = $this->makepayment($i_customer,$this->getdata['i_product']);
						
								$this->updateproduct($this->getdata['i_product'],$i_customer);
					
								require_once 'includes/emailtemplate.class.php';
					
								$customer_info             		  	  = $this->getinfo($i_customer);
									
								$customer_info['authcode']      = $transinfo['authcode'];
								
								$customer_info['product_info'] = $this->getproduct($this->getdata['i_product']);
								
								$customer_info['lang']				  = $this->getdata['lang'];
					
								$this->sendnotify(Emailtemplates::premium($customer_info));

								Base::messageresponse(array('error'=>false));
							
							break;
							case 'debit':
								
								$this->getdata['key_product'] = $this->getdata['i_product'];
								
								$transinfo = $this->makedebitpayment($i_customer,$this->getdata);
								
								$this->updateproduct($this->getdata['i_product'],$i_customer);
								
								require_once 'includes/emailtemplate.class.php';
								
								$customer_info             	   		   = $this->getinfo($i_customer);
									
								$customer_info['lang']         		   = $this->getdata['lang'];
									
								$customer_info['authcode']     		   = $transinfo['authcode'];
								
								$customer_info['credit_info']['type']  = '--------------------';
								
								$customer_info['product_info'] = $this->getproduct($this->getdata['i_product']);
									
								$this->sendnotify(Emailtemplates::premium($customer_info));
								
								Base::messageresponse(array('error'=>false));
							
							break;
							case 'paypal':
								
								require_once 'includes/paypal.class.php';
						
								$Paypal 		   				  = new Paypal();

								$paypal_uri 					  =	$Paypal->inithtml($i_customer,$this->getdata['i_product']);

								Base::messageresponse(array('error'=>false,'paypal'=>$paypal_uri));

							break;
						}
						
					}catch(Exception $e){
						
						Base::messageresponse(array('error'=>json_decode($e->getMessage())));
					}
				}
				
				/*
				 * Update info
				 */
				public function updateinfo(){
		
					try{
						
						if(! ($i_customer = $this->security->validlogged() )){
							Sysmessages::Excpetion(Sysmessages::$loggederror);
						}
						
						require_once 'includes/datacheck.class.php';
						
						 Datacheck::cinfo($this->getdata);
						
						/**
						 * Get Duplicate Email
						 */
						 
						 $row = $this->getcustomer($this->getdata['email'],'email');
						 
						 if($row){

						 	print_r($row);
						 	if($row['i_customer']!=$i_customer){
						 		$this->error = json_decode(Sysmessages::Excpetion(Sysmessages::$existemail));
						 	}
						 }
						 
						 $this->updatecustomerinfo($this->getdata,$i_customer);
						 
						 $row = $this->getinfo($i_customer);
						 
						 require_once 'includes/emailtemplatesaccount.class.php';
						 
						 $row['lang'] = $this->getdata['lang'];
						 
						 $this->sendnotify(Emailtemplatesaccount::updateaccount($row));
						 
						Base::messageresponse(array('error'=>false));
						 	
					}catch(Exception $e){
						
						Base::messageresponse(array('error'=>json_decode($e->getMessage())));
					}
			}

			/**
			 * Update Credit Card
			 *
			 * @param array $c_data
			 */
			public function updatecreditinfo(){
			
				try {
					
					if(! ($i_customer = $this->security->validlogged() )){
							Sysmessages::Excpetion(Sysmessages::$loggederror);
					}
					
					if(!isset($this->getdata['payment_method'])){
							Sysmessages::Excpetion(Sysmessages::$paymentmethod);
					}
						
					if($this->getdata['payment_method']=='credit'){
						if($this->getdata['automatic_debit']=='false'){
							  Sysmessages::Excpetion(Sysmessages::$debit);
						}
							
						require_once 'includes/datacheck.class.php';
						
						$dbdata 	= Datacheck::creditinfo($this->getdata);
					}
					
					switch($this->getdata['payment_method']){
						case 'credit':
					
							$this->updatecredit($this->getdata, $i_customer);
								
							$this->automaticdebit($this->getdata['automatic_debit'],$i_customer);
								
							$this->paymentmethod('credit',$i_customer);
								
						break;
						case 'paypal':
								
							$this->paymentmethod('paypal',$i_customer);
						break;
					}
					
					$row 	= $this->getinfo($i_customer);
					
					require_once 'includes/emailtemplatesaccount.class.php';
					
					$row['lang'] =	$this->getdata['lang'];
						
					$row['credit_info']['type'] = $this->getcredittype($row['credit_info']['number']);

					$this->sendnotify(Emailtemplatesaccount::updatepaymentmethod($row));

					Base::messageresponse(array('error'=>false));
					
				}catch(Exception $e){
					Base::messageresponse(array('error'=>json_decode($e->getMessage())));
				}
			}
			
			/*
			 * Make Payment
			 */
				public function makecustomerpayment(){
						
					try {
						
						if(!isset($this->getdata['i_reseller'])){
						
							if(! ($i_customer = $this->security->validlogged())){
								Sysmessages::Excpetion(Sysmessages::$loggederror);
							}
						
							$customerinfo		 = $this->getinfo($i_customer);
						
						}else{

							if($this->getdata['i_customer']=='0'){
								Sysmessages::Excpetion(Sysmessages::$invalidcustomer);
							}
								
							$i_customer					   = $this->getdata['i_customer'];
						
							$customerinfo		 		   = $this->getinfo($i_customer);
							
							$this->getdata['product_info'] = $this->getproduct($customerinfo['product_info']['key_product']);
							
							if($this->getdata['payment_method']=='0'){
								Sysmessages::Excpetion(Sysmessages::$paymentmethod);
							}

							switch($this->getdata['payment_method']){
								case 'credit':
									require_once 'includes/datacheck.class.php';
									
									$dbdata = Datacheck::creditinfo($this->getdata);
									
									$this->updatecredit($this->getdata, $i_customer);
								break;
								case 'debit':
									require_once 'includes/datacheck.class.php';

									$dbdata = Datacheck::debitinfo($this->getdata);
								break;
							}
						}
						
					
							
						switch($this->getdata['payment_method']){
							case 'credit':

									$transinfo =  $this->makepayment($i_customer, $customerinfo['product_info']['key_product'],true);
									
									require_once 'includes/emailtemplate.class.php';
									
									$customerinfo['product_info'] 					  = $this->getproduct($customerinfo['product_info']['key_product']);
									
									$customerinfo['authcode'] 						  = $transinfo['authcode'];
									
									$customerinfo['lang'] 		  					  = $this->getdata['lang'];
									
									$this->sendnotify(Emailtemplates::makepayment($customerinfo));
									
									Base::messageresponse(array('error'=>false));
							
							break;
							case 'debit':
								
								$this->getdata['key_product'] = $customerinfo['product_info']['key_product'];
							
								$transinfo = $this->makedebitpayment($i_customer,$this->getdata,true);

								require_once 'includes/emailtemplate.class.php';
							
								$customerinfo             	   		   = $this->getinfo($i_customer);
									
								$customerinfo['lang']         		   = $this->getdata['lang'];
									
								$customerinfo['authcode']     		   = $transinfo['authcode'];
							
								$customerinfo['credit_info']['type']  = '--------------------';
							
								$customerinfo['product_info'] = $this->getproduct($this->getdata['key_product']);
								
								$this->sendnotify(Emailtemplates::makepayment($customerinfo));
							
								Base::messageresponse(array('error'=>false));
							
							break;
							
							case 'paypal':
								
								require_once 'includes/paypal.class.php';
								
								$Paypal 		   				  =   new Paypal();
								
								$paypal_uri 					  =	$Paypal->inithtml($i_customer, $customerinfo['product_info']['key_product']);
								
								Base::messageresponse(array('error'=>false,'paypal'=>$paypal_uri));
							break;
						}
					
					}catch(Exception $e){
						
						Base::messageresponse(array('error'=>json_decode($e->getMessage())));
					}
				}
			
			/**
			 *  link Device
			 */
				public function linkdevice(){

					try{
						
						if(! ($i_customer = $this->security->validlogged() )){
							Sysmessages::Excpetion(Sysmessages::$loggederror);
						}
						
						require_once 'includes/datacheck.class.php';
						
						Datacheck::deviceinfo($this->getdata);
							
						$this->c_device->primary_key='i_customer';
							
						$dbdata=array(
								'i_customer'	=> $i_customer,
								'i_serial'		=> $this->getdata['i_serial'],
						);
						
						$this->c_device->add($dbdata);
						
						Base::messageresponse(array('error'=>false));
							
					}catch(Exception $e){
						
						Base::messageresponse(array('error'=>json_decode($e->getMessage())));
						
					}
				}
				
				/**
				 *  link Device
				 */
				public function deletedevice(){
				
					try{
				
						if(! ($i_customer = $this->security->validlogged() )){
							Sysmessages::Excpetion(Sysmessages::$loggederror);
						}
				
						require_once 'includes/datacheck.class.php';
				
						Datacheck::deviceinfo($this->getdata);
							
						$this->c_device->primary_key='i_customer';
							
						$dbdata=array(
								'i_customer'	=> $i_customer,
								'i_serial'		=> $this->getdata['i_serial'],
						);
				
						$this->c_device->add($dbdata);
				
						Base::messageresponse(array('error'=>false));
							
					}catch(Exception $e){
				
						Base::messageresponse(array('error'=>json_decode($e->getMessage())));
				
					}
				}
	}
?>