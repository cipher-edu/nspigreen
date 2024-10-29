<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Widget_Google_Map extends Rhye_Widget_Base {
	protected static $_instance = null;

	public function get_name() {
		return 'rhye-widget-google-map';
	}

	public function get_title() {
		return esc_html__( 'Google Map', 'rhye' );
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
			'integration-class' => 'WPML_Elementor_Rhye_Widget_Google_Map',
		);

		return $widgets;

	}

	public function add_wpml_support() {
		add_filter( 'wpml_elementor_widgets_to_translate', array( $this, 'wpml_widgets_to_translate_filter' ) );
	}

	private function check_api_key() {
		$gmap = get_option( 'arts_gmap' );
		return isset( $gmap['key'] ) && ! empty( $gmap['key'] );
	}

	protected function register_controls() {

		/**
		 * Section Markers
		 */
		$this->start_controls_section(
			'markers_section',
			array(
				'label' => esc_html__( 'Markers', 'rhye' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'is_key',
			array(
				'type'    => Controls_Manager::HIDDEN,
				'default' => $this->check_api_key(),
			)
		);

		$this->add_control(
			'message_api',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(
					'%1$s <a href="https://developers.google.com/maps/documentation/javascript/tutorial#api-key-billing-errors" target="_blank">%2$s</a><br><br>%3$s <a href="%4$s" target="_blank">%5$s</a> %6$s',
					esc_html__( 'To make this widget work properly you need to obtain', 'rhye' ),
					esc_html__( 'an API key from Google', 'rhye' ),
					esc_html__( 'If you already have a valid and set up API key please enter it in', 'rhye' ),
					admin_url( 'options-general.php?page=arts-setting-gmap' ),
					esc_html__( 'WordPress admin panel.', 'rhye' ),
					esc_html__( 'and return back here.', 'rhye' )
				),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'condition'       => array(
					'is_key' => false,
				),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'marker_content',
			array(
				'label'       => esc_html__( 'Content Box', 'rhye' ),
				'description' => esc_html__( 'That content will appear in a small window on marker click. You can place a helpful information here (e.g. company address).', 'rhye' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => '',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'marker_lat',
			array(
				'label'   => esc_html__( 'Latitude', 'rhye' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '40.6700',
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'marker_lon',
			array(
				'label'   => esc_html__( 'Longitude', 'rhye' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '-73.9400',
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'marker_icon',
			array(
				'label'       => esc_html__( 'Icon', 'rhye' ),
				'description' => esc_html__( 'Upload a PNG image of a nice map pin.', 'rhye' ),
				'type'        => Controls_Manager::MEDIA,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'marker_icon_size',
			array(
				'label'     => esc_html__( 'Image Size', 'rhye' ),
				'type'      => Controls_Manager::IMAGE_DIMENSIONS,
				'default'   => array(
					'width'  => '',
					'height' => '',
				),
				'condition' => array(
					'marker_icon!' => array(
						'id'  => '',
						'url' => '',
					),
				),
			)
		);

		$this->add_control(
			'markers',
			array(
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'title_field'   => '{{{ marker_content }}}',
				'prevent_empty' => true,
				'condition'     => array(
					'is_key' => true,
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Section Style
		 */
		$this->start_controls_section(
			'style_section',
			array(
				'label' => esc_html__( 'Style', 'rhye' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'map_zoom',
			array(
				'label'       => esc_html__( 'Zoom Level', 'rhye' ),
				'description' => esc_html__( 'Applicable if there is only one marker on the map', 'rhye' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => array(
					'px' => array(
						'min' => 1,
						'max' => 20,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 14,
				),
				'condition'   => array(
					'is_key' => true,
				),
			)
		);

		$this->add_responsive_control(
			'map_height',
			array(
				'label'           => esc_html__( 'Map Height', 'rhye' ),
				'type'            => Controls_Manager::SLIDER,
				'range'           => array(
					'px' => array(
						'min' => 0,
						'max' => 1440,
					),
					'vh' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'desktop_default' => array(
					'size' => 900,
				),
				'tablet_default'  => array(
					'size' => 70,
					'unit' => 'vh',
				),
				'mobile_default'  => array(
					'size' => 50,
					'unit' => 'vh',
				),
				'size_units'      => array( 'px', 'vh' ),
				'selectors'       => array(
					'{{WRAPPER}} .gmap__container' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'snazzy_styles',
			array(
				'label'       => esc_html__( 'Snazzy Maps Styles', 'rhye' ),
				'type'        => Controls_Manager::TEXTAREA,
				'description' => sprintf(
					'%1$s <a href="https://snazzymaps.com/explore" target="_blank">%2$s</a> %3$s',
					esc_html__( 'You can preview and generate custom map styles on', 'rhye' ),
					esc_html__( 'Snazzy Maps.', 'rhye' ),
					esc_html__( 'Just copy-paste JavaScript style array in this field.', 'rhye' )
				),
				'default'     => '[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#181818"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#181818"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#181818"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#181818"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#181818"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#181818"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#181818"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#181818"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#181818"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#181818"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#181818"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#181818"},{"lightness":17}]}]',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'gmap',
			array(
				'class'                   => array( 'gmap', 'js-gmap' ),
				'data-gmap-zoom'          => is_array( $settings['map_zoom'] ) ? $settings['map_zoom']['size'] : 14,
				'data-gmap-snazzy-styles' => preg_replace( '^\n|\r|\s+|\s+^', '', $settings['snazzy_styles'] ),
			)
		);

		?>

		<div <?php $this->print_render_attribute_string( 'gmap' ); ?>>
			<div class="gmap__container"></div>
			<?php if ( $settings['markers'] ) : ?>
				<?php foreach ( $settings['markers'] as $index => $item ) : ?>
					<?php
						$rowKey = $this->get_repeater_setting_key( 'marker', 'markers', $index );
						$this->add_render_attribute(
							$rowKey,
							array(
								'class'               => 'gmap__marker d-none',
								'data-marker-lat'     => $item['marker_lat'],
								'data-marker-lon'     => $item['marker_lon'],
								'data-marker-content' => $item['marker_content'],
								'data-marker-img'     => $item['marker_icon']['url'],
								'data-marker-width'   => $item['marker_icon_size']['width'],
								'data-marker-height'  => $item['marker_icon_size']['height'],
							)
						);
					?>
					<div <?php $this->print_render_attribute_string( $rowKey ); ?>></div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<?php
	}
}
