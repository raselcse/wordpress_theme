<?php

/**
*
*	Theme functions
*	(c) www.devn.co
*
*/

/*-----------------------------------------------------------------------------------*/
# Helper: Build list pages on Vitual Design Layouts
/*-----------------------------------------------------------------------------------*/


function devn_buildListItemsPage( $screen, $context, $object ) {

	global $wp_meta_boxes;
	static $already_sorted = false;

	if ( empty( $screen ) ){
		$screen = get_current_screen();
	}elseif ( is_string( $screen ) ){
		$screen = convert_to_screen( $screen );
	}	
	$page = $screen->id;

	$hidden = get_hidden_meta_boxes( $screen );

	$i = 0;
	do {
		// Grab the ones the user has manually sorted. Pull them out of their previous context/priority and into the one the user chose
		if ( !$already_sorted && $sorted = get_user_option( "meta-box-order_$page" ) ) {
			foreach ( $sorted as $box_context => $ids ) {
				foreach ( explode(',', $ids ) as $id ) {
					if ( $id && 'dashboard_browser_nag' !== $id )
						add_meta_box( $id, null, null, $screen, $box_context, 'sorted' );
				}
			}
		}
		$already_sorted = true;

		
		if ( !isset($wp_meta_boxes) || !isset($wp_meta_boxes[$page]) || !isset($wp_meta_boxes[$page][$context]) )
			break;
		?>
			
		<h3>
			General page
			<a href="#layout|edit|general" title='Edit General page, All page will be inheritance' class='edit general' id="layout_editting"  data="{'id':'general','title':'General'}"></a>
		</h3>
		<div>
			<ul>
				<li>
					<span></span>
					<?php
						$indexAl = 'Index';
						if( get_option('show_on_front') == 'page' ){
							$pid = get_option('page_for_posts');
							if( $pid ){
								$indexAl = get_the_title( $pid ).' <br /><i style="font-size: 10px;margin-left: 15px;">(Posts Page)</i>';
							}
						}
						echo $indexAl;
					?>
					<a href="#layout|edit|index" title='Edit this page' class='edit index' data="{'id':'index','title':'Index'}"></a>
				</li>
				<?php
					
					if( get_option('show_on_front') == 'page' ){
							$pid = get_option('page_on_front');
							if( $pid ){
							?>	
							<li>
								<span></span>
								<?php echo get_the_title( $pid ); ?>  <br /><i style="font-size: 10px;margin-left: 15px;">(Front Page)</i>
								<a href="#layout|edit|page-<?php echo $pid; ?>" title='Edit this page' class='edit page-<?php echo $pid; ?>' data="{'id':'page-<?php echo $pid; ?>','title':'<?php echo get_the_title( $pid ); ?>'}"></a>
							</li>
								
							<?php	
							}
						}
				?>				
				<li>
					<span></span>
					404 page
					<a href="#layout|edit|404" title='Edit this page' class='edit 404' data="{'id':'404','title':'404'}"></a>
				</li>				
				<li>
					<span></span>
					Search result
					<a href="#layout|edit|search"  title='Edit this page' class='edit search' data="{'id':'search','title':'Search'}"></a>
				</li>				
				<li>
					<span></span>
					Archives
					<a href="#layout|edit|archive"  title='Edit this page' class='edit archives' data="{'id':'archives','title':'Archives'}"></a>
				</li>	
			</ul>
		</div>	
			
		
		<?php
		
		$custom_type = '';
		
		foreach ( array('high', 'sorted', 'core', 'default', 'low') as $priority ) {
			if ( isset($wp_meta_boxes[$page][$context][$priority]) ) {
				foreach ( (array) $wp_meta_boxes[$page][$context][$priority] as $box ) {
					if ( false == $box || ! $box['title'] ){
						continue;
					}	
					$i++;
					$style = '';
					$hidden_class = in_array($box['id'], $hidden) ? ' hide-if-js' : '';

					if( in_array( $box['args']->name, array('page','post','category','post_tag') ) ){
						
						call_user_func($box['callback'].'_custom_bydevn', $object, $box);
						
					}else{
							
						$custom_type .= '<li><span></span>'.(str_replace(array('-','_'),array(' ',' '),$box['args']->name)).'<a href="#layout|edit|'.$box['args']->name.'" title="Edit '.$box['args']->name.'" class="edit '.$box['args']->name.'" data="{\'id\':\''.$box['args']->name.'\',\'title\':\''.(str_replace(array('-','_'),array(' ',' '),$box['args']->name)).'\'}\"></a></li>';	
						
					}

				}
			}
		}
		
		echo "<h3>Custom Post Type</h3>";
		echo '<div id="list-pages-designbox">';
		echo '<ul>'.$custom_type.'</ul></div>';
		
	} while(0);

	?>
	
		<h3 title="<?php _e('The layout have been created','devn'); ?>" class="listavl">
			<strong><?php _e('Layouts Created','devn'); ?></strong>
			<a title="Create new layout" href="#layout|add" class="add alignright"><i class="icon icon-plus"></i></a>
		</h3>
		<div>
			<ul id="availabel-layouts">
			
			<?php
			
				if ($handle = opendir(dirname(__FILE__).DS.'layouts')) {
					/* This is the correct way to loop over the directory. */
					while (false !== ($entry = readdir($handle))) {
						if( $entry != '.' && $entry != '..' && strpos($entry, '.xml') !== false ){
							$devn_xml = @simplexml_load_file( dirname(__FILE__).DS.'layouts'.DS.$entry );
							?>
							
							<li>
								<span></span>
								<?php 
									echo $devn_xml->title;
									
									$ediLi = '';
									if( $devn_xml->type != 'Custom' ){
										$ediLi .= $devn_xml->type;
									}
									if( !empty($devn_xml->id) ){
										if( $ediLi != '' ){
											$ediLi .= '-';
										}
										$ediLi .= $devn_xml->id;
									}
								 ?>
								<a href="#layout|edit|<?php echo $ediLi; ?>" title='Edit <?php echo $devn_xml->title; ?>' class='edit <?php echo $ediLi; ?>'  data="{'id':'<?php echo $ediLi; ?>','title':'<?php echo $devn_xml->title; ?>'}"></a>
							</li>
							
							<?php
						}
					}
				}	

			?>
				
			</ul>
		</div>		
		
		<h3 title="<?php _e('The group have been created','devn'); ?>" class="listavl">
			<strong><?php _e('Groups Created','devn'); ?></strong>
			<a title="Create new group" href="#group|add" class="add alignright"><i class="icon icon-plus"></i></a>
		</h3>
		<div>
			<ul id="availabel-groups">
			
			<?php
			
			if ( $handle = opendir(dirname(__FILE__).DS.'layouts'.DS.'groups')) {
					/* This is the correct way to loop over the directory. */
					while (false !== ($entry = readdir($handle))) {
						if( $entry != '.' && $entry != '..' && strpos($entry, '.xml') !== false ){
							$devn_xml2 = @simplexml_load_file( dirname(__FILE__).DS.'layouts'.DS.'groups'.DS.$entry );
							?>
							
							<li>
								<span></span>
								<?php echo $devn_xml2->title; ?>
								<a href="#layout|edit|groups[DS]<?php echo $devn_xml2->id; ?>" title='Edit <?php echo $devn_xml2->title; ?>' class='edit groups-<?php echo $devn_xml2->id; ?>' data="{'id':'groups[DS]<?php echo $devn_xml2->id; ?>','title':'<?php echo $devn_xml2->title; ?>'}"></a>
							</li>
							
						<?php	
						}
					}
				}
				
				?>
			
				
			</ul>
		</div>	
		
		<br />
		<br />
		<br />
		<br />
	<?php
	
	return $i;

}

/*-----------------------------------------------------------------------------------*/
# Helper: List post type on Vitual Design Layouts
/*-----------------------------------------------------------------------------------*/


