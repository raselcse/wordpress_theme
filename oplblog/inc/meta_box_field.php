<?php
	/**
 * Initialize the custom Meta Boxes. 
 */
add_action( 'admin_init', 'custom_meta_boxes' );

/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types in demo-theme-options.php.
 *
 * @return    void
 * @since     2.0
 */
function custom_meta_boxes() {
  
  /**
   * Create a custom meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   */
  $portfolio_meta_box = array(
    'id'          => 'demo_meta_box',
    'title'       => __( 'Portfolio Picture Section', 'theme-text-domain' ),
    'desc'        => '',
    'pages'       => 'portfolio',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => __( 'Conditions', 'theme-text-domain' ),
        'id'          => 'demo_conditions',
        'type'        => 'tab'
      ),
      array(
        'label'       => __( 'Portfolio Picture', 'theme-text-domain' ),
        'id'          => 'demo_show_gallery',
        'type'        => 'on-off',
        'desc'        => sprintf( __( 'Shows the Portfolio Picture when set to %s.', 'theme-text-domain' ), '<code>on</code>' ),
        'std'         => 'off'
      ),
      array(
        'label'       => '',
        'id'          => 'demo_textblock',
        'type'        => 'textblock',
        'desc'        => __( 'Congratulations, you created a  Portfolio Picture!', 'theme-text-domain' ),
        'operator'    => 'and',
        'condition'   => 'demo_show_gallery:is(on),demo_gallery:not()'
      ),
      array(
        'label'       => __( 'Gallery', 'theme-text-domain' ),
        'id'          => 'demo_gallery',
        'type'        => 'gallery',
        'desc'        => sprintf( __( 'This is a  Portfolio Picture option type. It displays when %s.', 'theme-text-domain' ), '<code>demo_show_gallery:is(on)</code>' ),
        'condition'   => 'demo_show_gallery:is(on)'
      ),
      array(
        'label'       => __( 'More Options', 'theme-text-domain' ),
        'id'          => 'demo_more_options',
        'type'        => 'tab'
      ),
      array(
        'label'       => __( 'Sub Title', 'theme-text-domain' ),
        'id'          => 'portfolio_subtitle',
        'type'        => 'text',
        'desc'        => __( 'THis is Sub title.', 'theme-text-domain' )
      ),
      array(
        'label'       => __( 'Project link', 'theme-text-domain' ),
        'id'          => 'portfolio_link',
        'type'        => 'text',
        'desc'        => __( 'Project Link', 'theme-text-domain' )
      )
    )
  );
 
  $slider_meta_box=array(
    'id'          => 'slider_meta_box',
    'title'       => __( 'Product Description', 'theme-text-domain' ),
    'desc'        => '',
    'pages'       => 'slider',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
		
		
	  array(
        'label'       => __( 'Slide Text', 'theme-text-domain' ),
        'id'          => 'slide_text',
        'type'        => 'text',
        'desc'        => sprintf( __('Slide Text' ))
      )
      )
    
  );
  
   $homepost_meta_box=array(
    'id'          => 'homepost_meta_box',
    'title'       => __( 'Home Post Description', 'theme-text-domain' ),
    'desc'        => '',
    'pages'       => 'homepost',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
		
		
		  array(
			'label'       => __( 'More Button Text', 'theme-text-domain' ),
			'id'          => 'more_button_text',
			'type'        => 'text',
			'desc'        => sprintf( __('More Button Text' ))
		  ),
		  
		   array(
			'label'       => __( 'More Button Link', 'theme-text-domain' ),
			'id'          => 'more_button_link',
			'type'        => 'text',
			'desc'        => sprintf( __('More Button Link' ))
		  )
      )
    
  );
   $page_meta_box=array(
    'id'          => 'page_meta_box',
    'title'       => __( 'Page Description', 'theme-text-domain' ),
    'desc'        => '',
    'pages'       => array('page','post'),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
		
		
		  array(
        'label'       => __( 'Sub Title', 'theme-text-domain' ),
        'id'          => 'subtitle',
        'type'        => 'text',
        'desc'        => __( 'THis is Sub title.', 'theme-text-domain' )
      )
      )
    
  );
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
  if ( function_exists( 'ot_register_meta_box' ) )
    ot_register_meta_box( $portfolio_meta_box );
    ot_register_meta_box( $product_meta_box );
    ot_register_meta_box( $slider_meta_box );
    ot_register_meta_box( $homepost_meta_box );
    ot_register_meta_box( $page_meta_box );

}


 ?>