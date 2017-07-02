<?php get_header(); ?>

<main class="container">

<!-- This sets the $curauth variable -->

    <?php
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    ?>

    <h2>About: <?php echo $curauth->nickname; ?></h2>
    <dl>
        <dt>Website</dt>
        <dd><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></dd>
        <dt>Profile</dt>
        <dd><?php echo $curauth->user_description; ?></dd>
    </dl>

    <h2>Posts by <?php echo $curauth->nickname; ?>:</h2>
    <?php
    $index=0;
	?>
	<div class="row">
<!-- The Loop -->
     
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
			$index++; 	
		?>
        <article class="col small-full-width medium-one-half large-one-half xlarge-one-half">
				<header class="post-header top2 bottom4">
					<?php 
					if ( has_post_thumbnail() ) {
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured_image_size' );
						if ( ! empty( $large_image_url[0] ) ) {
							echo '<a href="' .get_permalink(). '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">';
							echo get_the_post_thumbnail( $post->ID, 'featured_image_size' ); 
							echo '</a>';
						}
					}
					?>
					
					<div class="author media parent">
						<div class="pull-left">
						<div class="avatar avatar-large circle">
						<div class="avatar-inner">
							<a href="#" rel="nofollow">
							<?php echo get_avatar( get_the_author_email(), 120); ?>
						</a>
						</div>
						</div> 
						</div>
						<div class="media-body">
						By: <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ?>"><?php echo get_the_author();?></a>
						<time datetime="2017-02-17 00:01:00" class="pull-right"><?php echo get_the_date();?></time>
						</div>
					</div>
					<h2 class="title font-lato">
						<a href="<?php echo get_permalink();?>"><?php the_title();?></a>
					</h2>
					
					<?php the_category( '<span class="separator">|</span>' ); ?>
					<p><?php echo get_the_excerpt(); ?></p>
					<footer class="row top2 bottom2">
						<div class="col small-one-half medium-one-half large-one-quarter xlarge-one-quarter">
							<a href="<?php echo get_permalink();?>" class="button-secondary blue">Read this post</a>
						</div>
						<div class="thumbs col-one-quarter align-center" data-resource-id="44496" data-resource-type="post">
							<a href="<?php echo get_permalink();?>">
							<svg class="icon">
							<use xlink:href="#icon-thumb">
							</use></svg>
							<span class="value"><?php echo  $count = get_post_meta( $id, '_zilla_likes', true);?></span>
							</a>
						</div>
						<div class="thumbs col small-one-quarter medium-one-quarter large-one-half xlarge-one-half col-end">
							<a href="<?php echo get_permalink();?>comments" class="comment-count">
								<svg class="icon">
								<use xlink:href="#icon-word-bubble">
								</use></svg>
								<?php 
								$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
								echo $num_comments;
							    ?>    
							</a>
						</div>
					</footer>
				</header>
			</article>
			<?php
        if(($index % 2) ==0){
		echo '</div><div class="row">';
		}
		?>
    <?php endwhile; else: ?>
        <p><?php _e('No posts by this author.'); ?></p>

    <?php endif; ?>
</main>
<!-- End Loop -->

<?php get_footer(); ?>