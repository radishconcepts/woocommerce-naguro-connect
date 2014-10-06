<?php

class WC_Naguro_Text_Image_Get_Request extends WC_Naguro_Request {
	public function output() {
		$data = $this->handler->handle_request('text-image', $this->params, 'post' );
		$output_data = json_decode( $data['body'] );

		$output_array = array(
			'image' => $output_data->image,
		);

		echo json_encode($output_array); die();
	}
}