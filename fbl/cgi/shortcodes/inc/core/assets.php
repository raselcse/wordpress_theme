<?php

/**
 * Class for managing plugin assets
 */
class Su_Assets {

	/**
	 * Set of queried assets
	 *
	 * @var array
	 */
	static $assets = array( 'css' => array(), 'js' => array() );

	/**
	 * Constructor
	 */
	function __construct() {
		// Register
		add_action( 'wp_head',                     array( __CLASS__, 'register' ) );
		add_action( 'admin_head',                  array( __CLASS__, 'register' ) );
		add_action( 'su/generator/preview/before', array( __CLASS__, 'register' ) );
		add_action( 'su/examples/preview/before',  array( __CLASS__, 'register' ) );
		// Enqueue
		add_action( 'wp_footer',                   array( __CLASS__, 'enqueue' ) );
		add_action( 'admin_footer',                array( __CLASS__, 'enqueue' ) );
		// Print
		add_action( 'su/generator/preview/after',  array( __CLASS__, 'prnt' ) );
		add_action( 'su/examples/preview/after',   array( __CLASS__, 'prnt' ) );
		// Custom CSS
		add_action( 'wp_footer',                   array( __CLASS__, 'custom_css' ), 99 );
		add_action( 'su/generator/preview/after',  array( __CLASS__, 'custom_css' ), 99 );
		add_action( 'su/examples/preview/after',   array( __CLASS__, 'custom_css' ), 99 );
	}

