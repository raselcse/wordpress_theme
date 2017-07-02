
<?php
/*
Template Name: Contact Template
*/
?>
&nbsp;
<?php
if(isset($_POST['submitted'])) {
if(trim($_POST['contactName']) === '') {
$nameError = 'Please enter your name.';
$hasError = true;
} else {
$name = trim($_POST['contactName']);
}
if(trim($_POST['email']) ==='')  {
$emailError = 'Please enter your email address.';
$hasError = true;
} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
$emailError = 'You entered an invalid email address.';
$hasError = true;
} else {
$email = trim($_POST['email']);
}

if(trim($_POST['subject']) === '') {
$subjectError = 'Please enter your subject.';
$hasError = true;
} else {
$subject = trim($_POST['subject']);
}


if(trim($_POST['comments']) === '') {
$commentError = 'Please enter a message.';
$hasError = true;
} else {
if(function_exists('stripslashes')) {
$comments = stripslashes(trim($_POST['comments']));
} else {
$comments = trim($_POST['comments']);
}
}
if(!isset($hasError)) {
$emailTo = get_option('tz_email');
if (!isset($emailTo) || ($emailTo == '') ){
$emailTo = get_option('admin_email');
}
$subject = $subject.'From '.$name;
$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

wp_mail($emailTo, $subject, $body, $headers);
$emailSent = true;
}
} ?>
<?php get_header(); ?>
		<section class="cd-section">
		<div class="cd-block">
			<div class="contact-top">
			
				<div id="cd-google-map">
				   
					<div id="google-container"> <?php echo ot_get_option('contact_googlemap');?></div>
					<div id="cd-zoom-in"></div>
					<div id="cd-zoom-out"></div>
					<address><?php echo ot_get_option('contact_address');?></address> 
				</div>	
				
				<a href="#scroll-link" class="scroll scroll-down"></a>
				
			</div>
		</div>
		
	</section>
		
					  
						
<section class="section white-background padding-top-bottom shadow-sec" id="scroll-link">
		<div class="container">
			
				<div class="section-header-text">
					<h4><?php echo ot_get_option('contact_title');?><span></span></h4> 
					<p><?php echo ot_get_option('contact_subtitle');?></p> 
					<div class="line-header"></div>
				</div>
			    <div class="sixteen columns">
						
						    <div>
								<?php if(isset($emailSent) && $emailSent == true) { ?>
								<div class="successfull_message">
								<p>Thanks, your email was sent successfully.</p>
								</div>
								<?php } else { ?>
							
								<?php if(isset($hasError) || isset($captchaError)) { ?>
								<p>Sorry, an error occured.<p>
								<?php } ?>
							</div>
						</div>
			
				<form action="<?php the_permalink(); ?>" id="ajax-form" method="post">
				<div class="one-third column" data-scroll-reveal="enter bottom move 100px over 0.6s after 0.2s">
						<label for="name"></label>
				<input type="text" name="contactName" id="contactName" placeholder="Name *" value="<?php if(isset($_POST[‘contactName’])) echo $_POST[‘contactName’];?>" />
				<?php if($nameError != ”) { ?>
				<span><?=$nameError;?></span>
				<?php } ?>
				</div>
				<div class="one-third column" data-scroll-reveal="enter bottom move 100px over 0.6s after 0.2s">
						<label for="name"></label>
				<input type="text" name="email" id="email" placeholder="E-Mail: *" value="<?php if(isset($_POST[‘email’]))  echo $_POST[‘email’];?>" />
				<?php if($emailError != ”) { ?>
				<span><?=$emailError;?></span>
				<?php } ?>
				</div>
                <div class="one-third column" data-scroll-reveal="enter bottom move 100px over 0.6s after 0.2s">
						<label for="name"></label>
				<input type="text" name="subject" id="contactName" placeholder="Subject *" value="<?php if(isset($_POST[subject])) echo $_POST[subject];?>" />
				<?php if($nameError != ”) { ?>
				<span><?=$nameError;?></span>
				<?php } ?>
				</div>
				<div class="sixteen columns" data-scroll-reveal="enter bottom move 100px over 0.6s after 0.2s">
						<label for="name"></label>
				<textarea name="comments" id="commentsText" rows="20" cols="30" placeholder="Message: *"><?php if(isset($_POST[‘comments’])) { if(function_exists(‘stripslashes’)) { echo stripslashes($_POST[‘comments’]); } else { echo $_POST[‘comments’]; } } ?></textarea>
				<?php if($commentError != '') { ?>
				<span><?=$commentError;?></span>
				<?php } ?>
				</div>
				
				<div class="sixteen columns" data-scroll-reveal="enter bottom move 100px over 0.6s after 0.2s">
						<div id="button-con"><input type="submit" name="opl-submitted" class="send_message" id="send" value="Submit"/></div>					
					</div>
				</ul>
				<input type="hidden" name="submitted" id="submitted" value="true" />
				</form>
<?php } ?>

</div><!– .post –>


	</section>
	<section class="section white-background padding-bottom hidden-sec">
		<div class="container">
			<div class="one-third column">
				<div class="contact-details">
					<p><span>&#xf1d8;</span> Email:</p> 
					<h6><?php echo ot_get_option('contact_email');?></h6>
				</div>
			</div>
			<div class="one-third column">
				<div class="contact-details">
					<p><span>&#xf095;</span> Phone:</p>
					<h6><?php echo ot_get_option('contact_phone');?></h6>
				</div>
			</div>
			<div class="one-third column">
				<div class="contact-details">
					<p><span>&#xf041;</span> Address:</p>
					<h6><?php echo ot_get_option('contact_address');?></h6>
				</div>
			</div>
		</div>
	</section>
	
<?php get_footer(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/custom-contact1.js"></script> 
