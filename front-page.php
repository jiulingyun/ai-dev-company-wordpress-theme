<?php
/**
 * Front Page Template
 *
 * @package AI_Dev_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php get_template_part( 'template-parts/hero/home' ); ?>

    <!-- Services Section -->
    <section id="services" class="section py-2xl">
        <div class="container">
            <header class="section-header text-center mb-xl fade-in-up">
                <h2 class="section-title"><?php esc_html_e( 'Our Capabilities', 'ai-dev-theme' ); ?></h2>
                <p class="section-subtitle"><?php esc_html_e( 'Cutting-edge technology for modern problems', 'ai-dev-theme' ); ?></p>
            </header>

            <div class="grid grid--auto-fit gap-lg">
                <!-- Service 1 -->
                <div class="card service-card fade-in-up delay-100">
                    <div class="card__content">
                        <div class="service-icon mb-md">
                            <span class="dashicons dashicons-superhero" style="font-size: 2rem; color: var(--color-primary);"></span>
                        </div>
                        <h3 class="card__title"><?php esc_html_e( 'AI Integration', 'ai-dev-theme' ); ?></h3>
                        <p class="card__excerpt"><?php esc_html_e( 'Seamlessly integrate LLMs and computer vision into your existing workflows.', 'ai-dev-theme' ); ?></p>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="card service-card fade-in-up delay-200">
                    <div class="card__content">
                        <div class="service-icon mb-md">
                            <span class="dashicons dashicons-cloud" style="font-size: 2rem; color: var(--color-secondary);"></span>
                        </div>
                        <h3 class="card__title"><?php esc_html_e( 'Cloud Native', 'ai-dev-theme' ); ?></h3>
                        <p class="card__excerpt"><?php esc_html_e( 'Scalable, resilient microservices architectures built on AWS and Azure.', 'ai-dev-theme' ); ?></p>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="card service-card fade-in-up delay-300">
                    <div class="card__content">
                        <div class="service-icon mb-md">
                            <span class="dashicons dashicons-shield" style="font-size: 2rem; color: var(--color-accent);"></span>
                        </div>
                        <h3 class="card__title"><?php esc_html_e( 'Cyber Security', 'ai-dev-theme' ); ?></h3>
                        <p class="card__excerpt"><?php esc_html_e( 'Next-gen threat detection and automated security protocols.', 'ai-dev-theme' ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Projects -->
    <section id="projects" class="section py-2xl bg-surface-alt">
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
