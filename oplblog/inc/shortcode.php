<?php 

function pallash_full( $atts, $content = null ) {
   return '<div class="sixteen columns">' . do_shortcode($content) . '</div>';
}
add_shortcode('full_width', 'pallash_full');
function pallash_one_half( $atts, $content = null ) {
   return '<div class="eight columns">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'pallash_one_half');
 

function pallash_one_third( $atts, $content = null ) {
   return '<div class="one-third column">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'pallash_one_third');
 

 
function pallash_one_fourth( $atts, $content = null ) {
   return '<div class="four columns">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'pallash_one_fourth');
 
function pallash_one_eight( $atts, $content = null ) {
   return '<div class="two columns">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_eight', 'pallash_one_eight');
function services_list($atts, $content = null) {
    extract(shortcode_atts(array(
		"title" =>'Test',
		"description" =>'This is summary',
		"icon" =>'fa-dashcube'
    ), $atts));
    return '<div class="services-box-2">
	                <div class="ser-icon"><span class="'.$icon.'"></span></div>
					<h6>'.$title.'</h6>
					<p>'.$description.'</p> 
				</div>	
			';
}
add_shortcode('services', 'services_list');

function title_page($atts){
		extract(shortcode_atts(array(
				"title" =>'About Us',
				"subtitle" =>'Our passion for perfection'
			), $atts));
		return '<div class="sixteen columns">
						<div class="section-header-text-left">
							<h4>'.$title.'<span>.</span></h4> 
							<p>'.$subtitle.'.</p> 
							<div class="line-header"></div>
						</div>
					</div>	';
}
add_shortcode('title', 'title_page');

function inner_title_page($atts){
		extract(shortcode_atts(array(
				"title" =>'About Us'
			), $atts));
		return '	<h2>'.$title.'</span></h2>	
					<div class="line-big-header"></div>';
}
add_shortcode('inner_title', 'inner_title_page');

function skill_function($atts){
     extract(shortcode_atts(array(
				"title" =>'php',
				"percentile" =>'80'
			), $atts));
	return '<div class="skills-name">'.$title.' <span><span class="counter-skills">'.$percentile.'</span>%</span></div><div class="pro-bar-container pro-bar-margin">
					<div class="pro-bar bar-87 animated" data-pro-bar-percent="87" data-pro-bar-delay="100" style="overflow: hidden; width: 86.9977113519355%;"></div>
				</div>';
}

add_shortcode('skill', 'skill_function');

function counter_wrape($atts){
 extract(shortcode_atts(array(
				"title" =>'line of code',
				"number" =>'800'
			), $atts));
 return '<div class="counter-wrap">	
						<div class="counter-numb"><span class="counter-facts">'.$number.'</span></div>
						<div class="counter-line"></div>
						<h6>'.$title.'</h6>	
					</div>	';
}

add_shortcode('counter', 'counter_wrape');

function pricing_function($atts){
 extract(shortcode_atts(array(
				"title" =>'Mega',
				"icon" =>'',
				"price" =>'90',
				"memory" =>'1000MB',
				"user" =>'1',
				"website" =>'1',
				"domain" =>'1',
				"link" =>'#',
				"popular" =>'',
			), $atts));
return '  <div class="pricing-item '.$popular.'">
						<h6>'.$title.'</h6>
						<div class="number-price"><span>'.$icon.'</span>'.$price.'<span>/ MO</span></div>
						<p><span>'.$memory.'</span> MEMORY</p>
						<p><span>'.$user.'</span> USER</p>
						<p><span>'.$website.'</span> WEBSITE</p>
						<p><span>'.$domain.'</span> DOMAIN</p>
						<p>UNLIMITED BANDWIDTH</p>
						<p><span>24/7</span> SUPPORT</p>
						<a class="price-link" href="'.$link.'">select</a>
					</div>';
}
add_shortcode('pricing', 'pricing_function');

function team_create($atts){
	 extract(shortcode_atts(array(
				"name" =>'Jahidul Isalm',
				"designation" =>'Web Developer',
				"photourl" =>'http://localhost/pallash/wp-content/uploads/2015/04/Rasel-2.jpg',
				"skill1"=>'',
				"skill2"=>'',
				"skill3"=>'',
				"skill4"=>'',
				"social1_icon"=>'fa-facebook',
				"social1_link"=>'',
				"social2_icon"=>'fa-twitter',
				"social2_link"=>'',
				"social3_icon"=>'fa-google',
				"social3_link"=>'',
				"social4_icon"=>'fa-linkedin',
				"social4_link"=>'',
				
			), $atts));
	if($skill1==''){
	return '<div class="team-wrap">
						<img src="'.$photourl.'" height="400px"alt="">	
						<div class="mask-team">
							<h6>'.$name.'</h6>
							<p><span>'.$designation.'</span></p>
							
							<div class="social-team">
								<ul class="list-social-team">
									<li class="icon-soc-team">
										<a href="'.$social1_link.'" class="'.$social1_icon.'"></a>
									</li>
									<li class="icon-soc-team">
										<a href="'.$social2_link.'" class="'.$social2_icon.'"></a>
									</li>
									<li class="icon-soc-team">
										<a href="'.$social3_link.'" class="'.$social3_icon.'"></a>
									</li>
									<li class="icon-soc-team">
										<a href="'.$social4_link.'" class="'.$social4_icon.'"></a>
									</li>
								</ul>	
							</div>
						</div>
					</div>';
	}
	else{
		return '<div class="team-wrap">
						<img src="'.$photourl.'" height="400px"alt="">	
						<div class="mask-team">
							<h6>'.$name.'</h6>
							<p><span>'.$designation.'</span></p>
							<ul class="skills-list">
							   
								<li>
									<p><span>&#xf1db;</span>'.$skill1.'</p>
								</li>
								<li>
									<p><span>&#xf1db;</span>'.$skill2.'</p>
								</li>
								<li>
									<p><span>&#xf1db;</span>'.$skill3.'</p>
								</li>
								<li>
									<p><span>&#xf1db;</span>'.$skill4.'</p>
								</li>
							</ul>
							<div class="social-team">
								<ul class="list-social-team">
									<li class="icon-soc-team">
										<a href="'.$social1_link.'" class="'.$social1_icon.'"></a>
									</li>
									<li class="icon-soc-team">
										<a href="'.$social2_link.'" class="'.$social2_icon.'"></a>
									</li>
									<li class="icon-soc-team">
										<a href="'.$social3_link.'" class="'.$social3_icon.'"></a>
									</li>
									<li class="icon-soc-team">
										<a href="'.$social4_link.'" class="'.$social4_icon.'"></a>
									</li>
								</ul>	
							</div>
						</div>
					</div>';
					}
	
}

add_shortcode('teams', 'team_create');
?>