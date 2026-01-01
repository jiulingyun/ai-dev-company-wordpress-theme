<?php
/**
 * Template part for displaying project card
 *
 * @package AI_Dev_Theme
 */

$technologies = get_the_terms( get_the_ID(), 'technology' );
$industries   = get_the_terms( get_the_ID(), 'industry' );
$subtitle     = get_post_meta( get_the_ID(), 'project_subtitle', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'project-card h-100 d-flex flex-column' ); ?>>
	<div class="project-card__thumbnail position-relative overflow-hidden">
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" class="d-block w-100 h-100">
				<?php the_post_thumbnail( 'medium_large', ['class' => 'w-100 h-100 object-cover transition-transform'] ); ?>
			</a>
            <div class="project-card__overlay">
                <a href="<?php the_permalink(); ?>" class="button button--icon rounded-circle bg-white text-primary">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
		<?php endif; ?>
        
        <?php if ( ! empty( $industries ) && ! is_wp_error( $industries ) ) : ?>
            <div class="project-card__badges position-absolute top-0 start-0 p-sm z-1">
                <?php foreach ( array_slice( $industries, 0, 1 ) as $industry ) : ?>
                    <span class="badge badge--secondary text-uppercase letter-spacing-sm shadow-sm"><?php echo esc_html( $industry->name ); ?></span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
	</div>

	<div class="project-card__content p-lg flex-grow-1 d-flex flex-column bg-surface border border-secondary border-opacity-25 border-top-0">
		<header class="project-card__header mb-md">
			<?php the_title( '<h3 class="project-card__title h5 mb-xs"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="text-decoration-none hover-primary transition-colors">', '</a></h3>' ); ?>
            <?php if ( $subtitle ) : ?>
                <p class="project-card__subtitle text-muted font-secondary small mb-0"><?php echo esc_html( $subtitle ); ?></p>
            <?php endif; ?>
		</header>

		<div class="project-card__excerpt text-muted mb-lg flex-grow-1">
			<?php the_excerpt(); ?>
		</div>

		<footer class="project-card__footer mt-auto">
            <?php if ( ! empty( $technologies ) && ! is_wp_error( $technologies ) ) : ?>
                <div class="project-card__technologies d-flex flex-wrap gap-xs mb-md">
                    <?php foreach ( array_slice( $technologies, 0, 3 ) as $tech ) : ?>
                        <span class="badge badge--tech bg-background text-muted border border-secondary" style="font-size: 0.75rem;">
                            <?php echo esc_html( $tech->name ); ?>
                        </span>
                    <?php endforeach; ?>
                    <?php if ( count( $technologies ) > 3 ) : ?>
                        <span class="badge badge--tech bg-background text-muted border border-secondary" style="font-size: 0.75rem;">+<?php echo count( $technologies ) - 3; ?></span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

			<a href="<?php the_permalink(); ?>" class="button button--outline button--sm w-100 text-center">
				<?php esc_html_e( 'View Case Study', 'ai-dev-theme' ); ?> <i class="fas fa-arrow-right ms-2"></i>
			</a>
		</footer>
	</div>
</article>
