<?php

$priority = 1;

Kirki::add_field(
	'arts', array(
		'type'     => 'switch',
		'settings' => 'preloader_enabled',
		'label'    => esc_html__( 'Enable Page Preloader', 'rhye' ),
		'section'  => 'preloader',
		'default'  => false,
		'priority' => $priority++,
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'radio-buttonset',
		'settings'        => 'preloader_style',
		'label'           => esc_html__( 'Preloader Style', 'rhye' ),
		'section'         => 'preloader',
		'default'         => 'custom_text',
		'priority'        => $priority++,
		'choices'         => array(
			'logo'         => esc_html__( 'Logo', 'rhye' ),
			'custom_text'  => esc_html__( 'Custom Text', 'rhye' ),
			'custom_image' => esc_html__( 'Custom Image', 'rhye' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'preloader_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'select',
		'settings'        => 'preloader_logo',
		'label'           => esc_html__( 'Logo to Display', 'rhye' ),
		'section'         => 'preloader',
		'default'         => 'primary',
		'priority'        => $priority++,
		'choices'         => array(
			'primary'   => esc_html__( 'Primary', 'rhye' ),
			'secondary' => esc_html__( 'Secondary', 'rhye' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'preloader_enabled',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'preloader_style',
				'operator' => '==',
				'value'    => 'logo',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'text',
		'settings'        => 'preloader_heading',
		'label'           => esc_html__( 'Heading', 'rhye' ),
		'section'         => 'preloader',
		'default'         => esc_html__( 'Loading...', 'rhye' ),
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'preloader_enabled',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'preloader_style',
				'operator' => '==',
				'value'    => 'custom_text',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'select',
		'settings'        => 'preloader_heading_preset',
		'label'           => esc_html__( 'Heading Preset', 'rhye' ),
		'section'         => 'preloader',
		'default'         => 'h2',
		'priority'        => $priority++,
		'choices'         => ARTS_THEME_TYPOGRAHY_ARRAY,
		'active_callback' => array(
			array(
				'setting'  => 'preloader_enabled',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'preloader_style',
				'operator' => '==',
				'value'    => 'custom_text',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'text',
		'settings'        => 'preloader_subheading',
		'label'           => esc_html__( 'Subheading', 'rhye' ),
		'section'         => 'preloader',
		'default'         => '',
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'preloader_enabled',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'preloader_style',
				'operator' => '==',
				'value'    => 'custom_text',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'select',
		'settings'        => 'preloader_subheading_preset',
		'label'           => esc_html__( 'Subheading Preset', 'rhye' ),
		'section'         => 'preloader',
		'default'         => 'subheading',
		'priority'        => $priority++,
		'choices'         => ARTS_THEME_TYPOGRAHY_ARRAY,
		'active_callback' => array(
			array(
				'setting'  => 'preloader_enabled',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'preloader_style',
				'operator' => '==',
				'value'    => 'custom_text',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'image',
		'settings'        => 'preloader_image_url',
		'section'         => 'preloader',
		'default'         => '',
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'preloader_enabled',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'preloader_style',
				'operator' => '==',
				'value'    => 'custom_image',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'preloader_generic_divider' . $priority,
		'section'  => 'preloader',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'select',
		'settings'        => 'preloader_theme',
		'label'           => esc_html__( 'Preloader Elements Color', 'rhye' ),
		'section'         => 'preloader',
		'default'         => 'light',
		'priority'        => $priority++,
		'choices'         => ARTS_THEME_COLOR_THEMES_ARRAY,
		'active_callback' => array(
			array(
				'setting'  => 'preloader_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'select',
		'settings'        => 'preloader_background',
		'label'           => esc_html__( 'Preloader Background Color', 'rhye' ),
		'section'         => 'preloader',
		'default'         => 'bg-dark-2',
		'priority'        => $priority++,
		'choices'         => ARTS_THEME_COLORS_ARRAY,
		'active_callback' => array(
			array(
				'setting'  => 'preloader_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'preloader_generic_divider' . $priority,
		'section'  => 'preloader',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
		'active_callback' => array(
			array(
				'setting'  => 'preloader_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'generic',
		'label'           => esc_html__( 'Loading Circle', 'rhye' ),
		'settings'        => 'preloader_generic_heading' . $priority,
		'section'         => 'preloader',
		'priority'        => $priority++,
		'choices'         => array(
			'element' => 'span',
		),
		'active_callback' => array(
			array(
				'setting'  => 'preloader_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'slider',
		'settings'        => 'preloader_circle_max_size',
		'description'     => esc_html__( 'Desktop size (px)', 'rhye' ),
		'section'         => 'preloader',
		'default'         => 960,
		'priority'        => $priority++,
		'choices'         => array(
			'min'  => 50,
			'max'  => 1500,
			'step' => 10,
		),
		'transport'       => 'auto',
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--preloader-circle-max-size',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'preloader_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'slider',
		'settings'        => 'preloader_circle_min_size',
		'description'     => esc_html__( 'Mobile size (px)', 'rhye' ),
		'section'         => 'preloader',
		'default'         => 280,
		'priority'        => $priority++,
		'choices'         => array(
			'min'  => 50,
			'max'  => 1500,
			'step' => 10,
		),
		'transport'       => 'auto',
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--preloader-circle-min-size',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'preloader_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'preloader_generic_divider' . $priority,
		'section'  => 'preloader',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
		'active_callback' => array(
			array(
				'setting'  => 'preloader_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'generic',
		'label'           => esc_html__( 'Counter', 'rhye' ),
		'settings'        => 'preloader_generic_heading' . $priority,
		'section'         => 'preloader',
		'priority'        => $priority++,
		'choices'         => array(
			'element' => 'span',
		),
		'active_callback' => array(
			array(
				'setting'  => 'preloader_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'checkbox',
		'settings'        => 'preloader_counter_enabled',
		'label'           => esc_html__( 'Enable Counter', 'rhye' ),
		'section'         => 'preloader',
		'default'         => true,
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'preloader_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'select',
		'settings'        => 'preloader_counter_preset',
		'label'           => esc_html__( 'Counter Preset', 'rhye' ),
		'section'         => 'preloader',
		'default'         => 'h5',
		'priority'        => $priority++,
		'choices'         => ARTS_THEME_TYPOGRAHY_ARRAY,
		'active_callback' => array(
			array(
				'setting'  => 'preloader_enabled',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'preloader_counter_enabled',
				'operator' => '==',
				'value'    => true
			),
		),
	)
);
