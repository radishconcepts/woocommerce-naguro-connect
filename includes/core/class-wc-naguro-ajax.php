<?php

class WC_Naguro_Ajax {
	public function __construct() {
		add_action( 'wp_ajax_naguro', array( $this, 'dispatch' ) );
		add_action( 'wp_ajax_nopriv_naguro', array( $this, 'dispatch' ) );
	}

	public function dispatch() {
		$session = $_POST['session'];
		$model = $_POST['model'];
		$method = $_POST['method'];

		if ( 'session' == $model && 'get' == $method ) {
			new WC_Naguro_Session_Get_Request( array('session_id' => $session ) );
		}
	}
}