<?php
/*
*	Main HUB for install devn framework and directs sub page
*	No one has the right to modify this - Under DEVN Network's License
*	(c) www.devn.co
*
*/
#
#Define main class
#



class devn{
	/*------------------------------------*/
	#	Register widgets from framework data
	/*------------------------------------*/
	public function widgets_common(){

		global $wp_registered_sidebars, $devn_sidebars_widgets, $wp_registered_widgets;		
			
		/* For live design & grid */

		$devn_sidebars_widgets = wp_get_sidebars_widgets();
		
		if (empty($devn_sidebars_widgets))
			$devn_sidebars_widgets = wp_get_widget_defaults();


		if (!function_exists('wp_list_widgets'))
		require_once(ABSPATH . '/wp-admin/includes/widgets.php');

	}
	/*------------------------------------*/
	#	HELL
	/*------------------------------------*/
	public function save0js(){
		
		$widget_id = $_POST['widget-id'];
		check_admin_referer("save-delete-widget-$widget_id");

		$number = isset($_POST['multi_number']) ? (int) $_POST['multi_number'] : '';
		if ( $number ) {
			foreach ( $_POST as $key => $val ) {
				if ( is_array($val) && preg_match('/__i__|%i%/', key($val)) ) {
					$_POST[$key] = array( $number => array_shift($val) );
					break;
				}
			}
		}

		$sidebar_id = $_POST['sidebar'];
		$position = isset($_POST[$sidebar_id . '_position']) ? (int) $_POST[$sidebar_id . '_position'] - 1 : 0;

		$id_base = $_POST['id_base'];
		$sidebar = isset($devn_sidebars_widgets[$sidebar_id]) ? $devn_sidebars_widgets[$sidebar_id] : array();

		// delete
		if ( isset($_POST['removewidget']) && $_POST['removewidget'] ) {

			if ( !in_array($widget_id, $sidebar, true) ) {
				wp_redirect( admin_url('widgets.php?error=0') );
				exit;
			}

			$sidebar = array_diff( $sidebar, array($widget_id) );
			$_POST = array('sidebar' => $sidebar_id, 'widget-' . $id_base => array(), 'the-widget-id' => $widget_id, 'delete_widget' => '1');
		}

		$_POST['widget-id'] = $sidebar;

		foreach ( (array) $wp_registered_widget_updates as $name => $control ) {
			if ( $name != $id_base || !is_callable($control['callback']) )
				continue;

			ob_start();
				call_user_func_array( $control['callback'], $control['params'] );
			ob_end_clean();

			break;
		}

		$devn_sidebars_widgets[$sidebar_id] = $sidebar;

		// remove old position
		if ( !isset($_POST['delete_widget']) ) {
			foreach ( $devn_sidebars_widgets as $key => $sb ) {
				if ( is_array($sb) )
					$devn_sidebars_widgets[$key] = array_diff( $sb, array($widget_id) );
			}
			array_splice( $devn_sidebars_widgets[$sidebar_id], $position, 0, $widget_id );
		}

		wp_set_sidebars_widgets($devn_sidebars_widgets);
		wp_redirect( admin_url('widgets.php?message=0') );
		exit;
		
	}
	/*------------------------------------*/
	#	Short Include function
	/*------------------------------------*/
	public static function incl( $file ){
		require_once(  get_template_directory().'/cgi/'.$file.'.php' );
	}	
	/*------------------------------------*/
	#	Find and get layout file XML
	/*------------------------------------*/	
	public static function getLayoutName( $page = 'general' ){
		
		$x = dirname(__FILE__).DS.'layouts'.DS;
		
		if( file_exists( $x.$page.'.xml' ) )
		{
			return $page;
		}else{

			$page = explode( "-", $page);
			/*If it chose layout in edit-page*/
			if( $page[0] == 'page' && isset($page[1]) )
			{
				$gid = get_post_meta( $page[1],'_devn_page_layout', true);

				if( !empty( $gid ) )
				{
				
					if( file_exists( $x.$gid.'.xml' ) )
					{
						return $gid;
					}	
				}
			}
			
			if( file_exists( $x.$page[0].'.xml' ) )
			{
				return $page[0];
			}
			
		}
		
		return 'general';
	
	}
	/*------------------------------------*/
	#	Find and get layout for front-side
	/*------------------------------------*/
	public static function getLayoutAtReal(){
		
		global $devn_curFile;
		
		$post = get_post();
		$id = !empty($post)?$post->ID:'';
		$x = dirname(__FILE__).DS.'layouts'.DS;
		$alias = $devn_curFile;

		$cur_file = $devn_curFile;
		if( $devn_curFile == 'single'  )
			$cur_file = 'post';
		else if( $devn_curFile == 'tag'  )
			$cur_file = 'post_tag';	

		if( !empty( $cur_file ) ){
		
			$alias = $cur_file;
			if( $cur_file == 'page' )
			{
				global $post;
				if( file_exists( $x.$alias.'-'.$post->ID.'.xml' ) )
				{
					$alias .= '-'.$post->ID;
				}
				
				$gid = get_post_meta( $post->ID,'_devn_page_layout', true);
				if( !empty( $gid ) )
				{
					if( file_exists( $x.$gid.'.xml' ) )
					{
						$alias = $gid;
					}	
				}
				
			}else if( $cur_file == 'category' )
			{
				if( file_exists( $x.$alias.'-'.get_cat_id( single_cat_title("",false) ).'.xml' ) )
				{
					$alias .= '-'. get_cat_id( single_cat_title("",false) );
				}	
			}else if( $cur_file == 'post_tag' )
			{
				global $wp_query;
				$tag = $wp_query->get_queried_object();
				$current_tag = $tag->term_id;
				if( file_exists( $x.$alias.'-'.$current_tag.'.xml' ) )
				{
					$alias .= '-'.$current_tag;
				}

			}else if( $cur_file == 'index' ){
				
				if( file_exists( $x.'index.xml' ) ){
					$alias = 'index';
				}else{	
					$page4posts = get_option('page_for_posts');
					
					if( !empty( $page4posts ) ){
						
						$gid = get_post_meta( $page4posts,'_devn_page_layout', true);
						
						if( file_exists( $x.$gid.'.xml' ) ){
	
							$alias = $gid;
						}
						else if( file_exists( $x.'page-'.$page4posts.'.xml' ) )
						{
							$alias = 'page-'.$page4posts;
						}
					}
				}
			}
		}

		if( !file_exists( $x.$alias.'.xml' ) ){
			$alias = 'general';
		}
		
		return $alias;
		
	}
	/*------------------------------------*/
	#	Find and get layout from XML
	/*------------------------------------*/	
	public static function getLayout( $page = 'general' ){
		
		$x = dirname(__FILE__).DS.'layouts'.DS;
		$path = $x.'general.xml';
		
		if( file_exists( $x.$page.'.xml' ) )
		{
			$path = $x.$page.'.xml';
		}else{
		
			$page = explode( "-", $page);
			/*If it chose layout in edit-page*/
			if( $page[0] == 'page' && isset($page[1]) )
			{
				$gid = get_post_meta( $page[1],'_devn_page_layout', true);
				if( !empty( $gid ) )
				{
					if( file_exists( dirname(__FILE__).DS.'layouts'.DS.$gid.'.xml' ) )
					{
						$path = $x.$gid.'.xml';
					}	
				}
			}
			if( file_exists( $x.$page[0].'.xml' ) && $page[0].'.xml' != 'general.xml' )
			{
				$path = $x.$page[0].'.xml';
			}

		}

		$devn_xml = simplexml_load_file( $path );

		return 	$devn_xml;
	
	}
	/*------------------------------------*/
	#	Admin mode: zend layout from XML
	/*------------------------------------*/	
	public static function zendLayout( $page, $cpage = null ){
		
		global $devn,$wpdb;
		$task = !empty($_POST['task'])?$_POST['task']:null;
		if( empty($cpage) )
			$cpage = $page;
		$getLN = $devn->getLayoutName( $page );
		$devn_xml = $devn->getLayout( $page );
		$layout = $devn_xml->vitual;

		?>
		<div id="customHeadFootBtn">
			<div class="btn-group">
				<?php if( strpos( $page , 'groups/' ) === false ){ ?>
				<button class="btn btn-default">
					<i class="fa fa-pencil-square-o"></i>
					<a href="#grids|custom|header"> Custom Header </a>
				</button>
				<button class="btn btn-default">
					<i class="fa fa-pencil-square-o"></i>
					<a href="#grids|custom|footer"> Custom Footer </a>
				</button>
				<button class="btn btn-default" title="<?php _e("Don't allow use this layout in other where if private checked",'devn'); ?>">
					<input type="checkbox" id="privateLayout" <?php if( $devn_xml->private != 'no' )echo 'checked'; ?> />
					Private Layout
					&nbsp;
					<i class="fa fa-question-circle"></i>
				</button>
				<?php }else{ ?>
				<div class="input-group" style="max-width: 940px;">
				  <span class="input-group-addon">Group Class</span>
				  <input type="text" class="form-control" id="groupClass" onkeyup="this.value = this.value.replace(/[^[0-9a-zA-Z _-]]*/g,'')" value="<?php echo $devn_xml->groupclass; ?>" />
				  <span class="input-group-addon">Group ID</span>
				  <input type="text" class="form-control" id="groupID" onkeyup="this.value = this.value.replace(/[^[0-9a-zA-Z-_]]*/g,'')" value="<?php echo $devn_xml->groupid; ?>" />
				</div>
				<?php } ?>
			</div>
			<div class="popup-overlay" style="display:none">
				<div class="popup">
					<div class="popup-head">
						<h3 class="poptit">Cutom Header</h3>
						<a class="alignleft btn btn_normal" href="#grids|custom|close">
							<i class="fa fa-times"></i>Cancel
						</a>
						<a class="alignright btn btn_green" href="#grids|custom|save">
							<i class="fa fa-check"></i>Save
						</a>
					</div>
					<div class="popup-body scroll">
						<textarea id="customHeader" style="display:none"><?php echo $devn_xml->customHeader; ?></textarea><textarea id="customFooter" style="display:none"><?php echo $devn_xml->customFooter; ?></textarea>
					</div>
				</div>
			</div>	
		</div>	
				
		<?php
		

		$devn->zendLayoutLabel( $cpage );
		
		
		$ignore = array("___");
		$i = 0;

		if( !empty( $layout ) ){
			
			$layoutObj = json_decode( $layout );

			$height = $devn_xml->height?$devn_xml->height:'700';
			
			echo '<div id="grid-wrapest" class="'.str_replace('/',' ',$page).'" style="min-height:700px;height: '.$height.'px">';
				echo '<div id="mask-dragin"></div>';
			
			if( $getLN == $page )
			{
				if( is_array( $layoutObj ) && count( $layoutObj ) )
				{
					
					foreach( $layoutObj as $row ){
					
					$i++;
					
					$status =  !empty($row->cfg)?(!empty($row->cfg->status)?$row->cfg->status:''):'';
					
					?>
					<div id="sidebar-<?php echo $i; ?>" class="block-wrpest <?php echo $status; if(strpos($row->sid,'blocks[DS]')!== false)echo 'typeof-block'; if($row->width==940)echo ' max-width'; ?> " style="top:<?php echo $row->top ?>px;left:<?php echo $row->left ?>px;height:<?php echo $row->height; ?>px;width:<?php echo $row->width; ?>px;">
				
					<span title="Width x Height of this block" class="height-of-block">
						<?php echo $row->width.' x '.$row->height; ?>
					</span>
					<ul class="ui-widget functions-btn">
						<li class="ui-state">
							<a href="#sidebar|edit|<?php echo $i; ?>" title="<?php _e('Edit this area','devn'); ?>">
								<i class="fa fa-wrench"></i>
							</a>	
						</li>
					
						<li class="ui-state">
							<a href="#sidebar|remove|<?php echo $i; ?>" title="<?php _e('Remove this area','devn'); ?>">
								<i class="fa fa-times"></i>
							</a>
						</li>
					</ul>
					<div class="block-body">
	
					<?php	
					
						if( strpos( $row->sid , 'devn_customize' ) !== false ){
						
					?>	
							
						<div class="block-center">
							<div class="sidebar-wrpest btn-group">
								<div class="widgets-holder-wrap sidebar-inner"  cfg='<?php echo !empty($row->cfg)?json_encode($row->cfg):'' ?>' >
									<a href="#sidebar|edit|<?php echo $i; ?>" class="btn btn-default add-code-btn">
										<i class="fa fa-pencil"></i> 
										<span class="selectSidebarBtn">
										
											<?php
												if( empty( $row->custLabel ) ){
													$row->custLabel = '';
												}
												if( $row->custLabel ){
													echo $row->custLabel;
												}else{
													echo 'Code Customization';
												}
											?>

										</span>
									</a>
									<textarea id="<?php echo  $row->sid; ?>" class="customize" style="display:none;"><?php echo get_option( $row->sid ); ?></textarea>
								</div>
							</div>
						</div>
							
					<?php	
						}else if( $row->sid != '' && $row->sid != 'undefined' ){
						
							self::loadPosition( $row->sid, $row->cfg );
							array_push( $ignore , $row->sid );
						}else{
					?>
						
						<div class="block-center">
							
							<div class="sidebar-wrpest btn-group">
								<a href="#sidebar|add|<?php echo $i; ?>" class="btn btn-default add-sidebar-btn">
									<i class="fa fa-plus"></i> <span class="selectSidebarBtn">Sidebar</span>
								</a>
								<a href="#group|add|<?php echo $i; ?>" class="btn btn-default add-group-btn">
									<i class="fa fa-plus"></i> <span class="selectSidebarBtn">Group</span>
								</a>
								<a href="#sidebar|code|<?php echo $i; ?>" class="btn btn-default add-code-btn">
									<i class="fa fa-pencil"></i> <span class="selectSidebarBtn">Code</span>
								</a>
							</div>
							
						</div>	
						<?php } ?>	
					

					</div>
				</div>
		
					<?php		
					}
				}
				
				$devn->getCustomizeRaw( $page, false );
				
			}else{
				
				$devn->displayEmptyLayout( $getLN );
				
				$devn->getCustomizeRaw( $getLN, true );
				
			}


			echo '</div>';
		}
		
		/* THIS LIST ALL POSITION */

		echo '<div id="list-inactive-position" style="display:none;">';
		
		echo '<input type="hidden" id="sidebar-id" value="'.($i+1).'" />';
		
		global $wp_registered_sidebars, $devn_sidebars_widgets, $wp_registered_widgets;

		foreach ( $wp_registered_sidebars as $sidebar => $registered_sidebar )
		{
			if( !in_array(  $sidebar , $ignore )/* && strpos($sidebar,'blocks') === false */ )
				self::loadPosition( $sidebar );
		}		
		echo '</div>';
		
		
		
		if( $cpage != null )
			$ctp = explode( '-', $cpage );
		else 
			$ctp = explode( '-', $page );	
			
		if( !empty( $ctp[1] ) && $ctp[0] == 'page' ){
			$getPage = get_page( $ctp[1] );
			
			$rawFunc = "remove"."_"."filter";
			$rawFunc( 'the'.'_'.'content', 'do'.'_'.'shortcode', 11);
			
			$content = apply_filters('the_content', $getPage->post_content, 11);
			echo '<form id="pageContentForm" style="display:none;"><input type="hidden" name="action" value="savePageContent" /><input type="hidden" name="id" id="page-content-id-raw" value="'.$getPage->ID.'" /><input type="hidden" id="page-content-title-raw" name="title" value="'.$getPage->post_title.'" /><textarea name="content" id="page-content-raw" style="display:none">'.$content.'</textarea></form>';
		}

	}	
	
