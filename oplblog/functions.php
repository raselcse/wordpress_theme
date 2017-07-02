<?php
function wmpudev_enqueue_icon_stylesheet() {
	wp_register_style( 'fontawesome', 'http:////maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'fontawesome');
}
add_action( 'wp_enqueue_scripts', 'wmpudev_enqueue_icon_stylesheet' );
/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
require( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

include_once('inc/theme_file.php');
include_once('inc/theme_supports.php');
// add menu function
include_once('inc/menu_supports.php');
include_once('inc/meta_box_field.php');
include_once('inc/shortcode.php');
include_once('inc/widget_list.php');
include_once('inc/theme-options.php');
include_once('inc/pagination.php');
require_once ('inc/class-tgm-plugin-activation.php');
require_once ('inc/activation-plugins.php');
// Remove Option Tree Settings Menu

add_filter( 'ot_show_pages', '__return_false' );





function webendev_load_font_awesome() {
	if ( ! is_admin() ) {

		wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css', null, '4.0.1' );

	}

}


?>
