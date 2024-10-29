<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Circle_Button extends Rhye_Widget_Base {
	protected static $_instance = null;

	public function get_name() {
		return 'rhye-widget-circle-button';
	}

	public function get_title() {
		return esc_html__( 'Circle Button', 'rhye' );
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
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'       => esc_html__( 'Color', 'rhye' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT,
				'options'     => ARTS_THEME_COLORS_ARRAY,
				'default'     => 'bg-dark-1',
			)
		);

		$this->add_responsive_control(
			'button_width_height',
			array(
				'label'           => esc_html__( 'Button Size', 'rhye' ),
				'type'            => Controls_Manager::SLIDER,
				'desktop_default' => array(
					'size' => 120,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 100,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 90,
					'unit' => 'px',
				),
				'range'           => array(
					'px' => array(
						'min' => 0,
						'max' => 1440,
					),
				),
				'size_units'      => array( 'px' ),
				'selectors'       => array(
					'{{WRAPPER}} .circle-button_link' => 'width: calc({{SIZE}}{{UNIT}} - 10px); height: calc({{SIZE}}{{UNIT}} - 10px);',
					'{{WRAPPER}} .circle-button_link .circle-button__inner .svg-circle' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
				'render_type'     => 'template',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'typography_section',
			array(
				'label' => esc_html__( 'Typography', 'rhye' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'typography_name',
			array(
				'label' => esc_html__( 'Title', 'rhye' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'title_preset',
			array(
				'label'   => esc_html__( 'Typography Preset', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'subheading',
				'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
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

		$this->add_control(
			'cursor_magnetic_enabled',
			array(
				'label'     => esc_html__( 'Enable Magnetic Effect', 'rhye' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array(
					'cursor_enabled' => 'yes',
				),
			)
		);

		$this->add_control(
			'cursor_helper',
			array(
				'label'     => esc_html__( 'Cursor Helper', 'rhye' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'icon',
				'options'   => array(
					''      => esc_html__( 'None', 'rhye' ),
					'label' => esc_html__( 'Label', 'rhye' ),
					'icon'  => esc_html__( 'Icon', 'rhye' ),
				),
				'condition' => array(
					'cursor_enabled' => 'yes',
				),
			)
		);

		$this->add_control(
			'cursor_label',
			array(
				'label'     => esc_html__( 'Label', 'rhye' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'condition' => array(
					'cursor_enabled' => 'yes',
					'cursor_helper'  => 'label',
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'cursor_icon',
			array(
				'label'     => esc_html__( 'Icon', 'rhye' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'material-icons add',
				'condition' => array(
					'cursor_enabled' => 'yes',
					'cursor_helper'  => 'icon',
				),
			)
		);

		$this->add_control(
			'cursor_color',
			array(
				'label'     => esc_html__( 'Color', 'rhye' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'condition' => array(
					'cursor_enabled' => 'yes',
					'cursor_helper!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .circle-button__icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings             = $this->get_settings_for_display();
		$tag                  = 'div';
		$theme_cursor_enabled = get_theme_mod( 'cursor_enabled', false );

		$this->add_render_attribute( 'button', 'class', array( 'circle-button', 'circle-button_link', 'js-circle-button', $settings['button_color'], $settings['title_preset'] ) );
		$this->add_render_attribute(
			'svg_circle',
			array(
				'class'       => array( 'svg-circle', 'border-none', $settings['button_color'] ),
				'viewBox'     => '0 0 60 60',
				'version'     => '1.1',
				'xmlns'       => 'http://www.w3.org/2000/svg',
				'xmlns:xlink' => 'http://www.w3.org/1999/xlink',
			)
		);

		$this->add_render_attribute( 'touch_icon_wrapper', 'class', 'circle-button__icon' );

		if ( $theme_cursor_enabled ) {
			$this->add_render_attribute( 'touch_icon_wrapper', 'class', 'circle-button__icon-touch' );
		}

		if ( ! empty( $settings['button_link']['url'] ) ) {
			$tag = 'a';

			$this->add_render_attribute(
				'button',
				array(
					'href' => esc_url( $settings['button_link']['url'] ),
				)
			);

			if ( $settings['button_link']['is_external'] ) {
				$this->add_render_attribute( 'button', 'target', '_blank' );
			}

			if ( $settings['button_link']['nofollow'] ) {
				$this->add_render_attribute( 'button', 'rel', 'nofollow' );
			}
		}

		if ( ! empty( $settings['cursor_label'] ) ) {
			$this->add_render_attribute(
				'button',
				array(
					'data-arts-cursor-label' => $settings['cursor_label'],
				)
			);
		}

		if ( $settings['cursor_enabled'] ) {
			$this->add_render_attribute(
				'button',
				arts_get_element_cursor_attributes(
					array(
						'enabled'     => 'true',
						'scale'       => '0',
						'magnetic'    => $settings['cursor_magnetic_enabled'],
						'hide_native' => $settings['cursor_hide_native_enabled'],
						'icon_class'  => $settings['cursor_icon'],
						'color'       => $settings['cursor_color'],
						'return'      => 'array',
					)
				)
			);
		}

		if ( $settings['cursor_icon'] ) {
			$this->add_render_attribute( 'touch_icon', 'class', $settings['cursor_icon'] );
			$this->add_render_attribute( 'touch_icon_wrapper', 'data-arts-cursor-color', $settings['cursor_color'] );
		}

		if ( $settings['animation_enabled'] ) {
			$this->add_render_attribute( 'button', 'data-arts-os-animation', 'true' );
		}

		?>

		<<?php echo $tag; ?> <?php $this->print_render_attribute_string( 'button' ); ?>>
			<?php if ( ! empty( $settings['button_text'] ) ) : ?>
				<!-- curved label -->
				<div class="circle-button__outer">
					<div class="circle-button__wrapper-label">
						<div class="circle-button__label"><?php echo $settings['button_text']; ?></div>
					</div>
				</div>
				<!-- - curved label -->
			<?php endif; ?>
			<!-- geometry wrapper -->
			<div class="circle-button__inner">
				<div class="circle-button__circle">
					<svg <?php $this->print_render_attribute_string( 'svg_circle' ); ?>>
						<circle class="circle" cx="30" cy="30" r="29" fill="none"></circle>
					</svg>
				</div>
				<?php if ( $settings['cursor_icon'] ) : ?>
					<!-- browsers with touch support -->
					<div <?php $this->print_render_attribute_string( 'touch_icon_wrapper' ); ?>>
						<div <?php $this->print_render_attribute_string( 'touch_icon' ); ?>></div>
					</div>
					<!-- - browsers with touch support -->
				<?php endif; ?>
			</div>
			<!-- - geometry wrapper -->
		</<?php echo $tag; ?>>

		<?php
	}
}
