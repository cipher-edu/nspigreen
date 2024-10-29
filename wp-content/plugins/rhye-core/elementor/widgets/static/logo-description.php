<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Logo_Description extends Rhye_Widget_Base {
	protected static $_instance = null;

	public function get_name() {
		return 'rhye-widget-logo-description';
	}

	public function get_title() {
		return esc_html__( 'Logo Description', 'rhye' );
	}

	public function get_icon() {
		return 'eicon-plug icon-rhye-widget-static';
	}

	public function get_categories() {
		return array( 'rhye-static' );
	}

	public function wpml_widgets_to_translate_filter( $widgets ) {
		$name  = $this->get_name();
		$title = $this->get_title();

		$widgets[ $name ] = array(
			'conditions' => array( 'widgetType' => $name ),
			'fields'     => array(
				array(
					'field'       => 'description',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'Short Description', 'rhye' ) ),
					'editor_type' => 'LINE',
				),
			),
		);

		return $widgets;
	}

	public function add_wpml_support() {
		add_filter( 'wpml_elementor_widgets_to_translate', array( $this, 'wpml_widgets_to_translate_filter' ) );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Choose Image', 'rhye' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => esc_html__( 'Short Description', 'rhye' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Company...', 'rhye' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			array(
				'label' => esc_html__( 'Style', 'rhye' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'grayscale_enabled',
			array(
				'label'        => esc_html__( 'Enable Grayscale Filter', 'rhye' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'grayscale',
				'default'      => 'grayscale',
			)
		);

		$this->add_control(
			'background_theme',
			array(
				'label'   => esc_html__( 'Background Color', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'options' => ARTS_THEME_COLORS_ARRAY,
				'default' => 'bg-white',
			)
		);

		$this->add_control(
			'background_hover_theme',
			array(
				'label'   => esc_html__( 'Hover Background Color', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'options' => ARTS_THEME_COLORS_ARRAY,
				'default' => 'bg-dark-3',
			)
		);

		$this->add_control(
			'background_hover_main_theme',
			array(
				'label'   => esc_html__( 'Hover Main Elements Color', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'light',
				'options' => ARTS_THEME_COLOR_THEMES_ARRAY,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'animation_section',
			array(
				'label' => esc_html__( 'Animation', 'rhye' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'animation_enabled',
			array(
				'label'   => esc_html__( 'Enable On-scroll Animation', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'section', 'class', array( 'section', 'section-content', 'text-center' ) );
		$this->add_render_attribute( 'wrapper', 'class', array( 'figure-logo', $settings['grayscale_enabled'], $settings['background_theme'] ) );
		$this->add_render_attribute(
			'description',
			array(
				'class'                => array( 'figure-logo__description', $settings['background_hover_theme'] ),
				'data-arts-theme-text' => $settings['background_hover_main_theme'],
			)
		);

		if ( ! empty( $settings['description'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'figure-logo_has-description' );
		}

		if ( $settings['animation_enabled'] ) {
			$this->add_render_attribute( 'section', 'data-arts-os-animation', 'true' );
		}

		?>

		<?php if ( ! empty( $settings['image']['url'] ) ) : ?>
			<div <?php $this->print_render_attribute_string( 'section' ); ?>>
				<div class="section-content__image">
					<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
						<div class="figure-logo__wrapper-img">
							<?php echo wp_get_attachment_image( $settings['image']['id'], 'full' ); ?>
						</div>
						<?php if ( ! empty( $settings['description'] ) ) : ?>
							<div <?php $this->print_render_attribute_string( 'description' ); ?>>
								<div class="figure-logo__description-content"><?php echo $settings['description']; ?></div>
								<div class="figure-logo__line"></div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php
	}
}
