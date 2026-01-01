<?php
/**
 * Elementor Integration Class
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Classes;

use AI_Dev_Theme\Inc\Traits\Singleton;

class Elementor {
	use Singleton;

	protected function __construct() {
		$this->setup_hooks();
	}

	protected function setup_hooks() {
		// Add theme support for Elementor
		add_action( 'after_setup_theme', [ $this, 'add_elementor_support' ] );
		
		// Add custom categories for Elementor widgets
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_widget_categories' ] );
		
		// Enqueue Elementor editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'enqueue_editor_scripts' ] );
	}

	public function add_elementor_support() {
		add_theme_support( 'elementor' );
		
		// Set default content width for Elementor
		if ( ! isset( $content_width ) ) {
			$content_width = 1140;
		}
	}

	public function add_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'ai-dev-theme',
			[
				'title' => __( 'AI Dev Theme', 'ai-dev-theme' ),
				'icon'  => 'fa fa-plug',
			]
		);
	}

	public function enqueue_editor_scripts() {
		wp_enqueue_style(
			'ai-dev-theme-elementor-editor',
			get_template_directory_uri() . '/assets/css/elementor-editor.css',
			[],
			AI_DEV_THEME_VERSION
		);
	}
}
