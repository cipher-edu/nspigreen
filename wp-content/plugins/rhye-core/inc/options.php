<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rhye_Options_Page {
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct() {
			add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
			add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	/**
	 * Add options page
	 */
	public function add_plugin_page() {
			// This page will be under "Settings"
			add_options_page(
				'Google Maps',
				'Google Maps',
				'manage_options',
				'arts-setting-gmap',
				array( $this, 'create_admin_page' )
			);
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page() {
			// Set class property
			$this->options = get_option( 'arts_gmap' );
		?>
			<div class="wrap">
					<h1><?php esc_html_e( 'Google Maps', 'rhye' ); ?></h1>
					<form method="post" action="options.php">
					<?php
							// This prints out all hidden setting fields
							settings_fields( 'arts_options_gmap' );
							do_settings_sections( 'arts_setting_gmap' );
							submit_button();
					?>
					</form>
			</div>
			<?php
	}

	/**
	 * Register and add settings
	 */
	public function page_init() {
			register_setting(
				'arts_options_gmap', // Option group
				'arts_gmap', // Option name
				array( $this, 'sanitize' ) // Sanitize
			);

			add_settings_section(
				'arts_setting_section_gmap_api', // ID
				'API', // Title
				array( $this, 'print_section_info' ), // Callback
				'arts_setting_gmap' // Page
			);

			add_settings_field(
				'key',
				esc_html__( 'Key', 'rhye' ),
				array( $this, 'key_callback' ),
				'arts_setting_gmap',
				'arts_setting_section_gmap_api'
			);
	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input ) {
			$new_input = array();

		if ( isset( $input['key'] ) ) {
				$new_input['key'] = sanitize_text_field( $input['key'] );
		}

			return $new_input;
	}

	/**
	 * Print the Section text
	 */
	public function print_section_info() {
		printf(
			'<p>%1$s <a href="https://developers.google.com/maps/documentation/javascript/tutorial#api-key-billing-errors" target="_blank">%2$s</a></p><p>%3$s</p>',
			esc_html__( 'To make Google Maps widget work properly in Rhye Theme you need to obtain', 'rhye' ),
			esc_html__( 'an API key from Google first.', 'rhye' ),
			esc_html__( 'If you already have a valid API key please enter it here', 'rhye' )
		);
	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function key_callback() {
			printf(
				'<input class="regular-text" type="text" id="title" name="arts_gmap[key]" value="%s" />',
				isset( $this->options['key'] ) ? esc_attr( $this->options['key'] ) : ''
			);
	}

}

if ( is_admin() ) {
	new Rhye_Options_Page();
}
