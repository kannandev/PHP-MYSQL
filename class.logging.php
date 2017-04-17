<?php
/**
 * Logging Class
 * contains lfile, lwrite and lclose public methods
 */  
class Logging {
	private $logFile, $fp;
	private static $instance = null;
	
    /**
     * Construct  Method
     * Initialize configuration
     */
     public function __construct(){
		 $this->logFile = LOG_FILE;
	 }
	  	
	/**
	 * getInstance Method
	 * Object is created within the class itself
	 * @return $instance
	 */ 
	 public static function getInstance(){
		if ( self::$instance === null )
			self::$instance = new Logging();
		return self::$instance;
	 }

	/**
	 * LogWrite Method
	 */ 
	public function lwrite($message) {
		
		if ( is_array($message) )
			$message = var_export($message, TRUE);

		if (!is_resource($this->fp)) {
			$this->lopen();
		}
		$scriptName = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
		$time = @date('[d/M/Y:H:i:s]');
		fwrite($this->fp, "$time ($scriptName) $message" . PHP_EOL);
		$this->lclose();
	}
	
	/**
	 * LogClose Method
	 */ 
	public function lclose() {
		fclose($this->fp);
	}
	
	/**
	 * LogOpen Method
	 */ 
	private function lopen() {
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			$logFileDefault = 'c:/php/logfile.txt';
		}
		else {
			$logFileDefault = '/tmp/logfile.txt';
		}
		
		$lfile = $this->logFile ? $this->logFile : $logFileDefault;
		$this->fp = fopen($lfile, 'a') or exit("Can't open $lfile!");
	}
}
?>
