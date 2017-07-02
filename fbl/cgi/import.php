<?php

#	(c) www.devn.co


	global $wpdb;
	
	$file = dirname(__FILE__).DIRECTORY_SEPARATOR.'sample'.DIRECTORY_SEPARATOR.'widgets.export.data';

	if (file_exists($file)) {
	
		$handle = devnExt::file( 'open',  $file, 'r' );
		$export = devnExt::file( 'read',  $handle, 500000 );  
		$export = devnExt::base64( 'decode', $export);
		
		$imports = json_decode( $export );
		
		if(count($imports)){
			
			$wpdb->query( "DELETE FROM `".$wpdb->prefix."options` WHERE `".$wpdb->prefix."options`.`option_name` LIKE 'widget_%' OR `".$wpdb->prefix."options`.`option_name`='sidebars_widgets' OR `".$wpdb->prefix."options`.`option_name` LIKE 'devn_customize%'" );
			
			foreach( $imports as $key => $import ){
				
				if( $key == 'layerslider-slides' ){
				
					$table_name = $wpdb->prefix . "layerslider";

					$wpdb->query( "CREATE TABLE IF NOT EXISTS `wp_layerslider` (`id` int(10) NOT NULL auto_increment, `name` varchar(100) NOT NULL, `data` text NOT NULL, `date_c` int(10) NOT NULL, `date_m` int(11) NOT NULL, `flag_hidden` tinyint(1) NOT NULL default '0', `flag_deleted` tinyint(1) NOT NULL default '0', PRIMARY KEY  (`id`) ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

					$sliders = json_decode(devnExt::base64( 'decode', $import), true);

					// Invalid export code
					if(!is_array($sliders)) {

						// Try to get slider data with PHP unserialize
						$sliders = unserialize(devnExt::base64( 'decode', $import));

					}

					if(is_array($sliders)) {
					

						// Iterate over imported sliders
						foreach($sliders as $item) {

							// Execute query
							$wpdb->query(
								$wpdb->prepare("INSERT INTO $table_name
													(name, data, date_c, date_m)
												VALUES (%s, %s, %d, %d)",
												$item['properties']['title'],
												json_encode($item),
												time(),
												time()
												)
							);
						}
					}
					
				}else{
				
					$wpdb->query("INSERT INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES (null, '".$key."', '".str_replace("'","\'",devnExt::base64( 'decode', $import))."', 'yes')");
					
				}
			}	
		}
		
		/*Reset homepage -> index_php*/
		update_option( 'show_on_front', 'posts' );
		
		$wpdb->flush();

	}else{
		if(isset($_REQUEST['devn']))if($_REQUEST['devn']=='import')echo 'File not found: <i>www/wp-contents/themes/newspace/cgi/widgets.export.data</i>';
	}
	
	
if(isset($_REQUEST['devn']))if($_REQUEST['devn']=='import'){
echo 'Import succesful';
echo '<br /><br />';
echo '<a href="'.SITE_URI.'/wp-admin">Go Back</a>';
exit;
}






