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

		// Enqueue style.css
		wp_enqueue_style( 'ai-dev-theme-style', get_stylesheet_uri(), [], AI_DEV_THEME_VERSION );

        // Google Fonts (Optimized loading)
        wp_enqueue_style( 
            'ai-dev-theme-fonts', 
            'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=JetBrains+Mono&family=Orbitron:wght@700&display=swap', 
            [], 
            null 
        );
	}

	public function register_scripts() {
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