	/*------------------------------------*/
	#	admin mode: Load all widgets in a sidebar 
	/*------------------------------------*/
	public static function zendLayoutLabel( $page ){
	
		global $devn;
		$getLN = $devn->getLayoutName( $page );
		$devn_xml = $devn->getLayout( $page );
		$task = !empty($_POST['task'])?$_POST['task']:null;
		$alias = !empty($_REQUEST['alias'])?$_REQUEST['alias']:'';
		$mpage = @split('-', $page );
		$pageMain =  $mpage[0];
		if( isset($mpage[1]) )
			$pageId = $mpage[1];
		else $pageId = null;	
		
		$permalink = null;
		if( $devn_xml->type != 'page' )
			$permalink = @get_term_link( (int)$devn_xml->id, $devn_xml->type ); 		
		if( !is_string( $permalink ) || $permalink == '' ){
			$permalink = get_permalink( (int)$pageId );
		}	
		if( $devn_xml->type == 'general' && $getLN == $page )
			$permalink = null;
		if( $page == 'index' ){
	
			$permalink = site_url();
			if( get_option('show_on_front') == 'page' ){
				$pid = get_option('page_for_posts');
				if( $pid ){
					$permalink = get_permalink( $pid );
				}
			}
			
		}
			
					
		?>

		
		<div id="grid-inner-panel">
			<span class="page-label">
				<?php 
					if( strtolower($alias) != strtolower($devn_xml->type) )
						echo $devn_xml->type.' <span style="margin-right:-3px;">&mdash;</span>&raquo; ';
					if( !empty($alias) )
						echo $alias;
					else echo 'Global Pages';
					if( is_numeric($devn_xml->id) )echo ' [id: '.$devn_xml->id.']'; 
				
				?>
			</span>

			<?php 
				if( $page == 'general' || $page == 'page' || $page == 'post' || $page == 'category' ){ 
					echo '<span class="page-label-child">This layout will effect to every subpages</span>';
				}if( $getLN != $page ){	
					echo '<span class="page-label-child">This page was inherited from <strong><u>'.$getLN.'</u></strong>';
					echo ' <a title="'.__('Click to load layout', 'devn').'" href="#layout|edit|'.$getLN.'"> Go to '.$getLN.' <i class="fa fa-level-up"></i></a>';
					echo ' <a title="'.__('Click to load layout', 'devn').'" href="#layout|using|'.$getLN.'"> load in Here <i class="fa fa-level-down"></i></a>';
					echo '</span>';
				}	
			?>
			
		<?php if( is_string( $permalink ) && $task != 'group' && !in_array( $page, array( 'general','page','post','category')) ){ ?>
			<input type="hidden" id="link-live-view" value="<?php echo $permalink; ?>?mode=instant-edit" />
		<?php } ?>
			
		<div class="btn-group alignright">
		
		<?php if($task != 'group'){ ?>	

			<?php if( $page != 'general' ){ ?>
				
				<?php if( $getLN == $page && $devn_xml->type != 'general' ){ ?>
					<button id="do-delete-layout" class="btn btn-default" rel="<?php echo $devn_xml->type; if(!empty($devn_xml->id))echo '-'.$devn_xml->id;?>">
						<i class="fa fa-times"></i>
						<a href="#layout|using|delete" title="Delete this layout">
							<?php echo __('Delete', 'devn'); ?>
						</a>
					</button>
				<?php } ?>
				<button id="do-empty-layout" class="btn btn-default">
					<i class="fa fa-file-text-o"></i>
					<a href="#layout|using|empty" title="<?php echo __('Clear all to start with empty', 'devn'); ?>">
						<?php echo __('Start over', 'devn'); ?>
					</a>
				</button>
				<div id="use-global-layout" class="btn btn-default">
					<?php echo __('Copy Layouts', 'devn'); ?>
					<span class="caret"></span>
					<?php devn_available_blocks( $page, 'dropdown-menu' ); ?>
				</div>
				
				<?php } ?>
				
			<?php }else{ ?>
			
				<button id="empty" class="iconwrp" onclick="$('#grid-wrapest .block-wrpest').remove();" title="<?php echo __('Clear all sidebars', 'devn'); ?>" class="iconwrp">
					<i class="fa fa-file-o"></i> 
					<?php echo __('Empty', 'devn'); ?>
				</button>				

				<span id="delete-group-layout" title="<?php echo __('Delete this group', 'devn'); ?>" class="btn btn-default">
					<i class="fa fa-times"></i> 
					<?php echo __('Delete', 'devn'); ?>
				</span>
			<?php } ?>

	
				<span class="loading-eff iconwrp" id="saveLLoading">
					<?php echo __('saving', 'devn'); ?>
				</span>
				<button title="Save layout" id="saveLayout" class="btn btn-success alignleft" style="display: block;">
					<i class="fa fa-check"></i> <?php echo __('Save Layout', 'devn'); ?></b>
				</button>
				
			</div>	
		</div>
		
	<?php
	}
		
