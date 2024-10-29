<?php

$priority   = 1;
$thumbnails = arts_get_all_image_sizes();

/**
 * Animation
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'switch',
		'settings' => 'blog_os_animations_enabled',
		'label'    => esc_html__( 'Enable on-scroll animation', 'rhye' ),
		'section'  => 'blog_style',
		'default'  => 'off',
		'priority' => $priority++,
		'choices'  => array(
			true  => esc_html__( 'On', 'rhye' ),
			false => esc_html__( 'Off', 'rhye' ),
		),
	)
);

/**
 * Colors
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'label'    => esc_html__( 'Colors', 'rhye' ),
		'settings' => 'blog_style_generic_heading' . $priority,
		'section'  => 'blog_style',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'select',
		'settings'    => 'blog_style_theme',
		'description' => esc_html__( 'Blog Page Color Theme', 'rhye' ),
		'section'     => 'blog_style',
		'default'     => 'bg-light-1',
		'priority'    => $priority++,
		'choices'     => ARTS_THEME_COLORS_ARRAY,
		'transport' => 'postMessage'
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'select',
		'settings'    => 'blog_style_main_theme',
		'description' => esc_html__( 'Blog Page Main Elements Color', 'rhye' ),
		'section'     => 'blog_style',
		'default'     => 'dark',
		'priority'    => $priority++,
		'choices'     => ARTS_THEME_COLOR_THEMES_ARRAY,
		'transport' => 'postMessage'
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'select',
		'settings'    => 'blog_style_single_post_theme',
		'description' => esc_html__( 'Single Post Color Theme', 'rhye' ),
		'section'     => 'blog_style',
		'default'     => 'bg-light-2',
		'priority'    => $priority++,
		'choices'     => ARTS_THEME_COLORS_ARRAY,
		'transport' => 'postMessage'
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'select',
		'settings'    => 'blog_style_single_post_main_theme',
		'description' => esc_html__( 'Single Post Main Elements Color', 'rhye' ),
		'section'     => 'blog_style',
		'default'     => 'dark',
		'priority'    => $priority++,
		'choices'     => ARTS_THEME_COLOR_THEMES_ARRAY,
		'transport' => 'postMessage'
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'select',
		'settings'    => 'blog_style_single_post_background',
		'description' => esc_html__( 'Single Post Article Background', 'rhye' ),
		'section'     => 'blog_style',
		'default'     => '',
		'priority'    => $priority++,
		'choices'     => ARTS_THEME_COLORS_ARRAY,
		'transport' => 'postMessage'
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'blog_style_generic_heading' . $priority,
		'section'  => 'blog_style',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);

/**
 * Typography
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'label'    => esc_html__( 'Typography', 'rhye' ),
		'settings' => 'blog_style_generic_heading' . $priority,
		'section'  => 'blog_style',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'select',
		'settings'    => 'blog_posts_heading_preset',
		'description' => esc_html__( 'Blog Page Posts Headings', 'rhye' ),
		'section'     => 'blog_style',
		'default'     => 'h3',
		'priority'    => $priority++,
		'choices'     => ARTS_THEME_TYPOGRAHY_ARRAY,
		'tooltip'     => esc_html__( 'The posts headings tag will remain <h2> regardless of the selected styling preset.', 'rhye' ),
		'transport' => 'postMessage'
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'select',
		'settings'    => 'blog_single_post_heading_preset',
		'description' => esc_html__( 'Single Post Heading', 'rhye' ),
		'section'     => 'blog_style',
		'default'     => 'h1',
		'priority'    => $priority++,
		'choices'     => ARTS_THEME_TYPOGRAHY_ARRAY,
		'tooltip'     => esc_html__( 'The single post heading tag will remain <h1> regardless of the selected styling preset.', 'rhye' ),
		'transport' => 'postMessage'
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'select',
		'settings'        => 'post_prev_next_heading_preset',
		'description'     => esc_html__( 'Posts Headings', 'rhye' ),
		'section'         => 'blog_style',
		'default'         => 'h4',
		'priority'        => $priority++,
		'choices'         => ARTS_THEME_TYPOGRAHY_ARRAY
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'blog_style_generic_heading' . $priority,
		'section'  => 'blog_style',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);

/**
 * Thumbnails
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'label'    => esc_html__( 'Thumbnails', 'rhye' ),
		'settings' => 'blog_style_generic_heading' . $priority,
		'section'  => 'blog_style',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'span',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'select',
		'settings'    => 'blog_style_posts_thumbnail',
		'description' => esc_html__( 'Blog Page Posts Thumbnails', 'rhye' ),
		'section'     => 'blog_style',
		'default'     => 'rhye-1024-1024-crop',
		'priority'    => $priority++,
		'choices'     => $thumbnails,
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'select',
		'settings'    => 'blog_style_single_post_thumbnail',
		'description' => esc_html__( 'Single Post Thumbnail', 'rhye' ),
		'section'     => 'blog_style',
		'default'     => 'full',
		'priority'    => $priority++,
		'choices'     => $thumbnails,
	)
);
