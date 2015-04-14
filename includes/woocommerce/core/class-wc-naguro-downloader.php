<?php

class WC_Naguro_Downloader {
	public function __construct() {
		add_action( 'init', array( $this, 'listener' ) );
	}

	public function listener() {
		if ( isset( $_GET['naguro_download_editor'] ) ) {
			// Do download magic here
		}
	}
}