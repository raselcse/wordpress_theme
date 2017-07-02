<?php
/**
 * Class for managing plugin data
 */
class Su_Data {

	/**
	 * Constructor
	 */
	function __construct() {}

	/**
	 * Shortcode groups
	 */
	public static function groups() {
		return ( array ) apply_filters( 'su/data/groups', array(
				'all'     => __( 'All', 'devn' ),
				'content' => __( 'Content', 'devn' ),
				'box'     => __( 'Box', 'devn' ),
				'media'   => __( 'Media', 'devn' ),
				'gallery' => __( 'Gallery', 'devn' ),
				'data'    => __( 'Data', 'devn' ),
				'other'   => __( 'Other', 'devn' )
			) );
	}

	/**
	 * Border styles
	 */
	public static function borders() {
		return ( array ) apply_filters( 'su/data/borders', array(
				'none'   => __( 'None', 'devn' ),
				'solid'  => __( 'Solid', 'devn' ),
				'dotted' => __( 'Dotted', 'devn' ),
				'dashed' => __( 'Dashed', 'devn' ),
				'double' => __( 'Double', 'devn' ),
				'groove' => __( 'Groove', 'devn' ),
				'ridge'  => __( 'Ridge', 'devn' )
			) );
	}

	/**
	 * Font-Awesome icons
	 */
	public static function icons() {
		return apply_filters( 'su/data/icons', array( 'glass', 'music', 'search', 'envelope-o', 'heart', 'star', 'star-o', 'user', 'film', 'th-large', 'th', 'th-list', 'check', 'times', 'search-plus', 'search-minus', 'power-off', 'signal', 'cog', 'trash-o', 'home', 'file-o', 'clock-o', 'road', 'download', 'arrow-circle-o-down', 'arrow-circle-o-up', 'inbox', 'play-circle-o', 'repeat', 'refresh', 'list-alt', 'lock', 'flag', 'headphones', 'volume-off', 'volume-down', 'volume-up', 'qrcode', 'barcode', 'tag', 'tags', 'book', 'bookmark', 'print', 'camera', 'font', 'bold', 'italic', 'text-height', 'text-width', 'align-left', 'align-center', 'align-right', 'align-justify', 'list', 'outdent', 'indent', 'video-camera', 'picture-o', 'pencil', 'map-marker', 'adjust', 'tint', 'pencil-square-o', 'share-square-o', 'check-square-o', 'arrows', 'step-backward', 'fast-backward', 'backward', 'play', 'pause', 'stop', 'forward', 'fast-forward', 'step-forward', 'eject', 'chevron-left', 'chevron-right', 'plus-circle', 'minus-circle', 'times-circle', 'check-circle', 'question-circle', 'info-circle', 'crosshairs', 'times-circle-o', 'check-circle-o', 'ban', 'arrow-left', 'arrow-right', 'arrow-up', 'arrow-down', 'share', 'expand', 'compress', 'plus', 'minus', 'asterisk', 'exclamation-circle', 'gift', 'leaf', 'fire', 'eye', 'eye-slash', 'exclamation-triangle', 'plane', 'calendar', 'random', 'comment', 'magnet', 'chevron-up', 'chevron-down', 'retweet', 'shopping-cart', 'folder', 'folder-open', 'arrows-v', 'arrows-h', 'bar-chart-o', 'twitter-square', 'facebook-square', 'camera-retro', 'key', 'cogs', 'comments', 'thumbs-o-up', 'thumbs-o-down', 'star-half', 'heart-o', 'sign-out', 'linkedin-square', 'thumb-tack', 'external-link', 'sign-in', 'trophy', 'github-square', 'upload', 'lemon-o', 'phone', 'square-o', 'bookmark-o', 'phone-square', 'twitter', 'facebook', 'github', 'unlock', 'credit-card', 'rss', 'hdd-o', 'bullhorn', 'bell', 'certificate', 'hand-o-right', 'hand-o-left', 'hand-o-up', 'hand-o-down', 'arrow-circle-left', 'arrow-circle-right', 'arrow-circle-up', 'arrow-circle-down', 'globe', 'wrench', 'tasks', 'filter', 'briefcase', 'arrows-alt', 'users', 'link', 'cloud', 'flask', 'scissors', 'files-o', 'paperclip', 'floppy-o', 'square', 'bars', 'list-ul', 'list-ol', 'strikethrough', 'underline', 'table', 'magic', 'truck', 'pinterest', 'pinterest-square', 'google-plus-square', 'google-plus', 'money', 'caret-down', 'caret-up', 'caret-left', 'caret-right', 'columns', 'sort', 'sort-asc', 'sort-desc', 'envelope', 'linkedin', 'undo', 'gavel', 'tachometer', 'comment-o', 'comments-o', 'bolt', 'sitemap', 'umbrella', 'clipboard', 'lightbulb-o', 'exchange', 'cloud-download', 'cloud-upload', 'user-md', 'stethoscope', 'suitcase', 'bell-o', 'coffee', 'cutlery', 'file-text-o', 'building-o', 'hospital-o', 'ambulance', 'medkit', 'fighter-jet', 'beer', 'h-square', 'plus-square', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-double-down', 'angle-left', 'angle-right', 'angle-up', 'angle-down', 'desktop', 'laptop', 'tablet', 'mobile', 'circle-o', 'quote-left', 'quote-right', 'spinner', 'circle', 'reply', 'github-alt', 'folder-o', 'folder-open-o', 'smile-o', 'frown-o', 'meh-o', 'gamepad', 'keyboard-o', 'flag-o', 'flag-checkered', 'terminal', 'code', 'reply-all', 'mail-reply-all', 'star-half-o', 'location-arrow', 'crop', 'code-fork', 'chain-broken', 'question', 'info', 'exclamation', 'superscript', 'subscript', 'eraser', 'puzzle-piece', 'microphone', 'microphone-slash', 'shield', 'calendar-o', 'fire-extinguisher', 'rocket', 'maxcdn', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-circle-down', 'html5', 'css3', 'anchor', 'unlock-alt', 'bullseye', 'ellipsis-h', 'ellipsis-v', 'rss-square', 'play-circle', 'ticket', 'minus-square', 'minus-square-o', 'level-up', 'level-down', 'check-square', 'pencil-square', 'external-link-square', 'share-square', 'compass', 'caret-square-o-down', 'caret-square-o-up', 'caret-square-o-right', 'eur', 'gbp', 'usd', 'inr', 'jpy', 'rub', 'krw', 'btc', 'file', 'file-text', 'sort-alpha-asc', 'sort-alpha-desc', 'sort-amount-asc', 'sort-amount-desc', 'sort-numeric-asc', 'sort-numeric-desc', 'thumbs-up', 'thumbs-down', 'youtube-square', 'youtube', 'xing', 'xing-square', 'youtube-play', 'dropbox', 'stack-overflow', 'instagram', 'flickr', 'adn', 'bitbucket', 'bitbucket-square', 'tumblr', 'tumblr-square', 'long-arrow-down', 'long-arrow-up', 'long-arrow-left', 'long-arrow-right', 'apple', 'windows', 'android', 'linux', 'dribbble', 'skype', 'foursquare', 'trello', 'female', 'male', 'gittip', 'sun-o', 'moon-o', 'archive', 'bug', 'vk', 'weibo', 'renren', 'pagelines', 'stack-exchange', 'arrow-circle-o-right', 'arrow-circle-o-left', 'caret-square-o-left', 'dot-circle-o', 'wheelchair', 'vimeo-square', 'try', 'plus-square-o' ) );
	}

	/**
	 * Animate.css animations
	 */
	public static function animations() {
		return apply_filters( 'su/data/animations', array( 'flash', 'bounce', 'shake', 'tada', 'swing', 'wobble', 'pulse', 'flip', 'flipInX', 'flipOutX', 'flipInY', 'flipOutY', 'fadeIn', 'fadeInUp', 'fadeInDown', 'fadeInLeft', 'fadeInRight', 'fadeInUpBig', 'fadeInDownBig', 'fadeInLeftBig', 'fadeInRightBig', 'fadeOut', 'fadeOutUp', 'fadeOutDown', 'fadeOutLeft', 'fadeOutRight', 'fadeOutUpBig', 'fadeOutDownBig', 'fadeOutLeftBig', 'fadeOutRightBig', 'slideInDown', 'slideInLeft', 'slideInRight', 'slideOutUp', 'slideOutLeft', 'slideOutRight', 'bounceIn', 'bounceInDown', 'bounceInUp', 'bounceInLeft', 'bounceInRight', 'bounceOut', 'bounceOutDown', 'bounceOutUp', 'bounceOutLeft', 'bounceOutRight', 'rotateIn', 'rotateInDownLeft', 'rotateInDownRight', 'rotateInUpLeft', 'rotateInUpRight', 'rotateOut', 'rotateOutDownLeft', 'rotateOutDownRight', 'rotateOutUpLeft', 'rotateOutUpRight', 'lightSpeedIn', 'lightSpeedOut', 'hinge', 'rollIn', 'rollOut' ) );
	}

	/**
	 * Examples section
	 */
	public static function examples() {
		return ( array ) apply_filters( 'su/data/examples', array(
				'basic' => array(
					'title' => __( 'Basic examples', 'devn' ),
					'items' => array(
						array(
							'name' => __( 'Accordions, spoilers, different styles, anchors', 'devn' ),
							'id'   => 'spoilers',
							'code' => plugin_dir_path( SU_PLUGIN_FILE ) . '/inc/examples/spoilers.example',
							'icon' => 'tasks'
						),
						array(
							'name' => __( 'Tabs, vertical tabs, tab anchors', 'devn' ),
							'id'   => 'tabs',
							'code' => plugin_dir_path( SU_PLUGIN_FILE ) . '/inc/examples/tabs.example',
							'icon' => 'folder'
						),
						array(
							'name' => __( 'Column layouts', 'devn' ),
							'id'   => 'columns',
							'code' => plugin_dir_path( SU_PLUGIN_FILE ) . '/inc/examples/columns.example',
							'icon' => 'th-large'
						),
						array(
							'name' => __( 'Media elements, YouTube, Vimeo, Screenr and self-hosted videos, audio player', 'devn' ),
							'id'   => 'media',
							'code' => plugin_dir_path( SU_PLUGIN_FILE ) . '/inc/examples/media.example',
							'icon' => 'play-circle'
						),
						array(
							'name' => __( 'Unlimited buttons', 'devn' ),
							'id'   => 'buttons',
							'code' => plugin_dir_path( SU_PLUGIN_FILE ) . '/inc/examples/buttons.example',
							'icon' => 'heart'
						),
						array(
							'name' => __( 'Animations', 'devn' ),
							'id'   => 'animations',
							'code' => plugin_dir_path( SU_PLUGIN_FILE ) . '/inc/examples/animations.example',
							'icon' => 'bolt'
						),
					)
				),
				'advanced' => array(
					'title' => __( 'Advanced examples', 'devn' ),
					'items' => array(
						array(
							'name' => __( 'Interacting with posts shortcode', 'devn' ),
							'id' => 'posts',
							'code' => plugin_dir_path( SU_PLUGIN_FILE ) . '/inc/examples/posts.example',
							'icon' => 'list'
						),
						array(
							'name' => __( 'Nested shortcodes, shortcodes inside of attributes', 'devn' ),
							'id' => 'nested',
							'code' => plugin_dir_path( SU_PLUGIN_FILE ) . '/inc/examples/nested.example',
							'icon' => 'indent'
						),
					)
				),
			) );
	}

