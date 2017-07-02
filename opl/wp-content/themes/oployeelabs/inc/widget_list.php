<?php

class latest_products_widget extends WP_Widget 
	{
	function __construct() {
		parent::__construct(
			'latest_products_widget', // Base ID
			'Latest Products list', // Name
			array('description' => __( 'Displays your Latest Product lists. Outputs the post thumbnail, title and date per listing'))
		   );
	}
	function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['numberOfListings'] = strip_tags($new_instance['numberOfListings']);
			return $instance;
	}
	 
	  
	function form($instance) {
		if( $instance) {
			$title = esc_attr($instance['title']);
			$numberOfListings = esc_attr($instance['numberOfListings']);
		} else {
			$title = '';
			$numberOfListings = '';
		}
		?>
			<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'latest_products_widget'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
			<p>
			<label for="<?php echo $this->get_field_id('numberOfListings'); ?>"><?php _e('Number of Listings:', 'latest_products_widget'); ?></label>		
			<select id="<?php echo $this->get_field_id('numberOfListings'); ?>"  name="<?php echo $this->get_field_name('numberOfListings'); ?>">
				<?php for($x=1;$x<=10;$x++): ?>
				<option <?php echo $x == $numberOfListings ? 'selected="selected"' : '';?> value="<?php echo $x;?>"><?php echo $x; ?></option>
				<?php endfor;?>
			</select>
			</p>		 
		<?php
		}
		function widget($args, $instance) { 
			extract( $args );
			$title = apply_filters('widget_title', $instance['title']);
			$numberOfListings = $instance['numberOfListings'];
			echo $before_widget;
			if ( $title ) {
				echo $before_title . $title . $after_title;
			}
			$this->getProductListings($numberOfListings);
			echo $after_widget;
		}
		
			function getProductListings($numberOfListings) { //html
			global $post;
			add_image_size( 'realty_widget_size', 85, 45, false );
			$listings = new WP_Query();
			$listings->query('post_type=custom_products&posts_per_page=' . $numberOfListings );	
			if($listings->found_posts > 0) {
				echo '<ul class="products_list_widget">';
					while ($listings->have_posts()) {
						$listings->the_post();
						$image = (has_post_thumbnail($post->ID)) ? get_the_post_thumbnail($post->ID, 'realty_widget_size') : '<div class="noThumb"></div>'; 
						$listItem = '<li>' . $image; 
						$listItem .= '<a href="' . get_permalink() . '">';
						$listItem .= get_the_title() . '</a>';
						$listItem .= '<span>Added ' . get_the_date() . '</span></li>'; 
						echo $listItem; 
					}
				echo '</ul>';
				wp_reset_postdata(); 
			}else{
				echo '<p style="padding:25px;">No listing found</p>';
			} 
		}
	} //end class latest_products_widget
register_widget('latest_products_widget');
