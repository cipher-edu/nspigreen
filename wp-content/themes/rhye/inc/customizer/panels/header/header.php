<?php

$priority = 1;

/**
 * Options
 */
Kirki::add_section(
	'header_options',
	array(
		'title'    => esc_html__( 'Options', 'rhye' ),
		'panel'    => 'header',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/header/sections/options' );

/**
 * Menu
 */
Kirki::add_section(
	'menu',
	array(
		'title'    => esc_html__( 'Menu', 'rhye' ),
		'panel'    => 'header',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/header/sections/menu' );