function wp_nav_menu_item_post_type_meta_box_custom_bydevn( $object, $post_type ) {
	
	global $_nav_menu_placeholder, $nav_menu_selected_id, $wpdb;

	$post_type_name = $post_type['args']->name;
	
	echo "<h3>{$post_type_name}<a href=\"#layout|edit|{$post_type_name}\" title='Edit {$post_type_name} - This layout will be Affected to all children' class='edit {$post_type_name}'  data=\"{'id':'{$post_type_name}','title':'{$post_type_name}'}\"";

	echo "></a></h3>";
	
	if( $post_type_name == 'post' )
	{
		echo '<div><label class="no-items">Affected all kinds of articles.</label></div>';return;
	}else if( $post_type_name == 'page' ){

	$posts = $wpdb->get_results("SELECT `ID`,`post_name`,`post_title` FROM `".$wpdb->posts."` WHERE `post_type`='{$post_type_name}' LIMIT 1000");

	if ( !count( $posts ) ){
		echo '<div><label class="no-items">No items</label></div>';
		return;
	}

	
	?>
	
	
	<div id="list-pages-designbox">
		<p>
			<?php echo wp_dropdown_pages( array( 'name' => 'select_page_for_edit_layout', 'echo' => 0, 'show_option_none' => __( '&mdash; Select Page &mdash;' ,'devn' ), 'option_none_value' => '0', 'selected' => '' ) ); ?>
		</p>
		<ul style="display:none">
			<?php 
				foreach( $posts as $post ){
					if( $post->post_title != 'Auto Draft' && $post->post_name != '' )
					{
						echo "<li><span></span>{$post->post_name}<a href=\"#layout|edit|{$post_type_name}-{$post->ID}\" title='Edit \"{$post->post_name}\"' class='edit {$post_type_name}-{$post->ID}' data=\"{'id':'{$post_type_name}".'-'."{$post->ID}','title':'{$post->post_name}'}\"></a></li>";
					}	
				}
			?>
		</ul>
	</div>
	
	<?php
	
	}
}

/*-----------------------------------------------------------------------------------*/
# Helper: List taxonomy on Vitual Design Layouts
/*-----------------------------------------------------------------------------------*/


function wp_nav_menu_item_taxonomy_meta_box_custom_bydevn( $object, $taxonomy ) {

	global $nav_menu_selected_id;
	$taxonomy_name = $taxonomy['args']->name;
	
	echo "<h3>{$taxonomy_name}<a href=\"#layout|edit|{$taxonomy_name}\" title='Edit {$taxonomy_name} - This layout will be Affected to all children' class='edit {$taxonomy_name}' data=\"{'id':'{$taxonomy_name}','title':'{$taxonomy_name}'}\"></a></h3>";
	
	$per_page = 1000;
	$pagenum = isset( $_REQUEST[$taxonomy_name . '-tab'] ) && isset( $_REQUEST['paged'] ) ? absint( $_REQUEST['paged'] ) : 1;
	$offset = 0 < $pagenum ? $per_page * ( $pagenum - 1 ) : 0;

	$args = array(
		'child_of' => 0,
		'exclude' => '',
		'hide_empty' => false,
		'hierarchical' => 1,
		'include' => '',
		'number' => $per_page,
		'offset' => $offset,
		'order' => 'ASC',
		'orderby' => 'name',
		'pad_counts' => false,
	);

	$terms = get_terms( $taxonomy_name, $args );

	if ( ! $terms || is_wp_error($terms) ) {
		echo '<div><label class="no-items">No items.</label></div>';
		return;
	}


	?>
	
	<?php //echo $taxonomy_name; ?>
	<div>
		<ul>
			<?php

				foreach( $terms as $term ){
					echo "<li><span></span>{$term->name}<a href=\"#layout|edit|{$taxonomy_name}-{$term->term_id}\" title='Edit {$term->name}'  class='edit {$taxonomy_name}-{$term->term_id}' data=\"{'id':'{$taxonomy_name}-{$term->term_id}','title':'{$term->name}'}\"></a></li>";
				}
			
			?>
		</ul>
	</div>
	<?php
}

/*-----------------------------------------------------------------------------------*/
# Helper: list page on Vitual Design Layouts
/*-----------------------------------------------------------------------------------*/

function devn_bwp_url_to_postid($url)
{
	global $wp_rewrite;

	$url = apply_filters('url_to_postid', $url);

	// First, check to see if there is a 'p=N' or 'page_id=N' to match against
	if ( preg_match('#[?&](p|page_id|attachment_id)=(\d+)#', $url, $values) )	{
		$id = absint($values[2]);
		if ( $id )
			return $id;
	}

	// Check to see if we are using rewrite rules
	$rewrite = $wp_rewrite->wp_rewrite_rules();

	// Not using rewrite rules, and 'p=N' and 'page_id=N' methods failed, so we're out of options
	if ( empty($rewrite) )
		return 0;

	// Get rid of the #anchor
	$url_split = explode('#', $url);
	$url = $url_split[0];

	// Get rid of URL ?query=string
	$url_split = explode('?', $url);
	$url = $url_split[0];

	// Add 'www.' if it is absent and should be there
	if ( false !== strpos(home_url(), '://www.') && false === strpos($url, '://www.') )
		$url = str_replace('://', '://www.', $url);

	// Strip 'www.' if it is present and shouldn't be
	if ( false === strpos(home_url(), '://www.') )
		$url = str_replace('://www.', '://', $url);

	// Strip 'index.php/' if we're not using path info permalinks
	if ( !$wp_rewrite->using_index_permalinks() )
		$url = str_replace('index.php/', '', $url);

	if ( false !== strpos($url, home_url()) ) {
		// Chop off http://domain.com
		$url = str_replace(home_url(), '', $url);
	} else {
		// Chop off /path/to/blog
		$home_path = parse_url(home_url());
		$home_path = isset( $home_path['path'] ) ? $home_path['path'] : '' ;
		$url = str_replace($home_path, '', $url);
	}

	// Trim leading and lagging slashes
	$url = trim($url, '/');

	$request = $url;
	// Look for matches.
	$request_match = $request;
	foreach ( (array)$rewrite as $match => $query) {
		// If the requesting file is the anchor of the match, prepend it
		// to the path info.
		if ( !empty($url) && ($url != $request) && (strpos($match, $url) === 0) )
			$request_match = $url . '/' . $request;

		if ( preg_match("!^$match!", $request_match, $matches) ) {
			// Got a match.
			// Trim the query of everything up to the '?'.
			$query = preg_replace("!^.+\?!", '', $query);

			// Substitute the substring matches into the query.
			$query = addslashes(WP_MatchesMapRegex::apply($query, $matches));

			// Filter out non-public query vars
			global $wp;
			parse_str($query, $query_vars);
			$query = array();
			foreach ( (array) $query_vars as $key => $value ) {
				if ( in_array($key, $wp->public_query_vars) )
					$query[$key] = $value;
			}

		// Taken from class-wp.php
		foreach ( $GLOBALS['wp_post_types'] as $post_type => $t )
			if ( $t->query_var )
				$post_type_query_vars[$t->query_var] = $post_type;

		foreach ( $wp->public_query_vars as $wpvar ) {
			if ( isset( $wp->extra_query_vars[$wpvar] ) )
				$query[$wpvar] = $wp->extra_query_vars[$wpvar];
			elseif ( isset( $_POST[$wpvar] ) )
				$query[$wpvar] = $_POST[$wpvar];
			elseif ( isset( $_GET[$wpvar] ) )
				$query[$wpvar] = $_GET[$wpvar];
			elseif ( isset( $query_vars[$wpvar] ) )
				$query[$wpvar] = $query_vars[$wpvar];

			if ( !empty( $query[$wpvar] ) ) {
				if ( ! is_array( $query[$wpvar] ) ) {
					$query[$wpvar] = (string) $query[$wpvar];
				} else {
					foreach ( $query[$wpvar] as $vkey => $v ) {
						if ( !is_object( $v ) ) {
							$query[$wpvar][$vkey] = (string) $v;
						}
					}
				}

				if ( isset($post_type_query_vars[$wpvar] ) ) {
					$query['post_type'] = $post_type_query_vars[$wpvar];
					$query['name'] = $query[$wpvar];
				}
			}
		}

			// Do the query
			$query = new WP_Query($query);
			if ( !empty($query->posts) && $query->is_singular )
				return $query->post;
			else
				return 0;
		}
	}
	return 0;
}

/*-----------------------------------------------------------------------------------*/
# Comment template
/*-----------------------------------------------------------------------------------*/

