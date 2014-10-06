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

	public function handle_request( $endpoint, $params = array(), $type = 'post' ) {
		$params = $this->add_auth_token_to_header( $params );
		$url = $this->generate_api_endpoint_url( $endpoint );

		if ( 'get' == $type ) {
			$data = $this->get_request( $url, $params );
		} else {
			$data = $this->post_request( $url, $params );
		}

		return $data;
	}

	private function generate_api_endpoint_url( $endpoint ) {
		return trailingslashit( trailingslashit( $this->api_url ) . $endpoint );
	}

	private function add_auth_token_to_header( $params ) {
		$params['headers']['X-Auth-Token'] = $this->api_key;
		return $params;
	}

	private function get_request( $url, $params ) {
		return wp_remote_get( $url, $params );
	}

	private function post_request( $url, $params ) {
		return wp_remote_post( $url, $params );
	}
}