
<div class="container">
	<?php
		// Posts are found
		if ( $posts->have_posts() ) {
			$i = 0;
			while ( $posts->have_posts() ) :
				$posts->the_post();
				$i++;
				global $post;
				?>

				<div id="su-post-<?php the_ID(); ?>" class="one_third <?php if( $i%3 == 0 )echo 'last'; ?>">
					<h4 class="head1line"><?php the_title(); ?></h4>
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="su-post-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
					<?php endif; ?>
					<p>
						<?php   echo mb_substr( get_the_excerpt() , 0 , 150 ); ?>
					</p>
					<br />
					<a href="<?php the_permalink(); ?>" class="lfive">
						<i class="fa fa-chevron-circle-right"></i> &nbsp; <?php echo __('Read more','devn'); ?>
					</a>
				</div>

				<?php
			endwhile;
		}
		// Posts not found
		else {
			echo '<h4>' . __( 'Posts not found', 'devn' ) . '</h4>';
		}
	?>
</div>

