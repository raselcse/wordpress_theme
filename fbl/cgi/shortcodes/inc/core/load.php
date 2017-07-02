<?php
class Shortcodes_Devn {

	/**
	 * Constructor
	 */
	function __construct() {
		add_action( 'plugins_loaded',             array( __CLASS__, 'init' ) );
		add_action( 'init',                       array( __CLASS__, 'register' ) );
		add_action( 'init',                       array( __CLASS__, 'update' ), 20 );
		register_activation_hook( SU_PLUGIN_FILE, array( __CLASS__, 'activation' ) );
		register_activation_hook( SU_PLUGIN_FILE, array( __CLASS__, 'deactivation' ) );
	}

	/**
	 * Plugin init
	 */
	public static function init() {
	
		$admin = new Sunrise4( array(
				'file'       => SU_PLUGIN_FILE,
				'slug'       => 'devn',
				'prefix'     => 'devn_option_',
				'textdomain' => 'devn'
			) );
		// Top-level menu
			
		$admin->add_menu( array(
		
				'page_title'  => __( 'Examples', 'devn' ) . ' &lsaquo; ' . __( 'Shortcodes Ultimate', 'devn' ),
				'menu_title'  => apply_filters( 'su/menu/examples', __( 'Examples', 'devn' ) ),
				'capability'  => 'edit_others_posts',
				'slug'        => 'shortcodes-examples',
		
		
				'page_title'  => __( 'Settings', 'devn' ) . ' &lsaquo; ' . __( 'Shortcodes Examples', 'devn' ),
				'menu_title'  => apply_filters( 'su/menu/shortcodes', __( 'Shortcodes', 'devn' ) ),
				'capability'  => 'manage_options',
				'slug'        => 'shortcodes-examples',
				'icon_url'    => THEME_URI.'/cgi/shortcodes/assets/images/icon.png',
				'position'    => '80.11',
				'options'     => array(
					array(
						'type' => 'examples',
						'callback' => array( 'Su_Admin_Views', 'examples' )
					)
				)

			) );

		// Translate plugin meta
		__( 'Shortcodes Ultimate', 'devn' );
		__( 'Vladimir Anokhin', 'devn' );
		__( 'Supercharge your WordPress theme with mega pack of shortcodes', 'devn' );
		// Add plugin actions links
		add_filter( 'plugin_action_links_' . plugin_basename( SU_PLUGIN_FILE ), array( __CLASS__, 'actions_links' ), -10 );
		// Add plugin meta links
		add_filter( 'plugin_row_meta', array( __CLASS__, 'meta_links' ), 10, 2 );
		// Shortcodes Ultimate is ready
		do_action( 'su/init' );
	}

	/**
	 * Plugin activation
	 */
	public static function activation() {

	}

	/**
	 * Plugin deactivation
	 */
	public static function deactivation() {

	}

	/**
	 * Plugin update hook
	 */
	public static function update() {

	}

	/**
	 * Register shortcodes
	 */
	public static function register() {
		// Prepare compatibility mode prefix
		$prefix = su_cmpt();
		// Loop through shortcodes
		foreach ( ( array ) Su_Data::shortcodes() as $id => $data ) {
			if ( isset( $data['function'] ) && is_callable( $data['function'] ) ) $func = $data['function'];
			elseif ( is_callable( array( 'Su_Shortcodes', $id ) ) ) $func = array( 'Su_Shortcodes', $id );
			elseif ( is_callable( array( 'Su_Shortcodes', 'su_' . $id ) ) ) $func = array( 'Su_Shortcodes', 'su_' . $id );
			else continue;
			// Register shortcode
			add_shortcode( $prefix . $id, $func );
		}
		// Register [media] manually // 3.x
		add_shortcode( $prefix . 'media', array( 'Su_Shortcodes', 'media' ) );
	}

	/**
	 * Add timestamp
	 */
	public static function timestamp() {
		if ( !get_option( 'su_installed' ) ) update_option( 'su_installed', time() );
	}

	/**
	 * Create directory /wp-content/uploads/shortcodes-ultimate-skins/ on activation
	 */
	public static function skins_dir() {
		$upload_dir = wp_upload_dir();
		$path = trailingslashit( path_join( $upload_dir['basedir'], 'shortcodes-ultimate-skins' ) );
		if ( !file_exists( $path ) ) mkdir( $path, 0755 );
	}

	/**
	 * Add plugin actions links
	 */
	public static function actions_links( $links ) {
		$links[] = '<a href="' . admin_url( 'admin.php?page=shortcodes-ultimate-examples' ) . '">' . __( 'Examples', 'devn' ) . '</a>';
		$links[] = '<a href="' . admin_url( 'admin.php?page=shortcodes-ultimate' ) . '#tab-0">' . __( 'Where to start?', 'devn' ) . '</a>';
		return $links;
	}

	/**
	 * Add plugin meta links
	 */
	public static function meta_links( $links, $file ) {
		// Check plugin
		return '';
	}
}

/**
 * Register plugin function to perform checks that plugin is installed
 */
function shortcodes_devn() {
	return true;
}

new Shortcodes_Devn;
