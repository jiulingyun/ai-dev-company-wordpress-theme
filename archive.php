<?php
/**
 * The template for displaying archive pages
 *
 * @package AI_Dev_Theme
 */

get_header();
?>

<div class="container py-xl">
    <div class="row">
        <div class="col-lg-8">
            <main id="primary" class="site-main">

                <?php if ( have_posts() ) : ?>

                    <header class="page-header mb-xl">
                        <?php
                        // Display breadcrumb only (suppress large archive title)
                        if ( function_exists( 'ai_dev_theme_breadcrumbs' ) ) {
                            ai_dev_theme_breadcrumbs();
                        }
                        the_archive_description( '<div class="archive-description text-muted">', '</div>' );
                        ?>
                    </header><!-- .page-header -->

                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'template-parts/content/content', get_post_type() );
                    endwhile;

                    the_posts_navigation( array(
                        'prev_text' => '<i class="fas fa-chevron-left me-2"></i>' . __( 'Previous', 'ai-dev-theme' ),
                        'next_text' => __( 'Next', 'ai-dev-theme' ) . '<i class="fas fa-chevron-right ms-2"></i>',
                    ) );

                else :

                    get_template_part( 'template-parts/content/content', 'none' );

                endif;
                ?>

            </main><!-- #main -->
        </div>
        <div class="col-lg-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php
get_footer();
