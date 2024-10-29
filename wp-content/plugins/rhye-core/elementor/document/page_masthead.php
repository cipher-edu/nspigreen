<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Page Masthead in Elementor Document Settings
 */
add_action( 'elementor/element/wp-page/document_settings/after_section_end', 'arts_add_elementor_document_settings_page_masthead' );
add_action( 'elementor/element/wp-post/document_settings/after_section_end', 'arts_add_elementor_document_settings_page_masthead' );
function arts_add_elementor_document_settings_page_masthead( \Elementor\Core\DocumentTypes\PageBase $page ) {
	$background_position_control_condition = array(
		'relation' => 'or',
		'terms'    => array(
			array(
				'terms' => array(
					array(
						'name'     => 'page_masthead_layout',
						'operator' => '!==',
						'value'    => 'none',
					),
					array(
						'name'  => 'page_masthead_image_placement',
						'value' => 'background',
					),
				),
			),
			array(
				'terms' => array(
					array(
						'name'  => 'page_masthead_layout',
						'value' => 'fullscreen',
					),
				),
			),
			array(
				'terms' => array(
					array(
						'name'  => 'page_masthead_layout',
						'value' => 'halfscreen-image-left',
					),
				),
			),
			array(
				'terms' => array(
					array(
						'name'  => 'page_masthead_layout',
						'value' => 'halfscreen-image-left-properties',
					),
				),
			),
			array(
				'terms' => array(
					array(
						'name'  => 'page_masthead_layout',
						'value' => 'halfscreen-image-right',
					),
				),
			),
			array(
				'terms' => array(
					array(
						'name'  => 'page_masthead_layout',
						'value' => 'halfscreen-image-right-properties',
					),
				),
			),
		),
	);

	/**
	 * Page Masthead Settings
	 */
	$page->start_controls_section(
		'page_masthead_section',
		array(
			'label' => esc_html__( 'Page Masthead', 'rhye' ),
			'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
		)
	);

	$page->add_control(
		'page_masthead_layout',
		array(
			'label'   => esc_html__( 'Layout', 'rhye' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => array(
				'none'                              => esc_html__( 'Hide Background', 'rhye' ),
				'beneath'                           => esc_html__( 'Background Beneath Content', 'rhye' ),
				'fullscreen'                        => esc_html__( 'Fullscreen', 'rhye' ),
				'halfscreen-image-left'             => esc_html__( 'Halfscreen / Image Left / Content Right', 'rhye' ),
				'halfscreen-image-left-properties'  => esc_html__( 'Halfscreen / Image Left / Content Left / Properties Right', 'rhye' ),
				'halfscreen-image-right'            => esc_html__( 'Halfscreen / Image Right / Content Left', 'rhye' ),
				'halfscreen-image-right-properties' => esc_html__( 'Halfscreen / Image Right / Content Right / Properties Left', 'rhye' ),
			),
			'default' => 'beneath',
		)
	);

	$page->add_control(
		'page_masthead_fullscreen_fixed_enabled',
		array(
			'label'     => esc_html__( 'Enable Fixed Layout', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SWITCHER,
			'default'   => '',
			'condition' => array(
				'page_masthead_layout' => 'fullscreen',
			),
		)
	);

	$page->add_control(
		'page_masthead_fullscreen_fixed_speed',
		array(
			'label'     => esc_html__( 'Scene Duration Multiplier', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SLIDER,
			'range'     => array(
				'factor' => array(
					'min'  => 0.1,
					'max'  => 2,
					'step' => 0.01,
				),
			),
			'default'   => array(
				'unit' => 'factor',
				'size' => 0.2,
			),
			'condition' => array(
				'page_masthead_layout'                   => 'fullscreen',
				'page_masthead_fullscreen_fixed_enabled' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_masthead_heading_content',
		array(
			'label'     => esc_html__( 'Content', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		)
	);

	$page->add_control(
		'page_masthead_content_alignment',
		array(
			'label'   => esc_html__( 'Alignment', 'rhye' ),
			'type'    => \Elementor\Controls_Manager::CHOOSE,
			'options' => array(
				'text-left'   => array(
					'title' => esc_html__( 'Left', 'rhye' ),
					'icon'  => 'eicon-text-align-left',
				),
				'text-center' => array(
					'title' => esc_html__( 'Center', 'rhye' ),
					'icon'  => 'eicon-text-align-center',
				),
				'text-right'  => array(
					'title' => esc_html__( 'Right', 'rhye' ),
					'icon'  => 'eicon-text-align-right',
				),
			),
			'default' => 'text-center',
			'toggle'  => false,
		)
	);

	$page->add_control(
		'page_masthead_content_container',
		array(
			'label'      => esc_html__( 'Container', 'rhye' ),
			'type'       => \Elementor\Controls_Manager::SELECT,
			'options'    => array(
				'container'       => esc_html__( 'Boxed', 'rhye' ),
				'container-fluid' => esc_html__( 'Fullwidth', 'rhye' ),
			),
			'default'    => 'container-fluid',
			'conditions' => array(
				'relation' => 'or',
				'terms'    => array(
					array(
						'name'     => 'page_masthead_layout',
						'operator' => '!=',
						'value'    => 'yes',
					),
				),
			),
		)
	);

	$page->add_control(
		'page_masthead_content_position',
		array(
			'label'     => esc_html__( 'Position', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::CHOOSE,
			'options'   => array(
				'section-masthead__inner_background-left'  => array(
					'title' => esc_html__( 'Left', 'rhye' ),
					'icon'  => 'eicon-text-align-left',
				),
				''                                         => array(
					'title' => esc_html__( 'Center', 'rhye' ),
					'icon'  => 'eicon-text-align-center',
				),
				'section-masthead__inner_background-right' => array(
					'title' => esc_html__( 'Right', 'rhye' ),
					'icon'  => 'eicon-text-align-right',
				),
			),
			'default'   => 'section-masthead__inner_background-left',
			'toggle'    => false,
			'condition' => array(
				'page_masthead_content_enable_background' => 'yes',
				'page_masthead_layout'                    => 'fullscreen',
			),
		)
	);

	$page->add_control(
		'page_masthead_pt',
		array(
			'label'     => esc_html__( 'Padding Top', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'default'   => 'pt-large',
			'options'   => array(
				''          => esc_html__( 'None', 'rhye' ),
				'pt-xsmall' => esc_html__( '+ XSmall', 'rhye' ),
				'pt-small'  => esc_html__( '+ Small', 'rhye' ),
				'pt-medium' => esc_html__( '+ Medium', 'rhye' ),
				'pt-large'  => esc_html__( '+ Large', 'rhye' ),
				'pt-xlarge' => esc_html__( '+ XLarge', 'rhye' ),
			),
			'condition' => array(
				'page_masthead_layout!' => 'fullscreen',
			),
		)
	);

	$page->add_control(
		'page_masthead_pb',
		array(
			'label'     => esc_html__( 'Padding Bottom', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'default'   => 'pb-medium',
			'options'   => array(
				''          => esc_html__( 'None', 'rhye' ),
				'pb-xsmall' => esc_html__( '+ XSmall', 'rhye' ),
				'pb-small'  => esc_html__( '+ Small', 'rhye' ),
				'pb-medium' => esc_html__( '+ Medium', 'rhye' ),
				'pb-large'  => esc_html__( '+ Large', 'rhye' ),
				'pb-xlarge' => esc_html__( '+ XLarge', 'rhye' ),
			),
			'condition' => array(
				'page_masthead_layout!' => 'fullscreen',
			),
		)
	);

	$page->add_control(
		'page_masthead_mt',
		array(
			'label'     => esc_html__( 'Margin Top', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'default'   => '',
			'options'   => array(
				''          => esc_html__( 'None', 'rhye' ),
				'mt-xsmall' => esc_html__( '+ XSmall', 'rhye' ),
				'mt-small'  => esc_html__( '+ Small', 'rhye' ),
				'mt-medium' => esc_html__( '+ Medium', 'rhye' ),
				'mt-large'  => esc_html__( '+ Large', 'rhye' ),
				'mt-xlarge' => esc_html__( '+ XLarge', 'rhye' ),
			),
			'condition' => array(
				'page_masthead_layout!' => 'fullscreen',
			),
		)
	);

	$page->add_control(
		'page_masthead_mb',
		array(
			'label'     => esc_html__( 'Margin Bottom', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'default'   => '',
			'options'   => array(
				''          => esc_html__( 'None', 'rhye' ),
				'mb-xsmall' => esc_html__( '+ XSmall', 'rhye' ),
				'mb-small'  => esc_html__( '+ Small', 'rhye' ),
				'mb-medium' => esc_html__( '+ Medium', 'rhye' ),
				'mb-large'  => esc_html__( '+ Large', 'rhye' ),
				'mb-xlarge' => esc_html__( '+ XLarge', 'rhye' ),
			),
			'condition' => array(
				'page_masthead_layout!' => 'fullscreen',
			),
		)
	);

	$page->add_control(
		'page_masthead_heading_image',
		array(
			'label'     => esc_html__( 'Background', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => array(
				'page_masthead_layout!' => 'none',
			),
		)
	);

	$page->add_control(
		'page_masthead_image_placement',
		array(
			'label'     => esc_html__( 'Element Placement', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::CHOOSE,
			'options'   => array(
				'image'      => array(
					'title' => esc_html__( 'Preserve Aspect Ratio', 'rhye' ),
					'icon'  => 'eicon-image-before-after',
				),
				'background' => array(
					'title' => esc_html__( 'Cover Background', 'rhye' ),
					'icon'  => 'eicon-image',
				),
			),
			'default'   => 'background',
			'toggle'    => false,
			'condition' => array(
				'page_masthead_layout' => 'beneath',
			),
		)
	);

	$page->add_responsive_control(
		'page_masthead_image_width',
		array(
			'label'           => esc_html__( 'Maximum Width', 'rhye' ),
			'type'            => \Elementor\Controls_Manager::SLIDER,
			'desktop_default' => array(
				'size' => 100,
				'unit' => '%',
			),
			'tablet_default'  => array(
				'size' => 100,
				'unit' => '%',
			),
			'mobile_default'  => array(
				'size' => 100,
				'unit' => '%',
			),
			'range'           => array(
				'px' => array(
					'min' => 0,
					'max' => 1440,
				),
				'%'  => array(
					'min' => 0,
					'max' => 100,
				),
			),
			'size_units'      => array( 'px', '%' ),
			'selectors'       => array(
				'{{WRAPPER}} .section-masthead .section-masthead__background' => 'max-width: {{SIZE}}{{UNIT}};',
			),
			'condition'       => array(
				'page_masthead_layout'           => 'beneath',
				'page_masthead_image_placement'  => 'image',
				'page_masthead_image_alignment!' => 'w-100',
			),
		)
	);

	$page->add_responsive_control(
		'page_masthead_image_height',
		array(
			'label'           => esc_html__( 'Height', 'rhye' ),
			'type'            => \Elementor\Controls_Manager::SLIDER,
			'desktop_default' => array(
				'size' => 900,
				'unit' => 'px',
			),
			'tablet_default'  => array(
				'size' => 70,
				'unit' => 'vh',
			),
			'mobile_default'  => array(
				'size' => 50,
				'unit' => 'vh',
			),
			'range'           => array(
				'px' => array(
					'min' => 0,
					'max' => 1440,
				),
				'vh' => array(
					'min' => 0,
					'max' => 100,
				),
			),
			'size_units'      => array( 'px', 'vh' ),
			'selectors'       => array(
				'{{WRAPPER}} .section-masthead .section-masthead__background' => 'height: {{SIZE}}{{UNIT}};',
			),
			'condition'       => array(
				'page_masthead_layout'          => 'beneath',
				'page_masthead_image_placement' => 'background',
			),
		)
	);

	$background_position_selectors = arts_elementor_should_selectors_have_responsive_prefixes() ? array(
		'(desktop){{WRAPPER}} .section-masthead .section-masthead__background img.of-cover' => 'object-position: {{page_masthead_background_position_x.SIZE}}{{page_masthead_background_position_x.UNIT}} {{page_masthead_background_position_y.SIZE}}{{page_masthead_background_position_y.UNIT}};',
		'(tablet){{WRAPPER}} .section-masthead .section-masthead__background img.of-cover' => 'object-position: {{page_masthead_background_position_x_tablet.SIZE}}{{page_masthead_background_position_x_tablet.UNIT}} {{page_masthead_background_position_y_tablet.SIZE}}{{page_masthead_background_position_y_tablet.UNIT}};',
		'(mobile){{WRAPPER}} .section-masthead .section-masthead__background img.of-cover' => 'object-position: {{page_masthead_background_position_x_mobile.SIZE}}{{page_masthead_background_position_x_mobile.UNIT}} {{page_masthead_background_position_y_mobile.SIZE}}{{page_masthead_background_position_y_mobile.UNIT}};',
	) : array(
		'{{WRAPPER}} .section-masthead .section-masthead__background img.of-cover' => 'object-position: {{page_masthead_background_position_x.SIZE}}{{page_masthead_background_position_x.UNIT}} {{page_masthead_background_position_y.SIZE}}{{page_masthead_background_position_y.UNIT}};',
	);
	$page->add_responsive_control(
		'page_masthead_background_position_x',
		array(
			'label'           => esc_html__( 'Background Position X', 'rhye' ),
			'type'            => \Elementor\Controls_Manager::SLIDER,
			'desktop_default' => array(
				'size' => 50,
				'unit' => '%',
			),
			'tablet_default'  => array(
				'size' => 50,
				'unit' => '%',
			),
			'mobile_default'  => array(
				'size' => 50,
				'unit' => '%',
			),
			'range'           => array(
				'%' => array(
					'min' => 0,
					'max' => 100,
				),
			),
			'size_units'      => array( '%' ),
			'selectors'       => $background_position_selectors,
			'conditions'      => $background_position_control_condition,
		)
	);

	$page->add_responsive_control(
		'page_masthead_background_position_y',
		array(
			'label'           => esc_html__( 'Background Position Y', 'rhye' ),
			'type'            => \Elementor\Controls_Manager::SLIDER,
			'desktop_default' => array(
				'size' => 50,
				'unit' => '%',
			),
			'tablet_default'  => array(
				'size' => 50,
				'unit' => '%',
			),
			'mobile_default'  => array(
				'size' => 50,
				'unit' => '%',
			),
			'range'           => array(
				'%' => array(
					'min' => 0,
					'max' => 100,
				),
			),
			'size_units'      => array( '%' ),
			'selectors'       => $background_position_selectors,
			'conditions'      => $background_position_control_condition,
			'condition'       => array(
				'page_masthead_image_placement' => 'background',
				'page_masthead_layout!'         => 'none',
			),
		)
	);

	$page->add_control(
		'page_masthead_image_alignment',
		array(
			'label'     => esc_html__( 'Alignment', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::CHOOSE,
			'options'   => array(
				'w-100'                     => array(
					'title' => esc_html__( 'Fullwidth', 'rhye' ),
					'icon'  => 'eicon-h-align-stretch',
				),
				'section_w-container-left'  => array(
					'title' => esc_html__( 'Left', 'rhye' ),
					'icon'  => 'eicon-h-align-left',
				),
				'container'                 => array(
					'title' => esc_html__( 'Center', 'rhye' ),
					'icon'  => 'eicon-h-align-center',
				),
				'section_w-container-right' => array(
					'title' => esc_html__( 'Right', 'rhye' ),
					'icon'  => 'eicon-h-align-right',
				),
			),
			'default'   => 'w-100',
			'condition' => array(
				'page_masthead_layout' => 'beneath',
			),
			'toggle'    => false,
		)
	);

	$page->add_control(
		'page_masthead_image_gutters_enabled',
		array(
			'label'     => esc_html__( 'Enable Background Gutters', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SWITCHER,
			'default'   => '',
			'condition' => array(
				'page_masthead_layout' => array( 'halfscreen-image-left', 'halfscreen-image-right' ),
			),
		)
	);

	$page->add_control(
		'page_masthead_image_parallax_enabled',
		array(
			'label'     => esc_html__( 'Enable Parallax', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SWITCHER,
			'default'   => 'yes',
			'condition' => array(
				'page_masthead_layout!' => 'none',
			),
		)
	);

	$page->add_control(
		'page_masthead_image_parallax_speed',
		array(
			'label'     => esc_html__( 'Parallax Speed', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SLIDER,
			'range'     => array(
				'factor' => array(
					'min'  => -0.5,
					'max'  => 0.5,
					'step' => 0.01,
				),
			),
			'default'   => array(
				'unit' => 'factor',
				'size' => 0.1,
			),
			'condition' => array(
				'page_masthead_image_parallax_enabled' => 'yes',
				'page_masthead_layout!'                => 'none',
			),
		)
	);

	/**
	 * Overlay
	 */
	$page->add_control(
		'page_masthead_heading_overlay',
		array(
			'label'     => esc_html__( 'Overlay', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => array(
				'page_masthead_layout' => array( 'fullscreen', 'halfscreen-image-left-properties', 'halfscreen-image-right-properties' ),
			),
		)
	);

	$page->add_group_control(
		\Elementor\Group_Control_Background::get_type(),
		array(
			'name'      => 'page_masthead_background_overlay',
			'selector'  => '.section-masthead .section-masthead__overlay',
			'condition' => array(
				'page_masthead_layout' => array( 'fullscreen', 'halfscreen-image-left-properties', 'halfscreen-image-right-properties' ),
			),
		)
	);

	$page->add_control(
		'page_masthead_background_overlay_dither_enabled',
		array(
			'label'        => esc_html__( 'Enable Dither', 'rhye' ),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'return_value' => 'overlay_dither',
			'default'      => 'overlay_dither',
			'condition'    => array(
				'page_masthead_layout' => array( 'fullscreen', 'halfscreen-image-left-properties', 'halfscreen-image-right-properties' ),
			),
		)
	);

	$page->add_control(
		'page_masthead_background_overlay_dither_opacity',
		array(
			'label'     => esc_html__( 'Dither Opacity', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SLIDER,
			'default'   => array(
				'size' => .2,
			),
			'range'     => array(
				'px' => array(
					'max'  => 1,
					'step' => 0.01,
				),
			),
			'selectors' => array(
				'{{WRAPPER}} .section-masthead .section-masthead__overlay:before' => 'opacity: {{SIZE}};',
			),
			'condition' => array(
				'page_masthead_layout' => array( 'fullscreen', 'halfscreen-image-left-properties', 'halfscreen-image-right-properties' ),
				'page_masthead_background_overlay_dither_enabled' => 'overlay_dither',
			),
		)
	);

	$page->add_control(
		'page_masthead_heading_themes',
		array(
			'label'     => esc_html__( 'Color Theme', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		)
	);

	$page->add_control(
		'page_masthead_background_image',
		array(
			'label'     => esc_html__( 'Image Background Color', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'default'   => '',
			'options'   => ARTS_THEME_COLORS_ARRAY,
			'condition' => array(
				'page_masthead_layout' => array( 'halfscreen-image-left', 'halfscreen-image-right' ),
			),
		)
	);

	$page->add_control(
		'page_masthead_background',
		array(
			'label'   => esc_html__( 'Transition & Background Color', 'rhye' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'default' => '',
			'options' => ARTS_THEME_COLORS_ARRAY,
		)
	);

	$page->add_control(
		'page_masthead_theme',
		array(
			'label'   => esc_html__( 'Main Elements Color', 'rhye' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'default' => 'dark',
			'options' => ARTS_THEME_COLOR_THEMES_ARRAY,
		)
	);

	$page->add_control(
		'page_masthead_heading_typography',
		array(
			'label'     => esc_html__( 'Typography', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		)
	);

	$page->add_control(
		'page_masthead_heading_preset',
		array(
			'label'   => esc_html__( 'Heading Preset', 'rhye' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'default' => 'h1',
			'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
		)
	);

	$page->add_control(
		'page_masthead_subheading_preset',
		array(
			'label'     => esc_html__( 'Category / Subheading Preset', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'default'   => 'subheading',
			'options'   => ARTS_THEME_TYPOGRAHY_ARRAY,
			'condition' => array(
				'page_masthead_subheading_enabled' => 'yes',
			),
		)
	);

	$page->add_control(
		'page_masthead_text_preset',
		array(
			'label'     => esc_html__( 'Text Preset', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::SELECT,
			'default'   => 'paragraph',
			'options'   => ARTS_THEME_TYPOGRAHY_ARRAY,
			'condition' => array(
				'page_masthead_text_enabled' => 'yes',
			),
		)
	);

	$page->add_control(
		'heading_additional',
		array(
			'label'     => esc_html__( 'Additional Options', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		)
	);

	$page->add_control(
		'page_masthead_animation_enabled',
		array(
			'label'   => esc_html__( 'Enable On-scroll Animation', 'rhye' ),
			'type'    => \Elementor\Controls_Manager::SWITCHER,
			'default' => 'yes',
		)
	);

	$page->add_control(
		'page_masthead_subheading_enabled',
		array(
			'type'    => \Elementor\Controls_Manager::SWITCHER,
			'label'   => esc_html__( 'Show Category / Subheading', 'rhye' ),
			'default' => 'yes',
		)
	);

	$page->add_control(
		'page_masthead_text_enabled',
		array(
			'type'    => \Elementor\Controls_Manager::SWITCHER,
			'label'   => esc_html__( 'Show Text', 'rhye' ),
			'default' => '',
		)
	);

	$page->add_control(
		'page_masthead_headline_enabled',
		array(
			'type'    => \Elementor\Controls_Manager::SWITCHER,
			'label'   => esc_html__( 'Show Headline', 'rhye' ),
			'default' => 'yes',
		)
	);

	$page->add_control(
		'page_masthead_scroll_down_enabled',
		array(
			'type'      => \Elementor\Controls_Manager::SWITCHER,
			'label'     => esc_html__( 'Show Scroll Down', 'rhye' ),
			'default'   => '',
			'condition' => array(
				'page_masthead_layout' => array( 'fullscreen', 'halfscreen-image-left', 'halfscreen-image-left-properties', 'halfscreen-image-right', 'halfscreen-image-right-properties' ),
			),
		)
	);

	$page->add_control(
		'rhye_hide_title_enabled',
		array(
			'type'      => \Elementor\Controls_Manager::HIDDEN,
			'default'   => '',
			'condition' => array(
				'hide_title' => 'yes',
			),
			'selectors' => array(
				':root {{WRAPPER}}' => '--page-title-display: none',
			),
		)
	);

	$page->add_control(
		'rhye_hide_title_disabled',
		array(
			'type'      => \Elementor\Controls_Manager::HIDDEN,
			'default'   => 'yes',
			'condition' => array(
				'hide_title' => '',
			),
			'selectors' => array(
				':root {{WRAPPER}}' => '--page-title-display: block',
			),
		)
	);

	$page->end_controls_section();
}
