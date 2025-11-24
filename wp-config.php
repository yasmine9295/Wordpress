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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '?6<jTsf|&prXJPrVwEvOiQmVvp42p0QtF1GK`Q$v[{g8`PYP9z!y7PnAn2wX2`8<' );
define( 'SECURE_AUTH_KEY',   'X>cZwa:ze6/ {3VPQaWd>Nyk0dZkqiy>~o]7]77Ci%%RMLhV,Yw)Ok&7Xm.%nZCZ' );
define( 'LOGGED_IN_KEY',     'qFJZPtj._eY@gdJ1!p<Yi[gg*U)BS&VCcW, Q@6<vXkyd^u,9_g@Rr44VbxZ] Gz' );
define( 'NONCE_KEY',         'ns82/ognxY5j4dD9%KI9w7W:]IZw$[?c7q~G] .C(-+YD+X|},0uKfeF;7^m&2U9' );
define( 'AUTH_SALT',         '3dDn~$q2)$5?1PR*`I<_!DgCu>?JwoXNlYXar~ b;`!@oS~izSbXI=G[(Z<Tzi(A' );
define( 'SECURE_AUTH_SALT',  'BxrFwC%:;tDICS1&c`I7m:SM_~=Eg1>6Hn,m0Z`xrVR>.C^6tMlvn~z?iSKky|v(' );
define( 'LOGGED_IN_SALT',    '7-:f9mcBk|/ku~-1)6M(rl3@UAr xNn=aqZ7FHDI}Ux8_}sVpXx{f-wT/HV%K$c>' );
define( 'NONCE_SALT',        'NGH2+[jb|1E$)5AJ}I1&?3!-Ps|TvHEej+:66S*T<TmI78GTopYGg[|^+|R^Kjb6' );
define( 'WP_CACHE_KEY_SALT', 'OPr.X:F4<xOv3kAg2Ui36%)?7/qTC{X25A;o{WGyOv8KL=@v/vCd{#10nO?|EvVD' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
