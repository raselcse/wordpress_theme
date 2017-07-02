<?php
/**
 *
 * (c) DEVN.co
 *
 * The Header of theme.
 *
 * You can add your custom css & js at this file
 *
 */
 
 
global $page, $paged, $devn_settings, $devn;

if ( ! isset( $content_width ) ){
	$content_width = 1170;
}	
	
?><!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
<?php devn_meta(); ?>
<title><?php devn_title(); ?></title>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="main" class="layout-<?php echo $devn_settings['layout']; echo ' '.$post->post_name; ?>">
