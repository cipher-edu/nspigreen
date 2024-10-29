<?php

$priority = 1;
$choices  = arts_add_fonts_custom_choice();

Kirki::add_field(
	'arts', array(
    'label' => esc_html__( 'Parallax Big Letters'),
		'type'      => 'typography',
		'settings'  => 'projects_big_letters_font',
		'section'   => 'typography_misc',
		'default'   => array(
			'font-family'    => 'Cinzel',
			'variant'        => 'regular'
		),
		'priority'  => $priority++,
		'choices'   => $choices,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => '.figure-project__letter, .section-services__letter',
			)
		),
	)
);

Kirki::add_field(
	'arts', array(
    'label' => esc_html__( 'Blog Pagination'),
		'type'      => 'typography',
		'settings'  => 'blog_pagination_font',
		'section'   => 'typography_misc',
		'default'   => array(
			'font-family'    => 'Cinzel',
			'variant'        => 'regular'
		),
		'priority'  => $priority++,
		'choices'   => $choices,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => '.pagination, .page-links .page-number',
			)
		),
	)
);

Kirki::add_field(
	'arts', array(
    'label' => esc_html__( 'Blog Comments Author'),
		'type'      => 'typography',
		'settings'  => 'blog_comments_author_font',
		'section'   => 'typography_misc',
		'default'   => array(
			'font-family'    => 'Cinzel',
			'variant'        => '700'
		),
		'priority'  => $priority++,
		'choices'   => $choices,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => '.comment-body .fn',
			)
		),
	)
);

Kirki::add_field(
	'arts', array(
    'label' => esc_html__( 'Widgets Additional Info'),
		'type'      => 'typography',
		'settings'  => 'widgets_additional_info_font',
		'section'   => 'typography_misc',
		'default'   => array(
			'font-family'    => 'Cinzel',
			'variant'        => '700'
		),
		'priority'  => $priority++,
		'choices'   => $choices,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => '.widget_recent_comments ul li a, .widget_recent_entries ul li a, .widget_rss .rsswidget',
			)
		),
	)
);
