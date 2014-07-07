<?php

class WC_Naguro {
	/** @var Naguro_Request_Factory */
	public $request_factory;

	/** @var \WC_Request_Handler */
	public $request_handler;

	/** @var Naguro_Handler_Factory */
	public $handler_factory;

	/** @var Naguro_Model_Repository */
	public $model_repository;

	public function __construct() {
		$this->always_include();

		$this->request_factory = new Naguro_Request_Factory();
		$this->handler_factory = new Naguro_Handler_Factory();
		$this->model_repository = new Naguro_Model_Repository( $this->request_factory );
		$this->request_handler = new WC_Request_Handler( $this->handler_factory, $this->model_repository );

		$this->setup_handler();
	}

	/**
	 * Contains includes that should be included in every single request
	 */
	private function always_include() {
		include_once( NAGURO_LIB_PATH . 'abstracts/abstract-request-handler.php' );

		include_once( NAGURO_LIB_PATH . 'interfaces/interface-api-handler.php' );

		include_once( NAGURO_LIB_PATH . 'handler-factory.php' );
		include_once( NAGURO_LIB_PATH . 'model-repository.php' );
		include_once( NAGURO_LIB_PATH . 'request-factory.php' );

		include_once( NAGURO_PLUGIN_PATH . 'includes/class-wc-request-handler.php' );
	}

	/**
	 * Setup the WordPress specific API request handler
	 */
	private function setup_handler() {
		include( NAGURO_PLUGIN_PATH . 'includes/class-wp-api-handler.php' );
		$this->handler_factory->register_api_handler( new WP_API_Handler() );
	}
}