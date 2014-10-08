<?php

class WC_Naguro_Text_Image_Get_Request extends WC_Naguro_Request {
	public function output() {
		if ( strstr( $this->params['colour'], '#' ) ) {
			$this->params['colour'] = str_replace('#', '', $this->params['colour']);
		}

		$data = $this->handler->handle_request('text-image', $this->params, 'post' );
		$output_data = json_decode( $data['body'] );

		$output_array = array(
			'src' => $output_data->image,
			'width' => 500, // @todo actual value implementation
			'height' => 500, // @todo actual value implementation
		);

		echo json_encode($output_array); die();
	}
}