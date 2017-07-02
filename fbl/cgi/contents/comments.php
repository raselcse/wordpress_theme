<?php
/**
 * (c) www.devn.co
 *
 */

	while ( have_posts() ) : the_post(); 
	
		echo '<footer class="entry-meta">';
			if ( comments_open() ) : 
				if ( isset($show_sep) ) : 
					echo '<span class="sep"> | </span>';
				endif; // End if $show_sep
			
				echo '<span class="comments-link">';
				
				echo '</span>';
		
			endif; // End if comments_open() 

		echo '</footer><!-- #entry-meta -->';
		
		comments_template( '', true ); 
			
	endwhile; // end of the loop. 

	?>
