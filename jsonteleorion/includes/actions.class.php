<?php
/**
 * Action Class
 */	
	class Actions extends Method{
					
			/**
			 * Action Construct
			 */
				public function __construct($data){
					
					/**
					 * Init Parent Construct
					 */
						parent::__construct();
				
						$this->getdata   = objectToArray($data);
						
				}
			/**
			 *  Add Free Customer
			 */
				public function addfree(){
					
					try {
						
						require_once(INCLUDE_PATH . 'datacheck.class.php');
						
						$password = rand(800, 9999);
						
						$this->getdata['password']		  = $password;
						
						$this->getdata['password_repeat'] = $password;
						
						$dbdata   = Datacheck::freeinfo($this->getdata);

						$i_customer = $this->initcustomer($dbdata);
							
						$this->setproduct($i_customer , 'freeorion');
							
						$this->setstatus($i_customer, 1);
						
						$this->customerdate($i_customer,'freeorion');
						
						require_once 'includes/emailtemplate.class.php';
						
						$customer_info     					 = $this->getinfo($i_customer);   
						
						$customer_info['customer_info']['password'] =$this->getdata['password'];
						
						$customer_info['lang']              		= $this->getdata['lang'];
							
						$customer_info['product_info'] = $this->getproduct('freeorion');
						
						$this->sendnotify(Emailtemplates::free($customer_info));
						
						Base::messageresponse(array('error'=>false));
							
					}catch (Exception $e){
						Base::messageresponse(array('error'=>json_decode($e->getMessage())));
					}
				
				}	
				
				/**
				 * Recharge Reseller
				 *
				 * @param json $c_data
				 */
					public function rechargereseller(){
					
						try{
							
							require_once(INCLUDE_PATH . 'datacheck.class.php');
							
								
								$dbdata = Datacheck::resellerpaymentinfo($this->getdata);
						
								
								$this->makeresellerpayment($dbdata['i_reseller'], $dbdata['amount']);
								
								Base::messageresponse(array('error'=>false));
						
						}catch(Exception $e){
						
							Base::messageresponse(array('error'=>json_decode($e->getMessage())));
						}
					}
				
				/**
				 * Add Premium Customer
				 *
				 * @param json $c_data
				 */
				public function addpremium(){
				
					$paypal_uri		 = false;
						
					try{
						
						require_once(INCLUDE_PATH . 'datacheck.class.php');
						
						$dbdata = Datacheck::premiumcinfo($this->getdata);
					
						$i_customer = $this->initcustomer($dbdata);
						
						$this->setproduct($i_customer, $dbdata['key_product']);
						
						switch($dbdata['payment_method']){
							
							case 'credit':

									$this->updatecredit($dbdata,$i_customer);
						
									$transinfo = $this->makepayment($i_customer,$dbdata['key_product']);
							
									$this->setstatus($i_customer, 1);
						
									require_once 'includes/emailtemplate.class.php';
						
									$customer_info             	   = $this->getinfo($i_customer);   
							      
									$customer_info['lang']         = $this->getdata['lang'];
									
									$customer_info['authcode']     = $transinfo['authcode'];

									$customer_info['product_info'] = $this->getproduct($dbdata['key_product']);
									
									$this->sendnotify(Emailtemplates::premium($customer_info));
						
									Base::messageresponse(array('error'=>false));
									
							break;
							
							case 'debit':

								$transinfo = $this->makedebitpayment($i_customer,$dbdata);
								
								$this->setstatus($i_customer, 1);
								
								require_once 'includes/emailtemplate.class.php';
								
								$customer_info             	   		   = $this->getinfo($i_customer);
									
								$customer_info['lang']         		   = $this->getdata['lang'];
									
								$customer_info['authcode']     		   = $transinfo['authcode'];
								
								$customer_info['credit_info']['type']  = '--------------------';
								
								$customer_info['product_info'] = $this->getproduct($dbdata['key_product']);
									
								$this->sendnotify(Emailtemplates::premium($customer_info));
								
								Base::messageresponse(array('error'=>false));
								
							break;
							case 'paypal':
								
								$this->paymentmethod('paypal',$i_customer);
								
								require_once 'includes/paypal.class.php';
						
								$Paypal 		   				  =   new Paypal();

								$paypal_uri 					  =	$Paypal->inithtml($i_customer,$this->getdata['key_product']);

								Base::messageresponse(array('error'=>false,'paypal'=>$paypal_uri));
								
								break;
						}
						
					
					}catch(Exception $e){
						
						Base::messageresponse(array('error'=>json_decode($e->getMessage())));
					
					}
				}
				
			/**
			 * Recovery password
			 */
				public function recoverypass(){
					
					$c_data	= $this->getdata;
					
					try{
						
						require_once 'includes/datacheck.class.php';
						
						$dbdata = Datacheck::recoveryinfo($this->getdata);
						
						require_once 'includes/emailtemplatebasic.class.php';
						
						$row= $this->getcustomer($c_data['email'],'email');
							
						$row['password']  = decrypt($row['password'],ENCRYPT_KEY); $row['lang'] = $c_data['lang'];
							
						$this->sendnotify(Emailtemplatebasic::recovery($row));
					
						Base::messageresponse(array('error'=>false));
						
					}catch (Exception $e){

						Base::messageresponse(array('error'=>json_decode($e->getMessage())));
					
					}
				}
			
			/**
			 * Contact
			 * @param string $c_data
			 * @return json
			 */
			public function contact(){
				
				try{

					require_once 'includes/datacheck.class.php';
						
					$dbdata = Datacheck::contactinfo($this->getdata);
				
					require_once 'includes/emailtemplatebasic.class.php';
					
					$mail_body	=	Emailtemplatebasic::contact($dbdata);
						
					$this->sendnotify($mail_body['customer']);
						
					$this->sendnotify($mail_body['company']);
					
					Base::messageresponse(array('error'=>false));
				
				}catch (Exception $e){
					
					Base::messageresponse(array('error'=>json_decode($e->getMessage())));
				}
		}
	}
?>