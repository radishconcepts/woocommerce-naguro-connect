<?php

class WooCommerce_Naguro {
	public function __construct() {
		add_action( 'naguro_api_handler_class', array( $this, 'api_handler_class' ), 10, 0 );

		new Naguro_WordPress_Menu();
	}

	public function api_handler_class() {
		return 'WordPress_API_Handler';
	}
}