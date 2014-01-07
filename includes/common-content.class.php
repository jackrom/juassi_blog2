<?php

	class juassi_common_content {

		private $x_name_table;
		private $x_name_column;

		function return_first_x_name($x_name) {
			global $juassi_db, $juassi_tb;
			static $number_count = 1;

			if ($number_count > 1) {
				$check_value = $x_name . '-' . $number_count;
			}
			else {
				$check_value = $x_name;
			}
			$query = "SELECT count(*) FROM $this->x_name_table WHERE $this->x_name_column = ?";
			$stmt = $juassi_db->prepare($query);
			$stmt->bindParam(1, $check_value);

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			if ($array = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
				$number = $array[0]['count(*)'];
			}
			else {
				$number = 0;
			}

			if ($number > 0) {
				$number_count++;
				$this->return_first_x_name($x_name);
			}
			else {
				return $x_name;
			}

			return $x_name . '-' . $number_count;
		}

		function set_x_name_table($table_name) {
			$this->x_name_table = $table_name;
		}
		function set_x_name_column($table_column) {
			$this->x_name_column = $table_column;
		}

	}

?>