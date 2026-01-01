<?php
/**
 * The main template file
 *
 * @package AI_Dev_Theme
 */

get_header();
?>

<div class="hero-page py-xl bg-dark position-relative overflow-hidden mb-xl">
    <div class="scanline"></div>
    <div class="container position-relative z-1">
        <h1 class="display-3 mb-md glitch" data-text="<?php single_post_title(); ?>"><?php single_post_title(); ?></h1>
        <div class="hero-page__content" style="max-width: 600px;">
            <p class="lead text-muted"><?php esc_html_e( 'Latest insights, tutorials, and news from the AI world.', 'ai-dev-theme' ); ?></p>
        </div>
    </div>
</div>

<div class="container pb-xl">
    <div class="row">
        <div class="col-lg-8">
            <main id="primary" class="site-main">

                <?php
                if ( have_posts() ) :

                    if ( is_home() && ! is_front_page() ) :
                        ?>
                        <header>
                            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                        </header>
                        <?php
                    endif;

                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();

                        /*
                         * Include the Post-Type-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                         */
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
