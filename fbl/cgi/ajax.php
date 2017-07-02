<?php

/* Actions for Ajax functions */
function saveLayout(){
	
	global $devn_customActive,$wpdb;
	$devn_customActive = array();
	
	$name = explode( '[DS]', $_POST['name'] );
	if( empty($name[1]) )
	{	
		$name[1] = '';
		if(strpos($name[0],'-')!==false){
			$name = explode( '-', $name[0] );
		}
		
		if( !is_numeric( $name[1] ) ){
			$name[1] = $_POST['name'];
			$name[0] = 'Custom';
		}
		
	}	
	$title = trim( str_replace( array('-',"\n",'  ','&nbsp;'), array(' ','','',''), strip_tags($_POST['title']) ) );
	$vitual = str_replace( array('\"',"\'"), array('"',"'") , $_POST['vitual'] );
	$real = str_replace( array('\"',"\'"), array('"',"'") , $_POST['real'] );
	
	$zend = devn::zendLiveLayoutCache( $real, $name[0], $name[1] );
	
	$html = $zend[0];
	$css = $zend[1];
	$groups = $zend[2];
	$height = $_POST['height'];
	$private = $_POST['private'];
	$blockHeight = $_POST['blockHeight'];
	$customHeader = $_POST['customHeader'];
	$customFooter = $_POST['customFooter'];
	$groupid = $_POST['groupid'];
	$groupclass = $_POST['groupclass'];
	
	
	/* REMOVE Customize data after storage into database */
	$vitual = explode( '"customize":"' , $vitual );
	for( $i=1; $i< count( $vitual ); $i++ ){
		$vitual[$i] = substr($vitual[$i], strpos($vitual[$i], '"'));
	}
	$vitual = implode( '"customize":"', $vitual );
	
	$real = explode( '"customize":"' , $real );
	for( $i=1; $i< count( $real ); $i++ ){
		$real[$i] = substr($real[$i], strpos($real[$i], '"'));
	}
	$real = implode( '"customize":"', $real );
	/*====================================================*/
	
	
	$file = dirname(__FILE__).DS.'layouts'.DS.str_replace('[DS]',DS,$_POST['name']).'.xml';	
		
	$fp = devnExt::file( 'open',  $file, 'w');

	$data = '<?xml version="1.0" encoding="UTF-8" ?>'."\n";
	$data .= '<!-- copyright devn.co (c) All Rights Reserved -->'."\n";
	$data .= '<!-- @author: devn -->'."\n";
	$data .= '<!-- @email: contact@devn.co -->'."\n";
	$data .= '<!-- @package: Layout + Cache -->'."\n";

	$data .= '<layout>'."\n";
	$data .= '	<title>'.ucfirst($title).'</title>'."\n";
	$data .= '	<type>'.$name[0].'</type>'."\n";
	$data .= '	<id>'.$name[1].'</id>'."\n";
	$data .= '	<blockHeight>'.$blockHeight.'</blockHeight>'."\n";
	$data .= '	<height>'.$height.'</height>'."\n";
	$data .= '	<private>'.$private.'</private>'."\n";
	$data .= '	<update>'.date(DATE_RFC822).'</update>'."\n";
	$data .= '	<css><![CDATA['.str_replace(array("\n","	"),array("",""),$css).']]></css>'."\n";	
	$data .= '	<groups>'.$groups.'</groups>'."\n";	
	$data .= '	<customHeader><![CDATA['.$customHeader.']]></customHeader>'."\n";
	$data .= '	<customFooter><![CDATA['.$customFooter.']]></customFooter>'."\n";		
	$data .= '	<groupid><![CDATA['.$groupid.']]></groupid>'."\n";		
	$data .= '	<groupclass><![CDATA['.$groupclass.']]></groupclass>'."\n";		
	$data .= '	<vitual><![CDATA['.$vitual.']]></vitual>'."\n";
	$data .= '	<real><![CDATA['.$real.']]></real>'."\n";
	$data .= '	<html><![CDATA['.$html.']]></html>'."\n";
	$data .= '</layout>'."\n";

	devnExt::file( 'write',  $fp, $data );
	devnExt::file( 'close',  $fp );
	

	/* ===============Storage Customize================== */	
	
	$vname = $name[1];
	if( $name[0] == 'groups' ){
		$vname = '_grp_'.$name[1];
	}
	
	if ( get_option( 'devn_customize_Storage_'.$vname ) !== false ) {
	
		$customizs = $wpdb->get_results( "SELECT * FROM `".$wpdb->prefix."options` WHERE `".$wpdb->prefix."options`.`option_name` LIKE 'devn_customize_".$vname."_%'" );
		foreach( $customizs as $customiz ){
			if( strpos( $customiz->option_name, 'devn_customize_'.$vname.'_' ) !== false ){
				if( !in_array( $customiz->option_name , $devn_customActive ) ){
					delete_option( $customiz->option_name );
				}	
			}
		}
		
		update_option( 'devn_customize_Storage_'.$vname , $devn_customActive );
		
	} else {
		add_option( 'devn_customize_Storage_'.$vname, $devn_customActive );
	}
	
	/* ===============Private Layouts================== */	

	if( $name[0] != 'groups' )
	{
		$sname = get_option( 'devn_customize__Private' );
		if( !$sname ){
			$sname = array();
		}
		if( $private == 'yes' ){
			if( !in_array( $_POST['name'] , $sname) ){
				array_push( $sname , $_POST['name'] );
			}	
		}else{
			if( in_array( $_POST['name'] , $sname) ){
			
				foreach( $sname as $key => $value ){
					if( $value == $_POST['name'] ){
						unset( $sname[$key] );
					}
				}
			}
		}
		
		if(  count( $sname ) == 0 ){
			delete_option( 'devn_customize__Private' );
		}else if ( get_option( 'devn_customize__Private' )  != false ) {
			update_option( 'devn_customize__Private' , $sname );
		} else {
			add_option( 'devn_customize__Private', $sname );
		}
		
		
		
	}
	
	exit;
}
	
