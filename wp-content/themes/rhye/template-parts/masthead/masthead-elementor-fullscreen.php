<?php

global $post;

$titles        = arts_set_page_title();
$page_title    = $titles[0];
$page_subtitle = $titles[1];
$page_text     = $titles[2];

$attrs_section    = '';
$class_section    = arts_get_document_option( 'page_masthead_background' );
$class_section   .= ' ' . arts_get_document_option( 'page_masthead_content_alignment' );
$class_inner      = arts_get_document_option( 'page_masthead_content_container' );
$class_overlay    = '';
$class_split_text = ' split-text js-split-text';

$has_post_thumbnail     = has_post_thumbnail();
$image_parallax_enabled = arts_get_document_option( 'page_masthead_image_parallax_enabled' );
$image_parallax_speed   = arts_get_document_option( 'page_masthead_image_parallax_speed' );

$page_masthead_heading_preset                    = arts_get_document_option( 'page_masthead_heading_preset' );
$page_masthead_subheading_preset                 = arts_get_document_option( 'page_masthead_subheading_preset' );
$page_masthead_text_preset                       = arts_get_document_option( 'page_masthead_text_preset' );
$page_masthead_headline_enabled                  = arts_get_document_option( 'page_masthead_headline_enabled' );
$page_masthead_subheading_enabled                = arts_get_document_option( 'page_masthead_subheading_enabled' );
$page_masthead_text_enabled                      = arts_get_document_option( 'page_masthead_text_enabled' );
$page_masthead_scroll_down_enabled               = arts_get_document_option( 'page_masthead_scroll_down_enabled' );
$page_masthead_background_overlay_dither_enabled = arts_get_document_option( 'page_masthead_background_overlay_dither_enabled' );
$page_masthead_fullscreen_fixed_enabled          = arts_get_document_option( 'page_masthead_fullscreen_fixed_enabled' );
$page_masthead_fullscreen_fixed_speed            = arts_get_document_option( 'page_masthead_fullscreen_fixed_speed' );

$page_color_theme_curtain        = arts_get_document_option( 'page_masthead_background' );
$page_curtain_color              = get_theme_mod( esc_attr( $page_color_theme_curtain ), '#eeece6' );
$page_masthead_animation_enabled = arts_get_document_option( 'page_masthead_animation_enabled', null, true );
$page_masthead_theme             = arts_get_document_option( 'page_masthead_theme' );

if ( $page_masthead_theme ) {
	$attrs_section = ' data-arts-theme-text=' . $page_masthead_theme;
}

if ( $page_masthead_background_overlay_dither_enabled ) {
	$class_overlay .= ' overlay_dither';
}

if ( $page_masthead_fullscreen_fixed_enabled ) {
	$attrs_section .= ' data-arts-scroll-fixed=true';
	$attrs_section .= ' data-arst-scroll-fixed-speed=' . floatval( $page_masthead_fullscreen_fixed_speed['size'] );
	$class_section .= ' section-masthead_fixed overflow';
}

if ( $page_masthead_animation_enabled ) {
	$attrs_section                   .= ' data-arts-os-animation=true';
	$page_masthead_heading_preset    .= $class_split_text;
	$page_masthead_subheading_preset .= $class_split_text;
	$page_masthead_text_preset       .= $class_split_text;
}

?>
<?php if ( $page_masthead_fullscreen_fixed_enabled ) : ?>
	<div class="<?php echo esc_attr( $page_color_theme_curtain ); ?>">
<?php endif; ?>
	<section class="section section-masthead section-fullheight <?php echo esc_attr( trim( $class_section ) ); ?>" data-background-color="<?php echo esc_attr( $page_curtain_color ); ?>" <?php echo esc_attr( trim( $attrs_section ) ); ?>>
		<div class="section-masthead__inner section-fullheight__inner section-fullheight__inner_mobile <?php echo esc_attr( $class_inner ); ?>">
			<header class="row section-masthead__header">
				<div class="col-12">
					<?php if ( $page_masthead_subheading_enabled && ! empty( $page_subtitle ) ) : ?>
						<div class="section-masthead__subheading mt-0 mb-1 mb-md-2 <?php echo esc_attr( $page_masthead_subheading_preset ); ?>" data-split-text-type="lines,words" data-split-text-set="words"><?php echo esc_html( $page_subtitle ); ?></div>
						<div class="w-100"></div>
					<?php endif; ?>
					<?php if ( ! empty( $page_title ) ) : ?>
						<h1 class="entry-title section-masthead__heading my-0 <?php echo esc_attr( $page_masthead_heading_preset ); ?>" data-split-text-type="lines,words" data-split-text-set="words"><?php echo esc_html( $page_title ); ?></h1>
						<div class="w-100"></div>
					<?php endif; ?>
					<?php if ( $page_masthead_headline_enabled ) : ?>
						<div class="section-masthead__headline section__headline mt-2"></div>
					<?php endif; ?>
					<?php if ( $page_masthead_text_enabled && ! empty( $page_text ) ) : ?>
						<div class="section-masthead__text mt-2 <?php echo esc_attr( $page_masthead_text_preset ); ?>" data-split-text-type="lines" data-split-text-set='lines'><?php echo wp_kses( $page_text, wp_kses_allowed_html( 'post' ) ); ?></div>
				<?php endif; ?>
				</div>
			</header>
			<?php if ( $page_masthead_scroll_down_enabled ) : ?>
				<!-- scroll down -->
				<div class="section-masthead__scroll-down">
					<div class="section-masthead__wrapper-scroll-down">
						<?php
							arts_the_scroll_down_button(
								array(
									'label'     => get_theme_mod( 'label_scroll_down_pages', esc_html__( 'Scroll Down', 'rhye' ) ),
									'animation' => $page_masthead_fullscreen_fixed_enabled ? false : true,
								)
							);
						?>
					</div>
				</div>
				<!-- - scroll down -->
			<?php endif; ?>
		</div>
		<?php if ( $has_post_thumbnail ) : ?>
			<?php
				arts_the_lazy_image(
					array(
						'id'        => get_post_thumbnail_id(),
						'type'      => 'background',
						'class'     => array(
							'section' => array( 'section', 'section-image', 'section-masthead__background', 'section-masthead__background_fullscreen' ),
							'wrapper' => array( 'section-image__wrapper', 'js-transition-img' ),
							'image'   => array( 'of-cover', 'js-transition-img__transformed-el' ),
							'overlay' => array( 'section-masthead__overlay', trim( $class_overlay ) ),
						),
						'parallax'  => array(
							'enabled' => $image_parallax_enabled,
							'factor'  => is_array( $image_parallax_speed ) ? $image_parallax_speed['size'] : 0,
						),
						'animation' => false,
						'mask'      => false,
						'overlay'   => true,
					)
				);
			?>
		<?php endif; ?>
	</section>
<?php if ( $page_masthead_fullscreen_fixed_enabled ) : ?>
	</div>
<?php endif; ?>
