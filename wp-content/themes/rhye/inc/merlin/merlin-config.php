<?php

/**
 * Merlin WP configuration file
 */

$wizard      = new Merlin(
	$config  = array(
		'directory'            => 'inc/merlin', // Location / directory where Merlin WP is placed in your theme.
		'merlin_url'           => 'merlin', // The wp-admin page slug where Merlin WP loads.
		'parent_slug'          => 'themes.php', // The wp-admin parent page slug for the admin menu item.
		'capability'           => 'manage_options', // The capability required for this menu to be displayed to the user.
		'child_action_btn_url' => 'https://codex.wordpress.org/child_themes', // URL for the 'child-action-link'.
		'dev_mode'             => false, // Enable development mode for testing.
		'license_step'         => false, // EDD license activation step.
		'license_required'     => false, // Require the license activation step.
		'license_help_url'     => '', // URL for the 'license-tooltip'.
		'edd_remote_api_url'   => '', // EDD_Theme_Updater_Admin remote_api_url.
		'edd_item_name'        => '', // EDD_Theme_Updater_Admin item_name.
		'edd_theme_slug'       => '', // EDD_Theme_Updater_Admin item_slug.
		'ready_big_button_url' => '', // Link for the big button on the ready step.
	),
	$strings = array(
		'admin-menu'               => esc_html__( 'Theme Setup', 'rhye' ),
		/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
		'title%s%s%s%s'            => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'rhye' ),
		'return-to-dashboard'      => esc_html__( 'Return to the dashboard', 'rhye' ),
		'ignore'                   => esc_html__( 'Disable this wizard', 'rhye' ),
		'btn-skip'                 => esc_html__( 'Skip', 'rhye' ),
		'btn-next'                 => esc_html__( 'Next', 'rhye' ),
		'btn-start'                => esc_html__( 'Start', 'rhye' ),
		'btn-no'                   => esc_html__( 'Cancel', 'rhye' ),
		'btn-plugins-install'      => esc_html__( 'Install', 'rhye' ),
		'btn-child-install'        => esc_html__( 'Install', 'rhye' ),
		'btn-content-install'      => esc_html__( 'Install', 'rhye' ),
		'btn-import'               => esc_html__( 'Import', 'rhye' ),
		'btn-license-activate'     => esc_html__( 'Activate', 'rhye' ),
		'btn-license-skip'         => esc_html__( 'Later', 'rhye' ),
		/* translators: Theme Name */
		'license-header%s'         => esc_html__( 'Activate %s', 'rhye' ),
		/* translators: Theme Name */
		'license-header-success%s' => esc_html__( '%s is Activated', 'rhye' ),
		/* translators: Theme Name */
		'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'rhye' ),
		'license-label'            => esc_html__( 'License key', 'rhye' ),
		'license-success%s'        => esc_html__( 'The theme is already registered, so you can go to the next step!', 'rhye' ),
		'license-json-success%s'   => esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'rhye' ),
		'license-tooltip'          => esc_html__( 'Need help?', 'rhye' ),
		/* translators: Theme Name */
		'welcome-header%s'         => esc_html__( 'Welcome to %s', 'rhye' ),
		'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'rhye' ),
		'welcome%s'                => esc_html__( 'This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'rhye' ),
		'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'rhye' ),
		'child-header'             => esc_html__( 'Install Child Theme', 'rhye' ),
		'child-header-success'     => esc_html__( 'You\'re good to go!', 'rhye' ),
		'child'                    => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'rhye' ),
		'child-success%s'          => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'rhye' ),
		'child-action-link'        => esc_html__( 'Learn about child themes', 'rhye' ),
		'child-json-success%s'     => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'rhye' ),
		'child-json-already%s'     => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'rhye' ),
		'plugins-header'           => esc_html__( 'Install Plugins', 'rhye' ),
		'plugins-header-success'   => esc_html__( 'You\'re up to speed!', 'rhye' ),
		'plugins'                  => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'rhye' ),
		'plugins-success%s'        => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'rhye' ),
		'plugins-action-link'      => esc_html__( 'Advanced', 'rhye' ),
		'import-header'            => esc_html__( 'Import Content', 'rhye' ),
		'import'                   => esc_html__( 'Let\'s import content to your website, to help you get familiar with the theme.', 'rhye' ),
		'import-action-link'       => esc_html__( 'Advanced', 'rhye' ),
		'ready-header'             => esc_html__( 'All done. Have fun!', 'rhye' ),
		/* translators: Theme Author */
		'ready%s'                  => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'rhye' ),
		'ready-action-link'        => esc_html__( 'Extras', 'rhye' ),
		'ready-big-button'         => esc_html__( 'View your website', 'rhye' ),
		'ready-link-1'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://wordpress.org/support/', esc_html__( 'Explore WordPress', 'rhye' ) ),
		'ready-link-2'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://themeforest.net/user/artemsemkin', esc_html__( 'Get Theme Support', 'rhye' ) ),
		'ready-link-3'             => sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'customize.php' ), esc_html__( 'Start Customizing', 'rhye' ) ),
	)
);
