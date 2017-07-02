
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/base.css"/>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/skeleton.css"/>
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/font-awesome.css" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/retina.css"/>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/animsition.min.css"/>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/layout.css"/>

		
	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.png">
	<link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('stylesheet_directory'); ?>/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('stylesheet_directory'); ?>/apple-touch-icon-114x114.png">
	
	
<?php wp_head(); ?>	
</head>
<body <?php body_class()?>>	

	<div class="animsition">
	
	<!-- MENU
    ================================================== -->	

		<div id="menu-wrap" class="menu-back cbp-af-header">
			<div class="container">
				<div class="sixteen columns">
					<div class="logo">
					 <?php if ( ot_get_option('header_logo') ) {?>
					 <a href="<?php echo site_url();?>" ><h1><img class="header_logo" src="<?php echo ot_get_option('header_logo'); ?>"/></h1></a>
					<?php } else {?>
					 <a href="<?php echo site_url();?>" ><h1><img class="header_logo" src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.jpg" height="90" width="300"/></h1></a>
					<?php }?>
					</div>
					 <?php
					if ( has_nav_menu( 'main-menu' ) ) {
				    	 wp_nav_menu(array('menu_class' => 'slimmenu', 'container' => false, 'theme_location' => 'main-menu','before'=>'','after'=>'' ,'show_home' => '1'));
					  }
					
					  ?>
				</div>
			</div>
		</div>	
		