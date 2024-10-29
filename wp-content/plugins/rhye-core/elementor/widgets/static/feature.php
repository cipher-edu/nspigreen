<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Feature extends Rhye_Widget_Base {
	protected static $_instance = null;

	public function get_name() {
		return 'rhye-widget-feature';
	}

	public function get_title() {
		return esc_html__( 'Feature', 'rhye' );
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
			'conditions' => array( 'widgetType' => $name ),
			'fields'     => array(
				array(
					'field'       => 'heading',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'Heading', 'rhye' ) ),
					'editor_type' => 'LINE',
				),
				array(
					'field'       => 'text',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'Text', 'rhye' ) ),
					'editor_type' => 'AREA',
				),
			),
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

		$this->add_control(
			'icon',
			array(
				'label' => esc_html__( 'Icon', 'rhye' ),
				'type'  => Controls_Manager::ICONS,
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => esc_html__( 'Heading', 'rhye' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Feature...', 'rhye' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'text',
			array(
				'label'   => esc_html__( 'Text', 'rhye' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 10,
				'default' => esc_html__( 'Description...', 'rhye' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'         => esc_html__( 'Link', 'rhye' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => 'https://...',
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				),
				'dynamic'       => array(
					'active' => true,
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
				'default' => 'h4',
				'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
			)
		);

		$this->add_control(
			'heading_tag',
			array(
				'label'      => esc_html__( 'HTML Tag', 'rhye' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'h3',
				'options'    => ARTS_THEME_HTML_TAGS_ARRAY,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'link[url]',
							'operator' => '===',
							'value'    => '',
						),
					),
				),
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
				'default' => 'yes',
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

		$settings    = $this->get_settings_for_display();
		$tag         = 'div';
		$heading_tag = $settings['heading_tag'];

		$this->add_render_attribute( 'section', 'class', array( 'section-content', 'figure-icon', 'text-center' ) );
		$this->add_render_attribute( 'wrapper_icon', 'class', array( 'figure-icon__wrapper-icon' ) );
		$this->add_render_attribute( 'heading', 'class', array( 'figure-feature__heading', 'mt-1', 'mb-0', $settings['heading_preset'] ) );
		$this->add_render_attribute( 'text', 'class', array( 'figure-feature__text', 'mt-1', 'mb-0', $settings['text_preset'] ) );

		if ( $settings['animation_enabled'] ) {
			$this->add_render_attribute( 'section', 'data-arts-os-animation', 'true' );
		}

		if ( $settings['cursor_enabled'] ) {
			$this->add_render_attribute(
				'wrapper_icon',
				arts_get_element_cursor_attributes(
					array(
						'enabled'     => 'true',
						'scale'       => $settings['cursor_scale']['size'],
						'magnetic'    => $settings['cursor_magnetic_enabled'],
						'hide_native' => $settings['cursor_hide_native_enabled'],
						'return'      => 'array',
					)
				)
			);
		}

		if ( ! empty( $settings['link']['url'] ) ) {
			$tag         = 'a';
			$heading_tag = 'a';
			$this->add_render_attribute( 'heading', 'href', $settings['link']['url'] );
			$this->add_render_attribute( 'wrapper_icon', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'heading', 'target', '_blank' );
				$this->add_render_attribute( 'wrapper_icon', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'heading', 'rel', 'nofollow' );
				$this->add_render_attribute( 'wrapper_icon', 'rel', 'nofollow' );
			}
		}

		?>

		<div <?php $this->print_render_attribute_string( 'section' ); ?>>
			<div class="section-content__image">
				<?php if ( ! empty( $settings['icon']['value'] ) ) : ?>
					<!-- icon -->
					<<?php echo $tag; ?> <?php $this->print_render_attribute_string( 'wrapper_icon' ); ?>>
						<?php
						Icons_Manager::render_icon(
							$settings['icon'],
							array(
								'class'       => 'figure-icon__icon',
								'aria-hidden' => 'true',
							)
						);
						?>
					</<?php echo $tag; ?>>
					<!-- - icon -->
				<?php endif; ?>
				<?php if ( ! empty( $settings['heading'] ) || ! empty( $settings['text'] ) ) : ?>
					<!-- header -->
					<div class="figure-icon__header">
						<?php if ( ! empty( $settings['heading'] ) ) : ?>
							<<?php echo $heading_tag; ?> <?php $this->print_render_attribute_string( 'heading' ); ?>><?php echo $settings['heading']; ?></<?php echo $heading_tag; ?>>
						<?php endif; ?>
						<?php if ( ! empty( $settings['text'] ) ) : ?>
							<<?php $this->print_html_tag( 'text_tag' ); ?> <?php $this->print_render_attribute_string( 'text' ); ?>><?php echo $settings['text']; ?></<?php $this->print_html_tag( 'text_tag' ); ?>>
						<?php endif; ?>
					</div>
					<!-- - header -->
				<?php endif; ?>
			</div>
		</div>

		<?php
	}
}
