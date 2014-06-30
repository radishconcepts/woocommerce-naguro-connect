<?php

class WC_Naguro {
	/** @var \WC_Request_Handler */
	public $request_handler;

	/** @var Naguro_Handler_Factory */
	public $handler_factory;

	/** @var Naguro_Model_Repository */
	public $model_repository;

	public function __construct() {
		$this->always_include();

		$this->request_handler = new WC_Request_Handler();
		$this->handler_factory = new Naguro_Handler_Factory();
		$this->model_repository = new Naguro_Model_Repository();

		$this->setup_handler();
	}

	/**
	 * Contains includes that should be included in every single request
	 */
	private function always_include() {
		include_once( 'naguro-library/application/abstracts/abstract-request-handler.php' );

		include_once( 'naguro-library/application/interfaces/interface-api-handler.php' );

		include_once( 'naguro-library/application/handler-factory.php' );
		include_once( 'naguro-library/application/model-repository.php' );

		include_once( 'class-wc-request-handler.php' );
	}

	/**
	 * Setup the WordPress specific API request handler
	 */
	private function setup_handler() {
		include( 'class-wp-api-handler.php' );
		$this->handler_factory->register_api_handler( new WP_API_Handler() );
	}
}