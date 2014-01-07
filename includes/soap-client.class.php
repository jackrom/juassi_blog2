<?php
	/*
		This class is used for SOAP communication between a Bluetrait Client and a Compatible SOAP server.
		Please Note: This class does not handle the client registration process
	*/
	class juassi_soap_client extends juassi_soap {

		private $config 		= NULL;
		private $is_connected	= FALSE;
		private $common			= NULL;

		function __construct($server_id = NULL) {

			if (!isset($server_id)) {
				$server_id		= juassi_get_config('soap_server_id');
			}

			$server_array	= juassi_get_soap_site($server_id);

			$this->config['remote_server_url'] = $server_array['site_soap_url'];
			$this->config['remote_server_username'] = $server_array['username'];
			$this->config['remote_server_site_id']= $server_array['remote_site_id'];
			$this->config['server_id'] = $server_id;

			//used to login
			$auth_client = new juassi_soap($this->config['remote_server_url']);

			$array['username'] 	= $this->config['remote_server_username'];
			$array['site_id']	= $this->config['remote_server_site_id'];

			$connection 		= $auth_client->call('juassi_soap_login', array($array));

			$session_id 		= $connection['session_id'];
			$session_name		= $connection['session_name'];

			//no longer needed
			unset($auth_client);

			if ($connection['success'] == 1) {
				//this is where the authenticated SOAP connection starts
				parent::__construct($this->config['remote_server_url'] . '?' . $session_name . '=' . $session_id);
				$this->is_connected = TRUE;
			}
			else {
				$this->is_connected = FALSE;
			}
		}

		public function is_connected() {
			return $this->is_connected;
		}

		public function get_common() {
			$result_array = $this->call('juassi_soap_common');

			$config = array();

			foreach ($result_array as $result) {
				$config[$result['name']] = $result['value'];
			}

			$this->common = $config;

			return $config;
		}

		//take a copy of get_common and cache it
		public function cache_common($full_update = FALSE) {
			if (isset($this->common) && ($full_update == FALSE)) {
				$remote_common	= $this->common;
			}
			else {
				$remote_common	= $this->get_common();
			}

			foreach ($remote_common as $index => $value) {
				$config_array['soap_client_id'] = $this->config['server_id'];
				$config_array['config_type']	= 'common';
				$config_array['config_name']	= $index;
				$config_array['config_value']	= $value;
				juassi_update_sites_config($config_array);
			}
		}

		//push common
		public function push_common() {
			$common_array = juassi_soap_common();

			$result = $this->call('juassi_soap_receive_common', array($common_array));

			return $result;
		}

		//push events
		public function push_events() {
			global $juassi_log;

			//get events to push
			$array['not_synced'] = true;
			$events = $juassi_log->get($array);
			if (count($events) > 0) {
				$result = $this->call('juassi_soap_receive_events', array($events));

				//mark syned events as sent
				if ($result['success'] == 1) {
					$juassi_log->set_synced($events);
				}

			}
			else {
				$result['success'] = 0;
				$result['message'] = 'No events to sync';
			}

			return $result;

		}

		public function setup_server_access() {
			$array['site_id']		= juassi_uuid();
			$array['site_soap_url']	= juassi_get_config('address') . '/juassi-soap.php';

			$result = $this->call('juassi_soap_register_client', array($array));

			if ($result['success'] == 1) {
				$server['site_id'] = $array['site_id'];
				$server['soap_client_id'] = $this->config['server_id'];
				juassi_soap_update_server($server);
				return true;
			}
			else {
				return false;
			}
		}
	}

?>