<?php

class WC_Naguro_Overlay {
	function __construct() {
		add_action("naguro_woocommerce_before_printable_area_button", array($this, "add_design_area_overlay_upload"));
		add_action("naguro_woocommerce_after_printable_area_image", array($this, "add_overlay_image"));
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

	function add_overlay_image($design_area) {
		if ( isset( $design_area['product_overlay'] ) ) {
			echo '<img class="overlay-image" src="' . $design_area['product_overlay'] . '" />';
		} else {
			echo '<img class="overlay-image" src="" />';
		}
	}
}