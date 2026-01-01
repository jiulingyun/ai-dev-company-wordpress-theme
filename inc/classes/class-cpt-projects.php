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
        add_action( 'add_meta_boxes', [ $this, 'add_project_meta_boxes' ] );
        add_action( 'save_post', [ $this, 'save_project_meta' ] );
	}

    public function add_project_meta_boxes() {
        add_meta_box(
            'project_details',
            __( 'Project Details', 'ai-dev-theme' ),
            [ $this, 'render_project_meta_box' ],
            'project',
            'normal',
            'high'
        );
    }

    public function render_project_meta_box( $post ) {
        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'ai_dev_theme_project_meta_box', 'ai_dev_theme_project_meta_box_nonce' );

        $subtitle      = get_post_meta( $post->ID, 'project_subtitle', true );
        $client        = get_post_meta( $post->ID, 'project_client', true );
        $url           = get_post_meta( $post->ID, 'project_url', true );
        $delivery_time = get_post_meta( $post->ID, 'project_delivery_time', true );
        $ai_code_pct   = get_post_meta( $post->ID, 'project_ai_code_pct', true );
        $team_size     = get_post_meta( $post->ID, 'project_team_size', true );
        $demo_qr       = get_post_meta( $post->ID, 'project_demo_qr', true );
        $demo_user     = get_post_meta( $post->ID, 'project_demo_user', true );
        $demo_pass     = get_post_meta( $post->ID, 'project_demo_pass', true );
        ?>
        <p>
            <label for="project_subtitle"><?php esc_html_e( 'Subtitle', 'ai-dev-theme' ); ?></label>
            <input type="text" id="project_subtitle" name="project_subtitle" value="<?php echo esc_attr( $subtitle ); ?>" class="widefat" />
        </p>
        <p>
            <label for="project_client"><?php esc_html_e( 'Client Name', 'ai-dev-theme' ); ?></label>
            <input type="text" id="project_client" name="project_client" value="<?php echo esc_attr( $client ); ?>" class="widefat" />
        </p>
        <p>
            <label for="project_url"><?php esc_html_e( 'Project URL (Demo)', 'ai-dev-theme' ); ?></label>
            <input type="url" id="project_url" name="project_url" value="<?php echo esc_attr( $url ); ?>" class="widefat" />
        </p>
        <p>
            <label for="project_demo_qr"><?php esc_html_e( 'Demo QR Code Image URL', 'ai-dev-theme' ); ?></label>
            <input type="url" id="project_demo_qr" name="project_demo_qr" value="<?php echo esc_attr( $demo_qr ); ?>" class="widefat" />
            <span class="description"><?php esc_html_e( 'URL to the QR code image for mobile preview.', 'ai-dev-theme' ); ?></span>
        </p>
        <p>
            <label for="project_demo_user"><?php esc_html_e( 'Demo Username', 'ai-dev-theme' ); ?></label>
            <input type="text" id="project_demo_user" name="project_demo_user" value="<?php echo esc_attr( $demo_user ); ?>" class="widefat" />
        </p>
        <p>
            <label for="project_demo_pass"><?php esc_html_e( 'Demo Password', 'ai-dev-theme' ); ?></label>
            <input type="text" id="project_demo_pass" name="project_demo_pass" value="<?php echo esc_attr( $demo_pass ); ?>" class="widefat" />
        </p>
        <hr>
        <p>
            <label for="project_delivery_time"><?php esc_html_e( 'Delivery Time (e.g. "2 Weeks")', 'ai-dev-theme' ); ?></label>
            <input type="text" id="project_delivery_time" name="project_delivery_time" value="<?php echo esc_attr( $delivery_time ); ?>" class="widefat" />
        </p>
        <p>
            <label for="project_ai_code_pct"><?php esc_html_e( 'AI Code Percentage (0-100)', 'ai-dev-theme' ); ?></label>
            <input type="number" id="project_ai_code_pct" name="project_ai_code_pct" value="<?php echo esc_attr( $ai_code_pct ); ?>" class="widefat" min="0" max="100" />
        </p>
        <p>
            <label for="project_team_size"><?php esc_html_e( 'Team Size (e.g. "2 Devs + 1 PM")', 'ai-dev-theme' ); ?></label>
            <input type="text" id="project_team_size" name="project_team_size" value="<?php echo esc_attr( $team_size ); ?>" class="widefat" />
        </p>
        <?php
    }

    public function save_project_meta( $post_id ) {
        // Check if our nonce is set.
        if ( ! isset( $_POST['ai_dev_theme_project_meta_box_nonce'] ) ) {
            return;
        }

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $_POST['ai_dev_theme_project_meta_box_nonce'], 'ai_dev_theme_project_meta_box' ) ) {
            return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && 'project' === $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }

        // Update the meta field in the database.
        $fields = [
            'project_subtitle',
            'project_client',
            'project_url',
            'project_delivery_time',
            'project_ai_code_pct',
            'project_team_size',
            'project_demo_qr',
            'project_demo_user',
            'project_demo_pass',
        ];

        foreach ( $fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                $value = $_POST[ $field ];
                if ( in_array( $field, ['project_url', 'project_demo_qr'] ) ) {
                    $value = esc_url_raw( $value );
                } else {
                    $value = sanitize_text_field( $value );
                }
                update_post_meta( $post_id, $field, $value );
            }
        }
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
			'taxonomies'          => [ 'technology', 'industry' ],
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
