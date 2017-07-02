
function re_init($){
	
	var rem, sidebars = $('div.widgets-sortables'), isRTL = !! ( 'undefined' != typeof isRtl && isRtl ),
		margin = ( isRtl ? 'marginRight' : 'marginLeft' ), the_id;

	$('#widgets-right').children('.widgets-holder-wrap').children('.sidebar-name').each(function(){
		var c = $(this).siblings('.widgets-sortables'), p = $(this).parent();
		$(this).children('.sidebar-name-arrow').remove();
		p.removeClass('closed');
		c.sortable('enable').sortable('refresh');
		$(this).off('click');
	});

	$(document.body).unbind('click.widgets-toggle');
	$(document.body).bind('click.widgets-toggle', function(e){

		var target = $(e.target), css = {}, widget, inside, wtitle, w, sett = $('#widget-settings-display');

		if ( target.parents('.widget-top').length && ! target.parents('#available-widgets').length ) {
		
			widget = target.closest('div.widget');
			inside = widget.children('.widget-inside');
			wtitle = widget.find('.widget-title h4');

			if ( inside.get(0).querySelector('form') ) {
				
				var form = inside.get(0).querySelector('form');
				ID('widget-settings-display').currentWidget = form.parentNode;
				
				sett.fadeIn();
				
				sett.append( form );
				this.style.overflow = 'hidden';
				
				var idBase = Q('.id_base',form).value;
				if( idBase == 'shortcodes-devn' ){
					$('#widget-settings-display .su-generator-button').click();
				}
				
				
				/*Add popup styling when click to edit widget*/
				if( !$(form).hasClass('popup') ){
				
					$(form).addClass('popup');
					var wgbody = $(form).find('.widget-content');
					var wgact = $(form).find('.widget-control-actions');
					var wgsave = $(form).find('.widget-control-save');
					var wgremove = $(form).find('.widget-control-remove');
					
					wgbody.before( wgact );
					wgbody.addClass('popup-body scroll');
					wgact.addClass('popup-head');
					wgact.find('br').remove();
					wgact.append('<h3 class="poptit">'+wtitle.html()+'</h3>');
					//wgsave.attr({'class': 'btn btn_green widget-control-save alignright',title:'Save widget settings'});
					
					$(form).find('.widget-control-close').addClass('close');
					
					wgsave.before($(form).find('.widget-control-close'));
					
					wgsave.after('<a href="#save" class="btn btn_green alignright"><i class="fa fa-check" title="Edit this block"></i></a>');
					wgsave.next().append(wgsave);
					
					wgremove.addClass('btn btn_red alignleft').html('<i class="fa fa-times"></i> Delete').parent().after(wgremove).remove();
					
					if( form.querySelector('.phpxcode') )
					{
						$(form).css({width : '950px', marginLeft: '-475px', marginTop: '-320px;'});
						$(form).find('.popup-body').css({height: '580px','maxHeight':'580px'});
					}else{
						$(form).css({width : '450px', marginLeft: '-225px'}).addClass('popsmall');
						if( wgbody.height() < 450 )
							$(form).css({marginTop: '-'+((wgbody.height()/2)+45)+'px'})
					}
					
				
				}
				
				if( idBase == 'contents' )
				{
					var cfsw = target.closest('.sidebar-inner').attr('cfg');
					var cfg = JSON.parse( cfsw?cfsw:'{}' );
					if( cfg.showBlog == 1 ){
						grid.fn.cfg.advanced( $('#widget-settings-display .contentOptions .blog').get(0) );
						$('.blogLinkSett').show();
					}else{
						
					}

				};
				
				$(form).css({opacity:1});
				
				if( form.querySelector('.phpxcode') && !form.querySelector('.CodeMirror') )
				{
					CodeMirrorInitPhp( form.querySelector('.phpxcode') );
				}
				
				
			} else {
				
			};
			
			e.preventDefault();
	
		} else if ( target.hasClass('widget-control-save') ) {
			
			var iframe = ID('design-iframe_ifr').contentWindow;
			var innerDoc = iframe.document;
			var widget = ID('widget-settings-display').currentWidget;
			widget.appendChild( ID('widget-settings-display').querySelector('form') );	
			
			var wgid = Q('.widget-id',widget).value;
			
			var wgid = innerDoc.getElementById(wgid);
			if( wgid ) wgid = wgid.parentNode.id;
			else wgid = '';
			
			/*wpWidgets.save( target.closest('div.widget'), 0, 1, 0 );*/
			saveWidgetCallBack( target.closest('div.widget'), 0, 1, 0, function(w,r){
			
				if( ID('control-visual-li').style.display != 'none' )
					ID('design-iframe_ifr').src = ID('design-iframe_ifr').src;
				
			} );
			
			
			if( Q('.id_base',widget).value == 'contents' )
				var wgcontent = true;
			else wgcontent = false;
			
			if( wgcontent ){
				grid.fn.cfg.content( widget, $(widget).closest('.sidebar-inner').get(0) );
			}	
			
			ID('widget-settings-display').currentWidget = widget.querySelector('form').parentNode;
			sett.append( widget.querySelector('form')  );
			/*sett.css({display:'none'});*/
			
			e.preventDefault();
			
			if( wgcontent ){
				$('#control-grid-li a').click();
				grid.fn.layout.save();
			}	
			
			$('#widget-settings-display .widget-control-close').click();
			
			
		} else if ( target.hasClass('widget-control-remove') ) {
		
			var widget = ID('widget-settings-display').currentWidget;
			
			widget.appendChild( ID('widget-settings-display').querySelector('form') );	
			
			sett.fadeOut();
			
			wpWidgets.save( $(widget).closest('div.widget'), 1, 0, 0 );
			
			var id = $(widget).find('.widget-id').val();
			
			grid.fn.openWGdelete( id );
			
			e.preventDefault();
			
			$('body').css({ 'overflow' : '' });
			
		} else if ( target.hasClass('widget-control-close') ) {
		
			var widget = ID('widget-settings-display').currentWidget;
			widget.appendChild( ID('widget-settings-display').querySelector('form') );	
			wpWidgets.close( $(widget).closest('div.widget') );
			
			sett.fadeOut();
			
			if( grid.changed == true && ID('live-design-frame').style.display != 'none' )
				$('#control-visual-li > a.mnhrefli').click();
			
			this.style.overflow = '';
			e.preventDefault();
			
		};

	});
	
	
	$('#widget-list').children('.widget').draggable({
		
		connectToSortable: 'div.widgets-sortables',
		handle: '> .widget-top > .widget-title',
		//distance: 2,
		helper: 'clone',
		//scroll:true,
		//iframeFix: true,
		zIndex: 999999,
		appendTo: 'body',
		scroll: true,
		containment: 'document',
		start: function(e,ui) {
			ui.helper.find('div.widget-description').hide();
			the_id = this.id;
		},
		drag: function(event,ui){
			ui.position.top -= $('html').scrollTop();
		},
		stop: function(e,ui) {
			if ( rem )
				$(rem).hide();
		
			rem = '';
			
			grid.changed = true;
			
		}
	});
	

	
	sidebars.sortable({
	
		placeholder: 'widget-placeholder',
		items: '> .widget',
		handle: '> .widget-top > .widget-title',
		cursor: 'move',
		distance: 10,
		//delay: 500,
		containment: 'document',
		appendTo: 'body',
		//containment: 'window',
		scroll: true,
		/*helper: 'clone',
		scrollSensitivity: true,*/
		start: function(e,ui) {
		
			ui.item.children('.widget-inside').hide();
			
			ui.item.css({margin:'', 'width':'230px'});

			/*ui.placeholder.height(ui.helper.outerHeight()-2);
			ui.placeholder.width(ui.helper.outerWidth()-2);*/
			
			$('#grid-wrapest').addClass('widgetSorting');
			
		},
		stop: function(e,ui) {

			onStopWGSort(ui,the_id,this);
			the_id = '';
			
		},
		receive: function(e, ui) {

			var sender = $(ui.sender);

			if ( !$(this).is(':visible') || this.id.indexOf('orphaned_widgets') != -1 )
				sender.sortable('cancel');

			if ( sender.attr('id').indexOf('orphaned_widgets') != -1 && !sender.children('.widget').length ) {
				sender.parents('.orphan-sidebar').slideUp(400, function(){ $(this).remove(); });
			}
			
			$('#grid-wrapest').removeClass('widgetSorting');
			
		}
	}).sortable('option', 'connectWith', 'div.widgets-sortables').parent().filter('.closed').children('.widgets-sortables').sortable('enable').sortable('refresh');
	
	/*Re set draggable & resizable for blocks*/
	$( "#grid-wrapest .block-wrpest" ).draggable({
		grid: [80,10],
		start: function(){this.style.zIndex = grid.index++;grid.changed = true;},
		containment: "parent",
		stop: grid.scanOverlap,
		cancel: '.editBlock',
		scroll: true
	}).resizable({
		grid: [80,10],
		handles: 'n, e, s, w',
		stop: grid.scanOverlap,
		containment: "parent",
		minHeight: 30,
		minWidth: 60
	}).on('resize', function(){
		this.querySelector('.height-of-block').innerHTML = this.offsetWidth+' x '+this.offsetHeight;
		grid.changed = true;
		
		if( this.offsetWidth == 940 ){
			$(this).addClass('max-width');
		}else{
			$(this).removeClass('max-width');
		}
	});
	
	
	$('#available-widgets').droppable({
		tolerance: 'pointer',
		accept: function(o){
			return $(o).parent().attr('id') != 'widget-list';
		},
		drop: function(e,ui) {
			ui.draggable.addClass('deleting');
			$('#removing-widget').hide().children('span').html('');
		},
		over: function(e,ui) {
			ui.draggable.addClass('deleting');
			$('div.widget-placeholder').hide();
			$('#removing-widget').show().children('span')
				.html( ui.draggable.find('div.widget-title').children('h4').html() );
		},
		out: function(e,ui) {
			ui.draggable.removeClass('deleting');
			$('div.widget-placeholder').show();
			$('#removing-widget').hide().children('span').html('');
		}
	});
	
	$('#listPages ul li').click(function(){
		var edit = $(this).find('a.edit');
		if(edit.get(0))
			window.location = edit.attr('href');
	});

	if( ID('link-live-view') ){
		$('#control-visual-li').css({display:'inline-block'});
		var link = ID('link-live-view').value;
		ID('design-iframe_ifr').src = link
		$('#iframe-visual-loading').css({display: 'block'});
		
		link = link.split('mode=')[0]+'mode=liveContent';
		jQuery.post(link, function (result) {
			if(result != 'null'){
				result = result.split('<!---expl--->');
				$('#widget-list .html2cache.contents').html( Base64.encode( result[0] ) );
				if(result[1])$('#widget-list .html2cache.comments').html( Base64.encode( result[1] ) );
			}else{
				$('#widget-list .html2cache.contents,#widget-list .html2cache.comments').html( '' );
			}
		})
		
	}else{
		$('#control-visual-li').css({display:'none'});
		$('#widget-list .html2cache.contents,#widget-list .html2cache.comments').html( '' );
	}
	
	
	wpWidgets_appendTitle();
	
};


