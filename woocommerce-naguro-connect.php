<?php

/*
 * Plugin Name: WooCommerce Naguro Connect
 * Description: Connects your WooCommerce powered store to Naguro.
 * Version: 0.0.1-beta-alpha
 * Author: Radish Concepts
 * Author URI: http://radishconcepts.com
 */

define( 'NAGURO_PLUGIN_PATH', trailingslashit( dirname( __FILE__ ) ) );
define( 'NAGURO_LIB_PATH', NAGURO_PLUGIN_PATH . 'vendor/radishconcepts/naguro-connector-library/application/' );
define( 'NAGURO_PLUGIN_URL', plugins_url( "/", __FILE__ ));

function wc_naguro_connect_get_instance() {
	include( NAGURO_PLUGIN_PATH . 'includes/class-wc-naguro.php' );
	return new WC_Naguro();
}

add_action('init', 'wc_naguro_connect_init');

function wc_naguro_connect_init() {
	// Load PHP 5.2 compatible autoloader if required
	if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
		include('vendor/autoload.php');
	} else {
		include('vendor/autoload_52.php');
	}

	// Setup the core class instance
	global $wc_naguro_connect;
	$wc_naguro_connect = wc_naguro_connect_get_instance();
}