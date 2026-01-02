<?php
/**
 * Front Page Template
 *
 * @package AI_Dev_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    // Check if a static page is set as homepage and it has content (potentially from Elementor)
    if ( 'page' === get_option( 'show_on_front' ) ) {
        $front_page_id = get_option( 'page_on_front' );
        // Check if Elementor is used on this page
        if ( \Elementor\Plugin::$instance->db->is_built_with_elementor( $front_page_id ) ) {
            $post = get_post( $front_page_id );
            $content = apply_filters( 'the_content', $post->post_content );
            echo $content;
            
            // If we are showing Elementor content, we might stop here to avoid duplicating the hardcoded theme sections.
            // However, the user might want to mix both.
            // But standard practice is: if Elementor is used, it takes full control.
            // So we return here.
            echo '</main>';
            get_footer();
            return;
        }
    }
    ?>

    <?php get_template_part( 'template-parts/hero/home' ); ?>

    <!-- AI Advantage Section (New) -->
    <section id="ai-advantage" class="section py-2xl overflow-hidden">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-6 mb-xl mb-lg-0 fade-in-up">
                    <h2 class="h1 mb-lg">
                        <span class="text-primary d-block h5 text-uppercase letter-spacing-sm mb-2"><?php esc_html_e( 'The AI Advantage', 'ai-dev-theme' ); ?></span>
                        <?php esc_html_e( 'Why Choose AI-Driven Development?', 'ai-dev-theme' ); ?>
                    </h2>
                    <p class="lead text-muted mb-xl">
                        <?php esc_html_e( 'Traditional software development is slow and error-prone. We use autonomous AI agents to write, test, and deploy code at speeds previously impossible.', 'ai-dev-theme' ); ?>
                    </p>
                    
                    <div class="feature-list">
                        <div class="feature-item d-flex mb-lg">
                            <div class="icon-box me-4 text-primary">
                                <i class="fas fa-bolt fa-2x"></i>
                            </div>
                            <div>
                                <h3 class="h5 mb-2"><?php esc_html_e( '10x Faster Delivery', 'ai-dev-theme' ); ?></h3>
                                <p class="text-muted mb-0"><?php esc_html_e( 'Weeks become days. We launch MVPs in record time without compromising quality.', 'ai-dev-theme' ); ?></p>
                            </div>
                        </div>
                        <div class="feature-item d-flex mb-lg">
                            <div class="icon-box me-4 text-accent">
                                <i class="fas fa-bug fa-2x"></i>
                            </div>
                            <div>
                                <h3 class="h5 mb-2"><?php esc_html_e( 'Zero-Defect Code', 'ai-dev-theme' ); ?></h3>
                                <p class="text-muted mb-0"><?php esc_html_e( 'AI agents run thousands of test cases instantly, catching bugs before they exist.', 'ai-dev-theme' ); ?></p>
                            </div>
                        </div>
                        <div class="feature-item d-flex">
                            <div class="icon-box me-4 text-secondary">
                                <i class="fas fa-coins fa-2x"></i>
                            </div>
                            <div>
                                <h3 class="h5 mb-2"><?php esc_html_e( 'Cost Efficiency', 'ai-dev-theme' ); ?></h3>
                                <p class="text-muted mb-0"><?php esc_html_e( 'Reduce development costs by up to 60% by automating repetitive coding tasks.', 'ai-dev-theme' ); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 fade-in-up" style="animation-delay: 0.2s;">
                    <div class="position-relative">
                        <!-- Decorative Elements -->
                        <div class="position-absolute top-0 end-0 translate-middle-y bg-primary opacity-25 blur-3xl rounded-circle" style="width: 300px; height: 300px; z-index: 0;"></div>
                        
                        <div class="card p-0 border-secondary overflow-hidden position-relative z-1">
                            <div class="card-header bg-card-header border-bottom border-secondary p-sm d-flex justify-between align-center">
                                <span class="text-muted small"><?php esc_html_e( 'AI Performance Metrics', 'ai-dev-theme' ); ?></span>
                                <div class="d-flex gap-xs">
                                    <span class="rounded-circle bg-secondary" style="width: 8px; height: 8px;"></span>
                                    <span class="rounded-circle bg-secondary" style="width: 8px; height: 8px;"></span>
                                </div>
                            </div>
                            <div class="card-body p-lg bg-card-body">
                                <!-- Simulated Chart/Graph -->
                                <div class="mb-lg">
                                    <div class="d-flex justify-between mb-2">
                                        <span class="small fw-bold text-text-main"><?php esc_html_e( 'Development Speed', 'ai-dev-theme' ); ?></span>
                                        <span class="small text-primary"><?php esc_html_e( 'AI vs Traditional', 'ai-dev-theme' ); ?></span>
                                    </div>
                                    <div class="progress-bar bg-progress-track rounded-pill mb-2" style="height: 8px;">
                                        <div class="progress-bar__fill bg-primary h-100" style="width: 95%;"></div>
                                    </div>
                                    <div class="progress-bar bg-progress-track rounded-pill" style="height: 8px; opacity: 0.3;">
                                        <div class="progress-bar__fill bg-white h-100" style="width: 20%;"></div>
                                    </div>
                                </div>
                                
                                <div class="grid grid--2 gap-md">
                                    <div class="stat-box p-md bg-stat-box rounded border border-secondary border-opacity-25 text-center">
                                        <span class="d-block h2 text-accent mb-1">99.9%</span>
                                        <span class="small text-muted text-uppercase"><?php esc_html_e( 'Uptime', 'ai-dev-theme' ); ?></span>
                                    </div>
                                    <div class="stat-box p-md bg-stat-box rounded border border-secondary border-opacity-25 text-center">
                                        <span class="d-block h2 text-primary mb-1">&lt;24h</span>
                                        <span class="small text-muted text-uppercase"><?php esc_html_e( 'MVP Launch', 'ai-dev-theme' ); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section py-2xl bg-surface-alt">
        <div class="container">
            <header class="section-header text-center mb-xl fade-in-up">
                <h2 class="section-title"><?php esc_html_e( 'Core Capabilities', 'ai-dev-theme' ); ?></h2>
                <p class="section-subtitle"><?php esc_html_e( 'End-to-end solutions powered by intelligence', 'ai-dev-theme' ); ?></p>
            </header>

            <div class="grid grid--auto-fit gap-lg">
                <!-- Service 1 -->
                <div class="card service-card fade-in-up delay-100 h-100">
                    <div class="card__content p-xl">
                        <div class="service-icon mb-lg d-inline-flex align-center justify-center rounded-circle bg-surface border border-secondary" style="width: 64px; height: 64px;">
                            <i class="fas fa-brain fa-lg text-primary"></i>
                        </div>
                        <h3 class="card__title h4 mb-md"><?php esc_html_e( 'AI Agent Integration', 'ai-dev-theme' ); ?></h3>
                        <p class="card__excerpt text-muted mb-lg"><?php esc_html_e( 'Deploy autonomous agents that handle customer support, data analysis, and process automation 24/7.', 'ai-dev-theme' ); ?></p>
                        <a href="#" class="text-primary text-decoration-none fw-bold small text-uppercase letter-spacing-sm hover-white transition-colors"><?php esc_html_e( 'Learn More', 'ai-dev-theme' ); ?> <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="card service-card fade-in-up delay-200 h-100">
                    <div class="card__content p-xl">
                        <div class="service-icon mb-lg d-inline-flex align-center justify-center rounded-circle bg-surface border border-secondary" style="width: 64px; height: 64px;">
                            <i class="fas fa-code-branch fa-lg text-secondary"></i>
                        </div>
                        <h3 class="card__title h4 mb-md"><?php esc_html_e( 'Generative UI/UX', 'ai-dev-theme' ); ?></h3>
                        <p class="card__excerpt text-muted mb-lg"><?php esc_html_e( 'Dynamic interfaces that adapt to user behavior in real-time using generative design algorithms.', 'ai-dev-theme' ); ?></p>
                        <a href="#" class="text-secondary text-decoration-none fw-bold small text-uppercase letter-spacing-sm hover-white transition-colors"><?php esc_html_e( 'Learn More', 'ai-dev-theme' ); ?> <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="card service-card fade-in-up delay-300 h-100">
                    <div class="card__content p-xl">
                        <div class="service-icon mb-lg d-inline-flex align-center justify-center rounded-circle bg-surface border border-secondary" style="width: 64px; height: 64px;">
                            <i class="fas fa-shield-alt fa-lg text-accent"></i>
                        </div>
                        <h3 class="card__title h4 mb-md"><?php esc_html_e( 'AI Security', 'ai-dev-theme' ); ?></h3>
                        <p class="card__excerpt text-muted mb-lg"><?php esc_html_e( 'Self-healing infrastructure that detects and neutralizes threats before they impact your business.', 'ai-dev-theme' ); ?></p>
                        <a href="#" class="text-accent text-decoration-none fw-bold small text-uppercase letter-spacing-sm hover-white transition-colors"><?php esc_html_e( 'Learn More', 'ai-dev-theme' ); ?> <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Projects -->
    <section id="projects" class="section py-2xl">
        <div class="container">
            <header class="section-header d-flex justify-between align-end mb-xl fade-in-up">
                <div>
                    <h2 class="section-title"><?php esc_html_e( 'Selected Works', 'ai-dev-theme' ); ?></h2>
                    <p class="section-subtitle"><?php esc_html_e( 'See what we have built', 'ai-dev-theme' ); ?></p>
                </div>
                <a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="button button--secondary">
                    <?php esc_html_e( 'View All', 'ai-dev-theme' ); ?>
                </a>
            </header>

            <?php
            $projects_query = new WP_Query( array(
                'post_type'      => 'project',
                'posts_per_page' => 3,
            ) );

            if ( $projects_query->have_posts() ) :
                ?>
                <div class="grid grid--auto-fit gap-lg">
                    <?php
                    while ( $projects_query->have_posts() ) :
                        $projects_query->the_post();
                        ?>
                        <div class="fade-in-up delay-200">
                            <?php get_template_part( 'template-parts/projects/card' ); ?>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

</main>

<?php
get_footer();
