<?php

abstract class WC_Naguro_Request {
	/** @var array */
	protected $params;

	/** @var WC_Naguro_Session */
	protected $session;

	/** @var WP_API_Handler */
	protected $handler;

	/**
	 * Fire up the required session and handler
	 * @param $params array
	 */
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