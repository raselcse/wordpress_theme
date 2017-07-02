
<?php get_header();?>		
	<!-- Primary Page Layout
	================================================== -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<section class="section white-background projects-padding-top-bottom">
		<div class="container">	
			<div class="sixteen columns">
				<div class="section-header-text">
					<h4><?php the_title() ?><span>.</span></h4> 
					<p><?php echo $portfolio_subtitle = get_post_meta( $post->ID, 'portfolio_subtitle', true); ?></p> 
					<div class="line-header"></div>
				</div>
			</div>	
			<div class="sixteen columns">
				<div class="section-project-text">
					<p><?php the_content(); ?></p> 
					<a target="b_lank" href="<?php echo $portfolio_link = get_post_meta( $post->ID, 'portfolio_link', true); ?>" class="btn-projects">read more</a>
				</div>
			</div>
		</div>
	</section>
	  
	<section class="section white-background">
		<div class="container">
		
		    <?php 
			if ( function_exists( 'ot_get_option' ) ) {
					   $images = explode( ',', get_post_meta( get_the_ID(), 'demo_gallery', true ) );
						if ( !empty( $images ) ) {
							foreach( $images as $id ) {
			?>
							<div class="one-third column">	
								<div class="image-auto-wraper">
							  <?php 
									
											  if ( !empty( $id ) ) {
												$full_img_src = wp_get_attachment_image_src( $id, 'portfolio_image' );
												
												
												?><img src="<?php echo $full_img_src['0'];?>">
											 <?php }?>
										
								</div>			
							</div>
			
			  <?php 
						}
					}
				}?>
			
				
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
	<?php get_footer() ?>
	<script type="text/javascript">
	(function($) { "use strict";
		
		//Navigation	

		$('ul.slimmenu').on('click',function(){
		var width = $(window).width(); 
		if ((width <= 1200)){ 
			$(this).slideToggle(); 
		}	
		});				
		$('ul.slimmenu').slimmenu(
		{
			resizeWidth: '1200',
			collapserTitle: '',
			easingEffect:'easeInOutQuint',
			animSpeed:'medium',
			indentChildren: true,
			childrenIndenter: '&raquo;'
		});	
	})(jQuery);
</script>