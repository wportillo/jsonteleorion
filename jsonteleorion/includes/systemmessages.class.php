 <?php 
	 /*
	  * System messages
	  * @author william
	  */
		class Sysmessages{
				
				/**
				 * Form Messages
				 */
					public static $lang   		 					= array('language'=>array('es'=>'Lenguaje obrigatório','pt'=>'Lenguaje obrigatório'),'code'=>'001');
					
					public static $name 		 					= array('language'=>array('es'=>'Nombre obrigatório','pt'=>'Nombre obrigatório'),'code'=>'002');
					
					public static $checkname 					= array('language'=>array('es'=>'Nombre debe tener un minimo de 2 hasta 50 caracteres','pt'=>'Nombre debe tener un minimo de 2 hasta 50 caracteres'),'code'=>'030');
			
					public static $surname 	 					= array('language'=>array('es'=>'Apellido obrigatório','pt'=>'Apellido obrigatório'),'code'=>'003');
					
					public static $checksurname				= array('language'=>array('es'=>'Apellido debe tener un minimo de 2 hasta 50 caracteres','pt'=>'Apellido debe tener un minimo de 2 hasta 50 caracteres'),'code'=>'031');
	
					public static $email 			 					= array('language'=>array('es'=>'E-mail obrigatório','pt'=>'E-mail obrigatório'),'code'=>'004');
					
					public static $validemail 	 					= array('language'=>array('es'=>'Digite correctamente E-mail ej xxx@test.com','pt'=>'Digite correctamente E-mail ej xxx@test.com'),'code'=>'005');
	
					public static $verifyemail  					= array('language'=>array('es'=>'Confirmación E-mail obrigatório','pt'=>'Confirmación E-mail obrigatório'),'code'=>'006');
					
					public static $checkverifyemail  			= array('language'=>array('es'=>'E-mail & confirmación  E-mail deben ser iguales','pt'=>'E-mail & confirmación  E-mail deben ser iguales'),'code'=>'007');
					
					public static $existemail   					= array('language'=>array('es'=>'E-mail ya existente en nuestra base de datos intente ingresar','pt'=>'E-mail ya existente en nuestra base de datos intente ingresar'),'code'=>'008');
					
					public static $password    					= array('language'=>array('es'=>'Contraseña obligatoria','pt'=>'Contraseña obligatoria'),'code'=>'009');
					
					public static $checkpassword    		= array('language'=>array('es'=>'Contraseña debe tener un minimo de 2 hasta 50 caracteres','pt'=>'Contraseña debe tener un minimo de 5 hasta 50 caracteres'),'code'=>'010');
					
					public static $verifypassword    			= array('language'=>array('es'=>'Confirmación Contraseña obligatoria','pt'=>'Confirmación Contraseña obligatoria'),'code'=>'011');
					
					public static $checkverifypassword   = array('language'=>array('es'=>'Contraseña & Confirmación Contraseña deben ser iguales','pt'=>'Contraseña & Confirmación Contraseña deben ser iguales'),'code'=>'012');
					
					public static $checkcountrycode    	= array('language'=>array('es'=>'Código de País debe tener un minimo de 1 hasta 7 caracteres ','pt'=>'Código de País debe tener un minimo de 1 hasta 7 caracteres'),'code'=>'013');
					
					public static $countrycode    				= array('language'=>array('es'=>'Código de País obrigatório','pt'=>'Código de País obrigatório'),'code'=>'014');
					
					public static $checkphone    				= array('language'=>array('es'=>'Número telefónico debe tener un minimo de 4 hasta 20 dígitos','pt'=>'Número telefónico debe tener un minimo de 4 hasta 20 dígitos'),'code'=>'015');
					
					public static $phone    				 		= array('language'=>array('es'=>'Número telefónico obrigatório','pt'=>'Número telefónico obrigatório'),'code'=>'016');
					
					public static $product    				 		= array('language'=>array('es'=>'Producto obligatorio','pt'=>'Producto obrigatório'),'code'=>'017');
					
					public static $checkproduct    			= array('language'=>array('es'=>'Producto inexistente','pt'=>'Producto inexistente'),'code'=>'018');
					
					public static $address    				 		= array('language'=>array('es'=>'Dirección obligatoria','pt'=>'Dirección obligatoria'),'code'=>'019');
					
					public static $checkaddress    			= array('language'=>array('es'=>'Dirección debe tener un minimo de 3 hasta 50 caracteres','pt'=>'Código de País debe tener un minimo de 3 hasta 50 caracteres'),'code'=>'020');
					
					public static $city    				 			= array('language'=>array('es'=>'Ciudad obligatoria','pt'=>'Ciudad obligatoria'),'code'=>'021');
					
					public static $checkcity    					= array('language'=>array('es'=>'Ciudad debe tener un minimo de 3 hasta 50 caracteres','pt'=>'Ciudad debe tener un minimo de 3 hasta 50 caracteres'),'code'=>'022');
					
					public static $state    				 			= array('language'=>array('es'=>'Estado obligatorio','pt'=>'Estado obrigatório'),'code'=>'023');
					
					public static $checkstate    				= array('language'=>array('es'=>'Estado debe tener un minimo de 3 hasta 50 caracteres','pt'=>'Estado debe tener un minimo de 3 hasta 50 caracteres'),'code'=>'024');
					
					public static $zip    				 				= array('language'=>array('es'=>'Código postal obligatorio','pt'=>'Código postal obligatorio'),'code'=>'025');
					
					public static $checkzip    					= array('language'=>array('es'=>'Código postal debe tener un minimo de 2 hasta 50 caracteres','pt'=>'Código postal debe tener un minimo de 2 hasta 50 caracteres'),'code'=>'026');
					
					public static $country    				 		= array('language'=>array('es'=>'País obligatorio','pt'=>'País obligatorio'),'code'=>'027');
						
					public static $checkcountry    			= array('language'=>array('es'=>'Debe seleccionar un País','pt'=>'Debe seleccionar un País'),'code'=>'028');
					
					public static $paymentmethod  			= array('language'=>array('es'=>'Método de pago obligatorio','pt'=>'Método de pago obligatorio'),'code'=>'029');
					
					public static $creditnumber  	  			= array('language'=>array('es'=>'Número de tarjeta obligatorio','pt'=>'Número de tarjeta obligatorio'),'code'=>'032');

					public static $checkcreditnumber  	    = array('language'=>array('es'=>'Número de tarjeta de crédito incorrecto','pt'=>'Número de tarjeta de crédito incorrecto'),'code'=>'033');

					public static $cvvnumber  	  				= array('language'=>array('es'=>'Código de seguridad de tarjeta obligatorio','pt'=>'Número de tarjeta obligatorio'),'code'=>'034');
					
					public static $checkcvvnumber  	  	= array('language'=>array('es'=>'Código de seguridad incorrecto','pt'=>'Código de seguridad incorrecto'),'code'=>'035');
					
					public static $month 	  					 	= array('language'=>array('es'=>'Mes obligatorio','pt'=>'Mes obligatorio'),'code'=>'036');
						
					public static $year 	  					 		= array('language'=>array('es'=>'Año obligatorio','pt'=>'Año obligatorio'),'code'=>'037');
					
					public static $cardexpired 	  				= array('language'=>array('es'=>'Tarjeta de crédito expirada','pt'=>'Tarjeta de crédito expirada'),'code'=>'038');

					public static $declinedtransaction 	    = array('language'=>array('es'=>'Transacción declinada','pt'=>'Transacción declinada'),'code'=>'039');
					
					public static $requestcontact 	    		= array('language'=>array('es'=>'Requerimiento obligatorio','pt'=>'Requerimiento obligatorio'),'code'=>'040');
					
					public static $checkmessagecontact = array('language'=>array('es'=>'Mensaje debe tener un minimo de 20 hasta 100 caracteres','pt'=>'Mensaje debe tener un minimo de 20 hasta 100 caracteres'),'code'=>'041');
					
					public static $messagecontact 	    	= array('language'=>array('es'=>'Mensaje obligatorio','pt'=>'Mensaje obligatorio'),'code'=>'042');
					
					public static $invalidemail 					= array('language'=>array('es'=>'Este E-mail no esta registrado en Teleorion','pt'=>'Este E-mail no esta registrado en Teleorion'),'code'=>'043');

					public static $invalidpassword 	    	= array('language'=>array('es'=>'Contraseña digitada es incorrecta','pt'=>'Contraseña digitada es incorrecta'),'code'=>'044');
					
					public static $debit 	    						= array('language'=>array('es'=>'Seleccione para activar o desactivar el débito automático','pt'=>'Seleccione para activar o desactivar el débito automático'),'code'=>'045');
					
					public static $device 	    					= array('language'=>array('es'=>'Seleccione tipo de dispositivo','pt'=>'Seleccione tipo de dispositivo'),'code'=>'046');
					
					public static $invalidmac 	    			= array('language'=>array('es'=>'El mac (MAC ADDRESS) ingresado es incorrecto','pt'=>'El (MAC ADDRESS) ingresado es incorrecto'),'code'=>'047');

					public static $invalidchannel 	    		= array('language'=>array('es'=>'El parámetro i_channel es obligatorio','pt'=>'O parâmetro i_channel é necessária'),'code'=>'048');

					public static $invalidchannelid 	    	= array('language'=>array('es'=>'El ID de canal solicitado no existe','pt'=>'O ID do canal solicitado não existe'),'code'=>'049');
						
					public static $inactiveuser 	    			= array('language'=>array('es'=>'Usuario inactivo','pt'=>'usuário não registrado'),'code'=>'050');
					
					public static $inactivecookie 	    		= array('language'=>array('es'=>'Cookie caducada','pt'=>'cookie expirado'),'code'=>'051');
					
					public static $invalidfbid 	    				= array('language'=>array('es'=>'Id de facebook incorrecto','pt'=>'id do facebook errado'),'code'=>'052');

					public static $invalidemailfb 				= array('language'=>array('es'=>'El E-mail asociado a su cuenta de facebook no existe en Teleorion','pt'=>'El E-mail asociado a su cuenta de facebook no existe en Teleorion'),'code'=>'053');
					
					public static $unlinkfacebook	    		= array('language'=>array('es'=>'Primero linkea tu cuenta de Facebook con tu cuenta de Teleorion accediendo a Redes Sociales en mi cuenta','pt'=>'Primeiro linkee sua conta do Facebook com sua conta Teleorion Redes Sociales en mi cuenta'),'code'=>'054');
					
					public static $invaliduserid	    			= array('language'=>array('es'=>'Necesita estar logueado para realizar esta acción','pt'=>'Precisa fazer login para realizar esta ação'),'code'=>'055');
						
					public static $statuschannel 	    		= array('language'=>array('es'=>'El canal solicitado esta temporalmente fuera de servicio','pt'=>'O canal solicitado está temporariamente para baixo'),'code'=>'056');
					
					public static $activechannel 	    		= array('language'=>array('es'=>'El canal solicitado esta inactivo','pt'=>'O canal solicitado está ocioso'),'code'=>'057');

					public static $databaserror 	    		= array('language'=>array('es'=>'Problemas de coneccion con la Base de datos reintente nuevamente','pt'=>'Problemas conexão com a nova tentativa do banco de dados novamente'),'code'=>'058');
					
					public static $loggederror 	    			= array('language'=>array('es'=>'Acceder como usuario para realizar esta acción','pt'=>'Entrar membro para fazer isso'),'code'=>'059');
				
					public static $invalidserial 	    		= array('language'=>array('es'=>'Serial/MAC es obligatorio','pt'=>'Serial/MAC é necessário'),'code'=>'060');
					
					public static $invalidcategory 	    		= array('language'=>array('es'=>'Id de categoría obligatorio','pt'=>'ID de categoria obrigatória'),'code'=>'061');
					
					public static $inactiveuserfree 	    	= array('language'=>array('es'=>'Usuario inactivo','pt'=>'usuário não registrado'),'code'=>'062');
				
					public static $i_reseller 	    			= array('language'=>array('es'=>'Id de reseller obligatorio','pt'=>'Id de reseller obligatorio'),'code'=>'063');
						
					public static $i_store 	    				= array('language'=>array('es'=>'Id de tienda obligatorio','pt'=>'Id de tienda obligatorio'),'code'=>'064');
					
					public static $reseller_balance 	    	= array('language'=>array('es'=>'El Balanace De reseller no es suficiente para realizar estra transcaccion','pt'=>'O balanace De revendedor não é suficiente para fazer transcaccion estratégico'),'code'=>'065');

					public static $store_balance 	    		= array('language'=>array('es'=>'El Balanace De La tienda no es suficiente para realizar estra transcaccion','pt'=>'Balanace Of A loja não é suficiente para fazer transcaccion estratégico'),'code'=>'066');
					
					public static $reseller_payment 	    	= array('language'=>array('es'=>'Necesita definir un método de pago','pt'=>'É necessário definir um método de pagamento'),'code'=>'067');
					
					public static $invalidamount 	    		= array('language'=>array('es'=>'Necesita seleccionar un monto a recargar','pt'=>'Você precisa selecionar uma quantidade de recarregar'),'code'=>'068');
					
					public static $invalidcustomer 	    		= array('language'=>array('es'=>'El id de cliente es necesario','pt'=>'Id es El cliente necesario'),'code'=>'069');
					
					
				/*
				 * END
				 */
					public static function Excpetion($message) {
						
						$message['language']['code'] = $message['code'];

						throw new Exception(json_encode($message['language']),$message['code']);
					}
					/*
					 * END
					*/
					public static function Showerror($message) {
					
						$message['language']['code'] = $message['code'];
					
						return $message['language'];
					}
		}
?>