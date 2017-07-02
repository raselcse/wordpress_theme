<?php //Loop Team post type items ?>

<div class="features_sec42 two our-team-section">
	<?php
		// Posts are found
		
		// Define responsive layout
		global $devn_teamProw;
		if($devn_teamProw == 1){
			$col_num = "";
		} elseif ($devn_teamProw == 2){
			$col_num = "one_half";
		} elseif ($devn_teamProw == 3){
			$col_num = "one_third";
		}elseif ($devn_teamProw == 4){
			$col_num = "one_fourth";
		} else{
			$col_num = "one_fourth";
		}
		// Define words limit
		global $devn_limit_text;
		$count = 1;
		
		if ( $posts->have_posts() ) {
			while ( $posts->have_posts() ) :
				$posts->the_post();
				global $post;
				
				?>
				
				
				<div id="su-post-<?php the_ID(); ?>" class="su-post animated eff-bounceIn delay-300ms <?php echo $col_num; if( ($devn_teamProw == 1 && $count%$devn_teamProw == 1) || $count%$devn_teamProw == 0){ echo " last";}?>">
					<div class="box">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php if($devn_teamProw == 1){
								the_post_thumbnail('full', array('class' => 'img_left11'));
							 } else {
								the_post_thumbnail('full');
							 }
						 endif; ?>
						<?php 
							$staff = get_post_meta( $post->ID , 'devn_staff' );
							$staff  = $staff[0];	
						?>
						<?php if($devn_teamProw == 1){ ?>
							<h4><?php the_title();?></h4>
						<?php } else { ?>
							<h5><?php the_title();?></h5>
						<?php }  ?>
						<h6><?php echo $staff['position'];?></h6>
						<?php 
							$content = get_the_content();
							if(isset($content)){
								$trimmed_content = wp_trim_words( $content, $devn_limit_text );
							    echo "<p>".$trimmed_content."</p>";	
							}	
						?>		
						<?php if($devn_teamProw == 1){ ?>
							<br><br>
						<?php } else { ?>
							<br>
						<?php }  ?>
						<ul class="footer_social_links five">
							<li><a href="https://www.facebook.com/<?php echo $staff['facebook'];?>" target="blank_"><i class="fa fa-facebook"></i></a></li>
							<li><a href="https://twitter.com/<?php echo $staff['twitter'];?>"><i class="fa fa-twitter"></i></a></li>
							<li><a href="https://plus.google.com/<?php echo $staff['gplus'];?>"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="skype:<?php echo $staff['skype'];?>?chat"><i class="fa fa-skype"></i></a></li>
						</ul>
						
					</div>
				</div>
				
				
			
				<?php

					if ( ($devn_teamProw == 1 && $count%$devn_teamProw == 1) || ( $count%$devn_teamProw == 0))
					{
						echo '<div class="clearfix divider_dashed2"></div>';
					}
					
					$count++;
				?>
				
				
			
				
				<?php
			endwhile;
		}
		// Posts not found
		else {
			echo '<h4>' . __( 'Posts not found', 'devn' ) . '</h4>';
		}
		//if ($count%$devn_teamProw != 1) echo "</div>";
	?>

</div>