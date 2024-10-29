<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'init', 'arts_register_taxonomies' );
function arts_register_taxonomies() {
	/**
	 * Category
	 */
	register_taxonomy(
		'arts_portfolio_category',
		array( 'arts_portfolio_item' ),
		array(
			'labels'            => array(
				'name'                       => _x( 'Portfolio Categories', 'taxonomy general name', 'rhye' ),
				'singular_name'              => _x( 'Portfolio Category', 'taxonomy singular name', 'rhye' ),
				'search_items'               => __( 'Search Portfolio Categories', 'rhye' ),
				'all_items'                  => __( 'All Portfolio Categories', 'rhye' ),
				'parent_item'                => __( 'Parent Portfolio Category', 'rhye' ),
				'parent_item_colon'          => __( 'Parent Portfolio Category:', 'rhye' ),
				'edit_item'                  => __( 'Edit Portfolio Category', 'rhye' ),
				'update_item'                => __( 'Update Portfolio Category', 'rhye' ),
				'add_new_item'               => __( 'Add New Portfolio Category', 'rhye' ),
				'new_item_name'              => __( 'New Portfolio Category', 'rhye' ),
				'separate_items_with_commas' => __( 'Separate portfolio categories with commas', 'rhye' ),
				'add_or_remove_items'        => __( 'Add or remove writers', 'rhye' ),
				'choose_from_most_used'      => __( 'Choose from the most used portfolio categories', 'rhye' ),
				'not_found'                  => __( 'No portfolio categories found.', 'rhye' ),
				'menu_name'                  => __( 'Portfolio Categories', 'rhye' ),
			),
			'public'            => true,
			'hierarchical'      => false,
			'show_admin_column' => true,
			'query_var'         => true,
		)
	);
}
