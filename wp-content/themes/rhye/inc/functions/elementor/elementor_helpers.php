<?php

/**
 * Get current post option
 * from Elementor document settings
 */
if ( ! function_exists( 'arts_get_document_option' ) ) {

	function arts_get_document_option( $option, $post_id = null ) {
		if ( did_action( 'elementor/loaded' ) && function_exists( 'arts_elementor_get_document_option' ) ) {
			return arts_elementor_get_document_option( $option, $post_id );
		}
	}
}

/**
 * Get the option for the current page/post
 *
 * @param string $option
 * @param int    $post_id
 * @return string
 */
if ( ! function_exists( 'arts_elementor_get_document_option' ) ) {
	function arts_elementor_get_document_option( $option, $post_id = null, $option_default = false ) {
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

		return $option_default;
	}
}

/**
 * Get overridable post option
 * from Elementor document settings
 */
if ( ! function_exists( 'arts_get_overridden_document_option' ) ) {

	function arts_get_overridden_document_option( $option, $option_condition, $option_default = '', $post_id = null ) {
		if ( did_action( 'elementor/loaded' ) && function_exists( 'arts_elementor_get_document_option' ) && function_exists( 'arts_is_built_with_elementor' ) && arts_is_built_with_elementor( $post_id ) && $option && $option_condition ) {
			$condition = arts_elementor_get_document_option( $option_condition, $post_id );
			if ( $condition ) {
				return arts_elementor_get_document_option( 'page_' . $option, $post_id );
			}
		}

		return get_theme_mod( $option, $option_default );
	}
}

/**
 * Check if the current post/page
 * is built using Elementor
 *
 * @param string $post_id
 * @return bool
 */
function arts_is_built_with_elementor( $post_id = null ) {
	if ( ! class_exists( '\Elementor\Plugin' ) ) {
		return false;
	}

	if ( $post_id == null ) {
		$post_id = get_the_ID();
	}

	if ( is_singular() && \Elementor\Plugin::$instance->db->is_built_with_elementor( $post_id ) ) {
		return true;
	}

	return false;
}

/**
 * Check if Elementor editor
 * is active
 *
 * @return bool
 */
function arts_is_elementor_editor_active() {
	if ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
		return true;
	}
	return false;
}

/**
 * Check if Elementor's experimental feature
 * is supported and active
 *
 * @return bool
 */
function arts_is_elementor_feature_active( $feature_name ) {
	return class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::instance()->experiments ) && \Elementor\Plugin::instance()->experiments->is_feature_active( $feature_name );
}
