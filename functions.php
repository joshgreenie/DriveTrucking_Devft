<?php
/**
 * _scorch functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _scorch
 */

if ( ! function_exists( '_scorch_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function _scorch_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _scorch, use a find and replace
	 * to change '_scorch' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( '_scorch', get_template_directory() . '/languages' );

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

	add_image_size( 'company-logo', 300, 9999 ); //300 pixels wide (and unlimited height)

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
        'primary' => esc_html__( 'Primary', '_scorch' ),
        'main' => esc_html__( 'Main Nav', '_scorch' ),
        'account' => esc_html__( 'Account', '_scorch' ),
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
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( '_scorch_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', '_scorch_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _scorch_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_scorch_content_width', 640 );
}
add_action( 'after_setup_theme', '_scorch_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _scorch_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', '_scorch' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Account', '_scorch' ),
        'id'            => 'account',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Blog', '_scorch' ),
        'id'            => 'blog',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
	register_sidebar( array(
		'name'          => __( 'Footer One', '_scorch' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<aside id="footer-one" class="menu %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Two', '_scorch' ),
		'id'            => 'footer-2',
		'description'   => '',
		'before_widget' => '<aside id="footer-two" class="menu %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Three', '_scorch' ),
		'id'            => 'footer-3',
		'description'   => '',
		'before_widget' => '<aside id="footer-three" class="menu %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Four', '_scorch' ),
		'id'            => 'footer-4',
		'description'   => '',
		'before_widget' => '<aside id="footer-four" class="menu %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Five', '_scorch' ),
		'id'            => 'footer-5',
		'description'   => '',
		'before_widget' => '<aside id="footer-five" class="menu %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Disclaimer', '_scorch' ),
		'id'            => 'footer-disclaimer',
		'description'   => '',
		'before_widget' => '<aside id="footer-disclaimer" class="menu %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', '_scorch_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function _scorch_scripts() {
	wp_enqueue_style( '_scorch-style', get_stylesheet_uri() );

	wp_enqueue_script( '_scorch-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( '_scorch-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'responsiveslides-js', get_stylesheet_directory_uri() . '/js/responsiveslides.js', array('jquery'), '1.0.0', false );

	wp_enqueue_script( 'select2-full-js', get_stylesheet_directory_uri() . '/js/select2.full.min.js', array('jquery'), '4.0.2', false );

    wp_enqueue_script( 'owl-js', get_stylesheet_directory_uri() . '/js/owl.carousel.js', array('jquery'), '1.0.0', false );

    wp_enqueue_style( 'owl-css', get_stylesheet_directory_uri() . '/inc/owl.carousel.css', false, false, false );

    wp_enqueue_script( '_scorch-js', get_stylesheet_directory_uri() . '/js/_scorch.js', array('jquery'), '1.0.0', false );

    wp_enqueue_script( 'isotope-js', get_stylesheet_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), '1.0.0', false );

//
//    wp_enqueue_style( 'component-css', get_stylesheet_directory_uri() . '/css/component.css', false, false, false );
//    wp_enqueue_style( 'select-css', get_stylesheet_directory_uri() . '/css/cs-select.css', false, false, false );
//    wp_enqueue_style( 'boxes-css', get_stylesheet_directory_uri() . '/css/cs-skin-boxes.css', false, false, false );
//
//
//    wp_enqueue_script( 'modernizr-js', get_stylesheet_directory_uri() . '/js/forms/modernizr.custom.js', array('jquery'), '1.0.0', false );
//    wp_enqueue_script( 'classie-js', get_stylesheet_directory_uri() . '/js/forms/classie.js', array('jquery'), '1.0.0', true );
//    wp_enqueue_script( 'selectFx-js', get_stylesheet_directory_uri() . '/js/forms/selectFx.js', array('jquery'), '1.0.0', true );
//    wp_enqueue_script( 'fullscreenForm-js', get_stylesheet_directory_uri() . '/js/forms/fullscreenForm.js', array('jquery'), '1.0.0', true );



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '_scorch_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Woocommerce compatibility files.
 */
//require get_template_directory() . '/inc/woocommerce-settings.php';
/**
 * Load Advanced Custom fields file.
 */
require get_template_directory() . '/inc/advanced-custom-fields-build.php';

/**
 * Load Advanced Custom fields file.
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Load Advanced Custom fields file.
 */
require get_template_directory() . '/inc/feeds.php';

/**
 * Load Advanced Custom fields file.
 */
require get_template_directory() . '/inc/Mobile_Detect.php';

/**
 * Load Advanced Custom fields file.
 */
require get_template_directory() . '/inc/gravity-submit.php';

/**
 * Load Advanced Custom fields file.
 */
require get_template_directory() . '/inc/acf-taxonomy-depth-rule.php';

/**
 * Load redirection file.
 */
require get_template_directory() . '/inc/redirects.php';

/**
 * Load shortcodes file.
 */
require get_template_directory() . '/inc/shortcodes.php';


