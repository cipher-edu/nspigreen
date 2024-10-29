<?php

/**
 * ACF Helper Functions
 */

if ( ! function_exists( 'arts_have_rows' ) ) {
	function arts_have_rows( $args, $options = '' ) {

		if ( function_exists( 'have_rows' ) ) {
			return have_rows( $args, $options );
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'arts_get_field' ) ) {
	function arts_get_field( $args, $options = '' ) {

		if ( function_exists( 'get_field' ) ) {
			return get_field( $args, $options );
		} else {
			return false;
		}

	}
}
