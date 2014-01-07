<?php
/*
	Juassi 2.0 PDO Database Class
	Juan Carlos Reyes C Copyright 2012
*/
	class juassi_db extends PDO {

		function __construct($juassi_db_host, $juassi_db_name, $juassi_db_user, $juassi_db_pass, $juassi_db_type = 'mysql', $juassi_db_charset = 'UTF8') {

			switch ($juassi_db_type) {
				case 'postgresql':

					if (array_search('postgresql', parent::getAvailableDrivers()) === FALSE)
					juassi_die('Unable to find the PDO PostgreSQL database driver, which is required with the current database settings.');

					try {
						$connection = parent::__construct('pgsql:host=' . $juassi_db_host . ';dbname=' . $juassi_db_name . ';user=' . $juassi_db_user . ';password=' . $juassi_db_pass);
					}
					catch (PDOException $e) {
						juassi_die($e->getMessage());
					}
					//set charset
					parent::exec('SET NAMES ' . $juassi_db_charset);

					return $connection;

				break;

				case 'mysql':

					if (array_search('mysql', parent::getAvailableDrivers()) === FALSE)
					juassi_die('Unable to find the PDO MySQL database driver, which is required with the current database settings.');

					try {
						$connection = parent::__construct('mysql:host=' . $juassi_db_host . ';dbname=' . $juassi_db_name, $juassi_db_user, $juassi_db_pass,
							array(PDO::ATTR_PERSISTENT => true));
					}
					catch (PDOException $e) {
						juassi_die($e->getMessage());
					}
					//set charset
					parent::exec('SET NAMES ' . $juassi_db_charset);

					return $connection;

				break;

				case 'sqlite':

					if (array_search('sqlite', parent::getAvailableDrivers()) === FALSE)
					juassi_die('Unable to find the PDO SQLite database driver, which is required with the current database settings.');

					try {
						return parent::__construct('sqlite:' . $juassi_db_name);
					}
					catch (PDOException $e) {
						juassi_die($e->getMessage());
					}
				break;

				default:
					juassi_die('Database "' . $juassi_db_type . '" is unsupported.');
			}
		}

		private $juassi_num_query = 0;

		function query($query) {
			//echo $query . '<br />';
			$this->juassi_num_query++;
			return parent::query($query);
		}

		function prepare($query, $driver_options = array()) {
			//echo $query . '<br />';
			$this->juassi_num_query++;
			return parent::prepare($query, $driver_options);
		}

		function juassi_num_queries() {
			return $this->juassi_num_query;
		}

	}
?>