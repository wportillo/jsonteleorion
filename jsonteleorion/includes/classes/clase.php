<?php
/**
 *  Db Connection class Teleorion Db
 * 
 * @author william
 * @package Teleorion
 * @category db
 */
    class Crm_access_log extends rs{
			function __construct(){
				$this->table ='crm_access_log';
				$this->primary_key='i_acces_log';
			}
	}
    
    class Category extends rs{
		function __construct(){
			$this->table ='category';
			$this->primary_key='i_category';
		}
	}
	
	class Crm_reseller_payment_history extends rs{
		function __construct(){
			$this->table ='crm_reseller_payment_history';
			$this->primary_key='i_payment';
		}
	}
	class Channels extends rs{
		function __construct(){
			$this->table ='channels_info';
			$this->primary_key='i_channel';
		}
	}
	class Crm_emails extends rs{
		function __construct(){
			$this->table ='crm_emails';
			$this->primary_key='i_email';
		}
	}
   class Crm_reseller extends rs{
		function __construct(){
			$this->table ='crm_reseller';
			$this->primary_key='i_reseller';
		}
	}
   class Crm_roll extends rs{
		function __construct(){
			$this->table ='crm_roll';
			$this->primary_key='i_roll';
		}
	}
   class Crm_sale extends rs{
		function __construct(){
			$this->table ='crm_sale';
			$this->primary_key='i_sales';
		}
	}
   class Crm_store extends rs{
		function __construct(){
			$this->table ='crm_store';
			$this->primary_key='i_store';
		}
	}
	class Crm_user extends rs{
		function __construct(){
			$this->table ='crm_user';
			$this->primary_key='i_user';
		}
	}
	class Crm_user_roll extends rs{
		function __construct(){
			
			$this->table ='crm_user';
			
			$this->primary_key='i_user';
			
			$this->pivot_tables=array(array(
						
					'table'  => 'crm_roll',
						
					'link_a' => 'i_roll',
						
					'link_b' => 'i_roll'
				)
			);
		}
	}
	
  class Customer_credit_info extends rs{
		function __construct(){
			$this->table ='customer_credit_info';
			$this->primary_key='i_credit';
		}
	}
   
   class Crm_reseller_credit_info extends rs{
		function __construct(){
			$this->table ='crm_reseller_credit_info';
			$this->primary_key='i_credit';
		}
   }
   
   class Customer_date_info extends rs{
		function __construct(){
			$this->table ='customer_date_info';
			$this->primary_key='i_date';
		}
	}
	class Customer_device_info extends rs{
		function __construct(){
			$this->table ='customer_device_info';
			$this->primary_key='i_serial';
		}
	}
	class Customer_favorites extends rs{
		function __construct(){
			$this->table ='customer_favorites';
			$this->primary_key='i_fav';
		}
	}
	class Customer_info extends rs{
		function __construct(){
			$this->table ='customer_info';
			$this->primary_key='i_customer';
		}
	}
	class Customer_payment_history extends rs{
		function __construct(){
			$this->table ='customer_payment_history';
			$this->primary_key='i_payment';
		}
	}
	class Customer_product_info extends rs{
		function __construct(){
			$this->table ='customer_product_info';
			$this->primary_key='i_product';
		}
	}
	class Product_info extends rs{
		function __construct(){
			$this->table ='product_info';
			$this->primary_key='i_product';
		}
	}
	class Sessions extends rs{
		function __construct(){
			$this->table ='sessions';
			$this->primary_key='i_session';
		}
	}
?>