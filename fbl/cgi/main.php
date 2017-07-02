<?php
/*
*	This is private registration with WP
* 	(c) www.devn.co
*	
*/


add_action( 'widgets_init', 'devn_widgets_init' );
/*----------------------------------------------------------*/
#	Register sidebars from database
/*----------------------------------------------------------*/
function devn_widgets_init() {

	$widgets = get_option('sidebars_widgets');
	if( isset($widgets['wp_inactive_widgets']) )
	{
		foreach( $widgets['wp_inactive_widgets'] as $inactive ){
			$inactive = explode( '-' , $inactive );
			$wname = $inactive[0];
			$wid = $inactive[ count($inactive) -1 ];
			for($i=1; $i<count($inactive)-1; $i++){
				$wname .= '-'.$inactive[ $i ];
			}
			//echo $wname.' '.$wid.'<br />';
			$widget = get_option('widget_'.$wname);
			if( !empty( $widget[$wid] ))
			{
				unset($widget[$wid]);
			}	
			update_option( 'widget_'.$wname , $widget );
		}
		unset($widgets['wp_inactive_widgets']);
		update_option( 'sidebars_widgets' , $widgets );
	}


	if( is_array($widgets) )
	{
		foreach( $widgets as $k => $v ){
			if( is_array( $v ) )
			{
				$name = ucfirst( str_replace(array('-','_'),array(' ',' '),$k) );
				register_sidebar( array(
					'name' => $name,
					'id' => $k,
					'description' => $name.' sidebar created by Visual Design',
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => "</aside>",
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>',
				) );
			}
		}
	}else{
		register_sidebar( array(
			'name' => 'Welcome to  www.devn.co',
			'id' => '___',
			'description' => "Please create widgets in Grid layout",
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
	}

}
add_action('admin_head', 'global_assets', 1 );
/*----------------------------------------------------------*/
#	Add assets in admin
/*----------------------------------------------------------*/
function global_assets(){
	
	$uri = get_template_directory_uri().'/cgi/assets/';
	echo '<script type="text/javascript">var uri = "'.$uri.'";</script>'."\n";
	echo '<link type="text/css" rel="stylesheet" href="'.$uri.'css/global.css" />'."\n";
	echo '<script type="text/javascript" src="'.$uri.'js/base64.js"></script>'."\n";

	/*Load mirror for page builder*/
	if( !empty($_REQUEST['action']) ){
		if( $_REQUEST['action'] = 'edit' ){
			devn_mirrorAssets( $uri );
		}	
	}	
	if(isset($_REQUEST['post_type'])){
		devn_mirrorAssets( $uri );
	}
	if( !empty($_REQUEST['page']) )
	{
		if( $_REQUEST['page'] == 'panel' )
		{
			echo '<script type="text/javascript" src="'.$uri.'jscolor/jscolor.js"></script>'."\n";
			
		}
		else if( $_REQUEST['page'] == 'visual-design' )
		{
				
			wp_enqueue_script('pw-widgets','/wp-admin/js/widgets.js', array('jquery', 'jquery-ui-sortable', 'jquery-ui-draggable', 'jquery-ui-droppable', 'jquery-ui-tabs', 'jquery-ui-accordion', 'jquery-ui-resizable'), '1.1', true);
			devn_mirrorAssets( $uri );
			wp_enqueue_media();
			
			$cssUri = $uri.'css/';
			$jsUri = $uri.'js/';
			devn_assets(array(
				array('css' => $cssUri.'jquery-ui'),
				array('css' => $cssUri.'bootstrap-icons'),
				array('css' => $cssUri.'bootstrap_responsive'),
				array('css' => THEME_URI.'/css/bootstrap3/css/bootstrap.min'),
				array('css' => $cssUri.'style'),
				array('css' => $cssUri.'grid'),
				array('js' => $jsUri.'widgets_lt'),
				array('js' => $jsUri.'devn.framework'),
				array('js' => $jsUri.'grid'),
				array('js' => 'js/widgets'),
				array('js' => $uri.'jscolor/jscolor')
			));
		
		}
		else if( $_REQUEST['page'] == 'live-inspector' )
		{
						
		}	
		else if( $_REQUEST['page'] == 'devn-sample-data' )
		{
			devn_assets(array(
				array('css' => THEME_URI.'/css/bootstrap3/css/bootstrap.min'),
				array('css' => $uri.'css/sample')
			));
		}
	}	
}

function devn_mirrorAssets( $uri ){
	
	$u = $uri.'codemirror/lib/';
	$ut = $uri.'codemirror/lib/util/';
	$m = $uri.'codemirror/mode/';
	
	devn_assets(array(
		array('css' => $u.'codemirror'),
		array('css' => $u.'util/dialog'),
		array('css' => $uri.'codemirror/theme/eclipse'),
		array('js' => $u.'codemirror'),
		array('js' => $ut.'searchcursor'),
		array('js' => $ut.'match-highlighter'),
		array('js' => $ut.'closetag'),
		array('js' => $ut.'formatting'),
		array('js' => $ut.'dialog'),
		array('js' => $ut.'searchcursor'),
		array('js' => $ut.'search'),
		array('js' => $m.'htmlmixed/htmlmixed'),
		array('js' => $m.'xml/xml'),
		array('js' => $m.'javascript/javascript'),
		array('js' => $m.'css/css'),
		array('js' => $m.'clike/clike'),
		array('js' => $m.'php/php'),
	));

}
/*----------------------------------------------------------*/
#	Visual Design Layout Page
/*----------------------------------------------------------*/
function devn_mainPageLayoutGrid() {  
	
	global $wp_registered_sidebars, $devn_sidebars_widgets, $wp_registered_widgets,$devn;

	/*Load data widgets*/
	$devn->widgets_common();
	
	/*saving a widget without js*/
	if ( isset($_POST['savewidget']) || isset($_POST['removewidget']) ) {
		//save0js();
	}

	// Output the widget form without js
	if ( isset($_GET['editwidget']) && $_GET['editwidget'] ) {
		
		$devn->incl( 'editwidget' );
		
		exit;
		
	}

?>
 
<script type="text/javascript">
<?php
	$widgets = get_option('sidebars_widgets');
	$arg = array();
	if(is_array($widgets))foreach( $widgets as $k => $v ){
		if( is_array( $v ) )
		{
			array_push( $arg ,$k );
		}
	}	
	echo "var positions = ['".implode("','",$arg)."']";
?>
	
	var theme = '<?php echo THEME_URI; ?>';
	var site_uri = '<?php echo SITE_URI; ?>';
	
</script>
<div class="wrap">
	<?php 
		do_action( 'widgets_admin_page' );
		$devn->incl( 'wg_list_left' ); 
		$devn->incl( 'wg_list_right' );
	?>
	<form action="" method="post">
		<?php wp_nonce_field( 'save-sidebar-widgets', '_wpnonce_widgets', false ); ?>
	</form>
</div>
<?php	
}

/*----------------------------------------------------------*/
#	Sample Data Page
/*----------------------------------------------------------*/

function devn_sample_data(){
	devn::incl('sample');
}

add_action( 'admin_bar_menu', 'devn_add_admin_bar_visualDesign_btn', 135 );
/*----------------------------------------------------------*/
#	Register Inspector Button on top of page on front end
/*----------------------------------------------------------*/
function devn_add_admin_bar_visualDesign_btn() {

	global $wp_admin_bar, $devn_curFile, $post;
	
	$alias = '';
	$cur_file = $devn_curFile;
	if( $devn_curFile == 'single'  )
		$cur_file = 'post';
	else if( $devn_curFile == 'tag'  )
		$cur_file = 'post_tag';	

	if( !empty( $cur_file ) ){
		$alias .= '#layout|edit|'.$cur_file;
		if( $cur_file == 'page' )
		{
			$alias .= '-'.$post->ID;
		}else if( $cur_file == 'category' )
		{
			$alias .= '-'. get_cat_id( single_cat_title("",false) );
		}else if( $cur_file == 'post_tag' )
		{
			global $wp_query;
			$tag = $wp_query->get_queried_object();
			$current_tag = $tag->term_id;
			$alias .= '-'.$current_tag;
		}else if( $cur_file == 'index' ){	
			if(  get_option('page_for_posts') ){
				$alias = '#layout|edit|page-'.get_option('page_for_posts');
			}else{
				$alias = '#layout|edit|index';
			}
		}
	}
	if( is_admin() ){
		global $post;
		if( !empty($post->post_type) ){
			 if( $post->post_type== 'page' ){
				 $alias = '#layout|edit|page-'.$post->ID;
			 }
		}	
	}
	
	if( $alias != '' ){
		$alias .= '|visual';
	}
	
	if ( !is_super_admin() || !is_admin_bar_showing() )
	  return;
		
	$wp_admin_bar->add_menu( 
		array( 'id' => 'visualDesignLayouts', 
			'title' => '<span class="ab-icon"></span>Visual Design Layout<style type="text/css">#wp-admin-bar-visualDesignLayouts .ab-icon:before{content: "\f180";top:3px;}</style>', 
			'href' => site_url( 'wp-admin/admin.php?page=visual-design'.$alias )
		) 
	);
}


add_action("after_switch_theme", "devn_activeTheme", 1000 ,  1);
/*----------------------------------------------------------*/
#	Active theme -> import some data
/*----------------------------------------------------------*/
function devn_activeTheme($oldname, $oldtheme=false) {
	
	global $devn;
	
	#Check to import base of settings
	$devn->incl('import');
	
	?>
	<style type="text/css">
		body{display:none;}
	</style>
	<script type="text/javascript">
		/*Redirect to install required plugins after active theme*/
		window.location = 'admin.php?page=devn-sample-data';
	</script>
	
	<?php
	
}


/*----------------------------------------------------------*/
#	Theme Setup
/*----------------------------------------------------------*/
function DEVNThemeSetup() {

	load_theme_textdomain( 'devn', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ,'title','editor','author','thumbnail','excerpt','custom-fields','page-attributes') );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'devn' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );
	
	add_theme_support( "custom-header", array() ); 

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
	
	
}
add_action( 'after_setup_theme', 'DEVNThemeSetup' );


