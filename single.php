<?php
/**
 * The template for displaying all single posts
 *
 * @package AI_Dev_Theme
 */

get_header();
?>

<div class="container py-xl">
    <div class="row">
        <div class="col-lg-8">
            <main id="primary" class="site-main">
                <?php
                if ( function_exists( 'ai_dev_theme_breadcrumbs' ) ) {
                    ai_dev_theme_breadcrumbs();
                }
                ?>

                <?php
                while ( have_posts() ) :
                    the_post();

                    get_template_part( 'template-parts/content/content', 'single' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.
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
