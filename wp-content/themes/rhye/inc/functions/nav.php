<?php

require_once ARTS_THEME_PATH . '/inc/classes/class-arts-walker-nav-menu-overlay.php';

/**
 * Register Theme Menus
 *
 * @return void
 */
add_action( 'after_setup_theme', 'arts_init_navigation' );
function arts_init_navigation() {

	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
			array(
				'main_menu' => esc_html__( 'Main Menu', 'rhye' ),
			)
		);
	}

}
