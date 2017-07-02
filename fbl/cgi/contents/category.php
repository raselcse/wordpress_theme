<?php
/**
 * (c) www.devn.co
 *
 */

?>

			<?php if ( have_posts() ) : ?>

				<header>
					<h1 class="page-title"><?php
						printf( __( 'Category Archives: %s', 'devn' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?>
					<?php
					
						global $devn_settings;
						if( $devn_settings['rssIcon'] == 1 )
							echo '<a title="'.__('Get new feeds via RSS of this category','devn').'" href="feed" class="alignright rssicon" target=_blank > </a>';
						echo '</h1>';
						global $devn_settings;
						if( $devn_settings['catDes'] == 1 )
						{
							$category_description = category_description();
							if ( ! empty( $category_description ) )
								echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
						}		
					?>
	
				</header>
				
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php

						require('content.php');  
						
					?>

				<?php endwhile; ?>

				<?php devn_pagination(); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'devn' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'devn' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

