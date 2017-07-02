  <?php get_header();?>
	<!-- Primary Page Layout
	================================================== -->
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<section class="cd-section">
		<div class="cd-block">
			<div class="post-top">
				  <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						
							<?php the_post_thumbnail('featured_image_size'); ?>
						
				 <?php endif; ?>
				<a href="#scroll-link" class="scroll scroll-down"></a>
				
			</div>
		</div>
	</section> <!-- .cd-section --> 


	<section class="section white-background padding-top shadow-sec" id="scroll-link">
		<div class="container">	
			<div class="eight columns">	
				<div class="section-big-header-text">	
					<h2><?php the_title(); ?><span>.</span></h2>	
					<div class="line-big-header"></div>
					<p><?php the_date(); ?>, author: <?php the_author(); ?></p> 
				</div>		
			</div>	
			<div class="eight columns">	
				<?php the_content();?>
			 </div>	
		</div>
	</section>

 
	<section class="section white-background padding-top-bottom">
		<div class="container">
			<div class="sixteen columns">	
				<div class="project-arrows-wrapper">
					<a href="" class="animsition-link"><div class="project-arrow-left"><p><?php previous_post(' &laquo; %', '', 'yes'); ?></p></div></a>
					<a href="" class="animsition-link"><div class="project-arrow-right"><p><?php next_post('% &raquo;  ', '', 'yes'); ?></p></div></a>
				</div>
			</div>	
		</div>
	</section>
	<?php endwhile; else: ?>
<p> <?php _e('Sorry, no posts matched your criteria.'); ?> </p>
<?php endif; ?>
	<?php get_footer(); ?>