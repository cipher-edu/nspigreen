<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Masonry_Grid extends Rhye_Widget_Base {
	protected static $_instance = null;

	public function get_name() {
		return 'rhye-widget-masonry-grid';
	}

	public function get_title() {
		return esc_html__( 'Masonry Grid', 'rhye' );
	}

	public function get_icon() {
		return 'eicon-plug icon-rhye-widget-static';
	}

	public function get_categories() {
		return array( 'rhye-static' );
	}

	protected function register_controls() {

		/**
		 * Section Content
		 */
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Images', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		/**
		 * Gallery Lightbox
		 */
		$this->add_control(
			'gallery',
			array(
				'type'    => Controls_Manager::GALLERY,
				'default' => array(),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'label'   => esc_html__( 'Thumbnail Size', 'rhye' ),
				'name'    => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'full',
			)
		);

		$this->end_controls_section();

		/**
		 * Section Settings
		 */
		$this->start_controls_section(
			'settings_section',
			array(
				'label' => esc_html__( 'Settings', 'rhye' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			)
		);

		$this->add_control(
			'mode',
			array(
				'label'   => esc_html__( 'Mode', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'lightbox',
				'options' => array(
					''             => esc_html__( 'None', 'rhye' ),
					'lightbox'     => esc_html__( 'Lightbox', 'rhye' ),
					'external_url' => esc_html__( 'Open Page from "External URL" fields', 'rhye' ),
				),
			)
		);

		$this->add_control(
			'embed_external_url_lightbox_enabled',
			array(
				'label'     => esc_html__( 'Embed External URL Content to Lightbox', 'rhye' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'condition' => array(
					'mode' => 'lightbox',
				),
			)
		);

		$this->add_control(
			'mode_embed_external_url_lightbox_info',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'separator'       => 'after',
				'raw'             => sprintf(
					'%1$s<br><br>%2$s <a href="%3$s" target="_blank">%4$s</a>',
					esc_html__( 'The content from "External URL" field on the images will be embeded to lightbox.', 'rhye' ),
					esc_html__( 'Use "External URL" field on an image', 'rhye' ),
					admin_url( 'upload.php' ),
					esc_html__( 'in WordPress media library', 'rhye' )
				),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-success',
				'condition'       => array(
					'embed_external_url_lightbox_enabled' => 'yes',
				),
			)
		);

		$this->add_control(
			'mode_external_info',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'separator'       => 'after',
				'raw'             => sprintf(
					'%1$s <a href="%2$s" target="_blank">%3$s</a>',
					esc_html__( 'Use "External URL" field on an image to assign a page URL', 'rhye' ),
					admin_url( 'upload.php' ),
					esc_html__( 'in WordPress media library', 'rhye' )
				),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-success',
				'condition'       => array(
					'mode' => 'external_url',
				),
			)
		);

		/**
		 * Enable Captions
		 */
		$this->add_control(
			'captions_enabled',
			array(
				'label'   => esc_html__( 'Enable Image Captions', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'captions_style',
			array(
				'label'     => esc_html__( 'Captions Style', 'rhye' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'section-image__caption-horizontal',
				'options'   => array(
					'section-image__caption-horizontal'    => esc_html__( 'Horizontal', 'rhye' ),
					'section-image__caption-vertical-left' => esc_html__( 'Vertical Bottom Left', 'rhye' ),
					'section-image__caption-vertical-right' => esc_html__( 'Vertical Top Right', 'rhye' ),
				),
				'condition' => array(
					'captions_enabled' => 'yes',
				),
			)
		);

		$this->add_control(
			'captions_alignment',
			array(
				'label'     => esc_html__( 'Captions Alignment', 'rhye' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'text-left'   => array(
						'title' => esc_html__( 'Left', 'rhye' ),
						'icon'  => 'eicon-text-align-left',
					),
					'text-center' => array(
						'title' => esc_html__( 'Center', 'rhye' ),
						'icon'  => 'eicon-text-align-center',
					),
					'text-right'  => array(
						'title' => esc_html__( 'Right', 'rhye' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'text-center',
				'toggle'    => false,
				'condition' => array(
					'captions_enabled' => 'yes',
					'captions_style'   => 'section-image__caption-horizontal',
				),
			)
		);

		$this->add_control(
			'captions_position',
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
					'captions_enabled' => 'yes',
					'captions_style'   => 'section-image__caption-horizontal',
				),
			)
		);

		$this->add_control(
			'container_class_vertical',
			array(
				'type'         => Controls_Manager::HIDDEN,
				'default'      => 'elementor-widget_vertical-captions',
				'prefix_class' => '',
				'classes'      => '{{WRAPPER}}',
				'condition'    => array(
					'captions_enabled' => 'yes',
					'captions_style!'  => 'section-image__caption-horizontal',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Section Layout
		 */
		$this->start_controls_section(
			'layout_section',
			array(
				'label' => esc_html__( 'Layout', 'rhye' ),
				'tab'   => Controls_Manager::TAB_LAYOUT,
			)
		);

		$this->add_control(
			'fancy_enabled',
			array(
				'label'     => esc_html__( 'Enable Fancy Grid', 'rhye' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array(
					'columns!' => '12',
				),
			)
		);

		/**
		 * Columns
		 */
		$this->add_responsive_control(
			'columns',
			array(
				'label'           => esc_html__( 'Columns', 'rhye' ),
				'type'            => Controls_Manager::SELECT,
				'options'         => array(
					2       => esc_html__( 'Six Columns', 'rhye' ),
					'2dot4' => esc_html__( 'Five Columns', 'rhye' ),
					3       => esc_html__( 'Four Columns', 'rhye' ),
					4       => esc_html__( 'Three Columns', 'rhye' ),
					6       => esc_html__( 'Two Columns', 'rhye' ),
					12      => esc_html__( 'Single Column', 'rhye' ),
				),
				'render_type'     => 'template',
				'desktop_default' => 4,
				'tablet_default'  => 6,
				'mobile_default'  => 12,
			)
		);

		/**
		 * Space Between
		 */
		$this->add_responsive_control(
			'space_between',
			array(
				'label'           => esc_html__( 'Space Between', 'rhye' ),
				'type'            => Controls_Manager::SLIDER,
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
					'vw' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units'      => array( 'px', 'vw' ),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 6,
					'unit' => 'vw',
				),
				'tablet_default'  => array(
					'size' => 40,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 20,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}}.elementor-widget_vertical-captions .elementor-widget-container' => 'padding: 0 calc({{SIZE}}{{UNIT}});',
					// '{{WRAPPER}}'             => 'overflow: hidden;',
					'{{WRAPPER}} .grid'       => 'margin: calc(-{{SIZE}}{{UNIT}}) calc(-{{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .grid__item' => 'padding: calc({{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .grid_fancy .grid__item:nth-child(3)' => 'margin-top: {{SIZE}}{{UNIT}};',
					'(tablet){{WRAPPER}} .grid_fancy .grid__item:nth-child(3)' => 'margin-top: 0;',
					'(mobile){{WRAPPER}} .grid_fancy .grid__item:nth-child(3)' => 'margin-top: 0;',
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
				'label'   => esc_html__( 'Enable Parallax', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
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
					'size' => 1.6,
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
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'cursor_enabled' => 'yes',
					'cursor_helper'  => 'label',
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

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$col_desktop = 'grid__item_desktop-' . $settings['columns'];
		$col_tablet  = 'grid__item_tablet-' . $settings['columns_tablet'];
		$col_mobile  = 'grid__item_mobile-' . $settings['columns_mobile'];

		$this->add_render_attribute(
			'section',
			array(
				'class'                    => array( 'section', 'section-grid' ),
				'data-grid-columns'        => 12 / $this->translate_columns_settings( $settings['columns'] ),
				'data-grid-columns-tablet' => 12 / $this->translate_columns_settings( $settings['columns_tablet'] ),
				'data-grid-columns-mobile' => 12 / $this->translate_columns_settings( $settings['columns_mobile'] ),
			)
		);

		$this->add_render_attribute(
			'grid',
			array(
				'class' => array( 'grid', 'js-grid' ),
			)
		);

		$this->add_render_attribute(
			'sizerAtts',
			array(
				'class' => array( 'grid__sizer', 'js-grid__sizer', $col_desktop, $col_tablet, $col_mobile ),
			)
		);

		$this->add_render_attribute(
			'wrapperImg',
			array(
				'class' => array( 'figure-image__wrapper-img', 'mask-reveal' ),
			)
		);

		$this->add_render_attribute( 'caption', 'class', array( 'figure-image__caption', 'section-image__caption', 'hover-zoom__caption', $settings['captions_style'], $settings['captions_alignment'], $settings['caption_preset'] ) );

		if ( $settings['fancy_enabled'] ) {
			$this->add_render_attribute(
				'grid',
				array(
					'class' => array( 'grid_fancy' ),
				)
			);
		}

		if ( $settings['animation_enabled'] ) {

			$this->add_render_attribute(
				'section',
				array(
					'data-arts-os-animation' => 'true',
				)
			);
		}

		if ( $settings['mode'] === 'lightbox' ) {
			$this->add_render_attribute(
				'grid',
				array(
					'class' => array( 'js-gallery' ),
				)
			);
		}

		if ( $settings['mode'] === 'external_url' ) {
			$this->add_render_attribute(
				'grid',
				array(
					'class' => array( 'js-gallery_external-urls' ),
				)
			);
		}

		if ( $settings['captions_position'] === 'top' ) {
			$this->add_render_attribute( 'caption', 'class', 'section-image__caption-horizontal_top' );
		}

		?>

		<?php if ( ! empty( $settings['gallery'] ) ) : ?>
			<div <?php $this->print_render_attribute_string( 'section' ); ?>>
				<div <?php $this->print_render_attribute_string( 'grid' ); ?>>
					<div <?php $this->print_render_attribute_string( 'sizerAtts' ); ?>></div>
						<?php foreach ( $settings['gallery'] as $index => $image ) : ?>
							<?php
								$img           = wp_get_attachment_image_src( $image['id'], $settings['image_size'] );
								$title         = wp_get_attachment_caption( $image['id'] );
								$class_caption = '';

							if ( $settings['captions_enabled'] && ! empty( $title ) ) {
								$class_caption = 'grid__item_caption';
							}

							$this->add_render_attribute(
								'itemAtts',
								array(
									'class' => array( 'grid__item', 'js-grid__item', $col_desktop, $col_tablet, $col_mobile, $class_caption ),
								),
								true,
								true
							);

							?>
							<div <?php $this->print_render_attribute_string( 'itemAtts' ); ?>>
								<?php
								$tag = 'div';

								if ( ! empty( $settings['mode'] ) && $settings['cursor_enabled'] ) {
									$this->add_render_attribute(
										'wrapperOutter',
										arts_get_element_cursor_attributes(
											array(
												'enabled'  => 'true',
												'scale'    => $settings['cursor_scale']['size'],
												'magnetic' => false,
												'hide_native' => $settings['cursor_hide_native_enabled'],
												'label'    => $settings['cursor_label'],
												'icon_class' => $settings['cursor_icon'],
												'return'   => 'array',
											)
										),
										true,
										true
									);
								}

								if ( $settings['mode'] === 'lightbox' ) {

									$external_media = arts_get_field( 'external_media', $image['id'] );
									$img_full       = wp_get_attachment_image_src( $image['id'], 'full' );

									if ( $settings['embed_external_url_lightbox_enabled'] && ! empty( $external_media ) ) {

										$this->add_render_attribute(
											'wrapperOutter',
											array(
												'class' => array( 'hover-zoom', 'grid__item-link' ),
												'href'  => $external_media['url'],
												'data-autoplay' => 'true',
											),
											true,
											true
										);

									} else {

										$this->add_render_attribute(
											'wrapperOutter',
											array(
												'class' => array( 'hover-zoom', 'grid__item-link' ),
												'href'  => $img_full[0],
												'data-size' => $img_full[1] . 'x' . $img_full[2],
												'data-elementor-open-lightbox' => 'no',
											),
											true,
											true
										);

									}

									if ( $settings['captions_enabled'] && ! empty( $title ) ) {
										$this->add_render_attribute(
											'wrapperOutter',
											array(
												'data-title' => $title,
											),
											true,
											true
										);
									}

									$tag = 'a';
								}

								if ( $settings['mode'] === 'external_url' ) {

									$external_media = arts_get_field( 'external_media', $image['id'] );
									$img_full       = wp_get_attachment_image_src( $image['id'], 'full' );

									if ( ! empty( $external_media ) ) {
										$this->add_render_attribute(
											'wrapperOutter',
											array(
												'class'  => array( 'hover-zoom', 'grid__item-link' ),
												'href'   => $external_media['url'],
												'target' => $external_media['target'],
											),
											true,
											true
										);
									} else {
										$this->add_render_attribute(
											'wrapperOutter',
											array(
												'class' => array( 'hover-zoom', 'grid__item-link', 'no-ajax' ),
												'href'  => $img_full[0],
											),
											true,
											true
										);
									}

									$tag = 'a';
								}
								?>
								<div class="section-grid__item">
									<<?php echo $tag; ?> <?php $this->print_render_attribute_string( 'wrapperOutter' ); ?>>
										<div class="hover-zoom__inner">
											<div class="hover-zoom__zoom">
												<?php
													arts_the_lazy_image(
														array(
															'id' => $image['id'],
															'type' => 'image',
															'size' => $settings['image_size'],
															'class' => array(
																'section' => array( 'section', 'section-image', 'figure-image' ),
																'wrapper' => array( 'section-image__wrapper' ),
																'image' => array(),
															),
															'parallax' => array(
																'enabled' => $settings['image_parallax'],
																'factor'  => is_array( $settings['image_parallax_speed'] ) ? $settings['image_parallax_speed']['size'] : 0,
															),
															'animation' => false,
															'mask' => $settings['animation_enabled'] && $settings['animation_type'] === 'mask_reveal',
														)
													);
												?>
											</div>
										</div>
										<?php if ( $settings['captions_enabled'] && ! empty( $title ) ) : ?>
											<div <?php $this->print_render_attribute_string( 'caption' ); ?>>
												<?php
												if ( $settings['animation_enabled'] ) :
													?>
													<div class="figure-image__wrapper-caption"><?php endif; ?>
													<?php echo $title; ?>
												<?php
												if ( $settings['animation_enabled'] ) :
													?>
													</div><?php endif; ?>
											</div>
										<?php endif; ?>
									</<?php echo $tag; ?>>
								</div>
							</div>
						<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php
	}
}
