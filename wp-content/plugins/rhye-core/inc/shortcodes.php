<?php

add_shortcode( 'arts_current_year', 'arts_display_current_year' );
if ( ! function_exists( 'arts_display_current_year' ) ) {
	function arts_display_current_year() {
		$current_year = gmdate( 'Y' );
		$current_year = do_shortcode( shortcode_unautop( $current_year ) );

		if ( ! empty( $current_year ) ) {
			return $current_year;
		}
	}
}
