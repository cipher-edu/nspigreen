<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Page Header in Elementor Document Settings
 */
add_action( 'elementor/element/wp-page/document_settings/after_section_end', 'arts_add_elementor_document_settings_page_header' );
add_action( 'elementor/element/wp-post/document_settings/after_section_end', 'arts_add_elementor_document_settings_page_header' );
function arts_add_elementor_document_settings_page_header( \Elementor\Core\DocumentTypes\PageBase $page ) {
	$menu_style = get_theme_mod( 'menu_style', 'classic' );

	$page->start_controls_section(
		'page_header_section',
		array(
			'label' => esc_html__( 'Page Header', 'rhye' ),
			'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
		)
	);

	$page->add_control(
		'page_header_settings_overridden',
		array(
			'label'       => esc_html__( 'Override Page Header Settings', 'rhye' ),
			'description' => esc_html__( 'Use custom header settings for this page instead of WordPress Customizer settings', 'rhye' ),
			'type'        => \Elementor\Controls_Manager::SWITCHER,
			'default'     => '',
		)
	);

	$page->add_control(
		'page_header_main_theme',
		array(
			'label'     => esc_html__( 'Main Elements Color', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'default'   => 'dark',
			'options'   => ARTS_THEME_COLOR_THEMES_ARRAY,
			'condition' => array(
				'page_header_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_header_main_logo',
		array(
			'label'     => esc_html__( 'Main Logo to Display', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'default'   => 'primary',
			'options'   => array(
				'primary'   => esc_html__( 'Primary', 'rhye' ),
				'secondary' => esc_html__( 'Secondary', 'rhye' ),
			),
			'condition' => array(
				'page_header_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_header_sticky_theme',
		array(
			'label'     => esc_html__( 'Sticky Background Color', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'default'   => 'bg-dark-1',
			'options'   => ARTS_THEME_COLORS_ARRAY,
			'condition' => array(
				'page_header_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_header_sticky_logo',
		array(
			'label'     => esc_html__( 'Sticky Logo to Display', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'default'   => 'secondary',
			'options'   => array(
				'primary'   => esc_html__( 'Primary', 'rhye' ),
				'secondary' => esc_html__( 'Secondary', 'rhye' ),
			),
			'condition' => array(
				'page_header_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_header_heading_overlay_menu',
		array(
			'label'     => $menu_style === 'classic' ? esc_html__( 'Mobile Overlay Menu', 'rhye' ) : esc_html__( 'Overlay Menu', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => array(
				'page_header_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_header_overlay_menu_theme',
		array(
			'label'     => $menu_style === 'classic' ? esc_html__( 'Mobile Overlay Theme Elements', 'rhye' ) : esc_html__( 'Overlay Theme Elements', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'default'   => 'light',
			'options'   => ARTS_THEME_COLOR_THEMES_ARRAY,
			'condition' => array(
				'page_header_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_menu_overlay_background_color',
		array(
			'label'     => $menu_style === 'classic' ? esc_html__( 'Mobile Overlay Background', 'rhye' ) : esc_html__( 'Overlay Background', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::COLOR,
			'default'   => get_theme_mod( 'menu_overlay_background_color', 'rgba(0,0,0,1)' ),
			'condition' => array(
				'page_header_settings_overridden' => 'yes',
			),
		)
	);

	$page->end_controls_section();
}
