<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>


	<section class="section white-background portfolio-padding-top-bottom-1">
		<div class="container">			
			<div class="sixteen columns">
                <img src="<?php bloginfo('stylesheet_directory'); ?>/images/404.jpg" width="100%"/>
			    <p><?php echo 'It looks like nothing was found at this location. Maybe try a search?'; ?></p>

				<div class="page-content">
				   
				    <div class="four columns">
					 <?php get_search_form(); ?>
					</div>
				</div><!-- .page-content -->

		    </div>	
		</div>
	</section>

<?php

get_footer();
