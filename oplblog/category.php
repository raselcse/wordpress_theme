<?php
/**
* A Simple Category Template
*/

get_header(); ?> 

<main class="container">
	<header class="top3 bottom2">
    <div class="row">
		<div class="col small-full-width med-two-thirds large-two-thirds xlarge-two-thirds">
			<h1 class="archive-title"><?php single_cat_title() ?></h1>
			<div class="archive-meta">
			Articles and tutorials for <?php single_cat_title() ?>.
			</div>   
		</div>
		<div class="col-one-third hide-small col-end align-right">
        <?php  
		    echo '<select name="categories" id="category-dropdown" class="select bottom2">';
				 // Add custom option as default
				  
				  // Get categories as array
				  $categories = get_categories( $args );
				 
				$category_link = get_category_link($cat);
				  foreach ( $categories as $category ) :

					// Check if current term ID is equal to term ID stored in 
                    $selected = ( $category_link ==  get_category_link( $category->term_id )  ) ? 'selected' : '';

						//echo '<option value="' . $category->term_id . '" ' . $selected . '>' . $category->name.'</option>';

					echo '<option value="' .  get_category_link( $category->term_id ). '"' . $selected . '>' . $category->name . '</option>';

				  endforeach;

			echo '</select>'; ?>
			<div class="social-buttons small">
			 <?php // Loop for Social Links 

						if (function_exists('ot_get_option')) {

							/* get the option array */
							$links = ot_get_option('footer_social_links', array());
								echo'<span class="join">Join Us!</span>';
							if (!empty($links)) {
								foreach ($links as $link) {

									echo '<a  class="'.$link['name'].'" title="'.$link['name'].'" href="' . $link['href'] . '"/><i class="fa fa-'. $link['title'] . '" aria-hidden="true"></i></a>';

								}
							}
						}	

					?>
						
			</div>
        </div>
    </div>
  </header>
<?php 
// Check if there are any posts to display
if ( have_posts() ) : ?>

<header class="archive-header">
<?php
// Since this template will only be used for Design category
// we can add category title and description manually.
// or even add images or change the layout
?>


</header>

<?php
    $index=0;
	?>
 <div class="row">

	<?php
	
		 
	while ( have_posts() ) : the_post();
	
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
					By: <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_the_author();?></a>
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
						<?php $num_comments = get_comments_number(); // get_comments_number returns only a numeric value
                               echo $num_comments;
						// if ( comments_open() ) {
							// if ( $num_comments == 0 ) {
								// $comments = __('No Comments');
							// } elseif ( $num_comments > 1 ) {
								// $comments = $num_comments . __(' Comments');
							// } else {
								// $comments = __('1 Comment');
							// }
							// $write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
						// } else {
							// $write_comments =  __('Comments are off for this post.');
						// }?>    </a>
					</div>
				</footer>
			</header>
			</article> <?php
		if(($index % 2) ==0){
		echo '</div><div class="row">';
		}
	endwhile;// End Loop

else: ?>
<p>Sorry, no posts matched your criteria.</p>
<?php endif; ?>
</main>
<?php get_footer(); ?>