	/**
	 * Shortcodes
	 */
	public static function shortcodes( $shortcode = false ) {
		$shortcodes = apply_filters( 'su/data/shortcodes', array(
				// Team
				'team' => array(
					'name' => __( 'Our Team', 'devn' ),
					'type' => 'single',
					'group' => 'content',
					'atts' => array(
						'id' => array(
							'default' => '',
							'name' => __( 'Team ID\'s', 'devn' ),
							'desc' => __( 'Enter comma separated ID\'s of the posts that you want to show', 'devn' )
						),
						'category' => array(
							'type' => 'select',
							'multiple' => true,
							'values' => Su_Tools::get_terms( 'category' ),
							'default' => '',
							'name' => __( 'Terms', 'devn' ),
							'desc' => __( 'Select category which you chosen for Team items', 'devn' )
						),
						'column' => array (
							'type' => 'select',
							'values' => array(
								'1' => 1,
								'2' => 2,
								'3' => 3,
								'4' => 4
							),
							'default' => 4,
							'name' => __( 'Items on Row', 'devn' ),
							'desc' => __( 'Choose number of items display on a row', 'devn' )
						),
						'limit_word' => array(
							'default' => '20',
							'name' => __( 'Words', 'devn' ),
							'desc' => __( 'Limit words you want show as short description', 'devn' )
						),
						'limit_item' => array(
							'type' => 'number',
							'min' => -1,
							'max' => 10000,
							'step' => 1,
							'default' => '20',
							'name' => __( 'Limit', 'devn' ),
							'desc' => __( 'Specify number of team that you want to show. Enter -1 to get all team', 'devn' )
						),
						'order' => array(
							'type' => 'select',
							'values' => array(
								'desc' => __( 'Descending', 'devn' ),
								'asc' => __( 'Ascending', 'devn' )
							),
							'default' => 'DESC',
							'name' => __( 'Order', 'devn' ),
							'desc' => __( 'Team order', 'devn' )
						)	
					),
					'desc' => __( 'Our team template', 'devn' ),
					'icon' => 'group'
				),
				'work' => array(
					'name' => __( 'Our Works', 'devn' ),
					'type' => 'single',
					'group' => 'content',
					'atts' => array(
						'tax_term' => array(
							'type' => 'select',
							'multiple' => true,
							'values' => Su_Tools::get_terms( 'category' ),
							'default' => '',
							'name' => __( 'Terms', 'devn' ),
							'desc' => __( 'Select category which you chosen for Team items', 'devn' )
						),
						'filter' => array (
							'type' => 'select',
							'values' => array(
								'Yes' => 'Yes',
								'No' => 'No'
							),
							'default' => 1,
							'name' => __( 'Show Filter', 'devn' ),
							'desc' => __( 'Filter projects by category', 'devn' )
						),
						'column' => array (
							'type' => 'select',
							'values' => array(
								'two' => 2,
								' ' => 3,
								'four' => 4
							),
							'default' => ' ',
							'name' => __( 'Items on Row', 'devn' ),
							'desc' => __( 'Choose number of items display on a row', 'devn' )
						),
						'items' => array(
							'type' => 'number',
							'min' => -1,
							'max' => 10000,
							'step' => 1,
							'default' => get_option( 'posts_per_page' ),
							'name' => __( 'Limit', 'devn' ),
							'desc' => __( 'Specify number of team that you want to show. Enter -1 to get all team', 'devn' )
						),
						'order' => array(
							'type' => 'select',
							'values' => array(
								'desc' => __( 'Descending', 'devn' ),
								'asc' => __( 'Ascending', 'devn' )
							),
							'default' => 'DESC',
							'name' => __( 'Order', 'devn' ),
							'desc' => __( 'Projects order', 'devn' )
						)	
					),
					'desc' => __( 'Our work for portfolio template', 'devn' ),
					'icon' => 'send-o'
				),
				// Testimonials
				'testimonials' => array(
					'name' => __( 'Testimonials', 'devn' ),
					'type' => 'single',
					'group' => 'content',
					'atts' => array(
						'show' => array (
							'type' => 'select',
							'values' => array(
								'slide' => 'slider',
								'slideBigOne' => 'slide big one',
								'list' => 'list'
							),
							'default' => 'slide',
							'name' => __( 'Display Slider or List', 'devn' ),
							'desc' => __( 'Display testimonials as Slider or List items', 'devn' )
						),
						'rounded' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Rounded avatar', 'devn' ),
							'desc' => __( 'Do you want rounded avatar images? Choose Yes / No', 'devn' )
						),
						'col' => array(
							'default' => '2',
							'name' => __( 'Number items', 'devn' ),
							'desc' => __( 'Number items to show on a row of list or slide', 'devn' )
						),
						'items' => array(
							'type' => 'number',
							'min' => -1,
							'max' => 10000,
							'step' => 1,
							'default' => '20',
							'name' => __( 'Limit', 'devn' ),
							'desc' => __( 'Specify number of team that you want to show. Enter -1 to get all team', 'devn' )
						),
						'limit_word' => array(
							'default' => '20',
							'name' => __( 'Words', 'devn' ),
							'desc' => __( 'Limit words you want show as short description', 'devn' )
						),
						
						'order' => array(
							'type' => 'select',
							'values' => array(
								'desc' => __( 'Descending', 'devn' ),
								'asc' => __( 'Ascending', 'devn' )
							),
							'default' => 'DESC',
							'name' => __( 'Order', 'devn' ),
							'desc' => __( 'Team order', 'devn' )
						)	
					),
					'desc' => __( 'Our team template', 'devn' ),
					'icon' => 'group'
				),
				// heading
				'php' => array(
					'name' => __( 'PHP code', 'devn' ),
					'type' => 'wrap',
					'group' => 'content',
					'atts' => array(

					),
					'content' => __( ' ', 'devn' ),
					'desc' => __( 'PHP code customize', 'devn' ),
					'icon' => 'pencil'
				),
				'heading' => array(
					'name' => __( 'Heading', 'devn' ),
					'type' => 'wrap',
					'group' => 'content',
					'atts' => array(
						'style' => array(
							'type' => 'select',
							'values' => array(
								'default' => __( 'Default', 'devn' ),
							),
							'default' => 'default',
							'name' => __( 'Style', 'devn' ),
							'desc' => ''
						),
						'size' => array(
							'type' => 'slider',
							'min' => 7,
							'max' => 48,
							'step' => 1,
							'default' => 13,
							'name' => __( 'Size', 'devn' ),
							'desc' => __( 'Select heading size (pixels)', 'devn' )
						),
						'align' => array(
							'type' => 'select',
							'values' => array(
								'left' => __( 'Left', 'devn' ),
								'center' => __( 'Center', 'devn' ),
								'right' => __( 'Right', 'devn' )
							),
							'default' => 'center',
							'name' => __( 'Align', 'devn' ),
							'desc' => __( 'Heading text alignment', 'devn' )
						),
						'margin' => array(
							'type' => 'slider',
							'min' => 0,
							'max' => 200,
							'step' => 10,
							'default' => 20,
							'name' => __( 'Margin', 'devn' ),
							'desc' => __( 'Bottom margin (pixels)', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( 'Heading text', 'devn' ),
					'desc' => __( 'Styled heading', 'devn' ),
					'icon' => 'h-square'
				),
				// tabs
				'tabs' => array(
					'name' => __( 'Tabs', 'devn' ),
					'type' => 'wrap',
					'group' => 'box',
					'atts' => array(
						'style' => array(
							'type' => 'select',
							'values' => array(
								'default' => __( 'Default', 'devn' )
							),
							'default' => 'default',
							'name' => __( 'Style', 'devn' ),
							'desc' => ''
						),
						'active' => array(
							'type' => 'number',
							'min' => 1,
							'max' => 100,
							'step' => 1,
							'default' => 1,
							'name' => __( 'Active tab', 'devn' ),
							'desc' => __( 'Select which tab is open by default', 'devn' )
						),
						'vertical' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Vertical', 'devn' ),
							'desc' => __( 'Show tabs vertically', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( "[%prefix_tab title=\"Title 1\"]Content 1[/%prefix_tab]\n[%prefix_tab title=\"Title 2\"]Content 2[/%prefix_tab]\n[%prefix_tab title=\"Title 3\"]Content 3[/%prefix_tab]", 'devn' ),
					'desc' => __( 'Tabs container', 'devn' ),
					'example' => 'tabs',
					'icon' => 'list-alt'
				),
				// tab
				'tab' => array(
					'name' => __( 'Tab', 'devn' ),
					'type' => 'wrap',
					'group' => 'box',
					'atts' => array(
						'title' => array(
							'default' => __( 'Tab name', 'devn' ),
							'name' => __( 'Title', 'devn' ),
							'desc' => __( 'Enter tab name', 'devn' )
						),
						'disabled' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Disabled', 'devn' ),
							'desc' => __( 'Is this tab disabled', 'devn' )
						),
						'anchor' => array(
							'default' => '',
							'name' => __( 'Anchor', 'devn' ),
							'desc' => __( 'You can use unique anchor for this tab to access it with hash in page url. For example: type here <b%value>Hello</b> and then use url like http://example.com/page-url#Hello. This tab will be activated and scrolled in', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( 'Tab content', 'devn' ),
					'desc' => __( 'Single tab', 'devn' ),
					'example' => 'tabs',
					'icon' => 'list-alt'
				),
				// spoiler
				'spoiler' => array(
					'name' => __( 'Spoiler', 'devn' ),
					'type' => 'wrap',
					'group' => 'box',
					'atts' => array(
						'title' => array(
							'default' => __( 'Spoiler title', 'devn' ),
							'name' => __( 'Title', 'devn' ), 'desc' => __( 'Text in spoiler title', 'devn' )
						),
						'open' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Open', 'devn' ),
							'desc' => __( 'Is spoiler content visible by default', 'devn' )
						),
						'style' => array(
							'type' => 'select',
							'values' => array(
								'default' => __( 'Default', 'devn' ),
								'fancy' => __( 'Fancy', 'devn' ),
								'simple' => __( 'Simple', 'devn' )
							),
							'default' => 'default',
							'name' => __( 'Style', 'devn' ),
							'desc' => ''
						),
						'icon' => array(
							'type' => 'select',
							'values' => array(
								'plus'           => __( 'Plus', 'devn' ),
								'plus-circle'    => __( 'Plus circle', 'devn' ),
								'plus-square-1'  => __( 'Plus square 1', 'devn' ),
								'plus-square-2'  => __( 'Plus square 2', 'devn' ),
								'arrow'          => __( 'Arrow', 'devn' ),
								'arrow-circle-1' => __( 'Arrow circle 1', 'devn' ),
								'arrow-circle-2' => __( 'Arrow circle 2', 'devn' ),
								'chevron'        => __( 'Chevron', 'devn' ),
								'chevron-circle' => __( 'Chevron circle', 'devn' ),
								'caret'          => __( 'Caret', 'devn' ),
								'caret-square'   => __( 'Caret square', 'devn' ),
								'folder-1'       => __( 'Folder 1', 'devn' ),
								'folder-2'       => __( 'Folder 2', 'devn' )
							),
							'default' => 'plus',
							'name' => __( 'Icon', 'devn' ),
							'desc' => __( 'Icons for spoiler', 'devn' )
						),
						'anchor' => array(
							'default' => '',
							'name' => __( 'Anchor', 'devn' ),
							'desc' => __( 'You can use unique anchor for this spoiler to access it with hash in page url. For example: type here <b%value>Hello</b> and then use url like http://example.com/page-url#Hello. This spoiler will be open and scrolled in', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( 'Hidden content', 'devn' ),
					'desc' => __( 'Spoiler with hidden content', 'devn' ),
					'note' => __( 'Did you know that you can wrap multiple spoilers with [accordion] shortcode to create accordion effect?', 'devn' ),
					'example' => 'spoilers',
					'icon' => 'list-ul'
				),
				// accordion
				'accordion' => array(
					'name' => __( 'Accordion', 'devn' ),
					'type' => 'wrap',
					'group' => 'box',
					'atts' => array(
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( "[%prefix_spoiler]Content[/%prefix_spoiler]\n[%prefix_spoiler]Content[/%prefix_spoiler]\n[%prefix_spoiler]Content[/%prefix_spoiler]", 'devn' ),
					'desc' => __( 'Accordion with spoilers', 'devn' ),
					'note' => __( 'Did you know that you can wrap multiple spoilers with [accordion] shortcode to create accordion effect?', 'devn' ),
					'example' => 'spoilers',
					'icon' => 'list'
				),
				// divider
				'divider' => array(
					'name' => __( 'Divider', 'devn' ),
					'type' => 'single',
					'group' => 'content',
					'atts' => array(
						'top' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Show TOP link', 'devn' ),
							'desc' => __( 'Show link to top of the page or not', 'devn' )
						),
						'text' => array(
							'values' => array( ),
							'default' => __( 'Go to top', 'devn' ),
							'name' => __( 'Link text', 'devn' ), 'desc' => __( 'Text for the GO TOP link', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'Content divider with optional TOP link', 'devn' ),
					'icon' => 'ellipsis-h'
				),
				// spacer
				'spacer' => array(
					'name' => __( 'Spacer', 'devn' ),
					'type' => 'single',
					'group' => 'content other',
					'atts' => array(
						'size' => array(
							'type' => 'slider',
							'min' => 0,
							'max' => 800,
							'step' => 10,
							'default' => 20,
							'name' => __( 'Height', 'devn' ),
							'desc' => __( 'Height of the spacer in pixels', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'Empty space with adjustable height', 'devn' ),
					'icon' => 'arrows-v'
				),
				// highlight
				'highlight' => array(
					'name' => __( 'Highlight', 'devn' ),
					'type' => 'wrap',
					'group' => 'content',
					'atts' => array(
						'background' => array(
							'type' => 'color',
							'values' => array( ),
							'default' => '#DDFF99',
							'name' => __( 'Background', 'devn' ),
							'desc' => __( 'Highlighted text background color', 'devn' )
						),
						'color' => array(
							'type' => 'color',
							'values' => array( ),
							'default' => '#000000',
							'name' => __( 'Text color', 'devn' ), 'desc' => __( 'Highlighted text color', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( 'Highlighted text', 'devn' ),
					'desc' => __( 'Highlighted text', 'devn' ),
					'icon' => 'pencil'
				),
				// label
				'label' => array(
					'name' => __( 'Label', 'devn' ),
					'type' => 'wrap',
					'group' => 'content',
					'atts' => array(
						'type' => array(
							'type' => 'select',
							'values' => array(
								'default' => __( 'Default', 'devn' ),
								'success' => __( 'Success', 'devn' ),
								'warning' => __( 'Warning', 'devn' ),
								'important' => __( 'Important', 'devn' ),
								'black' => __( 'Black', 'devn' ),
								'info' => __( 'Info', 'devn' )
							),
							'default' => 'default',
							'name' => __( 'Type', 'devn' ),
							'desc' => __( 'Style of the label', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( 'Label', 'devn' ),
					'desc' => __( 'Styled label', 'devn' ),
					'icon' => 'tag'
				),
				// quote
				'quote' => array(
					'name' => __( 'Quote', 'devn' ),
					'type' => 'wrap',
					'group' => 'box',
					'atts' => array(
						'style' => array(
							'type' => 'select',
							'values' => array(
								'default' => __( 'Default', 'devn' )
							),
							'default' => 'default',
							'name' => __( 'Style', 'devn' ),
							'desc' => ''
						),
						'cite' => array(
							'default' => '',
							'name' => __( 'Cite', 'devn' ),
							'desc' => __( 'Quote author name', 'devn' )
						),
						'url' => array(
							'values' => array( ),
							'default' => '',
							'name' => __( 'Cite url', 'devn' ),
							'desc' => __( 'Url of the quote author. Leave empty to disable link', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( 'Quote', 'devn' ),
					'desc' => __( 'Blockquote alternative', 'devn' ),
					'icon' => 'quote-right'
				),
				// pullquote
				'pullquote' => array(
					'name' => __( 'Pullquote', 'devn' ),
					'type' => 'wrap',
					'group' => 'box',
					'atts' => array(
						'align' => array(
							'type' => 'select',
							'values' => array(
								'left' => __( 'Left', 'devn' ),
								'right' => __( 'Right', 'devn' )
							),
							'default' => 'left',
							'name' => __( 'Align', 'devn' ), 'desc' => __( 'Pullquote alignment (float)', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( 'Pullquote', 'devn' ),
					'desc' => __( 'Pullquote', 'devn' ),
					'icon' => 'quote-left'
				),
				// dropcap
				'dropcap' => array(
					'name' => __( 'Dropcap', 'devn' ),
					'type' => 'wrap',
					'group' => 'content',
					'atts' => array(
						'style' => array(
							'type' => 'select',
							'values' => array(
								'default' => __( 'Default', 'devn' ),
								'flat' => __( 'Flat', 'devn' ),
								'light' => __( 'Light', 'devn' ),
								'simple' => __( 'Simple', 'devn' )
							),
							'default' => 'default',
							'name' => __( 'Style', 'devn' ), 'desc' => __( 'Dropcap style preset', 'devn' )
						),
						'size' => array(
							'type' => 'slider',
							'min' => 1,
							'max' => 5,
							'step' => 1,
							'default' => 3,
							'name' => __( 'Size', 'devn' ),
							'desc' => __( 'Choose dropcap size', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( 'D', 'devn' ),
					'desc' => __( 'Dropcap', 'devn' ),
					'icon' => 'bold'
				),
				// frame
				'frame' => array(
					'name' => __( 'Frame', 'devn' ),
					'type' => 'wrap',
					'group' => 'content',
					'atts' => array(
						'align' => array(
							'type' => 'select',
							'values' => array(
								'left' => __( 'Left', 'devn' ),
								'center' => __( 'Center', 'devn' ),
								'right' => __( 'Right', 'devn' )
							),
							'default' => 'left',
							'name' => __( 'Align', 'devn' ),
							'desc' => __( 'Frame alignment', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => '<img src="http://lorempixel.com/g/400/200/" />',
					'desc' => __( 'Styled image frame', 'devn' ),
					'icon' => 'picture-o'
				),
				// row
				'row' => array(
					'name' => __( 'Row', 'devn' ),
					'type' => 'wrap',
					'group' => 'box',
					'atts' => array(
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( "[%prefix_column size=\"1/3\"]Content[/%prefix_column]\n[%prefix_column size=\"1/3\"]Content[/%prefix_column]\n[%prefix_column size=\"1/3\"]Content[/%prefix_column]", 'devn' ),
					'desc' => __( 'Row for flexible columns', 'devn' ),
					'icon' => 'columns'
				),
				// column
				'column' => array(
					'name' => __( 'Column', 'devn' ),
					'type' => 'wrap',
					'group' => 'box',
					'atts' => array(
						'size' => array(
							'type' => 'select',
							'values' => array(
								'1/1' => __( 'Full width', 'devn' ),
								'1/2' => __( 'One half', 'devn' ),
								'1/3' => __( 'One third', 'devn' ),
								'2/3' => __( 'Two third', 'devn' ),
								'1/4' => __( 'One fourth', 'devn' ),
								'3/4' => __( 'Three fourth', 'devn' ),
								'1/5' => __( 'One fifth', 'devn' ),
								'2/5' => __( 'Two fifth', 'devn' ),
								'3/5' => __( 'Three fifth', 'devn' ),
								'4/5' => __( 'Four fifth', 'devn' ),
								'1/6' => __( 'One sixth', 'devn' ),
								'5/6' => __( 'Five sixth', 'devn' )
							),
							'default' => '1/2',
							'name' => __( 'Size', 'devn' ),
							'desc' => __( 'Select column width. This width will be calculated depend page width', 'devn' )
						),
						'center' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Centered', 'devn' ),
							'desc' => __( 'Is this column centered on the page', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( 'Column content', 'devn' ),
					'desc' => __( 'Flexible and responsive columns', 'devn' ),
					'note' => __( 'Did you know that you need to wrap columns with [row] shortcode?', 'devn' ),
					'example' => 'columns',
					'icon' => 'columns'
				),
				// list
				'list' => array(
					'name' => __( 'List', 'devn' ),
					'type' => 'wrap',
					'group' => 'content',
					'atts' => array(
						'icon' => array(
							'type' => 'icon',
							'default' => '',
							'name' => __( 'Icon', 'devn' ),
							'desc' => __( 'You can upload custom icon for this list or pick a built-in icon', 'devn' )
						),
						'icon_color' => array(
							'type' => 'color',
							'default' => '#333333',
							'name' => __( 'Icon color', 'devn' ),
							'desc' => __( 'This color will be applied to the selected icon. Does not works with uploaded icons', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( "<ul>\n<li>List item</li>\n<li>List item</li>\n<li>List item</li>\n</ul>", 'devn' ),
					'desc' => __( 'Styled unordered list', 'devn' ),
					'icon' => 'list-ol'
				),
				// button
				'button' => array(
					'name' => __( 'Button', 'devn' ),
					'type' => 'wrap',
					'group' => 'content',
					'atts' => array(
						'url' => array(
							'values' => array( ),
							'default' => home_url(),
							'name' => __( 'Link', 'devn' ),
							'desc' => __( 'Button link', 'devn' )
						),
						'target' => array(
							'type' => 'select',
							'values' => array(
								'self' => __( 'Same tab', 'devn' ),
								'blank' => __( 'New tab', 'devn' )
							),
							'default' => 'self',
							'name' => __( 'Target', 'devn' ),
							'desc' => __( 'Button link target', 'devn' )
						),
						'style' => array(
							'type' => 'select',
							'values' => array(
								'default' => __( 'Default', 'devn' ),
								'flat' => __( 'Flat', 'devn' ),
								'ghost' => __( 'Ghost', 'devn' ),
								'soft' => __( 'Soft', 'devn' ),
								'glass' => __( 'Glass', 'devn' ),
								'bubbles' => __( 'Bubbles', 'devn' ),
								'noise' => __( 'Noise', 'devn' ),
								'stroked' => __( 'Stroked', 'devn' ),
								'3d' => __( '3D', 'devn' )
							),
							'default' => 'default',
							'name' => __( 'Style', 'devn' ), 'desc' => __( 'Button background style preset', 'devn' )
						),
						'background' => array(
							'type' => 'color',
							'values' => array( ),
							'default' => '#2D89EF',
							'name' => __( 'Background', 'devn' ), 'desc' => __( 'Button background color', 'devn' )
						),
						'color' => array(
							'type' => 'color',
							'values' => array( ),
							'default' => '#FFFFFF',
							'name' => __( 'Text color', 'devn' ),
							'desc' => __( 'Button text color', 'devn' )
						),
						'size' => array(
							'type' => 'slider',
							'min' => 1,
							'max' => 20,
							'step' => 1,
							'default' => 3,
							'name' => __( 'Size', 'devn' ),
							'desc' => __( 'Button size', 'devn' )
						),
						'wide' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Fluid', 'devn' ), 'desc' => __( 'Fluid buttons has 100% width', 'devn' )
						),
						'center' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Centered', 'devn' ), 'desc' => __( 'Is button centered on the page', 'devn' )
						),
						'radius' => array(
							'type' => 'select',
							'values' => array(
								'auto' => __( 'Auto', 'devn' ),
								'round' => __( 'Round', 'devn' ),
								'0' => __( 'Square', 'devn' ),
								'5' => '5px',
								'10' => '10px',
								'20' => '20px'
							),
							'default' => 'auto',
							'name' => __( 'Radius', 'devn' ),
							'desc' => __( 'Radius of button corners. Auto-radius calculation based on button size', 'devn' )
						),
						'icon' => array(
							'type' => 'icon',
							'default' => '',
							'name' => __( 'Icon', 'devn' ),
							'desc' => __( 'You can upload custom icon for this button or pick a built-in icon', 'devn' )
						),
						'icon_color' => array(
							'type' => 'color',
							'default' => '#FFFFFF',
							'name' => __( 'Icon color', 'devn' ),
							'desc' => __( 'This color will be applied to the selected icon. Does not works with uploaded icons', 'devn' )
						),
						'text_shadow' => array(
							'type' => 'shadow',
							'default' => 'none',
							'name' => __( 'Text shadow', 'devn' ),
							'desc' => __( 'Button text shadow', 'devn' )
						),
						'desc' => array(
							'default' => '',
							'name' => __( 'Description', 'devn' ),
							'desc' => __( 'Small description under button text. This option is incompatible with icon.', 'devn' )
						),
						'onclick' => array(
							'default' => '',
							'name' => __( 'onClick', 'devn' ),
							'desc' => __( 'Advanced JavaScript code for onClick action', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( 'Button text', 'devn' ),
					'desc' => __( 'Styled button', 'devn' ),
					'example' => 'buttons',
					'icon' => 'heart'
				),
				// service
				'service' => array(
					'name' => __( 'Service', 'devn' ),
					'type' => 'wrap',
					'group' => 'box',
					'atts' => array(
						'title' => array(
							'values' => array( ),
							'default' => __( 'Service title', 'devn' ),
							'name' => __( 'Title', 'devn' ),
							'desc' => __( 'Service name', 'devn' )
						),
						'icon' => array(
							'type' => 'icon',
							'default' => '',
							'name' => __( 'Icon', 'devn' ),
							'desc' => __( 'You can upload custom icon for this box', 'devn' )
						),
						'icon_color' => array(
							'type' => 'color',
							'default' => '#333333',
							'name' => __( 'Icon color', 'devn' ),
							'desc' => __( 'This color will be applied to the selected icon. Does not works with uploaded icons', 'devn' )
						),
						'size' => array(
							'type' => 'slider',
							'min' => 10,
							'max' => 128,
							'step' => 2,
							'default' => 32,
							'name' => __( 'Icon size', 'devn' ),
							'desc' => __( 'Size of the uploaded icon in pixels', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( 'Service description', 'devn' ),
					'desc' => __( 'Service box with title', 'devn' ),
					'icon' => 'check-square-o'
				),
				// box
				'box' => array(
					'name' => __( 'Box', 'devn' ),
					'type' => 'wrap',
					'group' => 'box',
					'atts' => array(
						'title' => array(
							'values' => array( ),
							'default' => __( 'Box title', 'devn' ),
							'name' => __( 'Title', 'devn' ), 'desc' => __( 'Text for the box title', 'devn' )
						),
						'style' => array(
							'type' => 'select',
							'values' => array(
								'default' => __( 'Default', 'devn' ),
								'soft' => __( 'Soft', 'devn' ),
								'glass' => __( 'Glass', 'devn' ),
								'bubbles' => __( 'Bubbles', 'devn' ),
								'noise' => __( 'Noise', 'devn' )
							),
							'default' => 'default',
							'name' => __( 'Style', 'devn' ),
							'desc' => __( 'Box style preset', 'devn' )
						),
						'box_color' => array(
							'type' => 'color',
							'values' => array( ),
							'default' => '#333333',
							'name' => __( 'Color', 'devn' ),
							'desc' => __( 'Color for the box title and borders', 'devn' )
						),
						'title_color' => array(
							'type' => 'color',
							'values' => array( ),
							'default' => '#FFFFFF',
							'name' => __( 'Title text color', 'devn' ), 'desc' => __( 'Color for the box title text', 'devn' )
						),
						'radius' => array(
							'type' => 'slider',
							'min' => 0,
							'max' => 20,
							'step' => 1,
							'default' => 3,
							'name' => __( 'Radius', 'devn' ),
							'desc' => __( 'Box corners radius', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( 'Box content', 'devn' ),
					'desc' => __( 'Colored box with caption', 'devn' ),
					'icon' => 'list-alt'
				),
				// note
				'note' => array(
					'name' => __( 'Note', 'devn' ),
					'type' => 'wrap',
					'group' => 'box',
					'atts' => array(
						'note_color' => array(
							'type' => 'color',
							'values' => array( ),
							'default' => '#FFFF66',
							'name' => __( 'Background', 'devn' ), 'desc' => __( 'Note background color', 'devn' )
						),
						'text_color' => array(
							'type' => 'color',
							'values' => array( ),
							'default' => '#333333',
							'name' => __( 'Text color', 'devn' ),
							'desc' => __( 'Note text color', 'devn' )
						),
						'radius' => array(
							'type' => 'slider',
							'min' => 0,
							'max' => 20,
							'step' => 1,
							'default' => 3,
							'name' => __( 'Radius', 'devn' ), 'desc' => __( 'Note corners radius', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( 'Note text', 'devn' ),
					'desc' => __( 'Colored box', 'devn' ),
					'icon' => 'list-alt'
				),
				// lightbox
				'lightbox' => array(
					'name' => __( 'Lightbox', 'devn' ),
					'type' => 'wrap',
					'group' => 'gallery',
					'atts' => array(
						'type' => array(
							'type' => 'select',
							'values' => array(
								'iframe' => __( 'Iframe', 'devn' ),
								'image' => __( 'Image', 'devn' ),
								'inline' => __( 'Inline (html content)', 'devn' )
							),
							'default' => 'iframe',
							'name' => __( 'Content type', 'devn' ),
							'desc' => __( 'Select type of the lightbox window content', 'devn' )
						),
						'src' => array(
							'default' => '',
							'name' => __( 'Content source', 'devn' ),
							'desc' => __( 'Insert here URL or CSS selector. Use URL for Iframe and Image content types. Use CSS selector for Inline content type.<br />Example values:<br /><b%value>http://www.youtube.com/watch?v=XXXXXXXXX</b> - YouTube video (iframe)<br /><b%value>http://example.com/wp-content/uploads/image.jpg</b> - uploaded image (image)<br /><b%value>http://example.com/</b> - any web page (iframe)<br /><b%value>#contact-form</b> - any HTML content (inline)', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( '[%prefix_button] Click Here to Watch the Video [/%prefix_button]', 'devn' ),
					'desc' => __( 'Lightbox window with custom content', 'devn' ),
					'icon' => 'external-link'
				),
				// tooltip
				'tooltip' => array(
					'name' => __( 'Tooltip', 'devn' ),
					'type' => 'wrap',
					'group' => 'other',
					'atts' => array(
						'style' => array(
							'type' => 'select',
							'values' => array(
								'light' => __( 'Basic: Light', 'devn' ),
								'dark' => __( 'Basic: Dark', 'devn' ),
								'yellow' => __( 'Basic: Yellow', 'devn' ),
								'green' => __( 'Basic: Green', 'devn' ),
								'red' => __( 'Basic: Red', 'devn' ),
								'blue' => __( 'Basic: Blue', 'devn' ),
								'youtube' => __( 'Youtube', 'devn' ),
								'tipsy' => __( 'Tipsy', 'devn' ),
								'bootstrap' => __( 'Bootstrap', 'devn' ),
								'jtools' => __( 'jTools', 'devn' ),
								'tipped' => __( 'Tipped', 'devn' ),
								'cluetip' => __( 'Cluetip', 'devn' ),
							),
							'default' => 'yellow',
							'name' => __( 'Style', 'devn' ),
							'desc' => __( 'Tooltip window style', 'devn' )
						),
						'position' => array(
							'type' => 'select',
							'values' => array(
								'north' => __( 'Top', 'devn' ),
								'south' => __( 'Bottom', 'devn' ),
								'west' => __( 'Left', 'devn' ),
								'east' => __( 'Right', 'devn' )
							),
							'default' => 'top',
							'name' => __( 'Position', 'devn' ),
							'desc' => __( 'Tooltip position', 'devn' )
						),
						'shadow' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Shadow', 'devn' ),
							'desc' => __( 'Add shadow to tooltip. This option is only works with basic styes, e.g. blue, green etc.', 'devn' )
						),
						'rounded' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Rounded corners', 'devn' ),
							'desc' => __( 'Use rounded for tooltip. This option is only works with basic styes, e.g. blue, green etc.', 'devn' )
						),
						'size' => array(
							'type' => 'select',
							'values' => array(
								'default' => __( 'Default', 'devn' ),
								'1' => 1,
								'2' => 2,
								'3' => 3,
								'4' => 4,
								'5' => 5,
								'6' => 6,
							),
							'default' => 'default',
							'name' => __( 'Font size', 'devn' ),
							'desc' => __( 'Tooltip font size', 'devn' )
						),
						'title' => array(
							'default' => '',
							'name' => __( 'Tooltip title', 'devn' ),
							'desc' => __( 'Enter title for tooltip window. Leave this field empty to hide the title', 'devn' )
						),
						'content' => array(
							'default' => __( 'Tooltip text', 'devn' ),
							'name' => __( 'Tooltip content', 'devn' ),
							'desc' => __( 'Enter tooltip content here', 'devn' )
						),
						'behavior' => array(
							'type' => 'select',
							'values' => array(
								'hover' => __( 'Show and hide on mouse hover', 'devn' ),
								'click' => __( 'Show and hide by mouse click', 'devn' ),
								'always' => __( 'Always visible', 'devn' )
							),
							'default' => 'hover',
							'name' => __( 'Behavior', 'devn' ),
							'desc' => __( 'Select tooltip behavior', 'devn' )
						),
						'close' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Close button', 'devn' ),
							'desc' => __( 'Show close button', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( '[%prefix_button] Hover me to open tooltip [/%prefix_button]', 'devn' ),
					'desc' => __( 'Tooltip window with custom content', 'devn' ),
					'icon' => 'comment-o'
				),
				// private
				'private' => array(
					'name' => __( 'Private', 'devn' ),
					'type' => 'wrap',
					'group' => 'other',
					'atts' => array(
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( 'Private note text', 'devn' ),
					'desc' => __( 'Private note for post authors', 'devn' ),
					'icon' => 'lock'
				),
				// youtube
				'youtube' => array(
					'name' => __( 'YouTube', 'devn' ),
					'type' => 'single',
					'group' => 'media',
					'atts' => array(
						'url' => array(
							'values' => array( ),
							'default' => '',
							'name' => __( 'Url', 'devn' ),
							'desc' => __( 'Url of YouTube page with video. Ex: http://youtube.com/watch?v=XXXXXX', 'devn' )
						),
						'width' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 600,
							'name' => __( 'Width', 'devn' ),
							'desc' => __( 'Player width', 'devn' )
						),
						'height' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 400,
							'name' => __( 'Height', 'devn' ),
							'desc' => __( 'Player height', 'devn' )
						),
						'responsive' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Responsive', 'devn' ),
							'desc' => __( 'Ignore width and height parameters and make player responsive', 'devn' )
						),
						'autoplay' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Autoplay', 'devn' ),
							'desc' => __( 'Play video automatically when page is loaded', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'YouTube video', 'devn' ),
					'example' => 'media',
					'icon' => 'youtube-play'
				),
				// youtube_advanced
				'youtube_advanced' => array(
					'name' => __( 'YouTube Advanced', 'devn' ),
					'type' => 'single',
					'group' => 'media',
					'atts' => array(
						'url' => array(
							'values' => array( ),
							'default' => '',
							'name' => __( 'Url', 'devn' ),
							'desc' => __( 'Url of YouTube page with video. Ex: http://youtube.com/watch?v=XXXXXX', 'devn' )
						),
						'playlist' => array(
							'default' => '',
							'name' => __( 'Playlist', 'devn' ),
							'desc' => __( 'Value is a comma-separated list of video IDs to play. If you specify a value, the first video that plays will be the VIDEO_ID specified in the URL path, and the videos specified in the playlist parameter will play thereafter', 'devn' )
						),
						'width' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 600,
							'name' => __( 'Width', 'devn' ),
							'desc' => __( 'Player width', 'devn' )
						),
						'height' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 400,
							'name' => __( 'Height', 'devn' ),
							'desc' => __( 'Player height', 'devn' )
						),
						'responsive' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Responsive', 'devn' ),
							'desc' => __( 'Ignore width and height parameters and make player responsive', 'devn' )
						),
						'controls' => array(
							'type' => 'select',
							'values' => array(
								'no' => __( '0 - Hide controls', 'devn' ),
								'yes' => __( '1 - Show controls', 'devn' ),
								'alt' => __( '2 - Show controls when playback is started', 'devn' )
							),
							'default' => 'yes',
							'name' => __( 'Controls', 'devn' ),
							'desc' => __( 'This parameter indicates whether the video player controls will display', 'devn' )
						),
						'autohide' => array(
							'type' => 'select',
							'values' => array(
								'no' => __( '0 - Do not hide controls', 'devn' ),
								'yes' => __( '1 - Hide all controls on mouse out', 'devn' ),
								'alt' => __( '2 - Hide progress bar on mouse out', 'devn' )
							),
							'default' => 'alt',
							'name' => __( 'Autohide', 'devn' ),
							'desc' => __( 'This parameter indicates whether the video controls will automatically hide after a video begins playing', 'devn' )
						),
						'showinfo' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Show title bar', 'devn' ),
							'desc' => __( 'If you set the parameter value to NO, then the player will not display information like the video title and uploader before the video starts playing.', 'devn' )
						),
						'autoplay' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Autoplay', 'devn' ),
							'desc' => __( 'Play video automatically when page is loaded', 'devn' )
						),
						'loop' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Loop', 'devn' ),
							'desc' => __( 'Setting of YES will cause the player to play the initial video again and again', 'devn' )
						),
						'rel' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Related videos', 'devn' ),
							'desc' => __( 'This parameter indicates whether the player should show related videos when playback of the initial video ends', 'devn' )
						),
						'fs' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Show full-screen button', 'devn' ),
							'desc' => __( 'Setting this parameter to NO prevents the fullscreen button from displaying', 'devn' )
						),
						'modestbranding' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => 'modestbranding',
							'desc' => __( 'This parameter lets you use a YouTube player that does not show a YouTube logo. Set the parameter value to YES to prevent the YouTube logo from displaying in the control bar. Note that a small YouTube text label will still display in the upper-right corner of a paused video when the user\'s mouse pointer hovers over the player', 'devn' )
						),
						'theme' => array(
							'type' => 'select',
							'values' => array(
								'dark' => __( 'Dark theme', 'devn' ),
								'light' => __( 'Light theme', 'devn' )
							),
							'default' => 'dark',
							'name' => __( 'Theme', 'devn' ),
							'desc' => __( 'This parameter indicates whether the embedded player will display player controls (like a play button or volume control) within a dark or light control bar', 'devn' )
						),
						'https' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Force HTTPS', 'devn' ),
							'desc' => __( 'Use HTTPS in player iframe', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'YouTube video player with advanced settings', 'devn' ),
					'example' => 'media',
					'icon' => 'youtube-play'
				),
				// vimeo
				'vimeo' => array(
					'name' => __( 'Vimeo', 'devn' ),
					'type' => 'single',
					'group' => 'media',
					'atts' => array(
						'url' => array(
							'values' => array( ),
							'default' => '',
							'name' => __( 'Url', 'devn' ), 'desc' => __( 'Url of Vimeo page with video', 'devn' )
						),
						'width' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 600,
							'name' => __( 'Width', 'devn' ),
							'desc' => __( 'Player width', 'devn' )
						),
						'height' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 400,
							'name' => __( 'Height', 'devn' ),
							'desc' => __( 'Player height', 'devn' )
						),
						'responsive' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Responsive', 'devn' ),
							'desc' => __( 'Ignore width and height parameters and make player responsive', 'devn' )
						),
						'autoplay' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Autoplay', 'devn' ),
							'desc' => __( 'Play video automatically when page is loaded', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'Vimeo video', 'devn' ),
					'example' => 'media',
					'icon' => 'youtube-play'
				),
				// screenr
				'screenr' => array(
					'name' => __( 'Screenr', 'devn' ),
					'type' => 'single',
					'group' => 'media',
					'atts' => array(
						'url' => array(
							'default' => '',
							'name' => __( 'Url', 'devn' ),
							'desc' => __( 'Url of Screenr page with video', 'devn' )
						),
						'width' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 600,
							'name' => __( 'Width', 'devn' ),
							'desc' => __( 'Player width', 'devn' )
						),
						'height' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 400,
							'name' => __( 'Height', 'devn' ),
							'desc' => __( 'Player height', 'devn' )
						),
						'responsive' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Responsive', 'devn' ),
							'desc' => __( 'Ignore width and height parameters and make player responsive', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'Screenr video', 'devn' ),
					'icon' => 'youtube-play'
				),
				// dailymotion
				'dailymotion' => array(
					'name' => __( 'Dailymotion', 'devn' ),
					'type' => 'single',
					'group' => 'media',
					'atts' => array(
						'url' => array(
							'default' => '',
							'name' => __( 'Url', 'devn' ),
							'desc' => __( 'Url of Dailymotion page with video', 'devn' )
						),
						'width' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 600,
							'name' => __( 'Width', 'devn' ),
							'desc' => __( 'Player width', 'devn' )
						),
						'height' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 400,
							'name' => __( 'Height', 'devn' ),
							'desc' => __( 'Player height', 'devn' )
						),
						'responsive' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Responsive', 'devn' ),
							'desc' => __( 'Ignore width and height parameters and make player responsive', 'devn' )
						),
						'autoplay' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Autoplay', 'devn' ),
							'desc' => __( 'Start the playback of the video automatically after the player load. May not work on some mobile OS versions', 'devn' )
						),
						'background' => array(
							'type' => 'color',
							'default' => '#FFC300',
							'name' => __( 'Background color', 'devn' ),
							'desc' => __( 'HTML color of the background of controls elements', 'devn' )
						),
						'foreground' => array(
							'type' => 'color',
							'default' => '#F7FFFD',
							'name' => __( 'Foreground color', 'devn' ),
							'desc' => __( 'HTML color of the foreground of controls elements', 'devn' )
						),
						'highlight' => array(
							'type' => 'color',
							'default' => '#171D1B',
							'name' => __( 'Highlight color', 'devn' ),
							'desc' => __( 'HTML color of the controls elements\' highlights', 'devn' )
						),
						'logo' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Show logo', 'devn' ),
							'desc' => __( 'Allows to hide or show the Dailymotion logo', 'devn' )
						),
						'quality' => array(
							'type' => 'select',
							'values' => array(
								'240'  => '240',
								'380'  => '380',
								'480'  => '480',
								'720'  => '720',
								'1080' => '1080'
							),
							'default' => '380',
							'name' => __( 'Quality', 'devn' ),
							'desc' => __( 'Determines the quality that must be played by default if available', 'devn' )
						),
						'related' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Show related videos', 'devn' ),
							'desc' => __( 'Show related videos at the end of the video', 'devn' )
						),
						'info' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Show video info', 'devn' ),
							'desc' => __( 'Show videos info (title/author) on the start screen', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'Dailymotion video', 'devn' ),
					'icon' => 'youtube-play'
				),
				// audio
				'audio' => array(
					'name' => __( 'Audio', 'devn' ),
					'type' => 'single',
					'group' => 'media',
					'atts' => array(
						'url' => array(
							'type' => 'upload',
							'default' => '',
							'name' => __( 'File', 'devn' ),
							'desc' => __( 'Audio file url. Supported formats: mp3, ogg', 'devn' )
						),
						'width' => array(
							'values' => array(),
							'default' => '100%',
							'name' => __( 'Width', 'devn' ),
							'desc' => __( 'Player width. You can specify width in percents and player will be responsive. Example values: <b%value>200px</b>, <b%value>100&#37;</b>', 'devn' )
						),
						'autoplay' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Autoplay', 'devn' ),
							'desc' => __( 'Play file automatically when page is loaded', 'devn' )
						),
						'loop' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Loop', 'devn' ),
							'desc' => __( 'Repeat when playback is ended', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'Custom audio player', 'devn' ),
					'example' => 'media',
					'icon' => 'play-circle'
				),
				// video
				'video' => array(
					'name' => __( 'Video', 'devn' ),
					'type' => 'single',
					'group' => 'media',
					'atts' => array(
						'url' => array(
							'type' => 'upload',
							'default' => '',
							'name' => __( 'File', 'devn' ),
							'desc' => __( 'Url to mp4/flv video-file', 'devn' )
						),
						'poster' => array(
							'type' => 'upload',
							'default' => '',
							'name' => __( 'Poster', 'devn' ),
							'desc' => __( 'Url to poster image, that will be shown before playback', 'devn' )
						),
						'title' => array(
							'values' => array( ),
							'default' => '',
							'name' => __( 'Title', 'devn' ),
							'desc' => __( 'Player title', 'devn' )
						),
						'width' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 600,
							'name' => __( 'Width', 'devn' ),
							'desc' => __( 'Player width', 'devn' )
						),
						'height' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 300,
							'name' => __( 'Height', 'devn' ),
							'desc' => __( 'Player height', 'devn' )
						),
						'controls' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Controls', 'devn' ),
							'desc' => __( 'Show player controls (play/pause etc.) or not', 'devn' )
						),
						'autoplay' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Autoplay', 'devn' ),
							'desc' => __( 'Play file automatically when page is loaded', 'devn' )
						),
						'loop' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Loop', 'devn' ),
							'desc' => __( 'Repeat when playback is ended', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'Custom video player', 'devn' ),
					'example' => 'media',
					'icon' => 'play-circle'
				),
				// table
				'table' => array(
					'name' => __( 'Table', 'devn' ),
					'type' => 'mixed',
					'group' => 'content',
					'atts' => array(
						'url' => array(
							'type' => 'upload',
							'default' => '',
							'name' => __( 'CSV file', 'devn' ),
							'desc' => __( 'Upload CSV file if you want to create HTML-table from file', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( "<table>\n<tr>\n\t<td>Table</td>\n\t<td>Table</td>\n</tr>\n<tr>\n\t<td>Table</td>\n\t<td>Table</td>\n</tr>\n</table>", 'devn' ),
					'desc' => __( 'Styled table from HTML or CSV file', 'devn' ),
					'icon' => 'table'
				),
				// permalink
				'permalink' => array(
					'name' => __( 'Permalink', 'devn' ),
					'type' => 'mixed',
					'group' => 'content other',
					'atts' => array(
						'id' => array(
							'values' => array( ), 'default' => 1,
							'name' => __( 'ID', 'devn' ),
							'desc' => __( 'Post or page ID', 'devn' )
						),
						'target' => array(
							'type' => 'select',
							'values' => array(
								'self' => __( 'Same tab', 'devn' ),
								'blank' => __( 'New tab', 'devn' )
							),
							'default' => 'self',
							'name' => __( 'Target', 'devn' ),
							'desc' => __( 'Link target. blank - link will be opened in new window/tab', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => '',
					'desc' => __( 'Permalink to specified post/page', 'devn' ),
					'icon' => 'link'
				),
				// members
				'members' => array(
					'name' => __( 'Members', 'devn' ),
					'type' => 'wrap',
					'group' => 'other',
					'atts' => array(
						'message' => array(
							'default' => __( 'This content is for registered users only. Please %login%.', 'devn' ),
							'name' => __( 'Message', 'devn' ), 'desc' => __( 'Message for not logged users', 'devn' )
						),
						'color' => array(
							'type' => 'color',
							'default' => '#ffcc00',
							'name' => __( 'Box color', 'devn' ), 'desc' => __( 'This color will applied only to box for not logged users', 'devn' )
						),
						'login_text' => array(
							'default' => __( 'login', 'devn' ),
							'name' => __( 'Login link text', 'devn' ), 'desc' => __( 'Text for the login link', 'devn' )
						),
						'login_url' => array(
							'default' => wp_login_url(),
							'name' => __( 'Login link url', 'devn' ), 'desc' => __( 'Login link url', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( 'Content for logged members', 'devn' ),
					'desc' => __( 'Content for logged in members only', 'devn' ),
					'icon' => 'lock'
				),
				// guests
				'guests' => array(
					'name' => __( 'Guests', 'devn' ),
					'type' => 'wrap',
					'group' => 'other',
					'atts' => array(
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( 'Content for guests', 'devn' ),
					'desc' => __( 'Content for guests only', 'devn' ),
					'icon' => 'user'
				),
				// feed
				'feed' => array(
					'name' => __( 'RSS Feed', 'devn' ),
					'type' => 'single',
					'group' => 'content other',
					'atts' => array(
						'url' => array(
							'values' => array( ),
							'default' => '',
							'name' => __( 'Url', 'devn' ),
							'desc' => __( 'Url to RSS-feed', 'devn' )
						),
						'limit' => array(
							'type' => 'slider',
							'min' => 1,
							'max' => 20,
							'step' => 1,
							'default' => 3,
							'name' => __( 'Limit', 'devn' ), 'desc' => __( 'Number of items to show', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'Feed grabber', 'devn' ),
					'icon' => 'rss'
				),
				// menu
				'menu' => array(
					'name' => __( 'Menu', 'devn' ),
					'type' => 'single',
					'group' => 'other',
					'atts' => array(
						'name' => array(
							'values' => array( ),
							'default' => '',
							'name' => __( 'Menu name', 'devn' ), 'desc' => __( 'Custom menu name. Ex: Main menu', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'Custom menu by name', 'devn' ),
					'icon' => 'bars'
				),
				// subpages
				'subpages' => array(
					'name' => __( 'Sub pages', 'devn' ),
					'type' => 'single',
					'group' => 'other',
					'atts' => array(
						'depth' => array(
							'type' => 'select',
							'values' => array( 1, 2, 3, 4, 5 ), 'default' => 1,
							'name' => __( 'Depth', 'devn' ),
							'desc' => __( 'Max depth level of children pages', 'devn' )
						),
						'p' => array(
							'values' => array( ),
							'default' => '',
							'name' => __( 'Parent ID', 'devn' ),
							'desc' => __( 'ID of the parent page. Leave blank to use current page', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'List of sub pages', 'devn' ),
					'icon' => 'bars'
				),
				// siblings
				'siblings' => array(
					'name' => __( 'Siblings', 'devn' ),
					'type' => 'single',
					'group' => 'other',
					'atts' => array(
						'depth' => array(
							'type' => 'select',
							'values' => array( 1, 2, 3 ), 'default' => 1,
							'name' => __( 'Depth', 'devn' ),
							'desc' => __( 'Max depth level', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'List of cureent page siblings', 'devn' ),
					'icon' => 'bars'
				),
				// document
				'document' => array(
					'name' => __( 'Document', 'devn' ),
					'type' => 'single',
					'group' => 'media',
					'atts' => array(
						'url' => array(
							'type' => 'upload',
							'default' => '',
							'name' => __( 'Url', 'devn' ),
							'desc' => __( 'Url to uploaded document. Supported formats: doc, xls, pdf etc.', 'devn' )
						),
						'width' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 600,
							'name' => __( 'Width', 'devn' ),
							'desc' => __( 'Viewer width', 'devn' )
						),
						'height' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 600,
							'name' => __( 'Height', 'devn' ),
							'desc' => __( 'Viewer height', 'devn' )
						),
						'responsive' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Responsive', 'devn' ),
							'desc' => __( 'Ignore width and height parameters and make viewer responsive', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'Document viewer by Google', 'devn' ),
					'icon' => 'file-text'
				),
				// gmap
				'gmap' => array(
					'name' => __( 'Gmap', 'devn' ),
					'type' => 'single',
					'group' => 'media',
					'atts' => array(
						'width' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 600,
							'name' => __( 'Width', 'devn' ),
							'desc' => __( 'Map width', 'devn' )
						),
						'height' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 400,
							'name' => __( 'Height', 'devn' ),
							'desc' => __( 'Map height', 'devn' )
						),
						'responsive' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Responsive', 'devn' ),
							'desc' => __( 'Ignore width and height parameters and make map responsive', 'devn' )
						),
						'address' => array(
							'values' => array( ),
							'default' => '',
							'name' => __( 'Marker', 'devn' ),
							'desc' => __( 'Address for the marker. You can type it in any language', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'Maps by Google', 'devn' ),
					'icon' => 'globe'
				),
				// slider
				'slider' => array(
					'name' => __( 'Slider', 'devn' ),
					'type' => 'single',
					'group' => 'gallery',
					'atts' => array(
						'source' => array(
							'type'    => 'image_source',
							'default' => 'none',
							'name'    => __( 'Source', 'devn' ),
							'desc'    => __( 'Choose images source. You can use images from Media library or retrieve it from posts (thumbnails) posted under specified blog category. You can also pick any custom taxonomy', 'devn' )
						),
						'limit' => array(
							'type' => 'slider',
							'min' => -1,
							'max' => 100,
							'step' => 1,
							'default' => 20,
							'name' => __( 'Limit', 'devn' ),
							'desc' => __( 'Maximum number of image source posts (for recent posts, category and custom taxonomy)', 'devn' )
						),
						'link' => array(
							'type' => 'select',
							'values' => array(
								'none'       => __( 'None', 'devn' ),
								'image'      => __( 'Full-size image', 'devn' ),
								'lightbox'   => __( 'Lightbox', 'devn' ),
								'custom'     => __( 'Slide link (added in media editor)', 'devn' ),
								'attachment' => __( 'Attachment page', 'devn' ),
								'post'       => __( 'Post permalink', 'devn' )
							),
							'default' => 'none',
							'name' => __( 'Links', 'devn' ),
							'desc' => __( 'Select which links will be used for images in this gallery', 'devn' )
						),
						'target' => array(
							'type' => 'select',
							'values' => array(
								'self' => __( 'Same window', 'devn' ),
								'blank' => __( 'New window', 'devn' )
							),
							'default' => 'self',
							'name' => __( 'Links target', 'devn' ),
							'desc' => __( 'Open links in', 'devn' )
						),
						'width' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 600,
							'name' => __( 'Width', 'devn' ), 'desc' => __( 'Slider width (in pixels)', 'devn' )
						),
						'height' => array(
							'type' => 'slider',
							'min' => 200,
							'max' => 1600,
							'step' => 20,
							'default' => 300,
							'name' => __( 'Height', 'devn' ), 'desc' => __( 'Slider height (in pixels)', 'devn' )
						),
						'responsive' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Responsive', 'devn' ),
							'desc' => __( 'Ignore width and height parameters and make slider responsive', 'devn' )
						),
						'title' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Show titles', 'devn' ), 'desc' => __( 'Display slide titles', 'devn' )
						),
						'centered' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Center', 'devn' ), 'desc' => __( 'Is slider centered on the page', 'devn' )
						),
						'arrows' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Arrows', 'devn' ), 'desc' => __( 'Show left and right arrows', 'devn' )
						),
						'pages' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Pagination', 'devn' ),
							'desc' => __( 'Show pagination', 'devn' )
						),
						'mousewheel' => array(
							'type' => 'bool',
							'default' => 'yes', 'name' => __( 'Mouse wheel control', 'devn' ),
							'desc' => __( 'Allow to change slides with mouse wheel', 'devn' )
						),
						'autoplay' => array(
							'type' => 'number',
							'min' => 0,
							'max' => 100000,
							'step' => 100,
							'default' => 5000,
							'name' => __( 'Autoplay', 'devn' ),
							'desc' => __( 'Choose interval between slide animations. Set to 0 to disable autoplay', 'devn' )
						),
						'speed' => array(
							'type' => 'number',
							'min' => 0,
							'max' => 20000,
							'step' => 100,
							'default' => 600,
							'name' => __( 'Speed', 'devn' ), 'desc' => __( 'Specify animation speed', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'Customizable image slider', 'devn' ),
					'icon' => 'picture-o'
				),
				// carousel
				'carousel' => array(
					'name' => __( 'Carousel', 'devn' ),
					'type' => 'single',
					'group' => 'gallery',
					'atts' => array(
						'source' => array(
							'type'    => 'image_source',
							'default' => 'none',
							'name'    => __( 'Source', 'devn' ),
							'desc'    => __( 'Choose images source. You can use images from Media library or retrieve it from posts (thumbnails) posted under specified blog category. You can also pick any custom taxonomy', 'devn' )
						),
						'limit' => array(
							'type' => 'slider',
							'min' => -1,
							'max' => 100,
							'step' => 1,
							'default' => 20,
							'name' => __( 'Limit', 'devn' ),
							'desc' => __( 'Maximum number of image source posts (for recent posts, category and custom taxonomy)', 'devn' )
						),
						'link' => array(
							'type' => 'select',
							'values' => array(
								'none'       => __( 'None', 'devn' ),
								'image'      => __( 'Full-size image', 'devn' ),
								'lightbox'   => __( 'Lightbox', 'devn' ),
								'custom'     => __( 'Slide link (added in media editor)', 'devn' ),
								'attachment' => __( 'Attachment page', 'devn' ),
								'post'       => __( 'Post permalink', 'devn' )
							),
							'default' => 'none',
							'name' => __( 'Links', 'devn' ),
							'desc' => __( 'Select which links will be used for images in this gallery', 'devn' )
						),
						'target' => array(
							'type' => 'select',
							'values' => array(
								'self' => __( 'Same window', 'devn' ),
								'blank' => __( 'New window', 'devn' )
							),
							'default' => 'self',
							'name' => __( 'Links target', 'devn' ),
							'desc' => __( 'Open links in', 'devn' )
						),
						'width' => array(
							'type' => 'slider',
							'min' => 100,
							'max' => 1600,
							'step' => 20,
							'default' => 600,
							'name' => __( 'Width', 'devn' ),
							'desc' => __( 'Carousel width (in pixels)', 'devn' )
						),
						'height' => array(
							'type' => 'slider',
							'min' => 20,
							'max' => 1600,
							'step' => 20,
							'default' => 100,
							'name' => __( 'Height', 'devn' ),
							'desc' => __( 'Carousel height (in pixels)', 'devn' )
						),
						'responsive' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Responsive', 'devn' ),
							'desc' => __( 'Ignore width and height parameters and make carousel responsive', 'devn' )
						),
						'items' => array(
							'type' => 'number',
							'min' => 1,
							'max' => 20,
							'step' => 1,
							'default' => 3,
							'name' => __( 'Items to show', 'devn' ),
							'desc' => __( 'How much carousel items is visible', 'devn' )
						),
						'scroll' => array(
							'type' => 'number',
							'min' => 1,
							'max' => 20,
							'step' => 1, 'default' => 1,
							'name' => __( 'Scroll number', 'devn' ),
							'desc' => __( 'How much items are scrolled in one transition', 'devn' )
						),
						'title' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Show titles', 'devn' ), 'desc' => __( 'Display titles for each item', 'devn' )
						),
						'centered' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Center', 'devn' ), 'desc' => __( 'Is carousel centered on the page', 'devn' )
						),
						'arrows' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Arrows', 'devn' ), 'desc' => __( 'Show left and right arrows', 'devn' )
						),
						'pages' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Pagination', 'devn' ),
							'desc' => __( 'Show pagination', 'devn' )
						),
						'mousewheel' => array(
							'type' => 'bool',
							'default' => 'yes', 'name' => __( 'Mouse wheel control', 'devn' ),
							'desc' => __( 'Allow to rotate carousel with mouse wheel', 'devn' )
						),
						'autoplay' => array(
							'type' => 'number',
							'min' => 0,
							'max' => 100000,
							'step' => 100,
							'default' => 5000,
							'name' => __( 'Autoplay', 'devn' ),
							'desc' => __( 'Choose interval between auto animations. Set to 0 to disable autoplay', 'devn' )
						),
						'speed' => array(
							'type' => 'number',
							'min' => 0,
							'max' => 20000,
							'step' => 100,
							'default' => 600,
							'name' => __( 'Speed', 'devn' ), 'desc' => __( 'Specify animation speed', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'Customizable image carousel', 'devn' ),
					'icon' => 'picture-o'
				),
				// custom_gallery
				'custom_gallery' => array(
					'name' => __( 'Gallery', 'devn' ),
					'type' => 'single',
					'group' => 'gallery',
					'atts' => array(
						'source' => array(
							'type'    => 'image_source',
							'default' => 'none',
							'name'    => __( 'Source', 'devn' ),
							'desc'    => __( 'Choose images source. You can use images from Media library or retrieve it from posts (thumbnails) posted under specified blog category. You can also pick any custom taxonomy', 'devn' )
						),
						'limit' => array(
							'type' => 'slider',
							'min' => -1,
							'max' => 100,
							'step' => 1,
							'default' => 20,
							'name' => __( 'Limit', 'devn' ),
							'desc' => __( 'Maximum number of image source posts (for recent posts, category and custom taxonomy)', 'devn' )
						),
						'link' => array(
							'type' => 'select',
							'values' => array(
								'none'       => __( 'None', 'devn' ),
								'image'      => __( 'Full-size image', 'devn' ),
								'lightbox'   => __( 'Lightbox', 'devn' ),
								'custom'     => __( 'Slide link (added in media editor)', 'devn' ),
								'attachment' => __( 'Attachment page', 'devn' ),
								'post'       => __( 'Post permalink', 'devn' )
							),
							'default' => 'none',
							'name' => __( 'Links', 'devn' ),
							'desc' => __( 'Select which links will be used for images in this gallery', 'devn' )
						),
						'target' => array(
							'type' => 'select',
							'values' => array(
								'self' => __( 'Same window', 'devn' ),
								'blank' => __( 'New window', 'devn' )
							),
							'default' => 'self',
							'name' => __( 'Links target', 'devn' ),
							'desc' => __( 'Open links in', 'devn' )
						),
						'width' => array(
							'type' => 'slider',
							'min' => 10,
							'max' => 1600,
							'step' => 10,
							'default' => 90,
							'name' => __( 'Width', 'devn' ), 'desc' => __( 'Single item width (in pixels)', 'devn' )
						),
						'height' => array(
							'type' => 'slider',
							'min' => 10,
							'max' => 1600,
							'step' => 10,
							'default' => 90,
							'name' => __( 'Height', 'devn' ), 'desc' => __( 'Single item height (in pixels)', 'devn' )
						),
						'title' => array(
							'type' => 'select',
							'values' => array(
								'never' => __( 'Never', 'devn' ),
								'hover' => __( 'On mouse over', 'devn' ),
								'always' => __( 'Always', 'devn' )
							),
							'default' => 'hover',
							'name' => __( 'Show titles', 'devn' ),
							'desc' => __( 'Title display mode', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'Customizable image gallery', 'devn' ),
					'icon' => 'picture-o'
				),
				// posts
				'posts' => array(
					'name' => __( 'Posts', 'devn' ),
					'type' => 'single',
					'group' => 'other',
					'atts' => array(
						'template' => array(
							'default' => 'templates/default-loop.php', 'name' => __( 'Template', 'devn' ),
							'desc' => __( '<b>Do not change this field value if you do not understand description below.</b><br/>Relative path to the template file. Default templates is placed under the plugin directory (templates folder). You can copy it under your theme directory and modify as you want. You can use following default templates that already available in the plugin directory:<br/><b%value>templates/default-loop.php</b> - posts loop<br/><b%value>templates/teaser-loop.php</b> - posts loop with thumbnail and title<br/><b%value>templates/single-post.php</b> - single post template<br/><b%value>templates/list-loop.php</b> - unordered list with posts titles', 'devn' )
						),
						'id' => array(
							'default' => '',
							'name' => __( 'Post ID\'s', 'devn' ),
							'desc' => __( 'Enter comma separated ID\'s of the posts that you want to show', 'devn' )
						),
						'posts_per_page' => array(
							'type' => 'number',
							'min' => -1,
							'max' => 10000,
							'step' => 1,
							'default' => get_option( 'posts_per_page' ),
							'name' => __( 'Posts per page', 'devn' ),
							'desc' => __( 'Specify number of posts that you want to show. Enter -1 to get all posts', 'devn' )
						),
						'post_type' => array(
							'type' => 'select',
							'multiple' => true,
							'values' => Su_Tools::get_types(),
							'default' => 'post',
							'name' => __( 'Post types', 'devn' ),
							'desc' => __( 'Select post types. Hold Ctrl key to select multiple post types', 'devn' )
						),
						'taxonomy' => array(
							'type' => 'select',
							'values' => Su_Tools::get_taxonomies(),
							'default' => 'category',
							'name' => __( 'Taxonomy', 'devn' ),
							'desc' => __( 'Select taxonomy to show posts from', 'devn' )
						),
						'tax_term' => array(
							'type' => 'select',
							'multiple' => true,
							'values' => Su_Tools::get_terms( 'category' ),
							'default' => '',
							'name' => __( 'Terms', 'devn' ),
							'desc' => __( 'Select terms to show posts from', 'devn' )
						),
						'tax_operator' => array(
							'type' => 'select',
							'values' => array( 'IN', 'NOT IN', 'AND' ),
							'default' => 'IN', 'name' => __( 'Taxonomy term operator', 'devn' ),
							'desc' => __( 'IN - posts that have any of selected categories terms<br/>NOT IN - posts that is does not have any of selected terms<br/>AND - posts that have all selected terms', 'devn' )
						),
						'author' => array(
							'type' => 'select',
							'multiple' => true,
							'values' => Su_Tools::get_users(),
							'default' => 'default',
							'name' => __( 'Authors', 'devn' ),
							'desc' => __( 'Choose the authors whose posts you want to show', 'devn' )
						),
						'meta_key' => array(
							'default' => '',
							'name' => __( 'Meta key', 'devn' ),
							'desc' => __( 'Enter meta key name to show posts that have this key', 'devn' )
						),
						'offset' => array(
							'type' => 'number',
							'min' => 0,
							'max' => 10000,
							'step' => 1, 'default' => 0,
							'name' => __( 'Offset', 'devn' ),
							'desc' => __( 'Specify offset to start posts loop not from first post', 'devn' )
						),
						'order' => array(
							'type' => 'select',
							'values' => array(
								'desc' => __( 'Descending', 'devn' ),
								'asc' => __( 'Ascending', 'devn' )
							),
							'default' => 'DESC',
							'name' => __( 'Order', 'devn' ),
							'desc' => __( 'Posts order', 'devn' )
						),
						'orderby' => array(
							'type' => 'select',
							'values' => array(
								'none' => __( 'None', 'devn' ),
								'id' => __( 'Post ID', 'devn' ),
								'author' => __( 'Post author', 'devn' ),
								'title' => __( 'Post title', 'devn' ),
								'name' => __( 'Post slug', 'devn' ),
								'date' => __( 'Date', 'devn' ), 'modified' => __( 'Last modified date', 'devn' ),
								'parent' => __( 'Post parent', 'devn' ),
								'rand' => __( 'Random', 'devn' ), 'comment_count' => __( 'Comments number', 'devn' ),
								'menu_order' => __( 'Menu order', 'devn' ), 'meta_value' => __( 'Meta key values', 'devn' ),
							),
							'default' => 'date',
							'name' => __( 'Order by', 'devn' ),
							'desc' => __( 'Order posts by', 'devn' )
						),
						'post_parent' => array(
							'default' => '',
							'name' => __( 'Post parent', 'devn' ),
							'desc' => __( 'Show childrens of entered post (enter post ID)', 'devn' )
						),
						'post_status' => array(
							'type' => 'select',
							'values' => array(
								'publish' => __( 'Published', 'devn' ),
								'pending' => __( 'Pending', 'devn' ),
								'draft' => __( 'Draft', 'devn' ),
								'auto-draft' => __( 'Auto-draft', 'devn' ),
								'future' => __( 'Future post', 'devn' ),
								'private' => __( 'Private post', 'devn' ),
								'inherit' => __( 'Inherit', 'devn' ),
								'trash' => __( 'Trashed', 'devn' ),
								'any' => __( 'Any', 'devn' ),
							),
							'default' => 'publish',
							'name' => __( 'Post status', 'devn' ),
							'desc' => __( 'Show only posts with selected status', 'devn' )
						),
						'ignore_sticky_posts' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Ignore sticky', 'devn' ),
							'desc' => __( 'Select Yes to ignore posts that is sticked', 'devn' )
						)
					),
					'desc' => __( 'Custom posts query with customizable template', 'devn' ),
					'icon' => 'th-list'
				),
				// dummy_text
				'dummy_text' => array(
					'name' => __( 'Dummy text', 'devn' ),
					'type' => 'single',
					'group' => 'content',
					'atts' => array(
						'what' => array(
							'type' => 'select',
							'values' => array(
								'paras' => __( 'Paragraphs', 'devn' ),
								'words' => __( 'Words', 'devn' ),
								'bytes' => __( 'Bytes', 'devn' ),
							),
							'default' => 'paras',
							'name' => __( 'What', 'devn' ),
							'desc' => __( 'What to generate', 'devn' )
						),
						'amount' => array(
							'type' => 'slider',
							'min' => 1,
							'max' => 100,
							'step' => 1,
							'default' => 1,
							'name' => __( 'Amount', 'devn' ),
							'desc' => __( 'How many items (paragraphs or words) to generate. Minimum words amount is 5', 'devn' )
						),
						'cache' => array(
							'type' => 'bool',
							'default' => 'yes',
							'name' => __( 'Cache', 'devn' ),
							'desc' => __( 'Generated text will be cached. Be careful with this option. If you disable it and insert many dummy_text shortcodes the page load time will be highly increased', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'Text placeholder', 'devn' ),
					'icon' => 'text-height'
				),
				// dummy_image
				'dummy_image' => array(
					'name' => __( 'Dummy image', 'devn' ),
					'type' => 'single',
					'group' => 'content',
					'atts' => array(
						'width' => array(
							'type' => 'slider',
							'min' => 10,
							'max' => 1600,
							'step' => 10,
							'default' => 500,
							'name' => __( 'Width', 'devn' ),
							'desc' => __( 'Image width', 'devn' )
						),
						'height' => array(
							'type' => 'slider',
							'min' => 10,
							'max' => 1600,
							'step' => 10,
							'default' => 300,
							'name' => __( 'Height', 'devn' ),
							'desc' => __( 'Image height', 'devn' )
						),
						'theme' => array(
							'type' => 'select',
							'values' => array(
								'any'       => __( 'Any', 'devn' ),
								'abstract'  => __( 'Abstract', 'devn' ),
								'animals'   => __( 'Animals', 'devn' ),
								'business'  => __( 'Business', 'devn' ),
								'cats'      => __( 'Cats', 'devn' ),
								'city'      => __( 'City', 'devn' ),
								'food'      => __( 'Food', 'devn' ),
								'nightlife' => __( 'Night life', 'devn' ),
								'fashion'   => __( 'Fashion', 'devn' ),
								'people'    => __( 'People', 'devn' ),
								'nature'    => __( 'Nature', 'devn' ),
								'sports'    => __( 'Sports', 'devn' ),
								'technics'  => __( 'Technics', 'devn' ),
								'transport' => __( 'Transport', 'devn' )
							),
							'default' => 'any',
							'name' => __( 'Theme', 'devn' ),
							'desc' => __( 'Select the theme for this image', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'desc' => __( 'Image placeholder with random image', 'devn' ),
					'icon' => 'picture-o'
				),
				// animate
				'animate' => array(
					'name' => __( 'Animation', 'devn' ),
					'type' => 'wrap',
					'group' => 'other',
					'atts' => array(
						'type' => array(
							'type' => 'select',
							'values' => array_combine( self::animations(), self::animations() ),
							'default' => 'bounceIn',
							'name' => __( 'Animation', 'devn' ),
							'desc' => __( 'Select animation type', 'devn' )
						),
						'duration' => array(
							'type' => 'slider',
							'min' => 0,
							'max' => 20,
							'step' => 0.5,
							'default' => 1,
							'name' => __( 'Duration', 'devn' ),
							'desc' => __( 'Animation duration (seconds)', 'devn' )
						),
						'delay' => array(
							'type' => 'slider',
							'min' => 0,
							'max' => 20,
							'step' => 0.5,
							'default' => 0,
							'name' => __( 'Delay', 'devn' ),
							'desc' => __( 'Animation delay (seconds)', 'devn' )
						),
						'inline' => array(
							'type' => 'bool',
							'default' => 'no',
							'name' => __( 'Inline', 'devn' ),
							'desc' => __( 'This parameter determines what HTML tag will be used for animation wrapper. Turn this option to YES and animated element will be wrapped in SPAN instead of DIV. Useful for inline animations, like buttons', 'devn' )
						),
						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'devn' ),
							'desc' => __( 'Extra CSS class', 'devn' )
						)
					),
					'content' => __( 'Animated content', 'devn' ),
					'desc' => __( 'Wrapper for animation. Any nested element will be animated', 'devn' ),
					'example' => 'animations',
					'icon' => 'bolt'
				),
				// meta
				'meta' => array(
					'name' => __( 'Meta', 'devn' ),
					'type' => 'single',
					'group' => 'data',
					'atts' => array(
						'key' => array(
							'default' => '',
							'name' => __( 'Key', 'devn' ),
							'desc' => __( 'Meta key name', 'devn' )
						),
						'default' => array(
							'default' => '',
							'name' => __( 'Default', 'devn' ),
							'desc' => __( 'This text will be shown if data is not found', 'devn' )
						),
						'before' => array(
							'default' => '',
							'name' => __( 'Before', 'devn' ),
							'desc' => __( 'This content will be shown before the value', 'devn' )
						),
						'after' => array(
							'default' => '',
							'name' => __( 'After', 'devn' ),
							'desc' => __( 'This content will be shown after the value', 'devn' )
						),
						'post_id' => array(
							'default' => '',
							'name' => __( 'Post ID', 'devn' ),
							'desc' => __( 'You can specify custom post ID. Leave this field empty to use an ID of the current post. Current post ID may not work in Live Preview mode', 'devn' )
						),
						'filter' => array(
							'default' => '',
							'name' => __( 'Filter', 'devn' ),
							'desc' => __( 'You can apply custom filter to the retrieved value. Enter here function name. Your function must accept one argument and return modified value. Example function: ', 'devn' ) . "<br /><pre><code style='display:block;padding:5px'>function my_custom_filter( \$value ) {\n\treturn 'Value is: ' . \$value;\n}</code></pre>"
						)
					),
					'desc' => __( 'Post meta', 'devn' ),
					'icon' => 'info-circle'
				),
				// user
				'user' => array(
					'name' => __( 'User', 'devn' ),
					'type' => 'single',
					'group' => 'data',
					'atts' => array(
						'field' => array(
							'type' => 'select',
							'values' => array(
								'display_name'        => __( 'Display name', 'devn' ),
								'ID'                  => __( 'ID', 'devn' ),
								'user_login'          => __( 'Login', 'devn' ),
								'user_nicename'       => __( 'Nice name', 'devn' ),
								'user_email'          => __( 'Email', 'devn' ),
								'user_url'            => __( 'URL', 'devn' ),
								'user_registered'     => __( 'Registered', 'devn' ),
								'user_activation_key' => __( 'Activation key', 'devn' ),
								'user_status'         => __( 'Status', 'devn' )
							),
							'default' => 'display_name',
							'name' => __( 'Field', 'devn' ),
							'desc' => __( 'User data field name', 'devn' )
						),
						'default' => array(
							'default' => '',
							'name' => __( 'Default', 'devn' ),
							'desc' => __( 'This text will be shown if data is not found', 'devn' )
						),
						'before' => array(
							'default' => '',
							'name' => __( 'Before', 'devn' ),
							'desc' => __( 'This content will be shown before the value', 'devn' )
						),
						'after' => array(
							'default' => '',
							'name' => __( 'After', 'devn' ),
							'desc' => __( 'This content will be shown after the value', 'devn' )
						),
						'user_id' => array(
							'default' => '',
							'name' => __( 'User ID', 'devn' ),
							'desc' => __( 'You can specify custom user ID. Leave this field empty to use an ID of the current user', 'devn' )
						),
						'filter' => array(
							'default' => '',
							'name' => __( 'Filter', 'devn' ),
							'desc' => __( 'You can apply custom filter to the retrieved value. Enter here function name. Your function must accept one argument and return modified value. Example function: ', 'devn' ) . "<br /><pre><code style='display:block;padding:5px'>function my_custom_filter( \$value ) {\n\treturn 'Value is: ' . \$value;\n}</code></pre>"
						)
					),
					'desc' => __( 'User data', 'devn' ),
					'icon' => 'info-circle'
				),
				// post
				'post' => array(
					'name' => __( 'Post', 'devn' ),
					'type' => 'single',
					'group' => 'data',
					'atts' => array(
						'field' => array(
							'type' => 'select',
							'values' => array(
								'ID'                    => __( 'Post ID', 'devn' ),
								'post_author'           => __( 'Post author', 'devn' ),
								'post_date'             => __( 'Post date', 'devn' ),
								'post_date_gmt'         => __( 'Post date', 'devn' ) . ' GMT',
								'post_content'          => __( 'Post content', 'devn' ),
								'post_title'            => __( 'Post title', 'devn' ),
								'post_excerpt'          => __( 'Post excerpt', 'devn' ),
								'post_status'           => __( 'Post status', 'devn' ),
								'comment_status'        => __( 'Comment status', 'devn' ),
								'ping_status'           => __( 'Ping status', 'devn' ),
								'post_name'             => __( 'Post name', 'devn' ),
								'post_modified'         => __( 'Post modified', 'devn' ),
								'post_modified_gmt'     => __( 'Post modified', 'devn' ) . ' GMT',
								'post_content_filtered' => __( 'Filtered post content', 'devn' ),
								'post_parent'           => __( 'Post parent', 'devn' ),
								'guid'                  => __( 'GUID', 'devn' ),
								'menu_order'            => __( 'Menu order', 'devn' ),
								'post_type'             => __( 'Post type', 'devn' ),
								'post_mime_type'        => __( 'Post mime type', 'devn' ),
								'comment_count'         => __( 'Comment count', 'devn' )
							),
							'default' => 'post_title',
							'name' => __( 'Field', 'devn' ),
							'desc' => __( 'Post data field name', 'devn' )
						),
						'default' => array(
							'default' => '',
							'name' => __( 'Default', 'devn' ),
							'desc' => __( 'This text will be shown if data is not found', 'devn' )
						),
						'before' => array(
							'default' => '',
							'name' => __( 'Before', 'devn' ),
							'desc' => __( 'This content will be shown before the value', 'devn' )
						),
						'after' => array(
							'default' => '',
							'name' => __( 'After', 'devn' ),
							'desc' => __( 'This content will be shown after the value', 'devn' )
						),
						'post_id' => array(
							'default' => '',
							'name' => __( 'Post ID', 'devn' ),
							'desc' => __( 'You can specify custom post ID. Leave this field empty to use an ID of the current post. Current post ID may not work in Live Preview mode', 'devn' )
						),
						'filter' => array(
							'default' => '',
							'name' => __( 'Filter', 'devn' ),
							'desc' => __( 'You can apply custom filter to the retrieved value. Enter here function name. Your function must accept one argument and return modified value. Example function: ', 'devn' ) . "<br /><pre><code style='display:block;padding:5px'>function my_custom_filter( \$value ) {\n\treturn 'Value is: ' . \$value;\n}</code></pre>"
						)
					),
					'desc' => __( 'Post data', 'devn' ),
					'icon' => 'info-circle'
				),
				// template
				'template' => array(
					'name' => __( 'Template', 'devn' ),
					'type' => 'single',
					'group' => 'other',
					'atts' => array(
						'name' => array(
							'default' => '',
							'name' => __( 'Template name', 'devn' ),
							'desc' => sprintf( __( 'Use template file name (with optional .php extension). If you need to use templates from theme sub-folder, use relative path. Example values: %s, %s, %s', 'devn' ), '<b%value>page</b>', '<b%value>page.php</b>', '<b%value>includes/page.php</b>' )
						)
					),
					'desc' => __( 'Theme template', 'devn' ),
					'icon' => 'puzzle-piece'
				),
			) );
		// Return result
		return ( is_string( $shortcode ) ) ? $shortcodes[sanitize_text_field( $shortcode )] : $shortcodes;
	}
}

class Shortcodes_Devn_Data extends Su_Data {
	function __construct() {
		parent::__construct();
	}
}
