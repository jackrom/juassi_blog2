<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) exit('No direct access allowed.');

class User {
	
	protected static $table_name="users";
	protected static $levels_table_name="user_levels";
	protected static $invites_table_name="invites";
	protected static $db_fields = array('id', 'user_id', 'first_name', 'last_name', 'gender', 'username', 'password', 'email', 'user_level', 'level_expiry', 'expiry_datetime', 'activated', 'suspended', 'date_created', 'last_login', 'account_lock', 'signup_ip', 'last_ip', 'country', 'whitelist', 'ip_whitelist', 'tokens', 'bank_tokens');
	
	public $id;
	public $user_id;
	public $username;
	public $password;
	public $email;
	public $user_level;
	public $activated;
	public $suspended;
	public $first_name;
	public $last_name;
	public $gender;
	public $date_created;
	public $last_login;
	public $account_lock;
	public $signup_ip;
	public $last_ip;
	public $country;
	public $whitelist;
	public $ip_whitelist;
	public $tokens;
	public $bank_tokens;
	public $level_expiry;
	public $expiry_datetime;
	
  	public function full_name() {
	    if(isset($this->first_name) && isset($this->last_name)) {
	      return $this->first_name . " " . $this->last_name;
	    } else {
	      return "";
	    }
  	}

	public static function authenticate($username="", $password="") {
		global $database;
		$username = $database->escape_value($username);
		$password = $database->escape_value(md5($password));
	
		$sql  = "SELECT * FROM ".self::$table_name." WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";
		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function check_user($table, $entry) {
	    global $database;
		$table = $database->escape_value($table);
	    $entry = $database->escape_value($entry);

	    $sql  = "SELECT * FROM ".self::$table_name." WHERE {$table} = '{$entry}' LIMIT 1";
	    $result_array = self::find_by_sql($sql);
		return !empty($result_array) ? true : false;
	}
	
	public static function check_activation($username) {
		global $database;
		$username = $database->escape_value($username);
	
		// $sql  = "SELECT '{$username}' FROM users WHERE {$table} = {$entry} LIMIT 1";
		$sql = "SELECT * FROM ".self::$table_name." WHERE username = '{$username}' AND activated = '1' LIMIT 1";
		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? true : false;
	}
	
	public static function check_if_suspended($username) {
		global $database;
		$username = $database->escape_value($username);
	
		// $sql  = "SELECT '{$username}' FROM users WHERE {$table} = {$entry} LIMIT 1";
		$sql = "SELECT * FROM ".self::$table_name." WHERE username = '{$username}' AND suspended = '1' LIMIT 1";
		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? true : false;
	}
	
	public static function check_current_password($username, $password) {
		global $database;
		$username = $database->escape_value($username);
		$password = $database->escape_value($password);
	
		// $sql = "SELECT * FROM users WHERE username = '{$username}' AND password = {$password}";
		$sql = "SELECT * FROM  ".self::$table_name." WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";
		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? true : false;
	}
	
	public static function check_whitelist($username) {
		global $database;
		$username = $database->escape_value($username);
	
		// $sql  = "SELECT '{$username}' FROM users WHERE {$table} = {$entry} LIMIT 1";
		$sql = "SELECT * FROM ".self::$table_name." WHERE username = '{$username}' AND whitelist = '1' LIMIT 1";
		
		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? true : false;
	}
	
	public static function check_login($username, $password, $current_ip) {
		// Instanciamos la clase session
		$session = new Session();
		
	    // Chequeamos la base de datos para saber si existe el usuario/contraseña.
		$found_user = self::authenticate($username, $password);

		// Vemos si la cuenta del usuario ha sido activada
	    $activated = self::check_activation($username);
		// Vemos si la cuenta del usuario ha sido suspendida
	    $suspended = self::check_if_suspended($username);
	
		// Vemos si la cuenta del usuario tiene permitido la ip whitelist
		$whitelist = self::check_whitelist($username);

	  if ($found_user) {
	   	 if($activated){
		   	if(!$suspended){
				if($whitelist) {
					global $database;
					$sql = "SELECT ip_whitelist FROM users WHERE username = '{$username}'";
					$result = $database->query($sql);
					$array = $database->fetch_array($result);
					$exp = $array['ip_whitelist'];
					// print_r($exp);
					$whitelist = explode(",", $exp);
					// print_r($whitelist);
					if (in_array($current_ip, $whitelist)) {
						// echo "success";
						$session->login($found_user);
						$sql = "UPDATE ".self::$table_name." SET last_ip = '{$current_ip}' WHERE username = '{$username}' ";
						$database->query($sql);
						redirect_to("dashboard.php");
					} else {
						// echo "failure";
						$session->message("<div class='form-group'><div class='col-sm-6'><div class='notification-box error-notification-box'><p>Lo sentimos, pero actualmente esta cuenta tiene habilitada la protecci&oacute;n IP y tu actual direcci&oacute;n IP (<strong>{$current_ip}</strong>) no esta en la  whitelist para esta cuenta. Si siente que esto es un error, por favor contacta con el departamento de soporte.</p><a href='#' class='notification-close error-notification-close'>x</a></div></div></div><!--.notification-box .notification-box-error end-->");
						redirect_to("admin/index.php");
					}
				} else {
					$session->login($found_user);
					global $database;
					$sql = "UPDATE ".self::$table_name." SET last_ip = '{$current_ip}' WHERE username = '{$username}' ";
					$database->query($sql);
			        redirect_to("dashboard.php");
				}
			 } else {
				$session->message("<div class='form-group'><div class='col-sm-6'><div class='notification-box error-notification-box'><p>Tu cuenta ha sido suspendida, por favor contacta con el departamento de soporte.</p><a href='#' class='notification-close error-notification-close'>x</a></div></div></div><!--.notification-box .notification-box-error end-->");
				redirect_to("admin/index.php");
			 }
		 } else {
			$session->message("<div class='form-group'><div class='col-sm-6'><div class='notification-box warning-notification-box'><p>Tu cuenta no ha sido activada a&uacute;n, por favor chequea tu email. Para reenvio del c&oacute;digo <a href='activate.php'>click aqu&iacute;.</a></p><a href='#' class='notification-close warning-notification-close'>x</a></div></div></div><!--.notification-box .notification-box-warning end-->");
			redirect_to("admin/index.php");
		 }
	  } else {
	    // username/password combo was not found in the database
	    $session->message("<div class='form-group'><div class='col-sm-6'><div class='notification-box warning-notification-box'><p>Combinaci&oacute;n de Usuario/Contrase&ntilde;a incorrectos.</p><a href='#' class='notification-close warning-notification-close'>x</a></div></div></div><!--.notification-box .notification-box-warning end-->");
		redirect_to("admin/index.php");
	  }
    }
	
	public function create_account($username, $password, $email, $first_name, $last_name, $plain_password, $signup_ip, $country, $gender, $invite_code){
		global $database;
		$session = new Session();
		// Genetate the users ID.
		$user_id = generate_id();
		
		$sql = "SELECT * FROM ".self::$levels_table_name." WHERE auto = '1'";
		$query = $database->query($sql);
		$row = $database->fetch_array($query);
		$user_level = $row['level_id'];
		
		$flag = false;
		//until flag is false
		while ($flag == false){
			//check if the user id exists
			$sql = "SELECT * FROM ".self::$table_name." WHERE user_id = '{$user_id}'";
			$query = $database->query($sql);
			$rows = $database->num_rows($query);
			//if it does try again till you find an id that does not exist
			if ($rows){
				$user_id = generate_id();
			}else{
				//if it does not exist, exit the loop
				$flag = true;
			}
		}
		if ($flag == true){
			//insert into db the data
			$datetime = strftime("%Y-%m-%d %H:%M:%S", time());
			if(VERIFY_EMAIL == "NO"){$activated = 1;} else if(VERIFY_EMAIL == "YES"){$activated = 0;}
			// $sql = "INSERT INTO ".self::$table_name." VALUES ('', '$user_id', '$first_name', '$last_name', '$gender', '$username', '$password', '$email', '$user_level', '$activated', '0', '$datetime', '', '0', '$signup_ip', '', '$country', '0', '', '')";
			$sql = "INSERT INTO ".self::$table_name." VALUES ('', '$user_id', '$first_name', '$last_name', '$gender', '$username', '$password', '$email', '$user_level', '0', '', '$activated', '0', '$datetime', '', '0', '$signup_ip', '', '$country', '0', '', '', '')";
			$database->query($sql);
			
			if (ALLOW_REGISTRATIONS == "NO") {
				$sql = "DELETE FROM ".self::$invites_table_name." WHERE code = '{$invite_code}' ";
				$database->query($sql);
			}
						
			// Send and email to the user.
			if(VERIFY_EMAIL == "NO") {
				// Initialize functions.
				$email_class = new Email();

				// Email sent to the user if logged in.
				$from = SITE_EMAIL;
				$subject = "Bienvenidos a la web de ".SITE_NAME." ";
				
				$message = $email_class->email_template('registration_success', "$plain_password", "$username", "", "");
				$email_class->send_email($email, $from, $subject, $message);
			} else if(VERIFY_EMAIL == "YES") {
				//$activation_hash = Activation::set_activation_link($email)
				Activation::set_activation_link($plain_password, $username, $email);
			}
			
			// Create the message that will be displayed on the login screen once the user has been redirected.
			$session->message("<div class='form-group'><div class='col-sm-6'><div class='notification-box success-notification-box'><p>Tu cuenta ha sido creada satisfactoriamente. Por favor chequea en tu email el link de activaci&oacute;n de tu cuenta.</p><a href='#' class='notification-close success-notification-close'>x</a></div></div></div><!--.notification-box .notification-box-success end-->");
			
			// redirect the user to the login page.
			redirect_to('admin/index.php');
		}
	}
	
	public function update_account($value, $first_name, $last_name, $password, $email, $plain_password, $country, $gender, $whitelist, $ip_whitelist){
			global $database;
			// Initialize functions.
			$email_class = new Email();
			$session = new Session();

			// Email sent to the user if logged in.
			$from = SITE_EMAIL;
			$subject = "Configuraci&oacute;n de cuenta cambiada";
			
			if(($whitelist == 1) && (empty($ip_whitelist))){
				$whitelist = 0;
			}
			
			if ($value == 1) {
				$sql = "UPDATE ".self::$table_name." SET password = '{$password}', email = '{$email}', first_name = '{$first_name}', last_name = '{$last_name}', gender = '{$gender}', country = '{$country}', whitelist = '{$whitelist}', ip_whitelist = '{$ip_whitelist}' WHERE user_id = '{$this->user_id}'";
				
				// HTML Message Content.
				$message = $email_class->email_template('update_all_account_settings', $plain_password, "");
				
			} else if ($value == 2) {
				$sql = "UPDATE ".self::$table_name." SET email = '{$email}', first_name = '{$first_name}', last_name = '{$last_name}', gender = '{$gender}', country = '{$country}', whitelist = '{$whitelist}', ip_whitelist = '{$ip_whitelist}' WHERE user_id = '{$this->user_id}' ";
				
				// HTML Message Content.
				$message = $email_class->email_template('update_account_settings', "", "");
				
			} 
			$database->query($sql);
			// $session = new Session();
			$session->message("<div class='form-group'><div class='col-sm-6'><div class='notification-box success-notification-box'><p>Configuraci&oacute;n actualizada satisfactoriamente.</p><a href='#' class='notification-close success-notification-close'>x</a></div></div></div><!--.notification-box .notification-box-success end-->");
			
			// Finally send the email to the user.
			$email_class->send_email($email, $from, $subject, $message);
			
			redirect_to('admin/account_settings.php');
	}

	public static function downgrade_user($user_id, $location){
		global $database;
		
		$sql = "SELECT level_id, level_name FROM user_levels WHERE auto = '1' LIMIT 1";
		$result = $database->query($sql);
		$group = $database->fetch_array($result);
		
		$new_level = $group['level_id'];
		
		$sql = "UPDATE users SET user_level = '{$new_level}', level_expiry = '0', expiry_datetime = '0000-00-00 00:00:00' WHERE user_id = '{$user_id}' ";
		$database->query($sql);

		redirect_to($location);
	}
	
	// Tokens
	
	public static function add_tokens($user_id, $current_tokens, $token_package, $location = NULL){
		global $database;
		$session = new Session();
		
		$new_tokens = $current_tokens + $token_package;
		
		$sql = "UPDATE ".self::$table_name." SET tokens = '{$new_tokens}' WHERE user_id = '{$user_id}' ";
		$database->query($sql);
		
		// add token history			
		$datetime = date('Y-m-d H:i:s');
		$sql = "INSERT INTO token_history VALUES('','$user_id','$token_package','Purchased Tokens','$datetime','c')";
		$database->query($sql);
		
		$session->message("<div class='form-group'><div class='col-sm-6'><div class='notification-box success-notification-box'><p>{$token_package} tokens ha sido satisfactoriamente aplicado a tu cuenta.</p><a href='#' class='notification-close success-notification-close'>x</a></div></div></div><!--.notification-box .notification-box-success end-->");
		redirect_to($location);
		
	}
	
	public static function buy_package($user_id, $current_tokens, $token_package, $package_name, $package_desc, $level_expiry, $expiry_datetime, $location){
		global $database;
		$session = new Session();
		
		if($current_tokens < $token_package) {
			$session->message("<div class='form-group'><div class='col-sm-6'><div class='notification-box error-notification-box'><p>Lo sentimos, no tienes suficientes creditos activos para este paquete.</p><a href='#' class='notification-close error-notification-close'>x</a></div></div></div><!--.notification-box .notification-box-error end-->");
			// redirect_to($location);
			redirect_to('admin/spend_tokens.php');
		} else {
			$new_tokens = $current_tokens - $token_package;
			
			$sql = "UPDATE ".self::$table_name." SET tokens = '{$new_tokens}' WHERE user_id = '{$user_id}' ";
			$database->query($sql);
			
			// add token history			
			$datetime = date('Y-m-d H:i:s');
			$sql = "INSERT INTO token_history VALUES('','$user_id','$token_package','$package_desc','$datetime','d')";
			$database->query($sql);
					
			if($package_name == "vip1w"){
				if($level_expiry == '1'){
					$new_date = strtotime('+1 week', strtotime($expiry_datetime));
					$datetime = date( 'Y-m-d H:i:s', $new_date );
				} else {
					$datetime = date('Y-m-d H:i:s', strtotime("+1 week"));
				}		
				$sql = "UPDATE users SET user_level = '748969', level_expiry = '1', expiry_datetime = '{$datetime}' WHERE user_id = '{$user_id}'";
			} else if($package_name == "vip3w"){
				if($level_expiry == '1'){
					$new_date = strtotime('+3 weeks', strtotime($expiry_datetime));
					$datetime = date( 'Y-m-d H:i:s', $new_date );
				} else {
					$datetime = date('Y-m-d H:i:s', strtotime("+1 week"));
				}		
				$sql = "UPDATE users SET user_level = '748969', level_expiry = '1', expiry_datetime = '{$datetime}' WHERE user_id = '{$user_id}'";
			} else if($package_name == "vip5w"){
				if($level_expiry == '1'){
					$new_date = strtotime('+5 weeks', strtotime($expiry_datetime));
					$datetime = date( 'Y-m-d H:i:s', $new_date );
				} else {
					$datetime = date('Y-m-d H:i:s', strtotime("+1 week"));
				}			
				$sql = "UPDATE users SET user_level = '748969', level_expiry = '1', expiry_datetime = '{$datetime}' WHERE user_id = '{$user_id}'";
			}
			
			$database->query($sql);

			$session->message("<div class='form-group'><div class='col-sm-6'><div class='notification-box success-notification-box'><p>El paquete {$package_name} ha sido satisfactoriamente aplicado a tu cuenta y vencer&aacute; el  ".datetime_to_text($datetime).".</p><a href='#' class='notification-close success-notification-close'>x</a></div></div></div><!--.notification-box .notification-box-success end-->");
			redirect_to($location);
		}
		
	}
	
	public static function bank_tokens($user_id, $current_tokens, $bank_tokens, $tokens, $bw, $location){
		global $database;
		$session = new Session();		
		
		// $tokens = preg_replace("/[^0-9]/", '', $tokens);
				
		if($bw == "bank"){
			$active_tokens = $current_tokens - $tokens;
			$banked_tokens = $bank_tokens + $tokens;
			$msg = "deposited";
		} else if($bw == "withdraw"){
			$banked_tokens = $bank_tokens - $tokens;
			$active_tokens = $current_tokens + $tokens;
			$msg = "withdrawn";
		}
		
		$sql = "UPDATE ".self::$table_name." SET tokens = '{$active_tokens}', bank_tokens = '{$banked_tokens}' WHERE user_id = '{$user_id}' ";
		$database->query($sql);
		
		$session->message("<div class='form-group'><div class='col-sm-6'><div class='notification-box success-notification-box'><p>".number_format($tokens, 0, '.', ',')." tokens han sido satisfactoria {$msg}.</p><a href='#' class='notification-close success-notification-close'>x</a></div></div></div><!--.notification-box .notification-box-success end-->");
		redirect_to($location);
	}
	
	// Common Database Methods
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table_name);
  	}
  
  	public static function find_by_id($id=0) {
    	$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE user_id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
    }
  	
	public static function find_by_username($username) {
    	$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE username = '{$username}' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
    }

  	public static function find_by_sql($sql="") {
		global $database;
		$result_set = $database->query($sql);
		$object_array = array();
		while ($row = $database->fetch_array($result_set)) {
		  $object_array[] = self::instantiate($row);
		}
		return $object_array;
    }

	public static function count_all() {
	  	global $database;
	  	$sql = "SELECT COUNT(*) FROM ".self::$table_name;
    	$result_set = $database->query($sql);
	  	$row = $database->fetch_array($result_set);
    	return array_shift($row);
	}

	private static function instantiate($record) {
		// Could check that $record exists and is an array
    	$object = new self;
		
		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  $attributes = array();
	  foreach(self::$db_fields as $field) {
	    if(property_exists($this, $field)) {
	      $attributes[$field] = $this->$field;
	    }
	  }
	  return $attributes;
	}
	
	protected function sanitized_attributes() {
	  global $database;
	  $clean_attributes = array();
	  // sanitize the values before submitting
	  // Note: does not alter the actual value of each attribute
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $database->escape_value($value);
	  }
	  return $clean_attributes;
	}

}

?>