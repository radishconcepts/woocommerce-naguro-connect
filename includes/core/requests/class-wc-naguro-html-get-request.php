<?php

class WC_Naguro_HTML_Get_Request extends Naguro_Request {
	public function get() {
		$data = $this->handler->handle_request('get-html', $this->params, 'get' );
		$body = json_decode( $data['body'] );

		return array(
			'html' => $body->html,
			'css'  => $body->css,
			'js'   => $body->js,
		);
	}
}