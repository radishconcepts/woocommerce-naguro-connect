<?php

class WC_Naguro_Downloader {
	public function __construct() {
		add_action( 'init', array( $this, 'rewrite_rules' ), 1 );
		add_action( 'template_redirect', array( $this, 'listener' ) );
	}

	public function upload_mimes( $types ) {
		$types['html'] = 'text/html';
		return $types;
	}

	public function rewrite_rules() {
		add_rewrite_endpoint( 'naguro-editor', EP_ROOT );
	}

	public function listener() {
		add_filter( 'upload_mimes', array( $this, 'upload_mimes' ) );

		if ( 'download' != get_query_var( 'naguro-editor' ) ) {
			return;
		}

		$data = $_POST['data'];
		$store_array = array();

		foreach ( array( 'html' => 'file', 'css' => 'url', 'js' => 'url' ) as $key => $value_to_store ) {
			$assets_api_url = apply_filters( 'wc_naguro_assets_api_endpoint_url', 'http://api.naguro.com:5000/' );
			$contents = file_get_contents( $assets_api_url . $data[$key] );
			$file = $this->save_file_to_disk( $data['hash'], $key, $contents );
			$store_array[$key] = $file[ $value_to_store ];
		}

		update_option( 'naguro_editor_' . $data['hash'], $store_array );

		remove_filter( 'upload_mimes', array( $this, 'upload_mimes' ) );

		exit;
	}

	private function save_file_to_disk( $handle, $type, $contents ) {
		$file = wp_upload_bits( $handle . '.' . $type, null, $contents, date( 'Y/m' ) );
		return $file;
	}
}