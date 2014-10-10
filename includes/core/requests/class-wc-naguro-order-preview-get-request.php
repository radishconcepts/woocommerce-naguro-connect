<?php

class WC_Naguro_Order_Preview_Get_Request extends WC_Naguro_Request {
	public function output() {
		$data = $this->handler->handle_request('order-preview', $this->params, 'post' );
		$output_data = json_decode( $data['body'] );

		$output_array = array();

		foreach ( $output_data as $part ) {
			$output_array[] = array(
				'src'            => $part->src,
				'design_area_id' => $part->design_area_id,
			);
		}

		echo json_encode($output_array); die();
	}
}