add_action('add_meta_boxes','devn_add_page_layout_template_metabox');
/*----------------------------------------------------------*/
#	Add select layout on page edit
/*----------------------------------------------------------*/
function devn_add_page_layout_template_metabox() {
    add_meta_box('devnselectlayout', __('DEVN Visual Layouts','devn'), 'devn_post_template_meta_box', 'page', 'side', 'core');
    add_meta_box('devnselectlayout', __('DEVN Visual Layouts','devn'), 'devn_post_template_meta_box', 'post', 'side', 'core');
    add_meta_box('devnfeildsteam', __('Staff Profiles','devn'), 'devn_staff_fields_meta_box', 'our-team', 'normal', 'high');
    add_meta_box('devnfeildswork', __('Project\'s Link','devn'), 'devn_work_fields_meta_box', 'our-works', 'normal', 'high');
}

function devn_post_template_meta_box( $post ) {
	
	if( get_option('show_on_front') == 'page' ){
		$pid = get_option('page_for_posts');
		if( $post->ID == $pid ){
		?>
			<br />
			<span style="color:red"><?php echo __('This page was setted to display as Posts Page.','devn'); ?></span>
			<br />
			<p>
				<a title="<?php echo __('Open Visual Design Layouts to edit','devn'); ?>" href="admin.php?page=visual-design#layout|edit|page-<?php echo $post->ID; ?>" class="button button-primary" target=_blank style="margin-right: 10px;"><?php echo __('Open in Visual Tool','devn'); ?></a>
			
				<a href="javascript:;" style="float:right" title="<?php echo __("This article will use the layouts created by the 'Visual Design Layout' tool",'devn'); ?>" onclick="alert(this.title);"><?php echo __('What is this?','devn'); ?></a>
			</p>
		<?php
		
			return;	
		
		}
	}
	
	if ( 'page' == $post->post_type || 'post' == $post->post_type ) {
  
		$layout = get_post_meta( $post->ID,'_devn_page_layout' , true );
		$playout = get_post_meta( $post->ID,'_wp_page_template' , true );
		
		$file = dirname(__FILE__).DS.'layouts'.DS.'page-'.$post->ID.'.xml';
		if( file_exists( $file ) )
		{
			_e('You can not chose Visual Layout, because this page was created layout.', 'devn');
			echo '<br /><br /><a href="admin.php?page=visual-design#layout|edit|page-'.$post->ID.'" target=_blank class="button button-primary">Edit in Visual Design Layout</a>';
			
			echo '<input type="hidden" name="page_layout" value="page-'.$post->ID.'" />';
			
			return;
		}
		
		if( $playout == 'default' || empty( $playout ) )
		{
			echo '<p><strong>'.__('Select layout for this ','devn').$post->post_type.'</strong></p>';
			echo '<select style="width: 100%;" name="page_layout">';
			echo '<option value="">--- Default Layout ---</option>';
			
			$privateLayout = get_option('devn_customize__Private');
			
			if ($handle = opendir(dirname(__FILE__).DS.'layouts')) {
				/* This is the correct way to loop over the directory. */
				while (false !== ($entry = readdir($handle))) {
					
					$entryz = explode( '.' , $entry );
					
					if( $entryz[1] == 'xml' && !in_array( $entryz[0] , $privateLayout ) ){
					
						$devn_xml = simplexml_load_file( dirname(__FILE__).DS.'layouts'.DS.$entry );

						$title = $devn_xml->title;
						$lt = str_replace('.xml','',$entry);
						
						echo '<option';
						
						if( $layout == $lt ){
							echo " selected ";
						}	
						echo ' value="'.$lt.'">'.$title.'</option>';
					}	
				}

				closedir($handle);
			}
			
			?>
				</select>
				<br />
				<br />
				<p>
					<a title="<?php echo __('Open Visual Design Layouts to edit','devn'); ?>" href="admin.php?page=visual-design#layout|edit|page-<?php echo $post->ID; ?>" class="button button-primary" target=_blank style="margin-right: 10px;"><?php echo __('Open in Visual Tool','devn'); ?></a>
				
					<a href="javascript:;" style="float:right" title="<?php echo __("This article will use the layouts created by the 'Visual Design Layout' tool",'devn'); ?>" onclick="alert(this.title);"><?php echo __('What is this?','devn'); ?></a>
				</p>
				
		<?php	
			}else{
			
				/*if page select template attribute*/
				echo '<br />';
				echo '<span style="color:red">'.__('You can not use Visual Layout for this page because you choseed a page-template for this page.','devn').'</span>';
				echo '<br />';
			
			}
	}
}

