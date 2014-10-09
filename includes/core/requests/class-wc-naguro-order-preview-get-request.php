<?php

class WC_Naguro_Order_Preview_Get_Request extends WC_Naguro_Request {
	public function output() {
		$data = $this->handler->handle_request('order-preview', $this->params, 'post' );
		$output_data = json_decode( $data['body'] );

		$output_array = array(
			'src' => $output_data->image,
		);

		echo json_encode($output_array); die();
	}
}