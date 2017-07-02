<?php
	/*
		Template Name:Contact page
	*/
?>

<?php
 // if the submit button is clicked, send the email
    if ( isset( $_POST['opl-submitted'] ) ) {
 
        // sanitize form values
        $name    = sanitize_text_field( $_POST["opl-name"] );
        $email   = sanitize_email( $_POST["opl-email"] );
        $subject = sanitize_text_field( $_POST["opl-subject"] );
        $message = esc_textarea( $_POST["opl-message"] );
 
        // get the blog administrator's email address
        $to = get_option( 'admin_email' );
         var_dump($to);
		 exit();
        $headers = "From: $name <$email>" . "\r\n";
 
        // If email has been process for sending, display a success message
        if ( wp_mail( $to, $subject, $message, $headers ) ) {
            echo '<div>';
            echo '<p>Thanks for contacting me, expect a response soon.</p>';
            echo '</div>';
        } else {
            echo 'An unexpected error occurred';
        }
    }?>
   <?php  get_header() ?>
		
	<!-- Primary Page Layout
	================================================== -->

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
	</section> <!-- .cd-section --> 

	<section class="section white-background padding-top-bottom shadow-sec" id="scroll-link">
		<div class="container">
			<div class="sixteen columns">
				<div class="section-header-text">
					<h4><?php echo ot_get_option('contact_title');?><span></span></h4> 
					<p><?php echo ot_get_option('contact_subtitle');?></p> 
					<div class="line-header"></div>
				</div>
			</div>
				
				<div class="clear"></div>
				
				<form action="<?php the_permalink(); ?>" id="ajax-form" method="post">
				<?php  
					echo '<div class="one-third column" data-scroll-reveal="enter bottom move 100px over 0.6s after 0.2s">
										<label for="name">';

					echo '</label>';
					echo '<input type="text" name="opl-name"  id="name" pattern="[a-zA-Z0-9 ]+" placeholder="Your Name: *" value="' . ( isset( $_POST["opl-name"] ) ? esc_attr( $_POST["opl-name"] ) : '' ) . '" size="40" />';
					echo '</div>';
					echo '<div class="one-third column" data-scroll-reveal="enter bottom move 100px over 0.6s after 0.2s">
										<label for="email"> ';
				  
					echo '</label>';
					echo '<input type="email" name="opl-email" id="email"  placeholder="E-Mail: *" value="' . ( isset( $_POST["opl-email"] ) ? esc_attr( $_POST["opl-email"] ) : '' ) . '" size="40" />';
					echo '</div>';
					echo '<div class="one-third column" data-scroll-reveal="enter bottom move 100px over 0.6s after 0.2s">
										<label for="subject"> ';
				  
					echo ' </label>';
					echo '<input type="text" name="opl-subject" id="name" pattern="[a-zA-Z ]+" placeholder="Subject: *" value="' . ( isset( $_POST["opl-subject"] ) ? esc_attr( $_POST["opl-subject"] ) : '' ) . '" size="40" />';
					echo '</div>';
					echo '<div class="sixteen columns" data-scroll-reveal="enter bottom move 100px over 0.6s after 0.2s">
										<label for="message"></label>';
					
					echo '<textarea rows="10" cols="35" id="message" placeholder="Tell Us Everything" name="opl-message">' . ( isset( $_POST["opl-message"] ) ? esc_attr( $_POST["opl-message"] ) : '' ) . '</textarea>';
					echo '</div>';
					echo '<div class="sixteen columns" data-scroll-reveal="enter bottom move 100px over 0.6s after 0.2s">
										<div id="button-con"><input type="submit" name="opl-submitted" class="send_message" id="send" value="Submit"/></div>					
									</div>
									<div class="clear"></div>	';
					echo '</form>'; ?>	
				<div class="clear"></div>
				<div id="ajaxsuccess">Successfully sent!!</div>
				<div class="clear"></div>
					
		</div>
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
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/contact.js"></script>  	  
   <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/custom-contact1.js"></script> 
	<?php get_footer();?>
	