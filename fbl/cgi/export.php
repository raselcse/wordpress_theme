<?php
/*
	(c) www.devn.co
*/

global $wpdb;

$wgs = $wpdb->get_results( "SELECT * FROM `".$wpdb->prefix."options` WHERE `".$wpdb->prefix."options`.`option_name` LIKE 'widget_%' OR `".$wpdb->prefix."options`.`option_name` = 'sidebars_widgets' OR `".$wpdb->prefix."options`.`option_name` LIKE 'devn_customize%'" );
$data = array();
if( count( $wgs ) )foreach( $wgs as $wg ){
	$data[$wg->option_name] =  devnExt::base64( 'encode',  $wg->option_value );
}
		
$export = devnExt::base64( 'encode', json_encode($data));

$file = dirname(__FILE__).DIRECTORY_SEPARATOR.'sample'.DIRECTORY_SEPARATOR.'widgets.export.data';	
$fp = @devnExt::file( 'open',  $file, 'w');

@devnExt::file( 'write',  $fp, $export );
devnExt::file( 'close',  $fp );

echo '<strong style="color:green">Export succesful</strong><br /> Data stored in the file <i>www/wp-contents/themes/hoxa/cgi/sample/widgets.export.data</i>';
echo '<br /><br />';
echo '<strong>Ho To import</strong><br />  -step 1: copy your backup file under name <strong>"widgets.export.data"</strong> into folder www/wp-contents/themes/hoxa/cgi/sample/ ';
echo '<br />';
echo '-step 2: Run a link <strong>yoursite/'.'wp-admin/index'.'.php?devn=import</strong> ';
echo '<br /><br />';
echo '<a href="'.SITE_URI.'/wp-admin">Go Back</a>';
exit;
	



