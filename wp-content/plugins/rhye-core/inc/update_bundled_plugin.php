<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( class_exists( 'Arts_Bundled_Plugins_Update' ) ) {
	return;
}

class Arts_Bundled_Plugins_Update {
	private $theme_id; // "my-theme-slug"
	private $plugin_id; // "my-plugin/my_plugin.php"
	private $endpoint;
	private $license_key;
	private $license_key_status;
	private $remote_plugin_data;

	public function __construct(
		$args = array()
		) {
		$defaults = array(
			'theme_id'  => '',
			'plugin_id' => '',
			'endpoint'  => '',
		);

		$args = wp_parse_args( $args, $defaults );

		if ( ! $args['theme_id'] || ! $args['plugin_id'] || ! $args['endpoint'] ) {
			return;
		}

		$this->theme_id  = $args['theme_id'];
		$this->plugin_id = $args['plugin_id'];
		$this->endpoint  = $args['endpoint'];

		$this->license_key        = get_option( "{$this->theme_id}_license_key" );
		$this->license_key_status = get_option( "{$this->theme_id}_license_key_status" );

		if ( $this->license_key && $this->license_key_status === 'valid' ) {
			add_action( 'admin_init', array( $this, 'remove_update_message' ) );
		}

		add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'modify_plugins_transient' ), 99, 1 );
	}

	private function get_remote_plugin_data() {
		if ( ! $this->remote_plugin_data ) {
			$this->remote_plugin_data = $this->fetch_remote_plugin_data();
		}

		return $this->remote_plugin_data;
	}

	public function modify_plugins_transient( $transient ) {
		if ( isset( $transient->response[ $this->plugin_id ] ) && empty( $transient->response[ $this->plugin_id ]->package ) ) {
			$remote_plugin_data = $this->get_remote_plugin_data();

			if ( ! empty( $remote_plugin_data->download_url ) ) {
				$transient->response[ $this->plugin_id ]->package = $remote_plugin_data->download_url;
				$this->remove_update_message();
			}
		}

		return $transient;
	}

	public function remove_update_message() {
		remove_all_actions( 'in_plugin_update_message-' . $this->plugin_id );
	}

	public function fetch_remote_plugin_data() {
		$args = array(
			'body' => array(
				'url' => esc_url( home_url( '/' ) ),
				'key' => rawurlencode( $this->license_key ),
			),
		);

		$request = wp_remote_post( $this->endpoint, $args );

		if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
			$response = (object) json_decode( stripslashes( $request['body'] ), true );

			return $response;
		}
	}
}
