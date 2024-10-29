<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Albums_Covers_List extends Rhye_Widget_Base {
	protected static $_instance, $_posts;
	protected static $_post_type          = 'arts_album';
	protected static $_data_static_fields = array( 'title', 'permalink', 'image' );

	public function get_name() {
		return 'rhye-widget-albums-covers-list';
	}

	public function get_title() {
		return esc_html__( 'Albums Covers List', 'rhye' );
	}

	public function get_icon() {
		return 'eicon-sitemap icon-rhye-widget-dynamic';
	}

	public function get_categories() {
		return array( 'rhye-dynamic' );
	}

	public function wpml_widgets_to_translate_filter( $widgets ) {
		$name  = $this->get_name();
		$title = $this->get_title();

		$widgets[ $name ] = array(
			'conditions'        => array( 'widgetType' => $name ),
			'fields'            => array(
				array(
					'field'       => 'button_text',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'Button Title', 'rhye' ) ),
					'editor_type' => 'LINE',
				),
				array(
					'field'       => 'button_text_hover',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'Button Hover Title', 'rhye' ) ),
					'editor_type' => 'LINE',
				),
			),
			'integration-class' => 'WPML_Elementor_Rhye_Widget_Albums_Covers_List',
		);

		return $widgets;

	}

	public function add_wpml_support() {
		add_filter( 'wpml_elementor_widgets_to_translate', array( $this, 'wpml_widgets_to_translate_filter' ) );
	}

	protected function register_controls() {

		// posts toggles & posts amount
		$this->add_controls_posts_toggles();

		$this->start_controls_section(
			'button_section',
			array(
				'label' => esc_html__( 'Button', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'button_type',
			array(
				'label'       => esc_html__( 'Type', 'rhye' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'button' => esc_html__( 'Button', 'rhye' ),
					'arrow'  => esc_html__( 'Arrow', 'rhye' ),
				),
				'default'     => 'arrow',
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'     => esc_html__( 'Title', 'rhye' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'View Album', 'rhye' ),
				'separator' => 'before',
				'condition' => array(
					'button_type' => 'button',
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'button_text_hover',
			array(
				'label'     => esc_html__( 'Hover Title', 'rhye' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'View Album', 'rhye' ),
				'condition' => array(
					'button_type' => 'button',
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'button_style',
			array(
				'label'       => esc_html__( 'Style', 'rhye' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'button_solid'    => esc_html__( 'Solid', 'rhye' ),
					'button_bordered' => esc_html__( 'Bordered', 'rhye' ),
				),
				'default'     => 'button_bordered',
				'condition'   => array(
					'button_type' => 'button',
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
				'condition'   => array(
					'button_type' => 'button',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'source_section',
			array(
				'label' => esc_html__( 'Media Source', 'rhye' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			)
		);

		$this->add_control(
			'embed_external_url_lightbox_enabled',
			array(
				'label'   => esc_html__( 'Embed External URL Content to Lightbox', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
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

		$this->end_controls_section();

		$this->start_controls_section(
			'elements_section',
			array(
				'label' => esc_html__( 'Elements', 'rhye' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			)
		);

		$this->add_control(
			'button_enabled',
			array(
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Show Button', 'rhye' ),
				'default' => 'yes',
			)
		);

		$this->add_control(
			'counters_enabled',
			array(
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Show Counters', 'rhye' ),
				'default' => 'yes',
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
			'items_paddings',
			array(
				'label'   => esc_html__( 'Items Vertical Paddings', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'py-xsmall',
				'options' => array(
					''          => esc_html__( 'None', 'rhye' ),
					'py-xsmall' => esc_html__( '+ XSmall', 'rhye' ),
					'py-small'  => esc_html__( '+ Small', 'rhye' ),
					'py-medium' => esc_html__( '+ Medium', 'rhye' ),
					'py-large'  => esc_html__( '+ Large', 'rhye' ),
					'py-xlarge' => esc_html__( '+ XLarge', 'rhye' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'images_section',
			array(
				'label' => esc_html__( 'Images', 'rhye' ),
				'tab'   => Controls_Manager::TAB_LAYOUT,
			)
		);

		$this->add_control(
			'image_type',
			array(
				'label'   => esc_html__( 'Priority Image', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'primary',
				'options' => array(
					'primary'   => esc_html__( 'Primary Featured Image', 'rhye' ),
					'secondary' => esc_html__( 'Secondary Featured Image', 'rhye' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'label'   => esc_html__( 'Thumbnail Size', 'rhye' ),
				'name'    => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'medium',
			)
		);

		$this->add_control(
			'image_type_info',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(
					'%1$s<br><br>%2$s <a href="%3$s" target="_blank">%4$s</a>',
					esc_html__( 'If a secondary featured image is not set for a post then it will fallback to a primary featured image.', 'rhye' ),
					esc_html__( 'You can edit your posts and adjust the featured images', 'rhye' ),
					admin_url( 'edit.php?post_type=' . self::$_post_type ),
					esc_html__( 'in WordPress admin panel', 'rhye' )
				),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'condition'       => array(
					'image_type' => 'secondary',
				),
			)
		);

		$this->add_responsive_control(
			'image_max_width',
			array(
				'label'           => esc_html__( 'Maximum Width', 'rhye' ),
				'type'            => Controls_Manager::SLIDER,
				'desktop_default' => array(
					'size' => 240,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 180,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 180,
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
					'{{WRAPPER}} .list-projects__thumbnail' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'image_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'rhye' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'default'    => array(
					'size' => 100,
					'unit' => '%',
				),
				'selectors'  => array(
					'{{WRAPPER}} .block-circle' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
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
			'typography_section',
			array(
				'label' => esc_html__( 'Typography', 'rhye' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'typography_heading',
			array(
				'label' => esc_html__( 'Heading', 'rhye' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'heading_preset',
			array(
				'label'   => esc_html__( 'Typography Preset', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
			)
		);

		$this->add_control(
			'heading_tag',
			array(
				'label'   => esc_html__( 'HTML Tag', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => ARTS_THEME_HTML_TAGS_ARRAY,
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
		$posts    = $this->get_posts_to_display();

		$this->add_render_attribute( 'section', 'class', array( 'section', 'section-list' ) );

		if ( $settings['animation_enabled'] ) {
			$this->add_render_attribute( 'section', 'data-arts-os-animation', 'true' );
		}

		?>

		<?php if ( ! empty( $posts ) ) : ?>
			<div <?php $this->print_render_attribute_string( 'section' ); ?>>
				<div class="list-projects text-center text-md-left">
					<?php foreach ( $posts as $item ) : ?>
						<?php
							$item_has_gallery   = array_key_exists( 'media_gallery', $item ) && $item['media_gallery'];
							$item_gallery_count = 0;
							$image_id           = $this->get_priority_image_id_to_display( $item, $settings['image_type'] );
							$tag                = 'div';

							$this->add_render_attribute(
								'link',
								array(
									'class' => array( 'list-projects__item', 'hover-zoom', 'js-arrow', $settings['items_paddings'] ),
								),
								true,
								true
							);

						if ( array_key_exists( 'permalink', $item ) && $item['permalink'] ) {
							$tag = 'a';

							$this->add_render_attribute(
								'link',
								array(
									'href' => esc_url( $item['permalink'] ),
								),
								true,
								true
							);
						}

						if ( array_key_exists( 'permalink_attributes', $item ) ) {

							if ( array_key_exists( 'is_external', $item['permalink_attributes'] ) && $item['permalink_attributes']['is_external'] ) {
								$this->add_render_attribute( 'link', 'target', '_blank' );
								$this->remove_render_attribute( 'link', 'data-pjax-link' );
							} else {
								$this->remove_render_attribute( 'link', 'target' );
							}

							if ( array_key_exists( 'nofollow', $item['permalink_attributes'] ) && $item['permalink_attributes']['nofollow'] ) {
								$this->add_render_attribute( 'link', 'rel', 'nofollow' );
							} else {
								$this->remove_render_attribute( 'link', 'rel' );
							}
						}

							$this->add_render_attribute(
								'heading',
								array(
									'class'                => array( 'd-inline-block', 'list-projects__heading', 'js-split-text', 'split-text', 'mt-0-5', 'mb-0-5', $settings['heading_preset'] ),
									'data-split-text-type' => 'lines,words',
									'data-split-text-set'  => 'words',
								),
								true,
								true
							);

						if ( $item_has_gallery ) {
							$item_gallery_count = count( $item['media_gallery'] );
							$this->add_render_attribute( 'link', 'class', array( 'js-album' ) );
						}

						if ( $item_gallery_count > 0 ) {
							$this->add_render_attribute( 'heading', 'class', 'block-counter' );
						}

						?>
						<<?php echo esc_attr( $tag ); ?> <?php $this->print_render_attribute_string( 'link' ); ?>>
							<div class="row align-items-center justify-content-center justify-content-md-between no-gutters">
								<div class="col-md-10">
									<div class="row align-items-center justify-content-center justify-content-md-start">
										<?php if ( $image_id ) : ?>
											<!-- album cover -->
											<div class="col-auto">
												<div class="hover-zoom__inner block-circle overflow">
													<div class="hover-zoom__zoom">
														<?php
															arts_the_lazy_image(
																array(
																	'id' => $image_id,
																	'size' => $settings['image_size'],
																	'class' => array(
																		'wrapper' => array( 'list-projects__thumbnail' ),
																		'image' => array(),
																	),
																	'parallax'  => array(
																		'enabled' => $settings['image_parallax'],
																		'factor'  => is_array( $settings['image_parallax_speed'] ) ? $settings['image_parallax_speed']['size'] : 0,
																	),
																)
															)
														?>
													</div>
												</div>
											</div>
											<!-- - album cover -->
											<div class="w-100 d-md-none"></div>
										<?php endif; ?>
										<?php if ( ! empty( $item['title'] ) ) : ?>
											<!-- header -->
											<div class="list-projects__header col-md-auto col-12">
												<<?php $this->print_html_tag( 'heading_tag' ); ?> <?php $this->print_render_attribute_string( 'heading' ); ?>>
													<span><?php echo $item['title']; ?></span>
													<?php if ( $settings['counters_enabled'] && $item_gallery_count > 0 ) : ?>
														<span class="block-counter__counter"><?php echo esc_attr( $item_gallery_count ); ?></span>
													<?php endif; ?>
												</<?php $this->print_html_tag( 'heading_tag' ); ?>>
											</div>
											<!-- - header -->
										<?php endif; ?>
									</div>
								</div>
								<?php if ( $settings['button_enabled'] ) : ?>
									<div class="list-projects__wrapper-button">
										<?php if ( $settings['button_type'] === 'arrow' ) : ?>
											<?php
												arts_the_arrow(
													array(
														'direction'   => 'right',
													)
												);
											?>
										<?php else : ?>
											<?php
												$this->add_render_attribute(
													'button',
													array(
														'class' => array( 'button', $settings['button_style'], $settings['button_color'] ),
													),
													true,
													true
												);
											?>
											<div <?php $this->print_render_attribute_string( 'button' ); ?>>
												<span class="button__label-hover"><?php echo esc_attr( $settings['button_text'] ); ?></span>
											</div>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
							<?php if ( array_key_exists( 'media_gallery', $item ) && $item['media_gallery'] ) : ?>
								<!-- album photos -->
								<div class="js-album__items d-none">
									<?php foreach ( $item['media_gallery'] as $album_image ) : ?>
										<?php
											$external_media = arts_get_field( 'external_media', $album_image['id'] );

										if ( $settings['embed_external_url_lightbox_enabled'] && ! empty( $external_media ) ) {

											$this->add_render_attribute(
												'album_image',
												array(
													'src' => '#',
													'data-album-src' => $external_media['url'],
													'data-autoplay' => 'true',
													'alt' => '',
												),
												true,
												true
											);

										} else {

											$this->add_render_attribute(
												'album_image',
												array(
													'src' => '#',
													'data-album-src' => $album_image['url'],
													'width' => $album_image['width'],
													'height' => $album_image['height'],
													'data-title' => $album_image['caption'],
													'alt' => '',
												),
												true,
												true
											);

										}
										?>
										<img <?php $this->print_render_attribute_string( 'album_image' ); ?>/>
									<?php endforeach; ?>
								</div>
								<!-- - album photos -->
							<?php endif; ?>
						</<?php echo esc_attr( $tag ); ?>>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php
	}
}
