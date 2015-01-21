<?php

class Naguro_Activate_Key_Request extends Naguro_Request {
	public function do_request() {
		$this->handler->handle_request( 'activate-key', $this->params, 'post' );
		var_dump( $this->handler->get_data() ); die();
	}
}