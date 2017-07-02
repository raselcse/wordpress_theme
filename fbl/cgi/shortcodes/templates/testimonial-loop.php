<?php  
	
	global $devn_limit_word, $devn_limit_item, $devn_display, $devn_rounded, $devn_col;
	
	if ($devn_col == 1) {
   	 $col_num = "";
	}
	elseif($devn_col == 2) {
	    $col_num = "one_half";
	}
	elseif($devn_col == 3) {
	    $col_num = "one_third";
	}
	elseif($devn_col == 4) {
	    $col_num = "one_fourth";
	} else {
	    $col_num = "one_fourth";
	}
	
?>

<?php

	if( $devn_display == 'slidebigone' ){
	?>
	<div class="testimonial-slideBigOne">
		<ul class="testimonials-big-one">
			<?php
				
				$count = 1;
				$total = $posts->query['posts_per_page'];
			
				if ( $posts->have_posts() ) {
					while ( $posts->have_posts() ) : $posts->the_post(); 
				
						global $post;
						
						echo '<li><div class="bigoneImage">';
						the_post_thumbnail('full');
						echo '</div><br /><div class="bigoneDes">';
						echo '<h4>';
						the_title();
						echo '</h4><p>';
						the_content();
						echo '</p></div></li>';
						
					
					endwhile;
				}/*end if have post*/	
				
			?>
		</ul>
		<!--a href="#" class="nav-prev nav"></a>
		<a href="#" class="nav-next nav"></a-->
	</div>	
	<script type="text/javascript">
		function getWidthTes( elm ){
			var activ = $(elm).find('.active');
			var width = activ.width();
			if( activ.prev() ){
				width += 4*activ.prev().width();
			}
			return width;
		}
		(function($){
			if( $('.testimonials-big-one li').length < 5 ){
				var les = 5 - $('.testimonials-big-one li').length;
				for( var i=0; i< les; i++ ){
					$('.testimonials-big-one').append( $('.testimonials-big-one li').first().clone() );
				}
			}
			$('.testimonials-big-one li').eq(2).each(function(){
			
				$(this).addClass('active');
				
				var activ = $(this);
				var width = activ.width();
				if( activ.prev() ){
					width += 4*activ.prev().width();
				}else if( activ.next() ){
					width += 4*activ.next().width();
				}
				$(this).closest('.testimonial-slideBigOne').width( width);
				$(this).find('.bigoneDes').show().animate({opacity:1});
			});	
			
			$('.testimonial-slideBigOne li').click(function(){
			
				var index = $('.testimonial-slideBigOne li').index( this );
				var height = $(this).height()+$(this).find('.bigoneDes').height();
				var val = (-((index-2)*166));
				$(this).closest('.testimonials-big-one').css({ 'left' : val+'px' });
				$('.testimonial-slideBigOne li.active').removeClass('active');
				$(this).addClass('active');
				$(this).closest('.testimonials-big-one').find('.bigoneDes').css({display:'none',opacity:0});
				setTimeout(function( elm ){
					$(elm).closest('.testimonials-big-one').find('.bigoneDes').css({opacity:0});
					$(elm).find('.bigoneDes').show().animate({opacity:1});
				}, 700, this )
	
			});
			
			setInterval(function(){
				
				$('.testimonial-slideBigOne li.active').each(function(){
					if( $(this).next().get(0) ){
						$(this).next().click();
					}else{
						$(this).closest('.testimonial-slideBigOne').find('li').first().click();
					}
				});
				
			}, 5000);
		})(jQuery);	
	</script>
	<?php	
		return;
	}
	
?>



<div class="testimonial-shortcode">
	<?php if($devn_display == 'slide' && $devn_col != 1) { ?>
	 <div class="slider nosidearrows">
		<div class="flexslider carousel">
		  <ul class="slides">
			<li>
			
	<?php } elseif ($devn_display == 'slide' && $devn_col == 1) {?>		
		
    	<section class="slider nosidearrows">
			<div class="flexslider carousel">
				<ul class="slides">
	<?php } else { ?>
	
		<div class="testimonial-list">
	
	<?php } ?>


		<?php
			// Testimonials are found
			$count = 1;
			$total = $posts->query['posts_per_page'];
			
			if ( $posts->have_posts() ) {
				while ( $posts->have_posts() ) : $posts->the_post(); 
				
				global $post;
				
				if( $devn_col == 1 ) { 
					echo "<li>"; 
				}
			
				?>
					<div id="c-tesml" class="<?php echo $col_num; if( $count%$devn_col == 0){ echo " last";}?>">
						<div class="pesbox">
							<?php 
								$content = get_the_content();
								if(isset($content)){
									$trimmed_content = wp_trim_words( $content, $devn_limit_word );
									echo "<p>".$trimmed_content."</p>";	
								}	
							?>		
						</div>
						<div class="<?php if($devn_rounded == 1){ echo "pesimg"; } else { echo "pesimgs"; }?>">
						
							<?php the_post_thumbnail('full'); ?> 
							&nbsp; 
							<strong>- <?php the_title(); ?></strong> 
							&nbsp;
							<i><?php the_excerpt(); ?></i>
							
						</div>
					</div>
					
				<?php 
				
					if( $devn_col == 1 ) { 
						echo "</li>"; 
					} 
					
					if (($devn_display == 'slide' && $devn_col != 1) && $count%$devn_col == 0 && $count < $total ) {
						 echo "</li><li>"; 
					 }

					 $count++; 
				
				endwhile; 
			
				/* Posts not found */
			}else {
				echo '<h4>' . __( 'Testimonials not found', 'devn' ) . '</h4>';
			}	
				
	
	if($devn_display == 'slide') { 
	
		 if( $devn_col == 1) {
			 
		?>	
			</ul>
			</div>
			</section>
			
		<?php } else { ?>
			</li>
			</ul>
			</div><!-- end .flexslider -->
			</div><!-- end .slider -->
		<?php } ?>		

<?php } else { ?>
	
	</div><!-- end .testimonial-list-->
	
<?php } ?>

</div><!-- end .testimonial-shortcode-->


