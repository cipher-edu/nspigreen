<?php

$priority = 1;

Kirki::add_field(
	'arts', array(
		'type'        => 'switch',
		'settings'    => 'smooth_scroll_enabled',
		'label'       => esc_html__( 'Enable Page Smooth Scroll', 'rhye' ),
		'description' => esc_html__( 'Desktop non-touch devices only', 'rhye' ),
		'section'     => 'smooth_scroll',
		'default'     => false,
		'priority'    => $priority++,
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'checkbox',
		'settings'        => 'smooth_scroll_elementor_canvas_template_enabled',
		'label'           => esc_html__( 'Enable on Elementor Canvas Pages ', 'rhye' ),
		'section'         => 'smooth_scroll',
		'default'         => true,
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'smooth_scroll_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'number',
		'settings'        => 'smooth_scroll_damping',
		'label'           => esc_html__( 'Damping', 'rhye' ),
		'description'     => esc_html__( 'The lower the value is, the more smooth the scrolling will be.', 'rhye' ),
		'tooltip'         => esc_html__( 'A float value between 0.0 and 1.0 defining the momentum reduction damping factor.', 'rhye' ),
		'section'         => 'smooth_scroll',
		'default'         => 0.12,
		'priority'        => $priority++,
		'choices'         => array(
			'min'  => 0,
			'max'  => 1,
			'step' => 0.01,
		),
		'active_callback' => array(
			array(
				'setting'  => 'smooth_scroll_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'switch',
		'settings'        => 'smooth_scroll_render_by_pixels_enabled',
		'label'           => esc_html__( 'Enable Render by Pixels', 'rhye' ),
		'description'     => esc_html__( 'Render every frame in integer pixel values, set to true to improve scrolling performance.', 'rhye' ),
		'section'         => 'smooth_scroll',
		'default'         => true,
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'smooth_scroll_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'switch',
		'settings'        => 'smooth_scroll_plugin_easing_enabled',
		'label'           => esc_html__( 'Enable Edge Easing', 'rhye' ),
		'description'     => esc_html__( 'The scroll will slow down with ease when reaching the page edges.', 'rhye' ),
		'section'         => 'smooth_scroll',
		'default'         => true,
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'smooth_scroll_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);
