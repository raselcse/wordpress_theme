<?php
/**
*	(c) www.devn.co
*/
define( 'DS', DIRECTORY_SEPARATOR );
define( 'SITE_URI', site_url() );
define( 'URL', site_url() );
define( 'ADMIN_URI', site_url('/wp-admin') );
define( 'THEME_URI', get_template_directory_uri() );
define( 'THEME_PATH', get_template_directory() );
define( 'DS_URI', THEME_URI.'/cgi/assets' );
define( 'DS_SHORTCODES', THEME_URI.'/cgi/shortcodes' );

define( 'DS_PATH', dirname(__FILE__) );
define( 'SKINS_PATH', dirname(__FILE__).DS.'skins' );

