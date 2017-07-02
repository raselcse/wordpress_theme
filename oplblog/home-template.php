<?php 
/**
 * Template Name: Home  Template
 *
 */	
get_header()?>
<main class="container">
	<header class="top3 bottom2">
		<div class="row">
			<div class="col small-full-width med-two-thirds large-two-thirds xlarge-two-thirds">
				<h1 class="top0 bottom1">The Opl Blog</h1>
				<p>The industry's top wizards, doctors, and other experts offer their best advice, research, how-tos, and insights—all in the name of helping you level-up your SEO and online marketing skills. Looking for the YouMoz Blog?</p>
			</div>
			<div class="col-one-third hide-small col-end align-right">
			<?php echo '<select name="categories" id="category-dropdown" class="select bottom2">';
				 // Add custom option as default
				  echo '<option>' . __('No Category', 'text-domain') . '</option>';

				  // Get categories as array
				  $categories = get_categories( $args );
				  foreach ( $categories as $category ) :

					// Check if current term ID is equal to term ID stored in 

					echo '<option value="' .  get_category_link( $category->term_id ). '"><a href="http://google.com">' . $category->name . '</a></option>';

				  endforeach;

				echo '</select>'; ?>
				
			</div>
		</div>
	</header>
	<?php
    $index=0;
	?>
	<div class="row">

	<?php
		global $paged;
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array( 'post_type' => 'post', 'posts_per_page' =>4,'paged' => $paged );
		$wp_query = new WP_Query($args);
		while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
	
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
							<a href="<?php echo get_permalink();?>#comments" class="comment-count">
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
			</article> <?php
		if(($index % 2) ==0){
		echo '</div><div class="row">';
		}
		if($index ==4){
		    ?>
			<!--<form class="subscribe-cta highlight-bar top2 bottom5 hide-small" action="https://feed.press/e/mailverify" method="post" target="popupwindow" onsubmit="window.open(&#39;https://feed.press/e/mailverify?feed_id=mozblog&#39;, &#39;popupwindow&#39;,
				&#39;scrollbars=yes,width=550,height=400&#39;);return true">
				  <div class="container align-center">
					<header class="sidelines yellow">
					  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/sparkles.svg" _cdn="true"><br>
					  <h3 class="alt title bottom2">
						Never miss a beat. Get Moz Blog<br>
						email updates daily in your inbox
					  </h3>
					</header>
					<p>
					  <button class="button-primary yellow large-cta">Subscribe to Email Updates</button>
					</p>
				  </div>
				  <input type="hidden" value="mozblog" name="feed_id">
			</form>-->
			<?php
		}
	endwhile;?>

	</div>
    
    <?php custom_pagination() ?>
 


  <?php get_footer()?>