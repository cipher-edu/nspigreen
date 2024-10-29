<?php

$priority = 1;

/**
 * Dark Colors
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'label'    => esc_html__( 'Dark Presets', 'rhye' ),
		'settings' => 'colors_generic_heading' . $priority,
		'section'  => 'colors',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'colors',
		'type'        => 'color',
		'description' => esc_html__( 'Dark Color 1', 'rhye' ),
		'default'     => '#111111',
		'settings'    => 'bg-dark-1',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--color-dark-1',
			),
			array(
				'element'  => ':root',
				'property' => '--color-dark-1',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'colors',
		'type'        => 'color',
		'description' => esc_html__( 'Dark Color 2', 'rhye' ),
		'default'     => '#262626',
		'settings'    => 'bg-dark-2',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--color-dark-2',
			),
			array(
				'element'  => ':root',
				'property' => '--color-dark-2',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'colors',
		'type'        => 'color',
		'description' => esc_html__( 'Dark Color 3', 'rhye' ),
		'default'     => '#333333',
		'settings'    => 'bg-dark-3',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--color-dark-3',
			),
			array(
				'element'  => ':root',
				'property' => '--color-dark-3',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'colors',
		'type'        => 'color',
		'description' => esc_html__( 'Dark Color 4', 'rhye' ),
		'default'     => '#555555',
		'settings'    => 'bg-dark-4',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--color-dark-4',
			),
			array(
				'element'  => ':root',
				'property' => '--color-dark-4',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'colors_generic_divider' . $priority,
		'section'  => 'colors',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);

/**
 * Light Colors
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'label'    => esc_html__( 'Light Presets', 'rhye' ),
		'settings' => 'colors_generic_heading' . $priority,
		'section'  => 'colors',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'colors',
		'type'        => 'color',
		'description' => esc_html__( 'Light Color 1', 'rhye' ),
		'default'     => '#eeece6',
		'settings'    => 'bg-light-1',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--color-light-1',
			),
			array(
				'element'  => ':root',
				'property' => '--color-light-1',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'colors',
		'type'        => 'color',
		'description' => esc_html__( 'Light Color 2', 'rhye' ),
		'default'     => '#f2f1ed',
		'settings'    => 'bg-light-2',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--color-light-2',
			),
			array(
				'element'  => ':root',
				'property' => '--color-light-2',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'colors',
		'type'        => 'color',
		'description' => esc_html__( 'Light Color 3', 'rhye' ),
		'default'     => '#f7f6f3',
		'settings'    => 'bg-light-3',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--color-light-3',
			),
			array(
				'element'  => ':root',
				'property' => '--color-light-3',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'colors',
		'type'        => 'color',
		'description' => esc_html__( 'Light Color 4', 'rhye' ),
		'default'     => '#f1e9db',
		'settings'    => 'bg-light-4',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--color-light-4',
			),
			array(
				'element'  => ':root',
				'property' => '--color-light-4',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'colors_generic_divider' . $priority,
		'section'  => 'colors',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);

/**
 * Gray Colors
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'label'    => esc_html__( 'Gray Presets', 'rhye' ),
		'settings' => 'colors_generic_heading' . $priority,
		'section'  => 'colors',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'colors',
		'type'        => 'color',
		'description' => esc_html__( 'Gray Color 1', 'rhye' ),
		'default'     => '#777777',
		'settings'    => 'bg-gray-1',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--color-gray-1',
			),
			array(
				'element'  => ':root',
				'property' => '--color-gray-1',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'colors',
		'type'        => 'color',
		'description' => esc_html__( 'Gray Color 2', 'rhye' ),
		'default'     => '#cccccc',
		'settings'    => 'bg-gray-2',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--color-gray-2',
			),
			array(
				'element'  => ':root',
				'property' => '--color-gray-2',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'colors_generic_divider' . $priority,
		'section'  => 'colors',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);

/**
 * White Colors
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'label'    => esc_html__( 'White Presets', 'rhye' ),
		'settings' => 'colors_generic_heading' . $priority,
		'section'  => 'colors',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'colors',
		'type'        => 'color',
		'description' => esc_html__( 'White Color', 'rhye' ),
		'default'     => '#ffffff',
		'settings'    => 'bg-white',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--color-white',
			),
			array(
				'element'  => ':root',
				'property' => '--color-white',
				'context'  => array( 'editor' ),
			),
		),
	)
);
