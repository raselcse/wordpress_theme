<?php
add_action( 'init', 'custom_slider' );
function custom_slider() {
  register_post_type( 'slider',
    array(
      'labels' => array(
        'name' => __( 'Sliders' ),
        'singular_name' => __( 'slide' ),
		'add_new'=>__('Add New Slide')
      ),
	   'taxonomies' => array('slider_category'), 
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'sliders'),
	  'supports' => array('thumbnail','title', 'editor','excerpt')
    )
  );
}

function slider_taxonomies() {

	register_taxonomy('slider_category', 'review', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Slider Category', 'taxonomy general name' ),
			'singular_name' => _x( 'slider-Category', 'taxonomy singular name' )
			
		),

		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'slider_category', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		)
	));
}
add_action( 'init', 'slider_taxonomies', 0 );

?>
