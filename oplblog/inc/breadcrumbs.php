<?php

function get_breadcrumb() {
 
	global $post;
 
	$trail = '';
	$page_title = get_the_title($post->ID);
 
	if($post->post_parent) {
		$parent_id = $post->post_parent;
      
		while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a> / ';
			$parent_id = $page->post_parent;
		}
 
		$breadcrumbs = array_reverse($breadcrumbs);
		foreach($breadcrumbs as $crumb) $trail .= $crumb;
	}
 
	$trail .= $page_title;
	$trail .= '';
 
	return $trail;	
 
}

?>