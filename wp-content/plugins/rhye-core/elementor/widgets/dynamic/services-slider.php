<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Services_Slider extends Rhye_Widget_Base {
	protected static $_instance, $_posts;
	protected static $_post_type = 'arts_service';

	public function get_name() {
		return 'rhye-widget-services-slider';
	}

	public function get_title() {
		return esc_html__( 'Services Slider', 'rhye' );
	}

	public function get_icon() {
		return 'eicon-sitemap icon-rhye-widget-dynamic';
	}

	public function get_categories() {
		return array( 'rhye-dynamic' );
	}

	/**
	 * Used for widgets with dynamically fetched posts
	 * Prints posts toggles set in the control panel
	 *
	 * @return void
	 */
	public function add_controls_posts_toggles() {
		$posts         = $this->get_posts();
		$post_type     = self::$_post_type;
		$post_type_obj = get_post_type_object( $post_type );

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'dynamic_content_info',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(
					'%1$s <strong>%2$s.</strong> %3$s<br><br>%4$s <a href="%5$s" target="_blank">%6$s</a>',
					esc_html__( 'This widget displays content dynamically from the existing', 'rhye' ),
					$post_type_obj->labels->name,
					esc_html__( 'It\'s not editable directly through Elementor Page Builder.', 'rhye' ),
					esc_html__( 'You can edit or re-order your posts', 'rhye' ),
					admin_url( 'edit.php?post_type=' . $post_type ),
					esc_html__( 'in WordPress admin panel', 'rhye' )
				),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			)
		);

		$this->add_control(
			'posts_amount',
			array(
				'label'   => esc_html__( 'Number of Posts to Display (0 for all)', 'rhye' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'number' => array(
						'min'  => 0,
						'max'  => 16,
						'step' => 1,
					),
				),
				'default' => array(
					'unit' => 'number',
					'size' => 0,
				),
			)
		);

		foreach ( $posts as $index => $item ) {

			/**
			 * Heading Toggle
			 */
			$id = 'heading_toggle' . $item['id'];
			$this->add_control(
				$id,
				array(
					'raw'        => sprintf(
						'<h3 class="elementor-control-title"><strong>%1$s</strong>&nbsp;&nbsp;<a href="%2$s" target="_blank"><i class="eicon-edit"></i></a></h3>',
						$item['title'],
						admin_url( 'post.php?post=' . $item['id'] . '&action=edit' ),
						esc_html__( 'Edit', 'rhye' )
					),
					'type'       => Controls_Manager::RAW_HTML,
					'separator'  => 'before',
					'conditions' => array(
						'relation' => 'or',
						'terms'    => array(
							array(
								'name'     => 'posts_amount[size]',
								'operator' => '>',
								'value'    => $index,
							),
							array(
								'name'     => 'posts_amount[size]',
								'operator' => '<=',
								'value'    => '0',
							),
						),
					),
				)
			);

			/**
			 * Toggle
			 */
			$id = 'enabled' . $item['id'];
			$this->add_control(
				$id,
				array(
					'label'      => esc_html__( 'Enabled', 'rhye' ),
					'type'       => Controls_Manager::SWITCHER,
					'default'    => 'yes',
					'conditions' => array(
						'relation' => 'or',
						'terms'    => array(
							array(
								'name'     => 'posts_amount[size]',
								'operator' => '>',
								'value'    => $index,
							),
							array(
								'name'     => 'posts_amount[size]',
								'operator' => '<=',
								'value'    => '0',
							),
						),
					),
				)
			);

			/**
			 * Color Theme
			 */
			$id = 'background' . $item['id'];
			$this->add_control(
				$id,
				array(
					'label'      => esc_html__( 'Background Color', 'rhye' ),
					'type'       => Controls_Manager::SELECT,
					'default'    => 'bg-white',
					'options'    => ARTS_THEME_COLORS_ARRAY,
					'condition'  => array(
						'enabled' . $item['id'] => 'yes',
					),
					'conditions' => array(
						'relation' => 'or',
						'terms'    => array(
							array(
								'name'     => 'posts_amount[size]',
								'operator' => '>',
								'value'    => $index,
							),
							array(
								'name'     => 'posts_amount[size]',
								'operator' => '<=',
								'value'    => '0',
							),
						),
					),
				)
			);

			/**
			 * Main Elements Color
			 */
			$id = 'main_theme' . $item['id'];
			$this->add_control(
				$id,
				array(
					'label'      => esc_html__( 'Main Elements Color', 'rhye' ),
					'type'       => Controls_Manager::SELECT,
					'default'    => '',
					'options'    => ARTS_THEME_COLOR_THEMES_ARRAY,
					'condition'  => array(
						'enabled' . $item['id'] => 'yes',
					),
					'conditions' => array(
						'relation' => 'or',
						'terms'    => array(
							array(
								'name'     => 'posts_amount[size]',
								'operator' => '>',
								'value'    => $index,
							),
							array(
								'name'     => 'posts_amount[size]',
								'operator' => '<=',
								'value'    => '0',
							),
						),
					),
				)
			);
		}

		$this->end_controls_section();
	}

	protected function register_controls() {
		$post_type = self::$_post_type;

		// posts toggles & posts amount
		$this->add_controls_posts_toggles();

		$this->start_controls_section(
			'elements_section',
			array(
				'label' => esc_html__( 'Elements', 'rhye' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			)
		);

		$this->add_control(
			'subheadings_enabled',
			array(
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Show Subheadings', 'rhye' ),
				'default' => 'yes',
			)
		);

		$this->add_control(
			'texts_enabled',
			array(
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Show Texts', 'rhye' ),
				'default' => 'yes',
			)
		);

		$this->add_control(
			'properties_enabled',
			array(
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Show Properties', 'rhye' ),
				'default' => 'yes',
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

		$this->end_controls_section();

		$this->start_controls_section(
			'layout_section',
			array(
				'label' => esc_html__( 'Layout', 'rhye' ),
				'tab'   => Controls_Manager::TAB_LAYOUT,
			)
		);

		$this->add_responsive_control(
			'slides_min_height',
			array(
				'label'           => esc_html__( 'Slides Minimum Height', 'rhye' ),
				'type'            => Controls_Manager::SLIDER,
				'desktop_default' => array(
					'size' => 0,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 0,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 0,
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
					'{{WRAPPER}} .figure-service__content' => 'min-height: {{SIZE}}{{UNIT}};',
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
				'default' => 'rhye-1024-1024-crop',
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
					admin_url( 'edit.php?post_type=' . $post_type ),
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
			'slider_section',
			array(
				'label' => esc_html__( 'Slider', 'rhye' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			)
		);

		$this->add_control(
			'slides_heading',
			array(
				'label' => esc_html__( 'Slides', 'rhye' ),
				'type'  => Controls_Manager::HEADING,
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
					'size' => 1.4,
					'unit' => 'number',
				),
				'tablet_default'  => array(
					'size' => 1.2,
					'unit' => 'number',
				),
				'mobile_default'  => array(
					'size' => 1.1,
					'unit' => 'number',
				),
			)
		);

		$this->add_responsive_control(
			'centered_slides',
			array(
				'label'           => esc_html__( 'Horizontaly Centered Slides', 'rhye' ),
				'label_block'     => true,
				'type'            => Controls_Manager::SWITCHER,
				'desktop_default' => true,
				'tablet_default'  => true,
				'mobile_default'  => true,
			)
		);

		$this->add_control(
			'vertical_centered_slides',
			array(
				'label'   => esc_html__( 'Vertically Centered Slides', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_responsive_control(
			'space_between',
			array(
				'label'           => esc_html__( 'Space Between Slides', 'rhye' ),
				'type'            => Controls_Manager::SLIDER,
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 160,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 30,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 20,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 20,
					'unit' => 'px',
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
					'%1s: <strong>slider-images_touched</strong><br>%2s',
					esc_html__( 'Default', 'rhye' ),
					esc_html__( 'CSS class WITHOUT the dot that will be temporarily applied to the slider during the dragging.', 'rhye' )
				),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'slider-images_touched', 'rhye' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'mouse_cursor_enabled' => 'yes',
				),
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
				'default' => 'h3',
				'options' => ARTS_THEME_HTML_TAGS_ARRAY,
			)
		);

		$this->add_control(
			'typography_subheading',
			array(
				'label'     => esc_html__( 'Subheading', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'subheading_preset',
			array(
				'label'   => esc_html__( 'Typography Preset', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'subheading',
				'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
			)
		);

		$this->add_control(
			'subheading_tag',
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

		$this->add_control(
			'typography_properties_option',
			array(
				'label'     => esc_html__( 'Properties: Option', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'properties_option_preset',
			array(
				'label'   => esc_html__( 'Typography Preset', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'subheading',
				'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
			)
		);

		$this->add_control(
			'properties_option_tag',
			array(
				'label'   => esc_html__( 'HTML Tag', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'div',
				'options' => ARTS_THEME_HTML_TAGS_ARRAY,
			)
		);

		$this->add_control(
			'typography_properties_value',
			array(
				'label'     => esc_html__( 'Properties: Value', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'properties_value_preset',
			array(
				'label'   => esc_html__( 'Typography Preset', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
			)
		);

		$this->add_control(
			'properties_value_tag',
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

		$this->add_render_attribute(
			'section',
			array(
				'class' => array( 'section', 'section-services', 'section-slider-images' ),
			)
		);

		$this->add_render_attribute(
			'subheading',
			array(
				'class' => array( 'mt-0', 'mb-1', $settings['subheading_preset'] ),
			)
		);

		$this->add_render_attribute(
			'heading',
			array(
				'class' => array( 'mt-0', 'mb-0', $settings['heading_preset'] ),
			)
		);

		$this->add_render_attribute(
			'text',
			array(
				'class' => array( 'mb-0', 'mt-1', $settings['text_preset'] ),
			)
		);

		$this->add_render_attribute(
			'property_name',
			array(
				'class' => array( 'figure-service__name', 'mb-0-5', $settings['properties_option_preset'] ),
			)
		);

		$this->add_render_attribute(
			'property_value',
			array(
				'class' => array( 'figure-service__value', $settings['properties_value_preset'] ),
			)
		);

		$this->add_render_attribute(
			'slide_wrapper',
			array(
				'class' => array( 'w-100', 'h-100' ),
			)
		);

		$this->add_render_attribute(
			'swiper',
			array(
				'class'                       => array( 'swiper', 'swiper-container', 'js-slider-images__slider' ),
				'data-speed'                  => $settings['speed']['size'],
				'data-slides-per-view'        => $settings['slides_per_view']['size'],
				'data-slides-per-view-tablet' => $settings['slides_per_view_tablet']['size'],
				'data-slides-per-view-mobile' => $settings['slides_per_view_mobile']['size'],
				'data-space-between'          => $settings['space_between']['size'],
				'data-space-between-tablet'   => $settings['space_between_tablet']['size'],
				'data-space-between-mobile'   => $settings['space_between_mobile']['size'],
				'data-centered-slides'        => $settings['centered_slides'],
				'data-centered-slides-tablet' => $settings['centered_slides_tablet'],
				'data-centered-slides-mobile' => $settings['centered_slides_mobile'],
				'data-touch-ratio'            => $settings['touch_ratio']['size'],
				'data-counter-style'          => $settings['counter_style'],
				'data-counter-add-zeros'      => $settings['counter_zeros'],
				'data-auto-height'            => 'true',
			)
		);

		if ( $settings['autoplay_enabled'] ) {
			$this->add_render_attribute(
				'swiper',
				array(
					'data-autoplay-enabled' => 'true',
					'data-autoplay-delay'   => $settings['autoplay_delay']['size'],
				)
			);
		}

		if ( $settings['vertical_centered_slides'] ) {
			$this->add_render_attribute(
				'swiper',
				array(
					'class' => 'slider_vertical-centered',
				)
			);
		}

		if ( $settings['mouse_cursor_enabled'] ) {
			$this->add_render_attribute(
				'swiper',
				array(
					'data-drag-mouse'  => 'true',
					'data-drag-cursor' => 'true',
					'data-drag-class'  => $settings['on_drag_cursor_class'],
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
				<div class="slider slider-services slider-images js-slider-images">
					<div <?php $this->print_render_attribute_string( 'swiper' ); ?>>
						<div class="swiper-wrapper">
							<?php foreach ( $posts as $item ) : ?>
								<?php
									$image_id = $this->get_priority_image_id_to_display( $item, $settings['image_type'] );

									$this->add_render_attribute(
										'figure',
										array(
											'class' => array( 'container', 'figure-service', $settings[ 'background' . $item['id'] ] ),
											'data-arts-theme-text' => $settings[ 'main_theme' . $item['id'] ],
										),
										true,
										true
									);

								?>
								<div class="swiper-slide">
									<div <?php $this->print_render_attribute_string( 'figure' ); ?>>
										<div class="row no-gutters">
											<?php if ( $image_id ) : ?>
												<!-- background image -->
												<div class="col-lg-5 overflow">
													<div <?php $this->print_render_attribute_string( 'slide_wrapper' ); ?>>
														<!-- zoom on drag container -->
														<div class="slider__zoom-container w-100 h-100">
															<div class="figure-service__wrapper-bg">
																<?php
																	arts_the_lazy_image(
																		array(
																			'id'   => $image_id,
																			'size' => $settings['image_size'],
																			'class' => array(
																				'wrapper' => false,
																				'image'   => array( 'of-cover', 'slider__bg', 'swiper-lazy' ),
																			),
																		)
																	);
																?>
															</div>
														</div>
														<!-- - zoom on drag container -->
													</div>
												</div>
												<!-- - background image -->
											<?php endif; ?>
											<!-- content -->
											<div class="col-lg-7">
												<div class="figure-service__content p-small">
													<!-- header -->
													<div class="figure-service__header">
														<?php if ( $settings['subheadings_enabled'] && ! empty( $item['subheading'] ) ) : ?>
															<div class="figure-service__subheading">
																<<?php $this->print_html_tag( 'subheading_tag' ); ?> <?php $this->print_render_attribute_string( 'subheading' ); ?>><?php echo $item['subheading']; ?></<?php $this->print_html_tag( 'subheading_tag' ); ?>>
															</div>
														<?php endif; ?>
														<div class="figure-service__heading">
															<<?php $this->print_html_tag( 'heading_tag' ); ?> <?php $this->print_render_attribute_string( 'heading' ); ?>><?php echo $item['title']; ?></<?php $this->print_html_tag( 'heading_tag' ); ?>>
														</div>
														<?php if ( $settings['texts_enabled'] && ! empty( $item['text'] ) ) : ?>
															<div class="figure-service__text">
																<<?php $this->print_html_tag( 'text_tag' ); ?> <?php $this->print_render_attribute_string( 'text' ); ?>><?php echo $item['text']; ?></<?php $this->print_html_tag( 'text_tag' ); ?>>
															</div>
														<?php endif; ?>
													</div>
													<!-- - header -->
													<?php if ( $settings['properties_enabled'] || $settings['button_enabled'] ) : ?>
														<!-- footer -->
														<div class="figure-service__footer d-flex flex-wrap justify-content-between align-items-center mt-xsmall mt-md-2">
															<?php if ( $settings['properties_enabled'] && arts_have_rows( 'properties', $item['id'] ) ) : ?>
																<div class="row">
																	<?php while ( have_rows( 'properties', $item['id'] ) ) : ?>
																		<?php the_row(); ?>
																		<div class="col-auto figure-service__property mt-0-5">
																			<<?php $this->print_html_tag( 'properties_option_tag' ); ?> <?php $this->print_render_attribute_string( 'property_name' ); ?>><?php the_sub_field( 'name' ); ?></<?php $this->print_html_tag( 'properties_option_tag' ); ?>>
																			<?php if ( have_rows( 'list' ) ) : ?>
																				<?php while ( have_rows( 'list' ) ) : ?>
																					<?php the_row(); ?>
																					<<?php $this->print_html_tag( 'properties_value_tag' ); ?> <?php $this->print_render_attribute_string( 'property_value' ); ?>><?php the_sub_field( 'value' ); ?></<?php $this->print_html_tag( 'properties_value_tag' ); ?>>
																				<?php endwhile; ?>
																			<?php endif; ?>
																		</div>
																	<?php endwhile; ?>
																</div>
															<?php endif; ?>
															<?php if ( $settings['button_enabled'] ) : ?>
																<div class="figure-service__wrapper-button">
																	<a class="d-inline-block no-highlight" href="<?php echo esc_url( $item['permalink'] ); ?>">
																		<?php
																			arts_the_arrow(
																				array(
																					'direction' => 'right',
																				)
																			);
																		?>
																	</a>
																</div>
															<?php endif; ?>
														</div>
														<!-- - footer -->
													<?php endif; ?>
												</div>
											</div>
											<!-- - content -->
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<?php if ( $settings['counter_enabled'] || $settings['dots_enabled'] ) : ?>
						<!-- slider FOOTER -->
						<div class="container slider-services__footer mt-1 mt-md-2">
							<div class="row justify-content-between align-items-center">
								<?php if ( $settings['counter_enabled'] ) : ?>
									<!-- slider COUNTER (current) -->
									<div class="col-auto order-1">
										<div class="slider__counter slider__counter_mini">
											<div class="js-slider__counter-current swiper swiper-container">
												<div class="swiper-wrapper"></div>
											</div>
										</div>
									</div>
									<!-- - slider COUNTER (current) -->
									<!-- slider COUNTER (total) -->
									<div class="col-auto order-3">
										<div class="slider__total slider__total_mini js-slider__counter-total">I</div>
									</div>
									<!-- - slider COUNTER (total) -->
								<?php endif; ?>
								<?php if ( $settings['dots_enabled'] ) : ?>
									<!-- slider DOTS -->
									<div class="col-auto order-2">
										<div class="slider__dots js-slider__dots">
										</div>
									</div>
									<!-- - slider DOTS -->
								<?php endif; ?>
							</div>
						</div>
						<!-- - slider FOOTER -->
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php
	}
}
