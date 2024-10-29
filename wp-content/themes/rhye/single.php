<?php

$is_elementor_page = arts_is_built_with_elementor();
$masthead_template = '';
$post_type         = get_post_type();

$portfolio_nav_enabled = get_theme_mod( 'portfolio_nav_enabled', true );
$portfolio_nav_style  = get_theme_mod( 'portfolio_nav_style', 'portfolio-auto-scroll' );

if ( $is_elementor_page ) {
	$masthead_template = 'elementor-' . arts_get_document_option( 'page_masthead_layout' );
}

get_header();

/**
 * Page Masthead
 */
get_template_part( 'template-parts/masthead/masthead', esc_attr( $masthead_template ) );
the_post();
?>

<?php if ( ! $is_elementor_page ) : ?>
	<section class="section py-medium section-blog">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col">
					<div class="post">
						<div class="post__content clearfix">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php else : ?>
	<?php the_content(); ?>
<?php endif; ?>

<?php

/**
 * Page Bottom Navigation (only portfolio items)
 */
if ( $post_type == 'arts_portfolio_item' && $is_elementor_page && $portfolio_nav_enabled ) {
	get_template_part( 'template-parts/nav/nav', esc_attr( $portfolio_nav_style ) );
}

get_footer();
