<?php

class WC_Naguro {
	/** @var Naguro_Request_Factory */
	public $request_factory;

	/** @var Naguro_Handler_Factory */
	public $handler_factory;

	/** @var Naguro_Model_Repository */
	public $model_repository;

	/** @var string */
	static $prefix = "naguro_";

	public function __construct() {
		$this->initialize_library_objects();

		if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || false == DOING_AJAX ) ) {
			$this->admin_init();
		} else {
			add_action( 'init', array( $this, 'conditional_include' ) );
			$this->frontend_init();
		}

		$this->setup_handler();
	}

	/**
	 * Initializes the main objects from the library to be used in the plugin
	 */
	private function initialize_library_objects() {
		$this->request_factory  = new Naguro_Request_Factory();
		$this->handler_factory  = new Naguro_Handler_Factory();
		$this->model_repository = new Naguro_Model_Repository( $this->request_factory );
	}

	/**
	 * Setup the WordPress specific API request handler
	 */
	private function setup_handler() {
		$this->handler_factory->register_api_handler( new WP_API_Handler() );
	}

	/**
	 * Prepare the administration panel specific files and classes
	 */
	private function admin_init() {
		new WC_Naguro_Product_Admin();
	}

	/**
	 * Prepare frontend specific classes
	 */
	private function frontend_init() {
		new WC_Naguro_Cart();
	}

	/**
	 * Prepare the specific files and classes who will be loaded based on WooCommerce conditionals
	 */
	public function conditional_include() {
		if ( is_checkout() || is_checkout_pay_page() ) {
			new WC_Naguro_Checkout();
		}
	}
}