function devn_staff_fields_meta_box( $post ) {

	$staff = get_post_meta( $post->ID , 'devn_staff' );
	if( !empty( $staff ) ){
		$staff  = $staff[0];
	}else{
		$staff = array( 'position' => '', 'facebook' => '', 'twitter' => '', 'gplus' => '', 'skype' => '' );
	}	
	
?>

	<table>
		<tr>
			<td>
				<label><?php _e('Position','devn'); ?>: </label>
			</td>
			<td>	
				<input type="text" name="devn_staff_position" value="<?php echo $staff['position'];	?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label><?php _e('Facebook','devn'); ?>: </label>
			</td>
			<td>
				<input type="text" name="devn_staff_facebook" value="<?php echo $staff['facebook'];	?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label><?php _e('Twitter','devn'); ?>: </label>
			</td>
			<td>
				<input type="text" name="devn_staff_twitter" value="<?php echo $staff['twitter'];	?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label><?php _e('Google+','devn'); ?>: </label>
			</td>
			<td>
				<input type="text" name="devn_staff_gplus" value="<?php echo $staff['gplus'];	?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label><?php _e('Skype','devn'); ?>: </label>
			</td>
			<td>
				<input type="text" name="devn_staff_skype" value="<?php echo $staff['skype'];	?>" />
			</td>
		</tr>
	</table>

<?php
}


