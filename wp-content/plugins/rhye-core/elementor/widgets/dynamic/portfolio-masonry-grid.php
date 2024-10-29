<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Portfolio_Masonry_Grid extends Rhye_Widget_Base {
	protected static $_instance, $_posts;
	protected static $_post_type = 'arts_portfolio_item';

	public function get_name() {
		return 'rhye-widget-portfolio-masonry-grid';
	}

	public function get_title() {
		return esc_html__( 'Portfolio Masonry Grid', 'rhye' );
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
			'conditions' => array( 'widgetType' => $name ),
			'fields'     => array(
				array(
					'field'       => 'heading_text',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'Heading', 'rhye' ) ),
					'editor_type' => 'LINE',
				),
				array(
					'field'       => 'explore_label',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'Projects "Explore" Label', 'rhye' ) ),
					'editor_type' => 'LINE',
				),
				array(
					'field'       => 'filter_all_label',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'Filter "All" Label', 'rhye' ) ),
					'editor_type' => 'LINE',
				),
			),
		);

		return $widgets;

	}

	public function add_wpml_support() {
		add_filter( 'wpml_elementor_widgets_to_translate', array( $this, 'wpml_widgets_to_translate_filter' ) );
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
				'label' => esc_html__( 'Posts', 'rhye' ),
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
			 * Gutters
			 */
			$id = 'gutters_enabled' . $item['id'];
			$this->add_control(
				$id,
				array(
					'label'      => esc_html__( 'Enable Gutters', 'rhye' ),
					'type'       => Controls_Manager::SWITCHER,
					'default'    => '',
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

		// posts toggles & posts amount
		$this->add_controls_posts_toggles();

		$this->start_controls_section(
			'heading_section',
			array(
				'label' => esc_html__( 'Heading', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'heading_text',
			array(
				'label'   => esc_html__( 'Heading', 'rhye' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Works',
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'heading_headline',
			array(
				'label'     => esc_html__( 'Headline', 'rhye' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after',
				'options'   => array(
					'none'   => esc_html__( 'None', 'rhye' ),
					'before' => esc_html__( 'Before Heading', 'rhye' ),
					'after'  => esc_html__( 'After Heading', 'rhye' ),
				),
				'condition' => array(
					'heading_text!' => '',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_section',
			array(
				'label' => esc_html__( 'Button', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'explore_label',
			array(
				'label'   => esc_html__( '"Explore" Label', 'rhye' ),
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
			'layout_section',
			array(
				'label' => esc_html__( 'Layout', 'rhye' ),
				'tab'   => Controls_Manager::TAB_LAYOUT,
			)
		);

		$this->add_control(
			'content_layout',
			array(
				'label'   => esc_html__( 'Content', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'hover'   => esc_html__( 'Over the Images on Hover', 'rhye' ),
					'beneath' => esc_html__( 'Beneath the Images', 'rhye' ),
				),
				'default' => 'hover',
			)
		);

		$this->add_control(
			'header_heading',
			array(
				'label'     => esc_html__( 'Widget Header', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'header_layout',
			array(
				'label'   => esc_html__( 'Layout', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'heading_left'  => esc_html__( 'Heading Left / Filter Right', 'rhye' ),
					'heading_right' => esc_html__( 'Heading Right / Filter Left', 'rhye' ),
					'heading_above' => esc_html__( 'Heading Above / Filter Beneath', 'rhye' ),
				),
				'default' => 'heading_left',
			)
		);

		$this->add_control(
			'header_alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'rhye' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'text-left'   => array(
						'title' => esc_html__( 'Left', 'rhye' ),
						'icon'  => 'eicon-h-align-left',
					),
					'text-center' => array(
						'title' => esc_html__( 'Center', 'rhye' ),
						'icon'  => 'eicon-h-align-center',
					),
					'text-right'  => array(
						'title' => esc_html__( 'Right', 'rhye' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'   => 'text-left',
				'condition' => array(
					'header_layout' => 'heading_above',
				),
				'toggle'    => false,
			)
		);

		$this->add_control(
			'header_padding_bottom',
			array(
				'label'   => esc_html__( 'Bottom Padding', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'pb-medium',
				'options' => array(
					''          => esc_html__( 'None', 'rhye' ),
					'pb-xsmall' => esc_html__( '+ XSmall', 'rhye' ),
					'pb-small'  => esc_html__( '+ Small', 'rhye' ),
					'pb-medium' => esc_html__( '+ Medium', 'rhye' ),
					'pb-large'  => esc_html__( '+ Large', 'rhye' ),
					'pb-xlarge' => esc_html__( '+ XLarge', 'rhye' ),
				),
			)
		);

		$this->add_control(
			'filter_heading',
			array(
				'label'     => esc_html__( 'Filter', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'filter_enabled',
			array(
				'label'   => esc_html__( 'Enable Grid Filter', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'filter_all_label',
			array(
				'label'     => esc_html__( '"All" label', 'rhye' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'All', 'rhye' ),
				'condition' => array(
					'filter_enabled' => 'yes',
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'filter_row_class',
			array(
				'label'     => esc_html__( 'Justify Filter Items', 'rhye' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'justify-content-between' => array(
						'title' => esc_html__( 'Space Between', 'rhye' ),
						'icon'  => 'eicon-h-align-stretch',
					),
					'justify-content-start'   => array(
						'title' => esc_html__( 'Start', 'rhye' ),
						'icon'  => 'eicon-h-align-left',
					),
					'justify-content-center'  => array(
						'title' => esc_html__( 'Center', 'rhye' ),
						'icon'  => 'eicon-h-align-center',
					),
					'justify-content-end'     => array(
						'title' => esc_html__( 'End', 'rhye' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'   => 'justify-content-start',
				'condition' => array(
					'filter_enabled' => 'yes',
				),
				'toggle'    => false,

			)
		);

		$this->add_control(
			'filter_paddings',
			array(
				'label'     => esc_html__( 'Vertical Paddings', 'rhye' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'py-small',
				'options'   => array(
					''          => esc_html__( 'None', 'rhye' ),
					'py-xsmall' => esc_html__( '+ XSmall', 'rhye' ),
					'py-small'  => esc_html__( '+ Small', 'rhye' ),
					'py-medium' => esc_html__( '+ Medium', 'rhye' ),
					'py-large'  => esc_html__( '+ Large', 'rhye' ),
					'py-xlarge' => esc_html__( '+ XLarge', 'rhye' ),
				),
				'condition' => array(
					'filter_enabled' => 'yes',
					'header_layout'  => 'heading_above',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'grid_section',
			array(
				'label' => esc_html__( 'Grid', 'rhye' ),
				'tab'   => Controls_Manager::TAB_LAYOUT,
			)
		);

		$this->add_control(
			'fancy_enabled',
			array(
				'label'     => esc_html__( 'Enable Fancy Grid', 'rhye' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'condition' => array(
					'columns!' => '12',
				),
			)
		);

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
				'desktop_default' => 6,
				'tablet_default'  => 6,
				'mobile_default'  => 12,
			)
		);

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
			'transition_section',
			array(
				'label' => esc_html__( 'AJAX Transition', 'rhye' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'ajax_image_transition_enabled',
			array(
				'label'   => esc_html__( 'Enable AJAX Image Transition', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
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
			'typography_widget_heading',
			array(
				'label' => esc_html__( 'Widget Heading', 'rhye' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'widget_heading_preset',
			array(
				'label'   => esc_html__( 'Typography Preset', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
			)
		);

		$this->add_control(
			'widget_heading_tag',
			array(
				'label'   => esc_html__( 'HTML Tag', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => ARTS_THEME_HTML_TAGS_ARRAY,
			)
		);

		$this->add_control(
			'typography_heading',
			array(
				'label'     => esc_html__( 'Items Headings', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
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
				'default' => 'span',
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
		$settings          = $this->get_settings_for_display();
		$posts             = $this->get_posts_to_display();
		$active_taxonomies = $settings['filter_enabled'] ? $this->get_taxonomies_to_display( $posts ) : array();
		$col_desktop       = 'grid__item_desktop-' . $settings['columns'];
		$col_tablet        = 'grid__item_tablet-' . $settings['columns_tablet'];
		$col_mobile        = 'grid__item_mobile-' . $settings['columns_mobile'];

		$this->add_render_attribute(
			'section',
			array(
				'class'                    => array( 'section', 'section-grid', 'section-content', 'overflow' ),
				'data-grid-columns'        => 12 / $this->translate_columns_settings( $settings['columns'] ),
				'data-grid-columns-tablet' => 12 / $this->translate_columns_settings( $settings['columns_tablet'] ),
				'data-grid-columns-mobile' => 12 / $this->translate_columns_settings( $settings['columns_mobile'] ),
			)
		);
		$this->add_render_attribute( 'row_filter', 'class', array( 'row', $settings['filter_row_class'] ) );
		$this->add_render_attribute( 'grid', 'class', array( 'grid', 'js-grid' ) );
		$this->add_render_attribute( 'sizerAtts', 'class', array( 'grid__sizer', 'js-grid__sizer', $col_desktop, $col_tablet, $col_mobile ) );
		$this->add_render_attribute( 'widget_heading', 'class', array( 'mt-0', 'mb-0', $settings['widget_heading_preset'] ) );
		$this->add_render_attribute( 'heading', 'class', array( 'figure-project__heading', $settings['heading_preset'] ) );
		$this->add_render_attribute( 'category', 'class', $settings['category_preset'] );

		$this->add_render_attribute( 'row_header', 'class', array( 'row', 'align-items-center', 'section-grid__header' ) );
		$this->add_render_attribute( 'col_heading', 'class', array( 'col-12' ) );
		$this->add_render_attribute( 'col_filter', 'class', array( 'col-12' ) );

		$this->add_render_attribute(
			'text',
			array(
				'class'                => array( 'section-content__text', 'split-text', 'js-split-text', 'mt-1', $settings['text_preset'] ),
				'data-split-text-type' => 'lines',
				'data-split-text-set'  => 'lines',
			)
		);

		switch ( $settings['header_layout'] ) {
			case 'heading_left': {
				$this->add_render_attribute( 'row_header', 'class', array( 'justify-content-between', 'text-left', $settings['header_padding_bottom'] ) );
				$this->add_render_attribute( 'col_heading', 'class', array( 'col-lg-auto', 'order-lg-1' ) );
				$this->add_render_attribute( 'col_filter', 'class', array( 'col-lg-auto', 'order-lg-2' ) );

				if ( ! empty( $settings['heading_text'] ) ) {
					$this->add_render_attribute( 'col_filter', 'class', array( 'pt-small', 'pt-md-0' ) );
				}
				break;
			}
			case 'heading_right': {
				$this->add_render_attribute( 'row_header', 'class', array( 'justify-content-between', 'text-right', $settings['header_padding_bottom'] ) );
				$this->add_render_attribute( 'col_heading', 'class', array( 'col-lg-auto', 'order-lg-2' ) );
				$this->add_render_attribute( 'col_filter', 'class', array( 'col-lg-auto', 'order-lg-1' ) );

				if ( ! empty( $settings['heading_text'] ) ) {
					$this->add_render_attribute( 'col_filter', 'class', array( 'pt-small', 'pt-md-0' ) );
				}
				break;
			}
			case 'heading_above': {
				$this->add_render_attribute( 'row_header', 'class', array( 'justify-content-center' ) );
				$this->add_render_attribute( 'col_heading', 'class', $settings['header_alignment'] );
				$this->add_render_attribute( 'col_filter', 'class', $settings['filter_paddings'] );

				if ( empty( $settings['heading_text'] ) ) {
					$this->add_render_attribute( 'row_header', 'class', $settings['header_padding_bottom'] );
				}

				if ( ! $settings['filter_enabled'] || empty( $active_taxonomies ) ) {
					$this->add_render_attribute( 'row_header', 'class', $settings['header_padding_bottom'] );
				}
				break;
			}
		}

		if ( ! empty( $settings['heading_text'] ) && $settings['header_layout'] !== 'heading_above' && ( $settings['heading_headline'] === 'before' || $settings['heading_headline'] === 'after' ) ) {
			$this->add_render_attribute( 'col_filter', 'class', 'pb-md-2' );
		}

		if ( $settings['fancy_enabled'] ) {
			$this->add_render_attribute( 'grid', 'class', 'grid_fancy' );
		}

		if ( $settings['animation_enabled'] ) {
			$this->add_render_attribute( 'section', 'data-arts-os-animation', 'true' );
		}

		?>

		<?php if ( ! empty( $posts ) ) : ?>
			<div <?php $this->print_render_attribute_string( 'section' ); ?>>
				<?php if ( ! empty( $settings['heading_text'] ) || ( $settings['filter_enabled'] && ! empty( $active_taxonomies ) ) ) : ?>
					<div <?php $this->print_render_attribute_string( 'row_header' ); ?>>
						<?php if ( ! empty( $settings['heading_text'] ) ) : ?>
							<div <?php $this->print_render_attribute_string( 'col_heading' ); ?>>
								<?php if ( $settings['heading_headline'] === 'before' ) : ?>
									<div class="section__headline mb-1 mb-md-2"></div>
									<div class="w-100"></div>
								<?php endif; ?>
								<div class="section-grid__heading split-text js-split-text" data-split-text-type="lines,words" data-split-text-set="words">
									<<?php $this->print_html_tag( 'widget_heading_tag' ); ?> <?php $this->print_render_attribute_string( 'widget_heading' ); ?>><?php echo $settings['heading_text']; ?></<?php $this->print_html_tag( 'widget_heading_tag' ); ?>>
								</div>
								<?php if ( $settings['heading_headline'] === 'after' ) : ?>
									<div class="w-100"></div>
									<div class="section__headline mt-2"></div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if ( $settings['filter_enabled'] && ! empty( $active_taxonomies ) ) : ?>
							<div <?php $this->print_render_attribute_string( 'col_filter' ); ?>>
								<div class="filter js-filter">
									<div class="filter__inner">
										<div class="container-fluid no-gutters">
											<!-- items -->
											<div <?php $this->print_render_attribute_string( 'row_filter' ); ?>>
												<!-- all (*) -->
												<div class="col-lg-auto col-12 filter__item filter__item_active js-filter__item" data-filter="*">
													<div class="filter__item-inner">
														<div class="split-text js-split-text" data-split-text-type="lines,words" data-split-text-set="words"><?php echo esc_html( $settings['filter_all_label'] ); ?></div>
													</div>
												</div>
												<!-- - all (*) -->
												<?php foreach ( $active_taxonomies as $item ) : ?>
													<div class="col-lg-auto col-12 filter__item js-filter__item" data-filter=".category-<?php echo $item['slug']; ?>">
														<div class="filter__item-inner">
															<div class="split-text js-split-text" data-split-text-type="lines,words" data-split-text-set="words"><?php echo $item['name']; ?></div>
														</div>
													</div>
												<?php endforeach; ?>
											</div>
											<!-- - items-->
											<!-- underline -->
											<div class="filter__underline js-filter__underline"></div>
											<!-- - underline -->
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<div <?php $this->print_render_attribute_string( 'grid' ); ?>>
					<div <?php $this->print_render_attribute_string( 'sizerAtts' ); ?>></div>
					<?php foreach ( $posts as $item ) : ?>
						<?php
							$gutters_enabled = $settings[ 'gutters_enabled' . $item['id'] ];
							$this->add_render_attribute( 'item', 'class', array( 'grid__item', 'js-grid__item', $col_desktop, $col_tablet, $col_mobile ), true );
							$this->add_render_attribute( 'grid_item', 'class', 'section-grid__item', true );
							$this->add_render_attribute(
								'link',
								array(
									'class' => array( 'hover-zoom', 'figure-project' ),
									'href'  => $item['permalink'],
								),
								true,
								true
							);

						if ( $gutters_enabled ) {
							$this->add_render_attribute( 'grid_item', 'class', 'section-grid__item_padding' );
						}

						if ( $settings['content_layout'] === 'hover' ) {
							$this->add_render_attribute( 'link', 'class', 'figure-project_hover-inner' );
						} else {
							$this->add_render_attribute( 'link', 'class', 'js-change-text-hover' );
						}

						if ( $settings['ajax_image_transition_enabled'] ) {
							$this->add_render_attribute( 'link', 'data-pjax-link', 'flyingImage', true, true );
						}

						if ( array_key_exists( 'categories_slugs', $item ) && is_array( $item['categories_slugs'] ) ) {

							foreach ( $item['categories_slugs'] as $slug ) {
								$this->add_render_attribute( 'item', 'class', 'category-' . esc_attr( $slug ) );
							}
						}
						?>
						<div <?php $this->print_render_attribute_string( 'item' ); ?>>
							<div <?php $this->print_render_attribute_string( 'grid_item' ); ?>>
								<a <?php $this->print_render_attribute_string( 'link' ); ?>>
									<div class="hover-zoom__inner">
										<div class="hover-zoom__zoom">
											<?php
												arts_the_lazy_image(
													array(
														'id' => $this->get_priority_image_id_to_display( $item, $settings['image_type'] ),
														'type' => 'image',
														'size' => $settings['image_size'],
														'class' => array(
															'section' => array( 'section', 'section-image', 'figure-project__wrapper-img', 'js-transition-img' ),
															'wrapper' => array( 'section-image__wrapper', 'w-100', 'h-100' ),
															'image' => array( 'js-transition-img__transformed-el' ),
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
										<?php if ( $settings['content_layout'] === 'hover' ) : ?>
											<div class="figure-project__wrapper-content" data-arts-theme-text="light">
												<?php if ( $settings['categories_enabled'] && ! empty( $item['categories_names'] ) ) : ?>
													<div class="figure-project__category figure-project__category_absolute">
														<<?php $this->print_html_tag( 'category_tag' ); ?> <?php $this->print_render_attribute_string( 'category' ); ?>><?php echo implode( '&nbsp;&nbsp;/&nbsp;&nbsp;', $item['categories_names'] ); ?></<?php $this->print_html_tag( 'category_tag' ); ?>>
													</div>
												<?php endif; ?>
												<?php if ( ! empty( $item['title'] ) ) : ?>
													<div class="figure-project__content figure-project__content_absolute">
														<<?php $this->print_html_tag( 'heading_tag' ); ?> <?php $this->print_render_attribute_string( 'heading' ); ?>><?php echo $item['title']; ?></<?php $this->print_html_tag( 'heading_tag' ); ?>>
													</div>
												<?php endif; ?>
											</div>
											<div class="figure-project__overlay overlay overlay_dark"></div>
										<?php endif; ?>
									</div>
									<?php if ( $settings['content_layout'] === 'beneath' ) : ?>
										<div class="figure-project__content pl-md-2 pt-md-2 pt-1 pl-0">
											<?php if ( ! empty( $item['title'] ) ) : ?>
												<<?php $this->print_html_tag( 'heading_tag' ); ?> <?php $this->print_render_attribute_string( 'heading' ); ?>><?php echo $item['title']; ?></<?php $this->print_html_tag( 'heading_tag' ); ?>>
											<?php endif; ?>
											<?php if ( $settings['texts_enabled'] && ! empty( $item['text'] ) ) : ?>
												<<?php $this->print_html_tag( 'text_tag' ); ?>  <?php $this->print_render_attribute_string( 'text' ); ?>><?php echo $item['text']; ?></<?php $this->print_html_tag( 'text_tag' ); ?> >
											<?php endif; ?>
											<?php if ( $settings['categories_enabled'] && ! empty( $item['categories_names'] ) ) : ?>
												<?php
													$this->add_render_attribute(
														'category',
														array(
															'class' => array( 'change-text-hover__normal', 'js-split-text', 'split-text', 'js-change-text-hover__normal', $settings['category_preset'] ),
															'data-split-text-type' => 'lines',
															'data-split-text-set' => 'lines',
														),
														true,
														true
													);
													$this->add_render_attribute(
														'wrapper_category',
														array(
															'class' => array( 'change-text-hover', 'change-text-hover_has-line', 'text-left', $settings['category_preset'] ),
														),
														true,
														true
													);
												?>
												<div class="figure-project__category mt-md-1 mt-0-5">
													<div <?php $this->print_render_attribute_string( 'wrapper_category' ); ?>>
														<!-- label by default -->
														<<?php $this->print_html_tag( 'category_tag' ); ?> <?php $this->print_render_attribute_string( 'category' ); ?>><?php echo implode( '&nbsp;&nbsp;/&nbsp;&nbsp;', $item['categories_names'] ); ?></<?php $this->print_html_tag( 'category_tag' ); ?>>
														<!-- - label by default -->
														<!-- label on hover -->
														<div class="change-text-hover__hover js-change-text-hover__hover">
															<!-- hover line -->
															<div class="change-text-hover__line js-change-text-hover__line"></div>
															<!-- - hover line -->
															<span class="js-split-text split-text" data-split-text-type="lines" data-split-text-set="lines"><?php echo $settings['explore_label']; ?></span>
														</div>
														<!-- - label on hover -->
													</div>
												</div>
											<?php endif; ?>
										</div>
									<?php endif; ?>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php
	}
}
