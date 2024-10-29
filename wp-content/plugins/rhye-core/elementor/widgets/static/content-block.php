<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Content_Block extends Rhye_Widget_Base {
	protected static $_instance = null;

	public function get_name() {
		return 'rhye-widget-content-block';
	}

	public function get_title() {
		return esc_html__( 'Content Block', 'rhye' );
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
					'field'       => 'heading_text',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'Heading', 'rhye' ) ),
					'editor_type' => 'VISUAL',
				),
				array(
					'field'       => 'content_text',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'Content', 'rhye' ) ),
					'editor_type' => 'VISUAL',
				),
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
				array(
					'field'       => 'button_link',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'Button Link', 'rhye' ) ),
					'editor_type' => 'LINE',
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
			'background_section',
			array(
				'label' => esc_html__( 'Background', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'background_type',
			array(
				'label'   => esc_html__( 'Type', 'rhye' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					''      => array(
						'title' => esc_html__( 'None', 'rhye' ),
						'icon'  => 'eicon-ban',
					),
					'image' => array(
						'title' => esc_html__( 'Image', 'rhye' ),
						'icon'  => 'eicon-image-bold',
					),
					'video' => array(
						'title' => esc_html__( 'Video', 'rhye' ),
						'icon'  => 'eicon-video-camera',
					),
				),
				'default' => '',
				'toggle'  => false,
			)
		);

		$this->add_control(
			'image',
			array(
				'label'     => esc_html__( 'Choose Image', 'rhye' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'background_type' => 'image',
				),
			)
		);

		$this->add_control(
			'video',
			array(
				'label'      => esc_html__( 'Choose Video', 'rhye' ),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'video',
				'condition'  => array(
					'background_type' => 'video',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'label'     => esc_html__( 'Thumbnail Size', 'rhye' ),
				'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default'   => 'full',
				'condition' => array(
					'background_type' => 'image',
				),
			)
		);

		$background_position_selectors = arts_elementor_should_selectors_have_responsive_prefixes() ? array(
			'(desktop) {{WRAPPER}} .section-image__wrapper img' => 'object-position: {{background_position_x.SIZE}}{{background_position_x.UNIT}} {{background_position_y.SIZE}}{{background_position_y.UNIT}};',
			'(tablet) {{WRAPPER}} .section-image__wrapper img' => 'object-position: {{background_position_x_tablet.SIZE}}{{background_position_x_tablet.UNIT}} {{background_position_y_tablet.SIZE}}{{background_position_y_tablet.UNIT}};',
			'(mobile) {{WRAPPER}} .section-image__wrapper img' => 'object-position: {{background_position_x_mobile.SIZE}}{{background_position_x_mobile.UNIT}} {{background_position_y_mobile.SIZE}}{{background_position_y_mobile.UNIT}};',
		) : array(
			'{{WRAPPER}} .section-image__wrapper img' => 'object-position: {{background_position_x.SIZE}}{{background_position_x.UNIT}} {{background_position_y.SIZE}}{{background_position_y.UNIT}};',
		);
		$this->add_responsive_control(
			'background_position_x',
			array(
				'label'           => esc_html__( 'Background Position X', 'rhye' ),
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'desktop_default' => array(
					'size' => 50,
					'unit' => '%',
				),
				'tablet_default'  => array(
					'size' => 50,
					'unit' => '%',
				),
				'mobile_default'  => array(
					'size' => 50,
					'unit' => '%',
				),
				'range'           => array(
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'size_units'      => array( '%' ),
				'selectors'       => $background_position_selectors,
				'condition'       => array(
					'background_type' => 'image',
					'image!'          => array(
						'id'  => '',
						'url' => '',
					),
				),
			)
		);

		$this->add_responsive_control(
			'background_position_y',
			array(
				'label'           => esc_html__( 'Background Position Y', 'rhye' ),
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'desktop_default' => array(
					'size' => 50,
					'unit' => '%',
				),
				'tablet_default'  => array(
					'size' => 50,
					'unit' => '%',
				),
				'mobile_default'  => array(
					'size' => 50,
					'unit' => '%',
				),
				'range'           => array(
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'       => $background_position_selectors,
				'size_units'      => array( '%' ),
				'condition'       => array(
					'background_type' => 'image',
					'image!'          => array(
						'id'  => '',
						'url' => '',
					),
				),
			)
		);

		$this->add_control(
			'overlay',
			array(
				'label'     => esc_html__( 'Overlay', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'background_type!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'background_overlay',
				'selector'  => '{{WRAPPER}} .section-image__overlay',
				'condition' => array(
					'background_type!' => '',
				),
			)
		);

		$this->add_control(
			'heading_parallax',
			array(
				'label'     => esc_html__( 'Parallax', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'background_type!' => '',
				),
			)
		);

		$this->add_control(
			'image_parallax',
			array(
				'label'     => esc_html__( 'Enable Parallax', 'rhye' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array(
					'background_type!' => '',
					'image!'           => array(
						'id'  => '',
						'url' => '',
					),
				),
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
					'background_type!' => '',
					'image_parallax'   => 'yes',
					'image!'           => array(
						'id'  => '',
						'url' => '',
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'heading_section',
			array(
				'label' => esc_html__( 'Heading', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'heading_enable_headline_before',
			array(
				'label'   => esc_html__( 'Enable Headline Before', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'heading_enable_headline_after',
			array(
				'label'   => esc_html__( 'Enable Headline After', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
			)
		);

		$this->add_control(
			'heading_text',
			array(
				'type'    => Controls_Manager::WYSIWYG,
				'default' => '<h2>Heading...</h2>',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'content_text',
			array(
				'type'        => Controls_Manager::WYSIWYG,
				'description' => sprintf(
					'%1s <strong>%2s</strong> %3s',
					esc_html__( 'Use class', 'rhye' ),
					'has-drop-cap',
					esc_html__( 'on an HTML element to set a dropcap.', 'rhye' )
				),
				'default'     => '<p>Text...</p>',
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
			'button_text',
			array(
				'label'   => esc_html__( 'Title', 'rhye' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'button_text_hover',
			array(
				'label'   => esc_html__( 'Hover Title', 'rhye' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'button_link',
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
				'default'     => 'button_solid',
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
			'overall_max_width',
			array(
				'label'           => esc_html__( 'Overall Maximum Width', 'rhye' ),
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
			'text_max_width',
			array(
				'label'           => esc_html__( 'Text Maximum Width', 'rhye' ),
				'type'            => Controls_Manager::SLIDER,
				'desktop_default' => array(
					'size' => 700,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 700,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 700,
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
					'{{WRAPPER}} .section-content__text' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'padding_top',
			array(
				'label'   => esc_html__( 'Padding Top', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''          => esc_html__( 'None', 'rhye' ),
					'pt-xsmall' => esc_html__( '+ XSmall', 'rhye' ),
					'pt-small'  => esc_html__( '+ Small', 'rhye' ),
					'pt-medium' => esc_html__( '+ Medium', 'rhye' ),
					'pt-large'  => esc_html__( '+ Large', 'rhye' ),
					'pt-xlarge' => esc_html__( '+ XLarge', 'rhye' ),
				),
			)
		);

		$this->add_control(
			'padding_bottom',
			array(
				'label'   => esc_html__( 'Padding Bottom', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
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
			'fit_to_screen_enabled',
			array(
				'label'   => esc_html__( 'Enable Fit to Screen', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
			)
		);

		$this->add_control(
			'scroll_down_enabled',
			array(
				'type'      => Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Show Scroll Down', 'rhye' ),
				'default'   => '',
				'condition' => array(
					'fit_to_screen_enabled' => 'yes',
				),
			)
		);

		$this->add_control(
			'scroll_down_label_enabled',
			array(
				'type'      => Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Override Scroll Down Label', 'rhye' ),
				'default'   => '',
				'condition' => array(
					'fit_to_screen_enabled' => 'yes',
					'scroll_down_enabled'   => 'yes',
				),
			)
		);

		$this->add_control(
			'scroll_down_label',
			array(
				'label'     => esc_html__( 'Scroll Down Label', 'rhye' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => get_theme_mod( 'label_scroll_down_pages', esc_html__( 'Scroll Down', 'rhye' ) ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'fit_to_screen_enabled'     => 'yes',
					'scroll_down_enabled'       => 'yes',
					'scroll_down_label_enabled' => 'yes',
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

		$this->start_controls_section(
			'typography_section',
			array(
				'label' => esc_html__( 'Typography', 'rhye' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
			)
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$sd_label = get_theme_mod( 'label_scroll_down_pages', esc_html__( 'Scroll Down', 'rhye' ) );

		$this->add_render_attribute( 'section', 'class', array( 'section', 'section-content', 'clearfix', $settings['padding_top'], $settings['padding_bottom'] ) );
		$this->add_render_attribute( 'heading', 'class', 'section-content__heading' );
		$this->add_render_attribute( 'content', 'class', 'section-content__text' );
		$this->add_render_attribute( 'wrapper_button', 'class', array( 'section-content__button', 'mt-2' ) );
		$this->add_render_attribute( 'content_inner', 'class', array( 'section-content__inner' ) );

		$this->add_render_attribute(
			'button',
			array(
				'class' => array( 'button', $settings['button_style'], $settings['button_color'] ),
				'href'  => esc_url( $settings['button_link']['url'] ),
			)
		);

		if ( $settings['scroll_down_label_enabled'] ) {
			$sd_label = $settings['scroll_down_label'];
		}

		if ( $settings['fit_to_screen_enabled'] ) {
			$this->add_render_attribute( 'section', 'class', 'section-fullheight' );
		}

		if ( $settings['button_text_hover'] ) {
			$this->add_render_attribute( 'button', 'data-hover', $settings['button_text_hover'] );
		}

		if ( $settings['button_link']['is_external'] ) {
			$this->add_render_attribute( 'button', 'target', '_blank' );
		}

		if ( $settings['button_link']['nofollow'] ) {
			$this->add_render_attribute( 'button', 'rel', 'nofollow' );
		}

		if ( $settings['animation_enabled'] ) {
			$this->add_render_attribute( 'section', 'data-arts-os-animation', 'true' );

			$this->add_render_attribute(
				'heading',
				array(
					'class'                => array( 'split-text', 'js-split-text' ),
					'data-split-text-type' => 'lines,words',
					'data-split-text-set'  => 'words',
				)
			);

			$this->add_render_attribute(
				'content',
				array(
					'class'                => array( 'split-text', 'js-split-text' ),
					'data-split-text-type' => 'lines',
					'data-split-text-set'  => 'lines',
				)
			);
		}

		if ( $settings['heading_text'] && $settings['content_text'] ) {
			$this->add_render_attribute( 'heading', 'class', 'mb-1' );
		}

		if ( ! $settings['heading_text'] && ! $settings['content_text'] ) {
			$this->add_render_attribute( 'wrapper_button', 'class', 'section-content__button', true );
		}

		if ( $settings['image'] && $settings['image']['id'] ) {
			$this->add_render_attribute( 'content_inner', 'class', 'container-fluid' );
		}

		?>

		<div <?php $this->print_render_attribute_string( 'section' ); ?>>
			<?php if ( $settings['fit_to_screen_enabled'] ) : ?>
				<div class="section-fullheight__inner section-fullheight__inner_mobile">
			<?php endif; ?>
			<div <?php $this->print_render_attribute_string( 'content_inner' ); ?>>
				<?php if ( $settings['heading_enable_headline_before'] || $settings['heading_text'] ) : ?>
					<div class="section-content__wrapper-heading">
						<?php if ( $settings['heading_enable_headline_before'] ) : ?>
							<div class="section__headline mb-1 mb-md-2"></div>
							<div class="w-100"></div>
						<?php endif; ?>
						<?php if ( $settings['heading_text'] ) : ?>
							<div <?php $this->print_render_attribute_string( 'heading' ); ?>><?php echo $settings['heading_text']; ?></div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if ( $settings['heading_enable_headline_after'] || $settings['content_text'] ) : ?>
					<div class="section-content__wrapper-content">
						<?php if ( $settings['heading_enable_headline_after'] ) : ?>
							<div class="w-100"></div>
							<?php
								$this->add_render_attribute( 'headline_after', 'class', array( 'section__headline', 'mt-1', 'mt-md-2' ) );
							if ( $settings['content_text'] ) {
								$this->add_render_attribute( 'headline_after', 'class', array( 'mb-1', 'mb-md-2' ) );
							}
							?>
							<div <?php $this->print_render_attribute_string( 'headline_after' ); ?>></div>
						<?php endif; ?>
						<?php if ( $settings['content_text'] ) : ?>
							<div class="w-100"></div>
							<div <?php $this->print_render_attribute_string( 'content' ); ?>><?php echo $settings['content_text']; ?></div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if ( $settings['button_text'] ) : ?>
					<div <?php $this->print_render_attribute_string( 'wrapper_button' ); ?>>
						<a <?php $this->print_render_attribute_string( 'button' ); ?>>
							<span class="button__label-hover"><?php echo $settings['button_text']; ?></span>
						</a>
					</div>
				<?php endif; ?>
			</div>
			<?php if ( $settings['background_type'] === 'image' && $settings['image']['id'] ) : ?>
				<?php
					arts_the_lazy_image(
						array(
							'id'        => $settings['image']['id'],
							'size'      => $settings['image_size'],
							'class'     => array(
								'section' => array( 'section-image', 'section__bg', 'section-content__bg' ),
								'wrapper' => array( 'section-image__wrapper' ),
								'overlay' => array( 'section-image__overlay' ),
							),
							'parallax'  => array(
								'enabled' => $settings['image_parallax'],
								'factor'  => is_array( $settings['image_parallax_speed'] ) ? $settings['image_parallax_speed']['size'] : 0,
							),
							'animation' => false,
							'mask'      => false,
							'overlay'   => true,
						)
					);
				?>
			<?php endif; ?>
			<?php if ( $settings['background_type'] === 'video' && $settings['video']['id'] ) : ?>
				<?php
					arts_the_lazy_image(
						array(
							'id'        => $settings['video']['id'],
							'type'      => 'background-video',
							'class'     => array(
								'section' => array( 'section-image', 'section__bg', 'section-content__bg' ),
								'wrapper' => array( 'section-image__wrapper' ),
								'overlay' => array( 'section-image__overlay' ),
							),
							'parallax'  => array(
								'enabled' => $settings['image_parallax'],
								'factor'  => is_array( $settings['image_parallax_speed'] ) ? $settings['image_parallax_speed']['size'] : 0,
							),
							'animation' => false,
							'mask'      => false,
							'overlay'   => true,
						)
					);
				?>
			<?php endif; ?>
			<?php if ( $settings['scroll_down_enabled'] ) : ?>
				<div class="section-content__wrapper-scroll-down">
					<?php arts_the_scroll_down_button( array( 'label' => $sd_label ) ); ?>
				</div>
			<?php endif; ?>
			<?php if ( $settings['fit_to_screen_enabled'] ) : ?>
				</div>
			<?php endif; ?>
		</div>

		<?php
	}
}
