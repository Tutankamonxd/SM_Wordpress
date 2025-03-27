<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bd_sm' );

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
define( 'AUTH_KEY',         'hromr&&eOyuA^@z;B6Ws&]Nio>t/Q>dN3eL[%mjh3-L#f9y6&/W BE/93H)sXrU(' );
define( 'SECURE_AUTH_KEY',  '6`(r+:3nJ`=sGKzNa|bo-gr?P(*^(n5(+:`ucXU#0.wz0q}@^pih[%#C>w&bU-i8' );
define( 'LOGGED_IN_KEY',    '0YhqZ/gkktM39qs]CQBF,i,_-?-(Jb-DUU5fmoQN<}@QL):7meM(,3!}|x+^J@Yx' );
define( 'NONCE_KEY',        'b#BxSH H-q<V4JZQsH|K{~M9h7!Y}Ix3H1Il*1(pL80VSt4rw{h27Uw;#je`Yw=(' );
define( 'AUTH_SALT',        '<z|(X4zdhAIF6f!`Es703WXU{ !Z|.:2AG$;jmxJ>5dc+I::%9Y9%jk>Ey6]qrQe' );
define( 'SECURE_AUTH_SALT', 'wCM/YY3:UypZg_3 uC:@7J$oezt:CeIh>+n|iA~eQsRT)O#sas4j;4FOTX+[_ac5' );
define( 'LOGGED_IN_SALT',   'V*;EKZX-dIJk[hEyx{dW5:#ur<1;:UFb?De%6c1w b6Gg3X=(6jCk0Dd@u(C>]UE' );
define( 'NONCE_SALT',       'Sh@fJH;NV2/k(wP,eE.@4*7lYwB#H(?Ct-a6+P?GCft~KAUe<-A5b|M@%$k*Y8N:' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define( 'SURECART_ENCRYPTION_KEY', '0YhqZ/gkktM39qs]CQBF,i,_-?-(Jb-DUU5fmoQN<}@QL):7meM(,3!}|x+^J@Yx' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
