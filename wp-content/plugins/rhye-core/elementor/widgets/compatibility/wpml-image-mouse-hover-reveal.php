<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WPML_Rhye_Elementor_Image_Mouse_Hover_Reveal extends WPML_Elementor_Module_With_Items {
	public function get_items_field() {
		return 'items';
	}

	public function get_fields() {
		return array( 'heading' );
	}

	protected function get_title( $field ) {
		switch ( $field ) {
			case 'heading':
				return sprintf( '<strong>%1$s</strong><br>%2$s', esc_html__( 'Image Mouse Hover Reveal', 'rhye' ), esc_html__( 'Heading', 'rhye' ) );
			default:
				return '';
		}
	}

	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'heading':
				return 'LINE';

			default:
				return '';
		}
	}
}
