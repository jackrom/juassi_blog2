<?php
/**
 * Akismet anti-comment spam service
 *
 * The class in this package allows use of the {@link http://akismet.com Akismet} anti-comment spam service in any PHP5 application.
 *
 * This service performs a number of checks on submitted data and returns whether or not the data is likely to be spam.
 *
 * Please note that in order to use this class, you must have a vaild {@link http://wordpress.com/api-keys/ WordPress API key}.  They are free for non/small-profit types and getting one will only take a couple of minutes.
 *
 * For commercial use, please {@link http://akismet.com/commercial/ visit the Akismet commercial licensing page}.
 *
 * Please be aware that this class is PHP5 only.  Attempts to run it under PHP4 will most likely fail.
 *
 * See the Akismet class documentation page linked to below for usage information.
 *
 * @package Akismet
 * @author Alex Potsides, {@link http://www.achingbrain.net http://www.achingbrain.net}, Bret Kuhns {@link http://www.l33thaxor.com}
 * @version 0.1
 * @copyright Alex Potsides, {@link http://www.achingbrain.net http://www.achingbrain.net}
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License
 */

/**
 *	The Akismet PHP4 Class
 *
 *  This class takes the functionality from the Akismet WordPress plugin written by {@link http://photomatt.net/ Matt Mullenweg} and allows it to be integrated into any PHP5 application or website.
 *
 *  The original plugin is {@link http://akismet.com/download/ available on the Akismet website}.
 *
 *  <b>Usage:</b>
 *  <code>
 *    $akismet = new Akismet('http://www.example.com/blog/', 'aoeu1aoue');
 *    $akismet->setCommentAuthor($name);
 *    $akismet->setCommentAuthorEmail($email);
 *    $akismet->setCommentAuthorURL($url);
 *    $akismet->setCommentContent($comment);
 *    $akismet->setPermalink('http://www.example.com/blog/alex/someurl/');
 *    if($akismet->isCommentSpam())
 *      // store the comment but mark it as spam (in case of a mis-diagnosis)
 *    else
 *      // store the comment normally
 *  </code>
 *
 *	@package	akismet
 *	@name		Akismet
 *	@version	0.3 Juassi (Modified by Juan Carlos Reyes for use in Juassi-Blog 2)
 *  	@author		Alex Potsides (converted to PHP4 by Bret Kuhns)
 *  	@link		http://www.achingbrain.net/
 */
class Akismet {
	var $version = '0.3';
	var $wordPressAPIKey;
	var $blogURL;
	var $comment;
	var $apiPort;
	var $akismetServer;
	var $akismetVersion;
	var $juassiVersion;
	var $verify_key;

