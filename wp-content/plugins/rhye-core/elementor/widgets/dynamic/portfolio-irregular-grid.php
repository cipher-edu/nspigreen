<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Portfolio_Irregular_Grid extends Rhye_Widget_Base {
	protected static $_instance, $_posts;
	protected static $_post_type = 'arts_portfolio_item';

	public function get_name() {
		return 'rhye-widget-portfolio-irregular-grid';
	}

	public function get_title() {
		return esc_html__( 'Portfolio Irregular Grid', 'rhye' );
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
			 * Layout
			 */
			$id = 'layout' . $item['id'];
			$this->add_control(
				$id,
				array(
					'label'      => esc_html__( 'Columns (Image / Content)', 'rhye' ),
					'type'       => Controls_Manager::SELECT,
					'default'    => 7,
					'options'    => array(
						3 => '25% / 75%',
						4 => '33% / 66%',
						5 => '42% / 58%',
						6 => '50% / 50%',
						7 => '58% / 42%',
						8 => '66% / 33%',
						9 => '75% / 25%',
					),
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
			 * Position
			 */
			$id = 'position' . $item['id'];
			$this->add_control(
				$id,
				array(
					'label'      => esc_html__( 'Position', 'rhye' ),
					'type'       => Controls_Manager::SELECT,
					'default'    => 'image_left',
					'options'    => array(
						'image_left'  => esc_html__( 'Image Left / Content Right', 'rhye' ),
						'image_right' => esc_html__( 'Image Right / Content Left', 'rhye' ),
					),
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

		$this->add_control(
			'letters_enabled',
			array(
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Show Parallax Letters', 'rhye' ),
				'default' => 'yes',
			)
		);

		$this->add_control(
			'letters_amount',
			array(
				'label'      => esc_html__( 'Amount of Letters', 'rhye' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 1,
					'unit' => 'px',
				),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 3,
						'step' => 1,
					),
				),
				'condition'  => array(
					'letters_enabled' => 'yes',
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
			'items_margins',
			array(
				'label'   => esc_html__( 'Items Vertical Margins', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'mt-medium',
				'options' => array(
					''          => esc_html__( 'None', 'rhye' ),
					'mt-xsmall' => esc_html__( '+ XSmall', 'rhye' ),
					'mt-small'  => esc_html__( '+ Small', 'rhye' ),
					'mt-medium' => esc_html__( '+ Medium', 'rhye' ),
					'mt-large'  => esc_html__( '+ Large', 'rhye' ),
					'mt-xlarge' => esc_html__( '+ XLarge', 'rhye' ),
				),
			)
		);

		$this->add_control(
			'last_item_margin_xsmall',
			array(
				'label'     => esc_html__( 'Add Bottom Margin to Last Item', 'rhye' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'condition' => array(
					'items_margins' => 'mt-xsmall',
				),
				'selectors' => array(
					'{{WRAPPER}} .grid .grid__item:last-of-type' => 'margin-bottom: calc(1 * (var(--distance-min-xsmall) * 1px + (var(--distance-max-xsmall) * 1.2 - var(--distance-min-xsmall)) * ((100vw - 320px) / 1600)));',
				),
			)
		);

		$this->add_control(
			'last_item_margin_small',
			array(
				'label'     => esc_html__( 'Add Bottom Margin to Last Item', 'rhye' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'condition' => array(
					'items_margins' => 'mt-small',
				),
				'selectors' => array(
					'{{WRAPPER}} .grid .grid__item:last-of-type' => 'margin-bottom: calc(1 * (var(--distance-min-small) * 1px + (var(--distance-max-small) * 1.2 - var(--distance-min-small)) * ((100vw - 320px) / 1600)));',
				),
			)
		);

		$this->add_control(
			'last_item_margin_medium',
			array(
				'label'     => esc_html__( 'Add Bottom Margin to Last Item', 'rhye' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'condition' => array(
					'items_margins' => 'mt-medium',
				),
				'selectors' => array(
					'{{WRAPPER}} .grid .grid__item:last-of-type' => 'margin-bottom: calc(1 * (var(--distance-min-medium) * 1px + (var(--distance-max-medium) * 1.2 - var(--distance-min-medium)) * ((100vw - 320px) / 1600)));',
				),
			)
		);

		$this->add_control(
			'last_item_margin_large',
			array(
				'label'     => esc_html__( 'Add Bottom Margin to Last Item', 'rhye' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'condition' => array(
					'items_margins' => 'mt-large',
				),
				'selectors' => array(
					'{{WRAPPER}} .grid .grid__item:last-of-type' => 'margin-bottom: calc(1 * (var(--distance-min-large) * 1px + (var(--distance-max-large) * 1.2 - var(--distance-min-large)) * ((100vw - 320px) / 1600)));',
				),
			)
		);

		$this->add_control(
			'last_item_margin_xlarge',
			array(
				'label'     => esc_html__( 'Add Bottom Margin to Last Item', 'rhye' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'condition' => array(
					'items_margins' => 'mt-xlarge',
				),
				'selectors' => array(
					'{{WRAPPER}} .grid .grid__item:last-of-type' => 'margin-bottom: calc(1 * (var(--distance-min-xlarge) * 1px + (var(--distance-max-xlarge) * 1.2 - var(--distance-min-xlarge)) * ((100vw - 320px) / 1600)));',
				),
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
				'default' => 'large',
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

		$this->add_render_attribute(
			'section',
			array(
				'class'                    => array( 'section', 'section-grid', 'section-content' ),
				'data-grid-columns'        => '1',
				'data-grid-columns-tablet' => '1',
				'data-grid-columns-mobile' => '1',
			)
		);
		$this->add_render_attribute( 'row_filter', 'class', array( 'row', $settings['filter_row_class'] ) );
		$this->add_render_attribute( 'widget_heading', 'class', array( 'mt-0', 'mb-0', $settings['widget_heading_preset'] ) );
		$this->add_render_attribute( 'heading', 'class', array( 'figure-project__heading', $settings['heading_preset'] ) );
		$this->add_render_attribute( 'category', 'class', $settings['category_preset'] );

		$this->add_render_attribute( 'row_header', 'class', array( 'row', 'align-items-center', 'section-grid__header' ) );
		$this->add_render_attribute( 'col_heading', 'class', array( 'col-12' ) );
		$this->add_render_attribute( 'col_filter', 'class', array( 'col-12' ) );

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
				<div class="grid js-grid">
					<div class="grid__sizer js-grid__sizer"></div>
					<?php foreach ( $posts as $item ) : ?>
						<?php
							$position    = $settings[ 'position' . $item['id'] ];
							$col_image   = 'col-lg-' . $settings [ 'layout' . $item['id'] ];
							$col_content = 'col-lg-' . ( 12 - intval( $settings [ 'layout' . $item['id'] ] ) );
							$image_id    = $this->get_priority_image_id_to_display( $item, $settings['image_type'] );

							$this->add_render_attribute( 'item', 'class', array( 'grid__item', 'js-grid__item', $settings['items_margins'] ), true );
							$this->add_render_attribute( 'link_header', 'class', array( 'figure-project__link', 'pointer-events-auto' ), true );
							$this->add_render_attribute(
								'link_image',
								array(
									'class' => array( 'hover-zoom', 'figure-project__link', 'js-change-text-hover', 'row no-gutters align-items-center figure-project figure-project_no-hover d-flex justify-content-center', 'pointer-events-none' ),
									'href'  => $item['permalink'],
								),
								true,
								true
							);
							$this->add_render_attribute( 'col_image', 'class', $col_image, true );
							$this->add_render_attribute( 'col_content', 'class', $col_content, true );
							$this->add_render_attribute( 'wrapper_content', 'class', array( 'figure-project__content', 'pt-1', 'pt-md-0' ), true );
							$this->add_render_attribute( 'wrapper_letter', 'class', array( 'figure-project__wrapper-letter', 'd-lg-block', 'd-none' ), true );

						if ( $settings['ajax_image_transition_enabled'] && $image_id ) {
							$this->add_render_attribute( 'link_header', 'data-pjax-link', 'flyingImage', true, true );
							$this->add_render_attribute( 'link_image', 'data-pjax-link', 'flyingImage', true, true );
						}

						if ( array_key_exists( 'categories_slugs', $item ) && is_array( $item['categories_slugs'] ) ) {
							foreach ( $item['categories_slugs'] as $slug ) {
								$this->add_render_attribute( 'item', 'class', 'category-' . esc_attr( $slug ) );
							}
						}

						if ( $position === 'image_left' ) {
							$this->add_render_attribute( 'col_image', 'class', 'order-lg-1' );
							$this->add_render_attribute( 'col_content', 'class', 'order-lg-2' );
							$this->add_render_attribute( 'wrapper_content', 'class', 'text-lg-left' );
							$this->add_render_attribute( 'wrapper_category', 'class', 'text-lg-left', true );
							$this->add_render_attribute( 'wrapper_letter', 'class', 'figure-project__wrapper-letter_right' );
						} else {
							$this->add_render_attribute( 'col_image', 'class', 'order-lg-2' );
							$this->add_render_attribute( 'col_content', 'class', 'order-lg-1' );
							$this->add_render_attribute( 'wrapper_content', 'class', 'text-lg-right' );
							$this->add_render_attribute( 'wrapper_category', 'class', 'text-lg-right', true );
							$this->add_render_attribute( 'wrapper_letter', 'class', 'figure-project__wrapper-letter_left' );
						}
						?>
						<div <?php $this->print_render_attribute_string( 'item' ); ?>>
							<div class="section-grid__item">
								<a <?php $this->print_render_attribute_string( 'link_image' ); ?>>
									<div <?php $this->print_render_attribute_string( 'col_image' ); ?>>
										<?php if ( $image_id ) : ?>
											<div class="figure-project__wrapper-img pointer-events-auto">
												<div class="hover-zoom__inner">
													<div class="hover-zoom__zoom">
														<?php
															arts_the_lazy_image(
																array(
																	'id' => $image_id,
																	'type' => 'image',
																	'size' => $settings['image_size'],
																	'class' => array(
																		'section' => array( 'section', 'section-image', 'js-transition-img' ),
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
												</div>
												<?php if ( $settings['letters_enabled'] && is_array( $settings['letters_amount'] ) && ! empty( $item['title'] ) ) : ?>
													<?php
														$amount_letters = intval( $settings['letters_amount']['size'] );
														$letter         = mb_substr( $item['title'], 0, $amount_letters );

													if ( $amount_letters === 1 ) {
														$letter = mb_strtoupper( $letter );
													}
													?>
													<div <?php $this->print_render_attribute_string( 'wrapper_letter' ); ?>>
														<div class="figure-project__letter" data-arts-parallax="element" data-arts-parallax-y="-20%"><?php echo $letter; ?></div>
													</div>
												<?php endif; ?>
											</div>
										<?php endif; ?>
									</div>
									<div <?php $this->print_render_attribute_string( 'col_content' ); ?>>
										<div <?php $this->print_render_attribute_string( 'wrapper_content' ); ?>>
											<div <?php $this->print_render_attribute_string( 'link_header' ); ?>>
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
																'class' => array( 'change-text-hover__normal', 'js-split-text', 'split-text', 'js-change-text-hover__normal' ),
																'data-split-text-type' => 'lines',
																'data-split-text-set' => 'lines',
															),
															true,
															true
														);
														$this->add_render_attribute(
															'wrapper_category',
															array(
																'class' => array( 'change-text-hover', 'change-text-hover_has-line', $settings['category_preset'] ),
															)
														);
													?>
													<div class="figure-project__category mt-md-1 mt-0-5">
														<div <?php $this->print_render_attribute_string( 'wrapper_category' ); ?>>
															<!-- label by default -->
															<<?php $this->print_html_tag( 'category_tag' ); ?> <?php $this->print_render_attribute_string( 'category' ); ?>><?php echo implode( '&nbsp;&nbsp;/&nbsp;&nbsp;', $item['categories_names'] ); ?></<?php $this->print_html_tag( 'category_tag' ); ?>>
															<!-- - label by default -->
															<!-- label on hover -->
															<div class="change-text-hover__hover js-change-text-hover__hover"><span class="js-split-text split-text" data-split-text-type="lines" data-split-text-set="lines"><?php echo $settings['explore_label']; ?></span>
															</div>
															<!-- - label on hover -->
														</div>
													</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
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
