<?php

$priority = 1;

/**
 * Curtains style
 */
Kirki::add_field(
	'arts', array(
		'type'     => 'radio-buttonset',
		'settings' => 'curtains_style',
		'label'    => esc_html__( 'Curtains Style', 'rhye' ),
		'section'  => 'curtains',
		'default'  => 'curved',
		'priority' => $priority++,
		'choices'  => array(
			'curved'   => esc_html__( 'Curved', 'rhye' ),
			'straight' => esc_html__( 'Straight', 'rhye' ),
		),
	)
);
