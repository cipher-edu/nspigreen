<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WPML_Rhye_Elementor_Counters extends WPML_Elementor_Module_With_Items {
	public function get_items_field() {
		return 'counters';
	}

	public function get_fields() {
		return array( 'label' );
	}

	protected function get_title( $field ) {
		switch ( $field ) {
			case 'label':
				return sprintf( '<strong>%1$s</strong><br>%2$s', esc_html__( 'Counters', 'rhye' ), esc_html__( 'Label', 'rhye' ) );
			default:
				return '';
		}
	}

	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'label':
				return 'LINE';

			default:
				return '';
		}
	}
}
