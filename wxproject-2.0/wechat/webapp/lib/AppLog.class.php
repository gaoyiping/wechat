<?php
define('LOGAPP_DIR',MO_WEBAPP_DIR . '/log');

class AppLog {

	private $logfile;

	private function display($msg){
		return date('!Y-m-d H:i:s!') . $msg . "\n";
	}
	
	public function __construct(){
		if(!@file_exists(LOGAPP_DIR)){
			@mkdir(LOGAPP_DIR,0777);
		}
		$dhandler = @opendir(LOGAPP_DIR);
		if(!$dhandler) { return; }
		while (false !== ($file = @readdir($dhandler))) {
			if ($file != "." && $file != "..") {
				$file = LOGAPP_DIR . '/' . $file;
				if(@is_file($file)){
					$fsize = @filesize($file);
					if($fsize < 1000000){
						$this->logfile = $file;
						break;
					}
				}
			}
		}
		@closedir($dhandler);
		if(!$this->logfile){
			$this->logfile = LOGAPP_DIR . '/' . time() . '.log';
		}
	}

	public function log($msg){
		if(!$this->logfile) { return; }
		$fhandler = @fopen($this->logfile,'a');
		if($fhandler){
			@fwrite($fhandler,$this->display($msg));
		}
		@fclose($fhandler);
		return;
	}

}

?>