add_action('wp_ajax_saveLayout', 'saveLayout');

function loadLayout(){
	
	global  $devn;
	
	$devn->widgets_common();
	
	$name = str_replace('[DS]',DS,$_POST['name']);
	

	if( get_option('show_on_front') == 'page' ){
		$pid = get_option('page_for_posts');
		if( $name == 'page-'.$pid ){
			echo 'reload:index:'.get_the_title( $pid );
			exit;
		}
	}

	
	$alias = str_replace('[DS]',DS,$_POST['alias']);/*current editting*/
	$task = $_POST['task'];
	$title = trim( str_replace( '-', ' ', strip_tags($_POST['title']) ) );
	$xname = explode( '-', $_POST['name'] );
	if(empty($xname[1]))
		$xname[1] = '';
	$cname = null;	
	if( $task == 'clearLayout' )
	{
		if( $name == 'general' )
		{

			@unlink( dirname(__FILE__).DS.'layouts'.DS.$alias.'.xml' );
			
		}else{
			
			$file = dirname(__FILE__).DS.'layouts'.DS.$name.'.xml';	
			$devn_xml = simplexml_load_file( $file );
			$cfile = dirname(__FILE__).DS.'layouts'.DS.$alias.'.xml';
			$cfp = @devnExt::file( 'open',  $cfile, 'w');

			$data = '<?xml version="1.0" encoding="UTF-8" ?>'."\n";
			$data .= '<!-- copyright devn.co (c) All Rights Reserved -->'."\n";
			$data .= '<!-- @author: devn -->'."\n";
			$data .= '<!-- @email: contact@devn.co -->'."\n";
			$data .= '<!-- @package: Layout + Cache -->'."\n";

			$data .= '<layout>'."\n";
			$data .= '	<title>'.$title.'</title>'."\n";
			$data .= '	<type>'.$xname[0].'</type>'."\n";
			$data .= '	<id>'.$xname[1].'</id>'."\n";
			$data .= '	<height>'.$devn_xml->height.'</height>'."\n";
			$data .= '	<update>'.date(DATE_RFC822).'</update>'."\n";
			$data .= '	<vitual><![CDATA['.$devn_xml->vitual.']]></vitual>'."\n";
			$data .= '	<real><![CDATA['.$devn_xml->real.']]></real>'."\n";
			$data .= '	<html><![CDATA['.$devn_xml->html.']]></html>'."\n";
			$data .= '</layout>'."\n";
			devnExt::file( 'write',  $cfp, $data );
			devnExt::file( 'close',  $fp );
			
		}	
		$name = $alias;
		
	}else if( strpos( $task, 'loadFor') !== false ){
		
		$cname = str_replace( 'loadFor-','', $task);
		
	}
	$devn->zendLayout( $name, $cname );
	
	exit;
}
	
