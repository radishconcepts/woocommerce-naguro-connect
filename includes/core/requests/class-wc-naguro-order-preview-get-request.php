<?php

class WC_Naguro_Order_Preview_Get_Request extends WC_Naguro_Request {
	public function output() {
		$session = new WC_Naguro_Session( $this->params['session'] );
		$design_areas = get_post_meta( $session->get('product_id'), 'naguro_design_area' );

		$this->params['design_area_array'] = array();
		foreach ( $design_areas as $key => $design_area ) {
			$image_src = wp_get_attachment_image_src( $design_area['product_image_id'], 'full' );
			$width = ( $image_src[1] / 100 ) * $design_area['print_width'];
			$height = ( $image_src[2] / 100 ) * $design_area['print_height'];

			$this->params['design_area_array'][ $key ] = array(
				'width' => $width,
				'height' => $height,
			);
		}

		$data = $this->handler->handle_request('order-preview', $this->params, 'post' );
		$output_array = array();

		$output_data = json_decode( $data['body'] );

		foreach ( $output_data as $part ) {
			$output_array[] = array(
				'src'            => $part->src,
				'design_area_id' => $part->design_area_id,
			);
		}

		echo json_encode($output_array); die();
	}
}