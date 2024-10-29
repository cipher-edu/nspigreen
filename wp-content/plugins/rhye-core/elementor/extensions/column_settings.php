<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add new controls to Elementor columns
 */
add_action( 'elementor/element/column/layout/before_section_end', 'arts_add_responsive_column_order', 10, 2 );
function arts_add_responsive_column_order( $element, $args ) {
	$element->add_responsive_control(
		'responsive_column_order',
		array(
			'label'     => esc_html__( 'Responsive Column Order', 'rhye' ),
			'type'      => \Elementor\Controls_Manager::NUMBER,
			'separator' => 'before',
			'selectors' => array(
				'{{WRAPPER}}' => '-webkit-order: {{VALUE}}; -ms-flex-order: {{VALUE}}; order: {{VALUE}};',
			),
		)
	);
}
