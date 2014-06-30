<?php

/*
 * Plugin Name: WooCommerce Naguro Connect
 * Description: Connects your WooCommerce powered store to Naguro.
 * Version: 0.0.1-beta-alpha
 * Author: Radisch Concepts
 * Author URI: http://radishconcepts.com
 */

function wc_naguro_connect_init() {
	include( 'includes/class-wc-naguro.php' );
	return new WC_Naguro();
}

global $wc_naguro_connect;
$wc_naguro_connect = wc_naguro_connect_init();