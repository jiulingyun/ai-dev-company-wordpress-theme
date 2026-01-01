<?php
/**
 * Bootstraps the Theme.
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Classes;

use AI_Dev_Theme\Inc\Traits\Singleton;

class AI_Dev_Theme {
	use Singleton;

	protected function __construct() {
		// Load class.
		Assets::get_instance();
		Setup::get_instance();
		CPT_Projects::get_instance();
		Elementor::get_instance();
		Customizer::get_instance();
		SEO::get_instance();
        AI_SEO::get_instance();
	}
}
