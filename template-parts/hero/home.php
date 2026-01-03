<?php
/**
 * Hero Section for Homepage
 *
 * @package AI_Dev_Theme
 */
?>
<section class="hero-home alignfull position-relative overflow-hidden d-flex align-center min-vh-100">
    <!-- Animated Grid Background (Base Layer) -->
    <div class="hero-home__grid-bg position-absolute top-0 start-0 w-100 h-100 z-0">
    </div>

    <!-- Effects Layer (Middle Layer) -->
    <div class="hero-home__bg scanline"></div>
    <div class="crt-overlay pointer-events-none"></div>
    
    <!-- Content Layer (Top Layer) -->
    <div class="container position-relative z-2">
        <div class="grid grid--12 align-center">
            <div class="hero-home__content grid-column-span-12 grid-column-span-lg-7">
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
                    <a href="/contact-us" class="button button--primary button--lg">
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

            <!-- Hero Visual/AI Interface -->
            <div class="hero-home__visual grid-column-span-12 grid-column-span-lg-5 position-relative" style="z-index: 10;">
                <!-- Glowing Background Orb -->
                <div class="ai-glow-orb position-absolute top-50 start-50 translate-middle"></div>
                
                <!-- Main Interface Window -->
                <div class="ai-interface-window bg-surface border border-secondary rounded-lg shadow-2xl overflow-hidden position-relative z-1 transform-perspective">
                    <!-- Window Header -->
                    <div class="window-header bg-surface-alt border-bottom border-secondary p-sm d-flex align-center justify-between">
                        <div class="d-flex gap-xs">
                            <span class="rounded-circle bg-danger" style="width: 10px; height: 10px;"></span>
                            <span class="rounded-circle bg-warning" style="width: 10px; height: 10px;"></span>
                            <span class="rounded-circle bg-success" style="width: 10px; height: 10px;"></span>
                        </div>
                        <div class="window-tabs d-flex gap-sm">
                            <div class="tab active px-sm py-xs bg-surface border-top border-start border-end border-secondary rounded-top small text-primary">
                                <i class="fab fa-python me-1"></i> agent_core.py
                            </div>
                            <div class="tab px-sm py-xs text-muted small opacity-50">
                                <i class="fab fa-react me-1"></i> App.tsx
                            </div>
                        </div>
                        <div class="window-actions text-muted small">
                            <i class="fas fa-code-branch"></i> main
                        </div>
                    </div>
                    
                    <!-- Window Body -->
                    <div class="window-body p-md bg-terminal-body font-secondary" style="font-size: 0.85rem; height: 320px; overflow: hidden; line-height: 1.6;">
                        <div class="code-line d-flex">
                            <span class="text-muted me-3 select-none opacity-50 text-end" style="min-width: 1.5rem;">1</span>
                            <div><span class="text-secondary">class</span> <span class="text-warning">AutoDevAgent</span>:</div>
                        </div>
                        <div class="code-line d-flex">
                            <span class="text-muted me-3 select-none opacity-50 text-end" style="min-width: 1.5rem;">2</span>
                            <div style="padding-left: 1.5rem;"><span class="text-secondary">def</span> <span class="text-primary">__init__</span>(<span class="text-text-main">self</span>, <span class="text-text-main">model</span>):</div>
                        </div>
                        <div class="code-line d-flex">
                            <span class="text-muted me-3 select-none opacity-50 text-end" style="min-width: 1.5rem;">3</span>
                            <div style="padding-left: 3rem;"><span class="text-text-main">self.model</span> = <span class="text-success">"GPT-4-Turbo"</span></div>
                        </div>
                        <div class="code-line d-flex">
                            <span class="text-muted me-3 select-none opacity-50 text-end" style="min-width: 1.5rem;">4</span>
                            <div style="padding-left: 3rem;"><span class="text-text-main">self.context_window</span> = <span class="text-accent">128000</span></div>
                        </div>
                        <div class="code-line d-flex">
                            <span class="text-muted me-3 select-none opacity-50 text-end" style="min-width: 1.5rem;">5</span>
                            <div style="padding-left: 3rem;"><span class="text-text-main">self.capabilities</span> = [<span class="text-success">"code"</span>, <span class="text-success">"debug"</span>, <span class="text-success">"deploy"</span>]</div>
                        </div>
                        <div class="code-line d-flex">
                            <span class="text-muted me-3 select-none opacity-50 text-end" style="min-width: 1.5rem;">6</span>
                            <div></div>
                        </div>
                        <div class="code-line d-flex">
                            <span class="text-muted me-3 select-none opacity-50 text-end" style="min-width: 1.5rem;">7</span>
                            <div style="padding-left: 1.5rem;"><span class="text-secondary">async def</span> <span class="text-primary">generate_solution</span>(<span class="text-text-main">self</span>, <span class="text-text-main">prompt</span>):</div>
                        </div>
                        <div class="code-line d-flex">
                            <span class="text-muted me-3 select-none opacity-50 text-end" style="min-width: 1.5rem;">8</span>
                            <div style="padding-left: 3rem;"><span class="text-muted">// AI Analyzing requirements...</span></div>
                        </div>
                        <div class="code-line d-flex">
                            <span class="text-muted me-3 select-none opacity-50 text-end" style="min-width: 1.5rem;">9</span>
                            <div style="padding-left: 3rem;"><span class="text-text-main">architecture</span> = <span class="text-secondary">await</span> <span class="text-text-main">self.analyze(prompt)</span></div>
                        </div>
                        <div class="code-line d-flex">
                            <span class="text-muted me-3 select-none opacity-50 text-end" style="min-width: 1.5rem;">10</span>
                            <div style="padding-left: 3rem;"><span class="text-text-main">codebase</span> = <span class="text-text-main">self.scaffold(architecture)</span></div>
                        </div>
                        <div class="code-line d-flex">
                            <span class="text-muted me-3 select-none opacity-50 text-end" style="min-width: 1.5rem;">11</span>
                            <div style="padding-left: 3rem;"><span class="text-secondary">return</span> <span class="text-text-main">codebase.optimize()</span></div>
                        </div>
                        
                        <div class="typing-cursor mt-2 text-primary d-flex">
                            <span class="d-inline-block me-3" style="min-width: 1.5rem;"></span>
                            <div style="padding-left: 3rem;">
                                <span class="blink">|</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating Status Overlay -->
                    <div class="status-overlay position-absolute bottom-0 end-0 p-md">
                        <div class="d-flex gap-2 align-center bg-surface border border-primary rounded-pill px-3 py-1 shadow-sm">
                            <div class="spinner-grow text-primary" role="status" style="width: 8px; height: 8px;"></div>
                            <span class="small text-primary fw-bold">AI Generating...</span>
                        </div>
                    </div>
                </div>

                <!-- Floating Elements -->
                <div class="float-card card-stats position-absolute top-0 end-0 bg-surface border border-secondary p-3 rounded shadow-lg z-2 floating-y" style="transform: translate(0, -20%); right: 0;">
                    <div class="d-flex align-center gap-3">
                        <div class="icon-box bg-success bg-opacity-10 text-success rounded p-2">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <div class="h4 mb-0 text-success">100%</div>
                            <div class="small text-muted text-uppercase" style="font-size: 0.65rem;">Test Coverage</div>
                        </div>
                    </div>
                </div>

                <div class="float-card card-speed position-absolute bottom-0 start-0 mb-xl bg-surface border border-secondary p-3 rounded shadow-lg z-2 floating-y" style="animation-delay: 1s; transform: translate(0, 0); left: 0;">
                    <div class="d-flex align-center gap-3">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary rounded p-2">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        <div>
                            <div class="h4 mb-0 text-primary">10x</div>
                            <div class="small text-muted text-uppercase" style="font-size: 0.65rem;">Dev Speed</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
