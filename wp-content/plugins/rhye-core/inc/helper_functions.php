<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Get the option for the current page/post
 *
 * @param string $option
 * @param int    $post_id
 * @return string
 */
if ( ! function_exists( 'arts_elementor_get_document_option' ) ) {
	function arts_elementor_get_document_option( $option, $post_id = null ) {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		if ( class_exists( '\Elementor\Core\Settings\Manager' ) && ! empty( $option ) ) {

			// Get the page settings manager
			$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

			// Get the settings model for current post
			$page_settings_model = $page_settings_manager->get_model( $post_id );

			// Retrieve the settings we added before
			return $page_settings_model->get_settings( $option );

		}

		return false;
	}
}

/**
 * Check the theme compatibility with async assets loading
 * mode and if it's actually enabled
 *
 * @return bool
 */

if ( ! function_exists( 'arts_is_async_assets_loading_enabled' ) ) {
	function arts_is_async_assets_loading_enabled() {
		return true;
		// Deprecated since 2.4.0
		// return defined( 'ARTS_RHYE_CORE_PLUGIN_VERSION' ) && version_compare( ARTS_RHYE_CORE_PLUGIN_VERSION, '2.0.0', '>=' ) && get_theme_mod( 'assets_loading_mode', 'async' ) === 'async';
	}
}

/**
 * Check if 'selectors' parameter in widget controls
 * should have 'tablet_', 'mobile_' prefixes when
 * printing CSS data to the frontend
 *
 * @return bool
 */
if ( ! function_exists( 'arts_elementor_should_selectors_have_responsive_prefixes' ) ) {
	function arts_elementor_should_selectors_have_responsive_prefixes() {
		return defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, '3.7.6' ) <= 0;
	}
}
