<?php

class WC_Naguro_Image_Get_Request extends WC_Naguro_Request {
	public function output() {
		if ( isset( $this->params['image_id'] ) ) {
			$id = absint( $this->params['image_id'] );

			if ( get_post_meta( $id, '_naguro_image_session_id', true ) == $this->params['session'] ) {
				$param_width = absint( $this->params['width'] );
				$image_src = wp_get_attachment_image_src( $id, 'full' );

				$src = $image_src[0];
				$width = $image_src[1];
				$height = $image_src[2];

				$image = wp_get_image_editor( $src );

				if ( ! is_wp_error( $image ) ) {
					$image->resize( $param_width, 99999 );
					$image->save( $image_src );
					$dimensions = $image->get_size();
					$width = $dimensions['width'];
					$height = $dimensions['height'];
				}


				echo json_encode( array(
					'id' => $id,
					'src' => $src,
					'width' => $width,
					'height' => $height,
				) );
			}
		}
		die();
	}
}