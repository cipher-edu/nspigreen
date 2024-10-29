<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Lightbox_Video extends Rhye_Widget_Base {
	protected static $_instance = null;

	public function get_name() {
		return 'rhye-widget-lightbox-video';
	}

	public function get_title() {
		return esc_html__( 'Lightbox Video', 'rhye' );
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
					'field'       => 'cursor_label',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'Button/Cursor Label', 'rhye' ) ),
					'editor_type' => 'LINE',
				),
				array(
					'field'       => 'video_external',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'External Video URL', 'rhye' ) ),
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
				'label' => esc_html__( 'Background', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Background Image', 'rhye' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_responsive_control(
			'height',
			array(
				'label'           => esc_html__( 'Background Height', 'rhye' ),
				'type'            => Controls_Manager::SLIDER,
				'desktop_default' => array(
					'size' => 800,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 70,
					'unit' => 'vh',
				),
				'mobile_default'  => array(
					'size' => 50,
					'unit' => 'vh',
				),
				'range'           => array(
					'px' => array(
						'min' => 0,
						'max' => 1440,
					),
					'vh' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'size_units'      => array( 'px', 'vh' ),
				'selectors'       => array(
					'{{WRAPPER}} .section-video' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'       => array(
					'image!' => array(
						'id'  => '',
						'url' => '',
					),
				),
			)
		);

		$background_position_selectors = arts_elementor_should_selectors_have_responsive_prefixes() ? array(
			'(desktop) {{WRAPPER}} .section-image__wrapper img' => 'object-position: {{background_position_x.SIZE}}{{background_position_x.UNIT}} {{background_position_y.SIZE}}{{background_position_y.UNIT}};',
			'(tablet) {{WRAPPER}} .section-image__wrapper img' => 'object-position: {{background_position_x_tablet.SIZE}}{{background_position_x_tablet.UNIT}} {{background_position_y_tablet.SIZE}}{{background_position_y_tablet.UNIT}};',
			'(mobile) {{WRAPPER}} .section-image__wrapper img' => 'object-position: {{background_position_x_mobile.SIZE}}{{background_position_x_mobile.UNIT}} {{background_position_y_mobile.SIZE}}{{background_position_y_mobile.UNIT}};',
		) : array(
			'{{WRAPPER}} .section-image__wrapper img' => 'object-position: {{background_position_x.SIZE}}{{background_position_x.UNIT}} {{background_position_y.SIZE}}{{background_position_y.UNIT}};',
		);
		$this->add_responsive_control(
			'background_position_x',
			array(
				'label'           => esc_html__( 'Background Position X', 'rhye' ),
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'desktop_default' => array(
					'size' => 50,
					'unit' => '%',
				),
				'tablet_default'  => array(
					'size' => 50,
					'unit' => '%',
				),
				'mobile_default'  => array(
					'size' => 50,
					'unit' => '%',
				),
				'range'           => array(
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'size_units'      => array( '%' ),
				'selectors'       => $background_position_selectors,
				'condition'       => array(
					'image!' => array(
						'id'  => '',
						'url' => '',
					),
				),
			)
		);

		$this->add_responsive_control(
			'background_position_y',
			array(
				'label'           => esc_html__( 'Background Position Y', 'rhye' ),
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'desktop_default' => array(
					'size' => 50,
					'unit' => '%',
				),
				'tablet_default'  => array(
					'size' => 50,
					'unit' => '%',
				),
				'mobile_default'  => array(
					'size' => 50,
					'unit' => '%',
				),
				'range'           => array(
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'       => $background_position_selectors,
				'size_units'      => array( '%' ),
				'condition'       => array(
					'image!' => array(
						'id'  => '',
						'url' => '',
					),
				),
			)
		);

		$this->add_control(
			'heading_parallax',
			array(
				'label'     => esc_html__( 'Parallax', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'image_parallax',
			array(
				'label'     => esc_html__( 'Enable Parallax', 'rhye' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array(
					'image!' => array(
						'id'  => '',
						'url' => '',
					),
				),
			)
		);

		$this->add_control(
			'image_parallax_speed',
			array(
				'label'     => esc_html__( 'Parallax Speed', 'rhye' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'factor' => array(
						'min'  => -0.5,
						'max'  => 0.5,
						'step' => 0.01,
					),
				),
				'default'   => array(
					'unit' => 'factor',
					'size' => 0.1,
				),
				'condition' => array(
					'image_parallax' => 'yes',
					'image!'         => array(
						'id'  => '',
						'url' => '',
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'video_section',
			array(
				'label' => esc_html__( 'Video', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'video_type',
			array(
				'label'   => esc_html__( 'Video Type', 'rhye' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'self_hosted' => array(
						'title' => esc_html__( 'Self Hosted', 'rhye' ),
						'icon'  => 'eicon-video-camera',
					),
					'external'    => array(
						'title' => esc_html__( 'External Source', 'rhye' ),
						'icon'  => 'eicon-external-link-square',
					),
				),
				'default' => 'self_hosted',
				'toggle'  => false,
			)
		);

		$this->add_control(
			'video_self_hosted',
			array(
				'label'      => esc_html__( 'Choose Video', 'rhye' ),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'video',
				'condition'  => array(
					'video_type' => 'self_hosted',
				),
			)
		);

		$this->add_control(
			'video_external',
			array(
				'label'         => esc_html__( 'External Video URL (YouTube, Vimeo)', 'rhye' ),
				'type'          => Controls_Manager::URL,
				'show_external' => false,
				'condition'     => array(
					'video_type' => 'external',
				),
				'dynamic'       => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'video_autoplay_enabled',
			array(
				'label'   => esc_html__( 'Enable Autoplay', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
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

		$this->add_control(
			'animation_type',
			array(
				'label'     => esc_html__( 'Animation Type', 'rhye' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'mask_reveal' => esc_html__( 'Mask Reveal', 'rhye' ),
					'jump_up'     => esc_html__( 'Jump Up', 'rhye' ),
				),
				'default'   => 'mask_reveal',
				'condition' => array(
					'animation_enabled' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_section',
			array(
				'label' => esc_html__( 'Button', 'rhye' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'button_background_color',
			array(
				'label'   => esc_html__( 'Button Background', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bg-dark-1',
				'options' => ARTS_THEME_COLORS_ARRAY,
			)
		);

		$this->add_control(
			'button_label_color',
			array(
				'label'     => esc_html__( 'Label Color', 'rhye' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255,255,255,1)',
				'selectors' => array(
					'{{WRAPPER}} .section-video__link-inner' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'cursor_label',
			array(
				'label'   => esc_html__( 'Label Text', 'rhye' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Play', 'rhye' ),
				'dynamic' => array(
					'active' => true,
				),
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
			'cursor_scale',
			array(
				'label'     => esc_html__( 'Scale', 'rhye' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 3,
						'step' => 0.01,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 0.0,
				),
				'condition' => array(
					'cursor_enabled' => 'yes',
				),
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

		$this->end_controls_section();

	}

	protected function render() {

		$settings             = $this->get_settings_for_display();
		$video_url            = '#';
		$theme_cursor_enabled = get_theme_mod( 'cursor_enabled', false );

		if ( $settings['video_type'] === 'self_hosted' ) {
			$video_url = $settings['video_self_hosted']['url'];
		} else {
			$video_url = $settings['video_external']['url'];
		}

		$this->add_render_attribute(
			'link',
			array(
				'class' => 'section-video__link',
				'href'  => esc_url( $video_url ),
			)
		);

		if ( $settings['video_autoplay_enabled'] ) {
			$this->add_render_attribute(
				'link',
				array(
					'data-autoplay' => 'true',
				)
			);
		}

		$this->add_render_attribute(
			'play',
			array(
				'class'                  => array( 'section-video__link-inner', $settings['button_background_color'] ),
				'data-arts-cursor-label' => empty( $settings['cursor_label'] ) ? 'false' : $settings['cursor_label'],
				'data-arts-cursor-color' => $settings['button_label_color'],
			)
		);

		if ( $settings['cursor_enabled'] && $theme_cursor_enabled ) {
			$this->add_render_attribute(
				'play',
				arts_get_element_cursor_attributes(
					array(
						'enabled'     => 'true',
						'scale'       => $settings['cursor_scale']['size'],
						'magnetic'    => $settings['cursor_magnetic_enabled'],
						'hide_native' => $settings['cursor_hide_native_enabled'],
						'return'      => 'array',
					)
				)
			);
		}
		?>

		<div class="section section-video js-gallery">
			<div class="section-video__container">
				<a <?php $this->print_render_attribute_string( 'link' ); ?>>
					<div <?php $this->print_render_attribute_string( 'play' ); ?>>
						<div class="section-video__icon material-icons">play_arrow</div>
					</div>
				</a>
				<?php if ( ! empty( $settings['image']['id'] ) ) : ?>
					<div class="section__bg">
						<?php
							arts_the_lazy_image(
								array(
									'id'        => $settings['image']['id'],
									'class'     => array(
										'section' => array( 'section', 'section-image', 'section__bg' ),
										'wrapper' => array( 'section-image__wrapper' ),
									),
									'parallax'  => array(
										'enabled' => $settings['image_parallax'],
										'factor'  => is_array( $settings['image_parallax_speed'] ) ? $settings['image_parallax_speed']['size'] : 0,
									),
									'animation' => $settings['animation_enabled'],
									'mask'      => $settings['animation_enabled'] && $settings['animation_type'] === 'mask_reveal',
								)
							);
						?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php
	}
}
