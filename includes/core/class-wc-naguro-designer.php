<?php

class WC_Naguro_Designer {
	/**
	 * @var WC_Product
	 */
	private $product;

	/**
	 * @param $product WC_Product
	 */
	public function __construct( $product ) {
		$this->product = $product;
		$this->html = $this->get_html();

		wp_enqueue_script('naguro-designer', NAGURO_PLUGIN_URL . 'vendor/radishconcepts/naguro-frontend-assets/js/naguro-designer-nl_NL.js');
		wp_enqueue_style('naguro-designer', NAGURO_PLUGIN_URL . 'vendor/radishconcepts/naguro-frontend-assets/css/style.css');
	}

	private function get_html() {
		$html = file_get_contents( NAGURO_PLUGIN_PATH . 'vendor/radishconcepts/naguro-frontend-assets/build.html');
		$html = str_replace('{{endpoint}}', get_home_url() . '/wp-admin/admin-ajax.php', $html );
		$html = str_replace('{{session-id}}', 23, $html );
		return $html;
	}

	public function output() {
		echo $this->html;
	}
}