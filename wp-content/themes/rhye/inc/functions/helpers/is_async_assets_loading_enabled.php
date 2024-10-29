<?php

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
