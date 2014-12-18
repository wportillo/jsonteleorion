<?php
	
	/**
	 * Security class php
	 * 
	 */
		class Security extends Method{
				
				public $getdata;
				
				public function __construct($data){
					
					/**
					 * Init Parent Construct
					 */
						parent::__construct();
					
						$this->getdata   		= objectToArray($data);
				}
				
				/**
				 * Valid logged
				 *
				 * if  session is array user is logged
				 *
				 * @return mixed array data or boolean
				 */
					
					public function validlogged(){
					
						
						if($this->getdata['i_sess']){

							$row 	= $this->getsess($this->getdata['i_sess']);
						}
						
						if($this->getdata['i_device']){
						
							$row 	= $this->getdevice($this->getdata['i_device']);
						}
						
						if($row){
								
							if($row['i_customer']!=''){
					
								return $row['i_customer'];
							}
						}
					
						return false;
					}
				
				/*
				 *  Validactive
				 */
					public function validactive(){

							if(! ($i_customer = $this->validlogged())){
								Sysmessages::Excpetion(Sysmessages::$loggederror);
							}

							$customer_info = $this->getinfo($i_customer,'customer_info,product_info');
							
							
							if($customer_info['customer_info']['active']=='0'){

								if($customer_info['product_info']['key_product']=='freeorion'){

									Sysmessages::Excpetion(Sysmessages::$inactiveuserfree);
										
								}else{

									Sysmessages::Excpetion(Sysmessages::$inactiveuser);
								}
							}
					}
				
				/*
				 * Validate Device 
				 *
				 * @ return bolean device stats
				 */
					public function validatedevice(){
						
						if(! $this->getdevice($this->getdata['i_device'])){
							
							Base::messageresponse(array('device'=>false));
						
						}else{
							
							Base::messageresponse(array('device'=>true));
						}
					}
					
					/*
					 * Validate Device
					*
					* @ return bolean device stats
					*/
						public function logdevice(){
						
							try{
									
									require_once(INCLUDE_PATH . 'datacheck.class.php');
									
									Datacheck::logininfo($this->getdata);
							
									$this->c_device->primary_key='i_customer';
										
									$customer = $this->getcustomer($this->getdata['email'], 'email');
									
									$dbdata=array(
											'i_customer'	=> $customer['i_customer'],
											'i_serial'		=> $this->getdata['i_device'],
									);
									
									$this->c_device->add($dbdata);
									
									Base::messageresponse(array('error'=>false));
								
								}catch(Exception $e){
											
									Base::messageresponse(array('error'=>true));
								
								}
						}
						
					/*
					 * Validate User
					 *
					 * @ return bolean device stats
					 */
						public function validateuser(){
						
							if(! $this->getcustomer($this->getdata['username'],'email')){
									
								Base::messageresponse(array('exist'=>false));
						
							}else{
									
								Base::messageresponse(array('exist'=>true));
							}
						}
				
				/**
				 *
				 * Login
				 * 
				 * @param object email
				 * @param object password
				 * 
				 */
					public function login(){	
					
						try{
							
							require_once(INCLUDE_PATH . 'datacheck.class.php');

							Datacheck::logininfo($this->getdata);

							$row = $this->getcustomer($this->getdata['email'],'email');
								
							$where = 'i_session!='.db::quote($this->getdata['i_sess']).' AND i_customer='.db::quote($row['i_customer']).' AND i_customer!=0';

							$rs_session = $this->c_sess->get_list(1,1,$where);
							
							$beforesession = db::fetch_assoc($rs_session);
							
							if($beforesession){
								
								$this->c_sess->delete($beforesession['i_session']);
							}
							
							$this->updatesession($this->getdata['i_sess'], $row);
							
							Base::messageresponse(array('error'=>false));
							
							
						}catch(Exception $e){
											
							Base::messageresponse(array('error'=>json_decode($e->getMessage())));
						
						}
					}

					/**
					 *
					 * Loginsocial
					 *
					 * @param object email
					 * @param object i_fbid
					 *
					 */
					public function loginfb(){
					
						try{
							
							require_once(INCLUDE_PATH . 'datacheck.class.php');
					
							Datacheck::logininfofb($this->getdata);
					
						}catch(Exception $e){
							$this->error = json_decode($e->getMessage());
						}
					
						if(!$this->error){
					
							$row = $this->getcustomer($this->getdata['i_fbid'],'i_fbid');
						
							Base::response(array('error'=>false,'id'=>Base::iencrypt($row['i_customer']),'name'=>$row['name'],'surname'=>$row['surname'],'email'=>$row['email']));
					
						}else{
					
							Base::response(array('error'=>$this->error));
						}
					
					}
					
					/**
					 *  Register FB
					 */
					
					public function registerfb(){

						if(!isset($this->getdata['id'])){

							$this->error = Sysmessages::Showerror(Sysmessages::$invaliduserid);
						
						}
						
						if(!isset($this->getdata['i_fbid'])){

							$this->error = Sysmessages::Showerror(Sysmessages::$invalidfbid);
						
						}
						
						if(!$this->error){
							
							$customer 	  =    Base::idecrypt($this->getdata['id']);
							
							$data['i_fbid'] =	$this->getdata['i_fbid'];
							
							$this->updatefbid($data, $customer[0]);
						}
						
						if($this->error){
							Base::response(array('error'=>$this->error));
						}else{
							Base::response(array('error'=>false));
						}
				 }
		}
?>