<?php
/**
 * Make Payments with Paypal account
 * 
 */
class Paypal{
		
			
		    private 	$p_account;

		    private 	$r_uri;
		    
		    private 	$server;
		
		/**
		 * 	Construct
		 * 
		 * @param null
		 * @return void
		 */
			public function __construct(){

				$this->server=SERVER_PAYPAL;
				
				$this->p_account=ACCOUNT_PAYPAL; 	
			
				$this->r_uri=URI_PAYPAL;
			}	
		//	public function generate_sale
			
			
		public function Genaerate_Form($paypal_attr){
			/**
			 * Product Class
			 */
			   $Products				 = new Products();
			   
			   $Customer_Products		 = new Customers_Products();
			   
			   
				
		   /**
		    * Customer Class
		    */
			   $Create_customer = new TVmia_Customer();
			   
			   $Create_customer->debug=false;
			   
			   $Create_customer->i_customer=$paypal_attr['i_customer'];
			   
			   $billing = $Create_customer->Generate_Billing();
			

			   
		   /**
		    * Get Client Information
		    */
		   	   $info_customer=$Create_customer->Get_Customer_Personal_information();
		   /**
		    * Get name Product
		    */
		   		$product_name=$Products->get($info_customer['producto']);
			
				$html='';
			
				$html.="
						<body onload='document.make_paypal_payment.submit();'>
						
						<form action=".SERVER_PAYPAL." method='post' name='make_paypal_payment'>
					
						<!-- SUBSCRIPTION TYPE -->
							<input type='hidden' name='cmd' value='_xclick-subscriptions' />
						<!-- SUBSCRIPTION TYPE -->
						
						<!-- BUSSNIESS ACCOUNT -->
							<input type='hidden' name='business' value='".USER_PAYPAL."' />
						<!-- BUSSNIESS ACCOUNT -->
						
						<!-- ECCHANGE TYPE -->
							<input type='hidden' name='lc' value='US'/>
						<!-- ECCHANGE TYPE -->
						
						<!-- CURRENCY CODE -->
							<input type='hidden' name='currency_code' value='USD' /> 
						<!-- CURRENCY CODE -->
						
						<!--SHIPPING ATTR -->
							  <input type='hidden' name='no_note' value='0' />
							  <input type='hidden' name='shipping' value='{$billing['purchase_detail']['shipping']}' />
						<!--SHIPPING ATTR -->
						
						<!-- PRODUCT ITEM -->
						 	<input type='hidden' name='item_name' value='Compra Tvmia' />
						<!-- PRODUCT ITEM -->
						
						<!-- I_CUSTOMER -->
						 	<input name='item_number' type='hidden' value='{$paypal_attr['i_customer']}' />
						<!-- I_CUSTOMER -->

						<!-- RETURN -->
						 	<input type='hidden' name='notify_url' value='".RETURN_IPN_PAYPAL."' /> 
						 	<input type='hidden' name='return' value='".RETURN_URI_PAYPAL."' />
						<!-- RETURN -->
						
						<!-- PAYPAL SUBSCRIPTION -->
							<input name='a3' type='hidden' value='".$billing['purchase_detail']['service']."' /> 
							<input name='p3' type='hidden' value='1' />
							<input name='t3' type='hidden' value='M' />
							<input type='hidden' name='src' value='1'/> 
						<!-- PAYPAL SUBSCRIPTION -->	
						<!-- PAYPAL SHARES -->
								<input type='hidden' name='srt' value='11' />
						<!-- PAYPAL SHARES -->
							
							
							<!-- PAYPAL SUBSCRIPTION -->
								<input name='a2' type='hidden' value='".($billing['purchase_detail']['device_fee']/$billing['purchase_detail']['total_fee'])."' /> 
								<input name='p2' type='hidden' value='{$billing['purchase_detail']['total_fee']}' />
								<input name='t2' type='hidden' value='M' />
							<!-- PAYPAL SUBSCRIPTION -->
					";
						
				
					$html.="
						
						<!-- PAYPAL INITIAL PAYMENT -->
								<input type='hidden' name='a1' value='{$billing['purchase_detail']['total']}' /> 
								<input type='hidden' name='p1' value='1'> 
								<input type='hidden' name='t1' value='M' />			
						<!-- PAYPAL INITIAL PAYMENT -->
					";
						
				
						$html.='</form></body>';
						
						return $html;
		}
		
