<?php

abstract class Naguro_Request {
	/** @var array */
	protected $params;

	/** @var Naguro_Session_Model */
	protected $session;

	/** @var Naguro_API_Handler */
	protected $handler;

	/**
	 * Fire up the required session and handler
	 * @param $params array
	 */
	public function __construct( $params ) {
		$this->params = $params;

		$this->session = new Naguro_Session_Model( $this->params['session_id'] );
		$this->handler = Naguro_API_Handlers_Repository::get_handler();
	}
}