<?php

/**
 * Collect WooCommerce pages URLs into array
 *
 * @return array
 */
function arts_get_woocommerce_urls() {
	$urls  = [];
	$pages = [];

	// shop pages
	if ( function_exists( 'wc_get_page_id' ) ) {

		$pages['shop']      = wc_get_page_id( 'shop' );
		$pages['cart']      = wc_get_page_id( 'cart' );
		$pages['myaccount'] = wc_get_page_id( 'myaccount' );
		$pages['checkout']  = wc_get_page_id( 'checkout' );
		$pages['terms']     = wc_get_page_id( 'terms' );

		if ( ! empty( $pages['shop'] ) ) {
			$urls[] = untrailingslashit( get_permalink( $pages['shop'] ) );
		}

		if ( ! empty( $pages['cart'] ) ) {
			$urls[] = untrailingslashit( get_permalink( $pages['cart'] ) );
		}

		if ( ! empty( $pages['myaccount'] ) ) {
			$urls[] = untrailingslashit( get_permalink( $pages['myaccount'] ) );
		}

		if ( ! empty( $pages['checkout'] ) ) {
			$urls[] = untrailingslashit( get_permalink( $pages['checkout'] ) );
		}

		if ( ! empty( $pages['terms'] ) ) {
			$urls[] = untrailingslashit( get_permalink( $pages['terms'] ) );
		}
	}

	// products, categories, tags, attributes
	if ( function_exists( 'wc_get_permalink_structure' ) ) {

		$permalinks = wc_get_permalink_structure();
		$base_url   = trailingslashit( get_site_url() );

		if ( array_key_exists( 'product_base', $permalinks ) && ! empty( $permalinks['product_base'] ) ) {
			$urls[] = untrailingslashit( $base_url . $permalinks['product_base'] );
		}

		if ( array_key_exists( 'category_base', $permalinks ) && ! empty( $permalinks['category_base'] ) ) {
			$urls[] = untrailingslashit( $base_url . $permalinks['category_base'] );
		}

		if ( array_key_exists( 'tag_base', $permalinks ) && ! empty( $permalinks['tag_base'] ) ) {
			$urls[] = untrailingslashit( $base_url . $permalinks['tag_base'] );
		}

		if ( array_key_exists( 'attribute_base', $permalinks ) && ! empty( $permalinks['attribute_base'] ) ) {
			$urls[] = untrailingslashit( $base_url . $permalinks['attribute_base'] );
		}
	}

	return $urls;
}
