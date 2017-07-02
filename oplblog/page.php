<?php get_header();?>
<section class="container">
	<div class="col-centered top4">
  
<?php   if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h2 class="top0 alt"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			<?php the_content();?>

			<?php endwhile; 
			   
	    endif; ?>

    </div>
</section>

<?php get_footer();?>
