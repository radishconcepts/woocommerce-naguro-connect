<?php

class WC_Naguro_Cart {
	public function __construct() {
		add_filter( 'woocommerce_loop_add_to_cart_link', array($this, 'change_add_to_cart_button'), 10, 2);
		add_filter( 'woocommerce_product_add_to_cart_text', array($this, 'add_to_cart_text' ), 10, 2 );
		add_filter( 'woocommerce_product_single_add_to_cart_text', array($this, 'add_to_cart_text'), 10, 2 );
		add_filter( 'template_include', array($this, 'designer_template_filter' ), 10, 1 );

		add_action( 'init', array( $this, 'add_to_cart_action' ), 9, 0 );
		add_action( 'the_content', array($this, 'output_designer' ) );
	}

	public function add_to_cart_action() {
		if ( empty( $_REQUEST['add-to-cart'] ) || ! is_numeric( $_REQUEST['add-to-cart'] ) ) {
			return;
		}

		$product = wc_get_product( absint( $_REQUEST['add-to-cart'] ) );

		if ( $this->is_naguro_product($product) ) {
			// Remove the temporary product that has now been added to the cart
			$cart_id = WC()->cart->generate_cart_id( $product->id );
			WC()->cart->set_quantity( $cart_id, 0 );

			wp_safe_redirect( $product->get_permalink() . '?designer');
			exit();
		}
	}

	public function output_designer( $content ) {
		if ( isset( $_GET['designer'] ) ) {
			global $post;

			if ( isset($post->ID)) {
				$product = wc_get_product($post->ID);
				if ( $this->is_naguro_product($product)) {
					$designer = new WC_Naguro_Designer( $product );
					$designer->output();
				}
			}
		} else {
			return $content;
		}
	}

	/**
	 * @param $product WC_Product
	 *
	 * @return bool
	 */
	private function is_naguro_product( $product ) {
		return ( 'yes' == get_post_meta( $product->id, 'naguro_product_active', true ) );
	}

	/**
	 * @param $button string
	 * @param $product WC_Product
	 *
	 * @return string
	 */
	public function change_add_to_cart_button( $button, $product ) {
		if ( $this->is_naguro_product( $product ) ) {
			$button = str_replace( 'add_to_cart_button', '', $button );
		}

		return $button;
	}

	/**
	 * @param $text string
	 * @param $product WC_Product
	 *
	 * @return string
	 */
	public function add_to_cart_text( $text, $product ) {
		if ( $this->is_naguro_product( $product ) ) {
			return __( 'Design product', 'woocommerce-naguro-connect' );
		}

		return $text;
	}

	public function designer_template_filter( $template_file) {
		if ( ! isset( $_GET['designer'] ) ) {
			return $template_file;
		}

		if ( strstr( $template_file, 'single-product.php' ) ) {
			return trailingslashit( get_template_directory() ) . 'page.php';
		}

		return $template_file;
	}
}