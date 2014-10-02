<?php

class WC_Naguro_Text_Image_Get_Request extends WC_Naguro_Request {
	public function output() {
		$object = new StdClass();
		$object->session_id = $this->session->get_id();

		echo json_encode( $object ); die();
	}
}