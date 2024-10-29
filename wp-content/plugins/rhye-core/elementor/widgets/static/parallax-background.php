<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Parallax_Background extends Rhye_Widget_Base {
	protected static $_instance = null;

	public function get_name() {
		return 'rhye-widget-parallax-background';
	}

	public function get_title() {
		return esc_html__( 'Parallax Background', 'rhye' );
	}

	public function get_icon() {
		return 'eicon-plug icon-rhye-widget-static';
	}

	public function get_categories() {
		return array( 'rhye-static' );
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
			'heading_background',
			array(
				'label' => esc_html__( 'Background', 'rhye' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'background_type',
			array(
				'label'   => esc_html__( 'Type', 'rhye' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'image' => array(
						'title' => esc_html__( 'Image', 'rhye' ),
						'icon'  => 'eicon-image-bold',
					),
					'video' => array(
						'title' => esc_html__( 'Video', 'rhye' ),
						'icon'  => 'eicon-video-camera',
					),
				),
				'default' => 'image',
				'toggle'  => false,
			)
		);

		$this->add_control(
			'image',
			array(
				'label'     => esc_html__( 'Choose Image', 'rhye' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'background_type' => 'image',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'label'     => esc_html__( 'Thumbnail Size', 'rhye' ),
				'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default'   => 'full',
				'condition' => array(
					'image!'          => array(
						'id'  => '',
						'url' => '',
					),
					'background_type' => 'image',
				),
			)
		);

		$this->add_control(
			'video',
			array(
				'label'      => esc_html__( 'Choose Video', 'rhye' ),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'video',
				'condition'  => array(
					'background_type' => 'video',
				),
			)
		);

		$this->add_control(
			'image_placement',
			array(
				'label'     => esc_html__( 'Element Placement', 'rhye' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'image'      => array(
						'title' => esc_html__( 'Preserve Aspect Ratio', 'rhye' ),
						'icon'  => 'eicon-image-before-after',
					),
					'background' => array(
						'title' => esc_html__( 'Cover Background', 'rhye' ),
						'icon'  => 'eicon-image',
					),
				),
				'default'   => 'image',
				'toggle'    => false,
				'condition' => array(
					'image!' => array(
						'id'  => '',
						'url' => '',
					),
				),
			)
		);

		$this->add_control(
			'fullwidth',
			array(
				'label'     => esc_html__( 'Enable Fullwidth', 'rhye' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'condition' => array(
					'background_type' => 'image',
					'image_placement' => 'image',
				),
				'selectors' => array(
					'{{WRAPPER}} .section-image__wrapper img' => 'width: 100%; height: auto;',
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
					'{{WRAPPER}} .section-image__wrapper' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'       => array(
					'image_placement' => 'background',
					'image!'          => array(
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
					'image_placement' => 'background',
					'image!'          => array(
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
					'image_placement' => 'background',
					'image!'          => array(
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
				'condition' => array(
					'image!' => array(
						'id'  => '',
						'url' => '',
					),
				),
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

		$this->add_control(
			'heading_caption',
			array(
				'label'     => esc_html__( 'Caption', 'rhye' ),
				'separator' => 'before',
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'image!' => array(
						'id'  => '',
						'url' => '',
					),
				),
			)
		);

		$this->add_control(
			'caption_enabled',
			array(
				'label'     => esc_html__( 'Enable Caption', 'rhye' ),
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
			'caption_style',
			array(
				'label'     => esc_html__( 'Caption Style', 'rhye' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'horizontal',
				'options'   => array(
					'horizontal' => esc_html__( 'Horizontal', 'rhye' ),
					'vertical'   => esc_html__( 'Vertical', 'rhye' ),
				),
				'condition' => array(
					'image!'          => array(
						'id'  => '',
						'url' => '',
					),
					'caption_enabled' => 'yes',
				),
			)
		);

		$this->add_control(
			'caption_position',
			array(
				'label'     => esc_html__( 'Captions Position', 'rhye' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'top'    => array(
						'title' => esc_html__( 'Top', 'rhye' ),
						'icon'  => 'eicon-v-align-top',
					),
					'bottom' => array(
						'title' => esc_html__( 'Bottom', 'rhye' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'   => 'bottom',
				'toggle'    => false,
				'condition' => array(
					'caption_enabled' => 'yes',
					'caption_style'   => 'horizontal',
				),
			)
		);

		$this->add_control(
			'message_incompatible_layout',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'The selected image layout may not display vertical captions due to no left/right block space. Please adjust your image layout.', 'rhye' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'condition'       => array(
					'caption_style' => 'vertical',
					'layout'        => 'section text-center',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'layout_section',
			array(
				'label' => esc_html__( 'Layout', 'rhye' ),
				'tab'   => Controls_Manager::TAB_LAYOUT,
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'   => esc_html__( 'Background Alignment', 'rhye' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'section text-center'       => array(
						'title' => esc_html__( 'Fullwidth', 'rhye' ),
						'icon'  => 'eicon-h-align-stretch',
					),
					'section_w-container-left'  => array(
						'title' => esc_html__( 'Left', 'rhye' ),
						'icon'  => 'eicon-h-align-left',
					),
					'container text-center'     => array(
						'title' => esc_html__( 'Center', 'rhye' ),
						'icon'  => 'eicon-h-align-center',
					),
					'section_w-container-right' => array(
						'title' => esc_html__( 'Right', 'rhye' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default' => 'section text-center',
				'toggle'  => false,
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
			'typography_caption',
			array(
				'label' => esc_html__( 'Caption', 'rhye' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'caption_preset',
			array(
				'label'   => esc_html__( 'Typography Preset', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'paragraph',
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

	}

	protected function render() {
		$settings        = $this->get_settings_for_display();
		$caption         = '';
		$classes_caption = array( 'section-image__caption', $settings['caption_preset'] );

		if ( $settings['caption_position'] === 'top' ) {
			$classes_caption[] = 'section-image__caption-horizontal_top';
		}

		if ( $settings['caption_enabled'] ) {

			if ( $settings['background_type'] === 'video' ) {
				$caption = wp_get_attachment_caption( $settings['video']['id'] );
			} else {
				$caption = wp_get_attachment_caption( $settings['image']['id'] );
			}

			switch ( $settings['layout'] ) {
				case 'section text-center': {
					if ( $settings['caption_style'] === 'vertical' ) {
						array_push( $classes_caption, 'section-image__caption-vertical-left' );
					} else {
						array_push( $classes_caption, 'section-image__caption-horizontal' );
					}
					break;
				}
				case 'section_w-container-left': {
					if ( $settings['caption_style'] === 'vertical' ) {
						array_push( $classes_caption, 'section-image__caption-vertical-right' );
					} else {
						array_push( $classes_caption, 'section-image__caption-horizontal' );
					}
					break;
				}
				case 'container text-center': {
					if ( $settings['caption_style'] === 'vertical' ) {
						array_push( $classes_caption, 'section-image__caption-vertical-left' );
					} else {
						array_push( $classes_caption, 'section-image__caption-horizontal' );
					}
					break;
				}
				case 'section_w-container-right': {
					if ( $settings['caption_style'] === 'vertical' ) {
						array_push( $classes_caption, 'section-image__caption-vertical-left' );
					} else {
						array_push( $classes_caption, 'section-image__caption-horizontal' );
					}
					break;
				}

			}
		}

		?>

		<?php if ( $settings['image_placement'] === 'background' ) : ?>
			<?php if ( $settings['background_type'] === 'video' ) : ?>
				<?php
					arts_the_lazy_image(
						array(
							'id'        => $settings['video']['id'],
							'type'      => 'background-video',
							'size'      => $settings['image_size'],
							'caption'   => $caption,
							'class'     => array(
								'section' => array( 'section', 'section-image', $settings['layout'] ),
								'wrapper' => array( 'section-image__wrapper' ),
								'image'   => array(),
								'caption' => $classes_caption,
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
			<?php else : ?>
				<?php
					arts_the_lazy_image(
						array(
							'id'        => $settings['image']['id'],
							'type'      => 'background',
							'size'      => $settings['image_size'],
							'caption'   => $caption,
							'class'     => array(
								'section' => array( 'section', 'section-image', $settings['layout'] ),
								'wrapper' => array( 'section-image__wrapper' ),
								'image'   => array(),
								'caption' => $classes_caption,
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
			<?php endif; ?>
		<?php elseif ( $settings['image_placement'] === 'image' ) : ?>
			<?php if ( $settings['background_type'] === 'video' ) : ?>
				<?php
					arts_the_lazy_image(
						array(
							'id'        => $settings['video']['id'],
							'type'      => 'video',
							'size'      => $settings['image_size'],
							'caption'   => $caption,
							'class'     => array(
								'section' => array( 'section', 'section-image', $settings['layout'] ),
								'wrapper' => array( 'section-image__wrapper' ),
								'image'   => array(),
								'caption' => $classes_caption,
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
			<?php else : ?>
				<?php
					arts_the_lazy_image(
						array(
							'id'        => $settings['image']['id'],
							'type'      => 'image',
							'size'      => $settings['image_size'],
							'caption'   => $caption,
							'class'     => array(
								'section' => array( 'section', 'section-image', $settings['layout'] ),
								'wrapper' => array( 'section-image__wrapper' ),
								'image'   => array(),
								'caption' => $classes_caption,
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
			<?php endif; ?>
		<?php endif; ?>

		<?php
	}
}
