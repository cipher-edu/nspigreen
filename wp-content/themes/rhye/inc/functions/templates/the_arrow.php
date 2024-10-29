<?php

/**
 * Markup for Circle Arrow
 */
if ( ! function_exists( 'arts_the_arrow' ) ) {
	function arts_the_arrow( $args ) {
		$defaults = array(
			'direction'  => 'right',
			'mini'       => false,
			'class'      => '',
			'attributes' => arts_get_element_cursor_attributes(
				array(
					'enabled'     => get_theme_mod( 'cursor_circle_arrows_enabled', true ),
					'scale'       => 0.0,
					'magnetic'    => true,
					'hide_native' => true,
				)
			),
		);

		$args        = wp_parse_args( $args, $defaults );
		$class_arrow = 'js-arrow arrow arrow-' . $args['direction'];
		$attrs_arrow = $args['attributes'];

		$class_pointer = 'arrow__pointer arrow-' . $args['direction'] . '__pointer';

		if ( $args['mini'] === true ) {
			$class_arrow .= ' arrow_mini';
		}

		?>
		<div class="<?php echo esc_attr( trim( $class_arrow ) ); ?>" <?php echo esc_attr( $attrs_arrow ); ?>>
			<?php get_template_part( 'template-parts/svg/svg', 'circle' ); ?>
			<div class="<?php echo esc_attr( $class_pointer ); ?>"></div>
			<div class="arrow__triangle"></div>
		</div>
		<?php
	}
}
