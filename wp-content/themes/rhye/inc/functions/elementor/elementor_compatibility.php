<?php

/**
 * Register theme locations for Elementor Theme Builder API
 */
add_action( 'elementor/theme/register_locations', 'arts_register_elementor_locations' );
function arts_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_location( 'header' );
	$elementor_theme_manager->register_location( 'footer' );
	$elementor_theme_manager->register_location( 'popup' );
	$elementor_theme_manager->register_location( 'single-post' );
	$elementor_theme_manager->register_location( 'single-page' );
}

/**
 * Elementor Pro AJAX compatibility
 * Enforce exclusive Elementor Pro assets to load on all the pages
 */
add_action( 'elementor_pro/init', 'arts_enqueue_elementor_pro_widgets_assets' );
function arts_enqueue_elementor_pro_widgets_assets() {
	$ajax_enabled              = get_theme_mod( 'ajax_enabled', false );
	$ajax_load_missing_scripts = get_theme_mod( 'ajax_load_missing_scripts', true );
	$ajax_load_missing_styles  = get_theme_mod( 'ajax_load_missing_styles', true );

	if ( $ajax_enabled ) {

		// JS assets
		if ( ! $ajax_load_missing_scripts ) {
			add_action(
				'elementor/frontend/before_enqueue_scripts', function() {
					wp_enqueue_script( 'elementor-gallery' ); // Elementor Gallery
					wp_enqueue_script( 'lottie' ); // Elementor Lottie animations
				}
			);
		}

		// CSS assets
		if ( ! $ajax_load_missing_styles ) {
			add_action(
				'elementor/frontend/before_enqueue_styles', function() {
					wp_enqueue_style( 'elementor-gallery' ); // Elementor Gallery
				}
			);
		}
	}
}

/**
 * Remove Elementor welcome splash screen
 * on the initial plugin activation
 * This prevents some issues when Merlin wizard
 * installs and activates the required plugins
 */
add_action( 'init', 'arts_remove_elementor_welcome_screen' );
function arts_remove_elementor_welcome_screen() {
	delete_transient( 'elementor_activation_redirect' );
}

/**
 * BEFORE: Extra markup for Elementor Canvas template
 */
add_action(
	'elementor/page_templates/canvas/before_content', function() {
		$preloader_enabled                               = get_theme_mod( 'preloader_enabled', false );
		$ajax_enabled                                    = get_theme_mod( 'ajax_enabled', false );
		$ajax_spinner_desktop_enabled                    = get_theme_mod( 'ajax_spinner_desktop_enabled', false );
		$ajax_spinner_mobile_enabled                     = get_theme_mod( 'ajax_spinner_mobile_enabled', true );
		$cursor_enabled                                  = get_theme_mod( 'cursor_enabled', false );
		$smooth_scroll_elementor_canvas_template_enabled = get_theme_mod( 'smooth_scroll_elementor_canvas_template_enabled', true );
		$page_color_theme_curtain                        = arts_get_document_option( 'page_masthead_background' );
		$page_curtain_color                              = get_theme_mod( esc_attr( $page_color_theme_curtain ), '#ffffff' );
		$class_container                                 = '';
		$attrs_container                                 = 'data-barba-namespace=elementor';
		$theme_container                                 = 'dark';

		if ( $ajax_enabled ) {
			$attrs_container .= ' data-barba=container';
		}

		if ( $smooth_scroll_elementor_canvas_template_enabled ) {
			$class_container = 'js-smooth-scroll';
		}
		?>
		<?php if ( $ajax_enabled ) : ?>
			<div data-barba="wrapper">
		<?php endif; ?>

		<?php if ( $preloader_enabled ) : ?>
			<!-- PAGE PRELOADER -->
			<?php get_template_part( 'template-parts/preloader/preloader' ); ?>
			<!-- - PAGE PRELOADER -->
		<?php endif; ?>

		<?php if ( $ajax_spinner_desktop_enabled || $ajax_spinner_mobile_enabled ) : ?>
			<!-- Loading Spinner -->
			<?php get_template_part( 'template-parts/spinner/spinner' ); ?>
			<!-- - Loading Spinner -->
		<?php endif; ?>

		<!-- TRANSITION CURTAINS -->
		<?php get_template_part( 'template-parts/curtains/curtains' ); ?>
		<!-- - TRANSITION CURTAINS -->

		<?php if ( $cursor_enabled || $preloader_enabled ) : ?>
			<!-- Cursor Follower-->
			<?php get_template_part( 'template-parts/cursor/cursor' ); ?>
			<!-- - Cursor Follower-->
		<?php endif; ?>

		<!-- PAGE HEADER -->
		<?php get_template_part( 'template-parts/header/header' ); ?>
		<!-- - PAGE HEADER -->

		<div class="<?php echo esc_attr( trim( $class_container ) ); ?>" id="page-wrapper" data-arts-theme-text="<?php echo esc_attr( $theme_container ); ?>" <?php echo esc_attr( trim( $attrs_container ) ); ?>>
			<main class="page-wrapper__content">
				<!-- Element to set transition background -->
				<section class="section section-masthead d-none" data-background-color="<?php echo esc_attr( $page_curtain_color ); ?>"></section>
				<!-- - Element to set transition background -->
			<?php
	}
);

/**
 * AFTER: Extra markup for Elementor Canvas template
 */
add_action(
	'elementor/page_templates/canvas/after_content', function() {
		$ajax_enabled = get_theme_mod( 'ajax_enabled', false );

		?>
		</main>
	</div>
		<?php if ( $ajax_enabled ) : ?>
		</div>
	<?php endif; ?>
		<?php
	}
);
