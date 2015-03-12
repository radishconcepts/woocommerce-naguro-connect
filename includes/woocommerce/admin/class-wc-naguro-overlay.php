<?php

class WC_Naguro_Overlay {
	function __construct() {
		add_action("naguro_woocommerce_before_printable_area_button", array($this, "add_design_area_overlay_upload"));
	}

	function add_design_area_overlay_upload($rand) {
		$name = WC_Naguro::$prefix . "designarea[overlay][" . $rand . "]";

		woocommerce_wp_text_input(array(
			"id"            => $name,
			"label"         => "Overlay image",
			"description"   => "Upload an image that will serve as the overlay image that will display on top of the designer",
			"name"          => $name,
			"value"         => "",
			"class"         => "",
			"type"          => "file"
		));
	}
}