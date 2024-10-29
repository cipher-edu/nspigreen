<?php

function arts_ajax_get_posts() {
	global $wp_query, $paged, $cat;

	$query_args = wp_parse_args(
		array(
			'cat'           => sanitize_key( $_POST['category'] ),
			'max_num_pages' => sanitize_key( $_POST['totalPages'] ),
			'post_type'     => 'post',
			'paged'         => sanitize_key( $_POST['page'] ),
			'post_status'   => 'publish',
		)
	);

	$wp_query = new WP_Query( $query_args );
	$cat      = sanitize_key( $_POST['category'] );
	$paged    = sanitize_key( $_POST['page'] );

	get_template_part( 'template-parts/blog/blog', 'grid' );

	wp_die();
}
add_action( 'wp_ajax_get_posts', 'arts_ajax_get_posts' );
add_action( 'wp_ajax_nopriv_get_posts', 'arts_ajax_get_posts' );