function CodeMirrorInitPhp( textarea ){
	
	CodeMirror.modeURL = "codemirror/mode/%N/%N.js";
	var editor = CodeMirror.fromTextArea( textarea , {
		lineNumbers: true,
		autofocus: true,
		autoCloseTags: true,
		mode: 'application/x-httpd-php',
		indentUnit: 4,
		indentWithTabs: true,
		theme: 'eclipse',
		electricChars: true,
		lineWrapping: true,
		extraKeys: {"Ctrl-Space": "previewphpcode","Ctrl-S" : function(){
			FBL.Firebug.chrome.document.getElementById('widget-inspect-save').onclick();
			return false;
		}}
	});
	
	autoFormatCodeMirrors( editor );
	
	editor.textarea = textarea;
	var delay,range,changed=false;
	
	editor.on("change", function() {
	
		clearTimeout(delay);
		
		delay = setTimeout(function(){

			//editor.textarea.value = editor.getValue().replace(/&lt;/g,'<').replace(/&gt;/g,'>');
			var form = $(editor.textarea).closest('form').get(0);
			form.style.marginTop = (-((form.offsetHeight/2)<(document.body.offsetHeight/2)?(form.offsetHeight/2):(document.body.offsetHeight/2)-30))+'px';
		}, 500);
		
		changed = true;
		
	});
	
	editor.on("blur", function() {
		editor.textarea.value = editor.getValue().replace(/&lt;/g,'<').replace(/&gt;/g,'>');
	});
	
	
	editor.on("cursorActivity", function() {
		//editor.matchHighlight("CodeMirror-matchhighlight");
	});
	
	var hlLine = editor.addLineClass(0, "background", "activeline");
	editor.on("cursorActivity", function() {
		var cur = editor.getLineHandle(editor.getCursor().line);
		if (cur != hlLine) {
			editor.removeLineClass(hlLine, "background", "activeline");
			hlLine = editor.addLineClass(cur, "background", "activeline");
		}
	});
	

	var form = $(editor.textarea).closest('form').get(0);
	form.style.marginTop = (-((form.offsetHeight/2)<(document.body.offsetHeight/2)?(form.offsetHeight/2):(document.body.offsetHeight/2)-30))+'px';

}
/**
*	
*/
function re_init_frame(frm){

	sizeRefresh();
	
	var inFrame = frm.contentWindow;
	var ij = inFrame.jQuery;
	
	if( !ij )
		return;
			
	var wrp = inFrame.document.createElement('div');
	var the_id = '';
	wrp.className = 'wrap';
	wrp.id = 'live-design-widgets';
	$(wrp).css({width: '240px',position:'fixed',top:'0px',left:'0px',zIndex:'99999','display':'none'});

	ij('head').append('<script type="text/javascript" src="'+theme+'/../../../wp-admin/load-scripts.php?c=1&load%5B%5D=jquery-ui-core,jquery-ui-widget,jquery-ui-mouse,jquery&load%5B%5D=-ui-sortable,jquery-ui-draggable,jquery-ui-droppable,jquery-ui-tabs,jquery-ui-accordion,jquery-ui-resizable"></script>');

	wrp.innerHTML = '<div class="widget-liquid-left" style="position: static;">'+
				'<div id="widgets-left">'+
				'<div id="available-widgets" class="widgets-holder-wrap" style="height:'+frm.style.height+'"><div class="widget-holder" id="widget-holder" style="padding-top: 20px;">' + 
				$('#widget-holder').html()+'</div></div></div>'+
				'<link rel="stylesheet" href="'+theme+'/cgi/assets/css/grid.css" type="text/css" media="all"><link rel="stylesheet" href="'+theme+'/cgi/assets/css/animate.css" type="text/css" media="all">'+
				'<link rel="stylesheet" href="'+theme+'/cgi/assets/css/bootstrap-icons.css" type="text/css" media="all"><link rel="stylesheet" href="'+theme+'/cgi/assets/css/animate.css" type="text/css" media="all">'+
				'<style type="text/css">.ui-state-highlight{min-height: 45px;}html{margin-top: 0px !important;}</style>';
	inFrame.document.getElementsByTagName('body')[0].appendChild(wrp);	
	$( inFrame.document.getElementById('wpadminbar') ).remove();
	
	$('#iframe-visual-loading').css({display: 'none'});
	
	/**
	*	start sortable widgets on iframe
	*/

	ij( ".widgetdevn" ).sortable({
		  placeholder: "ui-state-highlight widget-holder widget",
		  handle: "a.liveWidgetMove",
		  connectWith: ".widgetdevn",
		 // revert: '300',
		  //handle: "",
		  //helper: 'clone',
		  start: function(e, ui){
			
			
			if( ui.item.find('.widget-top').get(0) ){
				ui.placeholder.height(ui.item.height()<150?ui.item.height():150);
			}else{
				ui.placeholder.height(ui.item.height());
			}
			top.curLiveSidebar = ui.item.get(0).parentNode;
			ij('body').addClass('widgetSorting');
		  },
		  stop: function(e,ui){
			
			if ( ui.item.hasClass('ui-draggable') && ui.item.data('draggable') )
				ui.item.draggable('destroy');
			
			ij('body').removeClass('widgetSorting');
			
			if( !ui.item.hasClass('animated') )
				ui.item.addClass('animated bounceIn');
			
			var add = ui.item.find('input.add_new').val(),ccl = null;
			if(the_id)var n = $('div#' + the_id).find('input.multi_number').get(0);
			if(n)n=n.value;
			
			if ( add ) {
				
				
				if( the_id.indexOf('_contents-__i__') > -1 )
				{
					found = 0;
					$('#grid-wrapest .block-wrpest input.id_base').each(function(){
						if( this.value == 'contents' )
							found++;
					});
					if( found > 0 )
					{
						ui.item.remove();
						alert('You can not add more than one component content');
						return;
					}	
					
				}				
				
				if( the_id.indexOf('_comments-__i__') > -1 )
				{
					found = 0;
					$('#grid-wrapest .block-wrpest input.id_base').each(function(){
						if( this.value == 'comments' )
							found++;
					});
					if( found > 0 )
					{
						ui.item.remove();
						alert('You can not add more than one component comment');
						return;
					}	
					
				}
				
				wpWidgets.save( ui.item, 0, 0, 1 );	
				//widget_save_plus( ui.item, 0, 0, 1, jQuery, 1 );	
				
				var cacheContent = Base64.decode( ui.item.find('.html2cache').eq(0).val() );
				var ccl = cacheContent.length;
				
				cacheContent = $(cacheContent);	
				
				if(n){
					ui.item.html( ui.item.html().replace(/<[^<>]+>/g, function(m){ return m.replace(/__i__|%i%/g, n); }) );
					cacheContent.attr({id:ui.item.find('.widget-id').val()})
				}
				ui.item.after( cacheContent );
				
				if(n){
					ui.item.attr( 'id', the_id.replace('__i__', n) );
					n++;
					$('div#' + the_id).find('input.multi_number').val(n);
				}
				the_id = '';
				
				/*Move widget icon to grids*/
				$('#'+ui.item.get(0).parentNode.id+' .widgets-sortables').append(ui.item);
				if( ccl < 200 )
					ccl = 'openWGSetting';
					
				re_init_frame( ID('design-iframe_ifr') );
								
			}
			
			if( top.curLiveSidebar != ui.item.get(0).parentNode ){
				if(ui.item.get(0).id)
					moveWidget(ui.item.get(0).id,ui.item.get(0).parentNode.id);
				widgetsSortSync( ui.item.get(0).parentNode );
			}
			
			widgetsSortSync(top.curLiveSidebar);
			wpWidgets.saveOrder(ui.item.get(0).parentNode.id);

			if( ccl == 'openWGSetting' )
				grid.fn.openWGsettings( cacheContent.attr('id') );

		  }
	});

	var instEl = ij( ".widgetdevn > aside.widget_execphp .execphpwidget,div.entry-content,.execphpwidget.devn-code-customize " );
	
	instEl.each(function(){
		
		if( ij(this).hasClass('execphpwidget') || ij(this).hasClass('widget-title') || ij('.widget-content-component article').length < 2 )
			ij(this).addClass('hoverBlink');
		
	})
	
	
	instEl.dblclick(function(e){

		if( ij(this).hasClass('eblink') || ij(this).closest('.widget-content-component').find('article').length > 1 ){
			return false;
			/*There are more than one article*/
		}
		
		if( ij('.curentLiveEdittingMode').get(0) )
		{
			alert("ERROR! \nAnother area is editing.");
			var ids = ij('.curentLiveEdittingMode').attr('id');
			inFrame.location = inFrame.location.href.split('#')[0]+'#'+ids;
			return;
		}
		
		moveFromRaw2Live( this );
		
		switchEditable( this );
		
	});
	
	instEl.blur(function(e){
		var elmBlur = this;
		setTimeout(function(){
			
			onBlurVisualEdit( elmBlur );
			
		},500);	
	});

	  
	ij('#widget-list .widget').draggable({
		connectToSortable: 'div.widgetdevn',
		handle: '> .widget-top > .widget-title',
		placeholder: "ui-state-highlight",
		distance: 2,
		helper: 'clone',
		zIndex: 999999,
		appendTo: 'body',
		containment: 'document',
		scroll: true,
		start: function(e,ui) {
			the_id = this.id;
		},
		drag: function(event,ui){
			ui.position.top -= ij('html').scrollTop();
		},	
		receive: function(e, ui) {


			
			
		},
		stop: function(e,ui) {
	
		}
	});

	
	
	ij( ".widgetdevn .widget" ).each(function(){
		if( !ij(this).find('.liveWGFuncs').get(0) )
			$(this).append('<div class="liveWGFuncs"><a title="Drag to sort widgets" href="javascript:void(0);" class="liveWidgetMove ui-icon ui-icon-arrow-4-diag"></a><a title="Click to show settings" href="javascript:void(0);" onclick="top.grid.fn.openWGsettings(\''+this.id+'\')" class="liveWidgetEdit ui-icon ui-icon-wrench"></a><a title="Click to remove this widget" href="javascript:void(0);" onclick="top.grid.fn.openWGdelete(\''+this.id+'\')" class="liveWidgetDelete ui-icon ui-icon-close"></a></div>');
	});
	
	
	/*Add <br> when press enter while edit content*/
		
	ij( inFrame.document ).unbind('keypress').keypress( function ( e ) {
		
	    if ( e.keyCode === 13 /*&& ID('whenPressEnter').options[ID('whenPressEnter').selectedIndex].value == 'line' */) {
	    	
	    	return true;
			var inFrame = ID('design-iframe_ifr').contentWindow;
	        
	        e.preventDefault();

			if (inFrame.window.getSelection) {   
			
			   var selection = inFrame.window.getSelection(),              
			        range = selection.getRangeAt(0),              
			        br = document.createElement("br");        
			    range.deleteContents();          
			    range.insertNode(br);
			    range.setStartAfter(br);
			    range.setEndAfter(br);
			    range.collapse(false);
			    selection.removeAllRanges();
			    selection.addRange(range);
			    
			    return false;
			    
		    }
	    }
		
	});
	
	ij( inFrame.document ).unbind('keyup').keyup( function ( e ) {

		if( e.keyCode === 8 ){
			var inFrame = ID('design-iframe_ifr').contentWindow;
			var selected = inFrame.window.getSelection();
			if( selected == '' ){
				$('#ricktextBtns').hide();
				$('#liveModeInnerBtns').show();
			}
		}else if( e.keyCode === 13 ){	
			var ij = getIJ();
			ij('.elmSelected').removeClass('elmSelected').last().addClass('elmSelected');;
		}
		
	}).unbind('click').bind('click', function(e){
		top.$('.dropdown-menu').css({display:''});
		top.ID('responsive-options').style.top = '1px';
		/* Stop all link while live edit mode enable */
		if(e.target.nodeName == 'A' || ij(e.target).closest('a').get(0) ){
			return false;
		}	
		top.document.pageY = e.pageY;	
	});
	
}

