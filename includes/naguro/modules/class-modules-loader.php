<?php

class Naguro_Modules_Loader {
	public function __construct() {
		try {
			$modules = Naguro_Modules_Repository::get_active_modules();
		} catch ( Exception $e ) {
			echo '<b>Caught exception</b>: ', $e->getMessage(), "<br />\n";
		}

		/** @var Naguro_Module $module */
		foreach ( $modules as $module ) {
			$module->load();
		}
	}
}
