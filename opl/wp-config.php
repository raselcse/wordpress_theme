<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'oployeelabs');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '23tt^|nuVWM[I+`>sA,ewUK7gB$;1?p$yF_(d1om(vHk$),l7lT/Sv6@4=LJ$P$H');
define('SECURE_AUTH_KEY',  ')A=o.DnQer$3BNu50*X$}MS-D7)iLk[:h#Ac-c)4LUy8~72Qt6$!Z9.gJ57&$R[E');
define('LOGGED_IN_KEY',    '6_&|TEd+>WiJI`lZfcPD@X+_>pbG|9rk?R`x{%F^0Wl?N1G-ly/x{B(@Ucw^CF2?');
define('NONCE_KEY',        '.l6?caG+z+5pjk&[-]|/GjfCjtar=O{!^B,+BTG[F}DJzcg]OkYm.~duV(1!i,od');
define('AUTH_SALT',        'B8 }*Ph|VOjzj#b?cG!S?[$i=?C~h!I!)M[hZ+OgmQ>0l+n]{+Iuf3vG{AWh=x+=');
define('SECURE_AUTH_SALT', 'IC5=j`hv/bp|g0/L}ScgcW&]E?ADBe{ruZ;Qozj7JPU2!Mi:->EDcZ*[tfs}p|dH');
define('LOGGED_IN_SALT',   'F5>YhW,Hh7Sh[@7Y*l:RjB %:  rc+tRsXj!oUT)JNg/n)c-1Jg&KX!o_mE?Ho++');
define('NONCE_SALT',       '6klc}9w$]9kHmu|>gs)i=wB4PaF;<iQNjb9%>`;dWe74wl>KfQ%=81TX:g!uYRQS');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
