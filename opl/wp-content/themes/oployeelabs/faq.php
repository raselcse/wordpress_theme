<?php
/*
Template Name: Faq Template
*/
?>
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
				
				<div class="small-text"><?php the_title(); ?></div>
				
				<a href="#scroll-link" class="scroll scroll-down"></a>
				
			</div>
		</div>
	</section> <!-- .cd-section --> 
	
				<div class="container">
		
				 <div class="accordion">
						<?php 
						global $args;		
						$args = array(
							'post_type' => 'faq',
							'post_status' => 'publish'
						);
						$ourquery = new WP_Query( $args );
						$active=1;
						while ( $ourquery->have_posts() ) : $ourquery->the_post();
						?>
						 
						<div class="accordion_in <?php if($active==1) echo "acc_active"; ?>">
								<div class="acc_head"><?php the_title() ?></div>
								<div class="acc_content">
								<p><?php  the_content() ?></p>
								</div>
						</div>

						 <?php 
						$active++;
						endwhile;
						?>	
		        </div>		
		
    </div>

	
	<?php endwhile; ?>
	<?php get_footer();?>