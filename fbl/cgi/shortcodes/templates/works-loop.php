<?php 

global $devn_worksShorcd;

?>
<div>
	<div class="clearfix margin_top1"></div>
	
	<div id="filters-container" class="devn-portfolio-filters" <?php if( $devn_worksShorcd['filter'] != 'Yes' )echo 'style="visibility: hidden;height: 0px;margin: 0px;width: 100%;clear: both;"'; ?>>
	    <button data-filter="*" class="devn-portfolio-filter-item-active devn-portfolio-filter-item">All</button>
	</div>
	
	<div id="grid-container" class="devn-portfolio-main <?php echo $devn_worksShorcd['column']; ?>">
	    <ul>
		<?php

			$catsStack = array();
			if ( $posts->have_posts() ) {
				while ( $posts->have_posts() ) :
					$posts->the_post();
					global $post;
					
					$image = devn_get_featured_image( $post );
					$cats = get_the_category();
					$cateClass = '';
					if( count( $cats ) ){
						foreach( $cats as $cat ){
							$cat = strtolower( str_replace(' ','-',$cat->cat_name) );
							if( !in_array($cat, $catsStack) ){
								array_push( $catsStack , $cat );
							}
							$cateClass .= $cat.' ';
						}	
					}
			?>
				
				
				<li class="devn-portfolio-item <?php echo $cateClass; ?>">
					<div class="devn-portfolio-item-wrapper">
                        <div class="devn-portfolio-image">
                            <img class="noborder" src="<?php echo $image; ?>" alt="<?php the_title(); ?>" width="100%"></div>
                        <a href="<?php the_permalink(); ?>" class="devn-portfolio-caption-wrap">
                            <div class="devn-portfolio-caption">
                                <div class="devn-portfolio-caption-body">
                                    <div class="devn-portfolio-caption-title"><?php the_title(); ?></div>
                                    <div class="devn-portfolio-caption-desc"><?php the_excerpt(); ?></div>
                                </div>
                            </div>
                        </a>
	                    <a href="<?php echo $image; ?>"  title="<?php the_title(); ?>" class="btn linkfr view-large lightbox" rel="lb[portfolio]">
	                    	<i class="fa fa-search"></i>
	                    </a>
	                    <a href="<?php the_permalink(); ?>" title="<?php _e('More Detail','devn'); ?>" class="btn linkfr more-detail">
	                    	<i class="fa fa-link"></i>
	                    </a>
	                </div>
	             </li>
	                
				<?php
				endwhile;
			}
			// Posts not found
			else {
				echo '<h4>' . __( 'Posts not found', 'devn' ) . '</h4>';
			}
			
		?>
		
		
		</ul>
		
		<script type="text/javascript">
		<?php 
			
			$btn = '';
			foreach( $catsStack as $cat ){
				$btn .= '<button data-filter=".'.$cat.'" class="devn-portfolio-filter-item">'.str_replace('-',' ',$cat).'</button>';
			}
			echo 'jQuery("#filters-container").append(\''.$btn.'\');';
			
		?>
		</script>
		
		
	</div>
</div>