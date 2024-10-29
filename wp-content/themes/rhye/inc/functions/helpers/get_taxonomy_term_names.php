<?php

/**
 * Get the term names of taxonomy
 *
 * @param string $post_id
 * @param string $taxonomy
 * @return void
 */
function arts_get_taxonomy_term_names( $post_id, $taxonomy ) {
	$items = get_the_terms( $post_id, $taxonomy );
	$arr   = [];

	if ( is_array( $items ) ) {
		foreach ( $items as $item ) {

			$temp = array(
				'slug' => $item->slug,
				'name' => $item->name,
			);

			// don't add the same item multiple times
			if ( ! in_array( $arr, $temp ) ) {
				array_push( $arr, $temp );
			}
		}
	}

	return $arr;
}