function devn_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;
	
	switch ( $comment->comment_type ) :
		case 'pingback' : break;
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'devn' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'devn' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class('comment_wrap'); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			
			<?php
				$avatar_size = 68;
				if ( '0' != $comment->comment_parent )
					$avatar_size = 39;

				echo '<div class="gravatar">'.get_avatar( $comment, $avatar_size ).'</div>';
						
			?>			
			<div class="comment_content">
				<div class="comment_meta">
					<div class="comment_author">
						<?php
							/* translators: 1: comment author, 2: date and time */
							printf( __( '%1$s - %2$s ', 'devn' ),
								sprintf( '%s', get_comment_author_link() ),
								sprintf( '<i>%1$s</i>',
									sprintf( __( '%1$s at %2$s', 'devn' ), get_comment_date(), get_comment_time() )
								)
							);
						?>
	
						<?php edit_comment_link( __( 'Edit', 'devn' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-author .vcard -->
	
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'devn' ); ?></em>
						<br />
					<?php endif; ?>
	
				</div>

				<div class="comment_text">
					<?php comment_text(); ?>
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'devn' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div>
				
			</div>
		</article><!-- #comment-## -->

	<?php
	break;
	endswitch;
}

/*-----------------------------------------------------------------------------------*/
# Next and Prev link post on single page
/*-----------------------------------------------------------------------------------*/

function devn_content_nav( $nav_id ) {

	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'devn' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'devn' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'devn' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
	
}

/*-----------------------------------------------------------------------------------*/
# pagination on blog page
/*-----------------------------------------------------------------------------------*/

function devn_pagination( ) {
	
	global $wp_query,$wpse16243_title;
	$curpage = $wp_query->query_vars['paged'];
	if( $curpage == 0 ){
		$curpage = 1;
	}
	
	if( $wp_query->max_num_pages < 2 ){
		return;
	}
	
	$pagination = array(
		'base' => @add_query_arg('paged','%#%'),
		'format' => '/page/%#%',
		'total' => $wp_query->max_num_pages,
		'current' => $curpage,
		'show_all' => false,
		'type' => 'array',
		'prev_next'=> true,
		'prev_text'=> ' &lt; Previous ',
		'next_text'=> ' Next &gt; '				
	);

	if( !empty($wp_query->query_vars['s'] ) ){
			$pagination['add_args'] = array( 's' => urlencode( get_query_var( 's' ) ) );
	}
	$pgn = paginate_links( $pagination );
	
	?>
	
	<div class="pagination animated ext-fadeInUp" id="pagenation">
	    <b>Page <?php echo $curpage; ?> of <?php echo $wp_query->max_num_pages; ?></b>
        <?php 
        	foreach( $pgn as $k => $link ){
				echo $link;
			}
		?>
    </div>
    
    <?php
		
	
}


/*-----------------------------------------------------------------------------------*/
# Display meta box on article
/*-----------------------------------------------------------------------------------*/


