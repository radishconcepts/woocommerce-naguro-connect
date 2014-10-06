<?php

class WC_Naguro_Settings_Page {
	public function __construct() {
		add_action( 'admin_init', array( $this, 'settings_init' ) );
		add_action( 'admin_menu', array( $this, 'settings_menu' ) );
	}

	public function settings_init() {
		add_settings_section(
			'naguro_api_section',
			'Naguro API Settings',
			array( $this, 'api_section_callback' ),
			'naguro'
		);

		add_settings_field(
			'naguro_api_key',
			'API Key',
			array( $this, 'api_key_field_callback' ),
			'naguro',
			'naguro_api_section'
		);

		add_settings_field(
			'naguro_api_url',
			'API Endpoint',
			array( $this, 'api_url_field_callback' ),
			'naguro',
			'naguro_api_section'
		);

		register_setting( 'naguro', 'naguro_api_key' );
		register_setting( 'naguro', 'naguro_api_url' );
	}

	public function api_section_callback() {
		echo 'Enter your Naguro API settings here to enable the plugin to connect.';
	}

	public function api_key_field_callback() {
		$value = esc_attr( get_option( 'naguro_api_key' ) );
		echo '<input type="text" name="naguro_api_key" value="' . $value . '" />';
	}

	public function api_url_field_callback() {
		$value = esc_attr( get_option( 'naguro_api_url' ) );
		echo '<input type="text" name="naguro_api_url" value="' . $value . '" />';
	}

	public function settings_menu() {
		add_options_page( 'Naguro', 'Naguro', 'manage_options', 'naguro', array( $this, 'settings_screen' ) );
	}

	public function settings_screen() {
		?>
		<div class="wrap">
			<h2>Naguro Options</h2>
			<form action="options.php" method="POST">
				<?php settings_fields( 'naguro' ); ?>
				<?php do_settings_sections( 'naguro' ); ?>
				<?php submit_button(); ?>
			</form>
		</div>
	<?php
	}
}