<?php

$priority = 1;


/**
 * Body Text & Paragraph
 */
Kirki::add_section(
	'paragraph',
	array(
		'title'    => esc_html__( 'Body Text & Paragraph', 'rhye' ),
		'panel'    => 'typography',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/typography/sections/paragraph' );

/**
 * XL Headings
 */
Kirki::add_section(
	'xl_headings',
	array(
		'title'    => esc_html__( 'XL & XXL Headings', 'rhye' ),
		'panel'    => 'typography',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/typography/sections/xl-headings' );

/**
 * h1-h6 Headings
 */
Kirki::add_section(
	'h1_h6_headings',
	array(
		'title'    => esc_html__( 'H1 - H6 Headings', 'rhye' ),
		'panel'    => 'typography',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/typography/sections/h1-h6-headings' );

/**
 * Subheading
 */
Kirki::add_section(
	'subheading',
	array(
		'title'    => esc_html__( 'Subheading', 'rhye' ),
		'panel'    => 'typography',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/typography/sections/subheading' );

/**
 * Blockquote
 */
Kirki::add_section(
	'blockquote',
	array(
		'title'    => esc_html__( 'Blockquote', 'rhye' ),
		'panel'    => 'typography',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/typography/sections/blockquote' );

/**
 * Dropcap
 */
Kirki::add_section(
	'drop_cap',
	array(
		'title'    => esc_html__( 'Drop Cap', 'rhye' ),
		'panel'    => 'typography',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/typography/sections/drop-cap' );

/**
 * Text Logo
 */
Kirki::add_section(
	'text_logo',
	array(
		'title'    => esc_html__( 'Text Logo', 'rhye' ),
		'panel'    => 'typography',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/typography/sections/text-logo' );

/**
 * Slider Counters
 */
Kirki::add_section(
	'typography_counters',
	array(
		'title'    => esc_html__( 'Counters', 'rhye' ),
		'panel'    => 'typography',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/typography/sections/counters' );

/**
 * Miscellaneous Elements
 */
Kirki::add_section(
	'typography_social_icons',
	array(
		'title'    => esc_html__( 'Social Icons', 'rhye' ),
		'panel'    => 'typography',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/typography/sections/social-icons' );

/**
 * Miscellaneous Elements
 */
Kirki::add_section(
	'typography_misc',
	array(
		'title'    => esc_html__( 'Misc', 'rhye' ),
		'panel'    => 'typography',
		'priority' => $priority ++,
	)
);
get_template_part( '/inc/customizer/panels/typography/sections/misc' );
