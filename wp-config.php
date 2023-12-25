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
define( 'DB_NAME', 'webbansach' );

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
define( 'AUTH_KEY',         'OfA3&@||_sxvtoEq!ZRXT?Y&9}~J IBc&/F);i-@CTcTO/o]E$xBm6p[.[yO|uA`' );
define( 'SECURE_AUTH_KEY',  '`/vGCB|q.GsKI|+Pf&KO]9HOR MdtJE0YZb?O6,xh/@?RoagiWP23+EjmwA{P7ol' );
define( 'LOGGED_IN_KEY',    'Zi^?s<^UiEaL:!i~Cw%tCGdj!oQ x%vs$!ZS*%kBpR=@a-83+o$=-B=06IO){iZ2' );
define( 'NONCE_KEY',        'g@OOu&kyVFBe)]3kG 5FhKct5%!HKnPp-()T2cuF9z]0=@WBq7 #A}n;)dW.C0Ej' );
define( 'AUTH_SALT',        '^7;+9.2@ALq*nTS&[]9^#*BDbI]s+Mwm.*Qqh*iZuWOIECoDm&nfd}e<1UwxtF$s' );
define( 'SECURE_AUTH_SALT', 'CTFbK>;7-RA`4}Pqcvsmog]s5It_DaXMI9W#&l~#?0(/=M5yJ61y|v{~aS);G:9j' );
define( 'LOGGED_IN_SALT',   '52Sb%)1*E>94ah)R(g9B&m#iBZ<|d5B`Nk}4>3aNW?Tb#?9%we[H5gJV~#48}~Zo' );
define( 'NONCE_SALT',       'APEF!@,2ji#/?#BQ[xT6b>?$=Ekh !xmN9Z>jBiY!A(@W{~L<s=nfuqA!mD>){|l' );

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
