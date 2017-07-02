
<?php

	$widget_id = $_GET['editwidget'];

	if ( isset($_GET['addnew']) ) {
		// Default to the first sidebar
		$sidebar = array_shift( $keys = array_keys($wp_registered_sidebars) );

		if ( isset($_GET['base']) && isset($_GET['num']) ) { // multi-widget
			// Copy minimal info from an existing instance of this widget to a new instance
			foreach ( $wp_registered_widget_controls as $control ) {
				if ( $_GET['base'] === $control['id_base'] ) {
					$control_callback = $control['callback'];
					$multi_number = (int) $_GET['num'];
					$control['params'][0]['number'] = -1;
					$widget_id = $control['id'] = $control['id_base'] . '-' . $multi_number;
					$wp_registered_widget_controls[$control['id']] = $control;
					break;
				}
			}
		}
	}

	if ( isset($wp_registered_widget_controls[$widget_id]) && !isset($control) ) {
		$control = $wp_registered_widget_controls[$widget_id];
		$control_callback = $control['callback'];
	} elseif ( !isset($wp_registered_widget_controls[$widget_id]) && isset($wp_registered_widgets[$widget_id]) ) {
		$name = esc_html( strip_tags($wp_registered_widgets[$widget_id]['name']) );
	}

	if ( !isset($name) )
		$name = esc_html( strip_tags($control['name']) );

	if ( !isset($sidebar) )
		$sidebar = isset($_GET['sidebar']) ? $_GET['sidebar'] : 'wp_inactive_widgets';

	if ( !isset($multi_number) )
		$multi_number = isset($control['params'][0]['number']) ? $control['params'][0]['number'] : '';

	$id_base = isset($control['id_base']) ? $control['id_base'] : $control['id'];

	// show the widget form
	$width = ' style="width:' . max($control['width'], 350) . 'px"';
	$key = isset($_GET['key']) ? (int) $_GET['key'] : 0;

?>

	<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php echo esc_html( $title ); ?></h2>
	<div class="editwidget"<?php echo $width; ?>>
	<h3><?php printf( __( 'Widget %s','devn' ), $name ); ?></h3>

	<form action="<?php echo SITE_URI; ?>/wp-admin/widgets.php" method="post">
	<div class="widget-inside">
<?php
	if ( is_callable( $control_callback ) )
		call_user_func_array( $control_callback, $control['params'] );
	else
		echo '<p>' . __('There are no options for this widget.','devn') . "</p>\n"; ?>
	</div>

	<p class="describe"><?php _e('Select both the sidebar for this widget and the position of the widget in that sidebar.','devn'); ?></p>
	<div class="widget-position">
	<table class="widefat"><thead><tr><th><?php _e('Sidebar','devn'); ?></th><th><?php _e('Position','devn'); ?></th></tr></thead><tbody>
<?php
	foreach ( $wp_registered_sidebars as $sbname => $sbvalue ) {
		echo "\t\t<tr><td><label><input type='radio' name='sidebar' value='" . esc_attr($sbname) . "'" . checked( $sbname, $sidebar, false ) . " /> $sbvalue[name]</label></td><td>";
		if ( 'wp_inactive_widgets' == $sbname || 'orphaned_widgets' == substr( $sbname, 0, 16 ) ) {
			echo '&nbsp;';
		} else {
			if ( !isset($devn_sidebars_widgets[$sbname]) || !is_array($devn_sidebars_widgets[$sbname]) ) {
				$j = 1;
				$devn_sidebars_widgets[$sbname] = array();
			} else {
				$j = count($devn_sidebars_widgets[$sbname]);
				if ( isset($_GET['addnew']) || !in_array($widget_id, $devn_sidebars_widgets[$sbname], true) )
					$j++;
			}
			$selected = '';
			echo "\t\t<select name='{$sbname}_position'>\n";
			echo "\t\t<option value=''>" . __('&mdash; Select &mdash;','devn') . "</option>\n";
			for ( $i = 1; $i <= $j; $i++ ) {
				if ( in_array($widget_id, $devn_sidebars_widgets[$sbname], true) )
					$selected = selected( $i, $key + 1, false );
				echo "\t\t<option value='$i'$selected> $i </option>\n";
			}
			echo "\t\t</select>\n";
		}
		echo "</td></tr>\n";
	} ?>
	</tbody></table>
	</div>

	<div class="widget-control-actions">
<?php
	if ( isset($_GET['addnew']) ) { ?>
	<a href="<?php echo SITE_URI; ?>/wp-admin/widgets.php" class="button alignleft"><?php _e('Cancel','devn'); ?></a>
<?php
	} else {
		submit_button( __( 'Delete','devn' ), 'button alignleft', 'removewidget', false );
	}
	submit_button( __( 'Save Widget','devn' ), 'button-primary alignright', 'savewidget', false ); ?>
	<input type="hidden" name="widget-id" class="widget-id" value="<?php echo esc_attr($widget_id); ?>" />
	<input type="hidden" name="id_base" class="id_base" value="<?php echo esc_attr($id_base); ?>" />
	<input type="hidden" name="multi_number" class="multi_number" value="<?php echo esc_attr($multi_number); ?>" />
<?php	wp_nonce_field("save-delete-widget-$widget_id"); ?>
	<br class="clear" />
	</div>
	</form>
	</div>
	</div>