	/**
	 * Register assets
	 */
	public static function register() {
		// Chart.js
		wp_register_script( 'work',null, array( 'jquery' ), '0.2', true );
		
		wp_register_script( 'chartjs', THEME_URI.'/cgi/shortcodes/assets/js/chart.js' , false, '0.2', true );
		// SimpleSlider
		wp_register_script( 'simpleslider', THEME_URI.'/cgi/shortcodes/assets/js/simpleslider.js' , array( 'jquery' ), '1.0.0', true );
		wp_register_style( 'simpleslider', THEME_URI.'/cgi/shortcodes/assets/css/simpleslider.css', false, '1.0.0', 'all' );
		// Owl Carousel
		wp_register_script( 'owl-carousel', THEME_URI.'/cgi/shortcodes/assets/js/owl-carousel.js', array( 'jquery' ), '1.3.2', true );
		wp_register_style( 'owl-carousel', THEME_URI.'/cgi/shortcodes/assets/css/owl-carousel.css' , false, '1.3.2', 'all' );
		wp_register_style( 'owl-carousel-transitions', THEME_URI.'/cgi/shortcodes/assets/css/owl-carousel-transitions.css' , false, '1.3.2', 'all' );
		// Font Awesome
		wp_register_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', false, '4.0.3', 'all' );
		// Animate.css
		wp_register_style( 'animate', THEME_URI.'/cgi/shortcodes/assets/css/animate.css' , false, '1.0.0', 'all' );
		// InView
		wp_register_script( 'inview', THEME_URI.'/cgi/shortcodes/assets/js/inview.js', array( 'jquery' ), '2.1.1', true );
		// qTip
		wp_register_style( 'qtip', THEME_URI.'/cgi/shortcodes/assets/css/qtip.css', false, '2.1.1', 'all' );
		wp_register_script( 'qtip', THEME_URI.'/cgi/shortcodes/assets/js/qtip.js' , array( 'jquery' ), '2.1.1', true );
		// jsRender
		wp_register_script( 'jsrender', THEME_URI.'/cgi/shortcodes/assets/js/jsrender.js' , array( 'jquery' ), '1.0.0-beta', true );
		// Magnific Popup
		wp_register_style( 'magnific-popup', THEME_URI.'/cgi/shortcodes/assets/css/magnific-popup.css' , false, '0.9.7', 'all' );
		wp_register_script( 'magnific-popup', THEME_URI.'/cgi/shortcodes/assets/js/magnific-popup.js' , array( 'jquery' ), '0.9.7', true );
		wp_localize_script( 'magnific-popup', 'su_magnific_popup', array(
				'close'   => __( 'Close (Esc)', 'devn' ),
				'loading' => __( 'Loading...', 'devn' ),
				'prev'    => __( 'Previous (Left arrow key)', 'devn' ),
				'next'    => __( 'Next (Right arrow key)', 'devn' ),
				'counter' => sprintf( __( '%s of %s', 'devn' ), '%curr%', '%total%' ),
				'error'   => sprintf( __( 'Failed to load this link. %sOpen link%s.', 'devn' ), '<a href="%url%" target="_blank"><u>', '</u></a>' )
			) );
		// Ace
		wp_register_script( 'ace', THEME_URI.'/cgi/shortcodes/assets/js/ace/ace.js' , false, '1.1.01', true );
		// Swiper
		wp_register_script( 'swiper', THEME_URI.'/cgi/shortcodes/assets/js/swiper.js' , array( 'jquery' ), '2.6.1', true );
		// jPlayer
		wp_register_script( 'jplayer', THEME_URI.'/cgi/shortcodes/assets/js/jplayer.js' , array( 'jquery' ), '2.4.0', true );
		// Options page
		wp_register_style( 'su-options-page', THEME_URI.'/cgi/shortcodes/assets/css/options-page.css' , false, SU_PLUGIN_VERSION, 'all' );
		wp_register_script( 'su-options-page', THEME_URI.'/cgi/shortcodes/assets/js/options-page.js' , array( 'magnific-popup', 'jquery-ui-sortable', 'ace', 'jsrender' ), SU_PLUGIN_VERSION, true );
		wp_localize_script( 'su-options-page', 'su_options_page', array(
				'upload_title'  => __( 'Choose files', 'devn' ),
				'upload_insert' => __( 'Add selected files', 'devn' ),
				'not_clickable' => __( 'This button is not clickable', 'devn' )
			) );
		// Cheatsheet
		wp_register_style( 'su-cheatsheet', THEME_URI.'/cgi/shortcodes/assets/css/cheatsheet.css', false, SU_PLUGIN_VERSION, 'all' );
		// Generator
		wp_register_style( 'su-generator', THEME_URI.'/cgi/shortcodes/assets/css/generator.css', array( 'farbtastic', 'magnific-popup' ), SU_PLUGIN_VERSION, 'all' );
		wp_register_script( 'su-generator', THEME_URI.'/cgi/shortcodes/assets/js/generator.js', array( 'farbtastic', 'magnific-popup', 'qtip' ), SU_PLUGIN_VERSION, true );
		wp_localize_script( 'su-generator', 'su_generator', array(
				'upload_title'         => __( 'Choose file', 'devn' ),
				'upload_insert'        => __( 'Insert', 'devn' ),
				'isp_media_title'      => __( 'Select images', 'devn' ),
				'isp_media_insert'     => __( 'Add selected images', 'devn' ),
				'presets_prompt_msg'   => __( 'Please enter a name for new preset', 'devn' ),
				'presets_prompt_value' => __( 'New preset', 'devn' ),
				'last_used'            => __( 'Last used settings', 'devn' )
			) );
		// Shortcodes stylesheets
		wp_register_style( 'su-content-shortcodes', self::skin_url( 'content-shortcodes.css' ), false, SU_PLUGIN_VERSION, 'all' );
		wp_register_style( 'su-box-shortcodes', self::skin_url( 'box-shortcodes.css' ), false, SU_PLUGIN_VERSION, 'all' );
		wp_register_style( 'su-media-shortcodes', self::skin_url( 'media-shortcodes.css' ), false, SU_PLUGIN_VERSION, 'all' );
		wp_register_style( 'su-other-shortcodes', self::skin_url( 'other-shortcodes.css' ), false, SU_PLUGIN_VERSION, 'all' );
		wp_register_style( 'su-galleries-shortcodes', self::skin_url( 'galleries-shortcodes.css' ), false, SU_PLUGIN_VERSION, 'all' );
		wp_register_style( 'su-players-shortcodes', self::skin_url( 'players-shortcodes.css' ), false, SU_PLUGIN_VERSION, 'all' );
		// Shortcodes scripts
		wp_register_script( 'su-galleries-shortcodes', THEME_URI.'/cgi/shortcodes/assets/js/galleries-shortcodes.js', array( 'jquery', 'swiper' ), SU_PLUGIN_VERSION, true );
		wp_register_script( 'su-players-shortcodes', THEME_URI.'/cgi/shortcodes/assets/js/players-shortcodes.js', array( 'jquery', 'jplayer' ), SU_PLUGIN_VERSION, true );
		wp_register_script( 'su-other-shortcodes', THEME_URI.'/cgi/shortcodes/assets/js/other-shortcodes.js', array( 'jquery' ), SU_PLUGIN_VERSION, true );
		wp_localize_script( 'su-other-shortcodes', 'su_other_shortcodes', array( 'no_preview' => __( 'This shortcode doesn\'t work in live preview. Please insert it into editor and preview on the site.', 'devn' ) ) );
		// Hook to deregister assets or add custom
		do_action( 'su/assets/register' );
	}

