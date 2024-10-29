<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Slider_Testimonials extends Rhye_Widget_Base {
	protected static $_instance = null;

	public function get_name() {
		return 'rhye-widget-slider-testimonials';
	}

	public function get_title() {
		return esc_html__( 'Slider Testimonials', 'rhye' );
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
			'integration-class' => 'WPML_Elementor_Rhye_Widget_Slider_Testimonials',
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
			'avatar',
			array(
				'label'   => esc_html__( 'Choose Image', 'rhye' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
			'author',
			array(
				'label'       => esc_html__( 'Author', 'rhye' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Author...', 'rhye' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'text',
			array(
				'label'       => esc_html__( 'Text', 'rhye' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Text...', 'rhye' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'testimonials',
			array(
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'title_field'   => '{{{ author }}}',
				'prevent_empty' => false,
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
			'dots_heading',
			array(
				'label'     => esc_html__( 'Dots', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
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
			'layout_section',
			array(
				'label' => esc_html__( 'Layout', 'rhye' ),
				'tab'   => Controls_Manager::TAB_LAYOUT,
			)
		);

		$this->add_control(
			'heading_layout',
			array(
				'label' => esc_html__( 'Layout', 'rhye' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'   => esc_html__( 'Layout', 'rhye' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'centered',
				'options' => array(
					'text-left'   => array(
						'title' => esc_html__( 'Left', 'rhye' ),
						'icon'  => 'eicon-text-align-left',
					),
					'text-center' => array(
						'title' => esc_html__( 'Center', 'rhye' ),
						'icon'  => 'eicon-text-align-center',
					),
				),
				'default' => 'text-left',
				'toggle'  => false,
			)
		);

		$this->add_control(
			'heading_image',
			array(
				'label'     => esc_html__( 'Avatar', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
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

		$this->add_responsive_control(
			'avatar_width',
			array(
				'label'           => esc_html__( 'Maximum Width', 'rhye' ),
				'type'            => Controls_Manager::SLIDER,
				'desktop_default' => array(
					'size' => 400,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 200,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 120,
					'unit' => 'px',
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
					'{{WRAPPER}} .figure-testimonial__avatar' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'decorations_section',
			array(
				'label' => esc_html__( 'Decorations', 'rhye' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'quote_enabled',
			array(
				'label'   => esc_html__( 'Enable Quote', 'rhye' ),
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
			'typography_author',
			array(
				'label' => esc_html__( 'Author', 'rhye' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'author_preset',
			array(
				'label'   => esc_html__( 'Typography Preset', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'subheading',
				'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
			)
		);

		$this->add_control(
			'author_tag',
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
				'default' => 'blockquote',
				'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
			)
		);

		$this->add_control(
			'text_tag',
			array(
				'label'   => esc_html__( 'HTML Tag', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'blockquote',
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

		$this->add_render_attribute(
			'section',
			array(
				'class' => array( 'section', 'section-testimonials', $settings['layout'] ),
			)
		);

		$this->add_render_attribute(
			'swiper',
			array(
				'class'                  => array( 'swiper', 'swiper-container', 'slider', 'slider-testimonials', 'js-slider-testimonials' ),
				'data-speed'             => $settings['speed']['size'],
				'data-counter-style'     => $settings['counter_style'],
				'data-counter-add-zeros' => $settings['counter_zeros'],
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

		if ( $settings['animation_enabled'] ) {
			$this->add_render_attribute(
				'section',
				array(
					'data-arts-os-animation' => 'true',
				)
			);
		}

		?>

		<?php if ( ! empty( $settings['testimonials'] ) ) : ?>
			<div <?php $this->print_render_attribute_string( 'section' ); ?>>
				<div <?php $this->print_render_attribute_string( 'swiper' ); ?>>
					<div class="swiper-wrapper">
						<?php foreach ( $settings['testimonials'] as $index => $item ) : ?>
							<?php
								$authorKey = $this->get_repeater_setting_key( 'author', 'testimonials', $index );
								$textKey   = $this->get_repeater_setting_key( 'text', 'testimonials', $index );

								$this->add_inline_editing_attributes( $authorKey );
								$this->add_inline_editing_attributes( $textKey );

								$this->add_render_attribute( $textKey, 'class', array( 'figure-testimonial__text', $settings['text_preset'], 'mt-1', 'mb-1' ) );
								$this->add_render_attribute( $authorKey, 'class', array( 'figure-testimonial__author', $settings['author_preset'], 'mt-2' ) );

								$this->add_render_attribute( 'col_text', 'class', 'col', true );

							if ( ! empty( $item['avatar']['id'] ) ) {
								$this->add_render_attribute( 'col_text', 'class', 'pl-md-3' );
							}

							if ( $settings['layout'] === 'text-center' ) {
								$this->add_render_attribute( 'col_text', 'class', 'col-lg-8', true );
							}
							?>
							<div class="swiper-slide">
								<div class="container container_p-xs-0 figure-testimonial">
									<div class="row justify-content-center align-items-center">
										<?php if ( $settings['layout'] === 'text-left' && ! empty( $item['avatar']['id'] ) ) : ?>
											<!-- avatar image -->
											<div class="col-lg-auto col-12">
												<div class="figure-testimonial__avatar overflow border-radius-100">
													<?php
														arts_the_lazy_image(
															array(
																'id'   => $item['avatar']['id'],
																'type' => 'image',
																'size' => $settings['image_size'],
																'class' => array(
																	'wrapper' => false,
																	'image'   => array( 'swiper-lazy' ),
																),
															)
														);
													?>
												</div>
											</div>
											<!-- - avatar image -->
										<?php endif; ?>
										<!-- content -->
										<div <?php $this->print_render_attribute_string( 'col_text' ); ?>>
											<?php if ( $settings['layout'] === 'text-left' ) : ?>
												<?php if ( $settings['quote_enabled'] ) : ?>
													<div class="figure-testimonial__sign d-none d-lg-block"></div>
												<?php endif; ?>
											<?php else : ?>
												<?php if ( ! empty( $item['avatar']['id'] ) ) : ?>
													<!-- avatar image -->
													<div class="figure-testimonial__avatar overflow border-radius-100">
														<?php
															arts_the_lazy_image(
																array(
																	'id'   => $item['avatar']['id'],
																	'type' => 'image',
																	'size' => $settings['image_size'],
																	'class' => array(
																		'wrapper' => false,
																		'image'   => array( 'swiper-lazy' ),
																	),
																)
															);
														?>
													</div>
													<!-- - avatar image -->
												<?php else : ?>
													<?php if ( $settings['quote_enabled'] ) : ?>
														<div class="figure-testimonial__sign mx-auto"></div>
													<?php endif; ?>
												<?php endif; ?>
											<?php endif; ?>
											<div class="slider-testimonials__text split-text js-split-text" data-split-text-type="lines" data-split-text-set="lines">
												<?php if ( ! empty( $item['text'] ) ) : ?>
													<<?php $this->print_html_tag( 'text_tag' ); ?> <?php $this->print_render_attribute_string( $textKey ); ?>><?php echo $item['text']; ?></<?php $this->print_html_tag( 'text_tag' ); ?>>
												<?php endif; ?>
												<?php if ( ! empty( $item['author'] ) ) : ?>
													<<?php $this->print_html_tag( 'author_tag' ); ?> <?php $this->print_render_attribute_string( $authorKey ); ?>><?php echo $item['author']; ?></<?php $this->print_html_tag( 'author_tag' ); ?>>
												<?php endif; ?>
											</div>
										</div>
										<!-- - content -->
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<?php if ( $settings['counter_enabled'] || $settings['dots_enabled'] ) : ?>
						<!-- slider FOOTER -->
						<div class="container container_p-xs-0 slider-testimonials__footer mt-1 mt-md-2">
							<div class="row justify-content-between align-items-center slider-testimonials__row no-gutters">
								<?php if ( $settings['counter_enabled'] ) : ?>
									<!-- slider COUNTER (current) -->
									<div class="col-auto order-1">
										<div class="slider__counter slider__counter_mini">
											<div class="js-slider-testimonials__counter-current swiper swiper-container">
												<div class="swiper-wrapper"></div>
											</div>
										</div>
									</div>
									<!-- - slider COUNTER (current) -->
									<!-- slider COUNTER (total) -->
									<div class="col-auto order-3">
										<div class="slider__total slider__total_mini js-slider-testimonials__counter-total">I</div>
									</div>
									<!-- - slider COUNTER (total) -->
								<?php endif; ?>
								<?php if ( $settings['dots_enabled'] ) : ?>
									<!-- slider DOTS -->
									<div class="col-auto order-2 mx-auto">
										<div class="slider__dots js-slider__dots">
										</div>
									</div>
									<!-- - slider DOTS -->
								<?php endif; ?>
							</div>
						</div>
						<!-- - slider FOOTER -->
					<?php endif; ?>
					<?php if ( $settings['arrows_enabled'] ) : ?>
						<div class="slider-testimonials__arrows">
							<div class="slider__arrow slider__arrow_left js-slider__arrow-prev">
								<?php
									arts_the_arrow(
										array(
											'direction' => 'left',
										)
									);
								?>
							</div>
							<div class="slider__arrow slider__arrow_right js-slider__arrow-next">
								<?php
									arts_the_arrow(
										array(
											'direction' => 'right',
										)
									);
								?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php
	}
}