function devn_posted_on( $class = "postedon" ) {

	global $devn_settings;
	
	?>

	<ul class="<?php echo $class; ?>">
	
		<?php if( $devn_settings['showAuthorMeta'] == 1 ){ ?>
			<li class="post_by">
				<a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'View all posts by %s', 'devn' ), get_the_author() ) ); ?>" rel="author">
					<?php echo get_the_author(); ?>
				</a>
			</li>
		<?php } ?>
		
		<?php
		
		
		if( $devn_settings['showCateMeta'] == 1 ){ 
		
			if ( 'post' == get_post_type() ){
	
				$categories_list = get_the_category_list( __( ',', 'devn' ) );
				
				if ( $categories_list ){
				
					echo '<li class="post_categoty">';
			        echo get_the_category_list( __( ',', 'devn' ) );
			        echo '</li>';
	
				}
			}	
				
		} 
		
		if( $devn_settings['showTagsMeta'] == 1 ){
		
			$tags_list = get_the_tag_list( '', __( ', ', 'devn' ) );
			
			if ( $tags_list ){
				
				echo '<li class="tag-links">';
				printf( __( '<span class="%1$s labl">Tags: </span> %2$s', 'devn' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
				echo '</li>';
	
			}
	
		}
	
		if( $devn_settings['showCommentsMeta'] == 1 ){
		?>
			 <li class="post_comments">
	            <a  title="'.__('Click to leave a comment','devn').'" href="#respond">
	            	<?php echo comments_number( 'no comments', 'one comment', '% comments' ); ?>
	            </a>
	        </li>
	    <?php  
		}
	
	echo '</ul>';
	
}

/*-----------------------------------------------------------------------------------*/
# Global breadcrumb
/*-----------------------------------------------------------------------------------*/

function socials( $eff = false ) {
global $devn_settings;
$i=0;
?>

	<?php if( $devn_settings['facebook'] != '' ){ $i = $i+200; ?>
	<li class="social <?php if( $eff == true ){ ?>animated eff-zoomIn delay-<?php } echo $i; ?>ms">
		<a href="https://www.facebook.com/<?php echo $devn_settings['facebook']; ?>" target="_blank">
			<i class="fa fa-facebook">
			</i>
		</a>
	</li>
	<?php } ?>
	<?php if( $devn_settings['twitter'] != '' ){ $i = $i+200; ?>
	<li class="social <?php if( $eff == true ){ ?>animated eff-zoomIn delay-<?php } echo $i; ?>ms">
		<a href="https://www.twitter.com/<?php echo $devn_settings['twitter']; ?>" target="_blank">
			<i class="fa fa-twitter">
			</i>
		</a>
	</li>
	<?php } ?>
	<?php if( $devn_settings['google'] != '' ){ $i = $i+200; ?>
	<li class="social <?php if( $eff == true ){ ?>animated eff-zoomIn delay-<?php } echo $i; ?>ms">
		<a href="https://plus.google.com/<?php echo $devn_settings['google']; ?>" target="_blank">
			<i class="fa fa-google-plus">
			</i>
		</a>
	</li>
	<?php } ?>
	<?php if( $devn_settings['linkedin'] != '' ){ $i = $i+200; ?>
	<li class="social <?php if( $eff == true ){ ?>animated eff-zoomIn delay-<?php } echo $i; ?>ms">
		<a href="https://www.linkedin.com/in/<?php echo $devn_settings['linkedin']; ?>" target="_blank">
			<i class="fa fa-linkedin">
			</i>
		</a>
	</li>
	<?php } ?>
	<?php if( $devn_settings['flickr'] != '' ){ $i = $i+200; ?>
	<li class="social <?php if( $eff == true ){ ?>animated eff-zoomIn delay-<?php } echo $i; ?>ms">
		<a href="https://www.flickr.com/photos/<?php echo $devn_settings['flickr']; ?>" target="_blank">
			<i class="fa fa-flickr">
			</i>
		</a>
	</li>
	<?php } ?>
	<?php if( $devn_settings['pinterest'] != '' ){ $i = $i+200; ?>
	<li class="social <?php if( $eff == true ){ ?>animated eff-zoomIn delay-<?php } echo $i; ?>ms">
		<a href="https://www.pinterest.com/<?php echo $devn_settings['pinterest']; ?>" target="_blank">
			<i class="fa fa-pinterest">
			</i>
		</a>
	</li>
	<?php } ?>
	<?php if( $devn_settings['youtube'] != '' ){ $i = $i+200; ?>
	<li class="social <?php if( $eff == true ){ ?>animated eff-zoomIn delay-<?php } echo $i; ?>ms">
		<a href="https://www.youtube.com/user/<?php echo $devn_settings['youtube']; ?>" target="_blank">
			<i class="fa fa-youtube">
			</i>
		</a>
	</li>
	<?php } ?>
	<?php if( $devn_settings['feed'] != '' ){ $i = $i+200; ?>
	<li class="social <?php if( $eff == true ){ ?>animated eff-zoomIn delay-<?php } echo $i; ?>ms">
		<a href="<?php echo $devn_settings['feed']; ?>" target="_blank">
			<i class="fa fa-rss">
			</i>
		</a>
	</li>
	<?php } ?>

	
<?php
}
/*-----------------------------------------------------------------------------------*/
# Global breadcrumb
/*-----------------------------------------------------------------------------------*/

function breadcrumb() {

	global $devn_settings,$post,$devn_curFile;
	
	echo '<div class="title"><h1>';
	
		if( is_front_page() ){
			echo get_bloginfo( 'name' );
		}else if(is_single()){
			echo __('Single Post','devn');
		}else{ 
			echo wp_title( null, false ); 
		}
		
	echo '</h1></div>';
	echo '<div class="pagenation">';
	echo '<div class="breadcrumbs">';
	
    if ( !is_front_page() ) {
		echo '<a href="'.home_url().'">'.__('Home','devn')."</a> ";
	}
	
	if( $devn_curFile == 'index' ){
		if(  get_option('page_for_posts') ){
			$curPost = get_post( get_option('page_for_posts') );
			echo $devn_settings['breadeli'].' '.$curPost->post_title.' ';
		}
	}
	
	
	if ( is_category() ) {echo 34535;
		echo $devn_settings['breadeli'].' '.single_cat_title( '', false );
	}
	
	if( is_page() ){
	
		if( $post->post_parent ){
			$parent = get_post( $post->post_parent );
			echo $devn_settings['breadeli'].' <a href="'.get_permalink( $post->post_parent ).'">'.$parent->post_title.'</a> ';
		}
	}
	if( ( is_single() || is_page() ) && !is_front_page() ) {
		echo ' '.$devn_settings['breadeli']." <span>";
		the_title();
		echo "</span>";
	}
	if(is_tag()){ echo $devn_settings['breadeli']." <span>Tag: ".single_tag_title('',FALSE).'</span>'; }
	if(is_404()){ echo $devn_settings['breadeli']." <span>404 - Page not Found</span>"; }
	if(is_search()){ echo $devn_settings['breadeli']." <span>Search</span>"; }
	if(is_year()){ echo $devn_settings['breadeli'].' '.get_the_time('Y'); }

	echo "</div>";
	echo "</div>";

}

/*-----------------------------------------------------------------------------------*/
# Return string of the first image in a post
/*-----------------------------------------------------------------------------------*/

function devn_images_attached( $id ){

	$args = array(
		'post_type'   => 'attachment',
		'numberposts' => -1,
		'post_status' => null,
		'post_parent' => $id,
		'exclude'     => get_post_thumbnail_id()
		);

	$attachments = get_posts( $args );
	$output = array();
	if ( $attachments ) {
		foreach ( $attachments as $attachment ) {
			$att = wp_get_attachment_image_src($attachment->ID);
			if(!empty($att))array_push( $output, $att );
		}
	}
	
	return $output;

}

function devn_get_first_image( $content, $id = null ) {
	
	$first_img = devn_get_first_video( $content );
	
	if( $first_img != null ){
		if( strpos( $first_img, 'youtube' ) !== false )return $first_img;
	}
	
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
	if( !empty($matches [1]) )
		if( !empty($matches [1][0]) )
			$first_img = $matches [1] [0];

	if(empty($first_img)){
		
		if($id != null)$first = devn_images_attached( $id );
		
		if( !empty( $first[0] ) )
			return $first[0][0];
	
		else $first_img = get_template_directory_uri()."/images/default.png";
	}
	
	return $first_img;
	
}

function devn_get_first_video( $content ) {

	$first_video = null;
	$output = preg_match_all('/<iframe.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
	if( !empty($matches [1]) ){
		if( !empty($matches [1][0]) ){
			$first_video = $matches [1] [0];
		}	
	}		

	return 	$first_video;	
	
}


function devn_get_featured_image( $post, $first = true ) {
	
	$featured = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
	
	if( empty($featured) )
	{
		if( $first == true )return devn_get_first_image( $post->post_content, $post->ID );
		else return get_template_directory_uri()."/images/default.png";
	}	
	return $featured[0];
	
}


/*-----------------------------------------------------------------------------------*/
# Find and get featured or the first image of a post
/*-----------------------------------------------------------------------------------*/


function devn_show_featured_image( $post ){

	$featured = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
	
	if( empty($featured) )
		return;
		
	echo '<img  class="alignnone size-full wp-image-800" src="'.$featured[0].'" alt="'.$post->post_title.'" />';	
	
}

/*-----------------------------------------------------------------------------------*/
# Call content builder
/*-----------------------------------------------------------------------------------*/

function devn_builder( $id = 0 ){

	$rows = json_decode( devnExt::base64( 'decode', get_post_meta( $id, $key = 'dsbuilder_content', $single = true )) );

	if( count($rows) )
	{
		foreach( $rows as $row ){
		?>
			<div class="row-fluid dsbuilder-row">
				
				<?php
					foreach( $row as $span ){
						
					?>
						<div class="<?php echo $span->span; ?>">
							<div class="shortcode">
								<div class="shortcode-body ui-sortable" idsufix="<?php echo $span->idSuffix; ?>" classsufix="<?php echo $span->classSuffix; ?>">
								
								<?php
									foreach( $span->shortcodes as $shortcode ){
										
										echo do_shortcode( str_replace( array('&lt;','&gt;'), array('<','>'), $shortcode->short ) );
									
									}
								?>

							</div>
						</div>
					</div>	
				<?php
				
				}
				
			echo '</div>';
			
		} 
	} 
}


function devn_create_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null ) {
	global $menu, $admin_page_hooks, $_registered_pages, $_parent_pages;

	$menu_slug = plugin_basename( $menu_slug );

	$admin_page_hooks[$menu_slug] = sanitize_title( $menu_title );

	$hookname = get_plugin_page_hookname( $menu_slug, '' );

	if ( !empty( $function ) && !empty( $hookname ) && current_user_can( $capability ) )
		add_action( $hookname, $function );

	if ( empty($icon_url) ) {
		$icon_url = 'none';
		$icon_class = 'menu-icon-generic ';
	} else {
		$icon_url = set_url_scheme( $icon_url );
		$icon_class = '';
	}

	$new_menu = array( $menu_title, $capability, $menu_slug, $page_title, 'menu-top ' . $icon_class . $hookname, $hookname, $icon_url );

	if ( null === $position )
		$menu[] = $new_menu;
	else
		$menu[$position] = $new_menu;

	$_registered_pages[$hookname] = true;

	// No parent as top level
	$_parent_pages[$menu_slug] = false;

	return $hookname;
}


function devn_create_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function = '' ) {

	global $submenu;
	global $menu;
	global $_wp_real_parent_file;
	global $_wp_submenu_nopriv;
	global $_registered_pages;
	global $_parent_pages;

	$menu_slug = plugin_basename( $menu_slug );
	$parent_slug = plugin_basename( $parent_slug);

	if ( isset( $_wp_real_parent_file[$parent_slug] ) )
		$parent_slug = $_wp_real_parent_file[$parent_slug];

	if ( !current_user_can( $capability ) ) {
		$_wp_submenu_nopriv[$parent_slug][$menu_slug] = true;
		return false;
	}

	if (!isset( $submenu[$parent_slug] ) && $menu_slug != $parent_slug ) {
		foreach ( (array)$menu as $parent_menu ) {
			if ( $parent_menu[2] == $parent_slug && current_user_can( $parent_menu[1] ) )
				$submenu[$parent_slug][] = $parent_menu;
		}
	}

	$submenu[$parent_slug][] = array ( $menu_title, $capability, $menu_slug, $page_title );

	$hookname = get_plugin_page_hookname( $menu_slug, $parent_slug);
	if (!empty ( $function ) && !empty ( $hookname ))
		add_action( $hookname, $function );

	$_registered_pages[$hookname] = true;

	if ( 'tools.php' == $parent_slug )
		$_registered_pages[get_plugin_page_hookname( $menu_slug, 'edit.php')] = true;

	$_parent_pages[$menu_slug] = $parent_slug;

	return $hookname;
}

/*-----------------------------------------------------------------------------------*/
# Helper: copy of layout in Vitual Design Layouts
/*-----------------------------------------------------------------------------------*/

