<?php

$priority = 1;
$choices  = arts_add_fonts_custom_choice();

/**
 * XXL
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'label'    => esc_html__( 'Heading XXL', 'rhye' ),
		'settings' => 'xl_generic_heading' . $priority,
		'section'  => 'xl_headings',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'      => 'typography',
		'settings'  => 'xxl_font',
		'section'   => 'xl_headings',
		'default'   => array(
			'font-family'    => 'Cinzel',
			'variant'        => 'regular',
			'line-height'    => 1.00,
			'letter-spacing' => 0,
			'text-transform' => 'none',
		),
		'priority'  => $priority++,
		'choices'   => $choices,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => '.xxl',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'xxl_max_font_size',
		'description' => esc_html__( 'Desktop font size (px)', 'rhye' ),
		'section'     => 'xl_headings',
		'default'     => 287,
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
				'property' => '--xxl-max-font-size',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'xxl_min_font_size',
		'description' => esc_html__( 'Mobile font size (px)', 'rhye' ),
		'section'     => 'xl_headings',
		'default'     => 60,
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
				'property' => '--xxl-min-font-size',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'xl_headings',
		'type'        => 'color',
		'description' => esc_html__( 'Dark Color Preset', 'rhye' ),
		'default'     => '#333333',
		'settings'    => 'xxl_color_dark',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--xxl-color-dark',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'xl_headings',
		'type'        => 'color',
		'description' => esc_html__( 'Light Color Preset', 'rhye' ),
		'default'     => '#eeece6',
		'settings'    => 'xxl_color_light',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--xxl-color-light',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'xl_generic_divider' . $priority,
		'section'  => 'xl_headings',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);

/**
 * XL
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'label'    => esc_html__( 'Heading XL', 'rhye' ),
		'settings' => 'xl_generic_heading' . $priority,
		'section'  => 'xl_headings',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'      => 'typography',
		'settings'  => 'xl_font',
		'section'   => 'xl_headings',
		'default'   => array(
			'font-family'    => 'Cinzel',
			'variant'        => 'regular',
			'line-height'    => 1.1,
			'letter-spacing' => 0,
			'text-transform' => 'none',
		),
		'priority'  => $priority++,
		'choices'   => $choices,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => '.xl',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'xl_max_font_size',
		'description' => esc_html__( 'Desktop font size (px)', 'rhye' ),
		'section'     => 'xl_headings',
		'default'     => 162,
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
				'property' => '--xl-max-font-size',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'xl_min_font_size',
		'description' => esc_html__( 'Mobile font size (px)', 'rhye' ),
		'section'     => 'xl_headings',
		'default'     => 54,
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
				'property' => '--xl-min-font-size',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'xl_headings',
		'type'        => 'color',
		'description' => esc_html__( 'Dark Color Preset', 'rhye' ),
		'default'     => '#333333',
		'settings'    => 'xl_color_dark',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--xl-color-dark',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'xl_headings',
		'type'        => 'color',
		'description' => esc_html__( 'Light Color Preset', 'rhye' ),
		'default'     => '#eeece6',
		'settings'    => 'xl_color_light',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--xl-color-light',
			),
		),
	)
);
