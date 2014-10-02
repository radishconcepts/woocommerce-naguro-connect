<?php

abstract class WC_Naguro_Request {
	protected $params;

	protected $session;

	public function __construct( $params ) {
		$this->params = $params;
		$this->session = new WC_Naguro_Session( $params['session_id'] );
	}
}