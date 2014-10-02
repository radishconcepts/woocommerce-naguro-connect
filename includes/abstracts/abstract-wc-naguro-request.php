<?php

abstract class WC_Naguro_Request {
	protected $params;

	public function __construct( $params ) {
		$this->params = $params;
	}
}