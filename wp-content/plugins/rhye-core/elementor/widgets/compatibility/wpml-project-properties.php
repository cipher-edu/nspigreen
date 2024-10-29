<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WPML_Elementor_Rhye_Widget_Project_Properties extends WPML_Elementor_Module_With_Items {
	public function get_items_field() {
		return 'properties';
	}

	public function get_fields() {
		return array( 'option', 'value' );
	}

	protected function get_title( $field ) {
		switch ( $field ) {
			case 'option':
				return sprintf( '<strong>%1$s</strong><br>%2$s', esc_html__( 'Project Property', 'rhye' ), esc_html__( 'Option', 'rhye' ) );
			case 'value':
				return sprintf( '<strong>%1$s</strong><br>%2$s', esc_html__( 'Project Property', 'rhye' ), esc_html__( 'Value', 'rhye' ) );
			default:
				return '';
		}
	}

	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'option':
				return 'LINE';
			case 'value':
				return 'LINE';

			default:
				return '';
		}
	}
}
