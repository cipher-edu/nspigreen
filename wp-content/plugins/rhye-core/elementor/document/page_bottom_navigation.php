<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Page Bottom Navigation in Elementor Document Settings
 */
add_action( 'elementor/element/wp-page/document_settings/after_section_end', 'arts_add_elementor_document_settings_page_bottom_navigation' );
add_action( 'elementor/element/wp-post/document_settings/after_section_end', 'arts_add_elementor_document_settings_page_bottom_navigation' );
function arts_add_elementor_document_settings_page_bottom_navigation( \Elementor\Core\DocumentTypes\PageBase $page ) {
	$page->start_controls_section(
		'page_portfolio_nav_section',
		array(
			'label' => esc_html__( 'Page Bottom Navigation', 'rhye' ),
			'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
		)
	);

	$page->add_control(
		'page_portfolio_nav_settings_overridden',
		array(
			'label'       => esc_html__( 'Override Page Bottom Navigation Settings', 'rhye' ),
			'description' => esc_html__( 'Use custom bottom navigation settings for this page instead of WordPress Customizer settings', 'rhye' ),
			'type'        => \Elementor\Controls_Manager::SWITCHER,
			'default'     => '',
		)
	);

	$page->add_control(
		'page_portfolio_nav_heading_color_theme',
		array(
			'label'     => esc_html__( 'Color Theme', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => array(
				'page_portfolio_nav_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_portfolio_nav_background',
		array(
			'label'     => esc_html__( 'Background Color', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'default'   => get_theme_mod( 'portfolio_nav_background', 'bg-light-1' ),
			'options'   => ARTS_THEME_COLORS_ARRAY,
			'condition' => array(
				'page_portfolio_nav_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_portfolio_nav_theme',
		array(
			'label'     => esc_html__( 'Main Elements Color', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'default'   => get_theme_mod( 'portfolio_nav_theme', 'dark' ),
			'options'   => ARTS_THEME_COLOR_THEMES_ARRAY,
			'condition' => array(
				'page_portfolio_nav_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_portfolio_nav_divider_enabled',
		array(
			'label'        => esc_html__( 'Enable Section Divider', 'rhye' ),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'default'      => get_theme_mod( 'portfolio_nav_divider_enabled', true ),
			'return_value' => true,
			'condition'    => array(
				'page_portfolio_nav_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_portfolio_nav_heading_prev_next',
		array(
			'label'       => esc_html__( 'Override Previous and Next Posts', 'rhye' ),
			'description' => esc_html__( 'Empty the fields to clear overrides', 'rhye' ),
			'type'        => \Elementor\Controls_Manager::HEADING,
			'separator'   => 'before',
			'condition'   => array(
				'page_portfolio_nav_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_portfolio_nav_previous_post',
		array(
			'label'         => esc_html__( 'Previous Post', 'rhye' ),
			'type'          => \Elementor\Controls_Manager::URL,
			'show_external' => false,
			'options'       => false,
			'autocomplete'  => true,
			'condition'     => array(
				'page_portfolio_nav_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_portfolio_nav_next_post',
		array(
			'label'         => esc_html__( 'Next Post', 'rhye' ),
			'type'          => \Elementor\Controls_Manager::URL,
			'show_external' => false,
			'options'       => false,
			'autocomplete'  => true,
			'condition'     => array(
				'page_portfolio_nav_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_portfolio_nav_internal_urls',
		array(
			'type'            => \Elementor\Controls_Manager::RAW_HTML,
			'raw'             => sprintf(
				'%1$s <strong>%2$s</strong> %3$s.',
				esc_html__( 'Please note that only', 'rhye' ),
				esc_html__( 'internal site URLs', 'rhye' ),
				esc_html( 'are supported for overriding', 'rhye' )
			),
			'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			'condition'       => array(
				'page_portfolio_nav_settings_overridden' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_portfolio_nav_elementor_update_button',
		array(
			'type'      => \Elementor\Controls_Manager::RAW_HTML,
			'raw'       => sprintf(
				"
				<div class=\"elementor-update-preview\">
					<div class=\"elementor-update-preview-title\">%1\$s</div>
					<div class=\"elementor-update-preview-button-wrapper\">
						<button class=\"rhye-reload-preview-button elementor-button elementor-button-success\" style=\"padding: 8px 15px; text-transform: uppercase;\" onclick='javascript:elementor.\$preview.trigger(\"arts/elementor/reload_preview\", {detail: {openedPageAfter: \"page_settings\", openedTabAfter: \"settings\", openedSectionAfter: \"page_portfolio_nav_section\"}});'>%2\$s</button>
					</div>
				</div>
				",
				esc_html__( 'Update changes to page', 'rhye' ),
				esc_html__( 'Apply', 'rhye' )
			),
			'condition' => array(
				'page_portfolio_nav_settings_overridden' => 'yes',
			),
		)
	);

	$page->end_controls_section();
}
