<?php
/**
 * (c) www.devn.co
 *
 */

 ?>


			<?php while ( have_posts() ) : the_post(); ?>

				<?php 
				
					global $devn_settings;
					/* Builder Only page and single  */
					require('content.php');  
	
				?>

			<?php endwhile; // end of the loop. ?>