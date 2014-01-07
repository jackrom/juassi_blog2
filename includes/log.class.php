<?php
	class juassi_log {

		private $event_table = '';

		function __construct() {

		}

		//add an event to the event log
		function add($event_array) {
			global $juassi_db, $juassi_tb;

			if (juassi_get_config('database_version') < 27) return false;

			//print_r($event_array);

			if (JUASSI_DEBUG) {
				echo '<br />' . juassi_htmlentities($event_array['event_number']) . ': ' . juassi_htmlentities($event_array['event_description']) .  ' in <b>' . juassi_htmlentities($event_array['event_file']) . '</b> on line <b>' . juassi_htmlentities($event_array['event_file_line']) . '</b>';
			}

			$query = "
				INSERT INTO `$juassi_tb->events`
				(user_id, event_date, event_date_utc, event_file, event_file_line,
				event_type, event_number, event_source, event_severity, event_ip_address, event_description";

			if (isset($event_array['event_trace'])) {
				$query .= ', event_trace';
			}
			else if (isset($event_array['log_backtrace']) && ($event_array['log_backtrace'] == true)) {
				/*
				Get the backtrace here
				*/
				ob_start();
				debug_print_backtrace();
				$event_trace = ob_get_contents();
				ob_end_clean();
				$query .= ', event_trace';
			}
			if (isset($event_array['server_id'])) {
				$query .= ', server_id';
			}
			if (isset($event_array['event_id'])) {
				$query .= ', remote_id';
			}

			$query .= ") VALUES (:user_id, :event_date, :event_date_utc, :event_file, :event_file_line, :event_type, :event_number, :event_source, :event_severity, :event_ip_address, :event_description";

			if ((isset($event_array['log_backtrace']) && ($event_array['log_backtrace'] == true)) || isset($event_array['event_trace'])) {
				$query .= ', :event_trace';
			}
			if (isset($event_array['server_id'])) {
				$query .= ', :server_id';
			}
			if (isset($event_array['event_id'])) {
				$query .= ', :remote_id';
			}

			$query .= ");";

			try {
				$stmt = $juassi_db->prepare($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			if (isset($event_array['user_id'])) {
				$stmt->bindParam(':user_id', $event_array['user_id']);
			}
			else {
				$user_id = (int) juassi_get_user_data('user_id');
				$stmt->bindParam(':user_id', $user_id);
			}

			if (isset($event_array['event_date'])) {
				$stmt->bindParam(':event_date', $event_array['event_date']);
			}
			else {
				$date 		= juassi_datetime();
				$stmt->bindParam(':event_date', $date);
			}

			if (isset($event_array['event_date_utc'])) {
				$stmt->bindParam(':event_date_utc', $event_array['event_date_utc']);
			}
			else {
				$date_utc	= juassi_datetime_utc();
				$stmt->bindParam(':event_date_utc', $date_utc);
			}
			$stmt->bindParam(':event_file', $event_array['event_file']);
			$stmt->bindParam(':event_file_line', $event_array['event_file_line']);
			$stmt->bindParam(':event_type', $event_array['event_type']);
			$stmt->bindParam(':event_number', $event_array['event_number']);
			$stmt->bindParam(':event_source', $event_array['event_source']);
			$stmt->bindParam(':event_severity', $event_array['event_severity']);
			if (isset($event_array['event_ip_address'])) {
				$stmt->bindParam(':event_ip_address', $event_array['event_ip_address']);
			}
			else {
				$ip_address	= juassi_ip_address();
				$stmt->bindParam(':event_ip_address', $ip_address);
			}
			$stmt->bindParam(':event_description', $event_array['event_description']);
			if (isset($event_array['event_trace'])) {
				$stmt->bindParam(':event_trace', $event_array['event_trace']);
			}
			else if (isset($event_array['log_backtrace']) && ($event_array['log_backtrace'] == true)) {
				$stmt->bindParam(':event_trace', $event_trace);
			}
			if (isset($event_array['server_id'])) {
				$stmt->bindParam(':server_id', $event_array['server_id']);
			}
			if (isset($event_array['event_id'])) {
				$stmt->bindParam(':remote_id', $event_array['event_id']);
			}

			try {
				$stmt->execute();
				$event_id = $juassi_db->lastInsertId();
			}
			catch (Exception $e) {
				/*
				$fp=fopen("test.txt","w+");
				fwrite($fp, $query);
				fclose($fp);
				*/
				juassi_die($e->getMessage());
			}

			return $event_id;

		}

		//clear events
		function clear($server_id = NULL) {
			global $juassi_db, $juassi_tb;

			$query = "DELETE FROM `$juassi_tb->events`";

			if (isset($server_id) && !empty($server_id)) {
				$query .= " WHERE server_id = :server_id";
			}
			else {
				$query .= " WHERE server_id IS NULL";
			}

			$stmt = $juassi_db->prepare($query);

			if (isset($server_id) && !empty($server_id)) {
				$stmt->bindParam(':server_id', $server_id);
			}

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			return true;

		}

		//delete a single event
		function delete($event_id) {
			global $juassi_db, $juassi_tb;

			$query = "DELETE FROM `$juassi_tb->events` WHERE event_id = :event_id";

			$stmt = $juassi_db->prepare($query);

			$stmt->bindParam(':event_id', $event_id);

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			return true;
		}

		//mark events that were synced
		function set_synced($events) {
			global $juassi_db, $juassi_tb;

			foreach ($events as $event) {
				$query = "UPDATE $juassi_tb->events SET event_synced = 1 WHERE event_id = :event_id";
				$stmt = $juassi_db->prepare($query);
				$stmt->bindParam(':event_id', $event['event_id']);

				try {
					$stmt->execute();
				}
				catch (Exception $e) {
					juassi_die($e->getMessage());
				}
			}
			return true;
		}

		function get($event_array) {
			global $juassi_db, $juassi_tb;

			if (isset($event_array['not_synced']) && ($event_array['not_synced'] == true)) {
				$query = "
				SELECT
				event_id, event_number, user_id, event_date, event_date_utc, event_type, event_severity,
				event_source, event_file, event_file_line, event_ip_address, event_description,
				event_trace
				FROM `$juassi_tb->events` WHERE 1 = 1 AND event_synced = 0";
			}
			else {
				$query = "SELECT * FROM `$juassi_tb->events` WHERE 1 = 1";
			}
			if (isset($event_array['server_id']) && !empty($event_array['server_id'])) {
				$query .= " AND server_id = :server_id";
			}
			else {
				$query .= " AND server_id IS NULL";
			}
			if (isset($event_array['event_severity']) && !empty($event_array['event_severity'])) {
				$query .= " AND event_severity = :event_severity";
			}
			if (isset($event_array['order']) && !empty($event_array['order'])) {
				$query .= " ORDER BY :order DESC";
			}
			else {
				$query .= " ORDER BY event_date DESC, event_id DESC";
			}

			if (isset($event_array['limit'])) {
				$query .= " LIMIT :limit";
				if (isset($event_array['offset'])) {
					$query .= " OFFSET :offset";
				}
			}
			//echo $query;

			$stmt = $juassi_db->prepare($query);
			if (isset($event_array['server_id']) && !empty($event_array['server_id'])) {
				$stmt->bindParam(':server_id', $event_array['server_id'], PDO::PARAM_INT);
			}
			if (isset($event_array['event_severity']) && !empty($event_array['event_severity'])) {
				$stmt->bindParam(':event_severity', $event_array['event_severity']);
			}

			if (isset($event_array['order']) && !empty($event_array['order'])) {
				$stmt->bindParam(':order', $event_array['order']);
			}

			if (isset($event_array['limit'])) {
				$limit = (int) $event_array['limit'];
				$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
				if (isset($event_array['offset'])) {
					$offset = (int) $event_array['offset'];
					$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
				}
			}

			//$stmt->bindParam('', );

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if (!empty($events)) {
				return $events;
			}
			else {
				return array();
			}
		}
	}
?>