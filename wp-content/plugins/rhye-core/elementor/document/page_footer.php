<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Page Footer in Elementor Document Settings
 */
add_action( 'elementor/element/wp-page/document_settings/after_section_end', 'arts_add_elementor_document_settings_page_footer' );
add_action( 'elementor/element/wp-post/document_settings/after_section_end', 'arts_add_elementor_document_settings_page_footer' );
function arts_add_elementor_document_settings_page_footer( \Elementor\Core\DocumentTypes\PageBase $page ) {
	$post_id           = get_the_ID();
	$post_type         = get_post_type( $post_id );
	$is_portfolio_item = $post_type === 'arts_portfolio_item';

	$page->start_controls_section(
		'page_footer_section',
		array(
			'label' => esc_html__( 'Page Footer', 'rhye' ),
			'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
		)
	);

	$page->add_control(
		'page_footer_settings_overridden',
		array(
			'label'       => esc_html__( 'Override Page Footer Settings', 'rhye' ),
			'description' => esc_html__( 'Use custom footer settings for this page instead of WordPress Customizer settings', 'rhye' ),
			'type'        => \Elementor\Controls_Manager::SWITCHER,
			'default'     => $is_portfolio_item ? 'yes' : '',
		)
	);

	$page->add_control(
		'page_footer_hide',
		array(
			'label'     => esc_html__( 'Remove Footer from this Page', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SWITCHER,
			'default'   => $is_portfolio_item ? 'yes' : '',
			'condition' => array(
				'page_footer_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_footer_theme',
		array(
			'label'     => esc_html__( 'Color Theme', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'default'   => get_theme_mod( 'footer_theme', 'bg-light-1' ),
			'options'   => ARTS_THEME_COLORS_ARRAY,
			'condition' => array(
				'page_footer_hide!'               => 'yes',
				'page_footer_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_footer_main_theme',
		array(
			'label'     => esc_html__( 'Main Elements Color', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'default'   => get_theme_mod( 'footer_main_theme', 'dark' ),
			'options'   => ARTS_THEME_COLOR_THEMES_ARRAY,
			'condition' => array(
				'page_footer_hide!'               => 'yes',
				'page_footer_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_footer_main_logo',
		array(
			'label'     => esc_html__( 'Logo to Display', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'default'   => get_theme_mod( 'footer_main_logo', 'primary' ),
			'options'   => array(
				'primary'   => esc_html__( 'Primary', 'rhye' ),
				'secondary' => esc_html__( 'Secondary', 'rhye' ),
			),
			'condition' => array(
				'page_footer_hide!'               => 'yes',
				'page_footer_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_footer_border_enabled_upper',
		array(
			'label'     => esc_html__( 'Enable Section Upper Divider', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SWITCHER,
			'return'    => true,
			'default'   => get_theme_mod( 'footer_border_enabled_upper', true ),
			'condition' => array(
				'page_footer_hide!'               => 'yes',
				'page_footer_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_footer_border_enabled_lower',
		array(
			'label'     => esc_html__( 'Enable Section Lower Divider', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SWITCHER,
			'return'    => true,
			'default'   => get_theme_mod( 'footer_border_enabled_lower', true ),
			'condition' => array(
				'page_footer_hide!'               => 'yes',
				'page_footer_settings_overridden' => 'yes',
			),
		)
	);

	$page->end_controls_section();
}
