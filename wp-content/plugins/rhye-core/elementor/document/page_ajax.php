<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Page Portfolio Navigation in Elementor Document Settings
 */
add_action( 'elementor/element/wp-page/document_settings/after_section_end', 'arts_add_elementor_document_settings_page_ajax' );
add_action( 'elementor/element/wp-post/document_settings/after_section_end', 'arts_add_elementor_document_settings_page_ajax' );
function arts_add_elementor_document_settings_page_ajax( \Elementor\Core\DocumentTypes\PageBase $page ) {
	$page->start_controls_section(
		'page_ajax_section',
		array(
			'label' => esc_html__( 'Page AJAX Transition', 'rhye' ),
			'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
		)
	);

	$page->add_control(
		'page_ajax_to_enabled',
		array(
			'label'   => sprintf(
				'%1s <strong>%2s</strong> %3s',
				esc_html__( 'Enable AJAX Transition', 'rhye' ),
				esc_html__( 'TO', 'rhye' ),
				esc_html__( 'this Page', 'rhye' )
			),
			'type'    => \Elementor\Controls_Manager::SWITCHER,
			'default' => 'yes',
		)
	);

	$page->add_control(
		'page_ajax_to_disabled_notice',
		array(
			'type'            => \Elementor\Controls_Manager::RAW_HTML,
			'raw'             => esc_html__( 'This page will interrupt an active AJAX transition and perform a hard refresh in browser.', 'rhye' ),
			'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			'condition'       => array(
				'page_ajax_to_enabled' => '',
			),
		)
	);

	$page->add_control(
		'page_ajax_from_enabled',
		array(
			'label'   => sprintf(
				'%1s <strong>%2s</strong> %3s',
				esc_html__( 'Enable AJAX Transition', 'rhye' ),
				esc_html__( 'FROM', 'rhye' ),
				esc_html__( 'this Page', 'rhye' )
			),
			'type'    => \Elementor\Controls_Manager::SWITCHER,
			'default' => 'yes',
		)
	);

	$page->add_control(
		'page_ajax_from_disabled_notice',
		array(
			'type'            => \Elementor\Controls_Manager::RAW_HTML,
			'raw'             => esc_html__( 'All the links on this page will perform a hard refresh in browser.', 'rhye' ),
			'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			'condition'       => array(
				'page_ajax_from_enabled' => '',
			),
		)
	);

	$page->end_controls_section();
}
