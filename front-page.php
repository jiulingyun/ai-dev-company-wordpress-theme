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
                                        <span class="small text-muted text-uppercase"><?php esc_html_e( 'Accuracy', 'ai-dev-theme' ); ?></span>
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

    <!-- AI Workflow & Digital Employees Section -->
    <section id="ai-workflow" class="section py-2xl bg-surface overflow-hidden">
        <div class="container">
            <header class="section-header text-center mb-xl fade-in-up">
                <h2 class="section-title">
                    <span class="d-block h5 text-primary text-uppercase letter-spacing-sm mb-2"><?php esc_html_e( 'Intelligent Workflow', 'ai-dev-theme' ); ?></span>
                    <?php esc_html_e( 'AI-Driven Development Process', 'ai-dev-theme' ); ?>
                </h2>
                <p class="section-subtitle" style="max-width: 800px; margin-left: auto; margin-right: auto;">
                    <?php esc_html_e( 'From requirement gathering to code review, our AI digital employees participate in the entire process, orchestrating a seamless flow.', 'ai-dev-theme' ); ?>
                </p>
            </header>

            <!-- Workflow Steps -->
            <div class="workflow-steps mb-2xl fade-in-up delay-100">
            <!-- Workflow Steps -->
            <div class="workflow-steps mb-2xl">
                <!-- Desktop Horizontal Flow -->
                <div class="workflow-desktop-view">
                    <!-- Connecting Line -->
                    <div class="position-absolute top-0 start-0 w-100 border-top border-secondary border-dashed opacity-50" style="margin-top: 30px; z-index: 0;"></div>
                    
                    <!-- Step 1 -->
                    <div class="workflow-step-item text-center position-relative z-1 flex-grow-1 px-3">
                        <div class="step-icon d-inline-flex align-center justify-center rounded-circle bg-surface border border-primary mb-md position-relative shadow-sm" style="width: 60px; height: 60px;">
                            <i class="fas fa-comments text-primary fa-lg"></i>
                            <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-primary small border border-surface">1</span>
                        </div>
                        <h4 class="h6 mb-1"><?php esc_html_e( 'Requirement', 'ai-dev-theme' ); ?></h4>
                        <p class="small text-muted mb-0"><?php esc_html_e( 'Collecting', 'ai-dev-theme' ); ?></p>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="workflow-step-item text-center position-relative z-1 flex-grow-1 px-3">
                        <div class="step-icon d-inline-flex align-center justify-center rounded-circle bg-surface border border-secondary mb-md position-relative shadow-sm" style="width: 60px; height: 60px;">
                            <i class="fas fa-search-plus text-secondary fa-lg"></i>
                            <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-secondary small border border-surface">2</span>
                        </div>
                        <h4 class="h6 mb-1"><?php esc_html_e( 'Analysis', 'ai-dev-theme' ); ?></h4>
                        <p class="small text-muted mb-0"><?php esc_html_e( 'Processing', 'ai-dev-theme' ); ?></p>
                    </div>

                    <!-- Step 3 -->
                    <div class="workflow-step-item text-center position-relative z-1 flex-grow-1 px-3">
                        <div class="step-icon d-inline-flex align-center justify-center rounded-circle bg-surface border border-accent mb-md position-relative shadow-sm" style="width: 60px; height: 60px;">
                            <i class="fas fa-file-invoice-dollar text-accent fa-lg"></i>
                            <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-accent small border border-surface">3</span>
                        </div>
                        <h4 class="h6 mb-1"><?php esc_html_e( 'Quotation', 'ai-dev-theme' ); ?></h4>
                        <p class="small text-muted mb-0"><?php esc_html_e( 'Automated', 'ai-dev-theme' ); ?></p>
                    </div>

                    <!-- Step 4 -->
                    <div class="workflow-step-item text-center position-relative z-1 flex-grow-1 px-3">
                        <div class="step-icon d-inline-flex align-center justify-center rounded-circle bg-surface border border-info mb-md position-relative shadow-sm" style="width: 60px; height: 60px;">
                            <i class="fas fa-tasks text-info fa-lg"></i>
                            <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-info small border border-surface">4</span>
                        </div>
                        <h4 class="h6 mb-1"><?php esc_html_e( 'Planning', 'ai-dev-theme' ); ?></h4>
                        <p class="small text-muted mb-0"><?php esc_html_e( 'Scheduling', 'ai-dev-theme' ); ?></p>
                    </div>

                    <!-- Step 5 -->
                    <div class="workflow-step-item text-center position-relative z-1 flex-grow-1 px-3">
                        <div class="step-icon d-inline-flex align-center justify-center rounded-circle bg-surface border border-warning mb-md position-relative shadow-sm" style="width: 60px; height: 60px;">
                            <i class="fas fa-file-alt text-warning fa-lg"></i>
                            <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-warning small border border-surface">5</span>
                        </div>
                        <h4 class="h6 mb-1"><?php esc_html_e( 'Doc Gen', 'ai-dev-theme' ); ?></h4>
                        <p class="small text-muted mb-0"><?php esc_html_e( 'Specification', 'ai-dev-theme' ); ?></p>
                    </div>

                    <!-- Step 6 -->
                    <div class="workflow-step-item text-center position-relative z-1 flex-grow-1 px-3">
                        <div class="step-icon d-inline-flex align-center justify-center rounded-circle bg-surface border border-success mb-md position-relative shadow-sm" style="width: 60px; height: 60px;">
                            <i class="fas fa-code text-success fa-lg"></i>
                            <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-success small border border-surface">6</span>
                        </div>
                        <h4 class="h6 mb-1"><?php esc_html_e( 'AI Coding', 'ai-dev-theme' ); ?></h4>
                        <p class="small text-muted mb-0"><?php esc_html_e( 'MCP Execution', 'ai-dev-theme' ); ?></p>
                    </div>
                </div>

                <!-- Mobile Vertical Flow (Fallback) -->
                <div class="workflow-mobile-view">
                    <div class="grid grid--2 gap-md">
                        <!-- Step 1 -->
                        <div class="workflow-step-card p-3 bg-surface border border-secondary rounded text-center">
                            <div class="d-inline-block text-primary mb-2"><i class="fas fa-comments fa-2x"></i></div>
                            <h5 class="h6 mb-0"><?php esc_html_e( 'Requirement', 'ai-dev-theme' ); ?></h5>
                        </div>
                        <!-- Step 2 -->
                        <div class="workflow-step-card p-3 bg-surface border border-secondary rounded text-center">
                            <div class="d-inline-block text-secondary mb-2"><i class="fas fa-search-plus fa-2x"></i></div>
                            <h5 class="h6 mb-0"><?php esc_html_e( 'Analysis', 'ai-dev-theme' ); ?></h5>
                        </div>
                        <!-- Step 3 -->
                        <div class="workflow-step-card p-3 bg-surface border border-secondary rounded text-center">
                            <div class="d-inline-block text-accent mb-2"><i class="fas fa-file-invoice-dollar fa-2x"></i></div>
                            <h5 class="h6 mb-0"><?php esc_html_e( 'Quotation', 'ai-dev-theme' ); ?></h5>
                        </div>
                        <!-- Step 4 -->
                        <div class="workflow-step-card p-3 bg-surface border border-secondary rounded text-center">
                            <div class="d-inline-block text-info mb-2"><i class="fas fa-tasks fa-2x"></i></div>
                            <h5 class="h6 mb-0"><?php esc_html_e( 'Planning', 'ai-dev-theme' ); ?></h5>
                        </div>
                        <!-- Step 5 -->
                        <div class="workflow-step-card p-3 bg-surface border border-secondary rounded text-center">
                            <div class="d-inline-block text-warning mb-2"><i class="fas fa-file-alt fa-2x"></i></div>
                            <h5 class="h6 mb-0"><?php esc_html_e( 'Doc Gen', 'ai-dev-theme' ); ?></h5>
                        </div>
                        <!-- Step 6 -->
                        <div class="workflow-step-card p-3 bg-surface border border-secondary rounded text-center">
                            <div class="d-inline-block text-success mb-2"><i class="fas fa-code fa-2x"></i></div>
                            <h5 class="h6 mb-0"><?php esc_html_e( 'AI Coding', 'ai-dev-theme' ); ?></h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid--12 gap-xl align-center">
                <!-- AI Digital Employees (Left) -->
                <div class="grid-column-span-12 grid-column-span-lg-5 fade-in-up delay-200">
                    <h3 class="h4 mb-lg text-uppercase letter-spacing-sm">
                        <i class="fas fa-users-cog me-2 text-primary"></i><?php esc_html_e( 'AI Digital Workforce', 'ai-dev-theme' ); ?>
                    </h3>
                    
                    <div class="d-flex flex-column gap-md">
                        <!-- Agent Card 1 -->
                        <div class="agent-card d-flex align-center p-md bg-surface border border-secondary rounded hover-transform transition-all">
                            <div class="agent-avatar me-md position-relative">
                                <div class="avatar-circle bg-surface-alt rounded-circle d-flex align-center justify-center border border-primary" style="width: 48px; height: 48px;">
                                    <i class="fas fa-user-shield text-primary"></i>
                                </div>
                                <div class="status-dot position-absolute bottom-0 end-0 bg-success rounded-circle border border-surface" style="width: 10px; height: 10px;"></div>
                            </div>
                            <div>
                                <h4 class="h6 mb-0"><?php esc_html_e( 'Code Reviewer', 'ai-dev-theme' ); ?></h4>
                                <p class="small text-muted mb-0"><?php esc_html_e( 'Audits code quality & security', 'ai-dev-theme' ); ?></p>
                            </div>
                            <span class="ms-auto badge bg-primary bg-opacity-10 text-primary small">GPT-4o</span>
                        </div>

                        <!-- Agent Card 2 -->
                        <div class="agent-card d-flex align-center p-md bg-surface border border-secondary rounded hover-transform transition-all">
                            <div class="agent-avatar me-md position-relative">
                                <div class="avatar-circle bg-surface-alt rounded-circle d-flex align-center justify-center border border-secondary" style="width: 48px; height: 48px;">
                                    <i class="fas fa-layer-group text-secondary"></i>
                                </div>
                                <div class="status-dot position-absolute bottom-0 end-0 bg-success rounded-circle border border-surface" style="width: 10px; height: 10px;"></div>
                            </div>
                            <div>
                                <h4 class="h6 mb-0"><?php esc_html_e( 'Tech Stack Advisor', 'ai-dev-theme' ); ?></h4>
                                <p class="small text-muted mb-0"><?php esc_html_e( 'Recommends architecture', 'ai-dev-theme' ); ?></p>
                            </div>
                            <span class="ms-auto badge bg-secondary bg-opacity-10 text-secondary small">Claude 3.5</span>
                        </div>

                        <!-- Agent Card 3 -->
                        <div class="agent-card d-flex align-center p-md bg-surface border border-secondary rounded hover-transform transition-all">
                            <div class="agent-avatar me-md position-relative">
                                <div class="avatar-circle bg-surface-alt rounded-circle d-flex align-center justify-center border border-accent" style="width: 48px; height: 48px;">
                                    <i class="fas fa-chart-line text-accent"></i>
                                </div>
                                <div class="status-dot position-absolute bottom-0 end-0 bg-success rounded-circle border border-surface" style="width: 10px; height: 10px;"></div>
                            </div>
                            <div>
                                <h4 class="h6 mb-0"><?php esc_html_e( 'Quotation Analyst', 'ai-dev-theme' ); ?></h4>
                                <p class="small text-muted mb-0"><?php esc_html_e( 'Estimates cost & timeline', 'ai-dev-theme' ); ?></p>
                            </div>
                            <span class="ms-auto badge bg-accent bg-opacity-10 text-accent small">Qwen Max</span>
                        </div>
                        
                        <!-- Agent Card 4 -->
                        <div class="agent-card d-flex align-center p-md bg-surface border border-secondary rounded hover-transform transition-all">
                            <div class="agent-avatar me-md position-relative">
                                <div class="avatar-circle bg-surface-alt rounded-circle d-flex align-center justify-center border border-info" style="width: 48px; height: 48px;">
                                    <i class="fas fa-clipboard-list text-info"></i>
                                </div>
                                <div class="status-dot position-absolute bottom-0 end-0 bg-success rounded-circle border border-surface" style="width: 10px; height: 10px;"></div>
                            </div>
                            <div>
                                <h4 class="h6 mb-0"><?php esc_html_e( 'Requirement Collector', 'ai-dev-theme' ); ?></h4>
                                <p class="small text-muted mb-0"><?php esc_html_e( 'Structures user needs', 'ai-dev-theme' ); ?></p>
                            </div>
                            <span class="ms-auto badge bg-info bg-opacity-10 text-info small">DeepSeek</span>
                        </div>
                    </div>
                </div>

                <!-- AI Workbench Screenshot (Right) -->
                <div class="grid-column-span-12 grid-column-span-lg-7 fade-in-up delay-300">
                    <div class="workbench-preview position-relative">
                        <!-- Background Glow -->
                        <div class="position-absolute top-50 start-50 translate-middle bg-primary opacity-20 blur-3xl rounded-circle" style="width: 400px; height: 400px; z-index: 0;"></div>
                        
                        <!-- Main Screenshot Window -->
                        <div class="window-frame bg-surface border border-secondary rounded-lg shadow-2xl overflow-hidden position-relative z-1" style="transform: perspective(1000px) rotateY(-2deg);">
                            <!-- Window Header -->
                            <div class="window-header bg-surface-alt border-bottom border-secondary p-sm d-flex align-center justify-between">
                                <div class="d-flex gap-xs">
                                    <span class="rounded-circle bg-danger" style="width: 10px; height: 10px;"></span>
                                    <span class="rounded-circle bg-warning" style="width: 10px; height: 10px;"></span>
                                    <span class="rounded-circle bg-success" style="width: 10px; height: 10px;"></span>
                                </div>
                                <div class="text-muted small mx-auto"><?php esc_html_e( 'AI Workbench - Project Dashboard', 'ai-dev-theme' ); ?></div>
                                <div class="d-flex gap-sm text-muted small">
                                    <i class="fas fa-bell"></i>
                                    <i class="fas fa-cog"></i>
                                </div>
                            </div>
                            
                            <!-- Window Content (Simulated Dashboard) -->
                            <div class="window-content bg-surface p-0">
                                <div class="d-flex" style="height: 400px;">
                                    <!-- Sidebar -->
                                    <div class="sidebar bg-surface-alt border-end border-secondary p-3 d-none d-sm-block" style="width: 200px;">
                                        <div class="d-flex align-center gap-2 mb-4 text-primary">
                                            <i class="fas fa-robot fa-lg"></i>
                                            <span class="fw-bold">AI Workbench</span>
                                        </div>
                                        <div class="nav flex-column gap-2">
                                            <div class="nav-item p-2 rounded bg-primary bg-opacity-10 text-primary"><i class="fas fa-home me-2"></i> <?php esc_html_e( 'Dashboard', 'ai-dev-theme' ); ?></div>
                                            <div class="nav-item p-2 rounded text-muted"><i class="fas fa-project-diagram me-2"></i> <?php esc_html_e( 'Workflow', 'ai-dev-theme' ); ?></div>
                                            <div class="nav-item p-2 rounded text-muted"><i class="fas fa-users me-2"></i> <?php esc_html_e( 'Digital Employees', 'ai-dev-theme' ); ?></div>
                                            <div class="nav-item p-2 rounded text-muted"><i class="fas fa-file-code me-2"></i> <?php esc_html_e( 'Documents', 'ai-dev-theme' ); ?></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Main Area -->
                                    <div class="main-area flex-grow-1 p-4 bg-surface-alt bg-opacity-50">
                                        <div class="d-flex justify-between align-center mb-4">
                                            <h4 class="h5 mb-0"><?php esc_html_e( 'Active Projects', 'ai-dev-theme' ); ?></h4>
                                            <button class="button button--sm button--primary"><i class="fas fa-plus me-1"></i> <?php esc_html_e( 'New Task', 'ai-dev-theme' ); ?></button>
                                        </div>
                                        
                                        <div class="grid grid--2 gap-3">
                                            <!-- Project Card 1 -->
                                            <div class="p-3 bg-surface rounded border border-secondary shadow-sm">
                                                <div class="d-flex justify-between mb-2">
                                                    <span class="badge bg-warning bg-opacity-10 text-warning">In Progress</span>
                                                    <i class="fas fa-ellipsis-h text-muted"></i>
                                                </div>
                                                <h5 class="h6 mb-1">SaaS Platform Dev</h5>
                                                <div class="progress-bar bg-surface-alt rounded-pill mb-2" style="height: 6px;">
                                                    <div class="progress-bar__fill bg-warning h-100" style="width: 65%;"></div>
                                                </div>
                                                <div class="d-flex align-center gap-2 small text-muted">
                                                    <i class="fas fa-robot text-primary"></i>
                                                    <span>AI Coding...</span>
                                                </div>
                                            </div>
                                            
                                            <!-- Project Card 2 -->
                                            <div class="p-3 bg-surface rounded border border-secondary shadow-sm">
                                                <div class="d-flex justify-between mb-2">
                                                    <span class="badge bg-success bg-opacity-10 text-success">Completed</span>
                                                    <i class="fas fa-ellipsis-h text-muted"></i>
                                                </div>
                                                <h5 class="h6 mb-1">Marketing Website</h5>
                                                <div class="progress-bar bg-surface-alt rounded-pill mb-2" style="height: 6px;">
                                                    <div class="progress-bar__fill bg-success h-100" style="width: 100%;"></div>
                                                </div>
                                                <div class="d-flex align-center gap-2 small text-muted">
                                                    <i class="fas fa-check-circle text-success"></i>
                                                    <span>Deployed</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Agent Activity Log -->
                                        <div class="mt-4 p-3 bg-terminal-body rounded border border-secondary font-secondary small text-success">
                                            <div class="mb-1"><span class="text-muted">10:42:01</span> [Requirement_Collector] User needs updated</div>
                                            <div class="mb-1"><span class="text-muted">10:42:05</span> [Tech_Stack_Advisor] Recommended stack: Next.js + Supabase</div>
                                            <div class="mb-1"><span class="text-muted">10:42:12</span> [Quote_Analyst] Estimation complete: 48h / $2.5k</div>
                                            <div><span class="text-primary">➜</span> <span class="blink">_</span></div>
                                        </div>
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