function onStopWGSort(ui,the_id,sidebar){

	$('#grid-wrapest').removeClass('widgetSorting');
	
	grid.changed = true;
	
	if ( ui.item.hasClass('ui-draggable') && ui.item.data('draggable') )
		ui.item.draggable('destroy');

	if ( ui.item.hasClass('deleting') ) {
		wpWidgets.save( ui.item, 1, 0, 1 ); // delete widget
		ui.item.remove();
		$('body').css({ 'overflow' : '' });
		return;
	}

	var add = ui.item.find('input.add_new').val(),
		n = ui.item.find('input.multi_number').val(),
		id = the_id,
		sb = $(sidebar).attr('id');

	//if( !id )return;
		
	ui.item.css({margin:'', 'width':''});
	the_id = '';
	
	if ( add ) {

		if( id.indexOf('_contents-__i__') > -1 )
		{
			var allW = ID('grid-wrapest').querySelectorAll('.id_base');
			var found = 0;
			for( var i=0; i<allW.length; i++ )
				if( allW[i].value == 'contents' )
				{
					found++;
				};	
			if( found > 1 )
			{
				ui.item.remove();
				
				alert('You can not add more than one component content');
				
				return;
			}	
			
		}				
		
		if( id.indexOf('_comments-__i__') > -1 )
		{
			var allW = ID('grid-wrapest').querySelectorAll('.id_base');
			var found = 0;
			for( var i=0; i<allW.length; i++ )
				if( allW[i].value == 'comments' )
				{
					found++;
				};	
			if( found > 1 )
			{
				ui.item.remove();
				
				alert('You can not add more than one comment content');
				
				return;
			}	
			
		}
	
		if ( 'multi' == add ) {
			ui.item.html( ui.item.html().replace(/<[^<>]+>/g, function(m){ return m.replace(/__i__|%i%/g, n); }) );

			ui.item.attr( 'id', id.replace('__i__', n) );
			n++;
			$('div#' + id).find('input.multi_number').val(n);
		} else if ( 'single' == add ) {
			ui.item.attr( 'id', 'new-' + id );
			rem = 'div#' + id;
		}
		wpWidgets.save( ui.item, 0, 0, 1 );
		ui.item.find('input.add_new').val('');
		ui.item.find('a.widget-action').click();
		return;
	}
	
	wpWidgets.saveOrder(sb);
	
}

