<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Albums_Covers_Slider extends Rhye_Widget_Base {
	protected static $_instance, $_posts;
	protected static $_post_type          = 'arts_album';
	protected static $_data_static_fields = array( 'title', 'permalink', 'image' );

	public function get_name() {
		return 'rhye-widget-albums-covers-slider';
	}

	public function get_title() {
		return esc_html__( 'Albums Covers Slider', 'rhye' );
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
			'integration-class' => 'WPML_Elementor_Rhye_Widget_Albums_Covers_Slider',
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
			'indicator_section',
			array(
				'label' => esc_html__( 'Indicator', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'indicator_text',
			array(
				'label'     => esc_html__( 'Title', 'rhye' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Albums', 'rhye' ),
				'separator' => 'before',
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'indicator_text_hover',
			array(
				'label'   => esc_html__( 'Hover Title', 'rhye' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Explore Album', 'rhye' ),
				'dynamic' => array(
					'active' => true,
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
			'counters_enabled',
			array(
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Show Counters', 'rhye' ),
				'default' => 'yes',
			)
		);

		$this->add_control(
			'indicator_enabled',
			array(
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Show Indicator', 'rhye' ),
				'default' => 'yes',
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

		$this->add_responsive_control(
			'slides_per_view',
			array(
				'label'           => esc_html__( 'Slides Per Screen', 'rhye' ),
				'type'            => Controls_Manager::SLIDER,
				'range'           => array(
					'number' => array(
						'min'  => 1,
						'max'  => 4,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 1,
					'unit' => 'number',
				),
				'tablet_default'  => array(
					'size' => 1,
					'unit' => 'number',
				),
				'mobile_default'  => array(
					'size' => 1,
					'unit' => 'number',
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
			'mouse_cursor_enabled',
			array(
				'label'   => esc_html__( 'Enable Mouse Dragging', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'on_drag_cursor_class',
			array(
				'label'       => esc_html__( 'On Mouse Drag Class', 'rhye' ),
				'description' => sprintf(
					'%1s: <strong>slider-fullscreen-projects__images_scale-down</strong><br>%2s',
					esc_html__( 'Default', 'rhye' ),
					esc_html__( 'CSS class WITHOUT the dot that will be temporarily applied to the slider during the dragging.', 'rhye' )
				),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'slider-fullscreen-projects__images_scale-down', 'rhye' ),
				'condition'   => array(
					'mouse_cursor_enabled' => 'yes',
				),
				'dynamic'     => array(
					'active' => true,
				),
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
					'size' => 3,
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
					'{{WRAPPER}} .slider__images-slide-inner' => 'border-radius: {{SIZE}}{{UNIT}};',
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
			'decorations_overlay',
			array(
				'label' => esc_html__( 'Decorations', 'rhye' ),
				'type'  => Controls_Manager::HEADING,
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
						'min'  => 0.0,
						'max'  => 0.5,
						'step' => 0.1,
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

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$posts    = $this->get_posts_to_display();

		$this->add_render_attribute( 'section', 'class', array( 'section', 'section-fullheight', 'section-projects', 'section-projects-slider', 'overflow', $settings['content_alignment'] ) );

		if ( $settings['animation_enabled'] ) {
			$this->add_render_attribute( 'section', 'data-arts-os-animation', 'true' );
		}

		$this->add_render_attribute(
			'slider_images',
			array(
				'class'                       => array( 'container-fluid', 'slider-fullscreen-projects__images', 'swiper', 'swiper-container', 'js-slider-fullscreen-projects__images' ),
				'data-speed'                  => $settings['speed']['size'],
				'data-slides-per-view'        => $settings['slides_per_view']['size'],
				'data-slides-per-view-tablet' => $settings['slides_per_view_tablet']['size'],
				'data-slides-per-view-mobile' => $settings['slides_per_view_mobile']['size'],
				'data-direction'              => $settings['direction'],
				'data-touch-ratio'            => $settings['touch_ratio']['size'],
				'data-counter-style'          => $settings['counter_style'],
				'data-counter-add-zeros'      => $settings['counter_zeros'],
			)
		);

		$this->add_render_attribute(
			'slider_content',
			array(
				'class' => array( 'swiper', 'swiper-container', 'js-slider-fullscreen-projects__content' ),
			)
		);

		$this->add_render_attribute( 'slider_wrapper_arrows', 'class', 'slider__wrapper-arrows' );
		$this->add_render_attribute( 'slider_categories', 'class', array( 'slider-categories', 'js-slider__categories', 'text-center', 'mb-0' ) );
		$this->add_render_attribute( 'slider_circle', 'class', 'slider__circle' );

		$this->add_render_attribute( 'slide_image', 'class', array( 'swiper-slide', 'overflow', 'd-flex', 'align-items-center' ) );
		$this->add_render_attribute( 'slide_wrapper', 'class', array( 'w-100', 'h-100' ) );

		if ( $settings['arrows_position'] === 'left' ) {
			$this->add_render_attribute( 'slider_wrapper_arrows', 'class', 'slider__wrapper-arrows_left' );
		}

		if ( $settings['arrows_position'] === 'right' ) {
			$this->add_render_attribute( 'slider_wrapper_arrows', 'class', 'slider__wrapper-arrows_right' );
		}

		switch ( $settings['content_alignment'] ) {
			case 'text-left': {
				// $this->add_render_attribute(
				// 'slider_content', [
				// 'class' => [ 'slider-fullscreen-projects__content_reduced-sides' ],
				// ]
				// );
				$this->add_render_attribute( 'slider_wrapper_arrows', 'class', 'slider__wrapper-arrows_right' );
				$this->add_render_attribute( 'slider_categories', 'class', 'text-lg-right' );
				$this->add_render_attribute( 'slide_image', 'class', 'justify-content-start' );
				$this->add_render_attribute( 'slider_circle', 'class', 'slider__circle_left' );

				$this->add_render_attribute( 'footer_col_1', 'class', array( 'col-lg-3', 'd-none', 'd-lg-block', 'order-lg-2' ) );
				$this->add_render_attribute( 'footer_col_2', 'class', array( 'col-lg-6', 'order-lg-1', 'text-center', 'text-lg-left' ) );
				$this->add_render_attribute( 'footer_col_3', 'class', array( 'col-lg-3', 'order-lg-3', 'text-center', 'text-lg-right' ) );
				break;
			}
			case 'text-center': {
				// if ( $settings['arrows_position'] !== 'split-left-right' ) {
				// $this->add_render_attribute( 'slider_wrapper_arrows', 'class', 'slider__wrapper-arrows_left' );
				// }
				$this->add_render_attribute( 'slider_categories', 'class', 'text-lg-right' );
				$this->add_render_attribute( 'slide_image', 'class', 'justify-content-center' );

				$this->add_render_attribute( 'footer_col_1', 'class', array( 'col-lg-3', 'd-none', 'd-lg-block', 'order-lg-1' ) );
				$this->add_render_attribute( 'footer_col_2', 'class', array( 'col-lg-6', 'order-lg-2', 'text-center' ) );
				$this->add_render_attribute( 'footer_col_3', 'class', array( 'col-lg-3', 'order-lg-3', 'text-center', 'text-lg-right' ) );
				break;
			}
			case 'text-right': {
				// $this->add_render_attribute(
				// 'slider_content', [
				// 'class' => [ 'slider-fullscreen-projects__content_reduced-sides' ],
				// ]
				// );
				$this->add_render_attribute( 'slider_wrapper_arrows', 'class', 'slider__wrapper-arrows_left' );
				$this->add_render_attribute( 'slider_categories', 'class', 'text-lg-left' );
				$this->add_render_attribute( 'slide_image', 'class', 'justify-content-end' );
				$this->add_render_attribute( 'slider_circle', 'class', 'slider__circle_right' );

				$this->add_render_attribute( 'footer_col_1', 'class', array( 'col-lg-3', 'd-none', 'd-lg-block', 'order-lg-2' ) );
				$this->add_render_attribute( 'footer_col_2', 'class', array( 'col-lg-6', 'order-lg-3', 'text-center', 'text-lg-right' ) );
				$this->add_render_attribute( 'footer_col_3', 'class', array( 'col-lg-3', 'order-lg-1', 'text-center', 'text-lg-left' ) );
				break;
			}
		}

		if ( $settings['mouse_cursor_enabled'] ) {
			$this->add_render_attribute(
				'slider_images',
				array(
					'data-drag-mouse'  => 'true',
					'data-drag-cursor' => 'true',
					'data-drag-class'  => $settings['on_drag_cursor_class'],
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

		if ( $settings['image_parallax'] && is_array( $settings['image_parallax_speed'] ) && $settings['image_parallax_speed']['size'] > 0 ) {
			$this->add_render_attribute(
				'slide_wrapper',
				array(
					'data-swiper-parallax'      => $settings['image_parallax_speed']['size'] * 100 . '%',
					'data-swiper-parallax-zoom' => $settings['image_parallax_speed']['size'] * 100 . '%',
				)
			);
		}

		?>

		<?php if ( ! empty( $posts ) ) : ?>
			<div <?php $this->print_render_attribute_string( 'section' ); ?>>
				<div class="section-fullheight__inner section-fullheight__inner_mobile">
					<div class="slider slider-fullscreen-projects js-slider-fullscreen-projects js-slider">
						<!-- slider FOOTER -->
						<div class="container-fluid slider-fullscreen-projects__footer slider-fullscreen-projects__footer_content">
							<div class="row justify-content-between align-items-end">
								<div <?php $this->print_render_attribute_string( 'footer_col_1' ); ?>></div>
								<!-- slider CONTENT -->
								<div <?php $this->print_render_attribute_string( 'footer_col_2' ); ?>>
									<div <?php $this->print_render_attribute_string( 'slider_content' ); ?>>
										<div class="swiper-wrapper">
											<?php foreach ( $posts as $item ) : ?>
												<?php
													$item_has_gallery   = array_key_exists( 'media_gallery', $item ) && $item['media_gallery'];
													$item_gallery_count = 0;
													$tag                = 'div';

													$this->add_render_attribute(
														'link',
														array(
															'class'        => array( 'd-inline-block' ),
														),
														true,
														true
													);

												if ( array_key_exists( 'permalink', $item ) && $item['permalink'] ) {
													$tag = 'a';

													$this->add_render_attribute(
														'link',
														array(
															'href'             => esc_url( $item['permalink'] ),
														),
														true,
														true
													);
												}

													$this->add_render_attribute(
														'heading',
														array(
															'class' => array( 'slider__heading', $settings['heading_preset'] ),
														),
														true,
														true
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
												}

												if ( $item_has_gallery ) {
													$item_gallery_count = count( $item['media_gallery'] );
													$this->add_render_attribute( 'link', 'class', array( 'js-album' ) );
												}

												if ( $item_gallery_count > 0 ) {
													$this->add_render_attribute( 'heading', 'class', 'block-counter' );
												}

												if ( $settings['indicator_enabled'] ) {
													$this->add_render_attribute( 'link', 'class', 'js-page-indicator-trigger' );
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
												<div class="swiper-slide" data-category="<?php echo sanitize_title( $settings['indicator_text'] ); ?>">
													<<?php echo esc_attr( $tag ); ?> <?php $this->print_render_attribute_string( 'link' ); ?>>
														<?php if ( ! empty( $item['title'] ) ) : ?>
															<!-- header -->
															<<?php $this->print_html_tag( 'heading_tag' ); ?> <?php $this->print_render_attribute_string( 'heading' ); ?>>
																<span><?php echo $item['title']; ?></span>
																<?php if ( $settings['counters_enabled'] && $item_gallery_count > 0 ) : ?>
																	<span class="block-counter__counter"><?php echo esc_attr( $item_gallery_count ); ?></span>
																<?php endif; ?>
															</<?php $this->print_html_tag( 'heading_tag' ); ?>>
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
												</div>
											<?php endforeach; ?>
										</div>
									</div>
								</div>
								<!-- - slider CONTENT -->
								<!-- slider INDICATOR -->
								<div <?php $this->print_render_attribute_string( 'footer_col_3' ); ?>>
									<?php if ( $settings['indicator_enabled'] ) : ?>
										<div <?php $this->print_render_attribute_string( 'slider_categories' ); ?>>
											<div class="slider-categories__category subheading js-split-text split-text" data-split-text-type="lines" data-category="<?php echo sanitize_title( $settings['indicator_text'] ); ?>"><?php echo $settings['indicator_text']; ?></div>
											<div class="slider-categories__category subheading js-split-text split-text" data-split-text-type="lines" data-button="true"><?php echo $settings['indicator_text_hover']; ?></div>
										</div>
									<?php endif; ?>
								</div>
								<!-- - slider INDICATOR -->
							</div>
						</div>
						<!-- - slider FOOTER -->

						<!-- slider IMAGES -->
						<div <?php $this->print_render_attribute_string( 'slider_images' ); ?>>
							<div class="swiper-wrapper">
								<?php foreach ( $posts as $item ) : ?>
									<div <?php $this->print_render_attribute_string( 'slide_image' ); ?>>
										<div class="slider__images-slide-inner slider__images-slide-inner_circle js-transition-img">
											<div <?php $this->print_render_attribute_string( 'slide_wrapper' ); ?>>
												<!-- zoom on drag container -->
												<div class="slider__zoom-container w-100 h-100 overflow">
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
												<!-- - zoom on drag container -->
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
							<?php if ( $settings['circle_enabled'] ) : ?>
								<div <?php $this->print_render_attribute_string( 'slider_circle' ); ?>><div class="slider__circle-geometry"></div></div>
							<?php endif; ?>
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
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php
	}
}