function devn_work_fields_meta_box( $post ) {

	$work = get_post_meta( $post->ID , 'devn_work' );
	if( !empty( $work ) ){
		$work  = $work[0];
	}else{
		$work = '';
	}	
	
?>

	<input type="text" name="devn_project_link" value="<?php echo $work; ?>" style="width: 100%;" />

<?php
}



/* Add box select layouts into page|post editting */
add_action('save_post','devn_save_page_layout_template',10,2);
function devn_save_page_layout_template( $post_id, $post ) {

	if ( ( $post->post_type=='page' || $post->post_type=='post' ) && isset($_POST['page_layout']) ){
	
		update_post_meta( $post->ID , '_devn_page_layout' , $_POST['page_layout'] );
		
	}
		
	if( $post->post_type == 'our-team' ){
	
		$position = !empty($_POST['devn_staff_position']) ? $_POST['devn_staff_position'] : '';
		$facebook = !empty($_POST['devn_staff_facebook']) ? $_POST['devn_staff_facebook'] : '';
		$twitter = !empty($_POST['devn_staff_twitter']) ? $_POST['devn_staff_twitter'] : '';
		$gplus = !empty($_POST['devn_staff_gplus']) ? $_POST['devn_staff_gplus'] : '';
		$skype = !empty($_POST['devn_staff_skype']) ? $_POST['devn_staff_skype'] : '';
		
		update_post_meta( $post->ID , 'devn_staff' , array( 'position' => $position, 'facebook' => $facebook , 'twitter' => $twitter, 'gplus' => $gplus , 'skype' => $skype ) );	
	}

		
	if( $post->post_type == 'our-works' ){
		$link = !empty($_POST['devn_project_link']) ? $_POST['devn_project_link'] : '';
		update_post_meta( $post->ID , 'devn_work' , $link );	
	}

}


