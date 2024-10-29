<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Rhye Elementor Extension
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Rhye_Elementor_Extension {
	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Rhye_Elementor_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Rhye_Elementor_Extension An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		// Add Plugin actions
		add_action( 'elementor/elements/categories_registered', array( $this, 'add_elementor_widget_categories' ) );
		add_action( 'elementor/widgets/register', array( $this, 'init_widgets' ) );

		// Add WPML's Translation Management Support
		if ( class_exists( 'SitePress' ) ) {
			add_action( 'init', array( $this, 'add_widgets_wpml_support' ) );
		}
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'rhye' ),
			'<strong>' . esc_html__( 'Rhye Elementor Extension', 'rhye' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'rhye' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'rhye' ),
			'<strong>' . esc_html__( 'Rhye Elementor Extension', 'rhye' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'rhye' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'rhye' ),
			'<strong>' . esc_html__( 'Rhye Elementor Extension', 'rhye' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'rhye' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-error is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Register Custom Widget Categories
	 *
	 * @return void
	 */
	public function add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'rhye-static',
			array(
				'title' => esc_html__( 'Rhye Static Widgets', 'rhye' ),
				'icon'  => 'eicon-plug',
			)
		);

		$elements_manager->add_category(
			'rhye-dynamic',
			array(
				'title' => esc_html__( 'Rhye Dynamic Widgets', 'rhye' ),
				'icon'  => 'eicon-sitemap',
			)
		);
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function include_widgets_files() {
		// Custom Base Widget
		require_once __DIR__ . '/widgets/rhye-widget-base.php';

		// Dynamic Widgets Require
		require_once __DIR__ . '/widgets/dynamic/albums-covers-list.php';
		require_once __DIR__ . '/widgets/dynamic/albums-covers-slider.php';
		require_once __DIR__ . '/widgets/dynamic/albums-mouse-hover-reveal.php';
		require_once __DIR__ . '/widgets/dynamic/portfolio-fullscreen-slider.php';
		require_once __DIR__ . '/widgets/dynamic/portfolio-halfscreen-slider.php';
		require_once __DIR__ . '/widgets/dynamic/portfolio-irregular-grid.php';
		require_once __DIR__ . '/widgets/dynamic/portfolio-masonry-grid.php';
		require_once __DIR__ . '/widgets/dynamic/portfolio-mouse-hover-reveal.php';
		require_once __DIR__ . '/widgets/dynamic/portfolio-reveal-background-slider.php';
		require_once __DIR__ . '/widgets/dynamic/services-content-block.php';
		require_once __DIR__ . '/widgets/dynamic/services-grid.php';
		require_once __DIR__ . '/widgets/dynamic/services-slider.php';

		// Static Widgets Require
		require_once __DIR__ . '/widgets/static/button.php';
		require_once __DIR__ . '/widgets/static/circle-button.php';
		require_once __DIR__ . '/widgets/static/content-block.php';
		require_once __DIR__ . '/widgets/static/counters.php';
		require_once __DIR__ . '/widgets/static/feature.php';
		require_once __DIR__ . '/widgets/static/google-map.php';
		require_once __DIR__ . '/widgets/static/image-mouse-hover-reveal.php';
		require_once __DIR__ . '/widgets/static/lightbox-video.php';
		require_once __DIR__ . '/widgets/static/logo-description.php';
		require_once __DIR__ . '/widgets/static/masonry-grid.php';
		require_once __DIR__ . '/widgets/static/parallax-background.php';
		require_once __DIR__ . '/widgets/static/project-properties.php';
		require_once __DIR__ . '/widgets/static/scroll-down.php';
		require_once __DIR__ . '/widgets/static/slider-images.php';
		require_once __DIR__ . '/widgets/static/slider-testimonials.php';
		require_once __DIR__ . '/widgets/static/team-member.php';
	}

	/**
	 * WPML compatibility classes
	 *
	 * Include files with WPML compatability classes
	 * for widgets with repeater translatable fields
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function include_wpml_files() {
		require_once __DIR__ . '/widgets/compatibility/wpml-albums-covers-list.php';
		require_once __DIR__ . '/widgets/compatibility/wpml-albums-covers-slider.php';
		require_once __DIR__ . '/widgets/compatibility/wpml-albums-mouse-hover-reveal.php';
		require_once __DIR__ . '/widgets/compatibility/wpml-counters.php';
		require_once __DIR__ . '/widgets/compatibility/wpml-google-map.php';
		require_once __DIR__ . '/widgets/compatibility/wpml-image-mouse-hover-reveal.php';
		require_once __DIR__ . '/widgets/compatibility/wpml-portfolio-fullscreen-slider.php';
		require_once __DIR__ . '/widgets/compatibility/wpml-portfolio-halfscreen-slider.php';
		require_once __DIR__ . '/widgets/compatibility/wpml-portfolio-mouse-hover-reveal.php';
		require_once __DIR__ . '/widgets/compatibility/wpml-portfolio-reveal-background-slider.php';
		require_once __DIR__ . '/widgets/compatibility/wpml-project-properties.php';
		require_once __DIR__ . '/widgets/compatibility/wpml-slider-testimonials.php';
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {
		$this->include_widgets_files();

		// Dynamic Widgets Init
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Albums_Covers_List::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Albums_Covers_Slider::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Albums_Mouse_Hover_Reveal::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Portfolio_Fullscreen_Slider::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Portfolio_Halfscreen_Slider::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Portfolio_Irregular_Grid::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Portfolio_Masonry_Grid::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Portfolio_Mouse_Hover_Reveal::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Portfolio_Reveal_Background_Slider::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Services_Content_Block::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Services_Grid::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Services_Slider::instance() );

		// Static Widgets Init
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Button::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Circle_Button::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Content_Block::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Counters::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Feature::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Google_Map::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Image_Mouse_Hover_Reveal::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Lightbox_Video::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Logo_Description::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Masonry_Grid::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Parallax_Background::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Project_Properties::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Scroll_Down::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Slider_Images::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Slider_Testimonials::instance() );
		\Elementor\Plugin::instance()->widgets_manager->register( \Elementor\Rhye_Widget_Team_Member::instance() );
	}

	/**
	 * WPML support
	 *
	 * Get widget translatable fields
	 * that will appear in WPML Translation backend
	 *
	 * @since 1.0.0
	 * @access private
	 */
	public function add_widgets_wpml_support() {
		$this->include_wpml_files();
		$this->include_widgets_files();

		// Dynamic Widgets Translation
		\Elementor\Rhye_Widget_Albums_Covers_List::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Albums_Covers_Slider::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Portfolio_Fullscreen_Slider::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Portfolio_Halfscreen_Slider::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Portfolio_Irregular_Grid::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Portfolio_Masonry_Grid::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Portfolio_Mouse_Hover_Reveal::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Portfolio_Reveal_Background_Slider::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Services_Content_Block::instance()->add_wpml_support();

		// Static Widgets Translation
		\Elementor\Rhye_Widget_Button::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Circle_Button::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Content_Block::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Counters::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Feature::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Google_Map::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Image_Mouse_Hover_Reveal::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Lightbox_Video::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Logo_Description::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Project_Properties::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Scroll_Down::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Slider_Testimonials::instance()->add_wpml_support();
		\Elementor\Rhye_Widget_Team_Member::instance()->add_wpml_support();
	}
}
Rhye_Elementor_Extension::instance();
