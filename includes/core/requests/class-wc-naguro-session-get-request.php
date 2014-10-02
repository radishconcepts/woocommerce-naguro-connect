<?php

class WC_Naguro_Session_Get_Request extends WC_Naguro_Request {
	public function output() {
		$object = new StdClass();
		$object->session_id = $this->params['session_id'];
		$object->locale = 'nl_NL';
		$object->start_product_subtype_id = 1;
		$object->product = array(
			'product_id' => 1,
			'name' => 'USB stick',
			'design_areas' => array(
				array(
					'product_design_area_id' => 1,
					'name' => 'Front',
					'sort_order' => 1
				),
			),
			'subtypes' => array(
				array(
					'product_subtype_id' => 1,
					'product_design_area_id' => 1,
					'is_circle' => false,
					'src_width' => 480,
					'src_height' => 200,
					'print_width' => 51.04166666,
					'print_height' => 48,
					'output_width' => 244.8,
					'output_height' => 96,
					'left' => 25.625,
					'top' => 24.5,
					'size_description' => "1,5cm x 0.8cm",
					'image_src' => "/images/products/background.png",
					'overlay_src' => "",
				),
			),
		);

		echo json_encode( $object ); die();
	}
}