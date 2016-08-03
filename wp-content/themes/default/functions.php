<?php
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own twentysixteen_setup() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Sixteen, use a find and replace
	 * to change 'twentysixteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentysixteen', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	//add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 0, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'twentysixteen' ),
		'social'  => __( 'Social Links Menu', 'twentysixteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );
}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentysixteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'twentysixteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'twentysixteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Sixteen.
 *
 * Create your own twentysixteen_fonts_url() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentysixteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	//wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	//wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	//wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20150825' );
	//wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	//wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20150825' );
	//wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	//wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20150825' );
	//wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	//wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	//wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

	//wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20150825', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		//wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20150825' );
	}

	//wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150825', true );

	wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'twentysixteen' ),
		'collapse' => __( 'collapse child menu', 'twentysixteen' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10 , 3 );

function lb_keep_me_logged_in( $expirein ) {
    //return 31556926; // 1 year in seconds
	return 86400; // 24 hours in seconds
}
add_filter( 'auth_cookie_expiration', 'lb_keep_me_logged_in' );

remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version

function lb_sanitize($string,$type=""){
	$string = str_replace(array('[\', \']'), '', $string);
	$string = preg_replace('/\[.*\]/U', '', $string);
	$string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
	if($type=='image'){
		$string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '_', $string);
		$string = strtolower($string);
	}
	return (trim($string, '-'));
}

/*
* Strip Content with tags, short codes, script tags,
*/
function lb_strip_tags($cotnent){
	$post_content = strip_shortcodes($cotnent);
	$post_content = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $post_content); // Removing <script> tag
	$post_content = strip_tags($post_content);
	
	return $post_content;
}

function lb_truncate($text, $numchars=25){
	$chars = $numchars;
	if ( strlen($text) > $numchars ){
		$text_content = substr($text,0,$numchars);
		return $text_content;
	}else{
		return $text;
	}
}

function lb_convert_date($date, $format = "Y-m-d"){
	list($m, $d, $y) = explode('-', $date);
	return date($format, mktime(0,0,0,$m,$d,$y));
}

function custom_login() { 
	echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/custom-login.css" />'; 
}
//add_action('login_head', 'custom_login');

function isValidEmail($email) {
	$pattern = "/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i";
    return preg_match($pattern, $email) ? true : false;
}

function isValidZip($zip) {
	$ZIPREG=array(
		"US"=>"^\d{5}([\-]?\d{4})?$",
		"CA"=>"^([ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ])\ {0,1}(\d[ABCEGHJKLMNPRSTVWXYZ]\d)$"
	);
	
	if (preg_match("/".$ZIPREG['US']."/i",$zip) || preg_match("/".$ZIPREG['CA']."/i",$zip)){
		return true;
	}else{
		return false;
	}
}

function isValidPhone($number) {
	$formats = array('###-###-####', '####-###-###', '(###) ###-####', '(###)###-####', '####-####-####', '##-###-####-####', '####-####', '###-###-###', '#####-###-###', '##########');
	$format = trim(ereg_replace("[0-9]", "#", $number));
	return (in_array($format, $formats)) ? true : false;
}

function lb_print_errors($errors){
	$msg = '<div class="errors"><ul>';
		foreach($errors as $error){
			$msg .= '<li>'.$error.'</li>';
		}
	$msg .= '</ul></div>';
	echo $msg;
}

function set_html_content_type() {
	return 'text/html';
}

/*--------------------------------------------------------------------------------------------------
	Shortcodes fixer
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'shortcode_empty_paragraph_fix' ) ) {
	function shortcode_empty_paragraph_fix($content){   
		$array = array (
				'<p>[' => '[', 
				']</p>' => ']', 
				']<br />' => ']'
			);
	
			$content = strtr($content, $array);
			return $content;
	}
}
add_filter('the_content', 'shortcode_empty_paragraph_fix');

/*
* Permalink Shortcode
* Usage [permalink id="49"]
*/
if (!function_exists('do_permalink')) {
	function do_permalink($atts) {
		extract(shortcode_atts(array(
			'id' => 1
		), $atts));
	
		return get_permalink($id);
	}
	add_shortcode('permalink', 'do_permalink');
}
add_filter('widget_text', 'do_shortcode');

