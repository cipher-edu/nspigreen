<?php

/**
 * Add additional classes to <body>
 */
add_filter( 'body_class', 'arts_add_body_classes' );
function arts_add_body_classes( $classes ) {

	$page_ajax_to_enabled   = arts_get_document_option( 'page_ajax_to_enabled' );
	$page_ajax_from_enabled = arts_get_document_option( 'page_ajax_from_enabled' );
	$body_classes           = array();

	// Disable AJAX transitions TO this page
	if ( ! $page_ajax_to_enabled ) {
		$body_classes[] = 'page-no-ajax';
	}

	// Disable AJAX transitions FROM this page
	if ( ! $page_ajax_from_enabled ) {
		$body_classes[] = 'no-ajax';
	}

	$classes = array_merge( $classes, $body_classes );

	return $classes;

}
