<?php

class Pop3Message {
	var $id;
	var $to;
	var $from;
	var $subject;
	var $date;
	var $cc;
	var $bcc;
	var $unixTimeStamp;
	var $header;
	
	//Boolean values
	var $isMultipart;
	var $hasHtml;
	var $hasAttachments;
	var $hasPlainText;
	
	//Collections
	var $attachments;
	
	//Content
	var $htmlText;
	var $plainText;
	
	
	function Pop3Message($header) {
		$this->header = new Pop3Header($header);
		
		$this->hasAttachments 	= 0;
		$this->from 			= $this->header->getHeader('from');
		$this->subject 			= $this->header->getHeader('subject');
		$this->to 				= $this->header->getHeader('to');
		$this->date 			= $this->header->getHeader('date');
		$this->bcc				= $this->header->getHeader('bcc');
		$this->cc				= $this->header->getHeader('cc');
		$this->unixTimeStamp	= strtotime($this->date);
	}
	
	function getTextMessage() {
		if ($this->hasPlainText) {
		    return $this->plainText;
		} else if ($this->hasHtml) {
			$string = str_replace("</p>","<br/><br/>", $this->htmlText);
			return strip_tags($string, '<br><br/>');
		}
	}
	
	function getHtmlMessage() {
		return ($this->hasHtml)?str_replace ("\n", " ", $this->htmlText):$this->plainText;
	}
	
	function _parseEmail($header,$message) {
		$header = ($header != null)?$header:$this->header->_headerArray;
		$content_transfer_encoding = (array_key_exists("content-transfer-encoding", $header))?
			strtolower(trim($header["content-transfer-encoding"])):"8bit";
		
		
		/*
		if ($content_transfer_encoding == "") {
			$content_transfer_encoding = "8bit";
		}*/

		$message = $this->_textDecode($content_transfer_encoding, $message);

		$content_type = split(";", $header["content-type"], 2);
		
		for($i = 0; $i < count($content_type); $i++)
			$content_type[$i] = trim($content_type[$i]);
			
		if ($content_type[0]=="")
			$content_type[0]="text/plain";
		
		if (stristr($content_type[0],"multipart/") || stristr($content_type[0],"message/")) {
			$content_type[0] = "multipart";
		}
			

		if (array_key_exists("content-disposition", $header) && !stristr($header["content-disposition"],"inline")) {
			if ($header) {
				$this->hasAttachments = true;
				$this->attachments[] = new Pop3Attachment(array("header" => $header, "content" => @implode("\n",$message)));
			}
		} else {
			switch(trim(strtolower($content_type[0]))) {
				case "text/plain":
					$message = nl2br(htmlentities(implode("\n",$message), ENT_QUOTES, "iso-8859-1"));
					$this->hasPlainText = true;
          if (trim($message))
						$this->plainText = $message;
					break;
				case "text/html":
					$this->htmlText = implode("\n", $message);
					$this->hasHtml = true;
					break;
				case "multipart":
					$content_type[1]=split(";",$content_type[1]);
					foreach ($content_type[1] as $ct_pars) {
						if (stristr($ct_pars, "boundary")) {
							$ct_pars = split("=",trim($ct_pars),2);
							if (strtolower($ct_pars[0]) == "boundary")
								$boundary = str_replace("\"", "", $ct_pars[1]);
						}
					}
					if($boundary) {
						$parts = $this->_splitMultipart($boundary, $message);
						foreach($parts as $part) 
							$this->_parsePart($part);
						} 
					else {
						//Can't read
					}
					break;
				default:
					if($header) {
						$this->hasAttachments = true;
						$this->attachments[] = new Pop3Attachment(array("header" => $header, "content" => @implode("\n",$message)));
					}
					break;
			}
		}
	}
	
	function _textDecode($encoding, $text) {

		switch($encoding) {
			case "quoted-printable":
				$dec_text = explode("\n",quoted_printable_decode(implode("\n",$text)));
        break;
			case "base64":
				for($i = 0; $i < count($text); $i++) 
					$text[$i] = trim($text[$i]);
				$dec_text = explode("\n",base64_decode(@implode("",$text)));
				break;
			case "7bit":
			case "8bit":
			case "binary":
			default:
				$dec_text = $text;
				break;
		}
		return $dec_text;
	}
	
	function _splitMultipart($boundary, $text) {
		$parts = array();
		$tmp = array();
		
		foreach($text as $line) {
			if (strstr($line,"--$boundary")) {
				$parts[]=$tmp;
				$tmp=array();
			} else $tmp[]=$line;
		}
		for($i=0;$i<count($parts);$i++) 
			$parts[$i] = explode("\n",trim(implode("\n",$parts[$i])));
		
		return $parts;
	}
	
	function _parsePart($text) {
		$headerpart = array();
		$contentpart = array();
		$noheader = 0;
		
		foreach($text as $riga) {
			if (!$riga) $noheader++;
			if ($noheader) $contentpart[] = $riga;
			else $headerpart[] = $riga;
		}
		if (count($contentpart)==0) {
			$contentpart = $headerpart;
			$headerpart = array();
		}
		
		$this->_parseEmail($this->header->__parseHeader($headerpart),explode("\n",trim(implode("\n",$contentpart))));
	}
}  

?>