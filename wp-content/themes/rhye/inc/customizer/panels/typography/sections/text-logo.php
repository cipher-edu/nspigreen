<?php

$priority = 1;
$choices  = arts_add_fonts_custom_choice();

/**
 * Text logo disabled message
 */
Kirki::add_field(
	'arts', array(
		'type'            => 'custom',
		'settings'        => 'text_logo_info',
		'label'           => esc_html__( 'Text Logo is Disabled', 'rhye' ),
		'description'     => sprintf(
			'%1$s <strong>%2$s</strong> %3$s <a href="javascript:wp.customize.section(\'title_tagline\').focus();">%4$s</a> %5$s',
			esc_html__( 'To activate the logo typography options please enable', 'rhye' ),
			esc_html__( 'Display Site Title and Tagline', 'rhye' ),
			esc_html__( 'checkbox in', 'rhye' ),
			esc_html__( 'Site Identity', 'rhye' ),
			esc_html__( 'section.', 'rhye' )
		),
		'section'         => 'text_logo',
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'header_text',
				'operator' => '==',
				'value'    => false,
			),
		),
	)
);

/**
 * Text Logo: Title
 */
Kirki::add_field(
	'arts', array(
		'type'            => 'generic',
		'label'           => esc_html__( 'Text Logo: Title', 'rhye' ),
		'settings'        => 'text_logo_generic_heading' . $priority,
		'section'         => 'text_logo',
		'priority'        => $priority++,
		'choices'         => array(
			'element' => 'span',
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_text',
				'operator' => '!=',
				'value'    => false,
			),
			array(
				'setting'  => 'blogname',
				'operator' => '!=',
				'value'    => '',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'typography',
		'settings'        => 'text_logo_title_font',
		'section'         => 'text_logo',
		'default'         => array(
			'font-family'    => 'Cinzel',
			'variant'        => '700',
			'line-height'    => 1.3,
			'letter-spacing' => 0,
			'text-transform' => 'none',
		),
		'priority'        => $priority++,
		'choices'         => $choices,
		'transport'       => 'auto',
		'output'          => array(
			array(
				'element' => '.logo__text-title',
			),
			array(
				'element' => '.logo__text-title',
				'context' => array( 'editor' ),
			),
		)
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'slider',
		'settings'        => 'text_logo_title_max_font_size',
		'description'     => esc_html__( 'Desktop font size (px)', 'rhye' ),
		'section'         => 'text_logo',
		'default'         => 20,
		'priority'        => $priority++,
		'choices'         => array(
			'min'  => 8,
			'max'  => 300,
			'step' => 1,
		),
		'transport'       => 'auto',
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--logo-title-max-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--logo-title-max-font-size',
				'context'  => array( 'editor' ),
			),
		)
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'slider',
		'settings'        => 'text_logo_title_min_font_size',
		'description'     => esc_html__( 'Mobile font size (px)', 'rhye' ),
		'section'         => 'text_logo',
		'default'         => 16,
		'priority'        => $priority++,
		'choices'         => array(
			'min'  => 8,
			'max'  => 300,
			'step' => 1,
		),
		'transport'       => 'auto',
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--logo-title-min-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--logo-title-min-font-size',
				'context'  => array( 'editor' ),
			),
		)
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'generic',
		'settings'        => 'text_logo_generic_divider' . $priority,
		'section'         => 'text_logo',
		'priority'        => $priority++,
		'choices'         => array(
			'element' => 'hr',
		)
	)
);

/**
 * Text Logo: Tagline
 */
Kirki::add_field(
	'arts', array(
		'type'            => 'generic',
		'label'           => esc_html__( 'Text Logo: Tagline', 'rhye' ),
		'settings'        => 'text_logo_generic_heading' . $priority,
		'section'         => 'text_logo',
		'priority'        => $priority++,
		'choices'         => array(
			'element' => 'span',
		)
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'typography',
		'settings'        => 'text_logo_tagline_font',
		'section'         => 'text_logo',
		'default'         => array(
			'font-family'    => 'Raleway',
			'variant'        => '700italic',
			'line-height'    => 1.3,
			'letter-spacing' => 0,
			'text-transform' => 'none',
		),
		'priority'        => $priority++,
		'choices'         => $choices,
		'transport'       => 'auto',
		'output'          => array(
			array(
				'element' => '.logo__text-tagline',
			),
			array(
				'element' => '.logo__text-tagline',
				'context' => array( 'editor' ),
			),
		)
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'slider',
		'settings'        => 'text_logo_tagline_max_font_size',
		'description'     => esc_html__( 'Desktop font size (px)', 'rhye' ),
		'section'         => 'text_logo',
		'default'         => 12,
		'priority'        => $priority++,
		'choices'         => array(
			'min'  => 8,
			'max'  => 300,
			'step' => 1,
		),
		'transport'       => 'auto',
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--logo-tagline-max-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--logo-tagline-max-font-size',
				'context'  => array( 'editor' ),
			),
		)
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'slider',
		'settings'        => 'text_logo_tagline_min_font_size',
		'description'     => esc_html__( 'Mobile font size (px)', 'rhye' ),
		'section'         => 'text_logo',
		'default'         => 12,
		'priority'        => $priority++,
		'choices'         => array(
			'min'  => 8,
			'max'  => 300,
			'step' => 1,
		),
		'transport'       => 'auto',
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--logo-tagline-min-font-size',
			),
			array(
				'element'  => ':root',
				'property' => '--logo-tagline-min-font-size',
				'context'  => array( 'editor' ),
			),
		)
	)
);
