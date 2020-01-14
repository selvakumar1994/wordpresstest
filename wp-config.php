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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_db' );

/** MySQL database username */
define( 'DB_USER', 'wp_user' );

/** MySQL database password */
define( 'DB_PASSWORD', 'password' );

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
define( 'AUTH_KEY',         '(RM) KMULt LnQPZ9PxKkWy84<m(Qc`iO`|4!HruDI{r`BgxYtKd7ig?u@-P[;HV' );
define( 'SECURE_AUTH_KEY',  'jz>miMKNG#~W}VLs!u5uF_z`8 >.lsRYNBI(s-NJqmmYk!w?2W<5g:1XCTt;g}c2' );
define( 'LOGGED_IN_KEY',    'nwq [ggyl1H^ARGXI$xRC3N<?Y:R<+B8*(o(<Xt UB)1r?%yTdnw.+4<baB_g#Fk' );
define( 'NONCE_KEY',        'U+K`l/+Z!3NXng5$rRrR~;`(AvUsLS!FpI/Uj>o#}gx_u99{sE[^>Fe,,CQb8T~F' );
define( 'AUTH_SALT',        'k2v5k5&t _%Ru7+,h.Q+S`0].yv/3ASM`W_2=ycE7zUmL3wv10W,^J`!jyS#{+_b' );
define( 'SECURE_AUTH_SALT', 'Dh4nS[vMhc ^>L?09p. ]ag$@^oEjurqp)e2mu3[YW3YFTqY9lIb;7zHxST%~d<r' );
define( 'LOGGED_IN_SALT',   '`PHI#8w7%q7t;nae*Xw8ey1KkCrNT;KOa80`U!?[/3F)5]i;RZ<H#;T}TV|*yPCC' );
define( 'NONCE_SALT',       '.-$?g+-BYvuak0hBy9ZCeh2I7/9Xcp%j~x D2##n-,B%-&B,73~EIOwM@#E@]dU9' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
