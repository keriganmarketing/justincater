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
///** The name of the database for WordPress */
//define('DB_NAME', 'justinca_dev');

///** MySQL database username */
//define('DB_USER', 'justinca_usr');
//
///** MySQL database password */
//define('DB_PASSWORD', '[.DZrfhkaL?9gJ}#7X');
//
///** MySQL hostname */
//define('DB_HOST', '216.119.142.71');

/** The name of the database for WordPress */
define('DB_NAME', 'dev_justincater');

/** MySQL database username */
define('DB_USER', 'justincater');

/** MySQL database password */
define('DB_PASSWORD', 'LODsi3NVHkbwNuyB');

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
define('AUTH_KEY',         'gJ~eT#)uYH][-+cTMcKLVH<Z!jvwfS(%z-M#7g<-=t<Z@;Qsi+u&nbCm!bLgpR]`');
define('SECURE_AUTH_KEY',  '.t$dbeYY J2}~Y{Z|%+2<JF4--zZe$a]^tW.N88 *${yyi=uOKWajO>d}|s<kKrD');
define('LOGGED_IN_KEY',    ' x#Eedy5n15~~=_`|&ByB-w$x4o}&,^Yj+nf#^,>DQ&8l<-}4<(#pyjxu?2ZS3h*');
define('NONCE_KEY',        ')5|R`5MD2u^}JJD4.K&dnQ*a4pR)dRG|i=#]dB-|>@scVVR)=+Knk9e DH07V/&8');
define('AUTH_SALT',        'sz0s-[oJJ1P3Jl-PGo;No>[R,xWF]d yw6|-_^fzql7QP5mo0Xrl_hPZA_gbX?PD');
define('SECURE_AUTH_SALT', 'Sy@|MAed<!, u>WU/Kbhry%Zt708v^b<b@q=[tW_(N-PdY^S*?S@yi9-HX-1SHl]');
define('LOGGED_IN_SALT',   'B4NsIa>B9|LR+91<r{@b=q;KY.ninuu)J]=u-=I@t,%R_+0vu~oH-!|+7/BT]3a ');
define('NONCE_SALT',       'SPk_RGRo(?Df*hc+3|O+D>F+K}.,z-yJq@:muBoh(pME =rI9mH(8!d7,UWMG.l9');


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
