<?php

class WC_Naguro_Order_Place_Request extends WC_Naguro_Request {
	public function output() {
		$session = new WC_Naguro_Session( $this->params['session'] );
		$product = wc_get_product($session->get('product_id'));
		$session_data = array( 'naguro' => $session->get_id() );
		WC()->cart->add_to_cart( $product->id, 1, '', '', $session_data );

		$output_array = array(
			'redirect_url' => WC()->cart->get_cart_url(),
			'success' => true,
		);

		echo json_encode($output_array); die();
	}
}