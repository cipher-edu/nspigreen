<?php

/**
 * Set default title depending on the page
 *
 * @return array
 */
function arts_set_page_title() {
	global $post;
	$page_title    = '';
	$page_subtitle = '';
	$page_text     = '';
	$titles        = [];

	if ( arts_is_built_with_elementor() ) {

		$page_title       = get_the_title();
		$page_text        = arts_get_field( 'text' );
		$categories       = arts_get_taxonomy_term_names( $post->ID, 'arts_portfolio_category' );
		$categories_names = [];

		if ( ! empty( $categories ) ) {
			foreach ( $categories as $item ) {
				array_push( $categories_names, $item['name'] );
			}
			$page_subtitle = implode( '&nbsp;&nbsp;/&nbsp;&nbsp;', $categories_names );
		} else {
			$page_subtitle = arts_get_field( 'subheading' );
		}
	} elseif ( is_category() ) {

		$page_title    = get_category( get_query_var( 'cat' ) )->name;
		$page_subtitle = esc_html__( 'Posts in category', 'rhye' );

	} elseif ( is_author() ) {

		$page_title    = get_userdata( get_query_var( 'author' ) )->display_name;
		$page_subtitle = esc_html__( 'Posts by author', 'rhye' );

	} elseif ( is_tag() ) {

		$page_title    = single_tag_title( '', false );
		$page_subtitle = esc_html__( 'Posts with tag', 'rhye' );

	} elseif ( is_day() ) {

		$page_title    = get_the_date();
		$page_subtitle = esc_html__( 'Day archive', 'rhye' );

	} elseif ( is_month() ) {

		$page_title    = get_the_date( 'F Y' );
		$page_subtitle = esc_html__( 'Month archive', 'rhye' );

	} elseif ( is_year() ) {

		$page_title    = get_the_date( 'Y' );
		$page_subtitle = esc_html__( 'Year archive', 'rhye' );

	} elseif ( is_home() ) {

		$page_title = wp_title( '', false );

	} elseif ( is_search() ) {

		$default_title = esc_html__( 'Search', 'rhye' );
		$page_title    = get_theme_mod( 'search_title', $default_title );

	} else {

		$page_title    = get_the_title();
		$page_subtitle = '';

	}

	if ( ! $page_title ) {
		$page_title = esc_html__( 'Blog', 'rhye' );
	}

	$titles[0] = $page_title;
	$titles[1] = $page_subtitle;
	$titles[2] = $page_text;

	return $titles;

}
