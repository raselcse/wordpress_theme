<?php 
/**
 * (c) www.devn.co
 */

	global $devn_settings, $devn_curFile;
 
?><article id="post-<?php the_ID(); ?>" <?php post_class( is_page()?'':'blog_post' ); ?>>

		<div class="entry-content blog_postcontent">
			
			<?php 
				
				global $more,$post;
				
				if( $devn_settings['excerptImage'] == 1 && !is_page() && !is_single() )
				{

					$img = devn_get_featured_image( $post, true );
					if( strpos( $img , 'default.') === false && $img != null  && !is_single() )
					{
						if( strpos( $img , 'youtube') !== false )
						{
							echo '<div class="video_frame animated ext-fadeInUp">';
							echo '<iframe src="'.$img.'"></iframe>';
							echo '</div>';
							
						}else{
					
							echo '<div class="image_frame animated ext-fadeInUp">';
							if( $more == false ){
								echo '<a title="Continue read: '.get_the_title().'" href="'.get_permalink(get_the_ID()).'">';
							}else{
								echo '<a href="#">';
							}	
							echo '<img alt="'.get_the_title().'" class="featured-image" src="'.$img.'" />';
							echo '</a></div>';	
							
						}	
					}	
				
				};
				
				if( $devn_settings['excerptImage'] == 1 && is_single() ){
					
					$img = devn_get_featured_image( $post, false );
					
					if( strpos( $img , 'default.') === false && $img != null )
					{
					
						echo '<div class="image_frame animated ext-fadeInUp">';
						if( $more == false ){
							echo '<a title="Continue read: '.get_the_title().'" href="'.get_permalink(get_the_ID()).'">';
						}else{
							echo '<a href="#">';
						}	
						echo '<img alt="'.get_the_title().'" class="featured-image" src="'.$img.'" />';
						echo '</a></div>';	
								
					}	
				}
				
				?>
				
				<?php if( !is_page() ): ?>
				
					<header class="entry-header animated ext-fadeInUp">
							
						<?php global $devn_settings; if( $devn_settings['showDateMeta']==1 && !is_page() ): ?>
						
						<a href="<?php the_permalink(); ?>" class="date">
							<strong><?php echo esc_html( get_the_date('d') ); ?></strong>
							<i><?php echo esc_html( get_the_date('M') ); ?></i>
						</a>
						
						<?php endif; ?>
						
						<h3 class="entry-title entry-<?php echo $devn_curFile?>">
							<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'devn' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
								<?php the_title(); ?>
							</a>
							<?php //edit_post_link( __( 'Edit', 'devn' ), '<span class="edit-link">', '</span>' ); ?>
						</h3>
							
						<?php if ( is_sticky() ) : ?>	
							<h3 class="entry-format">
									<?php _e( 'Featured', 'devn' ); ?>
							</h3>
						<?php endif; ?>
			
						<?php 
						
						if ( 'post' == get_post_type() ){
	
							if ( $devn_settings['showMeta'] ==  1 ){ 
								devn_posted_on( 'post_meta_links '.$devn_curFile.'-meta' );
							}
							 
						}
				
						
					echo '</header><!-- .entry-header -->';
				
				endif;
				/*End of header of single post*/
	
				if( ( get_option('rss_use_excerpt') == 1 || is_search() ) && !is_single() && !is_page() ){

					the_excerpt();
					echo '<a href="'.get_the_permalink().'">'.__('read more &#187;','devn').'</a>';
					
				}else{

					the_content( __( 'Read more &#187;', 'devn' ) ); 
						
				}
				
			
				wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'devn' ) . '</span>', 'after' => '</div>' ) ); 
		
			
			?>
		</div><!-- .entry-content -->
		
	</article><!-- #post-<?php the_ID(); ?> -->
	<?php

	if( !is_page() ){
		echo '<div class="clearfix divider_dashed9"></div>';
	}
	?>	