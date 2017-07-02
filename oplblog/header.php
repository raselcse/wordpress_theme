<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
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

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://feedpress.me/mozblog">
<meta name="viewport" content="width=device-width, initial-scale=1">  <meta name="description" content="The Moz inbound marketing and SEO blog provides tips, tricks, and advice for improving websites and doing better search, social, content, and brand marketing.">

  <link rel="canonical" href="https://moz.com/blog">



<link rel="shortcut icon" href="https://dc8hdnsmzapvm.cloudfront.net/favicon.ico">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/responsive.css"/>
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="https://dc8hdnsmzapvm.cloudfront.net/assets/images/favicon/moz-favicon-57.png?7345a55">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="https://dc8hdnsmzapvm.cloudfront.net/assets/images/favicon/moz-favicon-72.png?a5899ba">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="https://dc8hdnsmzapvm.cloudfront.net/assets/images/favicon/moz-favicon-114.png?8bde9a0">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="https://dc8hdnsmzapvm.cloudfront.net/assets/images/favicon/moz-favicon-144.png?905e67d">
<link rel="next" href="https://moz.com/blog?page=2">
  

<meta name="robots" content="noydir, noodp">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="twitter:site" content="@Moz">
<meta property="twitter:account_id" content="15651700">
<meta property="fb:page_id" content="8489236245">
<meta name="referrer" content="unsafe-url">


<!--[if lt IE 9]>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
<![endif]-->


<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/globalnav.min.css"/>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css"/>
<script type="text/javascript" async="" src="<?php bloginfo('stylesheet_directory'); ?>globalnav.min.js.download"></script><script type="text/javascript" async="" src="<?php bloginfo('stylesheet_directory'); ?>/munchkin.js.download"></script><script type="text/javascript" async="" src="<?php bloginfo('stylesheet_directory'); ?>/linkid.js.download"></script><script type="text/javascript" async="" id="inspsync" src="<?php bloginfo('stylesheet_directory'); ?>/inspectlet.js.download"></script><script type="text/javascript" async="" src="<?php bloginfo('stylesheet_directory'); ?>/munchkin.js(1).download"></script><script type="text/javascript" async="" src="<?php bloginfo('stylesheet_directory'); ?>/2886781.js.download" id="hs-analytics"></script><script type="text/javascript" async="" src="<?php bloginfo('stylesheet_directory'); ?>/ze4rr0vi"></script><script type="text/javascript" async="" src="<?php bloginfo('stylesheet_directory'); ?>/analytics.js.download"></script><script type="text/javascript" async="" src="<?php bloginfo('stylesheet_directory'); ?>/s.js.download"></script><script type="text/javascript" async="" src="<?php bloginfo('stylesheet_directory'); ?>/analytics.min.js.download"></script><script type="text/javascript" async="" src="<?php bloginfo('stylesheet_directory'); ?>/ga.js.download"></script><script src="<?php bloginfo('stylesheet_directory'); ?>/satelliteLib-7bc7bd86922f7d6176087448ae61214793df0fe2.js.download"></script><script src="<?php bloginfo('stylesheet_directory'); ?>/mbox-contents-9828e4cc3b98ffc78eccda35588185590fd7fc9d.js.download"></script><script src="<?php bloginfo('stylesheet_directory'); ?>/582120801.js.download"></script>
<?php wp_head(); ?>	
</head>
<body <?php body_class( 'posts posts-index  responsive-layout layout-kaleidoscope' ); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1631861350437352";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
  <div id="wrap" class="no-overflow">

                                                                                                      
<nav class="subnav js-subnav-blog">

  <div class="header-section">
    <div class="container">
		  <div class="mgn-logo">
			<?php if ( ot_get_option('header_logo') ) {?>
			 <a href="<?php echo site_url();?>" ><img class="header_logo" src="<?php echo ot_get_option('header_logo'); ?>"/></a>
			<?php } else {?>
			 <a href="<?php echo site_url();?>" >
			 <svg class="mgn-moz-logo">
				<use xlink:href="#mgn-moz-logo">
			  </use></svg></a>
			<?php }?>
		  </div>
		<ul class="subnav-breadcrumbs">
			<li class="item subnav-drawer-menu">
				<a href="<?php echo site_url();?>">Home</a>        
			</li>
		</ul>
	   
		<ul class="search-box">
			<li class="item active  show-medium-up">
			<?php get_search_form(); ?>
			</li>
		</ul>
    </div>
  </div>
</nav>
 

		