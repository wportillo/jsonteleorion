<?php
	/*
	 * Class of control System Email
	 */
	class Emailtemplates{
		
		/**
		 * 
		 * Static Function free
		 */
			static function free($c_data){
				
				$mail_body 		= array(
							
						'lang'   		=> $c_data['lang'],
							
						'areacode'    	=> $c_data['customer_info']['areacode'],
				
						'phone'			=>  $c_data['customer_info']['phone'],
							
						'body_es'     	=> 'Gracias por registrarte en Teleorion Gratis '."\n".ucfirst($c_data['customer_info']['name']).' '.ucfirst($c_data['customer_info']['surname']).' / Vencimiento: '.date('d/m/Y',mydatetotimestamp(mydateadd(mydate(), $c_data['product_info']['cycle'])))."\n".' Contraseña :'.$c_data['customer_info']['password'],
							
						'body_pt' 		=>  'Graças por registrar em Teleorion Livre '."\n".ucfirst($c_data['customer_info']['name']).' '.ucfirst($c_data['customer_info']['surname']).'  / Maturidade: '.date('d/m/Y',mydatetotimestamp(mydateadd(mydate(), $c_data['product_info']['cycle'])))."\n".' Contraseña :'.$c_data['customer_info']['password'],
				
						'subject_es' 	=>  'Gracias por registrarte en Teleorion Gratis '.ucfirst($c_data['customer_info']['name']).'  '.ucfirst($c_data['customer_info']['surname']),
				
						'subject_pt'  	=>  'Graças por registrar em Teleorion Livre '.ucfirst($c_data['customer_info']['name']).' '.ucfirst($c_data['customer_info']['surname']),
				
						'fromname_es'	=> 'Soporte Teleorion',
							
						'fromname_pt'	=> 'Soporte Teleorion',
				
						'template'  		=> 'mail.tpl.html',
							
						'from'	  			=> 'soporte@teleorion.com',
							
						'bcc'     			=> true,
							
						'name'     			=> $c_data['customer_info']['name'],
							
						'surname'    		=> $c_data['customer_info']['surname'],
							
						'email'     			=> $c_data['customer_info']['email'],
							
						'print_vars_es' => array(
								array('label'=>'Usuario:','value'=>$c_data['customer_info']['email']),
								array('label'=>'Descripcion:','value'=>$c_data['product_info']['description_product_es']),
								array('label'=>'Este producto es válido hasta:','value'=>date('d/m/Y',mydatetotimestamp(mydateadd(mydate(), $c_data['product_info']['cycle'])))),
						),
						
						'print_vars_pt' 	=> array(
								array('label'=>'Usuário','value'=>$c_data['customer_info']['email']),
								array('label'=>'Descrição','value'=> $c_data['product_info']['description_product_pt']),
								array('label'=>'produto é válido até:','value'=> date('d/m/Y',mydatetotimestamp(mydateadd(mydate(), $c_data['product_info']['cycle'])))),
						)
				);
				
				return $mail_body;
			} 
			
			/**
			 *
			 * Static Function premium
			 */
			static function premium($maildata){
			
				 $mail_body 		= array(
							
						'lang'   			 	=> $maildata['lang'],
							
						'areacode'    	=> $maildata['customer_info']['areacode'],
			
						'phone'				=>  $maildata['customer_info']['phone'],
							
						'body_es'     	=> 'Gracias por registrarte en Teleorion '.ucfirst($maildata['customer_info']['name']).'  '.ucfirst($maildata['customer_info']['surname']).' / Vencimiento: '.date('d/m/Y',mydatetotimestamp(mydateadd(mydate(), $maildata['product_info']['cycle']))),
							
						'body_pt' 			=>  'Graças por registrar em Teleorion'.ucfirst($maildata['customer_info']['name']).' '.ucfirst($maildata['customer_info']['surname']).'  / Maturidade: '.date('d/m/Y',mydatetotimestamp(mydateadd(mydate(), $maildata['product_info']['cycle']))),
			
						'subject_es' 	=>  'Gracias por registrarte en Teleorion  '.ucfirst($maildata['customer_info']['name']).'  '.ucfirst($maildata['customer_info']['surname']),
			
						'subject_pt'  	=>  'Graças por registrar em Teleorion '.ucfirst($maildata['customer_info']['name']).' '.ucfirst($maildata['customer_info']['surname']),
			
						'fromname_es'	=> 'Soporte Teleorion',
							
						'fromname_pt'	=> 'Soporte Teleorion',
			
						'template'  		=> 'mail.tpl.html',
							
						'from'	  			=> 'soporte@teleorion.com',
							
						'bcc'     			=> true,
							
						'name'     			=> $maildata['customer_info']['name'],
							
						'surname'    		=> $maildata['customer_info']['surname'],
							
						'email'     			=> $maildata['customer_info']['email'],
							
						'print_vars_es' => array(
								array('label'=>'Usuario:','value'=>$maildata['customer_info']['email']),
								array('label'=>'Descripcion:','value'=>$maildata['product_info']['description_product_es']),
								array('label'=>'Costo:','value'=> '$US '.$maildata['product_info']['amount']),
								array('label'=>'Tarjeta de crédito:','value'=> $maildata['credit_info']['type']),
								array('label'=>'código autorización:','value'=> $maildata['authcode']),
								array('label'=>'Proximo Vencimiento:','value'=> date('d/m/Y',mydatetotimestamp($maildata['date_info']['next_payment']))),
								array('label'=>'Teléfono:','value'=> "+{$maildata['customer_info']['areacode']}{$maildata['customer_info']['phone']}")
						),
						
						'print_vars_pt' 	=> array(
								array('label'=>'Usuário','value'=>$maildata['customer_info']['email']),
								array('label'=>'Descrição','value'=> $maildata['product_info']['description_product_pt']),
								array('label'=>'Costo:','value'=> '$US '.$maildata['product_info']['amount']),
								array('label'=>'Cartão de crédito:','value'=> $maildata['credit_info']['type']),
								array('label'=>'Código autorización:','value'=> $maildata['authcode']),
								array('label'=>'Proximo Maturidade:','value'=> date('d/m/Y',mydatetotimestamp($maildata['date_info']['next_payment']))),
								array('label'=>'Telefone:','value'=> "+{$maildata['customer_info']['areacode']}{$maildata['customer_info']['phone']}")
						)
				);
			
				return $mail_body;
					
			}
			
			/**
			 *
			 * Static Function premium
			 */
			static function makepayment($maildata){
					
				$mail_body 		= array(
						
						'lang'   			 	=> $maildata['lang'],
							
						'areacode'    	=> $maildata['customer_info']['areacode'],
							
						'phone'				=>  $maildata['customer_info']['phone'],
							
						'body_es'     	=> 'Gracias por Efectuar pago en Teleorion '.ucfirst($maildata['customer_info']['name']).'  '.ucfirst($maildata['customer_info']['surname']).' / Vencimiento: '.date('d/m/Y',mydatetotimestamp(mydateadd(mydate(), $maildata['product_info']['cycle']))),
							
						'body_pt' 			=>  'Graças por pagamento em Teleorion'.ucfirst($maildata['customer_info']['name']).' '.ucfirst($maildata['customer_info']['surname']).'  / Maturidade: '.date('d/m/Y',mydatetotimestamp(mydateadd(mydate(), $maildata['product_info']['cycle']))),
							
						'subject_es' 	=>  'Gracias por Efectuar pago en Teleorion  '.ucfirst($maildata['customer_info']['name']).'  '.ucfirst($maildata['customer_info']['surname']),
							
						'subject_pt'  	=>  'Graças por pagamento em Teleorion '.ucfirst($maildata['customer_info']['name']).' '.ucfirst($maildata['customer_info']['surname']),
							
						'fromname_es'	=> 'Soporte Teleorion',
							
						'fromname_pt'	=> 'Soporte Teleorion',
							
						'template'  		=> 'mail.tpl.html',
							
						'from'	  			=> 'soporte@teleorion.com',
							
						'bcc'     			=> true,
							
						'name'     			=> $maildata['customer_info']['name'],
							
						'surname'    		=> $maildata['customer_info']['surname'],
							
						'email'     			=> $maildata['customer_info']['email'],
							
						'print_vars_es' => array(
								array('label'=>'Plan:','value'=> $maildata['product_info']['name_product']),
								array('label'=>'Costo:','value'=> '$US '.$maildata['product_info']['amount']),
								array('label'=>'Forma de pago:','value'=> $maildata['credit_info']['type']),
								array('label'=>'código autorización:','value'=> $maildata['authcode']),
								array('label'=>'Proximo Vencimiento:','value'=> date('d/m/Y',mydatetotimestamp($maildata['date_info']['next_payment']))),
						),
							
						'print_vars_pt' 	=> array(
								array('label'=>'Plan:','value'=> $maildata['product_info']['name_product']),
								array('label'=>'Costo:','value'=> '$US '.$maildata['product_info']['amount']),
								array('label'=>'Forma de pago:','value'=> $maildata['credit_info']['type']),
								array('label'=>'Código autorización:','value'=> $maildata['authcode']),
								array('label'=>'Proximo Maturidade:','value'=> date('d/m/Y',mydatetotimestamp($maildata['date_info']['next_payment']))),
						)
				);
					
				return $mail_body;
			}
			
			/**
			 *
			 * Static Function premium
			 */
			static function paymentdeny($maildata){
					
				$mail_body 		= array(
			
						'lang'   			 	=> $maildata['lang'],
							
						'areacode'    	=> $maildata['customer_info']['areacode'],
							
						'phone'				=>  $maildata['customer_info']['phone'],
							
						'body_es'     	=> 'Pago en Teleorion  no efectuado'.ucfirst($maildata['customer_info']['name']).'  '.ucfirst($maildata['customer_info']['surname']),
							
						'body_pt' 			=>  'Pago en Teleorion em Teleorion no efectuado'.ucfirst($maildata['customer_info']['name']).' '.ucfirst($maildata['customer_info']['surname']),
							
						'subject_es' 	=>  'Pago en Teleorion  no efectuado  verifique '.ucfirst($maildata['customer_info']['name']).'  '.ucfirst($maildata['customer_info']['surname']),
							
						'subject_pt'  	=>  'Pago en Teleorion  no efectuado  verifique'.ucfirst($maildata['customer_info']['name']).' '.ucfirst($maildata['customer_info']['surname']),
							
						'fromname_es'	=> 'Soporte Teleorion',
							
						'fromname_pt'	=> 'Soporte Teleorion',
							
						'template'  		=> 'mail.tpl.html',
							
						'from'	  			=> 'soporte@teleorion.com',
							
						'bcc'     			=> true,
							
						'name'     			=> $maildata['customer_info']['name'],
							
						'surname'    		=> $maildata['customer_info']['surname'],
							
						'email'     			=> $maildata['customer_info']['email'],
							
						'print_vars_es' => array(
								array('label'=>'Usuario:','value'=>$maildata['customer_info']['email']),
								array('label'=>'Costo:','value'=> '$US '.$maildata['product_info']['amount']),
								array('label'=>'Forma de pago:','value'=> $maildata['credit_info']['type']),
								array('label'=>'código autorización:','value'=> $maildata['authcode'])
						),
							
						'print_vars_pt' 	=> array(
								array('label'=>'Usuário','value'=>$maildata['customer_info']['email']),
								array('label'=>'Costo:','value'=> '$US '.$maildata['product_info']['amount']),
								array('label'=>'Forma de pago:','value'=> $maildata['credit_info']['type']),
								array('label'=>'Código autorización:','value'=> $maildata['authcode']),
						)
				);
					
				return $mail_body;
			}
	}
?>