<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Albums_Mouse_Hover_Reveal extends Rhye_Widget_Base {
	protected static $_instance, $_posts;
	protected static $_post_type          = 'arts_album';
	protected static $_data_static_fields = array( 'title', 'permalink' );

	public function get_name() {
		return 'rhye-widget-albums-mouse-hover-reveal';
	}

	public function get_title() {
		return esc_html__( 'Albums Mouse Hover Reveal', 'rhye' );
	}

	public function get_icon() {
		return 'eicon-sitemap icon-rhye-widget-dynamic';
	}

	public function get_categories() {
		return array( 'rhye-dynamic' );
	}

	public function wpml_widgets_to_translate_filter( $widgets ) {
		$name = $this->get_name();

		$widgets[ $name ] = array(
			'conditions'        => array( 'widgetType' => $name ),
			'integration-class' => 'WPML_Elementor_Rhye_Widget_Albums_Mouse_Hover_Reveal',
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
			'thumbnails_enabled',
			array(
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Show Thumbnails on Hover', 'rhye' ),
				'default' => 'yes',
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'label'     => esc_html__( 'Thumbnails Size', 'rhye' ),
				'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default'   => 'medium',
				'condition' => array(
					'thumbnails_enabled' => 'yes',
				),
			)
		);

		$this->add_control(
			'thumbnails_amount',
			array(
				'label'     => esc_html__( 'Number of Thumbnails to Display', 'rhye' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'number' => array(
						'min'  => 1,
						'max'  => 16,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'number',
					'size' => 3,
				),
				'condition' => array(
					'thumbnails_enabled' => 'yes',
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

	private function get_hover_thumbnails_to_display( $items, $max_num_items ) {
		if ( ! is_array( $items ) || empty( $items ) ) {
			return array();
		}

		// filter out not images
		$items = array_filter(
			$items,
			function( $item ) {
				return array_key_exists( 'id', $item ) && wp_attachment_is_image( $item['id'] );
			}
		);

		// limit array
		$items = array_slice( $items, 0, $max_num_items );

		return $items;
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
				<div class="list-projects list-albums text-center js-list-thumbs">
					<!-- items -->
					<div class="list-projects__items">
						<?php foreach ( $posts as $item ) : ?>
							<?php
								$item_has_gallery   = array_key_exists( 'media_gallery', $item ) && $item['media_gallery'];
								$item_gallery_count = 0;
								$tag                = 'div';

								$this->add_render_attribute(
									'link',
									array(
										'class' => array( 'list-projects__item', $settings['items_paddings'], 'js-list-thumbs__link' ),
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

							if ( array_key_exists( 'id', $item ) ) {
								$this->add_render_attribute(
									'link',
									array(
										'data-post-id' => $item['id'],
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
										'class' => array( 'd-inline-block', 'list-projects__heading', 'js-split-text', 'split-text', 'mt-0-5', 'mb-0-5', $settings['heading_preset'] ),
										'data-split-text-type' => 'lines,words',
										'data-split-text-set' => 'words',
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
					<!-- - items -->
					<?php if ( $settings['thumbnails_enabled'] ) : ?>
						<!-- hover thumbnails -->
						<div class="list-project__canvas js-list-thumbs__covers" data-arts-scroll-fixed="true">
							<?php foreach ( $posts as $item ) : ?>
								<div class="list-projects__covers">
									<?php if ( array_key_exists( 'media_gallery', $item ) && $item['media_gallery'] ) : ?>
										<?php $album_images = $this->get_hover_thumbnails_to_display( $item['media_gallery'], $settings['thumbnails_amount']['size'] ); ?>
										<?php foreach ( $album_images as $image ) : ?>
											<div class="list-projects__cover-reveal js-list-thumbs__cover" data-background-for="<?php echo esc_attr( $item['id'] ); ?>">
												<?php
													arts_the_lazy_image(
														array(
															'id' => $image['id'],
															'type' => 'image',
															'size' => $settings['image_size'],
															'class' => array(
																'wrapper' => array( 'list-projects__cover-wrapper' ),
															),
														)
													);
												?>
											</div>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
						<!-- - hover thumbnails -->
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php
	}
}