	/**
	 * Enqueue assets
	 */
	public static function enqueue() {
		// Get assets query and plugin object
		$assets = self::assets();
		// Enqueue stylesheets
		foreach ( $assets['css'] as $style ) wp_enqueue_style( $style );
		// Enqueue scripts
		foreach ( $assets['js'] as $script ) wp_enqueue_script( $script );
		// Hook to dequeue assets or add custom
		do_action( 'su/assets/enqueue', $assets );
	}

	/**
	 * Print assets without enqueuing
	 */
	public static function prnt() {
		// Prepare assets set
		$assets = self::assets();
		// Enqueue stylesheets
		wp_print_styles( $assets['css'] );
		// Enqueue scripts
		wp_print_scripts( $assets['js'] );
		// Hook
		do_action( 'su/assets/print', $assets );
	}

	/**
	 * Print custom CSS
	 */
	public static function custom_css() {
		// Get custom CSS and apply filters to it
		$custom_css = apply_filters( 'su/assets/custom_css', str_replace( '&#039;', '\'', html_entity_decode( (string) get_option( 'su_option_custom-css' ) ) ) );
		// Print CSS if exists
		if ( $custom_css ) echo "\n\n<!-- Shortcodes Ultimate custom CSS - begin -->\n<style type='text/css'>\n" . stripslashes( str_replace( array( '%theme_url%', '%home_url%', '%plugin_url%' ), array( trailingslashit( get_stylesheet_directory_uri() ), trailingslashit( home_url() ), trailingslashit( THEME_URI.'/cgi/shortcodes' ) ), $custom_css ) ) . "\n</style>\n<!-- Shortcodes Ultimate custom CSS - end -->\n\n";
	}

	/**
	 * Styles for visualised shortcodes
	 */
	public static function mce_css( $mce_css ) {
		if ( ! empty( $mce_css ) ) $mce_css .= ',';
		return THEME_URI.'/cgi/shortcodes/assets/css/tinymce.css';
	}

	/**
	 * TinyMCE plugin for visualised shortcodes
	 */
	public static function mce_js( $plugins ) {

		return THEME_URI.'/cgi/shortcodes/assets/js/tinymce.js';

	}

	/**
	 * Add asset to the query
	 */
	public static function add( $type, $handle ) {
		// Array with handles
		if ( is_array( $handle ) ) { foreach ( $handle as $h ) self::$assets[$type][$h] = $h; }
		// Single handle
		else self::$assets[$type][$handle] = $handle;
	}
	/**
	 * Get queried assets
	 */
	public static function assets() {
		// Get assets query
		$assets = self::$assets;
		// Apply filters to assets set
		$assets['css'] = array_unique( ( array ) apply_filters( 'su/assets/css', ( array ) array_unique( $assets['css'] ) ) );
		$assets['js'] = array_unique( ( array ) apply_filters( 'su/assets/js', ( array ) array_unique( $assets['js'] ) ) );
		// Return set
		return $assets;
	}

	/**
	 * Helper to get full URL of a skin file
	 */
	public static function skin_url( $file = '' ) {
		$shult = Shortcodes_Devn();
		$skin = get_option( 'su_option_skin' );
		$uploads = wp_upload_dir(); 
		$uploads = $uploads['baseurl'];
		// Prepare url to skin directory
		$url = ( !$skin || $skin === 'default' ) ? THEME_URI.'/cgi/shortcodes/assets/css/' : $uploads . '/shortcodes-ultimate-skins/' . $skin;
		return trailingslashit( apply_filters( 'su/assets/skin', $url ) ) . $file;
	}
}

new Su_Assets;

/**
 * Helper function to add asset to the query
 *
 * @param string  $type   Asset type (css|js)
 * @param mixed   $handle Asset handle or array with handles
 */
function su_query_asset( $type, $handle ) {
	Su_Assets::add( $type, $handle );
}

/**
 * Helper function to get current skin url
 *
 * @param string  $file Asset file name. Example value: box-shortcodes.css
 */
function su_skin_url( $file ) {
	return Su_Assets::skin_url( $file );
}
