<?php
/**
 * Archive Template for Projects
 *
 * @package AI_Dev_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		<header class="page-header">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="projects-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/projects/card' );
				endwhile;
				?>
			</div>

			<div class="pagination">
				<?php the_posts_pagination(); ?>
			</div>
		<?php else : ?>
			<p><?php esc_html_e( 'No projects found.', 'ai-dev-theme' ); ?></p>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
