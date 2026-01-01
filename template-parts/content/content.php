<?php
/**
 * Template part for displaying posts
 *
 * @package AI_Dev_Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card mb-xl' ); ?>>
    <?php if ( has_post_thumbnail() && ! is_singular() ) : ?>
        <div class="post-thumbnail mb-md">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'large', [ 'class' => 'w-100 h-auto', 'style' => 'border-radius: var(--radius-md);' ] ); ?>
            </a>
        </div>
    <?php endif; ?>

	<header class="entry-header p-lg pb-0">
		<?php
        // Category
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            echo '<div class="entry-category mb-sm">';
            foreach ( $categories as $category ) {
                echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="badge badge--primary me-2">' . esc_html( $category->name ) . '</a>';
            }
            echo '</div>';
        }

		if ( is_singular() ) :
			the_title( '<h1 class="entry-title mb-md">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title mb-md"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="text-decoration-none">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta d-flex align-center text-muted mb-md" style="font-size: 0.9rem;">
                <span class="posted-on me-3">
                    <i class="far fa-calendar-alt me-1"></i>
                    <?php echo get_the_date(); ?>
                </span>
                <span class="byline">
                    <i class="far fa-user me-1"></i>
                    <?php the_author_posts_link(); ?>
                </span>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content p-lg pt-sm">
		<?php
        if ( is_singular() ) {
            the_content();
        } else {
            the_excerpt();
            ?>
            <a href="<?php the_permalink(); ?>" class="button button--secondary mt-md">
                <?php esc_html_e( 'Read More', 'ai-dev-theme' ); ?>
            </a>
            <?php
        }

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ai-dev-theme' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer p-lg pt-0">
        <?php
        $tags = get_the_tags();
        if ( $tags ) {
            echo '<div class="entry-tags"><i class="fas fa-tags me-2 text-primary"></i>';
            foreach ( $tags as $tag ) {
                echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="text-muted me-2" style="font-size: 0.85rem;">#' . esc_html( $tag->name ) . '</a>';
            }
            echo '</div>';
        }
        ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
