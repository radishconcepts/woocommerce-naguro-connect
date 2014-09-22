<?php
require(NAGURO_PLUGIN_PATH . "includes/stubs/NaguroStubs.php");

class WC_Naguro_Settings_Panel {
	public function __construct() {
		add_filter( 'woocommerce_product_data_tabs', array( $this, 'product_data_tabs' ), 10, 1 );

		add_action( 'woocommerce_process_product_meta', array( $this, 'save_panel_settings' ), 10, 1 );
		add_action( 'woocommerce_product_data_panels', array( $this, 'product_data_panels' ), 10, 0 );

		wp_enqueue_script("wc-naguro", NAGURO_PLUGIN_URL . "assets/js/wc-naguro.js");
		wp_enqueue_style("wc-naguro", NAGURO_PLUGIN_URL . "assets/css/wc-naguro.css");
	}

	public function product_data_tabs( $tabs ) {
		$tabs['naguro'] = array(
			'label'  => __( 'Naguro', 'woocommerce-naguro-connect' ),
			'target' => 'woocommerce_naguro_settings',
			'class'  => array( 'show_if_naguro' ),
		);

		return $tabs;
	}

	public function save_panel_settings( $post_id ) {
	}

	public function product_data_panels() {
		echo '<div id="woocommerce_naguro_settings" class="panel woocommerce_options_panel show_if_naguro">';

		echo '<div class="options_group">';
			$this->add_enable_checkbox();
		echo '</div>';

		echo '<div class="options_group">';
			$this->add_design_areas();
		echo '</div>';

		echo '</div>';
	}

	public function add_enable_checkbox() {
		woocommerce_wp_checkbox(array(
			"label"         => "Naguro product?",
			"name"          => WC_Naguro::$prefix . "exists",
			"value"         => "yes", //@todo: hier leuk de true / false waarde als 'yes'/'no' uitpoepen.
			"description"   => "Enable the customer to configure this product with the Naguro designer"
		));
	}

	public function add_design_areas() {
		$design_areas = NaguroStubs::get_empty_design_areas(); //@todo: de echte design areas ophalen

		echo "<div class='wc-metaboxes naguro-design-areas'>";

		if (0 === sizeof( $design_areas )) {
			echo "No design areas found for this product.";
		}

		echo "</div>";
	}
}