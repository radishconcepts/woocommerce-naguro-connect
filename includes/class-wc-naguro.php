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
		$this->initialize_library_objects();

		if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || false == DOING_AJAX ) ) {
			$this->admin_init();
		} else {
			add_action( 'init', array( $this, 'conditional_include' ) );
		}

		$this->setup_handler();
	}

	/**
	 * Contains includes that should be included in every single request
	 */
	private function always_include() {
		include_once( NAGURO_LIB_PATH . 'abstracts/abstract-request.php' );
		include_once( NAGURO_LIB_PATH . 'abstracts/abstract-product.php' );

		include_once( NAGURO_LIB_PATH . 'interfaces/interface-api-handler.php' );

		include_once( NAGURO_LIB_PATH . 'handler-factory.php' );
		include_once( NAGURO_LIB_PATH . 'model-repository.php' );
		include_once( NAGURO_LIB_PATH . 'request-factory.php' );

		include_once( NAGURO_PLUGIN_PATH . 'includes/class-wc-naguro-product.php' );
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
		include( NAGURO_PLUGIN_PATH . 'includes/class-wp-api-handler.php' );
		$this->handler_factory->register_api_handler( new WP_API_Handler() );
	}

	/**
	 * Prepare the administration panel specific files and classes
	 */
	private function admin_init() {
		include( NAGURO_PLUGIN_PATH . 'includes/admin/class-wc-naguro-product-admin.php' );
		new WC_Naguro_Product_Admin();
	}

	/**
	 * Prepare the specific files and classes who will be loaded based on WooCommerce conditionals
	 */
	public function conditional_include() {
		if ( is_cart() ) {
			include( NAGURO_PLUGIN_PATH . 'includes/class-wc-naguro-cart.php' );
			new WC_Naguro_Cart();
		}

		if ( is_checkout() || is_checkout_pay_page() ) {
			include( NAGURO_PLUGIN_PATH . 'includes/class-wc-naguro-checkout.php' );
			new WC_Naguro_Checkout();
		}
	}
}