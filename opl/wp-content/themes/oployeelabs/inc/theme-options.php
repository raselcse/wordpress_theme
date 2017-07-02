<?php
/**
 * Initialize the custom Theme Options.
 */
 // Remove Option Tree Settings Menu


add_action( 'init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 *
 * @return    void
 * @since     2.0
 */
function custom_theme_options() {

  /* OptionTree is not loaded yet, or this is not an admin request */
  if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
    return false;

  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    
	
    'sections'        => array( 
	  array(
        'id'          => 'home_page_setting',
        'title'       => __( 'Home page setting', 'theme-text-domain' )
      ),
      array(
        'id'          => 'option_body',
        'title'       => __( 'Body Section', 'theme-text-domain' )
      ),
	    array(
        'id'          => 'header_section',
        'title'       => __( 'Header Section', 'theme-text-domain' )
      ),
	   array(
        'id'          => 'footer_section',
        'title'       => __( 'Footer Section', 'theme-text-domain' )
      ),
	   array(
        'id'          => 'contact_info',
        'title'       => __( 'Contact Info', 'theme-text-domain' )
      )
    ),
    'settings'        => array( 
			
		 array(
        'label'       => __( 'Home Slider', 'theme-text-domain' ),
        'id'          => 'home_slider',
        'type'        => 'gallery',
        'desc'        => sprintf( __( 'This is a  slider Picture option type. It displays when %s.', 'theme-text-domain' ), '<code>demo_show_gallery:is(on)</code>' ),
         'section'     => 'home_page_setting'
      ),
		   array(
        'id'          => 'slider_on_off',
        'label'       => __( 'Slider On/Off', 'theme-text-domain' ),
        'desc'        => sprintf( __( 'The On/Off option type displays a simple switch that can be used to turn things on or off. The saved return value is either %s or %s.', 'theme-text-domain' ), '<code>on</code>', '<code>off</code>' ),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'home_page_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	     array(
        'id'          => 'background_big_text',
        'label'       => __( 'Background Big Text', 'theme-text-domain' ),
        'desc'        =>__( 'Background Big Text for Homepage' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'home_page_setting'
      ),
	   array(
        'id'          => 'background_big_text_color',
        'label'       => __( 'Background Big Text Color', 'theme-text-domain' ),
        'desc'        => sprintf( __('Background Big Text') ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'home_page_setting'
      ),
	     array(
        'id'          => 'background_small_text',
        'label'       => __( 'Background Small Text', 'theme-text-domain' ),
        'desc'        =>__( 'Background Small Text' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'home_page_setting'
      ),
	   array(
        'id'          => 'background_small_text_color',
        'label'       => __( 'Background Small Text Color', 'theme-text-domain' ),
        'desc'        => sprintf( __('Background Small Text color ') ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'home_page_setting'
      ),
      array(
        'id'          => 'moving_background',
        'label'       => __( 'Home Moving Background', 'theme-text-domain' ),
        'desc'        => sprintf( __('Home Moving Background add from your media.') ),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'home_page_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	   array(
        'id'          => 'moving_text',
        'label'       => __( 'Home page Moving  Text', 'theme-text-domain' ),
        'desc'        =>__( 'after One text put comma( , )' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'home_page_setting'
      ),
      array(
        'id'          => 'home_video',
        'label'       => __( 'Home Video', 'theme-text-domain' ),
        'desc'        =>__( 'Home Video upload' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'home_page_setting'
      ),
   
     
      array(
        'id'          => 'fashion_typography',
        'label'       => __( 'Typography', 'theme-text-domain' ),
        'desc'        => sprintf( __( 'The Typography option type is for adding typography styles to your theme either dynamically via the CSS option type above or manually with %s. The Typography option type has filters that allow you to remove fields or change the defaults. For example, you can filter %s to remove unwanted fields from all Background options or an individual one. You can also filter %s. These filters allow you to fine tune the select lists for your specific needs.', 'theme-text-domain' ), '<code>ot_get_option()</code>', '<code>ot_recognized_typography_fields</code>', '<code>ot_recognized_font_families</code>, <code>ot_recognized_font_sizes</code>, <code>ot_recognized_font_styles</code>, <code>ot_recognized_font_variants</code>, <code>ot_recognized_font_weights</code>, <code>ot_recognized_letter_spacing</code>, <code>ot_recognized_line_heights</code>, <code>ot_recognized_text_decorations</code> ' . __( 'and', 'theme-text-domain' ) . ' <code>ot_recognized_text_transformations</code>' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'option_body',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'header_logo',
        'label'       => __( 'Logo Upload', 'theme-text-domain' ),
        'desc'        => sprintf( __('You Should logo height 25px and width 135px') ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'header_section'
      ),
	   array(
        'id'          => 'header_text_color',
        'label'       => __( 'Header Text Color', 'theme-text-domain' ),
        'desc'        => sprintf( __('Header Text color under Logo') ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'header_section'
      ),
	  
	  
       array(
        'id'          => 'footer_social_links',
        'label'       => __( 'Social Links', 'theme-text-domain' ),
        'desc'        => '<p>' . sprintf( __( 'The Social Links option type utilizes a drag & drop interface to create a list of social links.', 'theme-text-domain' ) ) . '</p>',
        'std'         => '',
        'type'        => 'social-links',
        'section'     => 'footer_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
     array(
        'id'          => 'footer_copyright_text',
        'label'       => __( 'Footer Copyright Text', 'theme-text-domain' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'footer_section'
      ),
	  
      array(
        'id'          => 'fashion_javascript',
        'label'       => __( 'JavaScript', 'theme-text-domain' ),
        'desc'        => '<p>' . sprintf( __( 'The JavaScript option type is a textarea that uses the %s code editor to highlight your JavaScript and display errors as you type.', 'theme-text-domain' ), '<code>ace.js</code>' ) . '</p>',
        'std'         => '',
        'type'        => 'javascript',
        'section'     => 'footer_section',
        'rows'        => '20',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	     array(
        'id'          => 'contact_email',
        'label'       => __( 'Contact Email', 'theme-text-domain' ),
        'desc'        =>__( 'Contact Email for Contact page' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'contact_info'
      ),
	   array(
        'id'          => 'contact_address',
        'label'       => __( 'Contact Address', 'theme-text-domain' ),
        'desc'        =>__( 'Contact Address for Contact page' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'contact_info'
      ),
	   array(
        'id'          => 'contact_phone',
        'label'       => __( 'Contact Phone', 'theme-text-domain' ),
        'desc'        =>__( 'Contact Phone for Contact page' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'contact_info'
      ),
	  
	    array(
        'id'          => 'contact_googlemap',
        'label'       => __( 'Google Map', 'theme-text-domain' ),
        'desc'        =>__( 'please give iframe of google for your address. Go to https://www.google.com/maps/ and find the required location using the search tool in the top left corner. go Setting-> Share or Embed -> Open ‘Embed Map’ tab and copy the code and past this text area' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'contact_info'
      ),
	  
	   array(
        'id'          => 'contact_title',
        'label'       => __( 'Contact body Title', 'theme-text-domain' ),
        'desc'        =>__( 'Contact body Title for Contact page' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'contact_info'
      ),
	   array(
        'id'          => 'contact_subtitle',
        'label'       => __( 'Contact Body Subtitle', 'theme-text-domain' ),
        'desc'        =>__( 'Contact Body Subtitle for Contact page' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'contact_info'
      ),
    )
	
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;
  
}