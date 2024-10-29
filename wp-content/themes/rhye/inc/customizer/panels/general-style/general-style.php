<?php

$priority = 1;

/**
 * Animation
 */
Kirki::add_section(
	'animations',
	array(
		'title'    => esc_html__( 'Animations', 'rhye' ),
		'panel'    => 'general-style',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/general-style/sections/animations' );

/**
 * Colors
 */
Kirki::add_section(
	'colors',
	array(
		'title'    => esc_html__( 'Colors', 'rhye' ),
		'panel'    => 'general-style',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/general-style/sections/colors' );

/**
 * Curtains
 */
Kirki::add_section(
	'curtains',
	array(
		'title'    => esc_html__( 'Curtains', 'rhye' ),
		'panel'    => 'general-style',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/general-style/sections/curtains' );

/**
 * Gutters
 */
Kirki::add_section(
	'gutters',
	array(
		'title'    => esc_html__( 'Gutters', 'rhye' ),
		'panel'    => 'general-style',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/general-style/sections/gutters' );

/**
 * Layout
 */
Kirki::add_section(
	'layout',
	array(
		'title'    => esc_html__( 'Layout', 'rhye' ),
		'panel'    => 'general-style',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/general-style/sections/layout' );

/**
 * Paddings & Margins
 */
Kirki::add_section(
	'paddings_margins',
	array(
		'title'    => esc_html__( 'Paddings & Margins', 'rhye' ),
		'panel'    => 'general-style',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/general-style/sections/paddings-margins' );