add_action('wp_ajax_loadLayout', 'loadLayout');


function loadPosition(){

	devn::widgets_common();
	
	$name = $_POST['name'];

	devn::loadPosition( $name );
	
	exit;
}
	
add_action('wp_ajax_loadPosition', 'loadPosition');


function loadSibarsInnerPage(){
	/* Load all widgets for inspect mode*/
	devn::widgets_common();
	
	$location =  str_replace( site_url('/'), '', $_POST['location'] );
	/*basename( untrailingslashit( ))*/
	
	$post = devn_bwp_url_to_postid($_POST['location']);
	
	if( $post ){
	
		devn::sidebarsInnerPage( $post->post_type.'-'.$post->ID );
		
	}else{
	
		$category = get_category_by_path( basename( untrailingslashit( $location ) ) );
		
		devn::sidebarsInnerPage( isset($category->id)?$category->id:null );
		
	}
	exit;
}
	
add_action('wp_ajax_loadSibarsInnerPage', 'loadSibarsInnerPage');




function orderWidgetPlus(){

	check_ajax_referer( 'save-sidebar-widgets', 'savewidgets' );

	if ( !current_user_can('edit_theme_options') )
		wp_die( -1 );

	unset( $_POST['savewidgets'], $_POST['action'] );

	// save widgets order for all sidebars
	if ( is_array($_POST['sidebars']) ) {
		$sidebars = array();
		foreach ( $_POST['sidebars'] as $key => $val ) {
			$sb = array();
			if ( !empty($val) ) {
				$val = explode(',', $val);
				foreach ( $val as $k => $v ) {
					if ( strpos($v, 'widget-') === false )
						continue;

					$sb[$k] = substr($v, strpos($v, '_') + 1);
				}
			}
			$sidebars[$key] = $sb;
		}
		wp_set_sidebars_widgets($sidebars);

	}
	
	dynamic_sidebar( $_POST['sidebar'] );
	
	
	exit;
}
	
add_action('wp_ajax_widgets-order-plus', 'orderWidgetPlus');


function widgetsLoadSidebar(){

	dynamic_sidebar( $_POST['sidebar'] );
	
	
	exit;
}
	
add_action('wp_ajax_widgets-load-sidebar', 'widgetsLoadSidebar');

/********************************************************************************/

function saveCssFile(){

	if( $_POST['dirs'] )
	{
		$files = $_POST['files'];
		$datas = $_POST['datas'];
		$dirs = $_POST['dirs'];

		$base = str_replace( '/wp-admin/admin-ajax.php', '', $_SERVER['SCRIPT_FILENAME']);
		
		for( $i = 0; $i < count($files); $i++ ){
			
			$dir = $base.str_replace( site_url(), '', $dirs[$i] );
			
			$fp = @devnExt::file( 'open',  $dir, 'w');
			
			if( $files[$i] == 'style.css' )
				$copy = "/*\nTheme Name: New Space\nTheme URI: http://newspace.devn.co\nDescription: New space Wordpress Theme\nAuthor: DEVN\nAuthor URI: http://devn.co\nVersion: 1.1\nLicense: GNU General Public License v2 or later\nLicense URI: http://www.gnu.org/licenses/gpl-2.0.html\nTags: dark, light, white, black, gray\n*/\n\n\n";
			else $copy = "/* (c) copyright devn.co */\n\n\n";	
			
			$datas[$i] = str_replace( array('\"',"\'"), array('"',"'"), $datas[$i] );
			
			$datas[$i] = str_replace( array('}','{ ','; ','	}'),array("}\n","{\n	",";\n	","}"), $datas[$i]);
			
			
			$datas[$i] = $copy.$datas[$i];
			
			/*$content = devnExt::file( 'read',  $fp, filesize( $dir ));*/
		
			@devnExt::file( 'write',  $fp, $datas[$i] );
			devnExt::file( 'close',  $fp );

		}
		
		
	}
	
	exit;
}
	
