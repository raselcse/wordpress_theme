<footer class="footer">
		<div class="container">
			<div class="sixteen columns">
				<div class="footer-social">
					<?php // Loop for Social Links 

						if (function_exists('ot_get_option')) {

							/* get the option array */
							$links = ot_get_option('footer_social_links', array());

							if (!empty($links)) {
								foreach ($links as $link) {

									echo '<a  href="' . $link['href'] . '"/>  '. $link['name'] . ' </a>';

								}
							}
						}	

					?>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="sixteen columns">
				<div class="footer-copy-text">
					<?php echo ot_get_option( 'footer_copyright_text' ); ?>
				</div>
			</div>
		</div>
	</footer> 	
		
	</div>	

		
	<!-- JAVASCRIPT
    ================================================== -->
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.js"></script>	
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.animsition.min.js"></script>
<script type="text/javascript">
(function($) { "use strict";
	$(document).ready(function() {
	  
	  $(".animsition").animsition({
	  
		inClass               :   'zoom-in-sm',
		outClass              :   'zoom-out-sm',
		inDuration            :    800,
		outDuration           :    800,
		linkElement           :   '.animsition-link', 
		// e.g. linkElement   :   'a:not([target="_blank"]):not([href^=#])'
		loading               :    true,
		loadingParentElement  :   'body', //animsition wrapper element
		loadingClass          :   'animsition-loading',
		unSupportCss          : [ 'animation-duration',
								  '-webkit-animation-duration',
								  '-o-animation-duration'
								],
		//"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser. 
		//The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
		
		overlay               :   false,
		
		overlayClass          :   'animsition-overlay-slide',
		overlayParentElement  :   'body'
	  });
	  
	  $('#category-dropdown').on('change', function() {
		  alert( this.value );
		});
		$('#commentform input#submit').addClass('button-primary');
});
	});  
})(jQuery);
</script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.easing.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/retina-1.1.0.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/classie.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/cbpAnimatedHeader.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/menu.js"></script> 	
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/scroll.js"></script>	
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/animated-headline.js"></script>	
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/mb.bgndGallery.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.fs.tipper.min.js"></script>	
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/custom-home2.js"></script>  

<!--
 	  



 

  
-->

	
	  
<!-- End Document
================================================== -->
<?php wp_footer(); ?>
</body>
</html>