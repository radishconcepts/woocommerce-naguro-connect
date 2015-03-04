<?php

class Naguro_Modules_Repository extends Naguro_Repository {
	public static function get_modules() {
		$core = new Naguro_Module_Model();
		$core->name = 'Naguro core';
		$core->description = 'The core of Naguro, always active.';
		$core->active = true;
		$core->unlocked = true;
		$core->always_on = true;

		$overlay = new Naguro_Module_Model();
		$overlay->name = 'Overlay module';
		$overlay->description = 'Allows you to add an overlay to your design areas.';
		$overlay->unlocked = true;

		$shirts = new Naguro_Module_Model();
		$shirts->name = 'Shirt module';
		$shirts->description = 'Allow your customers to design t-shirts with ease.';
		$shirts->purchase_url = 'https://www.naguro.com/';

		return array(
			$core,
			$overlay,
			$shirts,
		);
	}
}