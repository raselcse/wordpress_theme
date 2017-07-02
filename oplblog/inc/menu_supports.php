<?php
function register_my_menus() {
  register_nav_menus(
    array(
      'main' => __( 'Main Menu' ),
      'top-left' => __( 'Top Left Menu' ),
      'top-right' => __( 'Top Right Menu' ),
      'footer' => __( 'Footer Menu' ),
      'category' => __( 'Category Menu' ),
    )
  );
}
add_action( 'init', 'register_my_menus' );
// Add class to Menu li
function add_classes_on_li($classes, $item, $args) {
  $classes[] = 'item';
  return $classes;
}
add_filter('nav_menu_css_class','add_classes_on_li',1,3);
?>