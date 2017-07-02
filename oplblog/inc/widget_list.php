<?php

function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Footer First Column',
		'id'            => 'footer_first_column',
		'before_widget' => '<div class="footer_widget first_column">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="rounded">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => 'Footer second Column',
		'id'            => 'footer_second_column',
		'before_widget' => '<div class="footer_widget second_column">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="rounded">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => 'Footer Third Column',
		'id'            => 'footer_third_column',
		'before_widget' => '<div class="footer_widget third_column">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="rounded">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => 'Footer Fourth Column',
		'id'            => 'footer_fourth_column',
		'before_widget' => '<div class="footer_widget fourth_column mgn-col mgn-border-left">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="rounded">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );
