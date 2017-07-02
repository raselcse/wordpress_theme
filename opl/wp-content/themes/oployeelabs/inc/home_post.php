<?php
add_action( 'init', 'home_post' );
function home_post() {
  register_post_type( 'homepost',
    array(
      'labels' => array(
        'name' => __( 'Home Post' ),
        'singular_name' => __( 'home post' ),
		'add_new'=>__('Add New Home Post')
      ),
	  'taxonomies' => array('home_post_category'), 
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'homepostss'),
	  'supports' => array('thumbnail','title', 'editor')
    )
  );
}

function home_post_taxonomies() {

	register_taxonomy('home_post_category', 'review', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Home Post Category', 'taxonomy general name' ),
			'singular_name' => _x( 'homepost-Category', 'taxonomy singular name' )
			
		),

		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'home_category', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		)
	));
}
add_action( 'init', 'home_post_taxonomies', 0 );


add_action( 'init', 'faq_post' );
function faq_post() {
  register_post_type( 'faq',
    array(
      'labels' => array(
        'name' => __( 'faq list' ),
        'singular_name' => __( 'faq_one ' ),
		'add_new'=>__('Add New FAQ')
      ),
	  'taxonomies' => array('faq_category'), 
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'faqs'),
	  'supports' => array('title', 'editor')
    )
  );
}

function faq_taxonomies() {

	register_taxonomy('faq_category', 'review', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'FAQ Category', 'taxonomy general name' ),
			'singular_name' => _x( 'faq-Category', 'taxonomy singular name' )
			
		),

		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'faq_category', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		)
	));
}
add_action( 'init', 'faq_taxonomies', 0 );
?>
