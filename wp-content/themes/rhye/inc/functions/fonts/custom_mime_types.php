<?php

/**
 * Adds fonts filetypes to allowed mimes
 *
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/upload_mimes
 *
 * @param array $mimes Mime types keyed by the file extension regex corresponding to
 *                     those types. 'swf' and 'exe' removed from full list. 'htm|html' also
 *                     removed depending on '$user' capabilities.
 *
 * @return array
 */
add_filter( 'upload_mimes', 'arts_custom_mime_types', 60 );
function arts_custom_mime_types( $mime_types ) {

	$mime_types['woff']  = 'font/woff|application/font-woff|application/x-font-woff|application/octet-stream';
	$mime_types['woff2'] = 'font/woff2|application/octet-stream|font/x-woff2';

	return $mime_types;
}

/**
 * Sets the extension and mime types
 *
 * @param array  $wp_check_filetype_and_ext File data array containing 'ext', 'type', and
 *                                          'proper_filename' keys.
 * @param string $file                      Full path to the file.
 * @param string $filename                  The name of the file (may differ from $file due to
 *                                          $file being in a tmp directory).
 * @param array  $mimes                     Key is the file extension with value as the mime type.
 */
add_filter( 'wp_check_filetype_and_ext', 'arts_custom_file_ext', 10, 4 );
function arts_custom_file_ext( $types, $file, $filename, $mimes ) {

	if ( false !== strpos( $filename, '.woff' ) ) {
		$types['ext']  = 'woff';
		$types['type'] = 'font/woff|application/font-woff|application/x-font-woff|application/octet-stream';
	}

	if ( false !== strpos( $filename, '.woff2' ) ) {
		$types['ext']  = 'woff2';
		$types['type'] = 'font/woff2|application/octet-stream|font/x-woff2';
	}

	return $types;
}
