<?php

class Pop3Attachment {
	var $contentType;
	var $fileName;
	var $data;

	function Pop3Attachment($attachment) {
		foreach ($attachment as $atc) {
			$ctparts = split(";",$atc["content-type"]);
			if (count($ctparts) > 1) {
				$this->contentType = trim($ctparts[0]);
			}
			foreach ($ctparts as $ctpart) {
				if (strstr($ctpart,"name=")) {
					$filename = split("=",$ctpart);
					$this->fileName = str_replace("\"","",$filename[1]);
				}
			}
		}
		
		$this->data = trim($attachment['content']);
	}
}

  
?>