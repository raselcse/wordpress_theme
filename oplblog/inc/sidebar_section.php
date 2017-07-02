<?php
	
if (function_exists('register_sidebar')) {
	
register_sidebar( array(
'name' => 'Footer Sidebar',
'id' => 'footer',
'description' => 'Appears in the footer area',
'before_widget' => '<div>',
'after_widget' => '</div>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );

register_sidebar( array(
'name' => 'left Sidebar 1',
'id' => 'sidebar1',
'description' => 'Appears in the  Sidebar 1 area',
'before_widget' => '<div>',
'after_widget' => '</div>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );

register_sidebar( array(
'name' => 'left Sidebar 2',
'id' => 'sidebar2',
'description' => 'Appears in the Sidebar 2 area',
'before_widget' => '<div>',
'after_widget' => '</div>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
register_sidebar( array(
'name' => 'left Sidebar 3',
'id' => 'sidebar3',
'description' => 'Appears in the  Sidebar 3 area',
'before_widget' => '<div>',
'after_widget' => '</div>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}

?>