/*
* Get Option Shortcode
* Usage [get_option_value key=""]
*/
if (!function_exists('do_get_option_value')) {
	function do_get_option_value($atts) {
		extract(shortcode_atts(array(
			'key' => 1
		), $atts));
	
		return get_option($key);
	}
	add_shortcode('get_option_value', 'do_get_option_value');
}
add_filter('widget_text', 'do_get_option_value');

/*
* Strip Content with tags, short codes, num chars, script tags, urls  
*/
function lb_strip_content($cotnent,$numchars=200){
	$post_content = strip_shortcodes($cotnent);
	$post_content = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $post_content); // Removing <script> tag
	$post_content = strip_tags($post_content);
	$post_content = lb_cleaner($post_content); // removing URLS	
	if ( strlen($post_content) > $numchars ){
		$post_content = substr($post_content,0,$numchars);
	}
	$post_content_array = explode(" ",$post_content);
	$post_content = implode(" ",array_slice($post_content_array,0,count($post_content_array)-1));
	return $post_content;
}

/*
* Remove URLs from text
*/
function lb_cleaner($url) {
  $U = explode(' ',$url);

  $W =array();
  foreach ($U as $k => $u) {
    if (stristr($u,'http') || (count(explode('.',$u)) > 1)) {
      unset($U[$k]);
      return lb_cleaner( implode(' ',$U));
    }
  }
  return implode(' ',$U);
}

// Remove version from the style and js files
function lb_remove_css_ver( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'lb_remove_css_ver', 10, 2 );

// Function to get the post/page content based on id
function lb_get_post_content($pid){
	$content_post = get_post($pid);
	$content = $content_post->post_content;
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}

// Returns the featured images path
function lb_get_featured_image_source($postid, $type='thumbnail'){
	$post_thumbnail_id = get_post_thumbnail_id( $postid );
	$attachment =  wp_get_attachment_image_src( $post_thumbnail_id, $type );
	return $attachment[0];
}

// Returns the upload folder path
function lb_get_upload_directory_uri(){
	$upload_dir = wp_upload_dir();
	return $upload_dir['baseurl'];
}

function lb_get_topmost_parent($post_id){
	$parent_id = get_post($post_id)->post_parent;
	return ($parent_id == 0)?$post_id:lb_get_topmost_parent($parent_id);		
}

function lb_get_parent_id($post_id){
	$parent_id = get_post($post_id)->post_parent;
	return $parent_id;		
}

function lb_get_parent_category_id($catid) {
	while ($catid) {
		$cat = get_category($catid); // get the object for the catid
		$catid = $cat->category_parent; // assign parent ID (if exists) to $catid
		$parent_category = $cat->cat_ID;
	}
	
	return $parent_category;
}

function lb_get_post_parent_category_id(){
	$post_category = get_the_category( $post->ID ); 
	return $post_category[0]->category_parent;
}

// prints next and prev post links for custom post type on single page
function lb_print_next_prev_post_links($orderby='post_date', $order='DESC', $posttype='post', $suffix){
	global $post;
	
	$args = array('posts_per_page'   => '-1', 'orderby' => $orderby, 'order' => $order,	'post_type' => $posttype, 'post_status' => 'publish');
	$c_postlist = get_posts( $args ); 	
	$c_posts = array();
	foreach ($c_postlist as $c_post) {
		$c_posts[] += $c_post->ID;
	}
	$current = array_search($post->ID, $c_posts);
	$prev_post_id = $c_posts[$current-1];
	$next_post_id = $c_posts[$current+1];
	if(!empty($prev_post_id) || !empty($next_post_id)){
	?>
		<div id="post-navigation" >			
			<ul class="medium-block-grid-2">				
				<li class="prev-post">
					<?php if(!empty($prev_post_id)){
							$prev_text = "&laquo; ".get_the_title($prev_post_id);
						?>
						<a href="<?php echo get_permalink($prev_post_id);?>"><?php echo $prev_text; ?></a>
					<?php }?>
				</li>				
				<li class="next-post text-right">
					<?php if(!empty($next_post_id)){
							$next_text = get_the_title($next_post_id)." &raquo;";
						?>
						<a href="<?php echo get_permalink($next_post_id);?>"><?php echo $next_text; ?></a>
					<?php }?>
				</li>
			</ul>
		</div>
	<?php
	} // if
}