function moveWidget( widgetId, sidebarId ){
	/**
	*	@ move widget in grids mode after sortable from Visual mode
	*/	
	var widget = null;
	$('#widgets-right .widget input.widget-id').each(function(){
		if( this.value == widgetId )
			widget = $(this).closest('.widget').get(0);
	});
	
	if( widget == null )
		return false;
	
	$('#'+sidebarId+' .widgets-sortables').append( widget );
	
	
}

function widgetsSortSync( sidebar ){ 
	/**
	*	@ Sync widgets from Visual mode to grids mode and save
	*/
	var inFrame = ID('design-iframe_ifr').contentWindow;
	var ij = inFrame.jQuery;
	var i = 0;
	var grdSidebar = $('#'+sidebar.id+' .widgets-sortables');
	ij('#'+sidebar.id+' aside.widget').each(function(){
		var sdid = this.id;
		var fsd = null;
		grdSidebar.find('.widget').each(function(){
			if($(this).find('input.widget-id').val() == sdid)
				fsd = this;
		});
		if( fsd != null ){
			if(i==0)
				grdSidebar.prepend(fsd);
			else grdSidebar.find('.widget').eq(i).before(fsd);
			i++;	
		}
	});
	
	wpWidgets.saveOrder(sidebar.id);
	
	
}

function saveChangePageContent(){
	var pageTitle = ID('page-content-title-raw');
	var pageContent = ID('page-content-raw'); 
	var pageId = ID('page-content-id-raw');
	if( !pageContent )
		return false;
	jQuery.post(ajaxurl, 
		jQuery('#pageContentForm').serialize()
	/*{
			'action': 'savePageContent',
			'content': pageContent,
			'title': pageTitle,
			'id': pageId
		}*/, function (result) {
			reloadIF();
		});	
			
}

function onBlurVisualEdit(elmBlur){
	
	/* HOLD CODE, JUST FOR DEVELOPMENT */
	
}

