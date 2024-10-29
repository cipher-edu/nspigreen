<?php

require_once ARTS_THEME_PATH . '/inc/classes/class-arts-add-custom-fonts.php';

/**
 * Add custom fonts choice
 *
 * @return array
 */
function arts_add_fonts_custom_choice() {
	return array(
		'fonts' => apply_filters( 'arts/kirki_font_choices', array() ),
	);
}
