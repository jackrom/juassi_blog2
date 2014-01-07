<?php
	/*
		SOAP Server
	*/
	define('JUASSI_RUNNING_SOAP', TRUE);
	include('functions/juassi_common.php');

	include(JUASSI_ROOT . JUASSI_INCLUDE . '/admin.functions.php');

	if (juassi_get_config('soap_server')) {

		//check if SSL required
		if (juassi_get_config('soap_server_ssl_only')) {
			if (!isset($_SERVER['HTTPS']) || ($_SERVER['HTTPS'] != 'on')) {
				echo 'This server requires a secure soap connection.';

				$event_array['event_file'] = __FILE__;
				$event_array['event_file_line'] = __LINE__;
				$event_array['event_type'] = 'rejected_connection';
				$event_array['event_number'] = E_USER_NOTICE;
				$event_array['event_source'] = 'soap_server';
				$event_array['event_severity'] = 'notice';
				$event_array['event_description'] = 'Insecure Connector access attempt rejected';

				$juassi_log->add($event_array);
				exit;
			}
		}
		define('JUASSI_NUSOAP_NAMESPACE', 'http://www.juassi.com/');

		$juassi_soap 	= new juassi_soap_server();

		//setup name space
		$juassi_soap->configureWSDL('juassi', JUASSI_NUSOAP_NAMESPACE, juassi_get_config('address') . '/juassi-soap.php');
		$juassi_soap->wsdl->schemaTargetNamespace = JUASSI_NUSOAP_NAMESPACE;

		/*
			These need to be accessible to anyone so that they can authenticate
		*/
		$juassi_soap->wsdl->addComplexType(
			'authentication_results',
			'complexType',
			'struct',
			'all',
			'',
			array(
				'session_id' => array('name'=>'session_id','type'=>'xsd:string'),
				'session_name' => array('name'=>'session_name','type'=>'xsd:string'),
				'success' => array('name'=>'success','type'=>'xsd:int'),
				'message' => array('name'=>'message','type'=>'xsd:string'),
			)
		);

		$juassi_soap->wsdl->addComplexType(
			'authentication_details',
			'complexType',
			'struct',
			'all',
			'',
			array(
				'username' => array('name'=>'username','type'=>'xsd:string'),
				'site_id' => array('name'=>'site_id','type'=>'xsd:string'),
			)
		);

		//register authenticate()
		$juassi_soap->register(
			'juassi_soap_login',
			array('authentication_details'	=> 'tns:authentication_details'),
			array('return'	=> 'tns:authentication_results'),
			JUASSI_NUSOAP_NAMESPACE
		);

		$juassi_soap->wsdl->addComplexType(
			'registration_details',
			'complexType',
			'struct',
			'all',
			'',
			array(
				'username' => array('name'=>'username','type'=>'xsd:string'),
				'password' => array('name'=>'password','type'=>'xsd:string'),
				'site_id' => array('name'=>'site_id','type'=>'xsd:string'),
				'site_type' => array('name'=>'site_type','type'=>'xsd:string'),
			)
		);

		$juassi_soap->wsdl->addComplexType(
			'registration_results',
			'complexType',
			'struct',
			'all',
			'',
			array(
				'site_type' => array('name'=>'site_type','type'=>'xsd:string'),
				'success' => array('name'=>'success','type'=>'xsd:int'),
				'message' => array('name'=>'message','type'=>'xsd:string'),
			)
		);

		//register a site
		$juassi_soap->register(
			'juassi_soap_register_site',
			array('registration_details'	=>	'tns:registration_details'),
			array('return'					=>	'tns:registration_results'),
			JUASSI_NUSOAP_NAMESPACE
		);

		/*
			The rest of the functions can use the built in permissions
		*/

		if (juassi_is_logged_in()) {
			//register authenticate()
			$juassi_soap->register(
				'juassi_soap_logout',
				array(),
				array('return' => 'xsd:int'),
				JUASSI_NUSOAP_NAMESPACE
			);
		}

		if (juassi_is_logged_in()) {
			$juassi_soap->wsdl->addComplexType(
			    'common_array',
			    'complexType',
			    'array',
			    '',
			    'SOAP-ENC:Array',
			    array(),
			    array(
			        array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:common_basic[]')
			    ),
			    'tns:common_basic'
			);

			$juassi_soap->wsdl->addComplexType(
				'common_basic',
				'complexType',
				'struct',
				'all',
				'',
				array(
					'name' => array('name'=>'name','type'=>'xsd:string'),
					'value' => array('name'=>'value','type'=>'xsd:string')
				)
			);
			//get common
			$juassi_soap->register(
				'juassi_soap_common',
				array(),
				array('return'		=>	'tns:common_array'),
				JUASSI_NUSOAP_NAMESPACE
			);
			//receive common
			$juassi_soap->wsdl->addComplexType(
				'common_result',
				'complexType',
				'struct',
				'all',
				'',
				array(
					'success' => array('name'=>'success','type'=>'xsd:int'),
					'message' => array('name'=>'message','type'=>'xsd:string'),
				)
			);
			$juassi_soap->register(
				'juassi_soap_receive_common',
				array('common_array' => 'tns:common_array'),
				array('return'		=>	'tns:common_result'),
				JUASSI_NUSOAP_NAMESPACE
			);
		}

		if (juassi_is_logged_in()) {
			//unregister a site
			$juassi_soap->register(
				'juassi_soap_unregister_site',
				array(),
				array('return' =>	'xsd:int'),
				JUASSI_NUSOAP_NAMESPACE
			);
		}

		if (juassi_is_logged_in()) {
			$juassi_soap->wsdl->addComplexType(
				'client_details',
				'complexType',
				'struct',
				'all',
				'',
				array(
					'site_soap_url' => array('name'=>'site_soap_url','type'=>'xsd:string'),
					'site_id' => array('name'=>'site_id','type'=>'xsd:string'),
				)
			);

			$juassi_soap->wsdl->addComplexType(
				'client_results',
				'complexType',
				'struct',
				'all',
				'',
				array(
					'success' => array('name'=>'success','type'=>'xsd:int'),
					'message' => array('name'=>'message','type'=>'xsd:string'),
				)
			);
			//unregister a client
			$juassi_soap->register(
				'juassi_soap_register_client',
				array('client_details'	=> 'tns:client_details'),
				array('return' 			=> 'tns:client_results'),
				JUASSI_NUSOAP_NAMESPACE
			);
		}

		if (juassi_user_can('send_remote_events')) {
			$juassi_soap->wsdl->addComplexType(
				'events_result',
				'complexType',
				'struct',
				'all',
				'',
				array(
					'success' => array('name'=>'success','type'=>'xsd:int'),
					'message' => array('name'=>'message','type'=>'xsd:string'),
				)
			);

			$juassi_soap->wsdl->addComplexType(
			    'events_array',
			    'complexType',
			    'array',
			    '',
			    'SOAP-ENC:Array',
			    array(),
			    array(
			        array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:event[]')
			    ),
			    'tns:event'
			);

			$juassi_soap->wsdl->addComplexType(
				'event',
				'complexType',
				'struct',
				'all',
				'',
				array(
					'event_id' => array('name'=>'event_id','type'=>'xsd:int'),
					'event_number' => array('name'=>'event_number','type'=>'xsd:int'),
					'user_id' => array('name'=>'user_id','type'=>'xsd:int'),
					'event_date' => array('name'=>'event_date','type'=>'xsd:string'),
					'event_date_utc' => array('name'=>'event_date_utc','type'=>'xsd:string'),
					'event_type' => array('name'=>'event_type','type'=>'xsd:string'),
					'event_severity' => array('name'=>'event_severity','type'=>'xsd:string'),
					'event_file' => array('name'=>'event_file','type'=>'xsd:string'),
					'event_file_line' => array('name'=>'event_file_line','type'=>'xsd:string'),
					'event_ip_address' => array('name'=>'event_ip_address','type'=>'xsd:string'),
					'event_description' => array('name'=>'event_description','type'=>'xsd:string'),
					'event_trace' => array('name'=>'event_trace','type'=>'xsd:string'),
					'event_source' => array('name'=>'event_source','type'=>'xsd:string'),
				)
			);
			$juassi_soap->register(
				'juassi_soap_receive_events',
				array('events_array'	=> 'tns:events_array'),
				array('return'			=> 'tns:events_result'),
				JUASSI_NUSOAP_NAMESPACE
			);
		}

		if (juassi_user_can('recent_events')) {
			$juassi_soap->wsdl->addComplexType(
			    'event_basic_array',
			    'complexType',
			    'array',
			    '',
			    'SOAP-ENC:Array',
			    array(),
			    array(
			        array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:event_basic[]')
			    ),
			    'tns:event_basic'
			);

			$juassi_soap->wsdl->addComplexType(
				'event_basic',
				'complexType',
				'struct',
				'all',
				'',
				array(
					'event_date' => array('name'=>'event_date','type'=>'xsd:string'),
					'description' => array('name'=>'description','type'=>'xsd:string'),
					'type' => array('name'=>'type','type'=>'xsd:string'),
					'event_id' => array('name'=>'event_id','type'=>'xsd:int')
				)
			);
			$juassi_soap->register(
				'juassi_last_10_events',
				array(),
				array('return'		=>	'tns:event_basic_array'),
				JUASSI_NUSOAP_NAMESPACE
			);

		}
		if (juassi_user_can('add_user')) {

		}
		if (juassi_user_can('read_configuration')) {
			$juassi_soap->register(
				'juassi_get_config',
				array('config_name'=>'xsd:string','unserialize'=>'xsd:int'),
				array('return'		=>	'xsd:string'),
				JUASSI_NUSOAP_NAMESPACE
			);
		}

		// Use the request to (try to) invoke the service
		$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
		$juassi_soap->service($HTTP_RAW_POST_DATA);

	}

?>