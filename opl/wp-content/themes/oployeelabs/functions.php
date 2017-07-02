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
include_once('inc/home_post.php');
include_once('inc/portfolio.php');
include_once('inc/shortcode.php');
include_once('inc/widget_list.php');
include_once('inc/theme-options.php');
include_once('inc/pagination.php');


function my_wp_head() {
    $options = ot_get_option( 'header_text_color' );
    $color = $options['color'];
    echo "<style> h1 { color: $color; } </style>";
}
add_action( 'wp_head', 'my_wp_head' );
// Remove Option Tree Settings Menu

add_filter( 'ot_show_pages', '__return_false' );



// Hooks your functions into the correct filters
function my_add_mce_button() {
	// check user permissions
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'my_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'my_register_mce_button' );
	}
}
add_action('admin_head', 'my_add_mce_button');

// Declare script for new button
function my_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['my_mce_button'] = get_template_directory_uri() .'/js/mce-button.js';
	return $plugin_array;
}

// Register new button in the editor
function my_register_mce_button( $buttons ) {
	array_push( $buttons, 'my_mce_button' );
	return $buttons;
}

add_filter('nav_menu_css_class', 'add_active_class', 10, 2 );

function add_active_class($classes, $item) {

  if( in_array( 'current-menu-item', $classes ) ||
    in_array( 'current-menu-ancestor', $classes ) ||
    in_array( 'current-menu-parent', $classes ) ||
    in_array( 'current_page_parent', $classes ) ||
    in_array( 'current_page_ancestor', $classes )
    ) {

    $classes[] = "active-menu";
  }

  return $classes;
}

// Register the script
wp_register_script( 'pallash_handle', get_template_directory_uri() . '/js/custom-home2.js', array('jquery'), '1.0.0'  );
wp_register_script( 'pallash_handle1', get_template_directory_uri() . '/js/custom-home2.js', array('jquery'), '1.0.0'  );


	

	function my_custom_function() {
	    
		if ( function_exists( 'ot_get_option' ) ) {
	$images = explode( ',', ot_get_option( 'home_slider', '' ) );
		if ( ! empty( $images ) ) {
			$i = 0;
			foreach( $images as $id ) {
			if ( ! empty( $id ) ) {
				$full_img_src_.$i = wp_get_attachment_image_src( $id, '' );
				$slider_array = array(
			   
					'url.$i' =>  $full_img_src_.$i[0]
				
				);
			}
					 $i++;
				}
		
		}
	}
			
}
add_action( 'after_setup_theme', 'my_custom_function' );

// Localize the script with new data
$slider_array = array(
   
	'url1' => get_template_directory_uri()."/images/offshore-web-development.jpg",
	'url2' =>  get_template_directory_uri()."/images/Oployeelabs-Website-Banner-02.jpg",
	'url3' =>  get_template_directory_uri()."/images/responsive-web-design.jpg",
	
);
wp_localize_script( 'pallash_handle', 'theme', $slider_array );

// Enqueued script with localized data.
wp_enqueue_script( 'pallash_handle' );

add_action( 'wp_enqueue_scripts', 'webendev_load_font_awesome', 99 );
/**
* Enqueue Font Awesome Stylesheet from MaxCDN
*
*/


function webendev_load_font_awesome() {
	if ( ! is_admin() ) {

		wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css', null, '4.0.1' );

	}

}

?>
