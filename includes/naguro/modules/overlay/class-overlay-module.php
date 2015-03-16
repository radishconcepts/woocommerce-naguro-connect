<?php

class Naguro_Overlay_Module extends Naguro_Module {
	public function __construct() {
		new WC_Naguro_Overlay();

		parent::__construct();
	}
}