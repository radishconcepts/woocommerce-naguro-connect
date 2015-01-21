<?php

class Naguro_WordPress_Dashboard extends Naguro_WordPress_Settings_Page {
	public function __construct() {
		$this->maybe_save_settings();
		$this->output_tabs( 'dashboard' );
		$this->display_api_settings();
	}

	private function maybe_save_settings() {
		if ( isset( $_POST['naguro_api_key'] ) ) {
			update_option( 'naguro_api_key', sanitize_text_field( $_POST['naguro_api_key'] ) );

			$request = new Naguro_Activate_Key_Request( array(
				'api_key' => sanitize_text_field( $_POST['naguro_api_key'] ),
				'domain' => get_home_url(),
			) );
			$request->do_request();
		}
	}

	private function display_api_settings() {
		echo '<form action="" method="POST">';
		echo '<h3>Authentication</h3>';
		echo '<p>Please enter your Naguro API key in the field below to authenticate with the API and activate your purchased modules.</p>';
		echo '<label for="naguro_api_key">API key: </label>';
		echo '<input type="text" value="' . esc_attr( get_option( 'naguro_api_key' ) ) . '" id="naguro_api_key" name="naguro_api_key">';
		echo '<input type="submit" class="button" value="Save">';
		echo '</form>';
	}
}