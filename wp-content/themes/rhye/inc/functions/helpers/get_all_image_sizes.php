<?php
/**
 * Get all the registered image sizes along
 * with their formatted names
 *
 * @return array $image_sizes The image sizes
 */
function arts_get_all_image_sizes() {
	$image_sizes = get_intermediate_image_sizes();
	$formatted_sizes = [];
	$image_sizes[] = 'full'; // original image size

	if ($image_sizes) {
		foreach ($image_sizes as $size) {
			$formatted_sizes[ $size ] = ucwords( str_replace( '_', ' ', $size ) );
		}
	}

	return $formatted_sizes;
}
