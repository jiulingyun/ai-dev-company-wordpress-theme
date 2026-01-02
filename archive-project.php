<?php
/**
 * Archive Template for Projects
 *
 * @package AI_Dev_Theme
 */

get_header();
?>

<div class="hero-page py-2xl position-relative overflow-hidden mb-xl">
    <div class="hero-home__grid-bg position-absolute top-0 start-0 w-100 h-100 z-0"></div>
    <div class="scanline"></div>
    <div class="crt-overlay pointer-events-none"></div>
    <div class="container position-relative z-1 text-center">
        <?php
        // Dynamic Title based on context
        if ( is_tax() ) {
            $title = single_term_title( '', false );
            $description = term_description();
        } else {
            $title = __( 'Product Showcase', 'ai-dev-theme' );
            $description = __( 'Explore our AI-driven software solutions and success stories.', 'ai-dev-theme' );
        }
        ?>
        
        <h1 class="page-title display-3 mb-md glitch" data-text="<?php echo esc_attr( $title ); ?>"><?php echo esc_html( $title ); ?></h1>
        <div class="archive-description lead text-muted mb-xl" style="max-width: 700px; margin-left: auto; margin-right: auto;">
            <?php echo wp_kses_post( $description ); ?>
        </div>

        <!-- Search Form -->
        <div class="project-search mb-xl fade-in-up" style="max-width: 500px; margin: 0 auto; animation-delay: 0.1s;">
            <form role="search" method="get" class="search-form position-relative" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="hidden" name="post_type" value="project" />
                <div class="input-group">
                    <input type="search" class="form-control bg-surface border-secondary text-white py-md ps-lg pe-2xl" placeholder="<?php esc_attr_e( 'Search projects...', 'ai-dev-theme' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                    <button type="submit" class="button button--primary position-absolute top-0 end-0 h-100 px-lg" style="border-radius: 0 var(--border-radius-md) var(--border-radius-md) 0;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Filter Bar -->
        <div class="project-filters d-flex flex-wrap justify-center gap-sm fade-in-up" style="animation-delay: 0.2s;">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="button button--outline button--sm <?php echo is_post_type_archive( 'project' ) && ! is_tax() && ! is_search() ? 'active' : ''; ?>">
                <?php esc_html_e( 'All', 'ai-dev-theme' ); ?>
            </a>
            
            <?php
            $industries = get_terms( [
                'taxonomy'   => 'industry',
                'hide_empty' => true,
            ] );

            if ( ! empty( $industries ) && ! is_wp_error( $industries ) ) {
                foreach ( $industries as $industry ) {
                    $is_active = is_tax( 'industry', $industry->term_id );
                    echo '<a href="' . esc_url( get_term_link( $industry ) ) . '" class="button button--outline button--sm ' . ( $is_active ? 'active' : '' ) . '">' . esc_html( $industry->name ) . '</a>';
                }
            }
            ?>
        </div>
    </div>
</div>

<main id="primary" class="site-main">
	<div class="container pb-2xl">

		<?php if ( have_posts() ) : ?>
			<div class="projects-grid grid grid--auto-fit gap-lg">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/projects/card' );
				endwhile;
				?>
			</div>

			<div class="pagination mt-xl d-flex justify-center">
				<?php 
                the_posts_pagination( array(
                    'prev_text' => '<i class="fas fa-chevron-left me-2"></i>' . __( 'Previous', 'ai-dev-theme' ),
                    'next_text' => __( 'Next', 'ai-dev-theme' ) . '<i class="fas fa-chevron-right ms-2"></i>',
                    'class'     => 'pagination-modern'
                ) ); 
                ?>
			</div>
		<?php else : ?>
            <div class="text-center py-xl">
			    <p class="lead text-muted"><?php esc_html_e( 'No projects found.', 'ai-dev-theme' ); ?></p>
                <?php if ( is_search() ) : ?>
                    <p><?php esc_html_e( 'Try different keywords or check your spelling.', 'ai-dev-theme' ); ?></p>
                <?php endif; ?>
                <a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="button button--primary mt-md"><?php esc_html_e( 'View All Projects', 'ai-dev-theme' ); ?></a>
            </div>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
