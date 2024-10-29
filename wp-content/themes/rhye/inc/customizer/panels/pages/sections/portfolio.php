<?php

$priority = 1;

Kirki::add_field(
	'arts', array(
		'type'        => 'switch',
		'settings'    => 'portfolio_nav_enabled',
		'label'       => esc_html__( 'Enable Portfolio Navigation', 'rhye' ),
		'description' => esc_html__( 'Appears at the bottom of the portfolio pages.', 'rhye' ),
		'section'     => 'portfolio',
		'default'     => true,
		'priority'    => $priority++,
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'radio-buttonset',
		'settings'        => 'portfolio_nav_style',
		'label'           => esc_html__( 'Navigation Style', 'rhye' ),
		'section'         => 'portfolio',
		'default'         => 'portfolio-auto-scroll',
		'priority'        => $priority++,
		'choices'         => array(
			'portfolio-auto-scroll'     => esc_html__( 'Auto Scroll Next', 'rhye' ),
			'portfolio-prev-next-hover' => esc_html__( 'Prev & Next Hover', 'rhye' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'checkbox',
		'settings'        => 'portfolio_nav_scroll_down_enabled',
		'label'           => esc_html__( 'Enable Scroll Down Button', 'rhye' ),
		'section'         => 'portfolio',
		'default'         => true,
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'portfolio_nav_style',
				'operator' => '==',
				'value'    => 'portfolio-auto-scroll',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'checkbox',
		'settings'        => 'portfolio_nav_image_transition_enabled',
		'label'           => esc_html__( 'Enable Image Transition', 'rhye' ),
		'section'         => 'portfolio',
		'default'         => true,
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'checkbox',
		'settings'        => 'portfolio_loop_enabled',
		'label'           => esc_html__( 'Enable Loop Navigation', 'rhye' ),
		'section'         => 'portfolio',
		'default'         => true,
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'portfolio_nav_style',
				'operator' => '==',
				'value'    => 'portfolio-prev-next-hover',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'checkbox',
		'settings'        => 'portfolio_next_first_mobile',
		'label'           => esc_html__( 'Enable "Next" Item to Appear as First in the Stack on Mobiles', 'rhye' ),
		'section'         => 'portfolio',
		'default'         => true,
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'portfolio_nav_style',
				'operator' => '==',
				'value'    => 'portfolio-prev-next-hover',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'text',
		'description'     => esc_html__( 'Scroll Down Label', 'rhye' ),
		'settings'        => 'portfolio_nav_scroll_down_label',
		'section'         => 'portfolio',
		'priority'        => $priority++,
		'default'         => esc_html__( 'Keep Scrolling', 'rhye' ),
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'portfolio_nav_style',
				'operator' => '==',
				'value'    => 'portfolio-auto-scroll',
			),
			array(
				'setting'  => 'portfolio_nav_scroll_down_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'text',
		'description'     => esc_html__( 'Previous Label', 'rhye' ),
		'settings'        => 'portfolio_nav_prev_label',
		'section'         => 'portfolio',
		'priority'        => $priority++,
		'default'         => esc_html__( 'Previous Project', 'rhye' ),
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'portfolio_nav_style',
				'operator' => '==',
				'value'    => 'portfolio-prev-next-hover',
			),
		),
		'transport'       => 'postMessage',
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'text',
		'description'     => esc_html__( 'Next Label', 'rhye' ),
		'settings'        => 'portfolio_nav_next_label',
		'section'         => 'portfolio',
		'priority'        => $priority++,
		'default'         => esc_html__( 'Next Project', 'rhye' ),
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
		'transport'       => 'postMessage',
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'radio-buttonset',
		'settings'        => 'portfolio_nav_direction',
		'label'           => esc_html__( 'Posts Navigation Direction', 'rhye' ),
		'section'         => 'portfolio',
		'default'         => 'forward',
		'priority'        => $priority++,
		'choices'         => array(
			'backward' => esc_html__( 'Backward', 'rhye' ),
			'forward'  => esc_html__( 'Forward', 'rhye' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'switch',
		'settings'        => 'portfolio_archive_link_enabled',
		'label'           => esc_html__( 'Enable archive link', 'rhye' ),
		'section'         => 'portfolio',
		'default'         => 'on',
		'priority'        => $priority++,
		'choices'         => array(
			true  => esc_html__( 'On', 'rhye' ),
			false => esc_html__( 'Off', 'rhye' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'portfolio_nav_style',
				'operator' => '==',
				'value'    => 'portfolio-prev-next',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'dropdown-pages',
		'settings'        => 'portfolio_archive_link',
		'description'     => esc_html__( 'Choose a link to the page where all your portfolio items are listed.', 'rhye' ),
		'section'         => 'portfolio',
		'default'         => '',
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'portfolio_nav_style',
				'operator' => '==',
				'value'    => 'portfolio-prev-next',
			),
			array(
				'setting'  => 'portfolio_archive_link_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Typography
 */
Kirki::add_field(
	'arts', array(
		'type'            => 'generic',
		'settings'        => 'portfolio_nav_generic_heading' . $priority,
		'section'         => 'portfolio',
		'priority'        => $priority++,
		'choices'         => array(
			'element' => 'hr',
		),
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'generic',
		'label'           => esc_html__( 'Typography', 'rhye' ),
		'settings'        => 'portfolio_nav_generic_heading' . $priority,
		'section'         => 'portfolio',
		'priority'        => $priority++,
		'choices'         => array(
			'element' => 'span',
		),
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'select',
		'settings'        => 'portfolio_nav_headings_preset',
		'description'     => esc_html__( 'Headings', 'rhye' ),
		'section'         => 'portfolio',
		'default'         => 'h1',
		'priority'        => $priority++,
		'choices'         => ARTS_THEME_TYPOGRAHY_ARRAY,
		'transport'       => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'select',
		'settings'        => 'portfolio_nav_labels_preset',
		'description'     => esc_html__( 'Labels', 'rhye' ),
		'section'         => 'portfolio',
		'default'         => 'subheading',
		'priority'        => $priority++,
		'choices'         => ARTS_THEME_TYPOGRAHY_ARRAY,
		'transport'       => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Color Theme
 */
Kirki::add_field(
	'arts', array(
		'type'            => 'generic',
		'settings'        => 'portfolio_nav_generic_heading' . $priority,
		'section'         => 'portfolio',
		'priority'        => $priority++,
		'choices'         => array(
			'element' => 'hr',
		),
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'generic',
		'label'           => esc_html__( 'Color Theme', 'rhye' ),
		'settings'        => 'portfolio_nav_generic_heading' . $priority,
		'section'         => 'portfolio',
		'priority'        => $priority++,
		'choices'         => array(
			'element' => 'span',
		),
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'select',
		'settings'        => 'portfolio_nav_background',
		'description'     => esc_html__( 'Background Color', 'rhye' ),
		'section'         => 'portfolio',
		'default'         => 'bg-light-1',
		'priority'        => $priority++,
		'tooltip'         => esc_html__( 'This option may be overriden for the current page from Elementor document settings.', 'rhye' ),
		'choices'         => ARTS_THEME_COLORS_ARRAY,
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'select',
		'settings'        => 'portfolio_nav_theme',
		'description'     => esc_html__( 'Main Elements Color', 'rhye' ),
		'section'         => 'portfolio',
		'default'         => 'dark',
		'priority'        => $priority++,
		'tooltip'         => esc_html__( 'This option may be overriden for the current page from Elementor document settings.', 'rhye' ),
		'choices'         => ARTS_THEME_COLOR_THEMES_ARRAY,
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

/**
 * Border
 */
Kirki::add_field(
	'arts', array(
		'type'            => 'checkbox',
		'settings'        => 'portfolio_nav_divider_enabled',
		'label'           => esc_html__( 'Enable Section Divider', 'rhye' ),
		'section'         => 'portfolio',
		'default'         => true,
		'priority'        => $priority++,
		'tooltip'         => esc_html__( 'This option may be overriden for the current page from Elementor document settings.', 'rhye' ),
		'active_callback' => array(
			array(
				'setting'  => 'portfolio_nav_enabled',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);
