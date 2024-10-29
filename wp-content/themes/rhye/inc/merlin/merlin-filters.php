<?php

/**
 * Import Demo Data
 */
add_filter( 'merlin_import_files', 'arts_merlin_import_files' );
add_filter( 'ocdi/import_files', 'arts_merlin_import_files' );
function arts_merlin_import_files() {
	return array(
		array(
			'import_file_name'           => 'Rhye Demo Data',
			'import_file_url'            => 'https://artemsemkin.com/' . ARTS_THEME_SLUG . '/demo-content/demo-content.xml',
			'import_widget_file_url'     => 'https://artemsemkin.com/' . ARTS_THEME_SLUG . '/demo-content/widgets.wie',
			'import_customizer_file_url' => 'https://artemsemkin.com/' . ARTS_THEME_SLUG . '/demo-content/customizer.dat',
			'preview_url'                => 'https://artemsemkin.com/' . ARTS_THEME_SLUG . '/wp/',
		),
	);
}

/**
 * Setup Elementor
 */
add_filter( 'merlin_after_all_import', 'arts_merlin_setup_elementor' );
add_filter( 'pt-ocdi/after_import', 'arts_merlin_setup_elementor' );
function arts_merlin_setup_elementor() {

	$cpt_support = get_option( 'elementor_cpt_support' );

	// Update CPT Support
	if ( ! $cpt_support ) {
		$cpt_support = [ 'page', 'post', 'arts_portfolio_item', 'arts_service', 'arts_album' ];
		update_option( 'elementor_cpt_support', $cpt_support );
	} elseif ( ! in_array( 'arts_portfolio_item', $cpt_support ) ) {
		$cpt_support[] = 'arts_portfolio_item';
		update_option( 'elementor_cpt_support', $cpt_support );
	} elseif ( ! in_array( 'arts_service', $cpt_support ) ) {
		$cpt_support[] = 'arts_service';
		update_option( 'elementor_cpt_support', $cpt_support );
	} elseif ( ! in_array( 'arts_album', $cpt_support ) ) {
		$cpt_support[] = 'arts_album';
		update_option( 'elementor_cpt_support', $cpt_support );
	}

	// Update Default space between widgets
	update_option( 'elementor_space_between_widgets', '20' );

	// Update Content width
	update_option( 'elementor_container_width', '1100' );

	// Update Breakpoints
	update_option( 'elementor_viewport_lg', '992' );
	update_option( 'elementor_viewport_md', '768' );

	// Update Page title selector
	update_option( 'elementor_page_title_selector', '.section-masthead h1' );

	// Update Disable default color schemes and fonts
	update_option( 'elementor_disable_color_schemes', 'yes' );
	update_option( 'elementor_disable_typography_schemes', 'yes' );

	// Update CSS Print Method
	update_option( 'elementor_css_print_method', 'internal' );

	// FontAwesome 4 Support
	update_option( 'elementor_load_fa4_shim', 'yes' );

	// Enable Optimized Assets Loading
	update_option( 'elementor_experiment-e_optimized_assets_loading', 'active' );

}

/**
 * Setup Menu
 */
add_filter( 'merlin_after_all_import', 'arts_merlin_setup_menu' );
add_filter( 'pt-ocdi/after_import', 'arts_merlin_setup_menu' );
function arts_merlin_setup_menu() {

	$top_menu = get_term_by( 'name', 'Top Menu', 'nav_menu' );

	set_theme_mod(
		'nav_menu_locations', array(
			'main_menu' => $top_menu->term_id,
		)
	);
}

/**
 * Setup Front/Blog Pages
 */
