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
		$request = new Naguro_Get_Modules_Request( array() );
		$modules = $request->do_request();
		$modules = json_decode($modules['body']);

		$module_map = array(
			'core' => 'Naguro_Core_Module',
			'overlay' => 'Naguro_Overlay_Module',
			'shirt' => 'Naguro_Shirt_Module',
		);

		$module_array = array();

		$active_modules_array = get_option('naguro_active_modules', array() );

		foreach ( $modules->data as $module ) {
			if ( isset( $module_map[ $module->slug ] ) ) {
				$module_object = new $module_map[ $module->slug ]();
				$module_object->slug = $module->slug;
				$module_object->name = $module->name;
				$module_object->description = $module->description;
				$module_object->always_on = $module->always_on;
				$module_object->unlocked = $module->unlocked;

				if ( in_array( $module->slug, $active_modules_array ) ) {
					$module_object->active = true;
				}

				$module_array[ $module->slug ] = $module_object;
			}
		}

		return $module_array;
	}
}