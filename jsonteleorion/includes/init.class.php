<?php
/**
 *  Init Class
 */
	class Init{
		
		/**
		 * Init Vars
		 */
			public $error; public $c_info; public $c_product; public $c_date; public $c_device; public $c_credit; public $c_fav; public $product_info; public $p_history; public $i_customer=false; public $c_sess=false; public $r_history;
		
		/**
		 * Customer Construct
		 */
		public function __construct(){
			
			/*
			 *  Init Customer db
			 */
				$this->r_history		   = new Crm_reseller_payment_history();
				$this->c_info    		   = new Customer_info(); 
				$this->c_date 			   = new Customer_date_info(); 
				$this->c_credit 		   = new Customer_credit_info();
				$this->c_fav			   = new Customer_favorites();
				$this->c_product 	   	   = new Customer_product_info(); 
				$this->product_info	   	   = new Product_info(); 
				$this->p_history 		   = new Customer_payment_history();
				$this->c_device		   	   = new Customer_device_info();
				$this->c_sess			   = new Sessions();
		}
		
		/**
		 * initcustomer
		 *
		 * @param array $c_data
		 *
		 * @return void
		 */
		
		
			public function initcustomer($c_data){
			
				$data = array(
						'name'  	      	 					=> $c_data['name'],
						'i_user'								=> (isset($c_data['i_user']))? $c_data['i_user'] : '0',
						'i_reseller'							=> (isset($c_data['i_reseller']))? $c_data['i_reseller'] : '0',
						'i_store'								=> (isset($c_data['i_store']))? $c_data['i_store'] : '0',
						'surname'	  	  	 					=> $c_data['surname'],
						'email'   	  	  	 					=> $c_data['email'],
						'password'	 	     			  		=> encrypt($c_data['password'],ENCRYPT_KEY),
						'address'   	  	  	 				=> $query = (isset($c_data['address'])) ? $c_data['address']:'',
						'state'   	  	  	 					=> $query = (isset($c_data['state'])) ? $c_data['state']:'',
						'zip'   	  	 						=> $query = (isset($c_data['zip'])) ? $c_data['zip']:'',
						'city'	  	  	 						=> $query = (isset($c_data['city'])) ? $c_data['city']:'',
						'country'			 					=> $query = (isset($c_data['country'])) ? $c_data['country']:'',
						'phone'	 	  	 				    	=> $query = (isset($c_data['phone'])) ? $c_data['phone']:'',
						'areacode'	 	  	 					=> $query = (isset($c_data['areacode'])) ? $c_data['areacode']:''
				);
			
				/*
				 * Add data Info
				*/
				$i_customer = $this->c_info->add($data);
			
				$this->init_db($i_customer);
				
				return $i_customer;
			}
		
		/**
		 * Create table Data form Customer
		 *
		 * @param integer $i_customer
		 * @return void
		 */
				private function init_db($i_customer){
						
					$init_data['i_customer'] 	= $i_customer;
						
					$this->c_product->add($init_data);
				
					$this->c_date->add($init_data);
				
					$this->c_credit->add($init_data);
				
					$this->c_fav->add($init_data);
				}
}