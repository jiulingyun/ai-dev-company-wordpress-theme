<?php
/**
 * AI Split Feature Widget
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Widgets\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class AI_Split_Feature extends Widget_Base {

	public function get_name() {
		return 'ai_split_feature';
	}

	public function get_title() {
		return __( 'AI Split Feature', 'ai-dev-theme' );
	}

	public function get_icon() {
		return 'eicon-columns';
	}

	public function get_categories() {
		return [ 'ai-dev-theme' ];
	}

	protected function register_controls() {
        // Content
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ai-dev-theme' ),
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label' => __( 'Subtitle', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'The AI Advantage', 'ai-dev-theme' ),
			]
		);

        $this->add_control(
			'title',
			[
				'label' => __( 'Title', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Why Choose AI-Driven Development?', 'ai-dev-theme' ),
			]
		);

        $this->add_control(
			'description',
			[
				'label' => __( 'Description', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Traditional software development is slow and error-prone. We use autonomous AI agents to write, test, and deploy code at speeds previously impossible.', 'ai-dev-theme' ),
			]
		);

        $repeater = new Repeater();

        $repeater->add_control(
			'icon_class',
			[
				'label' => __( 'Icon Class', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'fas fa-bolt',
			]
		);

        $repeater->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color Class', 'ai-dev-theme' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'text-primary',
                'options' => [
                    'text-primary' => 'Primary',
                    'text-secondary' => 'Secondary',
                    'text-accent' => 'Accent',
                ]
			]
		);

        $repeater->add_control(
			'feature_title',
			[
				'label' => __( 'Feature Title', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '10x Faster Delivery', 'ai-dev-theme' ),
			]
		);

        $repeater->add_control(
			'feature_desc',
			[
				'label' => __( 'Feature Description', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Weeks become days. We launch MVPs in record time.', 'ai-dev-theme' ),
			]
		);

        $this->add_control(
			'features',
			[
				'label' => __( 'Features List', 'ai-dev-theme' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
                        'icon_class' => 'fas fa-bolt',
                        'icon_color' => 'text-primary',
                        'feature_title' => '10x Faster Delivery',
                        'feature_desc' => 'Weeks become days. We launch MVPs in record time without compromising quality.',
                    ],
                    [
                        'icon_class' => 'fas fa-bug',
                        'icon_color' => 'text-accent',
                        'feature_title' => 'Zero-Defect Code',
                        'feature_desc' => 'AI agents run thousands of test cases instantly, catching bugs before they exist.',
                    ],
                    [
                        'icon_class' => 'fas fa-coins',
                        'icon_color' => 'text-secondary',
                        'feature_title' => 'Cost Efficiency',
                        'feature_desc' => 'Reduce development costs by up to 60% by automating repetitive coding tasks.',
                    ],
				],
				'title_field' => '{{{ feature_title }}}',
			]
		);

		$this->end_controls_section();

        // Metrics Card
        $this->start_controls_section(
			'section_metrics',
			[
				'label' => __( 'Metrics Card', 'ai-dev-theme' ),
			]
		);

        $this->add_control(
			'card_title',
			[
				'label' => __( 'Card Title', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'AI Performance Metrics', 'ai-dev-theme' ),
			]
		);

        $this->add_control(
			'metric_1_label',
			[
				'label' => __( 'Metric 1 Label', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Development Speed', 'ai-dev-theme' ),
			]
		);

        $this->add_control(
			'metric_1_value',
			[
				'label' => __( 'Metric 1 Value (AI)', 'ai-dev-theme' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 95,
				],
                'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
			]
		);

        $this->add_control(
			'metric_1_value_trad',
			[
				'label' => __( 'Metric 1 Value (Traditional)', 'ai-dev-theme' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
                'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
			]
		);

        $this->add_control(
			'box_1_value',
			[
				'label' => __( 'Box 1 Value', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => '99.9%',
			]
		);

        $this->add_control(
			'box_1_label',
			[
				'label' => __( 'Box 1 Label', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Uptime',
			]
		);

        $this->add_control(
			'box_2_value',
			[
				'label' => __( 'Box 2 Value', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => '<24h',
			]
		);

        $this->add_control(
			'box_2_label',
			[
				'label' => __( 'Box 2 Label', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'MVP Launch',
			]
		);

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="ai-split-feature overflow-hidden">
            <div class="row align-center">
                <div class="col-lg-6 mb-xl mb-lg-0 fade-in-up">
                    <h2 class="h1 mb-lg">
                        <span class="text-primary d-block h5 text-uppercase letter-spacing-sm mb-2"><?php echo esc_html( $settings['subtitle'] ); ?></span>
                        <?php echo esc_html( $settings['title'] ); ?>
                    </h2>
                    <p class="lead text-muted mb-xl">
                        <?php echo esc_html( $settings['description'] ); ?>
                    </p>
                    
                    <div class="feature-list">
                        <?php foreach ( $settings['features'] as $feature ) : ?>
                            <div class="feature-item d-flex mb-lg">
                                <div class="icon-box me-4 <?php echo esc_attr( $feature['icon_color'] ); ?>">
                                    <i class="<?php echo esc_attr( $feature['icon_class'] ); ?> fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="h5 mb-2"><?php echo esc_html( $feature['feature_title'] ); ?></h3>
                                    <p class="text-muted mb-0"><?php echo esc_html( $feature['feature_desc'] ); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="col-lg-6 fade-in-up" style="animation-delay: 0.2s;">
                    <div class="position-relative">
                        <!-- Decorative Elements -->
                        <div class="position-absolute top-0 end-0 translate-middle-y bg-primary opacity-25 blur-3xl rounded-circle" style="width: 300px; height: 300px; z-index: 0;"></div>
                        
                        <div class="card p-0 border-secondary overflow-hidden position-relative z-1">
                            <div class="card-header bg-dark border-bottom border-secondary p-sm d-flex justify-between align-center">
                                <span class="text-muted small"><?php echo esc_html( $settings['card_title'] ); ?></span>
                                <div class="d-flex gap-xs">
                                    <span class="rounded-circle bg-secondary" style="width: 8px; height: 8px;"></span>
                                    <span class="rounded-circle bg-secondary" style="width: 8px; height: 8px;"></span>
                                </div>
                            </div>
                            <div class="card-body p-lg bg-surface">
                                <!-- Simulated Chart/Graph -->
                                <div class="mb-lg">
                                    <div class="d-flex justify-between mb-2">
                                        <span class="small fw-bold"><?php echo esc_html( $settings['metric_1_label'] ); ?></span>
                                        <span class="small text-primary"><?php esc_html_e( 'AI vs Traditional', 'ai-dev-theme' ); ?></span>
                                    </div>
                                    <div class="progress-bar bg-dark rounded-pill mb-2" style="height: 8px;">
                                        <div class="progress-bar__fill bg-primary h-100" style="width: <?php echo esc_attr( $settings['metric_1_value']['size'] ); ?>%;"></div>
                                    </div>
                                    <div class="progress-bar bg-dark rounded-pill" style="height: 8px; opacity: 0.3;">
                                        <div class="progress-bar__fill bg-white h-100" style="width: <?php echo esc_attr( $settings['metric_1_value_trad']['size'] ); ?>%;"></div>
                                    </div>
                                </div>
                                
                                <div class="grid grid--2 gap-md">
                                    <div class="stat-box p-md bg-dark rounded border border-secondary border-opacity-25 text-center">
                                        <span class="d-block h2 text-accent mb-1"><?php echo esc_html( $settings['box_1_value'] ); ?></span>
                                        <span class="small text-muted text-uppercase"><?php echo esc_html( $settings['box_1_label'] ); ?></span>
                                    </div>
                                    <div class="stat-box p-md bg-dark rounded border border-secondary border-opacity-25 text-center">
                                        <span class="d-block h2 text-primary mb-1"><?php echo esc_html( $settings['box_2_value'] ); ?></span>
                                        <span class="small text-muted text-uppercase"><?php echo esc_html( $settings['box_2_label'] ); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}
