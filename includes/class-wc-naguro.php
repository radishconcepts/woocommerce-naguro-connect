<?php

class WC_Naguro {
	/** @var \Naguro */
	private $naguro;

	public function __construct() {
		include_once( 'naguro-library/naguro.php' );
		$this->naguro = new Naguro();

		$this->includes();
		$this->naguro->handler_factory->register_api_handler( new WP_API_Handler() );
	}

	private function includes() {
		include( 'class-wp-api-handler.php' );
	}
}