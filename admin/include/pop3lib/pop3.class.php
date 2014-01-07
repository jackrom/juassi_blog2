<?php
//error_reporting(0);

class Pop3 {
	var $_server;
	var $_userName;
	var $_passWord;
	var $_port;
	var $_connection;
	var $messages;
	var $mailCount;
	
	function Pop3($server, $userName, $passWord, $port = 110) {
		$this->_server		= $server;
		$this->_userName	= $userName;
		$this->_passWord	= $passWord;
		$this->_port		= $port;
		$this->messages		= array();
	}
	
	function login() {
		//If the server property's been set
		//We should be good to go
		if (!empty($this->_server)) {
		    $this->_connection = @fsockopen($this->_server, $this->_port);
			$connectionResponse = @fgets($this->_connection,512);
        
			//If the connection is successful
			if ($this->_connection) {

				//Send the username
			    @fputs($this->_connection, "USER " . $this->_userName."\r\n");
  				$userResponse = @fgets($this->_connection,512);

				//Send the password
  				@fputs($this->_connection, "PASS ".$this->_passWord."\r\n");
				$passResponse = @fgets($this->_connection,512);

				//If the response is +OK, then login is successful.
  				if(strstr($passResponse, "+OK")) {
					//@fputs($this->_connection,"STAT\r\n");
 					//$statResponse = split(" ",@fgets($this->_connection,512));

					$this->getEmailHeaders();
					
					//Get the number of emails
					$this->mailCount = count($this->messages);
					
					//echo $this->mailCount = count($this->messages);
					
					return true;
				}
			}
		}
		
		//We shouldn't make it here. If we do, then something failed.
		return false;
	}
	
	function logoff() {
		@fwrite($this->_connection, "QUIT\r\n");
		$reply = fgets($this->_connection, 512);
		$reply = $this->_strip_clf($reply);
				
		@fclose($this->_connection);
		unset($this->_connection);
	}
	
	function _strip_clf ($text = "")
	{
		// Strips \r\n from server responses
		if(empty($text)) { return $text; }
		$stripped = ereg_replace("\r","",$text);
		$stripped = ereg_replace("\n","",$stripped);
		return $stripped;
	}
	
	function getEmailHeaders() {
 		@fputs($this->_connection,"STAT\r\n");
 		$statResponse = split(" ",@fgets($this->_connection,512));
		
		if($statResponse[0] != "+OK")
			return false;//"391";
			
		for($i = 0; $i < ($statResponse[1]); $i++) {
      		
			$actualNumber = $i+1;
			@fputs($this->_connection, "LIST $actualNumber\r\n");
			$listResponse = @fgets($this->_connection,512);

			$header = "";
			fputs($this->_connection,"TOP $actualNumber 0\r\n");
			
			while( ($rs = fgets($this->_connection,512) ) != ".\r\n")
				$header .= $rs;
				
			$this->messages[$i] = new Pop3Message($header);
		}
	}
	
	function getEmail($num) {
		$message = Array();
    	$actualNumber = $num+1;
		
		@fputs($this->_connection,"RETR $actualNumber\r\n");
		$retrResponse = @fgets($this->_connection,512);
		if (strstr($retrResponse,"+OK")) {
			while(($rs = @fgets($this->_connection,512))!="\r\n") {}
			while(($rs = @fgets($this->_connection,512))!=".\r\n")
				$message[] = trim($rs);
			
			$this->deleteEmail($actualNumber);
		} else {
			//Error
		}
		
		$this->messages[$num]->_parseEmail(null,$message);

		
	}
	
	function getEmails() {
		for ($i = 0; $i < $this->mailCount; $i++) {
			$this->getEmail($i);
		}
	}
	
	function deleteEmail($num) {
		@fputs($this->_connection,"DELE $num\r\n");
   		$del = split(" ", @fgets($this->_connection,512));
	}
}

?>