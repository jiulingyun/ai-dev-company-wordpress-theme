<?php
/**
 * Theme Setup Class
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Classes;

use AI_Dev_Theme\Inc\Traits\Singleton;

class Setup {
	use Singleton;

	protected function __construct() {
		// load class.
		$this->setup_hooks();
	}

	protected function setup_hooks() {
		/**
		 * Actions.
		 */
		add_action( 'after_setup_theme', [ $this, 'setup_theme' ] );
		add_action( 'widgets_init', [ $this, 'register_sidebars' ] );
	}

	public function register_sidebars() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'ai-dev-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ai-dev-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s mb-lg">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title h5 mb-md">',
			'after_title'   => '</h2>',
		) );

        $footer_sidebars = [
            'footer-1' => __( 'Footer Column 1', 'ai-dev-theme' ),
            'footer-2' => __( 'Footer Column 2', 'ai-dev-theme' ),
            'footer-3' => __( 'Footer Column 3', 'ai-dev-theme' ),
            'footer-4' => __( 'Footer Column 4', 'ai-dev-theme' ),
        ];

        foreach ( $footer_sidebars as $id => $name ) {
            register_sidebar( array(
                'name'          => $name,
                'id'            => $id,
                'description'   => esc_html__( 'Add widgets here for the footer.', 'ai-dev-theme' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s mb-lg">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title h5 mb-md text-primary">',
                'after_title'   => '</h2>',
            ) );
        }
	}

	public function setup_theme() {
		// Make theme available for translation.
		load_theme_textdomain( 'ai-dev-theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Register menus
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'ai-dev-theme' ),
			'footer'  => esc_html__( 'Footer Menu', 'ai-dev-theme' ),
		) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo', [
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		] );
	}
}
