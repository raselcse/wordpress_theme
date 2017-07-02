<?php
/**
 * (c) www.devn.co
 */

?>


	<div class="error_pagenotfound">
    	
        <strong><?php _e('404','devn'); ?></strong>
        <br>
    	<b><?php _e('Oops... Page Not Found!','devn'); ?></b>
        
        <em><?php _e('Sorry the Page Could not be Found here.','devn'); ?></em>

        <p><?php _e('Try using the button below to go to main page of the site','devn'); ?></p>
        
        <div class="clearfix margin_top3"></div>
    	
        <a href="<?php echo SITE_URI; ?>" class="but_goback">
        	<i class="fa fa-arrow-circle-left fa-lg"></i>&nbsp; <?php _e('Go to Back','devn'); ?>
        </a>
        
    </div>

<?php
return;
?>
			<article id="post-0" class="post error404 not-found hentry">
				<header class="entry-header">
					<h3 class="widget-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'devn' ); ?></h3>
				</header>
				<div class="entry-content">
					<br />
					<br />
					<center><img src="<?php echo THEME_URI; ?>/images/404.jpg" /></center>
					<br />
					<p>
						<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'devn' ); ?>
						<br />
						<aside id="search-2" class="widget widget_search">	<form method="get" id="searchform" action="<?php echo site_url(); ?>">
								<label for="s" class="assistive-text"><?php _e( 'Perhaps searching', 'devn' ); ?></label>
								<input type="text" style="width: 270px;" class="field" name="s" id="s" placeholder="<?php _e( 'Perhaps searching', 'devn' ); ?>">
								<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php _e( 'Perhaps searching', 'devn' ); ?>">
							</form>
						</aside>
					<br />
						<?php _e( 'Or one of the links below, can help.	', 'devn' ); ?>
					</p>

					<ul id="links404">							
						<li>
							<a href="<?php echo site_url('/faq'); ?>" title=""><?php _e('FAQ','devn'); ?></a>
						</li>						
						<li>
							<a href="<?php echo site_url('/contact'); ?>" title=""><?php _e('Contact Us','devn'); ?></a>
						</li>					
						<li>
							<a href="<?php echo site_url('/about-us'); ?>" title=""><?php _e('About Us','devn'); ?></a>
						</li>
					</ul>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
