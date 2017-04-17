<?php
/**
 * Curl class 
 */  
 class Curl{
	 
	 private static $instance = null;
	 
	/**
	* Method getInstance
	* Object is created within the class itself
	* @params array 
	* @return $instance
	*/ 
	public static function getInstance(){
	   if ( self::$instance === null ) 
			self::$instance = new Curl();
		return self::$instance;
	}
	 
	/**
	 * For get input from remote URL
	 * @param String url
	 * @param $fields Array
	 */  
	 public function get( $url = '' ,$fields = array() ) { 
		    $url = $url;
		    $fields_string = '';
			$data_string = json_encode($fields);
			//open connection
			$ch = curl_init();
			//set the url, number of POST vars, POST data
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
			curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                                
			'Content-Length: ' . strlen($data_string))                                                                       
			);                             
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//execute post
			$result = curl_exec($ch);
			if ($result === FALSE) {
				$result =  curl_error($ch);
			} 
			
			
			//close connection
			curl_close($ch);
			return $result;
	 }
	 
	 /**
	 * For post Form data 
	 * @custom header URL encoded
	 * @param String url
	 * @param $fields Array
	 */  
	 public function postRawData( $url = '' ,$fields = array() ) { 
		    $url = $url;
			$data_string = '';
			if ( is_array() ) {
				foreach( $fields as $value) 
					$data_string .= $key.'='.$value.'&';
			}
			$data_string .= rtrim('&', $data_string);
			//open connection
			$ch = curl_init();
			//set the url, number of POST vars, POST data
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
			curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
				'Content-Type: application/x-www-form-urlencoded'
				)                                                                       
			);                             
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//execute post
			$result = curl_exec($ch);
			if ($result === FALSE) {
				$result =  curl_error($ch);
			} 
			
			
			//close connection
			curl_close($ch);
			return $result;
	 }
	 
	 /**
	 * For get input from remote URL
	 * @param String url
	 * @param $fields Array
	 */  
	 public function postAuthToken( $url = '' ,$fields = array(), $authToken = '') {
		    $url = $url;
		    $fields_string = '';
			$data_string = json_encode($fields);
			//open connection
			$ch = curl_init();
			//set the url, number of POST vars, POST data
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
			curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                                
			'Content-Length: ' . strlen($data_string),                                                                       
			 'AUTH_TOKEN:'.$authToken,                                                                      
			)
			);                             
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//execute post
			$result = curl_exec($ch);
			if ($result === FALSE) {
				$result =  curl_error($ch);
			} 
			//close connection
			curl_close($ch);
			return $result;
	 }

 }
?>
