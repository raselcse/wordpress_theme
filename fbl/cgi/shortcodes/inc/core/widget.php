<?php
class Su_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname'   => 'shortcodes-devn',
			'description' => __( 'Drag this to left area and drop to select a component', 'devn' )
		);
		$control_ops = array(
			'width'   => 300,
			'height'  => 350,
			'id_base' => 'shortcodes-devn'
		);
		$this->WP_Widget( 'shortcodes-devn', __( 'Component Elements', 'devn' ), $widget_ops, $control_ops );
	}

	public static function register() {
		register_widget( 'Su_Widget' );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$content = $instance['content'];
		echo $before_widget;
		//if ( $title ) echo $before_title . $title . $after_title;
		echo do_shortcode( $content );
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['content'] = $new_instance['content'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			'title'   => __( '', 'devn' ),
			'content' => ''
		);
		$instance = wp_parse_args( ( array ) $instance, $defaults );
?>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Type:', 'devn' ); ?></label>
					<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat componentTitle" READONLY />
				</p>
				
				<div class="pElement">
							
					<?php 
						Su_Generator::button( array( 
						
							'target' => $this->get_field_id( 'content' ), 
							'class' => 'su-generator-button-2 button', 
							'icon'=>'th',
							'text'=>' Open Components','title'=>'Click to add new or edit component',
							'custom'=>'onclick="convertDataShortcode(this)"' ) 
							
						);
					?>
					
					<textarea style="display: none;" name="<?php echo $this->get_field_name( 'content' ); ?>" id="<?php echo $this->get_field_id( 'content' ); ?>" rows="7" class="widefat replaceOnly" style="margin-top:10px"><?php echo $instance['content']; ?></textarea>
				</div>
				<?php
	}

}

add_action( 'widgets_init', array( 'Su_Widget', 'register' ) );
