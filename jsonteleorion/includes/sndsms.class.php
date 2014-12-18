<?php
	
	require_once 'includes/smsinterface.class.php';
	/**
	 * Class SendSms
	 * @extend Smsinterface
	 * 
	 */
	class Sendsms extends SmsInterface{
	
		private $error;
		
		public function __construct(){

			parent::__construct(false,false);
		
			$this->error=false;
		
		}
		
		/**
		 * Send sms
		 * 
		 * @param integer $data->country
		 * @param integer $data->phone
		 * @param string   $data->body
		 */
		public function send($data){
			
				$this->addMessage("+{$data['areacode']}{$data['phone']}",$data['body']);
				
				if (!$this->connect (SMS_USER, SMS_PASS, true, false)){
							$this->error[]='unconnect';
				}else{
					if (!$this->sendMessages ()) {
						if ($this->getResponseMessage () !== NULL){
							$this->error[]='notsend';
						}
					}
				}
		
			if($this->error){
				return array('error'=>$this->error);
			}else{
				return array('error'=>false,'send'=>'ok');
			}	
		}
	}
?>