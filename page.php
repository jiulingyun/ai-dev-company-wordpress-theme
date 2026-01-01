<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package AI_Dev_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

            // If Elementor is active on this page, just show content
            if ( \Elementor\Plugin::$instance->db->is_built_with_elementor( get_the_ID() ) ) {
                the_content();
            } else {
                // Default Page Layout
                ?>
                <div class="hero-page py-xl bg-dark position-relative overflow-hidden mb-xl">
                    <div class="scanline"></div>
                    <div class="container position-relative z-1 text-center">
                        <h1 class="display-3 mb-md glitch" data-text="<?php the_title(); ?>"><?php the_title(); ?></h1>
                    </div>
                </div>

                <div class="container pb-xl">
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
                    </div>
                </div>
                <?php
            }

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
