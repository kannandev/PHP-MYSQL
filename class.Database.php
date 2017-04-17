<?php 
/**
 * Database connectivity class
 */ 
class Database{
	//Hold the class instance
	private static $instance = null;
	private $conn = '';
	private $host = '';
	private $user = '';
	private $password = '';
	private $dbName = '';
	private $port = '';
	private $debug = '';

	/**
	* Constructor is private to prevent initiation from outer
	* @params array $data
	*/ 
	private function __construct( $data = array() ){
		$this->host = DB_HOST;
		$this->userName = DB_USER_NAME;
		$this->password = DB_PASSWORD;
		$this->dbName = DB_NAME;
		$this->connect();
	}

	/**
	* Method getInstance
	* Object is created within the class itself
	* @params array 
	* @return $instance
	*/ 
	public static function getInstance(){
	   if ( self::$instance === null ) 
			self::$instance = new Database();
		return self::$instance;
	}

	/**
	* Connect Method
	* Establish a database connection
	*/
	private function connect(){
		$dbError = '';
		if ( !$this->conn ) {
			try {
				$this->conn = new mysqli($this->host, $this->userName, $this->password);
				mysqli_select_db($this->conn,$this->dbName);
				mysqli_set_charset($this->conn,'utf8');
			} catch (Exception $e){
				throw new Exception( mysqli_error($this->conn) );
			}
		}
		return $this->conn;
	}

	/**
	 * Execute Method
	 * Method for execute qry
	 */ 
	 public function execute($qry = ''){
		 $error = array();
		 $conn = $this->conn;
		 if ( empty($qry) ) $this->handleErrors('Qry should not be empty');
		 if ( !$response = mysqli_query($conn, $qry) ) {
			$error['DBError'][] = mysqli_error($conn) ;
			$error['DBError'][] = 'Qry ['.$qry.']';
			$this->handleErrors($error);
			return false;
		 }
		 return $response;
		  
	 }
	   
	/**
	 * disconnect method
	 * For destroy the object
	 *
	 */
	public function disConnect(){
		
		if ($this->conn) {
			$this->conn = null;
		}
	} 
	
	/**
	 * Fetch Method
	 * @return OBJECT
	 */ 
	 public function fetch($qry = ''){
		$res = '';
		$qryResult = '';
		$data = array();
		$res = $this->execute($qry);
		if ( !empty($res) ) {
			while ( $qryResult = mysqli_fetch_assoc($res) ) {
				$data[] = (object)$qryResult; 
			}
		}
		return $data;
	 }

	/**
	  * Handle error 
	  * For Error handling function
	  */ 
	 public function handleErrors($error = ''){
		  $logObj = Logging::getInstance();
		 $exception = array(
		 'type' => 'DBrror',
		 'Msg' => 'Database Exception',
		 'desc' => $error
		 );
		 $logObj->lwrite($exception);
	 }
}
?>
