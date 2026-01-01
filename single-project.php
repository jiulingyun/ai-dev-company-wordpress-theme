<?php
/**
 * The template for displaying all single projects
 *
 * @package AI_Dev_Theme
 */

get_header();

while ( have_posts() ) :
	the_post();
    
    // Get taxonomy terms
    $technologies = get_the_terms( get_the_ID(), 'technology' );
    $industries   = get_the_terms( get_the_ID(), 'industry' );
    
    // Get custom fields
    $subtitle      = get_post_meta( get_the_ID(), 'project_subtitle', true );
    $client_name   = get_post_meta( get_the_ID(), 'project_client', true );
    $project_url   = get_post_meta( get_the_ID(), 'project_url', true );
    $delivery_time = get_post_meta( get_the_ID(), 'project_delivery_time', true );
	?>

	<main id="primary" class="site-main">

        <!-- Hero Section -->
        <section class="project-hero alignfull position-relative py-2xl bg-dark overflow-hidden">
            <div class="scanline"></div>
            <div class="container position-relative z-1 text-center">
                
                <div class="project-header mb-xl">
                    <?php if ( ! empty( $industries ) && ! is_wp_error( $industries ) ) : ?>
                        <div class="project-badges mb-md fade-in-up">
                            <?php foreach ( $industries as $industry ) : ?>
                                <span class="badge badge--secondary text-uppercase letter-spacing-sm"><?php echo esc_html( $industry->name ); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php the_title( '<h1 class="entry-title display-3 mb-sm glitch" data-text="' . esc_attr( get_the_title() ) . '">', '</h1>' ); ?>
                    
                    <?php if ( $subtitle ) : ?>
                        <p class="lead text-primary font-secondary mb-0 fade-in-up" style="animation-delay: 0.2s;">
                            <span class="typing-effect"><?php echo esc_html( $subtitle ); ?></span>
                        </p>
                    <?php endif; ?>
                </div>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="project-hero__image fade-in-up" style="animation-delay: 0.4s;">
                        <div class="card p-sm border-primary" style="box-shadow: 0 0 30px var(--glow-primary);">
                            <?php the_post_thumbnail( 'full', [ 'class' => 'w-100 h-auto rounded' ] ); ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </section>

		<div class="container project-content-wrapper py-xl">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8 mb-xl mb-lg-0">
                    <div class="card p-xl h-100">
                        <h2 class="h3 mb-lg border-bottom border-secondary pb-sm d-inline-block"><?php esc_html_e( 'Project Overview', 'ai-dev-theme' ); ?></h2>
                        <div class="entry-content typography-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <aside class="project-sidebar sticky-top" style="top: var(--spacing-xl);">
                        
                        <!-- Key Stats Card -->
                        <div class="card p-lg mb-lg border-primary" style="background: rgba(0, 240, 255, 0.05);">
                            <h3 class="h5 mb-lg text-primary"><?php esc_html_e( 'Project Data', 'ai-dev-theme' ); ?></h3>
                            
                            <?php if ( $client_name ) : ?>
                                <div class="stat-item mb-md">
                                    <span class="text-muted d-block text-uppercase font-secondary" style="font-size: 0.8rem;"><?php esc_html_e( 'Client', 'ai-dev-theme' ); ?></span>
                                    <span class="fw-bold"><?php echo esc_html( $client_name ); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ( $delivery_time ) : ?>
                                <div class="stat-item mb-md">
                                    <span class="text-muted d-block text-uppercase font-secondary" style="font-size: 0.8rem;"><?php esc_html_e( 'AI Delivery Time', 'ai-dev-theme' ); ?></span>
                                    <span class="fw-bold text-accent">
                                        <i class="fas fa-bolt me-1"></i>
                                        <?php echo esc_html( $delivery_time ); ?>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <div class="stat-item">
                                <span class="text-muted d-block text-uppercase font-secondary" style="font-size: 0.8rem;"><?php esc_html_e( 'Date', 'ai-dev-theme' ); ?></span>
                                <span class="fw-bold"><?php echo get_the_date(); ?></span>
                            </div>
                        </div>

                        <!-- Technologies -->
                        <?php if ( ! empty( $technologies ) && ! is_wp_error( $technologies ) ) : ?>
                            <div class="card p-lg mb-lg">
                                <h4 class="h6 mb-md text-uppercase letter-spacing-sm"><?php esc_html_e( 'Tech Stack', 'ai-dev-theme' ); ?></h4>
                                <div class="tags-list d-flex flex-wrap gap-sm">
                                    <?php foreach ( $technologies as $tech ) : ?>
                                        <span class="badge badge--tech bg-surface text-muted border border-secondary" style="font-size: 0.85rem;">
                                            <i class="fas fa-code me-1 text-secondary"></i>
                                            <?php echo esc_html( $tech->name ); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Actions -->
                        <?php if ( $project_url ) : ?>
                            <div class="project-action">
                                <a href="<?php echo esc_url( $project_url ); ?>" target="_blank" rel="noopener noreferrer" class="button button--primary button--block w-100 text-center">
                                    <i class="fas fa-external-link-alt me-2"></i>
                                    <?php esc_html_e( 'Visit Live Site', 'ai-dev-theme' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                    </aside>
                </div>
            </div>
		</div>

        <!-- Related Projects -->
        <?php
        $related_args = array(
            'post_type'      => 'project',
            'posts_per_page' => 3,
            'post__not_in'   => array( get_the_ID() ),
            'orderby'        => 'rand',
        );
        
        // Try to filter by industry first
        if ( ! empty( $industries ) ) {
            $industry_ids = wp_list_pluck( $industries, 'term_id' );
            $related_args['tax_query'] = array(
                array(
                    'taxonomy' => 'industry',
                    'field'    => 'term_id',
                    'terms'    => $industry_ids,
                ),
            );
        }

        $related_query = new WP_Query( $related_args );

        if ( $related_query->have_posts() ) : ?>
            <div class="related-projects py-2xl bg-surface">
                <div class="container">
                    <h3 class="h2 mb-xl text-center"><?php esc_html_e( 'Related Projects', 'ai-dev-theme' ); ?></h3>
                    <div class="grid grid--auto-fit gap-lg">
                        <?php while ( $related_query->have_posts() ) : $related_query->the_post(); 
                            get_template_part( 'template-parts/projects/card' );
                        endwhile; ?>
                    </div>
                </div>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>

        <!-- Post Navigation -->
        <div class="container py-xl">
            <?php
            the_post_navigation(
                array(
                    'prev_text' => '<div class="nav-label text-muted text-uppercase mb-1" style="font-size: 0.8rem;">' . esc_html__( 'Previous Project', 'ai-dev-theme' ) . '</div><h4 class="h5 mb-0">%title</h4>',
                    'next_text' => '<div class="nav-label text-muted text-uppercase mb-1 text-end" style="font-size: 0.8rem;">' . esc_html__( 'Next Project', 'ai-dev-theme' ) . '</div><h4 class="h5 mb-0">%title</h4>',
                    'class'     => 'd-flex justify-between align-center'
                )
            );
            ?>
        </div>

	</main>

<?php
endwhile; // End of the loop.

get_footer();
