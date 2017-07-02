<?php


// function pallash_scripts_with_jquery()
// {
   
    // // or
    // // Register the script like this for a theme:
	    // if (!is_admin()) {
		    // wp_deregister_script('jquery');
		    // wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', array(), '1.0.0'  );
			// wp_register_script( 'modernizr_custom', get_template_directory_uri() . '/js/modernizr.custom.js', array( 'jquery' ));
			// wp_register_script( 'jquery_animsition_min', get_template_directory_uri() . '/js/jquery.animsition.min.js', array( 'modernizr_custom' ));
			// wp_register_script( 'jquery_easing', get_template_directory_uri() . '/js/jquery.easing.js', array( 'jquery_animsition_min' ), true );
			// wp_register_script( 'retina', get_template_directory_uri() . '/js/retina-1.1.0.min.js', array( 'jquery_easing' ),'1.1.0', true );
			// wp_register_script( 'classie', get_template_directory_uri() . '/js/classie.js', array( 'retina' ), true );
			// wp_register_script( 'cbpAnimatedHeader', get_template_directory_uri() . '/js/cbpAnimatedHeader.min.js', array( 'classie' ), true );
			// wp_register_script( 'menu', get_template_directory_uri() . '/js/menu.js', array( 'cbpAnimatedHeader' ), true );
			// wp_register_script( 'scroll', get_template_directory_uri() . '/js/scroll.js', array( 'menu' ), true );
			// wp_register_script( 'animated-headline', get_template_directory_uri() . '/js/animated-headline.js', array( 'scroll' ), true );
			// wp_register_script( 'tipper', get_template_directory_uri() . '/js/jquery.fs.tipper.min.js', array( 'animated-headline' ), true );
			// wp_register_script( 'custom-home1', get_template_directory_uri() . '/js/custom-home1.js', array( 'tipper' ), true );
		
		 
			// // For either a plugin or a theme, you can then enqueue the script:
			// wp_enqueue_script( 'jquery' );
			// wp_enqueue_script( 'modernizr_custom' );
			// wp_enqueue_script( 'jquery_animsition_min' );
			// wp_enqueue_script( 'jquery_easing' );
			// wp_enqueue_script( 'retina' );
			// wp_enqueue_script( 'classie' );
			// wp_enqueue_script( 'cbpAnimatedHeader' );
			// wp_enqueue_script( 'menu' );
			// wp_enqueue_script( 'scroll' );
			// wp_enqueue_script( 'animated-headline' );
			// wp_enqueue_script( 'tipper' );
			// wp_enqueue_script( 'custom-home1' );
		// }
    
// }
// add_action( 'wp_enqueue_scripts', 'pallash_scripts_with_jquery' );

// function pallash_styles_file_all()
// {
   
    // // Register the style like this for a theme:
    // wp_register_style( 'base', get_template_directory_uri() . '/css/base.css', array() );
    // wp_register_style( 'skeleton', get_template_directory_uri() . '/css/skeleton.css', array('base'));
    // wp_register_style( 'layout', get_template_directory_uri() . '/css/layout.css', array('skeleton'));
    // wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array('layout'));
    // wp_register_style( 'retina', get_template_directory_uri() . '/css/retina.css', array('font-awesome') );
    // wp_register_style( 'animsition', get_template_directory_uri() . '/css/animsition.min.css', array('retina'));
 
    // // For either a plugin or a theme, you can then enqueue the style:
    // wp_enqueue_style( 'base' );
    // wp_enqueue_style( 'skeleton' );
    // wp_enqueue_style( 'layout' );
    // wp_enqueue_style( 'font-awesome' );
    // wp_enqueue_style( 'retina' );
    // wp_enqueue_style( 'animsition' );
// }
// add_action( 'wp_enqueue_scripts', 'pallash_styles_file_all' );
?>