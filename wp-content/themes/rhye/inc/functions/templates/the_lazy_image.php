<?php

/**
 * Markup for lazy background/image/video
 */
if ( ! function_exists( 'arts_the_lazy_image' ) ) {
	function arts_the_lazy_image( $args ) {
		$defaults = array(
			'id'        => null,
			'type'      => 'background',
			'size'      => 'full',
			'caption'   => null,
			'class'     => array(
				'section' => array(),
				'wrapper' => array(),
				'image'   => array(),
				'caption' => array(),
				'overlay' => array(),
			),
			'parallax'  => array(
				'enabled' => false,
				'factor'  => 0.1,
			),
			'animation' => false,
			'mask'      => false,
			'overlay'   => false,
		);

		$class_section = '';
		$attrs_section = '';

		$attrs_wrapper = '';
		$class_wrapper = '';

		$class_caption = '';

		$class_media = '';

		$class_overlay = '';

		$lazy_placeholder_src       = '#';
		$lazy_placeholder_type      = get_theme_mod( 'lazy_placeholder_type', 'inline' );
		$lazy_placeholder_inline    = get_theme_mod ( 'lazy_placeholder_inline', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAHCGzyUAAAABGdBTUEAALGPC/xhBQAAADhlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAAqACAAQAAAABAAAAAaADAAQAAAABAAAAAQAAAADa6r/EAAAAC0lEQVQI12NolQQAASYAn89qhTcAAAAASUVORK5CYII=');
		$lazy_placeholder_image_url = get_theme_mod( 'lazy_placeholder_image_url', '' );

		if ( $lazy_placeholder_type === 'inline' && ! empty( $lazy_placeholder_inline ) ) {
			$lazy_placeholder_src = $lazy_placeholder_inline;
		}

		if ( $lazy_placeholder_type === 'custom_image' && ! empty( $lazy_placeholder_image_url ) ) {
			$lazy_placeholder_src = $lazy_placeholder_image_url;
		}

		$args = wp_parse_args( $args, $defaults );

		if ( ! $args['id'] || ! $args['type'] ) {
			return;
		}

		// section
		if ( array_key_exists( 'section', $args['class'] ) && is_array( $args['class']['section'] ) && ! empty( $args['class']['section'] ) ) {
			$class_section = implode( ' ', $args['class']['section'] );
		}

		// wrapper
		if ( array_key_exists( 'wrapper', $args['class'] ) && is_array( $args['class']['wrapper'] ) && ! empty( $args['class']['wrapper'] ) ) {
			$class_wrapper = implode( ' ', $args['class']['wrapper'] );
		}

		// caption
		if ( array_key_exists( 'caption', $args['class'] ) && is_array( $args['class']['caption'] ) && ! empty( $args['class']['caption'] ) ) {
			$class_caption = implode( ' ', $args['class']['caption'] );
		}

		// image
		if ( array_key_exists( 'image', $args['class'] ) && is_array( $args['class']['image'] ) && ! empty( $args['class']['image'] ) ) {
			$class_media = implode( ' ', $args['class']['image'] );
		}

		// parallax
		if ( array_key_exists( 'parallax', $args ) && is_array( $args['parallax'] ) && $args['parallax']['enabled'] ) {
			$class_wrapper .= ' overflow';
			$attrs_section .= ' data-arts-parallax=true';
			$attrs_section .= ' data-arts-parallax-factor=' . floatval( $args['parallax']['factor'] );
		}

		// overlay
		if ( $args['overlay'] && array_key_exists( 'overlay', $args['class'] ) && is_array( $args['class']['overlay'] ) && ! empty( $args['class']['overlay'] ) ) {
			$class_overlay = implode( ' ', $args['class']['overlay'] );
		}

		// mask
		if ( $args['mask'] ) {
			$class_wrapper .= ' mask-reveal';
		}

		// animation
		if ( $args['animation'] ) {
			$attrs_section .= ' data-arts-os-animation=true';
		}

		switch ( $args['type'] ) {
			case 'background':
				if ( $args['class']['wrapper'] !== false ) {
					$class_wrapper .= ' lazy-bg';
				}
				$class_media .= ' of-cover';
				break;
			case 'image':
				if ( $args['class']['wrapper'] !== false ) {
					$class_wrapper .= ' lazy';
				}
				break;
			case 'texture':
				if ( $args['class']['wrapper'] !== false ) {
					$class_wrapper .= ' lazy';
				}
				break;
			case 'background-video':
				$class_media .= ' of-cover';
				break;
			case 'video':
				break;
		}

		if ( $args['type'] === 'background' || $args['type'] === 'image' || $args['type'] === 'texture' ) {
			$full_size_images_enabled = get_theme_mod( 'full_size_images_enabled', false );
			$attrs  = wp_get_attachment_image_src( $args['id'], $args['size'] );
			$srcset = '';
			$sizes  = '';
			$alt    = get_post_meta( $args['id'], '_wp_attachment_image_alt', true );

			if ( ! $full_size_images_enabled ) {
				$srcset = wp_get_attachment_image_srcset( $args['id'], $args['size'] );
				$sizes  = wp_get_attachment_image_sizes( $args['id'], $args['size'] );
			}
		}

		?>
		<?php if ( ! empty( $class_section ) || ! empty( $attrs_section ) ) : ?>
			<div class="<?php echo esc_attr( trim( $class_section ) ); ?>" <?php echo esc_attr( trim( $attrs_section ) ); ?>>
		<?php endif; ?>
			<?php if ( ! empty( $class_wrapper ) || ! empty( $attrs_wrapper ) ) : ?>
				<?php if ( $args['type'] === 'image' || $args['type'] === 'texture' ) : ?>
					<div class="<?php echo esc_attr( trim( $class_wrapper ) ); ?>" <?php echo esc_attr( trim( $attrs_wrapper ) ); ?> style="padding-bottom: calc( (<?php echo esc_attr( $attrs[2] ); ?> / <?php echo esc_attr( $attrs[1] ); ?>) * 100% ); height: 0;">
				<?php else : ?>
					<div class="<?php echo esc_attr( trim( $class_wrapper ) ); ?>" <?php echo esc_attr( trim( $attrs_wrapper ) ); ?>>
				<?php endif; ?>
				<?php if ( $args['mask'] ) : ?>
					<div class="mask-reveal__layer mask-reveal__layer-1">
						<div class="mask-reveal__layer mask-reveal__layer-2">
				<?php endif; ?>
			<?php endif; ?>
				<?php
				switch ( $args['type'] ) {
					case 'background':
						?>
							<img class="<?php echo esc_attr( trim( $class_media ) ); ?>" src="<?php echo esc_attr( $lazy_placeholder_src ); ?>" data-src="<?php echo esc_attr( $attrs[0] ); ?>" width="<?php echo esc_attr( $attrs[1] ); ?>" height="<?php echo esc_attr( $attrs[2] ); ?>" <?php if ( $srcset ) : ?> data-srcset="<?php echo esc_attr( $srcset ); ?>" <?php endif; ?> <?php if ( $sizes ) : ?> data-sizes="<?php echo esc_attr( $sizes ); ?>" <?php endif; ?> alt="<?php echo esc_attr( $alt ); ?>" />
							<?php
						break;
					case 'image':
						?>
							<img class="<?php echo esc_attr( trim( $class_media ) ); ?>" src="<?php echo esc_attr( $lazy_placeholder_src ); ?>" data-src="<?php echo esc_attr( $attrs[0] ); ?>" width="<?php echo esc_attr( $attrs[1] ); ?>" height="<?php echo esc_attr( $attrs[2] ); ?>" <?php if ( $srcset ) : ?> data-srcset="<?php echo esc_attr( $srcset ); ?>" <?php endif; ?> <?php if ( $sizes ) : ?> data-sizes="<?php echo esc_attr( $sizes ); ?>" <?php endif; ?> alt="<?php echo esc_attr( $alt ); ?>"/>
							<?php
						break;
					case 'texture':
						?>
							<img class="<?php echo esc_attr( trim( $class_media ) ); ?>" src="<?php echo esc_attr( $attrs[0] ); ?>" data-src="<?php echo esc_attr( $attrs[0] ); ?>" width="<?php echo esc_attr( $attrs[1] ); ?>" height="<?php echo esc_attr( $attrs[2] ); ?>" <?php if ( $srcset ) : ?> srcset="<?php echo esc_attr( $srcset ); ?>" <?php endif; ?> <?php if ( $sizes ) : ?> sizes="<?php echo esc_attr( $sizes ); ?>" <?php endif; ?> alt="<?php echo esc_attr( $alt ); ?>"/>
							<?php
						break;
					case 'background-video':
						?>
							<video class="<?php echo esc_attr( trim( $class_media ) ); ?>" src="<?php echo esc_url( wp_get_attachment_url( $args['id'] ) ); ?>" playsinline loop muted autoplay></video>
							<?php
						break;
					case 'video':
						?>
							<video class="<?php echo esc_attr( trim( $class_media ) ); ?>" src="<?php echo esc_url( wp_get_attachment_url( $args['id'] ) ); ?>" playsinline loop muted autoplay></video>
							<?php
						break;
				}
				?>
			<?php if ( ! empty( $class_wrapper ) ) : ?>
				<?php if ( $args['mask'] ) : ?>
							<?php if ( $args['overlay'] ) : ?>
								<div class="overlay <?php echo esc_attr( trim( $class_overlay ) ); ?>"></div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ( array_key_exists( 'caption', $args ) && ! empty( $args['caption'] ) ) : ?>
				<?php
				if ( $args['caption'] === true ) {
					$caption = wp_get_attachment_caption( $args['id'] );
				} else {
					$caption = $args['caption'];
				}
				?>
				<div class="<?php echo esc_attr( $class_caption ); ?>"><?php echo esc_html( $caption ); ?></div>
			<?php endif; ?>
			<?php if ( $args['overlay'] && ! $args['mask'] ) : ?>
				<div class="overlay <?php echo esc_attr( trim( $class_overlay ) ); ?>"></div>
			<?php endif; ?>
		<?php if ( ! empty( $class_section ) || ! empty( $attrs_section ) ) : ?>
			</div>
		<?php endif; ?>
		<?php
	}
}
