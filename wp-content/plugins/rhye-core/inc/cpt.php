<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'init', 'arts_register_post_types' );
function arts_register_post_types() {

	$priority = 5;

	/**
	 * Portfolio Item
	 */
	$labels  = array(
		'name'                  => _x( 'Portfolio Items', 'Post Type General Name', 'rhye' ),
		'singular_name'         => _x( 'Portfolio Item', 'Post Type Singular Name', 'rhye' ),
		'menu_name'             => _x( 'Portfolio Items', 'Admin Menu text', 'rhye' ),
		'name_admin_bar'        => _x( 'Portfolio Item', 'Add New on Toolbar', 'rhye' ),
		'archives'              => esc_html__( 'Portfolio Item Archives', 'rhye' ),
		'attributes'            => esc_html__( 'Portfolio Item Attributes', 'rhye' ),
		'parent_item_colon'     => esc_html__( 'Parent Portfolio Item:', 'rhye' ),
		'all_items'             => esc_html__( 'All Portfolio Items', 'rhye' ),
		'add_new_item'          => esc_html__( 'Add New Portfolio Item', 'rhye' ),
		'add_new'               => esc_html__( 'Add New', 'rhye' ),
		'new_item'              => esc_html__( 'New Portfolio Item', 'rhye' ),
		'edit_item'             => esc_html__( 'Edit Portfolio Item', 'rhye' ),
		'update_item'           => esc_html__( 'Update Portfolio Item', 'rhye' ),
		'view_item'             => esc_html__( 'View Portfolio Item', 'rhye' ),
		'view_items'            => esc_html__( 'View Portfolio Items', 'rhye' ),
		'search_items'          => esc_html__( 'Search Portfolio Item', 'rhye' ),
		'not_found'             => esc_html__( 'Not found', 'rhye' ),
		'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'rhye' ),
		'featured_image'        => esc_html__( 'Featured Image', 'rhye' ),
		'set_featured_image'    => esc_html__( 'Set featured image', 'rhye' ),
		'remove_featured_image' => esc_html__( 'Remove featured image', 'rhye' ),
		'use_featured_image'    => esc_html__( 'Use as featured image', 'rhye' ),
		'insert_into_item'      => esc_html__( 'Insert into Portfolio Item', 'rhye' ),
		'uploaded_to_this_item' => esc_html__( 'Uploaded to this Portfolio Item', 'rhye' ),
		'items_list'            => esc_html__( 'Portfolio Items list', 'rhye' ),
		'items_list_navigation' => esc_html__( 'Portfolio Items list navigation', 'rhye' ),
		'filter_items_list'     => esc_html__( 'Filter Portfolio Items list', 'rhye' ),
	);
	$rewrite = array(
		'slug'       => 'portfolio',
		'with_front' => true,
		'pages'      => true,
		'feeds'      => true,
	);
	$args    = array(
		'label'               => esc_html__( 'Portfolio Item', 'rhye' ),
		'description'         => esc_html__( '', 'rhye' ),
		'labels'              => $labels,
		'menu_icon'           => 'dashicons-art',
		'supports'            => array( 'title', 'thumbnail', 'revisions' ),
		'taxonomies'          => array( 'arts_portfolio_category' ),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => $priority++,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'hierarchical'        => false,
		'exclude_from_search' => false,
		'show_in_rest'        => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite'             => $rewrite,
	);
	register_post_type( 'arts_portfolio_item', $args );

	/**
	 * Service
	 */
	$labels  = array(
		'name'                  => _x( 'Services', 'Post Type General Name', 'rhye' ),
		'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'rhye' ),
		'menu_name'             => _x( 'Services', 'Admin Menu text', 'rhye' ),
		'name_admin_bar'        => _x( 'Service', 'Add New on Toolbar', 'rhye' ),
		'archives'              => esc_html__( 'Service Archives', 'rhye' ),
		'attributes'            => esc_html__( 'Service Attributes', 'rhye' ),
		'parent_item_colon'     => esc_html__( 'Parent Service:', 'rhye' ),
		'all_items'             => esc_html__( 'All Services', 'rhye' ),
		'add_new_item'          => esc_html__( 'Add New Service', 'rhye' ),
		'add_new'               => esc_html__( 'Add New', 'rhye' ),
		'new_item'              => esc_html__( 'New Service', 'rhye' ),
		'edit_item'             => esc_html__( 'Edit Service', 'rhye' ),
		'update_item'           => esc_html__( 'Update Service', 'rhye' ),
		'view_item'             => esc_html__( 'View Service', 'rhye' ),
		'view_items'            => esc_html__( 'View Services', 'rhye' ),
		'search_items'          => esc_html__( 'Search Service', 'rhye' ),
		'not_found'             => esc_html__( 'Not found', 'rhye' ),
		'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'rhye' ),
		'featured_image'        => esc_html__( 'Featured Image', 'rhye' ),
		'set_featured_image'    => esc_html__( 'Set featured image', 'rhye' ),
		'remove_featured_image' => esc_html__( 'Remove featured image', 'rhye' ),
		'use_featured_image'    => esc_html__( 'Use as featured image', 'rhye' ),
		'insert_into_item'      => esc_html__( 'Insert into Service', 'rhye' ),
		'uploaded_to_this_item' => esc_html__( 'Uploaded to this Service', 'rhye' ),
		'items_list'            => esc_html__( 'Services list', 'rhye' ),
		'items_list_navigation' => esc_html__( 'Services list navigation', 'rhye' ),
		'filter_items_list'     => esc_html__( 'Filter Services list', 'rhye' ),
	);
	$rewrite = array(
		'slug'       => 'services',
		'with_front' => true,
		'pages'      => true,
		'feeds'      => true,
	);
	$args    = array(
		'label'               => esc_html__( 'Service', 'rhye' ),
		'description'         => esc_html__( '', 'rhye' ),
		'labels'              => $labels,
		'menu_icon'           => 'dashicons-hammer',
		'supports'            => array( 'title', 'thumbnail', 'revisions' ),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => $priority++,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'hierarchical'        => false,
		'exclude_from_search' => false,
		'show_in_rest'        => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite'             => $rewrite,
	);
	register_post_type( 'arts_service', $args );

	/**
	   * Album
	   */
	$labels  = array(
		'name'                  => _x( 'Albums', 'Post Type General Name', 'rhye' ),
		'singular_name'         => _x( 'Album', 'Post Type Singular Name', 'rhye' ),
		'menu_name'             => _x( 'Albums', 'Admin Menu text', 'rhye' ),
		'name_admin_bar'        => _x( 'Album', 'Add New on Toolbar', 'rhye' ),
		'archives'              => esc_html__( 'Album Archives', 'rhye' ),
		'attributes'            => esc_html__( 'Album Attributes', 'rhye' ),
		'parent_item_colon'     => esc_html__( 'Parent Album:', 'rhye' ),
		'all_items'             => esc_html__( 'All Albums', 'rhye' ),
		'add_new_item'          => esc_html__( 'Add New Album', 'rhye' ),
		'add_new'               => esc_html__( 'Add New', 'rhye' ),
		'new_item'              => esc_html__( 'New Album', 'rhye' ),
		'edit_item'             => esc_html__( 'Edit Album', 'rhye' ),
		'update_item'           => esc_html__( 'Update Album', 'rhye' ),
		'view_item'             => esc_html__( 'View Album', 'rhye' ),
		'view_items'            => esc_html__( 'View Albums', 'rhye' ),
		'search_items'          => esc_html__( 'Search Album', 'rhye' ),
		'not_found'             => esc_html__( 'Not found', 'rhye' ),
		'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'rhye' ),
		'featured_image'        => esc_html__( 'Featured Image', 'rhye' ),
		'set_featured_image'    => esc_html__( 'Set featured image', 'rhye' ),
		'remove_featured_image' => esc_html__( 'Remove featured image', 'rhye' ),
		'use_featured_image'    => esc_html__( 'Use as featured image', 'rhye' ),
		'insert_into_item'      => esc_html__( 'Insert into Album', 'rhye' ),
		'uploaded_to_this_item' => esc_html__( 'Uploaded to this Album', 'rhye' ),
		'items_list'            => esc_html__( 'Albums list', 'rhye' ),
		'items_list_navigation' => esc_html__( 'Albums list navigation', 'rhye' ),
		'filter_items_list'     => esc_html__( 'Filter Albums list', 'rhye' ),
	);
	$rewrite = array(
		'slug'       => 'albums',
		'with_front' => true,
		'pages'      => true,
		'feeds'      => true,
	);
	$args    = array(
		'label'               => esc_html__( 'Album', 'rhye' ),
		'description'         => esc_html__( '', 'rhye' ),
		'labels'              => $labels,
		'menu_icon'           => 'dashicons-images-alt',
		'supports'            => array( 'title', 'thumbnail', 'revisions' ),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => $priority++,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'hierarchical'        => false,
		'exclude_from_search' => false,
		'show_in_rest'        => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite'             => $rewrite,
	);
	register_post_type( 'arts_album', $args );
}