		public function Genaerate_instant_Form($paypal_attr){
			/**
			 * Product Class
			 */
			$Products				 = new Products();
		
			$Customer_Products		 = new Customers_Products();
		
		
		
			/**
			 * Customer Class
			 */
			$Create_customer = new TVmia_Customer();
		
			$Create_customer->debug=false;
		
			$Create_customer->i_customer=$paypal_attr['i_customer'];
			
			/**
			 * Get Client Information
			 */
			$info_customer=$Create_customer->Get_Customer_Personal_information();
			
			$html='';
				
			$html.="
			<body onload='document.make_paypal_payment.submit();'>
		
			<form action=".SERVER_PAYPAL." method='post' name='make_paypal_payment'>
				
			<!-- SUBSCRIPTION TYPE -->
			<input type='hidden' name='cmd' value='_xclick' />
			<!-- SUBSCRIPTION TYPE -->
		
			<!-- BUSSNIESS ACCOUNT -->
			<input type='hidden' name='business' value='".USER_PAYPAL."' />
			<!-- BUSSNIESS ACCOUNT -->
		
			<!-- ECCHANGE TYPE -->
			<input type='hidden' name='lc' value='US'/>
			<!-- ECCHANGE TYPE -->
		
			<!-- CURRENCY CODE -->
			<input type='hidden' name='currency_code' value='USD' />
			<!-- CURRENCY CODE -->
		
			<!--SHIPPING ATTR -->
			<input type='hidden' name='no_note' value='0' />
			<!--SHIPPING ATTR -->
		
			<!-- PRODUCT ITEM -->
			<input type='hidden' name='item_name' value='Compra Tvmia' />
			<!-- PRODUCT ITEM -->
		
			<!-- I_CUSTOMER -->
			<input name='item_number' type='hidden' value='{$paypal_attr['i_customer']}' />
			<!-- I_CUSTOMER -->
		
			<!-- RETURN -->
			<input type='hidden' name='notify_url' value='".RETURN_IPN_PAYPAL."' />
			<input type='hidden' name='return' value='".RETURN_URI_PAYPAL."' />
			<!-- RETURN -->
		
			";
		
		
			$html.="
		
			<!-- PAYPAL INITIAL PAYMENT -->
			<input type='hidden' name='amount' value='{$paypal_attr['amount']}' />
			<!-- PAYPAL INITIAL PAYMENT -->
			";
		
		
			$html.='</form></body>';
		
			return $html;
		}
		/**
		 * Load Ipn
		 * @todo load a IPN
		 */
		public function Load_Ipn(){
		
			
			/**
			 * Objects
			 */
			
				$Customers 				   		= 		new Customer();
				
				$Products						= 		new Products();
				
				$TvmiaCustomer 			   		= 		new TVmia_Customer();
				
				$Email 		 					= 		new TVmia_Email();
				
				$Mailing_list 					=  		new Mailing_list();
		
			/**
			 * POST PAYPAL
			 */
				$form_val['name']				=		_request('address_name');
					
				$form_val['email']				=		_request('payer_email');
					
				$form_val['estatus']			=		_request('payment_status');
					
				$form_val['amount']				=		_request('payment_gross');
					
				$form_val['item_number']		=		_request('item_number');
					
				$form_val['sell_id']			=		_request('txn_id');
					
				$form_val['pending_reason']		=		_request('pending_reason');
			
				
		
				
			/**
			 * Get Customer Info
			 */
			
				$TvmiaCustomer->i_customer 		= 		$form_val['item_number'];
					
				$info_customer					=		$TvmiaCustomer->Get_Customer_Personal_information();
			
				
				$billing  						= 		$TvmiaCustomer->Generate_Billing();
			
				if($billing['purchase_detail']=='0.00'){
				
							foreach($billing['purchase_products'] as $value){
								
							$block[] =	array(
										
									array('label'=>'name','value'			=> $value['name']),
										
									array('label'=>'description','value'	=>  $value['description']),
										
									array('label'=>'price','value'			=>	 $value['price']),
										
									array('label'=>'quantity','value'		=>	$value['quantity']),
										
									array('label'=>'price_quantity','value'	=>  $value['price_quantity'])
							);
						}
				}else{
			
						$billing['purchase_detail']['total']   =	$form_val['amount'] ;

						$billing['purchase_detail']['taxes'] =	$form_val['amount']*16/100;
					 
					    $billing['purchase_detail']['shipping']=0;
				}
				
		
			if($info_customer!=false){

				switch($form_val['estatus']){
					
					case 'Completed':
					
					case 'Processed':
			
						$TvmiaCustomer->Activate();
		
						$TvmiaCustomer->Update_Subscription_log(30);
		
						$TvmiaCustomer->Payment_log(array('auth_code'=>$form_val['sell_id'], 'result'=>$form_val['estatus']),$form_val['amount']);
		
						/**
						 * Send Email
						 */
							$bcc_email=array();
							
							$mailing_users=$Mailing_list->get_list('','','activo=1 AND trash=0 AND sales=1','');
							
							while($row_user=db::fetch_assoc($mailing_users)){
								$bcc_email[] = array('email'=>$row_user['correo'],'name'=>$row_user['nombre']);
							}


						
						    $email_params=array(
						    		'template'=>array(
						    
						    				'config'    => array('template'=>'comercialinvoicepaypal.tpl.html','plan_pc'=>0,'plan_tv'=> 0),
						    
						    				'print_vars'=>array(
						    
						    						array('label'=>'name','value'			=>  ucfirst($info_customer['nombre_cliente'])),
						    
						    						array('label'=>'surname','value'		=>	ucfirst($info_customer['apellido_cliente'])),
						    
						    						array('label'=>'email','value'			=>	$info_customer['email_cliente']),
						    
						    						array('label'=>'password','value'		=>	decrypt($info_customer['password_tvmia'], ENCRYPT_KEY)),
						    							
						    						array('label'=>'i_transaction','value'	=> $form_val['sell_id']),
						    							
													array('label'=>'total','value'			=>  $billing['purchase_detail']['total']),
						    							
						    						array('label'=>'taxes','value'			=>  $billing['purchase_detail']['taxes']),
						    							
						    						array('label'=>'shipping','value'		=>  $billing['purchase_detail']['shipping'])
						    
						    				),
						    
						    		),
						    	
						    		'subject' => 'El pago en Paypal se proceso correctamente',
						    			
						    		'from'	  => 'soporte@tvmia.com',
						    			
						    		'fromname'=> 'Soporte Tvmia',
						    			
						    		'address' =>  array('email'=>$info_customer['email_cliente'],'name'=>ucfirst($info_customer['nombre_cliente'])),
						    			
						    		'bcc'     => $bcc_email,
						    );

							/**
						     *  Add Block
						     */
						    
						    if(isset($block)){
						    	$email_params['template']['block_parts'] = $block;
							}
							
						    /**
						     * Send Email
						     */
							
						$Email->Send_Email($email_params);
					break;
					case 'Denied':
					case 'Failed':
		
						    $email_params=array(
						    		'template'=>array(
						    
						    				'config'    => array('template'=>'comercialinvoicepaypal.tpl.html'),
						    
						    				'print_vars'=>array(
						    
						    						array('label'=>'name','value'			=>  ucfirst($info_customer['nombre_cliente'])),
						    
						    						array('label'=>'surname','value'		=>	ucfirst($info_customer['apellido_cliente'])),
						    
						    						array('label'=>'email','value'			=>	$info_customer['email_cliente']),
						    
						    						array('label'=>'password','value'		=>	decrypt($info_customer['password_tvmia'], ENCRYPT_KEY)),
						    							
						    						array('label'=>'i_transaction','value'	=>  $form_val['sell_id']),
						    							
						    						array('label'=>'total','value'			=>  $billing['purchase_detail']['total']),
						    							
						    						array('label'=>'taxes','value'			=>  $billing['purchase_detail']['taxes']),
						    							
						    						array('label'=>'shipping','value'		=>  $billing['purchase_detail']['shipping'])
						    
						    				),
						    
						    		),
						    			
						    		'subject' => 'El pago en Paypal no se proceso correctamente verificar el estado de la transacción',
						    			
						    		'from'	  => 'soporte@tvmia.com',
						    			
						    		'fromname'=> 'Soporte Tvmia',
						    			
						    		'address' =>  array('email'=>$info_customer['email_cliente'],'name'=>ucfirst($info_customer['nombre_cliente'])),
						    			
						    		'bcc'     => $bcc_email,
						    );
						    /**
						     *  Add Block
						     */
						    	
						    $email_params['template']['block_parts'] = $block;
						    
						    /**
						     * Send Email
						     */
						    $Email->Send_Email($email_params);
		
						break;
				}
			}
		}
		
}

/**
 * Test IPN
 */
	//?address_name=juan&payer_email=wportillo@tvmia.com&payment_status=Completed&payment_gross=96&item_number=16157&txn_id=15&pending_reason=1234	
?>