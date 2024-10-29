<?php

$priority = 1;
$choices  = arts_add_fonts_custom_choice();

/**
 * Drop Cap
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'label'    => esc_html__( 'Drop Cap', 'rhye' ),
		'settings' => 'drop_cap_generic_heading' . $priority,
		'section'  => 'drop_cap',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'      => 'typography',
		'settings'  => 'drop_cap_font',
		'section'   => 'drop_cap',
		'default'   => array(
			'font-family'    => 'Cinzel',
			'variant'        => 'regular',
			'line-height'    => 0.7,
			'letter-spacing' => 0,
			'text-transform' => 'uppercase',
		),
		'priority'  => $priority++,
		'choices'   => $choices,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => '.has-drop-cap:not(:focus):not(.has-drop-cap_split):first-letter, .drop-cap',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'drop_cap_max_font_size',
		'description' => esc_html__( 'Desktop font size (px)', 'rhye' ),
		'section'     => 'drop_cap',
		'default'     => 94,
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
				'property' => '--dropcap-max-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--dropcap-max-font-size',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'slider',
		'settings'    => 'drop_cap_min_font_size',
		'description' => esc_html__( 'Mobile font size (px)', 'rhye' ),
		'section'     => 'drop_cap',
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
				'property' => '--dropcap-min-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--dropcap-min-font-size',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'drop_cap',
		'type'        => 'color',
		'description' => esc_html__( 'Dark Color Preset', 'rhye' ),
		'default'     => '#111111',
		'settings'    => 'drop_cap_color_dark',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--dropcap-color-dark',
			),
			array(
				'element'  => ':root',
				'property' => '--dropcap-color-dark',
				'context'  => array( 'editor' ),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'section'     => 'drop_cap',
		'type'        => 'color',
		'description' => esc_html__( 'Light Color Preset', 'rhye' ),
		'default'     => '#ffffff',
		'settings'    => 'drop_cap_color_light',
		'priority'    => $priority ++,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element'  => ':root',
				'property' => '--dropcap-color-light',
			),
			array(
				'element'  => ':root',
				'property' => '--dropcap-color-light',
				'context'  => array( 'editor' ),
			),
		),
	)
);