add_filter( 'merlin_after_all_import', 'arts_merlin_setup_front_blog_pages' );
add_filter( 'pt-ocdi/after_import', 'arts_merlin_setup_front_blog_pages' );
function arts_merlin_setup_front_blog_pages() {

	$front_page_id = get_page_by_title( 'Slider 1 Distortion / H' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}

/**
 * Setup Date Format
 */
add_filter( 'merlin_after_all_import', 'arts_merlin_setup_date_format' );
add_filter( 'pt-ocdi/after_import', 'arts_merlin_setup_date_format' );
function arts_merlin_setup_date_format() {

	update_option( 'date_format', 'd M Y' );

}

/**
 * Setup Intuitive Custom Post Order
 * Define sortable post types
 */
add_filter( 'merlin_after_all_import', 'arts_merlin_setup_hicpo' );
add_filter( 'pt-ocdi/after_import', 'arts_merlin_setup_hicpo' );
function arts_merlin_setup_hicpo() {

	add_option( 'hicpo_options', array( 'objects', 'tags' ) );

	$hicpo_options = get_option( 'hicpo_options' );
	$hicpo_objects = $hicpo_options['objects'];
	$hicpo_tags    = $hicpo_options['tags'];

	// Sortable custom post types
	if ( ! $hicpo_objects ) {

		$hicpo_objects            = [ 'arts_portfolio_item', 'arts_service', 'arts_album' ];
		$hicpo_options['objects'] = $hicpo_objects;
		update_option( 'hicpo_options', $hicpo_options );

	} elseif ( ! in_array( 'arts_portfolio_item', $hicpo_objects ) ) {

		$hicpo_objects[]          = 'arts_portfolio_item';
		$hicpo_options['objects'] = $hicpo_objects;
		update_option( 'hicpo_options', $hicpo_options );

	} elseif ( ! in_array( 'arts_service', $hicpo_objects ) ) {

		$hicpo_objects[]          = 'arts_service';
		$hicpo_options['objects'] = $hicpo_objects;
		update_option( 'hicpo_options', $hicpo_options );

	} elseif ( ! in_array( 'arts_album', $hicpo_objects ) ) {

		$hicpo_objects[]          = 'arts_album';
		$hicpo_options['objects'] = $hicpo_objects;
		update_option( 'hicpo_options', $hicpo_options );

	};

	// Sortable taxonomies
	if ( ! $hicpo_tags ) {

		$hicpo_tags            = ['arts_portfolio_category'];
		$hicpo_options['tags'] = $hicpo_tags;
		update_option( 'hicpo_options', $hicpo_options );

	} elseif ( ! in_array( 'arts_portfolio_category', $hicpo_tags ) ) {

		$hicpo_tags[]          = 'arts_portfolio_category';
		$hicpo_options['tags'] = $hicpo_tags;
		update_option( 'hicpo_options', $hicpo_options );

	}

}

/**
 * Setup permalinks format
 * Needed to make AJAX transitions work
 */
add_filter( 'merlin_after_all_import', 'arts_merlin_setup_permalinks' );
add_filter( 'pt-ocdi/after_import', 'arts_merlin_setup_permalinks' );
function arts_merlin_setup_permalinks() {

	global $wp_rewrite;

	// Set permalink structure
	$wp_rewrite->set_permalink_structure( '/%postname%/' );

	// Recreate rewrite rules
	$wp_rewrite->rewrite_rules();
	$wp_rewrite->wp_rewrite_rules();
	$wp_rewrite->flush_rules();

}

/**
 * Unset all widgets
 * from default blog sidebar
 */
add_action( 'merlin_widget_importer_before_widgets_import', 'arts_unset_default_sidebar_widgets' );
add_action( 'pt-ocdi/widget_importer_before_widgets_import', 'arts_unset_default_sidebar_widgets' );
function arts_unset_default_sidebar_widgets() {

	// empty default blog sidebar
	$widget_areas = array(
		'blog-sidebar' => array(),
	);
	update_option( 'sidebars_widgets', $widget_areas );

	// set menu to fullscreen style
	update_option( 'menu_style', 'fullscreen' );

	// register sidebar in fullscreen menu now
	// before the demo import starts
	// so the widgets will be actually imported
	register_sidebar(
		array(
			'name'          => esc_html__( 'Fullscreen Menu Widgets', 'rhye' ),
			'id'            => 'header-sidebar',
			'description'   => esc_html__( 'Appears on desktop in the page header if menu type is set to "fullscreen".', 'rhye' ),
			'before_widget' => '<div class="col-lg-4 col-gutters header__widget split-text" id="%1$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="subheading mb-0-5">',
			'after_title'   => '</div>',
		)
	);

}
