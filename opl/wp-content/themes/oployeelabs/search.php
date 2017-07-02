<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

		<section class="section white-background portfolio-padding-top-bottom-1">
		<div class="container">			
			<div class="sixteen columns">

			
			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>

			<!-- LIST RESULTS -->
			<section>   
			
			<li>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to 
			<?php the_title_attribute(); ?>"><?php the_title(); ?></a> - 
			<span class="search-time"><?php the_time('F, j, Y') ?></span>
			</li><br/>
		
			</section>
			<!-- / LIST RESULTS -->

			<?php endwhile; else: ?>

           <div class="sixteen columns">
				<div class="404-search">
						<img src="<?php bloginfo('stylesheet_directory'); ?>/images/404.jpg" width="100%"/>
				<?php echo "<h4>Oops... We couldn't find what you were searching for. Please try again</h4>"; ?>
				 </div>
				 
				 <div class="four columns">
				<?php get_search_form(); ?>
				  </div>
			</div>


			<?php endif; ?>

		 </div>	
		</div>
	</section>

<?php

get_footer();
