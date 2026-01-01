<?php
/**
 * Projects Custom Post Type
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Classes;

use AI_Dev_Theme\Inc\Traits\Singleton;

class CPT_Projects {
	use Singleton;

	protected function __construct() {
		$this->setup_hooks();
	}

	protected function setup_hooks() {
		add_action( 'init', [ $this, 'create_projects_cpt' ], 0 );
		add_action( 'init', [ $this, 'create_project_taxonomies' ], 0 );
	}

	public function create_projects_cpt() {

		$labels = [
			'name'                  => _x( 'Projects', 'Post Type General Name', 'ai-dev-theme' ),
			'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'ai-dev-theme' ),
			'menu_name'             => _x( 'Projects', 'Admin Menu text', 'ai-dev-theme' ),
			'name_admin_bar'        => _x( 'Project', 'Add New on Toolbar', 'ai-dev-theme' ),
			'archives'              => __( 'Project Archives', 'ai-dev-theme' ),
			'attributes'            => __( 'Project Attributes', 'ai-dev-theme' ),
			'parent_item_colon'     => __( 'Parent Project:', 'ai-dev-theme' ),
			'all_items'             => __( 'All Projects', 'ai-dev-theme' ),
			'add_new_item'          => __( 'Add New Project', 'ai-dev-theme' ),
			'add_new'               => __( 'Add New', 'ai-dev-theme' ),
			'new_item'              => __( 'New Project', 'ai-dev-theme' ),
			'edit_item'             => __( 'Edit Project', 'ai-dev-theme' ),
			'update_item'           => __( 'Update Project', 'ai-dev-theme' ),
			'view_item'             => __( 'View Project', 'ai-dev-theme' ),
			'view_items'            => __( 'View Projects', 'ai-dev-theme' ),
			'search_items'          => __( 'Search Project', 'ai-dev-theme' ),
			'not_found'             => __( 'Not found', 'ai-dev-theme' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'ai-dev-theme' ),
			'featured_image'        => __( 'Featured Image', 'ai-dev-theme' ),
			'set_featured_image'    => __( 'Set featured image', 'ai-dev-theme' ),
			'remove_featured_image' => __( 'Remove featured image', 'ai-dev-theme' ),
			'use_featured_image'    => __( 'Use as featured image', 'ai-dev-theme' ),
			'insert_into_item'      => __( 'Insert into Project', 'ai-dev-theme' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Project', 'ai-dev-theme' ),
			'items_list'            => __( 'Projects list', 'ai-dev-theme' ),
			'items_list_navigation' => __( 'Projects list navigation', 'ai-dev-theme' ),
			'filter_items_list'     => __( 'Filter Projects list', 'ai-dev-theme' ),
		];
		$args   = [
			'label'               => __( 'Project', 'ai-dev-theme' ),
			'description'         => __( 'The projects', 'ai-dev-theme' ),
			'labels'              => $labels,
			'menu_icon'           => 'dashicons-portfolio',
			'supports'            => [
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'revisions',
				'author',
				'comments',
				'trackbacks',
				'page-attributes',
				'custom-fields',
			],
			'taxonomies'          => [],
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'hierarchical'        => false,
			'exclude_from_search' => false,
			'show_in_rest'        => true, // Enable Gutenberg editor
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		];

		register_post_type( 'project', $args );

	}

	public function create_project_taxonomies() {
		// Register Technology Taxonomy
		$labels = [
			'name'              => _x( 'Technologies', 'taxonomy general name', 'ai-dev-theme' ),
			'singular_name'     => _x( 'Technology', 'taxonomy singular name', 'ai-dev-theme' ),
			'search_items'      => __( 'Search Technologies', 'ai-dev-theme' ),
			'all_items'         => __( 'All Technologies', 'ai-dev-theme' ),
			'parent_item'       => __( 'Parent Technology', 'ai-dev-theme' ),
			'parent_item_colon' => __( 'Parent Technology:', 'ai-dev-theme' ),
			'edit_item'         => __( 'Edit Technology', 'ai-dev-theme' ),
			'update_item'       => __( 'Update Technology', 'ai-dev-theme' ),
			'add_new_item'      => __( 'Add New Technology', 'ai-dev-theme' ),
			'new_item_name'     => __( 'New Technology Name', 'ai-dev-theme' ),
			'menu_name'         => __( 'Technologies', 'ai-dev-theme' ),
		];
		$args   = [
			'labels'             => $labels,
			'description'        => __( 'Technologies used in the project', 'ai-dev-theme' ),
			'hierarchical'       => true, // Like categories
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_tagcloud'      => true,
			'show_in_rest'       => true,
			'show_admin_column'  => true,
		];
		register_taxonomy( 'technology', [ 'project' ], $args );

		// Register Industry Taxonomy
		$labels_industry = [
			'name'              => _x( 'Industries', 'taxonomy general name', 'ai-dev-theme' ),
			'singular_name'     => _x( 'Industry', 'taxonomy singular name', 'ai-dev-theme' ),
			'search_items'      => __( 'Search Industries', 'ai-dev-theme' ),
			'all_items'         => __( 'All Industries', 'ai-dev-theme' ),
			'parent_item'       => __( 'Parent Industry', 'ai-dev-theme' ),
			'parent_item_colon' => __( 'Parent Industry:', 'ai-dev-theme' ),
			'edit_item'         => __( 'Edit Industry', 'ai-dev-theme' ),
			'update_item'       => __( 'Update Industry', 'ai-dev-theme' ),
			'add_new_item'      => __( 'Add New Industry', 'ai-dev-theme' ),
			'new_item_name'     => __( 'New Industry Name', 'ai-dev-theme' ),
			'menu_name'         => __( 'Industries', 'ai-dev-theme' ),
		];
		$args_industry   = [
			'labels'             => $labels_industry,
			'description'        => __( 'Industry of the project', 'ai-dev-theme' ),
			'hierarchical'       => true,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_tagcloud'      => true,
			'show_in_rest'       => true,
			'show_admin_column'  => true,
		];
		register_taxonomy( 'industry', [ 'project' ], $args_industry );
	}
}
