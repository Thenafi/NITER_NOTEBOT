<?php

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL

//Begin Really Simple SSL Load balancing fix
if ((isset($_ENV["HTTPS"]) && ("on" == $_ENV["HTTPS"]))
|| (isset($_SERVER["HTTP_X_FORWARDED_SSL"]) && (strpos($_SERVER["HTTP_X_FORWARDED_SSL"], "1") !== false))
|| (isset($_SERVER["HTTP_X_FORWARDED_SSL"]) && (strpos($_SERVER["HTTP_X_FORWARDED_SSL"], "on") !== false))
|| (isset($_SERVER["HTTP_CF_VISITOR"]) && (strpos($_SERVER["HTTP_CF_VISITOR"], "https") !== false))
|| (isset($_SERVER["HTTP_CLOUDFRONT_FORWARDED_PROTO"]) && (strpos($_SERVER["HTTP_CLOUDFRONT_FORWARDED_PROTO"], "https") !== false))
|| (isset($_SERVER["HTTP_X_FORWARDED_PROTO"]) && (strpos($_SERVER["HTTP_X_FORWARDED_PROTO"], "https") !== false))
|| (isset($_SERVER["HTTP_X_PROTO"]) && (strpos($_SERVER["HTTP_X_PROTO"], "SSL") !== false))
) {
$_SERVER["HTTPS"] = "on";
}
//END Really Simple SSL
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
define( 'DB_NAME', 'epiz_28000772_w373' );

/** MySQL database username */
define( 'DB_USER', '28000772_9' );

/** MySQL database password */
define( 'DB_PASSWORD', 'B!87Scp[15' );

/** MySQL hostname */
define( 'DB_HOST', 'sql105.byetcluster.com' );

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
define( 'AUTH_KEY',         '7ezrecqjjrmrxh0piuio12eicnln3ihy78qs0lml3al3bydpp5lay7b9vv0oeetb' );
define( 'SECURE_AUTH_KEY',  'xpamubvhzbspbdljqsdnniei4xsog4zbc8wbvliou2cd0jrfxpsfj5gva3hnsuji' );
define( 'LOGGED_IN_KEY',    'iir7t36twyzhapjordgqzkufhqj6tdwpfoznagfmvd6qqu4ct362plcqbdoezflp' );
define( 'NONCE_KEY',        'ez9mq7bhdsxd9wq90ielaj7gxrfdkryi4qkq0h9wmqsn3ma6w20raqz7raiugv7t' );
define( 'AUTH_SALT',        'pt57dxwfhxkktixm409rl76gtucmuk7kyo9eiskanbqrtspfvkp4wyacoufbk7di' );
define( 'SECURE_AUTH_SALT', 'zqwueflgxp5sdr7dd919boijtq8xbvnqbzwiquq3ximll6hrqymmvfjcrrafdoxj' );
define( 'LOGGED_IN_SALT',   'kt9vngwufmpeqznuhsabpiq3u0zwlzfenllkp2sooq0psratq7orbybgrynwi5lu' );
define( 'NONCE_SALT',       'b5sk9cjyikz60csgw6qy6jgb89gt7oduftzwp0ujv9nhv5l5r30pipjcf4yinfhh' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp7g_';

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

define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', true);