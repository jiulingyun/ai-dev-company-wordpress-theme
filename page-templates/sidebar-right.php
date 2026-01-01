<?php
/**
 * Template Name: Right Sidebar Page
 *
 * @package AI_Dev_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container page-with-sidebar page-with-sidebar--right">
        <div class="content-area">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    </header>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php
            endwhile;
            ?>
        </div>
        
        <?php get_sidebar(); ?>
    </div>
</main>

<?php
get_footer();
