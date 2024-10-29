<?php

$priority = 1;

Kirki::add_field(
	'arts', array(
		'type'     => 'text',
		'label'    => esc_html__( 'Label', 'rhye' ),
		'description' => esc_html__( 'Used for masthead scroll down button on: Pages, Portfolio Items, Services, Albums.', 'rhye' ),
		'settings' => 'label_scroll_down_pages',
		'section'  => 'scroll_down',
		'priority' => $priority++,
		'default' => esc_html__( 'Scroll Down', 'rhye' )
	)
);
