<?php

class Naguro_Modules_Loader {
	public function __construct() {
		// Needs to check naguro_active_modules to fire up modules
		new Naguro_Overlay_Module();
	}
}