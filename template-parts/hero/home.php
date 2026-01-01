<?php
/**
 * Hero Section for Homepage
 *
 * @package AI_Dev_Theme
 */
?>
<section class="hero-home alignfull position-relative overflow-hidden d-flex align-center min-vh-100 bg-dark">
    <!-- Animated Grid Background (Base Layer) -->
    <div class="position-absolute top-0 start-0 w-100 h-100 z-0" style="background: 
        linear-gradient(rgba(11, 16, 38, 0.9), rgba(11, 16, 38, 0.9)),
        linear-gradient(90deg, rgba(0, 240, 255, 0.03) 1px, transparent 1px),
        linear-gradient(rgba(0, 240, 255, 0.03) 1px, transparent 1px);
        background-size: 100% 100%, 40px 40px, 40px 40px;
        transform: perspective(500px) rotateX(20deg) scale(1.5);">
    </div>

    <!-- Effects Layer (Middle Layer) -->
    <div class="hero-home__bg scanline"></div>
    <div class="crt-overlay pointer-events-none"></div>
    
    <!-- Content Layer (Top Layer) -->
    <div class="container position-relative z-2">
        <div class="grid grid--12 align-center">
            <div class="hero-home__content grid-column-span-12 grid-column-span-lg-9">
                <div class="badge badge--tech mb-md fade-in-up" style="animation-delay: 0.1s;">
                    <i class="fas fa-robot me-2"></i><?php esc_html_e( 'AI-First Development Agency', 'ai-dev-theme' ); ?>
                </div>
                
                <h1 class="hero-home__title display-1 glitch mb-md" data-text="<?php esc_attr_e( 'Code the Future', 'ai-dev-theme' ); ?>">
                    <?php esc_html_e( 'Code the Future', 'ai-dev-theme' ); ?>
                    <span class="d-block text-primary"><?php esc_html_e( 'With Intelligence', 'ai-dev-theme' ); ?></span>
                </h1>
                
                <p class="hero-home__subtitle lead text-muted mb-xl fade-in-up typewriter" data-text="<?php esc_attr_e( 'We build enterprise-grade software 10x faster using advanced AI agents. 98% of our code is AI-generated, 100% human-verified.', 'ai-dev-theme' ); ?>" data-speed="30" data-delay="500" style="max-width: 800px;">
                </p>
                
                <div class="hero-home__actions d-flex gap-md fade-in-up" style="animation-delay: 0.5s;">
                    <a href="#contact" class="button button--primary button--lg">
                        <i class="fas fa-rocket me-2"></i><?php esc_html_e( 'Start Your Project', 'ai-dev-theme' ); ?>
                    </a>
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="button button--outline button--lg">
                        <i class="fas fa-eye me-2"></i><?php esc_html_e( 'View Case Studies', 'ai-dev-theme' ); ?>
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="hero-home__trust mt-2xl fade-in-up" style="animation-delay: 0.7s;">
                    <p class="text-uppercase letter-spacing-sm text-muted small mb-md opacity-50"><?php esc_html_e( 'Trusted by innovators', 'ai-dev-theme' ); ?></p>
                    <div class="d-flex align-center gap-xl opacity-50">
                        <i class="fab fa-aws fa-2x"></i>
                        <i class="fab fa-google fa-2x"></i>
                        <i class="fab fa-microsoft fa-2x"></i>
                        <i class="fab fa-react fa-2x"></i>
                    </div>
                </div>
            </div>

            <!-- Hero Visual/Terminal -->
            <div class="hero-home__visual grid-column-span-12 grid-column-span-lg-3 d-none d-lg-block fade-in-up" style="animation-delay: 0.4s;">
                <div class="terminal-window bg-dark border border-secondary rounded shadow-lg overflow-hidden" style="font-family: 'JetBrains Mono', monospace; font-size: 0.8rem;">
                    <div class="terminal-header bg-surface border-bottom border-secondary p-sm d-flex align-center">
                        <div class="d-flex gap-xs me-md">
                            <span class="rounded-circle bg-danger" style="width: 10px; height: 10px;"></span>
                            <span class="rounded-circle bg-warning" style="width: 10px; height: 10px;"></span>
                            <span class="rounded-circle bg-success" style="width: 10px; height: 10px;"></span>
                        </div>
                        <div class="text-muted small">ai-agent — zsh — 80x24</div>
                    </div>
                    <div class="terminal-body p-md text-success">
                        <div class="typing-animation">
                            <p class="mb-2"><span class="text-primary">➜</span> <span class="text-white">init_project</span> --type=saas --ai-model=gpt-4</p>
                            <p class="mb-2 text-muted">Analyzing requirements...</p>
                            <p class="mb-2 text-muted">Generating architecture...</p>
                            <p class="mb-2"><span class="text-success">✔</span> Backend structure created</p>
                            <p class="mb-2"><span class="text-success">✔</span> Database schema optimized</p>
                            <p class="mb-2"><span class="text-success">✔</span> Frontend components generated</p>
                            <p class="mb-0"><span class="text-primary">➜</span> <span class="blink">_</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
