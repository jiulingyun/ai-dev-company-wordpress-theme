<?php
/**
 * Template part for displaying project card
 *
 * @package AI_Dev_Theme
 */

$technologies = get_the_terms( get_the_ID(), 'technology' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'project-card' ); ?>>
	<div class="project-card__thumbnail">
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'medium_large' ); ?>
			</a>
		<?php endif; ?>
	</div>

	<div class="project-card__content">
		<header class="project-card__header">
			<?php the_title( '<h3 class="project-card__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
		</header>

		<div class="project-card__excerpt">
			<?php the_excerpt(); ?>
		</div>

		<?php if ( ! empty( $technologies ) && ! is_wp_error( $technologies ) ) : ?>
			<div class="project-card__technologies">
				<?php foreach ( $technologies as $tech ) : ?>
					<span class="badge badge--tech"><?php echo esc_html( $tech->name ); ?></span>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<footer class="project-card__footer">
			<a href="<?php the_permalink(); ?>" class="button button--primary">
				<?php esc_html_e( 'View Case Study', 'ai-dev-theme' ); ?>
			</a>
		</footer>
	</div>
</article>
