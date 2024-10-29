<?php

$priority = 1;

/**
 * Options
 */
Kirki::add_section(
	'footer_options',
	array(
		'title'    => esc_html__( 'Options', 'rhye' ),
		'priority' => $priority ++,
		'panel'    => 'footer',
	)
);
get_template_part( '/inc/customizer/panels/footer/sections/options' );

/**
 * Section Upper Layout
 */
Kirki::add_section(
	'section_footer_upper',
	array(
		'title'    => esc_attr__( 'Layout Upper Section', 'rhye' ),
		'priority' => $priority ++,
		'panel'    => 'footer',
	)
);
get_template_part( '/inc/customizer/panels/footer/sections/section-upper' );

/**
 * Section Lower Layout
 */
Kirki::add_section(
	'section_footer_lower',
	array(
		'title'    => esc_attr__( 'Layout Lower Section', 'rhye' ),
		'priority' => $priority ++,
		'panel'    => 'footer',
	)
);
get_template_part( '/inc/customizer/panels/footer/sections/section-lower' );