function devn_available_blocks( $ignor = '', $class = '' )
{

?>
	<ul id="layouts-list" class="<?php echo $class ?>">
		<li class="copyLayoutOf" id="general" style="color:red" title="Delete this layout and use parent's layout">
			<a href="#layout|using|general">
				<strong><?php echo __("General  Layout", 'devn'); ?></strong></li>		
			</a>
		<?php
			if ($handle = opendir(dirname(__FILE__).DS.'layouts')) {
				/* This is the correct way to loop over the directory. */
				while (false !== ($entry = readdir($handle))) {
					if( $entry != '.' && $entry != '..' && $entry != 'general.xml' && $entry != $ignor.'.xml' && strpos($entry, '.xml') !== false  ){
					
						$devn_xml = @simplexml_load_file( dirname(__FILE__).DS.'layouts'.DS.$entry );

						$title = '<strong>'.$devn_xml->title.'</strong> '.'<i>'.$devn_xml->type.'</i>';	
						echo '<li title="Update at '.$devn_xml->update.'" class="copyLayoutOf"><a href="#layout|using|'.str_replace('.xml','',$entry).'">'.$title.'</a></li>';
					}	
				}

				closedir($handle);
			}
		?>
	</ul>
<?php

}

/*-----------------------------------------------------------------------------------*/
# Re-write list widgets
/*-----------------------------------------------------------------------------------*/

function devn_wp_list_widgets_fix() {
	global $wp_registered_widgets, $devn_sidebars_widgets, $wp_registered_widget_controls,$devn_widgetCfg,$wd;

	$sort = $wp_registered_widgets;
	usort( $sort, '_sort_name_callback_fix' );

	$done = array();

	$wd=1;
	foreach ( $sort as $widget ) {
		if ( in_array( $widget['callback'], $done, true ) )
			continue;
		if( !empty($devn_widgetCfg[$widget['callback'][0]->id_base]) )
		{
			$wgCfg = $devn_widgetCfg[$widget['callback'][0]->id_base];
			if( !empty($wgCfg['ignore']) )
				if( $wgCfg['ignore'] == true )
					continue;
			/* Remove widget configuration eliminates */	
		}	
			
		$sidebar = is_active_widget( $widget['callback'], $widget['id'], false, false );
		$done[] = $widget['callback'];

		if ( ! isset( $widget['params'][0] ) )
			$widget['params'][0] = array();

		$args = array( 'widget_id' => $widget['id'], 'widget_name' => $widget['name'], '_display' => 'template' );

		if ( isset($wp_registered_widget_controls[$widget['id']]['id_base']) && isset($widget['params'][0]['number']) ) {
			$id_base = $wp_registered_widget_controls[$widget['id']]['id_base'];
			$args['_temp_id'] = "$id_base-__i__";
			$args['_multi_num'] = next_widget_id_number($id_base);
			$args['_add'] = 'multi';
		} else {
			$args['_add'] = 'single';
			if ( $sidebar )
				$args['_hide'] = '1';
		}

		$args = wp_list_widget_controls_dynamic_sidebar( array( 0 => $args, 1 => $widget['params'][0] ) );
		call_user_func_array( 'wp_widget_control_fix', $args );
		$wd++;
	}
}


function _sort_name_callback_fix( $a, $b ) {
	global $devn_widgetCfg;
	$one = array_search( $a['callback'][0]->id_base, array_keys($devn_widgetCfg) );
	$two = array_search( $b['callback'][0]->id_base, array_keys($devn_widgetCfg) );
	if( empty($one) )$one = 1000;	
	if( empty($two) )$two = 1000;
	if( $one == $two )return 0;
    return ($one < $two) ? -1 : 1;
	
}
/*-----------------------------------------------------------------------------------*/
# Insert widget's HTML Result into cache textarea 
/*-----------------------------------------------------------------------------------*/


function wp_widget_control_fix( $sidebar_args ) {

	global $wp_registered_widgets, $wp_registered_widget_controls, $devn_sidebars_widgets, $devn_widgetCfg, $wd;

	$widget_id = $sidebar_args['widget_id'];
	$sidebar_id = isset($sidebar_args['id']) ? $sidebar_args['id'] : false;
	$key = $sidebar_id ? array_search( $widget_id, $devn_sidebars_widgets[$sidebar_id] ) : '-1'; // position of widget in sidebar
	$control = isset($wp_registered_widget_controls[$widget_id]) ? $wp_registered_widget_controls[$widget_id] : array();
	$widget = $wp_registered_widgets[$widget_id];

	$id_format = $widget['id'];
	$widget_number = isset($control['params'][0]['number']) ? $control['params'][0]['number'] : '';
	$id_base = isset($control['id_base']) ? $control['id_base'] : $widget_id;
	$multi_number = isset($sidebar_args['_multi_num']) ? $sidebar_args['_multi_num'] : '';
	$add_new = isset($sidebar_args['_add']) ? $sidebar_args['_add'] : '';

	$query_arg = array( 'editwidget' => $widget['id'] );
	if ( $add_new ) {
		$query_arg['addnew'] = 1;
		if ( $multi_number ) {
			$query_arg['num'] = $multi_number;
			$query_arg['base'] = $id_base;
		}
	} else {
		$query_arg['sidebar'] = $sidebar_id;
		$query_arg['key'] = $key;
	}

	// We aren't showing a widget control, we're outputting a template for a multi-widget control
	if ( isset($sidebar_args['_display']) && 'template' == $sidebar_args['_display'] && $widget_number ) {
		// number == -1 implies a template where id numbers are replaced by a generic '__i__'
		$control['params'][0]['number'] = -1;
		// with id_base widget id's are constructed like {$id_base}-{$id_number}
		if ( isset($control['id_base']) )
			$id_format = $control['id_base'] . '-__i__';
	}

	$wp_registered_widgets[$widget_id]['callback'] = $wp_registered_widgets[$widget_id]['_callback'];
	unset($wp_registered_widgets[$widget_id]['_callback']);

	$widget_title = esc_html( strip_tags( $sidebar_args['widget_name'] ) );
	$has_form = 'noform';

	$callBackFunc = get_class($wp_registered_widgets[$widget_id]['callback'][0]);

	ob_start();
		$wgClass = new $callBackFunc();
		global $wp_widget_factory;
		$widget_obj = $wp_widget_factory->widgets[$callBackFunc];
		$before_widget = sprintf('<aside class="widget %s bounceIn animated">', $widget_obj->widget_options['classname'] );
		$args = array( 'before_widget' => $before_widget, 'after_widget' => "</aside>", 'before_title' => '<h3 class="widget-title">', 'after_title' => '</h2>', 'title' => ' ' );
		
		if( !empty($devn_widgetCfg[$id_base]) ){
			$devn_widgetCfg[$id_base]['title'] = '';
			$devn_widgetCfg[$id_base]['content'] = '';
			$wgClass->widget( $args , $devn_widgetCfg[$id_base] );
		}else{
			echo '<br /><p>Content preview</p><br />';
		}
			
		$text =  ob_get_contents();
	ob_end_clean();
	
	$icon = '';
	if( !empty($devn_widgetCfg['default']) )
		$icon = $devn_widgetCfg['default'];
	if( !empty($devn_widgetCfg[$id_base]) ){
		if( !empty($devn_widgetCfg[$id_base]['icon']) )
			$icon = $devn_widgetCfg[$id_base]['icon'];
	}


	echo $sidebar_args['before_widget']; ?>
	
	<div class="widget-top">
	<div class="widget-title-action">
		<a class="widget-action hide-if-no-js" href="#available-widgets"></a>
		<a class="widget-control-edit hide-if-js" href="<?php echo esc_url( add_query_arg( $query_arg ) ); ?>">
			<span class="edit"><?php _ex( 'Edit', 'widget' ); ?></span>
			<span class="add"><?php _ex( 'Add', 'widget' ); ?></span>
			<span class="screen-reader-text"><?php echo $widget_title; ?></span>
		</a>
	</div>
	<div class="widget-title"><h4><i class="fa fa-<?php echo $icon; ?>"></i> <?php echo $widget_title ?><span class="in-widget-title"></span></h4></div>
	</div>

	<div class="widget-inside">
	<textarea class='html2cache <?php echo $id_base; ?>'  style='display:none'><?php echo devnExt::base64( 'encode', $text ); ?></textarea>
	<form action="" method="post">
	<div class="widget-content">
<?php
	if ( isset($control['callback']) )
		$has_form = call_user_func_array( $control['callback'], $control['params'] );
	else
		echo "\t\t<p>" . __('There are no options for this widget.','devn') . "</p>\n"; ?>
	</div>
	<input type="hidden" name="widget-id" class="widget-id" value="<?php echo esc_attr($id_format); ?>" />
	<input type="hidden" name="id_base" class="id_base" value="<?php echo esc_attr($id_base); ?>" />
	<input type="hidden" name="widget-width" class="widget-width" value="<?php if (isset( $control['width'] )) echo esc_attr($control['width']); ?>" />
	<input type="hidden" name="widget-height" class="widget-height" value="<?php if (isset( $control['height'] )) echo esc_attr($control['height']); ?>" />
	<input type="hidden" name="widget_number" class="widget_number" value="<?php echo esc_attr($widget_number); ?>" />
	<input type="hidden" name="multi_number" class="multi_number" value="<?php echo esc_attr($multi_number); ?>" />
	<input type="hidden" name="add_new" class="add_new" value="<?php echo esc_attr($add_new); ?>" />

	<div class="widget-control-actions">
		<div class="alignleft">
		<a class="widget-control-remove" href="#remove"><?php _e('Delete','devn'); ?></a> |
		<a class="widget-control-close" href="#close"><?php _e('Close','devn'); ?></a>
		</div>
		<div class="alignright<?php if ( 'noform' === $has_form ) echo ' widget-control-noform'; ?>">
			<?php submit_button( __( 'Save','devn' ), 'button-primary widget-control-save right', 'savewidget', false, array( 'id' => 'widget-' . esc_attr( $id_format ) . '-savewidget' ) ); ?>
			<span class="spinner"></span>
		</div>
		<br class="clear" />
	</div>
	</form>
	</div>

	<div class="widget-description wd<?php echo ($wd%2); ?>">
<?php echo ( $widget_description = wp_widget_description($widget_id) ) ? "$widget_description\n" : "$widget_title\n"; ?>
	</div>
<?php
	echo $sidebar_args['after_widget'];
	return $sidebar_args;
}

