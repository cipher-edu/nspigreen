<?php

$priority = 1;

Kirki::add_field(
	'arts', array(
		'type'     => 'switch',
		'settings' => 'static_page_gutters_enabled',
		'label'    => esc_html__( 'Enable Page Gutters', 'rhye' ),
		'section'  => 'static_pages',
		'default'  => true,
		'priority' => $priority++,
	)
);
