<?php

/**
 * Get main wrapper attributes/classes
 *
 * @return array
 */
function arts_get_container_attributes() {
	$ajax_enabled    = get_theme_mod( 'ajax_enabled', false );
	$attrs_container = array(
		'class'      => 'js-smooth-scroll',
		'attributes' => '',
		'theme'      => 'dark',
	);

	if ( $ajax_enabled ) {
		$attrs_container['attributes'] .= ' data-barba=container';
	}

	if ( is_home() || is_category() || is_archive() || is_search() ) {
		$attrs_container['class'] .= ' ' . get_theme_mod( 'blog_style_theme', 'bg-light-1' );
		$attrs_container['theme']  = get_theme_mod( 'blog_style_main_theme', 'dark' );

		if ( $ajax_enabled ) {
			$attrs_container['attributes'] .= ' data-barba-namespace=archive';
		}
	}

	if ( is_singular( 'post' ) ) {
		$attrs_container['class'] .= ' ' . get_theme_mod( 'blog_style_single_post_theme', 'bg-light-1' );
		$attrs_container['theme']  = get_theme_mod( 'blog_style_single_post_main_theme', 'dark' );

		if ( $ajax_enabled ) {
			$attrs_container['attributes'] .= ' data-barba-namespace=post';
		}
	}

	if ( arts_is_built_with_elementor() && $ajax_enabled ) {
		$attrs_container['attributes'] .= ' data-barba-namespace=elementor';
	}

	return $attrs_container;
}
