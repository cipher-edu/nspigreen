<?php

$priority = 1;

Kirki::add_section(
	'ajax_transitions',
	array(
		'title'    => esc_html__( 'AJAX Transitions', 'rhye' ),
		'priority' => $priority ++,
		'panel'    => 'theme_options',
	)
);
get_template_part( '/inc/customizer/panels/theme-options/sections/ajax-transitions' );

Kirki::add_section(
	'contact_form_7',
	array(
		'title'    => esc_html__( 'Contact Form 7', 'rhye' ),
		'priority' => $priority ++,
		'panel'    => 'theme_options',
	)
);
get_template_part( '/inc/customizer/panels/theme-options/sections/contact-form-7' );

Kirki::add_section(
	'galleries',
	array(
		'title'    => esc_html__( 'Galleries', 'rhye' ),
		'priority' => $priority ++,
		'panel'    => 'theme_options',
	)
);
get_template_part( '/inc/customizer/panels/theme-options/sections/galleries' );

Kirki::add_section(
	'cursor_follower',
	array(
		'title'    => esc_html__( 'Mouse Cursor', 'rhye' ),
		'priority' => $priority ++,
		'panel'    => 'theme_options',
	)
);
get_template_part( '/inc/customizer/panels/theme-options/sections/cursor-follower' );

Kirki::add_section(
	'outdated_browsers',
	array(
		'title'    => esc_html__( 'Outdated Browsers', 'rhye' ),
		'priority' => $priority ++,
		'panel'    => 'theme_options',
	)
);
get_template_part( '/inc/customizer/panels/theme-options/sections/outdated-browsers' );

Kirki::add_section(
	'performance',
	array(
		'title'    => esc_html__( 'Performance & Lazy Images', 'rhye' ),
		'priority' => $priority ++,
		'panel'    => 'theme_options',
	)
);
get_template_part( '/inc/customizer/panels/theme-options/sections/performance' );

Kirki::add_section(
	'preloader',
	array(
		'title'    => esc_html__( 'Preloader', 'rhye' ),
		'priority' => $priority ++,
		'panel'    => 'theme_options',
	)
);
get_template_part( '/inc/customizer/panels/theme-options/sections/preloader' );

Kirki::add_section(
	'scroll_down',
	array(
		'title'    => esc_html__( 'Scroll Down', 'rhye' ),
		'priority' => $priority ++,
		'panel'    => 'theme_options',
	)
);
get_template_part( '/inc/customizer/panels/theme-options/sections/scroll-down' );

Kirki::add_section(
	'smooth_scroll',
	array(
		'title'    => esc_html__( 'Smooth Scroll', 'rhye' ),
		'priority' => $priority ++,
		'panel'    => 'theme_options',
	)
);
get_template_part( '/inc/customizer/panels/theme-options/sections/smooth-scroll' );
