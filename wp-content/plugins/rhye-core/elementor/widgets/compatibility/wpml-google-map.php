<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WPML_Elementor_Rhye_Widget_Google_Map extends WPML_Elementor_Module_With_Items {
	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'markers';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'marker_content', 'marker_lat', 'marker_lon' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'marker_content':
				return sprintf( '<strong>%1$s</strong><br>%2$s', esc_html__( 'Google Map', 'rhye' ), esc_html__( 'Content Box', 'rhye' ) );

			case 'marker_lat':
				return sprintf( '<strong>%1$s</strong><br>%2$s', esc_html__( 'Google Map', 'rhye' ), esc_html__( 'Latitude', 'rhye' ) );

			case 'marker_lon':
				return sprintf( '<strong>%1$s</strong><br>%2$s', esc_html__( 'Google Map', 'rhye' ), esc_html__( 'Longitude', 'rhye' ) );

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
			case 'marker_content':
				return 'AREA';

			case 'marker_lat':
				return 'LINE';

			case 'marker_lon':
				return 'LINE';

			default:
				return '';
		}
	}
}
