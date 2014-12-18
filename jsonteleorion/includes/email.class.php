<?php

	/**
	 * Template Class
	 */
	require_once 'includes/templates.class.php';

	/**
	 * Send Email
	 */
	class Email{
		
		public $db;
		
		/**
		 * Construct Email class
		 */
		public function __construct(){

			$this->db= new Crm_emails();
		}
		
		/**
		 * Send
		 * @param array $email_params
		 * 
		 */
		public function Send($email_params){
			
				$mail = new PHPMailer();
				
				$mail->IsSMTP();
				
				$mail->SMTPAuth   = true;
				
				$mail->SMTPSecure = 'ssl';
				
				$mail->Host = HOST_EMAIL;
				
				$mail->Port	= PORT_EMAIL;
				
				$mail->SMTPAuth = true;
				
				$mail->Username = USER_EMAIL;
				
				$mail->Password = PASSWORD_EMAIL;
				
				$mail->IsHTML(true);
				
				$mail->CharSet = 'UTF-8';
				
				$mail->Body = $this->Generate_Email($email_params['template']);
				
				$mail->Subject = $email_params['subject'];
				
				$mail->From = $email_params['from'];
				
				$mail->FromName = $email_params['fromname'];
	
				if(isset($email_params['address']['email'])){
						
						$mail->AddAddress($email_params['address']['email'],$email_params['address']['name']);
				
				}
				
				if(isset($email_params['bcc'])){

					foreach($this->bcc() as $value){
						$mail->AddBCC($value['email'],$value['name']);
					}
				
				}
				
				if(!$mail->Send()){

					return false;
				}else{
			
					return true;
				}
		}
		/**
		 * Generate Email
		 * @param array $email_body_params
		 */
			public function Generate_Email($email_body_params=false){
				
				$html	   = '';
					
				$mail_tpl = new HTML_Template_Sigma(TEMPLATES_PATH.'email/', TEMPLATES_CACHE_PATH);
					
					
				$mail_tpl->loadTemplatefile($email_body_params['config']['template']);
					
				
				if(isset($email_body_params['print_vars'])){	

					
							
							foreach ($email_body_params['print_vars'] as $value){

								$html.="<tr><td>{$value['label']}</td><td>{$value['value']}</td></tr>";
								
							}
							
							$mail_tpl->setCurrentBlock('email');
											$mail_tpl->setVariable('table',$html);
							$mail_tpl->parse('email');
							
				}else{
					$mail_tpl->touchBlock('email');
				}
						
				return $mail_tpl->get();
			}
		
		/**
		 *  Get Bcc from Crm_emails
		 *  
		 *  @return array email_list
		 */
			private function bcc(){
				
				$bcc_email = array();
				
				$emails_list =$this->db->get_list(false,false,'active=1 AND trash=0',false);
				
				while($row_email=db::fetch_assoc($emails_list)){
					
					array_push($bcc_email,array('email'=>$row_email['email'],'name'=>$row_email['name']));
				
				}
				
				return $bcc_email;
			}	
	}
?>