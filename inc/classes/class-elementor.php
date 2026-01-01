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

        // Register custom widgets
        add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
	}

    public function register_widgets( $widgets_manager ) {
        // Require the widget class
        require_once get_template_directory() . '/inc/widgets/elementor/class-ai-advantages.php';
        require_once get_template_directory() . '/inc/widgets/elementor/class-project-showcase.php';
        require_once get_template_directory() . '/inc/widgets/elementor/class-tech-stack.php';
        require_once get_template_directory() . '/inc/widgets/elementor/class-team-grid.php';
        require_once get_template_directory() . '/inc/widgets/elementor/class-testimonials.php';
        require_once get_template_directory() . '/inc/widgets/elementor/class-stats-counter.php';
        require_once get_template_directory() . '/inc/widgets/elementor/class-timeline.php';
        require_once get_template_directory() . '/inc/widgets/elementor/class-blog-posts.php';
        require_once get_template_directory() . '/inc/widgets/elementor/class-contact-form.php';
        require_once get_template_directory() . '/inc/widgets/elementor/class-about-hero.php';
        require_once get_template_directory() . '/inc/widgets/elementor/class-section-title.php';

        // Register the widget
        $widgets_manager->register( new \AI_Dev_Theme\Inc\Widgets\Elementor\AI_Advantages() );
        $widgets_manager->register( new \AI_Dev_Theme\Inc\Widgets\Elementor\Project_Showcase() );
        $widgets_manager->register( new \AI_Dev_Theme\Inc\Widgets\Elementor\Tech_Stack() );
        $widgets_manager->register( new \AI_Dev_Theme\Inc\Widgets\Elementor\Team_Grid() );
        $widgets_manager->register( new \AI_Dev_Theme\Inc\Widgets\Elementor\Testimonials() );
        $widgets_manager->register( new \AI_Dev_Theme\Inc\Widgets\Elementor\Stats_Counter() );
        $widgets_manager->register( new \AI_Dev_Theme\Inc\Widgets\Elementor\Timeline() );
        $widgets_manager->register( new \AI_Dev_Theme\Inc\Widgets\Elementor\Blog_Posts() );
        $widgets_manager->register( new \AI_Dev_Theme\Inc\Widgets\Elementor\Contact_Form() );
        $widgets_manager->register( new \AI_Dev_Theme\Inc\Widgets\Elementor\About_Hero() );
        $widgets_manager->register( new \AI_Dev_Theme\Inc\Widgets\Elementor\Section_Title() );
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