/**
*	Get a menu id
*/

function devn_getMenuId(){

	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	if( empty($menus) )
		return 0;
	foreach ( $menus as $menu ) {
		return $menu->term_id;
	}

}



function devn_wp_list_widget_controls_fix( $sidebar ) {
	add_filter( 'dynamic_sidebar_params', 'wp_list_widget_controls_dynamic_sidebar' );

	echo "<div id='$sidebar' class='widgets-sortables'>\n";

	$description = wp_sidebar_description( $sidebar );

	if ( !empty( $description ) ) {
		echo "<div class='sidebar-description'>\n";
		echo "\t<p class='description'>$description</p>";
		echo "</div>\n";
	}

	devn_dynamic_sidebar_fix( $sidebar );
	echo "</div>\n";
}



function devn_dynamic_sidebar_fix($index = 1) {

	global $wp_registered_sidebars, $wp_registered_widgets;

	if ( is_int($index) ) {
		$index = "sidebar-$index";
	} else {
		$index = sanitize_title($index);
		foreach ( (array) $wp_registered_sidebars as $key => $value ) {
			if ( sanitize_title($value['name']) == $index ) {
				$index = $key;
				break;
			}
		}
	}

	$devn_sidebars_widgets = wp_get_sidebars_widgets();
	if ( empty( $devn_sidebars_widgets ) )
		return false;

	if ( empty($wp_registered_sidebars[$index]) || !array_key_exists($index, $devn_sidebars_widgets) || !is_array($devn_sidebars_widgets[$index]) || empty($devn_sidebars_widgets[$index]) )
		return false;

	$sidebar = $wp_registered_sidebars[$index];

	$did_one = false;
	foreach ( (array) $devn_sidebars_widgets[$index] as $id ) {

		if ( !isset($wp_registered_widgets[$id]) ) continue;

		$params = array_merge(
			array( array_merge( $sidebar, array('widget_id' => $id, 'widget_name' => $wp_registered_widgets[$id]['name']) ) ),
			(array) $wp_registered_widgets[$id]['params']
		);

		// Substitute HTML id and class attributes into before_widget
		$classname_ = '';
		foreach ( (array) $wp_registered_widgets[$id]['classname'] as $cn ) {
			if ( is_string($cn) )
				$classname_ .= '_' . $cn;
			elseif ( is_object($cn) )
				$classname_ .= '_' . get_class($cn);
		}
		$classname_ = ltrim($classname_, '_');
		$params[0]['before_widget'] = sprintf($params[0]['before_widget'], $id, $classname_);

		$params = apply_filters( 'dynamic_sidebar_params', $params );

		$callback = 'wp_widget_control_fix';

		do_action( 'dynamic_sidebar', $wp_registered_widgets[$id] );

		if ( is_callable($callback) ) {
			call_user_func_array($callback, $params);
			$did_one = true;
		}
	}

	return $did_one;
}
/*-----------------------------------------------------------------------------------*/
# Get Most Racent posts
/*-----------------------------------------------------------------------------------*/
function devn_wp_last_posts($numberOfPosts = 5 , $thumb = true){
	global $post;
	$orig_post = $post;
	
	$lastPosts = get_posts('numberposts='.$numberOfPosts);
	foreach($lastPosts as $post): setup_postdata($post);
?>
	<li>
		<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) { ?>			
			<span>
				<a href="<?php echo get_permalink( $post->ID ) ?>" title="<?php printf( __( 'Permalink to %s', 'devn' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php devn_thumb('',50,50); ?></a>
			</span><!-- post-thumbnail /-->
		<?php }else{ ?>
		<span><a href="#"><img width="50"" src="<?php echo THEME_URI; ?>/images/default.jpg" alt=""></a></span>
		<?php } ?>
		
		<a href="<?php echo get_permalink( $post->ID ) ?>" title="<?php echo the_title(); ?>"><?php echo the_title(); ?></a>
		<?php devn_get_score(); ?> 
		<i><?php the_time(get_option('date_format'));  ?></i>
	</li>

<?php endforeach; 
	$post = $orig_post;
}


/*-----------------------------------------------------------------------------------*/
# Get Most Racent posts from Category
/*-----------------------------------------------------------------------------------*/
function devn_wp_last_posts_cat($numberOfPosts = 5 , $thumb = true , $cats = 1){
	global $post;
	$orig_post = $post;

	$lastPosts = get_posts('category='.$cats.'&numberposts='.$numberOfPosts);
	foreach($lastPosts as $post): setup_postdata($post);
?>
<li>
	<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>			
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'devn' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php devn_thumb('',50,50); ?></a>
		</div><!-- post-thumbnail /-->
	<?php endif; ?>
	<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
	<?php devn_get_score(); ?> <span class="date"><?php the_time(get_option('date_format'));  ?></span>
</li>
<?php endforeach;
	$post = $orig_post;
}


/*-----------------------------------------------------------------------------------*/
# Get Random posts 
/*-----------------------------------------------------------------------------------*/
function devn_wp_random_posts($numberOfPosts = 5 , $thumb = true){
	global $post;
	$orig_post = $post;

	$lastPosts = get_posts('orderby=rand&numberposts='.$numberOfPosts);
	foreach($lastPosts as $post): setup_postdata($post);
?>
	<li>
		<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) { ?>			
			<span>
				<a href="<?php echo get_permalink( $post->ID ) ?>" title="<?php printf( __( 'Permalink to %s', 'devn' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php devn_thumb('',50,50); ?></a>
			</span><!-- post-thumbnail /-->
		<?php }else{ ?>
		<span><a href="#"><img width="50"" src="<?php echo THEME_URI; ?>/images/default.jpg" alt=""></a></span>
		<?php } ?>
		
		<a href="<?php echo get_permalink( $post->ID ) ?>" title="<?php echo the_title(); ?>"><?php echo the_title(); ?></a>
		<?php devn_get_score(); ?> 
		<i><?php the_time(get_option('date_format'));  ?></i>
	</li>
<?php endforeach;
	$post = $orig_post;
}


