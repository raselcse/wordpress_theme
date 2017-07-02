   <?php 
	/*
	Template Name: Blog page
	*/
   ?>
   <?php get_header(); ?>
	<!-- Primary Page Layout
	================================================== -->
 
	<section class="cd-section">
		<div class="cd-block">
		    <?php while ( have_posts() ) : the_post(); ?>
			  
			<div class="home-top">
			  
				  <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						
							<?php the_post_thumbnail('featured_image_size'); ?>
						
				 <?php endif; ?>
				<div class="cd-intro">
					<h1 style="color:<?php echo ot_get_option('background_big_text_color');  ?>"><?php echo ot_get_option('background_big_text');?></h1>
				
				</div>
				
				<div class="small-text" style="color:<?php echo ot_get_option('background_small_text_color');  ?>" ><?php echo ot_get_option('background_small_text');?></div>
				
					
				
				<a href="#scroll-link" class="scroll scroll-down"></a>
				
			</div>
			<?php 
		endwhile;
		?>
		</div>
	</section> <!-- .cd-section -->
	
		<?php 
		$args = array( 'post_type' => 'post', 'posts_per_page' => 10,order=>'asc' );
		$loop = new WP_Query( $args );
		 $count=2;
		while ( $loop->have_posts() ) : $loop->the_post();
		               $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured_image_size' );
						$thumb_src_count = $src[0];?>
		   
		 
		   <section class="cd-section" id="scroll-link">
		       <style>
	
			.cd-section:nth-of-type(<?php echo $count ?>) .cd-half-block:first-of-type {
			  background-image: url("<?php echo $thumb_src_count ?>");
			  background-size: cover;
			}

	        </style>     
				<div class="cd-block">
				   
					<div class="cd-half-block">   
					  
 					 </div>

					<div class="cd-half-block">
					
						<div class="block-text">
						    <div class="blog-date"><?php the_date(); ?> <span>autor: <?php the_author(); ?></span></div>
							<h2><?php the_title();?><span>.</span></h2>
							<p><?php the_excerpt();?></p>
							<a href="<?php the_permalink(); ?>" class="btn animsition-link">Details More</a>
						</div>
					</div>
				</div>
			</section> <!-- .cd-section -->
			
		<?php 
		$count++;
		endwhile;
		?>
	

 <!-- .cd-section -->
	<nav>
		<ul class="cd-vertical-nav">
			<li><a href="#0" class="cd-prev inactive"></a></li>
			<li><a href="#0" class="cd-next inactive1"></a></li>
		</ul>
	</nav> <!-- .cd-vertical-nav -->
     	
	
	<?php get_footer(); ?>