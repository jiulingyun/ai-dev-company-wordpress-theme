<?php
/**
 * AI Advantages Widget
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Widgets\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class AI_Advantages extends Widget_Base {

	public function get_name() {
		return 'ai_advantages';
	}

	public function get_title() {
		return __( 'AI Advantages', 'ai-dev-theme' );
	}

	public function get_icon() {
		return 'eicon-star';
	}

	public function get_categories() {
		return [ 'ai-dev-theme' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ai-dev-theme' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Advantage Title', 'ai-dev-theme' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'description',
			[
				'label' => __( 'Description', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Description of the advantage.', 'ai-dev-theme' ),
				'show_label' => true,
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'ai-dev-theme' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'advantages',
			[
				'label' => __( 'Advantages List', 'ai-dev-theme' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __( 'Speed', 'ai-dev-theme' ),
						'description' => __( 'Lightning fast execution.', 'ai-dev-theme' ),
						'icon' => [ 'value' => 'fas fa-bolt', 'library' => 'solid' ],
					],
					[
						'title' => __( 'Precision', 'ai-dev-theme' ),
						'description' => __( 'High accuracy results.', 'ai-dev-theme' ),
						'icon' => [ 'value' => 'fas fa-crosshairs', 'library' => 'solid' ],
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => __( 'Columns', 'ai-dev-theme' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$columns = $settings['columns'];
		?>
		<div class="ai-advantages-grid grid grid--auto-fit gap-lg" style="--grid-min-width: <?php echo 100 / $columns * 0.8; ?>%;">
			<?php foreach ( $settings['advantages'] as $index => $item ) : 
				$delay = ($index + 1) * 100; 
				?>
				<div class="card service-card fade-in-up elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?> h-100" style="animation-delay: <?php echo $delay; ?>ms;">
					<div class="card__content p-xl">
						<div class="service-icon mb-lg d-inline-flex align-center justify-center rounded-circle bg-surface border border-secondary" style="width: 64px; height: 64px;">
							<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true', 'class' => 'fa-lg' ] ); ?>
						</div>
						<h3 class="card__title h4 mb-md"><?php echo esc_html( $item['title'] ); ?></h3>
						<p class="card__excerpt text-muted mb-lg"><?php echo esc_html( $item['description'] ); ?></p>
                        <a href="#" class="text-primary text-decoration-none fw-bold small text-uppercase letter-spacing-sm hover-white transition-colors">Learn More <i class="fas fa-arrow-right ms-1"></i></a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	}
}
