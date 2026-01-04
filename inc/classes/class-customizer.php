<?php
/**
 * Customizer Settings
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Classes;

use AI_Dev_Theme\Inc\Traits\Singleton;
use WP_Customize_Manager;

class Customizer {
	use Singleton;

	protected function __construct() {
		// Initialize the customizer.
		add_action( 'customize_register', [ $this, 'register_customizer_sections' ] );
	}

	/**
	 * Register Customizer sections and settings.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function register_customizer_sections( $wp_customize ) {
		// Add Section: Footer Settings
		$wp_customize->add_section( 'footer_settings', [
			'title'    => __( 'Footer Settings', 'ai-dev-theme' ),
			'priority' => 120,
		] );

		// Add logo settings to the existing Site Identity (title_tagline) section
		// Light mode logo
		$wp_customize->add_setting( 'logo_light', array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'logo_light', array(
			'label'    => __( 'Logo (Light)', 'ai-dev-theme' ),
			'section'  => 'title_tagline',
			'settings' => 'logo_light',
		) ) );

		// Dark mode logo
		$wp_customize->add_setting( 'logo_dark', array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'logo_dark', array(
			'label'    => __( 'Logo (Dark)', 'ai-dev-theme' ),
			'section'  => 'title_tagline',
			'settings' => 'logo_dark',
		) ) );

		/**
		 * Social Links
		 */
		$social_networks = [
			'twitter'  => __( 'Twitter URL', 'ai-dev-theme' ),
			'github'   => __( 'GitHub URL', 'ai-dev-theme' ),
			'linkedin' => __( 'LinkedIn URL', 'ai-dev-theme' ),
		];

		foreach ( $social_networks as $id => $label ) {
			// Setting
			$wp_customize->add_setting( "footer_social_{$id}", [
				'default'           => '#',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			] );

			// Control
			$wp_customize->add_control( "footer_social_{$id}", [
				'label'    => $label,
				'section'  => 'footer_settings',
				'settings' => "footer_social_{$id}",
				'type'     => 'url',
			] );
		}
	}
}
