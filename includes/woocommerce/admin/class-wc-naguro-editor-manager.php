<?php

class WC_Naguro_Editor_Manager {
	public function __construct() {
		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	public function save_post( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( 'product' != get_post_type($post_id ) ) {
			return;
		}

		$design_areas = get_post_meta( $post_id, 'naguro_design_area' );

		$use_overlay_module = false;

		foreach ( $design_areas as $design_area ) {
			if ( ! empty( $design_area['product_overlay_id'] ) && 0 != $design_area['product_overlay_id'] ) {
				$use_overlay_module = true;
				break;
			}
		}

		if ( $use_overlay_module ) {
			$params['modules'] = 'main,overlay';
		} else {
			$params['modules'] = 'main';
		}

		$params['version'] = '1.1';
		$params['theme'] = 'standard';
		$params['language'] = 'en_GB';
		$params['callback'] = home_url();
		$hash = $this->generate_editor_hash($params);

		if ( ! $this->does_editor_exist($hash)) {
			$request = new Naguro_Editor_Request($params);
			$request->get('editor/request');
		}

		update_post_meta( $post_id, 'naguro_editor_hash', $hash );
	}

	private function generate_editor_hash( $params ) {
		return md5(implode(',', $params));
	}

	private function does_editor_exist( $hash ) {
		$editor_option = get_option( 'naguro_editor_' . $hash, false );
		return ( false === $editor_option ) ? false : true;
	}
}