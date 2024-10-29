<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Portfolio_Mouse_Hover_Reveal extends Rhye_Widget_Base {
	protected static $_instance, $_posts;
	protected static $_post_type          = 'arts_portfolio_item';
	protected static $_data_static_fields = array( 'title', 'subheading', 'permalink', 'image' );

	public function get_name() {
		return 'rhye-widget-portfolio-mouse-hover-reveal';
	}

	public function get_title() {
		return esc_html__( 'Portfolio Mouse Hover Reveal', 'rhye' );
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
			'integration-class' => 'WPML_Elementor_Rhye_Widget_Portfolio_Mouse_Hover_Reveal',
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
					'button'        => esc_html__( 'Button', 'rhye' ),
					'link_category' => esc_html__( 'Category as Link', 'rhye' ),
				),
				'default'     => 'button',
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'     => esc_html__( 'Title', 'rhye' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Explore Project', 'rhye' ),
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
				'label'   => esc_html__( 'Hover Title', 'rhye' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Explore Project', 'rhye' ),
				'dynamic' => array(
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
			'elements_section',
			array(
				'label' => esc_html__( 'Elements', 'rhye' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			)
		);

		$this->add_control(
			'categories_enabled',
			array(
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Show Categories', 'rhye' ),
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
				'default' => 'py-small',
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
				'default' => 'rhye-1920-1280-crop',
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

		$this->end_controls_section();

		$this->start_controls_section(
			'effect_section',
			array(
				'label' => esc_html__( 'Effect', 'rhye' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'transition_effect_intensity',
			array(
				'label'   => esc_html__( 'Effect Intensity', 'rhye' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.01,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 0.35,
				),
			)
		);

		$this->add_control(
			'transition_effect_scale_texture',
			array(
				'label'   => esc_html__( 'Texture Scale Factor', 'rhye' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'px' => array(
						'min'  => 0,
						'max'  => 2,
						'step' => 0.01,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 1.2,
				),
			)
		);

		$this->add_control(
			'transition_effect_scale_plane',
			array(
				'label'   => esc_html__( 'Plane Height (vh)', 'rhye' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'vh' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default' => array(
					'unit' => 'vh',
					'size' => 33,
				),
			)
		);

		$this->add_control(
			'transition_retina_enabled',
			array(
				'label'       => esc_html__( 'Enable Retina Support', 'rhye' ),
				'description' => esc_html__( 'Make the textures to render at the actual display pixel density. Please note that this option may negatively impact the performance on low-end devices.', 'rhye' ),
				'type'        => Controls_Manager::SWITCHER,
				'default'     => '',
			)
		);

		$this->add_control(
			'transition_effect_enabled_at',
			array(
				'label'       => esc_html__( 'Effect enabled at screen width', 'rhye' ),
				'description' => esc_html__( 'Minimum screen width in pixels (min-width: XXX)', 'rhye' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => array(
					'px' => array(
						'min'  => 320,
						'max'  => 1920,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 768,
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ajax_section',
			array(
				'label' => esc_html__( 'AJAX Transition', 'rhye' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'ajax_image_transition_enabled',
			array(
				'label'   => esc_html__( 'Enable Seamless Image Transition', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
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
				'default' => 'h2',
				'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
			)
		);

		$this->add_control(
			'heading_tag',
			array(
				'label'   => esc_html__( 'HTML Tag', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => ARTS_THEME_HTML_TAGS_ARRAY,
			)
		);

		$this->add_control(
			'typography_category',
			array(
				'label'     => esc_html__( 'Category', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'category_preset',
			array(
				'label'   => esc_html__( 'Typography Preset', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'subheading',
				'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
			)
		);

		$this->add_control(
			'category_tag',
			array(
				'label'   => esc_html__( 'HTML Tag', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'div',
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
		$settings          = $this->get_settings_for_display();
		$posts             = $this->get_posts_to_display();
		$is_button_labeled = ! empty( $settings['button_text'] ) || ! empty( $settings['button_text_hover'] );

		$this->add_render_attribute( 'section', 'class', array( 'section', 'section-list' ) );

		$this->add_render_attribute(
			'heading',
			array(
				'class'                => array( 'list-projects__heading', 'js-split-text', 'split-text', $settings['heading_preset'] ),
				'data-split-text-type' => 'lines, words',
				'data-split-text-set'  => 'words',

			)
		);

		$this->add_render_attribute(
			'category',
			array(
				'class'                => array( 'list-projects__subheading', 'split-text', 'js-split-text', 'mb-1', $settings['category_preset'] ),
				'data-split-text-type' => 'lines, words',
				'data-split-text-set'  => 'words',
			)
		);

		$this->add_render_attribute(
			'wrapper',
			array(
				'class'                         => array( 'list-projects', 'js-list-hover' ),
				'data-arts-hover-strength'      => floatval( $settings['transition_effect_intensity']['size'] ),
				'data-arts-hover-scale-texture' => floatval( $settings['transition_effect_scale_texture']['size'] ),
				'data-arts-hover-scale-plane'   => floatval( $settings['transition_effect_scale_plane']['size'] / 100 ),
				'data-arts-hover-enabled-at'    => $settings['transition_effect_enabled_at']['size'],
			)
		);

		$this->add_render_attribute(
			'button',
			array(
				'class' => array( 'button', $settings['button_style'], $settings['button_color'] ),
			)
		);

		$this->add_render_attribute(
			'header',
			array(
				'class' => array( 'list-projects__header', 'mt-1', 'mt-md-0' ),
			)
		);

		if ( $is_button_labeled ) {
			$this->add_render_attribute( 'col_header', 'class', 'col-lg-8' );
			$this->add_render_attribute(
				'header',
				array(
					'class' => array( 'mb-1', 'mb-md-0' ),
				)
			);
		} else {
			$this->add_render_attribute( 'col_header', 'class', 'col-12' );
		}

		if ( $settings['button_text_hover'] ) {
			$this->add_render_attribute( 'button', 'data-hover', $settings['button_text_hover'] );
		}

		if ( $settings['animation_enabled'] ) {
			$this->add_render_attribute(
				'section',
				array(
					'data-arts-os-animation' => 'true',
				)
			);
		}

		if ( $settings['transition_retina_enabled'] ) {
			$this->add_render_attribute(
				'wrapper',
				array(
					'data-arts-hover-retina-enabled' => 'true',
				)
			);
		}

		?>

		<div <?php $this->print_render_attribute_string( 'section' ); ?>>
			<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
				<div class="list-projects__items">
					<?php foreach ( $posts as $index => $item ) : ?>
						<?php
							$image_id = $this->get_priority_image_id_to_display( $item, $settings['image_type'] );
							$tag      = 'div';

							$this->add_render_attribute(
								'link' . $index,
								array(
									'class'            => array( 'list-projects__item', 'js-change-text-hover', 'js-list-hover__link', $settings['items_paddings'] ),
									'data-arts-cursor' => 'true',
									'data-arts-cursor-hide-native' => 'true',
									'data-arts-cursor-scale' => '0.0',
								),
								true,
								true
							);

						if ( array_key_exists( 'permalink', $item ) && $item['permalink'] ) {
							$tag = 'a';

							$this->add_render_attribute(
								'link' . $index,
								array(
									'href' => esc_url( $item['permalink'] ),
								),
								true,
								true
							);
						}

						if ( $settings['ajax_image_transition_enabled'] && $image_id ) {
							$this->add_render_attribute( 'link' . $index, 'data-pjax-link', 'listHover', true );
						}

						if ( array_key_exists( 'permalink_attributes', $item ) ) {

							if ( array_key_exists( 'is_external', $item['permalink_attributes'] ) && $item['permalink_attributes']['is_external'] ) {
								$this->add_render_attribute( 'link' . $index, 'target', '_blank' );
								$this->remove_render_attribute( 'link' . $index, 'data-pjax-link' );
							} else {
								$this->remove_render_attribute( 'link' . $index, 'target' );
							}

							if ( array_key_exists( 'nofollow', $item['permalink_attributes'] ) && $item['permalink_attributes']['nofollow'] ) {
								$this->add_render_attribute( 'link' . $index, 'rel', 'nofollow' );
							} else {
								$this->remove_render_attribute( 'link' . $index, 'rel' );
							}
						}

							$this->add_render_attribute(
								'text_hover',
								array(
									'class' => array( 'change-text-hover', 'js-change-text-hover', 'text-lg-right', $settings['category_preset'] ),
								),
								true,
								true
							);
						?>
						<<?php echo esc_attr( $tag ); ?> <?php $this->print_render_attribute_string( 'link' . $index ); ?>>
							<div class="row align-items-center justify-content-center justify-content-md-between">
								<?php if ( $image_id ) : ?>
									<!-- hidden AJAX transition image -->
									<div class="col-12 d-md-none">
										<div class="js-transition-img list-projects__cover overflow js-list-hover__cover">
											<?php
												arts_the_lazy_image(
													array(
														'id'    => $image_id,
														'size'  => $settings['image_size'],
														'type'  => 'image',
														'class' => array(
															'wrapper' => array(),
															'image'   => array( 'js-transition-img__transformed-el', 'of-cover', 'texture' ),
														),
													)
												);
											?>
										</div>
									</div>
									<!-- - hidden AJAX transition image -->
								<?php endif; ?>
								<!-- header -->
								<div <?php $this->print_render_attribute_string( 'col_header' ); ?>>
									<div <?php $this->print_render_attribute_string( 'header' ); ?>>
										<?php if ( $settings['button_type'] === 'button' ) : ?>
											<?php if ( $settings['categories_enabled'] && ! empty( $item['categories_names'] ) ) : ?>
												<<?php $this->print_html_tag( 'category_tag' ); ?> <?php $this->print_render_attribute_string( 'category' ); ?>><?php echo implode( '&nbsp;&nbsp;/&nbsp;&nbsp;', $item['categories_names'] ); ?></<?php $this->print_html_tag( 'category_tag' ); ?>>
											<?php endif; ?>
										<?php endif; ?>
										<<?php $this->print_html_tag( 'heading_tag' ); ?> <?php $this->print_render_attribute_string( 'heading' ); ?>><?php echo $item['title']; ?></<?php $this->print_html_tag( 'heading_tag' ); ?>>
									</div>
								</div>
								<!-- - header -->
								<?php if ( $is_button_labeled ) : ?>
									<!-- change hover -->
									<div class="col-lg-4 list-projects__wrapper-button">
										<div class="list-projects__wrapper-link text-lg-right">
											<?php if ( $settings['button_type'] === 'button' ) : ?>
												<div <?php $this->print_render_attribute_string( 'button' ); ?>>
													<span class="button__label-hover"><?php echo esc_attr( $settings['button_text'] ); ?></span>
												</div>
											<?php else : ?>
												<div <?php $this->print_render_attribute_string( 'text_hover' ); ?>>
													<?php if ( $settings['categories_enabled'] && ! empty( $item['categories_names'] ) ) : ?>
														<!-- label by default -->
														<div class="change-text-hover__normal js-split-text split-text js-change-text-hover__normal" data-split-text-type="lines" data-split-text-set="lines"><?php echo implode( '&nbsp;&nbsp;/&nbsp;&nbsp;', $item['categories_names'] ); ?></div>
														<!-- - label by default -->
													<?php else : ?>
														<!-- label by default -->
														<div class="change-text-hover__normal js-split-text split-text js-change-text-hover__normal" data-split-text-type="lines" data-split-text-set="lines"><?php echo $settings['button_text_hover']; ?></div>
														<!-- - label by default -->
													<?php endif; ?>
													<!-- label on hover -->
													<div class="change-text-hover__hover js-change-text-hover__hover">
														<!-- hover line -->
														<div class="change-text-hover__line js-change-text-hover__line"></div>
														<!-- - hover line -->
														<span class="js-split-text split-text" data-split-text-type="lines" data-split-text-set="lines"><?php echo $settings['button_text_hover']; ?></span>
													</div>
													<!-- - label on hover -->
												</div>
											<?php endif; ?>
										</div>
									</div>
									<!-- - change hover -->
								<?php endif; ?>
							</div>
						</<?php echo esc_attr( $tag ); ?>>
					<?php endforeach; ?>
				</div>
				<!-- fixed canvas -->
				<canvas class="list-project__canvas js-list-hover__canvas" data-arts-scroll-fixed="true"></canvas>
				<!-- - fixed canvas -->
			</div>
		</div>

		<?php
	}
}
