<?php

/**
 * Theme Constants
 */
$theme         = wp_get_theme();
$theme_version = $theme->get( 'Version' );

// Try to get the parent theme object
$theme_parent = $theme->parent();

// Set current theme version as parent not child
if ( $theme_parent ) {
	$theme_version = $theme_parent->Version;
}

define( 'ARTS_THEME_SLUG', 'rhye' );
define( 'ARTS_THEME_PATH', get_template_directory() );
define( 'ARTS_THEME_URL', get_template_directory_uri() );
define( 'ARTS_THEME_PLUGINS_REMOTE_SOURCE', true );
define( 'ARTS_THEME_VERSION', $theme_version );

require_once ARTS_THEME_PATH . '/inc/functions/constants.php';

/**
 * Additional body classes
 */
require_once ARTS_THEME_PATH . '/inc/functions/add_body_classes.php';

/**
* ACF: Registered Fields & Helpers
*/
require_once ARTS_THEME_PATH . '/inc/functions/acf/acf_fields.php';
require_once ARTS_THEME_PATH . '/inc/functions/acf/acf_helpers.php';

/**
 * Blog
 */
require_once ARTS_THEME_PATH . '/inc/functions/blog/add_pingback_url.php';
require_once ARTS_THEME_PATH . '/inc/functions/blog/ajax_get_posts.php';
require_once ARTS_THEME_PATH . '/inc/functions/blog/comments.php';
require_once ARTS_THEME_PATH . '/inc/functions/blog/get_post_author.php';
require_once ARTS_THEME_PATH . '/inc/functions/blog/get_posts_categories.php';
require_once ARTS_THEME_PATH . '/inc/functions/blog/pagination.php';
require_once ARTS_THEME_PATH . '/inc/functions/blog/password_form.php';
require_once ARTS_THEME_PATH . '/inc/functions/blog/wrap_category_acrhive_count.php';

/**
 * Elementor Helpers
 */
require_once ARTS_THEME_PATH . '/inc/functions/elementor/elementor_compatibility.php';
require_once ARTS_THEME_PATH . '/inc/functions/elementor/elementor_custom_icons.php';
require_once ARTS_THEME_PATH . '/inc/functions/elementor/elementor_helpers.php';

/**
 * Adobe Fonts (Typekit) & Self Hosted Fonts Support
 */
require_once ARTS_THEME_PATH . '/inc/functions/fonts/custom_mime_types.php';
require_once ARTS_THEME_PATH . '/inc/functions/fonts/fonts.php';

/**
 * Footer Widgets
 */
require_once ARTS_THEME_PATH . '/inc/functions/footer/footer_has_active_sidebars.php';
require_once ARTS_THEME_PATH . '/inc/functions/footer/get_footer_columns.php';
require_once ARTS_THEME_PATH . '/inc/functions/footer/render_footer_widgets.php';

/**
 * Theme Helpers & Enhancements
 */
require_once ARTS_THEME_PATH . '/inc/functions/helpers/ajax_get_pswp_gallery.php';
require_once ARTS_THEME_PATH . '/inc/functions/helpers/body_open.php';
require_once ARTS_THEME_PATH . '/inc/functions/helpers/get_all_image_sizes.php';
require_once ARTS_THEME_PATH . '/inc/functions/helpers/get_taxonomy_term_names.php';
require_once ARTS_THEME_PATH . '/inc/functions/helpers/get_element_cursor_attributes.php';
require_once ARTS_THEME_PATH . '/inc/functions/helpers/get_woocommerce_urls.php';
require_once ARTS_THEME_PATH . '/inc/functions/helpers/is_async_assets_loading_enabled.php';
require_once ARTS_THEME_PATH . '/inc/functions/helpers/set_page_title.php';

/**
 * Functional Template Parts
 */
require_once ARTS_THEME_PATH . '/inc/functions/templates/the_arrow.php';
require_once ARTS_THEME_PATH . '/inc/functions/templates/the_lazy_image.php';
require_once ARTS_THEME_PATH . '/inc/functions/templates/the_scroll_down_button.php';

/**
 * Frontend Styles & Scripts∂
 */
require_once ARTS_THEME_PATH . '/inc/functions/frontend.php';

/**
 * Get Main Container Attributes/Classes
 */
require_once ARTS_THEME_PATH . '/inc/functions/get_container_attributes.php';

/**
 * Load Required Plugins
 */
require_once ARTS_THEME_PATH . '/inc/functions/load_plugins.php';

/**
 * Nav Menu
 */
require_once ARTS_THEME_PATH . '/inc/functions/nav.php';

/**
 * Theme Support Features
 */
require_once ARTS_THEME_PATH . '/inc/functions/theme_support.php';

/**
 * Widget Areas
 */
require_once ARTS_THEME_PATH . '/inc/functions/widget_areas.php';

/**
 * WP Contact Form 7: Don't Wrap Form Fields Into </p>
 */
require_once ARTS_THEME_PATH . '/inc/functions/wpcf7.php';

/**
 * Customizer Panels
 */
require_once ARTS_THEME_PATH . '/inc/customizer/customizer.php';

/**
 * Merlin WP theme wizard setup
 * Load only if One Click Demo Import plugin
 * is not activated
 */
if ( ! class_exists( 'OCDI_Plugin' ) ) {
	require_once ARTS_THEME_PATH . '/inc/merlin/vendor/autoload.php';
	require_once ARTS_THEME_PATH . '/inc/merlin/class-merlin.php';
	require_once ARTS_THEME_PATH . '/inc/merlin/merlin-config.php';
}
require_once ARTS_THEME_PATH . '/inc/merlin/merlin-filters.php';
