<?php
/**
 * Template Name: Full Width Page
 *
 * @package AI_Dev_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'full-width-page' ); ?>>
            <?php if ( ! is_front_page() ) : ?>
                <header class="entry-header alignwide">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header>
            <?php endif; ?>

            <div class="entry-content alignfull">
                <?php the_content(); ?>
            </div>
        </article>
        <?php
    endwhile;
    ?>
</main>

<?php
get_footer();
