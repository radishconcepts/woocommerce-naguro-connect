<?php

class WC_Naguro_Fonts_Get_Request extends WC_Naguro_Request {
	public function output() {
		$data = $this->handler->handle_request('fonts', array('session_id' => 23 ), 'get' );
		$fonts = json_decode( $data['body'] );

		$fonts_array = array();

		foreach ( $fonts->data as $font ) {
			array_push( $fonts_array, array(
				'id'     => $font->id,
				'name'   => $font->name,
				'bold'   => $font->bold,
				'italic' => $font->italic,
			) );
		}

		echo json_encode($fonts_array); die();
	}
}