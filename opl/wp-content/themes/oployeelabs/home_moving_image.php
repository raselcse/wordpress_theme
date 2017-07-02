<?php 
/*
	Template Name: Home Moving Image
	
*/
?>
<?php get_header();?>
	<!-- Primary Page Layout
	================================================== -->
       <?php $ot_recognized_background_fields=ot_get_option('moving_background');?>
		  <style>
				.moving-home {
				background: url('<?php echo $ot_recognized_background_fields['background-image'] ;?>') repeat scroll;
				position: absolute;
				background-size:cover;
				top: 0; 
				left: 0; 
				bottom: 0;
				z-index: -1;
				width:100%; 
			}
		 </style>	
	<section class="cd-section">
		<div class="cd-block">
			<div class="home-top-video">	
		       			
				<div class="moving-home"></div>
			
				<div class="big-text-top">
					<div class="flippy">
						<span class="rotate"><?php echo ot_get_option('moving_text')?></span>
					</div>
				</div>
				
				<div class="small-text" style="color:<?php echo ot_get_option('background_small_text_color');  ?>" ><?php echo ot_get_option('background_small_text');?></div>
				
				<div class="social-top">
					<ul class="list-social">

					<?php // Loop for Social Links 

						if (function_exists('ot_get_option')) {

							/* get the option array */
							$links = ot_get_option('footer_social_links', array());

							if (!empty($links)) {
								foreach ($links as $link) {

									echo '<li class="icon-soc tipped"  data-title="'. $link['name'] . '"><a  class="'. $link['title'] . '"  href="' . $link['href'] . '"/> </a></li>';

								}
							}
						}	

					?>

					</ul>	
				</div>		
				
				<a href="#scroll-link" class="scroll scroll-down"></a>
				
			</div>
		</div>
	</section> <!-- .cd-section -->

	<?php 
		$args = array( 'post_type' => 'homepost', 'posts_per_page' => 10,order=>'asc' );
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
							<h2><?php the_title();?></h2>
							<p><?php the_content();?></p>
							<a href="<?php echo get_post_meta( $post->ID, 'more_button_link', true); ?>" class="btn animsition-link"><?php echo get_post_meta( $post->ID, 'more_button_text', true); ?></a>
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
   <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.simple-text-rotator.js"></script>
<script type="text/javascript">
   jQuery(function($){
        var x = 0;
        setInterval(function(){
            x-=1;
            $('.moving-home').css('background-position', x + 'px 0');
        }, 10);
    })
</script>	
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/custom-home6.js"></script>  
	<?php get_footer(); ?>
		  
   	
