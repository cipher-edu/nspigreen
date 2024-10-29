<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( class_exists( 'Rhye_Core_Plugin_Update' ) ) {
	return;
}

class Rhye_Core_Plugin_Update {
	private $theme_id; // "my-theme-slug"
	private $plugin_id; // "my-plugin/my_plugin.php"
	private $icons; // icons set to appear on update-core.php page
	private $banners; // banners set to appear on update-core.php page
	private $endpoint;
	private $plugin_slug;
	private $license_key;
	private $remote_plugin_data;

	public function __construct(
		$args = array()
		) {
		$defaults = array(
			'theme_id'  => '',
			'plugin_id' => '',
			'endpoint'  => '',
			'icons'     => array(),
			'banners'   => array(),
		);

		$args = wp_parse_args( $args, $defaults );

		if ( ! $args['theme_id'] || ! $args['plugin_id'] || ! $args['endpoint'] ) {
			return;
		}

		$this->theme_id  = $args['theme_id'];
		$this->plugin_id = $args['plugin_id'];
		$this->endpoint  = esc_url( $args['endpoint'] );
		$this->icons     = $args['icons'];
		$this->banners   = $args['banners'];

		$this->license_key = get_option( "{$this->theme_id}_license_key" );

		$plugin_file       = trailingslashit( WP_PLUGIN_DIR ) . $this->plugin_id;
		$this->plugin_slug = dirname( plugin_basename( $plugin_file ) );

		add_filter( 'plugins_api', array( $this, 'set_remote_plugin_data' ), 99, 3 );
		add_filter( 'update_plugins_artemsemkin.com', array( $this, 'update_plugin' ), 99, 4 );
		add_action( 'update_option_' . $this->theme_id . '_license_key_status', array( $this, 'clear_plugin_update_data' ), 10, 2 );
		add_action( 'in_plugin_update_message-' . $this->plugin_id, array( $this, 'modify_plugin_update_message' ), 10, 2 );
	}

	private function get_remote_plugin_data() {
		if ( ! $this->remote_plugin_data ) {
			$this->remote_plugin_data = $this->fetch_remote_plugin_data();
		}

		return $this->remote_plugin_data;
	}

	public function set_remote_plugin_data( $res, $action, $args ) {
		if ( $action !== 'plugin_information' || empty( $args->slug ) || $args->slug !== $this->plugin_slug ) {
			return $res;
		}

		$remote_plugin_data = $this->get_remote_plugin_data();

		if ( ! $remote_plugin_data ) {
			return $res;
		}

		$res                 = new stdClass();
		$res->name           = $remote_plugin_data->name;
		$res->slug           = $remote_plugin_data->slug;
		$res->version        = $remote_plugin_data->version;
		$res->tested         = $remote_plugin_data->tested;
		$res->requires       = $remote_plugin_data->requires;
		$res->author         = $remote_plugin_data->author;
		$res->author_profile = $remote_plugin_data->author_profile;
		$res->donate_link    = $remote_plugin_data->donate_link;
		$res->homepage       = $remote_plugin_data->homepage;
		$res->download_link  = $remote_plugin_data->download_url;
		$res->trunk          = $remote_plugin_data->download_url;
		$res->requires_php   = $remote_plugin_data->requires_php;
		$res->last_updated   = $remote_plugin_data->last_updated;
		$res->sections       = $remote_plugin_data->sections;
		$res->rating         = $remote_plugin_data->rating;
		$res->num_ratings    = $remote_plugin_data->num_ratings;

		if ( is_array( $this->banners ) && ! empty( $this->banners ) ) {
			$res->banners = $this->banners;
		}

		return $res;
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

	public function update_plugin( $update, $plugin_data, $plugin_file, $locales ) {
		if ( $plugin_file !== $this->plugin_id || ! empty( $update ) ) {
			return $update;
		}

		$remote_plugin_data = $this->get_remote_plugin_data();

		if ( ! version_compare( $plugin_data['Version'], isset( $remote_plugin_data->version ) ? $remote_plugin_data->version : '', '<' ) ) {
			return $update;
		}

		$remote_plugin_data->new_version = $remote_plugin_data->version;
		$remote_plugin_data->package     = $remote_plugin_data->download_url;

		if ( is_array( $this->icons ) && ! empty( $this->icons ) ) {
			$remote_plugin_data->icons = $this->icons;
		}

		if ( is_array( $this->banners ) && ! empty( $this->banners ) ) {
			$remote_plugin_data->banners = $this->banners;
		}

		return $remote_plugin_data;
	}

	public function modify_plugin_update_message( $plugin_data ) {
		$no_package      = ! isset( $plugin_data['package'] ) || empty( $plugin_data['package'] );
		$new_version     = isset( $plugin_data['new_version'] ) ? $plugin_data['new_version'] : '';
		$current_version = isset( $plugin_data['Version'] ) ? $plugin_data['Version'] : '';

		if ( $no_package && version_compare( $current_version, $new_version, '<' ) ) {
			$purchase_url               = isset( $plugin_data['purchase_url'] ) ? $plugin_data['purchase_url'] : '';
			$message_template           = isset( $plugin_data['message'] ) ? $plugin_data['message'] : '';
			$message_theme_license_link = sprintf( '<a href="%1$s">%2$s</a>', admin_url( "admin.php?page={$this->theme_id}-license" ), esc_html__( 'Theme License', 'rhye' ) );
			$message_purchase_link      = $purchase_url ? sprintf( '<a href="%1$s" target="_blank" rel="nofollow">%2$s</a>', esc_url( $purchase_url ), esc_html__( 'Envato Market', 'rhye' ) ) : '';

			$output = $purchase_url ? sprintf( $message_template, $message_theme_license_link, $message_purchase_link ) : sprintf( $message_template, $message_theme_license_link );
			$output = '<br>' . $output;

			echo wp_kses_post( $output );
		}
	}

	public function clear_plugin_update_data() {
		wp_clean_plugins_cache( true );
	}
}
