<?php

class NaguroStubs {
	static function get_design_areas() {
		return array(
			array(
				"name"              => "Front",
				"size_description"  => "25mm x 12.3mm",
				"output_width"      => 25,
				"output_height"     => 12.3,
				"product_image"     => NAGURO_PLUGIN_URL . "/includes/stubs/background.png"
			)
		);
	}

	static function get_empty_design_areas() {
		return array();
	}
} 