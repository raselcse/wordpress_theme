<?php
/**
 * (c) www.devn.co
 *
 */
 ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php 
						
						require('content.php'); 
						
						global $devn_settings;
						
						if( $devn_settings['showShareBox'] == 1 ){
						
						$link =  "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						$escaped_link = htmlspecialchars($link, ENT_QUOTES, 'UTF-8');
						
						?>
						
						<div class="sharepost">
						    <h4><?php _e('Share this Post','devn'); ?></h4>
						    <ul>
						    <?php if( $devn_settings['showShareFacebook'] == 1 ){ ?>
						      <li>
						      	<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $escaped_link; ?>">
						      		&nbsp;<i class="fa fa-facebook fa-lg"></i>&nbsp;
						      	</a>
						      </li>
						      <?php } ?>
						      <?php if( $devn_settings['showShareTwitter'] == 1 ){ ?>
						      <li>
						      	<a href="https://twitter.com/home?status=<?php echo $escaped_link; ?>">
						      		<i class="fa fa-twitter fa-lg"></i>
						      	</a>
						      </li>
						      <?php } ?>
						      <?php if( $devn_settings['showShareGoogle'] == 1 ){ ?>
						      <li>
						      	<a href="https://plus.google.com/share?url=<?php echo $escaped_link; ?>">
						      		<i class="fa fa-google-plus fa-lg"></i>	
						      	</a>
						      </li>
						      <?php } ?>
						      <?php if( $devn_settings['showShareLinkedin'] == 1 ){ ?>
						      <li>
						      	<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=&amp;title=&amp;summary=&amp;source=<?php echo $escaped_link; ?>">
						      		<i class="fa fa-linkedin fa-lg"></i>
						      	</a>
						      </li>
						      <?php } ?>
						      <?php if( $devn_settings['showSharePinterest'] == 1 ){ ?>
						      <li>
						      	<a href="https://pinterest.com/pin/create/button/?url=&amp;media=&amp;description=<?php echo $escaped_link; ?>">
						      		<i class="fa fa-pinterest fa-lg"></i>
						      	</a>
						      </li>
						      <?php } ?>
						    </ul>
						</div>
						
						
						<?php
						
						}
						
						if( $devn_settings['navArticle'] == 1 ):
						
						?>
							<nav id="nav-single">
								<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous Article', 'devn' ) ); ?></span>
								<span class="nav-next"><?php next_post_link( '%link', __( 'Next Article<span class="meta-nav">&rarr;</span>', 'devn' ) ); ?></span>
							</nav><!-- #nav-single -->
						<?php 
						
						endif;
						
						
						if( $devn_settings['archiveAboutAuthor'] == 1 ){
						?>
						
						<!--About author-->
						<div class="clearfix"></div>
						<h4>About the Author</h4>
						<div class="about_author">
			                <?php echo get_avatar(get_the_author_meta( 'ID' )); ?>
			                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" target="_blank">
			                	<?php echo get_the_author(); ?>
			                </a>
			                <br>
							<?php the_author_meta( 'description' ); ?>
			            </div>

						<?php
						}
						
						
						
						if( $devn_settings['archiveRelatedPosts'] == 1 ){
							require('list/post-related.php'); 
						}
						
						comments_template( '', true );
						
					endwhile; // end of the loop. 
				
				?>
