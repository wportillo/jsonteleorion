<?php
	/**
	 * 	Templates Basic Emails
	 */
		class Emailtemplatebasic{
		
			/*
			 * Static Function Recovery
			 */
				static function recovery($c_data){

					$mail_body 	= array(
					
							'lang'			  =>  $c_data['lang'],
								
							'areacode'     =>  $c_data['areacode'],
								
							'phone'			  =>  $c_data['phone'],
								
							'body_es' 	   =>  'Hola '.ucfirst($c_data['name']).'  '.ucfirst($c_data['surname']).'  tu contraseña de Teleorion es :'.$c_data['password'],
					
							'body_pt' 		   =>  'Olá '.ucfirst($c_data['name']).'  '.ucfirst($c_data['surname']).' senha de Teleorion é : '.$c_data['password'],
					
							'subject_es'    =>  'Hola '.ucfirst($c_data['name']).'  '.ucfirst($c_data['surname']).' este e-mail contiene la contraseña de Teleorion',
								
							'subject_pt' 	   =>  'Olá '.ucfirst($c_data['name']).'  '.ucfirst($c_data['surname']).' este e-mail é uma resposta Teleorion senha',
								
							'fromname_es'	=>  'Soporte Teleorion',
								
							'fromname_pt'	=>  'Suporte Teleorion',
								
							'template'  		=> 'mail.tpl.html',
								
							'from'	  			=> 'soporte@teleorion.com',
								
							'bcc'     			=> true,
								
							'name'     			=> $c_data['name'],
					
							'surname'    		=> $c_data['surname'],
					
							'email'     			=> $c_data['email'],
								
							'print_vars_es' => array(
									array('label'=>'Fecha:','value'			=> date('d/m/Y',time())),
									array('label'=>'Email:','value'			=> $c_data['email']),
									array('label'=>'Contraseña:','value'=>  $c_data['password']),
							),
								
							'print_vars_pt' => array(
									array('label'=>'Data:','value'			=> date('d/m/Y',time())),
									array('label'=>'Email:','value'			=> $c_data['email']),
									array('label'=>'Senha:','value'		    => $c_data['password']),
							)
					);
					
					return $mail_body;
				}
				
			/*
			 * Conctact
			 *@param array $c_data
			 *
			 *@return array
			 */	
				static function contact($c_data){
							
						$company_body 	= array(
									
									'lang'				=>'es',
									
									'notsms'			=>true,
									
									'subject_es' 	=> 'Consulta Teleorion de '.ucfirst($c_data['name']).'  '.ucfirst($c_data['surname']),
		
									'fromname_es'	=>  'Soporte Teleorion',
		
									'template'  		=> 'mail.tpl.html',
										
									'from'	  			=> 'soporte@teleorion.com',
										
									'bcc'     			=> true,
										
									'print_vars_es' => array(
										    array('label'=>'Fecha:','value'			=> date('d/m/Y',time())),
											array('label'=>'Email:','value'			=> $c_data['email']),
											array('label'=>'Telefono:','value'		=> "+{$c_data['areacode']}{$c_data['phone']}"),
											array('label'=>'Tipo:','value'			=> $c_data['request']),
											array('label'=>'Mensaje:','value'		=> $c_data['message']),
									)
							);
						
							$customer_body 	= array(
										
									'lang'			  =>  $c_data['lang'],
									
									'areacode'     =>  $c_data['areacode'],
									
									'phone'			  =>  $c_data['phone'],
									
									'body_es' 	   =>  'Hola '.ucfirst($c_data['name']).'  '.ucfirst($c_data['surname']).' pronto nos estaremos contactando para darle respuesta a su pregunta',
										
									'body_pt' 		   =>  'Olá '.ucfirst($c_data['name']).' '. ucfirst ($c_data['surname']).' Entraremos em contato em breve para dar resposta à sua pergunta',
										
									'subject_es' 	=>  'Hola '.ucfirst($c_data['name']).'  '.ucfirst($c_data['surname']).' pronto nos estaremos contactando para darle respuesta a su pregunta',
									
									'subject_pt' 	=>  'Olá '.ucfirst($c_data['name']).' '. ucfirst ($c_data['surname']).' Entraremos em contato em breve para dar resposta à sua pergunta',
							
									'fromname_es'	=>  'Soporte Teleorion',
							
									'fromname_pt'	=>  'Suporte Teleorion',
									
									'template'  		=> 'mail.tpl.html',
							
									'from'	  			=> 'soporte@teleorion.com',
							
									'bcc'     			=> false,
									
									'name'     			=> $c_data['name'],
										
									'surname'    		=> $c_data['surname'],
										
									'email'     			=> $c_data['email'],
									
									'print_vars_es' => array(
											array('label'=>'Fecha:','value'			=> date('d/m/Y',time())),
											array('label'=>'Email:','value'			=> $c_data['email']),
											array('label'=>'Telefono:','value'		=> "+{$c_data['areacode']}{$c_data['phone']}"),
									),
									
									'print_vars_pt' => array(
											array('label'=>'Data:','value'			=> date('d/m/Y',time())),
											array('label'=>'Email:','value'			=> $c_data['email']),
											array('label'=>'Telefone:','value'		=> "+{$c_data['areacode']}{$c_data['phone']}"),
									)
							);
						
							return array('company'=> $company_body,'customer'=>$customer_body);
				}
		}
?>