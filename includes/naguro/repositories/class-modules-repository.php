<?php

class Naguro_Modules_Repository extends Naguro_Repository {

	/**
	 * @param $slug
	 * @return Naguro_Module_Model
	 */
	public static function get_module_by_slug( $slug ) {
		$modules = self::get_modules();

		foreach ( $modules as $key => $module ) {
			if ( $module->slug === $slug ) {
				return $module;
			}
		}

		return false;
	}

	public static function get_active_modules() {
		$modules = self::get_modules();

		foreach ( $modules as $key => $module ) {
			if ( ! $module->active ) {
				unset( $modules[ $key ] );
			}
		}

		return $modules;
	}

	public static function get_locked_modules() {
		$modules = self::get_modules();

		foreach ( $modules as $key => $module ) {
			if ( $module->unlocked ) {
				unset( $modules[ $key ] );
			}
		}

		return $modules;
	}

	public static function get_unlocked_modules() {
		$modules = self::get_modules();

		foreach ( $modules as $key => $module ) {
			if ( ! $module->unlocked ) {
				unset( $modules[ $key ] );
			}
		}

		return $modules;
	}

	public static function get_modules() {
		$core = new Naguro_Core_Module();
		$core->slug = 'core';
		$core->name = 'Naguro core';
		$core->description = 'The core of Naguro, always active.';
		$core->active = true;
		$core->unlocked = true;
		$core->always_on = true;

		$modules[] = $core;

		$overlay = new Naguro_Overlay_Module();
		$overlay->slug = 'overlay';
		$overlay->name = 'Overlay module';
		$overlay->description = 'Allows you to add an overlay to your design areas.';
		$overlay->unlocked = true;

		$modules[] = $overlay;

		$shirts = new Naguro_Shirt_Module();
		$shirts->slug = 'shirt';
		$shirts->name = 'Shirt module';
		$shirts->description = 'Allow your customers to design t-shirts with ease.';
		$shirts->purchase_url = 'https://www.naguro.com/';

		$modules[] = $shirts;

		$active_modules_array = get_option('naguro_active_modules', array() );

		foreach ( $modules as $module ) {
			if ( in_array( $module->slug, $active_modules_array ) ) {
				$module->active = true;
			}
		}

		return $modules;
	}
}