add_action('wp_ajax_save-css', 'saveCssFile');

/********************************************************************************/

function saveImageFile(){

	if( $_POST['dir'] )
	{

		$base = str_replace( '/wp-admin/admin-ajax.php', '', $_SERVER['SCRIPT_FILENAME']);
		
		$dir = $base.str_replace( site_url(), '', $_POST['dir'] );
		
		$img = str_replace('data:image/jpeg;base64,', '', $_POST['data']);
		$img = str_replace(' ', '+', $img);
		$data = devnExt::base64( 'decode', $img);
		
		$file = $dir;

		if( devnExt::file( 'put', $file, $data) ){
			
			if(file_exists($file)) {
				die('success');
			}
		}	
		
		
	}
	
	exit;
}
	
add_action('wp_ajax_save-image', 'saveImageFile');

/********************************************************************************/

function checkEditable(){
	
	$dirs = $_POST['dirs'];
	
	if( $dirs )
	{
		$re = array();
		$bs = str_replace( '/wp-admin/admin-ajax.php', '', $_SERVER['SCRIPT_FILENAME']);
		for( $i=0; $i < count($dirs); $i++ )
		{
			
			$ed = is_writable( $bs.str_replace( site_url(), '', $dirs[$i]) );
			array_push( $re, $ed?'true':'false' );
			
		}
				
		echo implode(',', $re );
		exit;		
	}
	
	die(0);
}
	
add_action('wp_ajax_is-editable', 'checkEditable');/********************************************************************************/


function latestfeeds( $offset = 0, $amount = 4, $loadmore = true, $span = 6, $cate = 0, $class = '' ){

	if( isset( $_POST['offset'] ) )
		$offset = $_POST['offset'];	
	if( isset( $_POST['amount'] ) )
		$amount = $_POST['amount'];

	$rows = get_posts( array(

		'post_status' => 'publish', 
		'post_type' => 'post',   
		'posts_per_page' => $amount,
		'offset' => $offset,
		'category' => $cate,
		//'orderby' => $orderBy,
		//'order' => $order,
	
	));
	
	if( !count( $rows ) )
		die();
	
?>

	<div class="row-fluid <?php echo $class; ?>">
	
		<?php
			$i=0;
			foreach( $rows as $row )
			{
			
			if( $i%(12/$span) == 0 && $i != 0 )
				echo "\n".'</div>'."\n".'<div class="row-fluid '.$class.'">'."\n";
			
		?>
		
		<div class="span<?php echo $span; ?> spanwrp">
			<div class="latestfeed-item item-<?php echo $i%(12/$span); ?>">
				<div class="latest-fnc">
					<img alt="<?php echo $row->post_title; ?>" src="<?php echo devn_get_featured_image($row); ?>" />
					<a title="<?php echo __('View more detail','devn'); ?>" href="<?php echo get_permalink($row->ID); ?>" class="linkicon fnicon"></a>
					<a rel="lb[feedsss]" title="<?php echo $row->post_title; ?>" href="<?php echo devn_get_featured_image($row); ?>" class="viewicon fnicon lightbox"></a>
				</div>
				<div class="latest-desc">
					<div class="latest-desc-body">
						<span class="latest-title">
							<a title="<?php echo $row->post_title; ?>" href="<?php echo get_permalink($row->ID); ?>" class="lt-title">
								<?php echo $row->post_title; ?>
							</a>
						</span>	
						<span class="posted-on georgia">
							<?php echo date(get_option('date_format'), strtotime($row->post_date)); ?>
						</span>
							<?php 

								$intros = explode( ' ', str_replace('  ',' ', strip_tags( $row->post_content ) ));
								$intro = array();
								for( $j=0; $j< 28; $j++ ){
									if(isset($intros[$j]))array_push( $intro, $intros[$j] );
								}
								
							?>
						</div>
					<span class="latest-desc-arr"></span>
				</div>
			</div>
		</div>
		
		<?php $i++; } ?>

	</div>
	<?php if($loadmore){ ?>
	<div class="loadmorefeed" onmouseover="homefeeds(this,'<?php echo SITE_URI; ?>',<?php echo ($offset + $amount).', '.$amount ?>)">
		<?php echo __('Load more','devn'); ?>
	</div>
	<?php } ?>
<?php
	if( isset( $_POST['offset'] ) || isset( $_POST['amount'] ) )
		die();
	
}
	
