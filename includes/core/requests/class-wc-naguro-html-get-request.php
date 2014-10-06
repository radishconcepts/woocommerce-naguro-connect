<?php

class WC_Naguro_HTML_Get_Request extends WC_Naguro_Request {
	public function output() {
		$data = $this->handler->handle_request('get-html', $this->params, 'get' );
		$body = json_decode( $data['body'] );

		$data_array = array(
			'html' => $body->html,
			'css'  => $body->css,
			'js'   => $body->js,
		);

		echo json_encode($data_array); die();
	}
}