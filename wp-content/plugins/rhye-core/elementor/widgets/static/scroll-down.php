<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Scroll_Down extends Rhye_Widget_Base {
	protected static $_instance = null;

	public function get_name() {
		return 'rhye-widget-scroll-down';
	}

	public function get_title() {
		return esc_html__( 'Scroll Down', 'rhye' );
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
					'field'       => 'button_text',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'Title', 'rhye' ) ),
					'editor_type' => 'LINE',
				),
				array(
					'field'       => 'button_link',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'Link', 'rhye' ) ),
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
			'button_section',
			array(
				'label' => esc_html__( 'Button', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'   => esc_html__( 'Title', 'rhye' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Button...', 'rhye' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'button_mode',
			array(
				'label'   => esc_html__( 'Mode', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'down',
				'options' => array(
					'down' => esc_html__( 'Scroll Down', 'rhye' ),
					'link' => esc_html__( 'Custom Link', 'rhye' ),
				),
			)
		);

		$this->add_control(
			'button_link',
			array(
				'label'         => esc_html__( 'Link', 'rhye' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => 'https://...',
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				),
				'dynamic'       => array(
					'active' => true,
				),
				'condition'     => array(
					'button_mode' => 'link',
				),
			)
		);

		$this->add_responsive_control(
			'button_alignment',
			array(
				'label'        => esc_html__( 'Alignment', 'rhye' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'rhye' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'rhye' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'rhye' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'prefix_class' => 'elementor%s-align-',
				'default'      => '',
				'toggle'       => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'cursor_section',
			array(
				'label' => esc_html__( 'Cursor', 'rhye' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'cursor_enabled',
			array(
				'label'   => esc_html__( 'Enable Cursor Interaction', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'cursor_hide_native_enabled',
			array(
				'label'     => esc_html__( 'Hide Native Cursor', 'rhye' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array(
					'cursor_enabled' => 'yes',
				),
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

		$tag = 'div';

		$this->add_render_attribute(
			'button',
			array(
				'class' => array( 'circle-button', 'js-circle-button', 'elementor-button-link' ),
			)
		);

		$this->add_render_attribute(
			'circle_button',
			array(
				'class' => array( 'circle-button__circle' ),
			)
		);

		if ( $settings['animation_enabled'] ) {
			$this->add_render_attribute( 'button', 'data-arts-os-animation', 'true' );
		}

		if ( $settings['button_mode'] === 'down' ) {
			$this->add_render_attribute( 'circle_button', 'data-arts-scroll-down', 'true' );
		}

		if ( $settings['button_mode'] === 'link' ) {
			$tag = 'a';
			$this->add_render_attribute( 'circle_button', 'href', esc_url( $settings['button_link']['url'] ) );

			if ( $settings['button_link']['is_external'] ) {
				$this->add_render_attribute( 'circle_button', 'target', '_blank' );
			}

			if ( $settings['button_link']['nofollow'] ) {
				$this->add_render_attribute( 'circle_button', 'rel', 'nofollow' );
			}
		}

		if ( $settings['cursor_enabled'] ) {
			$this->add_render_attribute( 'circle_button', 'data-arts-cursor', 'true' );
		}

		if ( $settings['cursor_hide_native_enabled'] ) {
			$this->add_render_attribute(
				'circle_button',
				array(
					'data-arts-cursor-hide-native' => 'true',
					'data-arts-cursor-scale'       => '0.0',
				)
			);
		}

		?>

		<div <?php $this->print_render_attribute_string( 'button' ); ?>>
			<!-- curved label -->
			<div class="circle-button__outer">
				<?php if ( $settings['button_text'] ) : ?>
					<div class="circle-button__wrapper-label">
						<div class="circle-button__label subheading"><?php echo esc_html( $settings['button_text'] ); ?></div>
					</div>
				<?php endif; ?>
			</div>
			<!-- - curved label -->
			<!-- geometry wrapper -->
			<div class="circle-button__inner">
				<<?php echo esc_attr( $tag ); ?> <?php $this->print_render_attribute_string( 'circle_button' ); ?>>
					<?php get_template_part( 'template-parts/svg/svg', 'circle' ); ?>
				</<?php echo esc_attr( $tag ); ?>>
				<!-- browsers WITH touch support -->
				<div class="circle-button__icon circle-button__icon-touch">
					<?php get_template_part( 'template-parts/svg/svg', 'arrow-down' ); ?>
				</div>
				<!-- - browsers WITH touch support -->
				<!-- - browsers WITHOUT touch support -->
				<div class="circle-button__icon circle-button__icon-mouse">
					<?php get_template_part( 'template-parts/svg/svg', 'mouse' ); ?>
				</div>
				<!-- - browsers WITHOUT touch support -->
			</div>
			<!-- - geometry wrapper -->
		</div>

		<?php
	}
}
