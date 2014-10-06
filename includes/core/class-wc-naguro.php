<?php

class WC_Naguro {
	/** @var Naguro_Request_Factory */
	public $request_factory;

	/** @var Naguro_Handler_Factory */
	public $handler_factory;

	/** @var Naguro_Model_Repository */
	public $model_repository;

	/** @var WC_Naguro_Ajax */
	private $ajax_handler;

	/** @var string */
	static $prefix = "naguro_";

	public function __construct() {
		if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || false == DOING_AJAX ) ) {
			$this->admin_init();
		} else {
			add_action( 'init', array( $this, 'conditional_include' ) );
			$this->frontend_init();
		}

		// Setup the Ajax dispatcher
		$this->ajax_handler = new WC_Naguro_Ajax();
	}

	/**
	 * Prepare the administration panel specific files and classes
	 */
	private function admin_init() {
		new WC_Naguro_Settings_Page();
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