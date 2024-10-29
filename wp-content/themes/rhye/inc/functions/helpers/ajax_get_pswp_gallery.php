<?php

function arts_ajax_get_pswp_gallery() {
	get_template_part( 'template-parts/photoswipe/pswp-container' );
	wp_die();
}
add_action( 'wp_ajax_get_pswp_gallery', 'arts_ajax_get_pswp_gallery' );
add_action( 'wp_ajax_nopriv_get_pswp_gallery', 'arts_ajax_get_pswp_gallery' );
