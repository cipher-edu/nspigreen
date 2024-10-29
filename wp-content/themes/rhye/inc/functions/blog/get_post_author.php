<?php

/**
 * Retrive current post author.
 * Can be used outside of WordPress loop
 */
function arts_get_post_author() {
	global $post;

	$author_id   = $post->post_author;
	$author_url  = get_author_posts_url( $author_id );
	$author_name = get_the_author_meta( 'display_name', $author_id );
	$result;

	if ( ! empty( $author_url ) ) {
		$result['url'] = $author_url;
	}

	if ( ! empty( $author_name ) ) {
		$result['name'] = $author_name;
	}

	return $result;
}
