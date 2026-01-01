<?php
/**
 * Theme functions and definitions
 */

if ( ! defined( 'AI_DEV_THEME_VERSION' ) ) {
	define( 'AI_DEV_THEME_VERSION', '1.0.0' );
}

if ( ! defined( 'AI_DEV_THEME_DIR_PATH' ) ) {
	define( 'AI_DEV_THEME_DIR_PATH', untrailingslashit( get_template_directory() ) );
}

if ( ! defined( 'AI_DEV_THEME_DIR_URI' ) ) {
	define( 'AI_DEV_THEME_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
}

require_once AI_DEV_THEME_DIR_PATH . '/inc/helpers.php';
require_once AI_DEV_THEME_DIR_PATH . '/inc/template-tags.php';

function ai_dev_theme_get_theme_instance() {
	\AI_Dev_Theme\Inc\Classes\AI_Dev_Theme::get_instance();
}
ai_dev_theme_get_theme_instance();

