<?php

class WC_Naguro_Session {
	/** @var int */
	private $id;

	/** @var bool */
	private $saved;

	/** @var array */
	private $data = array();

	public function __construct( $id = null ) {
		$this->saved = true;

		if ( null === $id ) {
			$this->id = $this->generate_session_id();
		} else {
			$this->id = $id;
			$this->data = $this->get_session();
		}

		add_action( 'shutdown', array( $this, 'save_data' ), 20 );
	}

	public function get_id() {
		return $this->id;
	}

	private function generate_session_id() {
		$max = get_option( 'naguro_max_session_id', 0 );
		$max = $max + 1;
		update_option( 'naguro_max_session_id', $max );
		return $max;
	}

	private function get_session() {
		$this->update_expires_record();
		return (array) get_option( 'naguro_session_' . $this->id, array() );
	}

	public function get( $key ) {
		if ( isset( $this->data[ $key ] ) ) {
			return $this->data[ $key ];
		}

		return null;
	}

	public function set( $key, $value ) {
		$this->data[ $key ] = $value;
		$this->saved = false;
		return true;
	}

	public function save_data() {
		if ( ! $this->saved ) {
			if ( false === get_option( 'naguro_session_' . $this->id ) ) {
				add_option( 'naguro_session_' . $this->id, $this->data, '', 'no' );
			} else {
				update_option( 'naguro_session_' . $this->id, $this->data );
			}

			$this->update_expires_record();
			$this->saved = true;
		}
	}

	private function update_expires_record() {
		$new_time = time() + DAY_IN_SECONDS;
		if ( false === get_option( 'naguro_session_expires_' . $this->id ) ) {
			add_option( 'naguro_session_expires_' . $this->id, $new_time, '', 'no' );
		} else {
			update_option( 'naguro_session_expires_' . $this->id, $new_time );
		}
	}
}