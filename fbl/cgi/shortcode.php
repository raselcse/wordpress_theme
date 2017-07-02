<?php
// Add Slider  [slider name='name']
function dsSlider_short_code($atts) {
	ob_start();
    extract(shortcode_atts(array(
		"name" => ''
	), $atts));
	DsSlider($name);
	$output = ob_get_clean();
	return $output;
}
//add_shortcode('slider', 'dsSlider_short_code');

function javascriptShort( $atts, $content = '') {
	ob_start();
		extract(shortcode_atts(array(
			"src" => ''
		), $atts));
		echo '<script type="text/javascript"';
		if( !empty($src) )
			echo ' src="'.$src.'" ';
		echo '>'.$content.'</script>';	
	$output = ob_get_clean();
	return $output;
}
add_shortcode('js', 'javascriptShort');