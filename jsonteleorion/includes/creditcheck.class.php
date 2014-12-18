<?php
/**
 *	Credit validator class
 */
class Creditcheck{
						
	/**
	* Validate credit card number and return card type.
	* Optionally you can validate if it is a specific type.
	*
	* @param string $ccnumber
	* @param string $cardtype
	* @param string $allowTest
	* @return mixed
	*/
	public function CreditCard($ccnumber, $cardtype = ''){
		// Check for test cc number
		
	$ccnumber = preg_replace('/[^0-9]/','',$ccnumber); // Strip non-numeric characters
	
		$creditcard = array(
			'Visa'	=>	"/^4\d{3}-?\d{4}-?\d{4}-?\d{4}$/",
			'Mastercard'	=>	"/^5[0-5]\d{2}-?\d{4}-?\d{4}-?\d{4}$/",
			'Discover'	=>	"/^6011-?\d{4}-?\d{4}-?\d{4}$/",
			'American Express'	=>	"/^3[4,7]\d{13}$/"
		);
		$other_credits_card = array(
			'diners'	=>	"/^3[0,6,8]\d{12}$/",
			'bankcard'	=>	"/^5610-?\d{4}-?\d{4}-?\d{4}$/",
			'jcb'	=>	"/^[3088|3096|3112|3158|3337|3528]\d{12}$/",
			'enroute'	=>	"/^[2014|2149]\d{11}$/",
			'switch'	=>	"/^[4903|4911|4936|5641|6333|6759|6334|6767]\d{12}$/"
		);
		
		if(empty($cardtype)){
				$match=false;
				foreach($creditcard as $cardtype=>$pattern){
					
						if(preg_match($pattern,$ccnumber)==1){
							$match=true;
							break;
						}
				}

				if(!$match){
					return false;
				}
			
		}else{
			
			if(@preg_match($creditcard[strtolower(trim($cardtype))],$ccnumber)==0){
				return false;
			}
		}	

		$return['valid']	=	$this->LuhnCheck($ccnumber);
		
		$return['ccnum']	=	$ccnumber;
		
		$return['type']	=	$cardtype;
		
		return $return;
	}

	/**
	* Do a modulus 10 (Luhn algorithm) check
	*
	* @param string $ccnum
	* @return boolean
	*/
	public function LuhnCheck($ccnum){
			
			$checksum = 0;
		
			for ($i=(2-(strlen($ccnum) % 2)); $i<=strlen($ccnum); $i+=2){
				$checksum += (int)($ccnum{$i-1});
			}
		
			// Analyze odd digits in even length strings or even digits in odd length strings.
			for ($i=(strlen($ccnum)% 2) + 1; $i<strlen($ccnum); $i+=2){
				
				$digit = (int)($ccnum{$i-1}) * 2;
				
				if ($digit < 10){
					$checksum += $digit;
				}else{
					$checksum += ($digit-9);
				}
			}
			
			if($ccnum!='' && $ccnum!='0'){
				
				if(($checksum % 10) == 0){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
	}
	/**
	 * Validate a Card Expiration Check
	 *
	 * @param string $month
	 * @param string $year
	 * @return boolean 
	 */
	 public function Card_Expiration_Check($month,$year){
	
		$date_compare = strtotime('01-'.$month.'-'.$year);
		
		$date_now	  = strtotime(date('d-m-Y'));
		
		if($date_compare>=$date_now){
			return true;
		}else{
			return false;
		}
	}						
}
?>