<?php

class Naguro_HTML_Get_Request extends Naguro_Request {
	public function output() {
		return $this->get();
	}

	public function get() {
		$product_id = $this->session->get('product_id');
		$design_areas = get_post_meta( $product_id, 'naguro_design_area' );

		$use_overlay_module = false;

		foreach ( $design_areas as $design_area ) {
			if ( ! empty( $design_area['product_overlay_id'] ) && 0 != $design_area['product_overlay_id'] ) {
				$use_overlay_module = true;
				break;
			}
		}

		if ( $use_overlay_module ) {
			$url_params['modules'] = 'main,overlay';
		} else {
			$url_params['modules'] = 'main';
		}

		$url_params['version'] = '1.1';
		$url_params['theme'] = 'standard';
		$url_params['language'] = 'en_GB';

		$endpoint = 'get-html?';
		foreach ( $url_params as $key => $value ) {
			$endpoint .= $key .'='. $value.'&';
		}

		$this->handler->handle_request($endpoint, $this->params, 'get' );
		$data = $this->handler->get_data();
		$body = json_decode( $data['body'] );

		return array(
			'html' => $body->html,
			'css'  => $body->css,
			'js'   => $body->js,
		);
	}
}