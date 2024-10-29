<?php

$priority = 1;

/**
 * Indicators
 */
Kirki::add_field(
	'arts', array(
		'type'            => 'generic',
		'label'           => esc_html__( 'Indicators', 'rhye' ),
		'settings'        => 'galleries_generic_heading' . $priority,
		'section'         => 'galleries',
		'priority'        => $priority++,
		'choices'         => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'checkbox',
		'settings'        => 'galleries_counter_enabled',
		'label'           => esc_html__( 'Enable Slides Counter', 'rhye' ),
		'section'         => 'galleries',
		'default'         => true,
		'priority'        => $priority++
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'checkbox',
		'settings'        => 'galleries_captions_enabled',
		'label'           => esc_html__( 'Enable Captions', 'rhye' ),
		'section'         => 'galleries',
		'default'         => true,
		'priority'        => $priority++
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'galleries_generic_divider' . $priority,
		'section'  => 'galleries',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);

/**
 * Controls
 */
Kirki::add_field(
	'arts', array(
		'type'            => 'generic',
		'label'           => esc_html__( 'Controls', 'rhye' ),
		'settings'        => 'galleries_generic_heading' . $priority,
		'section'         => 'galleries',
		'priority'        => $priority++,
		'choices'         => array(
			'element' => 'span',
		),
	)
);


Kirki::add_field(
	'arts', array(
		'type'            => 'checkbox',
		'settings'        => 'galleries_zoom_enabled',
		'label'           => esc_html__( 'Enable Zoom Functionality', 'rhye' ),
		'section'         => 'galleries',
		'default'         => true,
		'priority'        => $priority++
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'checkbox',
		'settings'        => 'galleries_arrows_enabled',
		'label'           => esc_html__( 'Enable Prev & Next Arrows', 'rhye' ),
		'section'         => 'galleries',
		'default'         => true,
		'priority'        => $priority++
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'checkbox',
		'settings'        => 'galleries_fullscreen_button_enabled',
		'label'           => esc_html__( 'Enable Fullscreen Toggle', 'rhye' ),
		'section'         => 'galleries',
		'default'         => true,
		'priority'        => $priority++
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'checkbox',
		'settings'        => 'galleries_close_button_enabled',
		'label'           => esc_html__( 'Enable Close Button', 'rhye' ),
		'section'         => 'galleries',
		'default'         => true,
		'priority'        => $priority++
	)
);
