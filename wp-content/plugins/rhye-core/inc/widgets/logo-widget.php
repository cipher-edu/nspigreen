<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Widget Logo
 */
class Rhye_Widget_Logo extends WP_Widget {
	function __construct() {
		parent::__construct(
			'rhye_logo',
			esc_html__( 'Rhye: Logo + Text', 'rhye' ),
			array( 'description' => esc_html__( 'Displays your logo and an optional short description.', 'rhye' ) )
		);
	}

	/**
	 * Display widget on frontend
	 *
	 * @param array $args     widget arguments.
	 * @param array $instance saved data from settings
	 */
	function widget( $args, $instance ) {

		$text = ( ! empty( $instance['text'] ) ) ? $instance['text'] : '';

		?>

		<?php
			echo $args['before_widget'];
			get_template_part( 'template-parts/logo/logo' );
		?>

		<?php if ( ! empty( $text ) ) : ?>
			<p><?php echo esc_html( $text ); ?></p>
		<?php endif; ?>

		<?php
			echo $args['after_widget'];
	}


	/**
	 * Admin settings
	 *
	 * @param array $instance saved data from settings
	 */
	function form( $instance ) {

		$text = @ $instance['text'] ? : '';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php esc_html_e( 'Text', 'rhye' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_attr( $text ); ?></textarea>
		</p>
		<?php
	}

	/**
	 * Sanitize and save widget settings.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance new settings
	 * @param array $old_instance previous settings
	 *
	 * @return array data to save
	 */
	function update( $new_instance, $old_instance ) {

		$instance         = array();
		$instance['text'] = ( ! empty( $new_instance['text'] ) ) ? esc_html( $new_instance['text'] ) : '';

		return $instance;

	}

}
