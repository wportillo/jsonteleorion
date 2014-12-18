 <?php
	/**
	 * Class Form
	 *
	 * @author willam
	 */
	
		class Form{
			
			public $post;
			
			public function __construct(){
	
					$formdata           = _request('formdata'); 

					$this->post   	   = json_decode($formdata);					

					if(isset($this->post->object)){
						
						if (class_exists($this->post->object)) {
						
							$call = new $this->post->object($this->post);
								
							$call->{$this->post->method}();
								
						}
					}
  
                                                                              
                                                                          
					
                                        if(isset($this->post->object_device)){
					
                                        	
						if (class_exists($this->post->object_device)) {
                                                  
                                      	        	$call = new $this->post->object_device($this->post);
						
                                                        $call->{$this->post->method_device}();
								
                                                }
					
                                      
                                        }
                                        
					
				}
		}
?>