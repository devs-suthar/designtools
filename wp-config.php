<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'designtools-db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '6Q#6Rh)M1CF0[gq&Nmdn^[aDo0`svJqI&OdRTJ@r8yBCWD|3Ah=0NkLp}+?3_&!_' );
define( 'SECURE_AUTH_KEY',  '8kB1Rp^E=vaiz[+9OrwwbPKTs^0u6nnQ[{tAxJd1+M/|u6N~C>e*C/#C(LE5fD<F' );
define( 'LOGGED_IN_KEY',    '#D>N+nLf#|mMH/H0BA3gH=OgL49dY)+B@)Z QEv,d9{Ytyu/[3R{9-b`n2*2 UwT' );
define( 'NONCE_KEY',        '7{;rFD<dhe~LV40kt(I:fGY,Xhluhc>nJPiLd4I?WBXDV]*o[~IHf7<v%iA<{}*K' );
define( 'AUTH_SALT',        '6A2Zo2DIPWdb4[?,bb0N)3epzN7n8Eu1*N8UwO*izPC$-N1%6g8V>alGpAYKwYm1' );
define( 'SECURE_AUTH_SALT', 'ovaH/kbsA{h|3XtMFuk|C?0P5SrK?$vl&:d3yhxPGMGRu5vc$}O,Va-lULCah<4j' );
define( 'LOGGED_IN_SALT',   '; OX[!aip?Nai^`xB{%&kH99_ax-_gWWd9}2^#;xaGQA4iwa-rcT%/P!F]e%qFP5' );
define( 'NONCE_SALT',       '%9bK{A.Z>&R75e27_4X}_KTW&5dBFzg@bc4{t4)ycq(1Cb%1s;A5#6/VQ~+KXn_]' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
