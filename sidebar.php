<?php
/**
 * The sidebar containing the main widget area
 *
 * @package AI_Dev_Theme
 */

/**
 * Fallback sidebar: if no widgets are added in admin, render default search, categories and recent posts
 */
?>

<aside id="secondary" class="widget-area">
	<?php
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		dynamic_sidebar( 'sidebar-1' );
	} else {
		// Default: Search
		?>
		<div class="card p-lg mb-lg widget widget_search">
			<?php get_search_form(); ?>
		</div>

		<?php
		// Default: Categories
		$cat_args = array(
			'show_count' => true,
			'title_li'   => '',
		);
		?>
		<div class="card p-lg mb-lg widget widget_categories">
			<h4 class="widget-title h6 mb-md"><?php esc_html_e( 'Categories', 'ai-dev-theme' ); ?></h4>
			<ul>
				<?php wp_list_categories( $cat_args ); ?>
			</ul>
		</div>

		<?php
		// Default: Recent posts
		$recent_posts = wp_get_recent_posts( array(
			'numberposts' => 5,
			'post_status' => 'publish',
		) );
		?>
		<div class="card p-lg mb-lg widget widget_recent_entries">
			<h4 class="widget-title h6 mb-md"><?php esc_html_e( 'Recent Posts', 'ai-dev-theme' ); ?></h4>
			<ul class="recent-posts-list">
				<?php foreach ( $recent_posts as $post ) : ?>
					<li>
						<a href="<?php echo esc_url( get_permalink( $post['ID'] ) ); ?>" class="text-decoration-none hover-primary"><?php echo esc_html( $post['post_title'] ); ?></a>
					</li>
				<?php endforeach; wp_reset_query(); ?>
			</ul>
		</div>
		<?php
	}
	?>
</aside><!-- #secondary -->
