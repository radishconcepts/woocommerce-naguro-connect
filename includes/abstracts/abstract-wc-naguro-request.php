<?php

abstract class WC_Naguro_Request {
	protected $params;

	protected $session;

	protected $handler;

	public function __construct( $params ) {
		$this->params = $params;
		$this->session = new WC_Naguro_Session( $params['session_id'] );
		$this->handler = new WP_API_Handler();
	}
}