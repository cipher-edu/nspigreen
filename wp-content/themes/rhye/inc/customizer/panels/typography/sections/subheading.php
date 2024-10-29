<?php

$priority = 1;
$choices  = arts_add_fonts_custom_choice();

/**
 * Subheading
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'label'    => esc_html__( 'Subheading', 'rhye' ),
		'settings' => 'subheading_generic_heading' . $priority,
		'section'  => 'subheading',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'      => 'typography',
		'settings'  => 'subheading_font',
		'section'   => 'subheading',
		'default'   => array(
      'font-family'    => 'Raleway',
			'variant'        => '700',
			'line-height'    => 1.3,
			'letter-spacing' => 2,
			'text-transform' => 'uppercase',
		),
		'priority'  => $priority++,
		'choices'   => $choices,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => '.subheading',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'subheading_max_font_size',
		'description' => esc_html__( 'Desktop font size (px)', 'rhye' ),
		'section'     => 'subheading',
		'default'     => 13,
		'priority'    => $priority++,
		'choices'     => array(
			'min'  => 8,
			'max'  => 300,
			'step' => 1,
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--subheading-max-font-size',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'subheading_min_font_size',
		'description' => esc_html__( 'Mobile font size (px)', 'rhye' ),
		'section'     => 'subheading',
		'default'     => 10,
		'priority'    => $priority++,
		'choices'     => array(
			'min'  => 8,
			'max'  => 300,
			'step' => 1,
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--subheading-min-font-size',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'subheading',
		'type'        => 'color',
		'description' => esc_html__( 'Dark Color Preset', 'rhye' ),
		'default'     => '#777777',
		'settings'    => 'subheading_color_dark',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--subheading-color-dark',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'subheading',
		'type'        => 'color',
		'description' => esc_html__( 'Light Color Preset', 'rhye' ),
		'default'     => '#ffffff',
		'settings'    => 'subheading_color_light',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--subheading-color-light',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'par_generic_divider' . $priority,
		'section'  => 'subheading',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);
