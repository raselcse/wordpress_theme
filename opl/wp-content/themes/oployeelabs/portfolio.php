<?php 
/*
	Template Name: Portfolio Background
	
*/

?>
 <?php get_header() ?>		
	<!-- Primary Page Layout
	================================================== -->
   	<section class="cd-section">
		<div class="cd-block">
		   
			<div class="work-top">
			   	  <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						
							<?php the_post_thumbnail('featured_image_size'); ?>
						
				 <?php endif; ?>  
				<div class="big-text-portfolio-top">
					<h2><?php the_title()?><span>.</span></h2>
					<p>Branding, Graphic Design, Illustration</p>
				</div>
				
				<a href="#scroll-link" class="scroll scroll-down"></a>
				
			</div>
		</div>
	</section> <!-- .cd-section --> 

	<section class="section white-background portfolio-padding-top-bottom-1">
		<div class="container">			
			<div class="sixteen columns">
				<div id="portfolio-filter">
					  <?php
					//list terms in a given taxonomy (useful as a widget for twentyten)
					$taxonomy = 'portfolio_category';
					$tax_terms = get_terms($taxonomy);
					?>
					<ul id="filter">
					<li><a href="#" class="current" data-filter="*" title="">All</a></li>
					
					<?php
					foreach ($tax_terms as $tax_term) {
					echo '<li>' . '<a  title="" href="#" data-filter=".'.strtolower ($tax_term->name).'" ' . '>' . $tax_term->name.'</a></li>';
					}
					?>
					</ul>
				</div>
			</div>	
		</div>
		
			<div id="projects-grid">
			
			<?php 
		$args = array( 'post_type' => 'portfolio', 'posts_per_page' => 10,order=>'desc' );
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
				$thumb_src = null;
					if ( has_post_thumbnail($post->ID) ) {
						$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'portfolio_image' );
						$thumb_src = $src[0];
					}
					$terms = get_the_terms($post->ID, 'portfolio_category' );
				if ($terms && ! is_wp_error($terms)) :
					$term_slugs_arr = array();
					foreach ($terms as $term) {
						$term_slugs_arr[] = $term->slug;
					}
					$terms_slug_str = join( " ", $term_slugs_arr);
				endif;
					?>
				       <a href="<?php the_permalink()?>" class="animsition-link">
							<div class="portfolio-box-1 <?php echo $terms_slug_str;?>">
								<div class="mask-1"></div>
								<img src="<?php echo $thumb_src; ?>" alt="<?php the_title() ?>">
								<h6><?php the_title() ?></h6>
								<div class="line-mask"></div>
								<p><?php echo $terms_slug_str;?></p>
							</div>
						</a><!-- .cd-section -->
		<?php 
		endwhile;
		?>
				
			</div>
	</section>
 
	<?php get_footer() ?>
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/imagesloaded.pkgd.min.js"></script>  	  
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/masonry.js"></script>  	  
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/isotope.js"></script> 
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/custom-work1.js"></script>
