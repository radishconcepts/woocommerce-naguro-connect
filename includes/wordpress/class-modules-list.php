<?php

class Naguro_Modules_List extends WP_List_Table {
	public function get_columns() {
		$columns = array(
			'name' => 'Name',
			'description' => 'Description',
			'actions' => 'Actions',
		);

		return $columns;
	}

	public function prepare_items() {
		$columns               = $this->get_columns();
		$hidden                = array();
		$sortable              = array();
		$this->_column_headers = array( $columns, $hidden, $sortable );
	}

	public function column_default( $item, $column_name ) {
		switch( $column_name ) {
			case 'name':
				return $item->name;
			case 'description':
				return $item->description;
			case 'actions':
				return $this->get_actions( $item );
			default:
				return '';
		}
	}

	/**
	 * @return string
	 */
	private function get_actions( $item ) {
		if ( $item->always_on ) {
			return '';
		}

		if ( ! $item->unlocked ) {
			$text = 'Get this module';

			if ( ! empty( $item->purchase_url ) ) {
				return '<a href="'.esc_url( $item->purchase_url ) . '">'. $text .'</a>';
			}

			return $text;
		}

		if ( ! $item->active ) {
			return 'Activate this module';
		}

		return 'Active';
	}

	public function single_row( $item ) {
		$active_class = ( $item->active ) ? 'active' : '';

		echo '<tr class="'.$active_class.'">';
		echo $this->single_row_columns( $item );
		echo "</tr>\n";
	}
}