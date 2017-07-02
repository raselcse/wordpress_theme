<?php

/**
*
* (c) www.devn.co /Init widgets
*
*/

$w = 'widgets/';

devn::incl($w.'widget.xcode');
devn::incl($w.'widget.content');
devn::incl($w.'widget.flickr');
devn::incl($w.'widget.tabbed');
devn::incl($w.'widget.twitter');

global $devn_widgetCfg;

$devn_widgetCfg = array(
	"default" => "puzzle-piece",
	
	"shortcodes-devn" => array(
		"icon"=>"th",
		"text" => "www.devn.co",
	),
	"execphp" => array(
		"icon"=>"pencil",
		"text" => "Double Click here to edit",
		),
	"contents" => array(
		"icon"=>	"align-center",
		),

	"comments" => array(
		"icon"=>	"comment",
		),	
		
	"archives" => array(
		"icon"=>"folder-open",
	),
	"calendar" => array(
		"icon"=>"calendar",
	),
	"categories" => array(
		"icon"=>"th-large",
		"title" => "Categories"
	),
	"nav_menu" => array(
		"icon"=>"th-list",
		"nav_menu" => devn_getMenuId(),
	),
	"pages" => array(
		"icon"=>"list-alt",
	),
	"recent-comments" => array(
		"icon"=>"align-left",
	),
	"recent-posts" => array(
		"icon"=>"align-left",
	),
	"recent-posts" => array(
		"icon"=>"bullhorn",
	),
	"search" => array(
		"icon"=>"search",
	),
	"tag_cloud" => array(
		"icon"=>"tags",
	),
	"text" => array(
		"icon"=>"pencil",
		"ignore" => true
		),
	"rss" => array(
		"icon"=>"rss",
	),
	"meta" => array(
		"icon"=>"code",
	),
	"flickr" => array(
		"icon"=>"flickr",
	),
	"tabbed" => array(
		"icon"=>"bars",
	),
	

);
