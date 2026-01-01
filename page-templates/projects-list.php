<?php
/**
 * Template Name: Projects List
 *
 * @package AI_Dev_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		<header class="page-header">
			<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
			<div class="archive-description"><?php the_content(); ?></div>
		</header>

		<?php
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$args = array(
			'post_type'      => 'project',
			'posts_per_page' => 9,
			'paged'          => $paged,
		);
		$projects_query = new WP_Query( $args );

		if ( $projects_query->have_posts() ) :
			?>
			<div class="projects-grid">
				<?php
				while ( $projects_query->have_posts() ) :
					$projects_query->the_post();
					get_template_part( 'template-parts/projects/card' );
				endwhile;
				?>
			</div>

			<div class="pagination">
				<?php
				echo paginate_links( array(
					'total' => $projects_query->max_num_pages,
				) );
				?>
			</div>
			<?php
			wp_reset_postdata();
		else :
			?>
			<p><?php esc_html_e( 'No projects found.', 'ai-dev-theme' ); ?></p>
			<?php
		endif;
		?>
	</div>
</main>

<?php
get_footer();
