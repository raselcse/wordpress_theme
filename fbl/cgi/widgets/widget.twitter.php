<?php

class TwitterWidget extends WP_Widget
{
    function TwitterWidget(){
		$widget_ops = array('description' => 'Displays Your Twitter Updates');
		$control_ops = array('width' => 300, 'height' => 300);
		parent::WP_Widget('twi7er',$name='Twitter',$widget_ops,$control_ops);
    }

	
	
  /*Saves the settings. */
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = stripslashes($new_instance['title']);
		$instance['TwitterCount'] = stripslashes($new_instance['TwitterCount']);
		$instance['TwitterID'] = stripslashes($new_instance['TwitterID']);
		return $instance;
	}

  /*Creates the form for the widget in the back-end. */
    function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'Twitter Feed!', 'TwitterCount'=>'', 'TwitterID'=>'') );

		$title = htmlspecialchars($instance['title']);
		$TwitterCount = htmlspecialchars($instance['TwitterCount']);
		$TwitterID = htmlspecialchars($instance['TwitterID']);

		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
		# Twitter ID
		echo '<p><label for="' . $this->get_field_id('TwitterID') . '">' . 'Twitter Username (yourname only):' . '</label><input class="widefat" id="' . $this->get_field_id('TwitterID') . '" name="' . $this->get_field_name('TwitterID') . '" type="text" value="' . $TwitterID . '" /></p>';
		# Twitter Update Count
		echo '<p><label for="' . $this->get_field_id('TwitterCount') . '">' . 'Update Count (ex: 3):' . '</label><input class="widefat" id="' . $this->get_field_id('TwitterCount') . '" name="' . $this->get_field_name('TwitterCount') . '" type="text" value="' . $TwitterCount . '" /></p>';	
	}


	/* Displays the Widget in the front-end */
    function widget($args, $instance){
    
		global $TwitterID, $TwitterCount;
		extract($args);
	
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Twitter Updates' : $instance['title']);
		$TwitterID = empty($instance['TwitterID']) ? '' : $instance['TwitterID'];
		$TwitterCount = empty($instance['TwitterCount']) ? '' : $instance['TwitterCount'];
		
				
		echo $before_widget;
		
		echo $before_title.$title.$after_title;
		
		// Print all tweets
		$tweet = self::returnTweet();
		$tweet = json_decode( $tweet );
		?>
		
		<div class="twitter_feeds_two twitter-feeds">
			<div class="right">	
				<?php

					for( $i=0 ; $i <= $TwitterCount - 1 ; $i++){
					
						$time = $tweet[$i]->created_at;
						$time = date_parse($time);
						$uTime = mktime($time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year']);
						$timeDisplay = self::twitter_time_diff($uTime, current_time('timestamp')); 
				?>
				<div class="tweet-item <?php if( $i == 0 )echo 'animated fadeInUp'; ?>" <?php if( $i>0 )echo 'style="display:none;"'; ?>>
					
					<i class="fa fa-twitter"></i>
					
					<a href="https://twitter.com/<?php echo esc_attr( $tweet[$i]->user->screen_name ); ?>" target="_blank">
						<?php echo esc_attr( $tweet[$i]->user->name ); ?>:
					</a>
					 <?php echo esc_attr( $tweet[$i]->text ); ?>
				
					<em>
						<a href="https://twitter.com/<?php echo esc_attr( $tweet[$i]->user->screen_name ); ?>/status/<?php echo esc_attr( $tweet[$i]->id_str ); ?>" target="_blank" class="small"><?php echo esc_attr( $timeDisplay ); ?> ago </a>
						.
						<a href="https://twitter.com/intent/tweet?in_reply_to=<?php echo esc_attr( $tweet[$i]->id_str ); ?>" target="_blank" class="small">reply </a>
						.
						<a href="https://twitter.com/intent/retweet?tweet_id=<?php echo esc_attr( $tweet[$i]->id_str ); ?>" target="_blank" class="small">retweet </a>
						.
						<a href="https://twitter.com/intent/favorite?tweet_id=<?php echo esc_attr( $tweet[$i]->id_str ); ?>" target="_blank" class="small">favorite</a>
					</em>
				</div>
				<?php } ?>
			</div>	
		</div>
		
		<?php
		
		echo $after_widget;
	}
	
	function buildBaseString($baseURI, $method, $params) {
		$r = array();
		ksort($params);
		foreach($params as $key=>$value){
			$r[] = "$key=" . rawurlencode($value);
		}
		return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
	}
	
	function buildAuthorizationHeader($oauth) {
		$r = 'Authorization: OAuth ';
		$values = array();
		foreach($oauth as $key=>$value)
			$values[] = "$key=\"" . rawurlencode($value) . "\"";
		$r .= implode(', ', $values);
		return $r;
	}
	
	function returnTweet(){
		
		global $TwitterID, $TwitterCount;
		$oauth_access_token         = "2438810168-QSjSfwcOYFqi2oEUfB4338asyBun28wasGFa8jS";
		$oauth_access_token_secret  = "qa6KIF3JpCPX7CXEDgE76MGvVDw3jAAbNvBRYhvw89Rp8";
		$consumer_key               = "F4RJ5DaO0BxGdlnYyctUEhfIT";
		$consumer_secret            = "FAyGunQfoifYbmz1nXs10pK2Trt0xw2IUWqBNmOehVK9UoutI0";
	
		$twitter_timeline           = "user_timeline";  //  mentions_timeline / user_timeline / home_timeline / retweets_of_me
	
		//  create request
			$request = array(
				'screen_name'       => $TwitterID,
				'count'             => $TwitterCount
			);
	
		$oauth = array(
			'oauth_consumer_key'        => $consumer_key,
			'oauth_nonce'               => time(),
			'oauth_signature_method'    => 'HMAC-SHA1',
			'oauth_token'               => $oauth_access_token,
			'oauth_timestamp'           => time(),
			'oauth_version'             => '1.0'
		);
	
		//  merge request and oauth to one array
			$oauth = array_merge($oauth, $request);
	
		//  do some magic
			$base_info              = self::buildBaseString("https://api.twitter.com/1.1/statuses/$twitter_timeline.json", 'GET', $oauth);
			$composite_key          = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
			$oauth_signature            = devnExt::base64( 'encode' , hash_hmac('sha1', $base_info, $composite_key, true));
			$oauth['oauth_signature']   = $oauth_signature;
	
		//  make request
			$header = array(self::buildAuthorizationHeader($oauth), 'Expect:');
			$options = array( CURLOPT_HTTPHEADER => $header,
							  CURLOPT_HEADER => false,
							  CURLOPT_URL => "https://api.twitter.com/1.1/statuses/$twitter_timeline.json?". http_build_query($request),
							  CURLOPT_RETURNTRANSFER => true,
							  CURLOPT_SSL_VERIFYPEER => false);
	
			$feed = devnExt::curl('init',"https://api.twitter.com/1.1/statuses/$twitter_timeline.json?". http_build_query($request));
			curl_setopt_array($feed, $options);
			$json = devnExt::curl( 'exec' , $feed);
			curl_close($feed);
	
		return $json;
	}
	
	// Return distance time from tweet to current.
	
	function twitter_time_diff( $from, $to = '' ) {
		$diff = human_time_diff($from,$to);
		$replace = array(
				' hour' => 'h',
				' hours' => 'h',
				' day' => 'd',
				' days' => 'd',
				' minute' => 'm',
				' minutes' => 'm',
				' second' => 's',
				' seconds' => 's',
		);
		return $diff;
	}	

	
}// end TwitterWidget class

function TwitterWidgetInit() {
  register_widget('TwitterWidget');
}

add_action('widgets_init', 'TwitterWidgetInit');