<?php
/**
 * PizzaHouse functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package PizzaHouse
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.1' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pizzahouse_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on PizzaHouse, use a find and replace
		* to change 'pizzahouse' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'pizzahouse', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

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
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header' => esc_html__( 'Header Primary', 'pizzahouse' ),
            'footer-primary' => esc_html__( 'Footer Primary', 'pizzahouse' ),
            'footer-secondary' => esc_html__( 'Footer Secondary', 'pizzahouse' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'pizzahouse_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'pizzahouse_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pizzahouse_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pizzahouse_content_width', 640 );
}
add_action( 'after_setup_theme', 'pizzahouse_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pizzahouse_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pizzahouse' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'pizzahouse' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'pizzahouse_widgets_init' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

//=======================================================================
// ==================== My Theme Code ===================================
//=======================================================================

/**
 * Load Woocommerce customizer functions
 */
if ( class_exists( 'woocommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce-functions.php';
}

/**
 * Load PizzaHouse Post Types
 */
require get_template_directory() . '/inc/post-types/post-types.php';

/**
 * Load PizzaHouse Shortcodes
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Load PizzaHouse Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Load Contact Form 7 functions
 */
require get_template_directory() . '/inc/contact-form-functions.php';

/**
 * Redux Options Panel configuration
 */

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/redux-core/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/redux-core/framework.php' );
}
if ( file_exists( get_template_directory() . '/inc/redux-config.php' ) ) {
    require_once( get_template_directory() . '/inc/redux-config.php' );
}


/**
 * Enqueue scripts and styles.
 */

function pizzahouse_scripts() {
	wp_enqueue_style( 'pizzahouse-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', _S_VERSION );
    wp_enqueue_style( 'pizzahouse-theme-fonts', get_template_directory_uri() . '/assets/css/fonts.css', _S_VERSION );
    wp_enqueue_style( 'pizzahouse-theme-style', get_template_directory_uri() . '/assets/css/style.css', _S_VERSION );
    wp_enqueue_style( 'pizzahouse-fontawesome', get_template_directory_uri() . '/assets/fontawesome/css/fontawesome.css', _S_VERSION );
    wp_enqueue_style( 'pizzahouse-fontawesome-brands', get_template_directory_uri() . '/assets/fontawesome/css/brands.css', _S_VERSION );
    wp_enqueue_style( 'pizzahouse-fontawesome-solid', get_template_directory_uri() . '/assets/fontawesome/css/solid.css', _S_VERSION );
    wp_style_add_data( 'pizzahouse-style', 'rtl', 'replace' );

    // Remove jquery default on frontend 
    if( ! is_admin() ){
        $jquery_scripts = array(
            'jquery-core',
            'jquery-migrate',
            'jquery'
        );

        foreach( $jquery_scripts as $jquery_script ) {
            wp_dequeue_script( $jquery_script );
            wp_deregister_script( $jquery_script );
        }
    }
     
	wp_enqueue_script('woocommerce-ajax-add-to-cart', get_template_directory_uri() . '/assets/js/ajax-add-to-cart.js', array('jquery', 'wp-i18n'), '', true);
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/core.min.js', array(), '3.2.1' );
    wp_enqueue_script( 'pizzahouse-script', get_template_directory_uri() . '/assets/js/script.js', array( 'jquery' ), false, true );
   // wp_enqueue_script( 'pizzahouse-script-slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    // Enqueue Ajax add to cart JS file 
    if ( function_exists('is_product') && is_product() ) {
		wp_set_script_translations('woocommerce-ajax-add-to-cart', 'pizzahouse');
	}	
}
add_action( 'wp_enqueue_scripts', 'pizzahouse_scripts' );

/**
 *  Register and load the widget
 */

function wpb_load_widget() {
    register_widget( 'pizzahouse_filter_category' );
	register_widget( 'pizzahouse_filter_price' );
	register_widget( 'pizzahouse_popular_products' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

// Remove sidebar on Checkout, Cart page
function remove_sidebar(){
    if( is_checkout() || is_cart() || is_single() ){
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
    }
}
add_action('woocommerce_before_main_content', 'remove_sidebar' );



remove_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10); 