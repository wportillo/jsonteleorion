<?php
require('includes/UvaultTokenGenerator.php');

class Content{
		
	private $getdata;
	
	private $category;

	private $channels;

	public $security;
	
	/**
	 * Construct
	 *
	 */
		public function __construct($data){
				
			$this->category		   		= new Category();
	
			$this->channels		   		= new Channels();
			
			$this->security				= new Security($data);
			
			$this->getdata   				= objectToArray($data);
		}
	
	/**
	 *  Get Categories
	 *
	 * @param
	 *
	 */
		public function getcategorylist(){
			
			try{
			
				$this->security->validactive();
				
				$this->category->primary_key='active';
					
				$this->category->nolimit=true;
					
				Base::messageresponse($this->category->get(1));
			
			}catch (Exception $e){
			
				Base::messageresponse(array('error'=>json_decode($e->getMessage())));
			}
		}
		
	/**
	 *  Get Category
	 *
	 * @param integer $i_category
	 * @return json
	 *
	 */
	public function getcategory(){

		try{
			
				$this->security->validactive();
				
				if(!isset($this->getdata['i_category'])){
					Sysmessages::Excpetion(Sysmessages::$invalidcategory);
				}
				
				$category = $this->category->get_list(1,1,' i_category='.db::quote($this->getdata['i_category']).' AND active=1');

				$row = db::fetch_assoc($category);
				
				if(!$row){
					Sysmessages::Excpetion(Sysmessages::$invalidcategory);
				}
				
				Base::messageresponse($row);
			
		}catch (Exception $e){
			
				Base::messageresponse(array('error'=>json_decode($e->getMessage())));
		}
	}
	
	/**
	 *  Get Channel
	 *
	 * @param integer $i_category
	 * @return json
	 *
	 */
	public function getchannel(){
		
		try {
			
			$this->security->validactive();
			
			if(!isset($this->getdata['i_channel'])){
				Sysmessages::Excpetion(Sysmessages::$invalidchannel);
			}
			
			$rs_channel = $this->channels->get_list(1,1,' i_channel='.db::quote($this->getdata['i_channel']).' AND active=1');
				
			$row = db::fetch_assoc($rs_channel);
			
			$gen = new UvaultTokenGenerator();
			
			$token = $gen->generateToken();
				
			$mobile_token = "?token=".$token;
				
			$row['primary_rtmp'] = $row['primary_rtmp'];
				
			$row['secondary_rtmp'] = $row['secondary_rtmp'];
				
				
			$row['primary_rtsp'] = $row['primary_rtsp'];
			
			$row['secondary_rtsp'] = $row['secondary_rtsp'];
			
			
			$row['primary_hls']   = $row['primary_hls'].$mobile_token;
				
			$row['secondary_hls'] = $row['secondary_hls'].$mobile_token;
			
			$row['imagebox'] 	  = BASE_IMG_BOX.$row['imagebox'];

			$row['imagesite'] 	  = BASE_IMG_SITE.$row['imagesite'];
				
			$row['token']		  = $token;
				
			if(!$row){
				Sysmessages::Excpetion(Sysmessages::$invalidchannelid);
			}
			
			if($row['status']==0){
				Sysmessages::Excpetion(Sysmessages::$statuschannel);
			}

				Base::messageresponse($row);
				
			}catch (Exception $e){

				Base::messageresponse(array('error'=>json_decode($e->getMessage())));
		   	
			}
	}
	
	/**
	 *  Get Channel
	 *
	 * @param integer $i_category
	 * @return json
	 *
	 */
		public function getchannellist(){
		
			try {
					
				$this->security->validactive();
				
				if(!isset($this->getdata['i_category'])){
					Sysmessages::Excpetion(Sysmessages::$invalidcategory);
				}
					
				$rs_channel = $this->channels->get_list('','',' i_category='.db::quote($this->getdata['i_category']).' AND active=1');
		
				$channels=array();

				$gen = new UvaultTokenGenerator();

				while($row = db::fetch_assoc($rs_channel)){
					
					$token = $gen->generateToken();
					
					$mobile_token = "?token=".$token;
					
					$row['primary_rtmp'] = $row['primary_rtmp']; 
					
					$row['secondary_rtmp'] = $row['secondary_rtmp'];
					
					
					$row['primary_rtsp'] = $row['primary_rtsp'];
						
					$row['secondary_rtsp'] = $row['secondary_rtsp'];
						

					$row['primary_hls'] = $row['primary_hls'].$mobile_token;
					
					$row['secondary_hls'] = $row['secondary_hls'].$mobile_token;
					
					$row['token']		  = $token;
					
					$row['imagebox'] 	  = BASE_IMG_BOX.$row['imagebox'];

					$row['imagesite'] 	  = BASE_IMG_SITE.$row['imagesite'];
					
					$channels[] = $row;	
				}
		
				if(count($channels)==0){
					Sysmessages::Excpetion(Sysmessages::$invalidcategory);
				}
				
				Base::messageresponse($channels);
				
			}catch (Exception $e){
		
				Base::messageresponse(array('error'=>json_decode($e->getMessage())));
		
			}
		}
}
?>