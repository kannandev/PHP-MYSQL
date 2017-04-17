<?php 
class users implements usersInterface {
	
	private static $instance = null;
	private $tableName = 'users';
	
	/**
	 * constructor method
	 */ 
	
	/**
	 * User create method
	 */ 
	 public function create($qry = ''){
	 }
	 
	 /**
	  * findOne method
	  * @params $qry
	  * @return OBJECT
	  */  
	  public function findOne($qry = ''){
	  }
	  
	  /**
	   * findAll method
	   * @params $qry
	   * @return OBJECT
	   */ 
	   public function findAll($qry){
	   }
	   
	   /**
		* update method
		* @params $qry
		* @return OBJECT
		*/ 
		public function update($qry = ''){
		}
		
		/*
		 * getInstance Method
		 * Object has been create inside a class
		 * @return OBJECT
		 */ 
		public static function getInstance(){
			if ( self::$instance === null ) 
				self::$instance = new Users();
			return self::$instance;
		}
		
		/**
		 * get table schema
		 * @return array
		 */ 
		 public function getSchema(){
			 $qryResult = '';
			 $logData = array();
			 $logData['Users']['function'] = __FUNCTION__;
			 $tableName = $this->tableName;
			 $data = array();
			 $db = Database::getInstance();
			 $log = Logging::getInstance();
			 $query = "SHOW COLUMNS FROM $tableName";
			 $logData['Users']['query'] = $query;
			 $qryResult = $db->fetch($query);
			 $log->lwrite($logData);
			 print_r($qryResult);
		 }
}
?>
