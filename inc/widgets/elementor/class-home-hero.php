<?php
/**
 * Home Hero Widget
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Widgets\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Home_Hero extends Widget_Base {

	public function get_name() {
		return 'ai_home_hero';
	}

	public function get_title() {
		return __( 'AI Home Hero', 'ai-dev-theme' );
	}

	public function get_icon() {
		return 'eicon-device-desktop';
	}

	public function get_categories() {
		return [ 'ai-dev-theme' ];
	}

	protected function register_controls() {
		// Content Tab
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Hero Content', 'ai-dev-theme' ),
			]
		);

		$this->add_control(
			'badge_text',
			[
				'label' => __( 'Badge Text', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'AI-First Development Agency', 'ai-dev-theme' ),
			]
		);

		$this->add_control(
			'title_line_1',
			[
				'label' => __( 'Title Line 1', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Code the Future', 'ai-dev-theme' ),
			]
		);

		$this->add_control(
			'title_line_2',
			[
				'label' => __( 'Title Line 2 (Highlighted)', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'With Intelligence', 'ai-dev-theme' ),
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __( 'Description (Typewriter)', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'We build enterprise-grade software 10x faster using advanced AI agents. 98% of our code is AI-generated, 100% human-verified.', 'ai-dev-theme' ),
			]
		);

		$this->end_controls_section();

		// Buttons Tab
		$this->start_controls_section(
			'section_buttons',
			[
				'label' => __( 'Buttons', 'ai-dev-theme' ),
			]
		);

		$this->add_control(
			'btn_primary_text',
			[
				'label' => __( 'Primary Button Text', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Start Your Project', 'ai-dev-theme' ),
			]
		);

		$this->add_control(
			'btn_primary_url',
			[
				'label' => __( 'Primary Button Link', 'ai-dev-theme' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ai-dev-theme' ),
				'default' => [
					'url' => '#contact',
				],
			]
		);

		$this->add_control(
			'btn_secondary_text',
			[
				'label' => __( 'Secondary Button Text', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'View Case Studies', 'ai-dev-theme' ),
			]
		);

		$this->add_control(
			'btn_secondary_url',
			[
				'label' => __( 'Secondary Button Link', 'ai-dev-theme' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ai-dev-theme' ),
				'default' => [
					'url' => '#projects',
				],
			]
		);

		$this->end_controls_section();

        // Terminal Content
        $this->start_controls_section(
			'section_terminal',
			[
				'label' => __( 'Terminal Content', 'ai-dev-theme' ),
			]
		);

        $this->add_control(
			'terminal_command',
			[
				'label' => __( 'Command', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'init_project --type=saas --ai-model=gpt-4',
			]
		);

        $repeater = new Repeater();

		$repeater->add_control(
			'line_text',
			[
				'label' => __( 'Line Text', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Processing...', 'ai-dev-theme' ),
			]
		);

        $repeater->add_control(
			'line_type',
			[
				'label' => __( 'Line Type', 'ai-dev-theme' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'text-muted',
				'options' => [
					'text-muted' => __( 'Muted (Info)', 'ai-dev-theme' ),
					'text-success' => __( 'Success (Green Check)', 'ai-dev-theme' ),
                    'text-white' => __( 'White (Standard)', 'ai-dev-theme' ),
				],
			]
		);

        $this->add_control(
			'terminal_lines',
			[
				'label' => __( 'Terminal Output Lines', 'ai-dev-theme' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'line_text' => __( 'Analyzing requirements...', 'ai-dev-theme' ),
						'line_type' => 'text-muted',
					],
                    [
						'line_text' => __( 'Generating architecture...', 'ai-dev-theme' ),
						'line_type' => 'text-muted',
					],
                    [
						'line_text' => __( 'Backend structure created', 'ai-dev-theme' ),
						'line_type' => 'text-success',
					],
                    [
						'line_text' => __( 'Database schema optimized', 'ai-dev-theme' ),
						'line_type' => 'text-success',
					],
                    [
						'line_text' => __( 'Frontend components generated', 'ai-dev-theme' ),
						'line_type' => 'text-success',
					],
				],
				'title_field' => '{{{ line_text }}}',
			]
		);

        $this->end_controls_section();

        // Trust Indicators
        $this->start_controls_section(
			'section_trust',
			[
				'label' => __( 'Trust Indicators', 'ai-dev-theme' ),
			]
		);

        $this->add_control(
			'trust_text',
			[
				'label' => __( 'Trust Text', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Trusted by innovators', 'ai-dev-theme' ),
			]
		);

        $repeater_trust = new Repeater();

        $repeater_trust->add_control(
			'icon_class',
			[
				'label' => __( 'Icon Class (FontAwesome)', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'fab fa-aws',
                'description' => 'e.g., fab fa-aws, fab fa-google'
			]
		);

        $this->add_control(
			'trust_icons',
			[
				'label' => __( 'Icons List', 'ai-dev-theme' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater_trust->get_controls(),
				'default' => [
					[ 'icon_class' => 'fab fa-aws' ],
                    [ 'icon_class' => 'fab fa-google' ],
                    [ 'icon_class' => 'fab fa-microsoft' ],
                    [ 'icon_class' => 'fab fa-react' ],
				],
				'title_field' => '{{{ icon_class }}}',
			]
		);

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
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
                        <?php if ( $settings['badge_text'] ) : ?>
                            <div class="badge badge--tech mb-md fade-in-up" style="animation-delay: 0.1s;">
                                <i class="fas fa-robot me-2"></i><?php echo esc_html( $settings['badge_text'] ); ?>
                            </div>
                        <?php endif; ?>
                        
                        <h1 class="hero-home__title display-1 glitch mb-md" data-text="<?php echo esc_attr( $settings['title_line_1'] ); ?>">
                            <?php echo esc_html( $settings['title_line_1'] ); ?>
                            <span class="d-block text-primary"><?php echo esc_html( $settings['title_line_2'] ); ?></span>
                        </h1>
                        
                        <p class="hero-home__subtitle lead text-muted mb-xl fade-in-up typewriter" data-text="<?php echo esc_attr( $settings['description'] ); ?>" data-speed="30" data-delay="500" style="max-width: 800px;">
                        </p>
                        
                        <div class="hero-home__actions d-flex gap-md fade-in-up" style="animation-delay: 0.5s;">
                            <?php if ( $settings['btn_primary_text'] ) : ?>
                                <a href="<?php echo esc_url( $settings['btn_primary_url']['url'] ); ?>" class="button button--primary button--lg">
                                    <i class="fas fa-rocket me-2"></i><?php echo esc_html( $settings['btn_primary_text'] ); ?>
                                </a>
                            <?php endif; ?>

                            <?php if ( $settings['btn_secondary_text'] ) : ?>
                                <a href="<?php echo esc_url( $settings['btn_secondary_url']['url'] ); ?>" class="button button--outline button--lg">
                                    <i class="fas fa-eye me-2"></i><?php echo esc_html( $settings['btn_secondary_text'] ); ?>
                                </a>
                            <?php endif; ?>
                        </div>

                        <!-- Trust Indicators -->
                        <div class="hero-home__trust mt-2xl fade-in-up" style="animation-delay: 0.7s;">
                            <?php if ( $settings['trust_text'] ) : ?>
                                <p class="text-uppercase letter-spacing-sm text-muted small mb-md opacity-50"><?php echo esc_html( $settings['trust_text'] ); ?></p>
                            <?php endif; ?>
                            
                            <?php if ( ! empty( $settings['trust_icons'] ) ) : ?>
                                <div class="d-flex align-center gap-xl opacity-50">
                                    <?php foreach ( $settings['trust_icons'] as $icon ) : ?>
                                        <i class="<?php echo esc_attr( $icon['icon_class'] ); ?> fa-2x"></i>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
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
		<?php
	}
}
