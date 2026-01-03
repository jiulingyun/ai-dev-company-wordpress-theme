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
    $ai_code_pct   = get_post_meta( get_the_ID(), 'project_ai_code_pct', true );
    $team_size     = get_post_meta( get_the_ID(), 'project_team_size', true );
    $demo_qr       = get_post_meta( get_the_ID(), 'project_demo_qr', true );
    $demo_user     = get_post_meta( get_the_ID(), 'project_demo_user', true );
    $demo_pass     = get_post_meta( get_the_ID(), 'project_demo_pass', true );
	?>

	<main id="primary" class="site-main">

        <!-- Hero Section -->
        <section class="project-hero alignfull position-relative py-2xl overflow-hidden">
            <div class="hero-home__grid-bg position-absolute top-0 start-0 w-100 h-100 z-0"></div>
            <div class="scanline"></div>
            <div class="crt-overlay pointer-events-none"></div>
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

                <?php
                // Build image list: featured image + attachments
                $post_id = get_the_ID();
                $images = array();
                if ( has_post_thumbnail( $post_id ) ) {
                    $images[] = get_post_thumbnail_id( $post_id );
                }
                $attachments = get_posts( array(
                    'post_type'      => 'attachment',
                    'post_mime_type' => 'image',
                    'posts_per_page' => -1,
                    'post_parent'    => $post_id,
                    'orderby'        => 'menu_order ID',
                    'order'          => 'ASC',
                ) );
                if ( $attachments ) {
                    foreach ( $attachments as $att ) {
                        if ( ! in_array( $att->ID, $images, true ) ) {
                            $images[] = $att->ID;
                        }
                    }
                }

                if ( ! empty( $images ) ) : ?>
                    <div class="project-slider fade-in-up" style="animation-delay: 0.4s;">
                        <div class="project-slider-inner">
                            <div class="project-slider swiper my-swiper">
                                <div class="swiper-wrapper">
                                    <?php foreach ( $images as $img_id ) : ?>
                                        <div class="swiper-slide">
                                            <?php echo wp_get_attachment_image( $img_id, 'large', false, array( 'loading' => 'lazy', 'class' => 'w-100 h-100' ) ); ?>
                                            <?php if ( $caption = wp_get_attachment_caption( $img_id ) ) : ?>
                                                <div class="slide-caption"><?php echo esc_html( $caption ); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </section>
        
        <!-- AI Efficiency Dashboard -->
        <section class="ai-efficiency-dashboard bg-surface border-bottom border-secondary border-opacity-25 py-lg">
            <div class="container">
                <div class="row align-center text-center text-lg-start">
                    <div class="col-lg-4 mb-md mb-lg-0 border-end-lg border-secondary border-opacity-25">
                        <div class="d-flex align-center justify-center justify-lg-start">
                            <div class="icon-box me-4 text-primary">
                                <i class="fas fa-bolt fa-2x"></i>
                            </div>
                            <div>
                                <span class="d-block text-muted text-uppercase letter-spacing-sm small mb-1"><?php esc_html_e( 'Delivery Time', 'ai-dev-theme' ); ?></span>
                                <h3 class="h4 mb-0"><?php echo $delivery_time ? esc_html( $delivery_time ) : '--'; ?> <span class="badge badge--tech ms-2" style="vertical-align: middle;"><?php esc_html_e( '6x Faster', 'ai-dev-theme' ); ?></span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-md mb-lg-0 border-end-lg border-secondary border-opacity-25">
                        <div class="d-flex align-center justify-center justify-lg-start">
                            <div class="icon-box me-4 text-accent">
                                <i class="fas fa-microchip fa-2x"></i>
                            </div>
                            <div class="flex-grow-1" style="max-width: 200px;">
                                <div class="d-flex justify-between mb-1">
                                    <span class="text-muted text-uppercase letter-spacing-sm small"><?php esc_html_e( 'AI Code', 'ai-dev-theme' ); ?></span>
                                    <span class="fw-bold text-accent"><?php echo $ai_code_pct ? esc_html( $ai_code_pct ) : '0'; ?>%</span>
                                </div>
                                <div class="progress-bar bg-dark rounded-pill overflow-hidden" style="height: 6px;">
                                    <div class="progress-bar__fill bg-accent h-100" style="width: <?php echo $ai_code_pct ? esc_attr( $ai_code_pct ) : '0'; ?>%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex align-center justify-center justify-lg-start">
                            <div class="icon-box me-4 text-secondary">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                            <div>
                                <span class="d-block text-muted text-uppercase letter-spacing-sm small mb-1"><?php esc_html_e( 'Team Size', 'ai-dev-theme' ); ?></span>
                                <h3 class="h4 mb-0"><?php echo $team_size ? esc_html( $team_size ) : '--'; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
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
                        
                        <!-- Actions -->
                        <?php if ( $project_url ) : ?>
                            <div class="project-action card p-lg mb-lg border-primary" style="background: rgba(0, 240, 255, 0.05);">
                                <h3 class="h5 mb-md text-primary"><?php esc_html_e( 'Experience It', 'ai-dev-theme' ); ?></h3>
                                <a href="<?php echo esc_url( $project_url ); ?>" target="_blank" rel="noopener noreferrer" class="button button--primary button--block w-100 text-center mb-md">
                                    <i class="fas fa-external-link-alt me-2"></i>
                                    <?php esc_html_e( 'Visit Live Site', 'ai-dev-theme' ); ?>
                                </a>

                                <?php if ( $demo_user || $demo_pass ) : ?>
                                    <div class="demo-credentials bg-stat-box p-sm rounded mb-md border border-secondary border-opacity-25">
                                        <p class="text-muted small mb-2 text-uppercase letter-spacing-sm text-center"><?php esc_html_e( 'Demo Credentials', 'ai-dev-theme' ); ?></p>
                                        <?php if ( $demo_user ) : ?>
                                            <div class="d-flex justify-between align-center mb-1">
                                                <span class="text-muted small"><?php esc_html_e( 'User:', 'ai-dev-theme' ); ?></span>
                                                <code class="text-accent"><?php echo esc_html( $demo_user ); ?></code>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ( $demo_pass ) : ?>
                                            <div class="d-flex justify-between align-center">
                                                <span class="text-muted small"><?php esc_html_e( 'Pass:', 'ai-dev-theme' ); ?></span>
                                                <code class="text-accent"><?php echo esc_html( $demo_pass ); ?></code>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ( $demo_qr ) : ?>
                                    <div class="demo-qr text-center mt-md pt-md border-top border-secondary border-opacity-25">
                                        <p class="text-muted small mb-2"><?php esc_html_e( 'Scan for Mobile Preview', 'ai-dev-theme' ); ?></p>
                                        <img src="<?php echo esc_url( $demo_qr ); ?>" alt="Mobile Preview QR" class="d-block mx-auto rounded border border-secondary" style="width: 120px; height: 120px;">
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Key Stats Card -->
                        <div class="card p-lg mb-lg">
                            <h3 class="h5 mb-lg text-text-main"><?php esc_html_e( 'Project Data', 'ai-dev-theme' ); ?></h3>
                            
                            <?php if ( $client_name ) : ?>
                                <div class="stat-item mb-md">
                                    <span class="text-muted d-block text-uppercase font-secondary" style="font-size: 0.8rem;"><?php esc_html_e( 'Client', 'ai-dev-theme' ); ?></span>
                                    <span class="fw-bold"><?php echo esc_html( $client_name ); ?></span>
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
                                        <span class="badge badge--tech bg-card-body text-muted border border-secondary" style="font-size: 0.85rem;">
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
                    'next_text' => '<div class="nav-label text-muted text-uppercase mb-1 text-end" style="font-size: 0.8rem;">' . esc_html__( 'Next Project', 'ai-dev-theme' ) . '</div><h4 class="h5 mb-0 text-end">%title</h4>',
                )
            );
            ?>
        </div>

	</main>

<?php
endwhile; // End of the loop.

get_footer();
