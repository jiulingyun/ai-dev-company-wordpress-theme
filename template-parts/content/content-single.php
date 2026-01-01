<?php
/**
 * Template part for displaying single posts
 *
 * @package AI_Dev_Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card p-xl mb-xl' ); ?>>
	<header class="entry-header mb-lg">
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
        
        the_title( '<h1 class="entry-title display-4 mb-md">', '</h1>' );
        ?>

		<div class="entry-meta d-flex align-center text-muted" style="font-size: 0.95rem;">
            <span class="posted-on me-4">
                <i class="far fa-calendar-alt me-2 text-primary"></i>
                <?php echo get_the_date(); ?>
            </span>
            <span class="byline me-4">
                <i class="far fa-user me-2 text-primary"></i>
                <?php the_author_posts_link(); ?>
            </span>
            <?php if ( comments_open() ) : ?>
            <span class="comments-link">
                <i class="far fa-comment me-2 text-primary"></i>
                <?php comments_popup_link( __( 'No Comments', 'ai-dev-theme' ), __( '1 Comment', 'ai-dev-theme' ), __( '% Comments', 'ai-dev-theme' ) ); ?>
            </span>
            <?php endif; ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail mb-xl">
            <?php the_post_thumbnail( 'full', [ 'class' => 'w-100 h-auto', 'style' => 'border-radius: var(--radius-md); box-shadow: var(--shadow-lg);' ] ); ?>
        </div>
    <?php endif; ?>

	<div class="entry-content typography-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ai-dev-theme' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer mt-xl pt-lg border-top">
        <?php
        $tags = get_the_tags();
        if ( $tags ) {
            echo '<div class="entry-tags mb-md"><span class="fw-bold me-2">' . esc_html__( 'Tags:', 'ai-dev-theme' ) . '</span>';
            foreach ( $tags as $tag ) {
                echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="badge badge--secondary me-2">#' . esc_html( $tag->name ) . '</a>';
            }
            echo '</div>';
        }
        ?>
        
        <div class="post-navigation d-flex justify-between mt-lg">
            <div class="nav-previous">
                <?php previous_post_link( '<div class="nav-label text-muted text-uppercase" style="font-size: 0.8rem;">' . __( 'Previous Post', 'ai-dev-theme' ) . '</div>%link' ); ?>
            </div>
            <div class="nav-next text-end">
                <?php next_post_link( '<div class="nav-label text-muted text-uppercase" style="font-size: 0.8rem;">' . __( 'Next Post', 'ai-dev-theme' ) . '</div>%link' ); ?>
            </div>
        </div>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

<?php
// Author Bio
if ( get_the_author_meta( 'description' ) ) : ?>
    <div class="author-bio card p-lg mb-xl d-flex align-center">
        <div class="author-avatar me-4">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', '', [ 'class' => 'rounded-circle', 'style' => 'border: 2px solid var(--color-primary);' ] ); ?>
        </div>
        <div class="author-info">
            <h3 class="author-title h5 mb-2"><?php echo esc_html__( 'About', 'ai-dev-theme' ) . ' ' . get_the_author(); ?></h3>
            <p class="author-description mb-0 text-muted"><?php the_author_meta( 'description' ); ?></p>
        </div>
    </div>
<?php endif; ?>
