<?php

abstract class WC_Naguro_Request {
	protected $params;

	protected $session;

	protected $handler;

	public function __construct( $params ) {
		$this->params = $params;

		// This variable needs to be available with both keys. Don't ask.
		if ( isset( $this->params['session'] ) ) {
			$this->params['session_id'] = $this->params['session'];
		}

		$this->session = new WC_Naguro_Session( $this->params['session_id'] );
		$this->handler = new WP_API_Handler();
	}
}