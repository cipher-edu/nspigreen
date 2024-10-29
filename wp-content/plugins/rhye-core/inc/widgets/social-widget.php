<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Widget Social
 */
class Rhye_Widget_Social extends WP_Widget {
	function __construct() {
		parent::__construct(
			'rhye_social',
			esc_html__( 'Rhye: Social Media', 'rhye' ),
			array( 'description' => esc_html__( 'Displays social media icons', 'rhye' ) )
		);

		$this->socials = apply_filters(
			'arts/widgets/rhye_widget_social/icons',
			array(
				'facebook'    => array(
					'title' => esc_html__( 'Facebook URL', 'rhye' ),
					'icon'  => 'fab fa-facebook-f fa-fw',
				),
				'twitter'     => array(
					'title' => esc_html__( 'Twitter URL', 'rhye' ),
					'icon'  => 'fab fa-twitter fa-fw',
				),
				'instagram'   => array(
					'title' => esc_html__( 'Instagram URL', 'rhye' ),
					'icon'  => 'fab fa-instagram fa-fw',
				),
				'linkedin'    => array(
					'title' => esc_html__( 'LinkedIn URL', 'rhye' ),
					'icon'  => 'fab fa-linkedin fa-fw',
				),
				'google_plus' => array(
					'title' => esc_html__( 'Google Plus URL', 'rhye' ),
					'icon'  => 'fab fa-google-plus fa-fw',
				),
				'vk'          => array(
					'title' => esc_html__( 'VK URL', 'rhye' ),
					'icon'  => 'fab fa-vk fa-fw',
				),
				'youtube'     => array(
					'title' => esc_html__( 'YouTube URL', 'rhye' ),
					'icon'  => 'fab fa-youtube fa-fw',
				),
				'vimeo'       => array(
					'title' => esc_html__( 'Vimeo URL', 'rhye' ),
					'icon'  => 'fab fa-vimeo fa-fw',
				),
				'dribbble'    => array(
					'title' => esc_html__( 'Dribbble URL', 'rhye' ),
					'icon'  => 'fab fa-dribbble fa-fw',
				),
				'pinterest'   => array(
					'title' => esc_html__( 'Pinterest URL', 'rhye' ),
					'icon'  => 'fab fa-pinterest fa-fw',
				),
				'behance'     => array(
					'title' => esc_html__( 'Behance URL', 'rhye' ),
					'icon'  => 'fab fa-behance fa-fw',
				),
				'flickr'      => array(
					'title' => esc_html__( 'Flickr URL', 'rhye' ),
					'icon'  => 'fab fa-flickr fa-fw',
				),
				'tumblr'      => array(
					'title' => esc_html__( 'Tumblr URL', 'rhye' ),
					'icon'  => 'fab fa-tumblr fa-fw',
				),
				'vine'        => array(
					'title' => esc_html__( 'Vine URL', 'rhye' ),
					'icon'  => 'fab fa-vine fa-fw',
				),
				'github'      => array(
					'title' => esc_html__( 'Github URL', 'rhye' ),
					'icon'  => 'fab fa-github fa-fw',
				),
				'soundcloud'  => array(
					'title' => esc_html__( 'SoundCloud URL', 'rhye' ),
					'icon'  => 'fab fa-soundcloud fa-fw',
				),
				'telegram'    => array(
					'title' => esc_html__( 'Telegram URL', 'rhye' ),
					'icon'  => 'fab fa-telegram fa-fw',
				),
				'medium'      => array(
					'title' => esc_html__( 'Medium URL', 'rhye' ),
					'icon'  => 'fab fa-medium fa-fw',
				),
				'skype'       => array(
					'title' => esc_html__( 'Skype URL', 'rhye' ),
					'icon'  => 'fab fa-skype fa-fw',
				),
				'whatsapp'    => array(
					'title' => esc_html__( 'WhatsApp URL', 'rhye' ),
					'icon'  => 'fab fa-whatsapp fa-fw',
				),
				'slack'       => array(
					'title' => esc_html__( 'Slack URL', 'rhye' ),
					'icon'  => 'fab fa-slack fa-fw',
				),
				'tiktok'      => array(
					'title' => esc_html__( 'TikTok URL', 'rhye' ),
					'icon'  => 'fab fa-tiktok fa-fw',
				),
			)
		);

	}

	/**
	 * Social Medias
	 *
	 * @var array
	 */
	private $socials;

	/**
	 * Display widget on frontend
	 *
	 * @param array $args     widget arguments.
	 * @param array $instance saved data from settings
	 */
	function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$widget_id = $args['widget_id'];

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		?>
			<div class="social-wrapper">
				<ul class="social">
					<?php foreach ( $this->socials as $index => $item ) : ?>
						<?php $option = array_key_exists( $index, $instance ) ? $instance[ $index ] : ''; ?>
						<?php if ( ! empty( $option ) ) : ?>
							<li class="social__item">
								<a class="social__icon <?php echo esc_attr( $item['icon'] ); ?>" href="<?php echo esc_url( $option ); ?>" target="_blank"></a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Admin settings
	 *
	 * @param array $instance saved data from settings
	 */
	function form( $instance ) {

		$title = array_key_exists( 'title', $instance ) ? $instance['title'] : '';

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'rhye' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<br>
		<?php foreach ( $this->socials as $index => $item ) : ?>
			<?php
					$field_name  = $this->get_field_name( $index );
					$field_value = array_key_exists( $index, $instance ) ? $instance[ $index ] : '';
					$field_id    = $this->get_field_id( $index );
					$field_title = $item['title'];
			?>
				<p>
					<label for="<?php echo esc_html( $field_id ); ?>"><?php echo esc_html( $item['title'] ); ?></label>
					<input class="widefat" id="<?php echo esc_html( $field_id ); ?>" name="<?php echo esc_html( $field_name ); ?>" type="text" value="<?php echo esc_url( $field_value ); ?>">
				</p>
		<?php endforeach; ?>

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

		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		foreach ( $this->socials as $index => $item ) {

			$url                = $new_instance[ $index ];
			$instance[ $index ] = '';

			if ( ! empty( $url ) ) {
				$instance[ $index ] = esc_url( $url );
			}
		}

		return $instance;

	}
}
