<?php 
	
	/**
	 * Email Templates account
	 */
	class Emailtemplatesaccount{
		
		/*
		 * Static Function Recovery
		 * 
		 * @param $c_data
		 */
		static function updatepaymentmethod($c_data){
		
			$mail_body 	= array(
						
					'lang'			  =>  $c_data['lang'],
		
					'areacode'     =>  $c_data['customer_info']['areacode'],
		
					'phone'			  =>  $c_data['customer_info']['phone'],
		
					'body_es' 	   =>  'Hola '.ucfirst($c_data['customer_info']['name']).'  '.ucfirst($c_data['customer_info']['surname']).' tus cambios en el método de pago se realizaron correctamente el detalle del mismo se enviara por correo electronico',
						
					'body_pt' 		   => 'Oi  '.ucfirst($c_data['customer_info']['name']).'  '.ucfirst($c_data['customer_info']['surname']).'  suas alterações na forma de pagamento foi bem sucedido detalhes serão enviados por e-mail',
						
					'subject_es'    =>  'Hola '.ucfirst($c_data['customer_info']['name']).'  '.ucfirst($c_data['customer_info']['surname']).' tus cambios en el método de pago se realizaron correctamente',
		
					'subject_pt' 	   =>  'Oi  '.ucfirst($c_data['customer_info']['name']).'  '.ucfirst($c_data['customer_info']['surname']).'  suas alterações na forma de pagamento foi bem sucedido',
		
					'fromname_es'	=>  'Soporte Teleorion',
		
					'fromname_pt'	=>  'Suporte Teleorion',
		
					'template'  		=> 'mail.tpl.html',
		
					'from'	  			=> 'soporte@teleorion.com',
		
					'bcc'     			=> true,
		
					'name'     			=> $c_data['customer_info']['name'],
						
					'surname'    		=> $c_data['customer_info']['surname'],
						
					'email'     			=> $c_data['customer_info']['email'],
		
					'print_vars_es' => array(
							
							array('label'=>'Fecha:','value'									=> date('d/m/y',time())),
							
							array('label'=>'Email:','value'									=> $c_data['customer_info']['email']),
							
							array('label'=>'Método de pago:','value'					=>  ($c_data['customer_info']['payment_method']=='credit')? 'Crédito':'Paypal'),
							
							($c_data['customer_info']['payment_method']=='credit') ? array('label'=>'Débito automático:','value'  =>($c_data['customer_info']['automatic_debit'])? 'Activo' : 'Desactivo' ) : null,
							
							($c_data['customer_info']['payment_method']=='credit') ? array('label'=>'Tarjeta de crédito:','value'  =>$c_data['credit_info']['type']) : null,
					),
		
					'print_vars_pt' => array(
							array('label'=>'Data:','value'									=> date('d/m/y',time())),
							array('label'=>'Email:','value'									=> $c_data['customer_info']['email']),
							array('label'=>'Método de pagamento:','value'		=>  ($c_data['customer_info']['payment_method']=='credit')? 'Crédito':'Paypal'),
							($c_data['customer_info']['payment_method']=='credit') ? array('label'=>'Débito automático:','value'  =>($c_data['customer_info']['automatic_debit'])? 'Ativo' : 'Desativar' ) : null,
							($c_data['customer_info']['payment_method']=='credit') ? array('label'=>'Cartão de crédito:','value'  =>$c_data['credit_info']['type']) : null,
					)
			);
				
			return $mail_body;
		}
		
		/**
		 * Static function Updateaccount
		 */
		static function updateaccount($c_data){

			$mail_body 	= array(
			
					'lang'			  =>  $c_data['lang'],
			
					'areacode'     =>  $c_data['customer_info']['areacode'],
			
					'phone'			  =>  $c_data['customer_info']['phone'],
			
					'body_es' 	   =>  'Hola '.ucfirst($c_data['customer_info']['name']).'  '.ucfirst($c_data['customer_info']['surname']).' tus cambios  se realizaron correctamente el detalle del mismo se enviara por correo electronico',
			
					'body_pt' 		   => 'Oi  '.ucfirst($c_data['customer_info']['name']).'  '.ucfirst($c_data['customer_info']['surname']).'  suas alteraçõeso foi bem sucedido detalhes serão enviados por e-mail',
			
					'subject_es'    =>  'Hola '.ucfirst($c_data['customer_info']['name']).'  '.ucfirst($c_data['customer_info']['surname']).' tus cambios se realizaron correctamente',
			
					'subject_pt' 	   =>  'Oi  '.ucfirst($c_data['customer_info']['name']).'  '.ucfirst($c_data['customer_info']['surname']).'  suas alterações foi bem sucedido',
			
					'fromname_es'	=>  'Soporte Teleorion',
			
					'fromname_pt'	=>  'Suporte Teleorion',
			
					'template'  		=> 'mail.tpl.html',
			
					'from'	  			=> 'soporte@teleorion.com',
			
					'bcc'     			=> true,
			
					'name'     			=> $c_data['customer_info']['name'],
			
					'surname'    		=> $c_data['customer_info']['surname'],
			
					'email'     			=> $c_data['customer_info']['email'],
			
					'print_vars_es' => array(
								
							array('label'=>'Fecha:','value'								=> date('d/m/y',time())),
								
							array('label'=>'Email / Usuario:','value'				=> $c_data['customer_info']['email']),
								
							array('label'=>'Contraseña:','value'					=>  decrypt($c_data['customer_info']['password'],ENCRYPT_KEY)),
							
							array('label'=>'Telefono:','value'							=> "+{$c_data['customer_info']['areacode']}{$c_data['customer_info']['phone']}"),
					
					),
			
					'print_vars_pt' => array(
							
							array('label'=>'Data:','value'									=> date('d/m/y',time())),
							
							array('label'=>'Email:','value'									=> $c_data['customer_info']['email']),

							array('label'=>'Senha:','value'									=>  decrypt($c_data['customer_info']['password'],ENCRYPT_KEY)),
							
							array('label'=>'Telefone:','value'								=>   "+{$c_data['customer_info']['areacode']}{$c_data['customer_info']['phone']}"),
				)
			);
			
			return $mail_body;
		}
	}
?>