/*enable editable mode*/

function switchEditable( elm ){
	
	var inFrame = ID('design-iframe_ifr').contentWindow;
	var ij = inFrame.jQuery;

	if( ij('.curentLiveEdittingMode').get(0) )
	{
		alert("ERROR! \nAnother area is editing.");
		var ids = ij('.curentLiveEdittingMode').attr('id');
		inFrame.location = inFrame.location.href.split('#')[0]+'#'+ids;
		return;
	}
	
	ij(elm).parent().removeClass('animated bounceIn');	
	
	ij('body').addClass('builderModeEnable');
	
	if( ij(elm).hasClass('entry-content') ){
		ij(elm).parent().find('h1.entry-title a').attr({'contenteditable':true});
	}
	
	ij( elm ).attr({ 'contenteditable' : true });
	ij( elm ).attr({ 'spellcheck' : false });
	
	//elm.focus();
	if( elm.offsetHeight < 20 )elm.style.minHeight = '20px';
	elm.style.lineHeight = 'auto';
	$(elm).addClass('eblink').closest('.widget').addClass('curentLiveEdittingMode');
	
	ij( ".widgetdevn" ).sortable('disable');

	
	$('#instant-editor-controls').show();
	
	elm.onmouseup = function(e){
		
		ij('.elmSelected').removeClass('elmSelected');
		var etarget = e.target;
		while( etarget.nodeName == 'FONT' && etarget.parentNode ){
			etarget = etarget.parentNode;
		}
		
		if( $(etarget).hasClass('eblink') || !etarget ){
			$('#elmSelectedFuncs').css({display:'none'});
			$('#ricktextBtns').hide();
			$('#liveModeInnerBtns').show();
			return;
		}
		
		ij(etarget).addClass('elmSelected');
		$('#elmSelectedFuncs').css({display:'block'});
		
		var finder = etarget;
		while( !ij( finder ).hasClass('eblink') && !ij( finder ).hasClass('devnContentCol') && finder.parentNode ){
			finder = finder.parentNode;
		}
		
		if( ij( finder ).hasClass('devnContentCol') ){
			$('#boxRowSett').css({display:'block'});
		}else{
			 $('#boxRowSett').css({display:'none'});
		}	 
		
		
		setTimeout(function(){
		
			var inFrame = ID('design-iframe_ifr').contentWindow;
			var selected = inFrame.window.getSelection();
			
			if( selected == '' ){
				
				$('#ricktextBtns').hide();
				$('#liveModeInnerBtns').show();
				
			}else{
			
				var node = inFrame.document.getSelection().anchorNode;
				node = (node.nodeType == 3 ? node.parentNode : node);
				
				ID('selectedTextColor').value = rgb2hex( $(node).css('color') );
				jscolor.color(ID('selectedTextColor'));
				ID('selectedTextBgColor').value = rgb2hex( $(node).css('background-color') );
				jscolor.color(ID('selectedTextBgColor'));
				
				$('#ricktextBtns').show();
				$('#liveModeInnerBtns').hide();
				
				var finder = node;
				while( !ij( finder ).hasClass('eblink') && !ij( finder ).hasClass('devnContentCol') && finder.parentNode ){
					finder = finder.parentNode;
				}
				
				if( ij( finder ).hasClass('devnContentCol') )
					$('#boxRowSett').css({display:'block'});
				else $('#boxRowSett').css({display:'none'});
				
			}
			
			var styl = etarget.style;
			var stylJ = ij(etarget);
			
			var widthP = stylJ.css('width');
			if( widthP.indexOf('px') > -1 ){
				widthP = ( widthP.replace('px','') / stylJ.parent().css('width').replace('px','') ) * 100;
			}else if( widthP.indexOf('%') > -1 ) widthP = widthP.replace('%','');
			
			/*ID('box-sizes-sel').selectedIndex = 0;
			ID('box-sizes2-sel').selectedIndex = 0;*/
			$('#box-sizes-sel,#box-sizes2-sel').change();
			
			if( styl.width == 'auto' )
				ID('box-sizes-checkauto').checked = true;
			else ID('box-sizes-checkauto').checked = false;
			
		}, 150 );	
	}
	
	$('#controls').css({display:'none'});
	
	if( $('#design-iframe_ifr').css('margin-left') == '0px' ){
		$('#live-design-frame').animate({marginLeft:0});
		$('#design-iframe_ifr').animate({width:'100%'});
	}	
	
	top.iframeContenteditable = elm;
	
	elm.focus();
	
}

/* Live ricktext editor */

function formatDoc(sCmd, sValue, ext) {
	var inFrame = ID('design-iframe_ifr').contentWindow;
	inFrame.document.execCommand(sCmd, false, sValue); 
}

function trimCss( inp ){

	if(inp.value.indexOf('{')>-1||inp.value.indexOf('}')>-1){
		inp.value = inp.value.replace(/}/g,'').replace(/{/g,'');
	}	
		
}

function convertDataShortcode(btn){
	
	var source = $(btn).parent().find('textarea').val();

	var shortcode = source.substring(1, source.indexOf(']'));
	
	var content = source.substring( source.indexOf(']')+1, source.length );
	
	content = content.split("").reverse().join("");
	content = content.substring( content.indexOf('[')+1, source.length ).split("").reverse().join("");
	
	shortcodeId = shortcode.substring(0, shortcode.indexOf(' '));
	$(btn).attr({'data-shortcode':shortcodeId});
	
	
	shortcode = shortcode.substring(shortcode.indexOf(' '), shortcode.length)+" ";

	if( content || shortcode.indexOf( '="', i ) > -1 ){

		if(content)var data = { content: content };
		else var data = {};
		
		var i=0,j=0,name='';
	
		while( shortcode.indexOf( '="', i ) > -1 ){
			name = shortcode.substr( j+1 , shortcode.indexOf( '="', j ) - j - 1 );
			i = shortcode.indexOf( '="', i )+2;
			j = shortcode.indexOf( '" ', i );
			eval('data.'+name.trim()+'="'+shortcode.substr(i, j-i).replace('"','&quot;')+'"');
			eval('if( data.'+name+'.indexOf(",") ){data.'+name+'=data.'+name+'.split(",");}');
		}
		
		document.shortcodeReEdit = data;
		
	}
	
	
	

}
function saveWidgetCallBack( widget, del, animate, order, callBack ) {

	var sidebarId = widget.closest('div.widgets-sortables').attr('id'),
		data = widget.find('form').serialize(), a;

	widget = $(widget);
	$('.spinner', widget).show();

	a = {
		action: 'save-widget',
		savewidgets: $('#_wpnonce_widgets').val(),
		sidebar: sidebarId
	};

	if ( del ) {
		a.delete_widget = 1;
	}

	data += '&' + $.param(a);

	$.post( ajaxurl, data, function(r) {
		var id;

		if ( del ) {
			if ( ! $('input.widget_number', widget).val() ) {
				id = $('input.widget-id', widget).val();
				$('#available-widgets').find('input.widget-id').each(function(){
					if ( $(this).val() === id ) {
						$(this).closest('div.widget').show();
					}
				});
			}

			if ( animate ) {
				order = 0;
				widget.slideUp('fast', function(){
					$(this).remove();
					wpWidgets.saveOrder();
				});
			} else {
				widget.remove();
			}
		} else {
			$('.spinner').hide();
			if ( r && r.length > 2 ) {
				$( 'div.widget-content', widget ).html( r );
				wpWidgets.appendTitle( widget );
				$( document ).trigger( 'widget-updated', [ widget ] );
			}
		}
		if ( order ) {
			wpWidgets.saveOrder();
		}
		if ( typeof callBack == 'function' )
			callBack(widget, r); 
	});
}

