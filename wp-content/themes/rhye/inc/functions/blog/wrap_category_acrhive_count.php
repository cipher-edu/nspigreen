<?php

/**
 * Filter the categories archive widget to add a span around post count
 */
add_filter( 'wp_list_categories', 'arts_cat_count_span' );
function arts_cat_count_span( $links ) {
	$links = str_replace( '</a> (', '</a><span>', $links );
	$links = str_replace( ')', '</span>', $links );
	return $links;
}

/**
 * Filter the archives widget to add a span around post count
 */
add_filter( 'get_archives_link', 'arts_archive_count_span' );
function arts_archive_count_span( $links ) {
	$links = str_replace( '</a>&nbsp;(', '</a><span>', $links );
	$links = str_replace( ')', '</span>', $links );
	return $links;
}
