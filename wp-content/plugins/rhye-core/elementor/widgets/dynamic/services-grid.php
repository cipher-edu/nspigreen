<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Services_Grid extends Rhye_Widget_Base {
	protected static $_instance, $_posts;
	protected static $_post_type = 'arts_service';

	public function get_name() {
		return 'rhye-widget-services-grid';
	}

	public function get_title() {
		return esc_html__( 'Services Grid', 'rhye' );
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
			 * Icon
			 */
			$id = 'icon' . $item['id'];
			$this->add_control(
				$id,
				array(
					'label'      => esc_html__( 'Icon', 'rhye' ),
					'type'       => Controls_Manager::ICON,
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
					'separator'  => 'after',
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
			'texts_enabled',
			array(
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Show Texts', 'rhye' ),
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
			'items_appearance',
			array(
				'label'   => esc_html__( 'Items Style', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array(
					'style_1' => esc_html__( 'Style 1', 'rhye' ),
					'style_2' => esc_html__( 'Style 2', 'rhye' ),
				),
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

		$this->add_responsive_control(
			'columns',
			array(
				'label'           => esc_html__( 'Columns', 'rhye' ),
				'type'            => Controls_Manager::SELECT,
				'options'         => array(
					3  => esc_html__( 'Four Columns', 'rhye' ),
					4  => esc_html__( 'Three Columns', 'rhye' ),
					6  => esc_html__( 'Two Columns', 'rhye' ),
					12 => esc_html__( 'Single Column', 'rhye' ),
				),
				'render_type'     => 'template',
				'desktop_default' => 4,
				'tablet_default'  => 6,
				'mobile_default'  => 12,
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
				'default' => 'h4',
				'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
			)
		);

		// $this->add_control(
		// 'heading_tag',
		// [
		// 'label'   => esc_html__( 'HTML Tag', 'rhye' ),
		// 'type'    => Controls_Manager::SELECT,
		// 'default' => 'h3',
		// 'options' => ARTS_THEME_HTML_TAGS_ARRAY,
		// ]
		// );
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
				'default' => '',
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
					'size' => 0.0,
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
			'cursor_magnetic_enabled',
			array(
				'label'     => esc_html__( 'Enable Magnetic Effect', 'rhye' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array(
					'cursor_enabled' => 'yes',
				),
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
				'class'                    => array( 'section', 'section-services', 'section-grid' ),
				'data-grid-columns'        => 12 / $this->translate_columns_settings( $settings['columns'] ),
				'data-grid-columns-tablet' => 12 / $this->translate_columns_settings( $settings['columns_tablet'] ),
				'data-grid-columns-mobile' => 12 / $this->translate_columns_settings( $settings['columns_mobile'] ),
			)
		);

		$this->add_render_attribute( 'text', 'class', array( 'figure-feature__description', $settings['text_preset'] ) );
		$this->add_render_attribute( 'header', 'class', array( 'figure-feature__header', $settings['items_paddings'] ) );

		$this->add_render_attribute( 'col', 'class', array( 'section-grid__item', 'col-gutters', 'col-lg-' . $settings['columns'], 'col-sm-' . $settings['columns_tablet'], 'col-' . $settings['columns_mobile'] ) );

		if ( $settings['animation_enabled'] ) {
			$this->add_render_attribute( 'section', 'data-arts-os-animation', 'true' );
		}

		?>

		<?php if ( ! empty( $posts ) ) : ?>
			<div <?php $this->print_render_attribute_string( 'section' ); ?>>
				<div class="container">
					<div class="row row-gutters">
						<?php foreach ( $posts as $item ) : ?>
							<?php
								$icon = $settings[ 'icon' . $item['id'] ];

								$this->add_render_attribute(
									'heading',
									array(
										'class' => array( 'figure-feature__heading', 'mt-0-5', 'mb-0', $settings['heading_preset'] ),
										'href'  => $item['permalink'],
									),
									true,
									true
								);

							if ( $settings['items_appearance'] === 'style_1' ) {
								$this->add_render_attribute(
									'figure',
									array(
										'class' => array( 'container', 'figure-feature', $settings[ 'background' . $item['id'] ] ),
										'data-arts-theme-text' => $settings[ 'main_theme' . $item['id'] ],
									),
									true,
									true
								);
								$this->add_render_attribute(
									'figure_wrapper_icon',
									array(
										'class' => array( 'figure-feature__icon', $icon ),
										'href'  => $item['permalink'],
									),
									true,
									true
								);
							}

							if ( $settings['items_appearance'] === 'style_2' ) {
								$this->add_render_attribute( 'figure', 'class', 'figure-icon', true );
								$this->add_render_attribute(
									'figure_wrapper_icon',
									array(
										'class' => array( 'figure-icon__wrapper-icon', $settings[ 'background' . $item['id'] ] ),
										'href'  => $item['permalink'],
										'data-arts-theme-text' => $settings[ 'main_theme' . $item['id'] ],
									),
									true,
									true
								);

								if ( $settings[ 'background' . $item['id'] ] ) {
									$this->add_render_attribute( 'figure_wrapper_icon', 'class', 'figure-icon__wrapper-icon_no-border' );
								}
							}

							if ( $settings['cursor_enabled'] ) {
								$this->add_render_attribute(
									'figure_wrapper_icon',
									arts_get_element_cursor_attributes(
										array(
											'enabled'     => 'true',
											'scale'       => $settings['cursor_scale']['size'],
											'magnetic'    => $settings['cursor_magnetic_enabled'],
											'hide_native' => $settings['cursor_hide_native_enabled'],
											'return'      => 'array',
										)
									),
									true,
									true
								);
							}
							?>
							<div <?php $this->print_render_attribute_string( 'col' ); ?>>
								<?php if ( $settings['items_appearance'] === 'style_1' ) : ?>
									<div <?php $this->print_render_attribute_string( 'figure' ); ?>>
										<div <?php $this->print_render_attribute_string( 'header' ); ?>>
											<?php if ( ! empty( $icon ) ) : ?>
												<!-- icon -->
												<a <?php $this->print_render_attribute_string( 'figure_wrapper_icon' ); ?>></a>
												<!-- - icon -->
											<?php endif; ?>
											<!-- header -->
											<?php if ( ! empty( $item['title'] ) ) : ?>
												<a <?php $this->print_render_attribute_string( 'heading' ); ?>><?php echo $item['title']; ?></a>
											<?php endif; ?>
											<?php if ( ! empty( $item['text'] ) && $settings['texts_enabled'] ) : ?>
												<<?php $this->print_html_tag( 'text_tag' ); ?> <?php $this->print_render_attribute_string( 'text' ); ?>><?php echo $item['text']; ?></<?php $this->print_html_tag( 'text_tag' ); ?>>
											<?php endif; ?>
											<!-- - header -->
										</div>
									</div>
								<?php endif; ?>
								<?php if ( $settings['items_appearance'] === 'style_2' ) : ?>
									<div <?php $this->print_render_attribute_string( 'figure' ); ?>>
										<?php if ( ! empty( $icon ) ) : ?>
											<!-- icon -->
											<a <?php $this->print_render_attribute_string( 'figure_wrapper_icon' ); ?>>
												<div class="figure-icon__icon <?php echo esc_attr( $icon ); ?>"></div>
											</a>
											<!-- - icon -->
										<?php endif; ?>
										<!-- header -->
										<div class="figure-icon__header">
											<?php if ( ! empty( $item['title'] ) ) : ?>
												<a <?php $this->print_render_attribute_string( 'heading' ); ?>><?php echo $item['title']; ?></a>
											<?php endif; ?>
											<?php if ( ! empty( $item['text'] ) && $settings['texts_enabled'] ) : ?>
												<<?php $this->print_html_tag( 'text_tag' ); ?> <?php $this->print_render_attribute_string( 'text' ); ?>><?php echo $item['text']; ?></<?php $this->print_html_tag( 'text_tag' ); ?>>
											<?php endif; ?>
										</div>
										<!-- - header -->
									</div>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php
	}
}
