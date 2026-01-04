<?php
/**
 * Assets Management Class
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Classes;

use AI_Dev_Theme\Inc\Traits\Singleton;

class Assets {
	use Singleton;

	protected function __construct() {
		$this->setup_hooks();
	}

	protected function setup_hooks() {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );
        
        // Resource Hints (Preconnect)
        add_action( 'wp_head', [ $this, 'add_resource_hints' ], 1 );
	}

    public function add_resource_hints() {
        ?>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <?php
    }

	public function register_styles() {
		// Register Main CSS
		wp_register_style( 'ai-dev-theme-main', get_template_directory_uri() . '/assets/css/main.css', [], AI_DEV_THEME_VERSION );
		
		// Enqueue Main CSS
		wp_enqueue_style( 'ai-dev-theme-main' );

		// FAQ override (ensure theme without rebuild immediately shows FAQ styles)
		wp_register_style( 'ai-dev-theme-faq-override', get_template_directory_uri() . '/assets/css/ai-faq-override.css', array( 'ai-dev-theme-main' ), AI_DEV_THEME_VERSION );
		wp_enqueue_style( 'ai-dev-theme-faq-override' );
		
		// Theme-toggle immediate override (ensure correct sun/moon visibility without rebuild)
		wp_register_style( 'ai-dev-theme-toggle-override', get_template_directory_uri() . '/assets/css/ai-theme-toggle-override.css', array( 'ai-dev-theme-main' ), AI_DEV_THEME_VERSION );
		wp_enqueue_style( 'ai-dev-theme-toggle-override' );

		// Swiper CSS (CDN) for project slider (use unpkg @8 as recommended)
		wp_register_style( 'ai-dev-theme-swiper', 'https://unpkg.com/swiper@8/swiper-bundle.min.css', array(), '8.0.0' );
		wp_enqueue_style( 'ai-dev-theme-swiper' );

		// Enqueue style.css
		wp_enqueue_style( 'ai-dev-theme-style', get_stylesheet_uri(), [], AI_DEV_THEME_VERSION );

        // Google Fonts (Optimized loading)
        wp_enqueue_style( 
            'ai-dev-theme-fonts', 
            'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=JetBrains+Mono&family=Orbitron:wght@700&display=swap', 
            [], 
            null 
        );

        // Font Awesome 6 (Latest) - Using a distinct handle to ensure loading
        wp_enqueue_style( 'ai-dev-theme-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', [], '6.5.1' );
	}

	public function register_scripts() {
		// Swiper JS (CDN) for project slider (use unpkg @8 as recommended)
		wp_register_script( 'ai-dev-theme-swiper', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', array(), '8.0.0', true );
		wp_enqueue_script( 'ai-dev-theme-swiper' );

		// Enqueue Main JS
		$script_asset = include( get_template_directory() . '/assets/js/build/main.asset.php' );
		
		wp_enqueue_script( 
			'ai-dev-theme-script', 
			get_template_directory_uri() . '/assets/js/build/main.js', 
			$script_asset['dependencies'], 
			$script_asset['version'], 
			true 
		);
	}
}
