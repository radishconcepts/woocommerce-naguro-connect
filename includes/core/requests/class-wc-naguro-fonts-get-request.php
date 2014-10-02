<?php

class WC_Naguro_Fonts_Get_Request extends WC_Naguro_Request {
	public function output() {
		$fonts = array(
			array(
				'id' => 1,
				'name' => 'Times New Roman',
				'bold' => true,
				'italic' => true,
			),
			array(
				'id' => 2,
				'name' => 'Comic Sans',
				'bold' => true,
				'italic' => true,
			),
			array(
				'id' => 3,
				'name' => 'Lato',
				'bold' => true,
				'italic' => true,
			)
		);

		$fonts_array = array();

		foreach ( $fonts as $font ) {
			array_push( $fonts_array, array(
				'id'     => $font['id'],
				'name'   => $font['name'],
				'bold'   => $font['bold'],
				'italic' => $font['italic'],
			) );
		}

		echo json_encode($fonts_array); die();
	}
}