<?php

class WP_API_Handler implements I_Naguro_API_Handler {
	private $api_key;

	public function __construct() {
		$this->api_key = get_option('naguro_api_key', false);

		if ( ! $this->api_key ) {
			wp_die('No API key provided...');
		}
	}
	
	public function handle_request( $params = array(), $request = false, $type = 'post' ) {}

	public function set_api_key( $api_key ) {}
}