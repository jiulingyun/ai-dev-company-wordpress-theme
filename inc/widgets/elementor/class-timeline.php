<?php
/**
 * Timeline Widget
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Widgets\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Timeline extends Widget_Base {

	public function get_name() {
		return 'timeline';
	}

	public function get_title() {
		return __( 'Timeline', 'ai-dev-theme' );
	}

	public function get_icon() {
		return 'eicon-time-line';
	}

	public function get_categories() {
		return [ 'ai-dev-theme' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Timeline Items', 'ai-dev-theme' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'year',
			[
				'label' => __( 'Year/Date', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '2025', 'ai-dev-theme' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Milestone Title', 'ai-dev-theme' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'description',
			[
				'label' => __( 'Description', 'ai-dev-theme' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 3,
				'default' => __( 'Description of the milestone.', 'ai-dev-theme' ),
			]
		);

		$this->add_control(
			'timeline_items',
			[
				'label' => __( 'Timeline List', 'ai-dev-theme' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'year' => __( '2023', 'ai-dev-theme' ),
						'title' => __( 'Founded', 'ai-dev-theme' ),
						'description' => __( 'AI Dev Company was established with a vision to revolutionize software development.', 'ai-dev-theme' ),
					],
                    [
						'year' => __( '2024', 'ai-dev-theme' ),
						'title' => __( 'First Major Release', 'ai-dev-theme' ),
						'description' => __( 'Launched our flagship AI coding assistant platform.', 'ai-dev-theme' ),
					],
                    [
						'year' => __( '2025', 'ai-dev-theme' ),
						'title' => __( 'Global Expansion', 'ai-dev-theme' ),
						'description' => __( 'Opened offices in London and Tokyo.', 'ai-dev-theme' ),
					],
				],
				'title_field' => '{{{ year }}} - {{{ title }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="timeline-container position-relative py-lg">
            <div class="timeline-line" style="position: absolute; left: 50%; top: 0; bottom: 0; width: 2px; background: var(--color-border); transform: translateX(-50%);"></div>
            
			<?php foreach ( $settings['timeline_items'] as $index => $item ) : 
                $side = ($index % 2 == 0) ? 'left' : 'right';
                $fade_direction = ($side == 'left') ? 'slide-in-left' : 'slide-in-right';
                ?>
				<div class="timeline-item <?php echo $fade_direction; ?>">
                    <!-- Spacer for layout -->
                    <div class="timeline-spacer"></div>
                    
                    <!-- Marker -->
                    <div class="timeline-marker"></div>
                    
                    <!-- Content -->
                    <div class="timeline-content card p-lg" style="<?php echo ($side == 'left') ? 'margin-right: auto; text-align: right;' : 'margin-left: auto; text-align: left;'; ?>">
                        <span class="timeline-year"><?php echo esc_html( $item['year'] ); ?></span>
                        <h3 class="timeline-title"><?php echo esc_html( $item['title'] ); ?></h3>
                        <p class="timeline-desc"><?php echo esc_html( $item['description'] ); ?></p>
                    </div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	}
}
