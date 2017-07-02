<?php
add_action( 'init', 'portfolio' );
function portfolio() {
  register_post_type( 'portfolio',
    array(
      'labels' => array(
        'name' => __( 'Portfolio' ),
        'singular_name' => __( 'portfolio' ),
		'add_new'=>__('Add New Portfolio')
      ),
	  'taxonomies' => array('portfolio_category'), 
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'portfolio_list'),
	  'supports' => array('thumbnail','title', 'editor')
    )
  );
}

function portfolio_taxonomies() {

	register_taxonomy('portfolio_category', 'review', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Portfolio Category', 'taxonomy general name' ),
			'singular_name' => _x( 'portfolio-Category', 'taxonomy singular name' )
			
		),

		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'portfolio_category', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		)
	));
}
add_action( 'init', 'portfolio_taxonomies', 0 );

?>
