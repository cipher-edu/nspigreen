<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'widgets_init', 'arts_register_widgets' );
function arts_register_widgets() {
	$widgets = array(
		'logo'   => 'Rhye_Widget_Logo',
		'social' => 'Rhye_Widget_Social',
		'cta'    => 'Rhye_Widget_Call_To_Action',
	);

	foreach ( $widgets as $index => $value ) {

		require_once __DIR__ . '/widgets/' . sanitize_key( $index ) . '-widget.php';
		register_widget( $value );
	}
}