	/**
	 *	@throws	Exception	An exception is thrown if your API key is invalid.
	 *	@param	string	Your WordPress API key.
	 *	@param	string	$blogURL			The URL of your blog.
	 */
	function Akismet($blogURL, $wordPressAPIKey, $juassi_version) {
		$this->blogURL = $blogURL;
		$this->wordPressAPIKey = $wordPressAPIKey;

		// Set some default values
		$this->apiPort = 80;
		$this->akismetServer = 'rest.akismet.com';
		$this->akismetVersion = '1.1';
		$this->juassiVersion = $juassi_version;

		// Start to populate the comment data
		$this->comment['blog'] = $blogURL;
		$this->comment['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
		$this->comment['referrer'] = $_SERVER['HTTP_REFERER'];

		// This is necessary if the server PHP5 is running on has been set up to run PHP4 and
		// PHP5 concurently and is actually running through a separate proxy al a these instructions:
		// http://www.schlitt.info/applications/blog/archives/83_How_to_run_PHP4_and_PHP_5_parallel.html
		// and http://wiki.coggeshall.org/37.html
		// Otherwise the user_ip appears as the IP address of the PHP4 server passing the requests to the
		// PHP5 one...
		$this->comment['user_ip'] = $_SERVER['REMOTE_ADDR'] != getenv('SERVER_ADDR') ? $_SERVER['REMOTE_ADDR'] : getenv('HTTP_X_FORWARDED_FOR');

		// Check to see if the key is valid
		$response = $this->http_post('key=' . $this->wordPressAPIKey . '&blog=' . $this->blogURL, $this->akismetServer, '/' . $this->akismetVersion . '/verify-key');

		if($response[1] != 'valid') {
			// Whoops, no it's not.  Throw an exception as we can't proceed without a valid API key.
			trigger_error('Akismet<br />Invalid API key.  Please obtain one from http://wordpress.com/api-keys/', E_USER_ERROR);
			$this->set_verify_key(false);
		}
		else {
			$this->set_verify_key(true);
		}

	}
	//Added for use in bluetrait
	function set_verify_key($value) {
		$this->verify_key = $value;
	}

	//Added for use in bluetrait
	function get_verify_key() {
		return $this->verify_key;
	}

	function http_post($request, $host, $path) {
		$http_request  = "POST " . $path . " HTTP/1.0\r\n";
		$http_request .= "Host: " . $host . "\r\n";
		$http_request .= "Content-Type: application/x-www-form-urlencoded; charset=utf-8\r\n";
		$http_request .= "Content-Length: " . strlen($request) . "\r\n";
		$http_request .= "User-Agent: Juassi/$this->juassiVersion | Akismet/1.11\r\n";
		$http_request .= "\r\n";
		$http_request .= $request;

		$socketWriteRead = new SocketWriteRead($host, $this->apiPort, $http_request);
		$socketWriteRead->send();

		return explode("\r\n\r\n", $socketWriteRead->getResponse(), 2);
	}

	// Formats the data for transmission	echo $sql;
	function getQueryString() {

		$this->comment['REMOTE_ADDR'] = $this->comment['user_ip'];

		$query_string = '';

		foreach($this->comment as $key => $data) {
			$query_string .= $key . '=' . urlencode(stripslashes($data)) . '&';
		}

		return $query_string;
	}

	/**
	 *	Tests for spam.
	 *
	 *	Uses the web service provided by {@link http://www.akismet.com Akismet} to see whether or not the submitted comment is spam.  Returns a boolean value.
	 *
	 *	@return		bool	True if the comment is spam, false if not
	 */
	function isCommentSpam() {
		$response = $this->http_post($this->getQueryString(), $this->wordPressAPIKey . '.rest.akismet.com', '/' . $this->akismetVersion . '/comment-check');

		return ($response[1] == 'true');
	}

	/**
	 *	Submit spam that is incorrectly tagged as ham.
	 *
	 *	Using this function will make you a good citizen as it helps Akismet to learn from its mistakes.  This will improve the service for everybody.
	 */
	function submitSpam() {
		$this->http_post($this->getQueryString(), $this->wordPressAPIKey . '.' . $this->akismetServer, '/' . $this->akismetVersion . '/submit-spam');
	}

	/**
	 *	Submit ham that is incorrectly tagged as spam.
	 *
	 *	Using this function will make you a good citizen as it helps Akismet to learn from its mistakes.  This will improve the service for everybody.
	 */
	function submitHam() {
		$this->http_post($this->getQueryString(), $this->wordPressAPIKey . '.' . $this->akismetServer, '/' . $this->akismetVersion . '/submit-ham');
	}

	/**
	 *	To override the user IP address when submitting spam/ham later on
	 *
	 *	@param string $userip	An IP address.  Optional.
	 */
	function setUserIP($userip) {
		$this->comment['user_ip'] = $userip;
	}

	/**
	 *	To override the referring page when submitting spam/ham later on
	 *
	 *	@param string $referrer	The referring page.  Optional.
	 */
	function setReferrer($referrer) {
		$this->comment['referrer'] = $referrer;
	}

	/**
	 *	A permanent URL referencing the blog post the comment was submitted to.
	 *
	 *	@param string $permalink	The URL.  Optional.
	 */
	function setPermalink($permalink) {
		$this->comment['permalink'] = $permalink;
	}

	/**
	 *	The type of comment being submitted.
	 *
	 *	May be blank, comment, trackback, pingback, or a made up value like "registration" or "wiki".
	 */
	function setCommentType($commentType) {
		$this->comment['comment_type'] = $commentType;
	}

	/**
	 *	The name that the author submitted with the comment.
	 */
	function setCommentAuthor($commentAuthor) {
		$this->comment['comment_author'] = $commentAuthor;
	}

	/**
	 *	The email address that the author submitted with the comment.
	 *
	 *	The address is assumed to be valid.
	 */
	function setCommentAuthorEmail($authorEmail) {
		$this->comment['comment_author_email'] = $authorEmail;
	}

	/**
	 *	The URL that the author submitted with the comment.
	 */
	function setCommentAuthorURL($authorURL) {
		$this->comment['comment_author_url'] = $authorURL;
	}

	/**
	 *	The comment's body text.
	 */
	function setCommentContent($commentBody) {
		$this->comment['comment_content'] = $commentBody;
	}

	/**
	 *	Defaults to 80
	 */
	function setAPIPort($apiPort) {
		$this->apiPort = $apiPort;
	}

	/**
	 *	Defaults to rest.akismet.com
	 */
	function setAkismetServer($akismetServer) {
		$this->akismetServer = $akismetServer;
	}

	/**
	 *	Defaults to '1.1'
	 */
	function setAkismetVersion($akismetVersion) {
		$this->akismetVersion = $akismetVersion;
	}
}

/**
 *	Utility class used by Akismet
 *
 *  This class is used by Akismet to do the actual sending and receiving of data.  It opens a connection to a remote host, sends some data and the reads the response and makes it available to the calling program.
 *
 *  The code that makes up this class originates in the Akismet WordPress plugin, which is {@link http://akismet.com/download/ available on the Akismet website}.
 *
 *	N.B. It is not necessary to call this class directly to use the Akismet class.  This is included here mainly out of a sense of completeness.
 *
 *	@package	akismet
 *	@name		SocketWriteRead
 *	@version	0.1
 *  @author		Alex Potsides
 *  @link		http://www.achingbrain.net/
 */
class SocketWriteRead {
	var $host;
	var $port;
	var $request;
	var $response;
	var $responseLength;
	var $errorNumber;
	var $errorString;

