<?php

/*
*	(c) www.devn.co
*/

class PHP_Code_Widget extends WP_Widget {

	function PHP_Code_Widget() {
		$widget_ops = array('classname' => 'widget_execphp', 'description' => __('Arbitrary text, HTML, Javascript, CSS and PHP Code','devn'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('execphp', __('Custom Code','devn'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$text = apply_filters( 'widget_execphp', $instance['text'], $instance );
		
		echo $before_widget;
		
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
			ob_start();
			$exxxe = devnExt::phpExe('?>'.$text);
			if( $exxxe === false ){
				echo '<font color="red">PHP Parse Error:</font> error on your code at widget <strong>';
				echo (!empty( $title )?$title:'execphp');
				echo "</strong>";
			}	
			$text =  do_shortcode( ob_get_contents() );

			ob_end_clean();
			?>			
			<div class="execphpwidget"><?php echo !empty($instance['filter']) ? wpautop($text) : $text; ?></div>
		<?php
		
		echo $after_widget;
		
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( $new_instance['text'] ) );
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$text = format_to_edit($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','devn'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<textarea class="widefat phpxcode" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
		
		<p style="display:none;" class="editMode">
			<br />
			<br />
			<label></label>
			<span style="margin-left: 0px;" class="btn btn-y" id="widget-inspect-preview" title="Ctrl+Space"> Preview </span>
			&nbsp;  
			<span onclick="top.loadShortcode('TB_inline?height=full&amp;inlineId=devn-generator-wrap&amp;width=640&amp;height=214');" class="btn" id="widget-inspect-shortcodes" title="Ctrl+Space"> Shortcodes </span>	
		</p>

		
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("PHP_Code_Widget");'));

