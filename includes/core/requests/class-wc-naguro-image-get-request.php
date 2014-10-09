<?php

class WC_Naguro_Image_Get_Request extends WC_Naguro_Request {
	public function output() {
		if ( ! isset( $this->params['image_id'] ) ) {
			$id = absint( $this->params['image_id'] );
			$image_src = wp_get_attachment_image_src( $id, 'full' );

			if ( get_post_meta( $id, '_naguro_image_session_id', true ) == $this->params['session'] ) {
				echo json_encode( array(
					'id' => $id,
					'src' => $image_src[0],
					'width' => $image_src[1],
					'height' => $image_src[2],
				) );
			}

		}
		die();
	}
}