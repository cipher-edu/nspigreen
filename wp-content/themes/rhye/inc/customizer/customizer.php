<?php

if ( ! class_exists( 'Kirki' ) ) {
	return;
}

// Don't gather telemetry data
add_filter( 'kirki_telemetry', '__return_false' );

/**
 * Register extra Customizer panels
 */
add_action( 'after_setup_theme', 'arts_register_customizer_panels' );
function arts_register_customizer_panels() {

	$priority = 1;

	Kirki::add_config(
		'arts',
		array(
			'capability'  => 'edit_theme_options',
			'option_type' => 'theme_mod',
		)
	);

	/**
	 * Panel General Style
	 */
	Kirki::add_panel(
		'general-style',
		array(
			'priority' => $priority++,
			'title'    => esc_html__( 'General Style', 'rhye' ),
			'icon'     => 'dashicons-admin-appearance',
		)
	);
	get_template_part( '/inc/customizer/panels/general-style/general-style' );

	/**
	 * Panel Typography
	 */
	Kirki::add_panel(
		'typography',
		array(
			'priority' => $priority++,
			'title'    => esc_html__( 'Typography', 'rhye' ),
			'icon'     => 'dashicons-editor-paragraph',
		)
	);
	get_template_part( '/inc/customizer/panels/typography/typography' );

	/**
	 * Panel Options
	 */
	Kirki::add_panel(
		'theme_options',
		array(
			'priority' => $priority++,
			'title'    => esc_html__( 'Theme Options', 'rhye' ),
			'icon'     => 'dashicons-admin-tools',
		)
	);
	get_template_part( '/inc/customizer/panels/theme-options/theme-options' );

	/**
	 * Panel Header
	 */
	Kirki::add_panel(
		'header',
		array(
			'priority' => $priority++,
			'title'    => esc_html__( 'Header', 'rhye' ),
			'icon'     => 'dashicons-arrow-up-alt',
		)
	);
	get_template_part( '/inc/customizer/panels/header/header' );

	/**
	 * Panel Footer
	 */
	Kirki::add_panel(
		'footer',
		array(
			'priority' => $priority++,
			'title'    => esc_html__( 'Footer', 'rhye' ),
			'icon'     => 'dashicons-arrow-down-alt',
		)
	);
	get_template_part( '/inc/customizer/panels/footer/footer' );

	/**
	 * Panel Pages
	 */
	Kirki::add_panel(
		'pages',
		array(
			'title'    => esc_html__( 'Pages', 'rhye' ),
			'priority' => $priority++,
			'icon'     => 'dashicons-media-document',
		)
	);
	get_template_part( '/inc/customizer/panels/pages/pages' );

	/**
	 * Panel Blog
	 */
	Kirki::add_panel(
		'blog',
		array(
			'priority' => $priority++,
			'title'    => esc_html__( 'Blog', 'rhye' ),
			'icon'     => 'dashicons-editor-bold',
		)
	);
	get_template_part( '/inc/customizer/panels/blog/blog' );

	/**
	 * Extend Title & Tagline Section
	 */
	get_template_part( 'inc/customizer/title-tagline/title-tagline' );

}
