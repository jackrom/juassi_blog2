<?php
/********* PayPal with IPN in PHP **********/
class paypal {
	
var $error; // holds the error encountered
var $ipn_log; // log IPN results
var $ipn_log_file; // filename of the IPN log
var $ipn_response; // holds the IPN response from PayPal
var $ipn_data = array(); // contains the POST values for IPN
var $fields = array(); // holds the fields to submit to PayPal

function paypal() {
	// constructor.
	$this->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
	$this->error = '';
	$this->ipn_log_file = '.ipn_results.log';
	$this->ipn_log = true;
	$this->ipn_response = '';
	$this->add_field('rm','2'); // Return method = POST
	$this->add_field('cmd','_xclick');
}

function add_field($field, $value) {
	// adds a key=>value pair to the fields array
	$this->fields["$field"] = $value;
}

function submit_paypal_post() {
	// generates an HTML page consisting of
	// a form with hidden elements which is submitted to PayPal
	echo "<html>\n";
	echo "<head><title>Processing...</title></head>\n";
	echo "<body onLoad=\"document.forms['paypal_form'].submit();\">\n";
	echo "<center><h2>Please wait, your order is being processed and you";
	echo " will be redirected to the paypal website.....</h2></center>\n";
	echo "<form method=\"post\" name=\"paypal_form\" ";
	echo "action=\"".$this->paypal_url."\">\n";
	foreach ($this->fields as $name => $value) {
		echo "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
	}
	echo "<center><br/><br/>If you are not automatically redirected to ";
	echo "paypal within 5 seconds...<br/><br/>\n";
	echo "<input type=\"submit\" value=\"Click Here\"></center>\n";
	echo "</form>\n";
	echo "</body></html>\n";
}

function validate_ipn() {
	// parse the paypal URL
	$url_parsed=parse_url($this->paypal_url);
	// generate the post string from the _POST vars
	$post_string = '';
	foreach ($_POST as $field=>$value) {
		$this->ipn_data["$field"] = $value;
		$post_string .= $field.'='.urlencode (stripslashes ($value)).'&';
	}
	$post_string .="cmd=_notify-validate";
	// open the connection to paypal
	$fp = fsockopen($url_parsed[host],"80",$err_num,$err_str,30);
	if(!$fp) {
		// Print the error if not able to open the connection.
		$this->error = "Error no. $errnum: $errstr";
		$this->log_ipn_results(false);
	return false;
	} else {
		// Post data back to paypal
		fputs($fp, "POST $url_parsed[path] HTTP/1.1\r\n");
		fputs($fp, "Host: $url_parsed[host]\r\n");
		fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
		fputs($fp, "Content-length: ".strlen($post_string)."\r\n");
		fputs($fp, "Connection: close\r\n\r\n");
		fputs($fp, $post_string . "\r\n\r\n");
		// loop through the response from the server and append to variable
		while(!feof($fp)) {
		$this->ipn_response .= fgets($fp, 1024);
	}
		fclose($fp); // close connection
	}
	
	// Valid IPN.
	$this->log_ipn_results(true);
	return true;

}

function log_ipn_results($success) {
	if (!$this->ipn_log) return;
	// Timestamp
	$text = '['.date('m/d/Y g:i A').'] - ';
	// Success or failure
	if ($success) $text .= "SUCCESS!\n";
	else $text .= 'FAIL: '.$this->error."\n";
	// Log the POST variables
	$text .= "IPN POST Values from Paypal:\n";
	foreach ($this->ipn_data as $key=>$value) {
	$text .= "$key=$value, ";
	}
	// response from the paypal server
	$text .= "\nIPN Response from Paypal Server:\n ".$this->ipn_response;
	// Write to log
	$fp=fopen($this->ipn_log_file,'a');
	fwrite($fp, $text . "\n\n");
	fclose($fp); // close file
	}
}
?>