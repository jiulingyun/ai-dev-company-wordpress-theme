<?php
/**
 * Stats Counter Widget
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Widgets\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Stats_Counter extends Widget_Base {

	public function get_name() {
		return 'stats_counter';
	}

	public function get_title() {
		return __( 'Stats Counter', 'ai-dev-theme' );
	}

	public function get_icon() {
		return 'eicon-counter';
	}

	public function get_categories() {
		return [ 'ai-dev-theme' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Statistics', 'ai-dev-theme' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'number',
			[
				'label' => __( 'Number', 'ai-dev-theme' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 100,
			]
		);

		$repeater->add_control(
			'suffix',
			[
				'label' => __( 'Suffix', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => '+',
				'placeholder' => '+, %, k',
			]
		);

		$repeater->add_control(
			'label',
			[
				'label' => __( 'Label', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Projects Completed', 'ai-dev-theme' ),
			]
		);

		$this->add_control(
			'stats',
			[
				'label' => __( 'Stats List', 'ai-dev-theme' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'number' => 50,
						'suffix' => '+',
						'label' => __( 'Happy Clients', 'ai-dev-theme' ),
					],
                    [
						'number' => 120,
						'suffix' => '',
						'label' => __( 'Projects Delivered', 'ai-dev-theme' ),
					],
                    [
						'number' => 5,
						'suffix' => '',
						'label' => __( 'Years Experience', 'ai-dev-theme' ),
					],
                    [
						'number' => 24,
						'suffix' => '/7',
						'label' => __( 'Support', 'ai-dev-theme' ),
					],
				],
				'title_field' => '{{{ label }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="stats-grid grid grid--auto-fit gap-lg text-center">
			<?php foreach ( $settings['stats'] as $index => $item ) : ?>
				<div class="stat-item fade-in-up" style="animation-delay: <?php echo $index * 100; ?>ms;">
                    <div class="stat-number-wrapper mb-xs" style="font-size: 3rem; font-weight: 700; font-family: var(--font-display); color: var(--color-primary); text-shadow: var(--glow-primary);">
                        <span class="counter" data-target="<?php echo esc_attr( $item['number'] ); ?>">0</span><span class="stat-suffix"><?php echo esc_html( $item['suffix'] ); ?></span>
                    </div>
                    <div class="stat-label" style="font-family: var(--font-secondary); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--color-text-muted);">
                        <?php echo esc_html( $item['label'] ); ?>
                    </div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	}
}
