<?php
/*
Plugin Name: Oployee Contact Form Plugin
Plugin URI: http://oployeelabs.com
Description: Simple non-bloated WordPress Contact Form
Version: 1.0
Author: Rasel

*/
    //
    // the plugin code will go here..
    //
?>
<?php 
function html_form_code() {
    echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" id="ajax-form" method="post">';
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
    echo '</form>';
}

function deliver_mail() {
 
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
    }
}

function opl_shortcode() {
    ob_start();
    deliver_mail();
    html_form_code();
 
    return ob_get_clean();
}
 
add_shortcode( 'opl_contact_form', 'opl_shortcode' );
 
?>