	/*------------------------------------*/
	#	admin mode: Load all widgets in a sidebar 
	/*------------------------------------*/
	public static function loadPosition( $name , $cfg = null ){
	
		if( $cfg != null )
			if( !$cfg->className )
				$cfg->className = $name.' sidebardevn';
	
	?>	
		<div id="sidebar-<?php echo $name; ?>" class="widgets-holder-wrap sidebar-inner"  cfg='<?php echo $cfg?json_encode($cfg):'' ?>' >
			<h2 class="sidebar-label">
				<?php 
					$title = ucfirst(str_replace( array("_","-",'s[DS]'), array(" "," "," "), $name)); 
					echo $title;
				?>
			</h2>
			<?php 
				if(strpos($name,'groups[DS]')=== false){
					/**
					*	If this sidebar | not block
					*/
					global $wp_registered_widgets,$devn_widgetCfg;
					
					foreach(  $wp_registered_widgets as $n => $v ){


					}
					
					devn_wp_list_widget_controls_fix($name); 
					
				}else{
			
				/**
				*	else this block | not sidebar
				*/
					
			?>
			
				<div id="<?php echo $name; ?>" title="Click to edit group <?php echo $title; ?>" class="sidebar-type-group sidebar-wrpest btn btn-primary"><a href="#layout|edit|<?php echo $name; ?>"><i class="fa fa-pencil "></i> Edit <?php echo $title; ?></a></div>
				

			<?php } ?>	
		</div>

	<?php	
		
	}
	/*------------------------------------*/
	#	When save in Vitual tool -> Use layout vitual and cleave -> storage in XML
	/*------------------------------------*/
	public static function zendLiveLayoutCache( $layout, $type = 'page', $sid = '' ){
	
		function checkFullWidth( $arrgs ){
			
			$checkStr = json_encode( $arrgs );

			if( is_numeric(strpos( $checkStr, '"fullWidth":"1"' )) )
				return 1;
			else if( is_numeric(strpos( $checkStr, '"fullWidth":"2"' )) )
				return 2;
			return false;
			
		}
		if($type == 'groups')
			$classPx = 'blk'.$sid;
		else $classPx = 'sys';	
		global $devn_responsiveInner,$wpdb,$devn_customActive;
		$devn_responsiveInner = array();;
		$groups = '';
		$closeContainerBegin = false;
		$closeContainerEnd = false;
		$devn_customActive = array();	
		
		$result = array();

		$rows = @json_decode( $layout );
				
		$theFirst = ''; 
		if( checkFullWidth( @$rows[0]) != false )
				$theFirst = 'full';
		$contId = '';
		if( @$rows[0][0] )
			if( $rows[0][0]->column[0] )
				$contId = 'container-'.$rows[0][0]->column[0]->sid;
				
		if( $theFirst == '' && $type != 'groups' ){
			array_push( $result , "\r".'<div class="container-fluid limit-width '.str_replace('[DS]','-',$contId).'">' );
		}	
		
		if( $type == 'groups' ){
			array_push( $result , '<div class="container-fluid limit-width">' );
		}
		
		/*rows*/
		if( count($rows) )
		{
		
			
		
			foreach( $rows as $row ){
				
				$fullwidth = '';
	
				$checkFW = checkFullWidth( $row );
				
				if( $checkFW != false )
				{
					
					$fullwidth = 'rowFullWidth';
					
					if( $checkFW == 1 )
						$fullwidth .= ' limit-width';
						
					if($type == 'groups')
						$theFirst = '';
					/**
					* </div> begin block
					*/	
					if( $theFirst == '' ){
						
						if( $result[ count($result) -1 ] == '<div class="container-fluid limit-width">' ){
							/*we need to clear container split*/
							array_pop( $result );
							
						}else{
							array_push( $result , "\r</div>" );
						}
								
					}else $theFirst = '';	
					
					array_push( $result , "\r".'<div class="container-fluid full-width full-width-'.str_replace('[DS]','-',$row[0]->column[0]->sid).'">' );
					
				}
	
				if(strpos(!empty($row[0]->column[0]->sid)?$row[0]->column[0]->sid:'','groups[DS]')!== false)
				{
					
					array_push( $result , "<?php devn::sidebarGroup('".$row[0]->column[0]->sid."'); ?>" );
					$groups .= $row[0]->column[0]->sid.',';
					
				}else{
			
				array_push( $result ,  "\r".'	<div class="rowlevelone row-fluid row wrpestdevn '.$fullwidth.' row-'.(!empty($row[0]->column[0]->sid)?$row[0]->column[0]->sid:'devn').'">' );
				/*columns*/
				foreach( $row as $col ){
				
					array_push( $result , "\r".'		<div class="spanlevelone col-md-'.($col->width/80).'">' );
					
					/*Rows in column*/
					foreach( $col->column as $rowsincol)
					{
						/*If there are more than 2 levels*/
						if( count($col->column) > 1 )
						{
					
							if( count($rowsincol) == 1 && count( $rowsincol[0]->column ) == 1 )
								$className = 'rowleveltwo-'.$rowsincol[0]->column[0]->cfg->className;
							else $className = '';	
							array_push( $result , "\r".'			<div class="rowleveltwo row-fluid row wrpinnerdevn '.$className.'">' );
							
						/*therea are more than one column in inner row */
							foreach( $rowsincol as $colrowinner )
							{
								
								if( count($rowsincol) > 1 )
								{
									$margin = (2.7624309392265194) - (2.7624309392265194/count($rowsincol));///count($rowsincol))+0.2;
									
									if( count( $colrowinner->column ) == 1 )
										$className = 'spanleveltwo-'.$colrowinner->column[0]->cfg->className;
									else $className = '';
									
									$cid = count($devn_responsiveInner);
									
									array_push( $result , "\r".'			<div class="spanleveltwo span '.$className.' '.$classPx.'devn'.$cid.'" >' );
									
									$devn_responsiveInner[ $cid ] = '.'.$classPx.'devn'.$cid.'{width:'.((($colrowinner->width/$col->width)*100)-$margin).'% !important;';
									if( !empty( $colrowinner->cfg ) ){
										if( !empty( $colrowinner->cfg->customCss ) )
											$devn_responsiveInner[ $cid ] .= devnExt::base64( 'decode',  $colrowinner->cfg->customCss );
									}	
									$devn_responsiveInner[ $cid ] .= '}';
								}
								
									if( count( $colrowinner->column ) == 1 )
									{
										/*we'll call sidebar now*/
										
										ob_start();
										
										self::loadLivePosition( $colrowinner->column[0], $rowsincol, $type, $sid );
										
										array_push( $result , ob_get_contents() );
										ob_end_clean();
										
									}else{
										/*therea are more than one column in inner row */
										foreach( $colrowinner->column as $colrowinnerest )
										{
											if( count( $colrowinner->column ) > 1 )
											{
												array_push( $result , "\r".'				<div class="rowlevelthree row-fluid row wrpinnerestdevn '.$colrowinnerest->cfg->className.'">' );
											}
											
												ob_start();
												
												self::loadLivePosition( $colrowinnerest, $colrowinner, $type, $sid );
												
												array_push( $result , ob_get_contents() );
												ob_end_clean();
												
											if( count( $colrowinner->column ) > 1 ){
												array_push( $result , "\r				</div>" );
											}	
										}
									}
									
								
								if( count($rowsincol) > 1 ){
									array_push( $result , "\r				</div>" );
								}	
							}
							
							array_push( $result , "\r			</div>" );/*end of rowleveltwo*/
						
						}else{
							/*just 2 level*/
							
							ob_start();
							
							self::loadLivePosition( $rowsincol, $col, $type, $sid );
							
							array_push( $result , ob_get_contents() );
							ob_end_clean();
						}
					}
					
					array_push( $result , "\r		</div>" );/*end of spanlevelone*/

				}
				array_push( $result , "\r	</div>" );/*end of rowlevelone*/
			
			} /*else if this is a block sidebar*/
				
				if( $fullwidth != '' ){
					array_push( $result , "\r".'</div>'."\r" );
					array_push( $result , '<div class="container-fluid limit-width">' );
				}		
				
			}
		}
		
		if( $type != 'groups' ){
		
			array_push( $result , "\r".'</div>' );/*end of container*/
			/*Export to string*/
			$result = implode( '', $result );
			
		}else{
		
			/*Export to string*/
			if( $result[ count($result) -1 ] ==  '<div class="container-fluid limit-width">' ){
				array_pop( $result );
			}else{
				array_push( $result , "\r".'</div>' );/*end of container*/
			}
			
			$result = implode( '', $result );
			$groupid = $_POST['groupid'];
			$groupclass = $_POST['groupclass'];
			$result = "</div>"."\n".'<div class="devn-group group-'.$sid.' '.$groupclass.'" id="'.$groupid.'">'.$result."\n</div>\n".
					  '<div class="container-fluid limit-width">';
		
			
		}
		
		
		/*
			We will delete all inactive custom code sidebar
		*/

		return array( $result, implode('', $devn_responsiveInner ), $groups );
		
	}
	/*------------------------------------*/
	#	Load all data of an sidebar in front-end
	/*------------------------------------*/		
	public static function loadLivePosition( $sidebar, $box, $type, $sid ){
		
		if($type == 'groups')
			$classPx = 'blk'.$sid;
		else $classPx = 'sys';
		
		if( is_array($box) )
			$box = $box[0];

		//print_r($box);

		$height = $sidebar->height;
		$class = "widgetdevn {$sidebar->cfg->className}";
		
		$marginLeft = (($sidebar->left-$box->left)/$box->width)*100;
		$width = ($sidebar->width/$box->width)*100;
		
		if( $box->width - $sidebar->width <= 20 ){
			$marginLeft = 0;
			$width = 100;
		};
		
		global $devn_responsiveInner;
		
		$cid = count($devn_responsiveInner);
		$devn_responsiveInner[ $cid ] = '.'.$classPx.'devn'.$cid.'{min-height:'.$height.'px;width:'.$width.'% !important;margin-left:'.$marginLeft.'% !important;';
		if( !empty( $sidebar->cfg ) ){
			if( !empty( $sidebar->cfg->customCss ) )
			{
				$devn_responsiveInner[ $cid ] .= devnExt::base64( 'decode',  $sidebar->cfg->customCss );
			}	
		}
		$devn_responsiveInner[ $cid ] .= '}';
		
		if( strpos( $sidebar->sid , 'devn_customize' ) !== false ){
			
			global $devn_customActive;
			array_push( $devn_customActive , $sidebar->sid );
			/*
				we will know list of active to delete inactive custom code
			*/
			
			/*
				We dont save custom code here to avoid error 500
			*/
			
			if( isset($sidebar->cfg->status) ){
				if( $sidebar->cfg->status == 'unpublish' ){
					return;
				}
			}
			
			echo "\r\r";
		?>
			<div class="widget widget_devn_customize">
				<div class="execphpwidget devn-code-customize <?php echo $sidebar->cfg->className; ?> <?php echo $classPx; ?>devn<?php echo $cid; ?>" id="<?php echo $sidebar->sid; ?>">
						<?php 
							echo '<?php devnExt::phpExe( "?>". do_shortcode( devnExt::base64( "decode", get_option("'.$sidebar->sid.'" ))) ); ?>'."\r"; 
						?>
				</div>
			</div>
		<?php	
		}else{
			
			if( isset($sidebar->cfg->status) ){
				if( $sidebar->cfg->status == 'unpublish' ){
					return;
				}
			}

			echo "\r\r";
			?>
				<div class="<?php echo $class ?> <?php echo $classPx; ?>devn<?php echo $cid; ?>" id="sidebar-<?php echo $sidebar->sid?$sidebar->sid:$sidebar->id; ?>">
				
					<?php 
						echo '<?php dynamic_sidebar( "'.$sidebar->sid.'" ); ?>'."\r"; 
					?>
					
				</div>
			<?php
		
		}	
			
	}
	/*------------------------------------*/
	#	Load block into sidebar
	/*------------------------------------*/
	public static function sidebarGroup( $gid ){
		
		$file = dirname(__FILE__).DS.'layouts'.DS.str_replace('[DS]',DS,$gid).'.xml';
		
		if( file_exists( $file )  ){
			$devn_xml = @simplexml_load_file( $file );
			devnExt::phpExe( '?>'.$devn_xml->html );
			return $devn_xml->css;
		}
		
	}	
	/*------------------------------------*/
	#	Load block into sidebar
	/*------------------------------------*/
	public static function getCustomizeRaw( $id, $showSelf = true ){
		
		global $wpdb;
		
		$file = dirname(__FILE__).DS.'layouts'.DS.str_replace('[DS]',DS,$id).'.xml';
		
		if( !file_exists( $file )  ){
			return null;
		}
		
		$devn_xml = @simplexml_load_file( $file );	

		echo '<div id="list-customize-code" style="display:none">';
		if( $showSelf == true ){
			if( $customizs = get_option('devn_customize_Storage_'.$id) ){
				foreach( $customizs as $customiz ){
					if( get_option( $customiz ) ){
				 		echo '<textarea id="'.$customiz.'">'.get_option( $customiz ).'</textarea>';
				 	}
				}
			}	
		}
		if( !empty( $devn_xml->groups ) ){
			$groups =  explode( ',', $devn_xml->groups  );	
			
			foreach( $groups as $group ){
				 if( !empty( $group ) ){
					 $group = str_replace('groups[DS]','_grp_', $group );
					 if( $grps = get_option('devn_customize_Storage_'.$group) ){
						 foreach( $grps as $grp ){
						 	if( get_option( $grp ) ){
						 		echo '<textarea id="'.$grp.'">'.get_option( $grp ).'</textarea>';
						 	}
						 }
					 }
				 }
			}
		}	
		echo '</div>';
		
	}
	/*------------------------------------*/
	#	Load block into sidebar
	/*------------------------------------*/
	public static function getCssGroup( $gid ){
		
		$file = dirname(__FILE__).DS.'layouts'.DS.str_replace('[DS]',DS,$gid).'.xml';
		
		if( file_exists( $file )  ){
			$devn_xml = @simplexml_load_file( $file );
			return $devn_xml->css;
		}
		return '';
		
	}
	/*------------------------------------*/
	#	Load all widgets for inspect mode
	/*------------------------------------*/	
	public function sidebarsInnerPage( $page = 'general' ){
		
		devn::zendLayout( $page );
		exit;
		
		$layout = self::getLayout( $page );
		if( !empty( $layout ) ){
			
			$rows = json_decode( $layout );
			foreach( $rows as $row ){
				foreach( $row as $col ){
					if( $col->p ){
						wp_list_widget_controls( $col->p );
					}
				}
			}	
		}
		
	}	
	/*------------------------------------*/
	#	Show empty message in empty layout
	/*------------------------------------*/
	public function displayEmptyLayout( $name ){	
	?>
		
		<div id="emptyLayout"></div>
		
	<?php
	}			
	/*------------------------------------*/
	#	Start framework -> get current file
	/*------------------------------------*/
	static function tmpl( $file = 'general' ){
		
		/*template contents*/

		global $devn_curFile,$devn_curFile2,$post,$devn_settings,$devn_xml,$devn;
		if( $file == 'single' ){

			if( $post->post_type != 'post' && file_exists( dirname(__FILE__).DS.'layouts'.DS.$post->post_type.'.xml' )  ){
				$file = $post->post_type;
			}
			
		}
		
		$devn_curFile2 = $file;
		
		if( !empty( $_REQUEST['layout'] ) ){
			if( file_exists( dirname(__FILE__).DS.'layouts'.DS.$_REQUEST['layout'].'.xml' )  ){
				
				$file = $_REQUEST['layout'];
			}
		}
		
		$devn_curFile = $file;

		$alias = self::getLayoutAtReal();
		
		$devn_xml = self::getLayout( $alias );
		
		$devn->tp_mode( $file );
		
		get_header(); 
	
		devnExt::phpExe('?>'.$devn_xml->html);

		get_footer();
		
	}
	/*------------------------------------*/
	#	Display content component
	/*------------------------------------*/	
	public static function contentsExecute(){
	
		/*Execute contents component*/
		
		global $devn_curFile,$devn_curFile2;
		$dir = dirname(__FILE__).DS.'contents'.DS.$devn_curFile2.'.php';

		if( file_exists( $dir ) ){
			require_once( $dir );
		}	
	}	
	/*------------------------------------*/
	#	Display comment component
	/*------------------------------------*/
	public static function commentsExecute(){
	
		/*Execute contents component*/
		
		global $devn_curFile;

		if( $devn_curFile != 'single' && $devn_curFile != 'page' )
			return;
		
		$dir = dirname(__FILE__).DS.'contents'.DS.'comments.php';

		if( file_exists( $dir ) ){
			require_once( $dir );
		}	
	}
	/*------------------------------------*/
	#	Setup header
	/*------------------------------------*/
	public static function header(){
		
		global $devn_xml,$devn;
		
		if( empty( $devn_xml ) ){
			return;
		}
		
		ob_start();
		
		$exe = devnExt::phpExe('?>'.devnExt::base64( 'decode',  $devn_xml->customHeader ));
		if( $exe === false )
			echo "<ERROR>Error php code at Layout's custom header</ERROR>";
		$text = ob_get_contents();

		ob_end_clean();
		
		echo $text;
		
		$groupCss = '';
		if( !empty( $devn_xml->groups ) ){
			$groups = explode(',',$devn_xml->groups);
			foreach( $groups as $group ){
				$groupCss .= $devn->getCssGroup( $group );
			}
		}
		echo '<style type="text/css">'.$devn_xml->css.$groupCss.'</style>';
	}
	/*------------------------------------*/
	#	Setup footer
	/*------------------------------------*/
	public static function footer(){
		
		global $devn_xml,$devn,$devn_settings;
		
		if( empty( $devn_xml ) ){
			return;
		}
		
		ob_start();
		
		$exe = devnExt::phpExe('?>'.devnExt::base64( 'decode',  $devn_xml->customFooter ));
		if( $exe === false )
			echo "<font color='red'>PHP Parse Error:</font> error on your code at Layout's custom footer";
		$text = ob_get_contents();

		ob_end_clean();
		
		echo str_replace(array('&#59;','&#39;','&#34;'), array(';', "'", '"'), $devn_settings['footer']);

		echo $text;
		
	}
	/*------------------------------------*/
	#	Setup ajax
	/*------------------------------------*/
	public static function tp_mode( $file ){
		
		global $devn_xml,$devn,$devn_settings;
		
		if( !empty( $_REQUEST['mode'] ) && current_user_can('edit_theme_options') ){
		
			switch( $_REQUEST['mode'] ){
				
				case 'liveContent' : 
				
					$dir = dirname(__FILE__).DS.'contents'.DS.$file.'.php';
	
					if( file_exists( $dir ) ){
						echo '<aside class="widget widget-content-component bounceIn animated">';
						require_once( $dir );
						echo '</aside>';
						echo '<!---expl--->';
						echo '<aside class="widget widget-comment-component bounceIn animated">';
						require_once( dirname(__FILE__).DS.'contents'.DS.'comments.php');
						echo '</aside>';
					}	
					else echo 'null';
							
					exit;
					
				break;
				

				
			}
		}	
		
		
	}	
	
	
	
}

global $devn_settings, $devn_curFile,$devn;
$devn = new devn();	

#call external hubs
$devn->incl('define');
$devn->incl('functions');
$devn->incl('ajax');
$devn->incl('main');
$devn->incl('options');
$devn->incl('widgets');

devn::incl('shortcodes'.DS.'shortcodes');


if(is_admin()){

	add_editor_style();
	
	if(isset($_REQUEST['devn']))
	{
		
		switch( $_REQUEST['devn'] ){
			case 'export':
			
				$devn->incl('export');
			
			break;
			case 'import':
			
				$devn->incl('import'); 	
				
			break;
		}	
	}
	
	if( !empty($_POST['importSampleData']) ){
		$devn->incl('sample/devnImporter');
	}
		
	
}else{

	/*add_action( 'init', 'devnTask', 1);*/

	function devnTask() {

		if( !empty($_REQUEST['devnTask']) ){
			switch( $_REQUEST['devnTask'] )
			{
				case 'widget2html' : 
					$callbackFnc = $_REQUEST['callbackFnc'];
					if( empty($callbackFnc) )
						die(3021);
					
					$a = new $callbackFnc();
					$a->widget( array() ,null);

				exit;		
					
				break;
			}
		}
	}	
	
}
