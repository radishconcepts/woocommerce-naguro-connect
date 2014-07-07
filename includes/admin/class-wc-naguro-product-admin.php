<?php

/**
 * Class WC_Naguro_Product_Admin
 * Responsible for settings related to products in the administration panel
 */
class WC_Naguro_Product_Admin {
	public function __construct() {
		add_action( 'woocommerce_process_product_meta', array( $this, 'save' ), 10, 2 );

		add_filter( 'product_type_options', array( $this, 'add_product_type' ), 10, 1 );
	}

	public function save( $post_id, $post ) {
		$is_naguro = ( isset( $_POST['_naguro'] ) && 'on' == $_POST['_naguro'] ) ? 'yes' : 'no';

		update_post_meta( $post_id, '_naguro', $is_naguro );
	}

	public function add_product_type( $types_array ) {
		$types_array['naguro'] = array(
			'id'            => '_naguro',
			'wrapper_class' => '',
			'label'         => __( 'Naguro product', 'woocommerce-naguro-connect' ),
			'description'   => __( 'Naguro products can be designed through the Naguro editor.', 'woocommerce-naguro-connect' ),
			'default'       => 'no'
		);

		return $types_array;
	}
}