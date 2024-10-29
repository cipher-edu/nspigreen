<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'wp_enqueue_scripts', 'arts_localize_assets', 60 );
function arts_localize_assets() {
	$gmap_key = get_option( 'arts_gmap' );

	if ( ! empty( get_option( 'arts_gmap' ) ) ) {
		$gmap_key = $gmap_key['key'];
	}

	wp_enqueue_script( 'rhye-base-components', ARTS_RHYE_CORE_PLUGIN_URL . '/modules/base/base.min.js', array( 'jquery', 'gsap' ), ARTS_RHYE_CORE_PLUGIN_VERSION, true );
	wp_enqueue_script( 'rhye-elementor-init', ARTS_RHYE_CORE_PLUGIN_URL . '/modules/elementorInit/elementorInit.min.js', array( 'rhye-base-components' ), ARTS_RHYE_CORE_PLUGIN_VERSION, true );

	wp_localize_script(
		'rhye-components',
		'plugin',
		array(
			'assets' => array(
				'aside-counters-js'              => array(
					'id'      => 'aside-counters-js',
					'type'    => 'script',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/asideCounters/asideCounters.min.js',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'aside-counters-css'             => array(
					'id'      => 'aside-counters-css',
					'type'    => 'style',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/asideCounters/asideCounters.min.css',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'base-gl-animation-js'           => array(
					'id'      => 'base-gl-animation-js',
					'type'    => 'script',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/baseGLAnimation/baseGLAnimation.min.js',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'effect-distortion-offscreen-js' => array(
					'id'      => 'effect-distortion-offscreen-js',
					'type'    => 'script',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/baseGLAnimationOffscreen/EffectDistortionOffscreen.js',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'effect-stretch-offscreen-js'    => array(
					'id'      => 'effect-stretch-offscreen-js',
					'type'    => 'script',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/baseGLAnimationOffscreen/EffectStretchOffscreen.js',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'circle-button-js'               => array(
					'id'      => 'circle-button-js',
					'type'    => 'script',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/circleButton/circleButton.min.js',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'circle-button-css'              => array(
					'id'      => 'circle-button-css',
					'type'    => 'style',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/circleButton/circleButton.min.css',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'googlemap-js'                   => array(
					'id'      => 'googlemap-js',
					'type'    => 'script',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/googleMap/googleMap.min.js',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'googlemap-map-js'               => array(
					'id'    => 'googlemap-map-js',
					'type'  => 'script',
					'src'   => '//maps.googleapis.com/maps/api/js?callback=Function.prototype&key=' . $gmap_key,
					'cache' => true,
				),
				'googlemap-css'                  => array(
					'id'      => 'googlemap-css',
					'type'    => 'style',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/googleMap/googleMap.min.css',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'pswp-js'                        => array(
					'id'      => 'pswp-js',
					'type'    => 'script',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/pswp/pswp.min.js',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'pswp-css'                       => array(
					'id'      => 'pswp-css',
					'type'    => 'style',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/pswp/pswp.min.css',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'section-content-js'             => array(
					'id'      => 'section-content-js',
					'type'    => 'script',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/sectionContent/sectionContent.min.js',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'section-content-css'            => array(
					'id'      => 'section-content-css',
					'type'    => 'style',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/sectionContent/sectionContent.min.css',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'section-grid-js'                => array(
					'id'      => 'section-grid-js',
					'type'    => 'script',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/sectionGrid/sectionGrid.min.js',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'section-grid-css'               => array(
					'id'      => 'section-grid-css',
					'type'    => 'style',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/sectionGrid/sectionGrid.min.css',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'section-image-js'               => array(
					'id'      => 'section-image-js',
					'type'    => 'script',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/sectionImage/sectionImage.min.js',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'section-image-css'              => array(
					'id'      => 'section-image-css',
					'type'    => 'style',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/sectionImage/sectionImage.min.css',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'section-list-js'                => array(
					'id'      => 'section-list-js',
					'type'    => 'script',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/sectionList/sectionList.min.js',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'section-list-css'               => array(
					'id'      => 'section-list-css',
					'type'    => 'style',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/sectionList/sectionList.min.css',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'section-projects-slider-js'     => array(
					'id'      => 'section-projects-slider-js',
					'type'    => 'script',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/sectionProjectsSlider/sectionProjectsSlider.min.js',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'section-projects-slider-css'    => array(
					'id'      => 'section-projects-slider-css',
					'type'    => 'style',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/sectionProjectsSlider/sectionProjectsSlider.min.css',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'section-scroll-js'              => array(
					'id'      => 'section-scroll-js',
					'type'    => 'script',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/sectionScroll/sectionScroll.min.js',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'section-slider-images-js'       => array(
					'id'      => 'section-slider-images-js',
					'type'    => 'script',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/sectionSliderImages/sectionSliderImages.min.js',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'section-slider-testimonials-js' => array(
					'id'      => 'section-slider-testimonials-js',
					'type'    => 'script',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/sectionSliderTestimonials/sectionSliderTestimonials.min.js',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'section-video-css'              => array(
					'id'      => 'section-video-css',
					'type'    => 'style',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/sectionVideo/sectionVideo.min.css',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'slider-js'                      => array(
					'id'      => 'slider-js',
					'type'    => 'script',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/slider/slider.min.js',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
				'slider-css'                     => array(
					'id'      => 'slider-css',
					'type'    => 'style',
					'src'     => ARTS_RHYE_CORE_PLUGIN_URL . '/modules/slider/slider.min.css',
					'cache'   => true,
					'version' => ARTS_RHYE_CORE_PLUGIN_VERSION,
				),
			),
		)
	);

}
