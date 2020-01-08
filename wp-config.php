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
define( 'DB_USER', 'wp-blog' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         ']~X[8rW_/*b|}x?t]NIjs27Y|!=h18>3V6{ C(n|kOl~e-,r{tU*?4?I93YU1kvO' );
define( 'SECURE_AUTH_KEY',  'N1wT-VOHbgwGC@s }D-KKwJv_2RNQ}LKJH;+e3K9au`v/OhpI;fG=R8Z~salO5kf' );
define( 'LOGGED_IN_KEY',    'Jf0)NJp+ 6Nbx(e)RAL=YsndJe%}Sb#WrvfM&cX]*io=E(P2Ye.G1G#U%_pc.Eo[' );
define( 'NONCE_KEY',        'D8iHG+-[(Hbs%2P^hPf%JFRCk17%)Q!9]]~9$*>pQ6,<.?o `mqAlA6!Xc(E c- ' );
define( 'AUTH_SALT',        'r<KHowZaP.rs^}&2k/)D1x}?9)vweEXb<l-!-=5w?,!E$GS:kqO0pBQqH?#kocNe' );
define( 'SECURE_AUTH_SALT', 'pjxU(0G[R3MJdvF)Up/nJhiZ WVP)-PzkW&l~&Naesy[zH|.n sDA>0FcGoSyLTb' );
define( 'LOGGED_IN_SALT',   'x.N|xLVj0,OI:u4@1D.?_hf*_k0gqZ{n(Kz8%)o7kEe=1H*sE0Zd+!R;9=-m{5eY' );
define( 'NONCE_SALT',       '(9(v}xanoHI)GM:8n9S%B2=oEp;sqM_Mbk lRp)uJ1wDxzJqjcDUEQ`*`]n/7o/R' );

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
