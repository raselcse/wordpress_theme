<?php
/**
* A Simple Category Template
*/

get_header(); ?> 


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
				  <main class="container">
	<article class="blog-post  top3">
		<header class="post-header top2 bottom4">
			 <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>

					<?php the_post_thumbnail('full',array('class' => 'post-image')); ?>
					
			 <?php endif; ?>
		<div class="grid">
			<div class="col small-full-width medium-three-quarters large-three-quarters xlarge-two-thirds col-centered">
				<div class="author media parent">
					<div class="pull-left">
						<div class="avatar avatar-large circle">
							<div class="avatar-inner">
							    
								<a href="https://moz.com/community/users/10088145" rel="nofollow">
								 <?php echo get_avatar( get_the_author_email(), 120); ?>
								</a>
							</div>
						</div> 
					</div>
				  <div class="media-body">
					By: <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_the_author();?></a>
					<time datetime="2017-02-16 00:05:00" class="pull-right"><?php echo get_the_date();?></time>
				  </div>
				    <div class="social-sharing-section">
				      <?php echo do_shortcode("[wp_social_sharing social_options='facebook,twitter,googleplus' twitter_username='arjun077' facebook_text='Share on Facebook' twitter_text='Share on Twitter' googleplus_text='Share on Google+' linkedin_text='Share on Linkedin' pinterest_text='Share on Pinterest' xing_text='Share on Xing' icon_order='f,t,g,l,p,x' show_icons='0' before_button_text='' text_position='' social_image='']");?>
			        </div>
				</div>
				
				<div class="row">
					<div class="col small-full-width">
					<h2 class="h2 alt"><?php  the_title();?></h2>
					<?php the_category( '<span class="separator">|</span>' ); ?>
					
					</div>
				</div>
			</div>
			
			
		</div>
	</header>
	<div class="row parent">
		<div class="col small-full-width medium-three-quarters large-three-quarters xlarge-two-thirds col-centered">
			<div class="post-content">
				<?php if( function_exists('zilla_likes') ) zilla_likes();?>
				<?php the_content();?>
				
				</div>
			</div>
	</div>
	</article>
</main>
			
	<?php endwhile; else: ?>
<p> <?php _e('Sorry, no posts matched your criteria.'); ?> </p>
<?php endif; ?>



	
	<main class="container">  
	
	
  <section>
    <div class="grid">
  <div id="comments" class="comments-container col small-full-width medium-three-quarters large-three-quarters xlarge-two-thirds col-centered">

    <div class="row top5">
      <div class="comments-header">
        <div class="header-text col small-full-width medium-one-half large-one-half xlarge-one-half">
          <h2 class="font-lato">Comments
                          <span class="tag-number teal comment-count"><?php get_comments_number()?></span>
                      </h2>
          
		  <?php $comments_args = array(
									// use the "Text or HTML to be displayed after the set of comment fields"-field to to add a class to the comment submit button
									 'class_submit' => 'submit button-primary',
									 'label_submit'=>__('+ Add Comment')
									);

				comment_form($comments_args);?>
        </div>
        <div class="alert alert-inline alert-info media success top0 hidden">
          <span class="alert-icon"></span>
          <div class="media-body alert-content">
          </div>
          <span class="alert-close"></span>
        </div>
       </div>
    </div>
    <ul class="comment-list clearfix" id="backbone-comments"> 
  <li class="item">

<?php 
	$id = get_the_ID();
	$comments = get_comments('post_id='.$id.'');
	
	foreach($comments as $comment) :
	$avatar = get_avatar( $comment->comment_author_email, 120); 

	 
	echo('<div class="comment " id="comment-419678"><span class="arrow-up"></span><div class="clearfix pull-left comment-avatar">

		<div class="avatar avatar-large ">
			<div class="avatar-inner">
				<a href="#" rel="nofollow">
				'.$avatar.'
				</a>
			</div>
		</div> 
    </div>
	<div class="comment-body comment-view">
		<header>
			<div class="clearfix">
				<div class="comment-author">
					  <a class="h5" href="#">'.$comment->comment_author .'</a>

				</div>
				<div class="comment-date">
					<a class="item slate">
						<time datatime="2017-02-16T00:46:28-08:00">'. human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago'  .'</time>
				  
					</a>
				</div>
			</div>
		</header>


		<p></p><p>'.$comment->comment_content .'</p><p></p>

		<footer>
			<div class="align-center comment-info thumbs">
           
		    </div>
		</footer>
  </div>
  
  <div class="comment-body comment-edit" style="display:none;">
    <form class="edit-form">
      <p><textarea class="textarea xlarge" name="" id="" cols="30" rows="10" maxlength="5000">&lt;p&gt;
Any other psychological tricks or innovative tactics you use to get more responses? </p></textarea></p>
      <button class="button-primary">Submit</button>
      <a class="button-secondary toggle-edit">Cancel</a>
    </form>
  </div></div><br />');
	endforeach;
	?>
  
  
  </li>
 </ul>
    <div class="reply bottom-reply"></div>
  </div>
</div>
  
  </section>



</main>
<?php get_footer(); ?>