add_action('wp_ajax_homefeeds', 'latestfeeds');
add_action('wp_ajax_nopriv_homefeeds', 'latestfeeds');



	
	

	
/*
*
*Execute live view when edit and add widget in inspector
*
*/	

if( !empty($_POST['mode']) )
{
	if( $_POST['mode'] == 'inspector' && current_user_can('edit_theme_options') )
	{
		
		if(!empty( $_POST['sidebars'] ) )
		{

			// save widgets order for all sidebars
			if ( is_array($_POST['sidebars']) ) {
			
				$sidebars = array();
				
				foreach ( $_POST['sidebars'] as $key => $val ) {
					$sb = array();
					if ( !empty($val) ) {
						$val = explode(',', $val);
						foreach ( $val as $k => $v ) {
							if ( strpos($v, 'widget-') === false )
								continue;

							$sb[$k] = substr($v, strpos($v, '_') + 1);
						}
					}
					$sidebars[$key] = $sb;
				}
				
				wp_set_sidebars_widgets($sidebars);

			}
		}
		
		if(!empty( $_POST['sidebar'] ) ){
		
			add_action('wp','display_sidebar_by_page');
			
		}	
		
		if(!empty( $_POST['previewPHP'] ) ){
		
			add_action('wp','display_previewPHP_by_page');
			
		}	

	}
	
}


function display_previewPHP_by_page(){
	
	if( !current_user_can('edit_theme_options') )
		die(-1);
		
	$text = str_replace( array('\"',"\'"), array('"',"'"), $_POST['previewPHP']);
	
	ob_start();
	$exxxe = devnExt::phpExe('?>'.$text);
	if( $exxxe === false )echo '<font color="red">PHP Parse Error:</font> error on your code at widget <strong>'.(!empty( $title )?$title:'execphp')."</strong>";
	
	$text =  do_shortcode( ob_get_contents() );
	ob_end_clean();
			
	echo $text;
	
	exit;

}

function display_sidebar_by_page(){
	
	if( !current_user_can('edit_theme_options') )
		die(-1);

	global $devn_curFile;
	
	$devn_curFile = 'single';
	
	dynamic_sidebar( $_POST['sidebar'] );
	
	exit;

}



add_action('wp_ajax_savePageContent', 'savePageContent');

function savePageContent(){

	$content= $_POST['content'];
	$title= $_POST['title'];
	$id= $_POST['id'];
	
	$my_post = array(
	  'ID'           => $id,
	  'post_content' => $content,
	  'post_title'	 => $title
	);

  	wp_update_post( $my_post );
  	
}



add_action('wp_ajax_saveCustomize', 'saveCustomize');

function saveCustomize(){

	$value= $_POST['value'];
	$id= $_POST['id'];
	
	update_option( $id, $value );
  	
}