/* Link Box Size type to slider */

function relateToBSI( sel , s ){
	
	var ij = getIJ();
	var elm = ij('.curentLiveEdittingMode .elmSelected');
	if( !elm )
		return;
	
	if( s == "auto" ){
		
		if( sel.checked == true )
		{
		
			updateValueBoxStyle( 'auto' );
			
		}else{
			$('#box-sizes-inp').change();
		}
				
		return;
		
	}else if( s == 'type' ){
		
		var ops = sel.options
		var prop = ops[sel.selectedIndex].innerHTML.replace(/ /g,'-').toLowerCase(),min=0,max=0;
		if( prop.indexOf('---') > -1 )
		{
			prop2 = ",'"+prop.substring(0, prop.indexOf('-')+1 ) + prop.substring( prop.indexOf('---')+3 ,prop.length )+"' : '"+val+"'";
			prop = prop.substring( 0, prop.indexOf('---') );
		}
	
		var ij = getIJ();
		var stylJ = ij('.curentLiveEdittingMode .elmSelected');
		
		if( !stylJ.get(0) ){
			/*alert('Select a box or block content first.');*/
			$('#boxRowSett').css({display:'none'});
			return;
		}
		
		var val = parseInt( stylJ.css(prop) );
		
		if( prop == 'height' )
		{	
		
			min = 0; max = 300;	
			/*val= stylJ.css('height');
			if( val.indexOf('px') > -1 ){
				val = ( val.replace('px','') / stylJ.parent().css('height').replace('px','') ) * 100;
			}else if( val.indexOf('%') > -1 ) val = val.replace('%','');*/
			
		}else if( prop == 'width' ){
		
			min = 0; max = 100;	
			val= stylJ.css('width');
			if( val.indexOf('px') > -1 ){
				val = ( val.replace('px','') / stylJ.parent().css('width').replace('px','') ) * 100;
			}else if( val.indexOf('%') > -1 ) val = val.replace('%','');
				
		}else if( prop.indexOf('padding') > -1 ){
			min = 0; max = 300;
		}else if( prop.indexOf('margin') > -1 ){
			min = -200; max = 200;
		}else/* if( prop.indexOf('line-height') > -1 )*/{
			min = 0; max = 100;
		}
		
		setUpSplSl(min,max,val);
		
		//$('#box-sizes-inp').simpleSlider('setValue', val );
		
		if( val == 'auto' )
			ID('box-sizes-checkauto').checked = true;
		else
			ID('box-sizes-checkauto').checked = false;
		
	}else if( s == 'clear' ){
		
		var re = new RegExp('<'+'font'+'[^><]*>|<.'+'font'+'[^><]*>','g')
		var res = new RegExp('<'+'span'+'[^><]*>|<.'+'span'+'[^><]*>','g')

		elm.html( elm.html().replace(re, '').replace(res, '') );

		updateValueBoxStyle( '' );
		ID('box-sizes-checkauto').checked = false;
		
		elm.removeAttr('style');
		
	}
	
	
}


function relateToBSI2( sel, s ){
	
	var ij = getIJ();
	var sElm = ij('.curentLiveEdittingMode .elmSelected');
	if( !sElm )
		return;
	if( s == 'type' ){
		
		if( !sElm.get(0) ){
			/*alert('Select a box or block content first.');*/
			$('#boxRowSett').css({display:'none'});
			return;
		}
		
		$('#list-box2prop-view li').hide().eq(sel.selectedIndex).css({display:'block'});
		var prop = sel.options[ sel.selectedIndex ].innerHTML.replace(/ /g,'-').toLowerCase();
		switch( prop ){
			case 'css3-effects':
				
				var clasz = sElm.attr('class').split(' ');
				var effs = ID('css3effects-bs2');
				effs.options[0].selected = true;
				for( var i = 0; i < clasz.length; i++ ){
					for( var j = 0; j < effs.options.length; j++ ){
						if( clasz[i] == effs.options[j].value ){
							effs.options[j].selected = true;
						}
					}	
				}	
				
			break;			
			case 'background':
				ID('bgcol-bs2').value = rgb2hex( sElm.css('background-color') );
				jscolor.color(ID('bgcol-bs2'));
				ID('bgfull-bs2').value = sElm.css('background-image')!='none'?sElm.css('background'):'';
			break;
			case 'border':
				$('#borderwidth-bs2').val( sElm.css('border-width') );
				$('#borderstyle-bs2').val( sElm.css('border-style') );
				var color = rgb2hex( sElm.css('border-color') );
				$('#bordercolor-bs2').val( color );
				jscolor.color(ID('bordercolor-bs2'));
			break;
			case 'box-shadow':
				var val = sElm.css('box-shadow');
				if( val != 'none' ){
					var color = rgb2hex( val.substring(0, val.indexOf(' ')) );
					var pxl = val.substring( val.indexOf(' ')+1 , val.length );
					ID('boxshadow-bs2').value = pxl;
					ID('boxshadowcolor-bs2').value = color;
					jscolor.color(ID('boxshadowcolor-bs2'));
				}
			break;
			case 'text-shadow':
				var val = sElm.css('text-shadow');
				if( val != 'none' ){
					var color = rgb2hex( val.substring(0, val.indexOf(' ')) );
					var pxl = val.substring( val.indexOf(' ')+1 , val.length );
					ID('textshadow-bs2').value = pxl;
					ID('textshadowcolor-bs2').value = color;
					jscolor.color(ID('textshadowcolor-bs2'));
				}
			break;
			case 'text-align':
				$('#textalgin-bs2').val( sElm.css('text-align') );
			break;
			case 'display':
				$('#display-bs2').val( sElm.css('display') );
			break;
		}
	}	
	
}

function setUpSplSl(min,max,val){
	
	$('#box-sizes-inp').parent().find('.slider-volume').remove();
	
	var $val2 = $('#box-sizes-inp');

	$val2.val(val).simpleSlider({
		snap: true,
		step: 1,
		range: [min, max],
		theme: 'volume'
	}).show().on('keyup blur', function (e) {
		$val2.simpleSlider('setValue', $val2.val());
	}).on('change', function (e) {
		
		updateValueBoxStyle( this.value );
		
		if( ID('box-sizes-checkauto').checked == true )
			ID('box-sizes-checkauto').checked = false;
		
	});
}

