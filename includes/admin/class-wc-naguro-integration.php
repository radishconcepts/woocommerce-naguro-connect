<?php

class WC_Naguro_Integration extends WC_Integration {
	public function __construct() {
		$this->id					= 'wc_naguro_integration';
		$this->method_title     	= 'Naguro';
		$this->method_description	= '';

		// Load the settings.
		$this->init_form_fields();
		$this->init_settings();

		// Define user set variables
		$this->naguro_api_key = $this->get_option( 'naguro_api_key' );
		$this->naguro_api_url = $this->get_option( 'naguro_api_url' );

		// Actions
		add_action( 'woocommerce_update_options_integration_wc_naguro_integration', array( $this, 'process_admin_options') );
	}

	public function init_form_fields() {
		$this->form_fields = array(
			'naguro_api_key' => array(
				'title' 			=> 'API Key',
				'description' 		=> '',
				'type' 				=> 'text',
				'default' 			=> get_option('naguro_api_key') // Backwards compat
			),
			'naguro_api_url' => array(
				'title' 			=> 'API Endpoint',
				'description' 		=> '',
				'type' 				=> 'text',
				'default' 			=> get_option('naguro_api_url') // Backwards compat
			),
		);
	}
}