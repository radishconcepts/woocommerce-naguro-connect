<?php

class WC_Naguro_Designer {
	/**
	 * @var WC_Product
	 */
	private $product;

	/** @var WC_Naguro_Session */
	private $session;

	/** @var array */
	private $designer_data;

	/**
	 * @param $product WC_Product
	 */
	public function __construct( $product ) {
		$this->product = $product;
		$this->prepare_request();
		$this->html = $this->get_html();

		// @todo CSS and JS local loading to cache
		// @todo Remove assets dependency in composer.json
		wp_enqueue_script('naguro-designer', NAGURO_PLUGIN_URL . 'vendor/radishconcepts/naguro-frontend-assets/js/naguro-designer-nl_NL.js');
		wp_enqueue_style('naguro-designer', NAGURO_PLUGIN_URL . 'vendor/radishconcepts/naguro-frontend-assets/css/style.css');
	}

	private function prepare_request() {
		$this->session = new WC_Naguro_Session();
		$this->session->set( 'product_id', $this->product->id);

		$request = new WC_Naguro_HTML_Get_Request(array( 'session_id' => $this->session->get_id() ) );
		$this->designer_data = $request->get();
	}

	private function get_html() {
		$html = $this->designer_data['html'];
		$html = str_replace('{{endpoint}}', get_home_url() . '/wp-admin/admin-ajax.php', $html );
		$html = str_replace('{{session-id}}', $this->session->get_id(), $html );
		return $html;
	}

	public function output() {
		echo $this->html;
	}
}