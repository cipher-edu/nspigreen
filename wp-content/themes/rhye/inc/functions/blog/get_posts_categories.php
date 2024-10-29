<?php

/**
 * Collect all the posts categories
 *
 * @param string $mode
 * @return array $current_categories
 */
function arts_get_posts_categories( $mode = 'all' ) {
	$current_categories = array();

	if ( have_posts() ) {
		// collect categories based on the posts
		// displayed on the current page
		if ( $mode === 'current_page' ) {
			while ( have_posts() ) {
				the_post();
				$categories = get_the_category();
				if ( ! empty( $categories ) ) {
					foreach ( $categories as $category ) {
						array_push(
							$current_categories, array(
								'id'   => $category->term_id,
								'name' => $category->name,
								'slug' => $category->slug,
							)
						);
					}
				}
			}

			// remove duplicate categories
			$current_categories = array_unique( $current_categories, SORT_REGULAR );
		} else {
			// collect all posts categories
			$posts_terms = get_terms(
				array(
					'taxonomy' => 'category',
				)
			);

			if ( ! empty( $posts_terms ) ) {
				foreach ( $posts_terms as $item ) {
					array_push(
						$current_categories, array(
							'id'   => $item->term_id,
							'slug' => $item->slug,
							'name' => $item->name,
						)
					);
				}
			}
		}
	}

	return $current_categories;
}