function updateValueBoxStyle( val ){
	
	var sel = ID('box-sizes-sel');
	var ops = sel.options
	ops[sel.selectedIndex].value = val;
	var prop = ops[sel.selectedIndex].innerHTML.replace(/ /g,'-').toLowerCase(),prop2 = '';
	
	if( val != '' && val != 'auto' ){
		if( (prop == 'width'/* || prop == 'height'*/) ){
			val = val+'%';
		}else{
			var val = val+'px';
		}
	}
	
	if( prop.indexOf('---') > -1 )
	{
		prop2 = prop.substring(0, prop.indexOf('-')+1 ) + prop.substring( prop.indexOf('---')+3 ,prop.length );
		prop = prop.substring( 0, prop.indexOf('---') );
	}
	
	var inFrame = ID('design-iframe_ifr').contentWindow;
	var ij = inFrame.jQuery;	

	ij('.curentLiveEdittingMode .elmSelected').css( prop , val );
	if( prop2 != '' ){
		ij('.curentLiveEdittingMode .elmSelected').css( prop2 , val );
	}
	//ij('.curentLiveEdittingMode .elmSelected').css({'"+prop+"' : '"+val+"' "+prop2+" })" );

	if( val == '' ){
		var val = parseInt( ij('.curentLiveEdittingMode .elmSelected').css(prop) );
		$('#box-sizes-inp').simpleSlider('setValue', val );
	}
}

function reloadIF(){
	
	ID('design-iframe_ifr').src = ID('design-iframe_ifr').src;
	
}

function moveFromRaw2Live( elm ){

	if( $(elm).hasClass('devn-code-customize') ){
		var sid = elm.id;
		var txtCode = '';
		txtCode = Base64.decode( ID( sid ).value );

		if( txtCode != '' ){
			
			elm.innerHTML = txtCode.replace(/<\?/g,'&lt;?').replace(/\?>/g,'?&gt;').replace(/\&lt\;\?php echo THEME_URI\; \?\&gt\;/g,theme).replace(/\&lt\;\?php echo SITE_URI\; \?\&gt\;/g,site_uri);
			
			var inFrame = ID('design-iframe_ifr').contentWindow;
			var ij = inFrame.jQuery;	
			if( typeof ij.flexslider == 'function' ){	
				ij('.flexslider').flexslider({
					animation:"slide",
					animationLoop:true,
					itemWidth:1170,
					itemMargin:5,
					pausePlay:true,
					pauseOnHover:true,
					start:function(slider){
						$('body').removeClass('loading');
					}
				});
			}	
		}	
	}else if( $(elm).hasClass('execphpwidget') ){
		var sid = elm.parentNode.id;
		var txtCode = '';
		$('#widgets-right .widget .widget-id').each(function(){
			if(this.value ==sid){
				txtCode = $(this).parent().find('textarea.phpxcode').val();
			}
		});
		if( txtCode != '' )
			elm.innerHTML = txtCode.replace(/<\?/g,'&lt;?').replace(/\?>/g,'?&gt;');
			
	}else if( $(elm).hasClass('entry-content') ){
		
		var ctraw = ID('page-content-raw');
		if( ctraw ){
			if( ctraw.value != '' ){
				
				var svalue = ctraw.value.replace(/<\?/g,'&lt;?').replace(/\?>/g,'?&gt;');
				var svalue = svalue.replace(/\[php\]echo THEME_URI\;\[\/php\]/g,theme).replace(/\[php\]echo SITE_URI\;\[\/php\]/g,site_uri);
				
				
				elm.innerHTML = svalue;
			}
		}else return;	
	}
	
	$( elm ).find('.compElm-livCon.compElm-iframe').each(function(){
		
		$(this).attr({contenteditable:'false'});
		
		var shortcode = Base64.encode( $(this).html().trim() );
		
		if( shortcode == '' )
			return;
		
		$(this).attr({ 'code' : shortcode });
		
		this.innerHTML = '<iframe scrolling="no" onload="top.onloadShortcodePreview(this)" style="width:100%;height:100px" src="'+theme+'/../../../wp-admin/admin-ajax.php?action=su_generator_preview&shortcode='+shortcode+'"></iframe><div contenteditable="false" class="shc-func-btns btn-group"><button class="btn btn-default" title="Edit this element" onclick="top.shcPrevFunc(this,\'edit\')"><i class="fa fa-pencil"></i></button><button  title="Remove this element" onclick="top.shcPrevFunc(this,\'remove\')" class="btn btn-default"><i class="fa fa-times"></i></button></div>';
	});
	
	$( elm ).find('.devnConColbody').attr({ 'contenteditable' : true });
	
}

function rgb2hex(rgb) {
	var color = rgb;
	try{
	     if (  rgb.search("rgb") == -1 ) {
	          return rgb;
	     }
	     else if ( rgb == 'rgba(0, 0, 0, 0)' ) {
	         return 'transparent';
	     }
	     else {
	          rgb = rgb.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+))?\)$/);
	          function hex(x) {
	               return ("0" + parseInt(x).toString(16)).slice(-2);
	          }
	          return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]); 
	     }
	  }catch(e){
		  return color;
	  }   
}

function autoFormatCodeMirrors( editor ) {
    var totalLines = editor.lineCount();
    var totalChars = editor.getTextArea().value.length;
    editor.autoFormatRange({line:0, ch:0}, {line:totalLines, ch:totalChars});
    editor.setSelection( {line:0, ch:0} , {line:0, ch:0} );
}

function scroll2cur(){

	var ij = getIJ();
	if( document.pageY ){
		var top = document.pageY;
		if( top > 300 )
			top -= 300;
		else top = 0;	
		ij('html,body').animate({ scrollTop : top });
		
		if( ij('.elmSelected').length > 1 )
		{	
			ij('.elmSelected').removeClass('elmSelected').eq(0).addClass('elmSelected');
		}
	}
}


function onloadShortcodePreview( iframe ){		

	var ij = getIJ();
	
	var inij = ij( iframe ).contents();
	inij.find('head').append('<style type="text/css">html,body{background: transparent !important;border:0px;padding:0px !important;margin: 0px !important;}</style>');
	ij('head link').each(function(){
		var href = ij(this).attr('href');
		if( !href )href = '';
		if( this.type == 'text/css' && href.indexOf('wp-include') == -1 && href.indexOf('wp-admin') == -1 )
			inij.find('head').append( ij(this).clone() ); 
	});
	inij.find('#preview-headding').remove();

	resizeHeightIframePreview( iframe )
	
	var inFrame = iframe.contentWindow;
	inFrame.document.iframeParent = iframe;
	
	inFrame.document.onclick = function(){
		top.resizeHeightIframePreview( this.iframeParent );
		top.getIJ('.elmSelected').removeClass('elmSelected');
		var frameElm = top.getIJ(this.iframeParent).parent();
		if( !frameElm.hasClass('eblink') && !frameElm.parent().hasClass('eblink') ){
			frameElm.parent().addClass('elmSelected');
		}else{
			return false;
		}	
		
		var finder = frameElm.parent().get(0);
		while( !ij( finder ).hasClass('eblink') && !ij( finder ).hasClass('devnContentCol') && finder.parentNode ){
			finder = finder.parentNode;
		}
		
		if( ij( finder ).hasClass('devnContentCol') )
			$('#boxRowSett').css({display:'block'});
		else $('#boxRowSett').css({display:'none'});
		
	};
	
}

