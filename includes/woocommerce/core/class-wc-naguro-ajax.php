<?php

class WC_Naguro_Ajax {
	public function __construct() {
		// Add the dispatch action for both logged in and not logged in visitors
		add_action( 'wp_ajax_naguro', array( $this, 'dispatch' ) );
		add_action( 'wp_ajax_nopriv_naguro', array( $this, 'dispatch' ) );
	}

	/**
	 * Fires up the correct request handler based on the posted model and method
	 */
	public function dispatch() {
		$model = $_POST['model'];
		$method = $_POST['method'];

		try {
			$request = $this->get_request_by_model_method( $model, $method );
			$request->output();
		} catch ( Exception $e ) {
			return;
		}
	}

	/**
	 * @param $model
	 * @param $method
	 *
	 * @return Naguro_Request
	 * @throws Exception
	 */
	private function get_request_by_model_method( $model, $method ) {
		if ( 'session' === $model && 'get' === $method ) {
			return new Naguro_Session_Get_Request( $_POST );
		} elseif ( 'font' === $model && 'getavailablefonts' === $method ) {
			return new Naguro_Fonts_Get_Request( $_POST );
		} elseif ( 'text' === $model && 'getimage' === $method ) {
			return new Naguro_Text_Image_Get_Request( $_POST );
		} elseif( 'order' === $model && 'preview' === $method ) {
			return new Naguro_Order_Preview_Get_Request( $_POST );
		} elseif( 'order' === $model && 'placeorder' === $method ) {
			return new Naguro_Order_Place_Request( $_POST );
		} elseif( 'image' === $model && 'upload' === $method ) {
			return new Naguro_Image_Upload_Request( $_POST );
		} elseif( 'image' === $model && 'getsrc' === $method ) {
			return new Naguro_Image_Get_Request( $_POST );
		}

		throw new Exception('Invalid model and method combination.');
	}
}