function devn_list_post_type(){

	return array( 
		'our-team' => array(
			'menu_icon' => 'dashicons-groups',
		    'labels' => array(
			    'name' => 'Our Team',
			    'singular_name' => 'our-team',
			    'add_new' => 'Add new staff',
			    'edit_item' => 'Edit staff',
			    'new_item' => 'New staff',
			    'view_item' => 'View staff',
			    'search_items' => 'Search staff',
			    'not_found' => 'No team found',
			    'not_found_in_trash' => 'No staff found in Trash'
		    ),
		    'public' => true,
		    'supports' => array('title','editor','thumbnail'),
		    'taxonomies' => array('category') 
	    ),
	    'our-works' => array(
	    	'menu_icon' => 'dashicons-book',
		    'labels' => array(
			    'name' => 'Our Works',
			    'singular_name' => 'our-works',
			    'add_new' => 'Add new project',
			    'edit_item' => 'Edit project',
			    'new_item' => 'New project',
			    'view_item' => 'View project',
			    'search_items' => 'Search project',
			    'not_found' => 'No project found',
			    'not_found_in_trash' => 'No project found in Trash'
		    ),
		    'public' => true,
		    'supports' => array('title','editor','author','thumbnail','excerpt'),
		    'taxonomies' => array('category')
	    ),
		'testimonials' => array(
			'menu_icon' => 'dashicons-admin-comments',
		    'labels' => array(
			    'name' => 'Testimonials',
			    'singular_name' => 'testimonials',
			    'add_new' => 'Add new testimonial',
			    'edit_item' => 'Edit testimonial',
			    'new_item' => 'New testimonial',
			    'view_item' => 'View testimonial',
			    'search_items' => 'Search testimonial',
			    'not_found' => 'No testimonial found',
			    'not_found_in_trash' => 'No testimonial found in Trash'
		    ),
		    'public' => true,
		    'supports' => array('title','editor','author','thumbnail','excerpt','custom-fields','page-attributes'),
		    'taxonomies' => array('category')
	    ),
	    
	 );

}


/*Add post type*/
add_action( 'init', 'devn_create_post_type_team' );
function devn_create_post_type_team() {
	
    foreach( devn_list_post_type() as $postType => $cofg ){
	    
	    register_post_type( $postType, $cofg );
	    
    }

}




