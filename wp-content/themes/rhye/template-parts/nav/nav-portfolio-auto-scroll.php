<?php

$portfolio_nav_direction = get_theme_mod( 'portfolio_nav_direction', 'forward' );
$next_post               = $portfolio_nav_direction === 'forward' ? get_previous_post() : get_next_post();
$current_id              = get_the_ID();
$next_link;
$next_title;
$next_image_id;
$attrs_link = '';

$portfolio_nav_background               = arts_get_overridden_document_option( 'portfolio_nav_background', 'page_portfolio_nav_settings_overridden', 'bg-light-1' );
$portfolio_nav_theme                    = arts_get_overridden_document_option( 'portfolio_nav_theme', 'page_portfolio_nav_settings_overridden', 'dark' );
$portfolio_nav_divider_enabled          = arts_get_overridden_document_option( 'portfolio_nav_divider_enabled', 'page_portfolio_nav_settings_overridden', true );
$portfolio_nav_image_transition_enabled = get_theme_mod( 'portfolio_nav_image_transition_enabled', true );
$portfolio_nav_scroll_down_enabled      = get_theme_mod( 'portfolio_nav_scroll_down_enabled', true );
$portfolio_nav_scroll_down_label        = get_theme_mod( 'portfolio_nav_scroll_down_label', esc_html__( 'Keep Scrolling', 'rhye' ) );
$portfolio_nav_headings_preset          = get_theme_mod( 'portfolio_nav_headings_preset', 'h1' );
$portfolio_nav_labels_preset            = get_theme_mod( 'portfolio_nav_labels_preset', 'subheading' );
$portfolio_nav_next_label               = get_theme_mod( 'portfolio_nav_next_label', esc_html__( 'Next Project', 'rhye' ) );

$posts = get_posts(
	array(
		'post_type'      => 'arts_portfolio_item',
		'posts_per_page' => -1,
	)
);

$first_post = $portfolio_nav_direction === 'forward' ? current( $posts ) : end( $posts );
$last_post  = $portfolio_nav_direction === 'forward' ? end( $posts ) : current( $posts );

if ( ! $next_post && $first_post ) {
	$next_post = $first_post;
}

if ( ! $next_post && $last_post ) {
	$next_post = $last_post;
}

if ( $next_post ) {
	$next_link     = get_permalink( $next_post );
	$next_title    = $next_post->post_title;
	$next_image_id = get_post_thumbnail_id( $next_post->ID );
}

if ( $portfolio_nav_image_transition_enabled && $next_image_id ) {
	$attrs_link = 'data-pjax-link=flyingImage';
}

?>

<?php if ( $next_post ) : ?>
  <section class="container-fluid section section-nav-projects section-fullheight text-center <?php echo esc_attr( $portfolio_nav_background ); ?>" data-arts-os-animation="true" data-arts-theme-text="<?php echo esc_attr( $portfolio_nav_theme ); ?>">
		<div class="section-fullheight__inner section-nav-projects__inner_actual">
			<?php if ( $portfolio_nav_divider_enabled ) : ?>
				<div class="section__divider section__divider_top"></div>
			<?php else : ?>
				<div class="section__divider d-none"></div>
			<?php endif; ?>
			<header class="section-nav-projects__header">
				<a class="section-nav-projects__link" href="<?php echo esc_url( $next_link ); ?>" <?php echo esc_attr( $attrs_link ); ?>>
					<div class="section-nav-projects__subheading mb-1 mb-md-2 <?php echo esc_attr( $portfolio_nav_labels_preset ); ?>"><?php echo esc_html( $portfolio_nav_next_label ); ?></div>
					<h2 class="section-nav-projects__heading mt-0 mb-0 <?php echo esc_attr( $portfolio_nav_headings_preset ); ?>"><?php echo esc_html( $next_title ); ?></h2>
				</a>
			</header>
			<?php if ( $portfolio_nav_scroll_down_enabled ) : ?>
				<!-- scroll down -->
				<div class="section-nav-projects__wrapper-scroll-down text-center">
					<?php
					arts_the_scroll_down_button(
						array(
							'label'     => $portfolio_nav_scroll_down_label,
							'animation' => false,
							'enabled'   => false,
						)
					);
					?>
				</div>
				<!-- - scroll down -->
			<?php endif; ?>
		</div>
		<?php if ( $portfolio_nav_image_transition_enabled && $next_image_id ) : ?>
			<!-- featured image -->
			<div class="container section-nav-projects__next-image section-fullheight__inner">
				<?php
					arts_the_lazy_image(
						array(
							'id'    => $next_image_id,
							'type'  => 'image',
							'size'  => 'medium_large',
							'class' => array(
								'section' => array( 'section-nav-projects__wrapper-image', 'js-transition-img', 'overflow' ),
								'wrapper' => array(),
								'image'   => array( 'js-transition-img__transformed-el', 'of-cover' ),
							),
						)
					);
				?>
			</div>
			<!-- - featured image -->
		<?php endif; ?>
		<!-- Vertical spacing element -->
		<div class="section-fullheight__inner hidden"></div>
		<!-- - Vertical spacing element -->
  </section>
<?php endif; ?>
