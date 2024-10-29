<?php

$priority = 1;


/**
 * Layout
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'radio-buttonset',
		'settings' => 'post_image_layout',
		'label'    => esc_html__( 'Featured Image Layout', 'rhye' ),
		'section'  => 'blog_post',
		'default'  => 'normal',
		'priority' => $priority++,
		'choices'  => array(
			'normal'     => esc_html__( 'Normal', 'rhye' ),
			'fullwidth'  => esc_html__( 'Full Width', 'rhye' ),
			'fullscreen' => esc_html__( 'Fullscreen', 'rhye' ),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'slider',
		'settings'        => 'post_image_height',
		'description'     => esc_html__( 'Image Height (vh)', 'rhye' ),
		'section'         => 'blog_post',
		'default'         => 70,
		'priority'        => $priority++,
		'choices'         => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
		'transport'       => 'auto',
		'active_callback' => array(
			array(
				'setting' => 'post_image_layout',
				'value'   => 'fullwidth',
			),
		),
		'output'          => array(
			array(
				'element'  => '.section-image_single-post',
				'property' => 'height',
				'units'    => 'vh',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'color',
		'settings'        => 'post_image_overlay_color',
		'description'     => esc_html__( 'Image Overlay', 'rhye' ),
		'section'         => 'blog_post',
		'default'         => 'rgba(0,0,0,0.6)',
		'priority'        => $priority++,
		'choices'         => array(
			'alpha' => true,
		),
		'output'          => array(
			array(
				'element'  => '.section-masthead__overlay_fullscreen',
				'property' => 'background-color',
			),
		),
		'transport'       => 'auto',
		'active_callback' => array(
			array(
				'setting' => 'post_image_layout',
				'value'   => 'fullscreen',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'checkbox',
		'settings'        => 'post_image_masthead_fixed_enabled',
		'label'           => esc_html__( 'Enable Fixed Masthead', 'rhye' ),
		'section'         => 'blog_post',
		'default'         => true,
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting' => 'post_image_layout',
				'value'   => 'fullscreen',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'checkbox',
		'settings'        => 'post_image_masthead_force_light_theme_enabled',
		'label'           => esc_html__( 'Force Light Color Theme for Masthead & Header if There is a Featured Image Set', 'rhye' ),
		'section'         => 'blog_post',
		'default'         => true,
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting' => 'post_image_layout',
				'value'   => 'fullscreen',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'checkbox',
		'settings'        => 'post_image_parallax_enabled',
		'label'           => esc_html__( 'Enable Parallax', 'rhye' ),
		'section'         => 'blog_post',
		'default'         => true,
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'post_image_layout',
				'operator' => '!=',
				'value'    => 'normal',
			),
			array(
				array(
					'setting'  => 'post_image_layout',
					'operator' => '!=',
					'value'    => 'fullscreen',
				),
				array(
					'setting'  => 'post_image_masthead_fixed_enabled',
					'operator' => '!=',
					'value'    => true,
				),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'slider',
		'settings'        => 'post_image_parallax_speed',
		'description'     => esc_html__( 'Parallax Speed', 'rhye' ),
		'section'         => 'blog_post',
		'default'         => 0.15,
		'priority'        => $priority++,
		'choices'         => array(
			'min'  => -0.5,
			'max'  => 0.5,
			'step' => 0.01,
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_image_layout',
				'operator' => '!=',
				'value'    => 'normal',
			),
			array(
				'setting' => 'post_image_parallax_enabled',
				'value'   => true,
			),
			array(
				array(
					'setting'  => 'post_image_layout',
					'operator' => '!=',
					'value'    => 'fullscreen',
				),
				array(
					'setting'  => 'post_image_masthead_fixed_enabled',
					'operator' => '!=',
					'value'    => true,
				),
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'generic',
		'settings'        => 'post_generic_divider' . $priority,
		'section'         => 'blog_post',
		'priority'        => $priority++,
		'choices'         => array(
			'element' => 'hr',
		),
		'active_callback' => array(
			array(
				'setting' => 'post_image_layout',
				'value'   => 'fullscreen',
			),
		),
	)
);

/**
 * Scroll Down
 */
Kirki::add_field(
	'arts', array(
		'type'            => 'switch',
		'settings'        => 'post_image_masthead_scrolldown_enabled',
		'label'           => esc_html__( 'Enable Scroll Down Button', 'rhye' ),
		'section'         => 'blog_post',
		'default'         => true,
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting' => 'post_image_layout',
				'value'   => 'fullscreen',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'text',
		'settings'        => 'post_image_masthead_scrolldown_label',
		'description'     => esc_html__( 'Label', 'rhye' ),
		'section'         => 'blog_post',
		'default'         => esc_html__( 'Start Reading', 'rhye' ),
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting' => 'post_image_layout',
				'value'   => 'fullscreen',
			),
			array(
				'setting' => 'post_image_masthead_scrolldown_enabled',
				'value'   => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'blog_post_generic_heading' . $priority,
		'section'  => 'blog_post',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);

/**
 * Post Show All Info
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'switch',
		'settings' => 'post_show_info',
		'label'    => esc_html__( 'Enable Meta Information', 'rhye' ),
		'section'  => 'blog_post',
		'default'  => 'on',
		'priority' => $priority++,
		'choices'  => array(
			true  => esc_html__( 'On', 'rhye' ),
			false => esc_html__( 'Off', 'rhye' ),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'multicheck',
		'settings'        => 'post_meta_set',
		'section'         => 'blog_post',
		'default'         => array( 'date', 'categories', 'comments', 'author' ),
		'priority'        => $priority++,
		'choices'         => array(
			'date'       => esc_html__( 'Date', 'rhye' ),
			'categories' => esc_html__( 'Categories', 'rhye' ),
			'comments'   => esc_html__( 'Comments Counter', 'rhye' ),
			'author'     => esc_html__( 'Author', 'rhye' ),
		),
		'active_callback' => array(
			array(
				'setting' => 'post_show_info',
				'value'   => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'blog_post_generic_heading' . $priority,
		'section'  => 'blog_post',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);

/**
 * Post Show Prev & Next Navigation
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'switch',
		'settings' => 'post_prev_next_nav_enabled',
		'label'    => esc_html__( 'Enable Prev/Next Footer Navigation', 'rhye' ),
		'section'  => 'blog_post',
		'default'  => 'on',
		'priority' => $priority++,
		'choices'  => array(
			true  => esc_html__( 'On', 'rhye' ),
			false => esc_html__( 'Off', 'rhye' ),
		),
	)
);

Kirki::add_field(
	'arts', [
		'type'            => 'checkbox',
		'settings'        => 'post_prev_next_nav_next_first_mobile',
		'label'           => esc_html__( 'Position "next" post item before "previous" on mobile', 'rhye' ),
		'section'         => 'blog_post',
		'default'         => true,
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'post_prev_next_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	]
);

Kirki::add_field(
	'arts',
	array(
		'type'            => 'text',
		'settings'        => 'post_prev_next_nav_prev_title',
		'label'           => esc_html__( '"Previous" label', 'rhye' ),
		'section'         => 'blog_post',
		'default'         => esc_html__( 'Prev', 'rhye' ),
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'post_prev_next_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts',
	array(
		'type'            => 'text',
		'settings'        => 'post_prev_next_nav_next_title',
		'label'           => esc_html__( '"Next" label', 'rhye' ),
		'section'         => 'blog_post',
		'default'         => esc_html__( 'Next', 'rhye' ),
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'post_prev_next_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);