/*Admin footer custom*/
add_action( 'in_admin_footer', 'devn_in_admin_footer_func' );
function devn_in_admin_footer_func(){
	global $post;
	$typeofCurPage = !empty($post->post_type)?$post->post_type:'';
	if( is_admin() && $typeofCurPage == 'page' ){
	?>
		<script type="text/javascript">
			
			jQuery('.wp-editor-tabs').append('<a href="admin.php?page=visual-design#layout|edit|page-<?php echo $post->ID; ?>|visual" class="wp-switch-editor" style="text-decoration: none;" title="<?php _e('Click to edit this page by DEVN Page Builder','devn'); ?>"><i class="fa fa-star-o"></i> Live Builder</a>');
			jQuery('#devnselectlayout').parent().prepend( jQuery('#devnselectlayout') );
		</script>
	<?php
	}
}



/*-----------------------------------------------------------------------------------*/
/* MEGA MENU
/*-----------------------------------------------------------------------------------*/
function devn_register_mega_menu() {

    $labels = array(
        'name' => __('DEVN - Mega Menu', 'devn'),
        'singular_name' => __('DEVN - Mega Menu', 'devn'),
        'add_new' => __('Add New', 'devn'),
        'add_new_item' => __('Add New DEVN Mega Menu Item', 'devn'),
        'edit_item' => __('Edit DEVN Mega Menu Item', 'devn'),
        'new_item' => __('New DEVN Mega Menu Item', 'devn'),
        'view_item' => __('View DEVN Mega Menu Item', 'devn'),
        'search_items' => __('Search DEVN Mega Menu Items', 'devn'),
        'not_found' => __('No DEVN Mega Menu Items found', 'devn'),
        'not_found_in_trash' => __('No DEVN Mega Menu Items found in Trash', 'devn'),
        'parent_item_colon' => __('Parent DEVN Mega Menu Item:', 'devn'),
        'menu_name' => __('Mega Menu', 'devn'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __('Mega Menus entries for Slowave.', 'devn'),
        'supports' => array('title', 'editor'),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 40,

        'show_in_nav_menus' => true,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => false,
        'capability_type' => 'post'
    );

    register_post_type('mega_menu', $args);
}
add_action('init', 'devn_register_mega_menu');


function devn_add_sc_select() {

    global $post;
    if(isset($post -> ID)) {
        if (!(get_post_type($post->ID) == 'mega_menu'))
            return false;
    } else {
        return false;
    }

    echo '<select id="sc_select"><option>Insert Mega Menu</option>';
    $menus = get_terms('nav_menu');
    foreach($menus as $menu) {
        echo '<option value="[mega_menu col=\'3\' title=\''.$menu->name.
        '\' menu=\''.$menu->slug.
        '\']">'.$menu->name.
        '</option>';
    }
    echo '</select>';
}
add_action('media_buttons', 'devn_add_sc_select', 1003);


function devn_button_js() {
    echo '<script type="text/javascript">jQuery(document).ready(function(){jQuery("#sc_select").change(function() {send_to_editor(jQuery("#sc_select :selected").val());return false;});});</script>';
}
add_action('admin_head', 'devn_button_js');

function devn_mega_menu($atts, $content = null) {

    extract(shortcode_atts(array(
        'menu' => '',
        'title' => '',
        'col' => 12
    ), $atts));
    
	global $wpdb;
	
	$menuID = $wpdb->get_results('SELECT `term_id` FROM `'.$wpdb->prefix.'terms` WHERE `'.$wpdb->prefix.'terms`.`slug` = "'.$menu.'"');
	if( empty( $menuID[0] ) ){
		return;
	}
	if( empty( $menuID[0]->term_id ) ){
		return;
	}
	$menu = $menuID[0]->term_id;
    $items = wp_get_nav_menu_items( $menu );

    $output = '';
    $output.= '<ul class="col-md-'.$col.' list-unstyled ">';
	if ($title)$output.= '<li><p>'.$title.'</p></li>';
    if ($items) {
        foreach($items as $item) {
            $output.= '<li><a href="'.$item->url.
            '"><i class="fa fa-angle-right"></i> '.$item->title.
            '</a></li>';
        }
    }

    $output.= '</ul>';

    return $output;
    
}
add_shortcode('mega_menu', 'devn_mega_menu');

if(!is_admin()) {

	add_action("template_include", 'devn_load_layout');
	function devn_load_layout( $file ){
		
		$fileTest = str_replace( array( "\\", "/" ), array( DS , DS ), $file );
		
		if( strpos($fileTest, 'hoxa'.DS.'woocommerce'.DS) != false ){
		
			global $devn_curFile,$devn_curFile2,$post,$devn_settings,$devn_xml,$devn;
	
			
			$devn_curFile2 = substr($fileTest, strpos($fileTest, 'hoxa'.DS.'woocommerce'));
			$devn_curFile2 = str_replace(array('hoxa','.php'), array('..'.DS.'..',''), $devn_curFile2);
	
			$devn_curFile = 'general';
	
			$alias = 'general';
			
			$devn_xml = devn::getLayout( $alias );
			
			$devn->tp_mode( $fileTest );
			
			get_header();
		
			devnExt::phpExe('?>'.$devn_xml->html);
	
			get_footer();
		
		}else{
			return $file;
		}
		
	}

}
/*Load Header*/
add_action( 'wp_head', 'devn_loadHeader' );
function devn_loadHeader(){
	
	global $devn_settings,$devn;
	
	echo '<link rel="stylesheet" id="bootstrapstylesheet" type="text/css" href="'.THEME_URI.'/css/bootstrap3/css/bootstrap.min.css" />'."\n".
	'<link id="mainstylesheet" rel="stylesheet" type="text/css" media="all" href="'.get_bloginfo( 'stylesheet_url' ).'" />'."\n".
	'<link rel="stylesheet" type="text/css" href="'.THEME_URI.'/css/options.css?refr='.time().'" />'."\n".
	'<link rel="stylesheet" type="text/css" href="'.THEME_URI.'/css/responsive.css" />'."\n".
	'<link rel="stylesheet" type="text/css" href="'.THEME_URI.'/js/pretty/css/prettyPhoto.css" />'."\n";

	if( !empty( $devn_settings['favicon'] ) ){
		echo '<link rel="shortcut icon" href="'.$devn_settings['favicon'].'" type="image/x-icon" />';
	}
			
	echo str_replace(array('&#59;','&#39;','&#34;'), array(';', "'", '"'), $devn_settings['header']);
	
	if ( is_singular() && get_option( 'thread_comments' ) ){
		wp_enqueue_script( 'comment-reply' );
	}
		
	echo "<script type=\"text/javascript\">var uri = '".THEME_URI."';</script>";
	
	wp_register_script( 'devn-jquery-ui', THEME_URI.'/js/jquery/jquery-ui.min.js', array('jquery'), '8', false );
	wp_register_script( 'devn-prettyPhoto', THEME_URI.'/js/pretty/js/jquery.prettyPhoto.js', array('jquery'), '8', false );
	wp_register_script( 'devn-flexslider', THEME_URI.'/js/jquery.flexslider.js', array('jquery'), '8', false );
	wp_register_script( 'devn-viewportchecker', THEME_URI.'/js/viewportchecker.js', array('jquery'), '8', false );
	wp_register_script( 'devn-custom', THEME_URI.'/js/custom.js', array('jquery'), '8', false );

	wp_enqueue_script( 'devn-jquery-ui' );
	wp_enqueue_script( 'devn-prettyPhoto' );
	wp_enqueue_script( 'devn-flexslider' );
	wp_enqueue_script( 'devn-viewportchecker' );
	wp_enqueue_script( 'devn-custom' );
	wp_register_style(
		'devn-jquery-ui',
		THEME_URI.'/js/jquery/jquery-ui.min.css',
		'',
		time(),
		'all'
	);
	wp_enqueue_style('devn-jquery-ui');
	$devn->header();
	
}



/*Load Header*/
add_action( 'wp_footer', 'devn_loadFooter' );
function devn_loadFooter(){
	global $devn;
	$devn->footer(); 
	echo '<a href="#" class="scrollup" id="scrollup" style="display: none;">Scroll</a>'."\n";
}