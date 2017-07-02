<?php
/*
 *
 * Thanks for Leemason-NHP
 * Copyright (c) Options by Leemason-NHP 
 *
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 * Also if running on windows you may have url problems, which can be fixed by defining the framework url first
 *
 */
//define('DS_OPTIONS_URL', site_url('path the options folder'));
if(!class_exists('DS_Options')){
	require_once( dirname( __FILE__ ) . '/options/options.php' );
}

/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
	
	//$sections = array();
	$sections[] = array(
				'title' => __('A Section added by hook', 'devn'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', 'devn'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
				//Lets leave this as a blank section, no options just some intro text set above.
				'fields' => array()
				);
	
	return $sections;
	
}//function

/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
	
	//$args['dev_mode'] = false;
	
	return $args;
	
}//function









/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */

function setup_framework_options(){
$args = array();

$args['dev_mode'] = false;

$args['google_api_key'] = 'AIzaSyDAnjptHMLaO8exTHk7i8jYPLzygAE09Hg';

$args['intro_text'] = __('<p>This is the HTML which can be displayed before the form, it isnt required, but more info is always better. Anything goes in terms of markup here, any HTML.</p>', 'devn');

$args['share_icons']['twitter'] = array(
										'link' => 'http://twitter.com/devnCo',
										'title' => 'Folow me on Twitter', 
										'img' => DS_OPTIONS_URL.'img/glyphicons/glyphicons_322_twitter.png'
										);

$args['show_import_export'] = false;

$args['opt_name'] = 'devn';

$args['menu_title'] = __('DEVN HOXA', 'devn');

$args['page_title'] = __('DEVN - Premium Theme', 'devn');

$args['page_slug'] = 'panel';

$args['page_position'] = 101;
$args['allow_sub_menu'] = false;

if( !empty($_REQUEST['daction']) )
{
	if( $_REQUEST['daction'] == 'import' )
	{
		require( dirname(__FILE__).DS.'sample'.DS.'devnImporter.php' );
		wordpress_devnimporter_init();
	}	
}

$import_file = dirname(__FILE__).DS.'sample'.DS.'data.xml';
$import_html = '';		
if ( file_exists($import_file) ){

	$import_html = '<h2></h2><br /><div class="nhp-opts-section-desc"><p class="description"><a style="font-style: normal;" href="admin.php?page=devn-sample-data" class="btn btn_green">One-Click Importer Sample Data</a>  &nbsp; Just click and your website will look exactly our demo (posts, pages, menus, categories, tags, layouts, images, sliders, post-type) </p> <br /></div><hr style="background: #ccc;border: none;height: 1px;"/><br />';
	
}	

$sections = array();

$sections[] = array(
	'title' => __('Getting Started', 'devn'),
	'desc' => $import_html.
		'<h2>Visual Design Layouts</h2><div class="nhp-opts-section-desc"><p class="description">You can create layouts easily, quickly and very visually</p><br><a style="font-style: normal;" href="admin.php?page=visual-design" class="btn btn_green">Open Tool</a> </div><table class="form-table"><tbody><tr valign="top"><th scope="row">Watch HD Video<span class="description">Getting started with visual design tool</span></th><td>			<iframe width="560" height="315" src="http://www.youtube.com/embed/XrB01R40Iuw?vq=hd720&amp;rel=0" frameborder="0" allowfullscreen=""></iframe></td></tr></tbody></table>'.
		
		'<div class="nhp-opts-section-desc"></div><table class="form-table"><tbody><tr valign="top"><th scope="row">Edit a Layout by Visual Design Tool</th><td><iframe width="560" height="315" src="http://www.youtube.com/embed/V1wtVaiGymU?vq=hd720&amp;rel=0" frameborder="0" allowfullscreen=""></iframe></td></tr></tbody></table>'.
		
		'<hr style="background: #ccc;border: none;height: 1px;"><br /><div style="font-style:normal"><p>If this is your first time using our theme , please visit docs at <a target="_blank" href="http://hoxa.devn.co/document">http://hoxa.devn.co/document</a></p><p>Full HD Videos tutorial <a target="_blank" href="https://www.youtube.com/channel/UCvPrdH_wP005TjBaOQdH9sQ/videos">Our Chanel</a></p><p>Want to find more, please visit <a target="_blank" href="http://'.'devn.co'.'">http://'.'devn.co'.'</a></p><p>If you have any questions that are beyond the scope of this help Or any the desire to cooperate, <br />please feel free to send an email to us: <span style="color:red">contact@devn.co</span></p><br /><hr style="background: #ddd;border: none;height: 1px;">Thank you for using our themes.<br /><br /><br /><br /></div>',
	'icon' => DS_OPTIONS_URL.'img/glyphicons/glyphicons_001_leaf.png'

);

$patterns = array();
for( $i=0; $i<34; $i++ ){
	$patterns['bg'.$i] = array('title' => 'Background '.$i, 'img' => THEME_URI.'/images/patterns/bg'.$i.'.png');
}
$args['fonts'] = array(
	"arial",
	"tahoma",
	"verdana",
	"georgia",
	"times",
	"----------------",
	"Abel",
	"Abril Fatface",
	"Aclonica",
	"Acme",
	"Actor",
	"Adamina",
	"Advent Pro",
	"Aguafina Script",
	"Aladin",
	"Aldrich",
	"Alegreya",
	"Alegreya SC",
	"Alex Brush",
	"Alfa Slab One",
	"Alice",
	"Alike",
	"Alike Angular",
	"Allan",
	"Allerta",
	"Allerta Stencil",
	"Allura",
	"Almendra",
	"Almendra SC",
	"Amaranth",
	"Amatic SC",
	"Amethysta",
	"Andada",
	"Andika",
	"Angkor",
	"Annie Use Your Telescope",
	"Anonymous Pro",
	"Antic",
	"Antic Didone",
	"Antic Slab",
	"Anton",
	"Arapey",
	"Arbutus",
	"Architects Daughter",
	"Arimo",
	"Arizonia",
	"Armata",
	"Artifika",
	"Arvo",
	"Asap",
	"Asset",
	"Astloch",
	"Asul",
	"Atomic Age",
	"Aubrey",
	"Audiowide",
	"Average",
	"Averia Gruesa Libre",
	"Averia Libre",
	"Averia Sans Libre",
	"Averia Serif Libre",
	"Bad Script",
	"Balthazar",
	"Bangers",
	"Basic",
	"Battambang",
	"Baumans",
	"Bayon",
	"Belgrano",
	"Belleza",
	"Bentham",
	"Berkshire Swash",
	"Bevan",
	"Bigshot One",
	"Bilbo",
	"Bilbo Swash Caps",
	"Bitter",
	"Black Ops One",
	"Bokor",
	"Bonbon",
	"Boogaloo",
	"Bowlby One",
	"Bowlby One SC",
	"Brawler",
	"Bree Serif",
	"Bubblegum Sans",
	"Buda",
	"Buenard",
	"Butcherman",
	"Butterfly Kids",
	"Cabin",
	"Cabin Condensed",
	"Cabin Sketch",
	"Caesar Dressing",
	"Cagliostro",
	"Calligraffitti",
	"Cambo",
	"Candal",
	"Cantarell",
	"Cantata One",
	"Cardo",
	"Carme",
	"Carter One",
	"Caudex",
	"Cedarville Cursive",
	"Ceviche One",
	"Changa One",
	"Chango",
	"Chau Philomene One",
	"Chelsea Market",
	"Chenla",
	"Cherry Cream Soda",
	"Chewy",
	"Chicle",
	"Chivo",
	"Coda",
	"Coda Caption",
	"Codystar",
	"Comfortaa",
	"Coming Soon",
	"Concert One",
	"Condiment",
	"Content",
	"Contrail One",
	"Convergence",
	"Cookie",
	"Copse",
	"Corben",
	"Cousine",
	"Coustard",
	"Covered By Your Grace",
	"Crafty Girls",
	"Creepster",
	"Crete Round",
	"Crimson Text",
	"Crushed",
	"Cuprum",
	"Cutive",
	"Damion",
	"Dancing Script",
	"Dangrek",
	"Dawning of a New Day",
	"Days One",
	"Delius",
	"Delius Swash Caps",
	"Delius Unicase",
	"Della Respira",
	"Devonshire",
	"Didact Gothic",
	"Diplomata",
	"Diplomata SC",
	"Doppio One",
	"Dorsa",
	"Dosis",
	"Dr Sugiyama",
	"Droid Sans",
	"Droid Sans Mono",
	"Droid Serif",
	"Duru Sans",
	"Dynalight",
	"EB Garamond",
	"Eater",
	"Economica",
	"Electrolize",
	"Emblema One",
	"Emilys Candy",
	"Engagement",
	"Enriqueta",
	"Erica One",
	"Esteban",
	"Euphoria Script",
	"Ewert",
	"Exo",
	"Expletus Sans",
	"Fanwood Text",
	"Fascinate",
	"Fascinate Inline",
	"Federant",
	"Federo",
	"Felipa",
	"Fjord One",
	"Flamenco",
	"Flavors",
	"Fondamento",
	"Fontdiner Swanky",
	"Forum",
	"Francois One",
	"Fredericka the Great",
	"Fredoka One",
	"Freehand",
	"Fresca",
	"Frijole",
	"Fugaz One",
	"GFS Didot",
	"GFS Neohellenic",
	"Galdeano",
	"Gentium Basic",
	"Gentium Book Basic",
	"Geo",
	"Geostar",
	"Geostar Fill",
	"Germania One",
	"Give You Glory",
	"Glass Antiqua",
	"Glegoo",
	"Gloria Hallelujah",
	"Goblin One",
	"Gochi Hand",
	"Gorditas",
	"Goudy Bookletter 1911",
	"Graduate",
	"Gravitas One",
	"Great Vibes",
	"Gruppo",
	"Gudea",
	"Habibi",
	"Hammersmith One",
	"Handlee",
	"Hanuman",
	"Happy Monkey",
	"Henny Penny",
	"Herr Von Muellerhoff",
	"Holtwood One SC",
	"Homemade Apple",
	"Homenaje",
	"IM Fell DW Pica",
	"IM Fell DW Pica SC",
	"IM Fell Double Pica",
	"IM Fell Double Pica SC",
	"IM Fell English",
	"IM Fell English SC",
	"IM Fell French Canon",
	"IM Fell French Canon SC",
	"IM Fell Great Primer",
	"IM Fell Great Primer SC",
	"Iceberg",
	"Iceland",
	"Imprima",
	"Inconsolata",
	"Inder",
	"Indie Flower",
	"Inika",
	"Irish Grover",
	"Istok Web",
	"Italiana",
	"Italianno",
	"Jim Nightshade",
	"Jockey One",
	"Jolly Lodger",
	"Josefin Sans",
	"Josefin Slab",
	"Judson",
	"Julee",
	"Junge",
	"Jura",
	"Just Another Hand",
	"Just Me Again Down Here",
	"Kameron",
	"Karla",
	"Kaushan Script",
	"Kelly Slab",
	"Kenia",
	"Khmer",
	"Knewave",
	"Kotta One",
	"Koulen",
	"Kranky",
	"Kreon",
	"Kristi",
	"Krona One",
	"La Belle Aurore",
	"Lancelot",
	"Lato",
	"League Script",
	"Leckerli One",
	"Ledger",
	"Lekton",
	"Lemon",
	"Lilita One",
	"Limelight",
	"Linden Hill",
	"Lobster",
	"Lobster Two",
	"Londrina Outline",
	"Londrina Shadow",
	"Londrina Sketch",
	"Londrina Solid",
	"Lora",
	"Love Ya Like A Sister",
	"Loved by the King",
	"Lovers Quarrel",
	"Luckiest Guy",
	"Lusitana",
	"Lustria",
	"Macondo",
	"Macondo Swash Caps",
	"Magra",
	"Maiden Orange",
	"Mako",
	"Marck Script",
	"Marko One",
	"Marmelad",
	"Marvel",
	"Mate",
	"Mate SC",
	"Maven Pro",
	"Meddon",
	"MedievalSharp",
	"Medula One",
	"Megrim",
	"Merienda One",
	"Merriweather",
	"Metal",
	"Metamorphous",
	"Metrophobic",
	"Michroma",
	"Miltonian",
	"Miltonian Tattoo",
	"Miniver",
	"Miss Fajardose",
	"Modern Antiqua",
	"Molengo",
	"Monofett",
	"Monoton",
	"Monsieur La Doulaise",
	"Montaga",
	"Montez",
	"Montserrat",
	"Moul",
	"Moulpali",
	"Mountains of Christmas",
	"Mr Bedfort",
	"Mr Dafoe",
	"Mr De Haviland",
	"Mrs Saint Delafield",
	"Mrs Sheppards",
	"Muli",
	"Mystery Quest",
	"Neucha",
	"Neuton",
	"News Cycle",
	"Niconne",
	"Nixie One",
	"Nobile",
	"Nokora",
	"Norican",
	"Nosifer",
	"Nothing You Could Do",
	"Noticia Text",
	"Nova Cut",
	"Nova Flat",
	"Nova Mono",
	"Nova Oval",
	"Nova Round",
	"Nova Script",
	"Nova Slim",
	"Nova Square",
	"Numans",
	"Nunito",
	"Odor Mean Chey",
	"Old Standard TT",
	"Oldenburg",
	"Oleo Script",
	"Open Sans",
	"Open Sans Condensed",
	"Orbitron",
	"Original Surfer",
	"Oswald",
	"Over the Rainbow",
	"Overlock",
	"Overlock SC",
	"Ovo",
	"Oxygen",
	"PT Mono",
	"PT Sans",
	"PT Sans Caption",
	"PT Sans Narrow",
	"PT Serif",
	"PT Serif Caption",
	"Pacifico",
	"Parisienne",
	"Passero One",
	"Passion One",
	"Patrick Hand",
	"Patua One",
	"Paytone One",
	"Permanent Marker",
	"Petrona",
	"Philosopher",
	"Piedra",
	"Pinyon Script",
	"Plaster",
	"Play",
	"Playball",
	"Playfair Display",
	"Podkova",
	"Poiret One",
	"Poller One",
	"Poly",
	"Pompiere",
	"Pontano Sans",
	"Port Lligat Sans",
	"Port Lligat Slab",
	"Prata",
	"Preahvihear",
	"Press Start 2P",
	"Princess Sofia",
	"Prociono",
	"Prosto One",
	"Puritan",
	"Quantico",
	"Quattrocento",
	"Quattrocento Sans",
	"Questrial",
	"Quicksand",
	"Qwigley",
	"Radley",
	"Raleway:100,200,300,400,500,600,700,800,900",
	"Rammetto One",
	"Rancho",
	"Rationale",
	"Redressed",
	"Reenie Beanie",
	"Revalia",
	"Ribeye",
	"Ribeye Marrow",
	"Righteous",
	"Rochester",
	"Rock Salt",
	"Rokkitt",
	"Ropa Sans",
	"Rosario",
	"Rosarivo",
	"Rouge Script",
	"Ruda",
	"Ruge Boogie",
	"Ruluko",
	"Ruslan Display",
	"Russo One",
	"Ruthie",
	"Sail",
	"Salsa",
	"Sancreek",
	"Sansita One",
	"Sarina",
	"Satisfy",
	"Schoolbell",
	"Seaweed Script",
	"Sevillana",
	"Shadows Into Light",
	"Shadows Into Light Two",
	"Shanti",
	"Share",
	"Shojumaru",
	"Short Stack",
	"Siemreap",
	"Sigmar One",
	"Signika",
	"Signika Negative",
	"Simonetta",
	"Sirin Stencil",
	"Six Caps",
	"Slackey",
	"Smokum",
	"Smythe",
	"Sniglet",
	"Snippet",
	"Sofia",
	"Sonsie One",
	"Sorts Mill Goudy",
	"Special Elite",
	"Spicy Rice",
	"Spinnaker",
	"Spirax",
	"Squada One",
	"Stardos Stencil",
	"Stint Ultra Condensed",
	"Stint Ultra Expanded",
	"Stoke",
	"Sue Ellen Francisco",
	"Sunshiney",
	"Supermercado One",
	"Suwannaphum",
	"Swanky and Moo Moo",
	"Syncopate",
	"Tangerine",
	"Taprom",
	"Telex",
	"Tenor Sans",
	"The Girl Next Door",
	"Tienne",
	"Tinos",
	"Titan One",
	"Trade Winds",
	"Trocchi",
	"Trochut",
	"Trykker",
	"Tulpen One",
	"Ubuntu",
	"Ubuntu Condensed",
	"Ubuntu Mono",
	"Ultra",
	"Uncial Antiqua",
	"UnifrakturCook",
	"UnifrakturMaguntia",
	"Unkempt",
	"Unlock",
	"Unna",
	"VT323",
	"Varela",
	"Varela Round",
	"Vast Shadow",
	"Vibur",
	"Vidaloka",
	"Viga",
	"Voces",
	"Volkhov",
	"Vollkorn",
	"Voltaire",
	"Waiting for the Sunrise",
	"Wallpoet",
	"Walter Turncoat",
	"Wellfleet",
	"Wire One",
	"Yanone Kaffeesatz",
	"Yellowtail",
	"Yeseva One",
	"Yesteryear",
	"Zeyada"
	);				
$sections[] = array(
	'icon' => DS_OPTIONS_URL.'img/glyphicons/glyphicons_023_cogwheels.png',
	'title' => __('General Settings', 'devn'),
	'desc' => __('<p class="description">general configuration options for theme</p>', 'devn'),
	'fields' => array(

		array(
			'id' => 'logo',
			'type' => 'upload',
			'title' => __('Upload Logo', 'devn'), 
			'sub_desc' => __('This will be display as logo at header of every page', 'devn'),
			'desc' => __('Upload new or from media library to use as your logo.', 'devn'),
			'std' => THEME_URI.'/images/hoxa.png'
		),					
		array(
			'id' => 'favicon',
			'type' => 'upload',
			'title' => __('Upload Favicon', 'devn'), 
			'sub_desc' => __('This will be display at title of browser', 'devn'),
			'desc' => __('Upload new or from media library to use as your favicon.', 'devn')
		),					
		array(
			'id' => 'maxwidth',
			'type' => 'text',
			'title' => __('Max Width', 'devn'), 
			'sub_desc' => __('Will not be affected to responsive', 'devn'),
			'desc' => __('Set width of the site in large screen. If the screen smaller, the content will automatically shrink.', 'devn'),
			'std' => '1170',
			'validate' => 'numeric'
		),						
		array(
			'id' => 'layout',
			'type' => 'button_set',
			'title' => __('Select Layout', 'devn'), 
			'desc' => '',
			'options' => array('wide' => 'WIDE','boxed' => 'BOXED'),
			'std' => 'wide'
		),
		array(
			'id' => 'responsive',
			'type' => 'button_set',
			'title' => __('Responsive Support', 'devn'), 
			'desc' => __('Help display well on all screen size (smartphone, tablet, laptop, desktop...)', 'devn'),
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'std' => '1'
		),
		array(
			'id' => 'breadeli',
			'type' => 'text',
			'title' => __('Breadcrumb Delimiter', 'devn'), 
			'desc' => __('The symbol in beetwen your Breadcrumbs.', 'devn'),
			'std' => '/'
		),			
		array(
			'id' => 'header',
			'type' => 'textarea',
			'title' => __('Additional Headers', 'devn'), 
			'sub_desc' => __('Add custom tag to header e.g: &lt;meta&gt;, &lt;stylesheet&gt;, &lt;javascript&gt; ...', 'devn'),
			'desc' => __('The following code will add to the <head> tag. Useful if you need to add additional scripts such as CSS or JS.', 'devn')
		),					
		array(
			'id' => 'footer',
			'type' => 'textarea',
			'title' => __('Additional Footer', 'devn'), 
			'sub_desc' => __('e.g: Google analytics at here', 'devn'),
			'desc' => __('The following code will add to the footer before the closing </body> tag. Useful if you need to Javascript or tracking code.', 'devn')
		)
	)	
);

$sections[] = array(
	'icon' => DS_OPTIONS_URL.'img/glyphicons/glyphicons_236_zoom_in.png',
	'title' => __('SEO', 'devn'),
	'desc' => __('<p class="description">Help your site more friendly with Search Engine<br /> After active theme, we will enable all <strong>permalinks</strong> and meta descriptions.</p>', 'devn'),
	'fields' => array(
		
		array(
			'id' => 'ogmeta',
			'type' => 'button_set',
			'title' => __('Open Graph Meta', 'devn'), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'std' => '1',
			'sub_desc' => __('elements that describe the object in different ways and are represented by meta tags included on the object page', 'devn'),
		),
		
		array(
			'id' => 'homeTitle',
			'type' => 'text',
			'title' => __('Homepage custom title', 'devn'), 
			'desc' => __('<br />Default is:  <strong>%Site Title% - %Tagline%</strong> from General Settings', 'devn'),
			'sub_desc' => __('The title will be displayed in homepage between &lt;title>&lt;/title> tags', 'devn'),
		),	
		
		array(
			'id' => 'homeTitleFm',
			'type' => 'select',
			'title' => __('Home Title Format', 'devn'), 
			'options' => array('1' => 'Blog Name | Blog description','2' => 'Blog description | Blog Name', '3' => 'Blog Name only'),
			'desc' => __('<br />If <b>Homepage custom title</b> not set', 'devn'),
			'std' => '1'
		),		
		
		array(
			'id' => 'postTitleFm',
			'type' => 'select',
			'title' => __('Single Post Page Title Format', 'devn'), 
			'options' => array('1' => 'Post title | Blog Name','2' => 'Blog Name | Post title', '3' => 'Post title only'),
			'std' => '1'
		),	
		
		array(
			'id' => 'archivesTitleFm',
			'type' => 'select',
			'title' => __('Archives Title Format', 'devn'), 
			'options' => array('1' => 'Category name | Blog Name','2' => 'Blog Name | Category name', '3' => 'Category name only'),
			'std' => '1'
		),
		
		array(
			'id' => 'titleSeparate',
			'type' => 'text',
			'title' => __('Separate Character', 'devn'), 
			'sub_desc' => __('a Character to separate BlogName and Post title', 'devn'),
			'std' => '|'
		),			
		
		array(
			'id' => 'homeMetaKeywords',
			'type' => 'textarea',
			'title' => __('Home Meta Keywords', 'devn'), 
			'sub_desc' => __('Add  tags for the search engines and especially Google', 'devn'),
		),			
		array(
			'id' => 'homeMetaDescription',
			'type' => 'textarea',
			'title' => __('Home Meta Description', 'devn'), 

		),		
		array(
			'id' => 'otherMetaKeywords',
			'type' => 'textarea',
			'title' => __('Other Page Meta Keywords', 'devn'), 

		),			
		array(
			'id' => 'otherMetaDescription',
			'type' => 'textarea',
			'title' => __('Other Page Meta Description', 'devn'), 

		),	
	)

);


$sections[] = array(
	'icon' => DS_OPTIONS_URL.'img/glyphicons/glyphicons_087_log_book.png',
	'title' => __('Blog', 'devn'),
	'desc' => __('Blog Settings', 'devn'),	
	'fields' => array(
		array(
			'id' => 'blog',
			'type' => 'blog'
		)
	)
);


$sections[] = array(
	'icon' => DS_OPTIONS_URL.'img/glyphicons/glyphicons_061_keynote.png',
	'title' => __('Article Settings', 'devn'),
	'desc' => __('<p class="description">Settings for Single post or Page</p>', 'devn'),
	'fields' => array(
		array(
			'id' => 'excerptImage',
			'type' => 'button_set',
			'title' => __('Featured Image', 'devn'), 
			'sub_desc' => __('Display Featured image before of content', 'devn'),
			'options' => array('1' => 'Display','2' => 'Hide'),
			'std' => '1'
		),		
		array(
			'id' => 'navArticle',
			'type' => 'button_set',
			'title' => __('Next/Prev Article Direction', 'devn'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showMeta',
			'type' => 'button_set',
			'title' => __('Meta Box', 'devn'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showAuthorMeta',
			'type' => 'button_set',
			'title' => __('Author Meta', 'devn'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showDateMeta',
			'type' => 'button_set',
			'title' => __('Date Meta', 'devn'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showCateMeta',
			'type' => 'button_set',
			'title' => __('Categories Meta', 'devn'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showCommentsMeta',
			'type' => 'button_set',
			'title' => __('Comments Meta', 'devn'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showTagsMeta',
			'type' => 'button_set',
			'title' => __('Tags Meta', 'devn'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showShareBox',
			'type' => 'button_set',
			'title' => __('Share Box', 'devn'), 
			'sub_desc' => __('Display box socials button below', 'devn'),
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showShareFacebook',
			'type' => 'button_set',
			'title' => __('Facebook Button', 'devn'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showShareTwitter',
			'type' => 'button_set',
			'title' => __('Tweet Button', 'devn'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showShareGoogle',
			'type' => 'button_set',
			'title' => __('Google Button', 'devn'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showSharePinterest',
			'type' => 'button_set',
			'title' => __('Pinterest Button', 'devn'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showShareLinkedin',
			'type' => 'button_set',
			'title' => __('LinkedIn Button', 'devn'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'archiveAboutAuthor',
			'type' => 'button_set',
			'title' => __('About Author', 'devn'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'sub_desc' => __('About author box with avatar and description', 'devn'),
			'std' => '1'
		),
		array(
			'id' => 'archiveRelatedPosts',
			'type' => 'button_set',
			'title' => __('Related Posts', 'devn'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'sub_desc' => __('List related posts after the content.', 'devn'),
			'std' => '1'
		),
		array(
			'id' => 'archiveNumberofPosts',
			'type' => 'text',
			'title' => __('Number of posts related to show', 'devn'), 
			'validate' => 'numeric',
			'std' => '3'
		),
		array(
			'id' => 'archiveRelatedQuery',
			'type' => 'button_set',
			'title' => __('Related Query Type', 'devn'), 
			'options' => array('category' => 'Category','tag' => 'Tag','author'=>'Author'),
			'std' => 'category'
		)
	)

);


$sections[] = array(
	'icon' => DS_OPTIONS_URL.'img/glyphicons/glyphicons_273_drink.png',
	'title' => __('Styling', 'devn'),
	'desc' => __('<p class="description">Setting up global style and background</p>', 'devn'),
	'fields' => array(
		array(
			'id' => 'colorStyle',
			'type' => 'colorStyle',
			'title' => __('Color Style', 'devn'), 
			'sub_desc' => __('Predefined Color Skins', 'devn'),
			'std'	=> 'lightblue'
		),
		array(
			'type' => 'color',
			'id' => 'backgroundColor',
			'title' =>  __('Background Color', 'devn'),
			'std' => '#eee',
			'desc' =>  __(' Background body for layout wide and background box for layout boxed', 'devn'), 
			'css' => '<?php if($value!="")echo "body{background-color: ".$value.";}"; ?>'
		),	
		array(
			'type' => 'upload',
			'id' => 'backgroundCustom',
			'title' =>  __('Custom Background Image', 'devn'),
			'sub_desc' => __('Only be used for Boxed Type.', 'devn'),
			'desc' =>  __(' Upload your custom background image, or you can also use the Pattern available below.', 'devn'),
			'std' => '',
			'css' => '<?php if($value!="")echo "body{background-image: url(".$value.") !important;}"; ?>'
		
		),
		array(
			'id' => 'useBackgroundPattern',
			'type' => 'checkbox_hide_below',
			'title' => __('Use Pattern for background', 'devn'), 
			'sub_desc' => __('Tick on checkbox to show list of Patterns', 'devn'),
			'desc' => __('If you do not have background image, you can also use our Pattern.', 'devn'),
			'std' => 1
		),
		array(
			'id' => 'backgroundImage',
			'type' => 'radio_img',
			'title' => __('Select background', 'devn'), 
			'sub_desc' => __('Only be used for Boxed Type.', 'devn'),
			'options' => $patterns,
			'std' => 'bg23',
			'css' => '<?php if($value!="")echo "body{background-image: url('.THEME_URI.'/images/patterns/".$value.".png);}"; ?>'
		),		
		array(
			'id' => 'linksDecoration',
			'type' => 'select',
			'title' => __('Links Decoration', 'devn'), 
			'sub_desc' => __('Set decoration for all links.', 'devn'),
			'options' => array('default'=>'Default','none'=>'None','underline'=>'Underline','overline'=>'Overline','line-through'=>'Line through'),
			'std' => 'default',
			'css' => '<?php if($value!="")echo "a{text-decoration: ".$value.";}"; ?>'
		),		
		array(
			'id' => 'linksHoverDecoration',
			'type' => 'select',
			'title' => __('Links Hover Decoration', 'devn'), 
			'sub_desc' => __('Set decoration for all links when hover.', 'devn'),
			'options' => array('default'=>'Default','none'=>'None','underline'=>'Underline','overline'=>'Overline','line-through'=>'Line through'),
			'std' => 'default',
			'css' => '<?php if($value!="")echo "a:hover{text-decoration: ".$value.";}"; ?>'
		),		
		array(
			'id' => 'cssGlobal',
			'type' => 'textarea',
			'title' => __('Global CSS', 'devn'), 
			'sub_desc' => __('CSS for all screen size, only CSS without &lt;style&gt; tag', 'devn'),
			'css' => '<?php if($value!="")echo $value; ?>'
		),
		array(
			'id' => 'cssTablets',
			'type' => 'textarea',
			'title' => __('Tablets CSS', 'devn'), 
			'sub_desc' => __('Width from 768px to 985px, only CSS without &lt;style&gt; tag', 'devn'),
			'css' => '<?php if($value!="")echo "@media (min-width: 768px) and (max-width: 985px){".$value."}"; ?>'
		),
		array(
			'id' => 'cssPhones',
			'type' => 'textarea',
			'title' => __('Wide Phones CSS', 'devn'), 
			'sub_desc' => __('Width from 480px to 767px, only CSS without &lt;style&gt; tag', 'devn'),
			'css' => '<?php if($value!="")echo "@media (min-width: 480px) and (max-width: 767px){".$value."}"; ?>'
		),
		
	)

);

$sections[] = array(
	'icon' => DS_OPTIONS_URL.'img/glyphicons/glyphicons_107_text_resize.png',
	'title' => __('Typography', 'devn'),
	'desc' => __('<p class="description">Set the color, font family, font size, font weight and font style.</p>', 'devn'),
	'fields' => array(
		array(
			'id' => 'generalTypography',
			'type' => 'typography',
			'title' => __('General Typography', 'devn'), 
			'std' => array('font'=>'Open Sans'),
			'css' => 'body{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),				
		array(
			'id' => 'generalHoverTypography',
			'type' => 'typography',
			'title' => __('General Link Hover', 'devn'), 
			'css' => 'a:hover, a:active, a:focus{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),		
		array(
			'id' => 'mainMenuTypography',
			'type' => 'typography',
			'title' => __('Main Menu', 'devn'),
			'css' => '.navbar-default .navbar-nav>li>a{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\' !important;"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px !important;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight]." !important;"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),		
		array(
			'id' => 'mainMenuHoverTypography',
			'type' => 'typography',
			'title' => __('Main Menu Hover', 'devn'), 
			'css' => '.navbar-default .navbar-nav>li>a:hover,.navbar-default .navbar-nav>li.current-menu-item>a{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),			
		array(
			'id' => 'mainMenuSubTypography',
			'type' => 'typography',
			'title' => __('Sub Main Menu Hover', 'devn'), 
			'css' => '.dropdown-menu>li>a{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),	
		array(
			'id' => 'postMetaTypography',
			'type' => 'typography',
			'title' => __('Post Meta', 'devn'), 
			'std' => array(),
			'css' => '.post_meta_links{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'postMatalinkTypography',
			'type' => 'typography',
			'title' => __('Post Meta Link', 'devn'), 
			'css' => '.post_meta_links li a{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'postTitleTypography',
			'type' => 'typography',
			'title' => __('Post Title', 'devn'), 
			'css' => '.blog_post h3.entry-title a{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'postEntryTypography',
			'type' => 'typography',
			'title' => __('Post Entry', 'devn'), 
			'css' => 'article .blog_postcontent,article .blog_postcontent p{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'widgetTitlesTypography',
			'type' => 'typography',
			'title' => __('Widget Titles', 'devn'), 
			'std'	=>	array('font'=>'Raleway:100,200,300,400,500,600,700,800,900','size'=>'22px'),
			'css' => '<?php if($value[color]!="")echo "aside .widget-title span{color:".$value[color].";}h3.widget-title {border-left: 2px solid ".$value[color].";}.devn-spoiler-open > .devn-spoiler-title {border-top: 2px solid ".$value[color].";}.widget_calendar #wp-calendar th {background-color:".$value[color]."}#tabbed-widget ul.tabs.posts-taps li.active, #tabbed-widget ul.tabs.posts-taps li:hover {background:".$value[color].";}"; ?>h3.widget-title,#reply-title,#comments-title{<?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'footerWidgetTitlesTypography',
			'type' => 'typography',
			'title' => __('Footer Widgets Titles', 'devn'), 
			'std'	=> array('color'=>'#fff'),
			'css' => '#footer-group h3.widget-title{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'h1Typography',
			'type' => 'typography',
			'title' => __('H1 Typography', 'devn'), 
			'std' => array(),
			'css' => 'h1{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'h2Typography',
			'type' => 'typography',
			'title' => __('H2 Typography', 'devn'), 
			'std' => array(),
			'css' => 'h2{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'h3Typography',
			'type' => 'typography',
			'title' => __('H3 Typography', 'devn'), 
			'std' => array(),
			'css' => 'h3{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'h4Typography',
			'type' => 'typography',
			'title' => __('H4 Typography', 'devn'), 
			'std' => array(),
			'css' => 'h4{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'h5Typography',
			'type' => 'typography',
			'title' => __('H5 Typography', 'devn'), 
			'std' => array(),
			'css' => 'h5{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'h6Typography',
			'type' => 'typography',
			'title' => __('H6 Typography', 'devn'), 
			'std' => array(),
			'css' => 'h6{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		)
		
	)

);

$sections[] = array(
	'icon' => DS_OPTIONS_URL.'img/glyphicons/glyphicons_100_font.png',
	'title' => __('Google Fonts', 'devn'),
	'desc' => __('Will show as list fonts for settings Typography. Preview fonts ','devn').'<a href="http://www.'.'google.com/fonts'.'" target=_blank>At Here</a>',
	'fields' => array(
		array(
			'id' => 'googleFonts',
			'type' => 'multi_text',
			'title' => __('List of Fonts', 'devn'),
			'sub_desc' => __('Add name of font for each input field, e.g: "Jacques Francois".', 'devn'),
			'std' => $args['fonts']
		),
	)

);

$sections[] = array(
	'icon' => DS_OPTIONS_URL.'img/glyphicons/glyphicons_050_link.png',
	'title' => __('Social Accounts', 'devn'),
	'desc' => __('Set your socials and will be displayed icons at header and footer ', 'devn'),
	'fields' => array(
		array(
			'id' => 'feed',
			'type' => 'text',
			'title' => __('Your Feed RSS', 'devn'),
			'sub_desc' => __('Enter full link e.g: http://yoursite.com/feed', 'devn'),
			'std' => 'feed'
		),
		array(
			'id' => 'facebook',
			'type' => 'text',
			'title' => __('Your Facebook Account', 'devn'),
			'sub_desc' => __('Social icon will not display if you leave empty', 'devn'),
			'std' => 'devn'
		),
		array(
			'id' => 'twitter',
			'type' => 'text',
			'title' => __('Your Twitter Account', 'devn'),
			'sub_desc' => __('Social icon will not display if you leave empty', 'devn'),
			'std' => 'devn'
		),
		array(
			'id' => 'google',
			'type' => 'text',
			'title' => __('Your Google+ Account', 'devn'),
			'sub_desc' => __('Social icon will not display if you leave empty', 'devn'),
			'std' => 'devn'
		),
		array(
			'id' => 'linkedin',
			'type' => 'text',
			'title' => __('Your LinkedIn Account', 'devn'),
			'sub_desc' => __('Social icon will not display if you leave empty', 'devn'),
			'std' => 'devn'
		),
		array(
			'id' => 'youtube',
			'type' => 'text',
			'title' => __('Your Youtube Chanel', 'devn'),
			'sub_desc' => __('Social icon will not display if you leave empty', 'devn'),
			'std' => 'devn'
		),
		array(
			'id' => 'pinterest',
			'type' => 'text',
			'title' => __('Your Pinterest Account', 'devn'),
			'sub_desc' => __('Social icon will not display if you leave empty', 'devn'),
			'std' => 'devn'
		),
		array(
			'id' => 'flickr',
			'type' => 'text',
			'title' => __('Your Flickr Account', 'devn'),
			'sub_desc' => __('Social icon will display if you leave empty', 'devn'),
			'std' => 'devn'
		),
		array(
			'id' => 'vimeo',
			'type' => 'text',
			'title' => __('Your Vimeo Account', 'devn'),
			'sub_desc' => __('Social icon will display if you leave empty', 'devn'),
			'std' => 'devn'
		)
		
	)

);

			
	$tabs = array();
			
	if (function_exists('wp_get_theme')){
		$theme_data = wp_get_theme();
		$theme_uri = $theme_data->get('ThemeURI');
		$description = $theme_data->get('Description');
		$author = $theme_data->get('Author');
		$version = $theme_data->get('Version');
		$tags = $theme_data->get('Tags');
	}else{
		$theme_data = wp_get_theme(trailingslashit(get_stylesheet_directory()).'style.css');
		$theme_uri = $theme_data['URI'];
		$description = $theme_data['Description'];
		$author = $theme_data['Author'];
		$version = $theme_data['Version'];
		$tags = $theme_data['Tags'];
	}	
	
	
	
	if(file_exists(trailingslashit(get_stylesheet_directory()).'README.html')){
		$tabs['theme_docs'] = array(
						'icon' => DS_OPTIONS_URL.'img/glyphicons/glyphicons_071_book.png',
						'title' => __('Documentation', 'devn'),
						'content' => nl2br(devnExt::file( 'get', trailingslashit(get_stylesheet_directory()).'README.html'))
						);
	}//if

	global $DS_Options, $devn_settings;
	$DS_Options = new DS_Options($sections, $args, $tabs);
	$devn_settings = get_option( $args['opt_name'] );;

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function video_get_start($field, $value){
	
	switch( $field['id'] ){
		case 'inspector':
		?>
			<iframe width="560" height="315" src="http://www.youtube.com/embed/rO8HYqUUbL8?vq=hd720&rel=0&start=76" frameborder="0" allowfullscreen></iframe>
		<?php
		break;
		case 'grid':
		?>
			<iframe width="560" height="315" src="http://www.youtube.com/embed/rO8HYqUUbL8?vq=hd720&rel=0" frameborder="0" allowfullscreen></iframe>
		<?php
		break;
	}

}//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;
	$value =  'just testing';	
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}//function
?>