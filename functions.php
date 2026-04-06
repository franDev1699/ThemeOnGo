<?php
/**
 * ThemeOnGo functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define Theme Version
define( 'THEMEONGO_VERSION', '1.0.0' );

/**
 * Theme Setup
 */
function themeongo_setup() {
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    // Register Navigation Menus
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'themeongo' ),
        'footer'  => esc_html__( 'Footer Menu', 'themeongo' ),
    ) );

    // Add support for core custom logo.
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
    ) );

    // Add support for Elementor
    add_theme_support( 'elementor' );
}
add_action( 'after_setup_theme', 'themeongo_setup' );

/**
 * Enqueue scripts and styles.
 */
function themeongo_scripts() {
    // Fonts
    wp_enqueue_style( 'themeongo-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap', array(), null );
    
    // Bootstrap CSS
    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3' );
    
    // FontAwesome
    wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );

    // Main Theme CSS
    wp_enqueue_style( 'themeongo-style', get_template_directory_uri() . '/assets/css/main.css', array(), THEMEONGO_VERSION );
    
    // Base style.css (required by WP)
    wp_enqueue_style( 'themeongo-base', get_stylesheet_uri(), array(), THEMEONGO_VERSION );

    // Bootstrap JS
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '5.3.3', true );
    
    // Main Theme JS
    wp_enqueue_script( 'themeongo-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), THEMEONGO_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'themeongo_scripts' );

/**
 * Add Bootstrap 5 classes to Nav Menu
 */
function themeongo_nav_menu_classes( $classes, $item, $args ) {
    if ( 'primary' === $args->theme_location ) {
        $classes[] = 'nav-item';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'themeongo_nav_menu_classes', 10, 3 );

function themeongo_nav_menu_link_attributes( $atts, $item, $args ) {
    if ( 'primary' === $args->theme_location ) {
        $atts['class'] = 'nav-link';
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'themeongo_nav_menu_link_attributes', 10, 3 );

/**
 * Customizer Additions
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Register Custom Elementor Widgets
 */
function themeongo_register_elementor_widgets( $widgets_manager ) {
    require_once( get_template_directory() . '/inc/elementor-widgets/class-badge-widget.php' );
    require_once( get_template_directory() . '/inc/elementor-widgets/class-pill-badge-widget.php' );
    require_once( get_template_directory() . '/inc/elementor-widgets/class-hero-slider-widget.php' );
    require_once( get_template_directory() . '/inc/elementor-widgets/class-image-float-widget.php' );
    require_once( get_template_directory() . '/inc/elementor-widgets/class-photo-collage-widget.php' );
    
    $widgets_manager->register( new \ThemeOnGo_Badge_Widget() );
    $widgets_manager->register( new \ThemeOnGo_Pill_Badge_Widget() );
    $widgets_manager->register( new \ThemeOnGo_Hero_Slider_Widget() );
    $widgets_manager->register( new \ThemeOnGo_Image_Float_Widget() );
    $widgets_manager->register( new \ThemeOnGo_Photo_Collage_Widget() );
}
add_action( 'elementor/widgets/register', 'themeongo_register_elementor_widgets' );
