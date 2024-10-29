<?php

$priority = 1;

Kirki::add_field(
	'arts', array(
		'type'        => 'switch',
		'settings'    => 'cf_7_modals_enabled',
		'label'       => esc_html__( 'Enable Custom Modal Windows', 'rhye' ),
		'description' => esc_html__( 'Styled success and error windows that appear when a visitor submits a form', 'rhye' ),
		'section'     => 'contact_form_7',
		'default'     => true,
		'priority'    => $priority++,
	)
);
