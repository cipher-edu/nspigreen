<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Image_Mouse_Hover_Reveal extends Rhye_Widget_Base {
	protected static $_instance = null;

	public function get_name() {
		return 'rhye-widget-image-mouse-hover-reveal';
	}

	public function get_title() {
		return esc_html__( 'Image Mouse Hover Reveal', 'rhye' );
	}

	public function get_icon() {
		return 'eicon-plug icon-rhye-widget-static';
	}

	public function get_categories() {
		return array( 'rhye-static' );
	}

	public function wpml_widgets_to_translate_filter( $widgets ) {

		$name  = $this->get_name();
		$title = $this->get_title();

		$widgets[ $name ] = array(
			'conditions'        => array( 'widgetType' => $name ),
			'fields'            => array(),
			'integration-class' => 'WPML_Rhye_Elementor_Image_Mouse_Hover_Reveal',
		);

		return $widgets;

	}

	public function add_wpml_support() {
		add_filter( 'wpml_elementor_widgets_to_translate', array( $this, 'wpml_widgets_to_translate_filter' ) );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'heading',
			array(
				'label'       => esc_html__( 'Heading', 'rhye' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Heading...', 'rhye' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'         => esc_html__( 'Link', 'rhye' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => 'https://...',
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				),
				'dynamic'       => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Choose Image', 'rhye' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'label'     => esc_html__( 'Thumbnail Size', 'rhye' ),
				'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default'   => 'full',
				'condition' => array(
					'image!' => array(
						'id'  => '',
						'url' => '',
					),
				),
			)
		);

		$this->add_control(
			'items',
			array(
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'title_field'   => '{{{ heading }}}',
				'prevent_empty' => false,
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
				'default' => 'py-medium',
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
			'style_section',
			array(
				'label' => esc_html__( 'Style', 'rhye' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'dividers_enabled',
			array(
				'label'        => esc_html__( 'Enable Dividers', 'rhye' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'section-list_dividers',
				'default'      => 'section-list_dividers',
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
			'effect_intensity',
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
			'effect_scale_texture',
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
			'effect_scale_plane',
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

		$amount = count( $settings['items'] );
		$col    = '';

		switch ( $amount ) {
			case 1:
				$col = 'col-12';
				break;
			case 2:
				$col = 'col-md-6 col-12';
				break;
			case 3:
				$col = 'col-md-4 col-6';
				break;
			default:
				$col = 'col-md-3 col-6';
				break;
		}

		$this->add_render_attribute( 'section', 'class', array( 'section', 'section-list', $settings['dividers_enabled'], 'section-list_' . $amount ) );
		$this->add_render_attribute( 'col', 'class', array( 'section-list__wrapper-item', $col ) );

		$this->add_render_attribute(
			'wrapper',
			array(
				'class'                         => array( 'container-fluid', 'no-gutters', 'list-projects', 'list-demos', 'js-list-hover' ),
				'data-arts-hover-strength'      => floatval( $settings['effect_intensity']['size'] ),
				'data-arts-hover-scale-texture' => floatval( $settings['effect_scale_texture']['size'] ),
				'data-arts-hover-scale-plane'   => floatval( $settings['effect_scale_plane']['size'] / 100 ),
				'data-arts-hover-enabled-at'    => $settings['transition_effect_enabled_at']['size'],
			)
		);

		$this->add_render_attribute(
			'heading',
			array(
				'class'                => array( 'list-projects__heading', 'js-split-text', 'split-text', $settings['heading_preset'] ),
				'data-split-text-type' => 'lines, words',
				'data-split-text-set'  => 'words',
			)
		);

		if ( $settings['animation_enabled'] ) {
			$this->add_render_attribute( 'section', 'data-arts-os-animation', 'true' );
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
				<div class="row align-items-center">
					<?php if ( ! empty( $settings['items'] ) ) : ?>
						<?php foreach ( $settings['items'] as $index => $item ) : ?>
							<?php
								$this->add_render_attribute(
									'link' . $index,
									array(
										'class'            => array( 'list-projects__item', 'list-demos__item', 'js-list-hover__link', $settings['items_paddings'] ),
										'href'             => $item['link']['url'],
										'data-arts-cursor' => 'true',
										'data-arts-cursor-hide-native' => 'true',
										'data-arts-cursor-scale' => '0.0',
									),
									true,
									true
								);

							if ( $settings['ajax_image_transition_enabled'] && ! empty( $item['image']['id'] ) ) {
								$this->add_render_attribute( 'link' . $index, 'data-pjax-link', 'listHover', true );
							}

							if ( $item['link']['is_external'] ) {
								$this->add_render_attribute( 'link' . $index, 'target', '_blank', true );
							}

							if ( $item['link']['nofollow'] ) {
								$this->add_render_attribute( 'link' . $index, 'rel', 'nofollow', true );
							}
							?>
							<div <?php $this->print_render_attribute_string( 'col' ); ?>>
								<a <?php $this->print_render_attribute_string( 'link' . $index ); ?>>
									<div class="row align-items-center justify-content-center">
										<?php if ( ! empty( $item['image']['id'] ) ) : ?>
											<!-- hidden AJAX transition image -->
											<div class="col-12 d-md-none">
												<div class="js-transition-img list-projects__cover overflow js-list-hover__cover">
													<?php
														arts_the_lazy_image(
															array(
																'id'    => $item['image']['id'],
																'size'  => $item['image_size'],
																'type'  => 'image',
																'class' => array(
																	'wrapper' => array(),
																	'image'   => array( 'js-transition-img__transformed-el', 'texture' ),
																),
															)
														);
													?>
												</div>
											</div>
											<!-- - hidden AJAX transition image -->
										<?php endif; ?>
										<?php if ( ! empty( $item['heading'] ) ) : ?>
											<!-- header -->
											<div class="col-12">
												<div class="list-projects__header mt-1 mt-md-0 mb-1 mb-md-0">
													<<?php $this->print_html_tag( 'heading_tag' ); ?> <?php $this->print_render_attribute_string( 'heading' ); ?>><?php echo $item['heading']; ?></<?php $this->print_html_tag( 'heading_tag' ); ?>>
												</div>
											</div>
											<!-- - header -->
										<?php endif; ?>
									</div>
								</a>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<!-- fixed canvas -->
				<canvas class="list-project__canvas js-list-hover__canvas" data-arts-scroll-fixed="true"></canvas>
				<!-- - fixed canvas -->
			</div>
		</div>

		<?php
	}
}
