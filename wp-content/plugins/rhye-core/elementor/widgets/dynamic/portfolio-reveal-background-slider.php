<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Portfolio_Reveal_Background_Slider extends Rhye_Widget_Base {
	protected static $_instance, $_posts;
	protected static $_post_type          = 'arts_portfolio_item';
	protected static $_data_static_fields = array( 'title', 'subheading', 'permalink', 'text', 'image' );

	public function get_name() {
		return 'rhye-widget-portfolio-reveal-background-slider';
	}

	public function get_title() {
		return esc_html__( 'Portfolio Reveal Background Slider', 'rhye' );
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
					'field'       => 'button_text_hover',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'Button Hover Title', 'rhye' ) ),
					'editor_type' => 'LINE',
				),
			),
			'integration-class' => 'WPML_Elementor_Rhye_Widget_Portfolio_Reveal_Background_Slider',
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

		$this->add_control(
			'texts_enabled',
			array(
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Show Texts', 'rhye' ),
				'default' => '',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_section',
			array(
				'label' => esc_html__( 'Slider', 'rhye' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			)
		);

		$this->add_control(
			'direction',
			array(
				'label'   => esc_html__( 'Direction', 'rhye' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'horizontal',
				'options' => array(
					'horizontal' => array(
						'title' => esc_html__( 'Horizontal', 'rhye' ),
						'icon'  => 'eicon-h-align-stretch',
					),
					'vertical'   => array(
						'title' => esc_html__( 'Vertical', 'rhye' ),
						'icon'  => 'eicon-v-align-stretch',
					),
				),
				'toggle'  => false,
			)
		);

		$this->add_control(
			'speed',
			array(
				'label'   => esc_html__( 'Speed', 'rhye' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'ms' => array(
						'min'  => 100,
						'max'  => 10000,
						'step' => 100,
					),
				),
				'default' => array(
					'unit' => 'ms',
					'size' => 1200,
				),
			)
		);

		$this->add_control(
			'autoplay_heading',
			array(
				'label'     => esc_html__( 'Autoplay', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'autoplay_enabled',
			array(
				'label'   => esc_html__( 'Enable Autoplay', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'autoplay_delay',
			array(
				'label'     => esc_html__( 'Delay (ms)', 'rhye' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'ms' => array(
						'min'  => 1000,
						'max'  => 60000,
						'step' => 100,
					),
				),
				'default'   => array(
					'unit' => 'ms',
					'size' => 6000,
				),
				'condition' => array(
					'autoplay_enabled' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'controls_section',
			array(
				'label' => esc_html__( 'Controls', 'rhye' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			)
		);

		$this->add_control(
			'dots_heading',
			array(
				'label' => esc_html__( 'Dots', 'rhye' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'dots_enabled',
			array(
				'label'   => esc_html__( 'Enable Dots', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'arrows_heading',
			array(
				'label' => esc_html__( 'Arrows', 'rhye' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'arrows_enabled',
			array(
				'label'   => esc_html__( 'Enable Arrows', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'counter_heading',
			array(
				'label'     => esc_html__( 'Counter', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'counter_enabled',
			array(
				'label'   => esc_html__( 'Enable Counter', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'counter_style',
			array(
				'label'     => esc_html__( 'Counter Style', 'rhye' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'roman',
				'options'   => array(
					'roman'  => esc_html__( 'Roman', 'rhye' ),
					'arabic' => esc_html__( 'Arabic', 'rhye' ),
				),
				'condition' => array(
					'counter_enabled' => 'yes',
				),
			)
		);

		$this->add_control(
			'counter_zeros',
			array(
				'label'     => esc_html__( 'Counter Prefix', 'rhye' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 2,
				'options'   => array(
					0 => esc_html__( 'None', 'rhye' ),
					1 => esc_html__( '1 Zero', 'rhye' ),
					2 => esc_html__( '2 Zeros', 'rhye' ),
				),
				'condition' => array(
					'counter_style'   => 'arabic',
					'counter_enabled' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'interaction_section',
			array(
				'label' => esc_html__( 'Interaction', 'rhye' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			)
		);

		$this->add_control(
			'mouse_heading',
			array(
				'label' => esc_html__( 'Mouse', 'rhye' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'mousewheel_control_enabled',
			array(
				'label'   => esc_html__( 'Enable Mousewheel Control', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'keyboard_heading',
			array(
				'label'     => esc_html__( 'Keyboard', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'keyboard_control_enabled',
			array(
				'label'   => esc_html__( 'Enable Keyboard Control', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'touch_heading',
			array(
				'label'     => esc_html__( 'Touch', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'touch_ratio',
			array(
				'label'   => esc_html__( 'Touch Ratio', 'rhye' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'px' => array(
						'min'  => 1,
						'max'  => 4,
						'step' => 0.1,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 1.5,
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
			'content_alignment',
			array(
				'label'   => esc_html__( 'Content Alignment', 'rhye' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
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
				'default' => 'text-center',
				'toggle'  => false,
			)
		);

		$this->add_control(
			'arrows_position',
			array(
				'label'     => esc_html__( 'Arrows Position', 'rhye' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'split-left-right',
				'options'   => array(
					'split-left-right' => array(
						'title' => esc_html__( 'Split Left / Right', 'rhye' ),
						'icon'  => 'eicon-h-align-stretch',
					),
					'left'             => array(
						'title' => esc_html__( 'Left', 'rhye' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right'            => array(
						'title' => esc_html__( 'Right', 'rhye' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'condition' => array(
					'content_alignment' => 'text-center',
				),
			)
		);

		$this->add_control(
			'counter_position',
			array(
				'label'   => esc_html__( 'Counter Position', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => array(
					'center' => esc_html__( 'Huge / Center', 'rhye' ),
					'bottom' => esc_html__( 'Small / Bottom', 'rhye' ),
				),
			)
		);

		$this->add_control(
			'categories_position',
			array(
				'label'   => esc_html__( 'Categories Position', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => array(
					'above_headings' => esc_html__( 'Above Headings', 'rhye' ),
					'bottom'         => esc_html__( 'Bottom', 'rhye' ),
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
			'overlay_section',
			array(
				'label' => esc_html__( 'Overlay', 'rhye' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'background_overlay',
				'selector' => '{{WRAPPER}} .slider__overlay',
			)
		);

		$this->add_control(
			'overlay_dither_enabled',
			array(
				'label'   => esc_html__( 'Enable Dither', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
			)
		);

		$this->add_control(
			'overlay_dither_opacity',
			array(
				'label'     => esc_html__( 'Dither Opacity', 'rhye' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => .2,
				),
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .slider__overlay:before' => 'opacity: {{SIZE}};',
				),
				'condition' => array(
					'overlay_dither_enabled' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'decorations_section',
			array(
				'label' => esc_html__( 'Decorations', 'rhye' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'circle_enabled',
			array(
				'label'   => esc_html__( 'Enable Circle', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
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
			'transition_text_enabled',
			array(
				'label'   => esc_html__( 'Enable Text Transition', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
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

		$this->add_control(
			'ajax_prefetch_active_slide_enabled',
			array(
				'label'       => esc_html__( 'Prefetch Links on Active Slide', 'rhye' ),
				'description' => esc_html__( 'Attempt to load next page on the active slide in background. This may potentially reduce the delay before the transition starts, but will increase the network traffic consumption.', 'rhye' ),
				'type'        => Controls_Manager::SWITCHER,
				'default'     => 'yes',
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
				'default' => 'h1',
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

		$this->add_control(
			'typography_text',
			array(
				'label'     => esc_html__( 'Text', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'text_preset',
			array(
				'label'   => esc_html__( 'Typography Preset', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'paragraph',
				'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
			)
		);

		$this->add_control(
			'text_tag',
			array(
				'label'   => esc_html__( 'HTML Tag', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'p',
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

		$this->add_render_attribute(
			'section',
			array(
				'class' => array( 'section', 'section-fullheight', 'section-projects', 'section-projects-slider', 'overflow', $settings['content_alignment'] ),
			)
		);

		$this->add_render_attribute(
			'overlay',
			array(
				'class' => array( 'slider__overlay', 'overlay' ),
			)
		);

		$this->add_render_attribute(
			'heading',
			array(
				'class' => array( 'slider__heading', $settings['heading_preset'] ),
			)
		);

		$this->add_render_attribute(
			'category',
			array(
				'class' => array( 'slider__subheading', 'mb-1', $settings['category_preset'] ),
			)
		);

		$this->add_render_attribute(
			'text',
			array(
				'class' => array( 'slider__text', 'mt-1', $settings['text_preset'] ),
			)
		);

		if ( $settings['transition_text_enabled'] ) {
			$this->add_render_attribute(
				'heading',
				array(
					'class'                => array( 'split-text', 'js-split-text' ),
					'data-split-text-type' => 'lines, words, chars',
					'data-split-text-set'  => 'chars',
				)
			);

			$this->add_render_attribute(
				'category',
				array(
					'class'                => array( 'split-text', 'js-split-text' ),
					'data-split-text-type' => 'lines, words, chars',
					'data-split-text-set'  => 'chars',
				)
			);

			$this->add_render_attribute(
				'text',
				array(
					'class'                => array( 'split-text', 'js-split-text' ),
					'data-split-text-type' => 'lines',
					'data-split-text-set'  => 'lines',
				)
			);
		}

		$this->add_render_attribute(
			'slider_images',
			array(
				'class'                  => array( 'slider-fullscreen-projects__images', 'swiper', 'swiper-container', 'js-slider-fullscreen-projects__images' ),
				'data-speed'             => $settings['speed']['size'],
				'data-direction'         => $settings['direction'],
				'data-touch-ratio'       => $settings['touch_ratio']['size'],
				'data-counter-style'     => $settings['counter_style'],
				'data-counter-add-zeros' => $settings['counter_zeros'],
			)
		);

		$this->add_render_attribute(
			'slider_content',
			array(
				'class' => array( 'slider-fullscreen-projects__content', 'swiper', 'swiper-container', 'js-slider-fullscreen-projects__content' ),
			)
		);

		$this->add_render_attribute(
			'slider_wrapper_arrows',
			array(
				'class' => 'slider__wrapper-arrows',
			)
		);

		switch ( $settings['content_alignment'] ) {
			case 'text-left': {
				$this->add_render_attribute(
					'slider_content',
					array(
						'class' => array( 'slider-fullscreen-projects__content_reduced-sides' ),
					)
				);

				$this->add_render_attribute(
					'slider_wrapper_arrows',
					array(
						'class' => 'slider__wrapper-arrows_right',
					)
				);

				$this->add_render_attribute(
					'footer_col_1',
					array(
						'class' => array( 'col-lg-4', 'd-none', 'd-lg-block', 'order-lg-3', 'text-right' ),
					)
				);

				$this->add_render_attribute(
					'footer_col_2',
					array(
						'class' => array( 'col-lg-4', 'order-lg-1', 'text-center', 'text-lg-left' ),
					)
				);

				$this->add_render_attribute(
					'footer_col_3',
					array(
						'class' => array( 'col-lg-4', 'order-lg-2', 'text-center' ),
					)
				);
				break;
			}
			case 'text-center': {

				$this->add_render_attribute(
					'slider_wrapper_arrows',
					array(
						'class' => 'slider__wrapper-arrows_' . $settings['arrows_position'],
					)
				);

				if ( $settings['categories_position'] === 'above_headings' ) {
					$this->add_render_attribute(
						'footer_col_1',
						array(
							'class' => array( 'col-lg-4', 'order-lg-3', 'text-lg-right', 'text-center', 'mb-1', 'mb-lg-0' ),
						)
					);

					$this->add_render_attribute(
						'footer_col_2',
						array(
							'class' => array( 'col-lg-4', 'order-lg-1', 'text-center', 'text-lg-right' ),
						)
					);

					$this->add_render_attribute(
						'footer_col_3',
						array(
							'class' => array( 'col-lg-4', 'order-lg-2', 'text-center' ),
						)
					);
				} else {
					$this->add_render_attribute(
						'footer_col_1',
						array(
							'class' => array( 'col-lg-4', 'order-lg-1', 'd-none', 'd-lg-block', 'text-left' ),
						)
					);

					$this->add_render_attribute(
						'footer_col_2',
						array(
							'class' => array( 'col-lg-4', 'order-lg-3', 'text-center', 'text-lg-right' ),
						)
					);

					$this->add_render_attribute(
						'footer_col_3',
						array(
							'class' => array( 'col-lg-4', 'order-lg-2', 'text-center' ),
						)
					);
				}
				break;
			}
			case 'text-right': {
				$this->add_render_attribute(
					'slider_content',
					array(
						'class' => array( 'slider-fullscreen-projects__content_reduced-sides' ),
					)
				);

				$this->add_render_attribute(
					'slider_wrapper_arrows',
					array(
						'class' => 'slider__wrapper-arrows_left',
					)
				);

				$this->add_render_attribute(
					'footer_col_1',
					array(
						'class' => array( 'col-lg-4', 'd-none', 'd-lg-block', 'order-lg-1', 'text-left' ),
					)
				);

				$this->add_render_attribute(
					'footer_col_2',
					array(
						'class' => array( 'col-lg-4', 'order-lg-3', 'text-center', 'text-lg-right' ),
					)
				);

				$this->add_render_attribute(
					'footer_col_3',
					array(
						'class' => array( 'col-lg-4', 'order-lg-2', 'text-center' ),
					)
				);
				break;
			}
		}

		$this->add_render_attribute(
			'slide_wrapper',
			array(
				'class' => array( 'slider__images-slide-inner', 'js-transition-img', 'overflow' ),
			)
		);

		if ( $settings['overlay_dither_enabled'] ) {
			$this->add_render_attribute(
				'overlay',
				array(
					'class' => array( 'overlay_dither' ),
				)
			);
		}

		if ( $settings['autoplay_enabled'] ) {
			$this->add_render_attribute(
				'slider_images',
				array(
					'data-autoplay-enabled' => 'true',
					'data-autoplay-delay'   => $settings['autoplay_delay']['size'],
				)
			);
		}

		if ( $settings['mousewheel_control_enabled'] ) {
			$this->add_render_attribute(
				'slider_images',
				array(
					'data-mousewheel-enabled' => 'true',
				)
			);
		}

		if ( $settings['keyboard_control_enabled'] ) {
			$this->add_render_attribute(
				'slider_images',
				array(
					'data-keyboard-enabled' => 'true',
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

		if ( $settings['ajax_prefetch_active_slide_enabled'] ) {
			$this->add_render_attribute( 'slider_images', 'data-prefetch-active-slide-transition', 'true' );
		}

		?>

		<?php if ( ! empty( $posts ) ) : ?>
			<div <?php $this->print_render_attribute_string( 'section' ); ?>>
				<div class="section-fullheight__inner section-fullheight__inner_mobile">
					<div class="slider slider_reveal slider-fullscreen-projects js-slider-fullscreen-projects js-slider-reveal js-slider">
						<!-- slider CONTENT -->
						<div <?php $this->print_render_attribute_string( 'slider_content' ); ?>>
							<div class="swiper-wrapper">
								<?php foreach ( $posts as $item ) : ?>
									<?php
										$this->add_render_attribute(
											'slide',
											array(
												'class' => array( 'swiper-slide' ),
											),
											true,
											true
										);

										$this->add_render_attribute(
											'text_hover',
											array(
												'class' => array( 'change-text-hover', 'js-change-text-hover', $settings['category_preset'] ),
											),
											true,
											true
										);

									if ( $settings['content_alignment'] === 'text-right' ) {
										$this->add_render_attribute(
											'text_hover',
											array(
												'class' => array( 'text-right' ),
											)
										);
									}

									if ( ! empty( $item['categories_slugs'] ) ) {
										$this->add_render_attribute(
											'slide',
											array(
												'class' => array( 'swiper-slide' ),
												'data-category' => $item['categories_slugs'],
											),
											true,
											true
										);
									}

									$this->add_render_attribute(
										'link',
										array(
											'class' => array( 'd-inline-flex', 'flex-column', 'js-change-text-hover', 'pointer-events-auto' ),
											'href'  => $item['permalink'],
										),
										true,
										true
									);

									if ( $settings['ajax_image_transition_enabled'] ) {
										$this->add_render_attribute( 'link', 'data-pjax-link', 'fullscreenSlider', true, true );
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

									?>
									<div <?php $this->print_render_attribute_string( 'slide' ); ?>>
										<?php if ( $settings['categories_enabled'] && $settings['categories_position'] === 'above_headings' && ! empty( $item['categories_names'] ) ) : ?>
											<<?php $this->print_html_tag( 'category_tag' ); ?> <?php $this->print_render_attribute_string( 'category' ); ?>><?php echo implode( '&nbsp;&nbsp;/&nbsp;&nbsp;', $item['categories_names'] ); ?></<?php $this->print_html_tag( 'category_tag' ); ?>>
										<?php endif; ?>
										<a <?php $this->print_render_attribute_string( 'link' ); ?>>
											<<?php $this->print_html_tag( 'heading_tag' ); ?> <?php $this->print_render_attribute_string( 'heading' ); ?>><?php echo $item['title']; ?></<?php $this->print_html_tag( 'heading_tag' ); ?>>
										</a>
										<?php if ( $settings['texts_enabled'] && ! empty( $item['text'] ) ) : ?>
											<<?php $this->print_html_tag( 'text_tag' ); ?> <?php $this->print_render_attribute_string( 'text' ); ?>><?php echo $item['text']; ?></<?php $this->print_html_tag( 'text_tag' ); ?>>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						<!-- - slider CONTENT -->

						<!-- slider IMAGES -->
						<div <?php $this->print_render_attribute_string( 'slider_images' ); ?>>
							<div class="swiper-wrapper">
								<?php foreach ( $posts as $item ) : ?>
									<div class="swiper-slide overflow">
										<div <?php $this->print_render_attribute_string( 'slide_wrapper' ); ?>>
											<?php
											arts_the_lazy_image(
												array(
													'id'   => $this->get_priority_image_id_to_display( $item, $settings['image_type'] ),
													'size' => $settings['image_size'],
													'class' => array(
														'wrapper' => false,
														'image'   => array( 'of-cover', 'slider__bg', 'swiper-lazy', 'js-transition-img__transformed-el' ),
													),
												)
											);
											?>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
							<!-- overlay -->
							<div <?php $this->print_render_attribute_string( 'overlay' ); ?>></div>
							<?php if ( $settings['circle_enabled'] ) : ?>
								<div class="slider__circle"><div class="slider__circle-geometry"></div></div>
							<?php endif; ?>
							<!-- - overlay -->
						</div>
						<!-- - slider IMAGES -->

						<?php if ( $settings['arrows_enabled'] ) : ?>
							<!-- slider ARROWS -->
							<?php if ( $settings['arrows_position'] === 'split-left-right' ) : ?>
								<div class="slider__arrow slider__arrow_left slider__arrow_absolute js-slider__arrow-prev">
									<?php
										arts_the_arrow(
											array(
												'direction' => $settings['direction'] === 'horizontal' ? 'left' : 'up',
											)
										);
									?>
								</div>
								<div class="slider__arrow slider__arrow_right slider__arrow_absolute js-slider__arrow-next">
									<?php
										arts_the_arrow(
											array(
												'direction' => $settings['direction'] === 'horizontal' ? 'right' : 'down',
											)
										);
									?>
								</div>
								<?php else : ?>
									<div <?php $this->print_render_attribute_string( 'slider_wrapper_arrows' ); ?>>
										<div class="slider__arrow js-slider__arrow-prev">
											<?php
												arts_the_arrow(
													array(
														'direction' => $settings['direction'] === 'horizontal' ? 'left' : 'up',
													)
												);
											?>
										</div>
										<div class="slider__arrow js-slider__arrow-next">
											<?php
												arts_the_arrow(
													array(
														'direction' => $settings['direction'] === 'horizontal' ? 'right' : 'down',
													)
												);
											?>
										</div>
									</div>
								<?php endif; ?>
								<!-- - slider ARROWS -->
						<?php endif; ?>

						<?php if ( $settings['counter_enabled'] && $settings['counter_position'] === 'center' ) : ?>
							<!-- slider COUNTER (centered) -->
							<div class="slider-fullscreen-projects__counter slider-fullscreen-projects__counter_centered">
								<div class="slider__wrapper-counter-big">
									<div class="slider__counter slider__counter_current slider__counter_current-huge">
										<div class="js-slider-fullscreen-projects__counter-current swiper swiper-container">
											<div class="swiper-wrapper"></div>
										</div>
									</div>
								</div>
							</div>
							<!-- - slider COUNTER (centered) -->
						<?php endif; ?>

						<!-- slider FOOTER -->
						<div class="container-fluid slider-fullscreen-projects__footer">
							<div class="row justify-content-between align-items-end">
								<div <?php $this->print_render_attribute_string( 'footer_col_1' ); ?>>
									<?php if ( $settings['counter_enabled'] && $settings['counter_position'] === 'bottom' ) : ?>
										<!-- slider COUNTER -->
										<div class="slider__wrapper-counter">
											<div class="slider__counter slider__counter_current">
												<div class="js-slider-fullscreen-projects__counter-current swiper swiper-container">
													<div class="swiper-wrapper"></div>
												</div>
											</div>
											<div class="slider__counter-divider slider-fullscreen__counter-divider"></div>
											<div class="slider__counter slider__counter_total js-slider-fullscreen-projects__counter-total"></div>
										</div>
										<!-- - slider COUNTER -->
									<?php endif; ?>
								</div>
								<div <?php $this->print_render_attribute_string( 'footer_col_2' ); ?>>
									<?php if ( ! empty( $posts ) && $settings['categories_enabled'] && $settings['categories_position'] === 'bottom' ) : ?>
										<!-- slider CATEGORIES -->
										<?php
											$this->add_render_attribute(
												'button',
												array(
													'class' => array( 'slider-categories__category', 'js-split-text', 'split-text', $settings['category_preset'] ),
													'data-split-text-type' => 'lines',
													'data-button' => 'true',
												)
											);
										?>
										<div class="slider-categories js-slider__categories">
											<?php foreach ( $posts as $item ) : ?>
												<?php if ( ! empty( $item['categories_names'] ) ) : ?>
													<?php
														$this->add_render_attribute(
															'category',
															array(
																'class' => array( 'slider-categories__category', 'js-split-text', 'split-text', $settings['category_preset'] ),
																'data-split-text-type' => 'lines',
																'data-category' => array_key_exists( 'categories_slugs', $item ) ? $item['categories_slugs'] : '',
															),
															true,
															true
														);
													?>
													<div <?php $this->print_render_attribute_string( 'category' ); ?>><?php echo implode( '&nbsp;&nbsp;/&nbsp;&nbsp;', $item['categories_names'] ); ?></div>
												<?php endif; ?>
											<?php endforeach; ?>
											<div <?php $this->print_render_attribute_string( 'button' ); ?>><?php echo $settings['button_text_hover']; ?></div>
										</div>
										<!-- - slider CATEGORIES -->
									<?php endif; ?>
								</div>
								<div <?php $this->print_render_attribute_string( 'footer_col_3' ); ?>>
									<?php if ( $settings['dots_enabled'] ) : ?>
										<!-- slider DOTS -->
										<div class="slider__dots js-slider__dots"></div>
										<!-- - slider DOTS -->
									<?php endif; ?>
								</div>
							</div>
						</div>
						<!-- - slider FOOTER -->
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php
	}
}
