<?php

class Naguro_Modules_Loader {
	private $modules = array(
		'overlay'
	);

	public function __construct() {
		$modules = apply_filters( 'naguro_available_modules', $this->modules );
		$active_modules = get_option( 'naguro_active_modules', array() );
		$active_modules = array_intersect( $modules, $active_modules );

		foreach ( $active_modules as $module ) {
			$this->load_module( $module );
		}
	}

	private function load_module( $module_slug ) {
		$module = Naguro_Modules_Repository::get_module_by_slug( $module_slug );
		$module->load();
	}
}