<?php

$priority = 1;

/**
 * Style
 */
Kirki::add_section(
	'blog_style',
	array(
		'title'    => esc_html__( 'Style', 'rhye' ),
		'priority' => $priority ++,
		'panel'    => 'blog',
	)
);
get_template_part( '/inc/customizer/panels/blog/sections/style' );

/**
 * Blog Page
 */
Kirki::add_section(
	'blog_layout',
	array(
		'title'    => esc_html__( 'Blog Page', 'rhye' ),
		'priority' => $priority ++,
		'panel'    => 'blog',
	)
);
get_template_part( '/inc/customizer/panels/blog/sections/blog-page' );

/**
 * Single Post
 */
Kirki::add_section(
	'blog_post',
	array(
		'title'    => esc_html__( 'Single Post', 'rhye' ),
		'priority' => $priority ++,
		'panel'    => 'blog',
	)
);
get_template_part( '/inc/customizer/panels/blog/sections/post' );

/**
 * Sidebar
 */
Kirki::add_section(
	'blog_sidebar',
	array(
		'title'    => esc_html__( 'Sidebar', 'rhye' ),
		'priority' => $priority ++,
		'panel'    => 'blog',
	)
);
get_template_part( '/inc/customizer/panels/blog/sections/sidebar' );
