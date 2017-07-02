(function($){
	"use strict";
	$(document).ready(function($){
		
		$(
				'.sidebar_widget .widget_categories,.sidebar_widget .widget_archive,'+
				'.sidebar_widget .widget_pages,.sidebar_widget .widget_meta,'+
				'.sidebar_widget .widget_recent_entries,.sidebar_widget .widget_nav_menu').each(function(){
				
			$(this).find('ul').addClass('arrows_list1');
			$(this).find('li a').prepend('<i class="fa fa-caret-right"></i>');
		
		});
		
		$('ul.nav>li.current-menu-item>a').addClass('active');
		
		$('.sidebar_widget h3.widget-title').each(function(){
			var html = this.innerHTML;
			if( html.indexOf(' ') > -1 ){
				var title = html.substring( 0 , html.indexOf(' ') );
				title += '<i>'+html.substring( html.indexOf(' '), html.length )+'</i>';
				this.innerHTML = title;
			}
		});
		
		setInterval(function(){
			
			$('.twitter-feeds').each(function(){
		
				var items = $(this).find('.tweet-item');
				var curr = $(this).find('.tweet-item.animated');
				if( !curr.get(0) ){
					items.eq(0).show().addClass('animated fadeInUp');
				}else{
					if( curr.next().get(0) ){
						curr.hide().removeClass('animated fadeInUp');
						curr.next().show().addClass('animated fadeInUp');
					}else{
						curr.hide().removeClass('animated fadeInUp');
						items.eq(0).show().addClass('animated fadeInUp');
					}
				}	
				
			});
			
		}, 3000 );
			
		$('#tabs ul.tabs li').click(function(e){
			$('#tabs .tab_container').css({display:'none'});
			$( $(this).find('a').attr('href') ).css({display:'block'});
			$('#tabs ul.tabs li.active').removeClass('active');
			$(this).addClass('active');
			e.preventDefault();
		});
		
		$("a[rel^='lb']").prettyPhoto({
			animation_speed:'normal',
			theme:'pp_default',
			slideshow:5000, 
			hideflash: true,
			autoplay_slideshow: true,
			social_tools: '',
			show_title: true,
		});	
		
		$('#scrollup').click(function(e){
			$('html,body').animate({ 'scroll-top' : 0 });
			e.preventDefault();
		});
		
		
		/*CREATE MENU RESPONSIVE*/
		var menu = $('#devn-mainmenu');
		if( menu.get(0) ){
			
			var wrp = menu.closest('.navbar-collapse').parent();
			wrp.append('<select id="mainmenu-select"></select>');
			$("<option />", {
			   "selected": "selected",
			   "value"   : "",
			   "text"    : "Go to..."
			}).appendTo( wrp.find('select') );
			
			menu.find('a').each(function() {
		
				var el = $(this);
				var spc = '';
				var ul = this.parentNode.parentNode;
				if( !ul )return;
				var i = 0;
				while( ul.id != 'devn-mainmenu' && i++ < 10 )
				{
					spc+='__';
					ul = ul.parentNode.parentNode;
					if( !ul )return;
				};
				var checked = false;
				if( el.attr("href") == window.location.href ){
					checked = true;
				}
				$("<option />", {
					 "value"   : el.attr("href"),
					 "text"    : spc+el.text(),
					 "selected": checked
				 }).appendTo( wrp.find('select') );
			});
		
			wrp.find('select').change(function() {
			 	 window.location = $(this).find("option:selected").val();
			});
			
		}
		
		$('a').click(function(e){
			if( $(this).attr('href') == '#' ){
				e.preventDefault();
			}
		});
		
	});

	$(window).scroll(function () {

	    if ($(window).scrollTop() > 100 ) {
	        $('#scrollup').show();
	    } else {
	        $('#scrollup').hide();
	    }
	});
	
	
	$(window).load(function(){
		$('.flexslider').flexslider({
			animation:"slide",
			animationLoop:true,
			itemWidth:1170,
			itemMargin:5,
			pausePlay:true,
			start:function(slider){
				$('body').removeClass('loading');
			}
		});
	});
	
	
})(jQuery);	
