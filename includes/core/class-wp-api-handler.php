<?php

class WP_API_Handler {
	/** @var string */
	private $api_key;

	/** @var string */
	private $api_url;

	public function __construct() {
		$this->api_key = get_option('naguro_api_key');
		$this->api_url = get_option('naguro_api_url');

		if ( ! $this->api_key || ! $this->api_url ) {
			wp_die('No valid API credentials provided...');
		}
	}

	public function handle_request( $params = array(), $request = false, $type = 'post' ) {
	}

	public function set_api_key( $api_key ) {}
}