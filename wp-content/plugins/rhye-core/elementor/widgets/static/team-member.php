<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Team_Member extends Rhye_Widget_Base {
	protected static $_instance = null;

	public function get_name() {
		return 'rhye-widget-team-member';
	}

	public function get_title() {
		return esc_html__( 'Team Member', 'rhye' );
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
					'field'       => 'name',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'Name', 'rhye' ) ),
					'editor_type' => 'LINE',
				),
				array(
					'field'       => 'position',
					'type'        => sprintf( '<strong>%1$s</strong><br>%2$s', $title, esc_html__( 'Position', 'rhye' ) ),
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
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'name',
			array(
				'label'       => esc_html__( 'Name', 'rhye' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Edit name...', 'rhye' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'position',
			array(
				'label'       => esc_html__( 'Position', 'rhye' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Edit position...', 'rhye' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'headline_enabled',
			array(
				'label'   => esc_html__( 'Enable Headline', 'rhye' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'social_heading',
			array(
				'label'     => esc_html__( 'Social Media', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_link',
			array(
				'label'         => esc_html__( 'Link', 'rhye' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://...', 'rhye' ),
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
			'avatar_section',
			array(
				'label' => esc_html__( 'Avatar', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'avatar',
			array(
				'label'   => esc_html__( 'Choose Image', 'rhye' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'label'   => esc_html__( 'Thumbnail Size', 'rhye' ),
				'name'    => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'full',
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
			'typography_name',
			array(
				'label' => esc_html__( 'Name', 'rhye' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'name_preset',
			array(
				'label'   => esc_html__( 'Typography Preset', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h4',
				'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
			)
		);

		$this->add_control(
			'name_tag',
			array(
				'label'   => esc_html__( 'HTML Tag', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'div',
				'options' => ARTS_THEME_HTML_TAGS_ARRAY,
			)
		);

		$this->add_control(
			'typography_position',
			array(
				'label'     => esc_html__( 'Position', 'rhye' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'position_preset',
			array(
				'label'   => esc_html__( 'Typography Preset', 'rhye' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'subheading',
				'options' => ARTS_THEME_TYPOGRAHY_ARRAY,
			)
		);

		$this->add_control(
			'position_tag',
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

		$this->add_inline_editing_attributes( 'name' );
		$this->add_inline_editing_attributes( 'position' );

		$this->add_render_attribute(
			'section',
			array(
				'class' => array( 'figure-member', 'text-center' ),
			)
		);

		$this->add_render_attribute(
			'name',
			array(
				'class' => array( 'figure-member__name', $settings['name_preset'] ),
			)
		);

		$this->add_render_attribute(
			'position',
			array(
				'class' => array( 'figure-member__position', 'mt-1', $settings['position_preset'] ),
			)
		);

		$this->add_render_attribute( 'footer', 'class', 'figure-member__footer' );

		if ( $settings['headline_enabled'] ) {
			$this->add_render_attribute( 'footer', 'class', 'mt-0-5' );
		} else {
			$this->add_render_attribute( 'footer', 'class', 'mt-1' );
		}

		if ( $settings['social'] ) {
			$this->add_render_attribute( 'section', 'class', 'figure-member_has-social' );
		}

		?>

		<div <?php $this->print_render_attribute_string( 'section' ); ?>>
			<?php if ( ! empty( $settings['avatar']['url'] ) ) : ?>
				<!-- avatar -->
				<div class="figure-member__avatar">
					<?php
						arts_the_lazy_image(
							array(
								'id'        => $settings['avatar']['id'],
								'size'      => $settings['image_size'],
								'type'      => 'image',
								'class'     => array(
									'section' => array( 'section', 'section-image' ),
									'wrapper' => array( 'section-image__wrapper' ),
									'image'   => array(),
								),
								'animation' => $settings['animation_enabled'] ? true : false,
								'mask'      => $settings['animation_enabled'] && $settings['animation_type'] === 'mask_reveal',
							)
						);
					?>
				</div>
				<!-- - avatar -->
			<?php endif; ?>
			<?php if ( $settings['headline_enabled'] ) : ?>
				<div class="figure-member__headline mt-1"></div>
			<?php endif; ?>
			<?php if ( ! empty( $settings['name'] ) || ! empty( $settings['position'] ) ) : ?>
				<!-- content -->
				<div <?php $this->print_render_attribute_string( 'footer' ); ?>>
					<?php if ( ! empty( $settings['name'] ) ) : ?>
						<<?php $this->print_html_tag( 'name_tag' ); ?> <?php $this->print_render_attribute_string( 'name' ); ?>><?php echo $settings['name']; ?></<?php $this->print_html_tag( 'name_tag' ); ?>>
					<?php endif; ?>
					<?php if ( ! empty( $settings['position'] ) ) : ?>
						<<?php $this->print_html_tag( 'position_tag' ); ?> <?php $this->print_render_attribute_string( 'position' ); ?>><?php echo $settings['position']; ?></<?php $this->print_html_tag( 'position_tag' ); ?>>
					<?php endif; ?>
					<?php if ( $settings['social'] ) : ?>
						<div class="figure-member__social">
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
				<!-- - content -->
			<?php endif; ?>
		</div>

		<?php
	}
}
