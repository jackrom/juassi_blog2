<?php
/*
	Juassi 2.0 Session Support
	Juan Carlos Reyes C Copyright 2012
*/

class juassi_sessions {

	private $db;
	private $tb;
	private $life_time;

	//setup the session
	public function juassi_sessions($database, $table_name) {

		$this->db = &$database;
		$this->tb = $table_name;
		$this->life_time = ini_get('session.gc_maxlifetime');


		if (defined('JUASSI_RUNNING_SOAP') && (JUASSI_RUNNING_SOAP == TRUE) && juassi_get_config('soap_server')) {
			session_name('soap_sid');
			ini_set('session.use_only_cookies', 0);
		}
		else {
			session_name(juassi_get_config('cookie_name') . '_sid');
			ini_set('session.use_only_cookies', 1);
		}
		if (juassi_get_config('https')) {
			session_set_cookie_params(0, juassi_get_config('script_path') . '/', '', 1);
		}
		else {
			session_set_cookie_params(0, juassi_get_config('script_path') . '/');
		}

		session_set_save_handler(
			array(&$this, 'open'),
			array(&$this, 'close'),
			array(&$this, 'read'),
			array(&$this, 'write'),
			array(&$this, 'destroy'),
			array(&$this, 'gc')
		);

		session_start();
		return true;
	}

	public function open($save_path, $id) {
		return true;
	}
	public function close() {
		return true;
	}

	//reading the array from the session
	public function read($session_id) {

		$query = "SELECT session_data FROM $this->tb WHERE session_id = ? LIMIT 1";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $session_id);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

		if ($array = $stmt->fetch(PDO::FETCH_ASSOC)) {
			return $array['session_data'];
		}
		else {
			//$this->create();
			return '';
		}
	}

	//writes an array to the session
	public function write($session_id, $data) {

		$query = "REPLACE INTO $this->tb
		(session_id, session_start, session_start_utc, session_expire, session_expire_utc, session_data)
		VALUES
		(:session_id, :session_start, :session_start_utc, :session_expire, :session_expire_utc, :session_data)
		";
		$datetime = juassi_datetime();
		$datetime_utc = juassi_datetime_utc();
		$expire = juassi_datetime($this->life_time);
		$expire_utc = juassi_datetime_utc($this->life_time);
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':session_data', $data);
		$stmt->bindParam(':session_start', $datetime);
		$stmt->bindParam(':session_start_utc', $datetime_utc);
		$stmt->bindParam(':session_expire', $expire);
		$stmt->bindParam(':session_expire_utc', $expire_utc);
		$stmt->bindParam(':session_id', $session_id);
		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
		return true;
	}

	//destroys a session id
	public function destroy($session_id) {

		$query = "DELETE FROM $this->tb WHERE session_id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $session_id);

		try {
			$stmt->execute();
			return true;
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

	}
	//garbage collection
	public function gc() {

		$now = juassi_datetime();

		$query = "DELETE FROM $this->tb WHERE session_expire <= ?";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $now);

		try {
			$stmt->execute();
			return true;
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
	}

	//regenerate session id in database and deletes old session
	public function regenerate_id() {

		$old_id = session_id();
		session_regenerate_id();
		$new_id = session_id();

		$query = "UPDATE $this->tb SET session_id = ? WHERE session_id = ?";

		$stmt = $this->db->prepare($query);
		$stmt->bindParam(1, $new_id);
		$stmt->bindParam(2, $old_id);

		try {
			$stmt->execute();
			return true;
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

	}

	//create session in database here
	private function create() {

		$query = "INSERT INTO $this->tb
		(session_id, session_start, session_start_utc, session_expire, session_expire_utc)
		VALUES
		(:session_id, :session_start, :session_start_utc, :session_expire, :session_expire_utc)
		";

		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':session_id', session_id());
		$stmt->bindParam(':session_start', juassi_datetime());
		$stmt->bindParam(':session_start_utc', juassi_datetime_utc());
		$stmt->bindParam(':session_expire', juassi_datetime($this->life_time));
		$stmt->bindParam(':session_expire_utc', juassi_datetime_utc($this->life_time));

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

		return true;
	}
}

?>