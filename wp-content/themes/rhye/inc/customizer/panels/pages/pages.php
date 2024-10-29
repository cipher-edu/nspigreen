<?php

$priority = 1;

/**
 * 404
 */
Kirki::add_section(
	'404',
	array(
		'title'    => esc_html__( '404', 'rhye' ),
		'panel'    => 'pages',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/pages/sections/404' );

/**
 * Portfolio
 */
Kirki::add_section(
	'portfolio',
	array(
		'title'    => esc_html__( 'Portfolio', 'rhye' ),
		'panel'    => 'pages',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/pages/sections/portfolio' );

/**
 * Static Pages
 */
Kirki::add_section(
	'static_pages',
	array(
		'title'    => esc_html__( 'Static Pages', 'rhye' ),
		'panel'    => 'pages',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/pages/sections/static' );
