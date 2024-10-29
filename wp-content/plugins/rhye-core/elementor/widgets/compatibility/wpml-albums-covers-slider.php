<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WPML_Elementor_Rhye_Widget_Albums_Covers_Slider extends WPML_Elementor_Module_With_Items {
	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'posts_static';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'title' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'title':
				return sprintf( '<strong>%1$s</strong><br>%2$s', esc_html__( 'Albums Covers Slider', 'rhye' ), esc_html__( 'Title', 'rhye' ) );

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
			case 'title':
				return 'LINE';

			default:
				return '';
		}
	}
}
