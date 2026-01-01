<?php
/**
 * Theme functions and definitions
 */

if ( ! defined( 'AI_DEV_THEME_VERSION' ) ) {
	define( 'AI_DEV_THEME_VERSION', '1.0.0' );
}

function ai_dev_theme_setup() {
	// Make theme available for translation.
	load_theme_textdomain( 'ai-dev-theme', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );
    
    // Register menus
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'ai-dev-theme' ),
        'footer'  => esc_html__( 'Footer Menu', 'ai-dev-theme' ),
    ) );
}
add_action( 'after_setup_theme', 'ai_dev_theme_setup' );

function ai_dev_theme_scripts() {
	// Enqueue main CSS
	wp_enqueue_style( 'ai-dev-theme-main', get_template_directory_uri() . '/assets/css/main.css', array(), AI_DEV_THEME_VERSION );
	
	// Enqueue main JS
	$script_asset = include( get_template_directory() . '/assets/js/build/main.asset.php' );
	wp_enqueue_script( 
		'ai-dev-theme-script', 
		get_template_directory_uri() . '/assets/js/build/main.js', 
		$script_asset['dependencies'], 
		$script_asset['version'], 
		true 
	);
	
	// Enqueue style.css for theme metadata and potential overrides
	wp_enqueue_style( 'ai-dev-theme-style', get_stylesheet_uri(), array(), AI_DEV_THEME_VERSION );
}
add_action( 'wp_enqueue_scripts', 'ai_dev_theme_scripts' );
