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

function wc_naguro_connect_get_instance() {
	include( NAGURO_PLUGIN_PATH . 'includes/class-wc-naguro.php' );
	return new WC_Naguro();
}

add_action('init', 'wc_naguro_connect_init');

function wc_naguro_connect_init() {
	include('vendor/autoload.php');

	global $wc_naguro_connect;
	$wc_naguro_connect = wc_naguro_connect_get_instance();
}