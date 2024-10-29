<?php
/**
 * Plugin Name: Rhye Core
 * Description: Core Plugin for Rhye WordPress Theme
 * Plugin URI: https://artemsemkin.com/
 * Version: 3.6.4
 * Requires at least: 6.4
 * Requires PHP: 7.0
 * Author: Artem Semkin
 * Update URI: artemsemkin.com
 * Tested up to: 6
 * Text Domain: rhye
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'ARTS_RHYE_CORE_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'ARTS_RHYE_CORE_PLUGIN_VERSION', get_file_data( __FILE__, array( 'ver' => 'Version' ), false )['ver'] );

/**
 * Theme Constants
 */
require_once __DIR__ . '/inc/constants.php';

/**
 * ACF Helper Functions
 */
require_once __DIR__ . '/inc/acf_helpers.php';

/**
 * Ability to upload custom fonts
 * to the media library
 */
require_once __DIR__ . '/inc/add_custom_mime_types.php';

/**
 * Register Custom Elementor Widgets
 */
require_once __DIR__ . '/elementor/rhye_elementor_extension.php';

/**
 * Extra Panels: Document Settings
 */
require_once __DIR__ . '/elementor/document/page_header.php';
require_once __DIR__ . '/elementor/document/page_masthead.php';
require_once __DIR__ . '/elementor/document/page_bottom_navigation.php';
require_once __DIR__ . '/elementor/document/page_footer.php';
require_once __DIR__ . '/elementor/document/page_ajax.php';
/**
 * Extra Panels: Elementor Section
 */
require_once __DIR__ . '/elementor/extensions/section_settings.php';

/**
 * Extra Panels: Elementor Column
 */
require_once __DIR__ . '/elementor/extensions/column_settings.php';

/**
 * Register Custom Post Types
 */
require_once __DIR__ . '/inc/cpt.php';

/**
 * Elementor Helper Functions
 */
require_once __DIR__ . '/inc/helper_functions.php';

/**
 * Plugin Frontend
 */
require_once __DIR__ . '/inc/frontend.php';

/**
 * Theme Options Panel
 */
require_once __DIR__ . '/inc/options.php';

/**
 * Shortcodes
 */
require_once __DIR__ . '/inc/shortcodes.php';

/**
 * Taxonomies
 */
require_once __DIR__ . '/inc/taxonomies.php';

/**
 * WordPress Custom Widgets
 */
require_once __DIR__ . '/inc/widgets.php';

/**
 * Plugin Updates API
 */
if ( ! class_exists( 'Rhye_Core_Plugin_Update' ) ) {
	require_once __DIR__ . '/inc/update.php';
}
$config_core_plugin_update = array(
	'theme_id'  => 'rhye',
	'plugin_id' => plugin_basename( __FILE__ ),
	'endpoint'  => esc_url( 'https://artemsemkin.com/wp-json/edd/v1/update/rhye/core-plugin' ),
	'icons'     => array(
		'svg' => esc_url( trailingslashit( ARTS_RHYE_CORE_PLUGIN_URL ) . 'assets/icon.svg' ),
		'1x'  => esc_url( trailingslashit( ARTS_RHYE_CORE_PLUGIN_URL ) . 'assets/icon-128x128.jpg' ),
		'2x'  => esc_url( trailingslashit( ARTS_RHYE_CORE_PLUGIN_URL ) . 'assets/icon-256x256.jpg' ),
	),
	'banners'   => array(
		'low'  => esc_url( trailingslashit( ARTS_RHYE_CORE_PLUGIN_URL ) . 'assets/banner-772x250.jpg' ),
		'high' => esc_url( trailingslashit( ARTS_RHYE_CORE_PLUGIN_URL ) . 'assets/banner-1544x500.jpg' ),
	),
);
new Rhye_Core_Plugin_Update( $config_core_plugin_update );

/**
 * Bundled Plugins Updates API
 */
if ( ! class_exists( 'Arts_Bundled_Plugins_Update' ) ) {
	require_once __DIR__ . '/inc/update_bundled_plugin.php';
}
$config_acf_pro_update = array(
	'theme_id'  => 'rhye',
	'plugin_id' => 'advanced-custom-fields-pro/acf.php',
	'endpoint'  => esc_url( 'https://artemsemkin.com/wp-json/edd/v1/update/acf-pro/plugin' ),
);
new Arts_Bundled_Plugins_Update( $config_acf_pro_update );

add_action( 'init', 'arts_load_textdomain' );
function arts_load_textdomain() {
	load_plugin_textdomain( 'rhye' );
}
