<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Widget CTA
 */
class Rhye_Widget_Call_To_Action extends WP_Widget {
	function __construct() {
		parent::__construct(
			'rhye_cta',
			esc_html__( 'Rhye: Call to Action', 'rhye' ),
			array( 'description' => esc_html__( 'Displays a content block with optional button.', 'rhye' ) ) // Args
		);
	}

	private $widget_fields = array(
		array(
			'label' => 'Heading',
			'id'    => 'heading_textarea',
			'type'  => 'textarea',
		),
		array(
			'label'   => 'Heading Preset',
			'id'      => 'heading_preset_select',
			'default' => 'h2',
			'type'    => 'select',
			'options' => array(
				'xl',
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
				'paragraph',
				'blockquote',
				'subheading',
				'small',
			),
		),
		array(
			'label' => 'Content',
			'id'    => 'content_textarea',
			'type'  => 'textarea',
		),
		array(
			'label' => 'Button Title',
			'id'    => 'button_title_text',
			'type'  => 'text',
		),
		array(
			'label' => 'Button Link',
			'id'    => 'button_link_url',
			'type'  => 'url',
		),
		array(
			'label'   => 'Open in New Window',
			'id'      => 'button_target_blank_checkbox',
			'default' => 'false',
			'type'    => 'checkbox',
		),
	);

	public function widget( $args, $instance ) {
		$button_attrs = '';

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		if ( array_key_exists( 'button_target_blank_checkbox', $instance ) && $instance['button_target_blank_checkbox'] ) {
			$button_attrs = 'target=_blank';
		}

		// Output generated fields
		?>

		<?php if ( ! empty( $instance['heading_textarea'] ) ) : ?>
			<h3 class="<?php echo esc_attr( $instance['heading_preset_select'] ); ?> mt-0 mb-0-5"><?php echo esc_html( $instance['heading_textarea'] ); ?></h3>
		<?php endif; ?>

		<?php if ( ! empty( $instance['content_textarea'] ) ) : ?>
			<p class="my-1"><?php echo esc_html( $instance['content_textarea'] ); ?></p>
		<?php endif; ?>

		<?php if ( ! empty( $instance['button_title_text'] ) ) : ?>
			<a class="button button_bordered bg-dark-1 mb-0-5" data-hover="<?php echo esc_html( $instance['button_title_text'] ); ?>" href="<?php echo esc_url( $instance['button_link_url'] ); ?>" <?php echo esc_attr( $button_attrs ); ?>>
				<span class="button__label-hover"><?php echo esc_html( $instance['button_title_text'] ); ?></span>
			</a>
		<?php endif; ?>

		<?php

		echo $args['after_widget'];
	}

	public function field_generator( $instance ) {
		$output = '';
		foreach ( $this->widget_fields as $widget_field ) {
			$default = '';
			if ( isset( $widget_field['default'] ) ) {
				$default = $widget_field['default'];
			}
			$widget_value = ! empty( $instance[ $widget_field['id'] ] ) ? $instance[ $widget_field['id'] ] : esc_html__( $default, 'rhye' );
			switch ( $widget_field['type'] ) {
				case 'checkbox':
					$output .= '<p>';
					$output .= '<input class="checkbox" type="checkbox" ' . checked( $widget_value, true, false ) . ' id="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field['id'] ) ) . '" value="1">';
					$output .= '<label for="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '">' . esc_attr( $widget_field['label'], 'rhye' ) . '</label>';
					$output .= '</p>';
					break;
				case 'textarea':
					$output .= '<p>';
					$output .= '<label for="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '">' . esc_attr( $widget_field['label'], 'rhye' ) . ':</label> ';
					$output .= '<textarea class="widefat" id="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field['id'] ) ) . '" rows="6" cols="6" value="' . esc_attr( $widget_value ) . '">' . $widget_value . '</textarea>';
					$output .= '</p>';
					break;
				case 'select':
					$output .= '<p>';
					$output .= '<label for="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '">' . esc_attr( $widget_field['label'], 'textdomain' ) . ':</label> ';
					$output .= '<select id="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field['id'] ) ) . '">';
					foreach ( $widget_field['options'] as $option ) {
						if ( $widget_value == $option ) {
							$output .= '<option value="' . $option . '" selected>' . $option . '</option>';
						} else {
							$output .= '<option value="' . $option . '">' . $option . '</option>';
						}
					}
					$output .= '</select>';
					$output .= '</p>';
					break;
				default:
					$output .= '<p>';
					$output .= '<label for="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '">' . esc_attr( $widget_field['label'], 'rhye' ) . ':</label> ';
					$output .= '<input class="widefat" id="' . esc_attr( $this->get_field_id( $widget_field['id'] ) ) . '" name="' . esc_attr( $this->get_field_name( $widget_field['id'] ) ) . '" type="' . $widget_field['type'] . '" value="' . esc_attr( $widget_value ) . '">';
					$output .= '</p>';
			}
		}
		echo $output;
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'rhye' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'rhye' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		$this->field_generator( $instance );
	}

	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		foreach ( $this->widget_fields as $widget_field ) {
			switch ( $widget_field['type'] ) {
				default:
					$instance[ $widget_field['id'] ] = ( ! empty( $new_instance[ $widget_field['id'] ] ) ) ? strip_tags( $new_instance[ $widget_field['id'] ] ) : '';
			}
		}
		return $instance;
	}

}
