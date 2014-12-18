<?php
/**
 * Make Payments with Paypal account
 * 
 */
class Paypal extends Method{

			/**
			 * Generate Instantsale
			 * 
			 * @param array $c_data
			 * 
			 * @return string
			 */
			public function inithtml($i_customer,$key_product){
				
					  	   $product_info   =  $this->getproduct($key_product);
							
				
							$array = array(    'cmd'		 	 				  => '_xclick-subscriptions',
													    'business' 					  => ACCOUNT_PAYPAL,
														'lc'			  					  => 'US',
														'currency_code'			  => 'USD',
														'no_note'			  		      => 0,
														'item_name'			  	      =>$product_info['name_product'],
														'item_number'			     => encrypt($i_customer, ENCRYPT_KEY),
														'a3'			  			 		 => $product_info['amount'],
														'p3'			  			 		 => 1,
														't3'			  			 		 => 'M',
														'src'								 =>  1
							);
							
							return SERVER_PAYPAL.'?'.http_build_query($array);
			}
			
			/**
			 * Load Ipn
			 * @todo load a IPN
			 */
			public function ipnnotification(){
			
				$ipnresponse  = array('name' 			=>_request('address_name'),
					 	                 'email'  						=>_request('payer_email'),
						                 'status' 						=> _request('payment_status','0'),
										 'amount'					    => _request('payment_gross'),
										 'email'					    	=> _request('payer_email'),
										 'i_customer' 				=>  decrypt(_request('item_number'),ENCRYPT_KEY),
									 	 'key_product'             => _request('item_name'),
										 'authcode'					=> _request('txn_id'),
										 'pending_reason'		=> _request('pending_reason')
				);

				
				
				switch(	$ipnresponse['status']){
					case 'Completed':
					case 'Processed':
						$this->getinfo($ipnresponse['i_customer']);

						if($this->c_info->get($ipnresponse['i_customer'])){
						
							$this->setstatus($ipnresponse['i_customer'], 1);
							
							$this->customerdate($ipnresponse['i_customer'], $ipnresponse['key_product']);
							
							$customer_info             		  	  			= $this->getinfo($ipnresponse['i_customer'],'customer_info,date_info,product_info');
						
							$customer_info['lang']							= 'es';
						
							$customer_info['authcode']      			= $ipnresponse['authcode'];
						
							$customer_info['credit_info']['type']    = 'Paypal';
						
							$customer_info['product_info']           = $this->getproduct($customer_info['product_info']['key_product']);
						
							require_once 'includes/emailtemplate.class.php';
							
							$this->p_history->primary_key='i_customer';
								
							if($this->p_history->get($ipnresponse['i_customer'])==false){

								$this->sendnotify(Emailtemplates::premium($customer_info));

							}else{
								$this->sendnotify(Emailtemplates::makepayment($customer_info));
							}
							
							$creditdata = array(
									'authcode'	  => $ipnresponse['authcode'],
									'i_customer'  =>  $ipnresponse['i_customer'],
									'amount'        =>  $ipnresponse['amount'],
									'type'			  => 'Paypal - '.$ipnresponse['email'],
									'post'			  =>  serialize($_REQUEST),
							);

							$this->paymenthistory($creditdata);
						}
					break;
					case '0':
					
					break;
					default:

						$this->getinfo($ipnresponse['i_customer']);
						
						if($this->c_info->get($ipnresponse['i_customer'])){
						
							$customer_info             		  	  			= $this->getinfo($ipnresponse['i_customer'],'customer_info,date_info,product_info');
						
							$customer_info['lang']							= 'es';
						
							$customer_info['authcode']      			= 'Pago no procesado verifique su cuenta de Paypal';
						
							$customer_info['credit_info']['type']    = 'Paypal';
						
							$customer_info['product_info']           = $this->getproduct($customer_info['product_info']['key_product']);
						
							require_once 'includes/emailtemplate.class.php';
								
							$this->sendnotify(Emailtemplates::paymentdeny($customer_info));
							
							$creditdata = array(
									'authcode'	  => $ipnresponse['authcode'],
									'i_customer'  =>  $ipnresponse['i_customer'],
									'amount'        =>  $ipnresponse['amount'],
									'type'			  => 'Paypal - '.$ipnresponse['email'],
									'post'			  =>  serialize($_REQUEST),
							);
							
							$this->paymenthistory($creditdata);
						}
					break;
				}
			}		
}

/**
 * Test IPN
 */
    //https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_xclick-subscriptions&business=dasportillo-developer%40yahoo.es&lc=US&currency_code=USD&no_note=0&item_name=Basico&item_number=Y6Ci&a3=9.98&p3=1&t3=M&src=1
	//http://jsonteleorion/paypal.php/?address_name=juan&payer_email=wportillo@tvmia.com&payment_status=Completed&payment_gross=96&item_number=Y5%2Bl&txn_id=15&pending_reason=1234
?>