<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Background Color Classes
 */
if ( ! defined( 'ARTS_THEME_COLORS_ARRAY' ) ) {
	define(
		'ARTS_THEME_COLORS_ARRAY',
		array(
			''           => esc_html__( 'Auto', 'rhye' ),
			'bg-dark-1'  => esc_html__( 'Dark 1', 'rhye' ),
			'bg-dark-2'  => esc_html__( 'Dark 2', 'rhye' ),
			'bg-dark-3'  => esc_html__( 'Dark 3', 'rhye' ),
			'bg-dark-4'  => esc_html__( 'Dark 4', 'rhye' ),
			'bg-light-1' => esc_html__( 'Light 1', 'rhye' ),
			'bg-light-2' => esc_html__( 'Light 2', 'rhye' ),
			'bg-light-3' => esc_html__( 'Light 3', 'rhye' ),
			'bg-light-4' => esc_html__( 'Light 4', 'rhye' ),
			'bg-white'   => esc_html__( 'White', 'rhye' ),
			'bg-gray-1'  => esc_html__( 'Gray 1', 'rhye' ),
			'bg-gray-2'  => esc_html__( 'Gray 2', 'rhye' ),
		)
	);
}

/**
 * Color Themes
 */
if ( ! defined( 'ARTS_THEME_COLOR_THEMES_ARRAY' ) ) {
	define(
		'ARTS_THEME_COLOR_THEMES_ARRAY',
		array(
			''      => esc_html__( 'Auto', 'rhye' ),
			'dark'  => esc_html__( 'Dark', 'rhye' ),
			'light' => esc_html__( 'Light', 'rhye' ),
		)
	);
}

/**
 * Typography Presets
 */
if ( ! defined( 'ARTS_THEME_TYPOGRAHY_ARRAY' ) ) {
	define(
		'ARTS_THEME_TYPOGRAHY_ARRAY',
		array(
			'xl'         => esc_html__( 'Heading XL', 'rhye' ),
			'h1'         => esc_html__( 'Heading 1', 'rhye' ),
			'h2'         => esc_html__( 'Heading 2', 'rhye' ),
			'h3'         => esc_html__( 'Heading 3', 'rhye' ),
			'h4'         => esc_html__( 'Heading 4', 'rhye' ),
			'h5'         => esc_html__( 'Heading 5', 'rhye' ),
			'h6'         => esc_html__( 'Heading 6', 'rhye' ),
			'paragraph'  => esc_html__( 'Paragraph', 'rhye' ),
			'blockquote' => esc_html__( 'Blockquote', 'rhye' ),
			'subheading' => esc_html__( 'Subheading', 'rhye' ),
			'small'      => esc_html__( 'Small', 'rhye' ),
		)
	);
}

/**
 * HTML Tags
 */
if ( ! defined( 'ARTS_THEME_HTML_TAGS_ARRAY' ) ) {
	define(
		'ARTS_THEME_HTML_TAGS_ARRAY',
		array(
			'div'        => 'div',
			'span'       => 'span',
			'h1'         => 'h1',
			'h2'         => 'h2',
			'h3'         => 'h3',
			'h4'         => 'h4',
			'h5'         => 'h5',
			'h6'         => 'h6',
			'p'          => 'p',
			'blockquote' => 'blockquote',
		)
	);
}
