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
define( 'DB_NAME', 'demotesting' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'F=6Ayr(5tj{O+LMe(?`g{Jwx?m]&@yw)0RztE6G>%Nj)!55EL($*T5a[ 17[Ko-m' );
define( 'SECURE_AUTH_KEY',  'y0|g *>6D1;~4Bxz^6Jr}<sc{kMMSkai]P5h,V2W[/Cc$4H&W_Ei79Tymv<y|Ur+' );
define( 'LOGGED_IN_KEY',    ')V,a:u=<3)KGua-fgJeS;*>J:AW588Gu5]SW#?XL,E-xvIZC@vJgs:5BwA};Sm^_' );
define( 'NONCE_KEY',        '-#+>w..OUL;M;{uJ?(~Hfb/cFvUyJy_O$Hd)NCd$]&1[NV)]6|L*Snrz?/y7NCri' );
define( 'AUTH_SALT',        'cydPts$wj={D}Rx:.{D3{;;#zMdjpGSUC),`=5QbomC`#!Xz!z9h;|j v6_-(($<' );
define( 'SECURE_AUTH_SALT', '6UQ/;qNb#(%2:.=t{[V#!k:Ln}Jftisrq0aV-Q/!pK&]9/Wt0}Np@JTpF=fl/,=J' );
define( 'LOGGED_IN_SALT',   'Je$s;waW;_4*:gw<pp@He)[=Qc:PMkB:b40f|AuwBN![Of-BFiRXY=*;0]+_ 2gK' );
define( 'NONCE_SALT',       '?>i)JpO-WT~HFuviN004r-6H}g$n5Zb8&:(S*4FRC3P]9|h,KFBewZEMaE-CN}]-' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define('FS_METHOD','direct'); 
/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
