<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WPML_Elementor_Rhye_Widget_Portfolio_Mouse_Hover_Reveal extends WPML_Elementor_Module_With_Items {
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
		return array( 'title', 'subheading', 'text' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'title':
				return sprintf( '<strong>%1$s</strong><br>%2$s', esc_html__( 'Portfolio Mouse Hover Reveal', 'rhye' ), esc_html__( 'Title', 'rhye' ) );
			case 'subheading':
				return sprintf( '<strong>%1$s</strong><br>%2$s', esc_html__( 'Portfolio Mouse Hover Reveal', 'rhye' ), esc_html__( 'Subheading', 'rhye' ) );
			case 'text':
				return sprintf( '<strong>%1$s</strong><br>%2$s', esc_html__( 'Portfolio Mouse Hover Reveal', 'rhye' ), esc_html__( 'Text', 'rhye' ) );

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
			case 'subheading':
				return 'LINE';
			case 'text':
				return 'AREA';

			default:
				return '';
		}
	}
}
