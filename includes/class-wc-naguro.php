<?php

class WC_Naguro {
	/** @var Naguro_Handler_Factory */
	public $handler_factory;

	/** @var Naguro_Model_Repository */
	public $model_repository;

	public function __construct() {
		$this->always_include();

		$this->handler_factory = new Naguro_Handler_Factory();
		$this->model_repository = new Naguro_Model_Repository();

		$this->setup_handler();
	}

	/**
	 * Contains includes that should be included in every single request
	 */
	private function always_include() {
		include_once( 'naguro-library/application/interfaces/interface-api-handler.php' );
		include_once( 'naguro-library/application/handler-factory.php' );
		include_once( 'naguro-library/application/model-repository.php' );
	}

	/**
	 * Setup the WordPress specific API request handler
	 */
	private function setup_handler() {
		include( 'class-wp-api-handler.php' );
		$this->handler_factory->register_api_handler( new WP_API_Handler() );
	}
}