	/**
	 *	@param	string	$host			The host to send/receive data.
	 *	@param	int		$port			The port on the remote host.
	 *	@param	string	$request		The data to send.
	 *	@param	int		$responseLength	The amount of data to read.  Defaults to 1160 bytes.
	 */
	function SocketWriteRead($host, $port, $request, $responseLength = 1160) {
		$this->host = $host;
		$this->port = $port;
		$this->request = $request;
		$this->responseLength = $responseLength;
		$this->errorNumber = 0;
		$this->errorString = '';
	}

	/**
	 *  Sends the data to the remote host.
	 *
	 * @throws	An exception is thrown if a connection cannot be made to the remote host.
	 */
	function send() {
		$this->response = '';

		$fs = fsockopen($this->host, $this->port, $this->errorNumber, $this->errorString, 10);

		if($this->errorNumber != 0) {
			trigger_error('Akismet<br />Error connecting to host: ' . $this->host . '<br />Error number: ' . $this->errorNumber . '<br />Error message: ' . $this->errorString, E_USER_ERROR);
		}

		if($fs !== false) {
			@fwrite($fs, $this->request);

			while(!feof($fs)) {
				$this->response .= fgets($fs, $this->responseLength);
			}
			fclose($fs);
		}
	}

	/**
	 *  Returns the server response text
	 *
	 *  @return	string
	 */
	function getResponse() {
		return $this->response;
	}

	/**
	 *	Returns the error number
	 *
	 *	If there was no error, 0 will be returned.
	 *
	 *	@return int
	 */
	function getErrorNumner() {
		return $this->errorNumber;
	}

	/**
	 *	Returns the error string
	 *
	 *	If there was no error, an empty string will be returned.
	 *
	 *	@return string
	 */
	function getErrorString() {
		return $this->errorString;
	}
}
?>