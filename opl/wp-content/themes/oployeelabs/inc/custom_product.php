<?php
add_action( 'init', 'custom_products' );
function custom_products() {
  register_post_type( 'custom_products',
    array(
      'labels' => array(
        'name' => __( 'Products' ),
        'singular_name' => __( 'product' ),
		'add_new'=>__('Add New Product')
      ),
	   'taxonomies' => array('post_tag','products_category'), 
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'products'),
	  'supports' => array('thumbnail','title', 'editor','excerpt')
    )
  );
}

function products_taxonomies() {

	register_taxonomy('products_category', 'review', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Product Category', 'taxonomy general name' ),
			'singular_name' => _x( 'products_category', 'taxonomy singular name' )
			
		),

		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'products_category', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
add_action( 'init', 'products_taxonomies', 0 );

?>