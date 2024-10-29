<?php

$priority = 9;

$lg = intval( get_option( 'elementor_viewport_lg', 992 ) );
$md = intval( get_option( 'elementor_viewport_md', 768 ) );
$sm = intval( get_option( 'elementor_viewport_sm', 480 ) );

/**
 * Adjust text logo typography message
 */
Kirki::add_field(
	'arts', array(
		'type'            => 'custom',
		'settings'        => 'title_tagline_text_logo_info',
		'description'     => sprintf(
			'<a href="javascript:wp.customize.section(\'text_logo\').focus();">%1$s</a>',
			esc_html__( 'Text Logo Typography Panel', 'rhye' )
		),
		'section'         => 'title_tagline',
		'priority'        => 12,
		'active_callback' => array(
			array(
				'setting'  => 'header_text',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Secondary Logo Version
 */
Kirki::add_field(
	'arts', array(
		'type'            => 'image',
		'settings'        => 'custom_logo_secondary',
		'label'           => esc_html__( 'Secondary Logo', 'rhye' ),
		'description'     => esc_html__( 'For example, you can upload here a pure white version of your logo.', 'rhye' ),
		'section'         => 'title_tagline',
		'default'         => '',
		'priority'        => $priority,
		'active_callback' => array(
			array(
				'setting'  => 'custom_logo',
				'operator' => '!=',
				'value'    => false,
			),
		),
	)
);

/**
 * Logo Max Height Desktop
 */
Kirki::add_field(
	'arts', array(
		'type'            => 'slider',
		'settings'        => 'custom_logo_max_height',
		'label'           => esc_html__( 'Logo Max Height', 'rhye' ),
		'description'     => esc_html__( 'Desktop screens', 'rhye' ),
		'section'         => 'title_tagline',
		'default'         => 80,
		'choices'         => [
			'min'  => 0,
			'max'  => 512,
			'step' => 1,
		],
		'priority'        => $priority,
		'transport'       => 'auto',
		'output'          => array(
			array(
				'element'     => '.logo__wrapper-img img',
				'property'    => 'height',
				'units'       => 'px',
				'media_query' => '@media (min-width: ' . $md++ . 'px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'custom_logo',
				'operator' => '!=',
				'value'    => false,
			),
		),
	)
);

/**
 * Logo Max Height Tablet
 */
Kirki::add_field(
	'arts', array(
		'type'            => 'slider',
		'settings'        => 'custom_logo_max_height_tablet',
		'label'           => esc_html__( 'Logo Max Height', 'rhye' ),
		'description'     => sprintf(
			'%1s %2s%3s %4s',
			esc_html__( 'Tablet screens', 'rhye' ),
			esc_attr( $md ),
			esc_html__( 'px', 'rhye' ),
			esc_html__( 'and lower', 'rhye' )
		),
		'section'         => 'title_tagline',
		'default'         => 80,
		'choices'         => [
			'min'  => 0,
			'max'  => 512,
			'step' => 1,
		],
		'priority'        => $priority,
		'transport'       => 'auto',
		'output'          => array(
			array(
				'element'     => '.logo__wrapper-img img',
				'property'    => 'height',
				'units'       => 'px',
				'media_query' => '@media (max-width: ' . $md . 'px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'custom_logo',
				'operator' => '!=',
				'value'    => false,
			),
		),
	)
);

/**
 * Logo Max Height Mobile
 */
Kirki::add_field(
	'arts', array(
		'type'            => 'slider',
		'settings'        => 'custom_logo_max_height_mobile',
		'label'           => esc_html__( 'Logo Max Height', 'rhye' ),
		'description'     => sprintf(
			'%1s %2s%3s %4s',
			esc_html__( 'Mobile screens', 'rhye' ),
			esc_attr( $sm ),
			esc_html__( 'px', 'rhye' ),
			esc_html__( 'and lower', 'rhye' )
		),
		'section'         => 'title_tagline',
		'default'         => 80,
		'choices'         => [
			'min'  => 0,
			'max'  => 512,
			'step' => 1,
		],
		'priority'        => $priority,
		'transport'       => 'auto',
		'output'          => array(
			array(
				'element'     => '.logo__wrapper-img img',
				'property'    => 'height',
				'units'       => 'px',
				'media_query' => '@media (max-width: ' . $sm . 'px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'custom_logo',
				'operator' => '!=',
				'value'    => false,
			),
		),
	)
);

