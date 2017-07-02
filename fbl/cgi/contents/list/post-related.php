<?php

global $devn_settings;

if( $devn_settings['archiveRelatedPosts'] == 1 ):

	$related_no = $devn_settings['archiveNumberofPosts'] ? $devn_settings['archiveNumberofPosts'] : 3;

	global $post;
	$orig_post = $post;
	
	$query_type = $devn_settings['archiveRelatedQuery'] ;

	if( $query_type == 'author' ){
		$args = array('post__not_in' => array($post->ID),'posts_per_page'=> $related_no , 'author'=> get_the_author_meta( 'ID' ));
	}elseif( $query_type == 'tag' ){
		$tags = wp_get_post_tags($post->ID);
		$tags_ids = array();
		foreach($tags as $individual_tag) $tags_ids[] = $individual_tag->term_id;
		$args=array('post__not_in' => array($post->ID),'posts_per_page'=> $related_no , 'tag__in'=> $tags_ids );
	}
	else{
		
		$categories = get_the_category($post->ID);
		$category_ids = array();
		foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
		$args = array('post__not_in' => array($post->ID),'posts_per_page'=> $related_no , 'category__in'=> $category_ids );
	}		

	$related_query = new wp_query( $args );
	
	if( $related_query->have_posts() ) : 
		
		$count=0;
	
	?>
	
		<div class="clearfix margin_top3"></div>
		
		<section id="related_posts">
			<div class="block-head">
				<h3 class="widget-title"><?php _e( 'Related Articles' , 'devn' ); ?></h3><div class="stripe-line"></div>
			</div>
			
			<div class="post-listing">
			
				<?php
					
					while ( $related_query->have_posts() ) : $related_query->the_post(); 
					
				?>
				<div class="related-item col-md-4">
					<ul class="recent_posts_list">
						<li>
							<a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
								<img src="<?php echo SITE_URI; ?>/?timthumb=true&amp;src=<?php echo urlencode( devn_get_featured_image($post,false) ); ?>&amp;h=124&amp;w=272&amp;a=c" alt="<?php the_title(); ?>" />
								<span class="overlay-icon"></span>
							</a>
							<br />
							<a class="relate-link" href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'devn' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
							<i><?php the_time(get_option('date_format')); ?></i>
						</li>
					</ul>		
				</div>
				
				<?php endwhile;?>
			</div>
		</section>
		
		<div class="clear"></div>
	
<?php	
	
	endif;
	$post = $orig_post;
	wp_reset_query();
	endif;
		
 ?>