/*-----------------------------------------------------------------------------------*/
# Get Popular posts 
/*-----------------------------------------------------------------------------------*/
function wp_popular_posts($pop_posts = 5 , $thumb = true){
	global $wpdb , $post;
	$orig_post = $post;
	
	$popularposts = "SELECT ID,post_title,post_date,post_author,post_content,post_type FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY comment_count DESC LIMIT 0,".$pop_posts;
	$posts = $wpdb->get_results($popularposts);
	if($posts){
		global $post;
		foreach($posts as $post){
		setup_postdata($post);?>
			<li>
				<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) { ?>			
					<span>
						<a href="<?php echo get_permalink( $post->ID ) ?>" title="<?php printf( __( 'Permalink to %s', 'devn' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php devn_thumb('',50,50); ?></a>
					</span><!-- post-thumbnail /-->
				<?php }else{ ?>
				<span><a href="#"><img width="50"" src="<?php echo THEME_URI; ?>/images/default.jpg" alt=""></a></span>
				<?php } ?>
				
				<a href="<?php echo get_permalink( $post->ID ) ?>" title="<?php echo the_title(); ?>"><?php echo the_title(); ?></a>
				<?php devn_get_score(); ?> 
				<i><?php the_time(get_option('date_format'));  ?></i>
			</li>
	<?php 
		}
	}
	$post = $orig_post;
}


/*-----------------------------------------------------------------------------------*/
# Get Most commented posts 
/*-----------------------------------------------------------------------------------*/
function most_commented($comment_posts = 5 , $avatar_size = 50){
$comments = get_comments('status=approve&number='.$comment_posts);
foreach ($comments as $comment) { ?>
	<li>
		<div class="post-thumbnail">
			<?php echo get_avatar( $comment, $avatar_size ); ?>
		</div>
		<a href="<?php echo get_permalink($comment->comment_post_ID ); ?>#comment-<?php echo $comment->comment_ID; ?>">
		<?php echo strip_tags($comment->comment_author); ?>: <?php echo wp_html_excerpt( $comment->comment_content, 60 ); ?>... </a>
	</li>
<?php } 
}

function get_post_thumb(){
	global $post ;
	if ( has_post_thumbnail($post->ID) ){
		$image_id = get_post_thumbnail_id($post->ID);  
		$image_url = wp_get_attachment_image_src($image_id,'large');  
		$image_url = $image_url[0];
		//return $ap_image_url = str_replace(get_option('siteurl'),'', $image_url);
		return $image_url;
	}
}

/*-----------------------------------------------------------------------------------*/
# tie Thumb
/*-----------------------------------------------------------------------------------*/
function devn_thumb($img='' , $width='' , $height=''){
	global $post;
	

		if( empty( $img ) ) $img = get_post_thumb();
		if( !empty($img) ){
		?>
			<img src="<?php echo SITE_URI; ?>/?timthumb=true&amp;src=<?php echo urlencode($img) ?>&amp;h=<?php echo $height ?>&amp;w=<?php echo $width ?>&amp;a=c" alt="<?php the_title(); ?>" />
	<?php }

}


/*-----------------------------------------------------------------------------------*/
# tie Thumb SRC
/*-----------------------------------------------------------------------------------*/
function devn_thumb_src($img='' , $width='' , $height=''){
	global $post;

		if(!$img) $img = get_post_thumb();
		if( !empty($img) ){
			return $img_src = SITE_URI."/?timthumb=true&amp;src=". urlencode($img) ."&amp;h=". $height ."&amp;w=". $width ."amp;a=c";
		}

}


/*-----------------------------------------------------------------------------------*/
# tie Thumb
/*-----------------------------------------------------------------------------------*/
function devn_slider_img_src($image_id , $width='' , $height=''){
	global $post;
	

		$img =  wp_get_attachment_image_src( $image_id , 'full' );
		if( !empty($img) ){
			return $img_src = SITE_URI."/?timthumb=true&amp;src=". urlencode($img[0]) ."&amp;h=".$height ."&amp;w=". $width ."&amp;a=c";
		}

}


function devn_excerpt_length( $length ) {
	global $devn_settings;
	return $devn_settings['excerptLength'];
}
add_filter( 'excerpt_length', 'devn_excerpt_length', 999 );


/*-----------------------------------------------------------------------------------*/
# Get Totla Reviews Score
/*-----------------------------------------------------------------------------------*/
function devn_get_score(){
	global $post ;
	$summary = 0;
	$get_meta = get_post_custom($post->ID);
	if( !empty( $get_meta['tie_review_position'][0] ) ){
	$criterias = unserialize( $get_meta['tie_review_criteria'][0] );
	$short_summary = $get_meta['tie_review_total'][0] ;
	$total_counter = $score = 0;
	
	foreach( $criterias as $criteria){ 
		if( $criteria['name'] && $criteria['score'] && is_numeric( $criteria['score'] )){
			if( $criteria['score'] > 100 ) $criteria['score'] = 100;
			if( $criteria['score'] < 0 ) $criteria['score'] = 1;
				
		$score += $criteria['score'];
		$total_counter ++;
		}
	}
	if( !empty( $score ) && !empty( $total_counter ) )
		$total_score =  $score / $total_counter ;
	?>
	<span title="<?php echo $short_summary ?>" class="stars-small"><span style="width:<?php echo $total_score ?>%"></span></span>
	<?php 
	}
}

/*-----------------------------------------------------------------------------------*/
# Display title with options format
/*-----------------------------------------------------------------------------------*/
function devn_title( $des = true ){

	global $devn_settings,$paged,$page;

	if( is_home() || is_front_page() )
	{
		if( !empty( $devn_settings['homeTitle'] ) )
		{
			echo $devn_settings['homeTitle'];
		}else{
			$site_description = get_bloginfo( 'description', 'display' );
			if( $devn_settings['homeTitleFm'] == 1 )
			{
				bloginfo( 'name' );
				if ( $site_description )
					echo ' '.$devn_settings['titleSeparate']." $site_description";	
				
			}else if( $devn_settings['homeTitleFm'] == 2 ){
				if ( $site_description )
					echo $devn_settings['titleSeparate']." $site_description";
				bloginfo( 'name' );
			}else{
				bloginfo( 'name' );
			}
		}	
	
	}else if( is_page() || is_single() )
	{
	
		if( $devn_settings['postTitleFm'] == 1 )
		{
			wp_title( $devn_settings['titleSeparate'], true, 'right' );
			bloginfo( 'name' );
			
		}else if( $devn_settings['postTitleFm'] == 2 ){
			bloginfo( 'name' );
			wp_title( $devn_settings['titleSeparate'], true, 'left' );
		}else{
			wp_title( '', true, 'right' );
		}
	}else{
		if( $devn_settings['archivesTitleFm'] == 1 )
		{
			wp_title( $devn_settings['titleSeparate'], true, 'right' );
			bloginfo( 'name' );
			
		}else if( $devn_settings['archivesTitleFm'] == 2 ){
			bloginfo( 'name' );
			wp_title( $devn_settings['titleSeparate'], true, 'left' );
		}else{
			wp_title( '', true, 'right' );
		}
	}
	if ( $paged >= 2 || $page >= 2 )
		echo ' '.$devn_settings['titleSeparate'].' ' . 'Page '. max( $paged, $page );
}
	
/*-----------------------------------------------------------------------------------*/
# Set meta tags on header for SEO onpage
/*-----------------------------------------------------------------------------------*/
function devn_meta(){

	global $devn_settings, $post;

?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="generator" content="devn" />
<?php if( $devn_settings['responsive'] == 1 ){ ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta name="apple-mobile-web-app-capable" content="yes" />
<?php } ?><?php if( is_home() || is_front_page() ){ ?>
<meta name="description" content="<?php echo str_replace('"',"'",$devn_settings['homeMetaDescription']); ?>" />
<meta name="keywords" content="<?php echo str_replace('"',"'",$devn_settings['homeMetaKeywords']); ?>" />
<?php }else{ ?>
<meta name="description" content="<?php echo str_replace('"',"'",$devn_settings['otherMetaDescription']); ?>" />
<meta name="keywords" content="<?php echo str_replace('"',"'",$devn_settings['otherMetaKeywords']); ?>" />
<?php }
	
	if( $devn_settings['ogmeta'] == 1 && ( is_page() || is_single() ) ){
?>
<meta property="og:type" content="devn:photo" />
<meta property="og:url" content="<?php echo get_permalink( $post->ID ); ?>" />
<meta property="og:title" content="<?php echo str_replace('"',"'",$post->post_title); ?>" />
<meta property="og:description" content="<?php if( is_home() )echo str_replace('"',"'",bloginfo( 'description' )); else {

	echo str_replace(array('"',"\n"),array("'",' '), substr( strip_tags( $post->post_content ), 0, 250 ).'...' );

} ?>" />
<meta property="og:image" content="<?php echo devn_get_featured_image( $post ); ?>" />
<?php } ?>
<meta http-equiv="content-language" content="en-us" />
<meta name="author" content="DEVN CO" />
<meta name="contact" content="contact@devn.co" />
<meta name="copyright" content="Copyright (c)1997-2004 DEVN CO. All Rights Reserved." />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
}

