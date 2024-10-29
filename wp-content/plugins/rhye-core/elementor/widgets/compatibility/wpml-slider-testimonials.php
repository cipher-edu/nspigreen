<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WPML_Elementor_Rhye_Widget_Slider_Testimonials extends WPML_Elementor_Module_With_Items {
	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'testimonials';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'author', 'text' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'author':
				return sprintf( '<strong>%1$s</strong><br>%2$s', esc_html__( 'Slider Testimonials', 'rhye' ), esc_html__( 'Author', 'rhye' ) );
			case 'text':
				return sprintf( '<strong>%1$s</strong><br>%2$s', esc_html__( 'Slider Testimonials', 'rhye' ), esc_html__( 'Text', 'rhye' ) );
			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'author':
				return 'LINE';
			case 'text':
				return 'AREA';

			default:
				return '';
		}
	}
}
