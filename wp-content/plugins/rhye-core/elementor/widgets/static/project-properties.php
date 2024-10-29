<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Project_Properties extends Rhye_Widget_Base {
	protected static $_instance = null;

	public function get_name() {
		return 'rhye-widget-project-properties';
	}

	public function get_title() {
		return esc_html__( 'Project Properties', 'rhye' );
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
			'integration-class' => 'WPML_Elementor_Rhye_Widget_Project_Properties',
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
			'option',
			array(
				'label'       => esc_html__( 'Option', 'rhye' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'value',
			array(
				'label'       => esc_html__( 'Value', 'rhye' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'properties',
			array(
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'title_field'   => '{{{ option || value }}}',
				'prevent_empty' => false,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'social_section',
			array(
				'label' => esc_html__( 'Social Media', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'social_heading',
			array(
				'label'       => esc_html__( 'Heading', 'rhye' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_link',
			array(
				'label'         => esc_html__( 'Link', 'rhye' ),
				'type'          => Controls_Manager::URL,
				'show_external' => true,
				'default'       => array(
					'is_external' => true,
					'nofollow'    => true,
				),
				'dynamic'       => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'social_icon',
			array(
				'label' => esc_html__( 'Icon', 'rhye' ),
				'type'  => Controls_Manager::ICON,
			)
		);

		$this->add_control(
			'social',
			array(
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'title_field'   => '{{{ social_icon.replace("fa fa-", "") }}}',
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
		/**
		 * Columns
		 */
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
			'typography_properties_option',
			array(
				'label' => esc_html__( 'Properties: Option', 'rhye' ),
				'type'  => Controls_Manager::HEADING,
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
				'default' => 'paragraph',
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
				'label'   => esc_html__( 'Enable On-scroll animation', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'section',
			array(
				'class' => array( 'section', 'section-properties', 'section-content' ),
			)
		);

		$this->add_render_attribute(
			'option',
			array(
				'class' => array( 'figure-info__option', $settings['properties_option_preset'] ),
			)
		);

		$this->add_render_attribute(
			'value',
			array(
				'class' => array( 'figure-info__value', $settings['properties_value_preset'] ),
			)
		);

		$class_lg = 'col-lg-' . $settings['columns'];
		$class_sm = 'col-sm-' . $settings['columns_tablet'];
		$class_xs = 'col-' . $settings['columns_mobile'];

		$this->add_render_attribute(
			'column',
			array(
				'class' => array( $class_lg, $class_sm, $class_xs, 'section-properties__item' ),
			)
		);

		if ( $settings['animation_enabled'] ) {
			$this->add_render_attribute(
				'section',
				array(
					'data-arts-os-animation' => 'true',
				)
			);

			$this->add_render_attribute(
				'option',
				array(
					'class'                => array( 'split-text', 'js-split-text' ),
					'data-split-text-type' => 'lines,words',
					'data-split-text-set'  => 'words',
				)
			);
			$this->add_render_attribute(
				'value',
				array(
					'class'                => array( 'split-text', 'js-split-text' ),
					'data-split-text-type' => 'lines,words',
					'data-split-text-set'  => 'words',
				)
			);
		}

		?>

		<?php if ( ! empty( $settings['properties'] ) ) : ?>
			<div <?php $this->print_render_attribute_string( 'section' ); ?>>
				<div class="row">
					<?php foreach ( $settings['properties'] as $index => $item ) : ?>
						<?php
							$keyOption = $this->get_repeater_setting_key( 'option', 'properties', $index );
							$keyValue  = $this->get_repeater_setting_key( 'value', 'properties', $index );
							$this->add_inline_editing_attributes( $keyOption );
							$this->add_inline_editing_attributes( $keyValue );
						?>
						<div <?php $this->print_render_attribute_string( 'column' ); ?>>
							<div class="figure-info">
								<div <?php $this->print_render_attribute_string( 'option' ); ?>>
									<<?php $this->print_html_tag( 'properties_option_tag' ); ?> <?php $this->print_render_attribute_string( $keyOption ); ?>><?php echo $item['option']; ?></<?php $this->print_html_tag( 'properties_option_tag' ); ?>>
								</div>
								<div <?php $this->print_render_attribute_string( 'value' ); ?>>
									<<?php $this->print_html_tag( 'properties_value_tag' ); ?> <?php $this->print_render_attribute_string( $keyValue ); ?>><?php echo $item['value']; ?></<?php $this->print_html_tag( 'properties_value_tag' ); ?>>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					<?php if ( ! empty( $settings['social'] ) || ! empty( $settings['social_heading'] ) ) : ?>
						<div <?php $this->print_render_attribute_string( 'column' ); ?>>
							<div class="figure-info">
								<?php if ( ! empty( $settings['social_heading'] ) ) : ?>
									<?php $this->add_inline_editing_attributes( 'social_heading' ); ?>
									<div <?php $this->print_render_attribute_string( 'option' ); ?>>
										<<?php $this->print_html_tag( 'properties_option_tag' ); ?> <?php $this->print_render_attribute_string( 'social_heading' ); ?>><?php echo $settings['social_heading']; ?></<?php $this->print_html_tag( 'properties_option_tag' ); ?>>
									</div>
								<?php endif; ?>
								<?php if ( ! empty( $settings['social'] ) ) : ?>
									<div <?php $this->print_render_attribute_string( 'value' ); ?>>
										<ul class="social">
											<?php foreach ( $settings['social'] as $item ) : ?>
												<li class="social__item">
													<?php
														$this->add_render_attribute(
															'icon_link',
															array(
																'class' => $item['social_icon'],
																'href' => $item['social_link']['url'],
															),
															true,
															true
														);

													if ( $item['social_link']['is_external'] ) {
														$this->add_render_attribute( 'icon_link', 'target', '_blank', true );
													}

													if ( $item['social_link']['nofollow'] ) {
														$this->add_render_attribute( 'icon_link', 'rel', 'nofollow', true );
													}
													?>
													<a <?php $this->print_render_attribute_string( 'icon_link' ); ?>></a>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php
	}

	protected function content_template() {
		?>

		<#

			view.addRenderAttribute(
				'section', {
					'class': [ 'section', 'section-content', 'section-properties' ],
				}
			);

			view.addRenderAttribute(
				'option', {
					'class': [ 'figure-info__option', settings.properties_option_preset ],
				}
			);

			view.addRenderAttribute(
				'value', {
					'class': [ 'figure-info__value', settings.properties_value_preset ],
				}
			);

			var class_lg = 'col-lg-' + settings.columns;
			var class_sm = 'col-sm-' + settings.columns_tablet;
			var class_xs = 'col-' + settings.columns_mobile;

			view.addRenderAttribute(
				'column', {
					'class': [ 'section-properties__item', class_lg, class_sm, class_xs ],
				}
			);

		#>

		<# if (settings.properties.length ) { #>
			<div {{{ view.getRenderAttributeString( 'section' ) }}}>
				<div class="row">
					<# _.each( settings.properties, function(item, index) { #>
						<#
							var keyOption = view.getRepeaterSettingKey( 'option', 'properties', index );
							var keyValue = view.getRepeaterSettingKey( 'value', 'properties', index );
							view.addInlineEditingAttributes( keyOption );
							view.addInlineEditingAttributes( keyValue );
						#>
						<div {{{ view.getRenderAttributeString( 'column' ) }}}>
							<div class="figure-info">
								<div {{{ view.getRenderAttributeString( 'option' ) }}}>
									<div {{{ view.getRenderAttributeString( keyOption ) }}}>{{{ item.option }}}</div>
								</div>
								<div {{{ view.getRenderAttributeString( 'value' ) }}}>
									<div {{{ view.getRenderAttributeString( keyValue ) }}}>{{{ item.value }}}</div>
								</div>
							</div>
						</div>
					<# }); #>
					<# if ( settings.social.length || settings.social_heading ) { #>
						<div {{{ view.getRenderAttributeString( 'column' ) }}}>
							<div class="figure-info">
								<# if ( settings.social_heading ) { #>
									<# view.addInlineEditingAttributes( 'social_heading' ); #>
									<div {{{ view.getRenderAttributeString( 'option' ) }}}>
										<div {{{ view.getRenderAttributeString( 'social_heading' ) }}}>{{{ settings.social_heading }}}</div>
									</div>
								<# } #>
								<# if ( settings.social.length ) { #>
									<div <?php $this->print_render_attribute_string( 'value' ); ?>>
										<ul class="social">
											<# _.each( settings.social, function(item) { #>
												<li class="social__item">
													<#
														var target = item.social_link.is_external ? ' target="_blank"' : '';
														var nofollow = item.social_link.nofollow ? ' rel="nofollow"' : '';
													#>
													<a class="{{{ item.social_icon }}}" href="{{{ item.social_link.url }}}" {{{ target }}} {{{ nofollow }}}></a>
												</li>
											<# }); #>
										</ul>
									</div>
								<# } #>
							</div>
						</div>
					<# } #>
				</div>
			</div>
		<# } #>

		<?php
	}
}