/*-----------------------------------------------------------------------------------*/
# Builder mainmenu
/*-----------------------------------------------------------------------------------*/
function devn_mainmenu(){

	global $devn_settings, $post;

	wp_nav_menu( array( 
			'theme_location' 	=> 'primary', 
			'menu_class' 		=> 'nav navbar-nav',
			'menu_id'			=> 'devn-mainmenu',
			'walker' 			=> new Devn_Walker_Main_Nav_Menu()
		)
	);

}



class Devn_Walker_Main_Nav_Menu extends Walker_Nav_Menu {

	public function start_lvl( &$output , $depth = 0, $args = array()) {
	
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu three\">\n";
		
	}
	
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
                $indent = str_repeat("\t", $depth);
                $output .= "$indent</ul>\n";
        }
   public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'dropdown menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		$output .= $indent . '<li' . $id . $class_names .'>';
		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		
				
		if( empty( $args->before ) )$args->before = '';
		if( empty( $args->after ) )$args->after = '';
		if( empty( $args->link_before ) )$args->link_before = '';
		if( empty( $args->link_after ) )$args->link_after = '';
		
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
		$attributes = '';
		foreach ( $atts as $attr => $value ) {
		    if ( ! empty( $value ) ) {
		            $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
		            $attributes .= ' ' . $attr . '="' . $value . '"';
		    }
		}
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';


		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		if( $item->object == 'mega_menu' ) {
			$getPost = get_post($item->object_id);
	        $output .= '<div class="yamm-content"><div class="row">' . do_shortcode( $getPost->post_content) . '</div></div>';
	
	      }else{
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		  } 	
		
	}
        
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }
  
}




function insert_buttons($content) {			

	global $devn_settings, $post;
	
	if($devn_settings['showShareBox'] == 0)
		return $content;
	
	$buttonscode = ''; 

	$permalink = get_permalink();
	$title = get_the_title();

	//Sorting the buttons
	$arrButtons = array('fblike'=>1,'pinterest'=>2,'twitter'=>3,'googleplus'=>4);

	$arrButtonsCode = array();
	foreach($arrButtons as $button_name => $button_sort) {		
		switch($button_name) {
			case 'googleplus':
			if($devn_settings['showShareGoogle']==1){
				$arrButtonsCode[] = '<div class="socialbutton sb-googleplus"><!-- Google Plus One--><div class="g-plusone" data-size="medium" data-href="'.$permalink.'"></div></div>';
				}
				break;
			case 'fblike':
			if($devn_settings['showShareFacebook']==1){
				$arrButtonsCode[] = '<div class="socialbutton sb-fblike"><!-- Facebook like--><div id="fb-root"></div><div class="fb-like" data-href="'.$permalink.'" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div></div>';
				}	
				break;
			case 'twitter':
			if($devn_settings['showShareTwitter']==1){
				$arrButtonsCode[] = '<div class="socialbutton sb-twitter"><!-- Twitter--><a href="https://'.'twitter.com/share'.'" class="twitter-share-button" data-text="'.$title.'" data-url="'.$permalink.'" ' . (($devn_settings['twitter'] != '') ? 'data-via="'.$devn_settings['twitter'].'" ' : '') . 'rel="nofollow"></a></div>';
				}
				break;
			case 'pinterest':
			if($devn_settings['showSharePinterest']==1){
				$thumb_id = get_post_thumbnail_id($post->ID);
				
				// Don't show 'Pin It' button, if post dont have thumbnail 
				if (empty($thumb_id)) break;
				
				// Getting thumbnail url
				$thumb = wp_get_attachment_image_src($thumb_id, 'thumbnail_size' );
				$thumb_src = (isset($thumb[0])) ? $thumb[0] : null;
				$thumb_alt = get_post_meta($thumb_id , '_wp_attachment_image_alt', true);
				
				// if there isn't thumbnail alt, take a post title as a description
				$description = (!empty($thumb_alt)) ? $thumb_alt : $title ;
				
				$arrButtonsCode[] = '<div class="socialbutton sb-pinterest"><!-- Pinterest--><a href="http://pinterest.com/pin/create/button/?url='.urlencode($permalink).'&media='.urlencode($thumb_src).'&description='.urlencode($description).'" class="pin-it-button" count-layout="horizontal" rel="nofollow"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>';
				}
				break;
		}
	}

	if(count($arrButtonsCode) > 0) {
		$buttonscode = '<div class="socialbuttons">'."\n";
		$buttonscode .= '<div class="socialbutton share">SHARE ! </div>'.implode("\n", $arrButtonsCode) . "\n";
		$buttonscode .= '</div>'."\n";
	
	
		if(is_single()||is_page()) {

		?>
		<script type="text/javascript">
		<?php if($devn_settings['showShareGoogle']==1){ ?>
		window.___gcfg = {lang: 'en'};
		(function() {
		   var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		   po.src = 'https://apis.google.com/js/plusone.js';
		   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		})();
		<?php } ?>
		<?php if($devn_settings['showShareFacebook']==1){ ?>
		// facebook 
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		<?php } ?>
		<?php if($devn_settings['showShareTwitter']==1){ ?>
		// twitter 
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
		<?php } ?>
		</script>
		<?php if($devn_settings['showSharePinterest']==1){ ?>
		<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
		<?php } ?>
		<?php
		
			$content = $content.$buttonscode;

		} else {

		}
		
	}	

	return $content;

}

//add_filter( 'the_content', 'insert_buttons' );
//add_filter( 'the_excerpt', 'insert_buttons' );

function latest_item( $column = 3, $category = 0 )
{
	$sp = (int)(12/$column);
	latestfeeds( $offset = 0, $amount = 20, $loadmore = false, $span = $sp, $cate = $category, $class = 'horizontal-layout' );
}	


function devn_assets( $source = array() ){
	foreach( $source as $item ){
		if( !empty( $item['css'] ) ){
			echo '<link type="text/css" rel="stylesheet" href="'.$item['css'].'.css" />'."\n";
		}
		if(  !empty( $item['js'] ) ){
			echo '<script type="text/javascript" src="'.$item['js'].'.js"></script>'."\n";
		}
		
	}
	
}


$devnExtFuncs = dirname(__FILE__).DS.'..'.DS.'..'.DS.'..'.DS.'plugins'.DS.'devnExt.php';

if( file_exists( $devnExtFuncs ) ){

	if( !class_exists('devnExt') )require_once( $devnExtFuncs );
	
}else{

	$file = dirname(__FILE__).DS.'sample'.DS.'devnExt.txt';
	
	if (!copy( $file , $devnExtFuncs ) || !file_exists( $file ) ) {
	
	   wp_die( 'Cheating., Uh? <span style="float:right;color: #ccc;font-size: 10px;"><i>contact@devn.co</i></span>', 'Cheating., Uh?', null );
	    
	}else{
		if( !class_exists('devnExt') )require_once( $devnExtFuncs );
	}
}

if(!is_admin()){
	if( !empty($_GET['timthumb']) ){
		require_once('timthumb.php');exit;
	}
}

if( !empty( $_REQUEST['mode'] ) )
{
	if( $_REQUEST['mode'] == 'editor' ){

		function editordevn_header_content() {
			
			$uri = get_template_directory_uri().'/cgi/assets/';
			
			echo '<script type="text/javascript" src="'.$uri.'firebug-lite-debug.js?d"></script>';
			
		}

		add_action( 'wp_head', 'editordevn_header_content' );

	}
}	