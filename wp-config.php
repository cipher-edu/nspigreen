<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ciphered_wp981' );

/** Database username */
define( 'DB_USER', 'ciphered_wp981' );

/** Database password */
define( 'DB_PASSWORD', '@po0BS(15u' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '2exavb3lxot6yxalxc2vh13igtz764t7naudbtdzczeurdbuoac0ekeqjiakxyhh' );
define( 'SECURE_AUTH_KEY',  '07441wkrbsef9mds8sqmt5dc2l7tvjlapuct36hb3lflmk0fwkxl3h5jlstyo6z2' );
define( 'LOGGED_IN_KEY',    '8w9kw25uzl1uinyozuh1zobyqec6byr9ihqvsonuqviuijbqjzvckilfo3yoik7o' );
define( 'NONCE_KEY',        'mikrbmjrgsk7rkvriiyiz1k4gxfdkqslhkch47bdl72c0gor07r4f5ztmcskv2fb' );
define( 'AUTH_SALT',        'mlz7jixkwmawisp7afpriowqiolhzkkvh2dkfmmwx5oxcce8vnt4hodbyedc9ure' );
define( 'SECURE_AUTH_SALT', 'lok8zylbga5gsgc9idw5ogiolnivpmunen0vpfhyo7ciu8z8hx0cfx0vxcjiqjcz' );
define( 'LOGGED_IN_SALT',   'wytm0dcgwu86vbs8u0hpjwyal6fbxdxegaqlfv7mgctjxnfatf2lfdlrcyytbwye' );
define( 'NONCE_SALT',       'tpqdtxiyyhm6suusxuob2bmw5zorn03wonsbw2vmcl62114og7gpcsvnsf3mssem' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpai_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
