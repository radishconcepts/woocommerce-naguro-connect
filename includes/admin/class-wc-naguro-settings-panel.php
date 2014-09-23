<?php
require(NAGURO_PLUGIN_PATH . "includes/stubs/NaguroStubs.php");

class WC_Naguro_Settings_Panel {
	public function __construct() {
		add_filter( 'woocommerce_product_data_tabs', array( $this, 'product_data_tabs' ), 10, 1 );

		add_action( 'woocommerce_process_product_meta', array( $this, 'save_panel_settings' ), 10, 1 );
		add_action( 'woocommerce_product_data_panels', array( $this, 'product_data_panels' ), 10, 0 );

		wp_enqueue_script("wc-naguro", NAGURO_PLUGIN_URL . "assets/js/wc-naguro.js");
		wp_enqueue_style("wc-naguro", NAGURO_PLUGIN_URL . "assets/css/wc-naguro.css");

		wp_enqueue_script("imgareaselect", NAGURO_PLUGIN_URL . "assets/imgareaselect/jquery.imgareaselect.min.js", array("jquery"));
		wp_enqueue_style("imgareaselect", NAGURO_PLUGIN_URL . "assets/imgareaselect/imgareaselect-default.css");
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
		$design_areas = NaguroStubs::get_design_areas(); //@todo: de echte design areas ophalen

		echo "<div class='wc-metaboxes naguro-design-areas'>";

		if (0 === sizeof( $design_areas )) {
			echo "<p>No design areas found for this product.</p>";

			echo '<section class="naguro-design-areas-container-ghost">';
			$this->add_design_area(array());
			echo '</section>';
		}

		echo '<section class="naguro-design-areas-container">';

		foreach ( $design_areas as $design_area ) {
			$this->add_design_area($design_area);
		}

		echo '</section>';

		echo '<button type="button" class="button button-primary">Add new design area</button>';

		echo "</div>";
	}

	public function add_design_area($design_area = array()) {
		echo '<article class="naguro-design-area">';

		$this->add_design_area_name($design_area);
		$this->add_design_area_size_description($design_area);
		$this->add_design_area_output_width($design_area);
		$this->add_design_area_output_height($design_area);
		$this->add_design_area_background($design_area);

		echo '</article>';
	}

	public function add_design_area_name($design_area = array()) {
		woocommerce_wp_text_input(array(
			"label"         => "Name",
			"placeholder"   => "Name of the design area",
			"name"          => WC_Naguro::$prefix . "designarea_name",
			"value"         => (isset($design_area["name"]) ? $design_area["name"] : "" )
		));
	}

	public function add_design_area_size_description($design_area = array()) {
		woocommerce_wp_text_input(array(
			"label"         => "Size description",
			"placeholder"   => "Size description",
			"description"   => "Textual description that will be shown in the Naguro designer (eg '25mm x 12.3mm')",
			"name"          => WC_Naguro::$prefix . "designarea_output_width",
			"value"         => (isset($design_area["size_description"]) ? $design_area["size_description"] : "" )
		));
	}

	public function add_design_area_output_width($design_area = array()) {
		woocommerce_wp_text_input(array(
			"label"         => "Print width",
			"placeholder"   => "Width of the printable area",
			"description"   => "Width of the printable area in millimeters without the unit (eg '25')",
			"name"          => WC_Naguro::$prefix . "designarea_output_width",
			"value"         => (isset($design_area["output_width"]) ? $design_area["output_width"] : "" )
		));
	}

	public function add_design_area_output_height($design_area = array()) {
		woocommerce_wp_text_input(array(
			"label"         => "Print height",
			"placeholder"   => "Height of the printable area",
			"description"   => "Height of the printable area in millimeters without the unit (eg '12.5')",
			"name"          => WC_Naguro::$prefix . "designarea_output_height",
			"value"         => (isset($design_area["output_height"]) ? $design_area["output_height"] : "" )
		));
	}

	public function add_design_area_background($design_area = array()) {
		if (isset($design_area['product_image'])) {
			//@todo: add width, height, top, left hidden fields
			$this->add_design_area_background_upload();
			echo "<p class='naguro-text-container'>Define the printable area:</p>";
			$this->add_design_area_printable_area($design_area);
		} else {
			$this->add_design_area_background_upload();
			echo "<p class='naguro-upload-notice'>Upload an image before defining the printable area.</p>";
		}
	}

	public function add_design_area_background_upload() {
		woocommerce_wp_text_input(array(
			"label"         => "Design area image",
			"description"   => "Upload an image that will serve as the image that will be designed on",
			"name"          => WC_Naguro::$prefix . "designarea_product_image",
			"value"         => "",
			"type"          => "file"
		));
	}

	public function add_design_area_printable_area($design_area = array()) {
		echo '<div class="naguro-printable-product">';

		$this->add_design_area_print_width($design_area);
		$this->add_design_area_print_height($design_area);
		$this->add_design_area_left($design_area);
		$this->add_design_area_top($design_area);

		echo '  <img src="' . $design_area["product_image"] . '" />';
		echo '</div>';
	}

	public function add_design_area_print_width($design_area = array()) {
		woocommerce_wp_hidden_input(array(
			"class" => WC_Naguro::$prefix . "designarea_print_width",
			"value" => (isset($design_area["print_width"]) ? $design_area["print_width"] : "" ),
			"id" => WC_Naguro::$prefix . "designarea_print_width"
		));
	}

	public function add_design_area_print_height($design_area = array()) {
		woocommerce_wp_hidden_input(array(
			"class" => WC_Naguro::$prefix . "designarea_print_height",
			"value" => (isset($design_area["print_height"]) ? $design_area["print_height"] : "" ),
			"id" => WC_Naguro::$prefix . "designarea_print_height"
		));
	}

	public function add_design_area_left($design_area = array()) {
		woocommerce_wp_hidden_input(array(
			"class" => WC_Naguro::$prefix . "designarea_left",
			"value" => (isset($design_area["left"]) ? $design_area["left"] : "" ),
			"id" => WC_Naguro::$prefix . "designarea_left"
		));
	}

	public function add_design_area_top($design_area = array()) {
		woocommerce_wp_hidden_input(array(
			"class" => WC_Naguro::$prefix . "designarea_top",
			"value" => (isset($design_area["top"]) ? $design_area["top"] : "" ),
			"id" => WC_Naguro::$prefix . "designarea_top"
		));
	}
}