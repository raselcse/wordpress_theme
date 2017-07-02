<?php
/**
 * (c) www.devn.co
 */

?>

			<?php if ( have_posts() ) : ?>

				<header>
					<h1 class="page-title">
						<?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily Archives: %s', 'devn' ), '<span>' . get_the_date() . '</span>' ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly Archives: %s', 'devn' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'devn' ) ) . '</span>' ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly Archives: %s', 'devn' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'devn' ) ) . '</span>' ); ?>
						<?php else : ?>
							<?php _e( 'Blog Archives', 'devn' ); ?>
						<?php endif; ?>
						
						<?php
						global $devn_settings;
						if( $devn_settings['rssIcon'] == 1 )
							echo '<a title="'.__('Get new feeds via RSS of this archive','devn').'" href="feed" class="alignright rssicon" target=_blank > </a>';
						?>
					
					</h1>
					
					
					
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
