<?php
/**
 * The main template file
 *
 */

get_header(); ?>

	<main class="container">
		<header class="top3 bottom2">
			<div class="row">
				<div class="col small-full-width med-two-thirds large-two-thirds xlarge-two-thirds">
					  <h1 class="top0 bottom1">The Opl Blog</h1>
					<p>The industry's top wizards, doctors, and other experts offer their best advice, research, how-tos, and insights—all in the name of helping you level-up your SEO and online marketing skills. Looking for the YouMoz Blog? <a href="https://moz.com/ugc">View the Archive</a></p>
				</div>
				<div class="col-one-third hide-small col-end align-right">
					<select id="category-dropdown" class="select bottom2">
					<option value="" selected="" disabled="">Explore by Category</option>
					<option value="https://moz.com/blog/category/advanced-seo">Advanced SEO</option><option value="https://moz.com/blog/category/analytics">Analytics</option><option value="https://moz.com/blog/category/basic-seo">Basic SEO</option><option value="https://moz.com/blog/category/blogging">Blogging</option><option value="https://moz.com/blog/category/branding">Branding</option><option value="https://moz.com/blog/category/business-practices">Business Practices</option><option value="https://moz.com/blog/category/community-management">Community Management</option><option value="https://moz.com/blog/category/competitive-research">Competitive Research</option><option value="https://moz.com/blog/category/consulting">Consulting</option><option value="https://moz.com/blog/category/content">Content</option><option value="https://moz.com/blog/category/conversion-rate-optimization">Conversion Rate Optimization (CRO)</option><option value="https://moz.com/blog/category/copywriting">Copywriting</option><option value="https://moz.com/blog/category/design">Design</option><option value="https://moz.com/blog/category/e-commerce">E-Commerce</option><option value="https://moz.com/blog/category/email-marketing">Email Marketing</option><option value="https://moz.com/blog/category/events">Events</option><option value="https://moz.com/blog/category/international">International</option><option value="https://moz.com/blog/category/keyword-research">Keyword Research</option><option value="https://moz.com/blog/category/link-building">Link Building</option><option value="https://moz.com/blog/category/local-seo">Local SEO</option><option value="https://moz.com/blog/category/marketing-industry">Marketing Industry</option><option value="https://moz.com/blog/category/marketing-psychology">Marketing Psychology</option><option value="https://moz.com/blog/category/mobile">Mobile</option><option value="https://moz.com/blog/category/moz-news">Moz News</option><option value="https://moz.com/blog/category/moz-tools">Moz Tools</option><option value="https://moz.com/blog/category/on-page-seo">On-page SEO</option><option value="https://moz.com/blog/category/online-advertising">Online Advertising</option><option value="https://moz.com/blog/category/paid-search-marketing">Paid Search Marketing (PPC)</option><option value="https://moz.com/blog/category/productivity">Productivity</option><option value="https://moz.com/blog/category/public-relations">Public Relations</option><option value="https://moz.com/blog/category/reporting">Reporting</option><option value="https://moz.com/blog/category/reputation-management">Reputation Management</option><option value="https://moz.com/blog/category/search-engines">Search Engines</option><option value="https://moz.com/blog/category/social-media">Social Media</option><option value="https://moz.com/blog/category/technical-seo">Technical SEO</option><option value="https://moz.com/blog/category/tools">Tools</option><option value="https://moz.com/blog/category/user-experience">User Experience (UX)</option><option value="https://moz.com/blog/category/video">Video</option><option value="https://moz.com/blog/category/whiteboard-friday">Whiteboard Friday</option>        </select>
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
		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php
			    $index=0;
			// Start the loop.
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
						<a href="https://moz.com/community/users/63" rel="nofollow">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/images/63.jpg" alt="randfish">
					</a>
					</div>
					</div> 
					</div>
					<div class="media-body">
					By: <a href="https://moz.com/community/users/63"><?php echo get_the_author();?></a>
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
						<a class="thumbs-up" href="https://moz.com/blog#">
						<svg class="icon">
						<use xlink:href="#icon-thumb">
						</use></svg>
						<span class="value">32</span>
						</a>
					</div>
					<div class="thumbs col small-one-quarter medium-one-quarter large-one-half xlarge-one-half col-end">
						<a href="https://moz.com/blog/how-to-prioritize-your-link-building-efforts-opportunities-whiteboard-friday#comments" class="comment-count">
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
			</article> 
			<?php
			if(($index % 2) ==0){
				echo '</div><div class="row">';
			}
			endwhile;

			// Previous/next page navigation.
			custom_pagination();

		// If no content, include the "No posts found" template.
		else :
			echo "Post not found";

		endif;
		?>
    </main>
<?php get_footer(); ?>
