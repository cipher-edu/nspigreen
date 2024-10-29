<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Services_Content_Block extends Rhye_Widget_Base {
	protected static $_instance, $_posts;
	protected static $_post_type = 'arts_service';

	public function get_name() {
		return 'rhye-widget-services-content-block';
	}

	public function get_title() {
		return esc_html__( 'Services Content Block', 'rhye' );
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
			 * Container
			 */
			$id = 'container' . $item['id'];
			$this->add_control(
				$id,
				array(
					'label'      => esc_html__( 'Container', 'rhye' ),
					'type'       => Controls_Manager::SELECT,
					'default'    => 'container-fluid',
					'options'    => array(
						'container'       => esc_html__( 'Container', 'rhye' ),
						'container-fluid' => esc_html__( 'Fullwidth', 'rhye' ),
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
			 * Gutters
			 */
			$id = 'gutters_enabled' . $item['id'];
			$this->add_control(
				$id,
				array(
					'label'      => esc_html__( 'Enable Gutters', 'rhye' ),
					'type'       => Controls_Manager::SWITCHER,
					'default'    => 'yes',
					'condition'  => array(
						'container' . $item['id'] => 'container-fluid',
						'enabled' . $item['id']   => 'yes',
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
				'default'   => esc_html__( 'Learn More', 'rhye' ),
				'dynamic'   => array(
					'active' => true,
				),
				'separator' => 'before',
				'condition' => array(
					'button_type' => 'button',
				),
			)
		);

		$this->add_control(
			'button_text_hover',
			array(
				'label'     => esc_html__( 'Hover Title', 'rhye' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Learn More', 'rhye' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'button_type' => 'button',
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
			'button_enabled',
			array(
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Show Button', 'rhye' ),
				'default' => 'yes',
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
				'default' => 'my-medium',
				'options' => array(
					''          => esc_html__( 'None', 'rhye' ),
					'my-xsmall' => esc_html__( '+ XSmall', 'rhye' ),
					'my-small'  => esc_html__( '+ Small', 'rhye' ),
					'my-medium' => esc_html__( '+ Medium', 'rhye' ),
					'my-large'  => esc_html__( '+ Large', 'rhye' ),
					'my-xlarge' => esc_html__( '+ XLarge', 'rhye' ),
				),
			)
		);

		$this->add_responsive_control(
			'content_max_width',
			array(
				'label'           => esc_html__( 'Content Overall Maximum Width', 'rhye' ),
				'type'            => Controls_Manager::SLIDER,
				'desktop_default' => array(
					'size' => 100,
					'unit' => '%',
				),
				'tablet_default'  => array(
					'size' => 100,
					'unit' => '%',
				),
				'mobile_default'  => array(
					'size' => 100,
					'unit' => '%',
				),
				'range'           => array(
					'px' => array(
						'min' => 0,
						'max' => 1440,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'size_units'      => array( 'px', '%' ),
				'selectors'       => array(
					'{{WRAPPER}} .section-content__inner' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_text_max_width',
			array(
				'label'           => esc_html__( 'Content Text Maximum Width', 'rhye' ),
				'type'            => Controls_Manager::SLIDER,
				'desktop_default' => array(
					'size' => 500,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 100,
					'unit' => '%',
				),
				'mobile_default'  => array(
					'size' => 500,
					'unit' => '%',
				),
				'range'           => array(
					'px' => array(
						'min' => 0,
						'max' => 1440,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'size_units'      => array( 'px', '%' ),
				'selectors'       => array(
					'{{WRAPPER}} .section-content__text' => 'max-width: {{SIZE}}{{UNIT}};',
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
				'default' => 'medium_large',
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
				'label'   => esc_html__( 'Subheading Preset', 'rhye' ),
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
		$settings = $this->get_settings_for_display();
		$posts    = $this->get_posts_to_display();

		$this->add_render_attribute(
			'section',
			array(
				'class' => array( 'section', 'section-services', 'section-content', $settings['items_margins'] ),
			)
		);

		$this->add_render_attribute( 'heading', 'class', array( 'section-content__heading', $settings['heading_preset'] ) );
		$this->add_render_attribute( 'subheading', 'class', array( 'section-content__heading', 'mb-0-5', $settings['subheading_preset'] ) );
		$this->add_render_attribute( 'text', 'class', array( 'section-content__text', 'mt-1', $settings['text_preset'] ) );

		if ( $settings['animation_enabled'] ) {
			$this->add_render_attribute(
				'section',
				array(
					'data-arts-os-animation' => 'true',
				)
			);

			$this->add_render_attribute(
				'heading',
				array(
					'class'                => array( 'split-text', 'js-split-text' ),
					'data-split-text-type' => 'lines,words',
					'data-split-text-set'  => 'words',
				)
			);

			$this->add_render_attribute(
				'subheading',
				array(
					'class'                => array( 'split-text', 'js-split-text' ),
					'data-split-text-type' => 'lines,words',
					'data-split-text-set'  => 'words',
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

		?>

		<?php if ( ! empty( $posts ) ) : ?>
			<?php foreach ( $posts as $item ) : ?>
				<?php
					$container       = $settings[ 'container' . $item['id'] ];
					$gutters_enabled = $settings[ 'gutters_enabled' . $item['id'] ];
					$position        = $settings[ 'position' . $item['id'] ];
					$col_image       = 'col-lg-' . $settings [ 'layout' . $item['id'] ];
					$col_content     = 'col-lg-' . ( 12 - intval( $settings [ 'layout' . $item['id'] ] ) );

					$this->add_render_attribute(
						'container',
						array(
							'class' => array( $container, 'section-services__container' ),
						),
						true,
						true
					);

				if ( $container === 'container-fluid' && ! $gutters_enabled ) {
					$this->add_render_attribute( 'container', 'class', 'no-gutters' );
				}

					$this->add_render_attribute( 'col_image', 'class', $col_image, true );
					$this->add_render_attribute( 'col_content', 'class', $col_content, true );
					$this->add_render_attribute( 'wrapper_letter', 'class', array( 'section-services__wrapper-letter', 'pointer-events-none' ), true );

				if ( $position === 'image_left' ) {
					$this->add_render_attribute( 'col_image', 'class', 'order-lg-1' );
					$this->add_render_attribute( 'col_content', 'class', 'order-lg-2' );
					$this->add_render_attribute( 'wrapper_letter', 'class', array( 'section-services__wrapper-letter_right', 'pointer-events-none' ) );
				} else {
					$this->add_render_attribute( 'col_image', 'class', 'order-lg-2' );
					$this->add_render_attribute( 'col_content', 'class', 'order-lg-1' );
					$this->add_render_attribute( 'wrapper_letter', 'class', array( 'section-services__wrapper-letter_left', 'pointer-events-none' ) );
				}
				?>
				<section <?php $this->print_render_attribute_string( 'section' ); ?>>
					<div <?php $this->print_render_attribute_string( 'container' ); ?>>
						<div class="row no-gutters align-items-center">
							<div <?php $this->print_render_attribute_string( 'col_image' ); ?>>
								<?php
									arts_the_lazy_image(
										array(
											'id'        => $this->get_priority_image_id_to_display( $item, $settings['image_type'] ),
											'size'      => $settings['image_size'],
											'type'      => 'image',
											'class'     => array(
												'section' => array( 'section', 'section-image' ),
												'wrapper' => array( 'section-image__wrapper' ),
												'image'   => array(),
											),
											'parallax'  => array(
												'enabled' => $settings['image_parallax'],
												'factor'  => $settings['image_parallax_speed']['size'],
											),
											'animation' => $settings['animation_enabled'],
											'mask'      => $settings['animation_enabled'] && $settings['animation_type'] === 'mask_reveal',
										)
									);
								?>
							</div>
							<div <?php $this->print_render_attribute_string( 'col_content' ); ?>>
								<div class="section-services__wrapper-content">
									<div class="clearfix container-fluid pt-md-0 pb-md-0 pt-small">
										<div class="section-content__inner">
											<?php if ( $settings['subheadings_enabled'] && ! empty( $item['subheading'] ) ) : ?>
												<<?php $this->print_html_tag( 'subheading_tag' ); ?> <?php $this->print_render_attribute_string( 'subheading' ); ?>><?php echo $item['subheading']; ?></<?php $this->print_html_tag( 'subheading_tag' ); ?>>
											<?php endif; ?>
											<?php if ( ! empty( $item['title'] ) ) : ?>
												<div class="w-100"></div>
												<<?php $this->print_html_tag( 'heading_tag' ); ?> <?php $this->print_render_attribute_string( 'heading' ); ?>><?php echo $item['title']; ?></<?php $this->print_html_tag( 'heading_tag' ); ?>>
											<?php endif; ?>
											<?php if ( $settings['texts_enabled'] && ! empty( $item['text'] ) ) : ?>
												<div class="w-100"></div>
												<<?php $this->print_html_tag( 'text_tag' ); ?> <?php $this->print_render_attribute_string( 'text' ); ?>><?php echo $item['text']; ?></<?php $this->print_html_tag( 'text_tag' ); ?>>
											<?php endif; ?>
											<?php if ( $settings['button_enabled'] ) : ?>
												<!-- more button -->
												<div class="w-100"></div>
												<div class="section-content__button mt-2">
													<?php if ( $settings['button_type'] === 'arrow' ) : ?>
														<a class="d-inline-block no-highlight" href="<?php echo esc_url( $item['permalink'] ); ?>">
															<?php
																arts_the_arrow(
																	array(
																		'direction' => 'right',
																	)
																);
															?>
														</a>
													<?php else : ?>
														<?php
															$this->add_render_attribute(
																'button',
																array(
																	'class'          => array( 'button', $settings['button_style'], $settings['button_color'] ),
																),
																true,
																true
															);

														if ( $settings['button_text_hover'] ) {
															$this->add_render_attribute( 'button', 'data-hover', $settings['button_text_hover'], true, true );
														}

															$this->add_render_attribute(
																'button',
																array(
																	'href' => esc_url( $item['permalink'] ),
																),
																true,
																true
															);
														?>
														<a <?php $this->print_render_attribute_string( 'button' ); ?>>
															<span class="button__label-hover"><?php echo esc_attr( $settings['button_text'] ); ?></span>
														</a>
													<?php endif; ?>
												</div>
												<!-- - more button -->
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php if ( $settings['letters_enabled'] && ! empty( $item['title'] ) ) : ?>
							<?php
								$amount_letters = intval( $settings['letters_amount']['size'] );
								$letter         = mb_substr( $item['title'], 0, $amount_letters );
							if ( $amount_letters === 1 ) {
								$letter = mb_strtoupper( $letter );
							}
							?>
							<div <?php $this->print_render_attribute_string( 'wrapper_letter' ); ?>>
								<div class="section-services__letter" data-arts-parallax="element" data-arts-parallax-y="-30%"><?php echo $letter; ?></div>
							</div>
						<?php endif; ?>
					</div>
				</section>
			<?php endforeach; ?>
		<?php endif; ?>

		<?php
	}
}
