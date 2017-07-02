(function($) {
	"use strict";
	$(document).ready( function() {
	    $('#filters-container button').click(function(e) {
	    	$('#filters-container .devn-portfolio-filter-item-active').removeClass('devn-portfolio-filter-item-active');
	    	$(this).addClass('devn-portfolio-filter-item-active'); 
	        var target = $(this).attr('data-filter');
	        if( target == '*' ){
		        target = '.devn-portfolio-item';
	        }
	        $('#grid-container .devn-portfolio-item .devn-portfolio-item-wrapper').addClass('animated zoomOut');
	        
	        setTimeout(function(){
	        
		        $('#grid-container .devn-portfolio-item').css({display:'none'});
		        $('#grid-container .devn-portfolio-item .devn-portfolio-item-wrapper').get(0).className = 'devn-portfolio-item-wrapper effHidden';
		        $('#grid-container '+target).each(function(){
			        $(this).css({display:'block'});
			        $(this).find('.devn-portfolio-item-wrapper').get(0).className = 'devn-portfolio-item-wrapper effVisible animated bounceIn';
		        });
		        setTimeout(function(){
			         $('#grid-container .animated').removeClass('animated').removeClass('bounceIn');
		        },1200);
		    },800); 
	        
	        e.preventDefault();
	    });
	});
})(jQuery);
