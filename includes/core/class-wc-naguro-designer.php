<?php

class WC_Naguro_Designer {
	/**
	 * @var WC_Product
	 */
	private $product;

	/**
	 * @param $product WC_Product
	 */
	public function __construct( $product ) {
		$this->product = $product;
	}

	public function output() {
		echo 'Designing...';
	}
}