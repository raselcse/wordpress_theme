<?php

/**
*
* (c) www.devn.co /Init widgets
*
*/

?>
<div class="style-1">

	<section class="wrap col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
			
			<div class="row" style="padding: 20px">
				
				<section class="content col-md-12">
					
					<?php 
						
						if( !empty($_POST['importSampleData']) ){
						global $devn_importMsg;
					?>		
						<img src="<?php echo THEME_URI; ?>/cgi/assets/img/devn.png" class="pull-right" />
						<h2 style="color: #30bfbf;">Import has completed</h2>
						<div class="h4">
							<p>We will redirect you to homepage after <span id="countdown">10</span> seconds. 
								You can 
								<a href="#" onclick="clearTimeout(countdownTimer)">
									Stop Now
								</a>
								 or go to 
								<a href="<?php echo admin_url('admin.php?page=panel'); ?>" onclick="clearTimeout(countdownTimer)">
									Theme Panel
								</a>
							</p>
						</div>		
						<div class="p">
							<div class="updated settings-error below-h2">
								<p></p>
								<h3>Import Successful</h3>
								<p>All done. Have fun!</p>
								<p></p>
								<p></p>
							</div>
						</div>		
						
					<?php	
						
						}else{
						
					?>
					
					<form action="" method="post" onsubmit="doSubmit(this)">
						<img src="<?php echo THEME_URI; ?>/cgi/assets/img/devn.png" class="pull-right" />
						<h2 style="color: #30bfbf;">Welcome to HOXA </h2>
						
						<div class="h4"><p>Thank you for using the Hoxa Theme.</p></div>	
						
						<div class="bs-callout bs-callout-info">
							<h4><?php _e('Sample Data','devn'); ?></h4>			
							<div class="p">
								<p>
								Let our custom demo content importer do the heavy lifting. Painlessly import settings, layouts, menus, colors, fonts, content, slider and plugins. Then get customising</p>
								Notice: Before import, Make sure your website data is empty (posts, pages, menus...etc...)
							</div>		
						</div>	
						
						<div class="p">
							<p>
								<label class="label-form-sel">Default layout: </label>
								<select name="defaultLayout" class="form-sel">
									<option value="business-layout" selected>Business</option>
									<option value="creative-layout">Creative</option>
									<option value="corporate-layout">Corporate</option>
									<option value="one-page-layout">One Page</option>
									<option value="portfolio-layout">Portfolio</option>
									<option value="landding-page">Landding Page</option>
								</select>
								<i class="sub-label-form-sel">The layout will display as home page</i>
							</p>
						</div>
						
						<div class="p">
							<p>
								<label class="label-form-sel">Install Plugins</label>
								&nbsp; 
								Yes <input checked type="radio" name="activePlugins" value="1" />
								&nbsp; 
								No <input type="radio" name="activePlugins" value="" />
								&nbsp; 
								<i class="sub-label-form-sel">There are 2 plugins we suggest using ( layer slider & contact form 7  )</i>
							</p>
						</div>
											
						<div class="p">
							<p>
								<input type="submit" id="submitbtn" value="Import Data Sample" class="btn submit-btn" />
								<h3 id="imp-notice">
									<img src="<?php echo THEME_URI; ?>/cgi/assets/img/loading.gif" /> 
									Please don't navigate away while importing
									<br />
									<span style="font-size: 10px;float: right;margin: 5px 7px 0 0;">It may take up to 10 minutes</span>
								</h3>
								
								<input type="hidden" value="1" name="importSampleData" />
							</p>
						</div>
					</form>		
					<?php } ?>
				</section><!-- /content -->
				

			</div><!-- /row -->
	
			<div class="row">
	
			<section class="col-md-12">
				
				<div class="footer">

					&copy; HOXA ver <?php global $DS_Options; echo $DS_Options->framework_version; ?> by <a href="//devn.co">DEVN</a>
					|  contact@devn.co
					
					<a onclick="clearTimeout(countdownTimer)" class="pull-right link btn btn-default" class="btn btn-default" href="<?php echo admin_url('admin.php?page=panel'); ?>">
						No, Thanks! &nbsp; <i class="fa fa-sign-out"></i>
					</a>
					
				</div>

			</section><!-- /subscribe -->
			
			</div><!-- /row -->

	  </section>
</div>		
<script type="text/javascript">


	function doSubmit( form ){
		var btn = document.getElementById('submitbtn');
		btn.className+=' disable';
		btn.disabled=true;
		btn.value='Importing.....';
		document.getElementById('imp-notice').style.display = 'block';
	}
	var countdown = document.getElementById('countdown');
	var countdownTimer = null;
	if( countdown ){
		
		function count_down( second ){
			
			second--;
			countdown.innerHTML = second;
			if(second>0){
				countdownTimer = setTimeout('count_down('+second+')', 1000);
			}else{
				window.location = '<?php echo SITE_URI; ?>';
			}	
		}

		count_down( 10 );
		
	}
	
	
	
</script>  