<?php

$priority = 1;
$choices  = arts_add_fonts_custom_choice();

/**
 * h1
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'label'    => esc_html__( 'Heading 1', 'rhye' ),
		'settings' => 'h1_h6_generic_heading' . $priority,
		'section'  => 'h1_h6_headings',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'      => 'typography',
		'settings'  => 'h1_font',
		'section'   => 'h1_h6_headings',
		'default'   => array(
			'font-family'    => 'Cinzel',
			'variant'        => 'regular',
			'line-height'    => 1.13,
			'letter-spacing' => 0,
			'text-transform' => 'none',
		),
		'priority'  => $priority++,
		'choices'   => $choices,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => 'h1, .h1',
			)
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'h1_max_font_size',
		'description' => esc_html__( 'Desktop font size (px)', 'rhye' ),
		'section'     => 'h1_h6_headings',
		'default'     => 88,
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
				'property' => '--h1-max-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--h1-max-font-size',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'h1_min_font_size',
		'description' => esc_html__( 'Mobile font size (px)', 'rhye' ),
		'section'     => 'h1_h6_headings',
		'default'     => 35,
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
				'property' => '--h1-min-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--h1-min-font-size',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'h1_h6_headings',
		'type'        => 'color',
		'description' => esc_html__( 'Dark Color Preset', 'rhye' ),
		'default'     => '#333333',
		'settings'    => 'h1_color_dark',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--h1-color-dark',
			),
			array(
				'element'  => ':root',
				'property' => '--h1-color-dark',
				'context' => array( 'editor' )
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'h1_h6_headings',
		'type'        => 'color',
		'description' => esc_html__( 'Light Color Preset', 'rhye' ),
		'default'     => '#eeece6',
		'settings'    => 'h1_color_light',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--h1-color-light',
			),
			array(
				'element'  => ':root',
				'property' => '--h1-color-light',
				'context' => array( 'editor' )
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'h1_h6_generic_divider' . $priority,
		'section'  => 'h1_h6_headings',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);

/**
 * h2
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'label'    => esc_html__( 'Heading 2', 'rhye' ),
		'settings' => 'h1_h6_generic_heading' . $priority,
		'section'  => 'h1_h6_headings',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'      => 'typography',
		'settings'  => 'h2_font',
		'section'   => 'h1_h6_headings',
		'default'   => array(
			'font-family'    => 'Cinzel',
			'variant'        => 'regular',
			'line-height'    => 1.31,
			'letter-spacing' => 0,
			'text-transform' => 'none',
		),
		'priority'  => $priority++,
		'choices'   => $choices,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => 'h2, .h2',
			)
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'h2_max_font_size',
		'description' => esc_html__( 'Desktop font size (px)', 'rhye' ),
		'section'     => 'h1_h6_headings',
		'default'     => 61,
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
				'property' => '--h2-max-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--h2-max-font-size',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'h2_min_font_size',
		'description' => esc_html__( 'Mobile font size (px)', 'rhye' ),
		'section'     => 'h1_h6_headings',
		'default'     => 31,
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
				'property' => '--h2-min-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--h2-min-font-size',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'h1_h6_headings',
		'type'        => 'color',
		'description' => esc_html__( 'Dark Color Preset', 'rhye' ),
		'default'     => '#333333',
		'settings'    => 'h2_color_dark',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--h2-color-dark',
			),
			array(
				'element'  => ':root',
				'property' => '--h2-color-dark',
				'context' => array( 'editor' )
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'h1_h6_headings',
		'type'        => 'color',
		'description' => esc_html__( 'Light Color Preset', 'rhye' ),
		'default'     => '#eeece6',
		'settings'    => 'h2_color_light',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--h2-color-light',
			),
			array(
				'element'  => ':root',
				'property' => '--h2-color-light',
				'context' => array( 'editor' )
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'h1_h6_generic_divider' . $priority,
		'section'  => 'h1_h6_headings',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);

/**
 * h3
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'label'    => esc_html__( 'Heading 3', 'rhye' ),
		'settings' => 'h1_h6_generic_heading' . $priority,
		'section'  => 'h1_h6_headings',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'      => 'typography',
		'settings'  => 'h3_font',
		'section'   => 'h1_h6_headings',
		'default'   => array(
			'font-family'    => 'Cinzel',
			'variant'        => 'regular',
			'line-height'    => 1.4,
			'letter-spacing' => 0,
			'text-transform' => 'none',
		),
		'priority'  => $priority++,
		'choices'   => $choices,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => 'h3, .h3',
			)
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'h3_max_font_size',
		'description' => esc_html__( 'Desktop font size (px)', 'rhye' ),
		'section'     => 'h1_h6_headings',
		'default'     => 42,
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
				'property' => '--h3-max-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--h3-max-font-size',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'h3_min_font_size',
		'description' => esc_html__( 'Mobile font size (px)', 'rhye' ),
		'section'     => 'h1_h6_headings',
		'default'     => 28,
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
				'property' => '--h3-min-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--h3-min-font-size',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'h1_h6_headings',
		'type'        => 'color',
		'description' => esc_html__( 'Dark Color Preset', 'rhye' ),
		'default'     => '#333333',
		'settings'    => 'h3_color_dark',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--h3-color-dark',
			),
			array(
				'element'  => ':root',
				'property' => '--h3-color-dark',
				'context' => array( 'editor' )
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'h1_h6_headings',
		'type'        => 'color',
		'description' => esc_html__( 'Light Color Preset', 'rhye' ),
		'default'     => '#eeece6',
		'settings'    => 'h3_color_light',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--h3-color-light',
			),
			array(
				'element'  => ':root',
				'property' => '--h3-color-light',
				'context' => array( 'editor' )
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'h1_h6_generic_divider' . $priority,
		'section'  => 'h1_h6_headings',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);

/**
 * h4
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'label'    => esc_html__( 'Heading 4', 'rhye' ),
		'settings' => 'h1_h6_generic_heading' . $priority,
		'section'  => 'h1_h6_headings',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'      => 'typography',
		'settings'  => 'h4_font',
		'section'   => 'h1_h6_headings',
		'default'   => array(
			'font-family'    => 'Cinzel',
			'variant'        => '700',
			'line-height'    => 1.62,
			'letter-spacing' => 0,
			'text-transform' => 'none',
		),
		'priority'  => $priority++,
		'choices'   => $choices,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => 'h4, .h4',
			)
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'h4_max_font_size',
		'description' => esc_html__( 'Desktop font size (px)', 'rhye' ),
		'section'     => 'h1_h6_headings',
		'default'     => 26,
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
				'property' => '--h4-max-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--h4-max-font-size',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'h4_min_font_size',
		'description' => esc_html__( 'Mobile font size (px)', 'rhye' ),
		'section'     => 'h1_h6_headings',
		'default'     => 22,
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
				'property' => '--h4-min-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--h4-min-font-size',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'h1_h6_headings',
		'type'        => 'color',
		'description' => esc_html__( 'Dark Color Preset', 'rhye' ),
		'default'     => '#262626',
		'settings'    => 'h4_color_dark',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--h4-color-dark',
			),
			array(
				'element'  => ':root',
				'property' => '--h4-color-dark',
				'context' => array( 'editor' )
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'h1_h6_headings',
		'type'        => 'color',
		'description' => esc_html__( 'Light Color Preset', 'rhye' ),
		'default'     => '#ffffff',
		'settings'    => 'h4_color_light',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--h4-color-light',
			),
			array(
				'element'  => ':root',
				'property' => '--h4-color-light',
				'context' => array( 'editor' )
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'h1_h6_generic_divider' . $priority,
		'section'  => 'h1_h6_headings',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);

/**
 * h5
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'label'    => esc_html__( 'Heading 5', 'rhye' ),
		'settings' => 'h1_h6_generic_heading' . $priority,
		'section'  => 'h1_h6_headings',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'      => 'typography',
		'settings'  => 'h5_font',
		'section'   => 'h1_h6_headings',
		'default'   => array(
			'font-family'    => 'Cinzel',
			'variant'        => '700',
			'line-height'    => 1.6,
			'letter-spacing' => 0,
			'text-transform' => 'none',
		),
		'priority'  => $priority++,
		'choices'   => $choices,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => 'h5, .h5',
			)
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'h5_max_font_size',
		'description' => esc_html__( 'Desktop font size (px)', 'rhye' ),
		'section'     => 'h1_h6_headings',
		'default'     => 18,
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
				'property' => '--h5-max-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--h5-max-font-size',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'h5_min_font_size',
		'description' => esc_html__( 'Mobile font size (px)', 'rhye' ),
		'section'     => 'h1_h6_headings',
		'default'     => 18,
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
				'property' => '--h5-min-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--h5-min-font-size',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'h1_h6_headings',
		'type'        => 'color',
		'description' => esc_html__( 'Dark Color Preset', 'rhye' ),
		'default'     => '#262626',
		'settings'    => 'h5_color_dark',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--h5-color-dark',
			),
			array(
				'element'  => ':root',
				'property' => '--h5-color-dark',
				'context' => array( 'editor' )
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'h1_h6_headings',
		'type'        => 'color',
		'description' => esc_html__( 'Light Color Preset', 'rhye' ),
		'default'     => '#ffffff',
		'settings'    => 'h5_color_light',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--h5-color-light',
			),
			array(
				'element'  => ':root',
				'property' => '--h5-color-light',
				'context' => array( 'editor' )
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'h1_h6_generic_divider' . $priority,
		'section'  => 'h1_h6_headings',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);

/**
 * h6
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'label'    => esc_html__( 'Heading 6', 'rhye' ),
		'settings' => 'h1_h6_generic_heading' . $priority,
		'section'  => 'h1_h6_headings',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'      => 'typography',
		'settings'  => 'h6_font',
		'section'   => 'h1_h6_headings',
		'default'   => array(
			'font-family'    => 'Cinzel',
			'variant'        => '700',
			'line-height'    => 1.6,
			'letter-spacing' => 0,
			'text-transform' => 'none',
		),
		'priority'  => $priority++,
		'choices'   => $choices,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => 'h6, .h6',
			)
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'h6_max_font_size',
		'description' => esc_html__( 'Desktop font size (px)', 'rhye' ),
		'section'     => 'h1_h6_headings',
		'default'     => 14,
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
				'property' => '--h6-max-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--h6-max-font-size',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'h6_min_font_size',
		'description' => esc_html__( 'Mobile font size (px)', 'rhye' ),
		'section'     => 'h1_h6_headings',
		'default'     => 14,
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
				'property' => '--h6-min-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--h6-min-font-size',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'h1_h6_headings',
		'type'        => 'color',
		'description' => esc_html__( 'Dark Color Preset', 'rhye' ),
		'default'     => '#262626',
		'settings'    => 'h6_color_dark',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--h6-color-dark',
			),
			array(
				'element'  => ':root',
				'property' => '--h6-color-dark',
				'context' => array( 'editor' )
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'h1_h6_headings',
		'type'        => 'color',
		'description' => esc_html__( 'Light Color Preset', 'rhye' ),
		'default'     => '#ffffff',
		'settings'    => 'h6_color_light',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--h6-color-light',
			),
			array(
				'element'  => ':root',
				'property' => '--h6-color-light',
				'context' => array( 'editor' )
			),
		),
	)
);
