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
define('DB_NAME', 'dodoum');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '`J~-uy,=+i?m]h;pz_.gwL%R]f`Nr0 P]*oKf6|X3_aeltGFwjVGW|kNHZG5IowP');
define('SECURE_AUTH_KEY',  'oY#TS9cnC}PgF1p^qM],5ChBLkiRwjH7i5+=h~I-[5UKqVN<jJ1uIp!Z]6;.CE(f');
define('LOGGED_IN_KEY',    'EGQXo=6V<77g:>9pEX75>Yw_a-w~2/;Z5%[<2ZWjrpDRBJ,s]#@c6]3&Hr8Q%<&X');
define('NONCE_KEY',        'im+91naZ$!gZ(qg.q8S~37<Zd_^c,COU`!T/-Dsj9iO=25FUj5 (cy;On/u?w(h_');
define('AUTH_SALT',        '^>z+z+)kVG^,9$14((B~r]<TFqNN:UW,?+c!f@R#(t}K%`]NcsnrZR7%V{5$qWsM');
define('SECURE_AUTH_SALT', '&sr#PU.AVF(>$H/(uIy(gL5g(M?;S9k7#sQGMgY(mlhO$,9L}c6?]l[bjcDKhZCG');
define('LOGGED_IN_SALT',   'JE]4wWsV igOi&[3tW>`CcurQbc$>C87 MK?vdN0I!8f.i16a%DH7)>!tp Yl/3u');
define('NONCE_SALT',       '49wb&/^aew|KY}Pb9[}(r$NB0Am:IL}O)riJ*iSOmP{RN)SoIc=od`5{Qx;fk.QH');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
