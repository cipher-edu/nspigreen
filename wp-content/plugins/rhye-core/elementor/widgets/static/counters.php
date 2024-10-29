<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Counters extends Rhye_Widget_Base {
	protected static $_instance = null;

	public function get_name() {
		return 'rhye-widget-counters';
	}

	public function get_title() {
		return esc_html__( 'Counters', 'rhye' );
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
			'integration-class' => 'WPML_Rhye_Elementor_Counters',
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
			'label',
			array(
				'label'       => esc_html__( 'Label', 'rhye' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Label...', 'rhye' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'counter_start',
			array(
				'label'   => esc_html__( 'Start Number', 'rhye' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 10000,
				'step'    => 1,
				'default' => 0,
			)
		);

		$repeater->add_control(
			'counter_target',
			array(
				'label'   => esc_html__( 'Target Number', 'rhye' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 10000,
				'step'    => 1,
				'default' => 10,
			)
		);

		$repeater->add_control(
			'counter_prefix',
			array(
				'label'   => esc_html__( 'Prefix', 'rhye' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			)
		);

		$repeater->add_control(
			'counter_suffix',
			array(
				'label'   => esc_html__( 'Suffix', 'rhye' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			)
		);

		$this->add_control(
			'counters',
			array(
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'title_field'   => '{{{ label }}}',
				'prevent_empty' => false,
			)
		);

		$this->add_control(
			'counters_duration',
			array(
				'label'   => esc_html__( 'Animation Duration (seconds)', 'rhye' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 10,
				'step'    => 1,
				'default' => 4,
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
				'return_value' => 'aside-counters_dividers',
				'default'      => 'aside-counters_dividers',
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
			'typography_number_heading',
			array(
				'label' => esc_html__( 'Number', 'rhye' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'number_preset',
			array(
				'label'   => esc_html__( 'Typography Preset', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
			)
		);

		$this->add_control(
			'number_tag',
			array(
				'label'   => esc_html__( 'HTML Tag', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'div',
				'options' => ARTS_THEME_HTML_TAGS_ARRAY,
			)
		);

		$this->add_control(
			'typography_label',
			array(
				'label'     => esc_html__( 'Label', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'label_preset',
			array(
				'label'   => esc_html__( 'Typography Preset', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'paragraph',
				'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
			)
		);

		$this->add_control(
			'label_tag',
			array(
				'label'   => esc_html__( 'HTML Tag', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'span',
				'options' => ARTS_THEME_HTML_TAGS_ARRAY,
			)
		);

		$this->add_control(
			'text_alignment',
			array(
				'label'        => esc_html__( 'Text Align', 'rhye' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
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
				'default'      => '',
				'prefix_class' => '',
				'classes'      => '{{WRAPPER}}',
				'separator'    => 'before',
			)
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		?>

		<?php if ( ! empty( $settings['counters'] ) ) : ?>
			<?php
				$amount = count( $settings['counters'] );
				$col    = 'col-6';

			switch ( $amount ) {
				case 1:
					$col = 'col-12';
					break;
				case 2:
					$col = 'col-6';
					break;
				case 3:
					$col = 'col-lg-4 col-6';
					break;
				default:
					$col = 'col-lg-3 col-6';
					break;
			}

				$this->add_render_attribute(
					'column',
					array(
						'class' => array( 'aside-counters__wrapper-item', $col ),
					),
					true,
					true
				);

				$this->add_render_attribute(
					'section',
					array(
						'class' => array( 'aside-counters', $settings['dividers_enabled'], 'aside-counters_' . $amount ),
					),
					true,
					true
				);

				$this->add_render_attribute(
					'number',
					array(
						'class' => array( 'counter__number', 'js-counter__number', $settings['number_preset'] ),
					),
					true,
					true
				);
			?>
			<div <?php $this->print_render_attribute_string( 'section' ); ?>>
				<div class="no-gutters">
					<div class="row justify-content-center">
						<?php foreach ( $settings['counters'] as $index => $item ) : ?>
							<?php
								$labelKey = $this->get_repeater_setting_key( 'label', 'counters', $index );
								$this->add_inline_editing_attributes( $labelKey );
								$this->add_render_attribute( $labelKey, 'class', $settings['label_preset'] );
								$this->add_render_attribute(
									'counter',
									array(
										'class' => array( 'counter', 'js-counter' ),
										'data-counter-start' => $item['counter_start'],
										'data-counter-target' => $item['counter_target'],
										'data-counter-prefix' => $item['counter_prefix'],
										'data-counter-suffix' => $item['counter_suffix'],
										'data-counter-duration' => $settings['counters_duration'],
									),
									true,
									true
								);

							if ( $index === 2 && $amount === 3 ) {
								$this->add_render_attribute(
									'column',
									array(
										'class' => array( 'aside-counters__wrapper-item', 'col-lg-4', 'col-12' ),
									),
									true,
									true
								);
							}
							?>
							<div <?php $this->print_render_attribute_string( 'column' ); ?>>
								<div <?php $this->print_render_attribute_string( 'counter' ); ?>>
									<<?php $this->print_html_tag( 'number_tag' ); ?> <?php $this->print_render_attribute_string( 'number' ); ?>><?php echo $item['counter_target']; ?></<?php $this->print_html_tag( 'number_tag' ); ?>>
									<div class="counter__label">
										<<?php $this->print_html_tag( 'label_tag' ); ?> <?php $this->print_render_attribute_string( $labelKey ); ?>><?php echo $item['label']; ?></<?php $this->print_html_tag( 'label_tag' ); ?>>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php
	}

	protected function content_template() {

		?>

		<# if ( settings.counters.length ) { #>
			<#
				var amount = settings.counters.length;
				var col = 'col-6';

				switch (amount) {
					case 1:
						col = 'col-12';
						break;
					case 2:
						col = 'col-6';
						break;
					case 3:
						col = 'col-lg-4 col-6';
						break;
					default:
						col = 'col-lg-3 col-6';
						break;
				}

				view.addRenderAttribute(
					'column', {
						'class': [ 'aside-counters__wrapper-item', col ]
					}, true, true
				);

				view.addRenderAttribute(
					'section', {
						'class': [ 'aside-counters', settings.dividers_enabled, 'aside-counters_' + amount ],
					}, true, true
				);

				view.addRenderAttribute(
					'number', {
						'class': [ 'counter__number', 'js-counter__number', settings.number_preset ],
					}, true, true
				);
			#>
			<div {{{ view.getRenderAttributeString( 'section' ) }}}>
				<div class="no-gutters">
					<div class="row justify-content-center">
						<# _.each( settings.counters, function(item, index) { #>
							<#
								var labelKey = view.getRepeaterSettingKey( 'label', 'counters', index );
								view.addInlineEditingAttributes( labelKey );
								view.addRenderAttribute( labelKey, 'class', settings.label_preset );

								view.addRenderAttribute(
									'counter', {
										'class': [ 'counter', 'js-counter' ],
										'data-counter-start': item.counter_start,
										'data-counter-target': item.counter_target,
										'data-counter-prefix': item.counter_prefix,
										'data-counter-suffix': item.counter_suffix,
										'data-counter-duration': settings.counters_duration,
									}, true, true
								);

								if ( index === 2 && amount === 3 ) {
									view.addRenderAttribute(
										'column', {
											'class': [ 'aside-counters__wrapper-item', 'col-lg-4', 'col-12' ]
										}, true, true
									);
								}
							#>
							<div {{{ view.getRenderAttributeString( 'column' ) }}}>
								<div {{{ view.getRenderAttributeString( 'counter' ) }}}>
									<div {{{ view.getRenderAttributeString( 'number') }}}>{{{ item.counter_target }}}</div>
									<div class="counter__label">
										<span {{{ view.getRenderAttributeString( labelKey ) }}}>{{{ item.label }}}</span>
									</div>
								</div>
							</div>
						<# }); #>
					</div>
				</div>
			</div>
		<# } #>

		<?php
	}
}
