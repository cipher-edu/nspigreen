<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add new controls to Elementor default "Section" widget
 */
add_action( 'elementor/element/section/section_advanced/before_section_end', 'arts_add_elementor_section_after_controls', 10, 2 );
add_action( 'elementor/element/column/section_advanced/before_section_end', 'arts_add_elementor_section_after_controls', 10, 2 );
add_action( 'elementor/element/container/section_layout/before_section_end', 'arts_add_elementor_section_after_controls', 10, 2 );
function arts_add_elementor_section_after_controls( $control ) {
	$control->add_control(
		'heading_theme',
		array(
			'label'     => esc_html__( 'Extended Theme Options', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		)
	);

	$control->add_control(
		'theme_section_pt',
		array(
			'label'        => esc_html__( 'Padding Top', 'rhye' ),
			'type'         => \Elementor\Controls_Manager::SELECT,
			'default'      => '',
			'options'      => array(
				''          => esc_html__( 'Auto', 'rhye' ),
				'pt-xsmall' => esc_html__( '+ XSmall', 'rhye' ),
				'pt-small'  => esc_html__( '+ Small', 'rhye' ),
				'pt-medium' => esc_html__( '+ Medium', 'rhye' ),
				'pt-large'  => esc_html__( '+ Large', 'rhye' ),
				'pt-xlarge' => esc_html__( '+ XLarge', 'rhye' ),
			),
			'dynamic'      => array(
				'active' => true,
			),
			'prefix_class' => '',
			'classes'      => '',
			'condition'    => array(
				'theme_section_gutters!' => 'container-fluid container-fluid_paddings',
			),
		)
	);

	$control->add_control(
		'theme_section_pb',
		array(
			'label'        => esc_html__( 'Padding Bottom', 'rhye' ),
			'type'         => \Elementor\Controls_Manager::SELECT,
			'default'      => '',
			'options'      => array(
				''          => esc_html__( 'Auto', 'rhye' ),
				'pb-xsmall' => esc_html__( '+ XSmall', 'rhye' ),
				'pb-small'  => esc_html__( '+ Small', 'rhye' ),
				'pb-medium' => esc_html__( '+ Medium', 'rhye' ),
				'pb-large'  => esc_html__( '+ Large', 'rhye' ),
				'pb-xlarge' => esc_html__( '+ XLarge', 'rhye' ),
			),
			'dynamic'      => array(
				'active' => true,
			),
			'prefix_class' => '',
			'classes'      => '',
			'condition'    => array(
				'theme_section_gutters!' => 'container-fluid container-fluid_paddings',
			),
		)
	);

	$control->add_control(
		'theme_section_gutters',
		array(
			'label'        => esc_html__( 'Gutters', 'rhye' ),
			'type'         => \Elementor\Controls_Manager::SELECT,
			'default'      => '',
			'options'      => array(
				''                                         => esc_html__( 'Auto', 'rhye' ),
				'container-fluid'                          => esc_html__( 'Left / Right Only', 'rhye' ),
				'container-fluid container-fluid_paddings' => esc_html__( 'All Sides', 'rhye' ),
			),
			'dynamic'      => array(
				'active' => true,
			),
			'prefix_class' => '',
			'classes'      => '',
		)
	);

	$control->add_control(
		'theme_section_offset_from_bottom',
		array(
			'label'        => esc_html__( 'Offset from Bottom', 'rhye' ),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'return_value' => 'offset_top',
			'default'      => '',
			'dynamic'      => array(
				'active' => true,
			),
			'prefix_class' => '',
			'classes'      => '',
			'condition'    => array(
				'theme_section_pt'  => '',
				'theme_section_pb!' => '',
			),
		)
	);

	$control->add_control(
		'theme_section_offset_from_top',
		array(
			'label'        => esc_html__( 'Offset from Top', 'rhye' ),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'return_value' => 'offset_bottom',
			'default'      => '',
			'dynamic'      => array(
				'active' => true,
			),
			'prefix_class' => '',
			'classes'      => '',
			'condition'    => array(
				'theme_section_pb'  => '',
				'theme_section_pt!' => '',
			),
		)
	);

	$control->add_control(
		'theme_section_mt',
		array(
			'label'        => esc_html__( 'Margin Top', 'rhye' ),
			'type'         => \Elementor\Controls_Manager::SELECT,
			'default'      => '',
			'separator'    => 'before',
			'options'      => array(
				''                => esc_html__( 'Auto', 'rhye' ),
				'mt-xsmall'       => esc_html__( '+ XSmall', 'rhye' ),
				'mt-small'        => esc_html__( '+ Small', 'rhye' ),
				'mt-medium'       => esc_html__( '+ Medium', 'rhye' ),
				'mt-large'        => esc_html__( '+ Large', 'rhye' ),
				'mt-xlarge'       => esc_html__( '+ XLarge', 'rhye' ),
				'mt-minus-xsmall' => esc_html__( '- XSmall', 'rhye' ),
				'mt-minus-small'  => esc_html__( '- Small', 'rhye' ),
				'mt-minus-medium' => esc_html__( '- Medium', 'rhye' ),
				'mt-minus-large'  => esc_html__( '- Large', 'rhye' ),
				'mt-minus-xlarge' => esc_html__( '- XLarge', 'rhye' ),
			),
			'dynamic'      => array(
				'active' => true,
			),
			'prefix_class' => '',
			'classes'      => '',
		)
	);

	$control->add_control(
		'theme_section_mb',
		array(
			'label'        => esc_html__( 'Margin Bottom', 'rhye' ),
			'type'         => \Elementor\Controls_Manager::SELECT,
			'default'      => '',
			'options'      => array(
				''                => esc_html__( 'Auto', 'rhye' ),
				'mb-xsmall'       => esc_html__( '+ XSmall', 'rhye' ),
				'mb-small'        => esc_html__( '+ Small', 'rhye' ),
				'mb-medium'       => esc_html__( '+ Medium', 'rhye' ),
				'mb-large'        => esc_html__( '+ Large', 'rhye' ),
				'mb-xlarge'       => esc_html__( '+ XLarge', 'rhye' ),
				'mb-minus-xsmall' => esc_html__( '- XSmall', 'rhye' ),
				'mb-minus-small'  => esc_html__( '- Small', 'rhye' ),
				'mb-minus-medium' => esc_html__( '- Medium', 'rhye' ),
				'mb-minus-large'  => esc_html__( '- Large', 'rhye' ),
				'mb-minus-xlarge' => esc_html__( '- XLarge', 'rhye' ),
			),
			'dynamic'      => array(
				'active' => true,
			),
			'prefix_class' => '',
			'classes'      => '',
		)
	);

	$control->add_control(
		'theme_section_color',
		array(
			'label'              => esc_html__( 'Color Theme', 'rhye' ),
			'type'               => \Elementor\Controls_Manager::SELECT,
			'separator'          => 'before',
			'default'            => '',
			'options'            => array(
				''           => esc_html__( 'Auto', 'rhye' ),
				'bg-dark-1'  => esc_html__( 'Dark 1', 'rhye' ),
				'bg-dark-2'  => esc_html__( 'Dark 2', 'rhye' ),
				'bg-dark-3'  => esc_html__( 'Dark 3', 'rhye' ),
				'bg-dark-4'  => esc_html__( 'Dark 4', 'rhye' ),
				'bg-light-1' => esc_html__( 'Light 1', 'rhye' ),
				'bg-light-2' => esc_html__( 'Light 2', 'rhye' ),
				'bg-light-3' => esc_html__( 'Light 3', 'rhye' ),
				'bg-light-4' => esc_html__( 'Light 4', 'rhye' ),
				'bg-white'   => esc_html__( 'White', 'rhye' ),
				'bg-gray-1'  => esc_html__( 'Gray 1', 'rhye' ),
				'bg-gray-2'  => esc_html__( 'Gray 2', 'rhye' ),
			),
			'prefix_class'       => '',
			'classes'            => '{{WRAPPER}}',
			'frontend_available' => true,
		)
	);

	$control->add_control(
		'theme_section_main_theme_text',
		array(
			'label'              => esc_html__( 'Main Elements Color', 'rhye' ),
			'type'               => Elementor\Controls_Manager::SELECT,
			'default'            => '',
			'options'            => array(
				''                           => esc_html__( 'Auto', 'rhye' ),
				'arts-elementor-theme-dark'  => esc_html__( 'Dark', 'rhye' ),
				'arts-elementor-theme-light' => esc_html__( 'Light', 'rhye' ),
			),
			'prefix_class'       => '',
			'classes'            => '{{WRAPPER}}',
			'frontend_available' => true,
		)
	);

	$control->add_control(
		'theme_section_color_on_scroll_heading',
		array(
			'label'     => esc_html__( 'On Scroll Color Theme', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => array(
				'theme_section_switch_theme_enabled' => 'section-scroll',
			),
		)
	);

	$control->add_control(
		'theme_section_switch_theme_enabled',
		array(
			'label'              => esc_html__( 'Switch Color Theme on Scroll', 'rhye' ),
			'type'               => \Elementor\Controls_Manager::SWITCHER,
			'default'            => '',
			'return_value'       => 'section-scroll',
			'prefix_class'       => '',
			'classes'            => '{{WRAPPER}}',
			'frontend_available' => true,
		)
	);

	$control->add_control(
		'theme_section_switch_theme_trigger_hook',
		array(
			'label'              => esc_html__( 'Scroll Trigger Hook', 'rhye' ),
			'description'        => esc_html__( 'A float number between 0 and 1 defining the position of the trigger Hook in relation to the viewport.', 'rhye' ),
			'type'               => \Elementor\Controls_Manager::SLIDER,
			'size_units'         => array( 'px' ),
			'range'              => array(
				'px' => array(
					'min'  => 0,
					'max'  => 1,
					'step' => 0.01,
				),
			),
			'default'            => array(
				'unit' => 'px',
				'size' => 0.8,
			),
			'condition'          => array(
				'theme_section_switch_theme_enabled' => 'section-scroll',
			),
			'render_type'        => 'none',
			'frontend_available' => true,
		)
	);

	$control->add_control(
		'theme_section_switch_theme_offset',
		array(
			'label'              => esc_html__( 'Scroll Trigger Offset (px)', 'rhye' ),
			'type'               => \Elementor\Controls_Manager::SLIDER,
			'size_units'         => array( 'px' ),
			'range'              => array(
				'px' => array(
					'min'  => -1000,
					'max'  => 1000,
					'step' => 5,
				),
			),
			'default'            => array(
				'unit' => 'px',
				'size' => 300,
			),
			'condition'          => array(
				'theme_section_switch_theme_enabled' => 'section-scroll',
			),
			'render_type'        => 'none',
			'frontend_available' => true,
		)
	);

	$control->add_control(
		'theme_section_color_on_scroll',
		array(
			'label'              => esc_html__( 'On Scroll: Color Theme', 'rhye' ),
			'type'               => \Elementor\Controls_Manager::SELECT,
			'default'            => '',
			'options'            => array(
				''           => esc_html__( 'Auto', 'rhye' ),
				'bg-dark-1'  => esc_html__( 'Dark 1', 'rhye' ),
				'bg-dark-2'  => esc_html__( 'Dark 2', 'rhye' ),
				'bg-dark-3'  => esc_html__( 'Dark 3', 'rhye' ),
				'bg-dark-4'  => esc_html__( 'Dark 4', 'rhye' ),
				'bg-light-1' => esc_html__( 'Light 1', 'rhye' ),
				'bg-light-2' => esc_html__( 'Light 2', 'rhye' ),
				'bg-light-3' => esc_html__( 'Light 3', 'rhye' ),
				'bg-light-4' => esc_html__( 'Light 4', 'rhye' ),
				'bg-white'   => esc_html__( 'White', 'rhye' ),
				'bg-gray-1'  => esc_html__( 'Gray 1', 'rhye' ),
				'bg-gray-2'  => esc_html__( 'Gray 2', 'rhye' ),
			),
			'condition'          => array(
				'theme_section_switch_theme_enabled' => 'section-scroll',
			),
			'render_type'        => 'none',
			'frontend_available' => true,
		)
	);

	$control->add_control(
		'theme_section_main_theme_text_on_scroll',
		array(
			'label'              => esc_html__( 'On Scroll: Main Elements Color', 'rhye' ),
			'type'               => Elementor\Controls_Manager::SELECT,
			'default'            => '',
			'options'            => array(
				''                           => esc_html__( 'Auto', 'rhye' ),
				'arts-elementor-theme-dark'  => esc_html__( 'Dark', 'rhye' ),
				'arts-elementor-theme-light' => esc_html__( 'Light', 'rhye' ),
			),
			'condition'          => array(
				'theme_section_switch_theme_enabled' => 'section-scroll',
			),
			'render_type'        => 'none',
			'frontend_available' => true,
		)
	);

	$control->add_control(
		'theme_section_unite_inner_galleries',
		array(
			'label'        => esc_html__( 'Unite Inner Image Galleries', 'rhye' ),
			'description'  => esc_html__( 'If the section contains multiple galleries inside, this option will enable a pass-through navigation between them in lightbox.', 'rhye' ),
			'type'         => Elementor\Controls_Manager::SWITCHER,
			'default'      => '',
			'return_value' => 'js-gallery-united',
			'prefix_class' => '',
			'classes'      => '{{WRAPPER}}',
			'separator'    => 'before',
		)
	);
}

add_action( 'elementor/element/after_add_attributes', 'arts_add_elementor_section_attributes' );
function arts_add_elementor_section_attributes( Elementor\Element_Base $element ) {
	if ( $element instanceof Elementor\Element_Section || $element instanceof Elementor\Includes\Elements\Container ) {
		$settings = $element->get_settings_for_display();

		if ( $settings['theme_section_switch_theme_enabled'] ) {
				$element->add_render_attribute(
					'_wrapper',
					array(
						'data-arts-default-theme'       => $settings['theme_section_color'],
						'data-arts-default-color'       => $settings['theme_section_main_theme_text'],
						'data-arts-scroll-theme'        => $settings['theme_section_color_on_scroll'],
						'data-arts-scroll-color'        => $settings['theme_section_main_theme_text_on_scroll'],
						'data-arts-scroll-offset'       => $settings['theme_section_switch_theme_offset']['size'],
						'data-arts-scroll-trigger-hook' => $settings['theme_section_switch_theme_trigger_hook']['size'],
					)
				);
		}
	}
}