function resizeHeightIframePreview( iframe ){

	var ij = getIJ();
	var inij = ij( iframe ).contents();
	var height = inij.find('body > div').get(0);
	if( height )
		height = height.offsetHeight;
	else height = inij.find('html').get(0).offsetHeight;
	
	iframe.style.height = (height)+'px';
	
}


function selectParentNode(){
	
	var ij = getIJ();
	var elm = ij('.elmSelected').removeClass('elmSelected').eq(0).addClass('elmSelected').get(0);
	if( !elm )
		return;
	if( ij( elm.parentNode ).hasClass('eblink') ){
		alert('Has to be limited to allow editing');
		return;
	}	
	elm = elm.parentNode;
	ij('.elmSelected').removeClass('elmSelected');
	
	var eblink = ij( elm ).addClass('elmSelected').closest('.eblink').get(0);	
	if( eblink )
		eblink.onmouseup({ target: elm });
	
	ID('dropdown-boxstyle').style.display = 'block';
}

function shcPrevFunc( btn, task ){
	
	var ij = getIJ();
	if( task == 'remove' ){
		ij(btn).closest('.devnConColbody').addClass('elmSelected');
		ij(btn).closest('.compElm-livCon').remove();
	}else{
		var shortcode = ij(btn).closest('.compElm-livCon').attr('code');
		$('#editShorcodePrev').val( Base64.decode(shortcode) ).html( Base64.decode(shortcode) );
		$('#editShorcodePrev').parent().find('a').click();
		ij('.elmSelected').removeClass('elmSelected');
		ij(btn).closest('.compElm-livCon').addClass('elmSelected');
	}
	
}


function a______________b(){}




function executeJS( elm, input ){
		
	elm.innerHTML = input;
	
	var shortcode = [['<script type="text/javascript">','</script>'],['<script>','</script>'],['[js]','[/js]']];
	var args,out='',script,error='';

	for( var j=0; j < 3; j++)
	{
		if( input.indexOf(shortcode[j][0]) > -1 )
		{
			args = input.split(shortcode[j][0]);
			out = '';
			for( var i=1; i<args.length; i+=2 )
			{
				if(args[i-1])out += args[ i-1 ];
				if(args[i])
				{
					script = args[i].split(shortcode[j][1]);
					out += script[1];
					try{
						eval(script[0]);
					}catch(e){error = "/n"+e.message;};
				};
				
			};
			if( out == '' )
				out = args[ 0 ];
			input = out;
		};	
	};	
	if( error != '' )
		alert("ERROR js:"+error);
		
	return out?out:input;
		
}
/*Rewrite save widget changes*/
function reload_sidebar( sb ){
	
	var iframe = ID('design-iframe_ifr').contentWindow;
	var innerDoc = iframe.document;
	
	var a = {
		mode: 'inspector',
		sidebar: sb,
	};

	jQuery.post( iframe.window.location.href , a, function(result) {
		
		executeJS( innerDoc.getElementById('sidebar-'+sb), result );
		re_init_frame(ID('design-iframe_ifr'));
		
	});
	
};

function widget_order_plus( sb, $ ){
	
	var iframe = ID('design-iframe_ifr').contentWindow;
	var innerDoc = iframe.document;
	
	var a = {
		mode: 'inspector',
		sidebar: sb,
		savewidgets: $('#_wpnonce_widgets').val(),
		sidebars: []
	};

	$('div.widgets-sortables').each( function() {
		if ( $(this).sortable )
			a['sidebars[' + $(this).attr('id') + ']'] = $(this).sortable('toArray').join(',');
	});

	$.post( iframe.window.location.href , a, function(result) {
	
		executeJS( innerDoc.getElementById('sidebar-'+sb), result );
		
	});

	
};

function widget_save_plus( widget, del, animate, order, $, reloadSidebar ) {

	var iframe = ID('design-iframe_ifr').contentWindow;
	var innerDoc = iframe.document;
	
	widget = $(widget);
	var sb = widget.closest('div.widgets-sortables').attr('id').replace('sidebar-',''), data = widget.find('form').serialize(), a;

	$('.spinner', widget).show();

	a = {
		action: 'save-widget',
		savewidgets: $('#_wpnonce_widgets').val(),
		sidebar: sb
	};

	if ( del )
		a['delete_widget'] = 1;

	data += '&' + $.param(a);

	$.post( ajaxurl, data, function(r){
	
		var id;

		if ( del ) {
			if ( !$('input.widget_number', widget).val() ) {
				id = $('input.widget-id', widget).val();
				$('#available-widgets').find('input.widget-id').each(function(){
					if ( $(this).val() == id )
						$(this).closest('div.widget').show();
				});
			}

			if ( animate ) {
				order = 0;
				widget.slideUp('fast', function(){
					$(this).remove();
					widget_order_plus( sb, jQuery );
				});
			} else {
				widget.remove();
			}
			$('body').css({ 'overflow' : '' });
			
		} else {
			$('.spinner').hide();
			if ( r && r.length > 2 ) {
				$('div.widget-content', widget).html(r);
				wpWidgets_appendTitle(widget);
				wpWidgets_fixLabels(widget);
			}
		};
			
		if ( order )
			widget_order_plus( sb, jQuery );	
			
		if ( reloadSidebar )
			reload_sidebar( sb );
	});
};

function wpWidgets_appendTitle() {
	
	jQuery('#widgets-right .widget').each(function(){
	
		var title = jQuery('input[id*="-title"]', this).val() || '';
	
		if ( title )
			title = ': ' + title.replace(/<[^<>]+>/g, '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
	
		jQuery(this).children('.widget-top').children('.widget-title').children()
				.children('.in-widget-title').html(title);
				
	});			
};


function wpWidgets_fixLabels(widget) {

	widget.children('.widget-inside').find('label').each(function(){
		var f = jQuery(this).attr('for');
		if ( f && f == jQuery('input', this).attr('id') )
			jQuery(this).removeAttr('for');
	});
};

function open_front_page(a){
	if( ! ID('link-live-view') ){
		/*alert( 'No content to view, Please select pages to edit first' );
		return false;*/
		a.href = site_uri;
	}else{
		a.href = ID('link-live-view').value;	
	}

}
