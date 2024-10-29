<?php

$priority = 1;
$choices  = arts_add_fonts_custom_choice();

Kirki::add_field(
	'arts', array(
    'label' => esc_html__( 'Slider Counter: Current'),
		'type'      => 'typography',
		'settings'  => 'slider_counter_current_font',
		'section'   => 'typography_counters',
		'default'   => array(
			'font-family'    => 'Cinzel',
			'variant'        => 'regular'
		),
		'priority'  => $priority++,
		'choices'   => $choices,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => '.slider__counter_current',
			)
		),
	)
);

Kirki::add_field(
	'arts', array(
    'label' => esc_html__( 'Slider Counter: Total'),
		'type'      => 'typography',
		'settings'  => 'slider_counter_total_font',
		'section'   => 'typography_counters',
		'default'   => array(
			'font-family'    => 'Cinzel',
			'variant'        => 'regular'
		),
		'priority'  => $priority++,
		'choices'   => $choices,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => '.slider__counter_total',
			)
		),
	)
);

Kirki::add_field(
	'arts', array(
    'label' => esc_html__( 'Albums Images Counter'),
		'type'      => 'typography',
		'settings'  => 'albums_images_counter_font',
		'section'   => 'typography_counters',
		'default'   => array(
			'font-family'    => 'Cinzel',
			'variant'        => '700'
		),
		'priority'  => $priority++,
		'choices'   => $choices,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => '.block-counter__counter',
			)
		),
	)
);
