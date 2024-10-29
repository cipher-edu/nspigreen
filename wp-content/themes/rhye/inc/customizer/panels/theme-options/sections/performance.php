<?php

$priority = 1;

Kirki::add_field(
	'arts', array(
		'type'            => 'switch',
		'settings'        => 'offscreen_canvas_enabled',
		'label'           => esc_html__( 'Enable offscreen canvas rendering for WebGL sections', 'rhye' ),
		'description'     => sprintf(
			'%1s<br><br>%2s <a href="https://caniuse.com/offscreencanvas" target="_blank">%3s</a>',
			esc_html__( 'Render WebGL scenes on a separate CPU thread. This should improve the overall performance and page loading speed for the browsers with OffscreenCanvas enabled feature.', 'rhye' ),
			esc_html__( 'If a browser doesn\'t support OffscreenCanvas then it will fallback to the normal WebGL rendering.', 'rhye' ),
			esc_html__( 'Learn more', 'rhye' )
		),
		'section'         => 'performance',
		'default'         => false,
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'assets_loading_mode',
				'operator' => '==',
				'value'    => 'async',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'performance_generic_divider' . $priority,
		'section'  => 'performance',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'switch',
		'settings'    => 'high_performance_gpu_enabled',
		'label'       => esc_html__( 'Prefer High-Performance GPU', 'rhye' ),
		'description' => esc_html__( 'Tell desktop browsers to use high-performance GPU on dual GPU systems for the website rendering. Doesn\'t have an effect on touch devices.', 'rhye' ),
		'section'     => 'performance',
		'default'     => true,
		'priority'    => $priority++,
	)
);

Kirki::add_field(
	'arts', array(
		'type'     => 'generic',
		'settings' => 'performance_generic_divider' . $priority,
		'section'  => 'performance',
		'priority' => $priority++,
		'choices'  => array(
			'element' => 'hr',
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'switch',
		'settings'    => 'full_size_images_enabled',
		'label'       => esc_html__( 'Force Load Full Size Images', 'rhye' ),
		'description' => esc_html__( 'Always use the original images uploaded to media library and don\'t use the WordPress generated thumbnails.', 'rhye' ),
		'section'     => 'performance',
		'default'     => false,
		'priority'    => $priority++,
	)
);

Kirki::add_field(
	'arts', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'lazy_placeholder_type',
		'label'       => esc_html__( 'Lazy Placeholder', 'rhye' ),
		'description' => esc_html__( 'Temporary lightweight image that appears before a lazy image is fully loaded.', 'rhye' ),
		'section'     => 'performance',
		'default'     => 'inline',
		'priority'    => $priority++,
		'choices'     => array(
			'inline'       => esc_html__( 'Inline Source', 'rhye' ),
			'custom_image' => esc_html__( 'Custom Image', 'rhye' ),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'textarea',
		'settings'        => 'lazy_placeholder_inline',
		'description'     => esc_html__( 'Base64 encoded image or external URL that will be appended to <img src="..."> attribute.', 'rhye' ),
		'section'         => 'performance',
		'default'         => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAHCGzyUAAAABGdBTUEAALGPC/xhBQAAADhlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAAqACAAQAAAABAAAAAaADAAQAAAABAAAAAQAAAADa6r/EAAAAC0lEQVQI12NolQQAASYAn89qhTcAAAAASUVORK5CYII=',
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'lazy_placeholder_type',
				'operator' => '==',
				'value'    => 'inline',
			),
		),
	)
);

Kirki::add_field(
	'arts', array(
		'type'            => 'image',
		'settings'        => 'lazy_placeholder_image_url',
		'section'         => 'performance',
		'default'         => '',
		'priority'        => $priority++,
		'active_callback' => array(
			array(
				'setting'  => 'lazy_placeholder_type',
				'operator' => '==',
				'value'    => 'custom_image',
			),
		),
	)
);
