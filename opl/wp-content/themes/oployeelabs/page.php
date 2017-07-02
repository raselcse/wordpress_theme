<?php get_header();?>
		
	<!-- Primary Page Layout
	================================================== -->
      	<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
		
	 <section class="cd-section">
		<div class="cd-block">
		
			<div class="shortcodes-top">
			      <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						
							<?php the_post_thumbnail('featured_image_size'); ?>
						
						<?php endif; ?>
				<div class="big-text-pages-top">
					<h1><span><?php the_title(); ?></span></h1>
				</div>
				
				<div class="small-text"><?php echo $portfolio_subtitle = get_post_meta( $post->ID, 'subtitle', true);  ?></div>
				
				<a href="#scroll-link" class="scroll scroll-down"></a>
				
			</div>
		</div>
	</section> <!-- .cd-section --> 
	
	<section class="section white-background padding-top-bottom shadow-sec" id="scroll-link">
		<div class="container">
		    <div class="sixteen columns">
			<div class="section-header-text-left">
				<h4><span><?php the_title(); ?></span></h4> 
				<div class="line-header"></div>
					
			</div>
			</div>
				
					
			<?php the_content(); ?>
			
				
		</div>
	</section>
   
	
	<?php endwhile; ?>
	
	
	<?php get_footer();?>
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.counterup.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/waypoints.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/visible.min.js"></script> 
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/pro-bars.js"></script>	
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.fitvids.js"></script> 
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/smk-accordion.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/custom-shortcodes.js"></script> 