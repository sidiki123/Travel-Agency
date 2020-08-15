<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'test' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'H[RJxx{HJC)bYiz/c[W^~iam9Jw)i`T=^79g1]9wnI0}k1c|zAgVQ_-v.Y|13^1r' );
define( 'SECURE_AUTH_KEY',  'Qg~k$7CMsto4$x$0K^RTyK,V4Pc7~Rq-;N,Kl@!c4:^]<qmFb~9RCeV}SwCw-!k~' );
define( 'LOGGED_IN_KEY',    '^~_4<V/3UO,m-<#@aOW3g_1P,)8yO`kesdVvUPw6YndB+8X^)tG~P$0n<L9|$?U4' );
define( 'NONCE_KEY',        'u5lkM>jT 4o`e &&p#{sFsuD*YFGe~vOPVvSK[L|B;^k`Q@6VD{v[98e1/?fRFT~' );
define( 'AUTH_SALT',        '?Vb66H+byx} |]C9/3 3!HC!slk2!jb (v-Ty?T:/78Qw=&?xPQ6G?k&PDOk=Ctg' );
define( 'SECURE_AUTH_SALT', '*rbvAKLUGb1:iFJhqTJ$+cWGzfEx_;t,LqEpZt8|nMv%Q?o!0V.b6frGHJg.HcTY' );
define( 'LOGGED_IN_SALT',   '5NVM?0rKN*.l|/cgt6i}C1b6JUwNdHiey?sGlkjgmZA/<to)&9Vhe[X#&(@WRpt~' );
define( 'NONCE_SALT',       '_{C=<}{H3wkJ4S0[2.R:rV%e&BWO9IgnF@n0jd:u+Dy._W(gt6x6b<Pk-b!Vv)yB' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
