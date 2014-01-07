<?php

class Pop3Header {
	var $_fullHeader;
	var $_headerArray;
	
	function Pop3Header($header) {
		$this->_fullHeader = $header;
		$this->_parseHeader();
	}
	
	function _parseHeader() {
		$this->_headerArray = $this->__parseHeader(split("\r\n",$this->_fullHeader));
	}
	
	function getHeader($header) {
		if (array_key_exists($header, $this->_headerArray)) {
		    return $this->_headerArray[$header];
		}
		
		return "";
	}
	
	function __parseHeader($header) {
		$last_header = '';
		$parsed_header = Array();
		
		for($j = 0; $j < count($header); $j++) {
			$headerArray = split(":", $header[$j], 2);
			if (preg_match_all("/\s/", $headerArray[0], $matches) || !array_key_exists(1, $headerArray)) {
				if ($last_header) 
					$parsed_header[$last_header].="\r\n".trim($header[$j]);
			} else {
				$last_header = strtolower($headerArray[0]);
				if (array_key_exists($last_header, $parsed_header)) {
				    $parsed_header[$last_header] .= (isset($parsed_header[$last_header])?"\r\n":"").trim($headerArray[1]);
				} else {
					//$parsed_header[$last_header] = '';
					$parsed_header[$last_header] = "" . trim($headerArray[1]);

				}
				
			}
		}
		if (is_array($parsed_header))
			foreach($parsed_header as $hd_name => $hd_content) {
				$start_enc_tag = $stop_enc_tag = 0;
				$pre_text = $enc_text = $post_text = "";
				while(1) {
					if(strstr($hd_content,"=?") && strstr($hd_content,"?=") && substr_count($hd_content,"?")>3) {
						$start_enc_tag = strpos($hd_content, "=?");
						$pre_text = substr($hd_content, 0, $start_enc_tag);
						do {
							$stop_enc_tag = strpos($hd_content, "?=", $stop_enc_tag) + 2;
							$enc_text = substr($hd_content, $start_enc_tag, $stop_enc_tag);
						} while (!(substr_count($enc_text,"?") > 3));
							$enc_text = explode("?", $enc_text, 5);
							switch(strtoupper($enc_text[2])) {
								case "B":
									$dec_text = base64_decode($enc_text[3]);
									break;
								case "Q":
								
								default:
									$dec_text = quoted_printable_decode($enc_text[3]);
									$dec_text = str_replace("_", " ", $dec_text);
									break;
							}
							$post_text = substr($hd_content,$stop_enc_tag);
							if(substr(ltrim($post_text), 0, 2) == "=?")
								$post_text = ltrim($post_text);
							$hd_content = $pre_text.$dec_text.$post_text;
							$parsed_header[$hd_name] = $hd_content;
					} else break;
			}
		}
		return $parsed_header;
	}
}

?>