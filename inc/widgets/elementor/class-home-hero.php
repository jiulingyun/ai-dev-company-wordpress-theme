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
                    <div class="hero-home__content grid-column-span-12 grid-column-span-lg-9">
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

                    <!-- Hero Visual/Terminal -->
                    <div class="hero-home__visual grid-column-span-12 grid-column-span-lg-3 d-none d-lg-block fade-in-up" style="animation-delay: 0.4s;">
                        <div class="terminal-window bg-surface border border-secondary rounded shadow-lg overflow-hidden" style="font-family: 'JetBrains Mono', monospace; font-size: 0.8rem;">
                            <div class="terminal-header bg-surface-alt border-bottom border-secondary p-sm d-flex align-center">
                                <div class="d-flex gap-xs me-md">
                                    <span class="rounded-circle bg-danger" style="width: 10px; height: 10px;"></span>
                                    <span class="rounded-circle bg-warning" style="width: 10px; height: 10px;"></span>
                                    <span class="rounded-circle bg-success" style="width: 10px; height: 10px;"></span>
                                </div>
                                <div class="text-muted small">ai-agent — zsh — 80x24</div>
                            </div>
                            <div class="terminal-body p-md text-success bg-terminal-body">
                                <div class="typing-animation">
                                    <p class="mb-2"><span class="text-primary">➜</span> <span class="text-text-main"><?php echo esc_html( $settings['terminal_command'] ); ?></span></p>
                                    
                                    <?php foreach ( $settings['terminal_lines'] as $line ) : ?>
                                        <p class="mb-2 <?php echo esc_attr( $line['line_type'] ); ?>">
                                            <?php if ( 'text-success' === $line['line_type'] ) : ?>
                                                <span class="text-success">✔</span>
                                            <?php endif; ?>
                                            <?php echo esc_html( $line['line_text'] ); ?>
                                        </p>
                                    <?php endforeach; ?>
                                    
                                    <p class="mb-0"><span class="text-primary">➜</span> <span class="blink">_</span></p>
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
